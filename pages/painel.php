<?php
session_start();
require_once '../App/Classes/Conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Painel.css">
</head>
<body>

<div class="dashboard">
    <aside class="sidebar">
        <div class="logo">🔐SenhaLock</div>
        <nav class="menu">
            <a href="#" class="active">Menu principal</a>
            <a href="#">Gerador de senhas</a>
            <a href="#">Cofre</a>
            <a href="#">Perfil</a>
            <a href="app/gateway.php?acao=organização">>Organizações</a>
            <a href="sair.php" class="logout">Logout</a>
        </nav>
    </aside>

    <main class="content">
        <h2>Bem-vinda, <?= htmlspecialchars($_SESSION['nome']) ?></h2>
        <p class="text-muted">Você está conectada como <?= htmlspecialchars($_SESSION['email']) ?></p>
        <a href="#" class="editar-perfil">Editar perfil</a>

        <div class="cards">
            <div class="card-box">
                <h5>Resumo do cofre</h5>
                <p><?= $total_senhas ?> senhas salvas</p>
                <p><?= $total_pastas ?> pastas criadas</p>
            </div>

            <div class="card-box">
                <h5>Dicas de segurança</h5>
                <ul>
                    <li>Use senhas com pelo menos 12 caracteres</li>
                    <li>Evite repetir senhas entre sites diferentes</li>
                </ul>
            </div>
        </div>
    </main>
</div>

</body>
</html>