<?php

    require 'conexao.php';
    require 'creditos.php';
    require 'exibiCarrinho.php';

    $conexao = new Conexao();
    if($adicionarCarrinho = new ExibiCarrinho($conexao)){
        $registros = $adicionarCarrinho->exibiCarrinho();
    }
    if($exibirCreditos = new Creditos($conexao)){
        $register = $exibirCreditos->exibirCreditos();
    }    
    
    
    

?>