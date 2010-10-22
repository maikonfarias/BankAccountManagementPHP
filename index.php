<?php
include 'classes/class.DB.php';
try{
  $conn = new DB();
} catch(Exception $e) {
  echo 'ERRO: ' . $e->getMessage();
  die;
}
echo '<title>Conta Bancaria</title>';
echo 'Conectado!<br><br>';

$res = $conn->query("SELECT '321etset' as teste");
$oRes = mysql_fetch_object($res);
echo $oRes->teste;

