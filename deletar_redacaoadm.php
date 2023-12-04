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

// Verificando se o codigo chegou via GET
if(!empty($_GET['codigo'])){

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo o nome do adm
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

    // Obtendo o nivel do adm
    $nivel = $dado['nivel'];

    // Obtendo o codigo do adm
    $codigo_adm = $dado['codigo'];

    // Verificando o nivel do adm
    if ($nivel == "admgeral" || $nivel == "adm" || $nivel == "corretor"){
    }
    else{

      // redirecionando para a pagina adm, pois o nivel do adm não condiz com a pagina atual
      header('location: pagina_adm.php');
      exit;
    }

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_redacoes WHERE codigo=$codigo";
    $result = $conexao->query($sqlSelect);

    // Verificando se a redação realmente existe
    if($result->num_rows > 0){

        // Obtendo os dados da redação
        $dados_red = $result->fetch_array();

        // Verificando a situação da redação
        // Se ele foi corrigida
        if ($dados_red['situacao'] == 1){

        // Se o adm atual é igual ao adm que corriguiu a redação
        if ($dados_red['codigo_adm'] == $codigo_adm){

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
        }else{

        // Pastas de origem
        $pasta = 'redacoes/';

        // Deletando o arquivo
        unlink($pasta.$dados_red['texto_naocorrigido']);

        // Deletando os dados do bd
        $sqlDelete = "DELETE FROM tabela_redacoes WHERE codigo=$codigo";
        $resultDelete = $conexao->query($sqlDelete);
        }
    }
}

// Voltando para a pagina corrigir redações
header('Location: readacoes_corrigir.php');
exit;
}
?>