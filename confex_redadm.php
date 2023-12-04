<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionando para a página index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

// Verificando se o código existe
if(!empty($_GET['codigo'])){

    // Obtendo o nome via sessão
    $nome = $_SESSION["nome_adm"];

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo ddados do adm a serem utilizados
    $dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");
    
    // Verificando se o usuário existe no bd
    if($dados->num_rows > 0){
      $dado=$dados->fetch_array();
    }else{

      // Voltando para o index, pois o usuario não existe
      header('location: index.php');
      exit;
    }

    // Obtendo o nivel do ADM
    $nivel = $dado['nivel'];

    // Verificando o nivel do adm
    if ($nivel == "admgeral" || $nivel == "adm" || $nivel == "corretor"){

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];
    }else{

      // Redirecionando para a página adm, pois o nivel não condiz com a pagina atual
      header('location: pagina_adm.php');
      exit;
    }
}else{

  // Redirecionando para a página adm, pois o código da prova não existe
  header('location: pagina_adm.php');
  exit;
}
}
?>

<!-- Inicando html -->
<!DOCTYPE HTML>
<html>
<!-- Definindo propriedades básicas da página, como acentuação e título -->
<meta charset="UTF-8">
<title>Confirmar Exclusão</title>

<!-- Fazendo a pergunta -->
<script>
    var resultado = confirm("Deseja realmete excluir essa Redação?")
    if (resultado == true) {
      location.href='deletar_redacaoadm.php?codigo=<?php echo $codigo; ?>';
	}
    else
    {
        location.href='readacoes_corrigir.php';
    }
</script>
</html>