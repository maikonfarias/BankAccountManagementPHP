<?php
	class DB{
		private $conexao;
		
		public function __construct(){
			if(!$this->conexao= mysql_connect('localhost', 'root', '')){
			   throw new Exception('Falha de conexão com o banco');
			}
			
			if(!mysql_select_db('banco', $this->conexao)){
			   throw new Exception('Falha ao selecionar a base');
			}
		}
		
		public function conn(){
		    return $this->conexao;
		}
		
		public function query($sQuery) {
			return mysql_query($sQuery,$this->Conn());
		}
	}
?>