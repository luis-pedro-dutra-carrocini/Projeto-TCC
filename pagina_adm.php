<?php
session_start();
if(!isset($_SESSION["senha_adm"]))
{
  header('location: index.php');
}
else
{
}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<meta charset="UTF-8"> 
<title>ADM</title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<link rel="stylesheet" type="text/css"  href="estilo_adm.css" />
<header>

<body style="background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));"> 
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
<div class="center_adm">
<h2>Administrador</h2>
</div>
</font>

<form action="" class="form_sair">
  <input type="text" value="<?php echo "ADM: ".$_SESSION["nome_adm"]; ?>" style="width: 115px; background-color:#778899;" readonly>
&nbsp;&nbsp;
  <input type="submit" onclick="sair()" value="Sair" id="btn_sair" name="btn_sair" class="btn_sair">
</form>
</header>
<br><br><br>

<div id="botao">

<form action="mostrar_usuarios.php" class="formbtns">
<button type="submit" id="btn_visusuarios" name="btn_visusuarios" class="btn_visusuarios"><img src="img/img_exemple.png" height ="40px" width="40px" style="position: absolute; top: 15%; left: 2%;">&nbsp;&nbsp;&nbsp;<b>Visualizar Usuários</b></button>
</form>

<form action="mostrar_questoes.php" class="formbtns">
<button type="submit" id="btn_visquestoes" name="btn_visquestoes" class="btn_visquestoes"><img src="img/imgbtn_visquestao2.png" height ="40px" width="40px" style="position: absolute; top: 15%; left: 2%;">&nbsp;&nbsp;&nbsp;<b>Visualizar Questões</b></button>
</form>

<form action="adicionar_adm.php" class="formbtns">
<button type="submit" id="btn_adiadm" name="btn_adiadm" class="btn_adiadm"><img src="img/img_exemple.png" height ="40px" width="40px" style="position: absolute; top: 15%; left: 2%;">&nbsp;&nbsp;&nbsp;<b>Adcionar ADM</b></button>
</form>

<form action="alterar_dadosadm.php" class="formbtns">
<button type="submit" id="btn_altdados" name="btn_altdados" class="btn_altsenha"><img src="img/img_exemple.png" height ="40px" width="40px" style="position: absolute; top: 15%; left: 2%;">&nbsp;&nbsp;&nbsp;<b>Alterar Dados</b></button>
</form>
</div>



</body>
</html>