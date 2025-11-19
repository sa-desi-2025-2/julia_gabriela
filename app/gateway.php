<?php
    require_once __DIR__ . '/Classes/Conexao.php';
    require_once __DIR__ . '/Classes/Usuario.php';
    require_once __DIR__ . '/Classes/Organizacao.php';
    require_once __DIR__ . '/Classes/Convite.php';
    require_once __DIR__ . '/Classes/Subordinado.php';
    require_once __DIR__ . '/Classes/Cofre.php';

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
                session_start();
                $_SESSION['email'] = $usuario->getEmail();

                header("Location: ../pages/painel.php");
            }else {
                session_start();
                $_SESSION['erro_login'] = "E-mail ou senha incorretos!";
                header("Location: ../Index.php");
                exit;
            }
        }
    }

    if ($acao == 'geradorPainel') { 
        header("Location: ../Pages/GeradorPainel.php");
        exit;
    }

    if ($acao === 'gerarSenha') {
        $tamanho = $_GET['tamanho'] ?? 8;
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+';
        $senha = substr(str_shuffle(str_repeat($caracteres, $tamanho)), 0, $tamanho);
        echo json_encode(['senha' => $senha]);
        exit;
      }

      if ($acao == 'CofrePainel') { 
        header("Location: ../Pages/CofrePainel.php");
        exit;
    }

    if ($acao === 'novoCofre') {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_cofre']);
            session_start();
            $id_usuario = $_SESSION['id_usuario'];
            if (empty($nome)) {
                header("Location: ../Pages/CofrePainel.php?erro=nomeVazio");
                exit;
            }
    
            $cofre = new Cofre();
            $cofre->setNome($nome);
            echo $nome . ' - ';
            $cofre->setIdSubordinado($id_usuario);
            echo $id_usuario;
            die();
            if ($cofre->inserir()) {
                header("Location: ../Pages/CofrePainel.php?sucesso=1");
            } else {
                header("Location: ../Pages/CofrePainel.php?erro=1");
            }
    
            exit;
        }
    }
    

    if ($acao == 'perfil') { 
        header("Location: ../Pages/Perfil.php");
        exit;
    }

if ($acao === 'visualizarPerfil' || isset($_POST['acao'])) {
    $usuario = new Usuario();
    $subacao = $_POST['acao'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $id = $_SESSION['id_usuario'] ?? null;

    if ($subacao === 'alterar' && $id) {
        $usuario->atualizar($id, $nome, $email, $senha ?: null);
        header("Location: ../Pages/Perfil.php?msg=alterado");
        exit;
    } else if ($subacao === 'excluir' && $id) {
        $usuario->excluir($id);
        session_destroy();
        header("Location: ../index.php?msg=conta_excluida");
        exit;
    }
    }   

    if ($acao == 'organizacao') { 
            header("Location: ../Pages/OrganizacaoPainel.php");
            exit;
    }

$acao = $_GET['acao'] ?? '';

if ($acao === 'novaOrganizacao') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // if (!isset($_SESSION['id_usuario'])) {
        //     header("Location: ../index.php");
        //     exit;
        // }
        $nome = trim($_POST['nome_organizacao']);
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        if (empty($nome)) {
            header("Location: ../Pages/organizacaoPainel.php?erro=nomeVazio");
            exit;
        }

        $organizacao = new Organizacao();
        if ($organizacao->cadastrar($nome, $id_usuario)) {
            header("Location: ../Pages/organizacaoPainel.php?sucesso=1");
        } else {
            header("Location: ../Pages/organizacaoPainel.php?erro=1");
        }

        exit;
    }
}

if ($acao == 'convite') {

    require_once __DIR__ . '/Classes/Convite.php';
    $convite = new Convite();

    $link = $convite->enviarConvite($_SESSION['id_usuario']);

    echo $link; // retorna pro JS
    exit;
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

?>