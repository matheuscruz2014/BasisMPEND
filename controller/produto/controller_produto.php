<?php
class controller_produto extends Controle{
        
        private $model;
        public function __construct(){
            $this->model = new model_produto();
        }
        function encapsulamento(){
            $o_produto = new objeto_produto();
            $o_conexao = new objeto_conexao();
            
            if(isset($_POST['produto_id'])){
                 $o_produto->setProduto_id($this->validaInput($_POST['produto_id']));
            }
             if(isset($_POST['nome_produto'])&&($_POST['nome_produto']!=null)){
                $o_produto->setNome_produto($this->validaInput($_POST['nome_produto']));
            }else{$o_conexao->setDetalhe("Erro no nome do produto");$o_conexao->setOn("false"); return $o_conexao;}
            if(isset($_POST['codigo_original'])){
                $o_produto->setCodigo_original($this->validaInput($_POST['codigo_original']));
            }else{$o_conexao->setDetalhe("Erro no no codigo original");$o_conexao->setOn("false"); return $o_conexao;}
            if(isset($_POST['codigo_fabricante'])){
                $o_produto->setCodigo_fabricante($this->validaInput($_POST['codigo_fabricante']));
            }else{$o_conexao->setDetalhe("Erro no codigo do fabricante");$o_conexao->setOn("false"); return $o_conexao;}
            if(isset($_POST['localizacao'])&&($_POST['localizacao']!=null)){
                $o_produto->setLocalizacao($this->validaInput($_POST['localizacao']));
            }else{$o_conexao->setDetalhe("Erro na localizacao");$o_conexao->setOn("false"); return $o_conexao;}
            if(isset($_POST['unidade'])&&($_POST['unidade']!=null)){
                $o_produto->setUnidade($this->validaInput($_POST['unidade']));
            }else{$o_conexao->setDetalhe("Erro na unidade");$o_conexao->setOn("false"); return $o_conexao;}
            if(isset($_POST['custo'])&&($_POST['custo']!=null)){
                $o_produto->setCusto($this->validaInput($_POST['custo']));
            }else{$o_conexao->setDetalhe("Erro no custo");$o_conexao->setOn("false"); return $o_conexao;}
            if(isset($_POST['margem'])&&($_POST['margem']!=null)){
                $o_produto->setMargem($this->validaInput($_POST['margem']));
            }else{$o_conexao->setDetalhe("Erro na margem");$o_conexao->setOn("false"); return $o_conexao;}
                if(isset($_POST['preco_final'])&&($_POST['preco_final']!=null)){
                $o_produto->setPreco_final($this->validaInput($_POST['preco_final']));
            }else{$o_conexao->setDetalhe("Erro no preco final");$o_conexao->setOn("false"); return $o_conexao;}
            $o_conexao->setBagagem($o_produto);
            $o_conexao->setOn("true");
            return $o_conexao;
        }
        public function insereAction(){
                  $retorno = $this->encapsulamento();
                  if($retorno->getBagagem()!=null){
                           $this->model->insert($retorno->getBagagem());
                           echo "true";
                  }else{
                           echo json_encode($retorno);
                  }
        }
        public function alteraAction(){
                  $retorno = $this->encapsulamento();
                  if($retorno->getBagagem()!=null){
                           $this->model->update($retorno->getBagagem());
                           echo "true";
                  }else{
                           echo json_encode($retorno);
                  }
        }
        public function deletaAction(){
                  $produto_id = $this->validaInput($_POST['produto_id']);
                  if(isset($produto_id)){
                           $this->model->delete($produto_id);
                           echo "true";
                  }else{
                           $o_conexao = new objeto_conexao();
                           $o_conexao->setOn("false");
                           $o_conexao->setDetalhe("Erro no id do produto para apagar");
                           $o_conexao->setBagagem($produto_id);
                           echo json_encode($o_conexao);
                  }
        }
		
		/*
		ENVIO - POST: descricao
		
		RETORNO - LISTA JSON: produto {
			produto_id;
        	codigo_fabrica;
			descricao;
			aplicacao;
		}.*/
		
        public function getProdutosAction(){
            
            if(isset($_POST['descricao'])){
                $descricao = $this->validaInput($_POST['descricao']);
                echo json_encode($this->model->__list($descricao));
            }else{
                 echo "FALSE";
            }
        }
}
