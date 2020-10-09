<?php

    class Creditos{
        private $conexao;

        public function __construct(Conexao $conexao)
        {
            $this->conexao = $conexao->conexao();
        }

        public function exibirCreditos()
        {
            $creditos = "SELECT creditos FROM tb_cartao_loja_virtual WHERE id_user = ".$_SESSION['id_user'];
            $conect = $this->conexao->query($creditos);
            $conect->execute();
            return $conect->fetch();
        }
    }
?>