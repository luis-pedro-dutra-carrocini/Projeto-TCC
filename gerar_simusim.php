<!-- iniciando o corpo da página -->

<!DOCTYPE HTML>

<html>

<meta charset="UTF-8">  

<title>Gerar Simulado Personalizado</title>



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

legend{

padding: 10px;

text-align: center;

border-radius: 8px;

font-size: clamp(1em, 1em + 1vw, 1.5em);

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

background-color: RoyalBlue;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

}

#adicionar:hover{

background-color: CornflowerBlue;

}

#cancelar{

width: 47%;

border: none;

padding: 15px;

color: white;

font-size: 15px;

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

}

#cancelar:hover{

background-color: CornflowerBlue;

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

        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li><a href='mostar_questoesusu.php'>Questões</a></li>

        <li><a href='mostrar_provas.php'>Provas e Gabaritos</a></li>

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

              <li><a href="gerar_simucom.php">Completos</a></li>

            </ul>

          </li>



          

          <li><a href="index.php">Voltar</a></li>

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


<!-- Inserindo inpust no form -->
<body>
<br><br><br><br><br><br>



<center>
<div class="box" align="left">

        <form action="prova_personalizadasemcad.php" method="POST" name="f1">



            <!-- Borda do form -->

            <fieldset>



                <!-- Legenda do form -->

                <legend><b>Propriedades</b></legend>

                <br>



                <!-- Inserindo um combobox de quantidade de questões -->

                <b>Quantidade de Perguntas:</b>

                <select name="qtperguntas">

                    <option value="5">5</option>

                    <option value="10">10</option>

                    <option value="15">15</option>

                    <option value="20">20</option>

                    <option value="25">25</option>

                    <option value="30">30</option>

                    <option value="35">35</option>

					          <option value="40">40</option>

                    <option value="45">45</option>

                    <option value="50">50</option>

                    <option value="55">55</option>

                    <option value="60">60</option>

                    <option value="65">65</option>

                    <option value="70">70</option>

                    <option value="75">75</option>

                    <option value="80">80</option>

                    <option value="85">85</option>

                    <option value="90">90</option>

                </select>

                &nbsp;&nbsp;&nbsp;&nbsp;

                <b>Ano da Questão:</b>
				<select name="anoquestao">
                <option value='todos'>Todos</option>
                    <?php
					$contano = 2009;

					$hoje = date('Y');

					while ($contano <= $hoje){
						echo "<option value='".$contano."'>".$contano."</option>";

						$contano = $contano + 1;
					}

					?>
                </select>

                <br><br><br>



                <!-- Disciplinas que serão aceitas -->
      
                <b>Selecione as Discliplinas:</b>

                <br><br>



                <!-- Opção de selecionar todas -->

                <input type="checkbox" name="chetudo" id="chetudo" value="Todas">

                <label for="chetudo"><b>Todas</b></label>

                <br><br>



                <!-- Opção de selecionar todas de ciencias da natureza-->

                <input type="checkbox" name="checienciasnatureza" id="checienciasnatureza" value="Ciências da Natureza">

                <label for="checienciasnatureza"><b>Ciências da Natureza</b></label>

                <br>



                <!-- Checbox Química-->

                <input type="checkbox" name="chequimica" id="chequimica" value="Química">

                <label for="chequimica">Química</label>



                <!-- Checbox Física-->

                <input type="checkbox" name="chefisica" id="chefisica" value="Física">

                <label for="chefisica">Física</label>



                <!-- Checbox Biologia-->

                <input type="checkbox" name="chebiologia" id="chebiologia" value="Biologia">

                <label for="chebiologia">Biologia</label>





                <br><br>

                <!-- Opção de selecionar todas de ciencias Humanas-->

                <input type="checkbox" name="checienciashumanas" id="checienciashumanas" value="Ciências Humanas">

                <label for="checienciashumanas"><b>Ciências Humanas</b></label>

                <br>



                <!-- Checbox História-->

                <input type="checkbox" name="chehistoria" id="chehistoria" value="História">

                <label for="chehistoria">História</label>



                <!-- Checbox Geografia-->

                <input type="checkbox" name="chegeografia" id="chegeografia" value="Geografia">

                <label for="chegeografia">Geografia</label>



                <!-- Checbox Filosofia-->

                <input type="checkbox" name="chefilosofia" id="chefilosofia" value="Filosofia">

                <label for="chefilosofia">Filosofia</label>



                <!-- Checbox Sociologia-->

                 <input type="checkbox" name="chesociologia" id="chesociologia" value="Sociologia">

                <label for="chesociologia">Sociologia</label>





                <br><br>

                <!-- Opção de selecionar Matemática-->

                <input type="checkbox" name="chematematica" id="chematematica" value="Matemática">

                <label for="chematematica"><b>Matemática</b></label>





                <br><br>

                <!-- Opção de selecionar todas de Linguagens-->

                <input type="checkbox" name="chelinguagens" id="chelinguagens" value="Linguagens">

                <label for="chelinguagens"><b>Linguagens</b></label>

                <br>



                <!-- Checbox Língua Portuguesa-->

                <input type="checkbox" name="cheportugues" id="cheportugues" value="Língua Portuguesa">

                <label for="cheportugues">Língua Portuguesa</label>



                <!-- Checbox Literatura-->

                 <input type="checkbox" name="cheliteratura" id="cheliteratura" value="Literatura">

                <label for="cheliteratura">Literatura</label>



                <!-- Checbox Educação Física-->

                <input type="checkbox" name="cheedfisica" id="cheedfisica" value="Educação Física">

                <label for="cheedfisica">Educação Física</label>



                <!-- Checbox Artes-->

                <input type="checkbox" name="cheartes" id="cheartes" value="Artes">

                <label for="cheartes">Artes</label>


                <!-- Checbox Lingua Estrangeira: Inglês-->

                <input type="checkbox" name="cheingles" id="cheingles" value="Lingua Estrangeira: Inglês">

                <label for="cheingles">Inglês</label>



                <!-- Checbox Lingua Estrangeira: Espanhol-->

                <input type="checkbox" name="cheespanhos" id="cheespanhos" value="Lingua Estrangeira: Espanhol">

                <label for="cheespanhos">Espanhol</label>



<!-- Iniciando java para manipular checkboxs -->              

<script>



// Configurando propriedade de checar tudo -->

var clikchetudo = document.querySelector("#chetudo");

clikchetudo.addEventListener("click", function() {

let chetudo = document.getElementById('chetudo');

if(chetudo.checked) {

    document.getElementById("checienciasnatureza").checked = true;

    document.getElementById("chequimica").checked = true;

    document.getElementById("chefisica").checked = true;

    document.getElementById("chebiologia").checked = true;



    document.getElementById("checienciashumanas").checked = true;

    document.getElementById("chehistoria").checked = true;

    document.getElementById("chegeografia").checked = true;

    document.getElementById("chefilosofia").checked = true;

    document.getElementById("chesociologia").checked = true;



    document.getElementById("chematematica").checked = true;



    document.getElementById("chelinguagens").checked = true;

    document.getElementById("cheliteratura").checked = true;

    document.getElementById("cheedfisica").checked = true;

    document.getElementById("cheartes").checked = true;

    document.getElementById("cheingles").checked = true;

    document.getElementById("cheespanhos").checked = true;

    document.getElementById("cheportugues").checked = true;

} else {

    document.getElementById("checienciasnatureza").checked = false;

    document.getElementById("chequimica").checked = false;

    document.getElementById("chefisica").checked = false;

    document.getElementById("chebiologia").checked = false;



    document.getElementById("checienciashumanas").checked = false;

    document.getElementById("chehistoria").checked = false;

    document.getElementById("chegeografia").checked = false;

    document.getElementById("chefilosofia").checked = false;

    document.getElementById("chesociologia").checked = false;



    document.getElementById("chematematica").checked = false;



    document.getElementById("chelinguagens").checked = false;

    document.getElementById("cheliteratura").checked = false;

    document.getElementById("cheedfisica").checked = false;

    document.getElementById("cheartes").checked = false;

    document.getElementById("cheingles").checked = false;

    document.getElementById("cheespanhos").checked = false;

    document.getElementById("cheportugues").checked = false;

}

});



// Configurando propriedade de checar ciencias da naturaza -->

var clikchecienciasnatureza = document.querySelector("#checienciasnatureza");

clikchecienciasnatureza.addEventListener("click", function() {

    let checienciasnatureza = document.getElementById('checienciasnatureza');

    if(checienciasnatureza.checked) {

    document.getElementById("chequimica").checked = true;

    document.getElementById("chefisica").checked = true;

    document.getElementById("chebiologia").checked = true;

} else {

    document.getElementById("chequimica").checked = false;

    document.getElementById("chefisica").checked = false;

    document.getElementById("chebiologia").checked = false;

}

});



// Configurando propriedade de checar ciencias humanas -->

var clikchecienciashumanas = document.querySelector("#checienciashumanas");

clikchecienciashumanas.addEventListener("click", function() {

    let chechecienciashumanas = document.getElementById('checienciashumanas');

    if(chechecienciashumanas.checked) {

    document.getElementById("chehistoria").checked = true;

    document.getElementById("chegeografia").checked = true;

    document.getElementById("chefilosofia").checked = true;

    document.getElementById("chesociologia").checked = true;

} else {

    document.getElementById("chehistoria").checked = false;

    document.getElementById("chegeografia").checked = false;

    document.getElementById("chefilosofia").checked = false;

    document.getElementById("chesociologia").checked = false;

}

});



// Configurando propriedade de checar linguagens -->

var clikchelinguagens = document.querySelector("#chelinguagens");

clikchelinguagens.addEventListener("click", function() {

    let chelinguagens = document.getElementById('chelinguagens');

    if(chelinguagens.checked) {

    document.getElementById("cheliteratura").checked = true;

    document.getElementById("cheedfisica").checked = true;

    document.getElementById("cheartes").checked = true;

    document.getElementById("cheingles").checked = true;

    document.getElementById("cheespanhos").checked = true;

    document.getElementById("cheportugues").checked = true;

} else {

    document.getElementById("cheliteratura").checked = false;

    document.getElementById("cheedfisica").checked = false;

    document.getElementById("cheartes").checked = false;

    document.getElementById("cheingles").checked = false;

    document.getElementById("cheespanhos").checked = false;

    document.getElementById("cheportugues").checked = false;

}

});

</script>



<br><br><br>

<div>   

<button type="submit" id="adicionar" name="btn_adicionaradm">Gerar Simulado</button>

<button type="button" id="cancelar" name="btn_canadiadm" onclick="voltar()">Cancelar</button>

</div>

            </fieldset>



<!-- Fechando tags em aberto -->

</form>
</div>

</center>
<br><br>

<center>
<div style="width: 90%; height:75px;">
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

</body>
</html>