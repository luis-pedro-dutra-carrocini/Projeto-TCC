<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"]))
{

  // Redirecionando para a página index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Verificando se o usuário é recente ou antigo
  if(isset($_SESSION["senha_usuario"])){

    // Obtendo o nome via sessão
    $nome_usuario = $_SESSION["nome_usuario"];
  }
  elseif(isset($_SESSION["nome_cad"])){

    // Obtendo o nome via sessão
    $nome_usuario = $_SESSION["nome_cad"];
  }


  if(!empty($_GET['codigo'])){

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];
  }else{

    // Redirecionando para a página minhas redações, pois o código da redação não existe
    header('location: minhas_redacoesusu.php');
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
      location.href='deletar_redacaousu.php?codigo=<?php echo $codigo; ?>';
	}
    else
    {
        location.href='minhas_redacoesusu.php';
    }
</script>
</html>