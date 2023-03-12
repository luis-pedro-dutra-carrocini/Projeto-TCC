<?php
if(isset($_POST["submitincrever-se"]))
{
include_once ('conexao.php');
$email = $_POST['email'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$comsenha = $_POST['comsenha'];

$verificaemailusu = mysqli_query($conexao, "SELECT * FROM tab_usuarios WHERE email_usuario = '$email';");
$verificanomeusu = mysqli_query($conexao, "SELECT * FROM tab_usuarios WHERE nome_usuario = '$nome';");

if(mysqli_num_rows($verificaemailusu)>0) 
{ 
echo "ERRO: E-Mail de Usuário já Cadastrado!!!";
}
else if(mysqli_num_rows($verificanomeusu)>0)
{
echo "ERRO: Nome de Usuário já Usado!!!";
}
else if ($senha != $comsenha)
{
echo "ERRO: Senha de Confirmação deve ser igual à Senha!!!";
}
else
{
$result = mysqli_query($conexao, "insert into tab_usuarios (email_usuario, nome_usuario, senha_usuario, pontuacao_usuario, porcentagemdeacerto_usuario) values ('$email','$nome','$senha',0,'0');");
session_start();
$_SESSION["email_cad"] = $email;
$_SESSION["nome_cad"] = $nome;
$_SESSION["senha_cad"] = $senha;
header ('location: pagina_usuarios.php');
exit;
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
  <title>Inscrever-se</title>
</head>
<body>
  <div class="container-login">
     <div  class="img-box">
	   <img src="img/increver-se.jpg">
	 </div>
	 <div class="content-box">
	   <div class="form-box">
	     <h2>Inscrever-se</h2>
		 <form method="POST" action="">
		   <div class="input-box">
		     <span>E-Mail</span>
			 <input type="email" name="email" placeholder="@gmail.com" autofocus required>
		    </div>
			<br>
			
			<div class="input-box">
		     <span>Nome Usuário</span>
			 <input type="text" name="nome" placeholder="Nome" required>
		    </div>
			<br><br>
			
			<div class="input-box">
			  <span>Senha</span>
			  <input type="password" name="senha" placeholder="Senha" required>
			</div>
			<br>
			
			<div class="input-box">
			  <span>Confirmar Senha</span>
			  <input type="password" name="comsenha" placeholder="Senha" required>
			</div>
			<br>

			<div class="input-box">
			  <input type="submit" name="submitincrever-se" value="Inscrever-se">
			</div>
		 </form>
	 </div>
  </div>

</body>
</html>