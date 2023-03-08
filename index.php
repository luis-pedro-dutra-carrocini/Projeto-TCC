<?php
if(isset($_POST["submitentrar"]))
{
include_once ('conexao.php');
$escolharad = $_POST['radadus'];
$email = $_POST['email'];

if($escolharad == "usuario")
{
$verificarusu = mysqli_query($conexao, "SELECT * FROM tab_usuarios WHERE email_usuario = '$email';");
$dado=$verificarusu->fetch_array();

if(mysqli_num_rows($verificarusu)<1) 
{ 
echo "ERRO: Usuário não cadastrado!!!";
}
else
{
    if ($dado["senha_usuario"] != $_POST['senha'])
	{
	echo "ERRO: Senha Incorreta!!!";
	}
	else
	{
    session_start();
	$_SESSION["nome_usuario"]= $dado["nome_usuario"];
	$_SESSION["senha_usuario"]= $_POST['senha'];
	header('location: pagina_usuarios.php');
	exit;
	}
}
}

else if($escolharad == "ADM")
{
$verificaradm = mysqli_query($conexao, "SELECT * FROM tab_adms WHERE email_adm = '$email';");
$dado=$verificaradm->fetch_array();

if(mysqli_num_rows($verificaradm)<1) 
{ 
echo "ERRO: ADM não cadastrado!!!";
}

else
{
	if ($dado["senha_adm"] != $_POST['senha'])
	{
	echo "ERRO: Senha Incorreta!!!";
	}
	else
	{
	session_start();
	$_SESSION["nome_adm"]= $dado["nome_adm"];
	$_SESSION["senha_adm"]= $_POST['senha'];
	header('location: pagina_adm.php');
	exit;
	}
}
}
}

?>


<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatoble" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!Link CSS>
  <link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>
  <div class="container-login">
     <div  class="img-box">
	   <img src="img/login.svg">
	 </div>
	 <div class="content-box">
	   <div class="form-box">
	     <h2>Login</h2>
		 <form method="POST">
		   <div class="input-box">
		     <span>E-Mail</span>
			 <input type="email" name="email" placeholder="@gmail.com" required>
		    </div>
			<br>
			
			<div class="input-box">
			  <span>Senha</span>
			  <input type="password" name="senha" placeholder="Senha" required>
			</div>
			<br>
			
			<div class="remember">
			  <a href="#">Esqueceu a Senha?</a>
			</div>
			
			<div class="remember">
			  <input type="radio" name="radadus" value="usuario" checked>Entrar como Usuário<br>
			  <input type="radio" name="radadus" value="ADM">Entrar como ADM<br>
			</div>
			
			<div class="input-box">
			  <input type="submit" name="submitentrar" value="Entrar">
			</div>
			
			<div class="input-box">
			  <p>Não é cadastrado? <a href="pagina_inscrever-se.php">Inscrever-se</a></p>
			</div>
		 </form>
	 </div>
  </div>

</body>
</html>