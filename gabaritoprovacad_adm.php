<!-- Iniciando PHP -->
<?php

// Inicinado sessão
session_start();

// Conectando com o banco de dados
include_once ('conexao.php');

// Verificando se a sessão foi iniciada 
if(!isset($_SESSION["senha_adm"])){

  // Redirecioanando para a pagina index, ppis a sessão não foi iniciadad
  header('location: index.php');
  exit;
}else{

// Obtendo o nome do ADM na sessão
$nome = $_SESSION["nome_adm"];

// Buncando dados do ADM para usar se necessário
$dados = mysqli_query($conexao, "SELECT * FROM tabela_adm WHERE nome = '$nome';");

// Verificando se o usuário existe no bd
if($dados->num_rows > 0){
  $dado=$dados->fetch_array();
  }else{

    // Voltando para o index, pois o usuario não existe
    header('location: index.php');
    exit;
  }

// Obtendo o nível do ADM
$niveladm = $dado['nivel'];

// Obtendo o codigo do adm
$codigo_adm = $dado['codigo'];

// Verificando se o codigo chegou via GET
// Codigo de provas do proprio adm logado
if(!empty($_GET['codigo'])){

// Obtendo o código via GET do form anterior
$codigo_prova = $_GET['codigo'];

// Selecionando os dados da prova
$select_dadppro = mysqli_query($conexao,"SELECT * FROM tabela_provas_adm WHERE (codigo = $codigo_prova and codigo_adm = $codigo_adm);");
$dados_prova = mysqli_fetch_assoc($select_dadppro);

}

// Codigos de provas de usuarios
elseif(!empty($_GET['codigousu'])){

// Obtendo o código via GET do form anterior
$codigo_prova = $_GET['codigousu'];

// Selecionando os dados da prova
$select_dadppro = mysqli_query($conexao,"SELECT * FROM tabela_provas_usuario WHERE (codigo = $codigo_prova and tipoprova = 1);");
$dados_prova = mysqli_fetch_assoc($select_dadppro);

}

// Codigo de provas de professores
elseif(!empty($_GET['codigoadm'])){

  // Obtendo o código via GET do form anterior
  $codigo_prova = $_GET['codigoadm'];
  
  // Selecionando os dados da prova
  $select_dadppro = mysqli_query($conexao,"SELECT * FROM tabela_provas_adm WHERE (codigo = $codigo_prova and tipoprova = 1);");
  $dados_prova = mysqli_fetch_assoc($select_dadppro);
  
}else{

    // Redirecioanando para a pagina adm, pois nenhum código chegou via GET
    header('location: pagina_adm.php');
    exit;
}
}

if (mysqli_num_rows($select_dadppro) < 1){

  // Redirecioanando para a pagina adm, pois a prova não existe
  header('location: pagina_adm.php');
  exit;
}else{

// Selecionando a qt de questões
$qtperguntas = $dados_prova['numero_questoes'];

// Selecionando as perguntas
// Questão 1
// Selecionando os dados 1
$codper1 = $dados_prova['codper1'];
$select_codper1 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper1;");
$per1 = mysqli_fetch_assoc($select_codper1);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper1 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper1 and letra = 'a';");
$letraaper1 = mysqli_fetch_assoc($select_letraaper1);

$select_letrabper1 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper1 and letra = 'b';");
$letrabper1 = mysqli_fetch_assoc($select_letrabper1);

$select_letracper1 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper1 and letra = 'c';");
$letracper1 = mysqli_fetch_assoc($select_letracper1);

$select_letradper1 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper1 and letra = 'd';");
$letradper1 = mysqli_fetch_assoc($select_letradper1);

$select_letraeper1 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper1 and letra = 'e';");
$letraeper1 = mysqli_fetch_assoc($select_letraeper1);

  // Selecionando alternativa correta 1
  if ($letraaper1["correta"]==1){
    $alt_corr1 = "Letra A";
  }
  elseif ($letrabper1["correta"]==1){
       $alt_corr1 = "Letra B";
  }
  elseif ($letracper1["correta"]==1){
    $alt_corr1 = "Letra C";
  }
  elseif ($letradper1["correta"]==1){
    $alt_corr1 = "Letra D";
  }
  elseif ($letraeper1["correta"]==1){
    $alt_corr1 = "Letra E";
  }


// Questão 2
// Selecionando os dados 2
$codper2 = $dados_prova['codper2'];
$select_codper2 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper2;");
$per2 = mysqli_fetch_assoc($select_codper2);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper2 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper2 and letra = 'a';");
$letraaper2 = mysqli_fetch_assoc($select_letraaper2);

$select_letrabper2 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper2 and letra = 'b';");
$letrabper2 = mysqli_fetch_assoc($select_letrabper2);

$select_letracper2 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper2 and letra = 'c';");
$letracper2 = mysqli_fetch_assoc($select_letracper2);

$select_letradper2 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper2 and letra = 'd';");
$letradper2 = mysqli_fetch_assoc($select_letradper2);

$select_letraeper2 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper2 and letra = 'e';");
$letraeper2 = mysqli_fetch_assoc($select_letraeper2);

  // Selecionando alternativa correta 2
  if ($letraaper2["correta"]==1){
    $alt_corr2 = "Letra A";
  }
  elseif ($letrabper2["correta"]==1){
       $alt_corr2 = "Letra B";
  }
  elseif ($letracper2["correta"]==1){
    $alt_corr2 = "Letra C";
  }
  elseif ($letradper2["correta"]==1){
    $alt_corr2 = "Letra D";
  }
  elseif ($letraeper2["correta"]==1){
    $alt_corr2 = "Letra E";
  }


// Questão 3
// Selecionando os dados 3
$codper3 = $dados_prova['codper3'];
$select_codper3 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper3;");
$per3 = mysqli_fetch_assoc($select_codper3);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper3 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper3 and letra = 'a';");
$letraaper3 = mysqli_fetch_assoc($select_letraaper3);

$select_letrabper3 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper3 and letra = 'b';");
$letrabper3 = mysqli_fetch_assoc($select_letrabper3);

$select_letracper3 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper3 and letra = 'c';");
$letracper3 = mysqli_fetch_assoc($select_letracper3);

$select_letradper3 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper3 and letra = 'd';");
$letradper3 = mysqli_fetch_assoc($select_letradper3);

$select_letraeper3 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper3 and letra = 'e';");
$letraeper3 = mysqli_fetch_assoc($select_letraeper3);

  // Selecionando alternativa correta 3
  if ($letraaper3["correta"]==1){
    $alt_corr3 = "Letra A";
  }
  elseif ($letrabper3["correta"]==1){
       $alt_corr3 = "Letra B";
  }
  elseif ($letracper3["correta"]==1){
    $alt_corr3 = "Letra C";
  }
  elseif ($letradper3["correta"]==1){
    $alt_corr3 = "Letra D";
  }
  elseif ($letraeper3["correta"]==1){
    $alt_corr3 = "Letra E";
  }


// Questão 4
// Selecionando os dados 4
$codper4 = $dados_prova['codper4'];
$select_codper4 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper4;");
$per4 = mysqli_fetch_assoc($select_codper4);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper4 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper4 and letra = 'a';");
$letraaper4 = mysqli_fetch_assoc($select_letraaper4);

$select_letrabper4 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper4 and letra = 'b';");
$letrabper4 = mysqli_fetch_assoc($select_letrabper4);

$select_letracper4 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper4 and letra = 'c';");
$letracper4 = mysqli_fetch_assoc($select_letracper4);

$select_letradper4 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper4 and letra = 'd';");
$letradper4 = mysqli_fetch_assoc($select_letradper4);

$select_letraeper4 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper4 and letra = 'e';");
$letraeper4 = mysqli_fetch_assoc($select_letraeper4);

  // Selecionando alternativa correta 4
  if ($letraaper4["correta"]==1){
    $alt_corr4 = "Letra A";
  }
  elseif ($letrabper4["correta"]==1){
       $alt_corr4 = "Letra B";
  }
  elseif ($letracper4["correta"]==1){
    $alt_corr4 = "Letra C";
  }
  elseif ($letradper4["correta"]==1){
    $alt_corr4 = "Letra D";
  }
  elseif ($letraeper4["correta"]==1){
    $alt_corr4 = "Letra E";
  }


// Questão 5
// Selecionando os dados 5
$codper5 = $dados_prova['codper5'];
$select_codper5 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper5;");
$per5 = mysqli_fetch_assoc($select_codper5);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper5 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper5 and letra = 'a';");
$letraaper5 = mysqli_fetch_assoc($select_letraaper5);

$select_letrabper5 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper5 and letra = 'b';");
$letrabper5 = mysqli_fetch_assoc($select_letrabper5);

$select_letracper5 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper5 and letra = 'c';");
$letracper5 = mysqli_fetch_assoc($select_letracper5);

$select_letradper5 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper5 and letra = 'd';");
$letradper5 = mysqli_fetch_assoc($select_letradper5);

$select_letraeper5 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper5 and letra = 'e';");
$letraeper5 = mysqli_fetch_assoc($select_letraeper5);

  // Selecionando alternativa correta 5
  if ($letraaper5["correta"]==1){
    $alt_corr5 = "Letra A";
  }
  elseif ($letrabper5["correta"]==1){
       $alt_corr5 = "Letra B";
  }
  elseif ($letracper5["correta"]==1){
    $alt_corr5 = "Letra C";
  }
  elseif ($letradper5["correta"]==1){
    $alt_corr5 = "Letra D";
  }
  elseif ($letraeper5["correta"]==1){
    $alt_corr5 = "Letra E";
  }


// Verificando se a qt de perguntas é maior que 5
if ($qtperguntas > 5){
// Questão 6
// Selecionando os dados 6
$codper6 = $dados_prova['codper6'];
$select_codper6 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper6;");
$per6 = mysqli_fetch_assoc($select_codper6);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper6 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper6 and letra = 'a';");
$letraaper6 = mysqli_fetch_assoc($select_letraaper6);

$select_letrabper6 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper6 and letra = 'b';");
$letrabper6 = mysqli_fetch_assoc($select_letrabper6);

$select_letracper6 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper6 and letra = 'c';");
$letracper6 = mysqli_fetch_assoc($select_letracper6);

$select_letradper6 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper6 and letra = 'd';");
$letradper6 = mysqli_fetch_assoc($select_letradper6);

$select_letraeper6 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper6 and letra = 'e';");
$letraeper6 = mysqli_fetch_assoc($select_letraeper6);

  // Selecionando alternativa correta 6
  if ($letraaper6["correta"]==1){
    $alt_corr6 = "Letra A";
  }
  elseif ($letrabper6["correta"]==1){
       $alt_corr6 = "Letra B";
  }
  elseif ($letracper6["correta"]==1){
    $alt_corr6 = "Letra C";
  }
  elseif ($letradper6["correta"]==1){
    $alt_corr6 = "Letra D";
  }
  elseif ($letraeper6["correta"]==1){
    $alt_corr6 = "Letra E";
  }


// Questão 7
// Selecionando os dados 7
$codper7 = $dados_prova['codper7'];
$select_codper7 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper7;");
$per7 = mysqli_fetch_assoc($select_codper7);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper7 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper7 and letra = 'a';");
$letraaper7 = mysqli_fetch_assoc($select_letraaper7);

$select_letrabper7 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper7 and letra = 'b';");
$letrabper7 = mysqli_fetch_assoc($select_letrabper7);

$select_letracper7 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper7 and letra = 'c';");
$letracper7 = mysqli_fetch_assoc($select_letracper7);

$select_letradper7 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper7 and letra = 'd';");
$letradper7 = mysqli_fetch_assoc($select_letradper7);

$select_letraeper7 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper7 and letra = 'e';");
$letraeper7 = mysqli_fetch_assoc($select_letraeper7);

  // Selecionando alternativa correta 7
  if ($letraaper7["correta"]==1){
    $alt_corr7 = "Letra A";
  }
  elseif ($letrabper7["correta"]==1){
       $alt_corr7 = "Letra B";
  }
  elseif ($letracper7["correta"]==1){
    $alt_corr7 = "Letra C";
  }
  elseif ($letradper7["correta"]==1){
    $alt_corr7 = "Letra D";
  }
  elseif ($letraeper7["correta"]==1){
    $alt_corr7 = "Letra E";
  }


// Questão 8
// Selecionando os dados 8
$codper8 = $dados_prova['codper8'];
$select_codper8 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper8;");
$per8 = mysqli_fetch_assoc($select_codper8);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper8 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper8 and letra = 'a';");
$letraaper8 = mysqli_fetch_assoc($select_letraaper8);

$select_letrabper8 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper8 and letra = 'b';");
$letrabper8 = mysqli_fetch_assoc($select_letrabper8);

$select_letracper8 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper8 and letra = 'c';");
$letracper8 = mysqli_fetch_assoc($select_letracper8);

$select_letradper8 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper8 and letra = 'd';");
$letradper8 = mysqli_fetch_assoc($select_letradper8);

$select_letraeper8 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper8 and letra = 'e';");
$letraeper8 = mysqli_fetch_assoc($select_letraeper8);

  // Selecionando alternativa correta 8
  if ($letraaper8["correta"]==1){
    $alt_corr8 = "Letra A";
  }
  elseif ($letrabper8["correta"]==1){
       $alt_corr8 = "Letra B";
  }
  elseif ($letracper8["correta"]==1){
    $alt_corr8 = "Letra C";
  }
  elseif ($letradper8["correta"]==1){
    $alt_corr8 = "Letra D";
  }
  elseif ($letraeper8["correta"]==1){
    $alt_corr8 = "Letra E";
  }


// Questão 9
// Selecionando os dados 9
$codper9 = $dados_prova['codper9'];
$select_codper9 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper9;");
$per9 = mysqli_fetch_assoc($select_codper9);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper9 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper9 and letra = 'a';");
$letraaper9 = mysqli_fetch_assoc($select_letraaper9);

$select_letrabper9 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper9 and letra = 'b';");
$letrabper9 = mysqli_fetch_assoc($select_letrabper9);

$select_letracper9 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper9 and letra = 'c';");
$letracper9 = mysqli_fetch_assoc($select_letracper9);

$select_letradper9 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper9 and letra = 'd';");
$letradper9 = mysqli_fetch_assoc($select_letradper9);

$select_letraeper9 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper9 and letra = 'e';");
$letraeper9 = mysqli_fetch_assoc($select_letraeper9);

  // Selecionando alternativa correta 9
  if ($letraaper9["correta"]==1){
    $alt_corr9 = "Letra A";
  }
  elseif ($letrabper9["correta"]==1){
       $alt_corr9 = "Letra B";
  }
  elseif ($letracper9["correta"]==1){
    $alt_corr9 = "Letra C";
  }
  elseif ($letradper9["correta"]==1){
    $alt_corr9 = "Letra D";
  }
  elseif ($letraeper9["correta"]==1){
    $alt_corr9 = "Letra E";
  }


// Questão 10
// Selecionando os dados 10
$codper10 = $dados_prova['codper10'];
$select_codper10 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper10;");
$per10 = mysqli_fetch_assoc($select_codper10);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper10 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper10 and letra = 'a';");
$letraaper10 = mysqli_fetch_assoc($select_letraaper10);

$select_letrabper10 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper10 and letra = 'b';");
$letrabper10 = mysqli_fetch_assoc($select_letrabper10);

$select_letracper10 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper10 and letra = 'c';");
$letracper10 = mysqli_fetch_assoc($select_letracper10);

$select_letradper10 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper10 and letra = 'd';");
$letradper10 = mysqli_fetch_assoc($select_letradper10);

$select_letraeper10 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper10 and letra = 'e';");
$letraeper10 = mysqli_fetch_assoc($select_letraeper10);

  // Selecionando alternativa correta 10
  if ($letraaper10["correta"]==1){
    $alt_corr10 = "Letra A";
  }
  elseif ($letrabper10["correta"]==1){
       $alt_corr10 = "Letra B";
  }
  elseif ($letracper10["correta"]==1){
    $alt_corr10 = "Letra C";
  }
  elseif ($letradper10["correta"]==1){
    $alt_corr10 = "Letra D";
  }
  elseif ($letraeper10["correta"]==1){
    $alt_corr10 = "Letra E";
  }
}


// Verificando se a qt de perguntas é maior que 10
if ($qtperguntas > 10){
// Questão 11
// Selecionando os dados 11
$codper11 = $dados_prova['codper11'];
$select_codper11 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper11;");
$per11 = mysqli_fetch_assoc($select_codper11);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper11 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper11 and letra = 'a';");
$letraaper11 = mysqli_fetch_assoc($select_letraaper11);

$select_letrabper11 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper11 and letra = 'b';");
$letrabper11 = mysqli_fetch_assoc($select_letrabper11);

$select_letracper11 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper11 and letra = 'c';");
$letracper11 = mysqli_fetch_assoc($select_letracper11);

$select_letradper11 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper11 and letra = 'd';");
$letradper11 = mysqli_fetch_assoc($select_letradper11);

$select_letraeper11 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper11 and letra = 'e';");
$letraeper11 = mysqli_fetch_assoc($select_letraeper11);

  // Selecionando alternativa correta 11
  if ($letraaper11["correta"]==1){
    $alt_corr11 = "Letra A";
  }
  elseif ($letrabper11["correta"]==1){
       $alt_corr11 = "Letra B";
  }
  elseif ($letracper11["correta"]==1){
    $alt_corr11 = "Letra C";
  }
  elseif ($letradper11["correta"]==1){
    $alt_corr11 = "Letra D";
  }
  elseif ($letraeper11["correta"]==1){
    $alt_corr11 = "Letra E";
  }


// Questão 12
// Selecionando os dados 12
$codper12 = $dados_prova['codper12'];
$select_codper12 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper12;");
$per12 = mysqli_fetch_assoc($select_codper12);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper12 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper12 and letra = 'a';");
$letraaper12 = mysqli_fetch_assoc($select_letraaper12);

$select_letrabper12 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper12 and letra = 'b';");
$letrabper12 = mysqli_fetch_assoc($select_letrabper12);

$select_letracper12 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper12 and letra = 'c';");
$letracper12 = mysqli_fetch_assoc($select_letracper12);

$select_letradper12 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper12 and letra = 'd';");
$letradper12 = mysqli_fetch_assoc($select_letradper12);

$select_letraeper12 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper12 and letra = 'e';");
$letraeper12 = mysqli_fetch_assoc($select_letraeper12);

  // Selecionando alternativa correta 12
  if ($letraaper12["correta"]==1){
    $alt_corr12 = "Letra A";
  }
  elseif ($letrabper12["correta"]==1){
       $alt_corr12 = "Letra B";
  }
  elseif ($letracper12["correta"]==1){
    $alt_corr12 = "Letra C";
  }
  elseif ($letradper12["correta"]==1){
    $alt_corr12 = "Letra D";
  }
  elseif ($letraeper12["correta"]==1){
    $alt_corr12 = "Letra E";
  }


// Questão 13
// Selecionando os dados 13
$codper13 = $dados_prova['codper13'];
$select_codper13 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper13;");
$per13 = mysqli_fetch_assoc($select_codper13);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper13 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper13 and letra = 'a';");
$letraaper13 = mysqli_fetch_assoc($select_letraaper13);

$select_letrabper13 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper13 and letra = 'b';");
$letrabper13 = mysqli_fetch_assoc($select_letrabper13);

$select_letracper13 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper13 and letra = 'c';");
$letracper13 = mysqli_fetch_assoc($select_letracper13);

$select_letradper13 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper13 and letra = 'd';");
$letradper13 = mysqli_fetch_assoc($select_letradper13);

$select_letraeper13 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper13 and letra = 'e';");
$letraeper13 = mysqli_fetch_assoc($select_letraeper13);

  // Selecionando alternativa correta 13
  if ($letraaper13["correta"]==1){
    $alt_corr13 = "Letra A";
  }
  elseif ($letrabper13["correta"]==1){
       $alt_corr13 = "Letra B";
  }
  elseif ($letracper13["correta"]==1){
    $alt_corr13 = "Letra C";
  }
  elseif ($letradper13["correta"]==1){
    $alt_corr13 = "Letra D";
  }
  elseif ($letraeper13["correta"]==1){
    $alt_corr13 = "Letra E";
  }


// Questão 14
// Selecionando os dados 14
$codper14 = $dados_prova['codper14'];
$select_codper14 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper14;");
$per14 = mysqli_fetch_assoc($select_codper14);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper14 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper14 and letra = 'a';");
$letraaper14 = mysqli_fetch_assoc($select_letraaper14);

$select_letrabper14 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper14 and letra = 'b';");
$letrabper14 = mysqli_fetch_assoc($select_letrabper14);

$select_letracper14 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper14 and letra = 'c';");
$letracper14 = mysqli_fetch_assoc($select_letracper14);

$select_letradper14 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper14 and letra = 'd';");
$letradper14 = mysqli_fetch_assoc($select_letradper14);

$select_letraeper14 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper14 and letra = 'e';");
$letraeper14 = mysqli_fetch_assoc($select_letraeper14);

  // Selecionando alternativa correta 14
  if ($letraaper14["correta"]==1){
    $alt_corr14 = "Letra A";
  }
  elseif ($letrabper14["correta"]==1){
       $alt_corr14 = "Letra B";
  }
  elseif ($letracper14["correta"]==1){
    $alt_corr14 = "Letra C";
  }
  elseif ($letradper14["correta"]==1){
    $alt_corr14 = "Letra D";
  }
  elseif ($letraeper14["correta"]==1){
    $alt_corr14 = "Letra E";
  }


// Questão 15
// Selecionando os dados 15
$codper15 = $dados_prova['codper15'];
$select_codper15 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper15;");
$per15 = mysqli_fetch_assoc($select_codper15);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper15 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper15 and letra = 'a';");
$letraaper15 = mysqli_fetch_assoc($select_letraaper15);

$select_letrabper15 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper15 and letra = 'b';");
$letrabper15 = mysqli_fetch_assoc($select_letrabper15);

$select_letracper15 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper15 and letra = 'c';");
$letracper15 = mysqli_fetch_assoc($select_letracper15);

$select_letradper15 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper15 and letra = 'd';");
$letradper15 = mysqli_fetch_assoc($select_letradper15);

$select_letraeper15 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper15 and letra = 'e';");
$letraeper15 = mysqli_fetch_assoc($select_letraeper15);

  // Selecionando alternativa correta 15
  if ($letraaper15["correta"]==1){
    $alt_corr15 = "Letra A";
  }
  elseif ($letrabper15["correta"]==1){
       $alt_corr15 = "Letra B";
  }
  elseif ($letracper15["correta"]==1){
    $alt_corr15 = "Letra C";
  }
  elseif ($letradper15["correta"]==1){
    $alt_corr15 = "Letra D";
  }
  elseif ($letraeper15["correta"]==1){
    $alt_corr15 = "Letra E";
  }
}


// Verificando se a qt de perguntas é maior que 15
if ($qtperguntas > 15){
// Questão 16
// Selecionando os dados 16
$codper16 = $dados_prova['codper16'];
$select_codper16 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper16;");
$per16 = mysqli_fetch_assoc($select_codper16);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper16 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper16 and letra = 'a';");
$letraaper16 = mysqli_fetch_assoc($select_letraaper16);

$select_letrabper16 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper16 and letra = 'b';");
$letrabper16 = mysqli_fetch_assoc($select_letrabper16);

$select_letracper16 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper16 and letra = 'c';");
$letracper16 = mysqli_fetch_assoc($select_letracper16);

$select_letradper16 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper16 and letra = 'd';");
$letradper16 = mysqli_fetch_assoc($select_letradper16);

$select_letraeper16 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper16 and letra = 'e';");
$letraeper16 = mysqli_fetch_assoc($select_letraeper16);

  // Selecionando alternativa correta 16
  if ($letraaper16["correta"]==1){
    $alt_corr16 = "Letra A";
  }
  elseif ($letrabper16["correta"]==1){
       $alt_corr16 = "Letra B";
  }
  elseif ($letracper16["correta"]==1){
    $alt_corr16 = "Letra C";
  }
  elseif ($letradper16["correta"]==1){
    $alt_corr16 = "Letra D";
  }
  elseif ($letraeper16["correta"]==1){
    $alt_corr16 = "Letra E";
  }


// Questão 17
// Selecionando os dados 17
$codper17 = $dados_prova['codper17'];
$select_codper17 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper17;");
$per17 = mysqli_fetch_assoc($select_codper17);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper17 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper17 and letra = 'a';");
$letraaper17 = mysqli_fetch_assoc($select_letraaper17);

$select_letrabper17 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper17 and letra = 'b';");
$letrabper17 = mysqli_fetch_assoc($select_letrabper17);

$select_letracper17 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper17 and letra = 'c';");
$letracper17 = mysqli_fetch_assoc($select_letracper17);

$select_letradper17 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper17 and letra = 'd';");
$letradper17 = mysqli_fetch_assoc($select_letradper17);

$select_letraeper17 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper17 and letra = 'e';");
$letraeper17 = mysqli_fetch_assoc($select_letraeper17);

  // Selecionando alternativa correta 17
  if ($letraaper17["correta"]==1){
    $alt_corr17 = "Letra A";
  }
  elseif ($letrabper17["correta"]==1){
       $alt_corr17 = "Letra B";
  }
  elseif ($letracper17["correta"]==1){
    $alt_corr17 = "Letra C";
  }
  elseif ($letradper17["correta"]==1){
    $alt_corr17 = "Letra D";
  }
  elseif ($letraeper17["correta"]==1){
    $alt_corr17 = "Letra E";
  }


// Questão 18
// Selecionando os dados 18
$codper18 = $dados_prova['codper18'];
$select_codper18 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper18;");
$per18 = mysqli_fetch_assoc($select_codper18);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper18 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper18 and letra = 'a';");
$letraaper18 = mysqli_fetch_assoc($select_letraaper18);

$select_letrabper18 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper18 and letra = 'b';");
$letrabper18 = mysqli_fetch_assoc($select_letrabper18);

$select_letracper18 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper18 and letra = 'c';");
$letracper18 = mysqli_fetch_assoc($select_letracper18);

$select_letradper18 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper18 and letra = 'd';");
$letradper18 = mysqli_fetch_assoc($select_letradper18);

$select_letraeper18 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper18 and letra = 'e';");
$letraeper18 = mysqli_fetch_assoc($select_letraeper18);

  // Selecionando alternativa correta 18
  if ($letraaper18["correta"]==1){
    $alt_corr18 = "Letra A";
  }
  elseif ($letrabper18["correta"]==1){
       $alt_corr18 = "Letra B";
  }
  elseif ($letracper18["correta"]==1){
    $alt_corr18 = "Letra C";
  }
  elseif ($letradper18["correta"]==1){
    $alt_corr18 = "Letra D";
  }
  elseif ($letraeper18["correta"]==1){
    $alt_corr18 = "Letra E";
  }


// Questão 19
// Selecionando os dados 19
$codper19 = $dados_prova['codper19'];
$select_codper19 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper19;");
$per19 = mysqli_fetch_assoc($select_codper19);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper19 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper19 and letra = 'a';");
$letraaper19 = mysqli_fetch_assoc($select_letraaper19);

$select_letrabper19 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper19 and letra = 'b';");
$letrabper19 = mysqli_fetch_assoc($select_letrabper19);

$select_letracper19 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper19 and letra = 'c';");
$letracper19 = mysqli_fetch_assoc($select_letracper19);

$select_letradper19 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper19 and letra = 'd';");
$letradper19 = mysqli_fetch_assoc($select_letradper19);

$select_letraeper19 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper19 and letra = 'e';");
$letraeper19 = mysqli_fetch_assoc($select_letraeper19);

  // Selecionando alternativa correta 19
  if ($letraaper19["correta"]==1){
    $alt_corr19 = "Letra A";
  }
  elseif ($letrabper19["correta"]==1){
       $alt_corr19 = "Letra B";
  }
  elseif ($letracper19["correta"]==1){
    $alt_corr19 = "Letra C";
  }
  elseif ($letradper19["correta"]==1){
    $alt_corr19 = "Letra D";
  }
  elseif ($letraeper19["correta"]==1){
    $alt_corr19 = "Letra E";
  }


// Questão 20
// Selecionando os dados 20
$codper20 = $dados_prova['codper20'];
$select_codper20 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper20;");
$per20 = mysqli_fetch_assoc($select_codper20);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper20 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper20 and letra = 'a';");
$letraaper20 = mysqli_fetch_assoc($select_letraaper20);

$select_letrabper20 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper20 and letra = 'b';");
$letrabper20 = mysqli_fetch_assoc($select_letrabper20);

$select_letracper20 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper20 and letra = 'c';");
$letracper20 = mysqli_fetch_assoc($select_letracper20);

$select_letradper20 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper20 and letra = 'd';");
$letradper20 = mysqli_fetch_assoc($select_letradper20);

$select_letraeper20 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper20 and letra = 'e';");
$letraeper20 = mysqli_fetch_assoc($select_letraeper20);

  // Selecionando alternativa correta 20
  if ($letraaper20["correta"]==1){
    $alt_corr20 = "Letra A";
  }
  elseif ($letrabper20["correta"]==1){
       $alt_corr20 = "Letra B";
  }
  elseif ($letracper20["correta"]==1){
    $alt_corr20 = "Letra C";
  }
  elseif ($letradper20["correta"]==1){
    $alt_corr20 = "Letra D";
  }
  elseif ($letraeper20["correta"]==1){
    $alt_corr20 = "Letra E";
  }
}


// Verificando se a qt de perguntas é maior que 20
if ($qtperguntas > 20){
// Questão 21
// Selecionando os dados 21
$codper21 = $dados_prova['codper21'];
$select_codper21 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper21;");
$per21 = mysqli_fetch_assoc($select_codper21);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper21 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper21 and letra = 'a';");
$letraaper21 = mysqli_fetch_assoc($select_letraaper21);

$select_letrabper21 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper21 and letra = 'b';");
$letrabper21 = mysqli_fetch_assoc($select_letrabper21);

$select_letracper21 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper21 and letra = 'c';");
$letracper21 = mysqli_fetch_assoc($select_letracper21);

$select_letradper21 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper21 and letra = 'd';");
$letradper21 = mysqli_fetch_assoc($select_letradper21);

$select_letraeper21 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper21 and letra = 'e';");
$letraeper21 = mysqli_fetch_assoc($select_letraeper21);

  // Selecionando alternativa correta 21
  if ($letraaper21["correta"]==1){
    $alt_corr21 = "Letra A";
  }
  elseif ($letrabper21["correta"]==1){
       $alt_corr21 = "Letra B";
  }
  elseif ($letracper21["correta"]==1){
    $alt_corr21 = "Letra C";
  }
  elseif ($letradper21["correta"]==1){
    $alt_corr21 = "Letra D";
  }
  elseif ($letraeper21["correta"]==1){
    $alt_corr21 = "Letra E";
  }


// Questão 22
// Selecionando os dados 22
$codper22 = $dados_prova['codper22'];
$select_codper22 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper22;");
$per22 = mysqli_fetch_assoc($select_codper22);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper22 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper22 and letra = 'a';");
$letraaper22 = mysqli_fetch_assoc($select_letraaper22);

$select_letrabper22 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper22 and letra = 'b';");
$letrabper22 = mysqli_fetch_assoc($select_letrabper22);

$select_letracper22 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper22 and letra = 'c';");
$letracper22 = mysqli_fetch_assoc($select_letracper22);

$select_letradper22 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper22 and letra = 'd';");
$letradper22 = mysqli_fetch_assoc($select_letradper22);

$select_letraeper22 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper22 and letra = 'e';");
$letraeper22 = mysqli_fetch_assoc($select_letraeper22);

  // Selecionando alternativa correta 22
  if ($letraaper22["correta"]==1){
    $alt_corr22 = "Letra A";
  }
  elseif ($letrabper22["correta"]==1){
       $alt_corr22 = "Letra B";
  }
  elseif ($letracper22["correta"]==1){
    $alt_corr22 = "Letra C";
  }
  elseif ($letradper22["correta"]==1){
    $alt_corr22 = "Letra D";
  }
  elseif ($letraeper22["correta"]==1){
    $alt_corr22 = "Letra E";
  }


// Questão 23
// Selecionando os dados 23
$codper23 = $dados_prova['codper23'];
$select_codper23 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper23;");
$per23 = mysqli_fetch_assoc($select_codper23);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper23 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper23 and letra = 'a';");
$letraaper23 = mysqli_fetch_assoc($select_letraaper23);

$select_letrabper23 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper23 and letra = 'b';");
$letrabper23 = mysqli_fetch_assoc($select_letrabper23);

$select_letracper23 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper23 and letra = 'c';");
$letracper23 = mysqli_fetch_assoc($select_letracper23);

$select_letradper23 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper23 and letra = 'd';");
$letradper23 = mysqli_fetch_assoc($select_letradper23);

$select_letraeper23 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper23 and letra = 'e';");
$letraeper23 = mysqli_fetch_assoc($select_letraeper23);

  // Selecionando alternativa correta 23
  if ($letraaper23["correta"]==1){
    $alt_corr23 = "Letra A";
  }
  elseif ($letrabper23["correta"]==1){
       $alt_corr23 = "Letra B";
  }
  elseif ($letracper23["correta"]==1){
    $alt_corr23 = "Letra C";
  }
  elseif ($letradper23["correta"]==1){
    $alt_corr23 = "Letra D";
  }
  elseif ($letraeper23["correta"]==1){
    $alt_corr23 = "Letra E";
  }


// Questão 24
// Selecionando os dados 24
$codper24 = $dados_prova['codper24'];
$select_codper24 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper24;");
$per24 = mysqli_fetch_assoc($select_codper24);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper24 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper24 and letra = 'a';");
$letraaper24 = mysqli_fetch_assoc($select_letraaper24);

$select_letrabper24 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper24 and letra = 'b';");
$letrabper24 = mysqli_fetch_assoc($select_letrabper24);

$select_letracper24 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper24 and letra = 'c';");
$letracper24 = mysqli_fetch_assoc($select_letracper24);

$select_letradper24 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper24 and letra = 'd';");
$letradper24 = mysqli_fetch_assoc($select_letradper24);

$select_letraeper24 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper24 and letra = 'e';");
$letraeper24 = mysqli_fetch_assoc($select_letraeper24);

  // Selecionando alternativa correta 24
  if ($letraaper24["correta"]==1){
    $alt_corr24 = "Letra A";
  }
  elseif ($letrabper24["correta"]==1){
       $alt_corr24 = "Letra B";
  }
  elseif ($letracper24["correta"]==1){
    $alt_corr24 = "Letra C";
  }
  elseif ($letradper24["correta"]==1){
    $alt_corr24 = "Letra D";
  }
  elseif ($letraeper24["correta"]==1){
    $alt_corr24 = "Letra E";
  }


// Questão 25
// Selecionando os dados 25
$codper25 = $dados_prova['codper25'];
$select_codper25 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper25;");
$per25 = mysqli_fetch_assoc($select_codper25);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper25 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper25 and letra = 'a';");
$letraaper25 = mysqli_fetch_assoc($select_letraaper25);

$select_letrabper25 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper25 and letra = 'b';");
$letrabper25 = mysqli_fetch_assoc($select_letrabper25);

$select_letracper25 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper25 and letra = 'c';");
$letracper25 = mysqli_fetch_assoc($select_letracper25);

$select_letradper25 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper25 and letra = 'd';");
$letradper25 = mysqli_fetch_assoc($select_letradper25);

$select_letraeper25 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper25 and letra = 'e';");
$letraeper25 = mysqli_fetch_assoc($select_letraeper25);

  // Selecionando alternativa correta 25
  if ($letraaper25["correta"]==1){
    $alt_corr25 = "Letra A";
  }
  elseif ($letrabper25["correta"]==1){
       $alt_corr25 = "Letra B";
  }
  elseif ($letracper25["correta"]==1){
    $alt_corr25 = "Letra C";
  }
  elseif ($letradper25["correta"]==1){
    $alt_corr25 = "Letra D";
  }
  elseif ($letraeper25["correta"]==1){
    $alt_corr25 = "Letra E";
  }
}


// Verificando se a qt de perguntas é maior que 25
if ($qtperguntas > 25){
// Questão 26
// Selecionando os dados 26
$codper26 = $dados_prova['codper26'];
$select_codper26 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper26;");
$per26 = mysqli_fetch_assoc($select_codper26);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper26 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper26 and letra = 'a';");
$letraaper26 = mysqli_fetch_assoc($select_letraaper26);

$select_letrabper26 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper26 and letra = 'b';");
$letrabper26 = mysqli_fetch_assoc($select_letrabper26);

$select_letracper26 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper26 and letra = 'c';");
$letracper26 = mysqli_fetch_assoc($select_letracper26);

$select_letradper26 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper26 and letra = 'd';");
$letradper26 = mysqli_fetch_assoc($select_letradper26);

$select_letraeper26 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper26 and letra = 'e';");
$letraeper26 = mysqli_fetch_assoc($select_letraeper26);

  // Selecionando alternativa correta 26
  if ($letraaper26["correta"]==1){
    $alt_corr26 = "Letra A";
  }
  elseif ($letrabper26["correta"]==1){
       $alt_corr26 = "Letra B";
  }
  elseif ($letracper26["correta"]==1){
    $alt_corr26 = "Letra C";
  }
  elseif ($letradper26["correta"]==1){
    $alt_corr26 = "Letra D";
  }
  elseif ($letraeper26["correta"]==1){
    $alt_corr26 = "Letra E";
  }


// Questão 27
// Selecionando os dados 27
$codper27 = $dados_prova['codper27'];
$select_codper27 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper27;");
$per27 = mysqli_fetch_assoc($select_codper27);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper27 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper27 and letra = 'a';");
$letraaper27 = mysqli_fetch_assoc($select_letraaper27);

$select_letrabper27 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper27 and letra = 'b';");
$letrabper27 = mysqli_fetch_assoc($select_letrabper27);

$select_letracper27 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper27 and letra = 'c';");
$letracper27 = mysqli_fetch_assoc($select_letracper27);

$select_letradper27 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper27 and letra = 'd';");
$letradper27 = mysqli_fetch_assoc($select_letradper27);

$select_letraeper27 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper27 and letra = 'e';");
$letraeper27 = mysqli_fetch_assoc($select_letraeper27);

  // Selecionando alternativa correta 27
  if ($letraaper27["correta"]==1){
    $alt_corr27 = "Letra A";
  }
  elseif ($letrabper27["correta"]==1){
       $alt_corr27 = "Letra B";
  }
  elseif ($letracper27["correta"]==1){
    $alt_corr27 = "Letra C";
  }
  elseif ($letradper27["correta"]==1){
    $alt_corr27 = "Letra D";
  }
  elseif ($letraeper27["correta"]==1){
    $alt_corr27 = "Letra E";
  }


// Questão 28
// Selecionando os dados 28
$codper28 = $dados_prova['codper28'];
$select_codper28 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper28;");
$per28 = mysqli_fetch_assoc($select_codper28);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper28 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper28 and letra = 'a';");
$letraaper28 = mysqli_fetch_assoc($select_letraaper28);

$select_letrabper28 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper28 and letra = 'b';");
$letrabper28 = mysqli_fetch_assoc($select_letrabper28);

$select_letracper28 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper28 and letra = 'c';");
$letracper28 = mysqli_fetch_assoc($select_letracper28);

$select_letradper28 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper28 and letra = 'd';");
$letradper28 = mysqli_fetch_assoc($select_letradper28);

$select_letraeper28 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper28 and letra = 'e';");
$letraeper28 = mysqli_fetch_assoc($select_letraeper28);

  // Selecionando alternativa correta 28
  if ($letraaper28["correta"]==1){
    $alt_corr28 = "Letra A";
  }
  elseif ($letrabper28["correta"]==1){
       $alt_corr28 = "Letra B";
  }
  elseif ($letracper28["correta"]==1){
    $alt_corr28 = "Letra C";
  }
  elseif ($letradper28["correta"]==1){
    $alt_corr28 = "Letra D";
  }
  elseif ($letraeper28["correta"]==1){
    $alt_corr28 = "Letra E";
  }


// Questão 29
// Selecionando os dados 29
$codper29 = $dados_prova['codper29'];
$select_codper29 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper29;");
$per29 = mysqli_fetch_assoc($select_codper29);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper29 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper29 and letra = 'a';");
$letraaper29 = mysqli_fetch_assoc($select_letraaper29);

$select_letrabper29 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper29 and letra = 'b';");
$letrabper29 = mysqli_fetch_assoc($select_letrabper29);

$select_letracper29 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper29 and letra = 'c';");
$letracper29 = mysqli_fetch_assoc($select_letracper29);

$select_letradper29 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper29 and letra = 'd';");
$letradper29 = mysqli_fetch_assoc($select_letradper29);

$select_letraeper29 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper29 and letra = 'e';");
$letraeper29 = mysqli_fetch_assoc($select_letraeper29);

  // Selecionando alternativa correta 29
  if ($letraaper29["correta"]==1){
    $alt_corr29 = "Letra A";
  }
  elseif ($letrabper29["correta"]==1){
       $alt_corr29 = "Letra B";
  }
  elseif ($letracper29["correta"]==1){
    $alt_corr29 = "Letra C";
  }
  elseif ($letradper29["correta"]==1){
    $alt_corr29 = "Letra D";
  }
  elseif ($letraeper29["correta"]==1){
    $alt_corr29 = "Letra E";
  }


// Questão 30
// Selecionando os dados 30
$codper30 = $dados_prova['codper30'];
$select_codper30 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper30;");
$per30 = mysqli_fetch_assoc($select_codper30);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper30 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper30 and letra = 'a';");
$letraaper30 = mysqli_fetch_assoc($select_letraaper30);

$select_letrabper30 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper30 and letra = 'b';");
$letrabper30 = mysqli_fetch_assoc($select_letrabper30);

$select_letracper30 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper30 and letra = 'c';");
$letracper30 = mysqli_fetch_assoc($select_letracper30);

$select_letradper30 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper30 and letra = 'd';");
$letradper30 = mysqli_fetch_assoc($select_letradper30);

$select_letraeper30 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper30 and letra = 'e';");
$letraeper30 = mysqli_fetch_assoc($select_letraeper30);

  // Selecionando alternativa correta 30
  if ($letraaper30["correta"]==1){
    $alt_corr30 = "Letra A";
  }
  elseif ($letrabper30["correta"]==1){
       $alt_corr30 = "Letra B";
  }
  elseif ($letracper30["correta"]==1){
    $alt_corr30 = "Letra C";
  }
  elseif ($letradper30["correta"]==1){
    $alt_corr30 = "Letra D";
  }
  elseif ($letraeper30["correta"]==1){
    $alt_corr30 = "Letra E";
  }
}

// Verificando se a qt de perguntas é maior que 30
if ($qtperguntas > 30){
// Questão 31
// Selecionando os dados 31
$codper31 = $dados_prova['codper31'];
$select_codper31 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper31;");
$per31 = mysqli_fetch_assoc($select_codper31);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper31 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper31 and letra = 'a';");
$letraaper31 = mysqli_fetch_assoc($select_letraaper31);

$select_letrabper31 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper31 and letra = 'b';");
$letrabper31 = mysqli_fetch_assoc($select_letrabper31);

$select_letracper31 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper31 and letra = 'c';");
$letracper31 = mysqli_fetch_assoc($select_letracper31);

$select_letradper31 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper31 and letra = 'd';");
$letradper31 = mysqli_fetch_assoc($select_letradper31);

$select_letraeper31 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper31 and letra = 'e';");
$letraeper31 = mysqli_fetch_assoc($select_letraeper31);

  // Selecionando alternativa correta 31
  if ($letraaper31["correta"]==1){
    $alt_corr31 = "Letra A";
  }
  elseif ($letrabper31["correta"]==1){
       $alt_corr31 = "Letra B";
  }
  elseif ($letracper31["correta"]==1){
    $alt_corr31 = "Letra C";
  }
  elseif ($letradper31["correta"]==1){
    $alt_corr31 = "Letra D";
  }
  elseif ($letraeper31["correta"]==1){
    $alt_corr31 = "Letra E";
  }


// Questão 32
// Selecionando os dados 32
$codper32 = $dados_prova['codper32'];
$select_codper32 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper32;");
$per32 = mysqli_fetch_assoc($select_codper32);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper32 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper32 and letra = 'a';");
$letraaper32 = mysqli_fetch_assoc($select_letraaper32);

$select_letrabper32 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper32 and letra = 'b';");
$letrabper32 = mysqli_fetch_assoc($select_letrabper32);

$select_letracper32 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper32 and letra = 'c';");
$letracper32 = mysqli_fetch_assoc($select_letracper32);

$select_letradper32 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper32 and letra = 'd';");
$letradper32 = mysqli_fetch_assoc($select_letradper32);

$select_letraeper32 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper32 and letra = 'e';");
$letraeper32 = mysqli_fetch_assoc($select_letraeper32);

  // Selecionando alternativa correta 32
  if ($letraaper32["correta"]==1){
    $alt_corr32 = "Letra A";
  }
  elseif ($letrabper32["correta"]==1){
       $alt_corr32 = "Letra B";
  }
  elseif ($letracper32["correta"]==1){
    $alt_corr32 = "Letra C";
  }
  elseif ($letradper32["correta"]==1){
    $alt_corr32 = "Letra D";
  }
  elseif ($letraeper32["correta"]==1){
    $alt_corr32 = "Letra E";
  }


// Questão 33
// Selecionando os dados 33
$codper33 = $dados_prova['codper33'];
$select_codper33 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper33;");
$per33 = mysqli_fetch_assoc($select_codper33);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper33 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper33 and letra = 'a';");
$letraaper33 = mysqli_fetch_assoc($select_letraaper33);

$select_letrabper33 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper33 and letra = 'b';");
$letrabper33 = mysqli_fetch_assoc($select_letrabper33);

$select_letracper33 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper33 and letra = 'c';");
$letracper33 = mysqli_fetch_assoc($select_letracper33);

$select_letradper33 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper33 and letra = 'd';");
$letradper33 = mysqli_fetch_assoc($select_letradper33);

$select_letraeper33 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper33 and letra = 'e';");
$letraeper33 = mysqli_fetch_assoc($select_letraeper33);

  // Selecionando alternativa correta 33
  if ($letraaper33["correta"]==1){
    $alt_corr33 = "Letra A";
  }
  elseif ($letrabper33["correta"]==1){
       $alt_corr33 = "Letra B";
  }
  elseif ($letracper33["correta"]==1){
    $alt_corr33 = "Letra C";
  }
  elseif ($letradper33["correta"]==1){
    $alt_corr33 = "Letra D";
  }
  elseif ($letraeper33["correta"]==1){
    $alt_corr33 = "Letra E";
  }


// Questão 34
// Selecionando os dados 34
$codper34 = $dados_prova['codper34'];
$select_codper34 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper34;");
$per34 = mysqli_fetch_assoc($select_codper34);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper34 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper34 and letra = 'a';");
$letraaper34 = mysqli_fetch_assoc($select_letraaper34);

$select_letrabper34 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper34 and letra = 'b';");
$letrabper34 = mysqli_fetch_assoc($select_letrabper34);

$select_letracper34 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper34 and letra = 'c';");
$letracper34 = mysqli_fetch_assoc($select_letracper34);

$select_letradper34 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper34 and letra = 'd';");
$letradper34 = mysqli_fetch_assoc($select_letradper34);

$select_letraeper34 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper34 and letra = 'e';");
$letraeper34 = mysqli_fetch_assoc($select_letraeper34);

  // Selecionando alternativa correta 34
  if ($letraaper34["correta"]==1){
    $alt_corr34 = "Letra A";
  }
  elseif ($letrabper34["correta"]==1){
       $alt_corr34 = "Letra B";
  }
  elseif ($letracper34["correta"]==1){
    $alt_corr34 = "Letra C";
  }
  elseif ($letradper34["correta"]==1){
    $alt_corr34 = "Letra D";
  }
  elseif ($letraeper34["correta"]==1){
    $alt_corr34 = "Letra E";
  }


// Questão 35
// Selecionando os dados 35
$codper35 = $dados_prova['codper35'];
$select_codper35 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper35;");
$per35 = mysqli_fetch_assoc($select_codper35);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper35 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper35 and letra = 'a';");
$letraaper35 = mysqli_fetch_assoc($select_letraaper35);

$select_letrabper35 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper35 and letra = 'b';");
$letrabper35 = mysqli_fetch_assoc($select_letrabper35);

$select_letracper35 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper35 and letra = 'c';");
$letracper35 = mysqli_fetch_assoc($select_letracper35);

$select_letradper35 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper35 and letra = 'd';");
$letradper35 = mysqli_fetch_assoc($select_letradper35);

$select_letraeper35 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper35 and letra = 'e';");
$letraeper35 = mysqli_fetch_assoc($select_letraeper35);

  // Selecionando alternativa correta 35
  if ($letraaper35["correta"]==1){
    $alt_corr35 = "Letra A";
  }
  elseif ($letrabper35["correta"]==1){
       $alt_corr35 = "Letra B";
  }
  elseif ($letracper35["correta"]==1){
    $alt_corr35 = "Letra C";
  }
  elseif ($letradper35["correta"]==1){
    $alt_corr35 = "Letra D";
  }
  elseif ($letraeper35["correta"]==1){
    $alt_corr35 = "Letra E";
  }
}


// Verificando se a qt de perguntas é maior que 35
if ($qtperguntas > 35){
// Questão 36
// Selecionando os dados 36
$codper36 = $dados_prova['codper36'];
$select_codper36 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper36;");
$per36 = mysqli_fetch_assoc($select_codper36);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper36 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper36 and letra = 'a';");
$letraaper36 = mysqli_fetch_assoc($select_letraaper36);

$select_letrabper36 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper36 and letra = 'b';");
$letrabper36 = mysqli_fetch_assoc($select_letrabper36);

$select_letracper36 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper36 and letra = 'c';");
$letracper36 = mysqli_fetch_assoc($select_letracper36);

$select_letradper36 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper36 and letra = 'd';");
$letradper36 = mysqli_fetch_assoc($select_letradper36);

$select_letraeper36 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper36 and letra = 'e';");
$letraeper36 = mysqli_fetch_assoc($select_letraeper36);

  // Selecionando alternativa correta 36
  if ($letraaper36["correta"]==1){
    $alt_corr36 = "Letra A";
  }
  elseif ($letrabper36["correta"]==1){
       $alt_corr36 = "Letra B";
  }
  elseif ($letracper36["correta"]==1){
    $alt_corr36 = "Letra C";
  }
  elseif ($letradper36["correta"]==1){
    $alt_corr36 = "Letra D";
  }
  elseif ($letraeper36["correta"]==1){
    $alt_corr36 = "Letra E";
  }


// Questão 37
// Selecionando os dados 37
$codper37 = $dados_prova['codper37'];
$select_codper37 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper37;");
$per37 = mysqli_fetch_assoc($select_codper37);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper37 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper37 and letra = 'a';");
$letraaper37 = mysqli_fetch_assoc($select_letraaper37);

$select_letrabper37 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper37 and letra = 'b';");
$letrabper37 = mysqli_fetch_assoc($select_letrabper37);

$select_letracper37 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper37 and letra = 'c';");
$letracper37 = mysqli_fetch_assoc($select_letracper37);

$select_letradper37 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper37 and letra = 'd';");
$letradper37 = mysqli_fetch_assoc($select_letradper37);

$select_letraeper37 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper37 and letra = 'e';");
$letraeper37 = mysqli_fetch_assoc($select_letraeper37);

  // Selecionando alternativa correta 37
  if ($letraaper37["correta"]==1){
    $alt_corr37 = "Letra A";
  }
  elseif ($letrabper37["correta"]==1){
       $alt_corr37 = "Letra B";
  }
  elseif ($letracper37["correta"]==1){
    $alt_corr37 = "Letra C";
  }
  elseif ($letradper37["correta"]==1){
    $alt_corr37 = "Letra D";
  }
  elseif ($letraeper37["correta"]==1){
    $alt_corr37 = "Letra E";
  }


// Questão 38
// Selecionando os dados 38
$codper38 = $dados_prova['codper38'];
$select_codper38 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper38;");
$per38 = mysqli_fetch_assoc($select_codper38);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper38 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper38 and letra = 'a';");
$letraaper38 = mysqli_fetch_assoc($select_letraaper38);

$select_letrabper38 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper38 and letra = 'b';");
$letrabper38 = mysqli_fetch_assoc($select_letrabper38);

$select_letracper38 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper38 and letra = 'c';");
$letracper38 = mysqli_fetch_assoc($select_letracper38);

$select_letradper38 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper38 and letra = 'd';");
$letradper38 = mysqli_fetch_assoc($select_letradper38);

$select_letraeper38 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper38 and letra = 'e';");
$letraeper38 = mysqli_fetch_assoc($select_letraeper38);

  // Selecionando alternativa correta 38
  if ($letraaper38["correta"]==1){
    $alt_corr38 = "Letra A";
  }
  elseif ($letrabper38["correta"]==1){
       $alt_corr38 = "Letra B";
  }
  elseif ($letracper38["correta"]==1){
    $alt_corr38 = "Letra C";
  }
  elseif ($letradper38["correta"]==1){
    $alt_corr38 = "Letra D";
  }
  elseif ($letraeper38["correta"]==1){
    $alt_corr38 = "Letra E";
  }


// Questão 39
// Selecionando os dados 39
$codper39 = $dados_prova['codper39'];
$select_codper39 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper39;");
$per39 = mysqli_fetch_assoc($select_codper39);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper39 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper39 and letra = 'a';");
$letraaper39 = mysqli_fetch_assoc($select_letraaper39);

$select_letrabper39 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper39 and letra = 'b';");
$letrabper39 = mysqli_fetch_assoc($select_letrabper39);

$select_letracper39 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper39 and letra = 'c';");
$letracper39 = mysqli_fetch_assoc($select_letracper39);

$select_letradper39 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper39 and letra = 'd';");
$letradper39 = mysqli_fetch_assoc($select_letradper39);

$select_letraeper39 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper39 and letra = 'e';");
$letraeper39 = mysqli_fetch_assoc($select_letraeper39);

  // Selecionando alternativa correta 39
  if ($letraaper39["correta"]==1){
    $alt_corr39 = "Letra A";
  }
  elseif ($letrabper39["correta"]==1){
       $alt_corr39 = "Letra B";
  }
  elseif ($letracper39["correta"]==1){
    $alt_corr39 = "Letra C";
  }
  elseif ($letradper39["correta"]==1){
    $alt_corr39 = "Letra D";
  }
  elseif ($letraeper39["correta"]==1){
    $alt_corr39 = "Letra E";
  }


// Questão 40
// Selecionando os dados 40
$codper40 = $dados_prova['codper40'];
$select_codper40 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper40;");
$per40 = mysqli_fetch_assoc($select_codper40);


// Selecionando alternativas referentes a esa pergunta
$select_letraaper40 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper40 and letra = 'a';");
$letraaper40 = mysqli_fetch_assoc($select_letraaper40);

$select_letrabper40 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper40 and letra = 'b';");
$letrabper40 = mysqli_fetch_assoc($select_letrabper40);

$select_letracper40 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper40 and letra = 'c';");
$letracper40 = mysqli_fetch_assoc($select_letracper40);

$select_letradper40 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper40 and letra = 'd';");
$letradper40 = mysqli_fetch_assoc($select_letradper40);

$select_letraeper40 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper40 and letra = 'e';");
$letraeper40 = mysqli_fetch_assoc($select_letraeper40);

  // Selecionando alternativa correta 40
  if ($letraaper40["correta"]==1){
    $alt_corr40 = "Letra A";
  }
  elseif ($letrabper40["correta"]==1){
       $alt_corr40 = "Letra B";
  }
  elseif ($letracper40["correta"]==1){
    $alt_corr40 = "Letra C";
  }
  elseif ($letradper40["correta"]==1){
    $alt_corr40 = "Letra D";
  }
  elseif ($letraeper40["correta"]==1){
    $alt_corr40 = "Letra E";
  }
}


// Verificando se a qt de perguntas é maior que 40
if ($qtperguntas > 40){
    // Questão 41
    // Selecionando os dados 41
    $codper41 = $dados_prova['codper41'];
    $select_codper41 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper41;");
    $per41 = mysqli_fetch_assoc($select_codper41);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper41 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper41 and letra = 'a';");
    $letraaper41 = mysqli_fetch_assoc($select_letraaper41);
    
    $select_letrabper41 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper41 and letra = 'b';");
    $letrabper41 = mysqli_fetch_assoc($select_letrabper41);
    
    $select_letracper41 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper41 and letra = 'c';");
    $letracper41 = mysqli_fetch_assoc($select_letracper41);
    
    $select_letradper41 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper41 and letra = 'd';");
    $letradper41 = mysqli_fetch_assoc($select_letradper41);
    
    $select_letraeper41 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper41 and letra = 'e';");
    $letraeper41 = mysqli_fetch_assoc($select_letraeper41);
    
      // Selecionando alternativa correta 41
      if ($letraaper41["correta"]==1){
        $alt_corr41 = "Letra A";
      }
      elseif ($letrabper41["correta"]==1){
           $alt_corr41 = "Letra B";
      }
      elseif ($letracper41["correta"]==1){
        $alt_corr41 = "Letra C";
      }
      elseif ($letradper41["correta"]==1){
        $alt_corr41 = "Letra D";
      }
      elseif ($letraeper41["correta"]==1){
        $alt_corr41 = "Letra E";
      }
    
    
    // Questão 42
    // Selecionando os dados 42
    $codper42 = $dados_prova['codper42'];
    $select_codper42 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper42;");
    $per42 = mysqli_fetch_assoc($select_codper42);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper42 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper42 and letra = 'a';");
    $letraaper42 = mysqli_fetch_assoc($select_letraaper42);
    
    $select_letrabper42 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper42 and letra = 'b';");
    $letrabper42 = mysqli_fetch_assoc($select_letrabper42);
    
    $select_letracper42 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper42 and letra = 'c';");
    $letracper42 = mysqli_fetch_assoc($select_letracper42);
    
    $select_letradper42 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper42 and letra = 'd';");
    $letradper42 = mysqli_fetch_assoc($select_letradper42);
    
    $select_letraeper42 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper42 and letra = 'e';");
    $letraeper42 = mysqli_fetch_assoc($select_letraeper42);
    
      // Selecionando alternativa correta 42
      if ($letraaper42["correta"]==1){
        $alt_corr42 = "Letra A";
      }
      elseif ($letrabper42["correta"]==1){
           $alt_corr42 = "Letra B";
      }
      elseif ($letracper42["correta"]==1){
        $alt_corr42 = "Letra C";
      }
      elseif ($letradper42["correta"]==1){
        $alt_corr42 = "Letra D";
      }
      elseif ($letraeper42["correta"]==1){
        $alt_corr42 = "Letra E";
      }
    
    
    // Questão 43
    // Selecionando os dados 43
    $codper43 = $dados_prova['codper43'];
    $select_codper43 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper43;");
    $per43 = mysqli_fetch_assoc($select_codper43);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper43 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper43 and letra = 'a';");
    $letraaper43 = mysqli_fetch_assoc($select_letraaper43);
    
    $select_letrabper43 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper43 and letra = 'b';");
    $letrabper43 = mysqli_fetch_assoc($select_letrabper43);
    
    $select_letracper43 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper43 and letra = 'c';");
    $letracper43 = mysqli_fetch_assoc($select_letracper43);
    
    $select_letradper43 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper43 and letra = 'd';");
    $letradper43 = mysqli_fetch_assoc($select_letradper43);
    
    $select_letraeper43 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper43 and letra = 'e';");
    $letraeper43 = mysqli_fetch_assoc($select_letraeper43);
    
      // Selecionando alternativa correta 43
      if ($letraaper43["correta"]==1){
        $alt_corr43 = "Letra A";
      }
      elseif ($letrabper43["correta"]==1){
           $alt_corr43 = "Letra B";
      }
      elseif ($letracper43["correta"]==1){
        $alt_corr43 = "Letra C";
      }
      elseif ($letradper43["correta"]==1){
        $alt_corr43 = "Letra D";
      }
      elseif ($letraeper43["correta"]==1){
        $alt_corr43 = "Letra E";
      }
    
    
    // Questão 44
    // Selecionando os dados 44
    $codper44 = $dados_prova['codper44'];
    $select_codper44 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper44;");
    $per44 = mysqli_fetch_assoc($select_codper44);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper44 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper44 and letra = 'a';");
    $letraaper44 = mysqli_fetch_assoc($select_letraaper44);
    
    $select_letrabper44 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper44 and letra = 'b';");
    $letrabper44 = mysqli_fetch_assoc($select_letrabper44);
    
    $select_letracper44 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper44 and letra = 'c';");
    $letracper44 = mysqli_fetch_assoc($select_letracper44);
    
    $select_letradper44 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper44 and letra = 'd';");
    $letradper44 = mysqli_fetch_assoc($select_letradper44);
    
    $select_letraeper44 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper44 and letra = 'e';");
    $letraeper44 = mysqli_fetch_assoc($select_letraeper44);
    
      // Selecionando alternativa correta 44
      if ($letraaper44["correta"]==1){
        $alt_corr44 = "Letra A";
      }
      elseif ($letrabper44["correta"]==1){
           $alt_corr44 = "Letra B";
      }
      elseif ($letracper44["correta"]==1){
        $alt_corr44 = "Letra C";
      }
      elseif ($letradper44["correta"]==1){
        $alt_corr44 = "Letra D";
      }
      elseif ($letraeper44["correta"]==1){
        $alt_corr44 = "Letra E";
      }
    
    
    // Questão 45
    // Selecionando os dados 45
    $codper45 = $dados_prova['codper45'];
    $select_codper45 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper45;");
    $per45 = mysqli_fetch_assoc($select_codper45);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper45 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper45 and letra = 'a';");
    $letraaper45 = mysqli_fetch_assoc($select_letraaper45);
    
    $select_letrabper45 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper45 and letra = 'b';");
    $letrabper45 = mysqli_fetch_assoc($select_letrabper45);
    
    $select_letracper45 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper45 and letra = 'c';");
    $letracper45 = mysqli_fetch_assoc($select_letracper45);
    
    $select_letradper45 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper45 and letra = 'd';");
    $letradper45 = mysqli_fetch_assoc($select_letradper45);
    
    $select_letraeper45 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper45 and letra = 'e';");
    $letraeper45 = mysqli_fetch_assoc($select_letraeper45);
    
      // Selecionando alternativa correta 45
      if ($letraaper45["correta"]==1){
        $alt_corr45 = "Letra A";
      }
      elseif ($letrabper45["correta"]==1){
           $alt_corr45 = "Letra B";
      }
      elseif ($letracper45["correta"]==1){
        $alt_corr45 = "Letra C";
      }
      elseif ($letradper45["correta"]==1){
        $alt_corr45 = "Letra D";
      }
      elseif ($letraeper45["correta"]==1){
        $alt_corr45 = "Letra E";
      }
    }

// Verificando se a qt de perguntas é maior que 45
if ($qtperguntas > 45){
    // Questão 46
    // Selecionando os dados 46
    $codper46 = $dados_prova['codper46'];
    $select_codper46 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper46;");
    $per46 = mysqli_fetch_assoc($select_codper46);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper46 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper46 and letra = 'a';");
    $letraaper46 = mysqli_fetch_assoc($select_letraaper46);
    
    $select_letrabper46 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper46 and letra = 'b';");
    $letrabper46 = mysqli_fetch_assoc($select_letrabper46);
    
    $select_letracper46 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper46 and letra = 'c';");
    $letracper46 = mysqli_fetch_assoc($select_letracper46);
    
    $select_letradper46 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper46 and letra = 'd';");
    $letradper46 = mysqli_fetch_assoc($select_letradper46);
    
    $select_letraeper46 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper46 and letra = 'e';");
    $letraeper46 = mysqli_fetch_assoc($select_letraeper46);
    
      // Selecionando alternativa correta 46
      if ($letraaper46["correta"]==1){
        $alt_corr46 = "Letra A";
      }
      elseif ($letrabper46["correta"]==1){
           $alt_corr46 = "Letra B";
      }
      elseif ($letracper46["correta"]==1){
        $alt_corr46 = "Letra C";
      }
      elseif ($letradper46["correta"]==1){
        $alt_corr46 = "Letra D";
      }
      elseif ($letraeper46["correta"]==1){
        $alt_corr46 = "Letra E";
      }
    
    
    // Questão 47
    // Selecionando os dados 47
    $codper47 = $dados_prova['codper47'];
    $select_codper47 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper47;");
    $per47 = mysqli_fetch_assoc($select_codper47);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper47 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper47 and letra = 'a';");
    $letraaper47 = mysqli_fetch_assoc($select_letraaper47);
    
    $select_letrabper47 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper47 and letra = 'b';");
    $letrabper47 = mysqli_fetch_assoc($select_letrabper47);
    
    $select_letracper47 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper47 and letra = 'c';");
    $letracper47 = mysqli_fetch_assoc($select_letracper47);
    
    $select_letradper47 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper47 and letra = 'd';");
    $letradper47 = mysqli_fetch_assoc($select_letradper47);
    
    $select_letraeper47 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper47 and letra = 'e';");
    $letraeper47 = mysqli_fetch_assoc($select_letraeper47);
    
      // Selecionando alternativa correta 47
      if ($letraaper47["correta"]==1){
        $alt_corr47 = "Letra A";
      }
      elseif ($letrabper47["correta"]==1){
           $alt_corr47 = "Letra B";
      }
      elseif ($letracper47["correta"]==1){
        $alt_corr47 = "Letra C";
      }
      elseif ($letradper47["correta"]==1){
        $alt_corr47 = "Letra D";
      }
      elseif ($letraeper47["correta"]==1){
        $alt_corr47 = "Letra E";
      }
    
    
    // Questão 48
    // Selecionando os dados 48
    $codper48 = $dados_prova['codper48'];
    $select_codper48 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper48;");
    $per48 = mysqli_fetch_assoc($select_codper48);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper48 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper48 and letra = 'a';");
    $letraaper48 = mysqli_fetch_assoc($select_letraaper48);
    
    $select_letrabper48 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper48 and letra = 'b';");
    $letrabper48 = mysqli_fetch_assoc($select_letrabper48);
    
    $select_letracper48 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper48 and letra = 'c';");
    $letracper48 = mysqli_fetch_assoc($select_letracper48);
    
    $select_letradper48 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper48 and letra = 'd';");
    $letradper48 = mysqli_fetch_assoc($select_letradper48);
    
    $select_letraeper48 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper48 and letra = 'e';");
    $letraeper48 = mysqli_fetch_assoc($select_letraeper48);
    
      // Selecionando alternativa correta 48
      if ($letraaper48["correta"]==1){
        $alt_corr48 = "Letra A";
      }
      elseif ($letrabper48["correta"]==1){
           $alt_corr48 = "Letra B";
      }
      elseif ($letracper48["correta"]==1){
        $alt_corr48 = "Letra C";
      }
      elseif ($letradper48["correta"]==1){
        $alt_corr48 = "Letra D";
      }
      elseif ($letraeper48["correta"]==1){
        $alt_corr48 = "Letra E";
      }
    
    
    // Questão 49
    // Selecionando os dados 49
    $codper49 = $dados_prova['codper49'];
    $select_codper49 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper49;");
    $per49 = mysqli_fetch_assoc($select_codper49);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper49 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper49 and letra = 'a';");
    $letraaper49 = mysqli_fetch_assoc($select_letraaper49);
    
    $select_letrabper49 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper49 and letra = 'b';");
    $letrabper49 = mysqli_fetch_assoc($select_letrabper49);
    
    $select_letracper49 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper49 and letra = 'c';");
    $letracper49 = mysqli_fetch_assoc($select_letracper49);
    
    $select_letradper49 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper49 and letra = 'd';");
    $letradper49 = mysqli_fetch_assoc($select_letradper49);
    
    $select_letraeper49 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper49 and letra = 'e';");
    $letraeper49 = mysqli_fetch_assoc($select_letraeper49);
    
      // Selecionando alternativa correta 49
      if ($letraaper49["correta"]==1){
        $alt_corr49 = "Letra A";
      }
      elseif ($letrabper49["correta"]==1){
           $alt_corr49 = "Letra B";
      }
      elseif ($letracper49["correta"]==1){
        $alt_corr49 = "Letra C";
      }
      elseif ($letradper49["correta"]==1){
        $alt_corr49 = "Letra D";
      }
      elseif ($letraeper49["correta"]==1){
        $alt_corr49 = "Letra E";
      }
    
    
    // Questão 50
    // Selecionando os dados 50
    $codper50 = $dados_prova['codper50'];
    $select_codper50 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper50;");
    $per50 = mysqli_fetch_assoc($select_codper50);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper50 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper50 and letra = 'a';");
    $letraaper50 = mysqli_fetch_assoc($select_letraaper50);
    
    $select_letrabper50 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper50 and letra = 'b';");
    $letrabper50 = mysqli_fetch_assoc($select_letrabper50);
    
    $select_letracper50 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper50 and letra = 'c';");
    $letracper50 = mysqli_fetch_assoc($select_letracper50);
    
    $select_letradper50 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper50 and letra = 'd';");
    $letradper50 = mysqli_fetch_assoc($select_letradper50);
    
    $select_letraeper50 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper50 and letra = 'e';");
    $letraeper50 = mysqli_fetch_assoc($select_letraeper50);
    
      // Selecionando alternativa correta 50
      if ($letraaper50["correta"]==1){
        $alt_corr50 = "Letra A";
      }
      elseif ($letrabper50["correta"]==1){
           $alt_corr50 = "Letra B";
      }
      elseif ($letracper50["correta"]==1){
        $alt_corr50 = "Letra C";
      }
      elseif ($letradper50["correta"]==1){
        $alt_corr50 = "Letra D";
      }
      elseif ($letraeper50["correta"]==1){
        $alt_corr50 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 50
if ($qtperguntas > 50){
    // Questão 51
    // Selecionando os dados 51
    $codper51 = $dados_prova['codper51'];
    $select_codper51 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper51;");
    $per51 = mysqli_fetch_assoc($select_codper51);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper51 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper51 and letra = 'a';");
    $letraaper51 = mysqli_fetch_assoc($select_letraaper51);
    
    $select_letrabper51 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper51 and letra = 'b';");
    $letrabper51 = mysqli_fetch_assoc($select_letrabper51);
    
    $select_letracper51 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper51 and letra = 'c';");
    $letracper51 = mysqli_fetch_assoc($select_letracper51);
    
    $select_letradper51 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper51 and letra = 'd';");
    $letradper51 = mysqli_fetch_assoc($select_letradper51);
    
    $select_letraeper51 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper51 and letra = 'e';");
    $letraeper51 = mysqli_fetch_assoc($select_letraeper51);
    
      // Selecionando alternativa correta 51
      if ($letraaper51["correta"]==1){
        $alt_corr51 = "Letra A";
      }
      elseif ($letrabper51["correta"]==1){
           $alt_corr51 = "Letra B";
      }
      elseif ($letracper51["correta"]==1){
        $alt_corr51 = "Letra C";
      }
      elseif ($letradper51["correta"]==1){
        $alt_corr51 = "Letra D";
      }
      elseif ($letraeper51["correta"]==1){
        $alt_corr51 = "Letra E";
      }
    
    
    // Questão 52
    // Selecionando os dados 52
    $codper52 = $dados_prova['codper52'];
    $select_codper52 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper52;");
    $per52 = mysqli_fetch_assoc($select_codper52);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper52 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper52 and letra = 'a';");
    $letraaper52 = mysqli_fetch_assoc($select_letraaper52);
    
    $select_letrabper52 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper52 and letra = 'b';");
    $letrabper52 = mysqli_fetch_assoc($select_letrabper52);
    
    $select_letracper52 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper52 and letra = 'c';");
    $letracper52 = mysqli_fetch_assoc($select_letracper52);
    
    $select_letradper52 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper52 and letra = 'd';");
    $letradper52 = mysqli_fetch_assoc($select_letradper52);
    
    $select_letraeper52 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper52 and letra = 'e';");
    $letraeper52 = mysqli_fetch_assoc($select_letraeper52);
    
      // Selecionando alternativa correta 52
      if ($letraaper52["correta"]==1){
        $alt_corr52 = "Letra A";
      }
      elseif ($letrabper52["correta"]==1){
           $alt_corr52 = "Letra B";
      }
      elseif ($letracper52["correta"]==1){
        $alt_corr52 = "Letra C";
      }
      elseif ($letradper52["correta"]==1){
        $alt_corr52 = "Letra D";
      }
      elseif ($letraeper52["correta"]==1){
        $alt_corr52 = "Letra E";
      }
    
    
    // Questão 53
    // Selecionando os dados 53
    $codper53 = $dados_prova['codper53'];
    $select_codper53 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper53;");
    $per53 = mysqli_fetch_assoc($select_codper53);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper53 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper53 and letra = 'a';");
    $letraaper53 = mysqli_fetch_assoc($select_letraaper53);
    
    $select_letrabper53 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper53 and letra = 'b';");
    $letrabper53 = mysqli_fetch_assoc($select_letrabper53);
    
    $select_letracper53 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper53 and letra = 'c';");
    $letracper53 = mysqli_fetch_assoc($select_letracper53);
    
    $select_letradper53 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper53 and letra = 'd';");
    $letradper53 = mysqli_fetch_assoc($select_letradper53);
    
    $select_letraeper53 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper53 and letra = 'e';");
    $letraeper53 = mysqli_fetch_assoc($select_letraeper53);
    
      // Selecionando alternativa correta 53
      if ($letraaper53["correta"]==1){
        $alt_corr53 = "Letra A";
      }
      elseif ($letrabper53["correta"]==1){
           $alt_corr53 = "Letra B";
      }
      elseif ($letracper53["correta"]==1){
        $alt_corr53 = "Letra C";
      }
      elseif ($letradper53["correta"]==1){
        $alt_corr53 = "Letra D";
      }
      elseif ($letraeper53["correta"]==1){
        $alt_corr53 = "Letra E";
      }
    
    
    // Questão 54
    // Selecionando os dados 54
    $codper54 = $dados_prova['codper54'];
    $select_codper54 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper54;");
    $per54 = mysqli_fetch_assoc($select_codper54);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper54 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper54 and letra = 'a';");
    $letraaper54 = mysqli_fetch_assoc($select_letraaper54);
    
    $select_letrabper54 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper54 and letra = 'b';");
    $letrabper54 = mysqli_fetch_assoc($select_letrabper54);
    
    $select_letracper54 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper54 and letra = 'c';");
    $letracper54 = mysqli_fetch_assoc($select_letracper54);
    
    $select_letradper54 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper54 and letra = 'd';");
    $letradper54 = mysqli_fetch_assoc($select_letradper54);
    
    $select_letraeper54 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper54 and letra = 'e';");
    $letraeper54 = mysqli_fetch_assoc($select_letraeper54);
    
      // Selecionando alternativa correta 54
      if ($letraaper54["correta"]==1){
        $alt_corr54 = "Letra A";
      }
      elseif ($letrabper54["correta"]==1){
           $alt_corr54 = "Letra B";
      }
      elseif ($letracper54["correta"]==1){
        $alt_corr54 = "Letra C";
      }
      elseif ($letradper54["correta"]==1){
        $alt_corr54 = "Letra D";
      }
      elseif ($letraeper54["correta"]==1){
        $alt_corr54 = "Letra E";
      }
    
    
    // Questão 55
    // Selecionando os dados 55
    $codper55 = $dados_prova['codper55'];
    $select_codper55 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper55;");
    $per55 = mysqli_fetch_assoc($select_codper55);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper55 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper55 and letra = 'a';");
    $letraaper55 = mysqli_fetch_assoc($select_letraaper55);
    
    $select_letrabper55 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper55 and letra = 'b';");
    $letrabper55 = mysqli_fetch_assoc($select_letrabper55);
    
    $select_letracper55 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper55 and letra = 'c';");
    $letracper55 = mysqli_fetch_assoc($select_letracper55);
    
    $select_letradper55 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper55 and letra = 'd';");
    $letradper55 = mysqli_fetch_assoc($select_letradper55);
    
    $select_letraeper55 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper55 and letra = 'e';");
    $letraeper55 = mysqli_fetch_assoc($select_letraeper55);
    
      // Selecionando alternativa correta 55
      if ($letraaper55["correta"]==1){
        $alt_corr55 = "Letra A";
      }
      elseif ($letrabper55["correta"]==1){
           $alt_corr55 = "Letra B";
      }
      elseif ($letracper55["correta"]==1){
        $alt_corr55 = "Letra C";
      }
      elseif ($letradper55["correta"]==1){
        $alt_corr55 = "Letra D";
      }
      elseif ($letraeper55["correta"]==1){
        $alt_corr55 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 55
if ($qtperguntas > 55){
    // Questão 56
    // Selecionando os dados 56
    $codper56 = $dados_prova['codper56'];
    $select_codper56 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper56;");
    $per56 = mysqli_fetch_assoc($select_codper56);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper56 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper56 and letra = 'a';");
    $letraaper56 = mysqli_fetch_assoc($select_letraaper56);
    
    $select_letrabper56 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper56 and letra = 'b';");
    $letrabper56 = mysqli_fetch_assoc($select_letrabper56);
    
    $select_letracper56 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper56 and letra = 'c';");
    $letracper56 = mysqli_fetch_assoc($select_letracper56);
    
    $select_letradper56 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper56 and letra = 'd';");
    $letradper56 = mysqli_fetch_assoc($select_letradper56);
    
    $select_letraeper56 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper56 and letra = 'e';");
    $letraeper56 = mysqli_fetch_assoc($select_letraeper56);
    
      // Selecionando alternativa correta 56
      if ($letraaper56["correta"]==1){
        $alt_corr56 = "Letra A";
      }
      elseif ($letrabper56["correta"]==1){
           $alt_corr56 = "Letra B";
      }
      elseif ($letracper56["correta"]==1){
        $alt_corr56 = "Letra C";
      }
      elseif ($letradper56["correta"]==1){
        $alt_corr56 = "Letra D";
      }
      elseif ($letraeper56["correta"]==1){
        $alt_corr56 = "Letra E";
      }
    
    
    // Questão 57
    // Selecionando os dados 57
    $codper57 = $dados_prova['codper57'];
    $select_codper57 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper57;");
    $per57 = mysqli_fetch_assoc($select_codper57);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper57 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper57 and letra = 'a';");
    $letraaper57 = mysqli_fetch_assoc($select_letraaper57);
    
    $select_letrabper57 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper57 and letra = 'b';");
    $letrabper57 = mysqli_fetch_assoc($select_letrabper57);
    
    $select_letracper57 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper57 and letra = 'c';");
    $letracper57 = mysqli_fetch_assoc($select_letracper57);
    
    $select_letradper57 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper57 and letra = 'd';");
    $letradper57 = mysqli_fetch_assoc($select_letradper57);
    
    $select_letraeper57 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper57 and letra = 'e';");
    $letraeper57 = mysqli_fetch_assoc($select_letraeper57);
    
      // Selecionando alternativa correta 57
      if ($letraaper57["correta"]==1){
        $alt_corr57 = "Letra A";
      }
      elseif ($letrabper57["correta"]==1){
           $alt_corr57 = "Letra B";
      }
      elseif ($letracper57["correta"]==1){
        $alt_corr57 = "Letra C";
      }
      elseif ($letradper57["correta"]==1){
        $alt_corr57 = "Letra D";
      }
      elseif ($letraeper57["correta"]==1){
        $alt_corr57 = "Letra E";
      }
    
    
    // Questão 58
    // Selecionando os dados 58
    $codper58 = $dados_prova['codper58'];
    $select_codper58 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper58;");
    $per58 = mysqli_fetch_assoc($select_codper58);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper58 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper58 and letra = 'a';");
    $letraaper58 = mysqli_fetch_assoc($select_letraaper58);
    
    $select_letrabper58 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper58 and letra = 'b';");
    $letrabper58 = mysqli_fetch_assoc($select_letrabper58);
    
    $select_letracper58 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper58 and letra = 'c';");
    $letracper58 = mysqli_fetch_assoc($select_letracper58);
    
    $select_letradper58 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper58 and letra = 'd';");
    $letradper58 = mysqli_fetch_assoc($select_letradper58);
    
    $select_letraeper58 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper58 and letra = 'e';");
    $letraeper58 = mysqli_fetch_assoc($select_letraeper58);
    
      // Selecionando alternativa correta 58
      if ($letraaper58["correta"]==1){
        $alt_corr58 = "Letra A";
      }
      elseif ($letrabper58["correta"]==1){
           $alt_corr58 = "Letra B";
      }
      elseif ($letracper58["correta"]==1){
        $alt_corr58 = "Letra C";
      }
      elseif ($letradper58["correta"]==1){
        $alt_corr58 = "Letra D";
      }
      elseif ($letraeper58["correta"]==1){
        $alt_corr58 = "Letra E";
      }
    
    
    // Questão 59
    // Selecionando os dados 59
    $codper59 = $dados_prova['codper59'];
    $select_codper59 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper59;");
    $per59 = mysqli_fetch_assoc($select_codper59);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper59 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper59 and letra = 'a';");
    $letraaper59 = mysqli_fetch_assoc($select_letraaper59);
    
    $select_letrabper59 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper59 and letra = 'b';");
    $letrabper59 = mysqli_fetch_assoc($select_letrabper59);
    
    $select_letracper59 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper59 and letra = 'c';");
    $letracper59 = mysqli_fetch_assoc($select_letracper59);
    
    $select_letradper59 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper59 and letra = 'd';");
    $letradper59 = mysqli_fetch_assoc($select_letradper59);
    
    $select_letraeper59 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper59 and letra = 'e';");
    $letraeper59 = mysqli_fetch_assoc($select_letraeper59);
    
      // Selecionando alternativa correta 59
      if ($letraaper59["correta"]==1){
        $alt_corr59 = "Letra A";
      }
      elseif ($letrabper59["correta"]==1){
           $alt_corr59 = "Letra B";
      }
      elseif ($letracper59["correta"]==1){
        $alt_corr59 = "Letra C";
      }
      elseif ($letradper59["correta"]==1){
        $alt_corr59 = "Letra D";
      }
      elseif ($letraeper59["correta"]==1){
        $alt_corr59 = "Letra E";
      }
    
    
    // Questão 60
    // Selecionando os dados 60
    $codper60 = $dados_prova['codper60'];
    $select_codper60 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper60;");
    $per60 = mysqli_fetch_assoc($select_codper60);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper60 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper60 and letra = 'a';");
    $letraaper60 = mysqli_fetch_assoc($select_letraaper60);
    
    $select_letrabper60 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper60 and letra = 'b';");
    $letrabper60 = mysqli_fetch_assoc($select_letrabper60);
    
    $select_letracper60 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper60 and letra = 'c';");
    $letracper60 = mysqli_fetch_assoc($select_letracper60);
    
    $select_letradper60 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper60 and letra = 'd';");
    $letradper60 = mysqli_fetch_assoc($select_letradper60);
    
    $select_letraeper60 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper60 and letra = 'e';");
    $letraeper60 = mysqli_fetch_assoc($select_letraeper60);
    
      // Selecionando alternativa correta 60
      if ($letraaper60["correta"]==1){
        $alt_corr60 = "Letra A";
      }
      elseif ($letrabper60["correta"]==1){
           $alt_corr60 = "Letra B";
      }
      elseif ($letracper60["correta"]==1){
        $alt_corr60 = "Letra C";
      }
      elseif ($letradper60["correta"]==1){
        $alt_corr60 = "Letra D";
      }
      elseif ($letraeper60["correta"]==1){
        $alt_corr60 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 60
if ($qtperguntas > 60){
    // Questão 61
    // Selecionando os dados 61
    $codper61 = $dados_prova['codper61'];
    $select_codper61 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper61;");
    $per61 = mysqli_fetch_assoc($select_codper61);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper61 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper61 and letra = 'a';");
    $letraaper61 = mysqli_fetch_assoc($select_letraaper61);
    
    $select_letrabper61 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper61 and letra = 'b';");
    $letrabper61 = mysqli_fetch_assoc($select_letrabper61);
    
    $select_letracper61 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper61 and letra = 'c';");
    $letracper61 = mysqli_fetch_assoc($select_letracper61);
    
    $select_letradper61 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper61 and letra = 'd';");
    $letradper61 = mysqli_fetch_assoc($select_letradper61);
    
    $select_letraeper61 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper61 and letra = 'e';");
    $letraeper61 = mysqli_fetch_assoc($select_letraeper61);
    
      // Selecionando alternativa correta 61
      if ($letraaper61["correta"]==1){
        $alt_corr61 = "Letra A";
      }
      elseif ($letrabper61["correta"]==1){
           $alt_corr61 = "Letra B";
      }
      elseif ($letracper61["correta"]==1){
        $alt_corr61 = "Letra C";
      }
      elseif ($letradper61["correta"]==1){
        $alt_corr61 = "Letra D";
      }
      elseif ($letraeper61["correta"]==1){
        $alt_corr61 = "Letra E";
      }
    
    
    // Questão 62
    // Selecionando os dados 62
    $codper62 = $dados_prova['codper62'];
    $select_codper62 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper62;");
    $per62 = mysqli_fetch_assoc($select_codper62);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper62 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper62 and letra = 'a';");
    $letraaper62 = mysqli_fetch_assoc($select_letraaper62);
    
    $select_letrabper62 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper62 and letra = 'b';");
    $letrabper62 = mysqli_fetch_assoc($select_letrabper62);
    
    $select_letracper62 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper62 and letra = 'c';");
    $letracper62 = mysqli_fetch_assoc($select_letracper62);
    
    $select_letradper62 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper62 and letra = 'd';");
    $letradper62 = mysqli_fetch_assoc($select_letradper62);
    
    $select_letraeper62 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper62 and letra = 'e';");
    $letraeper62 = mysqli_fetch_assoc($select_letraeper62);
    
      // Selecionando alternativa correta 62
      if ($letraaper62["correta"]==1){
        $alt_corr62 = "Letra A";
      }
      elseif ($letrabper62["correta"]==1){
           $alt_corr62 = "Letra B";
      }
      elseif ($letracper62["correta"]==1){
        $alt_corr62 = "Letra C";
      }
      elseif ($letradper62["correta"]==1){
        $alt_corr62 = "Letra D";
      }
      elseif ($letraeper62["correta"]==1){
        $alt_corr62 = "Letra E";
      }
    
    
    // Questão 63
    // Selecionando os dados 63
    $codper63 = $dados_prova['codper63'];
    $select_codper63 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper63;");
    $per63 = mysqli_fetch_assoc($select_codper63);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper63 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper63 and letra = 'a';");
    $letraaper63 = mysqli_fetch_assoc($select_letraaper63);
    
    $select_letrabper63 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper63 and letra = 'b';");
    $letrabper63 = mysqli_fetch_assoc($select_letrabper63);
    
    $select_letracper63 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper63 and letra = 'c';");
    $letracper63 = mysqli_fetch_assoc($select_letracper63);
    
    $select_letradper63 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper63 and letra = 'd';");
    $letradper63 = mysqli_fetch_assoc($select_letradper63);
    
    $select_letraeper63 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper63 and letra = 'e';");
    $letraeper63 = mysqli_fetch_assoc($select_letraeper63);
    
      // Selecionando alternativa correta 63
      if ($letraaper63["correta"]==1){
        $alt_corr63 = "Letra A";
      }
      elseif ($letrabper63["correta"]==1){
           $alt_corr63 = "Letra B";
      }
      elseif ($letracper63["correta"]==1){
        $alt_corr63 = "Letra C";
      }
      elseif ($letradper63["correta"]==1){
        $alt_corr63 = "Letra D";
      }
      elseif ($letraeper63["correta"]==1){
        $alt_corr63 = "Letra E";
      }
    
    
    // Questão 64
    // Selecionando os dados 64
    $codper64 = $dados_prova['codper64'];
    $select_codper64 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper64;");
    $per64 = mysqli_fetch_assoc($select_codper64);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper64 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper64 and letra = 'a';");
    $letraaper64 = mysqli_fetch_assoc($select_letraaper64);
    
    $select_letrabper64 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper64 and letra = 'b';");
    $letrabper64 = mysqli_fetch_assoc($select_letrabper64);
    
    $select_letracper64 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper64 and letra = 'c';");
    $letracper64 = mysqli_fetch_assoc($select_letracper64);
    
    $select_letradper64 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper64 and letra = 'd';");
    $letradper64 = mysqli_fetch_assoc($select_letradper64);
    
    $select_letraeper64 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper64 and letra = 'e';");
    $letraeper64 = mysqli_fetch_assoc($select_letraeper64);
    
      // Selecionando alternativa correta 64
      if ($letraaper64["correta"]==1){
        $alt_corr64 = "Letra A";
      }
      elseif ($letrabper64["correta"]==1){
           $alt_corr64 = "Letra B";
      }
      elseif ($letracper64["correta"]==1){
        $alt_corr64 = "Letra C";
      }
      elseif ($letradper64["correta"]==1){
        $alt_corr64 = "Letra D";
      }
      elseif ($letraeper64["correta"]==1){
        $alt_corr64 = "Letra E";
      }
    
    
    // Questão 65
    // Selecionando os dados 65
    $codper65 = $dados_prova['codper65'];
    $select_codper65 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper65;");
    $per65 = mysqli_fetch_assoc($select_codper65);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper65 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper65 and letra = 'a';");
    $letraaper65 = mysqli_fetch_assoc($select_letraaper65);
    
    $select_letrabper65 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper65 and letra = 'b';");
    $letrabper65 = mysqli_fetch_assoc($select_letrabper65);
    
    $select_letracper65 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper65 and letra = 'c';");
    $letracper65 = mysqli_fetch_assoc($select_letracper65);
    
    $select_letradper65 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper65 and letra = 'd';");
    $letradper65 = mysqli_fetch_assoc($select_letradper65);
    
    $select_letraeper65 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper65 and letra = 'e';");
    $letraeper65 = mysqli_fetch_assoc($select_letraeper65);
    
      // Selecionando alternativa correta 65
      if ($letraaper65["correta"]==1){
        $alt_corr65 = "Letra A";
      }
      elseif ($letrabper65["correta"]==1){
           $alt_corr65 = "Letra B";
      }
      elseif ($letracper65["correta"]==1){
        $alt_corr65 = "Letra C";
      }
      elseif ($letradper65["correta"]==1){
        $alt_corr65 = "Letra D";
      }
      elseif ($letraeper65["correta"]==1){
        $alt_corr65 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 65
if ($qtperguntas > 65){
    // Questão 66
    // Selecionando os dados 66
    $codper66 = $dados_prova['codper66'];
    $select_codper66 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper66;");
    $per66 = mysqli_fetch_assoc($select_codper66);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper66 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper66 and letra = 'a';");
    $letraaper66 = mysqli_fetch_assoc($select_letraaper66);
    
    $select_letrabper66 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper66 and letra = 'b';");
    $letrabper66 = mysqli_fetch_assoc($select_letrabper66);
    
    $select_letracper66 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper66 and letra = 'c';");
    $letracper66 = mysqli_fetch_assoc($select_letracper66);
    
    $select_letradper66 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper66 and letra = 'd';");
    $letradper66 = mysqli_fetch_assoc($select_letradper66);
    
    $select_letraeper66 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper66 and letra = 'e';");
    $letraeper66 = mysqli_fetch_assoc($select_letraeper66);
    
      // Selecionando alternativa correta 66
      if ($letraaper66["correta"]==1){
        $alt_corr66 = "Letra A";
      }
      elseif ($letrabper66["correta"]==1){
           $alt_corr66 = "Letra B";
      }
      elseif ($letracper66["correta"]==1){
        $alt_corr66 = "Letra C";
      }
      elseif ($letradper66["correta"]==1){
        $alt_corr66 = "Letra D";
      }
      elseif ($letraeper66["correta"]==1){
        $alt_corr66 = "Letra E";
      }
    
    
    // Questão 67
    // Selecionando os dados 67
    $codper67 = $dados_prova['codper67'];
    $select_codper67 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper67;");
    $per67 = mysqli_fetch_assoc($select_codper67);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper67 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper67 and letra = 'a';");
    $letraaper67 = mysqli_fetch_assoc($select_letraaper67);
    
    $select_letrabper67 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper67 and letra = 'b';");
    $letrabper67 = mysqli_fetch_assoc($select_letrabper67);
    
    $select_letracper67 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper67 and letra = 'c';");
    $letracper67 = mysqli_fetch_assoc($select_letracper67);
    
    $select_letradper67 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper67 and letra = 'd';");
    $letradper67 = mysqli_fetch_assoc($select_letradper67);
    
    $select_letraeper67 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper67 and letra = 'e';");
    $letraeper67 = mysqli_fetch_assoc($select_letraeper67);
    
      // Selecionando alternativa correta 67
      if ($letraaper67["correta"]==1){
        $alt_corr67 = "Letra A";
      }
      elseif ($letrabper67["correta"]==1){
           $alt_corr67 = "Letra B";
      }
      elseif ($letracper67["correta"]==1){
        $alt_corr67 = "Letra C";
      }
      elseif ($letradper67["correta"]==1){
        $alt_corr67 = "Letra D";
      }
      elseif ($letraeper67["correta"]==1){
        $alt_corr67 = "Letra E";
      }
    
    
    // Questão 68
    // Selecionando os dados 68
    $codper68 = $dados_prova['codper68'];
    $select_codper68 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper68;");
    $per68 = mysqli_fetch_assoc($select_codper68);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper68 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper68 and letra = 'a';");
    $letraaper68 = mysqli_fetch_assoc($select_letraaper68);
    
    $select_letrabper68 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper68 and letra = 'b';");
    $letrabper68 = mysqli_fetch_assoc($select_letrabper68);
    
    $select_letracper68 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper68 and letra = 'c';");
    $letracper68 = mysqli_fetch_assoc($select_letracper68);
    
    $select_letradper68 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper68 and letra = 'd';");
    $letradper68 = mysqli_fetch_assoc($select_letradper68);
    
    $select_letraeper68 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper68 and letra = 'e';");
    $letraeper68 = mysqli_fetch_assoc($select_letraeper68);
    
      // Selecionando alternativa correta 68
      if ($letraaper68["correta"]==1){
        $alt_corr68 = "Letra A";
      }
      elseif ($letrabper68["correta"]==1){
           $alt_corr68 = "Letra B";
      }
      elseif ($letracper68["correta"]==1){
        $alt_corr68 = "Letra C";
      }
      elseif ($letradper68["correta"]==1){
        $alt_corr68 = "Letra D";
      }
      elseif ($letraeper68["correta"]==1){
        $alt_corr68 = "Letra E";
      }
    
    
    // Questão 69
    // Selecionando os dados 69
    $codper69 = $dados_prova['codper69'];
    $select_codper69 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper69;");
    $per69 = mysqli_fetch_assoc($select_codper69);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper69 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper69 and letra = 'a';");
    $letraaper69 = mysqli_fetch_assoc($select_letraaper69);
    
    $select_letrabper69 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper69 and letra = 'b';");
    $letrabper69 = mysqli_fetch_assoc($select_letrabper69);
    
    $select_letracper69 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper69 and letra = 'c';");
    $letracper69 = mysqli_fetch_assoc($select_letracper69);
    
    $select_letradper69 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper69 and letra = 'd';");
    $letradper69 = mysqli_fetch_assoc($select_letradper69);
    
    $select_letraeper69 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper69 and letra = 'e';");
    $letraeper69 = mysqli_fetch_assoc($select_letraeper69);
    
      // Selecionando alternativa correta 69
      if ($letraaper69["correta"]==1){
        $alt_corr69 = "Letra A";
      }
      elseif ($letrabper69["correta"]==1){
           $alt_corr69 = "Letra B";
      }
      elseif ($letracper69["correta"]==1){
        $alt_corr69 = "Letra C";
      }
      elseif ($letradper69["correta"]==1){
        $alt_corr69 = "Letra D";
      }
      elseif ($letraeper69["correta"]==1){
        $alt_corr69 = "Letra E";
      }
    
    
    // Questão 70
    // Selecionando os dados 70
    $codper70 = $dados_prova['codper70'];
    $select_codper70 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper70;");
    $per70 = mysqli_fetch_assoc($select_codper70);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper70 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper70 and letra = 'a';");
    $letraaper70 = mysqli_fetch_assoc($select_letraaper70);
    
    $select_letrabper70 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper70 and letra = 'b';");
    $letrabper70 = mysqli_fetch_assoc($select_letrabper70);
    
    $select_letracper70 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper70 and letra = 'c';");
    $letracper70 = mysqli_fetch_assoc($select_letracper70);
    
    $select_letradper70 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper70 and letra = 'd';");
    $letradper70 = mysqli_fetch_assoc($select_letradper70);
    
    $select_letraeper70 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper70 and letra = 'e';");
    $letraeper70 = mysqli_fetch_assoc($select_letraeper70);
    
      // Selecionando alternativa correta 70
      if ($letraaper70["correta"]==1){
        $alt_corr70 = "Letra A";
      }
      elseif ($letrabper70["correta"]==1){
           $alt_corr70 = "Letra B";
      }
      elseif ($letracper70["correta"]==1){
        $alt_corr70 = "Letra C";
      }
      elseif ($letradper70["correta"]==1){
        $alt_corr70 = "Letra D";
      }
      elseif ($letraeper70["correta"]==1){
        $alt_corr70 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 70
if ($qtperguntas > 70){
    // Questão 71
    // Selecionando os dados 71
    $codper71 = $dados_prova['codper71'];
    $select_codper71 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper71;");
    $per71 = mysqli_fetch_assoc($select_codper71);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper71 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper71 and letra = 'a';");
    $letraaper71 = mysqli_fetch_assoc($select_letraaper71);
    
    $select_letrabper71 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper71 and letra = 'b';");
    $letrabper71 = mysqli_fetch_assoc($select_letrabper71);
    
    $select_letracper71 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper71 and letra = 'c';");
    $letracper71 = mysqli_fetch_assoc($select_letracper71);
    
    $select_letradper71 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper71 and letra = 'd';");
    $letradper71 = mysqli_fetch_assoc($select_letradper71);
    
    $select_letraeper71 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper71 and letra = 'e';");
    $letraeper71 = mysqli_fetch_assoc($select_letraeper71);
    
      // Selecionando alternativa correta 71
      if ($letraaper71["correta"]==1){
        $alt_corr71 = "Letra A";
      }
      elseif ($letrabper71["correta"]==1){
           $alt_corr71 = "Letra B";
      }
      elseif ($letracper71["correta"]==1){
        $alt_corr71 = "Letra C";
      }
      elseif ($letradper71["correta"]==1){
        $alt_corr71 = "Letra D";
      }
      elseif ($letraeper71["correta"]==1){
        $alt_corr71 = "Letra E";
      }
    
    
    // Questão 72
    // Selecionando os dados 72
    $codper72 = $dados_prova['codper72'];
    $select_codper72 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper72;");
    $per72 = mysqli_fetch_assoc($select_codper72);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper72 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper72 and letra = 'a';");
    $letraaper72 = mysqli_fetch_assoc($select_letraaper72);
    
    $select_letrabper72 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper72 and letra = 'b';");
    $letrabper72 = mysqli_fetch_assoc($select_letrabper72);
    
    $select_letracper72 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper72 and letra = 'c';");
    $letracper72 = mysqli_fetch_assoc($select_letracper72);
    
    $select_letradper72 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper72 and letra = 'd';");
    $letradper72 = mysqli_fetch_assoc($select_letradper72);
    
    $select_letraeper72 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper72 and letra = 'e';");
    $letraeper72 = mysqli_fetch_assoc($select_letraeper72);
    
      // Selecionando alternativa correta 72
      if ($letraaper72["correta"]==1){
        $alt_corr72 = "Letra A";
      }
      elseif ($letrabper72["correta"]==1){
           $alt_corr72 = "Letra B";
      }
      elseif ($letracper72["correta"]==1){
        $alt_corr72 = "Letra C";
      }
      elseif ($letradper72["correta"]==1){
        $alt_corr72 = "Letra D";
      }
      elseif ($letraeper72["correta"]==1){
        $alt_corr72 = "Letra E";
      }
    
    
    // Questão 73
    // Selecionando os dados 73
    $codper73 = $dados_prova['codper73'];
    $select_codper73 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper73;");
    $per73 = mysqli_fetch_assoc($select_codper73);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper73 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper73 and letra = 'a';");
    $letraaper73 = mysqli_fetch_assoc($select_letraaper73);
    
    $select_letrabper73 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper73 and letra = 'b';");
    $letrabper73 = mysqli_fetch_assoc($select_letrabper73);
    
    $select_letracper73 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper73 and letra = 'c';");
    $letracper73 = mysqli_fetch_assoc($select_letracper73);
    
    $select_letradper73 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper73 and letra = 'd';");
    $letradper73 = mysqli_fetch_assoc($select_letradper73);
    
    $select_letraeper73 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper73 and letra = 'e';");
    $letraeper73 = mysqli_fetch_assoc($select_letraeper73);
    
      // Selecionando alternativa correta 73
      if ($letraaper73["correta"]==1){
        $alt_corr73 = "Letra A";
      }
      elseif ($letrabper73["correta"]==1){
           $alt_corr73 = "Letra B";
      }
      elseif ($letracper73["correta"]==1){
        $alt_corr73 = "Letra C";
      }
      elseif ($letradper73["correta"]==1){
        $alt_corr73 = "Letra D";
      }
      elseif ($letraeper73["correta"]==1){
        $alt_corr73 = "Letra E";
      }
    
    
    // Questão 74
    // Selecionando os dados 74
    $codper74 = $dados_prova['codper74'];
    $select_codper74 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper74;");
    $per74 = mysqli_fetch_assoc($select_codper74);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper74 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper74 and letra = 'a';");
    $letraaper74 = mysqli_fetch_assoc($select_letraaper74);
    
    $select_letrabper74 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper74 and letra = 'b';");
    $letrabper74 = mysqli_fetch_assoc($select_letrabper74);
    
    $select_letracper74 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper74 and letra = 'c';");
    $letracper74 = mysqli_fetch_assoc($select_letracper74);
    
    $select_letradper74 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper74 and letra = 'd';");
    $letradper74 = mysqli_fetch_assoc($select_letradper74);
    
    $select_letraeper74 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper74 and letra = 'e';");
    $letraeper74 = mysqli_fetch_assoc($select_letraeper74);
    
      // Selecionando alternativa correta 74
      if ($letraaper74["correta"]==1){
        $alt_corr74 = "Letra A";
      }
      elseif ($letrabper74["correta"]==1){
           $alt_corr74 = "Letra B";
      }
      elseif ($letracper74["correta"]==1){
        $alt_corr74 = "Letra C";
      }
      elseif ($letradper74["correta"]==1){
        $alt_corr74 = "Letra D";
      }
      elseif ($letraeper74["correta"]==1){
        $alt_corr74 = "Letra E";
      }
    
    
    // Questão 75
    // Selecionando os dados 75
    $codper75 = $dados_prova['codper75'];
    $select_codper75 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper75;");
    $per75 = mysqli_fetch_assoc($select_codper75);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper75 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper75 and letra = 'a';");
    $letraaper75 = mysqli_fetch_assoc($select_letraaper75);
    
    $select_letrabper75 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper75 and letra = 'b';");
    $letrabper75 = mysqli_fetch_assoc($select_letrabper75);
    
    $select_letracper75 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper75 and letra = 'c';");
    $letracper75 = mysqli_fetch_assoc($select_letracper75);
    
    $select_letradper75 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper75 and letra = 'd';");
    $letradper75 = mysqli_fetch_assoc($select_letradper75);
    
    $select_letraeper75 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper75 and letra = 'e';");
    $letraeper75 = mysqli_fetch_assoc($select_letraeper75);
    
      // Selecionando alternativa correta 75
      if ($letraaper75["correta"]==1){
        $alt_corr75 = "Letra A";
      }
      elseif ($letrabper75["correta"]==1){
           $alt_corr75 = "Letra B";
      }
      elseif ($letracper75["correta"]==1){
        $alt_corr75 = "Letra C";
      }
      elseif ($letradper75["correta"]==1){
        $alt_corr75 = "Letra D";
      }
      elseif ($letraeper75["correta"]==1){
        $alt_corr75 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 75
if ($qtperguntas > 75){
    // Questão 76
    // Selecionando os dados 76
    $codper76 = $dados_prova['codper76'];
    $select_codper76 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper76;");
    $per76 = mysqli_fetch_assoc($select_codper76);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper76 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper76 and letra = 'a';");
    $letraaper76 = mysqli_fetch_assoc($select_letraaper76);
    
    $select_letrabper76 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper76 and letra = 'b';");
    $letrabper76 = mysqli_fetch_assoc($select_letrabper76);
    
    $select_letracper76 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper76 and letra = 'c';");
    $letracper76 = mysqli_fetch_assoc($select_letracper76);
    
    $select_letradper76 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper76 and letra = 'd';");
    $letradper76 = mysqli_fetch_assoc($select_letradper76);
    
    $select_letraeper76 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper76 and letra = 'e';");
    $letraeper76 = mysqli_fetch_assoc($select_letraeper76);
    
      // Selecionando alternativa correta 76
      if ($letraaper76["correta"]==1){
        $alt_corr76 = "Letra A";
      }
      elseif ($letrabper76["correta"]==1){
           $alt_corr76 = "Letra B";
      }
      elseif ($letracper76["correta"]==1){
        $alt_corr76 = "Letra C";
      }
      elseif ($letradper76["correta"]==1){
        $alt_corr76 = "Letra D";
      }
      elseif ($letraeper76["correta"]==1){
        $alt_corr76 = "Letra E";
      }
    
    
    // Questão 77
    // Selecionando os dados 77
    $codper77 = $dados_prova['codper77'];
    $select_codper77 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper77;");
    $per77 = mysqli_fetch_assoc($select_codper77);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper77 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper77 and letra = 'a';");
    $letraaper77 = mysqli_fetch_assoc($select_letraaper77);
    
    $select_letrabper77 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper77 and letra = 'b';");
    $letrabper77 = mysqli_fetch_assoc($select_letrabper77);
    
    $select_letracper77 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper77 and letra = 'c';");
    $letracper77 = mysqli_fetch_assoc($select_letracper77);
    
    $select_letradper77 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper77 and letra = 'd';");
    $letradper77 = mysqli_fetch_assoc($select_letradper77);
    
    $select_letraeper77 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper77 and letra = 'e';");
    $letraeper77 = mysqli_fetch_assoc($select_letraeper77);
    
      // Selecionando alternativa correta 77
      if ($letraaper77["correta"]==1){
        $alt_corr77 = "Letra A";
      }
      elseif ($letrabper77["correta"]==1){
           $alt_corr77 = "Letra B";
      }
      elseif ($letracper77["correta"]==1){
        $alt_corr77 = "Letra C";
      }
      elseif ($letradper77["correta"]==1){
        $alt_corr77 = "Letra D";
      }
      elseif ($letraeper77["correta"]==1){
        $alt_corr77 = "Letra E";
      }
    
    
    // Questão 78
    // Selecionando os dados 78
    $codper78 = $dados_prova['codper78'];
    $select_codper78 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper78;");
    $per78 = mysqli_fetch_assoc($select_codper78);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper78 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper78 and letra = 'a';");
    $letraaper78 = mysqli_fetch_assoc($select_letraaper78);
    
    $select_letrabper78 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper78 and letra = 'b';");
    $letrabper78 = mysqli_fetch_assoc($select_letrabper78);
    
    $select_letracper78 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper78 and letra = 'c';");
    $letracper78 = mysqli_fetch_assoc($select_letracper78);
    
    $select_letradper78 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper78 and letra = 'd';");
    $letradper78 = mysqli_fetch_assoc($select_letradper78);
    
    $select_letraeper78 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper78 and letra = 'e';");
    $letraeper78 = mysqli_fetch_assoc($select_letraeper78);
    
      // Selecionando alternativa correta 78
      if ($letraaper78["correta"]==1){
        $alt_corr78 = "Letra A";
      }
      elseif ($letrabper78["correta"]==1){
           $alt_corr78 = "Letra B";
      }
      elseif ($letracper78["correta"]==1){
        $alt_corr78 = "Letra C";
      }
      elseif ($letradper78["correta"]==1){
        $alt_corr78 = "Letra D";
      }
      elseif ($letraeper78["correta"]==1){
        $alt_corr78 = "Letra E";
      }
    
    
    // Questão 79
    // Selecionando os dados 79
    $codper79 = $dados_prova['codper79'];
    $select_codper79 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper79;");
    $per79 = mysqli_fetch_assoc($select_codper79);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper79 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper79 and letra = 'a';");
    $letraaper79 = mysqli_fetch_assoc($select_letraaper79);
    
    $select_letrabper79 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper79 and letra = 'b';");
    $letrabper79 = mysqli_fetch_assoc($select_letrabper79);
    
    $select_letracper79 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper79 and letra = 'c';");
    $letracper79 = mysqli_fetch_assoc($select_letracper79);
    
    $select_letradper79 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper79 and letra = 'd';");
    $letradper79 = mysqli_fetch_assoc($select_letradper79);
    
    $select_letraeper79 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper79 and letra = 'e';");
    $letraeper79 = mysqli_fetch_assoc($select_letraeper79);
    
      // Selecionando alternativa correta 79
      if ($letraaper79["correta"]==1){
        $alt_corr79 = "Letra A";
      }
      elseif ($letrabper79["correta"]==1){
           $alt_corr79 = "Letra B";
      }
      elseif ($letracper79["correta"]==1){
        $alt_corr79 = "Letra C";
      }
      elseif ($letradper79["correta"]==1){
        $alt_corr79 = "Letra D";
      }
      elseif ($letraeper79["correta"]==1){
        $alt_corr79 = "Letra E";
      }
    
    
    // Questão 80
    // Selecionando os dados 80
    $codper80 = $dados_prova['codper80'];
    $select_codper80 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper80;");
    $per80 = mysqli_fetch_assoc($select_codper80);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper80 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper80 and letra = 'a';");
    $letraaper80 = mysqli_fetch_assoc($select_letraaper80);
    
    $select_letrabper80 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper80 and letra = 'b';");
    $letrabper80 = mysqli_fetch_assoc($select_letrabper80);
    
    $select_letracper80 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper80 and letra = 'c';");
    $letracper80 = mysqli_fetch_assoc($select_letracper80);
    
    $select_letradper80 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper80 and letra = 'd';");
    $letradper80 = mysqli_fetch_assoc($select_letradper80);
    
    $select_letraeper80 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper80 and letra = 'e';");
    $letraeper80 = mysqli_fetch_assoc($select_letraeper80);
    
      // Selecionando alternativa correta 80
      if ($letraaper80["correta"]==1){
        $alt_corr80 = "Letra A";
      }
      elseif ($letrabper80["correta"]==1){
           $alt_corr80 = "Letra B";
      }
      elseif ($letracper80["correta"]==1){
        $alt_corr80 = "Letra C";
      }
      elseif ($letradper80["correta"]==1){
        $alt_corr80 = "Letra D";
      }
      elseif ($letraeper80["correta"]==1){
        $alt_corr80 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 80
if ($qtperguntas > 80){
    // Questão 81
    // Selecionando os dados 81
    $codper81 = $dados_prova['codper81'];
    $select_codper81 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper81;");
    $per81 = mysqli_fetch_assoc($select_codper81);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper81 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper81 and letra = 'a';");
    $letraaper81 = mysqli_fetch_assoc($select_letraaper81);
    
    $select_letrabper81 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper81 and letra = 'b';");
    $letrabper81 = mysqli_fetch_assoc($select_letrabper81);
    
    $select_letracper81 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper81 and letra = 'c';");
    $letracper81 = mysqli_fetch_assoc($select_letracper81);
    
    $select_letradper81 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper81 and letra = 'd';");
    $letradper81 = mysqli_fetch_assoc($select_letradper81);
    
    $select_letraeper81 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper81 and letra = 'e';");
    $letraeper81 = mysqli_fetch_assoc($select_letraeper81);
    
      // Selecionando alternativa correta 81
      if ($letraaper81["correta"]==1){
        $alt_corr81 = "Letra A";
      }
      elseif ($letrabper81["correta"]==1){
           $alt_corr81 = "Letra B";
      }
      elseif ($letracper81["correta"]==1){
        $alt_corr81 = "Letra C";
      }
      elseif ($letradper81["correta"]==1){
        $alt_corr81 = "Letra D";
      }
      elseif ($letraeper81["correta"]==1){
        $alt_corr81 = "Letra E";
      }
    
    
    // Questão 82
    // Selecionando os dados 82
    $codper82 = $dados_prova['codper82'];
    $select_codper82 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper82;");
    $per82 = mysqli_fetch_assoc($select_codper82);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper82 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper82 and letra = 'a';");
    $letraaper82 = mysqli_fetch_assoc($select_letraaper82);
    
    $select_letrabper82 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper82 and letra = 'b';");
    $letrabper82 = mysqli_fetch_assoc($select_letrabper82);
    
    $select_letracper82 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper82 and letra = 'c';");
    $letracper82 = mysqli_fetch_assoc($select_letracper82);
    
    $select_letradper82 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper82 and letra = 'd';");
    $letradper82 = mysqli_fetch_assoc($select_letradper82);
    
    $select_letraeper82 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper82 and letra = 'e';");
    $letraeper82 = mysqli_fetch_assoc($select_letraeper82);
    
      // Selecionando alternativa correta 82
      if ($letraaper82["correta"]==1){
        $alt_corr82 = "Letra A";
      }
      elseif ($letrabper82["correta"]==1){
           $alt_corr82 = "Letra B";
      }
      elseif ($letracper82["correta"]==1){
        $alt_corr82 = "Letra C";
      }
      elseif ($letradper82["correta"]==1){
        $alt_corr82 = "Letra D";
      }
      elseif ($letraeper82["correta"]==1){
        $alt_corr82 = "Letra E";
      }
    
    
    // Questão 83
    // Selecionando os dados 83
    $codper83 = $dados_prova['codper83'];
    $select_codper83 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper83;");
    $per83 = mysqli_fetch_assoc($select_codper83);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper83 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper83 and letra = 'a';");
    $letraaper83 = mysqli_fetch_assoc($select_letraaper83);
    
    $select_letrabper83 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper83 and letra = 'b';");
    $letrabper83 = mysqli_fetch_assoc($select_letrabper83);
    
    $select_letracper83 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper83 and letra = 'c';");
    $letracper83 = mysqli_fetch_assoc($select_letracper83);
    
    $select_letradper83 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper83 and letra = 'd';");
    $letradper83 = mysqli_fetch_assoc($select_letradper83);
    
    $select_letraeper83 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper83 and letra = 'e';");
    $letraeper83 = mysqli_fetch_assoc($select_letraeper83);
    
      // Selecionando alternativa correta 83
      if ($letraaper83["correta"]==1){
        $alt_corr83 = "Letra A";
      }
      elseif ($letrabper83["correta"]==1){
           $alt_corr83 = "Letra B";
      }
      elseif ($letracper83["correta"]==1){
        $alt_corr83 = "Letra C";
      }
      elseif ($letradper83["correta"]==1){
        $alt_corr83 = "Letra D";
      }
      elseif ($letraeper83["correta"]==1){
        $alt_corr83 = "Letra E";
      }
    
    
    // Questão 84
    // Selecionando os dados 84
    $codper84 = $dados_prova['codper84'];
    $select_codper84 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper84;");
    $per84 = mysqli_fetch_assoc($select_codper84);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper84 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper84 and letra = 'a';");
    $letraaper84 = mysqli_fetch_assoc($select_letraaper84);
    
    $select_letrabper84 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper84 and letra = 'b';");
    $letrabper84 = mysqli_fetch_assoc($select_letrabper84);
    
    $select_letracper84 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper84 and letra = 'c';");
    $letracper84 = mysqli_fetch_assoc($select_letracper84);
    
    $select_letradper84 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper84 and letra = 'd';");
    $letradper84 = mysqli_fetch_assoc($select_letradper84);
    
    $select_letraeper84 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper84 and letra = 'e';");
    $letraeper84 = mysqli_fetch_assoc($select_letraeper84);
    
      // Selecionando alternativa correta 84
      if ($letraaper84["correta"]==1){
        $alt_corr84 = "Letra A";
      }
      elseif ($letrabper84["correta"]==1){
           $alt_corr84 = "Letra B";
      }
      elseif ($letracper84["correta"]==1){
        $alt_corr84 = "Letra C";
      }
      elseif ($letradper84["correta"]==1){
        $alt_corr84 = "Letra D";
      }
      elseif ($letraeper84["correta"]==1){
        $alt_corr84 = "Letra E";
      }
    
    
    // Questão 85
    // Selecionando os dados 85
    $codper85 = $dados_prova['codper85'];
    $select_codper85 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper85;");
    $per85 = mysqli_fetch_assoc($select_codper85);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper85 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper85 and letra = 'a';");
    $letraaper85 = mysqli_fetch_assoc($select_letraaper85);
    
    $select_letrabper85 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper85 and letra = 'b';");
    $letrabper85 = mysqli_fetch_assoc($select_letrabper85);
    
    $select_letracper85 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper85 and letra = 'c';");
    $letracper85 = mysqli_fetch_assoc($select_letracper85);
    
    $select_letradper85 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper85 and letra = 'd';");
    $letradper85 = mysqli_fetch_assoc($select_letradper85);
    
    $select_letraeper85 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper85 and letra = 'e';");
    $letraeper85 = mysqli_fetch_assoc($select_letraeper85);
    
      // Selecionando alternativa correta 85
      if ($letraaper85["correta"]==1){
        $alt_corr85 = "Letra A";
      }
      elseif ($letrabper85["correta"]==1){
           $alt_corr85 = "Letra B";
      }
      elseif ($letracper85["correta"]==1){
        $alt_corr85 = "Letra C";
      }
      elseif ($letradper85["correta"]==1){
        $alt_corr85 = "Letra D";
      }
      elseif ($letraeper85["correta"]==1){
        $alt_corr85 = "Letra E";
      }
    }


// Verificando se a qt de perguntas é maior que 85
if ($qtperguntas > 85){
    // Questão 86
    // Selecionando os dados 86
    $codper86 = $dados_prova['codper86'];
    $select_codper86 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper86;");
    $per86 = mysqli_fetch_assoc($select_codper86);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper86 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper86 and letra = 'a';");
    $letraaper86 = mysqli_fetch_assoc($select_letraaper86);
    
    $select_letrabper86 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper86 and letra = 'b';");
    $letrabper86 = mysqli_fetch_assoc($select_letrabper86);
    
    $select_letracper86 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper86 and letra = 'c';");
    $letracper86 = mysqli_fetch_assoc($select_letracper86);
    
    $select_letradper86 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper86 and letra = 'd';");
    $letradper86 = mysqli_fetch_assoc($select_letradper86);
    
    $select_letraeper86 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper86 and letra = 'e';");
    $letraeper86 = mysqli_fetch_assoc($select_letraeper86);
    
      // Selecionando alternativa correta 86
      if ($letraaper86["correta"]==1){
        $alt_corr86 = "Letra A";
      }
      elseif ($letrabper86["correta"]==1){
           $alt_corr86 = "Letra B";
      }
      elseif ($letracper86["correta"]==1){
        $alt_corr86 = "Letra C";
      }
      elseif ($letradper86["correta"]==1){
        $alt_corr86 = "Letra D";
      }
      elseif ($letraeper86["correta"]==1){
        $alt_corr86 = "Letra E";
      }
    
    
    // Questão 87
    // Selecionando os dados 87
    $codper87 = $dados_prova['codper87'];
    $select_codper87 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper87;");
    $per87 = mysqli_fetch_assoc($select_codper87);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper87 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper87 and letra = 'a';");
    $letraaper87 = mysqli_fetch_assoc($select_letraaper87);
    
    $select_letrabper87 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper87 and letra = 'b';");
    $letrabper87 = mysqli_fetch_assoc($select_letrabper87);
    
    $select_letracper87 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper87 and letra = 'c';");
    $letracper87 = mysqli_fetch_assoc($select_letracper87);
    
    $select_letradper87 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper87 and letra = 'd';");
    $letradper87 = mysqli_fetch_assoc($select_letradper87);
    
    $select_letraeper87 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper87 and letra = 'e';");
    $letraeper87 = mysqli_fetch_assoc($select_letraeper87);
    
      // Selecionando alternativa correta 87
      if ($letraaper87["correta"]==1){
        $alt_corr87 = "Letra A";
      }
      elseif ($letrabper87["correta"]==1){
           $alt_corr87 = "Letra B";
      }
      elseif ($letracper87["correta"]==1){
        $alt_corr87 = "Letra C";
      }
      elseif ($letradper87["correta"]==1){
        $alt_corr87 = "Letra D";
      }
      elseif ($letraeper87["correta"]==1){
        $alt_corr87 = "Letra E";
      }
    
    
    // Questão 88
    // Selecionando os dados 88
    $codper88 = $dados_prova['codper88'];
    $select_codper88 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper88;");
    $per88 = mysqli_fetch_assoc($select_codper88);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper88 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper88 and letra = 'a';");
    $letraaper88 = mysqli_fetch_assoc($select_letraaper88);
    
    $select_letrabper88 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper88 and letra = 'b';");
    $letrabper88 = mysqli_fetch_assoc($select_letrabper88);
    
    $select_letracper88 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper88 and letra = 'c';");
    $letracper88 = mysqli_fetch_assoc($select_letracper88);
    
    $select_letradper88 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper88 and letra = 'd';");
    $letradper88 = mysqli_fetch_assoc($select_letradper88);
    
    $select_letraeper88 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper88 and letra = 'e';");
    $letraeper88 = mysqli_fetch_assoc($select_letraeper88);
    
      // Selecionando alternativa correta 88
      if ($letraaper88["correta"]==1){
        $alt_corr88 = "Letra A";
      }
      elseif ($letrabper88["correta"]==1){
           $alt_corr88 = "Letra B";
      }
      elseif ($letracper88["correta"]==1){
        $alt_corr88 = "Letra C";
      }
      elseif ($letradper88["correta"]==1){
        $alt_corr88 = "Letra D";
      }
      elseif ($letraeper88["correta"]==1){
        $alt_corr88 = "Letra E";
      }
    
    
    // Questão 89
    // Selecionando os dados 89
    $codper89 = $dados_prova['codper89'];
    $select_codper89 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper89;");
    $per89 = mysqli_fetch_assoc($select_codper89);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper89 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper89 and letra = 'a';");
    $letraaper89 = mysqli_fetch_assoc($select_letraaper89);
    
    $select_letrabper89 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper89 and letra = 'b';");
    $letrabper89 = mysqli_fetch_assoc($select_letrabper89);
    
    $select_letracper89 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper89 and letra = 'c';");
    $letracper89 = mysqli_fetch_assoc($select_letracper89);
    
    $select_letradper89 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper89 and letra = 'd';");
    $letradper89 = mysqli_fetch_assoc($select_letradper89);
    
    $select_letraeper89 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper89 and letra = 'e';");
    $letraeper89 = mysqli_fetch_assoc($select_letraeper89);
    
      // Selecionando alternativa correta 89
      if ($letraaper89["correta"]==1){
        $alt_corr89 = "Letra A";
      }
      elseif ($letrabper89["correta"]==1){
           $alt_corr89 = "Letra B";
      }
      elseif ($letracper89["correta"]==1){
        $alt_corr89 = "Letra C";
      }
      elseif ($letradper89["correta"]==1){
        $alt_corr89 = "Letra D";
      }
      elseif ($letraeper89["correta"]==1){
        $alt_corr89 = "Letra E";
      }
    
    
    // Questão 90
    // Selecionando os dados 90
    $codper90 = $dados_prova['codper90'];
    $select_codper90 = mysqli_query($conexao,"SELECT * FROM tabela_pergunta WHERE codigo_pergunta = $codper90;");
    $per90 = mysqli_fetch_assoc($select_codper90);
    
    
    // Selecionando alternativas referentes a esa pergunta
    $select_letraaper90 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper90 and letra = 'a';");
    $letraaper90 = mysqli_fetch_assoc($select_letraaper90);
    
    $select_letrabper90 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper90 and letra = 'b';");
    $letrabper90 = mysqli_fetch_assoc($select_letrabper90);
    
    $select_letracper90 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper90 and letra = 'c';");
    $letracper90 = mysqli_fetch_assoc($select_letracper90);
    
    $select_letradper90 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper90 and letra = 'd';");
    $letradper90 = mysqli_fetch_assoc($select_letradper90);
    
    $select_letraeper90 = mysqli_query($conexao, "SELECT * FROM tabela_resposta where codigo_pergunta = $codper90 and letra = 'e';");
    $letraeper90 = mysqli_fetch_assoc($select_letraeper90);
    
      // Selecionando alternativa correta 90
      if ($letraaper90["correta"]==1){
        $alt_corr90 = "Letra A";
      }
      elseif ($letrabper90["correta"]==1){
           $alt_corr90 = "Letra B";
      }
      elseif ($letracper90["correta"]==1){
        $alt_corr90 = "Letra C";
      }
      elseif ($letradper90["correta"]==1){
        $alt_corr90 = "Letra D";
      }
      elseif ($letraeper90["correta"]==1){
        $alt_corr90 = "Letra E";
      }
    }
}
?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo caracteristicas basicas para a pagina -->
<meta charset="UTF-8">
<title>Gabarito <?php echo $dados_prova['nome']; ?></title>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<!-- Colocando ícone na página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<script>

// Função para abrir a pagina sobre -->
function sobre() {
      location.href='sobreadm.php';
}

// Função para abrir a pagina alterar dados adm -->
function pgaltdados() {
      location.href='alterar_dadosadm.php';
}

// Função para sair da conta -->
function sair() {
  var resultado = confirm("Deseja Realmente sair dessa Conta?")
    if (resultado == true) {
      location.href='sair.php';
    }
}
</script>

<!-- Abrindo o cabeçalho -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style type="text/css">
    #header.header-scrolled {
    background: #fff;
    padding: 20px 0;
    height: 72px;
    transition: all 0.5s;
}
#header {
    padding: 30px 0;
    height: 92px;
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    transition: all 0.5s;
    z-index: 997;
    background-color: #fff;
    box-shadow: 5px 0px 15px #c3c3c3;
}
#header #logo h1 {
    font-size: 34px;
    margin: 0;
    padding: 0;
    line-height: 1;
    font-family: "Montserrat", sans-serif;
    font-weight: 700;
    letter-spacing: 3px;
}
#header #logo h1 a, #header #logo h1 a:hover {
    color: #000;
    padding-left: 10px;
    border-left: 4px solid grey;
}
#nav-menu-container {
    float: right;
    margin: 0;
}
.nav-menu > li {
    margin-left: 10px;
}
.nav-menu > li {
    float: left;
}
.nav-menu li {
    position: relative;
    white-space: nowrap;
}
.nav-menu, .nav-menu * {
    margin: 0;
    padding: 0;
    list-style: none;
}
.header-scrolled .nav-menu li:hover > a, .header-scrolled .nav-menu > .menu-active > a {
    color: #1E90FF;
}
.header-scrolled .nav-menu a {
    color: black;
}
.nav-menu li:hover > a, .nav-menu > .menu-active > a {
    color: #1E90FF;
}
.nav-menu a {
    padding: 0 8px 10px 8px;
    text-decoration: none;
    display: inline-block;
    color: #000;
    font-family: "Montserrat", sans-serif;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    outline: none;
}
#mobile-nav-toggle {
    display: inline;
}
#mobile-nav-toggle {
    position: fixed;
    right: 0;
    top: 0;
    z-index: 999;
    margin: 20px 20px 0 0;
    border: 0;
    background: none;
    font-size: 24px;
    display: none;
    transition: all 0.4s;
    outline: none;
    cursor: pointer;
}
#mobile-body-overly {
    width: 100%;
    height: 100%;
    z-index: 997;
    top: 0;
    left: 0;
    position: fixed;
    background: rgba(0, 0, 0, 0.7);
    display: none;
}
body.mobile-nav-active #mobile-nav {
    left: 0;
}
#mobile-nav {
    position: fixed;
    top: 0;
    padding-top: 18px;
    bottom: 0;
    z-index: 998;
    background: rgba(0, 0, 0, 0.8);
    left: -260px;
    width: 260px;
    overflow-y: auto;
    transition: 0.4s;
}
#mobile-nav ul {
    padding: 0;
    margin: 0;
    list-style: none;
}
#mobile-nav ul li {
    position: relative;
}
#mobile-nav ul li a {
    color: #fff;
    font-size: 13px;
    text-transform: uppercase;
    overflow: hidden;
    padding: 10px 22px 10px 15px;
    position: relative;
    text-decoration: none;
    width: 100%;
    display: block;
    outline: none;
    font-weight: 700;
    font-family: "Montserrat", sans-serif;
}
#mobile-nav ul .menu-has-children i.fa-chevron-up {
    color: #1E90FF;
}
#mobile-nav ul .menu-has-children i {
    position: absolute;
    right: 0;
    z-index: 99;
    padding: 15px;
    cursor: pointer;
    color: #fff;
}
#mobile-nav ul .menu-item-active {
    color: #1E90FF;
}
#mobile-nav ul li li {
    padding-left: 30px;
}

.menu-has-children ul
{display: none;}

.sf-arrows .sf-with-ul {
  padding-right: 30px;
}

.sf-arrows .sf-with-ul:after {
  content: "\f107";
  position: absolute;
  right: 15px;
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  color:black;
}

.sf-arrows ul .sf-with-ul:after {
  content: "\f105";
}


.nav-menu li:hover > ul,
.nav-menu li.sfHover > ul {
  display: block;
}
.nav-menu ul {
    margin: 4px 0 0 0;
    padding: 10px;
    box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
    background: #fff;
}
.nav-menu ul {
    position: absolute;
    display: none;
    top: 100%;
    left: 0;
    z-index: 99;
}

.sf-arrows .sf-with-ul {
    padding-right: 30px;
}
.nav-menu li {
    position: relative;
    white-space: nowrap;
}


@media (max-width: 768px){
#nav-menu-container {
    display: none;
}

#mobile-nav-toggle {
    display: inline;
}
}    </style>

<!-- Iniciando o CSS -->
<!-- Definindo características da página como um todo -->
<style>
		/* Definindo fonte e cor da página */
        body{
            font-family: Arial, Helvetica, sans-serif;
			background-color: LightBlue;
        }

		/* Definindo características da "caixa" do formulário */
        .box{
			top: 20%;
            left: 3%;
            color: black;
            position: absolute;
            background-color: white;
            padding: 15px;
            border-radius: 15px;
            width: 95%;
        }

		/* Definindo propriedades da legenda */
        legend{
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 19px;
        }

		/* Definindo caracteristicas dos botões */
        #alterarquestao{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #alterarquestao:hover{
            background-color: MediumTurquoise;
        }
        #cancelar{
            width: 64%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #cancelar:hover{
            background-color: MediumTurquoise;
        }
		#limpar{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #limpar:hover{
            background-color: MediumTurquoise;
        }

		
		/* Definindo caracteristicas dos botões */
        #adcionarquestao{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #adcionarquestao:hover{
            background-color: MediumTurquoise;
        }
        #cancelar{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #cancelar:hover{
            background-color: MediumTurquoise;
        }
		#limpar{
            width: 32%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: DarkTurquoise;
        }
        #limpar:hover{
            background-color: MediumTurquoise;
        }

</style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'https://bootsnipp.com');
        });
    </script>
</head>
<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="sobreadm.php" class="scrollto">DSENEM</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">

        <li class="menu-active"><a href="pagina_adm.php">Home</a></li>

        <!-- Iniciando PHP -->
          <?php

          // Verificando o nivel do adm para ver quais intens do cabeçalho se deve mostrar
          if ($niveladm =="admgeral" || $niveladm == "adm"){echo "
          <li class='menu-has-children'><a >Professores</a>
            <ul>
              <li><a href='mostrar_professores.php'>Cadastrados</a></li>
              <li><a href='mostrar_professores_banidos.php'>Banidos</a></li>
              <li><a href='adicionar_adm.php'> ADD Professor</a></li>
            </ul>
          
          <li class='menu-has-children'><a >Questões</a>
            <ul>
              <li><a href='mostrar_questoes.php'>Visualizar Questões</a></li>
              <li><a href='adicionar_questao.php'>ADD Questão</a></li>
              <li class='menu-has-children'><a >Verificar Imagens</a>
                <ul>
                    <li><a href='verficarimg_perguntas.php'>Perguntas</a></li>
                    <li><a href='verficarimg_respostas.php'>Respostas</a></li>
                </ul>
                </li>
            </ul>
          </li>
           <li class='menu-has-children'><a >Usuários</a>
            <ul>
            <li><a href='mostrar_usuarios.php'>Cadastrados</a></li>
              <li><a href='mostrar_usuarios_banidos.php'>Banidos</a></li>
            </ul>
          </li>";
          }

          if ($niveladm =="admgeral" || $niveladm == "adm" || $niveladm == "corretor"){echo"
            <li class='menu-has-children'><a >Redações</a>
            <ul>
              <li><a href='readacoes_corrigir.php'>Para Corrigir</a></li>
              <li><a href='readacoes_corrigidas.php'>Corrigidas</a></li>
              <li class='menu-has-children'><a >Temas</a>
              <ul>
                <li><a href='temas_enem.php'>ENEM</a></li>
                <li><a href='temas_usuarios.php'>Usuários</a></li>
                <li><a href='temas_professores.php'>Professores</a></li>
                <li><a href='adicionar_tema.php'>ADD Tema</a></li>
              </ul>
            </ul>
          </li>";
          }
          ?>

          <li class="menu-has-children"><a >Provas</a>
            <ul>
              <li><a href="provas_geradasadm.php">Minhas</a></li>
              <li><a href="provasadm_adm.php">Professores</a></li>
              <li><a href="provasusu_adm.php">Usuários</a></li>
              <li><a href="gerar_provaadm.php">Criar</a></li>
            </ul>
          </li>
          <li class="menu-active"><a onclick="sair()">Sair</a></li>
          <li class="menu-active"><i class="bi bi-person-circle" title='Dados da Conta' height ='30px' width='30px' onclick="pgaltdados()"></i></li>
          &nbsp;&nbsp;
          <i class="bi bi-printer" onClick="window.print()" title='Imprimir Gabarito'></i>
          <!-- <li><a >Contact</a></li> -->
        </ul>
      </nav><!-- #nav-menu-container -->

    </div>
  </header><!-- #header -->	<script type="text/javascript">
	// Mobile Navigation
  if ($('#nav-menu-container').length) {
    var $mobile_nav = $('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
    $('body').append('<div id="mobile-body-overly"></div>');
    $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');

    $(document).on('click', '.menu-has-children i', function(e) {
      $(this).next().toggleClass('menu-item-active');
      $(this).nextAll('ul').eq(0).slideToggle();
      $(this).toggleClass("fa-chevron-up fa-chevron-down");
    });

    $(document).on('click', '#mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
      $('#mobile-body-overly').toggle();
    });

    $(document).click(function(e) {
      var container = $("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    $("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if ($('#header').length) {
          top_space = $('#header').outerHeight();

          if( ! $('#header').hasClass('header-fixed') ) {
            top_space = top_space - 20;
          }
        }

        $('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu').length) {
          $('.nav-menu .menu-active').removeClass('menu-active');
          $(this).closest('li').addClass('menu-active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
          $('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });	</script>

<br><br><br><br><br><br><br>
<!-- Fechando cabeçalho -->

<!-- Iniciando o CSS -->
<!-- Definindo características da página como um todo -->
<style>
		/* Definindo fonte e cor da página */
        body{
            font-family: Arial, Helvetica, sans-serif;
			background-color: LightBlue;
            align-items: center;
        }

		/* Definindo características da "caixa" do formulário */
        .box{
			top: 20%;
            left: 1%;
            color: black;
            background-color: white;
            padding: 15px;
            border-radius: 15px;
            width: 97%;
        }

		/* Definindo estatura da borda do formulário */
        fieldset{
            border: 3px solid black;
			width: 97%;
        }

		/* Definindo propriedades da legenda */
        legend{
            padding: 10px;
            text-align: center;
            border-radius: 8px;
            font-size: 19px;
        }

 /* caracteristicas dos botões */
#finalizar{
    width: 50%;
    border: none;
    padding: 15px;
    color: white;
    font-size: 15px;
    cursor: pointer;
    border-radius: 10px;
    background-color: DarkTurquoise;
}
#finalizar:hover{
    background-color: MediumTurquoise;
}
#cancelar{
    width: 47%;
    border: none;
    padding: 15px;
    color: white;
    font-size: 15px;
    cursor: pointer;
    border-radius: 10px;
    background-color: DarkTurquoise;
}
#cancelar:hover{
    background-color: MediumTurquoise;
}  

.inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid black;
            outline: none;
            color: black;
            font-size: 17px;
            width: 90%;
            letter-spacing: 2px;
        }

        /* Definindo propriedades dos labels */
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: black;
        }

.table{
border:1px solid;
border-spacing:0;
background-color:#00BFFF;
}

.table tr td{
	border:1px solid #000;
	border:1px solid #000;
}

.table th{
	border:1px solid #000;
  background-color:#4169E1;
}

</style>

<body>

<!-- Caixa em volta do form -->
<font color="black" size="3">
<div class="box">

<!-- Formulário -->
<form action="resultados_simusimcad.php" method="POST"> 
	
<!-- Legenda do form -->
<legend style="color:grey31; font-size:25px; font-weight: bold;">Gabarito</legend>
<br>

<center>
<div style="width: 350px;">
<div style="float: left; ">
Questão 1: <?php echo $alt_corr1; ?>
<br><br>

Questão 2: <?php echo $alt_corr2; ?>
<br><br>

Questão 3: <?php echo $alt_corr3; ?>
<br><br>

Questão 4: <?php echo $alt_corr4; ?>
<br><br>

Questão 5: <?php echo $alt_corr5; ?>
<br><br>

<?php
if ($qtperguntas>5){
echo "Questão 6: ".$alt_corr6;
echo "<br><br>";

echo "Questão 7: ".$alt_corr7;
echo "<br><br>";

echo "Questão 8: ".$alt_corr8;
echo "<br><br>";

echo "Questão 9: ".$alt_corr9;
echo "<br><br>";

echo "Questão 10: ".$alt_corr10;
echo "<br><br>";
}


if ($qtperguntas>10){
    echo "Questão 11: ".$alt_corr11;
    echo "<br><br>";
    
    echo "Questão 12: ".$alt_corr12;
    echo "<br><br>";
    
    echo "Questão 13: ".$alt_corr13;
    echo "<br><br>";
    
    echo "Questão 14: ".$alt_corr14;
    echo "<br><br>";
    
    echo "Questão 15: ".$alt_corr15;
    echo "<br><br>";
}

if ($qtperguntas>15){
    echo "Questão 16: ".$alt_corr16;
    echo "<br><br>";
        
    echo "Questão 17: ".$alt_corr17;
    echo "<br><br>";
        
    echo "Questão 18: ".$alt_corr18;
    echo "<br><br>";
       
    echo "Questão 19: ".$alt_corr19;
    echo "<br><br>";
        
    echo "Questão 20: ".$alt_corr20;
    echo "<br><br>";
}

if ($qtperguntas>20){
    echo "Questão 21: ".$alt_corr21;
    echo "<br><br>";
            
    echo "Questão 22: ".$alt_corr22;
    echo "<br><br>";
            
    echo "Questão 23: ".$alt_corr23;
    echo "<br><br>";
            
    echo "Questão 24: ".$alt_corr24;
    echo "<br><br>";
            
    echo "Questão 25: ".$alt_corr25;
    echo "<br><br>";
}

if ($qtperguntas>25){
echo "Questão 26: ".$alt_corr26;
echo "<br><br>";
                
echo "Questão 27: ".$alt_corr27;
echo "<br><br>";
                
echo "Questão 28: ".$alt_corr28;
echo "<br><br>";
                
echo "Questão 29: ".$alt_corr29;
echo "<br><br>";
                
echo "Questão 30: ".$alt_corr30;
echo "<br><br>";
}

if ($qtperguntas>30){
    echo "Questão 31: ".$alt_corr31;
    echo "<br><br>";
                    
    echo "Questão 32: ".$alt_corr32;
    echo "<br><br>";
                    
    echo "Questão 33: ".$alt_corr33;
    echo "<br><br>";
                    
    echo "Questão 34: ".$alt_corr34;
    echo "<br><br>";
                    
    echo "Questão 35: ".$alt_corr35;
    echo "<br><br>";
}

if ($qtperguntas>35){
    echo "Questão 36: ".$alt_corr36;
    echo "<br><br>";
                    
    echo "Questão 37: ".$alt_corr37;
    echo "<br><br>";
                    
    echo "Questão 38: ".$alt_corr38;
    echo "<br><br>";
                    
    echo "Questão 39: ".$alt_corr39;
    echo "<br><br>";
                    
    echo "Questão 40: ".$alt_corr40;
    echo "<br><br>";
}

if ($qtperguntas>40){
    echo "Questão 41: ".$alt_corr41;
    echo "<br><br>";
                    
    echo "Questão 42: ".$alt_corr42;
    echo "<br><br>";
                    
    echo "Questão 43: ".$alt_corr43;
    echo "<br><br>";
                    
    echo "Questão 44: ".$alt_corr44;
    echo "<br><br>";
                    
    echo "Questão 45: ".$alt_corr45;
    echo "<br><br>";
}
?>
</div>

<div style="float: right;">
<?php
if ($qtperguntas>45){
    echo "Questão 46: ".$alt_corr46;
    echo "<br><br>";
                    
    echo "Questão 47: ".$alt_corr47;
    echo "<br><br>";
                    
    echo "Questão 48: ".$alt_corr48;
    echo "<br><br>";
                    
    echo "Questão 49: ".$alt_corr49;
    echo "<br><br>";
                    
    echo "Questão 50: ".$alt_corr50;
    echo "<br><br>";
}

if ($qtperguntas>50){
    echo "Questão 51: ".$alt_corr51;
    echo "<br><br>";
                    
    echo "Questão 52: ".$alt_corr52;
    echo "<br><br>";
                    
    echo "Questão 53: ".$alt_corr53;
    echo "<br><br>";
                    
    echo "Questão 54: ".$alt_corr54;
    echo "<br><br>";
                    
    echo "Questão 55: ".$alt_corr55;
    echo "<br><br>";
}

if ($qtperguntas>55){
    echo "Questão 56: ".$alt_corr56;
    echo "<br><br>";
                    
    echo "Questão 57: ".$alt_corr57;
    echo "<br><br>";
                    
    echo "Questão 58: ".$alt_corr58;
    echo "<br><br>";
                    
    echo "Questão 59: ".$alt_corr59;
    echo "<br><br>";
                    
    echo "Questão 60: ".$alt_corr60;
    echo "<br><br>";
}

if ($qtperguntas>60){
    echo "Questão 61: ".$alt_corr61;
    echo "<br><br>";
                    
    echo "Questão 62: ".$alt_corr62;
    echo "<br><br>";
                    
    echo "Questão 63: ".$alt_corr63;
    echo "<br><br>";
                    
    echo "Questão 64: ".$alt_corr64;
    echo "<br><br>";
                    
    echo "Questão 65: ".$alt_corr65;
    echo "<br><br>";
}

if ($qtperguntas>65){
    echo "Questão 66: ".$alt_corr66;
    echo "<br><br>";
                    
    echo "Questão 67: ".$alt_corr67;
    echo "<br><br>";
                    
    echo "Questão 68: ".$alt_corr68;
    echo "<br><br>";
                    
    echo "Questão 69: ".$alt_corr69;
    echo "<br><br>";
                    
    echo "Questão 70: ".$alt_corr70;
    echo "<br><br>";
}

if ($qtperguntas>70){
    echo "Questão 71: ".$alt_corr71;
    echo "<br><br>";
                    
    echo "Questão 72: ".$alt_corr72;
    echo "<br><br>";
                    
    echo "Questão 73: ".$alt_corr73;
    echo "<br><br>";
                    
    echo "Questão 74: ".$alt_corr74;
    echo "<br><br>";
                    
    echo "Questão 75: ".$alt_corr75;
    echo "<br><br>";
}

if ($qtperguntas>75){
    echo "Questão 76: ".$alt_corr76;
    echo "<br><br>";
                    
    echo "Questão 77: ".$alt_corr77;
    echo "<br><br>";
                    
    echo "Questão 78: ".$alt_corr78;
    echo "<br><br>";
                    
    echo "Questão 79: ".$alt_corr79;
    echo "<br><br>";
                    
    echo "Questão 80: ".$alt_corr80;
    echo "<br><br>";
}

if ($qtperguntas>80){
    echo "Questão 81: ".$alt_corr81;
    echo "<br><br>";
                    
    echo "Questão 82: ".$alt_corr82;
    echo "<br><br>";
                    
    echo "Questão 83: ".$alt_corr83;
    echo "<br><br>";
                    
    echo "Questão 84: ".$alt_corr84;
    echo "<br><br>";
                    
    echo "Questão 85: ".$alt_corr85;
    echo "<br><br>";
}

if ($qtperguntas>85){
    echo "Questão 86: ".$alt_corr86;
    echo "<br><br>";
                    
    echo "Questão 87: ".$alt_corr87;
    echo "<br><br>";
                    
    echo "Questão 88: ".$alt_corr88;
    echo "<br><br>";
                    
    echo "Questão 89: ".$alt_corr89;
    echo "<br><br>";
                    
    echo "Questão 90: ".$alt_corr90;
    echo "<br><br>";
}

?>
</div>
</div>

</center>
</form> 
</div>

<!-- Fechando tags abertas -->
</font>
</body>
</html>