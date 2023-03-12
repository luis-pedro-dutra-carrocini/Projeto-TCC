<?php
session_start();
include('conexao.php');

$consulta = mysqli_query($conexao,"select * from tab_questoes");

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
<title>Visualizar Questões</title>
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
<h2>Questões Cadastradas</h2>
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
<br><br>

</header>
<form action="adicionar_questao.php" class="formbtns">
<button type="submit" id="btn_adinoquestao" name="btn_adinoquestao" class="btn_adiquestao"><img src="img/img_exemple.png" height ="40px" width="40px" style="position: absolute; top: 15%; left: 2%;">&nbsp;&nbsp;&nbsp;<b>Cadastra nova Questão</b></button>
</form>
<br>

<font size="2">
<center>
<table border="4" cellpadding="5" bordercolor="LightSlateGray" style="background-color:DarkTurquoise;">
<tr bgcolor="LightSeaGreen" align="center">
<td>Código Questão</td>
<td>Questão</td>
<td>Ano do Vestibular</td>
<td>Resposta Correta</td>
<td>Resposta A</td>
<td>Resposta B</td>
<td>Resposta C</td>
<td>Resposta D</td>
<td>Resposta E</td>
<td>Nome Imagem</td>
<td align="center"><b>Alterar / Excluir<b></td>
</tr>
<?php while ($dado=$consulta->fetch_array()) { 
echo "<tr>";
echo "<td align='center'>".$dado["codigo_questao"]."</td>";
echo "<td>".$dado["texto_questao"]."</td>";
echo "<td>".$dado["ano_vestibular"]."</td>";
echo "<td>".$dado["resposta_correta"]."</td>";
echo "<td>".$dado["resposta_a"]."</td>";
echo "<td>".$dado["resposta_b"]."</td>";
echo "<td>".$dado["resposta_c"]."</td>";
echo "<td>".$dado["resposta_d"]."</td>";
echo "<td>".$dado["resposta_e"]."</td>";
echo "<td>".$dado["nome_imagem"]."</td>";
echo "<td align='center' height ='35'>
<div>
<a href='alterar_questao.php?codigo=$dado[codigo_questao]' title='Alterar'><img src='img/img_exemple.png' height ='30px' width='30px' align='center'></a>
<br><br><br>
<a href='deletar_questao.php?codigo=$dado[codigo_questao]' title='Excluir'><img src='img/img_exemple.png' height ='30px' width='30px' align='center'></a>
</div>
</td>";
echo "</tr>";
}?>
</table>
</center>





</bodY>
</html>