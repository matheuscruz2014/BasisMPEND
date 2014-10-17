<?php
	/* Classe responsável pela conexão com o banco */	
	class Dao {
		
		/* Variáveis Globais */
		private $servidor;
		private $usuario;
		private $senha;
		private $banco;
		private $conn;
		private $resultado;
		private $sql;
		private $lastid;
		
		/* Método Construtor */
		public function __construct($server, $user, $pass, $banco) {		
			$this->setServidor($server);
			$this->setUsuario($user);
			$this->setSenha($pass);
			$this->setBanco($banco);			
			if(!isset($_SESSION)){
				session_start();
			}
			
		}
		
		/* Sets */
		public function setServidor($server) {
			$this->servidor = $server;
		}		
		public function setUsuario($user) {
			$this->usuario = $user;
		}		
		public function setSenha($pass) {
			$this->senha = $pass;
		}		
		public function setBanco($banco) {
			$this->banco = $banco;
		}
		public function setLastId($last_id) {
			$this->lastid = $last_id;
		}
		public function getLastid() {
			return mysql_insert_id($this->conn) ;
		}
		
		/* Método que abre a conexão com o Banco de Dados */
		public function connDB() {	
			$this->conn = @mysql_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
			if(!$this->conn) {
				echo "<p>N&atilde;o foi poss&iacute;vel conectar-se ao servidor MySQL. <br>Erro MySQL: ".mysql_error()."</p>";
				exit();
			} elseif (!@mysql_select_db($this->banco, $this->conn)) {
				echo "<p>N&atilde;o foi poss&iacute;vel selecionar o banco de dados desejado. <br>Erro MySQL: ".mysql_error()."</p>";
				exit();
			}
		}
		
		/* Método que fecha a conexão com o Banco de Dados */
		public function closeConnDB() {
			return @mysql_close($this->conn);
		}
		
		/* Método que executa comando SQL */
		public function runQuery($sql) {
			$this->connDB();
			$this->sql = $sql;
			$this->resultado = @mysql_query($this->sql);
			if($this->resultado) {
				$_SESSION['lastid'] = @mysql_insert_id($this->conn);
				$this->closeConnDB();
				return $this->resultado;
			} else {
				$this->closeConnDB();
				exit("<p>N&atilde;o foi poss&iacute;vel executar o comando solicitado.<br>Erro MySQL: ".mysql_error()."</p><br />Comando SQL: ".$this->sql);
			}
		}
		
		/* Método instância um objeto da classe de conexão */
		static public function abreConexao(){
			# Conexão com banco de dados
			$hostname = "localhost"; 
			$username = "multipecas";
			$password = "multipecas2014*";
			$databasename = "multipecas";
			
			$conexao = new Dao($hostname, $username, $password, $databasename);
			
			return $conexao;
		}				
			
	}
?>