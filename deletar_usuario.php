<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verifivcando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

    // Obtendo o nome do adm
    $nome = $_SESSION["nome_adm"];

    // Conectando com o banco de dados
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

    // Obtendo onivel do adm
    $nivel = $dado['nivel'];

    // Verificando o nivel do adm
    if ($nivel == "admgeral" || $nivel == "adm"){
    }
    else{

      // Redirecionando para a pagina adm, pois o nivel do adm não condiz com a pagina atual
      header('location: pagina_adm.php');
      exit;
    }

// Verificando se o nome do do usuario chegou via GET
if(!empty($_GET['nome'])){

    // Obtendo o código via GET do form anterior
    $nome = $_GET['nome'];

    // Selecionando os dados a serem deletados
    $sqlSelect = "SELECT *  FROM tabela_usuario WHERE nome='$nome'";
    $result = $conexao->query($sqlSelect);
    $dado_usu = $result->fetch_array();

    // Obtendo o código do usuário
    $codigo_usuario = $dado_usu['codigo_usuario'];

    if($result->num_rows > 0){

      // Deletando as respostas do usuario
      $del_per = mysqli_query($conexao, "DELETE FROM tabela_resposta_usuario WHERE codigo_usuario = $codigo_usuario;");

      // Deletando as provas realizadas
      $del_prorel = mysqli_query($conexao, "DELETE FROM tabela_provasrealizadas_usuario WHERE codigo_usuario = $codigo_usuario;");

      // Deletando as provas salvas pelo usuario
      $del_prosal = mysqli_query($conexao, "DELETE FROM tabela_provas_usuario WHERE codigo_usuario = $codigo_usuario;");

      // Verificando se o usuário escreveu alguma redação
      $qtred = mysqli_query($conexao, "SELECT * FROM tabela_redacoes WHERE codigo_usuario = $codigo_usuario and tipo = 1;");
      if($qtred->num_rows > 0){

      // Deletando o arquivo da redação se houver
      while ($dadored=$qtred->fetch_array()) { 

      // Definindo a pasta onde se encontra o arquivo
      $pastared = 'redacoes/';

      // Deletando o arquivo
      unlink($pastared.$dadored['texto_naocorrigido']);

      }
      }

      // Deletando as redações do usuario
      $del_red = mysqli_query($conexao, "DELETE FROM tabela_redacoes WHERE codigo_usuario = $codigo_usuario;");

      // Deletando a avaliação do site
      $delava = mysqli_query($conexao, "DELETE FROM tabela_avaliacoes WHERE nome_usuario = '$nome' and tipo = 2;");

      // Deletando o usuario
      $sqlDelete = "DELETE FROM tabela_usuario WHERE nome='$nome'";
      $resultDelete = $conexao->query($sqlDelete);
    }
}

// Voltando para a pagina mostrar usuarios
header('Location: mostrar_usuarios.php');
exit;
}
?>