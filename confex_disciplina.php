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



// Verificando se o código da prova do professor existe

if(!empty($_GET['codigo']))

{



    // Obtendo o código via GET do form anterior

    $codigo = $_GET['codigo'];

}else{



    // Redirecionando para a página adm, pois o código do adm não existe

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

    var resultado = confirm("Deseja realmete excluir essa Disciplina?")

    if (resultado == true) {

      location.href='deletar_disciplina.php?codigo=<?php echo $codigo; ?>';

	}

    else

    {

        location.href='mostrar_disciplinas.php';

    }

</script>

</html>