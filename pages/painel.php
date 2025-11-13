<?php
session_start();
require_once '../App/Classes/Conexao.php';

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: index.php");
//     exit;
// }

$conn = new Conexao();

// Quantas senhas
$stmt = $conn->prepare("
    SELECT COUNT(s.id_senha) AS total_senhas
    FROM Senha s
    INNER JOIN Pasta p ON s.id_pasta = p.id_pasta
    INNER JOIN Cofre c ON p.id_cofre = c.id_cofre
    INNER JOIN Subordinado sub ON c.id_subordinado = sub.id_subordinado
    WHERE sub.id_usuario = ?
");
$stmt->execute([$_SESSION['id_usuario']]);
$total_senhas = $stmt->fetch()['total_senhas'] ?? 0;

// Quantas pastas 
$stmt = $conn->prepare("
    SELECT COUNT(p.id_pasta) AS total_pastas
    FROM Pasta p
    INNER JOIN Cofre c ON p.id_cofre = c.id_cofre
    INNER JOIN Subordinado sub ON c.id_subordinado = sub.id_subordinado
    WHERE sub.id_usuario = ?
");
$stmt->execute([$_SESSION['id_usuario']]);
$total_pastas = $stmt->fetch()['total_pastas'] ?? 0;

// Quantos cofres
$stmt = $conn->prepare("
    SELECT COUNT(c.id_cofre) AS total_cofres
    FROM Cofre c
    INNER JOIN Subordinado sub ON c.id_subordinado = sub.id_subordinado
    WHERE sub.id_usuario = ?
");
$stmt->execute([$_SESSION['id_usuario']]);
$total_cofres = $stmt->fetch()['total_cofres'] ?? 0;
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Painel - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Estilo personalizado -->
  <link rel="stylesheet" href="../Pages/css/Painel.css">
</head>
<body>

<div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4 text-white">
        <div class="logo mb-4">
            🔐 <span class="fw-bold">SenhaLock</span>
        </div>
        <nav class="menu nav flex-column">
            <a href="#" class="nav-link active">Menu principal</a>
            <a href="#" class="nav-link">Gerador de senhas</a>
            <a href="#" class="nav-link">Cofre</a>
            <a href="../App/gateway.php?acao=perfil" class="nav-link">Perfil</a>
            <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <a href="sair.php" class="nav-link text-danger mt-auto">Logout</a>
        </nav>
    </aside>

    <!-- Conteúdo -->
    <main class="content flex-grow-1 p-5 bg-light overflow-auto">
        <h2 class="fw-semibold mb-2">Bem-vinda, <?= htmlspecialchars($_SESSION['nome']) ?></h2>
        <p class="text-muted mb-1">Você está conectada como <?= htmlspecialchars($_SESSION['email']) ?></p>
        </a>

        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Resumo do Cofre</h5>
                        <p class="card-text mb-1"><i class="bi bi-key me-1 text-primary"></i><?= $total_senhas ?> senhas salvas</p>
                        <p class="card-text"><i class="bi bi-folder me-1 text-primary"></i><?= $total_pastas ?> pastas criadas</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Dicas de segurança</h5>
                        <ul class="mb-0 ps-3">
                            <li>Use senhas com pelo menos 12 caracteres</li>
                            <li>Evite repetir senhas entre sites diferentes</li>
                            <li>Altere suas senhas periodicamente</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
