<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conectando com o banco de dados
include_once('conexao.php');

// Verificando se sessão foi iniciada
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

    // Verificando o nvel do adm
    if ($nivel == "admgeral" || $nivel == "adm"){
    }
    else{

      // Redirecionando para a pagina adm, pois o nivel do adm não condiz coma a pagina atual
      header('location: pagina_adm.php');
      exit;
    }

if(!empty($_GET['nome'])){

    // Obtendo o código via GET do form anterior
    $nome = $_GET['nome'];

    // Obtendo os ddaos do adm a ser banido
    $sqlSelect = "SELECT *  FROM tabela_adm WHERE (nome='$nome' and nivel = 'professor')";
    $result = $conexao->query($sqlSelect);

    // Verificando se usuario realmente existe
    if($result->num_rows > 0){

        // Obtendo os dados do adm
        $dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");
        $dado=$dados->fetch_array();

        // Obtendo o email
        $email =  $dado['email'];

        // Obtendo o codigo
        $codigo_usuario = $dado['codigo'];
    }else{

        // Redirecionando para a pagina mostra questões, pois o adm não exite
        header('location: mostrar_professores.php');
        exit;
    }
}else{

    // Redirecionando para a pagina mostra questões, pois o nome via GET não exite
    header('location: mostrar_professores.php');
    exit;
}
}

// Quando clicar no botão excluir
if (isset($_POST['btn_banir'])){

    // Obtendo o dado (motivo) do form 
    $motivo = $_POST['motivo_ban'];

    // Obtendo data
    date_default_timezone_set('America/Sao_Paulo');
    $hoje = date('Y/m/d');

    // Inserindo os dados na tabela usuarios banidos
    $inusu_ban = mysqli_query($conexao, "INSERT into tabela_usuarios_banidos(nome, email, motivo, data_ban, usuoupro) values ('$nome', '$email', '$motivo', '$hoje', 0)");

    // Deletando os dados da tabela usuario
    $del_per = mysqli_query($conexao, "DELETE FROM tabela_provas_adm WHERE codigo_adm = $codigo_usuario;");
    $sqlDelete = "DELETE FROM tabela_adm WHERE nome='$nome'";
    $resultDelete = $conexao->query($sqlDelete);

    // Voltando para a pagina mostrar professores
    header('location: mostrar_professores.php');
    exit;
}
?>

<!-- Inicando o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo caracteristicas basicas como acenruação e titulo -->
<meta charset="UTF-8">
<title>Banir Professor</title>

<!-- Definindo um icone para a pagina -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- Link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Iniciando java -->
<script language="Javascript">

// Função para sair -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
  }

// Função para volta para a página anterior -->
function voltar() {
    location.href='mostrar_professores.php';
}

// Função para abrir a página de visualizar usuários -->
function visu_usuarios() {
      location.href='mostrar_usuarios.php';
}

// Função para abrir a página de visualizar questões -->
function visu_questoes() {
      location.href='mostrar_questoes.php';
}

// Função para abrir a página de adicionar adm -->
function add_adm() {
      location.href='adicionar_adm.php';
}

// Função para abrir a página de alterar dados adm -->
function alt_dados() {
      location.href='alterar_dadosadm.php';
}

// Função para abrir a página de home -->
function home() {
      location.href='pagina_adm.php';
}

</script>

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
            color: black;
            position: absolute;
            top: 60%;
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

         /* Definindo propriedades dos inputs */
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
            width: 90%;
            letter-spacing: 2px;
        }

        /* Definindo propriedades dos labels */
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

        /* Definindo caracteristicas dos botões */
        #btn_banir{
            width: 50%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #btn_banir:hover{
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
        <h1><a href="sobreadm.php" class="scrollto">DSENEM</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="pagina_adm.php" >Home</a></li>
          <li class='menu-has-children'><a >Professores</a>
            <ul>
              <li><a href='mostrar_professores.php'>Cadastrados</a></li>
              <li><a href='mostrar_professores_banidos.php'>Banidos</a></li>
              <li><a href='adicionar_adm.php'> ADD Professor</a></li>
            </ul>
            </li>
          
          <li class="menu-has-children"><a >Questões</a>
            <ul>
              <li><a href="mostrar_questoes.php">Visualizar Questões</a></li>
              <li><a href="adicionar_questao.php">ADD Questão</a></li>
              <li class='menu-has-children'><a >Verificar Imagens</a>
                <ul>
                    <li><a href='verficarimg_perguntas.php'>Perguntas</a></li>
                    <li><a href='verficarimg_respostas.php'>Respostas</a></li>
                </ul>
                </li>
            </ul>
          </li>
           <li class="menu-has-children"><a >Usuários</a>
            <ul>
            <li><a href='mostrar_usuarios.php'>Cadastrados</a></li>
              <li><a href="mostrar_usuarios_banidos.php">Banidos</a></li>
            </ul>
          </li>

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
          </li>

          <li class="menu-has-children"><a >Provas</a>
            <ul>    
              <li><a href="provas_geradasadm.php">Minhas</a></li>
              <li><a href="provasadm_adm.php">Professores</a></li>
              <li><a href="provasusu_adm.php">Usuários</a></li>
              <li><a href="gerar_provaadm.php">Criar</a></li>
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

<!-- Colocando os campos para a inserção de dados -->
<body>
<center>

<!-- Caixa em volta do form -->
<div class="box">
<form method="POST" name="f1">

<!-- Borda do form -->
<fieldset  style="text-align: left;">

<!-- Legenda do form -->
<legend style="color:grey31; font-size:25px; font-weight: bold;">Banir Professor</legend>
<br><br>

<!-- Campo email com suas caracteristicas -->
<label for="email_usu" style="font-size:17px; text-align: left; color: black;">E-Mail</label><br>
<input type="email" name="email_usu" id="email_usu" class="inputUser" style=" font-size:20px;" readonly value="<?php echo $email; ?>">
<br><br><br>

<!-- Campo nome com suas caracteristicas -->
<label for="nome_usu" style="font-size:17px; text-align: left; color: black;" required>Nome</label><br>
<input type="text" name="nome_usu" id="nome_usu" class="inputUser" style=" font-size:20px;" readonly value="<?php echo $nome; ?>">
<br><br><br>

<!-- Campo senha com suas caracteristicas -->
<label for="motivo_ban" style="font-size:17px; text-align: left; color: black;" required>Motivo</label><br>
<input type="text" name="motivo_ban" id="motivo_ban" class="inputUser" style="font-size:20px;" maxlength="50" required>
<br><br><br>

<!-- Botões de adicionar ou cancelar -->
<div>   
<button type="submit" id="btn_banir" name="btn_banir">Banir</button>
<button type="button" id="cancelar" name="btn_canadiadm" onclick="voltar()">Cancelar</button>
</div>

<!-- Fechando tags abertas -->
</fieldset>
</form>
</div>
</center>
</body>
</html>