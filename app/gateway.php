<?php
    require_once __DIR__ . '/Classes/Conexao.php';
    require_once __DIR__ . '/Classes/Usuario.php';
    require_once __DIR__ . '/Classes/Organizacao.php';
    require_once __DIR__ . '/Classes/Subordinado.php';

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
                    header("Location: ../Index.php");

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
                header("Location: ../Index.php");
                exit;
            }
        }
    }

    if ($acao == 'organizacao') {
        $org = new Organizacao();
    
        // cadastrar organização
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome_organizacao'])) {
            $nome = trim($_POST['nome_organizacao']);
            $id_usuario = $_SESSION['id_usuario'];
    
            if (!empty($nome)) {
                if ($org->cadastrar($nome, $id_usuario)) {
                    $_SESSION['msg_sucesso'] = "Organização <strong>$nome</strong> Criada com sucesso!";
                } else {
                    $_SESSION['msg_erro'] = "Erro ao criar a organização.";
                }
            } else {
                $_SESSION['msg_erro'] = "O nome da organização não pode estar vazio.";
            }
    
            header("Location: ../Pages/Painel.php");
            exit;
        }
    }

    if ($acao == 'subordinado') {
        $sub = new Subordinado();
    
        // cadastra subordinado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_organizacao'], $_POST['id_usuario'])) {
            $id_organizacao = (int)$_POST['id_organizacao'];
            $id_usuario = (int)$_POST['id_usuario'];
    
            if ($sub->cadastrar($id_usuario, $id_organizacao)) {
                $_SESSION['msg_sucesso'] = "Subordinado adicionado com sucesso!";
            } else {
                $_SESSION['msg_erro'] = "Erro ao adicionar subordinado.";
            }
    
            header("Location: ../Pages/OrganizacaoPainel.php");
            exit;
        }
    }
?>