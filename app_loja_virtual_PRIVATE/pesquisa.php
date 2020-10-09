<?php
    require 'conexao.php';
    class Pesquisa{
        private $conexao;
        private $pesquisar;
        public function __construct(Conexao $conexao){
            $this->conexao = $conexao->conexao();
        }

        public function __set($attr, $valor){
            $this->$attr = $valor;
        }
        public function pesquisar(){
            $query = "SELECT * FROM tb_produtos WHERE nome LIKE '%$this->pesquisar%'";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':pesquisar', $this->pesquisar);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function numRows(){
            $query = "SELECT * FROM tb_produtos WHERE nome LIKE '%$this->pesquisar%'";
            $stmt = $this->conexao->query($query);
            $stmt->bindValue(':pesquisar', $this->pesquisar);
            $stmt->execute();
            //return $stmt->fetch();
            return $stmt->rowCount();
        }
    }
    
     
?>