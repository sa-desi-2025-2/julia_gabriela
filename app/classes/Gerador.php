<?php
require_once __DIR__ . '/Conexao.php';

class Gerador
{
    private $conn; // conexão PDO
    private $table = "Gerador";

    public $id_gerador;
    public $nome;
    public $modelo;
    public $potencia;
    public $status;
    public $data_cadastro;

    public function __construct() {
        $this->conexao = new Conexao();
        $this->conn = $this->conexao->getConexao(); // garante que $this->conn seja uma instância de PDO
    }

    // Criar novo gerador (status inicial = ATIVO)
    public function criar()
    {
        $query = "INSERT INTO {$this->table} (nome, modelo, potencia, status)
                  VALUES (:nome, :modelo, :potencia, 'ATIVO')";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':potencia', $this->potencia);

        return $stmt->execute();
    }

    // Atualizar dados do gerador
    public function atualizar()
    {
        $query = "UPDATE {$this->table}
                  SET nome = :nome,
                      modelo = :modelo,
                      potencia = :potencia,
                      status = :status
                  WHERE id_gerador = :id_gerador";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':potencia', $this->potencia);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id_gerador', $this->id_gerador);

        return $stmt->execute();
    }

    // Atualizar apenas o status
    public function atualizarStatus($novoStatus)
    {
        $query = "UPDATE {$this->table}
                  SET status = :status
                  WHERE id_gerador = :id_gerador";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $novoStatus);
        $stmt->bindParam(':id_gerador', $this->id_gerador);

        return $stmt->execute();
    }

    // Ativar gerador
    public function ativar()
    {
        return $this->atualizarStatus('ATIVO');
    }

    // Desativar gerador
    public function desativar()
    {
        return $this->atualizarStatus('INATIVO');
    }

    // Buscar por ID
    public function buscarPorId($id_gerador)
    {
        $query = "SELECT * FROM {$this->table} WHERE id_gerador = :id_gerador";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_gerador', $id_gerador);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todos os geradores (opcionalmente por status)
    public function listar($status = null)
    {
        $query = "SELECT * FROM {$this->table}";
        if ($status) {
            $query .= " WHERE status = :status";
        }
        $query .= " ORDER BY data_cadastro DESC";

        $stmt = $this->conn->prepare($query);
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar geradores por modelo
    public function listarPorModelo($modelo)
    {
        $query = "SELECT * FROM {$this->table} WHERE modelo LIKE :modelo ORDER BY data_cadastro DESC";

        $stmt = $this->conn->prepare($query);
        $modelo = "%{$modelo}%";
        $stmt->bindParam(':modelo', $modelo);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar geradores por nome
    public function listarPorNome($nome)
    {
        $query = "SELECT * FROM {$this->table} WHERE nome LIKE :nome ORDER BY data_cadastro DESC";

        $stmt = $this->conn->prepare($query);
        $nome = "%{$nome}%";
        $stmt->bindParam(':nome', $nome);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Excluir gerador
    public function deletar()
    {
        $query = "DELETE FROM {$this->table} WHERE id_gerador = :id_gerador";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_gerador', $this->id_gerador);
        return $stmt->execute();
    }
}
?>
