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
          <a href="../Pages/painel.php" class="nav-link">Menu principal</a>
          <a href="../App/gateway.php?acao=geradorPainel" class="nav-link">Gerador de senhas</a>
          <a href="../App/gateway.php?acao=CofrePainel" class="nav-link">Cofre</a>
          <a href="../App/gateway.php?acao=perfil" class="nav-link active">Perfil</a>
          <?php if (!$_SESSION['eh_subordinado']) { ?>
                <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <?php } ?>
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

          <p class="fw-semibold mb-1">Nome:</p>
          <p class="text-dark"><?= $_SESSION['nome'] ?></p>

          <p class="fw-semibold mb-1">Email:</p>
          <p class="text-dark"><?= $_SESSION['email'] ?></p>

          <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
              <a href="#modalAlterar" class="btn btn-primary px-4 py-2">
                  <i class="bi bi-save me-1"></i> Alterar Conta
              </a>

              <a href="#modalExcluir" class="btn btn-secondary px-4 py-2">
                  <i class="bi bi-trash me-1"></i> Excluir Conta
              </a>
          </div>

      </div>
  </main>
</div>

<!-- ==========================
        MODAL ALTERAR
=========================== -->
<div id="modalAlterar" class="modal">
  <div class="modal-content">
      <h3 class="mb-4">Alterar Informações</h3>

      <form method="post" action="../App/gateway.php?acao=visualizarPerfil">
          <input type="hidden" name="acao" value="alterar">

          <label class="form-label fw-semibold">Nome:</label>
          <input type="text" name="nome" class="form-control mb-3" value="<?= $nome ?>">

          <label class="form-label fw-semibold">Email:</label>
          <input type="email" name="email" class="form-control mb-3" value="<?= $email ?>">

          <label class="form-label fw-semibold">Nova Senha:</label>
          <input type="password" name="senha" class="form-control mb-4" placeholder="Digite apenas se quiser trocar">

          <div class="d-flex justify-content-between">
              <a href="#" class="btn btn-outline-secondary px-4">Cancelar</a>
              <button type="submit" class="btn btn-primary px-4">Salvar</button>
          </div>
      </form>
  </div>
</div>

<!-- ==========================
        MODAL EXCLUIR
=========================== -->
<div id="modalExcluir" class="modal">
  <div class="modal-content">
      <h3 class="mb-3 text-danger">Excluir Conta</h3>

      <p class="mb-4 text-center">
          Tem certeza que deseja excluir sua conta?<br>
          <b>Essa ação é permanente.</b>
      </p>

      <form method="post" action="../App/gateway.php?acao=visualizarPerfil">
          <input type="hidden" name="acao" value="excluir">

          <div class="d-flex justify-content-between">
              <a href="#" class="btn btn-outline-secondary px-4">Cancelar</a>
              <button type="submit" class="btn btn-danger px-4">Excluir</button>
          </div>
      </form>
  </div>
</div>

</body>
</html>