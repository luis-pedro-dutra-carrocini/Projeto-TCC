<?php
session_start();
include('conexao.php');

$consulta = mysqli_query($conexao,"select * from tab_usuarios");

if(!isset($_SESSION["senha_adm"]))
{
  header('location: index.php');
  exit;
}
else
{
    $nome = $_SESSION["nome_adm"];
}

?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>Visualizar Usuários</title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<body style="background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));">
<link rel="stylesheet" type="text/css"  href="estilo_adm.css" />
<header>

<script>
    function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

function voltar() {
      location.href='pagina_adm.php';
}
</script>

<div>
<img src="img/logo_exemplo.png" style="position: absolute;  width: 98px; heigth: 50px; top: 0px; bottom: 0px; left: 0px; border: 1px solid black;">
  </div>

<font face="arial black">
<div class="altdados_adm">
<h2>Usuários Cadastrados</h2>
</div>
</font>

<form action="" class="form_sair">
<input type="text" value="<?php echo "ADM: ".$_SESSION["nome_adm"]; ?>" style="width: 115px; background-color:#778899;" readonly>
&nbsp;&nbsp;
  <input type="submit" onclick="sair()" value="Sair" id="btn_sair" name="btn_sair" class="btn_sair">
</form>
</header>
<div style='text-align:right'>
<button onclick="voltar()" style="text-align: rigth; width: 80px; height: 30px; border: 1px solid #080000; background-color: CadetBlue; font-size: 15px;">Voltar</button>
</div>
<br><br><br><br>

<center>
<table cellpadding="6" border="4" bordercolor="DarkBlue" style="background-color:DodgerBlue;">
<tr height ="35" bgcolor="RoyalBlue">
<td><b>Nome</b></td>
<td><b>E-Mail</b></td>
<td align="center"><b>Alterar / Excluir<b></td>
</tr>
<?php while ($dado=$consulta->fetch_array()) { 
echo "<tr>";
echo "<td height ='35'>".$dado['nome_usuario']."</td>";
echo "<td height ='35'>".$dado['email_usuario']."</td>";
echo "<td height ='35'>
<div>
&nbsp;&nbsp;
<a href='alterar_usuario.php?nome=$dado[nome_usuario]' title='Alterar'><img src='img/img_exemple.png' height ='30px' width='30px' align='center'></a>
&nbsp;&nbsp;
<a href='deletar_usuario.php?nome=$dado[nome_usuario]' title='Excluir'><img src='img/img_exemple.png' height ='30px' width='30px' align='center'></a>
&nbsp;&nbsp;
</div>
</td>";
echo "</tr>";
}
?>

</table>
</center>
</bodY>
</html>