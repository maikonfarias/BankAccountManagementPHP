<?php

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
   * Cadastra o cliente
   * @return true ou false se der erro
   */
  public function Cadastra() {
  	$sSQL = "INSERT INTO clientes (id_cliente, nome, logradouro, numero, cep, cpf) 
			VALUES (".$this->id_cliente.",'".$this->nome."','".$this->logradouro."',".$this->numero.",'".$this->cep."','".$this->cpf."')";
	$oConn = new DB();
	$res = mysql_query($sSQL,$oConn->Conn());
	
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
  public function Carrega($value){
  	$sSQL = "SELECT nome, logradouro, numero, cep, cpf FROM clientes WHERE id_cliente = '".$value."'";
	
	$oConn = new DB();
	$res = mysql_query($sSQL,$oConn->Conn());
	
	if ($res) {
		$oResultado = mysql_fetch_object($res);
		$this->id_cliente = $value;
		$this->nome = $oResultado->nome;
		$this->logradouro = $oResultado->logradouro;
		$this->numero = $oResultado->numero;
		$this->cep = $oResultado->cep;
		$this->cpf = $oRestuldado->cpf;
		return true;
	} else {
		throw new Exception('ERRO DE SQL: '.mysql_error());
	}
  }
  
  /**
   * Edita o cliente
   * @return true ou false se der erro
   */
  public function Editar() {
  	$sSQL = "UPDATE clientes SET 
					nome = '".$this->nome."',
					logradouro = '".$this->logradouro."',
					numero = ".$this->numero.",
					cep = '".$this->cep."',
					cpf = '".$this->cpf."'
  			  WHERE id_cliente = ".$this->id_cliente;	
	$oConn = new DB();
	$res = mysql_query($sSQL,$oConn->Conn());
	
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
  public function Remover($value){
  	$sSQL = " DELETE FROM clientes
  			  WHERE id_cliente = ".$value;	
	$oConn = new DB();
	$res = mysql_query($sSQL,$oConn->Conn());
	
	if ($res) {
		return true;
	} else {
		throw new Exception('ERRO DE SQL: '.mysql_error());
	}
  }

  
}
?>