<?php
include 'classes/class.DB.php';

/**
 * classe para manipular clientes
 * $ID$
 */
class Cliente{
  
  /**
   * @var integer id do cliente
   */
  private $id_cliente;
  
  /**
   * @var string nome do cliente
   */
  private $nome;
  
  /**
   * @var string nome da rua do endereco do cliente
   */
  private $logradouro;
  
  /**
   * @var integer numero da rua do endereco do cliente
   */	
  private $numero;
  
  /**
   * @var string cep do endereco do cliente
   */	
  private $cep;
  
  /**
   * @var string data de nascimento do cliente
   */	
  private $data_nascimento;
  
  /**
   * @var string cpf do cliente
   */
  private $cpf;
  
  /**
   * @var string rg do cliente
   */	
  private $rg;
  
  
  /**
   * construtor da classe Cliente
   * seta os valores padroes dos campos
   */	
  function __construct(){
    $this->id_cliente       = null;
    $this->nome             = '';
    $this->logradouro       = '';
    $this->numero           = 0;
    $this->cep              = '';
    $this->data_nascimento  = '';
    $this->cpf              = '';
    $this->rg               = '';
  }
  
  /**
   * Pega o id do cliente
   * @return integer id do cliente
   */
  public function getIdCliente() {
    return $this->id_cliente;
  }
  
  /**
   * Pega a nome do cliente
   * @return string nome do cliente
   */
  public function getNome(){
  	return $this->nome;
  }
  
  /**
   * Pega o logradouro do cliente
   * @return string logradouro do cliente
   */
  public function getLogradouro(){
  	return $this->logradouro;
  }
  
  /**
   * Pega o numero do endereco do cliente
   * @return integer numero do endereco do cliente
   */
  public function getNumero(){
  	return $this->numero;
  }
  
  /**
   * Pega o cep do cliente
   * @return string cep do cliente
   */
  public function getCep(){
  	return $this->cep;
  }
  
  /**
   * Pega o data de dascimento do cliente
   * @return string data de nascimento do cliente
   */
  public function getDataNascimento(){
  	return $this->data_nascimento;
  }
  
  /**
   * Pega o cpf do cliente
   * @return string cpf do cliente
   */
  public function getCpf(){
  	return $this->cpf;
  }
  
  /**
   * Pega o rg do cliente
   * @return string rg do cliente
   */
  public function getRg(){
  	return $this->rg;
  }
  
  
  /**
   * Seta o id do cliente
   * @param $value integer id do cliente
   */
  public function setIdCliente($value) {
    $value = (int) $value;
    if ($value > 0) {
      $this->id_cliente = $value;
    } else {
      throw new Exception('id_cliente deve ser inteiro maior que 0');
    }
  }
  
  /**
   * Seta a nome do cliente
   * @param $value string nome do cliente
   */
  public function setNome($value){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->nome = $value;
    } else {
      throw new Exception('nome deve ser string');
    }
  }
  
  /**
   * Seta o logradouro do cliente
   * @param $value string logradouro do cliente
   */
  public function setLogradouro($value){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->logradouro = $value;
    } else {
      throw new Exception('logradouro deve ser string');
    }
  }
  
  /**
   * Seta numero do endereco do cliente
   * @param $value integer numero do endereco do cliente
   */
  public function setNumero($value) {
    $value = (int) $value;
    if ($value >= 0) {
      $this->numero = $value;
    } else {
      throw new Exception('numero deve ser um numero inteiro positivo');
    }
  }
  
  /**
   * Seta o cep do cliente
   * @param $value string cep do cliente
   */
  public function setCep($value){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->cep = $value;
    } else {
      throw new Exception('cep deve ser string');
    }
  }
  
  /**
   * Seta o data de nascimento do cliente
   * @param $value string data de nascimento do cliente
   */
  public function setDataNascimento($value){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->data_nascimento = $value;
    } else {
      throw new Exception('data de nascimento deve ser string');
    }
  }
  
  /**
   * Seta o cpf do cliente
   * @param $value string cpf do cliente
   */
  public function setCpf($value){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->cpf = $value;
    } else {
      throw new Exception('cpf deve ser string');
    }
  }
  
  /**
   * Seta o rg do cliente
   * @param $value string rg do cliente
   */
  public function setRg($value){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->rg = $value;
    } else {
      throw new Exception('rg deve ser string');
    }
  }

  /**
   * Cadastra o cliente
   * @return true ou false se der erro
   */
  public function cadastra() {
    $sSQL = "
      INSERT INTO clientes (id_cliente, nome, logradouro, numero, cep, data_nascimento, cpf, rg) 
			VALUES (".$this->id_cliente.",'".$this->nome."','".$this->logradouro."',".$this->numero.",'".$this->cep."', '".$this->data_nascimento."','".$this->cpf.", '".$this->rg."')
    ";
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error());
    }
  }
  
  /**
   * Carrega o cliente
   * @return true ou false se der erro
   */
  public function carrega($value){
    $sSQL = "SELECT nome, logradouro, numero, cep, data_nascimento, cpf, rg FROM clientes WHERE id_cliente = '".$value."'";
	
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    if ($res) {
      $oResultado = mysql_fetch_object($res);
      
      $this->id_cliente       = $value;
      $this->nome             = $oResultado->nome;
      $this->logradouro       = $oResultado->logradouro;
      $this->numero           = $oResultado->numero;
      $this->cep              = $oResultado->cep;
      $this->data_nascimento  = $oResultado->data_nascimento;
      $this->cpf              = $oRestuldado->cpf;
      $this->rg               = $oRestuldado->rg;
      
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error());
    }
  }
  
  /**
   * Edita o cliente
   * @return true ou false se der erro
   */
  public function editar() {
    $sSQL = "UPDATE clientes SET 
              nome              = '".$this->nome."',
              logradouro        = '".$this->logradouro."',
              numero            = ". $this->numero.",
              cep               = '".$this->cep."',
              data_nascimento   = '".$this->data_nascimento."',
              cpf               = '".$this->cpf."',
              rg                = '".$this->rg."'
              WHERE id_cliente  = ". $this->id_cliente;	
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error());
    }
  }
  
  /**
   * Remove o cliente
   * @return true ou false se der erro
   */
  public function remover($value){
    $sSQL = " DELETE FROM clientes
              WHERE id_cliente = ".$value;	
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error());
    }
  }
  
  /**
   * Metodo estatico para listar os clientes em array
   * @return array clientes
   */
  public static function listar ($sWhere = '') {
    $sSQL = 'SELECT id_cliente, nome, logradouro, numero, cep, data_nascimento, cpf, rg FROM clientes';
    if (!empty($sWhere)) {
      $sSQL .= 'WHERE '.$sWhere;
    }
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    $aClientes = array();
    
    while ($oRes = pg_fetch_object($res)) {
      $cliente = new self();
      $cliente->setIdCliente(       $oRes->id_cliente);
      $cliente->setNome(            $oRes->nome);
      $cliente->setLogradouro(      $oRes->logradouro);
      $cliente->setNumero(          $oRes->numero);
      $cliente->setCep(             $oRes->cep);
      $cliente->setDataNascimento(  $oRes->data_nascimento);
      $cliente->setCpf(             $oRes->cpf);
      $cliente->setRg(              $oRes->rg);
      $aClientes[] = $cliente;
    }
    
    return $aClientes;
  }
}





?>