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

    // Obtendo nome via sessão
    $nome_usuario = $_SESSION["nome_usuario"];
  }
  elseif(isset($_SESSION["nome_cad"])){

    // Obtendo nome via sessão
    $nome_usuario = $_SESSION["nome_cad"];
  }

  // Verificando se o código da prova não esta vazio
  if(!empty($_GET['codigo'])){

    // Obtendo o código via GET do form anterior
    $codigo = $_GET['codigo'];
  }else{

    // Redirecionando para a página usuarios, pois não exite o código da prova
    header('location: pagina_usuarios.php');
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
    var resultado = confirm("Deseja realmete excluir essa Prova?")
    if (resultado == true) {
      location.href='deletar_provausu.php?codigo=<?php echo $codigo; ?>';
	}
    else
    {
        location.href='minhas_provas_Usuario.php';
    }
</script>
</html>