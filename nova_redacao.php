<!-- Iniciando PHP -->

<?php



// Inicinado sessão

session_start();



// Verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){



  // Redirecionabdo para a pagina index, pois a sessão não existe

  header('location: index.php');

  exit;

}else{



  // Verificando se o usuario é recente ou antigo

  // Antigo

  if(isset($_SESSION["senha_usuario"])){



    // Obtendo o nome do usuario

    $nome_usuario = $_SESSION["nome_usuario"];

  }



  // Recente

  elseif(isset($_SESSION["nome_cad"])){



    // Obtendo o nome do usuario

    $nome_usuario = $_SESSION["nome_cad"];

  }

}



// Iniciando conexao com o bd

include_once("conexao.php");



// Selecionando dados do usuario

$select_usuario = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome_usuario';");



// Verificando se o usuário existe no bd

if($select_usuario->num_rows > 0){

  $dados_usuario = $select_usuario->fetch_array();

  }else{



    // Voltando para o index, pois o usuario não existe

    header('location: index.php');

    exit;

  }



// Obtendo o codigo do usuario

$codigo_usuario = $dados_usuario['codigo_usuario'];



// Quando clicar no botão enviar

if (isset($_POST['enviarredacao'])){


  // Verificando o tipo do tema

  if (isset($_POST['tipotema'])){



  // Elaborado por mim

  if ($_POST['tipotema'] == "pormim"){



  // Obtendo o tema

  $tema = trim($_POST['txttema']);



  // Verificando se o tema não esta nulo

  if ($tema == ""){



    // Emitindo mensagem de erro

		$script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não pode ser nulo.');location.href='nova_redacao.php';</script>";

		echo $script;

		exit;

  }



  // Caiu no enem

  }elseif ($_POST['tipotema'] == "enem"){



  // Verificando se algum tema foi selecionado

  if (isset($_POST['temaenem'])){



  // Obtendo o codigo do tema 

  $codtemaenem = $_POST['temaenem'];

  }else{



    // Definindo o codigo para 0

    $codtemaenem = 0;

  }



  // Selecionando os dados desse tema para acrescentar na redação

  $sqltemaenem = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where (tipo = 0 and codigo = $codtemaenem);");

  $dados_temaenem = $sqltemaenem->fetch_array();



  // Verificando se o tema realmente existe 

  if($sqltemaenem->num_rows > 0){



  // Obtendo o tema

  $tema = $dados_temaenem['tema'];

  }else{



    // Emitindo mensagem de erro

		$script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não encontrado.');location.href='nova_redacao.php';</script>";

		echo $script;

		exit;

  }



  // Elaborado pro professor

  }elseif ($_POST['tipotema'] == "professor"){



    // Verificando se algum tema foi selecionado

    if (isset($_POST['temaprof'])){



    // Obtendo o codigo do tema 

    $codtemaprofessor = $_POST['temaprof'];

    }else{



      // Definindo o codigo para 0

      $codtemaprofessor = 0;

    }

  

    // Selecionando os dados desse tema para acrescentar na redação

    $sqltemaprofessor = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where (tipo = 1 and codigo = $codtemaprofessor);");

    $dados_temaprofessor = $sqltemaprofessor->fetch_array();

  

  // Verificando se o tema realmente existe 

  if($sqltemaprofessor->num_rows > 0){



    // Obtendo o tema

    $tema = $dados_temaprofessor['tema'];

    }else{

  

      // Emitindo mensagem de erro

      $script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não encontrado.');location.href='nova_redacao.php';</script>";

      echo $script;

      exit;

    }

  

  // Elaborado pro usuario

  }elseif ($_POST['tipotema'] == "usuario"){



    // Verificando se algum tema foi selecionado

    if (isset($_POST['temausuario'])){



    // Obtendo o codigo do tema 

    $codtemausuario = $_POST['temausuario'];

    }else{



      // Definindo o codigo para 0

      $codtemausuario = 0;

    }

  

    // Selecionando os dados desse tema para acrescentar na redação

    $sqltemausuario = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where (tipo = 2 and codigo = $codtemausuario);");

    $dados_temausuario = $sqltemausuario->fetch_array();

  

    // Verificando se o tema realmente existe 

    if($sqltemausuario->num_rows > 0){



    // Obtendo o tema

    $tema = $dados_temausuario['tema'];

    }else{

  

      // Emitindo mensagem de erro

      $script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não encontrado.');location.href='nova_redacao.php';</script>";

      echo $script;

      exit;

    }

  }

  }



  // Verificando se mais alguem alem do professor cerretor pode ver a redação

  // Somnete eu

  if ($_POST['chevisu'] == "eu"){

    $visu = 0;



  // Todos os usuarios

  }elseif ($_POST['chevisu'] == "todos"){

    $visu = 1;

  }else{

    $visu = 0;

  }



  // Verificando o tipo de redação

  // Tipo texto

  if ($_POST['chetipored'] == "texto"){



    // Obtendo o texto da redação

    $textored = trim($_POST['txtredacao']);



    // Verificando se o texto da redação não esta nulo

    if ($textored != ""){

    }else{



      // Emitindo mensagem de erro

      $script = "<script>alert('Erro: Não foi possivel enviar a Redação. Campo de Texto deve ser preechido.');location.href='nova_redacao.php';</script>";

      echo $script;

			exit;

    }



    // Definindo o tipo da redação como texto

    $tipored = 0;



  // Tipo anexo

  }elseif ($_POST['chetipored'] == "anexo"){



    // Definindo o tipo da redação como anexo

    $tipored = 1;



    // Verificando se o anexo foi escolhido

    if (!empty($_FILES['arquivo']['name'])){



      // Obtendo o nome do arquivo

			$nomearquivo = $_FILES['arquivo']['name'];



      // Obtendo o tipo

			$tipo = $_FILES['arquivo']['type'];



      // Obtendo o nome temporario do arquivo

			$nometemporario = $_FILES['arquivo']['tmp_name'];



      // definindo os tipos aceitos

			$tipospermitidos = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/pdf","text/plain"];



      // Verificando se o tipo é aceito

			if (!in_array ($tipo, $tipospermitidos)){



        // Emitindo mensagem de erro

				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo não permitido no anexo. Tipo: $tipo');location.href='nova_redacao.php';</script>";

				echo $script;

				exit;

			}



      // Definindo o caminho

			$caminho = "redacoes/";



      // Ajustando a data e obtendo-a

			date_default_timezone_set('America/Sao_Paulo');

			$hoje = date("d-m-Y_H-i-s", time());



      // Definindo o nome do arquivo a ser salvo

			$nomeimgla = $hoje."-".$nomearquivo;



      // definindo o texto da redação como o nome do arquivo

      $textored = $nomeimgla;

			

      // salvando o arquivo

			if (move_uploaded_file($nometemporario, $caminho.$nomeimgla)){

			}

			else{



        // Emitindo mensagem de erro

				$script = "<script>alert('Erro ao salvar o anexo.');location.href='nova_redacao.php';</script>";

				echo $script;

				exit;

			}

		}

		else{



      // Emitindo mensagem de erro pois nenhum arquivo foi selecionado

			$script = "<script>alert('Erro: Anexo não selecionado.');location.href='nova_redacao.php';</script>";

			echo $script;

			exit;

		}

  }else{



    // Definindo o texto da redação, caso ocorra um erro

    $textored = trim($_POST['txtredacao']);



  // Verificando se o tema não esta nulo

  if ($tema == ""){



    // Emitindo mensagem de erro

		$script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não pode ser nulo.');location.href='nova_redacao.php';</script>";

		echo $script;

		exit;

  }

  }



  // Ajustando a data 

  date_default_timezone_set('America/Sao_Paulo');

	$hoje = date('Y/m/d');



  // Salvando o tema caso ele não exista

  if ($_POST['tipotema'] == "pormim"){



    // Selecionando os dados desse tema para acrescentar na redação

    $sqltema = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tema = '".addslashes($tema)."';");



    // Verificando se o tema já existe 

    if($sqltema->num_rows < 1){



      // Obtendo o ano atual

      $ano = date('Y');



      // Cadastrando o tema

      $result = mysqli_query($conexao, "INSERT into tabela_temasredacoes(tema, ano, tipo) values('".addslashes($tema)."', $ano, 2)");

    }



  }

  

  // Enviando a redação

  $result = mysqli_query($conexao, "INSERT into tabela_redacoes(codigo_usuario, texto_naocorrigido, data_envio, tema, visualizacao, tipo, situacao) values($codigo_usuario, '".addslashes($textored)."', '$hoje', '".addslashes($tema)."', $visu, $tipored, 0)");



  // Emitindo amnesagem de sucesso

  $script = "<script>alert('Redação enviada com Sucesso.');location.href='minhas_redacoesusu.php';</script>";

  echo $script;

  exit;

}



?>



<!-- Inicaisndo o corpo da página -->

<!DOCTYPE HTML>

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">  

<title>Escrever Redação</title>



<!-- Definindo um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



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



// Função para sair da conta -->

function voltar() {

  var resultado = confirm("Deseja Realmente cancelar a Redação?")

    if (resultado == true) {

      location.href='pagina_usuarios.php';

    }

}



// Função para abrir a pagina alterar dados

function Alterar_Dados() {

      location.href='alterar_dadosusuario.php';

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


legend{

padding: 10px;

text-align: center;

border-radius: 8px;

font-size: clamp(1em, 1em + 2vw, 1.5em);

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

        <!-- <a href="sobreusu.php"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-active"><a href="pagina_usuarios.php">Home</a></li>

        <li><a href='mostrar_provas.php'>Provas</a></li>

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

              <li><a href="gerar_simucomcad.php">Completos</a></li>

              <li><a href="gerar_simusimcad.php">Personalizados</a></li>

              <li><a href="minhas_provas_Usuario.php">Meus Simulados</a></li>

              <li><a href="simu_feitoporadms.php">Feitos por Professores</a></li>

              <li><a href="simu_feitoporusuarios.php">Feitos por Usuários</a></li>

            </ul>

          </li>



          <li class="menu-has-children"><a >Redações</a>

            <ul>

              <li><a href="minhas_redacoesusu.php">Minhas</a></li>

              <li><a href="redacoes_todosusuarios.php">Outros usuários</a></li>

            </ul>

          </li>

            <ul>

              <li><a href="gerar_simucomcad.php">Completos</a></li>

              <li><a href="gerar_simusimcad.php">Personalizados</a></li>

              <li><a href="simu_feitoporadms.php">Feitos por Professores</a></li>

              <li><a href="simu_feitoporusuarios.php">Feitos por Usuários</a></li>

            </ul>

          </li>



		      <li><a href="todasprovas_realizadasusu.php">Evolução</a></li>

          <li><a href="ranking_usuarios.php">Ranking</a></li>

          

          

          <li><a href="alterar_dadosusuario.php">Dados</a></li>
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

<legend style="color:grey31; font-size: clamp(1em, 1em + 1vw, 1.5em); font-weight: bold;">Redação</legend>



<!-- Campo tema da redação, com suas propriedades -->

<b>Tema:</b>
<select name="tipotema" id="tipotema" onchange="ver()" style="border: 2px solid white; color:white; background-color: black;">
<option value="pormim">Elaborado por mim</option>
<option value="professor">Elaborado por Professores</option>
<option value="usuario">Elaborado por Usuários</option>
<option value="enem">ENEM</option>
</select>
<br><br>

<div id="divmeutema">
<b>Descrição Tema:</b>
<input type="text" style="width: 99%; border: 2px solid white; color:white; background-color: black;" name="txttema" style="width: 99%;" maxlength="300"  id="txttema">

<br><br>

</div>



<!-- Tamas professores -->

<div id="divtemaprof" style="display: none;">



<!-- Iniciando PHP -->

<?php



// Obtendo temas a serem mostrados

$sqltemaprof = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 1 order by ano, tema;");



// verificando se tem algum tema elaborado por usuarios

if ($sqltemaprof->num_rows > 0){

echo "<b>Selecione o Tema:</b><br>";
echo "<select name='temaprof' style='border: 2px solid white; color:white; background-color: black; width: 99%;'>";

// Criando loop

while ($dadotemaprof=$sqltemaprof->fetch_array()) { 

// Obtendo o codigo do tema
$codigo_temaprof = $dadotemaprof['codigo'];

echo "<option value='".$codigo_temaprof."'>".$dadotemaprof['tema']." - ".$dadotemaprof['ano']."</option>";

}

echo "</select><br>";

}else{

  echo "Nenhum tema encontrado <br>";

}



?>

<br>

</div>



<!-- Temas ENEM -->

<div id="divtemaenem" style="display: none;">



<!-- Iniciando PHP -->

<?php



// Obtendo temas a serem mostrados

$sqltemaenem = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 0 order by ano, tema;");



// verificando se tem algum tema elaborado por usuarios

if ($sqltemaenem->num_rows > 0){

echo "<b>Selecione o Tema:</b><br>";
echo "<select name='temaenem' style='border: 2px solid white; color:white; background-color: black; width: 99%;'>";

// Criando loop
while ($dadotemaenem=$sqltemaenem->fetch_array()) { 



// Obtendo o codigo do tema

$codigo_temaenem = $dadotemaenem['codigo'];

echo "<option value='".$codigo_temaenem."'>".$dadotemaenem['tema']." - ".$dadotemaenem['ano']."</option>";

}
echo "</select><br>";

}else{



  echo "Nenhum tema encontrado <br>";

}



?>

<br>



</div>



<!-- temas Usuarios -->

<div id="divtemausu" style="display: none;">



<!-- Iniciando PHP -->

<?php



// Obtendo temas a serem mostrados

$sqltemausu = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 2 order by ano, tema;");



// verificando se tem algum tema elaborado por usuarios

if ($sqltemausu->num_rows > 0){

echo "<b>Selecione o Tema:</b><br>";
echo "<select name='temausuario' style='border: 2px solid white; color:white; background-color: black; width: 99%;'>";

// Criando loop

while ($dadotemausu=$sqltemausu->fetch_array()) { 


// Obtendo o codigo do tema

$codigo_temausu = $dadotemausu['codigo'];

echo "<option value='".$codigo_temausu."'>".$dadotemausu['tema']." - ".$dadotemausu['ano']."</option>";

}
echo "</select><br>";

}else{



  echo "Nenhum tema encontrado <br>";

}



?>

<br>



</div>


<!-- Campo tipo da redação, com suas propriedades -->

<b>Tipo de envio:</b>

<br>

<input type="radio" name="chetipored"  id="restex" value="texto" checked >

<label for="chenimg">Texto</label>

<input type="radio" name="chetipored" id="resimg" value="anexo">

<label for="chenimg">Anexo</label>

<br>

<div id="divrestext">

<textarea cols="95" style="width: 99%; border: 2px solid white; color:white; background-color: black;" rows="15" style="width: 99%;" name="txtredacao" value="text"></textarea>

<br><br>

</div>

<div id="divresimg" style="display: none;">

<font size="3" color="red">

Tipos aceitos: DOCX (Word), PDF, TXT.

<br>

</font>

<input type="file" name="arquivo" accept=".docx,.pdf,.txt" style="font-size:15px">

</div>

<br>

<!-- Campo visualizar redação, com suas propriedades -->

<b>Visualização:</b>

<br>

<input type="radio" name="chevisu"  id="chevissim" value="eu" checked >

<label for="chevissim">Somente eu</label>

&nbsp;&nbsp;

<input type="radio" name="chevisu" id="chevissim" value="todos">

<label for="chevisnao">Todos</label>

<br><br>



<!-- Botões adicionar, limpar  cancelar -->

<center>

<input type="submit" name="enviarredacao" id="adcionarquestao" value="Enviar Redação">    

<input type="reset" name="limpar" id="limpar" value="Limpar">   

</form> 

<button onclick="voltar()" id="cancelar" name="cancelar">Cancelar</button>

</center>



<script>
function ver() {

  var sqltipotema = document.getElementById("tipotema");
  var tipotema = sqltipotema.options[sqltipotema.selectedIndex].value;
            
            if ((tipotema == "pormim")){
              divtemaenem.style.display = "none"; 

              divtemaprof.style.display = "none"; 

              divmeutema.style.display = "block"; 

              divtemausu.style.display = "none"; 

            }else if ((tipotema == "professor")){
              divtemaenem.style.display = "none"; 

              divtemaprof.style.display = "block"; 

              divmeutema.style.display = "none"; 

              divtemausu.style.display = "none"; 

            }else if ((tipotema == "usuario")){
              divtemaenem.style.display = "none"; 

              divtemaprof.style.display = "none"; 

              divmeutema.style.display = "none"; 

              divtemausu.style.display = "block"; 

            }else if ((tipotema == "enem")){
              divtemaenem.style.display = "block"; 

              divtemaprof.style.display = "none"; 

              divmeutema.style.display = "none"; 

              divtemausu.style.display = "none"; 

            }

           };

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
<!-- Fechando tags abertas -->
</div>
</center>
<br><br>

<center>
<div style="width: 90%; height:75px;">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1724042721194868"
     crossorigin="anonymous"></script>
<!-- bloco3 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1724042721194868"
     data-ad-slot="8102388707"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</center>
<br><br>

</font>
</body>
</html>