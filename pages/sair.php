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

    <link rel="stylesheet" href="../Pages/css/sair.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">🔐 <span>SenhaLock</span></div>
        <nav class="menu">
            <a href="#" class="active">Menu principal</a>
            <a href="#">Gerador de senhas</a>
            <a href="#">Cofre</a>
            <a href="#">Perfil</a>
            <a href="../App/gateway.php?acao=organizacao">Organizações</a>
            <a href="sair.php" class="logout">Logout</a>
        </nav>
    </div>

    <div class="main">
        <h2>Logout</h2>
        <p>Tem certeza que deseja sair?</p>
        <div class="buttons">
            <form method="post" action="">
                <button type="submit" name="acao" value="sim" class="btn">Sair</button>
                <button type="submit" name="acao" value="nao" class="btn cancelar">Cancelar</button>
            </form>
        </div>
    </div>
</body>
</html>
