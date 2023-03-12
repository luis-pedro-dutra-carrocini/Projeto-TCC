<?php
session_start();
if(isset($_POST["btn_adicionaradm"]))
{
        include_once('conexao.php');
        $adiemail_adm = $_POST['adiemail_adm'];
        $adinome_adm = $_POST['adinome_adm'];
        $adisenha_adm = $_POST['adisenha_adm'];
        $sql = mysqli_query($conexao, "SELECT * FROM tab_adms WHERE email_adm = '$adiemail_adm';");
        $sql2 = mysqli_query($conexao, "SELECT * FROM tab_adms WHERE nome_adm = '$adinome_adm';");
        $emailex = mysqli_num_rows($sql);
        $nomeex = mysqli_num_rows($sql2);
        $emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if($emailvalouinv == "Inválido"){
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. E-Mail Inválido.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        elseif($emailvalouinv == "Válido"){
        if($emailex>0) {
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. E-Mail já utilizado.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        elseif($nomeex>0){
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Nome de ADM já utilizado.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        else
        {
          if ($_POST['adinome_adm'] == "")
          {
            $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Nome ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
            echo $script;
          }
            else
            {
              if ($_POST['adisenha_adm'] == ""){
                $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Senha ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
                echo $script;
              }
              else
              {
                $adicionar = mysqli_query($conexao, "insert into tab_adms(email_adm, nome_adm,senha_adm) values('$adiemail_adm','$adinome_adm','$adisenha_adm');");
                $script = "<script>alert('ADM ". $adinome_adm ." adicionado com Sucesso!!!');location.href='adicionar_adm.php';</script>";
                echo $script;
              }
            }
        }
      }
    
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
?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>Adicionar ADM</title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<link rel="stylesheet" type="text/css"  href="estilo_adm.css" />
<header>

<style>
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            padding: 10px;
            text-align: left;
            border-radius: 8px;
            font-size: 19px;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 17px;
            width: 100%;
            letter-spacing: 2px;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
    </style>

<script language="Javascript">
function validacaoEmail(field) {
usuario = field.value.substring(0, field.value.indexOf("@"));
dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

if ((usuario.length >=1) &&
    (dominio.length >=3) &&
    (usuario.search("@")==-1) &&
    (dominio.search("@")==-1) &&
    (usuario.search(" ")==-1) &&
    (dominio.search(" ")==-1) &&
    (dominio.search(".")!=-1) &&
    (dominio.indexOf(".") >=1)&&
    (dominio.lastIndexOf(".") < dominio.length - 1)) {
      document.getElementById("msgemail").innerHTML="";
      var emailvalouinv = 'Válido';
      document.getElementById("emailvalouinv").value = emailvalouinv;
}
else{
document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>";
var emailvalouinv = 'Inválido';
document.getElementById("emailvalouinv").value = emailvalouinv;
}
}

function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
  }

    function voltar() {
  var resultadovoltar = confirm("Cancelar cadastro?")
    if (resultadovoltar == true) {
      location.href='pagina_adm.php';
    }
}
</script>

  <div>
<img src="img/logo_exemplo.png" style="position: absolute;  width: 98px; heigth: 50px; top: 0px; bottom: 0px; left: 0px; border: 1px solid black;">
  </div>

<font face="arial black">
<div class="adidados_adm">
<h2>Adicionar ADM</h2>
</div>
</font>

<form action="" class="form_sair">
<input type="text" value="<?php echo "ADM: ".$_SESSION["nome_adm"]; ?>" style="width: 115px; background-color:#778899;" readonly>
&nbsp;&nbsp;
  <input type="submit" onclick="sair()" value="Sair" id="btn_sair" name="btn_sair" class="btn_sair">
</form>
</header>
<br><br><br><br>

<body style="background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));">

<center>
<div class="box">
<form method="POST" name="f1">
<fieldset  style="text-align: left;">
<legend style="color:grey31; font-size:25px; font-weight: bold;">Dados</legend>
<br><br>
<label for="adiemail_adm" style="font-size:17px; text-align: left; color: dodgerblue;" required>E-Mail</label><br>
<input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
<input type="email" name="adiemail_adm" id="adiemail_adm" class="inputUser" style="width: 300px; font-size:20px;" autofocus onblur="validacaoEmail(f1.adiemail_adm)"  maxlength="256">
<div id="msgemail" style="text-align: center;"></div>
<br><br><br>

<label for="nome_adm" style="font-size:17px; text-align: left; color: dodgerblue;" required>Nome</label><br>
<input type="text" name="adinome_adm" id="adinome_adm" class="inputUser" style="width: 300px; font-size:20px;" maxlength="50">
<br><br><br>

<label for="senha_adm" style="font-size:17px; text-align: left; color: dodgerblue;" required>Senha</label><br>
<input type="password" name="adisenha_adm" id="senha_adm" class="inputUser" style="width: 190px; font-size:20px;" maxlength="16">
<br><br><br>

<div>   
<button type="submit" id="btn_adicionaradm" name="btn_adicionaradm" class="btn_adicionaradm" style="width: 50%;" data-toggle="tooltip" data-placement="top" title="Adicionar"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>
<button type="button" id="btn_canadiadm" name="btn_canadiadm" onclick="voltar()" class="btn_canadiadm" style="width: 47%;" data-toggle="tooltip" data-placement="top" title="Cancelar"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>
</fieldset>
</form>
</div>
</div>
</center>

</body>
</html>