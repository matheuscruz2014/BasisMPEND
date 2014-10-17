<?php
    class model_produto extends Auxiliar{
        function __construct(){
            
        }
        public function insert($objeto){
             $query = "INSERT INTO produto (nome_produto,
            codigo_original,
            codigo_fabricante,
            localizacao,
            unidade,
            custo, 
            margem,
            preco_final) VALUES ('".$objeto->getNome_produto()."', '"
                     .$objeto->getCodigo_original()."', '"
                     .$objeto->getCodigo_fabricante()."', '"
                     .$objeto->getLocalizacao()."', '"
                     .$objeto->getUnidade()."', '"
                     .$objeto->getCusto()."', '"
                     .$objeto->getMargem()."', '"
                     .$objeto->getPreco_final()."')";
             
             $resultado = DAO::abreConexao()->runQuery($query);
             return true;
        }
        public function __list($descricao){
                  $sql = "SELECT CODPRODUTO,CODIGO_FABRICA,DESCRICAO,APLICACAO FROM produto WHERE ";
                  
                  $sql .= "DESCRICAO LIKE '%".$descricao."%' LIMIT 100";
                  
                  $query = $sql;
                  
                  $resultado = DAO::abreConexao()->runQuery($query);
                  $produtos = array();
                  try{
                           $resultado = DAO::abreConexao()->runQuery($query);
                           while($dados = mysql_fetch_assoc($resultado)){
                                    $o_produto = new objeto_produto();
                                    $o_produto->setProduto_id($dados['CODPRODUTO']);
                                    $o_produto->setCodigo_fabrica($dados['CODIGO_FABRICA']);
                                    $o_produto->setDescricao($dados['DESCRICAO']);
                                    $o_produto->setAplicacao($dados['APLICACAO']);
                                    array_push($produtos, $o_produto);
                           }
                  } catch (Exception $ex) {
                           echo $ex;
                  }
                  return $produtos;
        }
        public function update($objeto){
             $query = "UPDATE produto SET nome_produto = '".$objeto->getNome_produto()."',
            codigo_original = '".$objeto->getCodigo_original()."',
            codigo_fabricante = '".$objeto->getCodigo_fabricante()."',
            localizacao = '".$objeto->getLocalizacao()."',
            unidade = '".$objeto->getUnidade()."',
            custo = '".$objeto->getCusto()."',
            margem = '".$objeto->getMargem()."',
            preco_final= '".$objeto->getPreco_final()."' WHERE produto_id = ".$objeto->getProduto_id();
             
             $resultado = DAO::abreConexao()->runQuery($query);
             return true;
        }
        public function delete($produto_id){
             $query = "DELETE FROM produto WHERE produto_id = ".$produto_id;
             $resultado = DAO::abreConexao()->runQuery($query);
             return true;
        }
    }