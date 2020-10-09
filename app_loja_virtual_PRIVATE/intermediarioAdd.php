<?php
    require '../../app_loja_virtual_PRIVATE/conexao.php';
    require '../../app_loja_virtual_PRIVATE/AdicionarProduto.php';
    

    $conexao = new Conexao();
    $adicionar = new Adicionar($conexao);
    $adicionar->__set('img', $_POST['img']);
    $adicionar->__set('nome', $_POST['nome']);
    $adicionar->__set('preco', $_POST['preco']);
    $adicionar->adicionar();


?>