<?php
session_start();
include('conexao.php');

$consulta = mysqli_query($conexao,"select * from tab_usuarios");

if(!isset($_SESSION["senha_adm"]))
{
  header('location: index.php');
  exit;
}
else
{
    $nome = $_SESSION["nome_adm"];
}

?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>Visualizar Usuários</title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<body background="img_fundo/fundo_pagadm.png">
<link rel="stylesheet" type="text/css"  href="estilo_adms.css" />
<header>

<script>
    function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}
</script>

<div>
<img src="img/logo_exemplo.png" style="position: absolute;  width: 98px; heigth: 50px; top: 0px; bottom: 0px; left: 0px; border: 1px solid black;">
  </div>

<font face="arial black">
<div class="altdados_adm">
<h2>Usuários Cadastrados</h2>
</div>
</font>

<form action="" class="form_sair">
<input type="text" value="<?php echo "ADM: ".$_SESSION["nome_adm"]; ?>" style="width: 115px; background-color:#778899;" readonly>
&nbsp;&nbsp;
  <input type="submit" onclick="sair()" value="Sair" id="btn_sair" name="btn_sair" class="btn_sair">
</form>
</header>
<br><br><br><br>

<center>
<table cellpadding="6" border="4" bordercolor="DarkBlue" style="background-color:DodgerBlue;">
<tr height ="35" bgcolor="RoyalBlue">
<td><b>Nome</b></td>
<td><b>E-Mail</b></td>
<td align="center"><b>Alterar / Excluir<b></td>
</tr>
<?php while ($dado=$consulta->fetch_array()) {?> 
<tr>
<td height ="35"><?php echo $dado["nome_usuario"];?></td>
<td height ="35"><?php echo $dado["email_usuario"];?></td>
<td height ="35">
<div>
&nbsp;&nbsp;
<a href='' title='Alterar'><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></a>
&nbsp;&nbsp;
<a href="deletar_usuario.php?id=$dado['nome_usuario']" title='Excluir'><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></a>
&nbsp;&nbsp;
</div>
</td>
</tr>
<?php }?>
</table>
</center>





</bodY>
</html>