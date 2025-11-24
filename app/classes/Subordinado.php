<?php
require_once __DIR__ . '/Conexao.php';

class Subordinado {
    private $conexao;
    
    public function __construct() {
        $this->conexao = new Conexao();
     }

    /*Cadastra um subordinado vinculado a uma organização*/
    public function cadastrar($id_usuario, $id_organizacao, $ativo = true) {
        $stmt = $this->conexao->prepare("
            INSERT INTO Subordinado (id_usuario, id_organizacao, ativo)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_usuario, $id_organizacao, $ativo]);
    }

    /* Retorna todos os subordinados de uma organização*/
    public function listarPorOrganizacao($id_organizacao) {
        $stmt = $this->conexao->prepare("
            SELECT s.*, u.nome, u.email 
            FROM Subordinado s
            INNER JOIN Usuario u ON s.id_usuario = u.id_usuario
            WHERE s.id_organizacao = ?
        ");
        $stmt->execute([$id_organizacao]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*Retorna todos os subordinados vinculados a um usuário*/
    public function listarPorUsuario($id_usuario) {
        $stmt = $this->conexao->prepare("
            SELECT s.*, o.nome AS organizacao
            FROM Subordinado s
            INNER JOIN Organizacao o ON s.id_organizacao = o.id_organizacao
            WHERE s.id_usuario = ?
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*Busca um subordinado específico (por id)*/
    public function buscarPorId($id_subordinado) {
        $stmt = $this->conexao->prepare("
            SELECT * FROM Subordinado WHERE id_subordinado = ?
        ");
        $stmt->execute([$id_subordinado]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*Busca um subordinado por id_usuario*/
    public function buscarPorIdUsuario($id_usuario) {
        $stmt = $this->conexao->prepare("
            SELECT * FROM Subordinado WHERE id_usuario = ?
        ");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*Verifica se um subordinado está ativo*/
    public function estaAtivo($id_usuario, $id_organizacao) {
        $stmt = $this->conexao->prepare("
            SELECT ativo FROM Subordinado
            WHERE id_usuario = ? AND id_organizacao = ?
        ");
        $stmt->execute([$id_usuario, $id_organizacao]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? (bool)$resultado['ativo'] : false;
    }

    /*Desativa ou reativa um subordinado*/
    public function alterarStatus($id_subordinado, $ativo) {
        $stmt = $this->conexao->prepare("
            UPDATE Subordinado SET ativo = ? WHERE id_subordinado = ?
        ");
        return $stmt->execute([$ativo, $id_subordinado]);
    }
}
?>