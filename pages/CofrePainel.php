<?php
require_once '../App/Classes/Conexao.php';
session_start();

$conexao = new Conexao();
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Cofres - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="../Pages/css/Cofre.css">
</head>

<body>

<div class="d-flex min-vh-100">

    <aside class="sidebar d-flex flex-column">
        <div class="logo mb-4">🔐 <span class="fw-bold">SenhaLock</span></div>
        
        <nav class="menu nav flex-column">
            <a href="../Pages/painel.php" class="nav-link">Menu principal</a>
            <a href="../App/gateway.php?acao=geradorPainel" class="nav-link">Gerador de senhas</a>
            <a href="../App/gateway.php?acao=CofrePainel" class="nav-link active">Cofre</a>
            <a href="../App/gateway.php?acao=perfil" class="nav-link">Perfil</a>
            <a href="../App/gateway.php?acao=organizacao" class="nav-link">Organizações</a>
            <a href="sair.php" class="nav-link text-danger mt-auto">Logout</a>
        </nav>
    </aside>

    <main class="conteudo flex-grow-1 p-5">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h2 class="fw-semibold text-dark mb-0">Meus Cofres</h2>

            <button type="button" class="btn btn-primary btn-novo" data-bs-toggle="modal" data-bs-target="#modalNovoCofre">
                <i class="bi bi-plus-lg"></i> Novo Cofre
            </button>
        </div>

        <div class="card card-org shadow-sm border-0">
            <div class="card-body d-flex align-items-center justify-content-between">

                <div class="info">
                    <h5 class="mb-1">Nome do Cofre</h5>
                    <p class="mb-0 text-muted">Descrição ou informações adicionais</p>
                </div>

                <a href="#" class="link-convidar">Abrir</a>
            </div>
        </div>

        <div class="modal fade" id="modalNovoCofre" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title">Novo Cofre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <form method="post" action="../App/gateway.php?acao=novoCofre">

                <div class="modal-body">

                  <div class="mb-3">
                    <label class="form-label">Nome do Cofre</label>
                    <input type="text" class="form-control" name="nome_cofre" placeholder="Ex: Cofre de Logins" required>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Criar</button>
                </div>

              </form>

            </div>
          </div>
        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>