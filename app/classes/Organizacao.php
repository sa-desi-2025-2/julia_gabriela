<?php
require_once __DIR__ . '/Conexao.php';

class Organizacao {
    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }
    
    /*Cadastra uma nova organização*/
    public function cadastrar($nome, $id_usuario_criador) {
        $stmt = $this->conexao->prepare("
            INSERT INTO Organizacao (nome, id_usuario_criador)
            VALUES (?, ?)
        ");
        return $stmt->execute([$nome, $id_usuario_criador]);
    }

    /*Retorna todas as organizações criadas por um usuário*/
    public function listarPorUsuario($id_usuario_criador) {
        $stmt = $this->conexao->prepare("
            SELECT * FROM Organizacao
            WHERE id_usuario_criador = ?
            ORDER BY data_criacao DESC
        ");
        $stmt->execute([$id_usuario_criador]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*Retorna uma organização específica*/
    public function buscarPorId($id_organizacao) {
        $stmt = $this->conexao->prepare("
            SELECT o.*, u.nome AS criador
            FROM Organizacao o
            INNER JOIN Usuario u ON o.id_usuario_criador = u.id_usuario
            WHERE o.id_organizacao = ?
        ");
        $stmt->execute([$id_organizacao]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*Atualiza o nome da organização*/
    public function atualizarNome($id_organizacao, $novo_nome) {
        $stmt = $this->conexao->prepare("
            UPDATE Organizacao SET nome = ? WHERE id_organizacao = ?
        ");
        return $stmt->execute([$novo_nome, $id_organizacao]);
    }

    /*Conta quantos subordinados estão vinculados a uma organização*/
    public function contarSubordinados($id_organizacao) {
        $stmt = $this->conexao->prepare("
            SELECT COUNT(*) AS total
            FROM Subordinado
            WHERE id_organizacao = ?
        ");
        $stmt->execute([$id_organizacao]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;
    }

    /*Conta quantos cofres existem dentro da organização*/
    public function contarCofres($id_organizacao) {
        $stmt = $this->conexao->prepare("
            SELECT COUNT(c.id_cofre) AS total
            FROM Cofre c
            INNER JOIN Subordinado s ON c.id_subordinado = s.id_subordinado
            WHERE s.id_organizacao = ?
        ");
        $stmt->execute([$id_organizacao]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] ?? 0;
    }
}

    // organização do usuario
    if (isset($_GET['listar'])) {
        $organizacoes = $org->listarPorUsuario($_SESSION['id_usuario']);

        foreach ($organizacoes as $o) {
            $subordinados = $org->contarSubordinados($o['id_organizacao']);
            $cofres = $org->contarCofres($o['id_organizacao']);
        }
    }
    // editar organização
    if (isset($_POST['editar_id']) && isset($_POST['novo_nome'])) {
        $id = (int)$_POST['editar_id'];
        $novo_nome = trim($_POST['novo_nome']);

        if ($org->atualizarNome($id, $novo_nome)) {
            $_SESSION['msg_sucesso'] = "Organização atualizada com sucesso!";
        } else {
            $_SESSION['msg_erro'] = "Erro ao atualizar o nome.";
        }
        header("Location: ../pages/painel.php");
        exit;
    }
    // excluir organização
    if (isset($_GET['excluir'])) {
        $id = (int)$_GET['excluir'];

        if ($org->excluir($id)) {
            $_SESSION['msg_sucesso'] = "Organização excluída com sucesso!";
        } else {
            $_SESSION['msg_erro'] = "Erro ao excluir a organização.";
        }
        header("Location: ../pages/painel.php");
        exit;

         /*Exclui uma organização
    public function excluir($id_organizacao) {
        $stmt = $this->conexao->prepare("
            DELETE FROM Organizacao WHERE id_organizacao = ?
        ");
        return $stmt->execute([$id_organizacao]); */
}