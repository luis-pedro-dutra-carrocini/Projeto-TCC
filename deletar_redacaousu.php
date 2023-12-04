<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){

  // Redirecionando para a pagina index, pis sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

// Verificando se o codigo chegou via GET
if(!empty($_GET['codigo'])){

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Verificando se o usuario é recente ou antigo
    if(isset($_SESSION["senha_usuario"])){

      // Obtendo o nome do usuario
      $nome_usuario = $_SESSION["nome_usuario"];
    }
    elseif(isset($_SESSION["nome_cad"])){

      // Obtendo o nome do usuario
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

// Obtendo o código via GET do form anterior
$codigo = $_GET['codigo'];

// Selecionando os dados a serem deletados
$sqlSelect = "SELECT *  FROM tabela_redacoes WHERE (codigo=$codigo and codigo_usuario=$codigo_usuario)";
$result = $conexao->query($sqlSelect);

// Verificando se a redação realmete existe
if($result->num_rows > 0){

    // Deletando o aquivo
    // Pastas de origem
    $pasta = 'redacoes/';

    // Deletando o arquivo
    unlink($pasta.$dados_red['texto_naocorrigido']);

    // Deletando o arquivo
    unlink($pasta.$dados_red['texto_corrigido']);

    // Deletando os dados do bd
    $sqlDelete = "DELETE FROM tabela_redacoes WHERE codigo=$codigo";
    $resultDelete = $conexao->query($sqlDelete);
  }
}

// Voltando para a pagina minhas redações
header('Location: minhas_redacoesusu.php');
exit;
}
?>