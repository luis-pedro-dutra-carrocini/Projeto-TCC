<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Verificando se a sessão foi iniciada
if(!isset($_SESSION["senha_usuario"]) && !isset($_SESSION["nome_cad"])){

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
  header('location: index.php');
  exit;
}else{

  // Verificando se o usuario é antigo ou recente
  // Antigo
  if(isset($_SESSION["senha_usuario"])){

    // Obtendo o nome do usuario
    $nome_usuario = $_SESSION["nome_usuario"];

    // Obtendo a senha do usuario
    $senha_usuario = $_SESSION["senha_usuario"];
  }

  // Recente
  elseif(isset($_SESSION["nome_cad"])){

    // Obtendo o nome do usuario
    $nome_usuario = $_SESSION["nome_cad"];

    // Obtendo a senha do usuario
    $senha_usuario = $_SESSION["senha_cad"];
  }

  // Conecatando com o banco de dados
  include_once('conexao.php');

  // Selecionando os dados do usuario
  $slusu = mysqli_query($conexao, "SELECT * FROM tabela_usuario where nome = '$nome_usuario';");

// Verificando se o usuário existe no bd
if($slusu->num_rows > 0){
  $dados_usu = mysqli_fetch_assoc($slusu);
  }else{

    // Voltando para o index, pois o usuario não existe
    header('location: index.php');
    exit;
  }

  // Obtendo o codigo do usuario
  $codigo_usuario = $dados_usu['codigo_usuario'];
}

// Guardando o dia e hora em uma variavel
date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y/m/d');
$hora = date('H:i:s');

// Salvando a prova na tabela provas usuario
// Se foi salva com um nome
if (isset($_POST['btn_salvar'])){
    // Obtendo o nome da prova
    $nome_prova = $_POST['nome_prova'];

    // Definindo a quantidade de perguntas
    $qtperguntas = $_SESSION['qtperguntas'];

    // Definindo o codigo de cada pergunta
    $codper1 = $_SESSION['codper1'];
    $codper2 = $_SESSION['codper2'];
    $codper3 = $_SESSION['codper3'];
    $codper4 = $_SESSION['codper4'];
    $codper5 = $_SESSION['codper5'];

    if ($qtperguntas > 5){
    $codper6 = $_SESSION['codper6'];
    $codper7 = $_SESSION['codper7'];
    $codper8 = $_SESSION['codper8'];
    $codper9 = $_SESSION['codper9'];
    $codper10 = $_SESSION['codper10'];
    }

    if ($qtperguntas > 10){
    $codper11 = $_SESSION['codper11'];
    $codper12 = $_SESSION['codper12'];
    $codper13 = $_SESSION['codper13'];
    $codper14 = $_SESSION['codper14'];
    $codper15 = $_SESSION['codper15'];
    }

    if ($qtperguntas > 15){
    $codper16 = $_SESSION['codper16'];
    $codper17 = $_SESSION['codper17'];
    $codper18 = $_SESSION['codper18'];
    $codper19 = $_SESSION['codper19'];
    $codper20 = $_SESSION['codper20'];
    }

    if ($qtperguntas > 20){
    $codper21 = $_SESSION['codper21'];
    $codper22 = $_SESSION['codper22'];
    $codper23 = $_SESSION['codper23'];
    $codper24 = $_SESSION['codper24'];
    $codper25 = $_SESSION['codper25'];
    }

    if ($qtperguntas > 25){
    $codper26 = $_SESSION['codper26'];
    $codper27 = $_SESSION['codper27'];
    $codper28 = $_SESSION['codper28'];
    $codper29 = $_SESSION['codper29'];
    $codper30 = $_SESSION['codper30'];
    }

    if ($qtperguntas > 30){
    $codper31 = $_SESSION['codper31'];
    $codper32 = $_SESSION['codper32'];
    $codper33 = $_SESSION['codper33'];
    $codper34 = $_SESSION['codper34'];
    $codper35 = $_SESSION['codper35'];
    }

    if ($qtperguntas > 35){
    $codper36 = $_SESSION['codper36'];
    $codper37 = $_SESSION['codper37'];
    $codper38 = $_SESSION['codper38'];
    $codper39 = $_SESSION['codper39'];
    $codper40 = $_SESSION['codper40'];
    }

    if ($qtperguntas > 40){
    $codper41 = $_SESSION['codper41'];
    $codper42 = $_SESSION['codper42'];
    $codper43 = $_SESSION['codper43'];
    $codper44 = $_SESSION['codper44'];
    $codper45 = $_SESSION['codper45'];
    }

    if ($qtperguntas > 45){
    $codper46 = $_SESSION['codper46'];
    $codper47 = $_SESSION['codper47'];
    $codper48 = $_SESSION['codper48'];
    $codper49 = $_SESSION['codper49'];
    $codper50 = $_SESSION['codper50'];
    }

    if ($qtperguntas > 50){
    $codper51 = $_SESSION['codper51'];
    $codper52 = $_SESSION['codper52'];
    $codper53 = $_SESSION['codper53'];
    $codper54 = $_SESSION['codper54'];
    $codper55 = $_SESSION['codper55'];
    }

    if ($qtperguntas > 55){
    $codper56 = $_SESSION['codper56'];
    $codper57 = $_SESSION['codper57'];
    $codper58 = $_SESSION['codper58'];
    $codper59 = $_SESSION['codper59'];
    $codper60 = $_SESSION['codper60'];
    }

    if ($qtperguntas > 60){
    $codper61 = $_SESSION['codper61'];
    $codper62 = $_SESSION['codper62'];
    $codper63 = $_SESSION['codper63'];
    $codper64 = $_SESSION['codper64'];
    $codper65 = $_SESSION['codper65'];
    }

    if ($qtperguntas > 65){
    $codper66 = $_SESSION['codper66'];
    $codper67 = $_SESSION['codper67'];
    $codper68 = $_SESSION['codper68'];
    $codper69 = $_SESSION['codper69'];
    $codper70 = $_SESSION['codper70'];
    }

    if ($qtperguntas > 70){
    $codper71 = $_SESSION['codper71'];
    $codper72 = $_SESSION['codper72'];
    $codper73 = $_SESSION['codper73'];
    $codper74 = $_SESSION['codper74'];
    $codper75 = $_SESSION['codper75'];
    }

    if ($qtperguntas > 75){
    $codper76 = $_SESSION['codper76'];
    $codper77 = $_SESSION['codper77'];
    $codper78 = $_SESSION['codper78'];
    $codper79 = $_SESSION['codper79'];
    $codper80 = $_SESSION['codper80'];
    }

    if ($qtperguntas > 80){
    $codper81 = $_SESSION['codper81'];
    $codper82 = $_SESSION['codper82'];
    $codper83 = $_SESSION['codper83'];
    $codper84 = $_SESSION['codper84'];
    $codper85 = $_SESSION['codper85'];
    }

    if ($qtperguntas > 85){
    $codper86 = $_SESSION['codper86'];
    $codper87 = $_SESSION['codper87'];
    $codper88 = $_SESSION['codper88'];
    $codper89 = $_SESSION['codper89'];
    $codper90 = $_SESSION['codper90'];
    }


    // Verificando o tipo da prova
    if (isset($_POST['chesalvar'])){
      $tipoprova = 1;
    }
    else{
      $tipoprova = 0;
    }

    // Verificando quantas perguntas e quais dvem ser salvas
    // De acordo com a quantidade de perguntas escolhida
    if ($qtperguntas > 85){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
      , codper69, codper70, codper71, codper72, codper73, codper74, codper75, codper76, codper77, codper78, codper79
      , codper80, codper81, codper82, codper83, codper84, codper85, codper86, codper87, codper88, codper89, codper90,tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
      $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
      $codper71,$codper72,$codper73,$codper74,$codper75,$codper76,$codper77,$codper78,$codper79,
      $codper80,$codper81,$codper82,$codper83,$codper84,$codper85,$codper86,$codper87,$codper88,
      $codper89,$codper90,$tipoprova);");
    }
    elseif ($qtperguntas > 80){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
      , codper69, codper70, codper71, codper72, codper73, codper74, codper75, codper76, codper77, codper78, codper79
      , codper80, codper81, codper82, codper83, codper84, codper85,tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
      $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
      $codper71,$codper72,$codper73,$codper74,$codper75,$codper76,$codper77,$codper78,$codper79,
      $codper80,$codper81,$codper82,$codper83,$codper84,$codper85,$tipoprova);");
    }
    elseif ($qtperguntas > 75){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
      , codper69, codper70, codper71, codper72, codper73, codper74, codper75, codper76, codper77, codper78, codper79
      , codper80, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
      $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
      $codper71,$codper72,$codper73,$codper74,$codper75,$codper76,$codper77,$codper78,$codper79,
      $codper80,$tipoprova);");
    }
    elseif ($qtperguntas > 70){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
      , codper69, codper70, codper71, codper72, codper73, codper74, codper75, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
      $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
      $codper71,$codper72,$codper73,$codper74,$codper75,$tipoprova);");
    }
    elseif ($qtperguntas > 65){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
      , codper69, codper70, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
      $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,$tipoprova);");
    }
    elseif ($qtperguntas > 60){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
      $codper62,$codper63,$codper64,$codper65,$tipoprova);");
    }
    elseif ($qtperguntas > 55){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
      , codper58, codper59, codper60, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$tipoprova);");
    }
    elseif ($qtperguntas > 50){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
      $codper53,$codper54,$codper55,$tipoprova);");
    }
    elseif ($qtperguntas > 45){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
      , codper47, codper48, codper49, codper50, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$tipoprova);");
    }
    elseif ($qtperguntas > 40){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
      $codper44,$codper45,$tipoprova);");
    }
    elseif ($qtperguntas > 35){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
      , codper36, codper37, codper38, codper39, codper40, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$tipoprova);");
    }
    elseif ($qtperguntas > 30){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
      $codper35,$tipoprova);");
    }
    elseif ($qtperguntas > 25){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, codper26, codper27, codper28, codper29, codper30, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
      $codper26,$codper27,$codper28,$codper29,$codper30,$tipoprova);");
    }
    elseif ($qtperguntas > 20){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
      , codper25, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,$tipoprova);");
    }
    elseif ($qtperguntas > 15){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, codper16, codper17, codper18, codper19, codper20, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
      $codper17,$codper18,$codper19,$codper20, $tipoprova);");
    }
    elseif ($qtperguntas > 10){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
      , codper14, codper15, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$tipoprova);");
    }
    elseif ($qtperguntas > 5){
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
      $codper8,$codper9,$codper10, $tipoprova);");
    }
    else{
      $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
      codper2, codper3, codper4, codper5, tipoprova) 
      values($codigo_usuario,$qtperguntas,'".addslashes($nome_prova)."',$codper1,$codper2,$codper3,$codper4,$codper5,$tipoprova);");
    }
  
    // Destrundo sessão para esquecer os dados da prova
    // Para não haver conflitos futuros
    session_destroy();

    // reinicinado a sessão
    session_start();

    // Passando os dados do usario para a sessão novamente
    $_SESSION['nome_usuario'] = $nome_usuario;
    $_SESSION["senha_usuario"] = $senha_usuario;

    // Emitindo mensagem de sucesso
    $script = "<script>alert('Prova salva com Sucesso');location.href='minhas_provas_Usuario.php';</script>";
    echo $script;
    exit;

}

// Se foi salva quando o simulado estava em execução
elseif(isset($_SESSION['codper1'])){

// definindo o nome da prova
$nome_prova = "Prova " . $hoje . " - " . $hora;

// Definindo a quantidade de perguntas
$qtperguntas = $_SESSION['qtperguntas'];

// Definindo o codigo de cada pergunta
$codper1 = $_SESSION['codper1'];
$codper2 = $_SESSION['codper2'];
$codper3 = $_SESSION['codper3'];
$codper4 = $_SESSION['codper4'];
$codper5 = $_SESSION['codper5'];

if ($qtperguntas > 5){
$codper6 = $_SESSION['codper6'];
$codper7 = $_SESSION['codper7'];
$codper8 = $_SESSION['codper8'];
$codper9 = $_SESSION['codper9'];
$codper10 = $_SESSION['codper10'];
}

if ($qtperguntas > 10){
$codper11 = $_SESSION['codper11'];
$codper12 = $_SESSION['codper12'];
$codper13 = $_SESSION['codper13'];
$codper14 = $_SESSION['codper14'];
$codper15 = $_SESSION['codper15'];
}

if ($qtperguntas > 15){
$codper16 = $_SESSION['codper16'];
$codper17 = $_SESSION['codper17'];
$codper18 = $_SESSION['codper18'];
$codper19 = $_SESSION['codper19'];
$codper20 = $_SESSION['codper20'];
}

if ($qtperguntas > 20){
$codper21 = $_SESSION['codper21'];
$codper22 = $_SESSION['codper22'];
$codper23 = $_SESSION['codper23'];
$codper24 = $_SESSION['codper24'];
$codper25 = $_SESSION['codper25'];
}

if ($qtperguntas > 25){
$codper26 = $_SESSION['codper26'];
$codper27 = $_SESSION['codper27'];
$codper28 = $_SESSION['codper28'];
$codper29 = $_SESSION['codper29'];
$codper30 = $_SESSION['codper30'];
}

if ($qtperguntas > 30){
$codper31 = $_SESSION['codper31'];
$codper32 = $_SESSION['codper32'];
$codper33 = $_SESSION['codper33'];
$codper34 = $_SESSION['codper34'];
$codper35 = $_SESSION['codper35'];
}

if ($qtperguntas > 35){
$codper36 = $_SESSION['codper36'];
$codper37 = $_SESSION['codper37'];
$codper38 = $_SESSION['codper38'];
$codper39 = $_SESSION['codper39'];
$codper40 = $_SESSION['codper40'];
}

if ($qtperguntas > 40){
$codper41 = $_SESSION['codper41'];
$codper42 = $_SESSION['codper42'];
$codper43 = $_SESSION['codper43'];
$codper44 = $_SESSION['codper44'];
$codper45 = $_SESSION['codper45'];
}

if ($qtperguntas > 45){
$codper46 = $_SESSION['codper46'];
$codper47 = $_SESSION['codper47'];
$codper48 = $_SESSION['codper48'];
$codper49 = $_SESSION['codper49'];
$codper50 = $_SESSION['codper50'];
}

if ($qtperguntas > 50){
$codper51 = $_SESSION['codper51'];
$codper52 = $_SESSION['codper52'];
$codper53 = $_SESSION['codper53'];
$codper54 = $_SESSION['codper54'];
$codper55 = $_SESSION['codper55'];
}

if ($qtperguntas > 55){
$codper56 = $_SESSION['codper56'];
$codper57 = $_SESSION['codper57'];
$codper58 = $_SESSION['codper58'];
$codper59 = $_SESSION['codper59'];
$codper60 = $_SESSION['codper60'];
}

if ($qtperguntas > 60){
$codper61 = $_SESSION['codper61'];
$codper62 = $_SESSION['codper62'];
$codper63 = $_SESSION['codper63'];
$codper64 = $_SESSION['codper64'];
$codper65 = $_SESSION['codper65'];
}

if ($qtperguntas > 65){
$codper66 = $_SESSION['codper66'];
$codper67 = $_SESSION['codper67'];
$codper68 = $_SESSION['codper68'];
$codper69 = $_SESSION['codper69'];
$codper70 = $_SESSION['codper70'];
}

if ($qtperguntas > 70){
$codper71 = $_SESSION['codper71'];
$codper72 = $_SESSION['codper72'];
$codper73 = $_SESSION['codper73'];
$codper74 = $_SESSION['codper74'];
$codper75 = $_SESSION['codper75'];
}

if ($qtperguntas > 75){
$codper76 = $_SESSION['codper76'];
$codper77 = $_SESSION['codper77'];
$codper78 = $_SESSION['codper78'];
$codper79 = $_SESSION['codper79'];
$codper80 = $_SESSION['codper80'];
}

if ($qtperguntas > 80){
$codper81 = $_SESSION['codper81'];
$codper82 = $_SESSION['codper82'];
$codper83 = $_SESSION['codper83'];
$codper84 = $_SESSION['codper84'];
$codper85 = $_SESSION['codper85'];
}

if ($qtperguntas > 85){
$codper86 = $_SESSION['codper86'];
$codper87 = $_SESSION['codper87'];
$codper88 = $_SESSION['codper88'];
$codper89 = $_SESSION['codper89'];
$codper90 = $_SESSION['codper90'];
}


// Tipo da prova para pessoal
$tipoprova = 0;

// Verificando quantas e quais perguntas devem ser salvas na prova
// De acordo com a quantidade de questões
if ($qtperguntas > 85){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
  , codper69, codper70, codper71, codper72, codper73, codper74, codper75, codper76, codper77, codper78, codper79
  , codper80, codper81, codper82, codper83, codper84, codper85, codper86, codper87, codper88, codper89, codper90,tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
  $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
  $codper71,$codper72,$codper73,$codper74,$codper75,$codper76,$codper77,$codper78,$codper79,
  $codper80,$codper81,$codper82,$codper83,$codper84,$codper85,$codper86,$codper87,$codper88,
  $codper89,$codper90,$tipoprova);");
}
elseif ($qtperguntas > 80){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
  , codper69, codper70, codper71, codper72, codper73, codper74, codper75, codper76, codper77, codper78, codper79
  , codper80, codper81, codper82, codper83, codper84, codper85,tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
  $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
  $codper71,$codper72,$codper73,$codper74,$codper75,$codper76,$codper77,$codper78,$codper79,
  $codper80,$codper81,$codper82,$codper83,$codper84,$codper85,$tipoprova);");
}
elseif ($qtperguntas > 75){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
  , codper69, codper70, codper71, codper72, codper73, codper74, codper75, codper76, codper77, codper78, codper79
  , codper80, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
  $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
  $codper71,$codper72,$codper73,$codper74,$codper75,$codper76,$codper77,$codper78,$codper79,
  $codper80,$tipoprova);");
}
elseif ($qtperguntas > 70){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
  , codper69, codper70, codper71, codper72, codper73, codper74, codper75, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
  $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,
  $codper71,$codper72,$codper73,$codper74,$codper75,$tipoprova);");
}
elseif ($qtperguntas > 65){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, codper66, codper67, codper68
  , codper69, codper70, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
  $codper62,$codper63,$codper64,$codper65,$codper66,$codper67,$codper68,$codper69,$codper70,$tipoprova);");
}
elseif ($qtperguntas > 60){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, codper61, codper62, codper63, codper64, codper65, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$codper61,
  $codper62,$codper63,$codper64,$codper65,$tipoprova);");
}
elseif ($qtperguntas > 55){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, codper56, codper57
  , codper58, codper59, codper60, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$codper56,$codper57,$codper58,$codper59,$codper60,$tipoprova);");
}
elseif ($qtperguntas > 50){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, codper51, codper52, codper53, codper54, codper55, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$codper51,$codper52,
  $codper53,$codper54,$codper55,$tipoprova);");
}
elseif ($qtperguntas > 45){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, codper46
  , codper47, codper48, codper49, codper50, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$codper46,$codper47,$codper48,$codper49,$codper50,$tipoprova);");
}
elseif ($qtperguntas > 40){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, codper41, codper42, codper43, codper44, codper45, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$codper41,$codper42,$codper43,
  $codper44,$codper45,$tipoprova);");
}
elseif ($qtperguntas > 35){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35
  , codper36, codper37, codper38, codper39, codper40, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$codper36,$codper37,$codper38,$codper39,$codper40,$tipoprova);");
}
elseif ($qtperguntas > 30){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, codper31, codper32, codper33, codper34, codper35, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$codper31,$codper32,$codper33,$codper34,
  $codper35,$tipoprova);");
}
elseif ($qtperguntas > 25){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, codper26, codper27, codper28, codper29, codper30, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,
  $codper26,$codper27,$codper28,$codper29,$codper30,$tipoprova);");
}
elseif ($qtperguntas > 20){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, codper21, codper22, codper23, codper24
  , codper25, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20,$codper21,$codper22,$codper23,$codper24,$codper25,$tipoprova);");
}
elseif ($qtperguntas > 15){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, codper16, codper17, codper18, codper19, codper20, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$codper16,
  $codper17,$codper18,$codper19,$codper20, $tipoprova);");
}
elseif ($qtperguntas > 10){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, codper11, codper12, codper13
  , codper14, codper15, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10,$codper11,$codper12,$codper13,$codper14,$codper15,$tipoprova);");
}
elseif ($qtperguntas > 5){
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, codper6, codper7, codper8, codper9, codper10, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$codper6,$codper7,
  $codper8,$codper9,$codper10, $tipoprova);");
}
else{
  $adicionar = mysqli_query($conexao, "INSERT into tabela_provas_usuario(codigo_usuario, numero_questoes, nome, codper1, 
  codper2, codper3, codper4, codper5, tipoprova) 
  values($codigo_usuario,$qtperguntas,'$nome_prova',$codper1,$codper2,$codper3,$codper4,$codper5,$tipoprova);");
}

// Destruindo sessão para esquecer os dados da prova
// Para não haver conflitos futuros
session_destroy();

// Reiniciando a sessão
session_start();

// Passando os dados do usuario para a sessão novamente
$_SESSION['nome_usuario'] = $nome_usuario;
$_SESSION["senha_usuario"] = $senha_usuario;

// Emitindo mesagem de sucesso
$script = "<script>alert('Prova salva com Sucesso');location.href='minhas_provas_Usuario.php';</script>";
echo $script;
exit;
}else{

  // redirecionando para a pagina usuarios, pois a pagina foi acessada de forma incorreta
  header('location: pagina_usuarios.php');
  exit;
}

?>