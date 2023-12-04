<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conectando com o banco de dados
include_once ('conexao.php');

// verifiacndo se a sessão foi iniciada
if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){

  // redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Verificando se o usuário é antigo ou recente
  // Usuário antigo
  if(isset($_SESSION["senha_usuario"])){

    // Obtendo o nome do usuário via sessão
    $nome_usuario = $_SESSION["nome_usuario"];

  // Usuário recente
  }elseif(isset($_SESSION["nome_cad"])){

    // Obtendo o nome do usuário via sessão
    $nome_usuario = $_SESSION["nome_cad"];
  }

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

// verificando se o código da prova chegou via GET
if(!empty($_GET['codigo'])){

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_provas_usuario WHERE codigo=$codigo and codigo_usuario = $codigo_usuario";
    $result = $conexao->query($sqlSelect);

    // Verificando se a prova realmente existe no banco de dados
    if($result->num_rows > 0){

        // Deletando os dados do bd
        $sqlDelete = "DELETE FROM tabela_provas_usuario WHERE codigo='$codigo'";
        $resultDelete = $conexao->query($sqlDelete);
    }
}

// Voltando para a página minhas provas usuario
header('Location: minhas_provas_Usuario.php');
exit;
}
?>