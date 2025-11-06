<?php
require_once __DIR__ . '/App/Classes/Conexao.php';
session_start();

$conexao = new Conexao();

if (isset($_SESSION['id_usuario'])) {
    header("Location: painel.php");
    exit;
}
?>

!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Gerenciador de Senhas - Organizacao</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    
  <link rel="stylesheet" href="OrganizacaoPainel.css">
</head>
<body>



</body>
</html>