<?php

    class ExibiCarrinho{
        private $conexao;
        private $id_produto;
        public function __construct(Conexao $conexao)
        {
            $this->conexao = $conexao->conexao();
        }

        public function exibiCarrinho(){
            $select = "SELECT v.creditos, c.id_status, p.id_produto, p.nome, p.preco, p.img FROM tb_produtos AS p INNER JOIN tb_carrinho AS c INNER JOIN tb_usuario AS u INNER JOIN tb_cartao_loja_virtual AS v ON(p.id_produto = c.id_produto AND u.id_user = c.id_user AND v.id_user = u.id_user) WHERE c.id_user = ".$_SESSION['id_user'];
            $exibi = $this->conexao->query($select);
            $exibi->execute();
            $validation = $exibi->rowCount();

            if($validation > 0){
            $select = "SELECT v.creditos, c.id_status, p.id_produto, p.nome, p.preco, p.img FROM tb_produtos AS p INNER JOIN tb_carrinho AS c INNER JOIN tb_usuario AS u INNER JOIN tb_cartao_loja_virtual AS v ON(p.id_produto = c.id_produto AND u.id_user = c.id_user AND v.id_user = u.id_user) WHERE c.id_user = ".$_SESSION['id_user'];
            $exibi = $this->conexao->prepare($select);
            $exibi->execute();
            return $exibi->fetchAll(PDO::FETCH_ASSOC); 
            }else{
            $select = "SELECT c.id_status, p.id_produto, p.nome, p.preco, p.img FROM tb_produtos AS p INNER JOIN tb_carrinho AS c INNER JOIN tb_usuario AS u ON(p.id_produto = c.id_produto AND u.id_user = c.id_user) WHERE c.id_user = ".$_SESSION['id_user'];
            $exibi = $this->conexao->prepare($select);
            $exibi->execute();
            return $exibi->fetchAll(PDO::FETCH_ASSOC); 
            }
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function idProduto(){
            $select = "SELECT p.id_produto, v.login_cartao FROM tb_produtos AS p INNER JOIN tb_cartao_loja_virtual AS v WHERE id_produto = $this->id_produto AND id_user = ".$_SESSION['id_user'];
            $exibi = $this->conexao->prepare($select);
            $exibi->execute();
            return $exibi->fetch(); 
        }
    }
    

    
?>