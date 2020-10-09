<?php

    class Conexao{
    
    public function conexao(){
        try{
            $conexao = new PDO('mysql:host=localhost;dbname=app_loja_virtual', 'root', '');

            return $conexao;
            
        }catch(PDOException $e){
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}
?>