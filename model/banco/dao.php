<?php
	class Dao{
		private $servidor;
		private $usuario;
		private $senha;
		private $banco;
		private $conn;
		private $resultado;
		private $sql;
		
		public function __construct($server, $user, $pass, $banco){
			$this->setServidor($server);
			$this->setUsuario($user);
			$this->setSenha($pass);
			$this->setBanco($banco);
		}
		
		public function setServidor($server){
			$this->servidor = $server;	
		}
		public function setUsuario($user){
			$this->usuario = $user;	
		}
		public function setSenha($pass){
			$this->senha = $pass;	
		}
		public function setBanco($banco){
			$this->banco = $banco;	
		}
		
		public function connDB(){
			$this->conn = @mysql_connect($this->servidor, $this->usuario, $this->senha);
			if(!$this->conn){
				echo "<p>N&atilde;o foi poss&iacute;vel conectar-se ao servidor MYSQL. <br> Erro MYSQL: ".mysql_error()."</p>";
				exit();
			}
			elseif(!mysql_select_db($this->banco, $this->conn)){
				echo "<p>N&atilde;o foi poss&iacute;vel selecionar o banco de dados desejado. <br> Erro MYSQL: ".mysql_error()."</p>";	
			}
		}
		public function closeConnDB(){
			return @mysql_close($this->conn);	
		}
		public function runQuery($sql){
			$this->connDB();
			$this->sql = $sql;
			$this->resultado = mysql_query($this->sql);
			if($this->resultado){
				$this->closeConnDB();
				return $this->resultado;
			}
			else{
				$this->closeConnDB();	
				exit("<p>Nao foi possivel executar o comando solicitado. <br> Erro Mysql : ".$this->sql."</p>");
			}
		}
		static public function abreConexao(){
			$hostname = "localhost"; 
			$username = "root";
			$password = "";
			$databasename = "multipecas";
			
			$conexao = new Dao($hostname, $username, $password, $databasename);
			
			return $conexao;	
		}
	}
?>