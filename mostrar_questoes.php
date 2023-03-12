<?php
session_start();
include('conexao.php');

$consulta = mysqli_query($conexao,"select * from tab_questoes");

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
<title>Visualizar Questões</title>
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

<font size="2">
<center>
<table border="4" bordercolor="LightSlateGray" style="background-color:DarkTurquoise;">
<tr bgcolor="LightSeaGreen" align="center">
<td>Código Questão</td>
<td>Questão</td>
<td>Ano do Vestibular</td>
<td>Resposta Correta</td>
<td>Resposta A</td>
<td>Resposta B</td>
<td>Resposta C</td>
<td>Resposta D</td>
<td>Resposta E</td>
<td>Nome Imagem</td>
</tr>
<?php while ($dado=$consulta->fetch_array()) {?> 
<tr>
<td align="center"><?php echo $dado["codigo_questao"];?></td>
<td><?php echo $dado["texto_questao"];?></td>
<td><?php echo $dado["ano_vestibular"];?></td>
<td><?php echo $dado["resposta_correta"];?></td>
<td><?php echo $dado["resposta_a"];?></td>
<td><?php echo $dado["resposta_b"];?></td>
<td><?php echo $dado["resposta_c"];?></td>
<td><?php echo $dado["resposta_d"];?></td>
<td><?php echo $dado["resposta_e"];?></td>
<td><?php echo $dado["nome_imagem"];?></td>
</tr>
<?php }?>
</table>
</center>





</bodY>
</html>