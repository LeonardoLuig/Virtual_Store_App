<?php
    require "biblioteca/PHPMailer/Exception.php";
    require "biblioteca/PHPMailer/OAuth.php";
    require "biblioteca/PHPMailer/PHPMailer.php";
    require "biblioteca/PHPMailer/POP3.php";
    require "biblioteca/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'conexao.php';

    class CartaoLoja{
        private $conexao;

        public function __construct(Conexao $conexao)
        {
            $this->conexao = $conexao->conexao();
        }

        public function gerarCartao()
        {   
            //FAZ UM QUERY PRA VER SE USUARIO JA POSSUI UM CARTAO
            $val = "SELECT login_cartao FROM tb_cartao_loja_virtual WHERE id_user = ". $_SESSION['id_user'];
            $ver = $this->conexao->query($val);
            $ver->execute();
            $validation = $ver->rowCount();

            //FILTRA PRA CRIACAO DO CARTAO
            $query = "SELECT email FROM tb_usuario WHERE id_user = ". $_SESSION['id_user'];    
            $stmt = $this->conexao->query($query);
            $stmt->execute();
            $email = $stmt->fetch();
            $cartao = explode('@gmail.com', $email['email']);
            $cartao = str_replace(".", "", $cartao);
            $cartao = str_replace("_", "", $cartao);
            $cartao = str_replace("-", "", $cartao);
            //print_r($cartao[0]);

            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
            }
            $senha = implode($pass); //turn the array into a string

            //VERIFICA SE O USUARIO JA POSSUI UM CARTAO, CASO POSSUA, RETURN FALSE, CASO CONTRÁRIO RETURN TRUE
            if($validation == 0){
            //print_r($validation);
            $insert = "INSERT INTO tb_cartao_loja_virtual(id_user, login_cartao, senha_cartao) VALUES(".$_SESSION['id_user'].",'$cartao[0]', '$senha')";
            $insere = $this->conexao->prepare($insert);
            $insere->execute();
            print_r($insert);

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'leonardo.luigi.belloni@gmail.com';                 // SMTP username
                $mail->Password = '16112000';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to
            
                //Recipients
                $mail->setFrom($email['email']);
                $mail->addAddress('leonardo.luigi.belloni@gmail.com');     // Add a recipient
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');
            
                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Trocar senha';
                $mail->Body    = "senha atual:$senha<br> ACESSE: <a href='localhost/App_Loja_Virtual/alterarSenha.php'>localhost/App_Loja_Virtual/alterarSenha.php</a> para comprar o produto desejado!";
                $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem!';
                header('Location: carrinho.php?conferir=email');
                $mail->send();
            } catch (Exception $e) {
                echo 'Não foi possivel enviar este email. Por favor tente novamente mais tarde<br>';
                echo 'Detalhes do erro: ' . $mail->ErrorInfo;
                //header('Location: produto.php?email=falied');
            }
                //header('Location: produto.php');
                //print_r($mensagem);
            }else{
                //print_r($validation);
                header('Location: carrinho.php');
            }
        }
    }

    $conexao = new Conexao();
    $gerar = new CartaoLoja($conexao);
    $gerar->gerarCartao();
    
    

?>