<?php
//classe para manipular as contas
include_once 'classes/class.ContaCorrente.php';
include_once 'classes/class.ContaPoupanca.php';

if (!empty($_POST['tp_conta']) && $_POST['tp_conta'] == 'cc') {
  if(empty($_POST['tp_conta']) || empty($_POST['agencia']) || empty($_POST['numero']) || empty($_POST['movimento']) || empty($_POST['valor'])) {
    header('Location: movimentos.php?erro=Todos os campos são obrigatórios!');
    die;
  }
  $aContas = ContaCorrente::listar("agencia = '".$_POST['agencia']."' AND numero = '".$_POST['numero']."'");
  if(count($aContas) == 0){
    header('Location: movimentos.php?aviso=Conta não encontrada');
    die;
  }
  
  $cc = $aContas[0];
  if ($_POST['movimento'] == 'retirada') {
    try{
      $cc->retirar($_POST['valor']);
    } catch(Exception $e) {
      header('Location: movimentos.php?erro='.$e->getMessage());
      die;
    }
  } else {
    $cc->depositar($_POST['valor']);
  }
  header('Location: movimentos.php?msg=Movimento concluído com sucesso!');
  die;
}

if (!empty($_POST['tp_conta']) && $_POST['tp_conta'] == 'cp') {
  if(empty($_POST['tp_conta']) || empty($_POST['agencia']) || empty($_POST['numero']) || empty($_POST['movimento']) || empty($_POST['valor'])) {
    header('Location: movimentos.php?erro=Todos os campos são obrigatórios!');
    die;
  }
  $aContas = ContaPoupanca::listar("agencia = '".$_POST['agencia']."' AND numero = '".$_POST['numero']."'");
  if(count($aContas) == 0){
    header('Location: movimentos.php?aviso=Conta não encontrada');
    die;
  }
  
  $cc = $aContas[0];
  if ($_POST['movimento'] == 'retirada') {
    try{
      $cc->retirar($_POST['valor']);
    } catch(Exception $e) {
      header('Location: movimentos.php?erro='.$e->getMessage());
      die;
    }
  } else {
    $cc->depositar($_POST['valor']);
  }
  header('Location: movimentos.php?msg=Movimento concluído com sucesso!');
  die;
}
header('Location: movimentos.php');
?>