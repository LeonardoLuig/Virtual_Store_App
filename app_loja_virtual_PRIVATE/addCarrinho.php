<?php
    session_start();
    require 'conexao.php';

    class AddCarrinho{
        private $conexao;
        private $id_produto;

        public function __construct(Conexao $conexao)
        {
            $this->conexao = $conexao->conexao();
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function addCarrinho(){
                $select = "SELECT * FROM tb_carrinho WHERE id_status = 1 AND id_produto = $this->id_produto AND id_user = ".$_SESSION['id_user'];
                $conect = $this->conexao->query($select);
                $conect->execute();
                $registro = $conect->rowCount();

                if($registro == 0){
                    $query = "INSERT INTO tb_carrinho(id_user, id_produto) VALUES(".$_SESSION['id_user'].", :id_produto)";
                    $stmt = $this->conexao->prepare($query);
                    $stmt->bindValue(':id_produto', $this->id_produto);
                    $stmt->execute(); 
                }
            }
    }

    if(isset($_SESSION['logado']) AND $_SESSION['logado'] == 'SIM'){
        $conexao = new Conexao();
        $adicionarCarrinho = new AddCarrinho($conexao);
        $adicionarCarrinho->__set('id_produto', $_POST['id_produto']);
        $validar = $adicionarCarrinho->addCarrinho();
        header('Location: produto.php');
    }else{
        header('Location: login.php?login=invalid');
    }
?>