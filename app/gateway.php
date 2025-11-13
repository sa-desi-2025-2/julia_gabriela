<?php
    require_once __DIR__ . '/Classes/Conexao.php';
    require_once __DIR__ . '/Classes/Usuario.php';
    require_once __DIR__ . '/Classes/Organizacao.php';
    require_once __DIR__ . '/Classes/Convite.php';
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
            header("Location: ../Pages/OrganizacaoPainel.php");
            exit;
    }

    if ($acao == 'convite') {
        require_once __DIR__ . '/Classes/Convite.php';
        $convite = new Convite();
        $convite->enviarConvite($_SESSION['id_usuario']);
    }
    

    // if ($acao == 'subordinado') {
    //     $sub = new Subordinado();
    
    //     // cadastra subordinado
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_organizacao'], $_POST['id_usuario'])) {
    //         $id_organizacao = (int)$_POST['id_organizacao'];
    //         $id_usuario = (int)$_POST['id_usuario'];
    
    //         if ($sub->cadastrar($id_usuario, $id_organizacao)) {
    //             $_SESSION['msg_sucesso'] = "Subordinado adicionado com sucesso!";
    //         } else {
    //             $_SESSION['msg_erro'] = "Erro ao adicionar subordinado.";
    //         }
    
    //         header("Location: ../Pages/OrganizacaoPainel.php");
    //         exit;
    //     }
    // }

    if (!isset($_SESSION['id_usuario'])) {
        header("Location: ../Pages/login.php");
        exit;
    }
    
    $acao = $_GET['acao'] ?? null;
    $usuario = new Usuario();
    $id = $_SESSION['id_usuario'];
    
    if ($acao === 'atualizarPerfil' || isset($_POST['acao'])) {
        $subacao = $_POST['acao'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    
        if ($subacao === 'alterar') {
            $usuario->atualizar($id, $nome, $email, $senha ?: null);
            header("Location: ../Pages/Perfil.php?msg=alterado");
            exit;
        } elseif ($subacao === 'excluir') {
            $usuario->excluir($id);
            session_destroy();
            header("Location: ../index.php?msg=conta_excluida");
            exit;
        }
    }
?>