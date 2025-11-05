<?php
require_once __DIR__ . '/app/classes/Conexao.php';
session_start();

$conexao = new Conexao();

// usuário já logado, vai direto pro painel
if (isset($_SESSION['id_usuario'])) {
    header("Location: painel.php");
    exit;
}

$mensagem = "Bem vindo!";
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Gerenciador de Senhas - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="Telainicial.css">
</head>
<body>

  <div class="logo text-center">🔒 SenhaLock</div>

  <div class="card-login">
      <?php if ($mensagem): ?>
          <div class="alert alert-info text-center"><?= $mensagem ?></div>
      <?php endif; ?>

      <h5 class="mb-3">Cadastrar</h5>

      <form method="post" action="app/gateway.php?acao=cadastrar">
      <div class="mb-3">
              <input type="nome" name="nome" class="form-control" placeholder="Nome" required>
          </div>
          <div class="mb-3">
              <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="mb-3">
              <input type="password" name="senha" class="form-control" placeholder="Senha" required>
          </div>
          <button type="submit" name="entrar" class="btn btn-login">Entrar</button>
      </form>

      <a class="link d-block mt-3" href="cadastrar.php">Cadastrar</a>
  </div>

  <p class="text-center mt-3 text-white small">
      Feito por <b>Gabriela Paludo</b> e <b>Júlia Steffen</b>
  </p>

</body>
</html>