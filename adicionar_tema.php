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

}



// Quando clicar no botão adicionar

if(isset($_POST["adicionar"])){



    // Obtendo os dados do formulário

    // Tema

	  $tema = Addslashes(trim($_POST['txttema']));



    // Tipo do tema

    if ($_POST['chetipo'] == "peloenem"){

        $tipo = 0;

    }elseif ($_POST['chetipo'] == "pormim"){

        $tipo = 1;

    }



    // Ano

    $ano = Addslashes(trim($_POST['ano']));



    // Verificando se o campo tema não esta nulo

    if ($tema != ""){

    

    // Obtendo os dados do bd para ver se o tema ja esta cadastrado

    $sql3 = mysqli_query($conexao, "SELECT * FROM tabela_temasredacoes WHERE tema = '".addslashes($tema)."';");



    // Verificando se o tema já existe

    if(mysqli_num_rows($sql3)>0) {



        // Enviando mesagem de erro

        $script = "<script>alert('Erro: Não foi possivel cadastrar o tema. Tema já cadastrado.');location.href='adicionar_tema.php';</script>";

        echo $script;

        exit;

    }else{



    // Verificando se o campo ano não esta nulo

    if ($ano == ""){



        // Enviando mesagem de erro

        $script = "<script>alert('Erro: Não foi possivel cadastrar o tema. Campo ano não pode ser nulo.');location.href='adicionar_tema.php';</script>";

        echo $script;

        exit;

    }



    // Verificando o tema é do ENEM e se o tema referente a um ano já existe

    if ($tipo == 0){



      // verifiacndo se o ano desse tema ja existe

      $sql4 = mysqli_query($conexao, "SELECT * FROM tabela_temasredacoes WHERE (ano = $ano and tipo = 0 and tema != '$tema');");



      if(mysqli_num_rows($sql4)>0) {



          // Enviando mesagem de erro

          $script = "<script>alert('Erro: Não foi possivel cadastrar o tema. O tema do ano $ano, já está Cadastrado.');location.href='adicionar_tema.php';</script>";

          echo $script;

          exit;

      }

  }



    // Adicionando o tema no banco de dados

    $adicionar = mysqli_query($conexao, "INSERT into tabela_temasredacoes(tema, ano, tipo) values('".addslashes($tema)."', $ano, $tipo);");



    // Redirecionando para a pagina correta

    // Se o tipo for ENEM

    if ($tipo == 0){

        $script = "<script>alert('Tema Cadastrado com sucesso');location.href='temas_enem.php';</script>";

        echo $script;

    

        // Se o tipo form proposto por professor

        }elseif ($tipo == 1){

        $script = "<script>alert('Tema Cadastrado com sucesso');location.href='temas_professores.php';</script>";

        echo $script;

        }

    }

    }else{



        // Enviando mesagem de erro, pois o campo tema esta vazio

        $script = "<script>alert('Erro: Não foi possivel cadastrar o tema. Campo tema não pode ser nulo.');location.href='adicionar_tema.php';</script>";

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

<title>Cadastrar Tema</title>



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



// função para voltar para a pagina adm

function voltar() {

    location.href='pagina_adm.php';

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

        #limpar{

width: 49%;

border: none;

padding: 15px;

color: white;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

}

#limpar:hover{

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

legend{

padding: 10px;

text-align: center;

border-radius: 8px;

font-size: clamp(1em, 1em + 1vw, 1.5em);

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

  <li class='menu-active'><a href='pagina_adm.php'>Home</a></li>

  <!-- Iniciando PHP -->
	<?php

	// Verificando o nivel do adm para ver quais intens do cabeçalho se deve mostrar
	if ($nivel =="admgeral" || $nivel == "adm"){echo "
	<li class='menu-has-children'><a>Provas</a>
	<ul>
	  <li><a href='mostrar_provas.php'>Vizualizar</a></li>
	  <li><a href='provas_cadastradas.php'>Cadastradas</a></li>
	  <li><a href='adicionar_prova.php'>ADD Prova</a>
	  <li class='menu-has-children'><a>Disciplinas</a>
		  <ul>
			  <li><a href='mostrar_disciplinas.php'>Cadastradas</a></li>
			  <li><a href='adicionar_disciplina.php'>ADD Disciplina</a></li>
		  </ul>
	  </li>
	</ul>
	</li>
	<li class='menu-has-children'><a>Questões</a>
	  <ul>
		<li><a href='mostrar_questoes.php'>Cadastradas</a></li>
		<li><a href='adicionar_questao.php'>ADD Questão</a></li>
		<li class='menu-has-children'><a>Verificar Imagens</a>
		  <ul>
			  <li><a href='verficarimg_perguntas.php'>Perguntas</a></li>
			  <li><a href='verficarimg_respostas.php'>Respostas</a></li>
		  </ul>
		  </li>
	  </ul>
	</li>
	 <li class='menu-has-children'><a >Usuários</a>
	  <ul>
	  <li><a href='mostrar_usuarios.php'>Alu. Cadastrados</a></li>
	  <li><a href='mostrar_usuarios_banidos.php'>Alu. Banidos</a></li>
	  <li><a href='mostrar_professores.php'>Prof. Cadastrados</a></li>
	  <li><a href='mostrar_professores_banidos.php'>Prof. Banidos</a></li>
	  <li><a href='adicionar_adm.php'> ADD Professor</a></li>
	  </ul>
	</li>";
	}


	if ($nivel =="admgeral" || $nivel == "adm" || $nivel == "corretor"){echo"
	  <li class='menu-has-children'><a >Redações</a>
	  <ul>
		<li><a href='readacoes_corrigir.php'>Para Corrigir</a></li>
		<li><a href='readacoes_corrigidas.php'>Corrigidas</a></li>
		<li class='menu-has-children'><a >Temas</a>
		<ul>
		  <li><a href='temas_enem.php'>ENEM</a></li>
		  <li><a href='temas_usuarios.php'>Usuários</a></li>
		  <li><a href='temas_professores.php'>Professores</a></li>
		</ul>
	  </ul>
	</li>";

	if ($nivel =="corretor"){echo"
	<li><a href='pagina_adm.php?mos_tabques=Todas'>Questões</a></li>";
	}
	}

	if ($nivel !="admgeral" && $nivel != "adm"){echo "
	<li><a href='mostrar_provas.php'>Provas e Gabaritos</a></li>";
	}
	?>

	<li class="menu-has-children"><a >Simulados</a>
	  <ul>
		<li><a href="provas_geradasadm.php">Meus</a></li>
		<li><a href="provasadm_adm.php">Professores</a></li>
		<li><a href="provasusu_adm.php">Usuários</a></li>
		<li><a href="gerar_provaadm.php">Criar</a></li>
	  </ul>
	</li>
	<li><a href="alterar_dadosadm.php">Dados</a></li>
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



<!-- Inserindo inputs com suas caracteristicas -->

<body>
<center>
    <div class="box" align="left">

        <form action="" method="POST" name="f1">



            <!-- Borda em volta do form -->

            <fieldset>



                <!-- legenda do Formulario -->

                <legend><b>Cadastrar Tema</b></legend>

                <br><br>



                <!-- Campo Tema -->

                <div class="inputBox">

                <b>Tema:</b>

                <input type="text" style="width: 88%; border: 2px solid white; color:white; background-color: black;" name="txttema" id="email" class="inputUser" autofocus maxlength="300" required>

                <br><br>



                <!-- radios Buton para decidir se o tema caiu no enem ou é para fins didaticos -->

                De onde vem esse Tema?<br>

                <input type='radio' name='chetipo' value='peloenem' checked>

                <label for='chetipo'>Já caiu no ENEM</label>&nbsp;&nbsp;



                <input type='radio' name='chetipo' value='pormim'>

                <label for='chetipo'>Proposto por mim</label>&nbsp;&nbsp;

                <br><br>



                <b>Ano da Aplicação:</b>
				        <select name="ano" style="border: 2px solid white; color:white; background-color: black;" >
                    <?php

					// Contador de ano desde o inicio do enem
					$contano = 1998;

					// Ano atual
					$hoje = date('Y');


					while ($contano <= $hoje){

						echo "<option value='".$contano."'>".$contano."</option>";

						$contano = $contano + 1;
					}

					?>
                </select>
<br><br>



                <!-- Botão alterar e cancelar -->

                <button type ="submit" id="alterar" name="adicionar">Cadastrar</button>

                <button type ="button" id="cancelar" onclick="voltar()" name="cancelar">Cancelar</button>

            </fieldset>



<!-- Fechando tags em aberto -->

</form>

</div>
</center>
<br><br>
</body>

</html>