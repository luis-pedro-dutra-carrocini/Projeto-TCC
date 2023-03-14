<?php
session_start();
if(!isset($_SESSION["senha_adm"]))
{
  header('location: index.php');
}
else
{
}

include_once ('conexao.php');
$codquestao = $_GET['codigo'];
$sql = mysqli_query($conexao, "SELECT * FROM tab_questoes WHERE codigo_questao = '$codquestao';");
$dado = $sql->fetch_array();

?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<body style="background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));">
<link rel="stylesheet" type="text/css"  href="estilo_adm.css" />
<title> Alterar Questão </title>

<header>
<div>
<img src="img/logo_exemplo.png" style="position: absolute;  width: 98px; heigth: 50px; top: 0px; bottom: 0px; left: 0px; border: 1px solid black;">
  </div>

<font face="arial black">
<div class="altdados_adm">
<h2>Alterar dados Questão</h2>
</div>
</font>

<form action="" class="form_sair">
<input type="text" value="<?php echo "ADM: ".$_SESSION["nome_adm"]; ?>" style="width: 115px; background-color:#778899;" readonly>
&nbsp;&nbsp;
  <input type="submit" onclick="sair()" value="Sair" id="btn_sair" name="btn_sair" class="btn_sair">
</form>
</header>
<br><br>

<script>
    function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

function voltar() {
      location.href='mostrar_questoes.php';
}
</script>

<font color="black" size="4">
<div id="area">

<form action="" method="POST" enctype="multipart/form-data">  
<fieldset>  
<legend style="color:grey31; font-size:25px; font-weight: bold;">Dados Questão</legend>
<b>Questão:</b>
<br>
<textarea cols="135" rows="10" name="txtquestao" value="text" required><?php $dado["texto_questao"] ?></textarea>
<br><br>

<div>
<b>Ano do Vestibulinho:</b>
<input type="int" name="numano" placeholder="2001" style="width: 55px;" required>
&nbsp;&nbsp;&nbsp;
<b>Opção Correta:</b>
<select name="txtrespostacorreta">
                    <option value="Letra A">Letra A</option>
                    <option value="Letra B">Letra B</option>
                    <option value="Letra C">Letra C</option>
                    <option value="Letra D">Letra D</option>
					<option value="Letra E">Letra E</option>
                </select>
</div>
<br>

<b>Respostas:</b>
<br><br>
<input type="radio" name="chenimgoutex"  id="restex" value="restex" checked >
<label for="chenimg">Texto</label>
<input type="radio" name="chenimgoutex" id="resimg" value="resimg">
<label for="chenimg">Imagem</label>
<br><br>

<script>
var chetex = document.querySelector("#restex");
chetex.addEventListener("click", function() {
divrestext.style.display = "block"; 
divresimg.style.display = "none"; 
});

var cheimg = document.querySelector("#resimg");
cheimg.addEventListener("click", function() {
divrestext.style.display = "none"; 
divresimg.style.display = "block"; 
});
</script>

<div id="divrestext">
<label style="left:40px; margin-right:5px;">Letra A:</label> <input type="text" name="txtletraa" style="width: 900px;" id="txtletraa">
<br><br>
<label style="left:40px; margin-right:5px;">Letra B:</label> <input type="text" name="txtletrab" style="width: 900px;" id="txtletrab">
<br><br>
<label style="left:40px; margin-right:5px;">Letra C:</label> <input type="text" name="txtletrac" style="width: 900px;" id="txtletrac">
<br><br>
<label style="left:40px; margin-right:5px;">Letra D:</label> <input type="text" name="txtletrad" style="width: 900px;" id="txtletrad">
<br><br>
<label style="left:40px; margin-right:5px;">Letra E:</label> <input type="text" name="txtletrae" style="width: 900px;" id="txtletrae">
<br><br>
</div>

<div id="divresimg" style="display: none;">
<label style="left:40px; margin-right:5px;">Letra A:</label><input type="file" name="resimga" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra B:</label><input type="file" name="resimgb" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra C:</label><input type="file" name="resimgc" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra D:</label><input type="file" name="resimgd" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra E:</label><input type="file" name="resimge" style="font-size:15px">
<br><br>
</div>

<b>Possui imagem?</b>
<br>
<input type="radio" name="chepimg"  id="spimg" value="spimg">
<label for="chepimg">Sim</label>
<input type="radio" name="chepimg" id="npimg" value="npimg" checked>
<label for="chepimg">Não</label>
<br><br>

<script>
var spimg = document.querySelector("#spimg");
spimg.addEventListener("click", function() { 
divimgques.style.display = "block"; 
});

var npimg = document.querySelector("#npimg");
npimg.addEventListener("click", function() { 
divimgques.style.display = "none"; 
});
</script>

<div id="divimgques" style="display: none;">
<input type="file" name="arquivo" style="font-size:15px">
</div>

<br><br>

<input type="submit" name="adcionarquestao"  value="Adicionar" style="width: 100px; height: 30px; background-color:green; color:white; font-size:15px; font-weight: bold;">    
<input type="reset" name="limpar" value="Limpar" style="width: 100px; height: 30px; background-color:white; color:green; font-size:15px; font-weight: bold;">    
<button onclick="voltar()" style="text-align: rigth; width: 100px; height: 30px; border: 1px solid #080000; background-color: FireBrick; color:white; font-size: 15px; font-weight: bold;">Cancelar</button>
 
</fieldset>
</form>
</div>
</font>
</body>
</html>