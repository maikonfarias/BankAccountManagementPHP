<?php
if (!empty($_GET['erro']) || !empty($_GET['aviso']) || !empty($_GET['msg'])) {
  if (!empty($_GET['erro'])) {
    $corMsg = 'red';
    $textoMsg = 'ERRO: '.$_GET['erro'];
  } else if (!empty($_GET['aviso'])){
    $corMsg = 'yellow';
    $textoMsg = 'AVISO: '.$_GET['aviso'];
  } else if (!empty($_GET['msg'])){
    $corMsg = 'lightblue';
    $textoMsg = $_GET['msg'];
  }
  ?>
 <fieldset style="width:500px">
  <table border="0" width="100%">
    <tr style="background: <?php echo $corMsg;?>">
      <td colspan="2" align="center"><b><?php echo $textoMsg;?></b></td>
    </tr>
  </table>
</fieldset>
<br>
  <?php
}
?>