<?php
error_reporting(E_ALL);
//classe para manipular os clientes
include 'classes/class.Cliente.php';

//classes para manipular as contas
include 'classes/class.ContaCorrente.php';
include 'classes/class.ContaPoupanca.php';
?>
<html>
  <head>
    <title>Movimentos</title>
  </head>
  <body>
    <h1>Movimentos</h1>
    <?php
    include 'msg.php';
    ?>
    <fieldset style="width:500px">
      <form action="movimentos_action.php" method="post">
        <table border="0" width="100%">
          <tr style="background: aaa">
            <td colspan="2" align="center"><b>Movimentos</b></td>
          </tr>
          <tr>
            <td align="right">Tipo:</td>
            <td> 
              <select name="tp_conta">
                <option value="cc">Conta corrente</option>
                <option value="cp">Conta poupança</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">Agencia:</td>
            <td><input name="agencia" size="5" /></td>
          </tr>
          <tr>
            <td align="right">Numero da Conta:</td>
            <td><input name="numero" size="10" /></td>
          </tr>
          <tr>
            <td align="right">Movimento:</td>
            <td>
              <select name="movimento">
                <option value="deposito">Deposito</option>
                <option value="retirada">Retirada</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">Valor:</td>
            <td><input name="valor" size="10" value="0.00" /></td>
          </tr>
          <tr>
            <td align="center" colspan="2">
              <input type="reset" value="Limpar" />
              <input type="submit" value="Avançar" />
            </td>
          </tr>
        </table>
      </form>
    </fieldset>
  </body>
</html>
