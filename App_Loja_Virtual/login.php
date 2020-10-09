<?php
    session_start();
    if(isset($_SESSION['logado']) AND $_SESSION['logado'] == 'SIM'){
        header('Location: index.php?logado');
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
    <div><i class="fas fa-reply"></i><a class="text-light" style="text-decoration: none" href="index.php">VOLTAR</a></div>
    <div class="text-info text-center mt-5" style="font-size: 40px;">Log in</div>

    <? if(isset($_GET['logado']) AND $_GET['logado'] == 'NAO'){ ?>
                    <div class="bg-danger w-100 h-5 text-white text-center">
                        Ops! Usuário e/ou senha inválido!
                    </div>
    <? } ?>
    <? if(isset($_GET['acess']) AND $_GET['acess'] == 'denied'){ ?>
                    <div class="bg-danger w-100 h-5 text-white text-center">
                        Faça Login para acessar as páginas protegida!
                    </div>
    <? } ?>
    <? if(isset($_GET['insert']) AND $_GET['insert'] == 'confirmado'){ ?>
                    <div class="bg-success w-100 h-5 text-white text-center">
                        Dados salvos com sucesso, faça login para continuar
                    </div>
    <? } ?>
    
    <div class="text-center p-5">
            <form class="form-group my-2 my-lg-0" action="controllerLogin.php" method="POST">
                <input class="form-control w-25 m-auto" type="email" name="email" placeholder="Email"><br>
                <input class="form-control w-25 m-auto" type="password" name="senha" placeholder="Senha"><br>
                <button type="submit" class="btn btn-info w-25 m-auto">Entrar</button><br>
            </form>
            <a href="cadastro.php">Não possuo Cadastro</a>
    </div>  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>