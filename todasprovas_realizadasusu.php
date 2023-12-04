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



// Selecionando as ultimos 8 simulados completos realizadas pelo usuario

$select_provascom = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE (codigo_usuario = $codigo_usuario and numero_questoes = 90) order by codigo DESC;");

$qt_provascom = mysqli_num_rows($select_provascom);



if($qt_provascom < 2){



  // Dedinindo os graficos como invisiveis

  $mos_graficoscom = "none";



}else{



// Dedinindo os graficos como visiveis

$mos_graficoscom = "block";



// Definindo o valor da variavel contador para 1

$contador_provaCompleta = 8;



// Criando o loop para obter somente os dados das ultimas 8 provas

// De simulados Completos

while ($dado_provaCompleta=$select_provascom->fetch_array()) { 



  // Obtendo o codigo da prova

  $codigo_provaCompleta = $dado_provaCompleta['codigo'];



  // Verificando qual é o numero do contador para ver quantas provas selecionar

  // Prova 8

  if ($contador_provaCompleta == 8){



    // Obtendo o codigo da 8 prova

    $select_provaCompleta8 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta8=$select_provaCompleta8->fetch_array();



    // Obtendo a pontuação

    $pontuacao_provaCompleta8 = $dado_provaCompleta8['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta8 = $dado_provaCompleta8['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta8 = $dado_provaCompleta8['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta8SM = $dado_provaCompleta8['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta8 = date('d/m/y - H:i',  strtotime($data_provaCompleta8SM));



  // Prova 7

  } elseif ($contador_provaCompleta == 7){



    // Obtendo o codigo da 7 prova

    $select_provaCompleta7 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta7=$select_provaCompleta7->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta7 = $dado_provaCompleta7['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta7 = $dado_provaCompleta7['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta7 = $dado_provaCompleta7['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta7SM = $dado_provaCompleta7['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta7 = date('d/m/y - H:i',  strtotime($data_provaCompleta7SM));



  // Prova 6

  } elseif ($contador_provaCompleta == 6){



    // Obtendo o codigo da 6 prova

    $select_provaCompleta6 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta6=$select_provaCompleta6->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta6 = $dado_provaCompleta6['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta6 = $dado_provaCompleta6['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta6 = $dado_provaCompleta6['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta6SM = $dado_provaCompleta6['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta6 = date('d/m/y - H:i',  strtotime($data_provaCompleta6SM));



  // Prova 5

  } elseif ($contador_provaCompleta == 5){



    // Obtendo o codigo da 5 prova

    $select_provaCompleta5 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta5=$select_provaCompleta5->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta5 = $dado_provaCompleta5['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta5 = $dado_provaCompleta5['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta5 = $dado_provaCompleta5['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta5SM = $dado_provaCompleta5['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta5 = date('d/m/y - H:i',  strtotime($data_provaCompleta5SM));



  // Prova 4

  } elseif ($contador_provaCompleta == 4){



    // Obtendo o codigo da 4 prova

    $select_provaCompleta4 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta4=$select_provaCompleta4->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta4 = $dado_provaCompleta4['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta4 = $dado_provaCompleta4['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta4 = $dado_provaCompleta4['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta4SM = $dado_provaCompleta4['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta4 = date('d/m/y - H:i',  strtotime($data_provaCompleta4SM));



  // Prova 3

  } elseif ($contador_provaCompleta == 3){



    // Obtendo o codigo da 3 prova

    $select_provaCompleta3 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta3=$select_provaCompleta3->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta3 = $dado_provaCompleta3['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta3 = $dado_provaCompleta3['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta3 = $dado_provaCompleta3['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta3SM = $dado_provaCompleta3['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta3 = date('d/m/y - H:i',  strtotime($data_provaCompleta3SM));



  // Prova 2

  } elseif ($contador_provaCompleta == 2){



    // Obtendo o codigo da 2 prova

    $select_provaCompleta2 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta2=$select_provaCompleta2->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta2 = $dado_provaCompleta2['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta2 = $dado_provaCompleta2['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta2 = $dado_provaCompleta2['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta2SM = $dado_provaCompleta2['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta2 = date('d/m/y - H:i',  strtotime($data_provaCompleta2SM));



  // Prova 1

  } elseif ($contador_provaCompleta == 1){



    // Obtendo o codigo da 1 prova

    $select_provaCompleta1 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaCompleta;");

    $dado_provaCompleta1=$select_provaCompleta1->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaCompleta1 = $dado_provaCompleta1['pontuacao'];



    // Obtendo a precisao

    $precisao_provaCompleta1 = $dado_provaCompleta1['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaCompleta1 = $dado_provaCompleta1['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaCompleta1SM = $dado_provaCompleta1['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaCompleta1 = date('d/m/y - H:i',  strtotime($data_provaCompleta1SM));

  }



  // Aumentando o valor do contador

  $contador_provaCompleta = $contador_provaCompleta - 1;



}

}



// Selecionando as ultimos 8 simulados personlizados realizadas pelo usuario

$select_provasper = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE (codigo_usuario = $codigo_usuario and numero_questoes != 90) order by codigo DESC;");

$qt_provasper = mysqli_num_rows($select_provasper);



if($qt_provasper < 2){



  // Dedinindo os graficos como invisiveis

  $mos_graficosper = "none";



}else{



  // Dedinindo os graficos como visiveis

$mos_graficosper = "block";



// Definindo o valor da variavel contador para 1

$contador_provaPersonalizada = 8;



// Criando o loop para obter somente os dados das ultimas 8 provas

// De simulados Completos

while ($dado_provaPersonalizada=$select_provasper->fetch_array()) { 



  // Obtendo o codigo da prova

  $codigo_provaPersonalizada = $dado_provaPersonalizada['codigo'];



  // Verificando qual é o numero do contador para ver quantas provas selecionar

  // Prova 8

  if ($contador_provaPersonalizada == 8){



    // Obtendo o codigo da 8 prova

    $select_provaPersonalizada8 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada8=$select_provaPersonalizada8->fetch_array();



    // Obtendo a pontuação

    $pontuacao_provaPersonalizada8 = $dado_provaPersonalizada8['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada8 = $dado_provaPersonalizada8['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada8 = $dado_provaPersonalizada8['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada8SM = $dado_provaPersonalizada8['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada8 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada8SM));



  // Prova 7

  } elseif ($contador_provaPersonalizada == 7){



    // Obtendo o codigo da 7 prova

    $select_provaPersonalizada7 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada7=$select_provaPersonalizada7->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada7 = $dado_provaPersonalizada7['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada7 = $dado_provaPersonalizada7['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada7 = $dado_provaPersonalizada7['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada7SM = $dado_provaPersonalizada7['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada7 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada7SM));



  // Prova 6

  } elseif ($contador_provaPersonalizada == 6){



    // Obtendo o codigo da 6 prova

    $select_provaPersonalizada6 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada6=$select_provaPersonalizada6->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada6 = $dado_provaPersonalizada6['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada6 = $dado_provaPersonalizada6['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada6 = $dado_provaPersonalizada6['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada6SM = $dado_provaPersonalizada6['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada6 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada6SM));



  // Prova 5

  } elseif ($contador_provaPersonalizada == 5){



    // Obtendo o codigo da 5 prova

    $select_provaPersonalizada5 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada5=$select_provaPersonalizada5->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada5 = $dado_provaPersonalizada5['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada5 = $dado_provaPersonalizada5['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada5 = $dado_provaPersonalizada5['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada5SM = $dado_provaPersonalizada5['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada5 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada5SM));



  // Prova 4

  } elseif ($contador_provaPersonalizada == 4){



    // Obtendo o codigo da 4 prova

    $select_provaPersonalizada4 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada4=$select_provaPersonalizada4->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada4 = $dado_provaPersonalizada4['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada4 = $dado_provaPersonalizada4['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada4 = $dado_provaPersonalizada4['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada4SM = $dado_provaPersonalizada4['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada4 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada4SM));



  // Prova 3

  } elseif ($contador_provaPersonalizada == 3){



    // Obtendo o codigo da 3 prova

    $select_provaPersonalizada3 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada3=$select_provaPersonalizada3->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada3 = $dado_provaPersonalizada3['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada3 = $dado_provaPersonalizada3['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada3 = $dado_provaPersonalizada3['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada3SM = $dado_provaPersonalizada3['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada3 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada3SM));



  // Prova 2

  } elseif ($contador_provaPersonalizada == 2){



    // Obtendo o codigo da 2 prova

    $select_provaPersonalizada2 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada2=$select_provaPersonalizada2->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada2 = $dado_provaPersonalizada2['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada2 = $dado_provaPersonalizada2['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada2 = $dado_provaPersonalizada2['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada2SM = $dado_provaPersonalizada2['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada2 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada2SM));



  // Prova 1

  } elseif ($contador_provaPersonalizada == 1){



    // Obtendo o codigo da 1 prova

    $select_provaPersonalizada1 = mysqli_query($conexao, "SELECT * FROM tabela_provasrealizadas_usuario WHERE codigo = $codigo_provaPersonalizada;");

    $dado_provaPersonalizada1=$select_provaPersonalizada1->fetch_array();

      

    // Obtendo a pontuação

    $pontuacao_provaPersonalizada1 = $dado_provaPersonalizada1['pontuacao'];



    // Obtendo a precisao

    $precisao_provaPersonalizada1 = $dado_provaPersonalizada1['precisao'];



    // Obtendo a media de tempo

    $mediatempo_provaPersonalizada1 = $dado_provaPersonalizada1['media_tempo'];



    // Obtendo a data e a hora da realização

    $data_provaPersonalizada1SM = $dado_provaPersonalizada1['data_realizacao'];



    // Ajustando a data para o formato brasileiro

    $data_provaPersonalizada1 = date('d/m/y - H:i',  strtotime($data_provaPersonalizada1SM));

  }



  // Aumentando o valor do contador

  $contador_provaPersonalizada = $contador_provaPersonalizada - 1;



}

}



// Verificando se nenhum dos graficos deve ser mostrado

if ($qt_provascom < 2 && $qt_provasper <2){



  // Variavel de define se a box deve ser mostrada

  $mos_box = "none";



  // Varialvel para ajustar o posicionamento da tabela

  $top_tabela = 45;



}else{



  // Variavel de define se a box deve ser mostrada

  $mos_box = "block";



  // Varialvel para ajustar o posicionamento da tabela

  $top_tabela = 330;



}



?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE HTML >

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">  

<title>Minhas Evoluções</title>



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

    background-color: white;

    padding: 15px;

    border-radius: 15px;

    width: 90%;

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

              <li><a href="minhas_redacoesusu.php">Minhas</a></li>

              <li><a href="nova_redacao.php">Escrever</a></li>

              <li><a href="redacoes_todosusuarios.php">Outros usuários</a></li>

            </ul>

          </li>



            <ul>

              <li><a href="gerar_simucomcad.php">Completos</a></li>

              <li><a href="gerar_simusimcad.php">Personalizados</a></li>

              <li><a href="minhas_provas_Usuario.php">Meus Simulados</a></li>

              <li><a href="simu_feitoporadms.php">Feitos por Professores</a></li>

              <li><a href="simu_feitoporusuarios.php">Feitos por Usuários</a></li>

            </ul>

          </li>

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

<br><br><br><br><br><br>



<!-- Mostrando os graficos de desempenho -->

<center>

<h2><b>Minhas Evoluções</b></h2>

<br><br><br>



<!-- Grafico da precisão -->
<center>
<div class="box" style ="display: <?PHP echo $mos_box; ?>">



<!-- Iniciando PHP para ver se a legenda deve ser msotrada -->

<?php



if ($qt_provascom > 2){

echo "<legend><b>Últimos 8 Simulados Completos</b></legend>

<br><br>";

}

?>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="chart_div" style="width: 100%; height: 250px; display: <?php echo $mos_graficoscom; ?>;"></div>



<script>

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Precisão'],



          // Verificando se o numero de provas é maior que 7

          <?php if ($qt_provascom > 7){

          echo "['". $data_provaCompleta1 ."',".  $precisao_provaCompleta1 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 6

          <?php if ($qt_provascom > 6){

          echo "['". $data_provaCompleta2 ."',".  $precisao_provaCompleta2 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 5

          <?php if ($qt_provascom > 5){

          echo "['". $data_provaCompleta3 ."',".  $precisao_provaCompleta3 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 4

          <?php if ($qt_provascom > 4){

          echo "['". $data_provaCompleta4 ."',".  $precisao_provaCompleta4 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 3

          <?php if ($qt_provascom > 3){

          echo "['". $data_provaCompleta5 ."',".  $precisao_provaCompleta5 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 2

          <?php if ($qt_provascom > 2){

          echo "['". $data_provaCompleta6 ."',".  $precisao_provaCompleta6 ."],";

          } ?>



          ['<?php echo $data_provaCompleta7; ?>',  <?php echo $precisao_provaCompleta7; ?>],

          ['<?php echo $data_provaCompleta8; ?>',  <?php echo $precisao_provaCompleta8; ?>]

          



        ]);



        var options = {

          title: 'Evolução da precisão nos Simulados Completos',

          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},

          legend: {position: 'top', maxLines: 3},

          

          vAxis: {minValue: 0}

        };



        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));

        chart.draw(data, options);

      }

</script>

<br><br>



<!-- Grafico da pontuação -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="div_pontuacaoprova" style="width: 100%; height: 250px; display: <?php echo $mos_graficoscom; ?>;"></div>



<script>

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Pontos'],

          

          // Verificando se o numero de provas é maior que 7

          <?php if ($qt_provascom > 7){

          echo "['". $data_provaCompleta1 ."',".  $pontuacao_provaCompleta1 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 6

          <?php if ($qt_provascom > 6){

          echo "['". $data_provaCompleta2 ."',".  $pontuacao_provaCompleta2 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 5

          <?php if ($qt_provascom > 5){

          echo "['". $data_provaCompleta3 ."',".  $pontuacao_provaCompleta3 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 4

          <?php if ($qt_provascom > 4){

          echo "['". $data_provaCompleta4 ."',".  $pontuacao_provaCompleta4 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 3

          <?php if ($qt_provascom > 3){

          echo "['". $data_provaCompleta5 ."',".  $pontuacao_provaCompleta5 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 2

          <?php if ($qt_provascom > 2){

          echo "['". $data_provaCompleta6 ."',".  $pontuacao_provaCompleta6 ."],";

          } ?>



          ['<?php echo $data_provaCompleta7; ?>',  <?php echo $pontuacao_provaCompleta7; ?>],

          ['<?php echo $data_provaCompleta8; ?>',  <?php echo $pontuacao_provaCompleta8; ?>]



        ]);



        var options = {

          title: 'Evolução na Pontuação nos Simulados Completos',

          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},

          legend: {position: 'top', maxLines: 3},

          

          vAxis: {minValue: 0}

        };



        var chart = new google.visualization.AreaChart(document.getElementById('div_pontuacaoprova'));

        chart.draw(data, options);

      }

</script>

<br><br>



<!-- Grafico da Média de tempo -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="div_mediatempo" style="width: 100%; height: 250px; display: <?php echo $mos_graficoscom; ?>;"></div>



<script>

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Média de tempo (M)'],



          // Verificando se o numero de provas é maior que 7

          <?php if ($qt_provascom > 7){

          echo "['". $data_provaCompleta1 ."',".  $mediatempo_provaCompleta1 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 6

          <?php if ($qt_provascom > 6){

          echo "['". $data_provaCompleta2 ."',".  $mediatempo_provaCompleta2 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 5

          <?php if ($qt_provascom > 5){

          echo "['". $data_provaCompleta3 ."',".  $mediatempo_provaCompleta3 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 4

          <?php if ($qt_provascom > 4){

          echo "['". $data_provaCompleta4 ."',".  $mediatempo_provaCompleta4 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 3

          <?php if ($qt_provascom > 3){

          echo "['". $data_provaCompleta5 ."',".  $mediatempo_provaCompleta5 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 2

          <?php if ($qt_provascom > 2){

          echo "['". $data_provaCompleta6 ."',".  $mediatempo_provaCompleta6 ."],";

          } ?>



          ['<?php echo $data_provaCompleta7; ?>',  <?php echo $mediatempo_provaCompleta7; ?>],

          ['<?php echo $data_provaCompleta8; ?>',  <?php echo $mediatempo_provaCompleta8; ?>]



        ]);



        var options = {

          title: 'Evolução na Média de tempo nos Simulados Completos',

          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},

          legend: {position: 'top', maxLines: 3},

          

          vAxis: {minValue: 0}

        };



        var chart = new google.visualization.AreaChart(document.getElementById('div_mediatempo'));

        chart.draw(data, options);

      }

 

</script>

<br><br>



<?php

if ($qt_provasper > 2){

echo "<legend><b>Últimos 8 Simulados Personalizados</b></legend>

<br><br>";

}

?>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="div_precisaoper" style="width: 100%; height: 250px; display: <?php echo $mos_graficosper; ?>;"></div>



<script>

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Precisão'],



          // Verificando se o numero de provas é maior que 7

          <?php if ($qt_provasper > 7){

          echo "['". $data_provaPersonalizada1 ."',".  $precisao_provaPersonalizada1 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 6

          <?php if ($qt_provasper > 6){

          echo "['". $data_provaPersonalizada2 ."',".  $precisao_provaPersonalizada2 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 5

          <?php if ($qt_provasper > 5){

          echo "['". $data_provaPersonalizada3 ."',".  $precisao_provaPersonalizada3 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 4

          <?php if ($qt_provasper > 4){

          echo "['". $data_provaPersonalizada4 ."',".  $precisao_provaPersonalizada4 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 3

          <?php if ($qt_provasper > 3){

          echo "['". $data_provaPersonalizada5 ."',".  $precisao_provaPersonalizada5 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 2

          <?php if ($qt_provasper > 2){

          echo "['". $data_provaPersonalizada6 ."',".  $precisao_provaPersonalizada6 ."],";

          } ?>



          ['<?php echo $data_provaPersonalizada7; ?>',  <?php echo $precisao_provaPersonalizada7; ?>],

          ['<?php echo $data_provaPersonalizada8; ?>',  <?php echo $precisao_provaPersonalizada8; ?>]



        ]);



        var options = {

          title: 'Evolução na Precisão nos Simulados Personalizados',

          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},

          legend: {position: 'top', maxLines: 3},

          

          vAxis: {minValue: 0}

        };



        var chart = new google.visualization.AreaChart(document.getElementById('div_precisaoper'));

        chart.draw(data, options);

      }

</script>

<br><br>



<!-- Grafico da pontuação -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="div_pontuacaoper" style="width: 100%; height: 250px; display: <?php echo $mos_graficosper; ?>;"></div>



<script>

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Pontos'],



          // Verificando se o numero de provas é maior que 7

          <?php if ($qt_provasper > 7){

          echo "['". $data_provaPersonalizada1 ."',".  $pontuacao_provaPersonalizada1 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 6

          <?php if ($qt_provasper > 6){

          echo "['". $data_provaPersonalizada2 ."',".  $pontuacao_provaPersonalizada2 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 5

          <?php if ($qt_provasper > 5){

          echo "['". $data_provaPersonalizada3 ."',".  $pontuacao_provaPersonalizada3 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 4

          <?php if ($qt_provasper > 4){

          echo "['". $data_provaPersonalizada4 ."',".  $pontuacao_provaPersonalizada4 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 3

          <?php if ($qt_provasper > 3){

          echo "['". $data_provaPersonalizada5 ."',".  $pontuacao_provaPersonalizada5 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 2

          <?php if ($qt_provasper > 2){

          echo "['". $data_provaPersonalizada6 ."',".  $pontuacao_provaPersonalizada6 ."],";

          } ?>



          ['<?php echo $data_provaPersonalizada7; ?>',  <?php echo $pontuacao_provaPersonalizada7; ?>],

          ['<?php echo $data_provaPersonalizada8; ?>',  <?php echo $pontuacao_provaPersonalizada8; ?>]



        ]);



        var options = {

          title: 'Evolução na Pontuação nos Simulados Personalizados',

          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},

          legend: {position: 'top', maxLines: 3},

          

          vAxis: {minValue: 0}

        };



        var chart = new google.visualization.AreaChart(document.getElementById('div_pontuacaoper'));

        chart.draw(data, options);

      }

</script>

<br><br>



<!-- Grafico da Média de tempo -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="div_mediatempoper" style="width: 100%; height: 250px; display: <?php echo $mos_graficosper; ?>;"></div>



<script>

      google.charts.load('current', {'packages':['corechart']});

      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Data', 'Média de tempo (M)'],



          // Verificando se o numero de provas é maior que 7

          <?php if ($qt_provasper > 7){

          echo "['". $data_provaPersonalizada1 ."',".  $mediatempo_provaPersonalizada1 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 6

          <?php if ($qt_provasper > 6){

          echo "['". $data_provaPersonalizada2 ."',".  $mediatempo_provaPersonalizada2 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 5

          <?php if ($qt_provasper > 5){

          echo "['". $data_provaPersonalizada3 ."',".  $mediatempo_provaPersonalizada3 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 4

          <?php if ($qt_provasper > 4){

          echo "['". $data_provaPersonalizada4 ."',".  $mediatempo_provaPersonalizada4 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 3

          <?php if ($qt_provasper > 3){

          echo "['". $data_provaPersonalizada5 ."',".  $mediatempo_provaPersonalizada5 ."],";

          } ?>



          // Verificando se o numero de provas é maior que 2

          <?php if ($qt_provasper > 2){

          echo "['". $data_provaPersonalizada6 ."',".  $mediatempo_provaPersonalizada6 ."],";

          } ?>



          ['<?php echo $data_provaPersonalizada7; ?>',  <?php echo $mediatempo_provaPersonalizada7; ?>],

          ['<?php echo $data_provaPersonalizada8; ?>',  <?php echo $mediatempo_provaPersonalizada8; ?>]



        ]);



        var options = {

          title: 'Evolução na Média de tempo nos Simulados Personalizados',

          hAxis: {title: 'Data',  titleTextStyle: {color: '#333'}},

          legend: {position: 'top', maxLines: 3},

          

          vAxis: {minValue: 0}

        };



        var chart = new google.visualization.AreaChart(document.getElementById('div_mediatempoper'));

        chart.draw(data, options);

      }

 

</script>

</div>
</center>
<br><br><br><br>



<!-- Tabela para mostrar todas as provas realizadas -->

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

                <h3 class="panel-title">Simulados Realizados</h3>

                <div class="pull-right">

                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtro</button>

                </div>

            </div>

            <table class="table">

                <thead>

                    <tr class="filters">

                        <th><input type="text" class="form-control" placeholder="Tipo" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Qt. Questões" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Pontuação" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Precisão" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Média de Tempo (M)" disabled></th>

                        <th><input type="text" class="form-control" placeholder="Data/Hora Realização" disabled></th>

                        

                    </tr>

                </thead>

                <tbody>





<!-- Iniciando php para inserir os dados na tabela --> 

<!-- Criando um loop -->

<?php 



// Selecionando a todas as provas realizadas

$consulta = mysqli_query($conexao,"SELECT * from tabela_provasrealizadas_usuario where codigo_usuario = $codigo_usuario order by codigo desc;");



while ($dado=$consulta->fetch_array()) { 



// Inserindo dados na tabela 

echo "<tr>";



// Definindo o tipo da prova

if ($dado['numero_questoes'] == 90){

echo "<td>Completo</td>";

}else{

  echo "<td>Personalizado</td>";

}



// Quantidade de perguntas

echo "<td>".$dado['numero_questoes']."</td>";



// Pontuação

echo "<td>".$dado['pontuacao']."</td>";



// Precisão

echo "<td>". number_format($dado['precisao'], 2, "," , ".") . "%" ."</td>";



// Média de Tempo

echo "<td>".number_format($dado['media_tempo'], 3, "," , ".")."</td>";



// Obtendo a data e a hora da realização

$data_reaSM = $dado['data_realizacao'];



// Ajustando a data para o formato brasileiro

$data_realizacao = date('d/m/y - H:i',  strtotime($data_reaSM));



// Data e hora da realização

echo "<td><a href='simu_meuusu.php?codigorea=$dado[codigo]'>$data_realizacao</a></td>";



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

            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">Nenhum Simulado Encontrado</td></tr>'));

        }

    });

});	</script>

<!-- Fechando a tabela -->



<!-- Fechando TAGs em aberto -->

</center>

<br><br><br><br>

</html>