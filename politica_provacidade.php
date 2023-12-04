<!-- iniciando PHP -->

<?php 



// Conectando com o banco de dados

include_once('conexao.php');



?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE HTML>

<html>

<meta charset="UTF-8">  

<title>Política de Privacidade</title>



<!-- Colocando ícone na página -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- chamando arquivo java para a passagem automática do slide -->

<script href="slide.js"></script>



<!-- Definindo caracteristica para o corpo da página -->

<body style="background-color: LightBlue;">



<!-- iniciando CSS para definir caracteristicas para o slide -->

<style>



.slider{

  border: 2px solid #000000;

  width: 90%;

  height: 60%;

  overflow: hidden;

  vertical-align: middle;

}



.slides{

  width: 400%;

  height: 60%;

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

  border: 2px solid #FFF;

  padding: 5px;

  border-radius: 10px;

  cursor: pointer;

  transition: 1s;

}



.manual-btn:not(:Last-child){

  margin-right: 20px;

}



.manual-btn:hover {

  background-color: #FFF;

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

  background-color: #FFF;

}



#radio2:checked ~ .navegation-auto .auto-btn2{

  background-color: #FFF;

}



#radio3:checked ~ .navegation-auto .auto-btn3{

  background-color: #FFF;

}



#radio4:checked ~ .navegation-auto .auto-btn4{

  background-color: #FFF;

}

</style>







<!-- Iniciando java -->

<script>



// Fução para entar na pagina de login -->

function login() {

      location.href='login.php';

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

}    



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

        <h1><a href="sobre.php" class="scrollto">DSENEM</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-has-children"><a>Simulados</a>

            <ul>

              <li><a href="gerar_simucom.php">Completos</a></li>

              <li><a href="gerar_simusim.php">Personalizados</a></li>

            </ul>

            <li><a href="pagina_inscrever-se.php">Voltar</a>

          </li>



          <li class="menu-active"><i class="bi bi-person-circle" title='Entrar' height ='30px' width='30px' onclick="login()"></i></li>

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



<div class="box">

<strong>Quem somos?</strong>

<br>

Nesse site onde você se encontra, foi criado como um trabalho para a conclusão do curso no ano de 2023, seu nome é Desenrola ENEM (desenrolaenem.com.br).<br>

Nele você pode gerar uma prova com até 90 questões aleatórias de todas as áreas de conhecimento para que você possa responder, e no fim, exibirá a pontuação feita, com a quantidade de acertos e erros, além de provas feitas por professores de diferentes áreas. Também se pode ver o ranking com a sua colocação onde é mostrado seus pontos e desempenho. Além disso, você pode escrever redações, para que professores voluntários e capacitados possam avalia-la.br<br>

Caso você seja professor, esse site também lhe será útil, já que nele estão cadastradas todas as perguntas do vestibular, desde 2009, sendo assim você pode selecionar perguntas que já caíram no ENEM, e elaborar uma prova para os seus alunos.<br>

Foi desenvolvido por: Júlia Mota Torlini, Kaio Leandro Rissato, Luis Felipe Puliani, Luís Pedro Dutra Carrocini, Miguel Malanote Pereira e Tainara Parpinelli Silva.

<br><br><br>



<strong>Quais dados pessoais coletamos e porque</strong>

<br>

Os dados que coletamos para o cadastro são:<br>

- E-Mail (Caso você se esqueça de sua senha, uma mendagem de recuperação será enviada para esse e-mail);<br>

- Nome (Essse nome pode ser fictício, porém será esse nome que aparecerá para outros usuários);<br>

- Data de Nascimento (Para calcular a sua idade, também será exibida para outros usuários);<br>

- Arquivos Anexados (Poderam ser vistos por ADMs e outros usuários);<br>

- Dados Calculados (São dados que serão caculados pelo próprio sistema de acordo com as suas repostas, em relação a provas);

<br><br><br>



<strong>Mídia</strong>

<br>

As informaçãos (Nome, Data de Nascimento e Arquivos Anexados) só serão divulgadas dentro do próprio site, não serão divulgadas para terceiros.

<br><br><br>



<strong>Com quem compartilhamos seus dados</strong>

<br>

Seus dados não serão compartilhados com ninguém fora deste site.

<br><br><br>



<strong>Por quanto tempo mantemos os seus dados</strong>

<br>

Seus dados ficarão armazenados por tempo indeterminado, ficarão armazenados até que você decida excluir a sua conta, assim todos os dados relacionados a você serão excluidos.

<br><br><br>



<strong>Quais os seus direitos sobre seus dados</strong>

<br>

Você tem todo o deireito sobre seus dados, porém caso não queira que seus dados sejam compartilhados com outros usuários desse mesmo site, você não poderá se cadastrar.

<br><br><br>



<strong>Para onde seus dados são enviados</strong>

<br>
Seus dados são enviados para os serviços de hospedagem da LocaWeb, onde são protegidos pelos serviços de segurança da hospedagem.

<br><br><br>



<strong>Informação de contato</strong>

<br>

E-Mail: desenrolaenem@gmail.com

<br><br><br>



</div>



<!-- Fechando tags em aberto -->

</body>

</html>