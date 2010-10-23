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
    <title>Cadastro de Contas</title>
  </head>
  <body>
    <h1>Cadastro de Contas</h1>
    <?php
    include 'msg.php';
    ?>
    <fieldset style="width:500px">
      <form action="contas_action.php" method="post">
        <table border="0" width="100%">
          <tr style="background: aaa">
            <td colspan="2" align="center"><b>Abertura de conta</b></td>
          </tr>
          <tr>
            <td align="right">Cliente</td>
            <td>
              <select name="id_cliente">
                <option value="">Escolha um cliente</option>
                <?php
                $aClientes = Cliente::listar();
                foreach($aClientes as $cliente){
                ?>
                <option value="<?php echo $cliente->getIdCliente() ?>"><?php echo $cliente->getNome() ?></option>
                <?php
                }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">Tipo de conta:</td>
            <td>
              <select name="tp_conta" onchange="
                if(this.value == 'cc') {
                  document.getElementById('tdCampo').innerHTML = 'Limite: R$';
                  document.getElementById('inputCampo').value = '0.00';
                } else {
                  document.getElementById('tdCampo').innerHTML = 'Data de Aniversario';
                  document.getElementById('inputCampo').value = '22/10/2010';
                }
              ">
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
            <td align="right">Numero da conta:</td>
            <td><input name="numero" size="20" /></td>
          </tr>
          <tr>
            <td align="right">Saldo inicial: R$</td>
            <td><input name="saldo" size="10" value="0.00" />
          </tr>
          <tr>
            <td id="tdCampo" align="right">Limite: R$</td>
            <td><input id="inputCampo" name="campo" size="10" value="0.00" /></td>
          </tr>
          <tr>
            <td align="right">Data de abertura:</td>
            <td><input name="data_abertura" size="15" readonly value="<?php echo @date('d/m/Y') ?>" /></td>
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
        <tr style="background: aaa">
          <td colspan="10" align="center"><b>Lista de contas correntes</b></td>
        </tr>
        <tr style="font-weight:bold">
          <td>id</td>
          <td>Nome cliente</td>
          <td>Agencia</td>
          <td>Número da conta</td>
          <td>Saldo</td>
          <td>Limite</td>
          <td>Data de abertura</td>
          <td width="1">&nbsp;</td>
        </tr>
        <?php
          $aCc = ContaCorrente::listar();
          $corFundo = '';
          if(count($aCc) == 0){
          ?>
        <tr style="background: ddd">
          <td colspan="10" align="center"><b>Não há registros</b></td>
        </tr>
          <?php
          } else
          foreach ($aCc as $cc) {
            $corFundo = ($corFundo == 'ddd')? 'fff' : 'ddd';
            ?>
        <tr style="background: <?php echo $corFundo;?>">
          <td><?php echo $cc->getIdContaCorrente();?></td>
          <td><?php echo $cc->cliente->getNome();?></td>
          <td><?php echo $cc->getAgencia();?></td>
          <td><?php echo $cc->getNumero();?></td>
          <td><?php echo $cc->getSaldo();?></td>
          <td><?php echo $cc->getLimite();?></td>
          <td><?php echo $cc->getDataAbertura();?></td>
          <td width="1"><a href="#contas_action.php?excluir=<?php echo $cc->getIdContaCorrente(); ?>">Excluir</a></td>
        </tr>
            <?php
          }
        ?>
      </table>
    </fieldset>

    <fieldset style="width:800px">
      <table width="100%" cellspacing=0>
        <tr style="background: aaa">
          <td colspan="10" align="center"><b>Lista de contas poupança</b></td>
        </tr>
        <tr style="font-weight:bold">
          <td>id</td>
          <td>Nome cliente</td>
          <td>Agencia</td>
          <td>Número da conta</td>
          <td>Saldo</td>
          <td>Data de Aniversario</td>
          <td>Data de abertura</td>
          <td width="1">&nbsp;</td>
        </tr>
        <?php
          $aCp = ContaPoupanca::listar();
          $corFundo = '';
          if(count($aCp) == 0){
          ?>
        <tr style="background: ddd">
          <td colspan="10" align="center"><b>Não há registros</b></td>
        </tr>
          <?php
          } else
          foreach ($aCp as $cp) {
            $corFundo = ($corFundo == 'ddd')? 'fff' : 'ddd';
            ?>
        <tr style="background: <?php echo $corFundo;?>">
          <td><?php echo $cp->getIdContaPoupanca();?></td>
          <td><?php echo $cp->cliente->getNome();?></td>
          <td><?php echo $cp->getAgencia();?></td>
          <td><?php echo $cp->getNumero();?></td>
          <td><?php echo $cp->getSaldo();?></td>
          <td><?php echo $cp->getDataAniversario();?></td>
          <td><?php echo $cp->getDataAbertura();?></td>
          <td width="1"><a href="#contas_action.php?excluir=<?php echo $cp->getIdContaPoupanca(); ?>">Excluir</a></td>
        </tr>
            <?php
          }
        ?>
      </table>
    </fieldset>
  </body>
</html>
