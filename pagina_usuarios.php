<?php
session_start();
if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"]))
{
  header('location: index.php');
  exit;
}
else
{
}

?>

<html>
<head>
  <meta charset="UTF-8">  
  <title>Usuário</title>
  <link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
</head>
<body>
<?php 
if (isset($_SESSION["nome_cad"]))
{
  echo "Usuário cadastrado com sucesso!!!";
  echo "<br>";
  echo "Usuário: ".$_SESSION["nome_cad"];
}
else
{
  echo "Usuário: ".$_SESSION["nome_usuario"];
}
?>
<br>
<a href="sair.php">Sair</a>
</body>
</html>