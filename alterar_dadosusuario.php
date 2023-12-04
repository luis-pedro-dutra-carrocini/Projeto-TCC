<!-- Inicinado PHP -->

<?php



// Iniciando sessão 

session_start();



// verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){



  // Redirecionando para a pagina index, pois a sessão não foi inicada

  header('location: index.php');

  exit;

}

else{



  // Verificando se o usuario é antigo ou recente

  // Antigp

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





// Conectando com o banco de dados

include_once('conexao.php');



// Obtendo o nome com a sessão

$nome = $nome_usuario;



// Obtendo os dsdos do usuario

$select_usuario = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome';");



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



// Verificando se a resposta de deletar e resetar são true ou false

if ($_POST){



    // Obtendo a resposta de exclusão do Java

    $confexc = filter_input(INPUT_POST, 'confexc', FILTER_SANITIZE_SPECIAL_CHARS);



    // Se for sim

    if ($confexc == "True"){



      // Deletando as respostas do usuario

      $del_per = mysqli_query($conexao, "DELETE FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario;");



      // Deletando as provas realizadas

      $del_prorel = mysqli_query($conexao, "DELETE FROM tabela_provasrealizadas_usuario WHERE codigo_usuario = $codigo_usuario;");



      // Deletando as provas salvas pelo usuario

      $del_prosal = mysqli_query($conexao, "DELETE FROM tabela_provas_usuario WHERE codigo_usuario = $codigo_usuario;");



      // Deletando as redações do usuario

      $del_red = mysqli_query($conexao, "DELETE FROM tabela_redacoes WHERE codigo_usuario = $codigo_usuario;");



      // Deletando a avaliação do site

      $delava = mysqli_query($conexao, "DELETE FROM tabela_avaliacoes WHERE nome_usuario = '$nome' and tipo = 2;");



      // Deletando o usuario da tabela usuarios

      $dados = mysqli_query($conexao, "DELETE FROM tabela_usuario WHERE nome = '$nome';");



      // Destruindo sessão

      session_destroy();



      // Redirecionando para a pagina login

      header('location: login.php');

      exit;

    }



    // Se for não

    elseif ($confexc == "False"){



      // Continuando na pagina alterar dados

      header('location: alterar_dadosusuario.php');

      exit;

    }



    // Obtendo a resposta de resetar a conta

    $confreset = filter_input(INPUT_POST, 'confreset', FILTER_SANITIZE_SPECIAL_CHARS);



    // Se for sim

    if ($confreset == "True"){



      // Deletando as respostas do usuario

      $dados = mysqli_query($conexao, "DELETE FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario;");



      // Deletando as provas realizadas

      $del_prorel = mysqli_query($conexao, "DELETE FROM tabela_provasrealizadas_usuario WHERE codigo_usuario = $codigo_usuario;");



      // Deletando as provas salvas pelo usuario

      $del_prosal = mysqli_query($conexao, "DELETE FROM tabela_provas_usuario WHERE codigo_usuario = $codigo_usuario;");



      // Deletando as redações do usuario

      $del_red = mysqli_query($conexao, "DELETE FROM tabela_redacoes WHERE codigo_usuario = $codigo_usuario;");



      // Deletando a avaliação do site

      $delava = mysqli_query($conexao, "DELETE FROM tabela_avaliacoes WHERE nome_usuario = '$nome' and tipo = 2;");



      // Zerando a pontuação, a precisão e a media de tempo

      $sqlInsert = "UPDATE tabela_usuario SET pontuacao = 0, precisao = 0, media_tempo = 0 WHERE nome='$nome';";

      $result = $conexao->query($sqlInsert);



      // Redirecionando para a pagina usuarios

      header('location: pagina_usuarios.php');

      exit;

    }



    // Se for não

    elseif ($confreset == "False"){

      

      // Continuando na pagina alterar dados

      header('location: alterar_dadosusuario.php');

      exit;

    }

}



    // Quando clicar no botão alterar

    if(isset($_POST["alterar"])){



        // Verificando se a menssagem foi aceita ou recusada

        $confalte = filter_input(INPUT_POST, 'confalte', FILTER_SANITIZE_SPECIAL_CHARS);



        // Se for sim

        if ($confalte == "True"){



            // Verificando se o email é válido ou não

            $emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);



            // Se for invalido

            if($emailvalouinv == "Inválido"){

                

                // Emitindo mensagem de erro

                $script = "<script>alert('Erro: Não foi alterar dados do Usuário. E-Mail Inválido.');location.href='alterar_dadosusuario.php';</script>";

                echo $script;

            }



            // Se for válido

            elseif($emailvalouinv == "Válido"){



            // Obtendo os dados do bd

            $sql3 = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$nome';");

            $selectemail=$sql3->fetch_array();



            // Obtendo os dados do form

            // Email antigo

            $email = $selectemail['email'];



            // Novo nome

            $novonome = trim($_POST['nome']);



            // Novo email

            $novoemail = trim($_POST['email']);



            // Nova senha

            $novasenha = trim($_POST['senha']);



            // Nova data de nascimento

            $novadtnascimento = $_POST['dtnasc'];



            // Obtendo outros dados para verificar se o novo email ou nove já existem

            $sql = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE email = '$novoemail';");

            $sql2 = mysqli_query($conexao, "SELECT * FROM tabela_usuario WHERE nome = '$novonome';");

            $emailex = mysqli_num_rows($sql);

            $nomeex = mysqli_num_rows($sql2);



        // Verificando se o email já existe

        // Se o email novo é diferente do antigo

        if ($novoemail != $email){



            // Verficando se ja existe

            if($emailex>0) {



                // Emitindo mensagem de erro

                $script = "<script>alert('Erro: Não foi possivel alterar dados do Usuário. E-Mail já utilizado.');location.href='alterar_dadosusuario.php';</script>";

                echo $script;

                exit;

            }

        }



        // Verificando se o nome já existe

        // Se o novo nome é diferente do nome antigo

        if ($novonome != $nome){



            // Verificando se ja existe

            if($nomeex>0) {



                // Emitindo mensagem de erro

                $script = "<script>alert('Erro: Não foi possivel alterar dados do Usuário. Nome já utilizado.');location.href='alterar_dadosusuario.php';</script>";

                echo $script;

                exit;

            }

        }



        // Verificando se nome ou email estão banidos

        // Eamil

        $verificarusuban = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE email = '$novoemail';");



        // Nome

        $verificarusubannome = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE nome = '$novonome';");



        // Certificando se esse email não esta banido

        if(mysqli_num_rows($verificarusuban)>0){



          // Emitindo mensagem de erro

	        $script = "<script>alert('Erro: E-Mail Banido.');location.href='alterar_dadosusuario.php';</script>";

	        echo $script;

          exit;

        }

        else{



          // Certificando se esse nome não esta banido

          if(mysqli_num_rows($verificarusubannome)>0){



            // Emitindo mensagem de erro

            $script = "<script>alert('Erro: Nome Banido.');location.href='alterar_dadosusuario.php';</script>";

            echo $script;

            exit;

          }else{



                // Verificando se o nome não esta nulo

                if ($novonome == ""){



                  // Emitindo mensagem de erro

                  $script = "<script>alert('Erro: Nome não pede ser nulo.');location.href='alterar_dadosusuario.php';</script>";

                  echo $script;

                  exit;

                }



                // Verificando se o a senha não esta nula

                if ($novasenha == ""){



                  // Emitindo mensagem de erro

                  $script = "<script>alert('Erro: Senha não pede ser nula.');location.href='alterar_dadosusuario.php';</script>";

                  echo $script;

                  exit;

                }



                // Alterando os dados

                $sqlInsert = "UPDATE tabela_usuario SET nome='$novonome',email='".addslashes($novoemail)."',senha='".addslashes($novasenha)."',data_nascimento='$novadtnascimento' WHERE nome='$nome';";

                $result = $conexao->query($sqlInsert);



                // Alterando nome da sessão

                // Se o usuario for antigo

                if(isset($_SESSION["senha_usuario"])){



                    // Novo nome

                    $_SESSION["nome_usuario"] = $novonome;

                  }



                  // Se o usuario for recente

                  elseif(isset($_SESSION["nome_cad"])){



                    // Novo nome

                    $_SESSION["nome_cad"] = $novonome;

                  }



                // Emitindo mensagem de sucesso

                $script = "<script>alert('Alterado com sucesso');location.href='alterar_dadosusuario.php';</script>";

                echo $script;

                exit;

          }

          }   

          }

    }

  }



    // Obtendo os dados do bd a serem alterados

    if(isset($nome_usuario)){

        if (isset($novonome)){



            // Obtendo o nome

            $nome = $novonome;



            // Obtendo os outros dados

            $sqlSelect = "SELECT * FROM tabela_usuario WHERE nome='$nome'";

            $result = $conexao->query($sqlSelect);



            // Verificando se o usuario existe

            if($result->num_rows > 0){



             // Dados o banco de dados

             $user_data = mysqli_fetch_assoc($result);



             // Nome a ser mostrado

             $nomemos = $user_data['nome'];



             // Email a ser mostrado

             $email = $user_data['email'];



             // Senha a ser mostrada

             $senha = $user_data['senha'];



             // Data de nascimento a ser mostrada

             $dtnascimento = $user_data['data_nascimento'];

    

            }



        }elseif (isset($nome_usuario)){



        // Obtendo o nome

        $nome = $nome_usuario;



        // Obtendo os outros dados

        $sqlSelect = "SELECT * FROM tabela_usuario WHERE nome='$nome'";

        $result = $conexao->query($sqlSelect);



        // Verificando se o usuario existe

        if($result->num_rows > 0){



         // Dados do banco de dados

         $user_data = mysqli_fetch_assoc($result);



         // Nome a ser mostrado

         $nomemos = $user_data['nome'];



         // Email a ser mostrado

         $email = $user_data['email'];



         // Senha a ser mostrada

         $senha = $user_data['senha'];



         // Data de nascimneto a ser mostrada

         $dtnascimento = $user_data['data_nascimento'];



        }

        }

        else

        {



            // Redirecionando para a pagina usuario

            header('Location: pagina_usuarios.php');

            exit;

        }

    }

    else

    {

        

      // Redirecionando para a pagina usuario

      header('Location: pagina_usuarios.php');

      exit;

    }

?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE html>

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">

<title>Dados da Conta</title>



<!-- Colocando ícone na página -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- Iniciando Java -->

<script>



// Função para sair da conta -->

function sair() {

  var resultado = confirm("Deseja Realmente sair dessa Conta?")

    if (resultado == true) {

      location.href='sair.php';

    }

}



// Função para abrir a pagina home -->

function home() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='pagina_usuarios.php';

    }

}



  // Função para alterar os dados -->

function alterardados() {

var resultadoalterar = confirm("Deseja Realmente alterar esses Dados?");

if (resultadoalterar == true) {

    var confalte = "True";

    document.getElementById("confalte").value = confalte;

  }

}



// Função para voltar para a pagina anterior -->

function voltar() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='pagina_usuarios.php';

    }

}



// Função para voltar para a pagina minhas provas -->

function meusimu() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='minhas_provas_Usuario.php';

    }

}



// Função para voltar para a pagina simulados feitos por professores -->

function feiprof() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='simu_feitoporadms.php';

    }

}



// Função para voltar para a pagina simulados feitos por usuarios -->

function feiusu() {

  var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='simu_feitoporusuarios.php';

    }

}



// Função para excluir a conta -- >

function excluirconta() {

    var resultado = confirm("Deseja Realmente Excluir essa Conta?");

    if (resultado == true) {

        alert("A conta foi Excluida com Sucesso!!!");

        var confexc = "True";

    }

        else{

          var confexc = "False";

        }

    document.getElementById("confexc").value = confexc;

}



// Função para resetar a conta -- >

function resetarconta() {

    var resultado = confirm("Deseja Realmente Resetar essa Conta? Dados de desempenho serão perdidos, já dados como Nome, Senha, E-Mail e Data de Nascimento, serão mantidos");

    if (resultado == true) {

        alert("A conta foi Resetada com Sucesso!!!");

        var confexc = "True";

    }

        else{

          var confexc = "False";

        }

        document.getElementById("confreset").value = confexc;

}



// Função para abrir a pagina Ranking -->

function Ranking() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='ranking_usuarios.php';

    }

}



// Função para abrir a pagina gerar simulado personalizado

function simusim() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='gerar_simusimcad.php';

    }

}



// Função para abrir a pagina gerar simulado personalizado

function simucom() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='gerar_simucomcad.php';

    }

}



// Função para abrir a pagina sobre

function sobre() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='sobreusu.php';

    }

}



// Função para abrir a pagina minhas redações

function redminhas() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='minhas_redacoesusu.php';

    }

}



// Função para abrir a pagina redações usuarios

function redoutros() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='redacoes_todosusuarios.php';

    }

}



// Função para abrir a pagina evoluções

function evolucao() {

    var resultadovoltar = confirm("Cancelar Alteração?");

    if (resultadovoltar == true) {

      location.href='todasprovas_realizadasusu.php';

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



<!-- Iniciando o CSS -->

<!-- definindo caracteristicas para a pagina -->

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

    width: 50%;

}



/* Caracteristicas da legenda do form */

legend{

    padding: 10px;

    text-align: center;

    border-radius: 8px;

    font-size: 19px;

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

#alterar{

    width: 50%;

    border: none;

    padding: 15px;

    color: white;

    font-size: 15px;

    cursor: pointer;

    border-radius: 10px;

    background-color: DarkTurquoise;

}

#alterar:hover{

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



#deletar_conta{

            width: 98%;

            border: none;

            padding: 15px;

            color: white;

            font-size: 15px;

            cursor: pointer;

            border-radius: 10px;

            background-color: DarkTurquoise;

        }

        #deletar_conta:hover{

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

        <h1><a onclick="sobre()" class="scrollto">DSENEM</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="sobreusu.php"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-active"><a onclick="home()">Home</a></li>

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

            <li><a onclick="simucom()">Completos</a></li>

              <li><a onclick="simusim()">Personalizados</a></li>

              <li><a onclick="meusimu()">Meus Simulados</a></li>

              <li><a onclick="feiprof()">Feitos por Professores</a></li>

              <li><a onclick="feiusu()">Feitos por Usuários</a></li>

            </ul>

          </li>



          <li class="menu-has-children"><a >Redações</a>

            <ul>

              <li><a onclick="redminhas()">Minhas</a></li>

              <li><a onclick="redoutros()">Outros usuários</a></li>

            </ul>

          </li>

            <ul>

              <li><a onclick="simucom()">Completos</a></li>

              <li><a onclick="simusim()">Personalizados</a></li>

              <li><a onclick="meusimu()">Meus Simulados</a></li>

              <li><a onclick="feiprof()">Feitos por Professores</a></li>

              <li><a onclick="feiusu()">Feitos por Usuários</a></li>

            </ul>

          </li>



          <li><a onclick="evolucao()">Evolução</a></li>

		      <li><a onclick="Ranking()">Ranking</a></li>

          

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

<br><br><br><br><br>


<!-- Iniciando java para a validação do email -->

<script>

// Função para validar email -->

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


<center>
<!-- Inserindo inputs com suas caracteristicas -->

<body>

    <div class="box" align="left">

        <form action="" method="POST" name="f1">



            <!-- Borda em volta do form -->

            <fieldset>



                <!-- legenda do Formulario -->

                <legend><b>Dados</b></legend>

                <br><br>



                <!-- Campo email -->

                <div class="inputBox">

                    <input type="email" name="email" id="email" class="inputUser" onblur="validacaoEmail(f1.email)" autofocus maxlength="256" value="<?php echo $email;?>" required>

                    <label for="email" class="labelInput">Email</label>

                    <input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 

                <br><br>



                <!-- DIV menssagem de email valido ou invalido -->

                </div>

                <div id="msgemail" style="text-align: center;"></div>

			    <br><br>



                <!-- campo nome -->

                <div class="inputBox">

                    <input type="text" name="nome" id="nome" class="inputUser" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" maxlength="50" value="<?php echo $nomemos;?>" required>

                    <label for="nome" class="labelInput">Nome</label>

                </div>

                <br><br>



                <!-- Campo data de nascimento -->

			    <div class="input-box">

		        <span>Data de Nascimento</span><br>

			    <input type="date" name ="dtnasc" value="<?php echo $dtnascimento;?>" required>

		        </div>

			    <br><br>



                <!-- campo senha -->

                <div class="inputBox">

                <input type="text" name="senha" id="senha" class="inputUser" maxlength="50" value="<?php echo $senha;?>" required>

                <label for="nome" class="labelInput">Senha</label>

                </div>

                <br><br>



                <!-- Inputs para passar informações do java para o php -->

				        <input type="hidden" name="id" value=<?php echo $nome;?>>

                <input type="hidden" value="" id="confalte" name="confalte"> 

                <input type="hidden" value="" id="confexc" name="confexc">   

                <input type="hidden" value="" id="confreset" name="confreset">



                <!-- Botão alterar e cancelar -->

                <button type ="submit" id="alterar" onclick="alterardados()" name="alterar">Alterar</button>

                <button type ="button" id="cancelar" onclick="voltar()" name="cancelar">Cancelar</button>

                <br><br>



                <center>

                <button onclick="resetarconta()" id="deletar_conta" data-toggle="tooltip" data-placement="top">Resetar conta</button>   

                </center>

                <br>



                <center>

                <button onclick="excluirconta()" id="deletar_conta" data-toggle="tooltip" data-placement="top">Deletar conta</button>   

                </center>

            </fieldset>



<!-- Fechando tags em aberto -->

</form>

</div>
</center>

</body>

</html>