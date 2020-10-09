<?php
    session_start();
    if($_SESSION['id_user']){

    }else{
        header('Location: login.php?acess=denied');
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   </head>

<body id="carrinho">
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
                <li class="nav-item" id="p-carrinho">
                    <a class="nav-link text-info" href="">
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
    <div class="text-success text-center" style="font-size: 40px;">Carrinho</div>

    <? if(isset($_GET['conferir']) AND $_GET['conferir'] == 'email'){ ?>
                    <div class="bg-success w-100 h-5 text-white text-center">
                        Uma mensagem foi enviado em seu email com a senha atual de seu cartão!
                    </div>
                <? }
                if(isset($_GET['buy']) AND $_GET['buy'] == 'true') {?>
                    <div class="bg-success w-100 h-5 text-white text-center">
                        Compra efetuada com sucesso!
                    </div>
                <? } ?>
    <? require 'exibiCarrinho.php';
    if(isset($register['creditos'])){
        echo '<div class="fundo-contato text-center mb-5 p-5">
        <div class="text-dark"> Crédito: R$'.
              $register['creditos'].' reais
            </div>
            </div>';
    }else{
        echo '<div class="fundo-contato text-center mb-5 p-5">
        <div class="text-dark"> Crédito: R$0,00 reais
            </div>
            </div>';
    }
    
        echo '<div class="row">';
        echo '<div style="border-right: 1px solid black;" class="col-6 mb-5 text-center conter" class="navbar navbar-expand-lg navbar-light bg-light">
            <h3 class="text-danger">Pendentes</h3><br><br>';
    

    foreach($registros AS $registro){
        if($registro['id_status'] == 1){
        echo '<div class="mt-2 mb-2 m-auto h-1" class="collapse navbar-collapse" id="conteudoNavbarSuportado" style="border: 1px solid whitesmoke; border-radius: 10px 10px 10px;">
                <ul class="navbar-nav m-auto d-inline">
                    <li style="list-style: none; width: 50%;" class="m-auto nav-item dropdown">
                        <img class=" d-inline" width="50" src="imagens/'. $registro['img'] .'">
                        <a class="nav-link btn ml-5 mr-5 dropdown-toggle text-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ver detalhes
                        </a>
                        <div class="dropdown-menu pt-4 pl-3 pr-3" aria-labelledby="navbarDropdown">
                            <span class="dropdown-item-active text-left">Nome: '. $registro['nome'] .'</span><br>
                            <span class="dropdown-item-active">Preço: R$'. $registro['preco'] .' reais</span><br>
                            <center><a href="pagar.php?id_produto='. $registro['id_produto'] .'"><button type="submit" class="detalhes dropdown-item btn">Comprar</button></a></center>
                        </div>
                    </li>
                </ul>
            </div>';
        }}
?>
    </div>
    <div class="col-6 mb-5 text-center conter" class="navbar navbar-expand-lg navbar-light bg-light">
    <h3 class="text-success">Comprados</h3><br><br>
<?  
        foreach($registros AS $registro){
        if($registro['id_status'] == 2){
         echo '<div class="mt-2 mb-2 m-auto h-1" class="collapse navbar-collapse" id="conteudoNavbarSuportado" style="border: 1px solid whitesmoke; border-radius: 10px 10px 10px;">
            
             <ul class="navbar-nav m-auto d-inline">
                 <li style="list-style: none;">
                     <img class=" d-inline" width="50" src="imagens/'. $registro['img'] .'">R$'. $registro['preco'] .' reais
                 </li>
             </ul>
         </div>';
        }
    }
 
?>
    </div><br><br><br><br>
    <div class="texto-rodape p-4" style="border-top: 1px solid gray;width: 100%;">
             Desenvolvido Por Leonardo luig 
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>