<?php

/**
 * classe de conexão com o banco de dados
 * $ID$
 */
class DB{

  /**
   * @var resource conexao aberta pelo sql
   */
  private $conexao;
  
  public function __construct(){
	  //if(!$this->conexao = mysql_connect('mysql.confecsul.com.br', 'confecsul022', utf8_decode('YWxjaWRlc21heWE='))){
    if(!$this->conexao = pg_connect("host=localhost port=5432 dbname=alcidesmaya user=postgres password=postgres")){
      throw new Exception('Falha de conexão com o banco');
    }
    
  }
  
  public function conn(){
    return $this->conexao;
  }
  
  public function query($sQuery) {
    //return mysql_query($sQuery,$this->Conn());
    return pg_query($this->Conn(),$sQuery);
  }
}
?>