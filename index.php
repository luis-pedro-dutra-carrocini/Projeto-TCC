<!-- iniciando PHP -->

<?php 



// Conectando com o banco de dados

include_once('conexao.php');



// Obtendo os dados do index

$sqldadosindex = mysqli_query($conexao, "SELECT * FROM tabela_informacoesdosite WHERE codigo = 1;");

$dadosindex=$sqldadosindex->fetch_array();



// Obtendo os nomes das imagens

$img1 = $dadosindex['imagem_index1'];

$img2 = $dadosindex['imagem_index2'];

$img3 = $dadosindex['imagem_index3'];

$img4 = $dadosindex['imagem_index4'];

// Obtendo os dados do index

$sqldadosindex = mysqli_query($conexao, "SELECT * FROM tabela_informacoesdosite WHERE codigo = 1;");

$dadosindex=$sqldadosindex->fetch_array();



// Obtendo o sobre

$sobre = $dadosindex['sobre'];



// Enviando avaliação

if (isset($_POST['adcionarquestao'])){



  // Obtendo comentário

  $comentario = trim($_POST['txtcomentario']);



  // Verificando se o comentário foi pereechido

  if ($comentario == ""){



    // Emitindo mensagem de erro

		$script = "<script>alert('Erro: Campo Comentário não pode ser nulo.');location.href='index.php';</script>";

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

  $nome = "Usuário não Cadastrado";



  // Inserindo dados na tabela

  $insert = mysqli_query($conexao, "INSERT into tabela_avaliacoes(nome_usuario, nota, comentario, melhoria_erro, tipo) values('$nome','$nota','".addslashes($comentario)."','".addslashes($melhoriaerro)."', 0);");



  // Emitindo mensagem de sucesso

  $script = "<script>alert('Avaliação enviada com Sucesso');location.href='index.php';</script>";

  echo $script;

  exit;



}

?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE HTML>

<html>

<meta charset="UTF-8">  

<title>Desenrola ENEM</title>

<head>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1724042721194868"
     crossorigin="anonymous"></script>

<!-- Colocando ícone na página -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- chamando arquivo java para a passagem automática do slide -->

<script href="slide.js"></script>



<!-- Definindo caracteristica para o corpo da página -->

<body style="background-color: black;">



<!-- iniciando CSS para definir caracteristicas para o slide -->

<style>



.slider{

  border: 2px solid #0000FF;

  width: 90%;

  height: 500px;

  overflow: hidden;

  vertical-align: middle;

}



.slides{

  width: 400%;

  height: 500px;

  display: flex;

}



.slides input{

  display: none;

}



.slide {

  width: 25%;

  position: relative;

}



.slide img {

  width: 100%;

  height: 100%;

}



.manual-navegatin {

  position: absolute;

  width: 90%;

  margin-top: -40px;

  display: flex;

  justify-content: center;

}



.manual-btn {

  border: 2px solid #000000;

  padding: 5px;

  border-radius: 10px;

  cursor: pointer;

  transition: 1s;

}



.manual-btn:not(:Last-child){

  margin-right: 20px;

}



.manual-btn:hover {

  background-color: #000000;

}



#radio1:checked ~ .first{

  margin-left: 0;

}



#radio2:checked ~ .first{

  margin-left: -25%;

}



#radio3:checked ~ .first{

  margin-left: -50%;

}



#radio4:checked ~ .first{

  margin-left: -75%;

}



.navegation-auto div{

  border: 2px solid #000000;

  padding: 5px;

  border-radius: 10px;

  cursor: pointer;

  transition: 1s;

}



.navegation-auto{

  position: absolute;

  width: 90%;

  margin-top: -45px;

  display: flex;

  justify-content: center;

}



.navegation-auto div:not(:Last-child){

  margin-right: 20px;

}



#radio1:checked ~ .navegation-auto .auto-btn1{

  background-color: #000000;

}



#radio2:checked ~ .navegation-auto .auto-btn2{

  background-color: #000000;

}



#radio3:checked ~ .navegation-auto .auto-btn3{

  background-color: #000000;

}



#radio4:checked ~ .navegation-auto .auto-btn4{

  background-color: #000000;

}

</style>







<!-- Iniciando java -->

<script>



// função para entrar na página cadastrar-se -->

function cadastrar() {

      location.href='pagina_inscrever-se.php';

}





// Fução para entar na pagina de login -->

function login() {

      location.href='login.php';

}



// Função para abrir a pagina gerar simulado personalizado

function simusim() {

      location.href='gerar_simusim.php';

}



// Função para abrir a pagina gerar simulado personalizado

function simucom() {

      location.href='gerar_simucom.php';

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

			background-color: LightBlue;

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

legend{

padding: 10px;

text-align: center;

border-radius: 8px;

font-size: clamp(1em, 1em + 1vw, 1.5em);

}

</style>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KW2JRPPJMX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-KW2JRPPJMX');
</script>

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

        <li><a href='mostar_questoesusu.php'>Questões</a></li>

        <li><a href='mostrar_provas.php'>Provas e Gabaritos</a></li>

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

              <li><a href="gerar_simucom.php">Completos</a></li>

              <li><a href="gerar_simusim.php">Personalizados</a></li>

            </ul>

          </li>



          

          <li><a href="pagina_inscrever-se.php">Cadastrar-se</a></li>

          <li class="menu-active"><a href="login.php">Entrar</a></li>

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



<!-- Criando um slider -->

<center>

<div class="slider">



<div class="slides">

<input type="radio" name="radio-btn" id="radio1">

<input type="radio" name="radio-btn" id="radio2">

<input type="radio" name="radio-btn" id="radio3">

<input type="radio" name="radio-btn" id="radio4">





<!-- imagens a aparecer -->

<div class="slide first">

  <img src="img_index/<?php echo $img1; ?>" alt="Imagem 1">

</div>



<div class="slide">

  <img src="img_index/<?php echo $img2; ?>" alt="Imagem 2">

</div>



<div class="slide">

  <img src="img_index/<?php echo $img3; ?>" alt="Imagem 3">

</div>



<div class="slide">

  <img src="img_index/<?php echo $img4; ?>" alt="Imagem 4">

</div>









</div>



<div class="manual-navegatin">

  <label for="radio1" class="manual-btn"></label>

  <label for="radio2" class="manual-btn"></label>

  <label for="radio3" class="manual-btn"></label>

  <label for="radio4" class="manual-btn"></label>

</div>



</div>

</center>



<script>

// Criando código para passar o slide automático --->

let caunt = 1;

document.getElementById("radio1").checked = true;



setInterval( function(){ proximaimagem(); }, 5000);



function proximaimagem(){

  caunt++;

  if(caunt>4){

    caunt = 1;

  }

  document.getElementById("radio"+caunt).checked = true;

}

</script>

<br><br>

<center>
<div style="width: 50%; height:75px;">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1724042721194868"
     crossorigin="anonymous"></script>
<!-- bloco2 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1724042721194868"
     data-ad-slot="7115760036"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</center>
<br><br>

<center>

<!-- Mostrando sobre o desenrrola enem -->

<div class="box" Align="left">

<font color="white">

<center>
<legend><b>Quem Somos?</b></legend>
<br>
</center>
<?php print "<p>".nl2br($sobre)."</p>"; ?>
<br>
</div>
<br><br>

<form action="" method="POST"> 
<!-- Borda do form -->
<fieldset>  

<!-- Legenda do form -->
<div class="box" Align="left">
<b><legend>Deixe sua avaliação.... </legend></b>



<b>Comentários</b>
<br>
<textarea cols="95" rows="5" style="width: 99%; border: 2px solid white; color:white; background-color: black;" name="txtcomentario" value="text" required></textarea>
<br><br>

<b>Avaliação</b>
<br>
<style>
  .rating{
  transform: translate(-73%,-50%) rotateY(180deg);
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
  color: white;
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
    <div class="rating" aling="center">
      <input type="radio" name="star" id="star6" value="5"><label for="star6"></label>
      <input type="radio" name="star" id="star7" value="4"><label for="star7"></label>
      <input type="radio" name="star" id="star8" value="3"><label for="star8"></label>
      <input type="radio" name="star" id="star9" value="2"><label for="star9"></label>
      <input type="radio" name="star" id="star10" value="1"><label for="star10"></label>
    </div>

<b>Erro ou Melhoria? (Opicional)</b>
<br>
<textarea cols="95" rows="5" style="width: 99%; border: 2px solid white; color:white; background-color: black;" name="txterromelhoria" value="text"></textarea>
<br><br>

<center>
<input type="submit" name="adcionarquestao" id="adcionarquestao" value="Enviar Avaliação">    
</form> 

</fieldset>
</diV>
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

<!-- Fechando tags em aberto -->
</body>
</html>