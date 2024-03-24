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

  $niveladm = $dado['nivel'];



  // Se o adm for corretor, adm normal ou adm geral

  if ($niveladm == "admgeral" || $niveladm == "adm"){

  }

  else{



    // Redirecionando para a pagina adm, pois o nivel do adm não condiz com a página atual

    header('location: pagina_adm.php');

    exit;

  }

}



// Quando clicar no botão adicionar

if(isset($_POST["adicionar"])){

    $ano = Addslashes($_POST['anoprova']);

    $nomeprovafixo = Addslashes(trim($_POST['nomeprova']));

    $dia = Addslashes($_POST['dia']);

    //Verificando se a prova foi selecionada,
		if (!empty($_FILES['arqprova']['name'])){

			// Obtendo os dados da imagem
			// Nome
			$nomeprova = $_FILES['arqprova']['name'];

			// Tipo
			$tipoprova = $_FILES['arqprova']['type'];

      // Obtendo o nome temporario do arquivo
			$nometemporarioprova = $_FILES['arqprova']['tmp_name'];

			// Verificando o tipoprova de arquivo escolhido
			$tipoprovaspermitidos = ["application/pdf"];
			if (!in_array ($tipoprova, $tipoprovaspermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Prova. Tipo de arquivo não permitido na Prova.');location.href='adicionar_prova.php';</script>";
				echo $script;
				exit;
			}

			// Definindo um acaminho e nome para a imagem
			$caminho = "provas_enem/";
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporarioprova, $caminho.$nomeprova)){
				
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar a Prova.');location.href='adicionar_prova.php';</script>";
				echo $script;
				exit;
			}
    }else{
        // Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar a Prova, arquivo não detectado.');location.href='adicionar_prova.php';</script>";
				echo $script;
				exit;
    }

    //Verificando se a prova foi selecionada,
		if (!empty($_FILES['arqgabarito']['name'])){

			// Obtendo os dados da imagem
			// Nome
			$nomegabarito = $_FILES['arqgabarito']['name'];

			// Tipo
			$tipogabarito = $_FILES['arqgabarito']['type'];

      // Obtendo o nome temporario do arquivo
			$nometemporariogabarito = $_FILES['arqgabarito']['tmp_name'];

			// Verificando o tipogabarito de arquivo escolhido
			$tipogabaritospermitidos = ["application/pdf"];
			if (!in_array ($tipogabarito, $tipogabaritospermitidos)){

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro: Não foi possivel cadastrar a Prova. Tipo de arquivo não permitido no Gabarito.');location.href='adicionar_prova.php';</script>";
				echo $script;
				exit;
			}

			// Definindo um acaminho e nome para a imagem
			$caminho = "provas_enem/";
			
			// Salvando a imagem na pasta de img_res
			if (move_uploaded_file($nometemporariogabarito, $caminho.$nomegabarito)){
				
			}
			else{

				// Emitindo mensagem de erro
				$script = "<script>alert('Erro ao salvar o Gabarito.');location.href='adicionar_prova.php';</script>";
				echo $script;
				exit;
			}
    }else{
      // Emitindo mensagem de erro
      $script = "<script>alert('Erro ao salvar o Gabarito, arquivo não detectado.');location.href='adicionar_prova.php';</script>";
      echo $script;
      exit;
  }

    // Adicionando o tema no banco de dados

    $adicionar = mysqli_query($conexao, "INSERT into tabela_provasenem(prova, gabarito, ano, dia, nomeprova) values('$nomeprova', '$nomegabarito', $ano, '$dia', '$nomeprovafixo');");

    // Emitindo mensagem de erro
    $script = "<script>alert('Prova cadastrada com Sucesso');location.href='adicionar_prova.php';</script>";
    echo $script;
    exit;

  }

?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE html>

<html>

<meta charset="UTF-8">



<!-- Colocando ícone na página -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<title>Cadastrar Prova</title>



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
          if ($niveladm =="admgeral" || $niveladm == "adm"){echo "
          <li class='menu-has-children'><a>Provas</a>
          <ul>
            <li><a href='mostrar_provas.php'>Vizualizar</a></li>
            <li><a href='provas_cadastradas.php'>Cadastradas</a></li>
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


          if ($niveladm =="admgeral" || $niveladm == "adm" || $niveladm == "corretor"){echo"
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
          </li>";

          if ($niveladm =="corretor"){echo"
          <li><a href='pagina_adm.php?mos_tabques=Todas'>Questões</a></li>";
          }
          }

          if ($niveladm !="admgeral" && $niveladm != "adm"){echo "
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

<br><br><br><br><br><br><br>



<!-- Inserindo inputs com suas caracteristicas -->

<body>
<center>
    <div class="box" align="left">

        <form action="" method="POST" name="f1" enctype="multipart/form-data">



            <!-- Borda em volta do form -->

            <fieldset>



                <!-- legenda do Formulario -->

                <legend><b>Cadastrar Prova</b></legend>

                <br>
                <b>Nome da Prova:</b><br>
                <input type="text" required autofocus name="nomeprova" style="background-color: black; border: 2px solid white;; color: white; font-size: clamp(1em, 1em + 0.2vw, 1.5em); width: 99%;">
                <br><br>

                <div style="width:99%; display: flex;">
                <div style="width:49%;">
                <b>Arquivo da Prova:</b>
                <br>
                <input type="file" accept=".pdf" name="arqprova" style="font-size:15px">
                </div>

                <div style="width:49%;">
                <b>Arquivo do Gabarito:</b>
                <br>
                <input type="file" accept=".pdf" name="arqgabarito" style="font-size:15px">
                <br><br>
                </div>
                </div>

                <b>Ano da Aplicação:</b>
				        <select name="anoprova" style="border: 2px solid white; color:white; background-color: black;" >
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
                &nbsp;&nbsp;&nbsp;
                <b>Dia:</b>
				        <select name="dia" style="border: 2px solid white; color:white; background-color: black;" >
                <option value='1° Dia'>1° Dia</option>
                <option value='2° Dia'>2° Dia</option>
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

</body>
</html>