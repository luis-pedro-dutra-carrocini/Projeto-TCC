<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"])){

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

// Verificando se o código da prova chegou via GET
if(!empty($_GET['codigo'])){

    // Obtendo o nome do adm
    $nome = $_SESSION["nome_adm"];

    // Conecatando com o banco de dados
    include_once('conexao.php');

    // Obtendo os dados do adm a serem utilizadaos
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
    $nivel = $dado['nivel'];

    // Verificando o nivel do adm
    if ($nivel == "admgeral" || $nivel == "adm"){

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_provas_usuario WHERE codigo=$codigo and tipoprova = 1";
    $result = $conexao->query($sqlSelect);
    $dadoprova=$result->fetch_array();

    // Verificando se a prova realmete existe
    if($result->num_rows > 0){

        // Deletando os dados do bd
        $sqlDelete = "DELETE FROM tabela_provas_usuario WHERE codigo=$codigo and tipoprova = 1";
        $resultDelete = $conexao->query($sqlDelete);
    }else{

      // Redirecionand para a pagina provas usuario, pois a prova não existe
      header('location: provasusu_adm.php');
      exit;
    }
}

// Redirecionand para a pagina adm, pois a prova o nivel é imcompativel com a pagina atual
header('location: pagina_adm.php');
exit;
}

// Voltando para a pagina provas usuario
header('Location: provasusu_adm.php');
exit;
}
?>