<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Painel - Gerenciador de Senhas</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Painel do Gerenciador</span>
    <a href="sair.php" class="btn btn-light btn-sm">Sair</a>
  </div>
</nav>

<div class="container py-5">
  <h3>Bem-vinda, <?= $_SESSION['nome'] ?> </h3>
  <p class="text-muted"> Aqui você poderá gerenciar suas senhas e cofres.</p>

  <div class="alert alert-info">
    Em breve: lista de organizações, cofres e senhas.
  </div>
</div>

</body>
</html>