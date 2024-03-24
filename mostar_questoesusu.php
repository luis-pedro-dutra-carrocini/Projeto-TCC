<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conectando com o banco de dados
include_once('conexao.php');

// Verificando se a sessão foi iniciada 
if(isset($_SESSION["senha_adm"])){

// Obtendo o nome do adm via sessão
$nome_adm = $_SESSION["nome_adm"];

// Obtendo os dados do adm
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
$usuario = "adm";

}elseif(isset($_SESSION["senha_usuario"])){

// Obtendo o nome do usuario
$nome_usuario = $_SESSION["nome_usuario"];

// Selecionando dados do usuario
$select_usuario = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome_usuario';");

// Verificando se o usuário existe no bd
if($select_usuario->num_rows > 0){
    $usuario = "aluno";
}else{
// Voltando para o index, pois o usuario não existe
header('location: index.php');
exit;
}

}elseif(isset($_SESSION["nome_cad"])){

// Obtendo o nome do usuario
$nome_usuario = $_SESSION["nome_cad"];

// Selecionando dados do usuario
$select_usuario = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome_usuario';");

// Verificando se o usuário existe no bd
if($select_usuario->num_rows > 0){
    $usuario = "aluno";
}else{
    // Voltando para o index, pois o usuario não existe
    header('location: index.php');
    exit;
}

}else{
    $usuario = "normal";
}

?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE HTML>
<html lang="pt-br">

<!-- definindo caracteristicas basicas como titulo e acentuação -->
<meta charset="UTF-8"> 
<title>Questões ENEM</title>

<!-- Definindo um icone para a pagina -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Definindo caracteristica para o corpo da pagina -->
<body style="background-color: black;"> 

<!-- Iniciando o java -->
<script>

// Função para sair da conta -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
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

            color: black;

            background-color: white;

            padding: 15px;

            border-radius: 15px;

            width: 95%;

            font-size: clamp(1em, 1em + 0.5vw, 1.5em);

        }

		/* Definindo caracteristicas dos botões */

        #adcionarquestao{

            width: 150px;

            height: 60px;

            border: none;

            padding: 15px;

            color: white;

            font-size: clamp(1em, 1em + 0.2vw, 1.5em);

            cursor: pointer;

            border-radius: 7px;

            background-color: RoyalBlue;

        }

        #adcionarquestao:hover{

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
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">

        <!-- Iniciando PHP -->
          <?php

        if ($usuario == "adm"){
          echo "<li class='menu-active'><a href='pagina_adm.php'>Home</a></li>";
          // Verificando o nivel do adm para ver quais intens do cabeçalho se deve mostrar
          if ($niveladm =="admgeral" || $niveladm == "adm"){echo "
          <li class='menu-has-children'><a>Provas</a>
          <ul>
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

          echo "
          <li class='menu-has-children'><a >Simulados</a>
            <ul>
              <li><a href='provas_geradasadm.php'>Meus</a></li>
              <li><a href='provasadm_adm.php'>Professores</a></li>
              <li><a href='provasusu_adm.php'>Usuários</a></li>
              <li><a href='gerar_provaadm.php'>Criar</a></li>
            </ul>
          </li>
          <li><a href='alterar_dadosadm.php'>Dados</a></li>
          <li class='menu-active'><a onclick='sair()'>Sair</a></li>";

          }elseif($usuario == "aluno"){echo"
            <li class='menu-active'><a href='pagina_usuarios.php'>Home</a></li>
            <li class='menu-has-children'><a >Simulados</a>
            <ul>
              <li><a href='gerar_simucomcad.php'>Completos</a></li>
              <li><a href='gerar_simusimcad.php'>Personalizados</a></li>
              <li><a href='minhas_provas_Usuario.php'>Meus Simulados</a></li>
              <li><a href='simu_feitoporadms.php'>Feitos por Professores</a></li>
              <li><a href='simu_feitoporusuarios.php'>Feitos por Usuários</a></li>
            </ul>
          </li>

          <li class='menu-has-children'><a >Redações</a>
            <ul>
              <li><a href='minhas_redacoesusu.php'>Minhas</a></li>
              <li><a href='nova_redacao.php'>Escrever</a></li>
              <li><a href='redacoes_todosusuarios.php'>Outros usuários</a></li>
            </ul>
          </li>

		      <li><a href='todasprovas_realizadasusu.php'>Evolução</a></li>
          <li><a href='ranking_usuarios.php'>Ranking</a></li>
          
          <li><a href='alterar_dadosusuario.php'>Dados</a></li>
          <li class='menu-active'><a onclick='sair()'>Sair</a></li>";
          }else{echo"
            <li><a href='mostrar_provas.php'>Provas e Gabaritos</a></li>
            <li class='menu-has-children'><a >Simulados</a>
            <ul>
              <li><a href='gerar_simucom.php'>Completos</a></li>
              <li><a href='gerar_simusim.php'>Personalizados</a></li>
            </ul>
          </li>

          <li><a href='index.php'>Voltar</a></li>
          <li><a href='pagina_inscrever-se.php'>Cadastrar-se</a></li>
          <li class='menu-active'><a href='login.php'>Entrar</a></li>";
          }

          ?>
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
<!-- Fechando cabeçalho -->

<center>

<!-- Mostrando sobre o desenrrola enem -->

<div class='box' Align="left">
    <form action="" method='POST'>
    <legend><b>Questões ENEM</b></legend>
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
                &nbsp;&nbsp;&nbsp;&nbsp;
                <b>Disciplina da Questão:</b>
				<select name="disciplinaquestao">
                <option value='todas'>Todas</option>
                    <?php
                    $sqldis = mysqli_query($conexao, "SELECT * FROM tabela_disciplina order by disciplina;");
					while ($dadocbodis=$sqldis->fetch_array()){
						echo "<option value='".$dadocbodis['codigo_disciplina']."'>".$dadocbodis['disciplina']."</option>";
					}

					?>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="pesquisa" id="adcionarquestao" value="Atualizar"> 
                </form>

<?php 

if (isset($_POST['pesquisa'])){

    $anoquestoes = addslashes($_POST['anoquestao']);
    $disciplinaquestao = addslashes($_POST['disciplinaquestao']);

    if ($disciplinaquestao == "todas" && $anoquestoes == "todos"){
        $sqlquestoes = mysqli_query($conexao, "SELECT * FROM tabela_pergunta order by ano desc;");
    }else{
        if ($anoquestoes == "todos"){
            $sqlquestoes = mysqli_query($conexao, "SELECT * FROM tabela_pergunta where (codigo_disciplina=$disciplinaquestao) order by ano desc;");
        }elseif ($disciplinaquestao == "todas"){
            $sqlquestoes = mysqli_query($conexao, "SELECT * FROM tabela_pergunta where (ano=$anoquestoes) order by ano desc;");
        }else{
            $sqlquestoes = mysqli_query($conexao, "SELECT * FROM tabela_pergunta where (ano=$anoquestoes and codigo_disciplina=$disciplinaquestao);");
        }
    }
					while ($dadoquestao=$sqlquestoes->fetch_array()){
						echo "<b>Ano: </b>".$dadoquestao['ano']."&nbsp;&nbsp;&nbsp;&nbsp;";

                        $codigo_pergunta = $dadoquestao['codigo_pergunta'];
                        $codigo_disciplina = $dadoquestao['codigo_disciplina'];
                        $sqldisques = mysqli_query($conexao, "SELECT * FROM tabela_disciplina where codigo_disciplina=$codigo_disciplina;");
                        $dadodis=$sqldisques->fetch_array();
                        echo "<b>Disciplina: </b>".$dadodis['disciplina']."<br><br>";

                        print nl2br($dadoquestao['pergunta'])."</p>";

                        if ($dadoquestao['imagem'] != "Não possui"){
                            echo "<img width='300' src='uploads/". $dadoquestao['imagem'] . "'><br><br>";
                        }

                        $sqlalta = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='a';");
                        $dadoalta=$sqlalta->fetch_array();

                        $sqlaltb = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='b';");
                        $dadoaltb=$sqlaltb->fetch_array();

                        $sqlaltc = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='c';");
                        $dadoaltc=$sqlaltc->fetch_array();

                        $sqlaltd = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='d';");
                        $dadoaltd=$sqlaltd->fetch_array();

                        $sqlalte = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='c';");
                        $dadoalte=$sqlalte->fetch_array();
                        
                        if ($dadoalta['tipo'] == 1){
                            echo "<b>a) </b><img width='300' src='img_res/". $dadoalta['alternativa'] . "'><br><br>";
                            echo "<b>b) </b><img width='300' src='img_res/". $dadoaltb['alternativa'] . "'><br><br>";
                            echo "<b>c) </b><img width='300' src='img_res/". $dadoaltc['alternativa'] . "'><br><br>";
                            echo "<b>d) </b><img width='300' src='img_res/". $dadoaltd['alternativa'] . "'><br><br>";
                            echo "<b>e) </b><img width='300' src='img_res/". $dadoalte['alternativa'] . "'><br><br>";
                        }else{
                        echo "<b>a) </b>".$dadoalta['alternativa']."<br>";
                        echo "<b>b) </b>".$dadoaltb['alternativa']."<br>";
                        echo "<b>c) </b>".$dadoaltc['alternativa']."<br>";
                        echo "<b>d) </b>".$dadoaltd['alternativa']."<br>";
                        echo "<b>e) </b>".$dadoalte['alternativa']."<br><br>";
                        }

                        if ($dadoalta["correta"]==1){

                            $alternativa_correta = "Letra A";
                          
                          }
                          
                          elseif ($dadoaltb["correta"]==1){
                          
                            $alternativa_correta = "Letra B";
                          
                          }
                          
                          elseif ($dadoaltc["correta"]==1){
                          
                            $alternativa_correta = "Letra C";
                          
                          }
                          
                          elseif ($dadoaltd["correta"]==1){
                          
                            $alternativa_correta = "Letra D";
                          
                          }
                          
                          elseif ($dadoalte["correta"]==1){
                          
                            $alternativa_correta = "Letra E";
                          
                          }

                          echo "<b>Alternativa Correta: </b>".$alternativa_correta."<br><br><br>";
					}

}else{

    $sqlquestoes = mysqli_query($conexao, "SELECT * FROM tabela_pergunta order by ano desc;");
					while ($dadoquestao=$sqlquestoes->fetch_array()){
						echo "<b>Ano: </b>".$dadoquestao['ano']."<br>";

                        $codigo_pergunta = $dadoquestao['codigo_pergunta'];
                        $codigo_disciplina = $dadoquestao['codigo_disciplina'];
                        $sqldisques = mysqli_query($conexao, "SELECT * FROM tabela_disciplina where codigo_disciplina=$codigo_disciplina;");
                        $dadodis=$sqldisques->fetch_array();
                        echo "<b>Disciplina: </b>".$dadodis['disciplina']."<br><br>";

                        print nl2br($dadoquestao['pergunta'])."</p>";

                        if ($dadoquestao['imagem'] != "Não possui"){
                            echo "<img width='300' src='uploads/". $dadoquestao['imagem'] . "'><br><br>";
                        }

                        $sqlalta = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='a';");
                        $dadoalta=$sqlalta->fetch_array();

                        $sqlaltb = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='b';");
                        $dadoaltb=$sqlaltb->fetch_array();

                        $sqlaltc = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='c';");
                        $dadoaltc=$sqlaltc->fetch_array();

                        $sqlaltd = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='d';");
                        $dadoaltd=$sqlaltd->fetch_array();

                        $sqlalte = mysqli_query($conexao,"SELECT * from tabela_resposta where codigo_pergunta = $codigo_pergunta and letra='e';");
                        $dadoalte=$sqlalte->fetch_array();
                        
                        if ($dadoalta['tipo'] == 1){
                            echo "<b>a) </b><img width='300' src='img_res/". $dadoalta['alternativa'] . "'><br><br>";
                            echo "<b>b) </b><img width='300' src='img_res/". $dadoaltb['alternativa'] . "'><br><br>";
                            echo "<b>c) </b><img width='300' src='img_res/". $dadoaltc['alternativa'] . "'><br><br>";
                            echo "<b>d) </b><img width='300' src='img_res/". $dadoaltd['alternativa'] . "'><br><br>";
                            echo "<b>e) </b><img width='300' src='img_res/". $dadoalte['alternativa'] . "'><br><br>";
                        }else{
                        echo "<b>a) </b>".$dadoalta['alternativa']."<br>";
                        echo "<b>b) </b>".$dadoaltb['alternativa']."<br>";
                        echo "<b>c) </b>".$dadoaltc['alternativa']."<br>";
                        echo "<b>d) </b>".$dadoaltd['alternativa']."<br>";
                        echo "<b>e) </b>".$dadoalte['alternativa']."<br><br>";
                        }
                        

                        if ($dadoalta["correta"]==1){

                            $alternativa_correta = "Letra A";
                          
                          }
                          
                          elseif ($dadoaltb["correta"]==1){
                          
                            $alternativa_correta = "Letra B";
                          
                          }
                          
                          elseif ($dadoaltc["correta"]==1){
                          
                            $alternativa_correta = "Letra C";
                          
                          }
                          
                          elseif ($dadoaltd["correta"]==1){
                          
                            $alternativa_correta = "Letra D";
                          
                          }
                          
                          elseif ($dadoalte["correta"]==1){
                          
                            $alternativa_correta = "Letra E";
                          
                          }

                          echo "<b>Alternativa Correta: </b>".$alternativa_correta."<br><br>";
					}
}

?>

</div>
<br><br>

<!-- Fechando tags em aberto -->
</bodY>
</html>