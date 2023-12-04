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
}
else
{

  // OBtendo o nome do ADM via sessão
  $nome = $_SESSION["nome_adm"];

  // Conectando com o banco de dados
  include_once('conexao.php');

  // Obtendo os dados do ADM para serem usados
  $dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");
  
  // Verificando se o usuário existe no bd
  if($dados->num_rows > 0){
  $dado=$dados->fetch_array();
  }else{

    // Voltando para o index, pois o usuario não existe
    header('location: index.php');
    exit;
  }

  // Obtendo nível do ADM
  $nivel = $dado['nivel'];

  // verificando o nível do ADM
  // SE o ADM for ADM Geral ou somente ADM
  if ($nivel == "admgeral" || $nivel == "adm"){

    // Verificando se o codigo adm existe
    if(!empty($_GET['nome'])){

    // Obtendo o código via GET do form anterior
    $nome = $_GET['nome'];
    }else{

    // Redirecionando para a página mostar professores, pois o código do adm não existe
    header('location: mostrar_professores.php');
    exit;
    }
  }else{

    // Redirecionando para a página adm, pois o nivel do adm não condiz com a página atual
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
    var resultado = confirm("Deseja realmete excluir esse Professor?")
    if (resultado == true) {
      location.href='deletar_adm.php?nome=<?php echo $nome; ?>';
	}
    else
    {
        location.href='mostrar_professores.php';
    }
</script>
</html>