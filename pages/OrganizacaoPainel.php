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

<div class="d-flex min-vh-100">
    <aside class="sidebar d-flex flex-column p-4 text-white">
        <div class="logo mb-4">🔐 <span class="fw-bold">SenhaLock</span></div>
        <nav class="menu nav flex-column">
            <a href="#" class="nav-link active">Menu principal</a>
            <a href="#" class="nav-link">Gerador de senhas</a>
            <a href="#" class="nav-link">Cofre</a>
            <a href="../App/gateway.php?acao=atualizarPerfil" class="nav-link">Perfil</a>
            <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <a href="sair.php" class="nav-link text-danger mt-auto">Logout</a>
        </nav>
    </aside>

    <main class="conteudo flex-grow-1 p-5 bg-light">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="fw-semibold text-dark mb-0">Organizações</h2>
            <button type="button" class="btn btn-primary btn-novo">
                <i class="bi bi-plus-lg"></i> Novo item
            </button>
        </div>

        <div class="card card-org shadow-sm border-0">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="info">
                    <h5 class="mb-1">Nome da Organização</h5>
                    <p class="mb-0 text-muted">Descrição ou informações adicionais</p>
                </div>
                <a href="#" class="link-convidar">Convidar</a>
            </div>
        </div>
    </main>
</div>

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
