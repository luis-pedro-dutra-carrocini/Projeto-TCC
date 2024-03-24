<!-- Iniciando PHP -->

<?php



// Inicinado sessão

session_start();



// verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){



  // redirecionando para a pagina index, pois a sessão não foi iniciada

  header('location: index.php');

  exit;

}else{



  // Verificando se o usuario é antigo ou recente

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



// Obtendo o codigo da prova

$codigo = $_GET['codigo'];



// Conectando com o banco de dados

include_once('conexao.php');



// Obtendo os dados do usuario

$sql_usu = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome_usuario';");



// Verificando se o usuário existe no bd

if($sql_usu->num_rows > 0){

  $dados_usu = $sql_usu->fetch_array();

  }else{



    // Voltando para o index, pois o usuario não existe

    header('location: index.php');

    exit;

  }



// Obtendo o codigo do usuario

$codigo_usuario = $dados_usu['codigo_usuario'];



// Quando clicar no botão alterar

if(isset($_POST["alterar"])){



    // Verificando se a menssagem foi aceita ou recusada

    $confalte = filter_input(INPUT_POST, 'confalte', FILTER_SANITIZE_SPECIAL_CHARS);



    // Se for sim

    if ($confalte == "True"){



        // Obtendo o codigo da prova

        $codigo = $_GET['codigo'];



        // Obtendo dados do formulario

        // Verificando se a prova é pessoal ou para todos verem

        // Pessoal

        if ($_POST['radsalvar'] == "pessoal"){



            // Defindo como pessoal para o banco de dados

            $novotipo = 0;



        // Para todos verem

        }elseif ($_POST['radsalvar'] == "todos"){



          // Defindo como para todos para o banco de dados

          $novotipo = 1;

        }



        $novonome = trim($_POST['nome']);



        // Verificando se o compo nome da prova não esta nulo

        if ($novonome == ""){



          // Emitindo mensagem de erro

          $script = "<script>alert('Erro: Nome da prova não pede ser nulo.');location.href='alterar_provausuario.php?codigo=$codigo';</script>";

          echo $script;

          exit;

        }



        // Alterando os dados

        $sqlInsert = "UPDATE tabela_provas_usuario SET nome='".addslashes($novonome)."',tipoprova=$novotipo WHERE codigo=$codigo;";

        $result = $conexao->query($sqlInsert);



        // Emitindo mensagem de sucesso

        $script = "<script>alert('Alterada com sucesso');location.href='minhas_provas_Usuario.php';</script>";

        echo $script;

        exit;

        }   

}



// Obtendo os dados do bd a serem alterados

// Verificando se o codigo chegou via GET

if(!empty($_GET['codigo'])){



    // Obtendo o codigo

    $codigo = $_GET['codigo'];



    // Obtendo os dados da prova

    $sqlSelect = "SELECT * FROM tabela_provas_usuario WHERE (codigo=$codigo and codigo_usuario=$codigo_usuario)";

    $result = $conexao->query($sqlSelect);



    // Verificando se a prova realmente existe

    if($result->num_rows > 0){



     // Obtendo os dados

     $user_data = mysqli_fetch_assoc($result);



     // Obtendo o nome a ser mostrado

     $nomemos = $user_data['nome'];



     // Obtendo o tipo a ser mostrado

     $tipo = $user_data['tipoprova'];



     // Verificando o tipo

     if ($tipo == 1){



        // Se for para todos verem

        $chetodos = "checked";

        $chepessoal = "";



     }elseif ($tipo == 0){



        // Se for pessoal

        $chetodos = "";

        $chepessoal = "checked";

     }

    }else{



        // Redirecionando para a pagina minhas provas, pois a prova não existe

        header('Location: minhas_provas_Usuario.php');

        exit;

    }

}else{



    // Redirecionando para a pagina minhas provas, pois o codigo não chegou

    header('Location: minhas_provas_Usuario.php');

    exit;

}

?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE html>

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">

<title>Alterar Dados da Prova</title>



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



// Função para abrir a pagina home -->

function home() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='pagina_usuarios.php';

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

      location.href='minhas_provas_Usuario.php';

    }

}



// Função para voltar para a pagina minhas provas -->

function meusimu() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='minhas_provas_Usuario.php';

    }

}



// Função para voltar para a pagina simulados feitos por professores -->

function feiprof() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='simu_feitoporadms.php';

    }

}



// Função para voltar para a pagina simulados feitos por usuarios -->

function feiusu() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='simu_feitoporusuarios.php';

    }

}



// Função para abrir a pagina Ranking -->

function Ranking() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='ranking_usuarios.php';

    }

}



// Função para abrir a pagina Ranking -->

function alterar_dados() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='alterar_dadosusuario.php';

    }

}



// Função para abrir a pagina gerar simulado personalizado

function simusim() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='gerar_simusimcad.php';

    }

}



// Função para abrir a pagina gerar simulado personalizado

function simucom() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='gerar_simucomcad.php';

    }

}



// Função para abrir a pagina sobre

function sobre() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='sobreusu.php';

    }

}



// Função para abrir a pagina evoluções

function evolucao() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='todasprovas_realizadasusu.php';

    }

}

// Função para página provas e gabaritos -->

function provas() {

var resultado = confirm("Cancelar Simulado?")

  if (resultado == true) {

    location.href='mostrar_provas.php';

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

        #alterar{

            width: 49%;

            border: none;

            padding: 15px;

            color: white;

            font-size: clamp(1em, 1em + 0.5vw, 1.5em);

            cursor: pointer;

            border-radius: 10px;

            background-color: RoyalBlue;

        }

        #alterar:hover{

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

#deletar_conta{

width: 100%;

border: none;

padding: 15px;

color: white;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

}

#deletar_conta:hover{

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

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- link para mostrar senha -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<!-- Inserindo inputs com suas caracteristicas -->

<body style="background-color: black;">

<center>
<div class="box" Align="left">

        <form action="" method="POST" name="f1">



            <!-- Borda em volta do form -->

            <fieldset>



                <!-- legenda do Formulario -->

                <legend><b>Alterar Dados Prova</b></legend>

                <br><br>



                <!-- campo nome -->
              <div class="form-group input-group">
		          <div class="input-group-prepend">
		          <span class="input-group-text"> <i class="fa fa-user" style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);"></i> </span>
		          </div>
              <input style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);" name="nome" maxlength="50" placeholder="Nome da Prova" value="<?php echo $nomemos;?>" required class="form-control" type="text">
              </div>
              <br><br>



                <b>Quem pode ver:</b><br><br>

                <input type="radio" name="radsalvar" value="todos" <?php echo $chetodos; ?>> Todos

                &nbsp; &nbsp;

                <input type="radio" name="radsalvar" value="pessoal" <?php echo $chepessoal; ?>> Somente eu

                <br><br>



                <!-- Inputs para passar informações do java para o php -->

                <input type="hidden" value="" id="confalte" name="confalte"> 



                <!-- Botão alterar e cancelar -->

                <button type ="submit" id="alterar" onclick="alterardados()" name="alterar">Alterar</button>

                <button type ="button" id="cancelar" onclick="voltar()" name="cancelar">Cancelar</button>

            </fieldset>



<!-- Fechando tags em aberto -->
</form>
</div>
</center>

</body>
</html>