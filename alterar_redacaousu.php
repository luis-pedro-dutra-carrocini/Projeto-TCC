<!-- Iniciando PHP -->

<?php



// Iniciando sessão

session_start();



// verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){



  // Redirecionando para a pagina index, pois a sessão não foi iniciada

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



// iniciando conexao com o bd

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



// codigo do usuario

$codigo_usuario = $dados_usuario['codigo_usuario'];



// Obtendo o codigo da redação

$codigo_red = $_GET['codigo'];



// Verificando se o código chegou via GET

if (empty($codigo_red)){



  // Redirecionando para a pagina minhas redações

	header('location: minhas_redacoesusu.php');

  exit;

}



// Dados a serem mostrados

$select_redacao = mysqli_query($conexao, "SELECT * FROM tabela_redacoes WHERE (codigo = $codigo_red and codigo_usuario = $codigo_usuario and situacao = 0);");

$dados_redacao = $select_redacao->fetch_array();



// Obtendo os dados para ver se a redação existe

$verifica_existe = $dados_redacao['tema'];



// verificando se a redação realmente existe

if (empty($verifica_existe)){



  // redirecionando para a pagina minhas redações, pois a redação não existe

	header('location: minhas_redacoesusu.php');

  exit;

}

// Obtendo o tema antigo

$tema_antigo = $dados_redacao['tema'];



// Obtendo os dados do tema 

$select_tema = mysqli_query($conexao, "SELECT * FROM tabela_temasredacoes WHERE tema = '$tema_antigo';");

$dados_tema = $select_tema->fetch_array();



// Obtendo o codigo do tema

$codigo_tema = $dados_tema['codigo'];



// Verificando qual é o tipo do tema

// Se for do ENEM

if ($dados_tema['tipo'] == 0){



  // Ajustando visibilidade dos divs

  $mostemaenem = "block";

  $mostemaprof = "none";

  $mostemameu = "none";



  // Ajustando radios botões

  $tipo_tema = "ENEM";
  $value_tema = "enem";



  // Tema a ser mostradp no meu tema

  $temamos = "";



// Se for de professores

}elseif ($dados_tema['tipo'] == 1){



  // Ajustando visibilidade dos divs

  $mostemaenem = "none";

  $mostemaprof = "block";

  $mostemameu = "none";



  $tipo_tema = "Elaborado por Professores";
  $value_tema = "professor";


  // Tema a ser mostradp no meu tema

  $temamos = "";



// Se for meu ou de outros usuarios

}elseif ($dados_tema['tipo'] == 2){



  // Ajustando visibilidade dos divs

  $mostemaenem = "none";

  $mostemaprof = "none";

  $mostemameu = "block";



  $tipo_tema = "Elaborado por mim";
  $value_tema = "pormim";



  // Tema a ser mostradp no meu tema

  $temamos = $tema_antigo;

}



// Verificando o tipo da redação

// Se for tipo texto

if ($dados_redacao['tipo'] == 0){



// Obtendo a redação

$texto_antigo = $dados_redacao['texto_naocorrigido'];



// deixando o nome do arquivo como vazio, pois não existe

$nome_arquivo = "";



// Ajustando os botões de radio

$chetexto = "checked";

$mostexto = "block";



// Definindo div de anexo como invizivel

$cheanexo = "";

$mosanexo = "none";



// Se for do tipo arquivo

}elseif ($dados_redacao['tipo'] == 1){



    // Definindo o texto da redação como vazio

    $texto_antigo = "";



    // Obtendo o nome do arquivo

    $nome_arquivo = $dados_redacao['texto_naocorrigido'];



    // Ajustando os botões de radio

    $chetexto = "";

    $mostexto = "none";

    

    // Definindo div de texto como invizivel

    $cheanexo = "checked";

    $mosanexo = "block";

}



// Verificando que pode ver a redação

// Somente eu

if ($dados_redacao['visualizacao'] == 0){



    // ajustando os botões de radio

    $cheeu = "checked";

    $chetodos = "";



// Todos

}elseif ($dados_redacao['visualizacao'] == 1){



    // ajustando os botões de radio

    $cheeu = "";

    $chetodos = "checked";

}



// Quando clocar no botão reenviar redação

if (isset($_POST['enviarredacao'])){

  // Verificando quem pode ver a redação

  // Somente eu

  if ($_POST['chevisu'] == "eu"){

    $visu = 0;



  // Todos

  }elseif ($_POST['chevisu'] == "todos"){

    $visu = 1;

  }else{



  // Somente eu

    $visu = 0;

  }



  // Verificando o tipo do tema

  if (isset($_POST['tipotema'])){



    // Elaborado por mim

    if ($_POST['tipotema'] == "pormim"){

  

    // Obtendo o tema

    $tema = trim($_POST['txttema']);

  

    // Verificando se o tema não esta nulo

    if ($tema == ""){

  

      // Emitindo mensagem de erro

      $script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não pode ser nulo.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

      echo $script;

      exit;

    }

  

    // Caiu no enem

    }elseif ($_POST['tipotema'] == "enem"){

  

    // Obtendo o codigo do tema 

    $codtemaenem = $_POST['temaenem'];

  

    // Selecionando os dados desse tema para acrescentar na redação

    $sqltemaenem = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where (tipo = 0 and codigo = $codtemaenem);");

    $dados_temaenem = $sqltemaenem->fetch_array();

  

    // Verificando se o tema realmente existe 

    if($sqltemaenem->num_rows > 0){

  

    // Obtendo o tema

    $tema = $dados_temaenem['tema'];

    }else{

  

      // Emitindo mensagem de erro

      $script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não encontrado.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

      echo $script;

      exit;

    }

  

    // Elaborado pro professor

    }elseif ($_POST['tipotema'] == "professor"){

  

      // Obtendo o codigo do tema 

      $codtemaprofessor = $_POST['temaprof'];

    

      // Selecionando os dados desse tema para acrescentar na redação

      $sqltemaprofessor = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where (tipo = 1 and codigo = $codtemaprofessor);");

      $dados_temaprofessor = $sqltemaprofessor->fetch_array();

    

    // Verificando se o tema realmente existe 

    if($sqltemaprofessor->num_rows > 0){

  

      // Obtendo o tema

      $tema = $dados_temaprofessor['tema'];

      }else{

    

        // Emitindo mensagem de erro

        $script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não encontrado.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

        echo $script;

        exit;

      }

    

    // Elaborado pro usuario

    }elseif ($_POST['tipotema'] == "usuario"){

  

      // Obtendo o codigo do tema 

      $codtemausuario = $_POST['temausuario'];

    

      // Selecionando os dados desse tema para acrescentar na redação

      $sqltemausuario = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where (tipo = 2 and codigo = $codtemausuario);");

      $dados_temausuario = $sqltemausuario->fetch_array();

    

      // Verificando se o tema realmente existe 

      if($sqltemausuario->num_rows > 0){

  

      // Obtendo o tema

      $tema = $dados_temausuario['tema'];

      }else{

    

        // Emitindo mensagem de erro

        $script = "<script>alert('Erro: Não foi possivel enviar a redação. Tema não encontrado.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

        echo $script;

        exit;

      }

    }

    }



  // Verificando qual é o tipo da redação

  // Tipo texto

  if ($_POST['chetipored'] == "texto"){



    // Obtendo o texto da redação

    $textored = trim($_POST['txtredacao']);



    // Verificando se o texto da redação não esta nulo

    if ($textored != ""){

    }else{



      // Emitindo mensagem de erro

      $script = "<script>alert('Erro: Não foi possivel enviar a Redação. Campo de Texto deve ser preechido.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

      echo $script;

			exit;

    }



    // Definindo o tipo da redação como texto

    $tipored = 0;



  // Tipo anexo

  }elseif ($_POST['chetipored'] == "anexo"){



    // Definindo o tipo da redação como anexo

    $tipored = 1;



    // Verificando se o arquivo foi selecionado

    if (!empty($_FILES['arquivo']['name'])){



      // Obtendo o nome do arquivo

			$nomearquivo = $_FILES['arquivo']['name'];



      // Obtendo o tipo do arquivo

			$tipo = $_FILES['arquivo']['type'];



      // Obtendo o nome temporario do arquivo

			$nometemporario = $_FILES['arquivo']['tmp_name'];



      // Definindo os tipos aceitos WORD(docx), PDF e TXT

			$tipospermitidos = ["application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/pdf","text/plain"];



      // Verificando o tipo do arquivo

			if (!in_array ($tipo, $tipospermitidos)){



        // Emitindo mensagem de erro

				$script = "<script>alert('Erro: Não foi possivel cadastra Pergunta. Tipo de arquivo não permitido no anexo. Tipo: $tipo');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

				echo $script;

				exit;

			}



      // Definindo o caminho para ser salvo o arquivo

			$caminho = "redacoes/";



      // Ajustando a data

			date_default_timezone_set('America/Sao_Paulo');

			$hoje = date("d-m-Y_H-i-s", time());



      // Definindo um nome para o arquivo

			$nomeimgla = $hoje."-".$nomearquivo;



      // Passando esse nome para a variavel que ira salvar no bd

      $textored = $nomeimgla;

			

      // Salvando o arquivo

			if (move_uploaded_file($nometemporario, $caminho.$nomeimgla)){

			}

			else{



        // Emitindo mensagem de erro

				$script = "<script>alert('Erro ao salvar o naexo.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

				echo $script;

				exit;

			}

		}

		else{



      // Emitindo mensagem de erro

			$script = "<script>alert('Erro: Anexo não selecionado.');location.href='alterar_redacaousu.php?".$codigo_red."';</script>";

			echo $script;

			exit;

		}

  }else{



    // Mantendo o nome do arquivo no bd

    $textored = $nome_arquivo;

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



  // Reenviando a redação

  $result = mysqli_query($conexao, "UPDATE tabela_redacoes SET texto_naocorrigido='".addslashes($textored)."',data_envio='$hoje', tema='".addslashes($tema)."', visualizacao=$visu, tipo=$tipored WHERE codigo=$codigo_red;");



  // Emitindo mensagem de sucesso

  $script = "<script>alert('Redação reenviada com Sucesso.');location.href='minhas_redacoesusu.php';</script>";

  echo $script;

  exit;

}



?>



<!-- Inicaisndo o corpo da página -->

<!DOCTYPE HTML>

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">  

<title>Reescrever Redação</title>



<!-- Definindo um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- Definindo caracteristicas para o corpo da página -->

<body style="background-color: black;">



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



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

  var resultado = confirm("Deseja Realmente cancelar as Alterações?")

    if (resultado == true) {

      location.href='minhas_redacoesusu.php';

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

              <li><a href="nova_redacao.php">Escrever</a></li>

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




<!-- Inserindo campos para a inserção de dados -->

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
<option value="<?php echo $value_tema; ?>"><?php echo $tipo_tema; ?></option>

<?php 
if ($value_tema != "pormim"){
echo "<option value='pormim'>Elaborado por mim</option>";
}
if ($value_tema != "professor"){
echo "<option value='professor'>Elaborado por Professores</option>";
}
if ($value_tema != "usuario"){
echo "<option value='usuario'>Elaborado por Usuários</option>";
}
if ($value_tema != "enem"){
echo "<option value='enem'>ENEM</option>";
}
?>

</select>
<br><br>

<div id="divmeutema" style="display: <?php echo $mostemameu; ?>;">
<b>Descrição Tema:</b>
<input type="text" style="width: 99%; border: 2px solid white; color:white; background-color: black;" value="<?php echo $temamos; ?>" name="txttema" style="width: 99%;" maxlength="300"  id="txttema">

<br><br>

</div>

<!-- Tamas professores -->

<div id="divtemaprof" style="display: <?php echo $mostemaprof; ?>;">



<!-- Iniciando PHP -->

<?php



// Obtendo temas a serem mostrados
$sqltemaprof = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 1 order by ano, tema;");

if ($sqltemaprof->num_rows > 0){

echo "<b>Selecione o Tema:</b><br>";
echo "<select name='temaprof' style='border: 2px solid white; color:white; background-color: black;' width: 99%;>";

// Criando loop
while ($dadotemaprof=$sqltemaprof->fetch_array()) { 

// Obtendo o codigo do tema
$codigo_temaprof = $dadotemaprof['codigo'];

// Verificando se o codigo do tema é igual
if ($codigo_temaprof == $codigo_tema){

  // Exibindo tema
  echo "<option value='".$codigo_temaprof."'>".$dadotemaprof['tema']." - ".$dadotemaprof['ano']."</option>";


}

}

// Obtendo temas a serem mostrados
$sqltemaprof2 = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 1 order by ano, tema;");

// Criando loop
while ($dadotemaprof2=$sqltemaprof2->fetch_array()) { 

  // Obtendo o codigo do tema
  $codigo_temaprof2 = $dadotemaprof2['codigo'];
  
  // Verificando se o codigo do tema é igual
  if ($codigo_temaprof2 != $codigo_tema){
  
    // Exibindo tema
    echo "<option value='".$codigo_temaprof2."'>".$dadotemaprof2['tema']." - ".$dadotemaprof2['ano']."</option>";
  
  
  }
  
}

echo "</select><br>";

}else{

  echo "Nenhum tema encontrado <br>";

}

?>

<br>

</div>



<!-- Temas ENEM -->

<div id="divtemaenem" style="display: <?php echo $mostemaenem; ?>;">



<!-- Iniciando PHP -->

<?php



// Obtendo temas a serem mostrados
$sqltemaenem = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 0 order by ano, tema;");

if ($sqltemaenem->num_rows > 0){

  echo "<b>Selecione o Tema:</b><br>";
  echo "<select name='temaenem' style='border: 2px solid white; color:white; background-color: black; width: 99%;'>";

// Criando loop

while ($dadotemaenem=$sqltemaenem->fetch_array()) { 

// Obtendo o codigo do tema
$codigo_temaenem = $dadotemaenem['codigo'];

// Verificando se o codigo do tema é igual
if ($codigo_temaenem == $codigo_tema){

  // Exibindo tema
  echo "<option value='".$codigo_temaenem."'>".$dadotemaenem['tema']." - ".$dadotemaenem['ano']."</option>";


}

}

// Obtendo temas a serem mostrados
$sqltemaenem2 = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 0 order by ano, tema;");

while ($dadotemaenem2=$sqltemaenem2->fetch_array()) { 

  // Obtendo o codigo do tema
  $codigo_temaenem2 = $dadotemaenem2['codigo'];
  
  // Verificando se o codigo do tema é igual
  if ($codigo_temaenem2 != $codigo_tema){
  
    // Exibindo tema
    echo "<option value='".$codigo_temaenem2."'>".$dadotemaenem2['tema']." - ".$dadotemaenem2['ano']."</option>";
  
  
  }

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

if ($sqltemausu->num_rows > 0){

  echo "<b>Selecione o Tema:</b><br>";
  echo "<select name='temausuario' style='border: 2px solid white; color:white; background-color: black; width: 99%;'>";

// Criando loop

while ($dadotemausu=$sqltemausu->fetch_array()) { 

// Obtendo o codigo do tema
$codigo_temausu = $dadotemausu['codigo'];

// Verificando se o codigo do tema é igual
if ($codigo_temausu == $codigo_tema){

  // Exibindo tema
  echo "<option value='".$codigo_temausu."'>".$dadotemausu['tema']." - ".$dadotemausu['ano']."</option>";


}

}

// Obtendo temas a serem mostrados
$sqltemausu2 = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 2 order by ano, tema;");

while ($dadotemausu2=$sqltemausu2->fetch_array()) { 

  // Obtendo o codigo do tema
  $codigo_temausu2 = $dadotemausu2['codigo'];
  
  // Verificando se o codigo do tema é igual
  if ($codigo_temausu2 != $codigo_tema){
  
    // Exibindo tema
    echo "<option value='".$codigo_temausu2."'>".$dadotemausu2['tema']." - ".$dadotemausu2['ano']."</option>";
  
  
  }

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

<input type="radio" name="chetipored"  id="restex" value="texto" <?php echo $chetexto; ?> >

<label for="chenimg">Texto</label>

<input type="radio" name="chetipored" id="resimg" value="anexo" <?php echo $cheanexo; ?>>

<label for="chenimg">Anexo</label>

<br>

<div id="divrestext" style="display: <?php echo $mostexto; ?>;">

<textarea cols="95" style="width: 99%; border: 2px solid white; color:white; background-color: black;" rows="15" style="width: 99%;" name="txtredacao" value="text"><?php echo $texto_antigo; ?></textarea>

<br><br>

</div>

<div id="divresimg" style="display: <?php echo $mosanexo; ?>;">

<font size="3" color="red">

Tipos aceitos: DOCX (Word), PDF, TXT.

<br>

</font>

<input type="file" name="arquivo" accept=".docx,.pdf,.txt" style="font-size:15px">

<br><br>

Arquivo: <a href="redacoes/<?php echo $nome_arquivo;?>" download><?php echo $nome_arquivo;?></a>

</div>

<br>

<!-- Campo visualizar redação, com suas propriedades -->

<b>Visualização:</b>

<br>

<input type="radio" name="chevisu"  id="chevissim" value="eu" <?php echo $cheeu; ?> >

<label for="chevissim">Somente eu</label>

<input type="radio" name="chevisu" id="chevissim" value="todos" <?php echo $chetodos; ?>>

<label for="chevisnao">Todos</label>

<br><br>



<!-- Botões adicionar, limpar  cancelar -->

<center>

<input type="submit" name="enviarredacao" id="adcionarquestao" value="Reenviar Redação">    

<input type="reset" name="limpar" id="limpar" value="Restaurar">  

</form> 

<button onclick="cancelar()" id="cancelar">Cancelar</button> 

</center>



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



// Verificando o tipo do tema

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

</script>

<!-- Fechando tags abertas -->
</div>
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