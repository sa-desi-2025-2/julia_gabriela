<?php

include 'conexao.php'; // conecta ao banco
session_start();       // inicia a sessão

// Se o usuário já estiver logado, vai direto pro painel
if (isset($_SESSION['id_usuario'])) {
    header("Location: painel.php");
    exit;
}

$mensagem = "Bem vindo!";

// cadastro do usuario
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se já existe e-mail cadastrado
    $sql = "SELECT * FROM Usuario WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $mensagem = "Este e-mail já está cadastrado!";
    } else {
        // Cria o hash da senha e cadastra
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Usuario (nome, email, senha_entrada) VALUES ('$nome', '$email', '$senhaHash')";
        if (mysqli_query($conn, $sql)) {
            $mensagem = "Cadastro realizado com sucesso! Faça login.";
        } else {
            $mensagem = "Erro ao cadastrar: " . mysqli_error($conn);
        }
    }
}

// login de usuario existente
if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Usuario WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $usuario = mysqli_fetch_assoc($res);

        if (password_verify($senha, $usuario['senha_entrada'])) {
            // Login bem-sucedido -  guarda dados na usados
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: painel.php");
            exit;
        } else {
            $mensagem = "Senha incorreta!";
        }
    } else {
        $mensagem = "Usuário não encontrado!";
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Gerenciador de Senhas - Login e Cadastro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h3 class="text-center mb-4">Gerenciador de Senhas</h3>

      <?php if ($mensagem): ?>
        <div class="alert alert-info text-center"><?= $mensagem ?></div>
      <?php endif; ?>

      <!-- Formulário de Login -->
      <div class="card p-4 mb-3 shadow-sm">
        <h5 class="mb-3 text-center">Entrar</h5>
        <form method="post">
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
          </div>
          <button type="submit" name="entrar" class="btn btn-primary w-100">Entrar</button>
        </form>
      </div>

      <!-- Formulário de Cadastro -->
      <div class="card p-4 shadow-sm">
        <h5 class="mb-3 text-center">Cadastrar</h5>
        <form method="post">
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
        Feito por <b>Maria Silva</b> e <b>Júlia Steffen</b>
      </p>
    </div>
  </div>
</div>

</body>
</html>