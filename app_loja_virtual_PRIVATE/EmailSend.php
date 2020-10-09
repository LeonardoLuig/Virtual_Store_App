<?php

    require "biblioteca/PHPMailer/Exception.php";
    require "biblioteca/PHPMailer/OAuth.php";
    require "biblioteca/PHPMailer/PHPMailer.php";
    require "biblioteca/PHPMailer/POP3.php";
    require "biblioteca/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class EnviarEmail{
        private $email;
        private $assunto;
        private $mensagem;

        public function __get($attr)
        {
            return $this->$attr;
        }

        public function __set($attr, $valor)
        {
            $this->$attr = $valor;
        }

        public function enviar()
        {
            if(empty($this->email) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }else{
                return true;
            }
        }
    }

    $enviar = new EnviarEmail();
    $enviar->__set('email', $_POST['email']);
    $enviar->__set('assunto', $_POST['assunto']);
    $enviar->__set('mensagem', $_POST['mensagem']);
    if(!$enviar->enviar()){
        header('Location: contato.php?email=false');
        die();
    }

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
        $mail->setFrom($enviar->__get('email'));
        $mail->addAddress('leonardo.luigi.belloni@gmail.com');     // Add a recipient
        //$mail->addReplyTo($enviar->__get('email'), 'Entraremos em contato em breve');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
    
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Assunto: ".$enviar->__get('assunto')." - Email: ".$enviar->__get('email');
        $mail->Body    = $enviar->__get('mensagem');
        $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem!';
        header('Location: contato.php?email=true');
        $mail->send();
    } catch (Exception $e) {
        echo 'Não foi possivel enviar este email. Por favor tente novamente mais tarde<br>';
        echo 'Detalhes do erro: ' . $mail->ErrorInfo;
    }
    
        //print_r($mensagem);


?>