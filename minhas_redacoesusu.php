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

    // Obtendo o nome
    $nome_usuario = $_SESSION["nome_usuario"];
  }

  // Recente
  elseif(isset($_SESSION["nome_cad"])){

    // Obtendo o nome
    $nome_usuario = $_SESSION["nome_cad"];
  }
}

// iniciando conexao com o bd
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

?>

<!-- Inicaisndo o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo caracteristicas basicas para a pagina -->
<meta charset="UTF-8">  
<title>Minhas Readações</title>

<!-- Definindo um icone para a pagina -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- Definindo caracteristicas para o corpo da página -->
<body style="background-color: LightBlue;">

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

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
    position: absolute;
    top: 75%;
    left: 50%;
    transform: translate(-50%,-50%);
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
        <h1><a href="sobreusu.php" class="scrollto">DSENEM</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="sobreusu.php"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
        <li class="menu-active"><a href="pagina_usuarios.php">Home</a></li>
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
          
          
          <li class="menu-active"><a onclick="sair()">Sair</a></li>
          <li class="menu-active"><i class="bi bi-person-circle" title='Dados da Conta' height ='30px' width='30px' onclick="Alterar_Dados()"></i></li>
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
                <h3 class="panel-title">Minhas Redações</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtro</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Tema" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Título" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Data Envio" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Data Correção" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Visualização" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Situação" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Pontuação" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Corrigido por" disabled></th>
                        <th>Alterar/Excluir</th>
                    </tr>
                </thead>
                <tbody>


<!-- Iniciando php para inserir os dados na tabela --> 
<!-- Criando um loop -->
<!-- Iniciando php para nostar todas a s provas geradas -->
<?php

// Obtendo as redações do usuario
$consulta = mysqli_query($conexao,"SELECT * from tabela_redacoes where codigo_usuario = $codigo_usuario;");

// Criando loop
while ($dado=$consulta->fetch_array()) { 
echo "<tr>";

// Obtendo o tema
echo "<td>".$dado['tema']."</td>";

// Obtendo o titulo
echo "<td><a href='redacao_usu.php?codigo=$dado[codigo]'>$dado[titulo]</a></td>";

// Obtendo a data de envio
$data_semcon = $dado['data_envio'];
$data_envio = date('d/m/Y',  strtotime($data_semcon));
echo "<td>".$data_envio."</td>";

// Verificando a situação da situação
// Se ja esta corrigida
if ($dado['situacao'] == 1){

// Obtendo a data da correção
$data_semcon = $dado['data_correcao'];
$data_correcao = date('d/m/Y',  strtotime($data_semcon));
echo "<td>".$data_correcao."</td>";

// Ajustando a situação
$situacao = "Corrigida";

// Obtendo a pontuação
$pontuacao = $dado['pontuacao'];

// Obtendo o codigo do professor corretor
$codigo_adm = $dado['codigo_adm'];

// Obtendo os dados do professor
$sqladm = mysqli_query($conexao,"SELECT * from tabela_adm where codigo = $codigo_adm;");
$dadoadm=$sqladm->fetch_array();

// Obtendo o nome do professor
$professor = $dadoadm['nome'];

// Se não esta corrigida
}elseif ($dado['situacao'] == 0){

    // Definindo os dados de correção
    // como não corrigida
    echo "<td>Não Corrigida</td>";
    $situacao = "Não Corrigida";
    $pontuacao = "Não Corrigida";
    $professor = "Não Corrigida";
}

// Verificando quem pode ver a redação
if ($dado['visualizacao'] == 0){

    // Somente o usuario escritor
    $visualizacao = "Somente eu";
}elseif ($dado['visualizacao'] == 1){

    // Todos os usuario
    $visualizacao = "Todos";
}

// Exibindo os dados na tabela
echo "<td>".$visualizacao."</td>";
echo "<td>".$situacao."</td>";
echo "<td>".$pontuacao."</td>";
echo "<td>".$professor."</td>";

// Inserindo os botões de excluir ou alterar
echo "<td align='center'>";

// Verificando se o botão alterar pode existir
if ($dado['situacao'] == 0){
echo "<a href='alterar_redacaousu.php?codigo=$dado[codigo]' title='Alterar'><img src='img/alterar.png' height ='20px' width='20px' align='center'></a>
&nbsp;&nbsp;";
}

// Botão deletar
echo "<a href='confex_redusu.php?codigo=$dado[codigo]' title='Excluir'><img src='img/deletar.png' height ='20px' width='20px' align='center'></a></td>";
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
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">Nenhuma Redação Encontrada</td></tr>'));
        }
    });
});	</script>
<!-- Fechando a tabela -->

<!-- Fechando tags em aberto -->
</body>
</html>