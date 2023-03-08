<?php
session_start();
if(isset($_POST["btn_cancelaraadm"]))
{
  header('location: pagina_adm.php');
  exit;
}

if(isset($_POST["btn_alteraadm"]))
{
    include_once('conexao.php');
    $nome = $_SESSION["nome_adm"];
    $novonome = $_POST['nome_adm'];
    $novasenha = $_POST['senha_adm'];
    $novoemail = $_POST['email_adm'];
    $aleterar = mysqli_query($conexao, "UPDATE tab_adms SET nome_adm='$novonome', email_adm='$novoemail', senha_adm='$novasenha' WHERE nome_adm='$nome';");
    $_SESSION["nome_adm"]= $novonome;
    $_SESSION["senha_adm"]= $novasenha;
    header('location: pagina_adm.php');
    exit;
}

if(!isset($_SESSION["senha_adm"]))
{
  header('location: index.php');
  exit;
}
else
{
    $nome = $_SESSION["nome_adm"];
    include_once('conexao.php');
    $dados = mysqli_query($conexao, "SELECT * FROM tab_adms WHERE nome_adm = '$nome';");
    $dado=$dados->fetch_array();
}

if ($_POST){
  $nome2 = filter_input(INPUT_POST, 'campo1', FILTER_SANITIZE_SPECIAL_CHARS);
  if ($nome2 == "True"){
    $dados = mysqli_query($conexao, "DELETE FROM tab_adms WHERE nome_adm = '$nome';");
    header('location: index.php');
    session_destroy();
  }
  else{
    header('location: alterar_dadosadm.php');
  }
  }

?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>Alterar dados ADM</title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<link rel="stylesheet" type="text/css"  href="estilo_adms.css" />
<header>

<body background="img_fundo/fundo_pagadm.png">
<script>
  function excluirconta() {
    var resultado = confirm("Deseja Realmente Excluir essa Conta?")
    if (resultado == true) {
        alert("A conta foi Excluida com Sucesso!!!")
        var confexc = "True"
    }
        else{
          var confexc = "False"
        }
    document.getElementById("nome2").value = confexc
}

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
<h2>Alterar dados do ADM</h2>
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
<form method="POST" class="formdados" id="formteste">
<legend style="color:grey31; font-size:25px; font-weight: bold;">Dados</legend>
<br><br>
<label for="email_adm" style="font-size:20px; font-weight: bold; text-align: left;">E-Mail</label>
<input type="email" name="email_adm" id="email_adm" style="width: 300px; font-size:20px;" value="<?php echo $dado['email_adm']; ?>">
<br><br><br>

<label for="nome_adm" style="font-size:20px; font-weight: bold; text-align: left;">Nome</label>
<input type="text" name="nome_adm" id="nome_adm" style="width: 300px; font-size:20px;" value="<?php echo $nome; ?>">
<br><br><br>

<label for="senha_adm" style="font-size:20px; font-weight: bold; text-align: left;">Senha</label>
<input type="text" name="senha_adm" id="senha_adm" style="width: 190px; font-size:20px;" value="<?php echo $dado['senha_adm']; ?>">
<br><br><br>

<div>   
<button type="submit" id="btn_alteraadm" name="btn_alteraadm" class="btn_alteraadm" data-toggle="tooltip" data-placement="top" title="Alterar"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" id="btn_cancelaraadm" name="btn_cancelaraadm" class="btn_cancelaraadm" data-toggle="tooltip" data-placement="top" title="Cancelar"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" value="" id="nome2" name="campo1">   
<button onclick="excluirconta()" class="btn_excluiradm" data-toggle="tooltip" data-placement="top" title="Excluir conta"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>   
</form>
</div>
</center>

</body>
</html>