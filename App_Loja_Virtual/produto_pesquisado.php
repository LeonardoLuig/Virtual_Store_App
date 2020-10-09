<?php

    session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body id="produto">
    <!--Área de navegação-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 1px solid whitesmoke;">
        <a class="navbar-brand" href="index.php">App <span style='border: 1px solid #339933; color: green;padding:4px;border-radius: 10px 10px 10px;'>Loja Virtual</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link text-info" id="p-home" href="index.php"> Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" id="p-produto" href="produto.php">
                        Produtos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" id="p-contato" href="contato.php">
                        Contato
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" id="p-sobre" href="sobre.php">
                        Sobre Nós
                    </a>
                </li>
                <?
                    if(isset($_SESSION['logado']) AND $_SESSION['logado'] == 'SIM'){
                ?>
                <li class="nav-item">
                        <a class="nav-link text-danger" href="sessionDestroy.php">
                            Sair
                        </a>
                </li>
                    <? }else{ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Entrar/Cadastrar
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="login.php" id="p-user">Entrar  <i class="fas fa-sign-in-alt mt-1 mr-2 float-right"></i></a>
                        <a class="dropdown-item" href="cadastro.php" id="p-user">Cadastrar  <i class="fas fa-user-plus mt-1 ml-3 float-right"></i></a>
                    </div>
                </li>
                    <? } ?>
                <li class="nav-item">
                    <a class="nav-link text-info" href="carrinho.php">
                        Carrinho
                        <i class="fas fa-shopping-cart text-dark"></i>
                    </a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="produto_pesquisado.php" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Ex: Samsung J7 Prime" name="pesquisar" aria-label="Pesquisar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    
    <!--Conteúdo-->
        
    <div class="text-success w-50 m-auto text-center" style="font-size: 40px;">Resultado da Pesquisa</div>
    
    <hr>
    <div class="row m-auto conteudo">
    <? 
         require 'pesquisa.php';

         $conexao = new Conexao();
         $pesquisa = new Pesquisa($conexao);
         $pesquisa->__set('pesquisar', $_POST['pesquisar']);
         $rows = $pesquisa->numRows();
         if($_POST['pesquisar'] != '' AND $rows > 0){
         $registro = $pesquisa->pesquisar();
         //header('Location:produto_pesquisado.php');
        foreach($registro AS $registros){
            if(isset($registro)){
            echo '<div class="col-3 bloco_anuncio">
                <div class="col-md-12 m-auto">
                    <p style="width: 100%;" class="w-100">'.$registros['nome'].'</p>
                    <img class="img-fluid" src="imagens/'.$registros['img'].'" class="text-r-center" width="250">
                    <p style="width: 100%;" class="w-100">R$'.$registros['preco'].' reais</p>
                    <a href="pagar.php?id_produto='. $registros['id_produto'] .'"><button class="btn btn-outline-success">Comprar</button></a>
                    
                    <form action="addCarrinho.php" method="POST">
                    <input name="id_produto" type="hidden" value="'. $registros['id_produto'] .'">
                    <button class="btn btn-outline-info">Carrinho</button>
                    </form>
                </div>
    </div>';
    }else{
        header('Location: produto.php?exist=false');
    }
}
}else{
    header('Location: produto.php?result=null');
}
    ?>
    </div> 
    
    <div class="texto-rodape p-4" style="border-top: 1px solid gray;">
             Desenvolvido Por Leonardo luig 
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>