<?php
include_once 'classes/class.DB.php';

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
   * @var string cidade do cliente
   */	
  private $cidade;
  
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
    $this->cidade         = '';
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
   * Pega o endereco do cliente
   * @return string endereco do cliente
   */
  public function getCidade(){
  	return $this->cidade;
  }
  
  /**
   * Pega o data de dascimento do cliente
   * @return string data de nascimento do cliente
   */
  public function getDataNascimento(){
  	return implode('/',array_reverse(explode('-',$this->data_nascimento)));
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
    $this->nome = $value;
  }
  
  /**
   * Seta o logradouro do cliente
   * @param $value string logradouro do cliente
   */
  public function setLogradouro($value){
  	$value = (string) $value;
    $this->logradouro = $value;

  }
  
  /**
   * Seta numero do endereco do cliente
   * @param $value integer numero do endereco do cliente
   */
  public function setNumero($value) {
    $value = (int) $value;
    $this->numero = $value;

  }
  
  /**
   * Seta o cep do cliente
   * @param $value string cep do cliente
   */
  public function setCep($value){
  	$value = (string) $value;
    $this->cep = $value;
  }
  
  /**
   * Seta o cidade do cliente
   * @param $value string cidade do cliente
   */
  public function setCidade($value){
  	$value = (string) $value.'';
    $this->cidade = $value;
  }
  
  /**
   * Seta o data de nascimento do cliente
   * @param $value string data de nascimento do cliente
   */
  public function setDataNascimento($value = '01/01/1900'){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->data_nascimento = implode('-',array_reverse(explode('/',$value)));
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
    $this->cpf = $value;
  }
  
  /**
   * Seta o rg do cliente
   * @param $value string rg do cliente
   */
  public function setRg($value){
  	$value = (string) $value;
    $this->rg = $value;
  }

  /**
   * Cadastra o cliente
   * @return true ou false se der erro
   */
  public function cadastrar() {
    $oConn = new DB();
    
    $sSQLId = 'SELECT MAX(id_cliente) as id_cliente FROM clientes';
    $resId = $oConn->query($sSQLId);
    $oResId = pg_fetch_object($resId);
    
    //força o numero a ficar int e incrementa em 1
    $this->id_cliente = ($oResId->id_cliente * 1) + 1;
    
    $sSQL = "
      INSERT INTO clientes (id_cliente, nome, logradouro, numero, cep, cidade, data_nascimento, cpf, rg) 
			VALUES (".$this->id_cliente.",'".$this->nome."','".$this->logradouro."',".$this->numero.",'".$this->cep."', '".$this->cidade."', '".$this->data_nascimento."','".$this->cpf."', '".$this->rg."')
    ";
    
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error().$sSQL);
    }
  }
  
  /**
   * Carrega o cliente
   * @return true ou false se der erro
   */
  public function carregar($value){
    $sSQL = "SELECT nome, logradouro, numero, cep, cidade, data_nascimento, cpf, rg FROM clientes WHERE id_cliente = '".$value."'";
	
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    if ($res) {
      $oResultado = pg_fetch_object($res);
      
      $this->id_cliente       = $value;
      $this->nome             = $oResultado->nome;
      $this->logradouro       = $oResultado->logradouro;
      $this->numero           = $oResultado->numero;
      $this->cep              = $oResultado->cep;
      $this->cidade           = $oResultado->cidade;
      $this->data_nascimento  = $oResultado->data_nascimento;
      $this->cpf              = $oResultado->cpf;
      $this->rg               = $oResultado->rg;
      
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
              cidade            = '".$this->cidade."',
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
  public function remover($value = ''){
    if(empty($value)){
      $value = $this->id_cliente;
    }
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
    $sSQL = 'SELECT id_cliente, nome, logradouro, numero, cep, cidade, data_nascimento, cpf, rg FROM clientes';
    if (!empty($sWhere)) {
      $sSQL .= ' WHERE '.$sWhere;
    }
    $sSQL .= ' ORDER BY id_cliente ASC';
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    $aClientes = array();
    
    while ($oRes = pg_fetch_object($res)) {
      $cliente = new self();
      $cliente->setIdCliente      ($oRes->id_cliente);
      $cliente->setNome           ($oRes->nome);
      $cliente->setLogradouro     ($oRes->logradouro);
      $cliente->setNumero         ($oRes->numero);
      $cliente->setCep            ($oRes->cep);
      $cliente->setCidade         ($oRes->cidade);
      $cliente->setDataNascimento ($oRes->data_nascimento);
      $cliente->setCpf            ($oRes->cpf);
      $cliente->setRg             ($oRes->rg);
      $aClientes[] = $cliente;
    }
    
    return $aClientes;
  }
}





?>