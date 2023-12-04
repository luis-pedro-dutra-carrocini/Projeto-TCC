<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão existe
if(!isset($_SESSION["senha_adm"]))
{

  // redirecionando para a pagina index, pois a sessão não existe
  header('location: index.php');
  exit;
}else{

// verificando se o código e tipo do tema existe
if(isset($_GET['codigo']) && isset($_GET['tipo'])){

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo o nome do adm via sessão
    $nome = $_SESSION["nome_adm"];

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

    // obtendo o nivel do adm
    $nivel = $dado['nivel'];

    // Obtendo o codigo do adm
    $codigo_adm = $dado['codigo'];

    // Verificando o nivel do adm
    if ($nivel == "admgeral" || $nivel == "adm" || $nivel == "corretor"){
    }
    else{

      // Redirecionando para a pagina adm, pois o nivel do adm não condiz com a página
      header('location: pagina_adm.php');
      exit;
    }

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Obtendo o tipo do tema
    $tipo = $_GET['tipo'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_temasredacoes WHERE codigo=$codigo";
    $result = $conexao->query($sqlSelect);

    // Verificando se o tema realmente existe no banco de dados
    if($result->num_rows > 0)
    {

        // Deletando o tema
        $sqlDelete = "DELETE FROM tabela_temasredacoes WHERE codigo=$codigo";
        $resultDelete = $conexao->query($sqlDelete);

        // Redirecionando para a pagina correta
        if ($tipo == 0){
        header('location: temas_enem.php');
        exit;
        }elseif ($tipo == 1){
        header('location: temas_professores.php');
        exit;
        }elseif ($tipo == 2){
        header('location: temas_usuarios.php');
        exit;
        }
    }
}else{

// Redirecionando para a pagina adm, pois o código e tipo não existem
header('Location: pagina_adm.php');
exit;
}
}
?>