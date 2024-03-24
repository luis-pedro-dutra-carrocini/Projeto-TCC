<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conecatando com o banco de dados
include_once('conexao.php');

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"])){

  // Redirecionando para a página index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Obtendo o nome via sessão
    $nome = $_SESSION["nome_adm"];

    // Obtendo os dados do adm
    $dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");
    
    // Verificando se o usuário existe no bd
    if($dados->num_rows > 0){
      $dado=$dados->fetch_array();
      }else{
  
        // Voltando para o index, pois o usuario não existe
        header('location: index.php');
        exit;
      }

    // Obtendo o email do adm
    $email = $dado['email'];

    // Obtendo a senha do adm
    $senha = $dado['senha'];

    // Obtendo o nivel do adm
    $niveladm = $dado['nivel'];

    // Obtendo o codigo do adm
    $codigo_adm = $dado['codigo'];
}

// Verificando se a resposta de deletar foi true ou false
if ($_POST){

  // Obtendo a resposta que veio do fromulario pelo java 
  // Confirmar alterarção
  $confexc = filter_input(INPUT_POST, 'confexc', FILTER_SANITIZE_SPECIAL_CHARS);

  // Confirmar exclusão
  $confalt = filter_input(INPUT_POST, 'confalt', FILTER_SANITIZE_SPECIAL_CHARS);

  // Verificando se a resposta de exclusão foi sim ou não
  // Se foi sim
  if ($confexc == "True"){

    if ($niveladm == "admgeral"){

      // verificando quantos adms gerais existem
      $qtadm = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nivel = 'admgeral';");
      $adms=$qtadm->fetch_array();

      // verificando se ha mais de um admgeral
      if($qtadm->num_rows > 1){

        // Deletando as provas do adm
        $del_provasadm = mysqli_query($conexao, "DELETE FROM tabela_provas_adm WHERE codigo_adm = $codigo_adm;");

        // Alterando a redações corrigidas pelo adm
        $alt_red = mysqli_query($conexao, "UPDATE tabela_redacoes SET codigo_adm = 1 WHERE codigo_adm = $codigo_adm;");

        // Deletando a conta do adm
        $dados = mysqli_query($conexao, "DELETE FROM tabela_adm WHERE nome = '$nome';");
      }else{

        // Emitindo mensagem de erro, pis o adm não pode se excluir
        // Já que não ha outro adm geral
				$script = "<script>alert('Não é possivel deletar a sua conta. Somente você é ADM Geral, seria necessário cadastrar outro ADM Geral');location.href='alterar_dadosadm.php';</script>";
				echo $script;
				exit;
      }

    }else{

    // Deletando as provas do adm
    $del_provasadm = mysqli_query($conexao, "DELETE FROM tabela_provas_adm WHERE codigo_adm = $codigo_adm;");

    // Alterando a redações corrigidas pelo adm
    $alt_red = mysqli_query($conexao, "UPDATE tabela_redacoes SET codigo_adm = 1 WHERE codigo_adm = $codigo_adm;");

    // Deletando a conta do adm
    $dados = mysqli_query($conexao, "DELETE FROM tabela_adm WHERE nome = '$nome';");
    }

    // Encerrando a sessão
    session_destroy();

    // Redirecionando para a pagina index
    header('location: index.php');
    exit;

  // Se aresposta for não
  }elseif ($confexc == "False"){
    // Continuando na pagina
  }
  else{
    // Continuando na pagina
  }

  // Verificando se a resposta de alterar foi true ou false
  if ($confalt == "True"){

    // Obtendo os dados do form
    //  Nome
    $novonome = trim($_POST['nome']);

    // Senha
    $novasenha = trim($_POST['senha']);

    // Email
    $novoemail = trim($_POST['email']);

    // Obtendo dados do bd para ver se email ja existe
    $sql = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE email = '".addslashes($novoemail)."';");
    $emailex = mysqli_num_rows($sql);

    // Obtendo dados do bd para ver se nome ja existe
    $sql2 = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '".addslashes($novonome)."';");
    $nomeex = mysqli_num_rows($sql2);

    // Obtendo os dados para ver se o email é válido
    $emailvalouinv = filter_input(INPUT_POST, 'emailvalouinv', FILTER_SANITIZE_SPECIAL_CHARS);
       
    // Verifivcando se o email é valido
    // Se for inválido
    if($emailvalouinv == "Inválido"){
      
      // Emitindo menssagem de erro
      $script = "<script>alert('Erro: Não foi possivel alterar os dados. E-Mail Inválido.');location.href='alterar_dadosadm.php';</script>";
      echo $script;
      exit;
    }

    // Se for válido
    elseif($emailvalouinv == "Válido"){

      // Verificando se nome ou email estão banidos
      // email
      $verificarusuban = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE email = '".addslashes($novoemail)."';");

      // Nome
      $verificarusubannome = mysqli_query($conexao, "SELECT * FROM tabela_usuarios_banidos WHERE nome = '".addslashes($novonome)."';");

      // Certificando se esse email esta banido
      if(mysqli_num_rows($verificarusuban)>0){

        // Emitindo menssagem de erro
        $script = "<script>alert('Erro: E-Mail Banido.');location.href='alterar_dadosadm.php';</script>";
        echo $script;
        exit;
      }else{

        // Se o nome esta banido
        if(mysqli_num_rows($verificarusubannome)>0){

          // Emitindo mensagem de erro
          $script = "<script>alert('Erro: Nome Banido.');location.href='alterar_dadosadm.php';</script>";
          echo $script;
          exit;
        }else{

            // Verificando se o email já esta cadastrado
            if($email != $novoemail){

              // Se estiver cadastrado
              if($emailex>0) {
                
                // Emitindo mensagem de erro
                $script = "<script>alert('Erro: Não foi possivel alterar os dados. E-Mail já utilizado.');location.href='alterar_dadosadm.php';</script>";
                echo $script;
                exit;

              // Verificando se o nome já esta cadastrado
              } elseif($nome != $novonome){

                // Se estiver cadastrado
                if($nomeex>0){
                
                // Emitindo mensagem de erro
                $script = "<script>alert('Erro: Não foi possivel alterar os dados. Nome já utilizado.');location.href='alterar_dadosadm.php';</script>";
                echo $script;
                exit;
              }

              // Verificando se o campo nome esta nulo
              elseif ($novonome == ""){
                
                // Emitindo mensagem de erro
                $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Nome deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
                echo $script;
                exit;
              }

              // Verificando se o campo senha esta nulo
              elseif ($novasenha == ""){
                
                // Emitindo mensagem de erro
                $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Senha deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
                echo $script;
                exit;
              }
              else{

                // Criptografando a senha
                $novasenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

          // Alterando os dados
          $aleterar = mysqli_query($conexao, "UPDATE tabela_adm SET nome='".addslashes($novonome)."', email='".addslashes($novoemail)."', senha='".addslashes($novasenha)."' WHERE nome='$nome';");

          // Alterando o valor da sessão
          $_SESSION["nome_adm"]= $novonome;
          $_SESSION["senha"]= $novasenha;

          // Emitindo uma mensagem de sucesso
          $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
          echo $script;
          exit;
          }
        }

        // Verificando se o campo nome seta nulo
        elseif ($_POST['nome'] == ""){
          
          // Emitindo mensagem de erro
          $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Nome ADM deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
          echo $script;
          exit;
        }

         // Verificando se o campo senha seta nulo
        elseif ($_POST['senha'] == ""){
          
          // Emitindo mensagem de erro
          $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Senha ADM deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
          echo $script;
          exit;
        }else{

        // Criptografando a senha
        $novasenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Alterando os dados
        $aleterar = mysqli_query($conexao, "UPDATE tabela_adm SET nome='".addslashes($novonome)."', email='".addslashes($novoemail)."', senha='".addslashes($novasenha)."' WHERE nome='$nome';");

        // Alterando os valores da sessão
        // Nome
        $_SESSION["nome_adm"]= $novonome;

        // Senha
        $_SESSION["senha"]= $novasenha;

        // Emitindo uma mensagem de sucesso
        $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
        echo $script;
        exit;
        }
      }

      // Verificando se o nome atual é diferente do nome novo
      elseif($nome != $novonome){

        // Verificando se o novo nome já existe
        if($nomeex>0){
          
          // Emitindo mensagem de erro
          $script = "<script>alert('Erro: Não foi possivel alterar os dados. Nome já utilizado.');location.href='alterar_dadosadm.php';</script>";
          echo $script;
          exit;
        }

        // Verificando se o campo nome esta nulo
        elseif ($_POST['nome'] == ""){
          
          // Emitindo mensagem de erro
          $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Nome ADM deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
          echo $script;
          exit;
        }

        // Verificando se o campo senha esta nulo
        elseif ($_POST['senha'] == ""){
          
          // Emitindo mensagem de erro
          $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Senha ADM deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
          echo $script;
          exit;
        }
        else{

        // Criptografando a senha
        $novasenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // Alterando os dados 
        $aleterar = mysqli_query($conexao, "UPDATE tabela_adm SET nome='".addslashes($novonome)."', email='".addslashes($novoemail)."', senha='".addslashes($novasenha)."' WHERE nome='$nome';");

        // Alterando os valores da sessão
        // Nome
        $_SESSION["nome_adm"]= $novonome;

        // Senha
        $_SESSION["senha"]= $novasenha;

        // Emitindo uma mensagem de sucesso
        $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
        echo $script;
        exit;
        }
      }

      // Verificando se o campo nome esta nulo
      elseif ($_POST['nome'] == ""){
        
        // Emitindo mensagem de erro
        $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Nome ADM deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
        echo $script;
        exit;
      }

      // Verificando se o campo senha esta nulo
      elseif ($_POST['senha'] == ""){
        
        // Emitindo mensagem de erro
        $script = "<script>alert('Erro: Não foi possivel alterar os dados. Campo Senha ADM deve ser preenchido.');location.href='alterar_dadosadm.php';</script>";
        echo $script;
        exit;
      }else{

      // Criptografando a senha
      $novasenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

      // Alterando os dados 
      $aleterar = mysqli_query($conexao, "UPDATE tabela_adm SET nome='".addslashes($novonome)."', email='".addslashes($novoemail)."', senha='".addslashes($novasenha)."' WHERE nome='$nome';");

      // Alterando os valores da sessão
      // Nome
      $_SESSION["nome_adm"]= $novonome;

      // Senha
      $_SESSION["senha_adm"]= $novasenha;

      // Emitindo uma mensagem de sucesso
      $script = "<script>alert('Dados alterados com Sucesso!!!');location.href='pagina_adm.php';</script>";
      echo $script;
      exit;
      }
    }
    }
  }
}
}

?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- definindo caracteristica basica da pagina como acentuação e titulo -->
<meta charset="UTF-8">
<title>Dados da Conta</title>

<!-- Definindo um icone para a página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- Iniciando o java -->
<script>

// Função para excluir a conta -->
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

// Função para sair da conta -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}

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

// Função para voltar para a pagina anterior -->
function voltar() {
  var resultadovoltar = confirm("Cancelar alterações?");
    if (resultadovoltar == true) {
      location.href='pagina_adm.php';
    }
}

// Função para alterar os dados -->
function alterar() {
    var resultado = confirm("Deseja Realmente alterar esses Dados?");
    if (resultado == true) {
        var confalt = "True";
        document.getElementById("confalt").value = confalt;
    }
        else{
          var confalt = "False";
          document.getElementById("confalt").value = confalt;
        }
}

// Função para ir para a página principal -->
function home() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='pagina_adm.php';
	}
}

// Função para ir para a página visualizar usuarios -->
function visu_usuarios() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_usuarios.php';
	}
}

// Função para ir para a página visualizar questões -->
function visu_questoes() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_questoes.php';
	}
}

// Função para ir para a página add questões -->
function add_questoes() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='adicionar_questao.php';
	}
}

// Função para ir para a página adicionar adm -->
function add_adm() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='adicionar_adm.php';
	}
}

// Função para ir para a página visu usu ban -->
function visu_usuarios_banidos() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_usuarios_banidos.php';
	}
}

// Função para ir para a página visu provas adm -->
function provas_geradas() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='provas_geradasadm.php';
	}
}

// Função para ir para a página criar provas -->
function gerar_prova() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='gerar_provaadm.php';
	}
}

// Função para alterar dados -->
function pgaltdados() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='alterar_dadosadm.php';
	}
}

// Função para abrir a pagina redações para corrigir -->
function red_corrigir() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='readacoes_corrigir.php';
	}
}

// Função para abrir a pagina redações corrigidas -->
function red_corrigidas() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='readacoes_corrigidas.php';
	}
}

// Função para abrir a pagina mostrar professores -->
function mostrar_professores() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_professores.php';
	}
}

// Função para abrir a pagina professores banidos -->
function mostrar_proban() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='mostrar_professores_banidos.php';
	}
}

// Função para abrir a pagina sobre -->
function sobre() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='sobreadm.php';
	}
}

// Função para abrir a pagina provas professores -->
function professores() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='provasadm_adm.php';
	}
}

// Função para abrir a pagina provas usuarios -->
function prousuarios() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='provasusu_adm.php';
	}
}

// Função para abrir a pagina temas do enem -->
function tamas_enem() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='temas_enem.php';
	}
}

// Função para abrir a pagina temas usuarios -->
function temas_usuarios() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='temas_usuarios.php';
	}
}


// Função para abrir a pagina temas adm -->
function temas_adm() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='temas_professores.php';
	}
}

// Função para abrir a pagina add tema -->
function add_tema() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='adicionar_tema.php';
	}
}

// Função para abrir a visualizar imagens de perguntas -->
function verimg_per() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='verficarimg_perguntas.php';
	}
}

// Função para abrir a visualizar imagens de respostas -->
function verimg_res() {
	var resultado = confirm("Cancelar alterarções?")
    if (resultado == true) {
      location.href='verficarimg_respostas.php';
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

            color: white;

            background-color: black;

            padding: 15px;

            border-radius: 15px;

            border: 2px solid #0000FF;

            width: 95%;

            font-size: clamp(1em, 1em + 0.5vw, 1.5em);

        }

		/* Definindo caracteristicas dos botões */

        #btn_alteraadm  {

            width: 32%;

            border: none;

            padding: 15px;

            color: white;

            font-size: clamp(1em, 1em + 0.5vw, 1.5em);

            cursor: pointer;

            border-radius: 10px;

            background-color: RoyalBlue;

        }

        #btn_alteraadm:hover{

            background-color: CornflowerBlue;

        }

        #btn_cancelaraadm{

width: 32%;

border: none;

padding: 15px;

color: white;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

}

#btn_cancelaraadm:hover{

background-color: CornflowerBlue;

}

#deletar_conta{

width: 32%;

border: none;

padding: 15px;

color: white;

font-size: clamp(1em, 1em + 0.5vw, 1.5em);

cursor: pointer;

border-radius: 10px;

background-color: RoyalBlue;

}

#deletar_conta:hover{

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



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<script>
  // função para quando clicar no btn mostrar a senha ou escondela -->
function mos_senha() {
	var inputpass = document.getElementById('senha')
	var btnmossenha = document.getElementById('mos_senha')

	if (inputpass.type === "password"){
		inputpass.setAttribute('type', 'text')
		btnmossenha.classList.replace('bi-eye-fill', 'bi-eye-slash-fill')
	}
	else{
		inputpass.setAttribute('type', 'password')
		btnmossenha.classList.replace('bi-eye-slash-fill', 'bi-eye-fill')
	}
	
}
</script>

<!-- Colocando os campos para a inserção de dados -->
<body>
<center>

<!-- Caixa em volta do form -->
<div class="box" align="left">
<form method="POST" name="f1" >

<!-- Borda do form -->
<fieldset  style="text-align: left;">

<!-- Legenda do form -->
<legend style="font-size:25px; font-weight: bold;">Dados</legend>
<br><br>

<div class="form-group input-group">
    	          <div class="input-group-prepend">
		            <span class="input-group-text"> <i class="fa fa-envelope" style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);"></i> </span>
		            </div>
                <input style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);" class="form-control" autofocus placeholder="E-Mail" type="email" name="email" id="email" onblur="validacaoEmail(f1.email)" maxlength="256" value="<?php echo $email;?>" required>
                <input type="hidden" value="" id="emailvalouinv" name="emailvalouinv"> 
                </div>
			          <div id="msgemail" style="text-align: center;"></div>
			          <br>

                <div class="form-group input-group">
		        <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-user" style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);"></i> </span>
		        </div>
            <input style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);" name="nome" maxlength="50" placeholder="Nome" required class="form-control" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" value="<?php echo $nome;?>" placeholder="Nome" type="text">
            </div>
            <br>

            <div class="form-group input-group">
    	          <div class="input-group-prepend">
		           <span class="input-group-text"> <i class="fa fa-lock" style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);"></i> </span>
	            	</div>
               <input style="font-size: clamp(1em, 1em + 0.5vw, 1.5em);" class="form-control" placeholder="Nova Senha" maxlength="50" name="senha" id="senha" value="" type="password" required>
                &nbsp;
	            	<span class="input-group-text" style="background-color: black; border:none; font-size: clamp(1em, 1em + 0.5vw, 1.5em);"><i class="bi bi-eye-fill" id="mos_senha" style="color:#6495ED" title='Mostrar Senha' onclick="mos_senha()"></i></span>
                </div>
                <br>

<!-- Botões de adicionar ou cancelar -->
<div>   
<button type="submit" id="btn_alteraadm" name="btn_alteraadm" onclick="alterar()" data-toggle="tooltip" data-placement="top">Alterar</button>
<button type="button" id="btn_cancelaraadm" name="btn_cancelaraadm" onclick="voltar()" data-toggle="tooltip" data-placement="top">Cancelar</button>

<!-- Input usado para passar dados do java para o php -->
<input type="hidden" value="" id="confexc" name="confexc">   
<input type="hidden" value="" id="confalt" name="confalt">

<!-- Botão para excluir a conta -->
<button onclick="excluirconta()" id="deletar_conta" data-toggle="tooltip" data-placement="top">Deletar conta</button>   

<!-- Fechando tags abertas -->
</form>
</div>
</div>
</fieldset>
</center>
<br><br>
</body>
</html>