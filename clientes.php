<?php
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
            <td align="right">Endereço:</td>
            <td><input name="endereco" size="30" /></td>
          </tr>
          <tr>
            <td align="right">Numero:</td>
            <td><input name="numero" size="5" />&nbsp;CEP:&nbsp;<input name="cep" size="10" /></td>
          </tr>
          </tr>
          <tr>
            <td align="right">Data de Nascimento:</td>
            <td><input name="data_nascimento" size="10" value="00/00/0000" /> <font size="2">formato: 00/00/0000</font></td>
          </tr>
          </tr>
          <tr>
            <td align="right">CPF:</td>
            <td><input name="cpf" size="18" /></td>
          </tr>
          </tr>
          <tr>
            <td align="right">RG:</td>
            <td><input name="rg" size="15" /></td>
          </tr>
          <tr>
            <td align="center" colspan="2">
              <input type="reset" value="Limpar" />
              <input type="submit" value="Cadastrar" onclick="return confirm('Verifique os dados antes de continuar')" />
            </td>
          </tr>
        </table>
      </form>
    </fieldset>
    <br />
    <fieldset style="width:800px">
      <table width="100%">
        <tr bgcolor="gray">
          <td colspan="9" align="center"><b>Lista de clientes</b></td>
        </tr>
        <tr style="font-weight:bold">
          <td>id</td>
          <td>Nome</td>
          <td>Endereço</td>
          <td>Número</td>
          <td>CEP</td>
          <td>Data Nasc.</td>
          <td>CPF</td>
          <td>RG</td>
          <td width="1">Excluir</td>
        </tr>
        <?php
          $aClientes = Cliente::listar();
        ?>
      </table>
    </fieldset>
  </body>
</html>
