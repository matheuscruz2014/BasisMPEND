<?php

class Auxiliar{
    
    
    public function dataMysql($data){
        $vetor = explode("/", $data);
        $nova_data = $vetor[2]."-".$vetor[1]."-".$vetor[0];
        return $nova_data;
    }
    public function dataNormal($data){
        $vetor = explode("-", $data);
        $nova_data = $vetor[2]."/".$vetor[1]."/".$vetor[0];
        return $nova_data;
    }
}
?>
