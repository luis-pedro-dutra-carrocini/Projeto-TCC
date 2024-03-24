<!-- Iniciando PHP -->

<?php



// Iniciando sessão

session_start();



// verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){



  // Redirecionando para a pagina index, pois a sessão não foi iniciada

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



// Iniciando conexao com o bd

include_once("conexao.php");



// Selecionando dados do usuario

$select_usuario = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome_usuario';");



// Verificando se o usuário existe no bd

if($select_usuario->num_rows > 0){

  $dados_usuario = $select_usuario->fetch_array();

  }else{



    // Voltando para o index, pois o usuario não existe

    header('location: index.php');

    exit;

  }



// codigo do usuario

$codigo_usuario = $dados_usuario['codigo_usuario'];



// Obtendo o codigo da redação

$codigo_red = $_GET['codigo'];



// Verificando se o codigo chegou via GET

if (empty($codigo_red)){



  // Redirecionando para a pagina minhas redações, pois o codigo não chegou

	header('location: minhas_redacoesusu.php');

  exit;

}



// Dados a serem mostrados

$select_redacao = mysqli_query($conexao, "SELECT * FROM tabela_redacoes WHERE codigo = $codigo_red and (visualizacao = 1 or codigo_usuario = $codigo_usuario);");

$dados_redacao = $select_redacao->fetch_array();



// Obtendo um dado para ver se redação existe

$verifica_existe = $dados_redacao['tema'];



// Verificando se a redação realmente existe

if (empty($verifica_existe)){



  // Redirecionando para a pagina minhas redações, pois a redação não existe

	header('location: minhas_redacoesusu.php');

  exit;

}


// Obtendo o tema ser mostrado

$tema_antigo = $dados_redacao['tema'];



// Verificando o tipo da redação

// Tipo texto

if ($dados_redacao['tipo'] == 0){



// Obtendo o texto da redação

$texto_antigo = $dados_redacao['texto_naocorrigido'];



// Ajustando o nome do arquivo para nulo

$nome_arquivo = "";



// Ajustando as checkbox e divs

$chetexto = "checked";

$mostexto = "block";

$cheanexo = "";

$mosanexo = "none";



// Tipo anexo

}elseif ($dados_redacao['tipo'] == 1){



    // Atribuindo o valor do texto para nulo

    $texto_antigo = "";



    // Obtendo o nome do arquivo

    $nome_arquivo = $dados_redacao['texto_naocorrigido'];



    // Ajustando as checkbox e divs

    $chetexto = "";

    $mostexto = "none";

    $cheanexo = "checked";

    $mosanexo = "block";

}



// Verificando quem pode ver a redação

// Somente eu

if ($dados_redacao['visualizacao'] == 0){



    // Ajustando as checkbox

    $cheeu = "checked";

    $chetodos = "";



// Todos

}elseif ($dados_redacao['visualizacao'] == 1){



    // Ajustando as checkbox

    $cheeu = "";

    $chetodos = "checked";

}



// Verificando a situação

// Não corrigida

if ($dados_redacao['situacao'] == 0){



    // Ajustando o valor da situação para não corrigida

    $situacao = "Não Corrigida";



    // Ajustando para não mostrar os dados da correção

    $mosdadoscorrecao = "none";



    // Ajustando os valores da correção para nulos

    $data_correcao = "";

    $comentario = "";

    $red_corrigida = "";

    $corretor = "";

    $pontuacao = "";



// Corrigida

}elseif ($dados_redacao['situacao'] == 1){



    // Ajustando o valor da situação para corrigida

    $situacao = "Corrigida";



    // Ajustando para mostrar os dados da correção

    $mosdadoscorrecao = "block";



    // Obtendo os valores da correção

    $data_semcon = $dados_redacao['data_correcao'];

    $data_correcao = date('d/m/Y',  strtotime($data_semcon));

    $comentario = $dados_redacao['comentario'];

    $red_corrigida = $dados_redacao['texto_corrigido'];

    $pontuacao = $dados_redacao['pontuacao'];



// Selecionando dados do usuario

// Codigo do corretor

$codigo_corretor = $dados_redacao['codigo_adm'];



// Selecionando os dados do corretor

$select_corretor = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE codigo = $codigo_corretor;");

$dados_corretor = $select_corretor->fetch_array();



// Obtendo o nome do corretor

$corretor = $dados_corretor['nome'];

}



// Obtendo a data de envio da redação

$data_semcon = $dados_redacao['data_envio'];

$data_envio = date('d/m/Y',  strtotime($data_semcon));

?>



<!-- Inicaisndo o corpo da página -->

<!DOCTYPE HTML>

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">  



<!-- Definindo o titulo da pagina para o titulo da redação -->

<title>Redação <?php echo $codigo_red; ?></title>



<!-- Definindo um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- Definindo caracteristicas para o corpo da página -->

<body style="background-color: black;">



<!-- iniciando java -->

<script>



// Função para sair da conta -->

function sair() {

  var resultado = confirm("Deseja Realmente sair dessa Conta?")

    if (resultado == true) {

      location.href='sair.php';

    }

}



// Função para abrir a pagina alterar dados

function Alterar_Dados() {

      location.href='alterar_dadosusuario.php';

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

        #cancelar{

width: 32%;

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

#limpar{

width: 32%;

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

            <ul>

              <li><a href="gerar_simucomcad.php">Completos</a></li>

              <li><a href="gerar_simusimcad.php">Personalizados</a></li>

              <li><a href="simu_feitoporadms.php">Feitos por Professores</a></li>

              <li><a href="simu_feitoporusuarios.php">Feitos por Usuários</a></li>

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





<!-- Inserindo campos para a inserção de daos -->

<body >



<!-- Caixa em volta do form -->

<font color="black" size="4">

<center>
<div class="box" align="left">

<form action="" method="POST" enctype="multipart/form-data"> 

	

<!-- Borda do form -->

<!-- Legenda do form -->

<legend style="color:grey31; font-size: clamp(1em, 1em + 1vw, 1.5em); font-weight: bold;">Redação</legend>



<!-- Campo a data de envio da redação, com suas propriedades -->

<b>Data de envio:</b> <?php echo $data_envio; ?>

<br><br>


<!-- Campo tema da redação, com suas propriedades -->

<b>Tema:</b> <?php echo $tema_antigo; ?>

<br><br>

<!-- Campo tipo da redação, com suas propriedades -->

<b>Redação:</b>

<br><br>

<div id="divrestext" style="display: <?php echo $mostexto; ?>;">

<?php print "<p>".nl2br($texto_antigo)."</p>"; ?>

<br><br>

</div>

<div id="divresimg" style="display: <?php echo $mosanexo; ?>;">

<br>

Arquivo: <a href="redacoes/<?php echo $nome_arquivo;?>" download><?php echo $nome_arquivo;?></a>

</div>

<br>



<b>Situação:</b> <?php echo $situacao;?>

<br>

<div id="divdadoscorrecao" style="display: <?php echo $mosdadoscorrecao; ?>;">

<br>

<b>Corretor:</b> <?php echo $corretor;?>

<br>

<b>Pontuação:</b> <?php echo $pontuacao;?>

<br>

<b>Data da correção:</b> <?php echo $data_correcao;?>

<br><br>



<b>Redação Corrigida:</b>

<br>

<?php 

if ($dados_redacao['tipo_correcao'] == 0){

print "<p>".nl2br($red_corrigida)."</p>"; 

}elseif ($dados_redacao['tipo_correcao'] == 1){

$nomearquivo_corr = $dados_redacao['texto_corrigido'];

echo "Arquivo: <a href='redacoes/$nomearquivo_corr' download>$nomearquivo_corr</a>";

}

?>

<br><br>



<b>Comentário:</b>

<?php print nl2br($comentario); ?>

</div>



<script>

// Verificando se o checkbox tipo texto esta selecionado

var chetex = document.querySelector("#restex");

chetex.addEventListener("click", function() {

divrestext.style.display = "block"; 

divresimg.style.display = "none"; 

});



// Verificando se o checkbox tipo imagem esta selecionado

var cheimg = document.querySelector("#resimg");

cheimg.addEventListener("click", function() {

divrestext.style.display = "none"; 

divresimg.style.display = "block"; 

});



</script>





<!-- Iniciando java para verificar checkbox -->

<script>

// Verificando se o checkbox sim esta selecionado

var spimg = document.querySelector("#spimg");

spimg.addEventListener("click", function() { 

divimgques.style.display = "block"; 

});



// Verificando se o checkbox não esta selecionado

var npimg = document.querySelector("#npimg");

npimg.addEventListener("click", function() { 

divimgques.style.display = "none"; 

});



</script>

<!-- Fechando tags abertas -->
</div>
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

</font>
</body>
</html>