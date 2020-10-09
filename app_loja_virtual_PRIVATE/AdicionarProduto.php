<?php

    class Adicionar{
        private $conexao;
        private $img;
        private $nome;
        private $preco;
        public function __construct(Conexao $conexao){
            $this->conexao = $conexao->conexao();
        }

        

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }
        public function adicionar(){
            if($this->img != '' AND $this->nome != '' AND $this->preco !=''){
            $query = "INSERT INTO tb_produtos(img, nome, preco) VALUES('$this->img', :nome, :preco)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $_POST['nome']);
            $stmt->bindValue(':preco', $_POST['preco']);
            $stmt->execute();
            header('Location: produto.php');
            }else{
                header('Location: addProduto.php?sit=null');
            }
        }
        public function exibir(){
            $query = "SELECT id_produto, nome, DAY(data), img, preco FROM tb_produtos";
            $stmt = $this->conexao->query($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>