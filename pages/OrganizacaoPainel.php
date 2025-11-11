<?php
require_once '../App/Classes/Conexao.php';
session_start();

$conexao = new Conexao();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Organizações - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../Pages/css/OrganizacaoPainel.css">
</head>

<body>
<form method="post" action="../App/Gateway.php?acao=organizacao"> 

<div class="dashboard">
    <aside class="sidebar">
        <div>
            <div class="logo">🔐 SenhaLock</div>
            <nav class="menu">
                <a href="#" class="active">Menu principal</a>
                <a href="#">Gerador de senhas</a>
                <a href="#">Cofre</a>
                <a href="#">Perfil</a>
                <a href="../App/gateway.php?acao=organizacao">Organizações</a>
                <a href="sair.php" class="logout">Logout</a>
            </nav>
        </div>
    </aside>
    <main class="conteudo">
        <div class="topo">
            <h2>Organizações</h2>
            <br>
            <br>
            <button type="button" class="btn-novo">
                <i class="bi bi-plus"></i>Nova organização
            </button>
        </div>
          <?php
            require_once '../App/Classes/Organizacao.php';
            $org = new Organizacao();

            // Lista organizações que pertencem ao usuário logado
            $organizacoes = $org->listarPorUsuario($_SESSION['id_usuario']);

              if (!empty($organizacoes)) {
                foreach ($organizacoes as $o) {
                    $quantidade = $org->contarSubordinados($o['id_organizacao']); 
                    echo "
                    <div class='card-org'>
                      <div class='info'>
                          <h5>{$o['nome']}</h5>
                          <p>$quantidade membro" . ($quantidade != 1 ? 's' : '') . "</p>
                      </div>
                      <a href='../App/Gateway.php?acao=convite&id_org={$o['id_organizacao']}' class='link-convidar'>
                          <i class='bi bi-person-plus'></i> Convidar
                      </a>
                  </div>";
                }
            } else {
              echo "<div class='alert-info'>Nenhuma organização cadastrada ainda.</div>";
          }
          ?>
    </main>
</div>

</form>
</body>
</html>