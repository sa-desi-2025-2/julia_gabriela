<?php
    require_once __DIR__ . '/classes/Conexao.php';
    require_once __DIR__ . '/classes/Usuario.php';

    $acao = $_GET['acao'];
    

    if($acao == 'conexao'){
        $conexao = new Conexao();
        
    }else if ($acao == 'cadastrar'){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            
            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $usuario = new Usuario();
                $usuario->setNome($nome);
                $usuario->setEmail($email);
                $usuario->setSenha($senha);
            }
            if ($usuario->inserir()) {
                header("Location: ../index.php");
                echo "caiu";
        }
    }
}
    if($acao == 'login'){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            
            $usuario = new Usuario();

            if (!empty($email) && !empty($senha)) {
                $usuario->setEmail($email);
                $usuario->setSenha($senha);
            }
            if ($usuario->login()) {
                header("Location: ../pages/painel.php");
            }else {
                session_start();
                $_SESSION['erro_login'] = "E-mail ou senha incorretos!";
                header("Location: ../index.php");
                exit;
            }
        }
    }
?>