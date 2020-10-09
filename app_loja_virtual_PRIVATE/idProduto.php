<?php
    require 'conexao.php';
    require 'exibiCarrinho.php';
    $conexao = new Conexao();
    $adicionarCarrinho = new ExibiCarrinho($conexao);
    $adicionarCarrinho->__set('id_produto', $_GET['id_produto']);
    return $registro = $adicionarCarrinho->idProduto();

?>