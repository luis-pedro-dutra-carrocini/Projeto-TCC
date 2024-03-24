<!-- Iniciando PHP -->

<?php



// Conecatando com o banco de dados 

include_once ("conexao.php");



if (isset($_POST['alterarsenha'])){



    // Obtendo o email digitado

    $email = trim($_POST['email']);



    // Validando email

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){



        // Emitindo mensagem de erro

	    $script = "<script>alert('Erro: E-Mail Inválido.');location.href='esqueceu_senha.php';</script>";

	    echo $script;

        exit;

    }else{



        // Verificando se aluno ou professor 

        if ($_POST['radadus'] == "ADM"){



            // Selecionando os dados da tabela

            $sqlemail = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE email = '".addslashes($email)."';");

            $usuario = "professor";

            $tabela = "tabela_adm";



        }elseif ($_POST['radadus'] == "usuario"){



            // Selecionando os dados da tabela

            $sqlemail = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE email = '".addslashes($email)."';");

            $usuario = "aluno";

            $tabela = "tabela_usuario";

        }



        // Verificando se o email existe no banco de dados

        if (mysqli_num_rows($sqlemail) < 1){



            // Emitindo mensagem de erro

	        $script = "<script>alert('Erro: E-Mail não Cadastrado.');location.href='esqueceu_senha.php';</script>";

	        echo $script;

            exit;

        }



        // Criando uma nova senha

        $novasenha = substr(md5(time()), 0, 6);

        $nscriptografada = md5(md5($novasenha));



        // Enviando email com a nova senha
        $destinatario = $email;

        $subject = "RECUPERAR SENHA";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message = "<html><head>";
        $message .= "
        	<h2>Senha do e-mail alterada!</h2>
        	<hr>
        	<h3>Sua senha de ".$usuario." do site desenrolaenem.com.br foi alterada:</h3>
        	<p>Nova senha: ".$nscriptografada."</p>
        	<hr>
        	<h5>Acesse o e-mail e altere a senha, essa é temporária</h5>
        	<hr>
        	Atenciosamente, Desenrola ENEM.
        ";

        $message .="</head></html>";

        $emailsender = "admsenhas@desenrolaenem.com.br";

        if(mail($destinatario, $subject, $message, $headers ,"-r".$emailsender)){

          // Alterando senha no bd
          $sqlInsert = "UPDATE tabela_usuario SET senha='$nscriptografada' WHERE email='$email';";
          $result = $conexao->query($sqlInsert);

          // Emitindo mensagem de sucesso
        	$script = "<script>alert('Nova senha enviada para o E-Mail, verifique sua caixa de entrada.');location.href='login.php';</script>";
	        echo $script;
        }else{

          // Emitindo mensagem de errro
        	$script = "<script>alert('Erro ao enviar o E-Mail.');location.href='login.php';</script>";
	        echo $script;
		    }


    }

}



?>



<!-- Iniciando o corpo da página -->

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatoble" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Esqueceu sua Senha</title>



<!-- Definind um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- Buscando informações no arquivo CSS -->

<link rel="stylesheet" href="style.css">



<!-- link para mostrar senha -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">





<!-- Iniciando Java -->

<script language="Javascript">



// Função para validar o email -->

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

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

              <li><a href="gerar_simucom.php">Completos</a></li>

              <li><a href="gerar_simusim.php">Personalizados</a></li>

            </ul>

          </li>

          <li><a href="pagina_inscrever-se.php">Cadastrar-se</a></li>

		  <li><a href="login.php">Voltar</a></li>



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



<!-- Inserindo inputs no form -->

<body style="background-color: black;">



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- link para mostrar senha -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->



<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<br>



<div class="container">
<article class="card-body mx-auto" style="max-width: 400px; background-color: #363636;">
<h4 class="card-title mt-3 text-center" style="color:white;">Recuperar Senha</h4>
<br>

<form method="POST" action="" name="f1">

    <div class="form-group input-group">

        <div class="form-group input-group">

            <div class="input-group-prepend">

		        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>

	        </div>

            <input class="form-control" value="" placeholder="E-Mail" type="email" name="email" id="email" onblur="validacaoEmail(f1.email)" maxlength="256" required>

            <input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 

            <br><br>

            </div>





            <!-- Botões para ver se é professor ou usuario--> 

	        <div class="form-group">

	        <input type="radio" name="radadus" value="usuario" checked> <font color="white"> Aluno &nbsp;&nbsp;

	        <input type="radio" name="radadus" value="ADM"> Professor<br> 

            </div>

        </div>



    <div class="form-group">

    <input type="submit" name="alterarsenha" class="btn btn-primary btn-block" value="Recuperar Senha">

    </div>

    </div> 



</form>

</article>



</div>

</div> 



  <!-- Fechando tags em aberto -->

</body>

</html>