<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conectando com o banco de dados
include_once('conexao.php');

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Obtendo o nome via sessão
  $nome = $_SESSION["nome_adm"];

  // Obtendo os dados do adm a serem utilizadaos
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

    // Redirecionando para a pagina adm, pois o nivel do adm não cndis com a pagina atual
    header('location: pagina_adm.php');
    exit;
  }
}

 // Verificando se o nome chogou via GET
 if(!empty($_GET['nome'])){

  // Obtendo o nome
  $nome = $_GET['nome'];

  // Obtendo os dados do usuario
  $sqlSelect = "SELECT * FROM tabela_usuario WHERE nome='$nome'";
  $result = $conexao->query($sqlSelect);

  // Verificando se o usuario realmente existe
  if($result->num_rows > 0){
   $user_data = mysqli_fetch_assoc($result);

   // Obtendo o nome
   $nomemos = $user_data['nome'];

   // Obtendo o email
   $email = $user_data['email'];
}else{

// Redirecionando para a pagina mostrar usuarios, pois o usuario não existe
header('Location: mostrar_usuarios.php');
exit;
}

}else{

// Redirecionando para a pagina mostrar usuarios, pois o codigo não existe
header('Location: mostrar_usuarios.php');
exit;
}

    // Quando clicar no botão alterar
    if(isset($_POST["alterar"]))
    {

        // Verificando se a menssagem foi aceita ou recusada
        $confalte = filter_input(INPUT_POST, 'confalte', FILTER_SANITIZE_SPECIAL_CHARS);

        // Se foi sim
        if ($confalte == "True"){

            // Verificando se o email é válido ou não
            $emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);

            // Se for invalido
            if($emailvalouinv == "Inválido"){

                // Emitindo uma mensagem de erro
                $script = "<script>alert('Erro: Não foi alterar dados do Usuário. E-Mail Inválido.');location.href='alterar_usuario.php?nome=$nome';</script>";
                echo $script;
                exit;
            }

            // Se for valido
            elseif($emailvalouinv == "Válido"){

            // Obtendo os dados do bd
            $sql3 = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nomemos';");
            $selectemail=$sql3->fetch_array();

            // Obtendo os dados do form
            // Email
            $email = $selectemail['email'];

            // Nome
            $novonome = $_POST['nome'];

            // Novo email
            $novoemail = $_POST['email'];

            // Obtendo dados do bd, para ver se o nome de usuario ou emaol ja existem
            // Email
            $sql = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE email = '$novoemail';");
            $emailex = mysqli_num_rows($sql);

            // Nome
            $sql2 = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$novonome';");
            $nomeex = mysqli_num_rows($sql2);

        // Verificando se o email já existe
        if ($novoemail != $email){
            if($emailex>0) {

                // Emitindo mensagem de erro
                $script = "<script>alert('Erro: Não foi possivel alterar dados do Usuário. E-Mail já utilizado.');location.href='alterar_usuario.php?nome=$nome';</script>";
                echo $script;
                exit;
            }
        }

        // Verificando se o nome já existe
        if ($novonome != $nomemos){
            if($nomeex>0) {

                // Emitindo mensagem de erro
                $script = "<script>alert('Erro: Não foi possivel alterar dados do Usuário. Nome já utilizado.');location.href='alterar_usuario.php?nome=$nome';</script>";
                echo $script;
                exit;
            }
        }

        // Verificando se nome ou email estão banidos
        $verificarusuban = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE email = '$novoemail';");
        $verificarusubannome = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE nome = '$novonome';");

        // Certificando se esse email esta banido
        if(mysqli_num_rows($verificarusuban)>0){

          // Emitindo mensagem de erro
	        $script = "<script>alert('Erro: E-Mail Banido.');location.href='alterar_usuario.php?nome=$nome';</script>";
	        echo $script;
          exit;
        }
        else{
          if(mysqli_num_rows($verificarusubannome)>0){

            // Emitindo mensagem de erro
            $script = "<script>alert('Erro: Nome Banido.');location.href='alterar_usuario.php?nome=$nome';</script>";
            echo $script;
            exit;
          }else{

                // Alterando o nome na avaliação
                $sqlalt = "UPDATE tabela_avaliacoes SET nome_usuario='$novonome' WHERE nome_usuario='$nome' and tipo = 2;";
                $altava = $conexao->query($sqlalt);

                // Alterando os dados
                $sqlInsert = "UPDATE tabela_usuario SET nome='$novonome',email='$novoemail' WHERE nome='$nome';";
                $result = $conexao->query($sqlInsert);

                // Emitindo umamensagem de sucesso
                $script = "<script>alert('Alterado com sucesso');location.href='mostrar_usuarios.php';</script>";
                echo $script;
              }
              }
            }   
          }
    }

?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE html>
<html>

<!-- Definindo caracteristicas basicas cvomo acentuação e titulo -->
<meta charset="UTF-8">
<title>Alterar Dados do Usuário</title>

<!-- Colocando ícone na página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Iniciando Java -->
<script>

// Função para sair da conta -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

// Função para abrir a pagina visulizar usuarios -->
function visu_usuarios() {
    var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
        location.href='mostrar_usuarios.php';
    }
}

// Função para abrir a pagina visualizar questões -->
function visu_questoes() {
    var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
        location.href='mostrar_questoes.php';
    }
}

// função paraabrir a pagina adiionar adm -->
function add_adm() {
    var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
        location.href='adicionar_adm.php';
    }
}

// Função para abrir a página alterar dados adm -->
function alt_dados() {
    var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
        location.href='alterar_dadosadm.php';
    }
}

// Função para abrir a pagina home -->
function home() {
  var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
      location.href='pagina_adm.php';
    }
}

  // Função para alterar os dados -->
function alterardados() {
var resultadoalterar = confirm("Deseja Realmente alterar esses Dados?");
if (resultadoalterar == true) {
    var confalte = "True";
    document.getElementById("confalte").value = confalte;
  }
}

// Função para voltar para a pagina anterior -->
function voltar() {
  var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
      location.href='mostrar_usuarios.php';
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

// função paraabrir a pagina adiionar adm -->
function add_questoes() {
    var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
        location.href='adicionar_questao.php';
    }
}

// Função para abrir a pagina sobre -->
function visu_usuarios_banidos() {
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

<br><br><br><br>
<!-- Fechando cabeçalho -->

<!-- Iniciando java para a validação do email -->
<script>
// Função para validar email -->
function validacaoEmail(field) {
usuario = field.value.substring(0, field.value.indexOf("@"));
dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);

if ((usuario.length >=1) &&
    (dominio.length >=3) &&
    (usuario.search("@")==-1) &&
    (dominio.search("@")==-1) &&
    (usuario.search(" ")==-1) &&
    (dominio.search(" ")==-1) &&
    (dominio.search(".")!=-1) &&
    (dominio.indexOf(".") >=1)&&
    (dominio.lastIndexOf(".") < dominio.length - 1)) {
      document.getElementById("msgemail").innerHTML="";
      var emailvalouinv = 'Válido';
      document.getElementById("emailvalouinv").value = emailvalouinv;
}
else{
document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>";
var emailvalouinv = 'Inválido';
document.getElementById("emailvalouinv").value = emailvalouinv;
}
}
</script>

<!-- Inserindo inputs com suas caracteristicas -->
<body>
    <div class="box">
        <form action="" method="POST" name="f1">

            <!-- Borda em volta do form -->
            <fieldset>

                <!-- legenda do Formulario -->
                <legend><b>Alterar Dados Usuário</b></legend>
                <br><br>

                <!-- Campo email -->
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" onblur="validacaoEmail(f1.email)" autofocus maxlength="256" value="<?php echo $email;?>" required>
                    <label for="email" class="labelInput">Email</label>
                    <input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
                <br><br>
                <!-- DIV menssagem de email valido ou invalido -->
                </div>
                <div id="msgemail" style="text-align: center;"></div>
			          <br><br>

                <!-- campo nome -->
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" maxlength="50" value="<?php echo $nomemos;?>" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>

                <!-- Inputs para passar informações do java para o php -->
				        <input type="hidden" name="id" value=<?php echo $nome;?>>
                <input type="hidden" value="" id="confalte" name="confalte"> 

                <!-- Botão alterar e cancelar -->
                <button type ="submit" id="alterar" onclick="alterardados()" name="alterar">Alterar</button>
                <button type ="button" id="cancelar" onclick="voltar()" name="cancelar">Cancelar</button>
            </fieldset>

<!-- Fechando tags em aberto -->
</form>
</div>
</body>
</html>