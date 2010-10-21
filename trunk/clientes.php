<?php 
error_reporting(E_ALL);
//classe para manipular os clientes
include 'classes/class.Cliente.php';
?>
<html>
  <head>
    <title>Cadastro de Clientes</title>
  </head>
  <body>
    <h1>Cadastro de Clientes</h1>
    <fieldset style="width:500px">
      <form action="clientes_action.php" method="post">
        <table border="0" width="100%">
          <tr bgcolor="gray">
            <td colspan="2" align="center"><b>Inserir novo cliente</b></td>
          </tr>
          <tr>
            <td align="right">Nome:</td>
            <td><input name="nome" /></td>
          </tr>
          <tr>
            <td align="right">Logradouro:</td>
            <td><input name="logradouro" size="30" /></td>
          </tr>
          <tr>
            <td align="right">Numero:</td>
            <td><input name="numero" size="5" />&nbsp;CEP:&nbsp;<input name="cep" size="10" /></td>
          </tr>
          <tr>
            <td align="right">Cidade:</td>
            <td><input name="cidade" size="20" /></td>
          </tr>
          <tr>
            <td align="right">Data de Nascimento:</td>
            <td><input name="data_nascimento" size="10" value="01/01/1900" /> <font size="2">formato: 00/00/0000</font></td>
          </tr>
          <tr>
            <td align="right">CPF:</td>
            <td><input name="cpf" size="18" /></td>
          </tr>
          <tr>
            <td align="right">RG:</td>
            <td><input name="rg" size="15" /></td>
          </tr>
          <tr>
            <td align="center" colspan="2">
              <input type="reset" value="Limpar" />
              <input type="submit" value="Cadastrar" />
            </td>
          </tr>
        </table>
      </form>
    </fieldset>
    <br />
    <fieldset style="width:800px">
      <table width="100%" cellspacing=0>
        <tr bgcolor="gray">
          <td colspan="10" align="center"><b>Lista de clientes</b></td>
        </tr>
        <tr style="font-weight:bold">
          <td>id</td>
          <td>Nome</td>
          <td>Logradouro</td>
          <td>Número</td>
          <td>CEP</td>
          <td>Cidade</td>
          <td>Data Nasc.</td>
          <td>CPF</td>
          <td>RG</td>
          <td width="1">&nbsp;</td>
        </tr>
        <?php
          $aClientes = Cliente::listar();
          $corFundo = '';
          foreach ($aClientes as $cliente) {
            $corFundo = ($corFundo == 'ddd')? 'fff' : 'ddd';
            ?>
        <tr style="background: <?php echo $corFundo;?>">
          <td><?php echo $cliente->getIdCliente();?></td>
          <td><?php echo $cliente->getNome();?></td>
          <td><?php echo $cliente->getLogradouro();?></td>
          <td><?php echo $cliente->getNumero();?></td>
          <td><?php echo $cliente->getCep();?></td>
          <td><?php echo $cliente->getCidade();?></td>
          <td><?php echo $cliente->getDataNascimento();?></td>
          <td><?php echo $cliente->getCpf();?></td>
          <td><?php echo $cliente->getRg();?></td>
          <td width="1"><a href="clientes_action.php?excluir=<?php echo $cliente->getIdCliente(); ?>">Excluir</a></td>
        </tr>
            <?php
          }
        ?>
      </table>
    </fieldset>
  </body>
</html>
