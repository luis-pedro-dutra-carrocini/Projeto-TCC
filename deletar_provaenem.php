<!-- Iniciando PHP -->

<?php



// Iniciando sessão

session_start();



// Verificando se a sessão foi iniciada

if(!isset($_SESSION["senha_adm"]))

{



  // Redirecionando para a pagina index pois a sessão não foi iniciada

  header('location: index.php');

  exit;

}else{



// verificando se o codigo chegou via GET

if(!empty($_GET['codigo'])){



    // Obtendo o nome do adm via sessão

    $nome = $_SESSION["nome_adm"];



    // Cenectando com o banco de dados

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

    // Se for adm ou ADM Geral

    if ($nivel == "admgeral" || $nivel == "adm"){



    // Obtendo o código via GET do form anterior

    $codigo = $_GET['codigo'];



    // Selecionando os dados a serem deletados

    $sqlSelect = "SELECT *  FROM tabela_provasenem WHERE codigo=$codigo;";

    $result = $conexao->query($sqlSelect);

    $dadoprova=$result->fetch_array();



    // Verificando se a prova realmente existe no banco de dados

    if($result->num_rows > 0){
        // Deletando a prova
        $sqlDelete = "DELETE FROM tabela_provasenem WHERE codigo=$codigo;";
        $resultDelete = $conexao->query($sqlDelete);
    }else{

      // redirecionando para a pagina provas adm, pois a prova não existe
      header('location: provas_cadastradas.php');
      exit;
    }
}

// Voltando para a pagina prova adm
header('Location: provas_cadastradas.php');
exit;

}else{
// Voltando para a pagina prova adm
header('Location: provas_cadastradas.php');
}
}
?>