<?php
session_start();
require_once '../App/Classes/Conexao.php';

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: index.php");
//     exit;
// }

$conn = new Conexao();
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Gerador de Senhas - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="../Pages/css/Gerador.css">
</head>

<body>
<div class="d-flex min-vh-100">

    <!-- SIDEBAR -->
    <aside class="sidebar d-flex flex-column p-4 text-white">
        <div class="logo mb-4">🔐 <span class="fw-bold">SenhaLock</span></div>

        <nav class="menu nav flex-column">
            <a href="../Pages/painel.php" class="nav-link">Menu principal</a>
            <a href="../Pages/Gerador.php" class="nav-link active">Gerador de senhas</a>
            <a href="../App/gateway.php?acao=CofrePainel" class="nav-link">Cofre</a>
            <a href="../App/gateway.php?acao=perfil" class="nav-link">Perfil</a>
            <?php if (!$_SESSION['eh_subordinado']) { ?>
                <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <?php } ?>
            <a href="../Pages/sair.php" class="nav-link text-danger mt-auto">Logout</a>
        </nav>
    </aside>

    <!-- CONTEÚDO -->
    <main class="content flex-grow-1 p-5 bg-light d-flex justify-content-between align-items-start">

        <!-- Texto -->
        <div class="texto">
            <h1>Crie <br><strong>Senhas<br>Rapidamente.</strong></h1>
            <p class="text-muted">Gere combinações fortes e aleatórias para proteger suas contas.</p>
        </div>

        <!-- Card Gerador -->
        <div class="gerador-card">
            <h5>Crie uma nova senha</h5>
            <p class="text-muted">Personalize sua nova senha</p>

            <div class="opcoes">
                <label><input type="checkbox" class="check-maiusculas" checked> ABC</label>
                <label><input type="checkbox" class="check-minusculas" checked> abc</label>
                <label><input type="checkbox" class="check-numeros"> 123</label>
                <label><input type="checkbox" class="check-simbolos"> #$</label>
            </div>

            <div class="range-box mt-2">
                <input type="range" class="range-tamanho" min="6" max="20" value="8">
                <span class="valor-tamanho">8</span>
            </div>

            <input type="text" class="campo-senha form-control mb-3" readonly>

            <div class="botoes mt-2 d-flex gap-2">
                <button type="button" class="btn btn-primary btn-copiar">Copiar senha</button>
                <button type="button" class="btn btn-secondary btn-gerar">Atualizar senha</button>
            </div>
        </div>

    </main>
</div>

<script src="../Pages/js/GeradorPainel.js"></script>
</body>
</html>
