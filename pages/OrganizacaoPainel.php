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
<head href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Organizações - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Pages/css/OrganizacaoPainel.css">
</head>
<body>
<form method="post" action="../App/Gateway.php?acao=organizacao"> 

<div class="dashboard">
    <aside class="sidebar">
        <div class="logo">🔐SenhaLock</div>
        <nav class="menu">
            <a href="#" class="active">Menu principal</a>
            <a href="#">Gerador de senhas</a>
            <a href="#">Cofre</a>
            <a href="#">Perfil</a>
            <a href="../App/gateway.php?acao=organizacao">Organizações</a>
            <a href="sair.php" class="logout">Logout</a>
        </nav>
    </aside>
</div>

  <main class="conteudo">
    <div class="topo">
      <h2>Organizações</h2>
      <button class="btn-novo"><span>+</span> Novo item</button>
    </div>

    <div class="card-org">
      <div class="info">
        <h5></h5>
        <p></p>
      </div>
      <a href="#" class="link-convidar">Convidar</a>
    </div>
  </main>
</form>

</body>
</html>