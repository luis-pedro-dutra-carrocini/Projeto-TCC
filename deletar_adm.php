<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

    // Obtendo o nome do adm via sessão
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
    $nivel = $dado['nivel'];

    // Verificando o nivel do adm
    if ($nivel == "admgeral" || $nivel == "adm"){
    }
    else{

      // Redirecionando para a pagina adm, pois o nivel de adm não condiz com a pagina atual
      header('location: pagina_adm.php');
      exit;
}

// Verificando se o nome existe
if(!empty($_GET['nome'])){

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo o código via GET do form anterior
    $nome = $_GET['nome'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_adm WHERE nome='$nome'";
    $result = $conexao->query($sqlSelect);
    $dado_adm = $result->fetch_array();

    // Obtendo o codigo do adm
    $codigo_adm = $dado_adm['codigo'];

    // verificando o nivel do adm a ser deletado
    // se for diferren de ADM Geral
    if ($dado_adm['nivel'] != "admgeral"){

    // E se for diferente do nevel do adm que esta deletando
    if ($dado_adm['nivel'] != $nivel){

    // Verificando se o adm realmente existe no banco de dados
    if($result->num_rows > 0){

        // Deletando as provas do adm
        $del_per = mysqli_query($conexao, "DELETE FROM tabela_provas_adm WHERE codigo_adm = $codigo_adm;");

        // Alterando a redações corrigidas pelo adm
        $alt_red = mysqli_query($conexao, "UPDATE tabela_redacoes SET codigo_adm = 1 WHERE codigo_adm = $codigo_adm;");

        // Deletando a avaliação do site
        $delava = mysqli_query($conexao, "DELETE FROM tabela_avaliacoes WHERE nome_usuario = '$nome' and tipo = 1;");

        // Deletando o adm
        $sqlDelete = "DELETE FROM tabela_adm WHERE nome='$nome'";
        $resultDelete = $conexao->query($sqlDelete);
    }

    }else{

        // Redirecionando para a pagina mostrar professores pois o nivel do adm é inferior
        header('Location: mostrar_professores.php');
        exit;
    }
}else{

    // Redirecionando para a pagina mostrar professores pois o nivel do adm é inferior
    header('Location: mostrar_professores.php');
    exit;
}
}

// Redirecionando para a pagina mostrar professores pois tudo ja esta feito
header('Location: mostrar_professores.php');
exit;
}
?>