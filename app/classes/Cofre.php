<?php
require_once __DIR__ . '/Conexao.php';

class Cofre {

    private $id;
    private $nome;
    private $idSubordinado;
    private $dataCriacao;

    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    public function getIdSubordinado() { return $this->idSubordinado; }
    public function setIdSubordinado($idSubordinado) { $this->idSubordinado = $idSubordinado; }

    public function getDataCriacao() { return $this->dataCriacao; }
    public function setDataCriacao($dataCriacao) { $this->dataCriacao = $dataCriacao; }

    // Criar cofre
    public function inserir() {
        try {
            $sql = "INSERT INTO Cofre (nome, id_subordinado) VALUES (?, ?)";
            $stmt = $this->conexao->prepare($sql);
            return $stmt->execute([$this->nome, $this->idSubordinado]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Buscar cofre por ID
    public function buscar() {
        $sql = "SELECT * FROM Cofre WHERE id_cofre = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar nome do cofre
    public function atualizar() {
        try {
            $sql = "UPDATE Cofre SET nome = ? WHERE id_cofre = ?";
            $stmt = $this->conexao->prepare($sql);
            return $stmt->execute([$this->nome, $this->id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Excluir cofre
    public function excluir() {
        try {
            $sql = "DELETE FROM Cofre WHERE id_cofre = ?";
            $stmt = $this->conexao->prepare($sql);
            return $stmt->execute([$this->id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Lista todos os cofres do usuário logado
    public function listarPorUsuario($idUsuario) {
        $sql = "
            SELECT Cofre.id_cofre, Cofre.nome, Cofre.data_criacao
            FROM Cofre
            INNER JOIN Subordinado ON Subordinado.id_subordinado = Cofre.id_subordinado
            WHERE Subordinado.id_usuario = ?
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar pastas dentro do cofre
    public function listarPastas() {
        $sql = "
            SELECT id_pasta, nome, data_criacao
            FROM Pasta
            WHERE id_cofre = ?
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>