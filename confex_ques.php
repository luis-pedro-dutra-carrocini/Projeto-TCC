<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_adm"]))
{

  // Redirecionando para a página index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

// Verificando se o código exite
if(!empty($_GET['codigo'])){

    // Obtendo o nome via sessão
    $nome = $_SESSION["nome_adm"];

    // Conectando com o banco de dados
    include_once('conexao.php');

    // Obtendo os dados do amd a serem utilizados
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
    
    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];
    }else{

      // Redirecionando para a pagina adm, pois o nivel não codiz com a pagina atual
      header('location: pagina_adm.php');
      exit;
    }
}else{

  // Redirecionando para a mostrar questões, pois o código nã existe
  header('location: mostrar_questoes.php');
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
    var resultado = confirm("Deseja realmete excluir essa Questão?")
    if (resultado == true) {
      location.href='deletar_questao.php?codigo=<?php echo $codigo; ?>';
	}
    else
    {
        location.href='mostrar_questoes.php';
    }
</script>
</html>