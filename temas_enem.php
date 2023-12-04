<!-- Iniciando PHP -->

<?php



// Iniciando sessão

session_start();



// Verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_adm"]))

{



  // Redirecionando para a página index, pois a sesão não foi iniciada

  header('location: index.php');

  exit;

}else{



  // Obtendo nome do adm pela sessão

  $nome = $_SESSION["nome_adm"];



  // Conecatando com o banco de dados

  include_once('conexao.php');



  // Obtendo os dados do adm a serem utilizados

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



  // Obtendo o código do adm

  $codigo_adm = $dado['codigo'];



  // Obtendp os dados da tabela temas

  $consulta = mysqli_query($conexao,"SELECT * from tabela_temasredacoes where tipo = 0 order by ano;");



  // Verificando o nivel do adm

  if ($niveladm == "admgeral" || $niveladm == "adm" || $niveladm == "corretor"){

  }

  else{



    // Redirecionando para pagina adm, pois o nivel do adm não condiz com a pagina atual

    header('location: pagina_adm.php');

    exit;

  }

}



?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE HTML>

<html>



<!-- Definindo caracteristicas basicas para a página como acentuação e titulo -->

<meta charset="UTF-8">

<title>Temas de redações que Cairam no ENEM</title>



<!-- Definindo um icone para a pagina -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- Definindo caracteristicas para o corpo da pagina -->

<body style="background-color: LightBlue;">





<!-- Iniciando o java -->

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

<br><br><br><br>





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



<!-- Iniciando cabeçalho -->

<header id="header">

    <div class="container">



      <div id="logo" class="pull-left">

        <h1><a href="sobreadm.php" class="scrollto">DSENEM</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-active"><a href="pagina_adm.php" >Home</a></li>



        <!-- Iniciando PHP -->

        <?php



          // Verificando qaul é o nivel do adm, para ver quais funções deve mostrar

          // Se for adm ou adm geral

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



          // Se for adm ou adm geral ou corretor

          if ($niveladm =="admgeral" || $niveladm == "adm" || $niveladm == "corretor"){echo"

            <li class='menu-has-children'><a >Redações</a>

            <ul>

              <li><a href='readacoes_corrigir.php'>Para Corrigir</a></li>

              <li><a href='readacoes_corrigidas.php'>Corrigidas</a></li>

              <li class='menu-has-children'><a >Temas</a>

              <ul>

                <li><a href='temas_usuarios.php'>Usuários</a></li>

                <li><a href='temas_professores.php'>Professores</a></li>

                <li><a href='adicionar_tema.php'>ADD Tema</a></li>

              </ul>

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



<br><br><br><br>





<!-- Definindo cacateristicas da tabela atraves do bootstrap -->

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style type="text/css">



.filterable {

    margin-top: 15px;

    margin: 0 auto;

}

.filterable .panel-heading .pull-right {

    margin-top: -20px;

}

.filterable .filters input[disabled] {

    background-color: transparent;

    border: none;

    cursor: auto;

    box-shadow: none;

    padding: 0;

    height: auto;

}

.filterable .filters input[disabled]::-webkit-input-placeholder {

    color: #333;

}

.filterable .filters input[disabled]::-moz-placeholder {

    color: #333;

}

.filterable .filters input[disabled]:-ms-input-placeholder {

    color: #333;

}

</style>



<!-- Iniciando JS -->

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

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



    <div class="container">

    <div class="row">

        <div class="panel panel-primary filterable">

            <div class="panel-heading">

                <h3 class="panel-title">Temas que Cairam no ENEM</h3>

                <div class="pull-right">

                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtro</button>

                </div>

            </div>

            <table class="table">

                <thead>

                    <tr class="filters">

                        <th><input type="text" class="form-control" placeholder="#" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Tema" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Ano" disabled></th>

                        <th><label>Alterar/Excluir</label></th>

                        

                    </tr>

                </thead>

                <tbody>





<!-- Iniciando php para inserir os dados na tabela --> 

<!-- Criando um loop -->

<?php while ($dado=$consulta->fetch_array()) { 



// Inserindo dados na tabela 

echo "<tr>";

echo "<td>".$dado['codigo']."</td>";

echo "<td>".$dado['tema']."</td>";

echo "<td>".$dado['ano']."</td>";



// Inserindo os botões aletar e excluir 

echo "<td>

<div>

&nbsp;&nbsp;

<a href='alterar_tema.php?codigo=$dado[codigo]' title='Alterar'><img src='img/alterar.png' height ='30px' width='30px' align='center'></a>

&nbsp;&nbsp;

<a href='confex_tema.php?codigo=$dado[codigo]&tipo=$dado[tipo]' title='Excluir'><img src='img/deletar.png' height ='30px' width='30px' align='center'></a>

&nbsp;&nbsp;

</div>

</td>";

echo "</tr>";

}

?>

                </tbody>

            </table>

        </div>

    </div>

</div>



<!--- Verificando pesquisa nos campos -->

<script type="text/javascript">

$(document).ready(function(){

    $('.filterable .btn-filter').click(function(){

        var $panel = $(this).parents('.filterable'),

        $filters = $panel.find('.filters input'),

        $tbody = $panel.find('.table tbody');

        if ($filters.prop('disabled') == true) {

            $filters.prop('disabled', false);

            $filters.first().focus();

        } else {

            $filters.val('').prop('disabled', true);

            $tbody.find('.no-result').remove();

            $tbody.find('tr').show();

        }

    });



    $('.filterable .filters input').keyup(function(e){

        /* Ignore tab key */

        var code = e.keyCode || e.which;

        if (code == '9') return;

        /* Useful DOM data and selectors */

        var $input = $(this),

        inputContent = $input.val().toLowerCase(),

        $panel = $input.parents('.filterable'),

        column = $panel.find('.filters th').index($input.parents('th')),

        $table = $panel.find('.table'),

        $rows = $table.find('tbody tr');

        /* Dirtiest filter function ever ;) */

        var $filteredRows = $rows.filter(function(){

            var value = $(this).find('td').eq(column).text().toLowerCase();

            return value.indexOf(inputContent) === -1;

        });

        /* Clean previous no-result if exist */

        $table.find('tbody .no-result').remove();

        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */

        $rows.show();

        $filteredRows.hide();

        /* Prepend no-result row if all rows are filtered */

        if ($filteredRows.length === $rows.length) {

            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">Nenhum tema Encontrado</td></tr>'));

        }

    });

});	</script>

<!-- Fechando a tabela -->



<!-- Fechando tags em aberto -->

</bodY>

</html>