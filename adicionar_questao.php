<!-- Iniciando PHP -->
<?php

// Iniciando sessão para obter os seus dados, se existirem
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{
  
  // Redirecionando para a página index pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}
else
{
  
  // Obtendo o nome do ADM na sessão
  $nome = $_SESSION["nome_adm"];

  // Conectando com o bnco de daos
  include_once('conexao.php');

  // Obtendo os dados do ADM para serem utilizados quando necessário
  $dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");
  
  // Verificando se o usuário existe no bd
  if($dados->num_rows > 0){
    $dado=$dados->fetch_array();
    }else{

      // Voltando para o index, pois o usuario não existe
      header('location: index.php');
      exit;
    }

  // Obtendo o nível do ADM
  $nivel = $dado['nivel'];

  // Verificando o nível do ADM
  if ($nivel == "admgeral" || $nivel == "adm"){
  }
  else{

	// Redirecionando para a página adm, pois o nivel não condiz com a página atual
    header('location: pagina_adm.php');
    exit;
  }
}

// Concatando com o banco de dados
include_once ('conexao.php');

// Obtendo nomes das diciplinas para o combobox a ser mostrado
$selc_diciplinas = mysqli_query($conexao, "SELECT * FROM tabela_disciplina order by disciplina;");

// Verificando se o botão adcionar foi clicado
if(isset($_POST["adcionarquestao"]))
{

	if (isset($_POST["txtquestao"]))	
	{

		// Obtendo o texto da questão a ser adicionada
		$txtquestao = trim($_POST['txtquestao']);

		// Obtendo dados da tebela pergunta para verificar se a questão já está cadastrada
		$sqlques = "SELECT * FROM tabela_pergunta WHERE pergunta ='".addslashes($txtquestao)."';";
		$sql = mysqli_query($conexao, $sqlques);
		
		// Verificando se a questão já não está cadastrada
		if(mysqli_num_rows($sql)>0) 
		{ 
		
		// Emitindo mensagem de erro
		$script = "<script>alert('Erro: Não foi possivel cadastrar Pergunta. Questão já cadastrada.');location.href='adicionar_questao.php';</script>";
		echo $script;
		exit;
		}
	}

	// Definindo o ano da questão
	$ano_pergunta = $_POST['anoquestao'];

	// Verificando se a questão tem imagem
	// Obtendo o valor da checkbox para isso
    $escolha = @$_POST['chepimg'];

	// Fazendo a verificação
	// Se a questão possui imagem
    if ($escolha=="spimg"){

		// Verificando se a imagem foi selecionada
	    if (!empty($_FILES['arquivo']['name'])){

			// Obtendo os dados da imagem
			// Nome
		    $nomeimagem = $_FILES['arquivo']['name'];

			// Tipo
		    $tipo = $_FILES['arquivo']['type'];

			// Nome temporário
		    $nometemporario = $_FILES['arquivo']['tmp_name'];

			// Tamanho
		    $tamanho_imagem = $_FILES['arquivo']['size'];

			// Definindo um tamanho máximo para a imagem
		    $tamanho_maximo = 1024 * 1024 * 5;

			// verificando se o tamanho da imagem exede o limite
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo menssagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Imagem exede o tamanho máximo de 5 MB.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
	
			// Definindo os tipos de imagem aceitos (PNG/JPG/JPEG)
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo do arquivo escolhido é uma imagem
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Tipo de arquivo(imagem) não permitido.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		
			// Difinindo o caminho da imagem
			$caminho = "uploads/";

			// Obtendo data e hora atual
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo o nome da imagem a ser salva
			// NOME + DATA e HORA
			$novonome = $hoje."-".$nomeimagem;
			
			// Verificando se a imagem foi salva na pasta
			if (move_uploaded_file($nometemporario, $caminho.$novonome)){
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
	    }
		else{

			// Emitindo mensagem de erro, pois nenuma imagem foi selecionada
			$script = "<script>alert('Erro: Nenhuma imagem selecionada.');location.href='adicionar_questao.php';</script>";
			echo $script;
			exit;
		}
	}  

	// Se a questão não possui imagem
	else if ($escolha = "npimg"){

		// Definindo valor Não Possui para a imagem
		$novonome = "Não possui";
	}

	// Obtendo valor da checkbox, para verificar se as resposntas são imagens ou texto
	$escolhares = @$_POST['chenimgoutex'];

	// Verificando se a resposta é Imagem ou Texto
	// Se as respostas forem imagens
    if ($escolhares == "resimg"){

		// Verificando se a imagem A foi selecionada
		if (!empty($_FILES['resimga']['name'])){

			// Obtendo dados da imagem

			// Nome
			$nomeimagem = $_FILES['resimga']['name'];

			// Tipo
			$tipo = $_FILES['resimga']['type'];

			// Nome temporário
			$nometemporario = $_FILES['resimga']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimga']['size'];

			// Definindo tamanho máximo para a imagem
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando se o tamanho da imagem excede o limite
			if ($tamanho_imagem > $tamanho_maximo){

				// Emiteindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Imagem da letra A exede o tamanho máximo de 5 MB.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		
			// Definindo tipos de imagens aceitas (PNG/JPG/JPEG)
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo do arquivo é aceito
			if (!in_array ($tipo, $tipospermitidos)){

				// Emiteindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra A.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}

			// Definindo um caminho para a imagem
			$caminho = "img_res/";

			// Obtendo data e hora atual
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo nome para a imagem a ser salva
			// NOME+ DATA e HORA
			$nomeimgla = $hoje."-".$nomeimagem;
			
			// Verificando se a imagem foi salva
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgla)){
			}
			else{

				// Emiteindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra A.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		}
		else{

			// Emiteindo mensagem de erro, pois nenhuma imagem foi selecionada
			$script = "<script>alert('Erro: Imagem letra A não selecionada.');location.href='adicionar_questao.php';</script>";
			echo $script;
			exit;
		}
	   
		//Verificando se a imagem B foi selecionada,
		if (!empty($_FILES['resimgb']['name'])){
			
			// Obtendo dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimgb']['name'];

			// Tipo
			$tipo = $_FILES['resimgb']['type'];

			// Nome temporário
			$nometemporario = $_FILES['resimgb']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimgb']['size'];

			// Definindo tamanho máximo para a imagem
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando se o tamanho da imagem excede o limite
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Imagem da letra B exede o tamanho máximo de 5 MB.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		
			// Definindo tipos de imagens aceitas (PNG/JPG/JPEG)
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo do arquivo é aceito
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra B.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		
			// Definindo um caminho para a imagem
			$caminho = "img_res/";

			// Obtendo data e hora atual
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo nome para a imagem a ser salva
			// NOME+ DATA e HORA
			$nomeimglb = $hoje."-".$nomeimagem;
			
			// Verificando se a imagem foi salva	
			if (move_uploaded_file($nometemporario, $caminho.$nomeimglb)){
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra B.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		}
		else{

			// Emitindo mensagem de erro, pois nenhuma imagem foi selecionada
			$script = "<script>alert('Erro: Imagem letra B não selecionada.');location.href='adicionar_questao.php';</script>";
			echo $script;
			exit;
		}

		//Verificando se a imagem C foi selecionada,
		if (!empty($_FILES['resimgc']['name'])){

			// Obtendo dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimgc']['name'];

			// Tipo
			$tipo = $_FILES['resimgc']['type'];

			// Nome temporário
			$nometemporario = $_FILES['resimgc']['tmp_name'];

			// |Tamanho
			$tamanho_imagem = $_FILES['resimgc']['size'];

			// Definindo tamanho máximo para a imagem
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando se o tamanho da imagem excede o limite
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Imagem da letra C exede o tamanho máximo de 5 MB.');location.href='adicionar_questao.php';</script>";
				echo $script;
			exit;
			}
		
			// Definindo tipos de imagens aceitas (PNG/JPG/JPEG)
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo do arquivo é aceito
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra C.');location.href='adicionar_questao.php';</script>";
				echo $script;
			exit;
			}
		
			// Definindo um caminho para a imagem
			$caminho = "img_res/";

			// Obtendo data e hora atual
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo nome para a imagem a ser salva
			// NOME+ DATA e HORA
			$nomeimglc = $hoje."-".$nomeimagem;
			
			// Verificando se a imagem foi salva	
			if (move_uploaded_file($nometemporario, $caminho.$nomeimglc)){
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra C.');location.href='adicionar_questao.php';</script>";
				echo $script;
			exit;
			}
		}
		else{

			// Emitindo mensagem de erro, pois nenhuma imagem foi selecionada
			$script = "<script>alert('Erro: Imagem letra C não selecionada.');location.href='adicionar_questao.php';</script>";
			echo $script;
			exit;
		}

		//Verificando se a imagem D foi selecionada,
		if (!empty($_FILES['resimgd']['name'])){

			// Obtendo dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimgd']['name'];

			// Tipo
			$tipo = $_FILES['resimgd']['type'];

			// Nome temporário
			$nometemporario = $_FILES['resimgd']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimgd']['size'];
		
			// Definindo tamanho máximo para a imagem
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando se o tamanho da imagem excede o limite
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Imagem da letra D exede o tamanho máximo de 5 MB.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		
			// Definindo tipos de imagens aceitas (PNG/JPG/JPEG)
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo do arquivo é aceito
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra D.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		
			// Definindo um caminho para a imagem
			$caminho = "img_res/";

			// Obtendo data e hora atual
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo nome para a imagem a ser salva
			// NOME+ DATA e HORA
			$nomeimgld = $hoje."-".$nomeimagem;
			
			// Verificando se a imagem foi salva	
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgld)){
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra D.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		}
		else{

			// Emitindo mensagem de erro, pois nenhuma imagem foi selecionada
			$script = "<script>alert('Erro: Imagem letra D não selecionada.');location.href='adicionar_questao.php';</script>";
			echo $script;
			exit;
		}	

		//Verificando se a imagem E foi selecionada,
		if (!empty($_FILES['resimge']['name'])){

			// Obtendo dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimge']['name'];

			// Tipo
			$tipo = $_FILES['resimge']['type'];

			// Nome temporário
			$nometemporario = $_FILES['resimge']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimge']['size'];
		
			// Definindo tamanho máximo para a imagem
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando se o tamanho da imagem excede o limite
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Imagem da letra E exede o tamanho máximo de 5 MB.');location.href='adicionar_questao.php';</script>";
				echo $script;
			exit;
			}
		
			// Definindo tipos de imagens aceitas (PNG/JPG/JPEG)
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo do arquivo é aceito
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra E.');location.href='adicionar_questao.php';</script>";
				echo $script;
			exit;
			}
		
			// Definindo um caminho para a imagem
			$caminho = "img_res/";

			// Obtendo data e hora atual
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo nome para a imagem a ser salva
			// NOME+ DATA e HORA
			$nomeimgle = $hoje."-".$nomeimagem;
			
			// Verificando se a imagem foi salva	
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgle)){
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra E.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			exit;
			}
		}
		else{

			// Emitindo mensagem de erro, pois nenhuma imagem foi selecionada
			$script = "<script>alert('Erro: Imagem letra E não selecionada.');location.href='adicionar_questao.php';</script>";
			echo $script;
			exit;
		}	
	}

	// Verificando se os dados inseridos são válidos, caso as respostas forem texto
    elseif ($escolhares == "restex"){

		// Verificando se os dados inserido no campo letra a são válidos
		if(isset($_POST["txtletraa"])){
			if(trim($_POST['txtletraa']) == ""){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: A resposta A não pode ser nula.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		}

		// Verificando se os dados inserido no campo letra b são válidos
		if(isset($_POST["txtletrab"])){
			if(trim($_POST['txtletrab']) == ""){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: A resposta B não pode ser nula.');location.href='adicionar_questao.php';</script>";
				echo $script;
				exit;
			}
		}

		// Verificando se os dados inserido no campo letra c são válidos
		if(isset($_POST["txtletrac"])){
				if(trim($_POST['txtletrac']) == ""){

					// Emitindo mensagem de erro
					$script = "<script>alert('Erro:  resposta C não pode ser nula.');location.href='adicionar_questao.php';</script>";
					echo $script;
					exit;
				}
			}

		// Verificando se os dados inserido no campo letra d são válidos
		if(isset($_POST["txtletrad"])){
				if(trim($_POST['txtletrad']) == ""){

					// Emitindo mensagem de erro
					$script = "<script>alert('Erro: A resposta D não pode ser nula.');location.href='adicionar_questao.php';</script>";
					echo $script;
					exit;
				}
		}

		// Verificando se os dados inserido no campo letra e são válidos
		if(isset($_POST["txtletrae"])){
				if(trim($_POST['txtletrae']) == ""){

					// Emitindo mensagem de erro
					$script = "<script>alert('Erro: A resposta E não pode ser nula.');location.href='adicionar_questao.php';</script>";
					echo $script;
					exit;
				}
		}
	}

		// Conectando com o banco de dados
		include_once ('conexao.php');

		// Obtendo os dados do form
		// Obtendo resposta correta
        $txtrespostacorreta = $_POST["txtrespostacorreta"];

		// Obtendo os dodos das alternativas, caso a escolha seja resposta em texto
		if ($escolhares == "restex"){

		// Letra A, sem espaço no começo e final
        $txtletraa = trim($_POST['txtletraa']);

		// Letra B, sem espaço no começo e final
        $txtletrab = trim($_POST['txtletrab']);

		// Letra C, sem espaço no começo e final
        $txtletrac = trim($_POST['txtletrac']);

		// Letra D, sem espaço no começo e final
        $txtletrad = trim($_POST['txtletrad']);

		// Letra E, sem espaço no começo e final
        $txtletrae = trim($_POST['txtletrae']);

		// Obtendo a disciplina
		$disciplina = $_POST["disciplina"];

		// Obtendo o codigo da disciplina
		$dadosdis = mysqli_query($conexao, "SELECT * FROM tabela_disciplina WHERE disciplina = '$disciplina';");
    	$dadodis=$dadosdis->fetch_array();
		$coddisciplina = $dadodis['codigo_disciplina'];

		// Inserindo dados na tabela de pergunta
		$result = mysqli_query($conexao, "INSERT into tabela_pergunta(pergunta, codigo_disciplina, imagem, ano) values('".addslashes($txtquestao)."','$coddisciplina', '$novonome', $ano_pergunta)");

		// Obtendo o código da pergunta que acabamos de cadastrar
		$sql4 = mysqli_query($conexao, "SELECT codigo_pergunta FROM tabela_pergunta WHERE pergunta = '".addslashes($txtquestao)."';"); 
		$sql5=$sql4->fetch_array();

		// Obtendo o código
		$codpergunta = $sql5['codigo_pergunta'];

		// Verificando qual é a resposta correta para colocar no banco de dados
		$letracor = @$_POST['txtrespostacorreta'];

		// Se for a letra A
		if ($letracor=="Letra A"){
			$cora = 1;
			$corb = 0;
			$corc = 0;
			$cord = 0;
			$core = 0;

		// Se for a letra B
		}elseif ($letracor=="Letra B"){
			$cora = 0;
			$corb = 1;
			$corc = 0;
			$cord = 0;
			$core = 0;

		// Se for a letra C
		}elseif ($letracor=="Letra C"){
			$cora = 0;
			$corb = 0;
			$corc = 1;
			$cord = 0;
			$core = 0;

		// Se for a letra D
		}elseif ($letracor=="Letra D"){
			$cora = 0;
			$corb = 0;
			$corc = 0;
			$cord = 1;
			$core = 0;

		// Se for a letra E
		}elseif ($letracor=="Letra E"){
			$cora = 0;
			$corb = 0;
			$corc = 0;
			$cord = 0;
			$core = 1;
		}
		
		// Inserindo dados na tabela de resposta
		// Letra A
		$adiquesa = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('".addslashes($txtletraa)."',$cora, 'a', 0, $codpergunta)");

		// Letra B
		$adiquesb = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('".addslashes($txtletrab)."',$corb, 'b', 0, $codpergunta)");

		// Letra C
		$adiquesc = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('".addslashes($txtletrac)."',$corc, 'c', 0, $codpergunta)");

		// Letra D
		$adiquesd = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('".addslashes($txtletrad)."',$cord, 'd', 0, $codpergunta)");

		// Letra 
		$adiquese = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('".addslashes($txtletrae)."',$core, 'e', 0, $codpergunta)");

		// Emitindo uma menssagem de sucesso
		$script = "<script>alert('Questão cadastrada com Sucesso.');location.href='adicionar_questao.php';</script>";
		echo $script;
		exit;
		}

		// Verificando se os dados inseridos são válidos, caso o tipo de resposta seja imagem
		elseif ($escolhares == "resimg"){

		// Obtendo a disciplina
		$disciplina = $_POST["disciplina"];

		// Obtendo o codigo da disciplina
		$dadosdis = mysqli_query($conexao, "SELECT * FROM tabela_disciplina WHERE disciplina = '$disciplina';");
    	$dadodis=$dadosdis->fetch_array();
		$coddisciplina = $dadodis['codigo_disciplina'];
		
		// Inserindo dados na tabela de pergunta
		$result = mysqli_query($conexao, "INSERT into tabela_pergunta(pergunta, codigo_disciplina, imagem, ano) values('".addslashes($txtquestao)."','$coddisciplina', '$novonome', $ano_pergunta)");

		// Obtendo código da questão que acabamos de cadastrar
		$sql4 = mysqli_query($conexao, "SELECT codigo_pergunta FROM tabela_pergunta WHERE pergunta = '".addslashes($txtquestao)."';");
		$sql5=$sql4->fetch_array();

		// Código da questão
		$codpergunta = $sql5['codigo_pergunta'];

		// Verificando qual é a resposta correta
		$letracor = @$_POST['txtrespostacorreta'];

		// Se for letra A
		if ($letracor=="Letra A"){
			$cora = 1;
			$corb = 0;
			$corc = 0;
			$cord = 0;
			$core = 0;

		// Se for letra B
		}elseif ($letracor=="Letra B"){
			$cora = 0;
			$corb = 1;
			$corc = 0;
			$cord = 0;
			$core = 0;

		// Se for letra C
		}elseif ($letracor=="Letra C"){
			$cora = 0;
			$corb = 0;
			$corc = 1;
			$cord = 0;
			$core = 0;

		// Se for letra D
		}elseif ($letracor=="Letra D"){
			$cora = 0;
			$corb = 0;
			$corc = 0;
			$cord = 1;
			$core = 0;

		// Se for letra E
		}elseif ($letracor=="Letra E"){
			$cora = 0;
			$corb = 0;
			$corc = 0;
			$cord = 0;
			$core = 1;
		}
	
		// Inserindo dados na tabela de resposta
		// Letra A
		$adiquesa = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('$nomeimgla',$cora, 'a', 1, $codpergunta)");

		// Letra B
		$adiquesb = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('$nomeimglb',$corb, 'b', 1, $codpergunta)");

		// Letra C
		$adiquesc = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('$nomeimglc',$corc, 'c', 1, $codpergunta)");

		// Letra D
		$adiquesd = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('$nomeimgld',$cord, 'd', 1, $codpergunta)");

		// Letra E
		$adiquese = mysqli_query($conexao, "INSERT into tabela_resposta(alternativa, correta, letra, tipo, codigo_pergunta) values('$nomeimgle',$core, 'e', 1, $codpergunta)");
		
		// Emitindo uma menssagem de sucesso
		$script = "<script>alert('Questão cadastrada com Sucesso.');location.href='adicionar_questao.php';</script>";
		echo $script;
		exit;
		}  
}
?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo propriedades básicas da página, como acentuação e título -->
<meta charset="UTF-8">
<title>Cadastrar Questão</title>

<!-- Inserindo um icone para a página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- Link necessário para icones  a serem exibidos-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Iniciando o java -->
<script>

// Função para sair da conta -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

// Função para voltar para a pagina adm -->
function voltar() {
      location.href='pagina_adm.php';
}

</script>

<!-- abrindo o cabeçalho -->



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style type="text/css">

    #header.header-scrolled {

    background: #fff;

    padding: 20px 0;

    height: 72px;

    transition: all 0.5s;

}

#header {

    padding: 30px 0;

    height: 92px;

    position: fixed;

    left: 0;

    top: 0;

    right: 0;

    transition: all 0.5s;

    z-index: 997;

    background-color: #363636;

    box-shadow: 5px 0px 15px #c3c3c3;

}

#header #logo h1 {

    font-size: 34px;

    margin: 0;

    padding: 0;

    line-height: 1;

    font-family: "Montserrat", sans-serif;

    font-weight: 700;

    letter-spacing: 3px;

}

#header #logo h1 a, #header #logo h1 a:hover {

    color: white;

    padding-left: 10px;

    border-left: 4px solid grey;

}

#nav-menu-container {

    float: right;

    margin: 0;

}

.nav-menu > li {

    margin-left: 10px;

}

.nav-menu > li {

    float: left;

}

.nav-menu li {

    position: relative;

    white-space: nowrap;

    color: white;

}

.nav-menu, .nav-menu * {

    margin: 0;

    padding: 0;

    list-style: none;

}

.header-scrolled .nav-menu li:hover > a, .header-scrolled .nav-menu > .menu-active > a {

    color: #1E90FF;

}

.header-scrolled .nav-menu a {

    color: black;

}

.nav-menu li:hover > a, .nav-menu > .menu-active > a {

    color: #1E90FF;

}

.nav-menu a {

    padding: 0 8px 10px 8px;

    text-decoration: none;

    display: inline-block;

    color: white;

    font-family: "Montserrat", sans-serif;

    font-weight: 700;

    font-size: 13px;

    text-transform: uppercase;

    outline: none;

}

#mobile-nav-toggle {

    display: inline;

}

#mobile-nav-toggle {

    position: fixed;

    right: 0;

    top: 0;

    z-index: 999;

    margin: 20px 20px 0 0;

    border: 0;

    background: none;

    font-size: 24px;

    display: none;

    transition: all 0.4s;

    outline: none;

    cursor: pointer;

}

#mobile-body-overly {

    width: 100%;

    height: 100%;

    z-index: 997;

    top: 0;

    left: 0;

    position: fixed;

    background: rgba(0, 0, 0, 0.7);

    display: none;

}

body.mobile-nav-active #mobile-nav {

    left: 0;

}

#mobile-nav {

    position: fixed;

    top: 0;

    padding-top: 18px;

    bottom: 0;

    z-index: 998;

    background: rgba(0, 0, 0, 0.8);

    left: -50%;

    width: 50%;

    overflow-y: auto;

    transition: 0.4s;

}

#mobile-nav ul {

    padding: 0;

    margin: 0;

    list-style: none;

}

#mobile-nav ul li {

    position: relative;

}

#mobile-nav ul li a {

    color: #fff;

    font-size: clamp(1em, 1em + 0.5vw, 1.5em);

    text-transform: uppercase;

    overflow: hidden;

    padding: 10px 22px 10px 15px;

    position: relative;

    text-decoration: none;

    width: 100%;

    display: block;

    outline: none;

    font-weight: 700;

    font-family: "Montserrat", sans-serif;

}

#mobile-nav ul .menu-has-children i.fa-chevron-up {

    color: #1E90FF;

}

#mobile-nav ul .menu-has-children i {

    position: absolute;

    right: 0;

    z-index: 99;

    padding: 15px;

    cursor: pointer;

    color: #fff;

}

#mobile-nav ul .menu-item-active {

    color: #1E90FF;

}

#mobile-nav ul li li {

    padding-left: 30px;

}



.menu-has-children ul

{display: none;}



.sf-arrows .sf-with-ul {

  padding-right: 30px;

}



.sf-arrows .sf-with-ul:after {

  content: "\f107";

  position: absolute;

  right: 15px;

  font-family: FontAwesome;

  font-style: normal;

  font-weight: normal;

  color:black;

}



.sf-arrows ul .sf-with-ul:after {

  content: "\f105";

}





.nav-menu li:hover > ul,

.nav-menu li.sfHover > ul {

  display: block;

}

.nav-menu ul {

    margin: 4px 0 0 0;

    padding: 10px;

    box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);

    background: #4F4F4F;

    color: white;

}

.nav-menu ul {

    position: absolute;

    display: none;

    top: 100%;

    left: 0;

    z-index: 99;

}



.sf-arrows .sf-with-ul {

    padding-right: 30px;

}

.nav-menu li {

    position: relative;

    white-space: nowrap;
    

}





@media (max-width: 1000px){

#nav-menu-container {

    display: none;

}



#mobile-nav-toggle {

    display: inline;

    padding-right: 50px;

    

}

#header {
  height: 102px;
}

}    </style>

<!-- Iniciando o CSS -->

<!-- Definindo características da página como um todo -->

<style>

		/* Definindo fonte e cor da página */

        body{

            font-family: Arial, Helvetica, sans-serif;

			background-color: black;

        }



		/* Definindo características da "caixa" do formulário */

        .box{

            color: white;

            background-color: black;

            padding: 15px;

            border-radius: 15px;

            border: 2px solid #0000FF;

            width: 95%;

            font-size: clamp(1em, 1em + 0.5vw, 1.5em);

        }

		/* Definindo caracteristicas dos botões */

        #adcionarquestao{

            width: 32%;

            border: none;

            padding: 15px;

            color: white;

            font-size: clamp(1em, 1em + 0.5vw, 1.5em);

            cursor: pointer;

            border-radius: 10px;

            background-color: RoyalBlue;

        }

        #adcionarquestao:hover{

            background-color: CornflowerBlue;

        }

        #limpar{

width: 32%;

border: none;

padding: 15px;

color: white;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

}

#limpar:hover{

background-color: CornflowerBlue;

}

#cancelar{

width: 32%;

border: none;

padding: 15px;

color: white;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

}

#cancelar:hover{

background-color: CornflowerBlue;

}

legend{

padding: 10px;

text-align: center;

border-radius: 8px;

font-size: clamp(1em, 1em + 1vw, 1.5em);

}

</style>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>
</head>
<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<header id="header">
<div class="container">

<div id="logo" class="pull-left">
  <h1><a class="scrollto">DSENEM</a></h1>
  <!-- Uncomment below if you prefer to use an image logo -->
  <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
</div>

<nav id="nav-menu-container">
  <ul class="nav-menu">

  <li class='menu-active'><a href='pagina_adm.php'>Home</a></li>

  <!-- Iniciando PHP -->
	<?php

	// Verificando o nivel do adm para ver quais intens do cabeçalho se deve mostrar
	if ($nivel =="admgeral" || $nivel == "adm"){echo "
	<li class='menu-has-children'><a>Provas</a>
	<ul>
	  <li><a href='mostrar_provas.php'>Vizualizar</a></li>
	  <li><a href='provas_cadastradas.php'>Cadastradas</a></li>
	  <li><a href='adicionar_prova.php'>ADD Prova</a>
	  <li class='menu-has-children'><a>Disciplinas</a>
		  <ul>
			  <li><a href='mostrar_disciplinas.php'>Cadastradas</a></li>
			  <li><a href='adicionar_disciplina.php'>ADD Disciplina</a></li>
		  </ul>
	  </li>
	</ul>
	</li>
	<li class='menu-has-children'><a>Questões</a>
	  <ul>
		<li><a href='mostrar_questoes.php'>Cadastradas</a></li>
		<li class='menu-has-children'><a>Verificar Imagens</a>
		  <ul>
			  <li><a href='verficarimg_perguntas.php'>Perguntas</a></li>
			  <li><a href='verficarimg_respostas.php'>Respostas</a></li>
		  </ul>
		  </li>
	  </ul>
	</li>
	 <li class='menu-has-children'><a >Usuários</a>
	  <ul>
	  <li><a href='mostrar_usuarios.php'>Alu. Cadastrados</a></li>
	  <li><a href='mostrar_usuarios_banidos.php'>Alu. Banidos</a></li>
	  <li><a href='mostrar_professores.php'>Prof. Cadastrados</a></li>
	  <li><a href='mostrar_professores_banidos.php'>Prof. Banidos</a></li>
	  <li><a href='adicionar_adm.php'> ADD Professor</a></li>
	  </ul>
	</li>";
	}


	if ($nivel =="admgeral" || $nivel == "adm" || $nivel == "corretor"){echo"
	  <li class='menu-has-children'><a >Redações</a>
	  <ul>
		<li><a href='readacoes_corrigir.php'>Para Corrigir</a></li>
		<li><a href='readacoes_corrigidas.php'>Corrigidas</a></li>
		<li class='menu-has-children'><a >Temas</a>
		<ul>
		  <li><a href='temas_enem.php'>ENEM</a></li>
		  <li><a href='temas_usuarios.php'>Usuários</a></li>
		  <li><a href='temas_professores.php'>Professores</a></li>
		  <li><a href='adicionar_tema.php'>ADD Tema</a></li>
		</ul>
	  </ul>
	</li>";

	if ($nivel =="corretor"){echo"
	<li><a href='pagina_adm.php?mos_tabques=Todas'>Questões</a></li>";
	}
	}

	if ($nivel !="admgeral" && $nivel != "adm"){echo "
	<li><a href='mostrar_provas.php'>Provas e Gabaritos</a></li>";
	}
	?>

	<li class="menu-has-children"><a >Simulados</a>
	  <ul>
		<li><a href="provas_geradasadm.php">Meus</a></li>
		<li><a href="provasadm_adm.php">Professores</a></li>
		<li><a href="provasusu_adm.php">Usuários</a></li>
		<li><a href="gerar_provaadm.php">Criar</a></li>
	  </ul>
	</li>
	<li><a href="alterar_dadosadm.php">Dados</a></li>
	<li class="menu-active"><a onclick="sair()">Sair</a></li>
	<!-- <li><a >Contact</a></li> -->
  </ul>
</nav><!-- #nav-menu-container -->

</div>
  </header><!-- #header -->	<script type="text/javascript">
	// Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if ($('#header').length) {
          top_space = $('#header').outerHeight();

          if( ! $('#header').hasClass('header-fixed') ) {
            top_space = top_space - 20;
          }
        }

        $('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu').length) {
          $('.nav-menu .menu-active').removeClass('menu-active');
          $(this).closest('li').addClass('menu-active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });	</script>
<!-- Fechando cabeçalho -->
<br><br><br><br><br><br>



<!-- Inserindo campos para a inserção de dados -->
<body>

<!-- Caixa em volta do form -->
<font color="black" size="4">
	<center>
<div class="box" align="left">
<form action="" method="POST" enctype="multipart/form-data"> 
	
<!-- Borda do form -->
<fieldset>  

<!-- Legenda do form -->
<legend style="color:grey31; font-size:25px; font-weight: bold;">Adicionar nova questão do ENEM</legend>

<!-- Campo texto da quetão, com suas propriedades -->
<b>Questão:</b>
<br>
<textarea style="width: 99%; border: 2px solid white; color:white; background-color: black;" cols="95" rows="10" style="width: 99%;" name="txtquestao" value="text" required></textarea>
<br><br>


<!-- Div para disciplina e opcção correta -->
<div>

<!-- Campo disciplina, com suas propriedades -->
<b>Disciplina:</b>
<select style="border: 2px solid white; color:white; background-color: black;" name="disciplina">
<?php 
while($diciplinas = mysqli_fetch_assoc($selc_diciplinas)) { ?>
<option value="<?php echo $diciplinas["disciplina"]; ?>"><?php echo $diciplinas["disciplina"]; ?></option>
<?php } ?>
</select>
&nbsp;&nbsp;&nbsp;

<!-- Campo opção correta, com suas propriedades -->
<b>Opção Correta:</b>
<select style="border: 2px solid white; color:white; background-color: black;" name="txtrespostacorreta">
                    <option value="Letra A">Letra A</option>
                    <option value="Letra B">Letra B</option>
                    <option value="Letra C">Letra C</option>
                    <option value="Letra D">Letra D</option>
					<option value="Letra E">Letra E</option>
                </select>
				&nbsp;&nbsp;&nbsp;

				<b>Ano:</b>
				<select style="border: 2px solid white; color:white; background-color: black;" name="anoquestao">
                    <?php
					$contano = 1998;

					$hoje = date('Y');

					while ($contano <= $hoje){
						echo "<option value='".$contano."'>".$contano."</option>";

						$contano = $contano + 1;
					}

					?>
                </select>
</div>
<br>

<!-- Campo tipo resposta, com suas propriedades -->
<b>Respostas:</b>
<br><br>
<input type="radio" name="chenimgoutex"  id="restex" value="restex" checked >
<label for="chenimg">Texto</label>
<input type="radio" name="chenimgoutex" id="resimg" value="resimg">
<label for="chenimg">Imagem</label>
<br><br>

<!-- Iniciando Java -->
<script>
// Verificando se o checkbox tipo texto esta selecionado
var chetex = document.querySelector("#restex");
chetex.addEventListener("click", function() {
divrestext.style.display = "block"; 
divresimg.style.display = "none"; 
});

// Verificando se o checkbox tipo imagem esta selecionado
var cheimg = document.querySelector("#resimg");
cheimg.addEventListener("click", function() {
divrestext.style.display = "none"; 
divresimg.style.display = "block"; 
});

</script>

<!-- Div que guarda os campos de resposta tipo texto -->
<div id="divrestext">
<label style="left:40px; margin-right:5px;">Letra A:</label> <input style="border: 2px solid white; color:white; background-color: black; width: 88%;" type="text" name="txtletraa" style="width: 90%;" id="txtletraa">
<br><br>
<label style="left:40px; margin-right:5px;">Letra B:</label> <input style="border: 2px solid white; color:white; background-color: black; width: 88%;" type="text" name="txtletrab" style="width: 90%;" id="txtletrab">
<br><br>
<label style="left:40px; margin-right:5px;">Letra C:</label> <input style="border: 2px solid white; color:white; background-color: black; width: 88%;" type="text" name="txtletrac" style="width: 90%;" id="txtletrac">
<br><br>
<label style="left:40px; margin-right:5px;">Letra D:</label> <input style="border: 2px solid white; color:white; background-color: black; width: 88%;" type="text" name="txtletrad" style="width: 90%;" id="txtletrad">
<br><br>
<label style="left:40px; margin-right:5px;">Letra E:</label> <input style="border: 2px solid white; color:white; background-color: black; width: 88%;" type="text" name="txtletrae" style="width: 90%;" id="txtletrae">
<br><br>
</div>

<!-- Div que guarda os campos de resposta tipo imagem -->
<div id="divresimg" style="display: none;">
<font size="3" color="red">
Tipos aceitos: JPG, JPEG, PNG.
<br>
</font>
<br>
<label style="left:40px; margin-right:5px;">Letra A:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimga" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra B:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimgb" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra C:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimgc" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra D:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimgd" style="font-size:15px">
<br><br>
<label style="left:40px; margin-right:5px;">Letra E:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimge" style="font-size:15px">
<br><br>
</div>

<!-- Campo possui imagem, com suas propriedades -->
<b>Possui imagem?</b>
<br>
<input type="radio" name="chepimg"  id="spimg" value="spimg">
<label for="chepimg">Sim</label>
<input type="radio" name="chepimg" id="npimg" value="npimg" checked>
<label for="chepimg">Não</label>
<br><br>

<!-- Div que contem o botão para escolher a imagem -->
<div id="divimgques" style="display: none;">
<font size="3" color="red">
Tipos aceitos: JPG, JPEG, PNG.
<br>
</font>
<input type="file" accept=".png,.jpg,.jpeg" name="arquivo" style="font-size:15px">
</div>
<br><br>

<!-- Iniciando java para verificar checkbox -->
<script>
// Verificando se o checkbox sim esta selecionado
var spimg = document.querySelector("#spimg");
spimg.addEventListener("click", function() { 
divimgques.style.display = "block"; 
});

// Verificando se o checkbox não esta selecionado
var npimg = document.querySelector("#npimg");
npimg.addEventListener("click", function() { 
divimgques.style.display = "none"; 
});

</script>

<!-- Botões adicionar, limpar e cancelar -->
<center>
<input type="submit" name="adcionarquestao" id="adcionarquestao" value="Cadastrar">    
<input type="reset" name="limpar" id="limpar" value="Limpar">   
</form> 
<button onclick="voltar()" id="cancelar" name="cancelar">Cancelar</button>
</center>

<!-- Fechando tags abertas -->
</fieldset>
</div>
</center>

</font>
</body>
</html>