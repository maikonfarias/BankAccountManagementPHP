<?php
include_once 'classes/class.Cliente.php';

/**
 * classe para manipular contas, não pode ser istanciada, deve ser herdada por outras contas
 * $ID$
 */
abstract class Conta{
  
  /**
   * @var integer id do conta
   */
  protected $id_conta;
  
  /**
   * @var Cliente cliente da conta
   */
  public $cliente;
  
  /**
   * @var string agencia da conta
   */
  protected $agencia;
  
  /**
   * @var string numero da conta
   */	
  protected $numero;
  
  /**
   * @var float saldo da conta
   */	
  protected $saldo;
  
  /*
   * @var string data de abertura da conta
   */	
  protected $data_abertura;

  
  
  /**
   * construtor da classe Conta
   * seta os valores padroes dos campos
   */	
  function __construct(){
    $this->id_conta         = null;
    $this->cliente          = null;
    $this->agencia          = '';
    $this->numero           = '';
    $this->saldo            = 0.00;
    $this->data_abertura    = '2010-10-22';
  }
  
  /**
   * Pega a agencia da conta
   * @return string agencia da conta
   */
  public function getAgencia(){
  	return $this->agencia;
  }
  
  /**
   * Pega o numero do endereco da conta
   * @return string numero do endereco da conta
   */
  public function getNumero(){
  	return $this->numero;
  }
  
  /**
   * Pega o saldo da conta
   * @return float saldo da conta
   */
  public function getSaldo(){
  	return $this->saldo;
  }
  
  /**
   * Pega o data de abertura da conta
   * @return string data de abertura da conta
   */
  public function getDataAbertura(){
  	return implode('/',array_reverse(explode('-',$this->data_abertura)));
  }
  
  /**
   * Seta o cliente da conta
   * @param $value integer id_cliente do cliente
   */
  public function setCliente($value){
  	$value = (int) $value;
    $cliente = new Cliente();
    $cliente->carregar($value);
    $this->cliente = $cliente;
  }
  
  /**
   * Seta a agencia da conta
   * @param $value string agencia da conta
   */
  public function setAgencia($value){
  	$value = (string) $value;
    $this->agencia = $value;

  }
  
  /**
   * Seta numero da conta
   * @param $value string numero da conta
   */
  public function setNumero($value) {
    $value = (string) $value;
    $this->numero = $value;

  }
  
  /**
   * Seta o saldo da conta
   * @param $value float saldo da conta
   */
  public function setSaldo($value){
  	$value = (float) $value;
    $this->saldo = $value;
  }
  
  /**
   * Seta o data de abertura da conta
   * @param $value string data de abertura da conta
   */
  public function setDataAbertura($value = '01/01/1900'){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->data_abertura = implode('-',array_reverse(explode('/',$value)));
    } else {
      throw new Exception('data_abertura deve ser string');
    }
  }
  
  public abstract function depositar($value);
  
  public abstract function retirar($value);
  
  public abstract function cadastrar();
  
}





?>