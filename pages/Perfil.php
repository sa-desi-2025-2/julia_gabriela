<?php
require_once '../App/Classes/Conexao.php';
session_start();

$conexao = new Conexao();

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: index.php");
//     exit;
// }

?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Meu Perfil - SenhaLock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../Pages/css/Perfil.css">
</head>

<body>
<div class="dashboard">
  <aside class="sidebar">
    <div class="logo">
      <span class="icone">🔒</span>
      <span class="titulo">SenhaLock</span>
    </div>
    <nav class="menu">
      <a href="#">Menu principal</a>
      <a href="#">Gerador de senhas</a>
      <a href="#">Cofre</a>
      <a href="../App/gateway.php?acao=perfil" class="active">Perfil</a>
      <a href="../App/gateway.php?acao=organizacao">Organizações</a>
      <a href="sair.php" class="logout">Logout</a>
    </nav>
  </aside>
  
  <main class="conteudo">
    <div class="perfil-container">
      <h2>MEU PERFIL</h2>
      <p class="descricao">Gerencie suas informações pessoais e credencial de acesso.</p>

      <div class="perfil-card">
        <div class="imagem-perfil">
          <i class="bi bi-person-circle"></i>
        </div>

        <form method="post" action="../App/gateway.php?acao=visualizarPerfil&subacao=alterar&subacao=excluir">
          <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $_SESSION['email']; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Senha:</label>
            <input type="password" name="senha" class="form-control">
          </div>

          <h5 class="mt-4">SEGURANÇA DA CONTA</h5>

          <div class="botoes">
            <button type="submit" name="acao" value="alterar" class="btn btn-primary">ALTERAR CONTA</button>
            <button type="submit" name="acao" value="excluir" class="btn btn-danger">EXCLUIR CONTA</button>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>
</body>
</html>