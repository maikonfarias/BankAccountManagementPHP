<?php
//classe para manipular as contas
include_once 'classes/class.ContaCorrente.php';
include_once 'classes/class.ContaPoupanca.php';

if (!empty($_POST['tp_conta']) && $_POST['tp_conta'] == 'cc') {
  $oCc = new ContaCorrente();
  $oCc->setCliente        ($_POST['id_cliente']);
  $oCc->setAgencia        ($_POST['agencia']);
  $oCc->setNumero         ($_POST['numero']);
  $oCc->setDataAbertura   ($_POST['data_abertura']);
  $oCc->setLimite         ($_POST['campo']);
  $oCc->setSaldo          ($_POST['saldo']);
  $oCc->cadastrar();
  header('Location: contas.php?msg=Conta Corrente cadastrada com sucesso!');
  die;
}
if (!empty($_GET['excluir'])) {
  $oCc = new ContaCorrente();
  $oCc->setIdContaCorrente($_GET['excluir']);
  $oCc->remover();
  header('Location: contas.php?msg=Conta Corrente excluida com sucesso!');
  die;
}

if (!empty($_POST['tp_conta']) && $_POST['tp_conta'] == 'cp') {
  $oCc = new ContaPoupanca();
  $oCc->setCliente        ($_POST['id_cliente']);
  $oCc->setAgencia        ($_POST['agencia']);
  $oCc->setNumero         ($_POST['numero']);
  $oCc->setDataAbertura   ($_POST['data_abertura']);
  $oCc->setDataAniversario($_POST['campo']);
  $oCc->setSaldo          ($_POST['saldo']);
  $oCc->cadastrar();
  header('Location: contas.php?msg=Conta Poupança cadastrada com sucesso!');
  die;
}
if (!empty($_GET['excluir'])) {
  $oCc = new ContaPoupanca();
  $oCc->setIdContaPoupanca($_GET['excluir']);
  $oCc->remover();
  header('Location: contas.php?msg=Conta Poupança excluida cadastrada com sucesso!');
  die;
}
header('Location: contas.php');
?>