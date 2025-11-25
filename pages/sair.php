<?php
session_start();

$loginPage = '../index.php';        
$painelPage = '../Pages/painel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'sim') {
        session_unset();
        session_destroy();
        header('Location: ' . $loginPage);
        exit;
    } else {
        header('Location: ' . $painelPage);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - SenhaLock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Estilo personalizado -->
    <link rel="stylesheet" href="../Pages/css/sair.css">
</head>
<body>

<div class="d-flex min-vh-100 flex-column flex-md-row">
    <aside class="sidebar d-flex flex-column p-4 text-white">
        <div class="logo mb-4">
            🔐 <span class="fw-bold">SenhaLock</span>
        </div>
        <nav class="menu nav flex-column flex-grow-1">
            <a href="../Pages/painel.php" class="nav-link active">Menu principal</a>
            <a href="../App/gateway.php?acao=geradorPainel" class="nav-link">Gerador de senhas</a>
            <a href="../App/gateway.php?acao=CofrePainel" class="nav-link">Cofre</a>
            <a href="../App/gateway.php?acao=perfil" class="nav-link">Perfil</a>
            <?php if (!$_SESSION['eh_subordinado']) { ?>
                <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <?php } ?>
            <a href="sair.php" class="nav-link text-danger mt-auto">Logout</a>
        </nav>
    </aside>
    
    <main class="main flex-grow-1 d-flex flex-column justify-content-center align-items-center p-4 bg-light">
        <div class="text-center">
            <h2 class="fw-bold mb-3 text-dark">Logout</h2>
            <p class="text-secondary mb-4">Tem certeza que deseja sair?</p>

            <form method="post" action="" class="d-flex flex-wrap justify-content-center gap-3">
                <button type="submit" name="acao" value="sim" class="btn btn-primary px-4 py-2">
                    <i class="bi bi-box-arrow-right me-1"></i> Sair
                </button>
                <button type="submit" name="acao" value="nao" class="btn btn-secondary px-4 py-2">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </button>
            </form>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>