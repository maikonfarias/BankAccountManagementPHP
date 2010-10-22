<?php
include_once 'classes/class.Conta.php';

/**
 * classe para manipular contas conrrentes, herdada da classe conta
 * $ID$
 */
class ContaCorrente extends Conta{
  
  /**
   * @var float limite da conta
   */
  private $limite;

  /**
   * construtor da classe Conta
   * seta os valores padroes dos campos
   */	
  function __construct(){
    parent::__construct();
    $this->limite = 0.00;
  }
  

  /**
   * Pega i id da conta corrente
   * @return integer id da conta corrente
   */
  public function getIdContaCorrente(){
  	return $this->id_conta;
  }
  
  /**
   * Pega a limite da conta
   * @return float agencia da conta
   */
  public function getLimite(){
  	return $this->limite;
  }
  
  /**
   * Seta id da conta corrente
   * @param $value integer id da conta corrente
   */
  public function setIdContaCorrente($value) {
    $value = (int) $value;
    if ($value > 0) {
      $this->id_conta = $value;
    } else {
      throw new Exception('id_ccorrente deve ser inteiro maior que 0');
    }
  }
  
  /**
   * Seta limite da conta
   * @param $value float numero da conta
   */
  public function setLimite($value) {
    $value = (float) $value;
    $this->limite = $value;

  }
  
  /**
   * Metodo para movimentar o saldo das contas correntes
   *
   */
  public function movimentar($value){
    $value = (float) $value;
    $this->saldo += $value;
    
    $oConn = new DB();
    
    $sSQL = 'UPDATE ccorrente SET saldo = '.$this->saldo . ' WHERE id_ccorrente = '.$this->id_conta;
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error().$sSQL);
    }
  }

  /**
   * Metodo para depositar saldo das contas correntes
   *
   */
  public function depositar($value){
    $this->movimentar($value);
  }
  
  /**
   * Metodo para retirar saldo das contas correntes
   *
   */
  public function retirar($value){
    if (($this->saldo - $value) < (0 - $this->limite)) {
      throw new Exception('Limite de credito excedido!');
    }
    $this->movimentar(0-$value);
  }
  
  /**
   * Metodo para cadastrar contas correntes
   *
   */
  public function cadastrar(){
    $oConn = new DB();
    
    $sSQLId = 'SELECT MAX(id_ccorrente) as id_ccorrente FROM ccorrente';
    $resId = $oConn->query($sSQLId);
    $oResId = mysql_fetch_object($resId);
    
    //força o numero a ficar int e incrementa em 1
    $this->id_conta = ($oResId->id_ccorrente * 1) + 1;
    
    $sSQL = "
      INSERT INTO ccorrente (id_ccorrente, id_cliente, agencia, numero, saldo, data_abertura, limite) 
			VALUES (".$this->id_conta.", ".$this->cliente->getIdCliente().", '".$this->agencia."', '".$this->numero."', '".$this->saldo."', '".$this->data_abertura."','".$this->limite."')
    ";
    
    $res = $oConn->query($sSQL);
    
    if ($res) {
      return true;
    } else {
      throw new Exception('ERRO DE SQL: '.mysql_error().$sSQL);
    }
  }
  
  /**
   * Metodo estatico para listar as contas correntes em array
   * @return array contas conrrentes
   */
  public static function listar($sWhere = '') {
    $sSQL = 'SELECT id_ccorrente, id_cliente, agencia, numero, saldo, data_abertura, limite FROM ccorrente';
    if (!empty($sWhere)) {
      $sSQL .= ' WHERE '.$sWhere;
    }
    $sSQL .= ' ORDER BY id_ccorrente ASC';
    $oConn = new DB();
    $res = $oConn->query($sSQL);
    
    $aContas = array();
    
    while ($oRes = mysql_fetch_object($res)) {
      $conta = new self();
      $conta->setIdContaCorrente($oRes->id_ccorrente);
      $conta->setCliente        ($oRes->id_cliente);
      $conta->setAgencia        ($oRes->agencia);
      $conta->setNumero         ($oRes->numero);
      $conta->setSaldo          ($oRes->saldo);
      $conta->setDataAbertura   ($oRes->data_abertura);
      $conta->setLimite         ($oRes->limite);
      $aContas[] = $conta;
    }
    
    return $aContas;
  }
  
}





?>