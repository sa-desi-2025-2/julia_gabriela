<?php
require_once '../App/Classes/Conexao.php';
session_start();

$conexao = new Conexao();

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: index.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Meu Perfil - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Estilo personalizado -->
  <link rel="stylesheet" href="../Pages/css/Perfil.css">
</head>

<body>
<div class="d-flex min-vh-100 flex-column flex-md-row">
  <!-- Sidebar -->
  <aside class="sidebar d-flex flex-column p-4 text-white">
      <div class="logo mb-4">
          🔐 <span class="fw-bold">SenhaLock</span>
      </div>
      <nav class="menu nav flex-column flex-grow-1">
          <a href="#" class="nav-link">Menu principal</a>
          <a href="#" class="nav-link">Gerador de senhas</a>
          <a href="#" class="nav-link">Cofre</a>
          <a href="../App/gateway.php?acao=perfil" class="nav-link active">Perfil</a>
          <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
          <a href="sair.php" class="nav-link text-danger mt-auto">Logout</a>
      </nav>
  </aside>

  <!-- Main -->
  <main class="main flex-grow-1 d-flex flex-column justify-content-center align-items-center p-4 bg-light">
      <div class="perfil-container text-center bg-white shadow-sm p-5 rounded-4" style="max-width: 600px;">
          <div class="mb-3">
              <i class="bi bi-person-circle text-secondary" style="font-size: 4rem;"></i>
          </div>

          <h2 class="fw-bold mb-2 text-dark">Meu Perfil</h2>
          <p class="text-secondary mb-4">Gerencie suas informações pessoais e credenciais de acesso.</p>

          <form method="post" action="../App/gateway.php?acao=visualizarPerfil&subacao=alterar&subacao=excluir" class="text-start">
              <div class="mb-3">
                  <label class="form-label">Email:</label>
                  <input type="email" name="email" class="form-control" value="<?= $_SESSION['email'] ?? 'usuario@app.com'; ?>">
              </div>

              <div class="mb-4">
                  <label class="form-label">Senha:</label>
                  <input type="password" name="senha" class="form-control" placeholder="********">
              </div>

              <h5 class="fw-semibold mb-3">Segurança da Conta</h5>

              <div class="d-flex flex-wrap justify-content-center gap-3">
                  <button type="submit" name="acao" value="alterar" class="btn btn-primary px-4 py-2">
                      <i class="bi bi-save me-1"></i> Alterar Conta
                  </button>
                  <button type="submit" name="acao" value="excluir" class="btn btn-secondary px-4 py-2">
                      <i class="bi bi-trash me-1"></i> Excluir Conta
                  </button>
              </div>
          </form>
      </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>