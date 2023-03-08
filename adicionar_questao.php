<?php
if(isset($_POST["adcionarquestao"]))
{

	if (isset($_POST["txtquestao"]))	
	{
		include_once ('conexao.php');
		$questao = $_POST['txtquestao'];
		echo $questao;
		$sql = mysqli_query($conexao, "SELECT * FROM tab_questoes WHERE texto_questao = '$questao';");
		$sql2 = mysqli_num_rows($sql);
		echo $sql2;

		
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

    $escolha = @$_POST['chenimg'];
    if (empty($escolha))
	{
		if (!empty($_FILES['arquivo']['name']))
	{
		$nomeimagem = $_FILES['arquivo']['name'];
		$tipo = $_FILES['arquivo']['type'];
		$nometemporario = $_FILES['arquivo']['tmp_name'];
		$tamanho_imagem = $_FILES['arquivo']['size'];
		$erros = array();
		
		$tamanho_maximo = 1024 * 1024 * 5;
		if ($tamanho_imagem > $tamanho_maximo)
		{
			$erros[] = "- Imagem exede o tamanho máximo de 5 MB.<br>";
		}
		
		$tipospermitidos = ["image/png","image/jpg","image/jpeg"];
		if (!in_array ($tipo, $tipospermitidos))
		{
			$erros[] = "- Tipo de arquivo não permitido.<br>";
		}
		
		if (!empty($erros)) 
		{
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
			
			if (move_uploaded_file($nometemporario, $caminho.$novonome))
			{
				echo "- Imagem salva com Sucesso!!!";
				echo "<br>";
			}
			else
			{
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
	else	
	{
		$novonome = "Não possui Imagem";	
	}
	}
	else if ($escolha = "chenao")
	{
		$novonome = "Não possui Imagem";
	}
	
	    include_once ('conexao.php');
        $txtquestao = $_POST["txtquestao"];
        $numano = $_POST["numano"];
        $txtnomevestibulinho = $_POST["txtnomevestibulinho"];
        $txtrespostacorreta = $_POST["txtrespostacorreta"];
        $txtletraa = $_POST["txtletraa"];
        $txtletrab = $_POST["txtletrab"];
        $txtletrac = $_POST["txtletrac"];
        $txtletrad = $_POST["txtletrad"];
        $txtletrae = $_POST["txtletrae"];

        $result = mysqli_query($conexao, "insert into tab_questoes(texto_questao, ano_vestibular,nome_vestibulinho,resposta_correta,resposta_a,resposta_b,resposta_c,resposta_d,resposta_e, nome_imagem) values('$txtquestao','$numano','$txtnomevestibulinho','$txtrespostacorreta','$txtletraa','$txtletrab','$txtletrac','$txtletrad','$txtletrae', '$novonome')");
		date_default_timezone_set('America/Sao_Paulo');
		$hora = date('H:i:s', time());
		echo "- Questão adicionada com Sucesso às ".$hora;

		

}

?>

<html>
<meta charset="UTF-8">
<body bgcolor="SeaGreen">
<title> Adicionar Questão </title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<br>

<font color="black" size="4">
<div id="area">

<form action="" method="POST" enctype="multipart/form-data">  
<fieldset>  
<legend style="color:grey31; font-size:25px; font-weight: bold;">Adicionar nova questão de Vestibulinho</legend>
<b>Questão:</b>
<br>
<textarea cols="135" rows="10" name="txtquestao" value="text" required></textarea>
<br><br>

<div>
<b>Ano do Vestibulinho:</b>
<input type="int" name="numano" placeholder="2001" style="width: 55px;" required>
&nbsp;&nbsp;&nbsp;
<b>Nome do Vestibulinho:</b>
<input type="text" name="txtnomevestibulinho" placeholder="Ex: ENEM" style="width: 200px;" required>
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

<label style="left:40px; margin-right:5px;">Letra A:</label> <input type="text" name="txtletraa" style="width: 1000px;" required>
<br><br>
<label style="left:40px; margin-right:5px;">Letra B:</label> <input type="text" name="txtletrab" style="width: 1000px;" required>
<br><br>
<label style="left:40px; margin-right:5px;">Letra C:</label> <input type="text" name="txtletrac" style="width: 1000px;" required>
<br><br>
<label style="left:40px; margin-right:5px;">Letra D:</label> <input type="text" name="txtletrad" style="width: 1000px;" required>
<br><br>
<label style="left:40px; margin-right:5px;">Letra E:</label> <input type="text" name="txtletrae" style="width: 1000px;" required>
<br><br>

<b>Imagem:</b>
<br>
<input type="file" name="arquivo" style="font-size:15px">
<input type="checkbox" name="chenimg" value="chenao">
<label for="chenimg">Não possui Imagem</label>
<br>

<br><br>

<input type="reset" name="limpar" value="Limpar" style="width: 100px; height: 30px; background-color:white; color:green; font-size:15px; font-weight: bold;">    
<input type="submit" name="adcionarquestao"  value="Adicionar" style="width: 100px; height: 30px; background-color:green; color:white; font-size:15px; font-weight: bold;">    
 
</fieldset>
</form>
</div>
</font>
</body>
</html>