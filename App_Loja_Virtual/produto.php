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
    <script type="text/javascript">
        function setaImagem(){
    var settings = {
        primeiraImg: function(){
            elemento = document.querySelector("#slider a:first-child");
            elemento.classList.add("ativo");
            this.legenda(elemento);
        },

        slide: function(){
            elemento = document.querySelector(".ativo");

            if(elemento.nextElementSibling){
                elemento.nextElementSibling.classList.add("ativo");
                settings.legenda(elemento.nextElementSibling);
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");
                settings.primeiraImg();
            }

        },

        proximo: function(){
            clearInterval(intervalo);
            elemento = document.querySelector(".ativo");

            if(elemento.nextElementSibling){
                elemento.nextElementSibling.classList.add("ativo");
                settings.legenda(elemento.nextElementSibling);
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");
                settings.primeiraImg();
            }
            intervalo = setInterval(settings.slide,4000);
        },

        anterior: function(){
            clearInterval(intervalo);
            elemento = document.querySelector(".ativo");

            if(elemento.previousElementSibling){
                elemento.previousElementSibling.classList.add("ativo");
                settings.legenda(elemento.previousElementSibling);
                elemento.classList.remove("ativo");
            }else{
                elemento.classList.remove("ativo");                     
                elemento = document.querySelector("a:last-child");
                elemento.classList.add("ativo");
                this.legenda(elemento);
            }
            intervalo = setInterval(settings.slide,4000);
        },

        legenda: function(obj){
            var legenda = obj.querySelector("img").getAttribute("");
            document.querySelector("figcaption").innerHTML = legenda;
        }

    }

    //chama o slide
    settings.primeiraImg();

    //chama a legenda
    settings.legenda(elemento);

    //chama o slide à um determinado tempo
    var intervalo = setInterval(settings.slide,4000);
    document.querySelector(".next").addEventListener("click",settings.proximo,false);
    document.querySelector(".prev").addEventListener("click",settings.anterior,false);
}

    window.addEventListener("load",setaImagem,false);
    </script>
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
            <form class="form-inline my-2 my-lg-0" action="produto_pesquisado.php" method="POST">
                <input class="form-control mr-sm-2" type="search" placeholder="Ex: Samsung J7 Prime" name="pesquisar" aria-label="Pesquisar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>
    
    <!--Conteúdo-->
    <? if(isset($_SESSION['id_type']) AND $_SESSION['id_type'] == 2){?>
        
    <a class="nav-link text-info w-25" href="addProduto.php?sit=add">Adicionar Novo Produto</a>
    <? } ?>
    <? if(isset($_GET['result']) AND $_GET['result'] == 'null'){ ?>
                    <div class="bg-danger w-100 h-5 text-white text-center">
                    Nenhum produto encontrado ou valor vazio!
                    </div>
    <? } ?>
    <? if(isset($_GET['exist']) AND $_GET['exist'] == 'false'){ ?>
                    <div class="bg-danger w-100 h-5 text-white text-center">
                        Nenhum produto encontrado!
                    </div>
    <? } ?>
    <div class="text-success w-50 m-auto text-center" style="font-size: 40px;">Produtos</div>
    
    <div class="slide w-80">
        <figure class="container">
            <span class="trs next"></span>
            <span class="trs prev"></span>

            <div id="slider">
                <a href="#" style="margin-left: 9%;" class="trs img-fluid"><img src="imagens/slideshow4.png" width="950" alt="Legenda da imagem 1" /></a>
                <a href="#" style="margin-left: 40%;" class="trs img-fluid"><img src="imagens/slideshow1.png" width="350" alt="Legenda da imagem 2" /></a>
                <a href="#" style="margin-left: 9%;" class="trs img-fluid"><img src="imagens/slideshow2.png" width="950" alt="Legenda da imagem 3" /></a>
                <a href="#" style="margin-left: 50%;" class="trs img-fluid"><img src="imagens/slideshow3.png" width="300" alt="Legenda da imagem 4" /></a>
                <a href="#" style="margin-left: 45%;" class="trs img-fluid"><img src="imagens/testeSamsungSm.png" width="300" alt="Legenda da imagem 5" /></a>
            </div>

            <figcaption></figcaption>
        </figure>
    </div>
    <hr>
    <div class="text-info text-center s-40" style="font-size: 40px;">Para procurar por produtos expecificos vá até pesquisa</div>
    <div class="row m-auto conteudo">
    <?

        require 'exibirProduto.php';
        $date = date('j');
        foreach($exibir as $exibi){
            $cal = $date - $exibi['DAY(data)'];
            echo '
            <div class="col-3 bloco_anuncio">
                <div class="col-md-12 m-auto">
                <p style="width: 100%;" class="w-100">'.$exibi['nome'].'</p>
                    <img class="img-fluid" src="imagens/'.$exibi['img'].'" class="text-r-center" width="250">
                    <p style="width: 100%;" class="w-100">R$'.$exibi['preco'].' reais</p>
                    <a href="pagar.php?id_produto='. $exibi['id_produto'] .'"><button class="btn btn-outline-success">Comprar</button></a>

                    <form action="addCarrinho.php" method="POST">
                    <input name="id_produto" type="hidden" value="'. $exibi['id_produto'] .'">
                    <button class="btn btn-outline-info">Carrinho</button>
                    </form>
                </div>
    </div>';
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