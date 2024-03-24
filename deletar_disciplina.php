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

    $sqlSelect = "SELECT *  FROM tabela_disciplina WHERE codigo_disciplina=$codigo;";

    $result = $conexao->query($sqlSelect);

    $dadoprova=$result->fetch_array();



    // Verificando se a disciplina realmente existe no banco de dados

    if($result->num_rows > 0){

    $sqlSelect1 = "SELECT *  FROM tabela_pergunta WHERE codigo_disciplina=$codigo;";
    $result1 = $conexao->query($sqlSelect1);

    // Verificando se ha questões cadastradas com ela
    if($result1->num_rows < 1){
        // Deletando a prova
        $sqlDelete = "DELETE FROM tabela_disciplina WHERE codigo_disciplina=$codigo;";
        $resultDelete = $conexao->query($sqlDelete);
        header('location: mostrar_disciplinas.php');
        exit;
    }
    }else{

      // redirecionando para a pagina provas adm, pois a prova não existe
      header('location: mostrar_disciplinas.php');
      exit;
    }
}

// Voltando para a pagina prova adm
header('Location: mostrar_disciplinas.php');
exit;

}else{
// Voltando para a pagina prova adm
header('Location: mostrar_disciplinas.php');
}
}
?>