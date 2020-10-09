<?php
    class Usuario{
        private $conexao;
        private $email;
        private $senha;
        private $confirmSenha;

        public function __construct(Conexao $conexao){
            $this->conexao = $conexao->conexao();
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function Cadastro(){
            try{
            $query = "SELECT COUNT(*) FROM tb_usuario WHERE email = '$this->email'";
            $smtm = $this->conexao->query($query);
            $num_row = $smtm->fetchColumn();
            $login = $this->senha == $this->confirmSenha;

            if($num_row == 0){
                if($this->email != '' and $this->senha != '' and $login){
                    $insert = "INSERT INTO tb_usuario(email, senha) VALUES('$this->email', '$this->senha')";
                    $stmt = $this->conexao->query($insert);
                    $smtm->execute();
                    header('Location: login.php?insert=confirmado');
                }else{
                    header('Location: cadastro.php?value=null');
                }}else{
                    header('Location: cadastro.php?value=exist');
            }}catch(PDOException $e){
                echo 'erro ao se conectar com o server';
            }
        }
        public function Login(){
            
            $query = "SELECT COUNT(*) FROM tb_usuario WHERE email = :login AND senha = :senha";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':login', $_POST['email']);
            $stmt->bindValue(':senha', $_POST['senha']);
            $stmt->execute();
            $num_row = $stmt->fetchColumn();
            ////////////////////////////////////////////////////////////////////////////
            $query = "SELECT id_user, id_type FROM tb_usuario WHERE email = :login AND senha = :senha";
            $id = $this->conexao->prepare($query);
            $id->bindValue(':login', $_POST['email']);
            $id->bindValue(':senha', $_POST['senha']);
            $id->execute();
            $id_user = $id->fetch();

            if($num_row > 0){
                session_start();

                $_SESSION['id_user'] = $id_user['id_user'];
                $_SESSION['id_type'] = $id_user['id_type'];
                $_SESSION['logado'] = 'SIM';
                header('Location: index.php?logado='.$_SESSION['logado']);
            }else{
                $_SESSION['logado'] = 'NAO';
                header('Location: login.php?logado='.$_SESSION['logado']);
            }
        }
    }

?>