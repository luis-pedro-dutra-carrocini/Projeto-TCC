<!-- Iniciando PHP -->

<?php



// Iniciando sessão

session_start();



// Conectando com o banco de dados

include('conexao.php');



// Verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_adm"]))

{



  // Redirecionando para a pagina index, pois a sessão não foi iniciada

  header('location: index.php');

  exit;

}else{



  // Obtendo o nome do adm via sessão

  $nome = $_SESSION["nome_adm"];

  include_once('conexao.php');

  

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

  $niveladm = $dado['nivel'];



  // Obtendo o codigo do adm

  $codigo_adm = $dado['codigo'];



  // Verificando o nivel do adm

  if ($niveladm == "admgeral" || $niveladm == "adm" || $niveladm == "corretor"){

  }

  else{



    // Redirecionando para a pagina adm, pois o nivel de adm não condiz com a pagina atual

    header('location: pagina_adm.php');

    exit;

  }

}



// Obtendo o codigo da redação

$codigo_red = $_GET['codigo'];



// Verificando se o codigo chedou via GET

if (empty($codigo_red)){



  // redirecioando para a pagina redações para corrigir, pois o codigo não chegou

	header('location: readacoes_corrigir.php');

  exit;

}



// Dados a serem mostrados

$select_redacao = mysqli_query($conexao, "SELECT * FROM tabela_redacoes WHERE codigo = $codigo_red and (situacao = 0 or codigo_adm = $codigo_adm);");

$dados_redacao = $select_redacao->fetch_array();



// Verificação da redação

$verifica_existe = $dados_redacao['tema'];





// Verificando se a redação existe

if (empty($verifica_existe)){

	header('location: readacoes_corrigir.php');

  exit;

}


// Obtendo o tema da redação

$tema_antigo = $dados_redacao['tema'];





// Verificando o tipo da redação

// Se for do tipo texto

if ($dados_redacao['tipo'] == 0){



  // Obtendo o valor da redação

$texto_antigo = $dados_redacao['texto_naocorrigido'];



// Deixando o nome do arquivo como nulo

$nome_arquivo = "";



// Selecionando as checkbox devidas

// Deixando os campos devidos como visiveis

$chetexto = "checked";

$mostexto = "block";



$cheanexo = "";

$mosanexo = "none";



// Se for do tipo arquivo

}elseif ($dados_redacao['tipo'] == 1){



    // Defifindo o valor do texto como nulo

    $texto_antigo = "";



    // Obtendo o nome do arquivo

    $nome_arquivo = $dados_redacao['texto_naocorrigido'];



    // Selecionando as checkbox devidas

    // Deixando os campos devidos como visiveis

    $chetexto = "";

    $mostexto = "none";

    

    $cheanexo = "checked";

    $mosanexo = "block";

}



// Obtendo a data de envio ajustada

$data_semcon = $dados_redacao['data_envio'];

$data_envio = date('d/m/Y',  strtotime($data_semcon));



// Verificando a situação da prova

// Se ja foi corrigida antes

if ($dados_redacao['situacao'] == 1){



    // Obtendo o comentario antigo

    $comentario_antigo = $dados_redacao['comentario'];



    // Obtendo a pontuação antiga

    $pontuacao_antiga = $dados_redacao['pontuacao'];



    // Verificando o tipo da correção

    if ($dados_redacao['tipo_correcao'] == 0){



        // Deixando os camos devidos como visiveis

        // Selecioando as checkbox devidas

        $mostexcorr = "block";



        // Obtendo o texto da redação

        $texcorr = $dados_redacao['texto_corrigido'];



        // Definindo o nome do arquivo como nulo

        $nomearquivo_corr = "";

        $mosanecorr = "none";

    }elseif ($dados_redacao['tipo_correcao'] == 1){



        // Deixando os camos devidos como visiveis

        // Selecioando as checkbox devidas

        $mostexcorr = "none";



        // definindo o texto da questão como nulo

        $texcorr = "";



        // Obtendo o nome do arquivo

        $nomearquivo_corr = $dados_redacao['texto_corrigido'];

        $mosanecorr = "block";

    }

}else{



  // definindo todos os campos como nulos, pois a redção nunca foi corrigida

    $pontuacao_antiga = "";

    $comentario_antigo = "";

    $nomearquivo_corr = "";

    $texcorr = "";

    $mosanecorr = "none";

}



// Quando clicar no botão enviar correção

if (isset($_POST['enviarcorrecao'])){



    // obtendo a pontuação

    $pontuacao = $_POST['pontuacao'];



    // Obtendo o comentario

    $comentario = $_POST['comentario'];



    // Verificando o tipo da correção

    // Se for do tipo texto

    if ($_POST['chetipored'] == "texto"){



        // Verificando se o campo não esta nulo

        if ($_POST['txtredacao'] != ""){



        // Obtendo o texto da redação

        $textored = $_POST['txtredacao'];

        }else{



          // Emitindo mensagem de erro

          $script = "<script>alert('Erro: Não foi possivel enviar a Redação. Campo de Texto de ve ser preechido.');location.href='nova_redacao.php';</script>";

          echo $script;

          exit;

        }



        // Definindo o tipo da redação como texto para por no bd

        $tipored = 0;



      // Se for do tipo arquivo

      }elseif ($_POST['chetipored'] == "anexo"){



        //// Definindo o tipo da redação como arquivo para por no bd

        $tipored = 1;



        // Verificando se o arquivo foi selecionado

        if (!empty($_FILES['arquivo']['name'])){



                // Obtendo o nome do arquivo

                $nomearquivo = $_FILES['arquivo']['name'];



                // Obtendo o tipo do arquivo

                $tipo = $_FILES['arquivo']['type'];



                // Obtendo o nome temporario

                $nometemporario = $_FILES['arquivo']['tmp_name'];



                // Definindo os tipos permitidos

                // DOCX, PDF, TXT.

                $tipospermitidos = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/pdf","text/plain"];

    

                // Verificando o tipo do arquivo

                if (!in_array ($tipo, $tipospermitidos)){



                  // Emitindo mensagem de erro

                    $script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo não permitido no anexo. Tipo: $tipo');location.href='nova_redacao.php';</script>";

                    echo $script;

                    exit;

                }

    

                // Definindo a pasta para ser salvo o arquivo

                $caminho = "redacoes/";



                // Ajustando a data para o Brasil

                date_default_timezone_set('America/Sao_Paulo');

                $hoje = date("d-m-Y_H-i-s", time());



                // Definindo um nome para o arquivo

                $nomeimgla = $hoje."-".$nomearquivo;

                $textored = $nomeimgla;

                

                // Salvando o arquivo

                if (move_uploaded_file($nometemporario, $caminho.$nomeimgla)){

                }

                else{



                    // Emitindo mensagem de erro

                    $script = "<script>alert('Erro ao salvar o naexo.');location.href='nova_redacao.php';</script>";

                    echo $script;

                    exit;

                }

            }

            else{



                //Emitindo mensagem de erro, pois o aruivo não foi selecionado

                $script = "<script>alert('Erro: Anexo não selecionado.');location.href='nova_redacao.php';</script>";

                echo $script;

                exit;

            }

      }else{



        // Mantendo o arquivo

        $textored = $_POST['txtredacao'];

      }



  // Ajustando a data para o Brasil

  date_default_timezone_set('America/Sao_Paulo');



  // Obtendo a dta de envio da correção

  $hoje = date('Y/m/d');



  // Enviando a correção

  $result = mysqli_query($conexao, "UPDATE tabela_redacoes SET texto_corrigido='".addslashes($textored)."',data_correcao='$hoje', comentario='$comentario', pontuacao=$pontuacao, codigo_adm=$codigo_adm, situacao = 1, tipo_correcao = $tipored WHERE codigo=$codigo_red;");

  $script = "<script>alert('Redação corrigida com Sucesso.');location.href='readacoes_corrigir.php';</script>";

  echo $script;



}



?>



<!-- Inicaisndo o corpo da página -->

<!DOCTYPE HTML>

<html>



<!-- Definindo caracteristicas basicas para a pagina, como titulo e acentuação -->

<meta charset="UTF-8">  

<title>Corrigir Redação</title>



<!-- Definindo um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- Definindo caracteristicas para o corpo da página -->

<body style="background-color: black;">



<!-- iniciando java -->

<script>



// Função para sair da conta -->

function sair() {

  var resultado = confirm("Deseja Realmente sair dessa Conta?")

    if (resultado == true) {

      location.href='sair.php';

    }

}



function cancelar() {

      location.href='readacoes_corrigir.php';

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

            width: 49%;

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

width: 49%;

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

width: 49%;

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
	if ($niveladm =="admgeral" || $niveladm == "adm"){echo "
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
		<li><a href='adicionar_questao.php'>ADD Questão</a></li>
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


	if ($niveladm =="admgeral" || $niveladm == "adm" || $niveladm == "corretor"){echo"
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

	if ($niveladm =="corretor"){echo"
	<li><a href='pagina_adm.php?mos_tabques=Todas'>Questões</a></li>";
	}
	}

	if ($niveladm !="admgeral" && $niveladm != "adm"){echo "
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





<!-- Inserindo campos para a inserção de daos -->

<body>



<!-- Caixa em volta do form -->

<font color="black" size="4">
<center>
<div class="box" align="left">

<form action="" method="POST" enctype="multipart/form-data"> 

	

<!-- Borda do form -->

<!-- Legenda do form -->

<legend style="color:grey31; font-size:25px; font-weight: bold;">Redação</legend>



<!-- Campo a data de envio da redação, com suas propriedades -->

<b>Data de envio:</b> <?php echo $data_envio; ?>

<br><br>



<!-- Campo tema da redação, com suas propriedades -->

<b>Tema:</b> <?php echo $tema_antigo; ?>

<br><br>

<!-- Campo tipo da redação, com suas propriedades -->

<b>Redação:</b>

<br>



<!-- Div texto redação -->

<div id="divrestext" style="display: <?php echo $mostexto; ?>;">

<?php print "<p>".nl2br($texto_antigo)."</p>"; ?>

<br><br>

</div>



<!-- Divi arquivo da redação -->

<div id="divresimg" style="display: <?php echo $mosanexo; ?>;">

<br>

Arquivo: <a href="redacoes/<?php echo $nome_arquivo;?>" download><?php echo $nome_arquivo;?></a>

<br>

</div>



<!-- Mostrando os valores da correção -->

<b>Redação Corrigida:</b>

<br>

<input type="radio" name="chetipored"  id="restex" value="texto" checked >

<label for="chenimg">Texto</label>

<input type="radio" name="chetipored" id="resimg" value="anexo">

<label for="chenimg">Anexo</label>

<br>

<div id="divrestextcor" style="display: <?php echo $mostexcorr; ?>;">

<textarea cols="95" style="width: 99%; border: 2px solid white; color:white; background-color: black;" rows="15" style="width: 99%;" name="txtredacao" value="text"><?php echo $texcorr; ?></textarea>

<br><br>

</div>

<div id="divresimgcor" style="display: <?php echo $mosanecorr; ?>;">

<font size="3" color="red">

Tipos aceitos: DOCX (Word), PDF, TXT.

<br>

</font>

<input type="file" name="arquivo" accept=".docx,.pdf,.txt" style="font-size:15px">

<br>

<div id="arquivocorred" style="display: <?php echo $mosanecorr; ?>;">

Arquivo: <a href="redacoes/<?php echo $nomearquivo_corr;?>" download><?php echo $nomearquivo_corr;?></a>

</div>

</div>

<br>


<b>Comentário:</b>

<textarea cols="95" style="width: 99%; border: 2px solid white; color:white; background-color: black;" rows="5" style="width: 99%;" name="comentario" value="text" required><?php echo $comentario_antigo; ?></textarea>

<br><br>



<b>Pontuação:</b>

<input type="number" style="width: 50%; border: 2px solid white; color:white; background-color: black;" maxlength="4" name="pontuacao" style="width: 10%;" required value="<?php echo $pontuacao_antiga; ?>">

<br><br>



<!-- Botões adicionar, limpar  cancelar -->

<center>

<input type="submit" name="enviarcorrecao" id="adcionarquestao" value="Enviar Correção">    

<input type="reset" name="limpar" id="limpar" value="Restaurar">  

</form> 

</center>

<br>



<center>

<button onclick="cancelar()" id="cancelar">Cancelar</button> 

</center>



<script>

// Verificando se o checkbox tipo texto esta selecionado

var chetex = document.querySelector("#restex");

chetex.addEventListener("click", function() {

divrestextcor.style.display = "block"; 

divresimgcor.style.display = "none"; 

});



// Verificando se o checkbox tipo imagem esta selecionado

var cheimg = document.querySelector("#resimg");

cheimg.addEventListener("click", function() {

divrestextcor.style.display = "none"; 

divresimgcor.style.display = "block"; 

});



</script>





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



<!-- Fechando tags abertas -->

</div>
</center>
</font>

<br<br><br>



</body>

</html>