<?php
    require_once __DIR__ . '/classes/Conexao.php';

    $acao = $_GET['acao'];
    

    if($acao == 'conexao'){
        $conexao = new Conexao();
    }else if ($acao == 'cadastrar'){

        //$_POST[]
        $usuario = new Usuario();
        $usuario->inserir();
    }
   

    
    


    