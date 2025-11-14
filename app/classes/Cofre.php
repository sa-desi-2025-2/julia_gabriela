<?php
require_once __DIR__ . '/Conexao.php';

class Cofre
{
    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }

    // Retorna todos os cofres que pertencem ao usuário logado.
    public function getCofresDoUsuario($idUsuario)
    {
        $sql = "
            SELECT Cofre.id_cofre, Cofre.nome, Cofre.data_criacao
            FROM Cofre
            INNER JOIN Subordinado ON Subordinado.id_subordinado = Cofre.id_subordinado
            WHERE Subordinado.id_usuario = :id_usuario
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_usuario' => $idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retorna apenas um cofre específico.
    public function getCofre($idCofre)
    {
        $sql = "SELECT * FROM Cofre WHERE id_cofre = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $idCofre]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    //  Cria um novo cofre para o subordinado.
    public function criarCofre($nome, $idSubordinado)
    {
        $sql = "INSERT INTO Cofre (nome, id_subordinado) VALUES (:nome, :sub)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nome' => $nome,
            'sub'  => $idSubordinado
        ]);
    }

    
    //  Renomeia um cofre.
     
    public function renomearCofre($idCofre, $novoNome)
    {
        $sql = "UPDATE Cofre SET nome = :nome WHERE id_cofre = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'nome' => $novoNome,
            'id'   => $idCofre
        ]);
    }

    //  Deleta um cofre 'apagar pastas antes'.
    public function deletarCofre($idCofre)
    {
        // Pasta e Senha dependem deste cofre
        $sql = "DELETE FROM Cofre WHERE id_cofre = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute(['id' => $idCofre]);
    }

    // Busca pastas dentro de um cofre.
    public function getPastasDoCofre($idCofre)
    {
        $sql = "
            SELECT Pasta.id_pasta, Pasta.nome, Pasta.data_criacao
            FROM Pasta
            WHERE Pasta.id_cofre = :id_cofre
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_cofre' => $idCofre]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>