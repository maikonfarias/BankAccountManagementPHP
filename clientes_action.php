<?php
//classe para manipular os clientes
include_once 'classes/class.Cliente.php';

if (!empty($_POST['nome'])) {
  $cliente = new Cliente();
  $cliente->setNome           ($_POST['nome']);
  $cliente->setLogradouro     ($_POST['logradouro']);
  $cliente->setNumero         ($_POST['numero']);
  $cliente->setCep            ($_POST['cep']);
  $cliente->setCidade         ($_POST['cidade']);
  $cliente->setDataNascimento ($_POST['data_nascimento']);
  $cliente->setCpf            ($_POST['cpf']);
  $cliente->setRg             ($_POST['rg']);
  $cliente->cadastrar();
  header('Location: clientes.php?msg=Cliente cadastrado com sucesso!');
  die;
}
if (!empty($_GET['excluir'])) {
  $cliente = new Cliente();
  $cliente->setIdCliente($_GET['excluir']);
  $cliente->remover();
  header('Location: clientes.php?msg=Cliente excluído com sucesso!');
  die;
}
header('Location: clientes.php');