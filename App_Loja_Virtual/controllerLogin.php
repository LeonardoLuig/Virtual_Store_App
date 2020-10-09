<?php

    require '../../app_loja_virtual_PRIVATE/conexao.php';
    require '../../app_loja_virtual_PRIVATE/CadastroLogin.php';

    $conexao = new Conexao();
    $cadastro = new Usuario($conexao);
    $cadastro->__set('email', $_POST['email']);
    $cadastro->__set('senha', $_POST['senha']);
    $cadastro->Login();


?>
