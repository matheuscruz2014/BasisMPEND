<?php
	function __autoload($nome_classe){
		$classe = 'lib/'.$nome_classe.'.php';
		if(file_exists($classe)){
			require_once($classe);
		}
	}
include_once("startup.php");
session_start();
class Application {
	protected $url_controller;
	protected $url_action;
	//Função que carrega as variaveis passadas por URL
                
                public function __construct(){
                                    define('RECEITA_FOTOS_PATH','global/imagem/receita/');
		}
	public function loadRoute(){
		//Pega o que for por GET ou POST
		$this->url_controller = isset($_REQUEST['controle']) ? $_REQUEST['controle'] : 'index';
		//Pega o que for passado por Ação
		$this->url_action = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : 'index';
		
	}
	public function dispatch(){
		//Carrega as variaveis 
		$this->loadRoute();
		//Transforma a String no caminho das pastas
		$arquivo_controle = 'controller/'.$this->url_controller.'/controller_'.$this->url_controller.'.php';
		//Se o arquivo existir ele irá inclui-lo
		if(file_exists($arquivo_controle)){
			require_once $arquivo_controle;
		}
		else{
			throw new Exception('Arquivo : '.$arquivo_controle.' não foi localizado ou não existe');	
		}
		//Com o arquivo incluido irá incluir a classe criada
		$classe_controle = 'controller_'.$this->url_controller;
		if(class_exists($classe_controle)){
			$obj_class = new $classe_controle;	
		}
		else{
			throw new Exception("Classe '$classe_controle' não existe no arquivo '$arquivo_controle'");	
		}
		//Irá convocar o método
		$metodo_controle = $this->url_action.'Action';
		if(method_exists($classe_controle,$metodo_controle)){
			//Executa método
			$obj_class->$metodo_controle();	
		}
		else{
			throw new Exception("Metodo '$metodo_controle' não existe na classe '$classe_controle'");
		}	
	}
	public static function redirect($url){
		header("Location : '$url'");	
	}

}
?>