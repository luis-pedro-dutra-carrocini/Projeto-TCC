<!-- Iniciando PHP -->
<?php

// Quando clicar no botão cadastar-se
if(isset($_POST["submitincrever-se"])){

// Verificando se o email é válido ou não
$emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);  

// Se for inválido
if($emailvalouinv == "Inválido"){
    
	// Emitindo mensagem de erro
    $script = "<script>alert('Erro: Não foi possivel cadastrar-se. E-Mail Inválido.');location.href='alterar_dadosadm.php';</script>";
    echo $script;
}

// Se for válido
elseif($emailvalouinv == "Válido"){

// Conectando com o banco de dados
include_once ('conexao.php');

// Obtendo dados do form
// Email
$email = $_POST['email'];

// Nome
$nome = $_POST['nome'];

// Senha
$senha = $_POST['senha'];

// Senha confirmada
$comsenha = $_POST['comsenha'];

// Data de Nascimento
$dtnasc = $_POST['dtnasc'];

// Verificando se email exist na tabela usuarios banidos
$verificarusuban_email = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE email = '".addslashes($email)."';");
$verificarusuban_nome = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE nome = '".addslashes($nome)."';");

// Cerificando se esse email não esta banido
if(mysqli_num_rows($verificarusuban_email)>0){

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: Usuário Banido.');location.href='usuario_banido.php?email=$email';</script>";
	echo $script;
}

// Cerificando se esse nome não esta banido
elseif(mysqli_num_rows($verificarusuban_nome)>0){

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: Usuário Banido.');location.href='usuario_banido.php?nome=$nome';</script>";
	echo $script;
}
else{

// Verificando se o email e o nome já existem
$verificaemailusu = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE email = '".addslashes($email)."';");
$verificanomeusu = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '".addslashes($nome)."';");

// Verificando se o email ja existe
if(mysqli_num_rows($verificaemailusu)>0) 
{ 

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: E-Mail já Cadastrado.');location.href='pagina_inscrever-se.php';</script>";
	echo $script;
}

// Verificando se o nome já existe
elseif(mysqli_num_rows($verificanomeusu)>0)
{

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro:  Nome já Cadastrado.');location.href='pagina_inscrever-se.php';</script>";
	echo $script;
}

// Verificando se a senha de confirmção é igual a senha 
elseif ($senha != $comsenha)
{

	// Emitindo mensagem de erro
	$script = "<script>alert('Erro: Senha de Confirmação deve ser igual à Senha.');location.href='pagina_inscrever-se.php';</script>";
	echo $script;
}
else
{

// Verificando se o tipo de usuario é aluno ou professor
if (isset($_POST['radadus'])){

// Se for usuario
if ($_POST['radadus'] == "usuario"){

// Criptografando a senha
$senha = password_hash($senha, PASSWORD_DEFAULT);

// Inserindo dados na tabela usuarios
$result = mysqli_query($conexao, "INSERT into tabela_usuario (email, nome, senha, pontuacao, data_nascimento, precisao, media_tempo) values ('".addslashes($email)."','".addslashes($nome)."','".addslashes($senha)."',0, '$dtnasc',0,0);");

// Iniciando sessão
session_start();

// Criando email na sessão
$_SESSION["email_cad"] = $email;

// Criando nome na sessão
$_SESSION["nome_cad"] = $nome;

// // Criando senha na sessão
$_SESSION["senha_cad"] = $senha;

// Abrindo a pagina usuarios
header ('location: pagina_usuarios.php');
exit;

// Se for professor
}elseif ($_POST['radadus'] == "ADM"){
// Criptografando a senha
$senha = password_hash($senha, PASSWORD_DEFAULT);

// Inserindo dados na tabela adms
$result = mysqli_query($conexao, "INSERT into tabela_adm (email, nome, senha, nivel) values ('".addslashes($email)."','".addslashes($nome)."','".addslashes($senha)."','professor');");

// Iniciando sessão
session_start();

// Criando email na sessão
$_SESSION["nome_adm"]= $nome;

// Criando nome na sessão
$_SESSION["senha_adm"]= $_POST['senha'];

// Abrindo pagina de professores
header ('location: pagina_adm.php');
exit;
}
}else{

	// Continuando na pagina de cadastro
	header ('location: pagina_inscrever-se.php');
	exit;
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

<!-- Definind um icone para a pagina -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- Buscando informações no arquivo CSS -->
<link rel="stylesheet" href="style.css">

<!-- link para mostrar senha -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<title>Cadastra-se</title>

<!-- Iniciando Java -->
<script language="Javascript">

// Função para validar o email -->
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


// função para quando clicar no btn mostrar a senha ou esconde-la 1 -->
function mos_senha1() {
	var inputpass = document.getElementById('senha')
	var btnmossenha = document.getElementById('mos_senha1')

	if (inputpass.type === "password"){
		inputpass.setAttribute('type', 'text')
		btnmossenha.classList.replace('bi-eye-fill', 'bi-eye-slash-fill')
	}
	else{
		inputpass.setAttribute('type', 'password')
		btnmossenha.classList.replace('bi-eye-slash-fill', 'bi-eye-fill')
	}
	
}

// função para quando clicar no btn mostrar a senha ou esconde-la 2 -->
function mos_senha2() {
	var inputpass = document.getElementById('comsenha')
	var btnmossenha = document.getElementById('mos_senha2')

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

<!-- Iniciando java -->
<script>

// função para entrar na página cadastrar-se -->
function cadastrar() {
      location.href='pagina_inscrever-se.php';
}


// Fução para entar na pagina de login -->
function login() {
      location.href='login.php';
}

// Função para abrir a pagina gerar simulado personalizado
function simusim() {
      location.href='gerar_simusim.php';
}

// Função para abrir a pagina gerar simulado personalizado
function simucom() {
      location.href='gerar_simucom.php';
}

</script>

<br>

<!-- Inserindo inputs no form -->
<body style="background-color: black;">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- link para mostrar senha -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<br>

<div class="container" >
<article class="card-body mx-auto" style="max-width: 400px; background-color: #363636;">
	<h4 class="card-title mt-3 text-center" style="color:white;">CADASTRAR-SE</h4>
	<br>
	<form method="POST" action="" name="f1">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="nome" maxlength="50" placeholder="Nome" required class="form-control" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" autofocus placeholder="Nome" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input class="form-control" placeholder="E-Mail" type="email" name="email" id="email" onblur="validacaoEmail(f1.email)" maxlength="256" required>
<input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
    </div>
			<div id="msgemail" style="text-align: center;"></div>
			<br>
    <div class="form-group input-group">
        <div class="input-group-prepend">
		    <span class="input-group-text"> <i>Dt. Nascimento</i> </span>
		 </div>
		 <input type="date" class="form-control" name ="dtnasc" required>
    </div>
    
    <br>
 <!-- form-group end.// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Senha" maxlength="50" name="senha" id="senha" type="password" required>
        &nbsp;
		<span class="input-group-text" style="background-color: #363636; border:none;"><i class="bi bi-eye-fill" id="mos_senha1" style="color:#6495ED" title='Mostrar Senha' onclick="mos_senha1()"></i></span>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Repitir Senha" maxlength="50" name="comsenha" id="comsenha" type="password" required>
        &nbsp;
		<span class="input-group-text" style="background-color: #363636; border:none;"><i class="bi bi-eye-fill" style="color:#6495ED" id="mos_senha1" title='Mostrar Senha' onclick="mos_senha2()"></i></span>
    </div> <!-- form-group// -->     

	<div class="form-group">
	<font color="white">
	<input type="radio" name="radadus" value="usuario" checked> Aluno &nbsp;&nbsp;
	<input type="radio" name="radadus" value="ADM"> Professor<br> 
  </div>

  <div class="form-group">
  <input type="checkbox" name="chepp" value="usuario" required>
	Concordo com os termos da <a href="politica_provacidade.php">Política de Provacidade</a>
  </div>

    <div class="form-group">
    <input type="submit" name="submitincrever-se" class="btn btn-primary btn-block" value="Cadastrar-se">
    </div> <!-- form-group// -->      
    <p class="text-center">Já é Cadastrado? <a href="login.php">Entrar</a> </p>       
</font>                                                          
</form>
</article>
</div> 
<br><br>
<!-- Fechando tags em aberto -->
</body>
</html>