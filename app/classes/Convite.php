<?php
class Convite
{
    private $conn; // conexão PDO
    private $table = "Convite";

    public $id_convite;
    public $email_convidado;
    public $id_organizacao;
    public $status;
    public $data_envio;

    public function __construct() {
        $this->conexao = new Conexao();
     }

    // Criar novo convite (status inicial = PENDENTE)
    public function criar()
    {
        $query = "INSERT INTO {$this->table} (email_convidado, id_organizacao, status)
                  VALUES (:email_convidado, :id_organizacao, 'PENDENTE')";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email_convidado', $this->email_convidado);
        $stmt->bindParam(':id_organizacao', $this->id_organizacao);

        return $stmt->execute();
    }

    // Atualizar status 
    public function atualizarStatus($novoStatus)
    {
        $query = "UPDATE {$this->table}
                  SET status = :status
                  WHERE id_convite = :id_convite";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $novoStatus);
        $stmt->bindParam(':id_convite', $this->id_convite);

        return $stmt->execute();
    }

    // Aceitar convite
    public function aceitar()
    {
        return $this->atualizarStatus('ACEITO');
    }

    // Recusar convite
    public function recusar()
    {
        return $this->atualizarStatus('RECUSADO');
    }

    // Reverter para pendente
    public function pendente()
    {
        return $this->atualizarStatus('PENDENTE');
    }

    // Buscar por ID
    public function buscarPorId($id_convite)
    {
        $query = "SELECT * FROM {$this->table} WHERE id_convite = :id_convite";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_convite', $id_convite);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todos os convites (opcionalmente por status)
    public function listar($status = null)
    {
        $query = "SELECT * FROM {$this->table}";
        if ($status) {
            $query .= " WHERE status = :status";
        }
        $query .= " ORDER BY data_envio DESC";

        $stmt = $this->conn->prepare($query);
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar convites de uma organização
    public function listarPorOrganizacao($id_organizacao, $status = null)
    {
        $query = "SELECT * FROM {$this->table} WHERE id_organizacao = :id_organizacao";
        if ($status) {
            $query .= " AND status = :status";
        }
        $query .= " ORDER BY data_envio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_organizacao', $id_organizacao);
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar convites de um e-mail específico
    public function listarPorEmail($email_convidado, $status = null)
    {
        $query = "SELECT * FROM {$this->table} WHERE email_convidado = :email_convidado";
        if ($status) {
            $query .= " AND status = :status";
        }
        $query .= " ORDER BY data_envio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email_convidado', $email_convidado);
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Excluir convite
    public function deletar()
    {
        $query = "DELETE FROM {$this->table} WHERE id_convite = :id_convite";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_convite', $this->id_convite);
        return $stmt->execute();
    }
}
?>