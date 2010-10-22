<?php
include_once 'classes/class.Conta.php';

/**
 * classe para manipular contas poupancas, herdada da classe conta
 * $ID$
 */
class ContaPoupanca extends Conta{
  
  /**
   * @var string data de aniversario da conta
   */
  private $data_aniversario;

  /**
   * construtor da classe Conta
   * seta os valores padroes dos campos
   */	
  function __construct(){
    parent::__construct();
    $this->data_aniversario = '2010-10-22';
  }
  

  /**
   * Pega o id da conta poupanca
   * @return integer id da conta poupanca
   */
  public function getIdContaPoupanca(){
  	return $this->id_conta;
  }
  
  /**
   * Pega o data de aniversario da conta
   * @return string data de aniversario da conta
   */
  public function getDataAniversario(){
  	return implode('/',array_reverse(explode('-',$this->data_aniversario)));
  }
  
  /**
   * Seta id da conta poupanca
   * @param $value integer id da conta poupanca
   */
  public function setIdContaPoupanca($value) {
    $value = (int) $value;
    if ($value > 0) {
      $this->id_conta = $value;
    } else {
      throw new Exception('id_cpoupanca deve ser inteiro maior que 0');
    }
  }
  
  /**
   * Seta o data de aniversario da conta
   * @param $value string data de aniversario da conta
   */
  public function setDataAniversario($value = '01/01/1900'){
  	$value = (string) $value;
    if (!empty($value)) {
      $this->data_aniversario = implode('-',array_reverse(explode('/',$value)));
    } else {
      throw new Exception('data_aniversario deve ser string');
    }
  }
  
  /**
   * Metodo para movimentar o saldo das contas poupancas
   *
   */
  public function movimentar($value){
    $value = (float) $value;
    $this->saldo += $value;
    
    $oConn = new DB();
    
    $sSQL = 'UPDATE cpoupanca SET saldo = '.$this->saldo . ' WHERE id_cpoupanca = '.$this->id_conta;
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error().$sSQL);
    }
  }

  /**
   * Metodo para depositar saldo das contas poupancas
   *
   */
  public function depositar($value){
    $this->movimentar($value);
  }
  
  /**
   * Metodo para retirar saldo das contas poupancas
   *
   */
  public function retirar($value){
    if (($this->saldo - $value) < (0)) {
      throw new Exception('Saldo não suficiente!');
    }
    $this->movimentar(0-$value);
  }
  
  /**
   * Metodo para cadastrar contas poupancas
   *
   */
  public function cadastrar(){
    $oConn = new DB();
    
    $sSQLId = 'SELECT MAX(id_cpoupanca) as id_cpoupanca FROM cpoupanca';
    $resId = $oConn->query($sSQLId);
    $oResId = pg_fetch_object($resId);
    
    //força o numero a ficar int e incrementa em 1
    $this->id_conta = ($oResId->id_cpoupanca * 1) + 1;
    
    $sSQL = "
      INSERT INTO cpoupanca (id_cpoupanca, id_cliente, agencia, numero, saldo, data_abertura, data_aniversario) 
			VALUES (".$this->id_conta.", ".$this->cliente->getIdCliente().", '".$this->agencia."', '".$this->numero."', '".$this->saldo."', '".$this->data_abertura."','".$this->data_aniversario."')
    ";
    
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error().$sSQL);
    }
  }
  
  /**
   * Metodo estatico para listar as contas poupancas em array
   * @return array contas poupancas
   */
  public static function listar($sWhere = '') {
    $sSQL = 'SELECT id_cpoupanca, id_cliente, agencia, numero, saldo, data_abertura, data_aniversario FROM cpoupanca';
    if (!empty($sWhere)) {
      $sSQL .= ' WHERE '.$sWhere;
    }
    $sSQL .= ' ORDER BY id_cpoupanca ASC';
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    $aContas = array();
    
    while ($oRes = pg_fetch_object($res)) {
      $conta = new self();
      $conta->setIdContaPoupanca($oRes->id_cpoupanca);
      $conta->setCliente        ($oRes->id_cliente);
      $conta->setAgencia        ($oRes->agencia);
      $conta->setNumero         ($oRes->numero);
      $conta->setSaldo          ($oRes->saldo);
      $conta->setDataAniversario($oRes->data_aniversario);
      $conta->setDataAbertura   ($oRes->data_abertura);
      $aContas[] = $conta;
    }
    
    return $aContas;
  }
  
}





?>