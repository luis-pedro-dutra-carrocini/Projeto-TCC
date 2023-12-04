<!-- Iniciando PHP -->

<?php



// Inicinado sessão

session_start();



// verificando se a sessão foi iniciada 

if(!isset($_SESSION["senha_adm"]))

{



  // Redirecionando para a pagina index pois a sessão não foi iniciada

  header('location: index.php');

  exit;

}else{



  // Conectando com o banco de dados

  include_once('conexao.php');



  // Obtendo o nome via sessão

  $nome_adm = $_SESSION["nome_adm"];



  // Obtendo os dados do adm a serem utilizados

  $slcadm = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome_adm';");



// Verificando se o usuário existe no bd

if($slcadm->num_rows > 0){

  $dadoadm=$slcadm->fetch_array();

  }else{



    // Voltando para o index, pois o usuario não existe

    header('location: index.php');

    exit;

  }



  // Obtendo o nivel do adm

  $niveladm = $dadoadm['nivel'];



  // verificando se a avaliação deve ser mostrada ou não

  if ($niveladm == "adm" || $niveladm == "admgeral"){



    // Definindo para não mostrar a avaliação

    $mosavaliacao = "none";



    // Definindo para mostrar todas as avaliações

    $mosfeedback = "block";



    // Obtendo as avaliações

    $consulta = mysqli_query($conexao, "SELECT * FROM tabela_avaliacoes order by codigo DESC;");

  }else{



    // Definindo para mostrar a avaliação

    $mosavaliacao = "block";



    // Definindo para não mostrar todas as avaliações

    $mosfeedback = "none";

  }



  // Obtendo os dados do index

  $sqldadosindex = mysqli_query($conexao, "SELECT * FROM tabela_informacoesdosite WHERE codigo = 1;");

  $dadosindex=$sqldadosindex->fetch_array();



  // Obtendo o sobre

  $sobre = $dadosindex['sobre'];



  // Obtendo a avaliação do usuario caso exista

  $sqlavaliacao = mysqli_query($conexao, "SELECT * FROM tabela_avaliacoes WHERE nome_usuario = '$nome_adm' and tipo = 1;");

  $dadosavaliacao=$sqlavaliacao->fetch_array();



  // verificando se a avaliação existe

  if(mysqli_num_rows($sqlavaliacao)>0) {



    // Obtendo comentário

    $comentarioantigo = $dadosavaliacao['comentario'];



    // Obtendo nota

    $notaantiga = $dadosavaliacao['nota'];



    // Obtendo melhorias ou erros encontrados

    $melhoriaerroantigo = $dadosavaliacao['melhoria_erro'];

  }else{



    // Definindo campos como vazios pois não existe avaliação antiga

    $comentarioantigo = "";

    $notaantiga = 0;

    $melhoriaerroantigo = "";

  }

  // Selecionando as estrelas corretas
  if ($notaantiga == 0){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 1){
    $chestar1 = "checked";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 2){
    $chestar1 = "";
    $chestar2 = "checked";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 3){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "checked";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 5){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "checked";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 5){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "checked";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 6){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "checked";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 7){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "checked";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 8){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "checked";
    $chestar9 = "";
    $chestar10 = "";
  }elseif ($notaantiga == 9){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "checked";
    $chestar10 = "";
  }elseif ($notaantiga == 10){
    $chestar1 = "";
    $chestar2 = "";
    $chestar3 = "";
    $chestar4 = "";
    $chestar5 = "";
    $chestar6 = "";
    $chestar7 = "";
    $chestar8 = "";
    $chestar9 = "";
    $chestar10 = "checked";
  }

}



// Enviando avaliação

if (isset($_POST['adcionarquestao'])){



  // Obtendo comentário

  $comentario = trim($_POST['txtcomentario']);



  // Verificando se o comentário foi pereechido

  if ($comentario == ""){



    // Emitindo mensagem de erro

		$script = "<script>alert('Erro: Campo Comentário não pode ser nulo.');location.href='sobreadm.php';</script>";

		echo $script;

		exit;

  }



  // Obtendo melhoria ou erro

  $melhoriaerro = trim($_POST['txterromelhoria']);



  // Verificando se o campo melhoria/erro esta nulo

  if ($melhoriaerro == ""){



    // Definindo a melhoria/erro para nada

    $melhoriaerro = "Nenhuma melhoria ou erro";

  }



  // Obtendo nota
  $nota = @$_POST['star'];



  // Definindo um nome para o usuario

  $nome = $_SESSION["nome_adm"];



  if(mysqli_num_rows($sqlavaliacao)>0) {



    // Alterando os dados

    $sqlInsert = "UPDATE tabela_avaliacoes SET nota='$nota',comentario='".addslashes($comentario)."',melhoria_erro='".addslashes($melhoriaerro)."' WHERE nome_usuario='$nome_adm' and tipo = 1;";

    $result = $conexao->query($sqlInsert);

  }else{



  // Inserindo dados na tabela

  $insert = mysqli_query($conexao, "INSERT into tabela_avaliacoes(nome_usuario, nota, comentario, melhoria_erro, tipo) values('$nome','$nota','".addslashes($comentario)."','".addslashes($melhoriaerro)."', 1);");

  }



  // Emitindo mensagem de sucesso

  $script = "<script>alert('Avaliação enviada com Sucesso');location.href='sobreadm.php';</script>";

  echo $script;

  exit;



}



?>



<!-- Inicaisndo o corpo da página -->

<!DOCTYPE HTML>

<html>

<meta charset="UTF-8">  

<title>Sobre o Desenrrola ENEM</title>



<!-- Definindo um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- Definindo caracteristicas para o corpo da página -->

<body style="background-color: LightBlue;">



<!-- iniciando java -->

<script>



// Função para sair da conta -->

function sair() {

  var resultado = confirm("Deseja Realmente sair dessa Conta?")

    if (resultado == true) {

      location.href='sair.php';

    }

}



// Função para alterar dados -->

function pgaltdados() {

      location.href='alterar_dadosadm.php';

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

            color: black;

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



		

		/* Definindo caracteristicas dos botões */

        #adcionarquestao{

            width: 32%;

            border: none;

            padding: 15px;

            color: white;

            font-size: 15px;

            cursor: pointer;

            border-radius: 10px;

            background-color: DarkTurquoise;

        }

        #adcionarquestao:hover{

            background-color: MediumTurquoise;

        }

        #cancelar{

            width: 32%;

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

        <h1><a class="scrollto">DSENEM</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="sobreusu.php"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-active"><a href='pagina_adm.php'> Home</a></li>

          <?php

          if ($niveladm =="admgeral" || $niveladm == "adm"){echo "

          <li class='menu-has-children'><a >Professores</a>

            <ul>

              <li><a href='mostrar_professores.php'>Cadastrados</a></li>

              <li><a href='mostrar_professores_banidos.php'>Banidos</a></li>

              <li><a href='adicionar_adm.php'> ADD Professor</a></li>

            </ul>

          

          <li class='menu-has-children'><a >Questões</a>

            <ul>

              <li><a href='mostrar_questoes.php'>Visualizar Questões</a></li>

              <li><a href='adicionar_questao.php'>ADD Questão</a></li>

              <li class='menu-has-children'><a >Verificar Imagens</a>

                <ul>

                    <li><a href='verficarimg_perguntas.php'>Perguntas</a></li>

                    <li><a href='verficarimg_respostas.php'>Respostas</a></li>

                </ul>

                </li>

            </ul>

          </li>

           <li class='menu-has-children'><a >Usuários</a>

            <ul>

            <li><a href='mostrar_usuarios.php'>Cadastrados</a></li>

              <li><a href='mostrar_usuarios_banidos.php'>Banidos</a></li>

            </ul>

          </li>";

          }



          if ($niveladm =="admgeral" || $niveladm == "adm" || $niveladm == "corretor"){echo"

            <li class='menu-has-children'><a >Redações</a>

            <ul>

              <li><a href='readacoes_corrigir.php'>Para Corrigir</a></li>

              <li><a href='readacoes_corrigidas.php'>Corrigidas</a></li>

            </ul>

          </li>";

          }

          ?>



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

<br><br><br><br><br>



<!-- DIV para mostrar do que se trata o site e para deixar a avaliação -->

<!-- Para usuarios e professores normais -->
<center>

<div class="box" style="display: <?php echo $mosavaliacao; ?>" Align="left">

<!-- Mostrando sobre o desenrrola enem -->

<?php print "<p>".nl2br($sobre)."</p>"; ?>

<br><br>



<form action="" method="POST"> 



<!-- Borda do form -->

<fieldset>  



<!-- Legenda do form -->

<legend style="color:grey31; font-size:25px; font-weight: bold;">Nos Avalie </legend>



<b>Comentários</b>

<br>

<textarea cols="95" rows="5" style="width: 99%;" name="txtcomentario" value="text" required><?php echo $comentarioantigo; ?></textarea>

<br><br>



<b>Qual nota você daria para o site?</b>
<br>

<style>
  .rating{
  transform: translate(-44%,-50%) rotateY(180deg);
  display: flex;
}

.rating input{
  display: none;
}

.rating label{
    display: block;
    cursor: pointer;
    width: 50px;
}

.rating label:before{
  content: '\f005';
  font-family: fontAwesome;
  position: relative;
  display: block;
  font-size: 50px;
  color: #0e1316;
}

.rating label:after{
  content: '\f005';
  font-family: fontAwesome;
  position: absolute;
  display: block;
  font-size: 50px;
  color: #ffff00;
  top: 0;
  opacity: 0;
  transition: .5;
  text-shadow: 0 4px 5px rgba(0, 0, 0, .5);
}
.rating label:hover:after,
.rating label:hover ~ label:after,
.rating input:checked ~ label:after{
  opacity: 1;
}
</style>

<br><br>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <div class="rating">
      <input type="radio" name="star" id="star1" value="10" <?php echo $chestar10; ?>><label for="star1"></label>
      <input type="radio" name="star" id="star2" value="9" <?php echo $chestar9; ?>><label for="star2"></label>
      <input type="radio" name="star" id="star3" value="8" <?php echo $chestar8; ?>><label for="star3"></label>
      <input type="radio" name="star" id="star4" value="7" <?php echo $chestar7; ?>><label for="star4"></label>
      <input type="radio" name="star" id="star5" value="6" <?php echo $chestar6; ?>><label for="star5"></label>
      <input type="radio" name="star" id="star6" value="5" <?php echo $chestar5; ?>><label for="star6"></label>
      <input type="radio" name="star" id="star7" value="4" <?php echo $chestar4; ?>><label for="star7"></label>
      <input type="radio" name="star" id="star8" value="3" <?php echo $chestar3; ?>><label for="star8"></label>
      <input type="radio" name="star" id="star9" value="2" <?php echo $chestar2; ?>><label for="star9"></label>
      <input type="radio" name="star" id="star10" value="1" <?php echo $chestar1; ?>><label for="star10"></label>
    </div>

<br><br>



<b>Encontrou algum Erro ou Melhoria? (Opicional)</b>

<br>

<textarea cols="95" rows="5" style="width: 99%;" name="txterromelhoria" value="text"><?php echo $melhoriaerroantigo; ?></textarea>

<br><br>



<center>

<input type="submit" name="adcionarquestao" id="adcionarquestao" value="Enviar Avaliação">    

</form> 



</fieldset>



</div>



<!-- DIV para mostrar todas as avaliações -->

<!-- Para ADMs e ADM Geral -->

<div class="box" style="display: <?php echo $mosfeedback; ?>" Align="left">



<!-- Iniciando PHP para mostrar as avaliações -->

<?php 



// Verificando se alguma avalaiação foi enviada

if(mysqli_num_rows($consulta)<1) {

echo "<center><b>Nenhuma Avaliação Enviada</b></center>";

}



// verificando se a avaliação deve ser mostrada ou não

if ($niveladm == "adm" || $niveladm == "admgeral"){

while ($dado=$consulta->fetch_array()) { 



// Obtendo o tipo de usuario

// Verificando o tipo de usuario

if ($dado['tipo'] == 1){



  // Definindo o tipo de usuario

  $tipo_usu = "Professor: ";



}elseif ($dado['tipo'] == 2){



  // Definindo o tipo de usuario

  $tipo_usu = "Usuário: ";

}else{



  // Definindo o tipo de usuario

  $tipo_usu = "";

}



// Nome do usuario

echo "<b>". $tipo_usu ."</b>" . $dado['nome_usuario'];

echo "<br><br>";



// Nota

echo "<b>Nota: </b>" . $dado['nota'];

echo "<br><br>";



// Comentario

echo "<b>Comentário:</b><br>";

print "<p>".nl2br($dado['comentario'])."</p>";

echo "<br>";



// Melhoria/Erro

echo "<b>Melhoria/Erro:</b><br>";

print "<p>".nl2br($dado['melhoria_erro'])."</p>";

echo "<br><br><br>";



}

}

?>



</div>
</center>


</font>

</body>

</html>