<?php
    session_start();
    require 'conexao.php';

    class BuyCarrinho{
        private $conexao;
        private $id_produto;
        private $senha;

        public function __construct(Conexao $conexao)
        {
            $this->conexao = $conexao->conexao();
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function buyCarrinho(){
            $valor = "SELECT * FROM tb_produtos WHERE id_produto = $this->id_produto";
            $process = $this->conexao->query($valor);
            $process->execute();
            $preco = $process->fetch();
            //
            $consulta = "SELECT * FROM tb_cartao_loja_virtual WHERE id_user =".$_SESSION['id_user'];
            $stmt = $this->conexao->query($consulta);
            $stmt->execute(); 
            $validation = $stmt->fetch();
            //
            $buy = $validation['creditos'] - $preco['preco'];
            //
            if($validation['senha_cartao'] == $this->senha){
                if($validation['creditos'] > $preco['preco']){
                    $update = "UPDATE tb_cartao_loja_virtual SET creditos = $buy WHERE id_user = ".$_SESSION['id_user'];
                    $conectar = $this->conexao->prepare($update);
                    $conectar->execute();

                    $updateC = "UPDATE tb_carrinho SET id_status = 2 WHERE id_user = ".$_SESSION['id_user']." AND id_produto = $this->id_produto";
                    $conectarC = $this->conexao->prepare($updateC);
                    $conectarC->execute();
                    header('Location: carrinho.php?buy=true');
                }else{
                    header('Location: pagar.php?id_produto='.$this->id_produto.'&buy=false');
                }
            }else{
                header('Location: pagar.php?id_produto='.$this->id_produto.'&pass=false');
            }

            

               
            }
        }

    $conexao = new Conexao();
    $comprar = new BuyCarrinho($conexao);
    $comprar->__set('id_produto', $_POST['id_produto']);
    $comprar->__set('senha', $_POST['senha']);
    $senhas = $comprar->buyCarrinho();
?>