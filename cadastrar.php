
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
  <title>Gerenciador de Senhas - Cadastro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h3 class="text-center mb-4">Gerenciador de Senhas</h3>

      <!-- Formulário de Cadastro -->
      <div class="card p-4 shadow-sm">
        <h5 class="mb-3 text-center">Cadastrar</h5>
        <form method="post" action = "app/gateway.php?acao=cadastrar">
          <div class="mb-3">
            <input type="text" name="nome" class="form-control" placeholder="Nome completo" required>
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
          </div>
          <button type="submit" name="cadastrar" class="btn btn-success w-100">Cadastrar</button>
        </form>
      </div>

      <p class="text-center mt-3 text-muted small">
        Feito por <b>Gabriela Paludo</b> e <b>Júlia Steffen</b>
      </p>
    </div>
  </div>
</div>

</body>
</html>