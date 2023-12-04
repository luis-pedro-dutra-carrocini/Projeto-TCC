<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // redirecionando para a página index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Obtendo o nome do adm via sessão
  $nome = $_SESSION["nome_adm"];

  // Conecatando com o banco de dados
  include_once('conexao.php');

  // obtendo dados do adm para serem utilizados
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

  // Se o adm for corretor, adm normal ou adm geral
  if ($nivel == "admgeral" || $nivel == "adm" || $nivel == "corretor"){
  }
  else{

    // Redirecionando para a pagina adm, pois o nivel do adm não condiz com a página atual
    header('location: pagina_adm.php');
    exit;
  }

  // Verificando se o código da prova não esta vazio
  if(!empty($_GET['codigo'])){

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Obtendo os dados do tema
    $dadost = mysqli_query($conexao, "SELECT * FROM tabela_temasredacoes WHERE codigo = $codigo;");
    $dadotema=$dadost->fetch_array();

    // Verificando se o código existe no banco de dados
    if (mysqli_num_rows($dadost)>0){

    // Obtendo tema
    $tema = $dadotema['tema'];

    // Obtendo ano
    $ano = $dadotema['ano'];

    // Obtendo o tipo
    $tipo = $dadotema['tipo'];

    // Verificando o tipo
    // Se o tipo form ENEM
    if ($tipo == 0){
        $cheenem = "checked";
        $chepro = "";
        $cheusu = "";

    // Se o tipo foi de proposto por professor
    }elseif ($tipo == 1){
        $cheenem = "";
        $chepro = "checked";
        $cheusu = "";

    // Se o tipo foi de proposto por usuario
    }elseif ($tipo == 2){
        $cheenem = "";
        $chepro = "";
        $cheusu = "checked";
    }
    }else{

        // Redirecionando para a página usuarios, pois não exite o código do tema
        header('location: pagina_adm.php');
        exit;
    }
  }else{

    // Redirecionando para a página usuarios, pois não exite o código do tema
    header('location: pagina_adm.php');
    exit;
  }
}

// Quando clicar no botão alterar
if(isset($_POST["Alterar"])){

    // Obtendo os dados do formulário
    // Tema
	$temanovo = trim($_POST['txttema']);

    // Tipo do tema
    if ($_POST['chetipo'] == "peloenem"){
        $tiponovo = 0;
    }elseif ($_POST['chetipo'] == "pormim"){
        $tiponovo = 1;
    }elseif ($_POST['chetipo'] == "porusu"){
        $tiponovo = 2;
    }

    // Ano
    $anonovo = trim($_POST['ano']);

    // Verificando se o campo tema não esta nulo
    if ($temanovo != ""){
    
    // Verificando se o tema se manteve
    if ($tema != $temanovo){

    // Obtendo os dados do bd para ver se o tema ja esta cadastrado
    $sql3 = mysqli_query($conexao, "SELECT * FROM tabela_temasredacoes WHERE tema = '".addslashes($temanovo)."';");
    $temaexiste = mysqli_num_rows($sql3);
    }else{
        $temaexiste = 0;
    }

    // Verificando o tema é do ENEM e se o tema referente a um ano já existe
    if ($tiponovo == 0){

        // verifiacndo se o ano desse tema ja existe
        $sql4 = mysqli_query($conexao, "SELECT * FROM tabela_temasredacoes WHERE (ano = $anonovo and tipo = 0 and tema != '$tema');");

        if(mysqli_num_rows($sql4)>0) {

            // Enviando mesagem de erro
            $script = "<script>alert('Erro: Não foi possivel alterar o tema. O tema do ano $anonovo, já está Cadastrado.');location.href='alterar_tema.php?codigo=$codigo';</script>";
            echo $script;
            exit;
        }
    }

    // Verificando se o tema já existe
    if($temaexiste>0) {

        // Enviando mesagem de erro
        $script = "<script>alert('Erro: Não foi possivel alterar o tema. Tema já cadastrado.');location.href='alterar_tema.php?codigo=$codigo';</script>";
        echo $script;
        exit;
    }else{

    // Verificando se o campo ano não esta nulo
    if ($anonovo == ""){

        // Enviando mesagem de erro
        $script = "<script>alert('Erro: Não foi possivel alterar o tema. Campo ano não pode ser nulo.');location.href='alterar_tema.php?codigo=$codigo';</script>";
        echo $script;
        exit;
    }

    // Adicionando o tema no banco de dados
    $alterar = mysqli_query($conexao, "UPDATE tabela_temasredacoes SET tema='".addslashes($temanovo)."',ano=$anonovo, tipo=$tiponovo WHERE codigo=$codigo;");

    // Redirecionando para a pagina correta
    // Se o tipo for ENEM
    if ($tiponovo == 0){
    $script = "<script>alert('Tema Alterado com sucesso');location.href='temas_enem.php';</script>";
    echo $script;

    // Se o tipo form proposto por professor
    }elseif ($tiponovo == 1){
    $script = "<script>alert('Tema Alterado com sucesso');location.href='temas_professores.php';</script>";
    echo $script;

    // Se o tipo form proposto por usuário
    }elseif ($tiponovo == 2){
    $script = "<script>alert('Tema Alterado com sucesso');location.href='temas_usuarios.php';</script>";
    echo $script;
    }
    }
    }else{

        // Enviando mesagem de erro, pois o campo tema esta vazio
        $script = "<script>alert('Erro: Não foi possivel alterar o tema. Campo tema não pode ser nulo.');location.href='adicionar_tema.php';</script>";
        echo $script;
        exit;
    }
}
?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<!-- Colocando ícone na página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>
<title>Alterar dados do Tema</title>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Iniciando Java -->
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
      location.href='pagina_adm.php';
    }
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
<!-- definindo caracteristicas para a pagina -->
<style>

/* caracteristicas do corpo da página */
body{
    font-family: Arial, Helvetica, sans-serif;
    background-color: LightBlue;
}

/* Caracteristicas do quadro em volta do form */
.box{
    color: black;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background-color: white;
    padding: 15px;
    border-radius: 15px;
    width: 50%;
}

/* Definindo propriedades da legenda */
legend{
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 19px;
        }

/* Caracteristicas dos inputs */
.inputBox{
    position: relative;
}
.inputUser{
    background: none;
    border: none;
    border-bottom: 1px solid black;
    outline: none;
    color: black;
    font-size: 17px;
    width: 100%;
    letter-spacing: 2px;
}

/* Caracteristicas do labels */
.labelInput{
    position: absolute;
    top: 0px;
    left: 0px;
    pointer-events: none;
    transition: .5s;
}
.inputUser:focus ~ .labelInput,
.inputUser:valid ~ .labelInput{
    top: -20px;
    font-size: 12px;
    color: black;
}

/* caracteristicas dos botões */
#alterar{
    width: 50%;
    border: none;
    padding: 15px;
    color: white;
    font-size: 15px;
    cursor: pointer;
    border-radius: 10px;
    background-color: DarkTurquoise;
}
#alterar:hover{
    background-color: MediumTurquoise;
}
#cancelar{
    width: 47%;
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
        <li class="menu-active"><a onclick='home()'>home</a></li>
        <?php
          if ($nivel =="admgeral" || $nivel == "adm"){echo "
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
          </li>";
          }

          if ($nivel =="admgeral" || $nivel == "adm" || $nivel == "corretor"){echo"
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
          </li>";
          }
          ?>
          <li class="menu-has-children"><a >Provas</a>
            <ul>
                <li><a onclick='provas_geradas()'>Minhas</a></li>
                <li><a onclick="professores()">Professores</a></li>
                <li><a onclick="prousuarios()">Usuários</a></li>
              <li><a onclick='gerar_prova()'>Criar</a></li>
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

<br><br><br><br><br><br>
<!-- Fechando cabeçalho -->

<!-- Inserindo inputs com suas caracteristicas -->
<body>
    <div class="box">
        <form action="" method="POST" name="f1">

            <!-- Borda em volta do form -->
            <fieldset>

                <!-- legenda do Formulario -->
                <legend><b>Cadastrar Tema</b></legend>
                <br><br>

                <!-- Campo Tema -->
                <div class="inputBox">
                <b>Tema:</b>
                <input type="text" name="txttema" id="email" class="inputUser" autofocus maxlength="300" value="<?php echo $tema;?>" required>
                <br><br>

                <!-- radios Buton para decidir se o tema caiu no enem ou é para fins didaticos -->
                <label style='font-size:17px; text-align: left; color: black;'>De onde vem esse Tema?</label><br>
                <input type='radio' name='chetipo' value='peloenem' <?php echo $cheenem; ?>>
                <label for='chetipo'>Já caiu no ENEM</label><br>

                <input type='radio' name='chetipo' value='pormim' <?php echo $chepro; ?>>
                <label for='chetipo'>Proposto por Professor</label><br>
                
                <input type='radio' name='chetipo' value='porusu' <?php echo $cheusu; ?>>
                <label for='chetipo'>Proposto por Usuário</label>
                <br><br>

                <!-- Campo ano -->
                <b>Ano:</b>
                <input type="number" id="nome" class="inputUser" maxlength="4" name="ano" style="width: 20%;" value="<?php echo $ano;?>" required>
                <br><br>

                <!-- Botão alterar e cancelar -->
                <button type ="submit" id="alterar" name="Alterar">Alterar</button>
                <button type ="button" id="cancelar" onclick="voltar()" name="cancelar">Cancelar</button>
            </fieldset>

<!-- Fechando tags em aberto -->
</form>
</div>
</body>
</html>