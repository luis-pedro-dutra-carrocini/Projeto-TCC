<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conectando com o banco de dados
include_once ('conexao.php');

// Verificando se a sessão exist
if(!isset($_SESSION["senha_adm"])){

	// Redirecionando para a pagina index, pois a sessão não foi iniciada
 	header('location: index.php');
	exit;
}else{

  // Obtendo o nome via sessão
  $nome = $_SESSION["nome_adm"];

  // Obtendo os dados do adm
  $dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");

  // Verificando se o usuário existe no bd
	if($dados->num_rows > 0){
	$dado=$dados->fetch_array();
	}else{
  
	  // Voltando para o index, pois o usuario não existe
	  header('location: index.php');
	  exit;
	}

  // Obtendo o nivel do adm
  $nivel = $dado['nivel'];

  // Verificando o nivel do adm
  if ($nivel == "admgeral" || $nivel == "adm"){
  }
  else{

	// redirecionando para a pagina adm, pois o nivel de adm não condiz com a pagina atual
    header('location: pagina_adm.php');
    exit;
  }
}


// Obtendo nomes das diciplinas para o combobox
$selc_diciplinas = mysqli_query($conexao, "SELECT * FROM tabela_disciplina order by disciplina;");


// verificando se o codigo chegou via GET
if (!empty($_GET['codigo'])){

// Obtendo o dado do tipo GET do outro form
$codquestao = $_GET['codigo'];

// Obtendo os dados da pergunta
$tipo_pergunta = mysqli_query($conexao, "SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codquestao;");
$dadotipper = $tipo_pergunta->fetch_array();

// Cerificando se a pergunta realmente existe no bd
if ($tipo_pergunta->num_rows > 0){
}else{

	// Redirecionando para a mostrar questões, pois a prova não existe
    header('location: mostrar_questoes.php');
    exit;
}
}else{

	// Redirecionando para a mostrar questões, pois o codigo não chegou
    header('location: mostrar_questoes.php');
    exit;
}


// Obtendo os dados do bd relacionados ao código da questão
// Obtendo as resposta da pergunta
$tipo_resposta = mysqli_query($conexao, "SELECT * FROM tabela_resposta WHERE codigo_pergunta = $codquestao and letra='a';");
$dadotipres = $tipo_resposta->fetch_array();

// Verificando se as resposta são do tipo texto ou imagem
// Resposta do tipo texto
if ($dadotipres['tipo']==0){

	// Obtendo o código da disciplina
 	$sql = mysqli_query($conexao, "SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codquestao;");
 	$dado = $sql->fetch_array();
  	$codigo_disciplina = $dado['codigo_disciplina'];

	// Obtendo os dados da disciplina
  	$select_nomdis = mysqli_query($conexao,"SELECT * FROM tabela_disciplina WHERE codigo_disciplina=$codigo_disciplina;");

	// Verificando se a disciplina realmente existe
	if ($select_nomdis->num_rows > 0){

	// Obtendo o nome da disciplina
  	$dado_disciplina = $select_nomdis->fetch_array();
	$nome_disciplina = $dado_disciplina['disciplina'];
	}else{

		// Definindo disciplina como não encontrada, pois não existe no banco de dados
		$nome_disciplina = "Não encontrada";
	}

	// Obtendo os valores das respostas
  	$select_lea = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='a';");
  	$select_leb = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='b';");
  	$select_lec = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='c';");
  	$select_led = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='d';");
 	$select_lee = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='e';");
  	$conletraa = $select_lea->fetch_array();
  	$conletrab = $select_leb->fetch_array();
  	$conletrac = $select_lec->fetch_array();
  	$conletrad = $select_led->fetch_array();
  	$conletrae = $select_lee->fetch_array();

	// Verificando se cada resposta realmente existe

	// Letra A
	if ($select_lea->num_rows > 0){

	// Obtendo o valor da letra A
  	$letraa = $conletraa['alternativa'];
	}else{

		// Definindo como erro na resposta A
		$letraa = "Algo deu errado, a questão não possui a alternativa A";
	}

	// Letra B
	if ($select_leb->num_rows > 0){

		// Obtendo o valor da letra B
		$letrab = $conletrab['alternativa'];
	}else{
	
		// Definindo como erro na resposta B
		$letrab = "Algo deu errado, a questão não possui a alternativa B";
	}

	// Letra C
	if ($select_lec->num_rows > 0){

		// Obtendo o valor da letra C
		$letrac = $conletrac['alternativa'];
	}else{
	
		// Definindo como erro na resposta C
		$letrab = "Algo deu errado, a questão não possui a alternativa C";
	}

	// Letra D
	if ($select_led->num_rows > 0){

		// Obtendo o valor da letra D
		$letrad = $conletrad['alternativa'];
	}else{
	
		// Definindo como erro na resposta D
		$letrad = "Algo deu errado, a questão não possui a alternativa D";
	}

	// Letra E
	if ($select_lee->num_rows > 0){

		// Obtendo o valor da letra E
		$letrae = $conletrae['alternativa'];
	}else{
	
		// Definindo como erro na resposta E
		$letrae = "Algo deu errado, a questão não possui a alternativa E";
	}

	// Definindo as propriedades para os DIVs de resposta texto e resposta imagem
 	$tiprestex = "block";
  	$tipresimg = "none";

	// Verificando se todas as alternativas existem para podermos ver qual é a correta
	if (($select_lea->num_rows > 0) && ($select_leb->num_rows > 0) && ($select_lec->num_rows > 0) && ($select_led->num_rows > 0) && ($select_lee->num_rows > 0)){

		// Verifivando qual é a resposta correta
		if ($conletraa["correta"]==1){
			$alternativa_correta = "Letra A";
		  }
		  elseif ($conletrab["correta"]==1){
			   $alternativa_correta = "Letra B";
		  }
		  elseif ($conletrac["correta"]==1){
			$alternativa_correta = "Letra C";
		  }
		  elseif ($conletrad["correta"]==1){
			$alternativa_correta = "Letra D";
		  }
		  elseif ($conletrae["correta"]==1){
			$alternativa_correta = "Letra E";
		 }
	}else{

		// Definindo varival como erro pois não existe todas as aleternativas
		$alternativa_correta = "Não possui alternativa correta, pois esta faltando alguma alternativa";
	}
}

// Resposta do tipo imagem
elseif($dadotipres['tipo']==1){

	// Obtendo o código da disciplina
  	$sql = mysqli_query($conexao, "SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codquestao;");
  	$dado = $sql->fetch_array();

	// Obtendo o código da disciplina
  	$codigo_disciplina = $dado['codigo_disciplina'];

	// Obtendo os dados da disciplina
	$select_nomdis = mysqli_query($conexao,"SELECT * FROM tabela_disciplina WHERE codigo_disciplina=$codigo_disciplina;");

	// Verificando se a disciplina realmente existe
	if ($select_nomdis->num_rows > 0){

	// Obtendo o nome da disciplina
  	$dado_disciplina = $select_nomdis->fetch_array();
	$nome_disciplina = $dado_disciplina['disciplina'];
	}else{

		// Definindo disciplina como não encontrada, pois não existe no banco de dados
		$nome_disciplina = "Não encontrada";
	}

	// Obtendo os valores das respostas
  	$select_lea = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='a';");
  	$select_leb = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='b';");
  	$select_lec = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='c';");
  	$select_led = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='d';");
  	$select_lee = mysqli_query($conexao,"SELECT * FROM tabela_resposta WHERE codigo_pergunta=$codquestao and letra='e';");
  	$letraa = $select_lea->fetch_array();
  	$letrab = $select_leb->fetch_array();
  	$letrac = $select_lec->fetch_array();
  	$letrad = $select_led->fetch_array();
  	$letrae = $select_lee->fetch_array();

	// Definindo os nomes das imagens
	// Letra A
	$letraaimg = $letraa['alternativa'];

	// Letra B
	$letrabimg = $letrab['alternativa'];

	// Letra C
	$letracimg = $letrac['alternativa'];

	// Letra D
	$letradimg = $letrad['alternativa'];

	// Letra B
	$letraeimg = $letrae['alternativa'];
  
	// Verificando se todas as alternativas existem para podermos ver qual é a correta
	if (($select_lea->num_rows > 0) && ($select_leb->num_rows > 0) && ($select_lec->num_rows > 0) && ($select_led->num_rows > 0) && ($select_lee->num_rows > 0)){

		// Verifivando qual é a resposta correta
		if ($letraa["correta"]==1){
			$alternativa_correta = "Letra A";
		  }
		  elseif ($letrab["correta"]==1){
			   $alternativa_correta = "Letra B";
		  }
		  elseif ($letrac["correta"]==1){
			$alternativa_correta = "Letra C";
		  }
		  elseif ($letrad["correta"]==1){
			$alternativa_correta = "Letra D";
		  }
		  elseif ($letrae["correta"]==1){
			$alternativa_correta = "Letra E";
		 }
	}else{

		// Definindo varival como erro pois não existe todas as aleternativas
		$alternativa_correta = "Não possui alternativa correta, pois está faltando alguma alternativa";
	}

	// Definindo os valores dos txt das resposta como nulos já que a resposta é do tipo imagem
 	$letraa = "";
  	$letrab = "";
  	$letrac = "";
  	$letrad = "";
  	$letrae = "";

	// Definindo a fotos das respostas
  	$tiprestex = "none";
  	$tipresimg = "block";
}

// Verificando se a pergunta tem imagem ou não
if ($dadotipper['imagem']=="Não possui"){
  $pimg = "none";
}
else{
  $pimg = "block";
}

// Alterar os dados
if(isset($_POST["alterarquestao"]))
{
	// Verificando se a questão já esta cadastrada.
	if (isset($_POST["txtquestao"]))	
	{

		// Obtendo o valor da questão
		$txtquestao = trim($_POST["txtquestao"]);
		$questao = $txtquestao;

		if ($txtquestao == ""){

			// Emitindo mensagem de erro, pois o valor esta nulo
			$script = "<script>alert('Erro: Não foi possivel alterar Pergunta. Campo questão não pode ser nulo.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
			echo $script;
			exit;
		}

		// Obtendo os valores se acoso a questão estiver cadastrada
		$sql2 = mysqli_query($conexao, "SELECT * FROM tabela_pergunta WHERE codigo_pergunta = '".addslashes($txtquestao)."';");
    	$sql = mysqli_query($conexao, "SELECT * FROM tabela_pergunta WHERE codigo_pergunta = '$codquestao';");
    	$texper = $sql->fetch_array();

		// Obtendo o valor da pergunta
    	$pergunta = $texper['pergunta'];
		
		// Fazendo a verificação
    	if($questao != $pergunta){
			if(mysqli_num_rows($sql2)>0) { 

				// Emitindo mensagem de erro, pois a questão já esta cadastrada
				$script = "<script>alert('Erro: Não foi possivel alterar Pergunta. Questão já cadastrada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
   		}
	}else{

		// Emitindo mensagem de erro, pois o valor esta nulo
		$script = "<script>alert('Erro: Não foi possivel alterar Pergunta. Campo questão não pode ser nulo.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
		echo $script;
		exit;
	}

	// Verificando se a questão tem imagem.
    $escolha = @$_POST['chepimg'];
    if ($escolha=="spimg"){
	    if (!empty($_FILES['arquivo']['name'])){

			// Obtendo os dados da imagem
			// Nome
		    $nomeimagem = $_FILES['arquivo']['name'];

			// Tipo
		    $tipo = $_FILES['arquivo']['type'];

			// Nome temporário
		    $nometemporario = $_FILES['arquivo']['tmp_name'];

			// Tamanho da imagem
		    $tamanho_imagem = $_FILES['arquivo']['size'];

			// Tamanho maximo
		    $tamanho_maximo = 1024 * 1024 * 5;

			// verificando o tamanho da imagem
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo menssagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Imagem exede o tamanho máximo de 5 MB.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Tipos permitidos
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando se o tipo é permitido
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo(imagem) não permitido.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo o caminho e o nome da imagem
			$caminho = "uploads/";

			// Ajustando a data para o Brasil
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo um nome para a imagem
			$novonome = $hoje."-".$nomeimagem;
			
			// Salvando a imagem na pasta uploads
			if (move_uploaded_file($nometemporario, $caminho.$novonome)){

				// Definindo caminho
				$pasta = 'uploads/';

				// Deletando a imagem antiga da pergunta
				unlink($pasta.$dado['imagem']);
			}
			else{

				// Emitindo mensagm de erro
				$script = "<script>alert('Erro ao salvar imagem.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
	    }else{

			// Verificando se alguma imagem foi selecionada
      		if (!isset($dado)){

			// Emitindo mensagem de erro
      		$script = "<script>alert('Erro: nenhuma imagem selecionada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
      		echo $script;
      		exit;
			}else{

			// Mantendo o nome da imagem
        	$novonome = $dado['imagem'];
      		}
		}
	}  

	// Definindo o valor de "Não possui", caso a opção seja de não possui imagem
	elseif ($escolha = "npimg"){
		$novonome = "Não possui";
	}

	// Verificando se a resposta é Imagem ou Texto.
	$escolhares = @$_POST['chenimgoutex'];

	// Resposta do tipo imagem
    if ($escolhares == "resimg"){

		//Verificando se a imagem A foi selecionada,
		if (!empty($_FILES['resimga']['name'])){

			// Obtendo os dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimga']['name'];

			// Tipo
			$tipo = $_FILES['resimga']['type'];

			// Nome temporario
			$nometemporario = $_FILES['resimga']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimga']['size'];
		
			// Definindo tamanho maximo
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando o tamanho da imagem
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de rro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Imagem da letra A exede o tamanho máximo de 5 MB.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Verificando o tipo de arquivo escolhido
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra A.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}

			// Definindo um acaminho e nome para a imagem
			$caminho = "img_res/";

			// Ajustando data para o Brasil
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo um nome para a imagem
			$nomeimgla = $hoje."-".$nomeimagem;
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgla)){

				// Definindo caminho
				$pasta = 'img_res/';
				
				// Deletand a imagem antiga da pergunta
				unlink($pasta.$letraaimg);
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra A.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}else{

			// Verificando se alguma imagem foi selecionada
      		if (!isset($letraaimg)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Imagem letra A não selecionada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
	  		else{

				// Matendo o nome da imagem
       		 	$nomeimgla = $letraaimg;
      		}
		}
	   
		// Verificando se a imagem B foi selecionada,
		if (!empty($_FILES['resimgb']['name'])){

			// Obtendo os dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimgb']['name'];

			// Tipo
			$tipo = $_FILES['resimgb']['type'];

			// Mome temporário
			$nometemporario = $_FILES['resimgb']['tmp_name'];

			// Tamamanho
			$tamanho_imagem = $_FILES['resimgb']['size'];
		
			// Definindo um tamanho maximo para a imagem
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando o tamanho da imagem
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Imagem da letra B exede o tamanho máximo de 5 MB.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Defininindo tipos aceitos
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando o tipo de arquivo escolhido
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra B.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo um acaminho e nome para a imagem
			$caminho = "img_res/";

			// Ajustando a data para o Brasil
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo um nome para a imagem
			$nomeimglb = $hoje."-".$nomeimagem;
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporario, $caminho.$nomeimglb)){

				// Definindo caminho
				$pasta = 'img_res/';
				
				// Deletand a imagem antiga da pergunta
				unlink($pasta.$letrabimg);
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra B.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}else{

			// Verificando se alguma imagem foi selecionada
      		if (!isset($letrabimg)){

				// Emitindo mensagem de erro
       			$script = "<script>alert('Erro: Imagem letra B não selecionada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
        		echo $script;
        		exit;
        	}else{

				// Matendo o nome da imagem
          		$nomeimglb = $letrabimg;
        	}
		}

		//Verificando se a imagem C foi selecionada,
		if (!empty($_FILES['resimgc']['name'])){

			// Obtendo os dados da imagem
			// Nome 
			$nomeimagem = $_FILES['resimgc']['name'];

			// Tipo
			$tipo = $_FILES['resimgc']['type'];

			// Nome temporario
			$nometemporario = $_FILES['resimgc']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimgc']['size'];
		
			// Definindo um tamanho maximo
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando o tamanho da imagem
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Imagem da letra C exede o tamanho máximo de 5 MB.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
			exit;
			}
		
			// Definindo os tipos aceitos
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando o tipo de arquivo escolhido
			if (!in_array ($tipo, $tipospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra C.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo um acaminho e nome para a imagem
			$caminho = "img_res/";

			// Ajustando data para o Brasil
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo o nome para a imagem
			$nomeimglc = $hoje."-".$nomeimagem;
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporario, $caminho.$nomeimglc)){

				// Definindo caminho
				$pasta = 'img_res/';
				
				// Deletand a imagem antiga da pergunta
				unlink($pasta.$letracimg);
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra C.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}else{

			// Verificando se alguma imagem foi selecionada
      		if (!isset($letracimg)){

				// Emitindo mensagem de erro
        		$script = "<script>alert('Erro: Imagem letra C não selecionada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
        		echo $script;
        		exit;
        	}else{

				// Matendo o nome da imagem
          		$nomeimglc = $letracimg;
        	}
		}

		//Verificando se a imagem D foi selecionada,
		if (!empty($_FILES['resimgd']['name'])){

			// Obtendo os dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimgd']['name'];

			// Tipo
			$tipo = $_FILES['resimgd']['type'];

			// Nome temporario
			$nometemporario = $_FILES['resimgd']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimgd']['size'];
		
			// Definindo tamanho maximo
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando o tamanho da imagem
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Imagem da letra D exede o tamanho máximo de 5 MB.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo os tipos aceitos
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando o tipo de arquivo escolhido
			if (!in_array ($tipo, $tipospermitidos)){
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra D.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo um acaminho e nome para a imagem
			$caminho = "img_res/";

			// Ajustando data para o Brasil
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo um nome para a imagem
			$nomeimgld = $hoje."-".$nomeimagem;
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgld)){

				// Definindo caminho
				$pasta = 'img_res/';
				
				// Deletand a imagem antiga da pergunta
				unlink($pasta.$letradimg);
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra D.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}else{

			// Verificando se alguma imagem foi selecionada
      		if (!isset($letradimg)){

				// Emitindo mensagem de erro
        		$script = "<script>alert('Erro: Imagem letra D não selecionada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
        		echo $script;
        		exit;
        	}else{

				// Mantendo o nome da imagem
          		$nomeimgld = $letradimg;
        	}
		}	

		//Verificando se a imagem E foi selecionada,
		if (!empty($_FILES['resimge']['name'])){

			// Obtendo os dados da imagem
			// Nome
			$nomeimagem = $_FILES['resimge']['name'];

			// Tipo
			$tipo = $_FILES['resimge']['type'];

			// Nome temporario
			$nometemporario = $_FILES['resimge']['tmp_name'];

			// Tamanho
			$tamanho_imagem = $_FILES['resimge']['size'];
		
			// Definindo o tamanho maximo
			$tamanho_maximo = 1024 * 1024 * 5;

			// Verificando o tamanho da imagem
			if ($tamanho_imagem > $tamanho_maximo){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Imagem da letra E exede o tamanho máximo de 5 MB.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo os tipos aceitos
			$tipospermitidos = ["image/png","image/jpg","image/jpeg"];

			// Verificando o tipo de arquivo escolhido
			if (!in_array ($tipo, $tipospermitidos)){
				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo(imagem) não permitido na Imagem da letra E.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		
			// Definindo um acaminho e nome para a imagem
			$caminho = "img_res/";

			// Ajustando data para o Brasil
			date_default_timezone_set('America/Sao_Paulo');
			$hoje = date("d-m-Y_H-i-s", time());

			// Definindo um nome para a imagem
			$nomeimgle = $hoje."-".$nomeimagem;
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporario, $caminho.$nomeimgle)){

				// Definindo caminho
				$pasta = 'img_res/';
				
				// Deletand a imagem antiga da pergunta
				unlink($pasta.$letraeimg);
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar imagem letra E.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}else{

			// Verificando se alguma imagem foi selecionada
      		if (!isset($letraeimg)){

				// Emitindo mensagem de erro
        		$script = "<script>alert('Erro: Imagem letra E não selecionada.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
        		echo $script;
        		exit;
        	}else{

				// Mantendo o nome da imagem
          		$nomeimgle = $letraeimg;
        	}
		}	
	}

	// Resposta do tipo texto
    elseif ($escolhares == "restex"){

		// Verificando se resposta A é válida
		if(isset($_POST["txtletraa"])){
			if(trim($_POST["txtletraa"])==""){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: A resposta A não pode ser nula.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}

		// Verificando se resposta B é válida
		if(isset($_POST["txtletrab"])){
			if(trim($_POST["txtletraa"])==""){
				
				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: A resposta B não pode ser nula.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}

		// Verificando se resposta C é válida
		if(isset($_POST["txtletrac"])){
			if(trim($_POST["txtletrac"])==""){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro:  resposta C não pode ser nula.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}

		// Verificando se resposta D é válida
		if(isset($_POST["txtletrad"])){
			if(trim($_POST["txtletrad"])==""){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: A resposta D não pode ser nula.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}

		// Verificando se resposta E é válida
		if(isset($_POST["txtletrae"])){
			if(trim($_POST["txtletrae"])==""){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: A resposta E não pode ser nula.');location.href='alterar_questao.php?codigo=$codquestao';</script>";
				echo $script;
				exit;
			}
		}
	}

		// Obtendo a resposta correta
        $txtrespostacorreta = $_POST["txtrespostacorreta"];

		// Se a resposta for do tipo texto
		if ($escolhares == "restex"){

			// obtendo dados do form
        	$txtletraa = trim($_POST["txtletraa"]);
        	$txtletrab = trim($_POST["txtletrab"]);
        	$txtletrac = trim($_POST["txtletrac"]);
        	$txtletrad = trim($_POST["txtletrad"]);
        	$txtletrae = trim($_POST["txtletrae"]);

			// Obtendo o valor da disciplina
			$disciplina = $_POST["disciplina"];
			
			// Obtendo o codigo da disciplina
			$sql2 = mysqli_query($conexao, "SELECT codigo_disciplina FROM tabela_disciplina WHERE disciplina = '$disciplina';");
			$sql3=$sql2->fetch_array();
			$coddisciplina = $sql3['codigo_disciplina'];

			// Salvando alterações na tabela pergunta
			$result = mysqli_query($conexao, "UPDATE tabela_pergunta SET codigo_disciplina=$coddisciplina,pergunta='".addslashes($txtquestao)."',imagem='$novonome' WHERE codigo_pergunta=$codquestao;");

			// Obtendo dados da tabela pergunta
			$sql4 = mysqli_query($conexao, "SELECT codigo_pergunta FROM tabela_pergunta WHERE pergunta = '".addslashes($txtquestao)."';");
			$sql5=$sql4->fetch_array();

			// Obtendo o codigo da pergunta
			$codpergunta = $sql5['codigo_pergunta'];

			// Obtendo a alternativa correta
			$letracor = $_POST['txtrespostacorreta'];

			// Verificando qual é a aletranativa correta, para salvar no bd
			if ($letracor=="Letra A"){
				$cora = 1;
				$corb = 0;
				$corc = 0;
				$cord = 0;
				$core = 0;
			}elseif ($letracor=="Letra B"){
				$cora = 0;
				$corb = 1;
				$corc = 0;
				$cord = 0;
				$core = 0;
			}elseif ($letracor=="Letra C"){
				$cora = 0;
				$corb = 0;
				$corc = 1;
				$cord = 0;
				$core = 0;
			}elseif ($letracor=="Letra D"){
				$cora = 0;
				$corb = 0;
				$corc = 0;
				$cord = 1;
				$core = 0;
			}elseif ($letracor=="Letra E"){
				$cora = 0;
				$corb = 0;
				$corc = 0;
				$cord = 0;
				$core = 1;
			}elseif ($letracor=="Resposta correta"){
      			if ($alternativa_correta == "Letra A"){
        			$cora = 1;
        			$corb = 0;
        			$corc = 0;
        			$cord = 0;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra b"){
        			$cora = 0;
        			$corb = 1;
        			$corc = 0;
        			$cord = 0;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra C"){
        			$cora = 0;
        			$corb = 0;
        			$corc = 1;
        			$cord = 0;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra D"){
        			$cora = 0;
        			$corb = 0;
       				$corc = 0;
        			$cord = 1;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra E"){
        			$cora = 0;
        			$corb = 0;
        			$corc = 0;
        			$cord = 0;
       				$core = 1;
      			}
			}
		
			// Aletrando os dados na tabela perguntas
			// Letra A
			$adiquesa = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$txtletraa',correta=$cora,tipo=0 WHERE codigo_pergunta='$codquestao' and letra='a';");

			// Letra B
    		$adiquesb = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$txtletrab',correta=$corb,tipo=0 WHERE codigo_pergunta='$codquestao' and letra='b';");

			// Letra C
			$adiquesc = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$txtletrac',correta=$corc,tipo=0 WHERE codigo_pergunta='$codquestao' and letra='c';");

			// Letra E
			$adiquesd = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$txtletrad',correta=$cord,tipo=0 WHERE codigo_pergunta='$codquestao' and letra='d';");

			// Letra D
			$adiquese = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$txtletrae',correta=$core,tipo=0 WHERE codigo_pergunta='$codquestao' and letra='e';");

			// Enviando uma mensagem de sucesso
			$script = "<script>alert('Questão alterada com Sucesso.');location.href='mostrar_questoes.php';</script>";
			echo $script;
			exit;
		}

		// Se a resposta for imagem
		elseif ($escolhares == "resimg"){

			// Obtendo o valor da disciplina
    		$disciplina = $_POST["disciplina"];
    	
			// Obtendo o codigo da disciplina
      		$sql2 = mysqli_query($conexao, "SELECT codigo_disciplina FROM tabela_disciplina WHERE disciplina = '$disciplina';");
      		$sql3=$sql2->fetch_array();
      		$coddisciplina = $sql3['codigo_disciplina'];


			// aletrando os dados da tebela pergunta
			$result = mysqli_query($conexao, "UPDATE tabela_pergunta SET codigo_disciplina=$coddisciplina,pergunta='".addslashes($txtquestao)."',imagem='$novonome' WHERE codigo_pergunta=$codquestao;");

			// Obtendo dados da tabela pergunta
			$sql4 = mysqli_query($conexao, "SELECT codigo_pergunta FROM tabela_pergunta WHERE pergunta = '".addslashes($txtquestao)."';");
			$sql5=$sql4->fetch_array();

			// Obtendo o codigo da pergunta
			$codpergunta = $sql5['codigo_pergunta'];

			// Obtendo a alternativa correta
			$letracor = $_POST['txtrespostacorreta'];

			// Verificando qual é a aletranativa correta
			if ($letracor=="Letra A"){
			$cora = 1;
			$corb = 0;
			$corc = 0;
			$cord = 0;
			$core = 0;
			}elseif ($letracor=="Letra B"){
			$cora = 0;
			$corb = 1;
			$corc = 0;
			$cord = 0;
			$core = 0;
			}elseif ($letracor=="Letra C"){
			$cora = 0;
			$corb = 0;
			$corc = 1;
			$cord = 0;
			$core = 0;
			}elseif ($letracor=="Letra D"){
			$cora = 0;
			$corb = 0;
			$corc = 0;
			$cord = 1;
			$core = 0;
			}elseif ($letracor=="Letra E"){
			$cora = 0;
			$corb = 0;
			$corc = 0;
			$cord = 0;
			$core = 1;
			}elseif ($letracor=="Resposta correta"){
      			if ($alternativa_correta == "Letra A"){
        			$cora = 1;
        			$corb = 0;
        			$corc = 0;
        			$cord = 0;
       				$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra b"){
        			$cora = 0;
       			 	$corb = 1;
        			$corc = 0;
        			$cord = 0;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra C"){
        			$cora = 0;
        			$corb = 0;
        			$corc = 1;
        			$cord = 0;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra D"){
        			$cora = 0;
        			$corb = 0;
        			$corc = 0;
        			$cord = 1;
        			$core = 0;
      			}
      			elseif ($alternativa_correta == "Letra E"){
        			$cora = 0;
        			$corb = 0;
        			$corc = 0;
        			$cord = 0;
        			$core = 1;
      			}
			}
		
			// Aletrando os daos da tabela respostas
			// Letra A
			$adiquesa = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$nomeimgla',correta=$cora,tipo=1 WHERE codigo_pergunta='$codquestao' and letra='a';");

			// Letra B
    		$adiquesb = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$nomeimglb',correta=$corb,tipo=1 WHERE codigo_pergunta='$codquestao' and letra='b';");

			// Letra C
			$adiquesc = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$nomeimglc',correta=$corc,tipo=1 WHERE codigo_pergunta='$codquestao' and letra='c';");

			// Letra D
			$adiquesd = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$nomeimgld',correta=$cord,tipo=1 WHERE codigo_pergunta='$codquestao' and letra='d';");

			// Letra E
			$adiquese = mysqli_query($conexao, "UPDATE tabela_resposta SET alternativa='$nomeimgle',correta=$core,tipo=1 WHERE codigo_pergunta='$codquestao' and letra='e';");

			// Emitindo uma mensagem de sucesso
			$script = "<script>alert('Questão alterada com Sucesso.');location.href='mostrar_questoes.php';</script>";
			echo $script;
			exit;       
}
}

?>


<!-- Iniciando o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo caracteristicas basica como acentuação e titulo -->
<meta charset="UTF-8">
<title>Alterar Dados da Questão</title>

<!-- Colocando ícone na página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Iniciando java -->
<script>

// Função para ir para sair da conta -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

// Função para voltar a pagina anterior -->
function voltar() {
  var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
      location.href='mostrar_questoes.php';
    }
}

// Função para restaura o form -->
function restaurar() {
      location.href='alterar_questao.php?codigo=<?php echo $codquestao ?>';
}

// Função para voltar a pagina home -->
function home() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='pagina_adm.php';
	}
}

// Função para abrir a pagina visualizar usuários -->
function visu_usuarios() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_usuarios.php';
	}
}

// Função para abrir a pagina visualizar questões -->
function visu_questoes() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_questoes.php';
	}
}

// Função para abrir a página adicionar adm -->
function add_adm() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='adicionar_adm.php';
	}
}

// Função para abrir a pagina alterar dados adm -->
function alt_dados() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='alterar_dadosadm.php';
	}
}

// Função para ir para a página visu usu ban -->
function visu_usuarios_banidos() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_usuarios_banidos.php';
	}
}

// Função para ir para a página visu provas adm -->
function provas_geradas() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='provas_geradasadm.php';
	}
}

// Função para ir para a página criar provas -->
function gerar_prova() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='gerar_provaadm.php';
	}
}

// Função para ir para a página add questões -->
function add_questoes() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='adicionar_questao.php';
	}
}

// Função para alterar dados -->
function pgaltdados() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='alterar_dadosadm.php';
	}
}

// Função para abrir a pagina redações para corrigir -->
function red_corrigir() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='readacoes_corrigir.php';
	}
}

// Função para abrir a pagina redações corrigidas -->
function red_corrigidas() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='readacoes_corrigidas.php';
	}
}

// Função para abrir a pagina mostrar professores -->
function mostrar_professores() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_professores.php';
	}
}

// Função para abrir a pagina professores banidos -->
function mostrar_proban() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_professores_banidos.php';
	}
}

// Função para abrir a pagina sobre -->
function sobre() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='sobreadm.php';
	}
}

// Função para abrir a pagina provas professores -->
function professores() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='provasadm_adm.php';
	}
}

// Função para abrir a pagina provas usuarios -->
function prousuarios() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='provasusu_adm.php';
	}
}

// Função para abrir a pagina temas do enem -->
function tamas_enem() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='temas_enem.php';
	}
}

// Função para abrir a pagina temas usuarios -->
function temas_usuarios() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='temas_usuarios.php';
	}
}


// Função para abrir a pagina temas adm -->
function temas_adm() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='temas_professores.php';
	}
}

// Função para abrir a pagina add tema -->
function add_tema() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='adicionar_tema.php';
	}
}

// Função para abrir a visualizar imagens de perguntas -->
function verimg_per() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='verficarimg_perguntas.php';
	}
}

// Função para abrir a visualizar imagens de respostas -->
function verimg_res() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='verficarimg_respostas.php';
	}
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
    background-color: #fff;
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
    color: #000;
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
    color: #000;
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
    left: -260px;
    width: 260px;
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
    font-size: 13px;
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
    background: #fff;
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


@media (max-width: 768px){
#nav-menu-container {
    display: none;
}

#mobile-nav-toggle {
    display: inline;
}
}    </style>

<!-- Iniciando o CSS -->
<!-- Definindo características da página como um todo -->
<style>
		/* Definindo fonte e cor da página */
        body{
            font-family: Arial, Helvetica, sans-serif;
			background-color: LightBlue;
        }

		/* Definindo características da "caixa" do formulário */
        .box{
			top: 20%;
            left: 3%;
            color: black;
            position: absolute;
            background-color: white;
            padding: 15px;
            border-radius: 15px;
            width: 95%;
        }

		/* Definindo propriedades da legenda */
        legend{
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 19px;
        }

		/* Definindo caracteristicas dos botões */
        #alterarquestao{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #alterarquestao:hover{
            background-color: MediumTurquoise;
        }
        #cancelar{
            width: 64%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #cancelar:hover{
            background-color: MediumTurquoise;
        }
		#limpar{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #limpar:hover{
            background-color: MediumTurquoise;
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
        <h1><a onclick='sobre()' class="scrollto">DSENEM</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
		<li class="menu-active"><a onclick="home()">Home</a></li>

          <li class='menu-has-children'><a >Professores</a>
            <ul>
              <li><a onclick='mostrar_professores()'>Cadastrados</a></li>
			  <li><a onclick='mostrar_proban()'>Banidos</a></li>
              <li><a onclick='add_adm()'> ADD Professor</a></li>
            </ul>
			</li>
          
          <li class='menu-has-children'><a >Questões</a>
            <ul>
              <li><a onclick='visu_questoes()'>Visualizar Questões</a></li>
              <li><a onclick='add_questoes()'>ADD Questão</a></li>
			  <li class='menu-has-children'><a >Verificar Imagens</a>
                <ul>
                    <li><a onclick='verimg_per()'>Perguntas</a></li>
                    <li><a onclick='verimg_res()'>Respostas</a></li>
                </ul>
                </li>
            </ul>
          </li>
           <li class='menu-has-children'><a >Usuários</a>
            <ul>
            <li><a onclick='visu_usuarios()'>Cadastrados</a></li>
              <li><a onclick='visu_usuarios_banidos()'>Banidos</a></li>
            </ul>
          </li>

            <li class='menu-has-children'><a >Redações</a>
            <ul>
              <li><a onclick='red_corrigir()'>Para Corrigir</a></li>
              <li><a onclick='red_corrigidas()'>Corrigidas</a></li>
			  <li class='menu-has-children'><a >Temas</a>
              <ul>
                <li><a onclick='tamas_enem()'>ENEM</a></li>
                <li><a onclick='temas_usuarios()'>Usuários</a></li>
                <li><a onclick='temas_adm()'>Professores</a></li>
                <li><a onclick='add_tema()'>ADD Tema</a></li>
              </ul>
            </ul>
          </li>
          
          <li class="menu-has-children"><a >Provas</a>
            <ul>
              <li><a onclick="provas_geradas()">Minhas</a></li>
			  <li><a onclick="professores()">Professores</a></li>
              <li><a onclick="prousuarios()">Usuários</a></li>
              <li><a onclick="gerar_prova()">Criar</a></li>
            </ul>
          </li>
          <li class="menu-active"><a onclick="sair()">Sair</a></li>
          <li class="menu-active"><i class="bi bi-person-circle" title='Dados da Conta' height ='30px' width='30px' onclick="pgaltdados()"></i></li>
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

<!-- Colocando os campos para a inserção de dados -->
<body>

<!-- Caixa em volta do form -->
<font color="black" size="4">
<div class="box">
	<!-- Borda do form -->
<fieldset> 
<form action="" method="POST" enctype="multipart/form-data"> 
	


<!-- Legenda do form -->
<legend style="color:grey31; font-size:25px; font-weight: bold;">Dados Questão</legend>

<!-- Campo questão -->
<b>Questão:</b>
<br>
<textarea cols="95" rows="10" name="txtquestao" style="width: 99%;" value="text" required><?php echo $dado['pergunta']; ?></textarea>
<br><br>

<!-- Campo disciplina e opção correta -->
<div>
<b>Disciplina:</b>
<select name="disciplina">
<option value="<?php echo $nome_disciplina; ?>"><?php echo $nome_disciplina; ?></option>
<?php 
while($diciplinas = mysqli_fetch_assoc($selc_diciplinas)) { ?>
<option value="<?php echo $diciplinas["disciplina"]; ?>"><?php echo $diciplinas["disciplina"]; ?></option>
<?php } ?>
</select>
&nbsp;&nbsp;&nbsp;
<b>Opção Correta:</b>
<select name="txtrespostacorreta">
                    <option value="<?php echo $alternativa_correta; ?>"><?php echo $alternativa_correta; ?></option>
                    <option value="Letra A">Letra A</option>
                    <option value="Letra B">Letra B</option>
                    <option value="Letra C">Letra C</option>
                    <option value="Letra D">Letra D</option>
					          <option value="Letra E">Letra E</option>
                </select>
</div>
<br>

<!-- Checkbox tipo resposta -->
<b>Respostas:</b>
<br><br>
<input type="radio" name="chenimgoutex"  id="restex" value="restex">
<label for="chenimg">Texto</label>
<input type="radio" name="chenimgoutex" id="resimg" value="resimg">
<label for="chenimg">Imagem</label>
<br><br>

<script>
// Verificar se DVIs tipo resposta devem ser mostrados, após clicarem no checkbox -->
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

// Verificando se a resposta é texto ou imagem -->
// Ocultando e mostrando os DVIs corretos -->
var resimgoutex = "<?php echo $dadotipres['tipo']; ?>";
if (resimgoutex == 0) {
    document.getElementById("restex").checked = true;
    document.getElementById("resimg").checked = false;
	imgla.style.display = "none"; 
	imglb.style.display = "none"; 
	imglc.style.display = "none"; 
	imgld.style.display = "none"; 
	imgle.style.display = "none"; 
} 
else if (resimgoutex == 1) {
 	document.getElementById("resimg").checked = true;
  	document.getElementById("restex").checked = false;
  	imgla.style.display = "block"; 
	imglb.style.display = "block"; 
	imglc.style.display = "block"; 
	imgld.style.display = "block"; 
	imgle.style.display = "block"; 
}
</script>

<!-- Div Tipo resposta texto -->
<div id="divrestext" style="display: <?php echo $tiprestex; ?>;">
<label style="left:40px; margin-right:5px;">Letra A:</label> <input type="text" name="txtletraa" style="width: 90%;" id="txtletraa" value="<?php echo $letraa; ?>">
<br><br>
<label style="left:40px; margin-right:5px;">Letra B:</label> <input type="text" name="txtletrab" style="width: 90%;" id="txtletrab" value="<?php echo $letrab; ?>">
<br><br>
<label style="left:40px; margin-right:5px;">Letra C:</label> <input type="text" name="txtletrac" style="width: 90%;" id="txtletrac" value="<?php echo $letrac; ?>">
<br><br>
<label style="left:40px; margin-right:5px;">Letra D:</label> <input type="text" name="txtletrad" style="width: 90%;" id="txtletrad" value="<?php echo $letrad; ?>">
<br><br>
<label style="left:40px; margin-right:5px;">Letra E:</label> <input type="text" name="txtletrae" style="width: 90%;" id="txtletrae" value="<?php echo $letrae; ?>">
<br><br>
</div>

<!-- Div Tipo resposta imagem -->
<!-- Div resposta A -->
<div id="divresimg" style="display: <?php echo $tipresimg; ?>;">
<font size="3" color="red">
Tipos aceitos: JPG, JPEG, PNG.
<br><br>
</font>
<label style="left:40px; margin-right:5px;">Letra A:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimga" style="font-size:15px">
<br><br>
<div id="imgla">
<img src="img_res/<?php echo $letraaimg; ?>" width="310">
<br><br>
</div>

<!-- Div resposta B -->
<label style="left:40px; margin-right:5px;">Letra B:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimgb" style="font-size:15px">
<br><br>
<div id="imglb">
<img src="img_res/<?php echo $letrabimg; ?>" width="310">
<br><br>
</div>

<!-- Div resposta C -->
<label style="left:40px; margin-right:5px;">Letra C:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimgc" style="font-size:15px">
<br><br>
<div id="imglc">
<img src="img_res/<?php echo $letracimg; ?>" width="310">
<br><br>
</div>

<!-- Div resposta D -->
<label style="left:40px; margin-right:5px;">Letra D:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimgd" style="font-size:15px">
<br><br>
<div id="imgld">
<img src="img_res/<?php echo $letradimg; ?>" width="310">
<br><br>
</div>

<!-- Div resposta E -->
<label style="left:40px; margin-right:5px;">Letra E:</label><input type="file" accept=".png,.jpg,.jpeg" name="resimge" style="font-size:15px">
<br><br>
<div id="imgle">
<img src="img_res/<?php echo $letraeimg; ?>" width="310">
<br><br>
</div>
</div>

<!-- Checkbox para possui imagem -->
<b>Possui imagem?</b>
<br>
<input type="radio" name="chepimg"  id="spimg" value="spimg">
<label for="chepimg">Sim</label>
<input type="radio" name="chepimg" id="npimg" value="npimg">
<label for="chepimg">Não</label>
<br><br>

<!-- Iniciando java para verificar checbox -->
<script>
// Verificando se os DVI quetão imagem deve ser mostrado, após clicar no checbox -->
var spimg = document.querySelector("#spimg");
spimg.addEventListener("click", function() { 
divimgques.style.display = "block"; 
});

var npimg = document.querySelector("#npimg");
npimg.addEventListener("click", function() { 
divimgques.style.display = "none"; 
});

// Verificando se pergunta possui imagem e deve ser mostrada -->
var pimg = "<?php echo $dadotipper['imagem']; ?>";
  if (pimg === "Não possui") {
    document.getElementById("npimg").checked = true;
    document.getElementById("spimg").checked = false;
} 
else {
  document.getElementById("spimg").checked = true;
  document.getElementById("npimg").checked = false;
}
</script>

<!-- Div possui imagem -->
<div id="divimgques" style="display: <?php echo $pimg; ?>;;">
<input type="file" accept=".png,.jpg,.jpeg" name="arquivo" style="font-size:15px">
<br><br>
<div id="divbtnimgques" style="display: <?php echo $pimg; ?>;;">
<img src="uploads/<?php echo $dado['imagem']; ?>" width="310">
</div>
</div>
<br><br>

<!-- Botões de alterar, restaurar form e cancelar -->
<center>
<input type="submit" name="alterarquestao" id="alterarquestao" value="Alterar">    
<button onclick="restaurar()" id="limpar">Restaurar</button>
</form>
</center>
<br> 

<center>
<button onclick="voltar()" id="cancelar">Cancelar</button>
</center>
<!-- Fechando tags abertas -->
</fieldset>

</div>
</font>
</body>
</html>