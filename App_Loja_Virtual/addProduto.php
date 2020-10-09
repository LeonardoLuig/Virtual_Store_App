<?php
    session_start();
    if(isset($_SESSION['id_type']) AND $_SESSION['id_type'] == 2){

    }else{
        header('Location: index.php?protectPage');
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

<body class="fundo-contato" id="contato">
    <!--Formulário-Login-->
    <div><i class="fas fa-reply"></i><a class="text-light" style="text-decoration: none" href="produto.php">VOLTAR</a></div>
    <div class="text-info text-center mt-5" style="font-size: 40px;">Adicionar Imagem</div>
    
    <div class="text-center p-5">
            <form class="form-group my-2 my-lg-0" action="AdicionarProduto.php" method="POST">
                <input class="form-control w-25 m-auto" type="text" name="nome" placeholder="Nome do dispositivo"><br>
                <input class="form-control w-25 m-auto" type="text" name="preco" placeholder="R$00000,00"><br>
                <input class=" btn btn-light mb-5 w-25 m-auto" type="file" name="img"><br><br>
                <button type="submit" class="btn btn-info w-25 m-auto">Adicionar</button><br>
            </form>
    </div>  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>