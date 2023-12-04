<!-- Iniciando PHP -->
<?php

// iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"])){

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo o nome do adm
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

    // Obtendo o nivel do adm
    $nivel = $dado['nivel'];

    // Verificando o nivel do adm
    // tem que ser ADM ou ADM Geral
    if ($nivel == "admgeral" || $nivel == "adm"){
    }
    else{

      // Redirecionando para a pagina adm, pois o nivel do adm é incompatival com a pagina atual
      header('location: pagina_adm.php');
      exit;
    }
}

// Verificando se o codigo da questão chegou via GET
if(!empty($_GET['codigo'])){

    // obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];

    // Selecionando os valores a serem deletados do bd
    // Pergunta
    $sqlSelect = "SELECT *  FROM tabela_pergunta WHERE codigo_pergunta=$codigo";
    $result = $conexao->query($sqlSelect);
    $dado=$result->fetch_array();

    // Letra A
    $sqlSelectresa = "SELECT *  FROM tabela_resposta WHERE codigo_pergunta=$codigo and letra='a'";
    $resultresa = $conexao->query($sqlSelectresa);
    $dadoresa=$resultresa->fetch_array();

    // Letra B
    $sqlSelectresb = "SELECT *  FROM tabela_resposta WHERE codigo_pergunta=$codigo and letra='b'";
    $resultresb = $conexao->query($sqlSelectresb);
    $dadoresb=$resultresb->fetch_array();
    
    // Letra C
    $sqlSelectresc = "SELECT *  FROM tabela_resposta WHERE codigo_pergunta=$codigo and letra='c'";
    $resultresc = $conexao->query($sqlSelectresc);
    $dadoresc=$resultresc->fetch_array();
    
    // Letra D
    $sqlSelectresd = "SELECT *  FROM tabela_resposta WHERE codigo_pergunta=$codigo and letra='d'";
    $resultresd = $conexao->query($sqlSelectresd);
    $dadoresd=$resultresd->fetch_array();
    
    // Letra E
    $sqlSelectrese = "SELECT *  FROM tabela_resposta WHERE codigo_pergunta=$codigo and letra='e'";
    $resultrese = $conexao->query($sqlSelectrese);
    $dadorese=$resultrese->fetch_array();

    // Verificando se a pergunta realmente existe
    if($result->num_rows > 0){

        // Deletando as imagens da pasta de img_res e uploads 
        // Caso contenham
        // Pastas de origem
        $pasta = 'uploads/';
        $pastares = 'img_res/';

        // Deletando imagem da pergunta
        unlink($pasta.$dado['imagem']);

        // Deletando imagem da letra A
        unlink($pastares.$dadoresa['alternativa']);

        // Deletando imagem da letra B
        unlink($pastares.$dadoresb['alternativa']);

        // Deletando imagem da letra C
        unlink($pastares.$dadoresc['alternativa']);

        // Deletando imagem da letra D
        unlink($pastares.$dadoresd['alternativa']);

        // Deletando imagem da letra E
        unlink($pastares.$dadorese['alternativa']);

        // Deletando os dados da tabela pergunta
        $sqlDeleteRes = "DELETE FROM tabela_resposta WHERE codigo_pergunta='$codigo'";
        $sqlDeleteRes = $conexao->query($sqlDeleteRes);

        // Deletando os dados da tabela respostas referente a pergunta
        $sqlDeletePer = "DELETE FROM tabela_pergunta WHERE codigo_pergunta='$codigo'";
        $sqlDeletePer = $conexao->query($sqlDeletePer);
    }
}

// Voltando para a pagina mostrar questões
header('Location: mostrar_questoes.php');
exit;
?>