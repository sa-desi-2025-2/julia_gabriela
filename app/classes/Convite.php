<?php
require_once __DIR__ . '/Conexao.php';

class Convite
{
    private $conexao;
    private $table = "convites";

    public function __construct() {
        $this->conexao = new Conexao();
    }

    public function enviarConvite($idUsuario)
    {
        $token = bin2hex(random_bytes(16));

        $sqlOrg = "SELECT id_organizacao FROM organizacoes WHERE id_usuario_criador = ?";
        $stmtOrg = $this->conexao->getConexao()->prepare($sqlOrg);
        $stmtOrg->execute([$idUsuario]);
        $org = $stmtOrg->fetch(PDO::FETCH_ASSOC);

        if (!$org) return null;

        $idOrganizacao = $org['id_organizacao'];

        $sql = "INSERT INTO convites (token, id_usuario, id_organizacao, status, data_envio)
                VALUES (?, ?, ?, 'PENDENTE', NOW())";

        $stmt = $this->conexao->getConexao()->prepare($sql);
        $stmt->execute([$token, $idUsuario, $idOrganizacao]);

        return "https://seusite.com/convite.php?token=" . $token;
    }
}
?>