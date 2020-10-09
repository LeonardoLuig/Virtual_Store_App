<?php

    require '../../app_loja_virtual_PRIVATE/conexao.php';
    require '../../app_loja_virtual_PRIVATE/AdicionarProduto.php';
    
    $conexao = new Conexao();
    $ex = new Adicionar($conexao);
    $exibir = $ex->exibir();


?>