<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionado para a pagina index pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Conectando com o banco de dados
  include_once('conexao.php');

  // Obtendo o nome do adm via sessão
  $nome_adm = $_SESSION["nome_adm"];

  // Obtendo os dados do adm a serem utilizados
  $slcadm = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome_adm';");

  // Verificando se o usuário existe no bd
  if($slcadm->num_rows > 0){
    $dadoadm=$slcadm->fetch_array();
  }else{

    // Voltando para o index, pois o usuario não existe
    header('location: index.php');
    exit;
  }

  // Obtendo o codigo do adm
  $codigo_adm = $dadoadm['codigo'];

// Verificando se o codigo chegou via GET
if(!empty($_GET['codigo'])){

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_provas_adm WHERE codigo=$codigo and codigo_adm = $codigo_adm";
    $result = $conexao->query($sqlSelect);

    // verificando se a prova realmente existe
    if($result->num_rows > 0){

        // Deletando os dados do bd
        $sqlDelete = "DELETE FROM tabela_provas_adm WHERE codigo=$codigo";
        $resultDelete = $conexao->query($sqlDelete);
    }
}

// Voltando para a pagina provas geradas adm
header('Location: provas_geradasadm.php');
exit;
}
?>