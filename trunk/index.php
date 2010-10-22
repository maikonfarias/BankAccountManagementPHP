<?php
error_reporting(E_ALL);
include_once 'classes/class.DB.php';
include_once 'classes/class.ContaCorrente.php';
try{
  $oConn = new DB();
} catch(Exception $e) {
  echo 'ERRO: ' . $e->getMessage();
  die;
}
echo '<title>Conta Bancaria</title>';
echo 'Conectado ao '.$oConn->getTipoBanco().'!<br>';

/*$res = $oConn->query("SELECT 'query ok' as teste");
$oRes = pg_fetch_object($res);
echo $oRes->teste.'<br><br>';*/

?>

<a href="clientes.php" target="tela">Clientes</a>
<a href="contas.php" target="tela">Contas</a>
<a href="movimentos.php" target="tela">Movimentos</a>
<br>
<iframe style="width:100%;height:100%; border:0;" name="tela"></frame>