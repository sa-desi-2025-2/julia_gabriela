<?php
session_start();
require_once '../App/Classes/Conexao.php';

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: index.php");
//     exit;
// }

$conn = new Conexao();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>SenhaLock</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../pages/css/Cofre.css">
</head>
<body>

<div class="d-flex min-vh-100"> 

    <aside class="sidebar d-flex flex-column p-4 text-white">
        <div class="logo mb-4">🔐 <span class="fw-bold">SenhaLock</span></div>

        <nav class="menu nav flex-column">
            <a href="../Pages/painel.php" class="nav-link active">Menu principal</a>
            <a href="../App/gateway.php?acao=geradorPainel" class="nav-link">Gerador de senhas</a>
            <a href="../App/gateway.php?acao=CofrePainel" class="nav-link">Cofre</a>
            <a href="../App/gateway.php?acao=perfil" class="nav-link">Perfil</a>
            <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <a href="sair.php" class="nav-link text-danger mt-auto">Logout</a>
        </nav>
    </aside>

    <div class="content">
        <h2>Todos os Cofres</h2>
        <p>Você está conectado como <?= $_SESSION['email']; ?></p>

        <div class="card">
            <h3>Meus Cofres</h3>
            <button type="button" class="btn btn-primary btn-novo">
                <i class="bi bi-plus-lg"></i> Novo Cofre
            </button>
        </div>
    </div>

</div> 

</body>
</html>