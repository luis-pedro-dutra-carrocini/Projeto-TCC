<!-- iniciando o corpo da página -->

<!DOCTYPE HTML>

<html>

<meta charset="UTF-8">  

<title>Gerar Simulado Completo</title>



<!-- definindo um icone -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- Iniciando o java -->

<script>



// função para abrir a pagina cadastrar-se -->

function voltar() {

      location.href='index.php';

}



// Função para abrir a pagina gerar simulado personalizado

function simusim() {

      location.href='gerar_simusim.php';

}



// função para entrar na página cadastrar-se -->

function cadastrar() {

      location.href='pagina_inscrever-se.php';

}





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

}    </style>



<!-- Iniciando CSS -->

<style>



/* caracteristicas do corpo da página */

body{

    font-family: Arial, Helvetica, sans-serif;

    background-color: LightBlue;

}



/* Caracteristicas do quadro em volta do form */

.box{

    color: black;

    background-color: white;

    padding: 15px;

    border-radius: 15px;

    width: 50%;

}



/* Caracteristicas da legenda do form */

legend{

    padding: 10px;

    text-align: center;

    border-radius: 8px;

    font-size: 22px;

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

#adicionar{

    width: 50%;

    border: none;

    padding: 15px;

    color: white;

    font-size: 15px;

    cursor: pointer;

    border-radius: 10px;

    background-color: DarkTurquoise;

}

#adicionar:hover{

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

        <h1><a href="#intro" class="scrollto">DSENEM</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

              <li><a href="gerar_simusim.php">Personalizados</a></li>

            </ul>

          </li>



          

          <li><a href="index.php">Voltar</a></li>

          <li><a onclick="cadastrar()">Cadastrar-se</a></li>

          <li class="menu-active"><a onclick="login()">Entrar</a></li>

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

<br><br><br><br><br><br><br><br>



<!-- Inserindo inpust no form -->

<body>


<center>
<div class="box" align="left">

<form action="prova_completasemcad.php" method="POST" name="f1">

<!-- Borda do form -->

<fieldset>



<!-- Legenda do form -->

<legend><b>Selecione o tipo do Simulado</b></legend>

<br>



			<!-- Botao para escolher exatas ou humanas-->

			<div class="remember">

			  <input type="radio" name="radtipoprova" value="humanas" id="humanas" checked>&nbsp;<b>Linguagens e Ciências Humanas</b><br><br>

        Neste Simulado estão incluidas as seguintes disciplinas:<br>

        Linguagens: Artes, Educação Física, Português, Literatura e Espanhol ou Inglês.<br>

        Ciências Humanas: Filosofia, Geografia, História, e Sociologia.

        <br><br>



        <!-- Div para decidir se vai ter ingles ou espanhol -->

        <div id="divlinest">

        Inglês ou Espanhol?

        <br><br>

        <input type="radio" name="radlinguaestrangeira" value="ingles" checked>&nbsp; Inglês

        <input type="radio" name="radlinguaestrangeira" value="espanhol">&nbsp; Espanhol

        </div>



        <br><br>

			  <input type="radio" name="radtipoprova" value="exatas" id="exatas" >&nbsp;<b>Matemática e Ciências da Natureza</b><br><br>

        Neste Simulado estão incluidas as seguintes disciplinas: Biologia, Física, Química e Matemática.

			</div>



<br><br>

<div>   

<button type="submit" id="adicionar" name="btn_adicionaradm">Gerar Simulado</button>

<button type="button" id="cancelar" name="btn_canadiadm" onclick="voltar()">Cancelar</button>

</div>

</fieldset>



<script>

// Verificando se a prova é humanas ou exatas

var chehumanas = document.querySelector("#humanas");

chehumanas.addEventListener("click", function() {

divlinest.style.display = "block"; 

});



var cheexatas = document.querySelector("#exatas");

cheexatas.addEventListener("click", function() {

divlinest.style.display = "none"; 

});



</script>



<!-- Fechando tags em aberto -->

</form>

</div>

</center>

</body>

</html>