<!-- Iniciando PHP -->
<?php

// Quando clicar no botão entrar
if(isset($_POST["submitentrar"])){

// Conectando com o banco de dados
include_once ('conexao.php');

// Obtendo daos do form
$escolharad = $_POST['radadus'];
$email = $_POST['email'];

// Se o usuario for aluno
if($escolharad == "usuario"){

// Verificando se o email á valido
$emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);

// Se for invalido
if($emailvalouinv == "Inválido"){
	
	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: E-Mail Inválido.');location.href='login.php';</script>";
	echo $script;
}

// Se for válido
elseif($emailvalouinv == "Válido"){

// verificando se o usuario esta banido
$verificarusu = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE email = '".addslashes($email)."';");
$verificarusuban = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE email = '".addslashes($email)."';");
$dado=$verificarusu->fetch_array();

// Certificando se esse email não esta banido
if(mysqli_num_rows($verificarusuban)>0){

	// Mostrando o motivo do banimento
	$script = "<script>alert('Erro: Aluno Banido.');location.href='usuario_banido.php?email=$email';</script>";
	echo $script;
	exit;
}
else{

// verificando se o email existe no bd
if(mysqli_num_rows($verificarusu)<1) { 
	
	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: E-Mail não cadastrado.');location.href='login.php';</script>";
	echo $script;
}
else
{

	// verificando se a senha esta correta
    if (password_verify($_POST['senha'], $dado["senha"])){
		
		// Inicaindo sessão
		session_start();

		// Criando o nome na sessão
		$_SESSION["nome_usuario"]= $dado["nome"];
	
		// Criando senha na sessão
		$_SESSION["senha_usuario"]= $_POST['senha'];
	
		// Abrindo a pagina de usuarios
		header('location: pagina_usuarios.php');
		exit;
	}
	else
	{
		// Emitindo mensagem de erro
		$script = "<script>alert('Erro: Senha Incorreta.');location.href='login.php';</script>";
		echo $script;
	
	}
}
}
}
}

// Se o usuario for prodessor
elseif($escolharad == "ADM"){

// verificando se o email é válido
$emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);

// Se o email for invalido
if($emailvalouinv == "Inválido"){

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: E-Mail Inválido.');location.href='login.php';</script>";
	echo $script;
}

// Se for valido
elseif($emailvalouinv == "Válido"){

// Verificando se o usuario esta banido
$verificaradm = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE email = '".addslashes($email)."';");
$verificaradmban = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE email = '".addslashes($email)."';");
$dado=$verificaradm->fetch_array();

// Certificando se esse email esta banido
if(mysqli_num_rows($verificaradmban)>0){

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: Professor Banido.');location.href='usuario_banido.php?email=$email';</script>";
	echo $script;
	exit;
}
else{

// Verificando se o email existe no bd
if(mysqli_num_rows($verificaradm)<1) 
{ 
	
	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: E-Mail não cadastrado.');location.href='login.php';</script>";
	echo $script;
}

else{

	// verificando se a senha esta correta
    if (password_verify($_POST["senha"], $dado["senha"])){
		
		// Inicaindo sessão
		session_start();

		// Criando o nome na sessão
		$_SESSION["nome_adm"]= $dado["nome"];
	
		// Criando senha na sessão
		$_SESSION["senha_adm"]= $_POST['senha'];
	
		// Abrindo a pagina de adm
		header('location: pagina_adm.php');
		exit;
	}
	else
	{
		// Emitindo mensagem de erro
		$script = "<script>alert('Erro: Senha Incorreta.');location.href='login.php';</script>";
		echo $script;
	
	}
	
}
}
}
}
}

?>

<!-- Iniciando o corpo da página -->
<html>

<!-- Definindo caracteristicas basicas para a pagina -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatoble" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  
<!-- Link CSS>

<!-- Definindo um icone para a pagina -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<style>
	/* Arquivo utlilizado para a pagina de login somente */



.body{

margin: 0;

padding: 0;

box-sizing: border-box;

font-family: Arial, Helvitica, sans-serif;

}



.container-login{

position: relative;

width: 100%;

height: 100%;

display: flex;

}



.img-box{

width: 100%;

height: 600px;

background-color: #5bb4ff;

padding: 20px;

}



.img-box img{

width: 50%;

height: 90%;

}



.content-box{

display: flex;

justify-content: center;

align-items: center;

width: 50%;

height: 100%;

}



.content-box .form-box{

width: 50%;

}



.content-box .form-box .ul{

display: flex;

align-items: center;

justify-content: center;

}



.content-box .form-box .ul li{

list-style: none;

width: 60px;

height: 60px;

display: flex;

justify-content: center;

align-items: center;

border-radius: 50%;

margin:0 7px;

cursor: pointer;

transition: 0.3s;

}



.content-box .form-box .ul li:hover{

background: #e4e4e4;

}



.form-box .ul li img{

width: 40px;

}



.content-box .form-box{

margin-bottom: 20px;

}



.content-box .form-box .input-box input{

width: 100%;

padding: 10px;

outline: none;

font-weight: 400;

border: none;

font-size: 17px;

color: #32324f;

background-color: #ecf2f7;

border-radius: 5px;

}



.content-box .form-box .input-box span{

font-size: 16px;

margin-bottom: 5px;

display: inline-block;

color: #32324f;

font-weight: 400;

}



.content-box .form-box input :placeholder{

color: #a9adb6;

}



.content-box .form-box input[type=submit]{

width: 100%;

background: #0069D9;

color: #fff;

outline: none;

border: none;

font-weight: 500;

cursor: pointer;

font-size: 20px;

transition: 0,3s;

}



.content-box .form-box input[type=email]{

width: 120px;

}



.content-box .form-box input[type=password]{

width: 120px;

}



.content-box .form-box input[type=submit]:hover{

background: #2b7bbc;

}



.content-box .form-box .remember{

margin-bottom: 20px;

color: #32324f;

font-weight: 400;

font-size: 14px;

cursor: pointer;

display: flex;

justify-content: space-between;

}



.content .form-box .remember a{

text-decoration: none;

color: #4aa4ee;

}



.content-box .form-box .remember a:hover{

color: #3286ca;

}



.content-box .form-box .input-box p{

color: #32324f;

}



.content-box .form-box .input-box p a{

color: #4aa4ee;

}



.content-box .form-box .input-box p a:hover{

color: #3286ca;

}



.content-box .form-box h2{

color: #607d8b;

text-decoration: none;

margin: 40px 0 15px;

font-weight: 500;

text-align: center;

font-size: 20px;

}



@media (max-width:868px) {

.container-login .img-box{

	display: none;

}



.container-login .content-box{

	width: 100%;

}

.container-login .content-box .form-box{

	width: 100%;

	padding: 40px;

	background: black;

	margin: 50pz;

}



.container-login .content-box .form-box h3{

	margin: 30px 0 10px;

}

}



@media (max-width:450px) {

.container-login .content-box .form-box .remember{

	flex-wrap: wrap;

}



.container-login .content-box .form-box .remember a{

	margin-top: 20px;

}

}
</style>

<!-- link para mostrar senha -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<title>Login</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- link para mostrar senha -->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<!-- Iniciando Java -->
<script language="Javascript">

// Função para verificar email -->
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
document.getElementById("msgemail").innerHTML="<font color='Crimson'>E-mail inválido </font>";
var emailvalouinv = 'Inválido';
document.getElementById("emailvalouinv").value = emailvalouinv;
}
}


// função para quando clicar no btn mostrar a senha ou escondela -->
function mos_senha() {
	var inputpass = document.getElementById('senha')
	var btnmossenha = document.getElementById('mos_senha')

	if (inputpass.type === "password"){
		inputpass.setAttribute('type', 'text')
		btnmossenha.classList.replace('bi-eye-fill', 'bi-eye-slash-fill')
	}
	else{
		inputpass.setAttribute('type', 'password')
		btnmossenha.classList.replace('bi-eye-slash-fill', 'bi-eye-fill')
	}
	
}

</script>



<!-- Inserindo inputs no form -->
<body style="background-color: black;">

<!-- Imagem login -->
  <div class="container-login" style="align-items: center;">
     <div  class="img-box" style="height: 95%; width: 50%; align-items: center; background-color: #363636;">
	 <center>
	   <img src="img/login.svg">
	</center>
	 </div>

	 <!-- Titulo login -->
	 <div class="content-box">

	 <!-- Divi caracteristicas form -->
	   <div class="form-box">
	   <center><h1><font color="white"><b>LOGIN</b></h1></center>
	   <BR><BR>
		 <form method="POST" action="" name="f1">

		 <!-- Campo email -->
		   <div class="form-group input-group">
		   <div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
			 </div>
        	<input class="form-control" placeholder="E-Mail" type="email" name="email" id="email" onblur="validacaoEmail(f1.email)" maxlength="256" required>
			<input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
    		</div>

			<!-- DIV mensagem email invalido ou valido -->
			<div id="msgemail" style="text-align: center;"></div>
			<br><br>
			
			<!-- Campo senha -->

			<div class="form-group input-group">
    		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
        	<input class="form-control" placeholder="Senha" maxlength="50" name="senha" id="senha" type="password" required>
        	&nbsp;
			<span class="input-group-text" style="background-color: black; border:none;"><i class="bi bi-eye-fill" id="mos_senha" style="color:#6495ED" title='Mostrar Senha' onclick="mos_senha()"></i></span>
    		</div>
			<br>
			
			<!-- Link esqueceu sua senha -->
			<div class="remember">
			  <a href="esqueceu_senha.php"><font color="#6495ED">Esqueceu a Senha?</font></a>
			</div>
			
			<!-- Checkboxs Usuário ou ADM -->
			<div class="remember">
			  <input type="radio" name="radadus" value="usuario" checked ><font color="white">Aluno</font><br>
			  <input type="radio" name="radadus" value="ADM"><font color="white">Professor</font><br>
			</div>
			
			<!-- Botão entrar -->
			<div class="input-box">
			  <input type="submit" class="btn btn-primary btn-block" name="submitentrar" value="Entrar">
			</div>
			<br>
			
			<!-- Link cadastrar-se -->
			<div class="input-box">
			  <p><font color="white">Não é cadastrado? </font><a href="pagina_inscrever-se.php"><font color="#6495ED">Cadastrar-se</a></p>
			</div>
		 </form>
	 </div>
  </div>

<!-- Fechando tags em aberto -->
</body>
</html>