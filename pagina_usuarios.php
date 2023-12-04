<!-- Iniciando PHP -->
<?php

// Inicinado sessão
session_start();

// verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"]))
{

  // redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}
else
{

  // Verificando se o usuario é recente ou antigo 
  // Antigo
  if(isset($_SESSION["senha_usuario"])){

    // Obtendo o nome do usuario
    $nome_usuario = $_SESSION["nome_usuario"];
  }

  // Novo
  elseif(isset($_SESSION["nome_cad"])){

    // Obtendo o nome do usuario
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

// obtendo o numero de questões respondidas
$select_torespostas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario;");
$total_respsotas = mysqli_num_rows($select_torespostas);

// Selecionando e calculando a precisao
$precisao_positiva = $dados_usuario['precisao'];
$precisao_negativa = 100 - $precisao_positiva;

if ($total_respsotas == 0){
  $precisao_positiva = 0;
  $precisao_negativa = 0;
}

// Ajustando valor de total resposta para ser diferente de zero
// Evitando erros na divisão
if ($total_respsotas == 0){
  $total_respsotas = 1;
}

// Ingles
// Obtendo o numero de respostas resposndidas de ingles
$select_numresingles = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 1;");
$num_resingles = mysqli_num_rows($select_numresingles);
// Calculando a porcentagem
$por_resingles = $num_resingles * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de ingles
$select_numresinglescorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resinglescorretas = mysqli_num_rows($select_numresinglescorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de ingles
$num_resingleserradas = $num_resingles - $num_resinglescorretas;


// espanhol
// Obtendo o numero de respostas resposndidas de espanhol
$select_numresespanhol = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 2;");
$num_resespanhol = mysqli_num_rows($select_numresespanhol);
// Calculando a porcentagem
$por_resespanhol = $num_resespanhol * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de espanhol
$select_numresespanholcorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resespanholcorretas = mysqli_num_rows($select_numresespanholcorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de espanhol
$num_resespanholerradas = $num_resespanhol - $num_resespanholcorretas;


// geografia
// Obtendo o numero de respostas resposndidas de geografia
$select_numresgeografia = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 3;");
$num_resgeografia = mysqli_num_rows($select_numresgeografia);
// Calculando a porcentagem
$por_resgeografia = $num_resgeografia * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de geografia
$select_numresgeografiacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resgeografiacorretas = mysqli_num_rows($select_numresgeografiacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de geografia
$num_resgeografiaerradas = $num_resgeografia - $num_resgeografiacorretas;


// portugues
// Obtendo o numero de respostas resposndidas de portugues
$select_numresportugues = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 4;");
$num_resportugues = mysqli_num_rows($select_numresportugues);
// Calculando a porcentagem
$por_resportugues = $num_resportugues * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de portugues
$select_numresportuguescorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resportuguescorretas = mysqli_num_rows($select_numresportuguescorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de portugues
$num_resportugueserradas = $num_resportugues - $num_resportuguescorretas;


// literatura
// Obtendo o numero de respostas resposndidas de literatura
$select_numresliteratura = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 5;");
$num_resliteratura = mysqli_num_rows($select_numresliteratura);
// Calculando a porcentagem
$por_resliteratura = $num_resliteratura * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de literatura
$select_numresliteraturacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resliteraturacorretas = mysqli_num_rows($select_numresliteraturacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de literatura
$num_resliteraturaerradas = $num_resliteratura - $num_resliteraturacorretas;


// edfisica
// Obtendo o numero de respostas resposndidas de edfisica
$select_numresedfisica = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 6;");
$num_resedfisica = mysqli_num_rows($select_numresedfisica);
// Calculando a porcentagem
$por_resedfisica = $num_resedfisica * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de edfisica
$select_numresedfisicacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resedfisicacorretas = mysqli_num_rows($select_numresedfisicacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de edfisica
$num_resedfisicaerradas = $num_resedfisica - $num_resedfisicacorretas;


// artes
// Obtendo o numero de respostas resposndidas de artes
$select_numresartes = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7;");
$num_resartes = mysqli_num_rows($select_numresartes);
// Calculando a porcentagem
$por_resartes = $num_resartes * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de artes
$select_numresartescorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resartescorretas = mysqli_num_rows($select_numresartescorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de artes
$num_resarteserradas = $num_resartes - $num_resartescorretas;


// historia
// Obtendo o numero de respostas resposndidas de historia
$select_numreshistoria = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 8;");
$num_reshistoria = mysqli_num_rows($select_numreshistoria);
// Calculando a porcentagem
$por_reshistoria = $num_reshistoria * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de historia
$select_numreshistoriacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_reshistoriacorretas = mysqli_num_rows($select_numreshistoriacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de historia
$num_reshistoriaerradas = $num_reshistoria - $num_reshistoriacorretas;


// filosofia
// Obtendo o numero de respostas resposndidas de filosofia
$select_numresfilosofia = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 9;");
$num_resfilosofia = mysqli_num_rows($select_numresfilosofia);
// Calculando a porcentagem
$por_resfilosofia = $num_resfilosofia * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de filosofia
$select_numresfilosofiacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resfilosofiacorretas = mysqli_num_rows($select_numresfilosofiacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de filosofia
$num_resfilosofiaerradas = $num_resfilosofia - $num_resfilosofiacorretas;



// sociologia
// Obtendo o numero de respostas resposndidas de sociologia
$select_numressociologia = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 10;");
$num_ressociologia = mysqli_num_rows($select_numressociologia);
// Calculando a porcentagem
$por_ressociologia = $num_ressociologia * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de sociologia
$select_numressociologiacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_ressociologiacorretas = mysqli_num_rows($select_numressociologiacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de sociologia
$num_ressociologiaerradas = $num_ressociologia - $num_ressociologiacorretas;


// quimica
// Obtendo o numero de respostas resposndidas de quimica
$select_numresquimica = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 11;");
$num_resquimica = mysqli_num_rows($select_numresquimica);
// Calculando a porcentagem
$por_resquimica = $num_resquimica * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de quimica
$select_numresquimicacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resquimicacorretas = mysqli_num_rows($select_numresquimicacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de quimica
$num_resquimicaerradas = $num_resquimica - $num_resquimicacorretas;


// fisica
// Obtendo o numero de respostas resposndidas de fisica
$select_numresfisica = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 12;");
$num_resfisica = mysqli_num_rows($select_numresfisica);
// Calculando a porcentagem
$por_resfisica = $num_resfisica * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de fisica
$select_numresfisicacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 12 and errada_certa = 1;");
$num_resfisicacorretas = mysqli_num_rows($select_numresfisicacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de fisica
$num_resfisicaerradas = $num_resfisica - $num_resfisicacorretas;


// biologia
// Obtendo o numero de respostas resposndidas de biologia
$select_numresbiologia = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 13;");
$num_resbiologia = mysqli_num_rows($select_numresbiologia);
// Calculando a porcentagem
$por_resbiologia = $num_resbiologia * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de biologia
$select_numresbiologiacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 7 and errada_certa = 1;");
$num_resbiologiacorretas = mysqli_num_rows($select_numresbiologiacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de biologia
$num_resbiologiaerradas = $num_resbiologia - $num_resbiologiacorretas;


// matematica
// Obtendo o numero de respostas resposndidas de matematica
$select_numresmatematica = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 14;");
$num_resmatematica = mysqli_num_rows($select_numresmatematica);
// Calculando a porcentagem
$por_resmatematica = $num_resmatematica * 100 / $total_respsotas;
// Obtendo o numero de respostas CORRETAS resposndidas de matematica
$select_numresmatematicacorretas = mysqli_query($conexao, "SELECT * FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario and codigo_disciplina = 14 and errada_certa = 1;");
$num_resmatematicacorretas = mysqli_num_rows($select_numresmatematicacorretas);
// Obtendo o numero de respostas INCORRETAS resposndidas de matematica
$num_resmatematicaerradas = $num_resmatematica - $num_resmatematicacorretas;

// Ajustando valor de total resposta para voltar a ser zero
// Evitando erros na divisão
if ($total_respsotas == 1){
  $total_respsotas = 0;
}

?>

<!-- Inicaisndo o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo caracteristicas basicas para a pagina -->
<meta charset="UTF-8">  
<title>Home Usuário</title>

<!-- Definindo um icone para a pagina -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Definindo caracteristicas para o corpo da página -->
<body style="background-color: LightBlue;">

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

<!-- Iniciando CSS -->
<style>

.slider{
  width: 90%;
  height: 400px;
  align-items: center;
  background-color: White;
}

.slides{
  display: flex;
  align-items: center;
  background-color: White;
}

.slides input{
  display: none;
}


</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- script para mostrar um grafico de precisão -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $precisao_positiva; ?>],
          ['Erros',      <?php echo $precisao_negativa; ?>]
        ]);

        var options = {
          title: 'Precisão'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao'));

        chart.draw(data, options);
      }
    </script>

<!-- script para mostrar um grafico de quantidade de perguntas respondidas -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Artes: <?php echo $num_resartes; ?>',     <?php echo $num_resartes; ?>],
          ['Biologia: <?php echo $num_resbiologia; ?>',     <?php echo $num_resbiologia; ?>],
          ['Educação Física: <?php echo $num_resedfisica; ?>',     <?php echo $num_resedfisica; ?>],
          ['Filosofia: <?php echo $num_resfilosofia; ?>',     <?php echo $num_resfilosofia; ?>],
          ['Física: <?php echo $num_resfisica; ?>',     <?php echo $num_resfisica; ?>],
          ['Geografia: <?php echo $num_resgeografia; ?>',     <?php echo $num_resgeografia; ?>],
          ['História: <?php echo $num_reshistoria; ?>',     <?php echo $num_reshistoria; ?>],
          ['L. Estrangeira: Espanhol: <?php echo $num_resespanhol; ?>',     <?php echo $num_resespanhol; ?>],
          ['L. Estrangeira: Inglês: <?php echo $num_resingles; ?>',     <?php echo $num_resingles; ?>],
          ['L. Portuguesa: <?php echo $num_resportugues; ?>',     <?php echo $num_resportugues; ?>],
          ['Literatura: <?php echo $num_resliteratura; ?>',     <?php echo $num_resliteratura; ?>],
          ['Matemática: <?php echo $num_resmatematica; ?>',     <?php echo $num_resmatematica; ?>],
          ['Química: <?php echo $num_resquimica; ?>',     <?php echo $num_resquimica; ?>],
          ['Sociologia: <?php echo $num_ressociologia; ?>',      <?php echo $num_ressociologia; ?>]
        ]);

        var options = {
          title: 'Total de Perguntas respondidas: <?php echo $total_respsotas; ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('qtdisciplina'));

        chart.draw(data, options);
      }
    </script>

<!-- script para mostrar um grafico de precisão em artes -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resartescorretas; ?>],
          ['Erros',      <?php echo $num_resarteserradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Artes'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_artes'));

        chart.draw(data, options);
      }
    </script>

<!-- script para mostrar um grafico de precisão em biologia -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resbiologiacorretas; ?>],
          ['Erros',      <?php echo $num_resbiologiaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Biologia'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_biologia'));

        chart.draw(data, options);
      }
    </script>

    <!-- script para mostrar um grafico de precisão em edfisica -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resedfisicacorretas; ?>],
          ['Erros',      <?php echo $num_resedfisicaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Educação Física'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_edfisica'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em filosofia -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resfilosofiacorretas; ?>],
          ['Erros',      <?php echo $num_resfilosofiaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Filosofia'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_filosofia'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em fisica -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resfisicacorretas; ?>],
          ['Erros',      <?php echo $num_resfisicaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Física'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_fisica'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em geografia -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resgeografiacorretas; ?>],
          ['Erros',      <?php echo $num_resgeografiaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Geografia'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_geografia'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em historia -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_reshistoriacorretas; ?>],
          ['Erros',      <?php echo $num_reshistoriaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em História'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_historia'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em espanhol -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resespanholcorretas; ?>],
          ['Erros',      <?php echo $num_resespanholerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Lin. Est. Espanhol'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_espanhol'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em ingles -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resinglescorretas; ?>],
          ['Erros',      <?php echo $num_resingleserradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Lin. Est. Inglês'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_ingles'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em portugues -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resportuguescorretas; ?>],
          ['Erros',      <?php echo $num_resportugueserradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Lin. Portuguesa'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_portugues'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em literatura -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resliteraturacorretas; ?>],
          ['Erros',      <?php echo $num_resliteraturaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Literatura'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_literatura'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em edfisica -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resedfisicacorretas; ?>],
          ['Erros',      <?php echo $num_resedfisicaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Educação Física'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_edfisica'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em matematica -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resmatematicacorretas; ?>],
          ['Erros',      <?php echo $num_resmatematicaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Matemática'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_matematica'));

        chart.draw(data, options);
      }
    </script>

        <!-- script para mostrar um grafico de precisão em quimica -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_resquimicacorretas; ?>],
          ['Erros',      <?php echo $num_resquimicaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Química'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_quimica'));

        chart.draw(data, options);
      }
    </script>

            <!-- script para mostrar um grafico de precisão em sociologia -->
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Acertos',     <?php echo $num_ressociologiacorretas; ?>],
          ['Erros',      <?php echo $num_ressociologiaerradas; ?>]
        ]);

        var options = {
          title: 'Precisão em Sociologia'
        };

        var chart = new google.visualization.PieChart(document.getElementById('precisao_sociologia'));

        chart.draw(data, options);
      }
    </script>

<center>

<h2><b>Meu Desempenho</b></h2>
<br>

<div class="slider">
  <div class="slides">

    <!-- Grafico que mostra a precisão -->
    <div id="precisao" style="width: 450px; height: 400px;"></div>

    <!-- Grafico que mostra a quantidade de respostas de cada disciplina -->
    <div id="qtdisciplina" style="width: 500px; height: 400px;"></div>

  </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em artes -->
    <div id="precisao_artes" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em biologia -->
    <div id="precisao_biologia" style="width: 475px; height: 400px;"></div>
    </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em ed. física -->
    <div id="precisao_edfisica" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em filosofia -->
    <div id="precisao_filosofia" style="width: 475px; height: 400px;"></div>
    </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em física -->
    <div id="precisao_fisica" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em geografia -->
    <div id="precisao_geografia" style="width: 475px; height: 400px;"></div>
    </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em historia -->
    <div id="precisao_historia" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em espanhol -->
    <div id="precisao_espanhol" style="width: 475px; height: 400px;"></div>
    </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em ingles -->
    <div id="precisao_ingles" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em portugues -->
    <div id="precisao_portugues" style="width: 475px; height: 400px;"></div>
    </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em literatura -->
    <div id="precisao_literatura" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em matematica -->
    <div id="precisao_matematica" style="width: 475px; height: 400px;"></div>
    </div>
</div>

<div class="slider">
  <div class="slides">
    <!-- Grafico que mostra a precisao em Química -->
    <div id="precisao_quimica" style="width: 475px; height: 400px;"></div>

    <!-- Grafico que mostra a precisao em sociologia-->
    <div id="precisao_sociologia" style="width: 475px; height: 400px;"></div>

    </div>
</div>
</center>

<!-- Fechando tags em aberto -->
</body>
</html>