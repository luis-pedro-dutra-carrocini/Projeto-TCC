<?php
session_start();
if(!isset($_SESSION["senha_adm"]))
{
  header('location: index.php');
}
else
{
}

if(isset($_POST["adcionarquestao"]))
{

	// Verificando se a questão já esta cadastrada.
	if (isset($_POST["txtquestao"]))	
	{
		include_once ('conexao.php');
		$questao = $_POST['txtquestao'];
		$sql = mysqli_query($conexao, "SELECT * FROM tab_questoes WHERE texto_questao = '$questao';");
		$sql2 = mysqli_num_rows($sql);
		
		if(mysqli_num_rows($sql)>0) 
		{ 
		echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		echo "<center><b>Erro</b></center><br>";
		echo "<font size='4' color='black'>";
		echo "- Questão já Cadastrada";
		echo "</body> </html>";
		echo "<br>";
		echo "<br>";
	    echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		exit();	
		}
	}

	// Verificando se a questão tem imagem.
    $escolha = @$_POST['chepimg'];
    if ($escolha=="spimg"){
	    if (!empty($_FILES['arquivo']['name'])){
		    $nomeimagem = $_FILES['arquivo']['name'];
		    $tipo = $_FILES['arquivo']['type'];
		    $nometemporario = $_FILES['arquivo']['tmp_name'];
		    $tamanho_imagem = $_FILES['arquivo']['size'];
		    $erros = array();
		    $tamanho_maximo = 1024 * 1024 * 5;

			if ($tamanho_imagem > $tamanho_maximo){
				$erros[] = "- Imagem exede o tamanho máximo de 5 MB.<br>";
			}
		
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			if (!in_array ($tipo, $tipospermitidos)){
				$erros[] = "- Tipo de arquivo não permitido.<br>";
			}
		
			if (!empty($erros)) {
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";

				foreach ($erros as $erro)
				{
					echo $erro;
				}

				echo "- Questão NÃO adicionada!!!";
				echo "</body> </html>";
		    	echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		    	exit();
			}
		
			$caminho = "uploads/";
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());
			$novonome = $hoje."-".$nomeimagem;
			
			if (move_uploaded_file($nometemporario, $caminho.$novonome)){
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else{
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- Erro ao Salvar a Imagem!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
	    }
		else{
			$novonome = "Não possui Imagem";
		}
	}  
	else if ($escolha = "npimg"){
		$novonome = "Não possui Imagem";
	}

	$escolhares = @$_POST['chenimgoutex'];

	// Verificando se a resposta é Imagem ou Texto.
    if ($escolhares == "resimg"){
		//Verificando se a imagem A foi selecionada,
		if (!empty($_FILES['resimga']['name'])){
			$nomeimagem = $_FILES['resimga']['name'];
			$tipo = $_FILES['resimga']['type'];
			$nometemporario = $_FILES['resimga']['tmp_name'];
			$tamanho_imagem = $_FILES['resimga']['size'];
			$erros = array();
		
			$tamanho_maximo = 1024 * 1024 * 5;

			if ($tamanho_imagem > $tamanho_maximo){
				$erros[] = "- Imagem da letra A exede o tamanho máximo de 5 MB.<br>";
			}
		
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			if (!in_array ($tipo, $tipospermitidos)){
				$erros[] = "- Tipo de arquivo não permitido na Imagem da letra A.<br>";
			}
		
			if (!empty($erros)) {
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";

				foreach ($erros as $erro)
				{
					echo $erro;
				}

				echo "- Questão NÃO adicionada!!!";
				echo "</body> </html>";
		    	echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		   		exit();
			}
		
			$caminho = "img_res/";
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());
			$nomeimgla = $hoje."-".$nomeimagem;
			
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgla)){
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else{
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- Erro ao Salvar a Imagem!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		else{
			echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    echo "<center><b>Erro</b></center><br>";
		    echo "<font size='4' color='black'>";
		    echo "- Imagem da letra A não selecionada!!!";
		    echo "</body> </html>";
			echo "<br>";
			echo "<br>";
			echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
			exit();
		}
	   
		//Verificando se a imagem B foi selecionada,
		if (!empty($_FILES['resimgb']['name'])){
			$nomeimagem = $_FILES['resimgb']['name'];
			$tipo = $_FILES['resimgb']['type'];
			$nometemporario = $_FILES['resimgb']['tmp_name'];
			$tamanho_imagem = $_FILES['resimgb']['size'];
			$erros = array();
		
			$tamanho_maximo = 1024 * 1024 * 5;

			if ($tamanho_imagem > $tamanho_maximo){
				$erros[] = "- Imagem da letra B exede o tamanho máximo de 5 MB.<br>";
			}
		
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			if (!in_array ($tipo, $tipospermitidos)){
				$erros[] = "- Tipo de arquivo não permitido na Imagem da letra B.<br>";
			}
		
			if (!empty($erros)) {
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";

				foreach ($erros as $erro)
				{
					echo $erro;
				}

				echo "- Questão NÃO adicionada!!!";
				echo "</body> </html>";
		    	echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		   		exit();
			}
		
			$caminho = "img_res/";
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());
			$nomeimglb = $hoje."-".$nomeimagem;
			
			if (move_uploaded_file($nometemporario, $caminho.$nomeimglb)){
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else{
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- Erro ao Salvar a Imagem!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		else{
			echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    echo "<center><b>Erro</b></center><br>";
		    echo "<font size='4' color='black'>";
		    echo "- Imagem da letra B não selecionada!!!";
		    echo "</body> </html>";
			echo "<br>";
			echo "<br>";
			echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
			exit();
		}

		//Verificando se a imagem C foi selecionada,
		if (!empty($_FILES['resimgc']['name'])){
			$nomeimagem = $_FILES['resimgc']['name'];
			$tipo = $_FILES['resimgc']['type'];
			$nometemporario = $_FILES['resimgc']['tmp_name'];
			$tamanho_imagem = $_FILES['resimgc']['size'];
			$erros = array();
		
			$tamanho_maximo = 1024 * 1024 * 5;

			if ($tamanho_imagem > $tamanho_maximo){
				$erros[] = "- Imagem da letra C exede o tamanho máximo de 5 MB.<br>";
			}
		
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			if (!in_array ($tipo, $tipospermitidos)){
				$erros[] = "- Tipo de arquivo não permitido na Imagem da letra C.<br>";
			}
		
			if (!empty($erros)) {
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";

				foreach ($erros as $erro)
				{
					echo $erro;
				}

				echo "- Questão NÃO adicionada!!!";
				echo "</body> </html>";
		    	echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		   		exit();
			}
		
			$caminho = "img_res/";
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());
			$nomeimglc = $hoje."-".$nomeimagem;
			
			if (move_uploaded_file($nometemporario, $caminho.$nomeimglc)){
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else{
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- Erro ao Salvar a Imagem!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		else{
			echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    echo "<center><b>Erro</b></center><br>";
		    echo "<font size='4' color='black'>";
		    echo "- Imagem da letra C não selecionada!!!";
		    echo "</body> </html>";
			echo "<br>";
			echo "<br>";
			echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
			exit();
		}

		//Verificando se a imagem D foi selecionada,
		if (!empty($_FILES['resimgd']['name'])){
			$nomeimagem = $_FILES['resimgd']['name'];
			$tipo = $_FILES['resimgd']['type'];
			$nometemporario = $_FILES['resimgd']['tmp_name'];
			$tamanho_imagem = $_FILES['resimgd']['size'];
			$erros = array();
		
			$tamanho_maximo = 1024 * 1024 * 5;

			if ($tamanho_imagem > $tamanho_maximo){
				$erros[] = "- Imagem da letra D exede o tamanho máximo de 5 MB.<br>";
			}
		
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			if (!in_array ($tipo, $tipospermitidos)){
				$erros[] = "- Tipo de arquivo não permitido na Imagem da letra D.<br>";
			}
		
			if (!empty($erros)) {
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";

				foreach ($erros as $erro)
				{
					echo $erro;
				}

				echo "- Questão NÃO adicionada!!!";
				echo "</body> </html>";
		    	echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		   		exit();
			}
		
			$caminho = "img_res/";
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());
			$nomeimgld = $hoje."-".$nomeimagem;
			
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgld)){
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else{
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- Erro ao Salvar a Imagem!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		else{
			echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    echo "<center><b>Erro</b></center><br>";
		    echo "<font size='4' color='black'>";
		    echo "- Imagem da letra D não selecionada!!!";
		    echo "</body> </html>";
			echo "<br>";
			echo "<br>";
			echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
			exit();
		}	

		//Verificando se a imagem E foi selecionada,
		if (!empty($_FILES['resimge']['name'])){
			$nomeimagem = $_FILES['resimge']['name'];
			$tipo = $_FILES['resimge']['type'];
			$nometemporario = $_FILES['resimge']['tmp_name'];
			$tamanho_imagem = $_FILES['resimge']['size'];
			$erros = array();
		
			$tamanho_maximo = 1024 * 1024 * 5;

			if ($tamanho_imagem > $tamanho_maximo){
				$erros[] = "- Imagem da letra E exede o tamanho máximo de 5 MB.<br>";
			}
		
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			if (!in_array ($tipo, $tipospermitidos)){
				$erros[] = "- Tipo de arquivo não permitido na Imagem da letra E.<br>";
			}
		
			if (!empty($erros)) {
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";

				foreach ($erros as $erro)
				{
					echo $erro;
				}

				echo "- Questão NÃO adicionada!!!";
				echo "</body> </html>";
		    	echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
		   		exit();
			}
		
			$caminho = "img_res/";
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());
			$nomeimgle = $hoje."-".$nomeimagem;
			
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgle)){
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else{
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- Erro ao Salvar a Imagem!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		else{
			echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    echo "<center><b>Erro</b></center><br>";
		    echo "<font size='4' color='black'>";
		    echo "- Imagem da letra E não selecionada!!!";
		    echo "</body> </html>";
			echo "<br>";
			echo "<br>";
			echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
			exit();
		}	
	}
    elseif ($escolhares == "restex"){
		if(isset($_POST["txtletraa"])){
			if($_POST["txtletraa"]==""){
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- A resposta A não pode ser nula!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		if(isset($_POST["txtletrab"])){
			if($_POST["txtletrab"]==""){
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- A resposta B não pode ser nula!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		if(isset($_POST["txtletrac"])){
			if($_POST["txtletrac"]==""){
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- A resposta C não pode ser nula!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		if(isset($_POST["txtletrad"])){
			if($_POST["txtletrad"]==""){
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- A resposta D não pode ser nula!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
		if(isset($_POST["txtletrae"])){
			if($_POST["txtletrae"]==""){
				echo "<html> <meta charset ='UTF-8'> <body bgcolor = 'cyan'> <title>Erro na Adição</title>  <font size='6' color='red'>";
		    	echo "<center><b>Erro</b></center><br>";
		    	echo "<font size='4' color='black'>";
		    	echo "- A resposta E não pode ser nula!!!";
		    	echo "</body> </html>";
				echo "<br>";
				echo "<br>";
				echo "Clique <a href='adicionar_questao.php'>aqui</a> para voltar.";
				exit();
			}
		}
	}

	include_once ('conexao.php');
        $txtquestao = $_POST["txtquestao"];
        $numano = $_POST["numano"];
        $txtrespostacorreta = $_POST["txtrespostacorreta"];

		if ($escolhares == "restex"){
        $txtletraa = $_POST["txtletraa"];
        $txtletrab = $_POST["txtletrab"];
        $txtletrac = $_POST["txtletrac"];
        $txtletrad = $_POST["txtletrad"];
        $txtletrae = $_POST["txtletrae"];
		$result = mysqli_query($conexao, "insert into tab_questoes(texto_questao, ano_vestibular,resposta_correta,resposta_a,resposta_b,resposta_c,resposta_d,resposta_e, nome_imagem, tipo_resposta) values('$txtquestao','$numano','$txtrespostacorreta','$txtletraa','$txtletrab','$txtletrac','$txtletrad','$txtletrae', '$novonome', 't')");
		date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());
		echo "- Questão adicionada com Sucesso às ".$hora;
		}
		elseif ($escolhares == "resimg"){
			$result = mysqli_query($conexao, "insert into tab_questoes(texto_questao, ano_vestibular,resposta_correta,resposta_a,resposta_b,resposta_c,resposta_d,resposta_e, nome_imagem, tipo_resposta) values('$txtquestao','$numano','$txtrespostacorreta','$nomeimgla','$nomeimglb','$nomeimglc','$nomeimgld','$nomeimgle', '$novonome', 'i')");
		date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());
		echo "- Questão adicionada com Sucesso às ".$hora;
		}

        
}
?>

<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<body style="background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));">
<link rel="stylesheet" type="text/css"  href="estilo_adm.css" />
<title> Adicionar Questão </title>

<header>
<div>
<img src="img/logo_exemplo.png" style="position: absolute;  width: 98px; heigth: 50px; top: 0px; bottom: 0px; left: 0px; border: 1px solid black;">
  </div>

<font face="arial black">
<div class="altdados_adm">
<h2>Adicionar Questão</h2>
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
<legend style="color:grey31; font-size:25px; font-weight: bold;">Adicionar nova questão do ENEM</legend>
<b>Questão:</b>
<br>
<textarea cols="135" rows="10" name="txtquestao" value="text" required></textarea>
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