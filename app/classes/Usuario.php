<?php
require_once __DIR__ . '/Conexao.php';

class Usuario {
    private $id;
    private $conexao;
    private $nome;
    private $email;
    private $senha;

    public function __construct() {
       $this->conexao = new Conexao();
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }


    // Cadastrar novo usuário
    public function inserir() {
        try {
            $hash = password_hash($this->senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Usuario (nome, email, senha_entrada) VALUES (?, ?, ?)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute([$this->nome, $this->email, $hash]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Listar todos os usuários
    public function listar() {
        $sql = "SELECT id_usuario, nome, email, data_cadastro FROM Usuario";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por ID
    public function buscar() {
        $sql = "SELECT * FROM Usuario WHERE id_usuario = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar informações do usuário
    public function atualizar() {
        try {
            $sql = "UPDATE Usuario SET nome = ?, email = ? WHERE id_usuario = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute([$this->nome, $this->email, $this->id]);
            return "Usuário atualizado!";
        } catch (PDOException $e) {
            return "Erro ao atualizar: " . $e->getMessage();
        }
    }

    // Excluir usuário
    public function excluir() {
        try {
            $sql = "DELETE FROM Usuario WHERE id_usuario = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->execute([$this->id]);
            return "Usuário excluído!";
        } catch (PDOException $e) {
            return "Erro ao excluir: " . $e->getMessage();
        }
    }

    // Buscar usuário por e-mail (para login)
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fazer login
    public function login() {
        $usuario = $this->buscarPorEmail($this->email);
        if ($usuario && password_verify($this->senha, $usuario['senha_entrada'])) {
            session_start();
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            return true;
        } else {
            return false;
        }
    }
}
?>