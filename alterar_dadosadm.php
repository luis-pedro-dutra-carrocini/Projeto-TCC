<?php
session_start();
if(isset($_POST["btn_alteraadm"]))
{
    
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
    $email = $dado['email_adm'];
    $senha = $dado['senha_adm'];
}

if ($_POST){
  $confexc = filter_input(INPUT_POST, 'confexc', FILTER_SANITIZE_SPECIAL_CHARS);
  $confalt = filter_input(INPUT_POST, 'confalt', FILTER_SANITIZE_SPECIAL_CHARS);
  if ($confexc == "True"){
    $dados = mysqli_query($conexao, "DELETE FROM tab_adms WHERE nome_adm = '$nome';");
    header('location: index.php');
    session_destroy();
  }
  elseif ($confexc == "False"){
    header('location: alterar_dadosadm.php');
  }
  else{

  }

  if ($confalt == "True"){
    include_once('conexao.php');
    $novonome = $_POST['nome_adm'];
    $novasenha = $_POST['senha_adm'];
    $novoemail = $_POST['email_adm'];
    $sql = mysqli_query($conexao, "SELECT * FROM tab_adms WHERE email_adm = '$novoemail';");
    $sql2 = mysqli_query($conexao, "SELECT * FROM tab_adms WHERE nome_adm = '$novonome';");
    $emailex = mysqli_num_rows($sql);
    $nomeex = mysqli_num_rows($sql2);
    $emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);
        
    if($emailvalouinv == "Inválido"){
      echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erros</title> </html>";
      $script = "<script>alert('Erro: Não foi possivel cadastra ADM. E-Mail Inválido.');location.href='adicionar_adm.php';</script>";
      echo $script;
    }
    elseif($emailvalouinv == "Válido"){
      if($email != $novoemail){
        if($emailex>0) {
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. E-Mail já utilizado.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        elseif($nome != $novonome){
          if($nomeex>0){
            echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
            $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Nome de ADM já utilizado.');location.href='adicionar_adm.php';</script>";
            echo $script;
          }
          elseif ($_POST['nome_adm'] == ""){
            echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
            $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Nome ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
            echo $script;
          }
          elseif ($_POST['senha_adm'] == ""){
            echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
            $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Senha ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
            echo $script;
          }
          else{
          $aleterar = mysqli_query($conexao, "UPDATE tab_adms SET nome_adm='$novonome', email_adm='$novoemail', senha_adm='$novasenha' WHERE nome_adm='$nome';");
          $_SESSION["nome_adm"]= $novonome;
          $_SESSION["senha_adm"]= $novasenha;
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Alterado com Sucesso</title> </html>";
          $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
          echo $script;
          }
        }
        elseif ($_POST['nome_adm'] == ""){
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Nome ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        elseif ($_POST['senha_adm'] == ""){
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Senha ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        else{
        $aleterar = mysqli_query($conexao, "UPDATE tab_adms SET nome_adm='$novonome', email_adm='$novoemail', senha_adm='$novasenha' WHERE nome_adm='$nome';");
        $_SESSION["nome_adm"]= $novonome;
        $_SESSION["senha_adm"]= $novasenha;
        echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Alterado com Sucesso</title> </html>";
        $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
        echo $script;
        }
      }
      elseif($nome != $novonome){
        if($nomeex>0){
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Nome de ADM já utilizado.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        elseif ($_POST['nome_adm'] == ""){
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Nome ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        elseif ($_POST['senha_adm'] == ""){
          echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
          $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Senha ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
          echo $script;
        }
        else{
        $aleterar = mysqli_query($conexao, "UPDATE tab_adms SET nome_adm='$novonome', email_adm='$novoemail', senha_adm='$novasenha' WHERE nome_adm='$nome';");
        $_SESSION["nome_adm"]= $novonome;
        $_SESSION["senha_adm"]= $novasenha;
        echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Alterado com Sucesso</title> </html>";
        $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
        echo $script;
        }
      }
      elseif ($_POST['nome_adm'] == ""){
        echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
        $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Nome ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
        echo $script;
      }
      elseif ($_POST['senha_adm'] == ""){
        echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Erro</title> </html>";
        $script = "<script>alert('Erro: Não foi possivel cadastra ADM. Campo Senha ADM deve ser preenchido.');location.href='adicionar_adm.php';</script>";
        echo $script;
      }
      else{
      $aleterar = mysqli_query($conexao, "UPDATE tab_adms SET nome_adm='$novonome', email_adm='$novoemail', senha_adm='$novasenha' WHERE nome_adm='$nome';");
      $_SESSION["nome_adm"]= $novonome;
      $_SESSION["senha_adm"]= $novasenha;
      echo "<html> <meta charset ='UTF-8'> <link rel='icon' type='image/png' href='img/icone_exemplo.png'/> <title>Alterado com Sucesso</title> </html>";
      $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
      echo $script;
      }
    }
  }
}

?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>Alterar dados ADM</title>
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
    
<body style="background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));">
<script>
  function excluirconta() {
    var resultado = confirm("Deseja Realmente Excluir essa Conta?");
    if (resultado == true) {
        alert("A conta foi Excluida com Sucesso!!!");
        var confexc = "True";
    }
        else{
          var confexc = "False";
        }
    document.getElementById("confexc").value = confexc;
}

function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

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

function voltar() {
  var resultadovoltar = confirm("Cancelar alterações?");
    if (resultadovoltar == true) {
      location.href='pagina_adm.php';
    }
  }

  function alterar() {
    var resultado = confirm("Deseja Realmente alterar esses Dados?");
    if (resultado == true) {
        var confalt = "True";
        document.getElementById("confalt").value = confalt;
    }
        else{
          var confalt = "False";
          document.getElementById("confalt").value = confalt;
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
<div class="box">
<form method="POST" name="f1" >
<fieldset  style="text-align: left;">
<legend style="font-size:25px; font-weight: bold;">Dados</legend>
<br><br>

<label for="email_adm" style="font-size:17px; text-align: left; color: dodgerblue;">E-Mail</label><br>
<input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
<input type="email" name="email_adm" id="email_adm" class="inputUser" style="width: 300px; font-size:20px; text-align: left;" autofocus onblur="validacaoEmail(f1.email_adm)" value="<?php echo $email; ?>">
<br>

<div id="msgemail" style="text-align: center;"></div>
<br><br><br>

<label for="nome_adm" style="font-size:17px; text-align: left; color: dodgerblue;">Nome</label>
<input type="text" name="nome_adm" id="nome_adm" class="inputUser" style="width: 300px; font-size:20px;" value="<?php echo $nome; ?>">
<br><br><br>

<label for="senha_adm" style="font-size:17px; text-align: left; color: dodgerblue;">Senha</label><br>
<input type="text" name="senha_adm" id="senha_adm" class="inputUser" style="width: 190px; font-size:20px;" value="<?php echo $senha; ?>">
<br><br><br>

<div>   
<button type="submit" id="btn_alteraadm" name="btn_alteraadm" onclick="alterar()" class="btn_alteraadm" data-toggle="tooltip" data-placement="top" title="Alterar"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" id="btn_cancelaraadm" name="btn_cancelaraadm" onclick="voltar()" class="btn_cancelaraadm" data-toggle="tooltip" data-placement="top" title="Cancelar"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" value="" id="confexc" name="confexc">   
<input type="hidden" value="" id="confalt" name="confalt">
<button onclick="excluirconta()" class="btn_excluiradm" data-toggle="tooltip" data-placement="top" title="Excluir conta"><img src="img/img_exemple.png" height ="30px" width="30px" align="center"></button>   
</form>
</div>
</div>
</fieldset>
</center>

</body>
</html>