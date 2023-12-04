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
	$script = "<script>alert('Erro: Usuário Banido.');location.href='usuario_banido.php?email=$email';</script>";
	echo $script;
	exit;
}
else{

// verificando se o email existe no bd
if(mysqli_num_rows($verificarusu)<1) { 
	
	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: E-Mail, não cadastrado.');location.href='login.php';</script>";
	echo $script;
}
else
{

	// verificando se a senha esta correta
    if ($dado["senha"] != $_POST['senha']){
		
		// Emitindo mensagem de erro
		$script = "<script>alert('Erro: senha Incorreta.');location.href='login.php';</script>";
		echo $script;
	}
	else
	{

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
	$script = "<script>alert('Erro: E-Mail, não cadastrado.');location.href='login.php';</script>";
	echo $script;
}

else{

	// Verificando se a senha esta correta
	if ($dado["senha"] != $_POST['senha'])
	{
		
		// Emitindo mensagem de erro
		$script = "<script>alert('Erro: senha Incorreta.');location.href='login.php';</script>";
		echo $script;
	}else{

	// Iniciando sessão
	session_start();

	// Criando nome na sessão
	$_SESSION["nome_adm"]= $dado["nome"];

	// Criando senha na sessão
	$_SESSION["senha_adm"]= $_POST['senha'];

	// Abrindo a pagina de professores
	header('location: pagina_adm.php');
	exit;
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

<!-- Buscando informações no arquivo CSS -->
<link rel="stylesheet" href="style.css">

<!-- link para mostrar senha -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<title>Login</title>

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
document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>";
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
<body style="background-color: LightBlue;">

<!-- Imagem login -->
  <div class="container-login" style="align-items: center;">
     <div  class="img-box" style="height: 95%; width: 50%; align-items: center;">
	 <center>
	   <img src="img/login.svg">
	</center>
	 </div>

	 <!-- Titulo login -->
	 <div class="content-box">

	 <!-- Divi caracteristicas form -->
	   <div class="form-box">
	   <center><h1><font color="black"><b>LOGIN</b></font></h1></center>
	   <BR><BR>
		 <form method="POST" action="" name="f1">

		 <!-- Campo email -->
		   <div class="input-box">
		     <span>E-Mail</span><br>
			 <input type="email" style="width: 100%;" name="email" placeholder="@gmail.com" id="email" maxlength="256" autofocus onblur="validacaoEmail(f1.email)" required>
			 <input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
		    </div>

			<!-- DIV mensagem email invalido ou valido -->
			<div id="msgemail" style="text-align: center;"></div>
			<br><br>
			
			<!-- Campo senha -->
			<div class="input-box">
			  <span>Senha</span><br>
			  <input type="password" style="width: 80%;"  name="senha" id="senha" placeholder="Senha" maxlength="50" required>
			  &nbsp; 
			  <i class="bi bi-eye-fill" id="mos_senha" title='Mostrar Senha' onclick="mos_senha()"></i>
			</div>
			<br>
			
			<!-- Link esqueceu sua senha -->
			<div class="remember">
			  <a href="esqueceu_senha.php">Esqueceu a Senha?</a>
			</div>
			
			<!-- Checkboxs Usuário ou ADM -->
			<div class="remember">
			  <input type="radio" name="radadus" value="usuario" checked>Aluno<br>
			  <input type="radio" name="radadus" value="ADM">Professor<br>
			</div>
			
			<!-- Botão entrar -->
			<div class="input-box">
			  <input type="submit" style="width: 100%;" name="submitentrar" value="Entrar">
			</div>
			<br>
			
			<!-- Link cadastrar-se -->
			<div class="input-box">
			  <p>Não é cadastrado? <a href="pagina_inscrever-se.php">Cadastrar-se</a></p>
			</div>
		 </form>
	 </div>
  </div>

<!-- Fechando tags em aberto -->
</body>
</html>