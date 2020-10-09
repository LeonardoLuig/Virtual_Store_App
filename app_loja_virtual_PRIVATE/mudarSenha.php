<?php
session_start();
    require 'conexao.php';

    class MudarSenha{
        private $conexao;
        private $senhaAtual;
        private $novaSenha;

        public function __construct(Conexao $conexao)
        {
            $this->conexao = $conexao->conexao();
        }

        public function __set($attr, $value)
        {
            $this->$attr = $value;
        }

        public function alterarSenha(){
            $query = "SELECT * FROM tb_cartao_loja_virtual WHERE id_user = ".$_SESSION['id_user'];
            $state = $this->conexao->prepare($query);
            $state->execute();
            $valid = $state->fetch();

            if($valid['senha_cartao'] == $this->senhaAtual){
            $update = "UPDATE tb_cartao_loja_virtual SET senha_cartao = :novaSenha WHERE id_user = ".$_SESSION['id_user'];
            $stmt = $this->conexao->prepare($update);
            $stmt->bindValue(':novaSenha', $_POST['novaSenha']);
            $stmt->execute();
            header('Location: carrinho.php?senha=alterada');
            }else{
                header('Location: alterarSenha.php?filed');
            }
        }
    }
    $conexao = new Conexao();
    $mudarSenha = new MudarSenha($conexao);
    $mudarSenha->__set('senhaAtual', $_POST['senhaAtual']);
    $mudarSenha->__set('novaSenha', $_POST['novaSenha']);
    $mudarSenha->alterarSenha();

?>