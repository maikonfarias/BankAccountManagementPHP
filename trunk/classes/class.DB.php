<?php

/**
 * classe de conexÃ£o com o banco de dados
 * $ID$
 */
class DB{

  /**
   * @var resource conexao aberta pelo sql
   */
  private static $conexao;
  
  /**
   * @var string tipoBanco banco conectado: MySQL Postgres e etc
   */
  private static $tipoBanco;
  
  public function __construct(){
    if(self::$conexao) return;
    if(!self::$conexao = mysql_connect('localhost', 'userdesenv', 'userdesenv')){
    //if(!self::$conexao = pg_connect("host=localhost port=5432 dbname=alcidesmaya user=postgres password=postgres")){
      throw new Exception('Falha de conexão com o banco');
    }
    if(!mysql_select_db('banco', self::$conexao)){
       throw new Exception('Falha ao selecionar a base');
    }
    
    self::$tipoBanco = 'MySQL';
    //self::$tipoBanco = 'Postgres';
  }
  
  public function getTipoBanco() {
    return self::$tipoBanco;
  }
  
  public function conn(){
    new self();
    return self::$conexao;
  }
  
  public function query($sQuery) {
    return mysql_query($sQuery,self::$conexao);
    //return pg_query($this->Conn(),$sQuery);
  }
}
?>