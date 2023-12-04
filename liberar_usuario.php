<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();
// Verificando se sessão foi iniciada
// Ou seja teve senha e email válidos no form anterior
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionando para a pagina index, pois a sessão não foi inicida
  header('location: index.php');
  exit;
}else{

    // Obtendo o nome do adm
    $nome = $_SESSION["nome_adm"];

    // Conectando com o banco de dados
    include_once('conexao.php');

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
    if ($nivel == "admgeral" || $nivel == "adm"){
    }
    else{

      // Redirecionando para a pagina adm, pois o nivel so adm não condiz com a pagina
      header('location: pagina_adm.php');
      exit;
    }
    
// Verificando se o nome chegou via GET
if(!empty($_GET['nome'])){

    // Obtendo o nome via GET do form anterior
    $nome = $_GET['nome'];

    // Obtendo os dados do usuario
    $sqlSelect = "SELECT *  FROM tabela_usuarios_banidos WHERE nome='$nome'";
    $result = $conexao->query($sqlSelect);

    // Verificando se o usuario realmente existe
    if($result->num_rows > 0){

    // Deletando os dados da tabela usuarios banidos
    $sqlDelete = "DELETE FROM tabela_usuarios_banidos WHERE nome='$nome'";
    $resultDelete = $conexao->query($sqlDelete);

    // Indo para a pagina mostrar usuarios banidos
    header('location: mostrar_usuarios_banidos.php');
    exit;
    }
    else{

      // Redirecioando para a pagina mostar usuarios, pois o usauario banido não existe
      header('location: mostrar_usuarios_banidos.php');
      exit;
    }
}else{

    // Voltando para a pagina usuarios banidos
    header('location: mostrar_usuarios_banidos.php');
    exit;
}
}
?>