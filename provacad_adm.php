<!-- Iniciando PHP -->
<?php

// Iniciando sessão
session_start();

// Conectando com o banco de dados
include_once ('conexao.php');

// Verificando se a sessão foi iniciada 
if(!isset($_SESSION["senha_adm"])){

  // Redirecionando para a pagina index, pois a sessão não foi iniciada
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

// Obtendo o codigo do ADM
$codigo_adm = $dado['codigo'];

// Obtendo o nivel do adm
$niveladm = $dado['nivel'];

// Verificando se o codigo chegou via GET
// Se for codigo da prova de um rpofessor
if(!empty($_GET['codigo'])){

// Obtendo o código via GET do form anterior
$codigo_prova = $_GET['codigo'];

// Selecionando os dados da prova
$select_dadppro = mysqli_query($conexao,"SELECT * FROM tabela_provas_adm WHERE codigo = $codigo_prova and tipoprova = 1;");
$dados_prova = mysqli_fetch_assoc($select_dadppro);
}

// Se o codigo for de alguma prova de um usuario
elseif (!empty($_GET['codigousu'])){

// Obtendo o código via GET do form anterior
$codigo_prova = $_GET['codigousu'];

// Selecionando os dados da prova
$select_dadppro = mysqli_query($conexao,"SELECT * FROM tabela_provas_usuario WHERE codigo = $codigo_prova and tipoprova = 1;");
$dados_prova = mysqli_fetch_assoc($select_dadppro);
}

// Se a prova for do proprio adm logado
elseif (!empty($_GET['codigomeu'])){

// Obtendo o código via GET do form anterior
$codigo_prova = $_GET['codigomeu'];

// Selecionando os dados da prova
$select_dadppro = mysqli_query($conexao,"SELECT * FROM tabela_provas_adm WHERE codigo = $codigo_prova and codigo_adm = $codigo_adm;");
$dados_prova = mysqli_fetch_assoc($select_dadppro);
}

else{


    // Redirecionando para a pagina adm, pois não chegou nenhum codigo
    header('location: pagina_adm.php');
    exit;
}
}

// Verificando se a prova realmente existe
if(mysqli_num_rows($select_dadppro)<1) {

  // Redirecionando para a pagina adm, pois a prova não existe
  header('location: pagina_adm.php');
  exit;
}

// Selecionando a qt de questões
$qtperguntas = $dados_prova['numero_questoes'];

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

// Selecionando imagem 1
$imgper1 = $per1['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 1
$tipoimgp1 = $letraaper1['tipo'];

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

// Selecionando imagem 2
$imgper2 = $per2['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 2
$tipoimgp2 = $letraaper2['tipo'];


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

// Selecionando imagem 3
$imgper3 = $per3['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 3
$tipoimgp3 = $letraaper3['tipo'];


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

// Selecionando imagem 4
$imgper4 = $per4['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 4
$tipoimgp4 = $letraaper4['tipo'];


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

// Selecionando imagem 5
$imgper5 = $per5['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 5
$tipoimgp5 = $letraaper5['tipo'];

// Verificando se a qt de perguntas é maior que 5
if ($qtperguntas >5){
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

// Selecionando imagem 6
$imgper6 = $per6['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 6
$tipoimgp6 = $letraaper6['tipo'];


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

// Selecionando imagem 7
$imgper7 = $per7['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 7
$tipoimgp7 = $letraaper7['tipo'];


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

// Selecionando imagem 8
$imgper8 = $per8['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 8
$tipoimgp8 = $letraaper8['tipo'];


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

// Selecionando imagem 9
$imgper9 = $per9['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 9
$tipoimgp9 = $letraaper9['tipo'];


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

// Selecionando imagem 10
$imgper10 = $per10['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 10
$tipoimgp10 = $letraaper10['tipo'];
}


// Verificando se a qt de perguntas é maior que 10
if ($qtperguntas >10){
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

// Selecionando imagem 11
$imgper11 = $per11['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 11
$tipoimgp11 = $letraaper11['tipo'];


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

// Selecionando imagem 12
$imgper12 = $per12['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 12
$tipoimgp12 = $letraaper12['tipo'];


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

// Selecionando imagem 13
$imgper13 = $per13['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 13
$tipoimgp13 = $letraaper13['tipo'];


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

// Selecionando imagem 14
$imgper14 = $per14['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 14
$tipoimgp14 = $letraaper14['tipo'];


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

// Selecionando imagem 15
$imgper15 = $per15['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 15
$tipoimgp15 = $letraaper15['tipo'];
}


// Verificando se a qt de perguntas é maior que 15
if ($qtperguntas >15){
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

// Selecionando imagem 16
$imgper16 = $per16['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 16
$tipoimgp16 = $letraaper16['tipo'];


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

// Selecionando imagem 17
$imgper17 = $per17['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 17
$tipoimgp17 = $letraaper17['tipo'];


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

// Selecionando imagem 18
$imgper18 = $per18['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 18
$tipoimgp18 = $letraaper18['tipo'];


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

// Selecionando imagem 19
$imgper19 = $per19['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 19
$tipoimgp19 = $letraaper19['tipo'];


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

// Selecionando imagem 20
$imgper20 = $per20['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 20
$tipoimgp20 = $letraaper20['tipo'];
}


// Verificando se a qt de perguntas é maior que 20
if ($qtperguntas >20){
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

// Selecionando imagem 21
$imgper21 = $per21['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 21
$tipoimgp21 = $letraaper21['tipo'];


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

// Selecionando imagem 22
$imgper22 = $per22['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 22
$tipoimgp22 = $letraaper22['tipo'];


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

// Selecionando imagem 22
$imgper22 = $per22['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 22
$tipoimgp22 = $letraaper22['tipo'];


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

// Selecionando imagem 23
$imgper23 = $per23['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 23
$tipoimgp23 = $letraaper23['tipo'];


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

// Selecionando imagem 24
$imgper24 = $per24['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 24
$tipoimgp24 = $letraaper24['tipo'];


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

// Selecionando imagem 25
$imgper25 = $per25['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 25
$tipoimgp25 = $letraaper25['tipo'];
}


// Verificando se a qt de perguntas é maior que 25
if ($qtperguntas >25){
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

// Selecionando imagem 26
$imgper26 = $per26['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 26
$tipoimgp26 = $letraaper26['tipo'];


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

// Selecionando imagem 27
$imgper27 = $per27['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 27
$tipoimgp27 = $letraaper27['tipo'];


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

// Selecionando imagem 28
$imgper28 = $per28['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 28
$tipoimgp28 = $letraaper28['tipo'];


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

// Selecionando imagem 29
$imgper29 = $per29['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 29
$tipoimgp29 = $letraaper29['tipo'];


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

// Selecionando imagem 30
$imgper30 = $per30['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 30
$tipoimgp30 = $letraaper30['tipo'];
}


// Verificando se a qt de perguntas é maior que 30
if ($qtperguntas >30){
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

// Selecionando imagem 31
$imgper31 = $per31['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 31
$tipoimgp31 = $letraaper31['tipo'];


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

// Selecionando imagem 32
$imgper32 = $per32['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 32
$tipoimgp32 = $letraaper32['tipo'];


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

// Selecionando imagem 33
$imgper33 = $per33['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 33
$tipoimgp33 = $letraaper33['tipo'];


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

// Selecionando imagem 34
$imgper34 = $per34['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 34
$tipoimgp34 = $letraaper34['tipo'];


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

// Selecionando imagem 35
$imgper35 = $per35['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 35
$tipoimgp35 = $letraaper35['tipo'];
}


// Verificando se a qt de perguntas é maior que 35
if ($qtperguntas >35){
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

// Selecionando imagem 36
$imgper36 = $per36['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 36
$tipoimgp36 = $letraaper36['tipo'];


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

// Selecionando imagem 37
$imgper37 = $per37['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 37
$tipoimgp37 = $letraaper37['tipo'];


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

// Selecionando imagem 38
$imgper38 = $per38['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 38
$tipoimgp38 = $letraaper38['tipo'];


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

// Selecionando imagem 39
$imgper39 = $per39['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 39
$tipoimgp39 = $letraaper39['tipo'];


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

// Selecionando imagem 40
$imgper40 = $per40['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 40
$tipoimgp40 = $letraaper40['tipo'];
}


// Verificando se a qt de perguntas é maior que 40
if ($qtperguntas >40){
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

// Selecionando imagem 41
$imgper41 = $per41['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 41
$tipoimgp41 = $letraaper41['tipo'];


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

// Selecionando imagem 42
$imgper42 = $per42['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 42
$tipoimgp42 = $letraaper42['tipo'];


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

// Selecionando imagem 43
$imgper43 = $per43['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 43
$tipoimgp43 = $letraaper43['tipo'];


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

// Selecionando imagem 44
$imgper44 = $per44['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 44
$tipoimgp44 = $letraaper44['tipo'];


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

// Selecionando imagem 45
$imgper45 = $per45['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 45
$tipoimgp45 = $letraaper45['tipo'];
}


// Verificando se a qt de perguntas é maior que 45
if ($qtperguntas >45){
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

// Selecionando imagem 46
$imgper46 = $per46['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 46
$tipoimgp46 = $letraaper46['tipo'];


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

// Selecionando imagem 47
$imgper47 = $per47['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 47
$tipoimgp47 = $letraaper47['tipo'];


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

// Selecionando imagem 48
$imgper48 = $per48['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 48
$tipoimgp48 = $letraaper48['tipo'];


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

// Selecionando imagem 49
$imgper49 = $per49['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 49
$tipoimgp49 = $letraaper49['tipo'];


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

// Selecionando imagem 50
$imgper50 = $per50['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 50
$tipoimgp50 = $letraaper50['tipo'];
}


// Verificando se a qt de perguntas é maior que 50
if ($qtperguntas >50){
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

// Selecionando imagem 51
$imgper51 = $per51['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 51
$tipoimgp51 = $letraaper51['tipo'];


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

// Selecionando imagem 52
$imgper52 = $per52['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 52
$tipoimgp52 = $letraaper52['tipo'];


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

// Selecionando imagem 53
$imgper53 = $per53['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 53
$tipoimgp53 = $letraaper53['tipo'];


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

// Selecionando imagem 54
$imgper54 = $per54['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 54
$tipoimgp54 = $letraaper54['tipo'];


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

// Selecionando imagem 55
$imgper55 = $per55['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 55
$tipoimgp55 = $letraaper55['tipo'];
}


// Verificando se a qt de perguntas é maior que 55
if ($qtperguntas >55){
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

// Selecionando imagem 56
$imgper56 = $per56['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 56
$tipoimgp56 = $letraaper56['tipo'];


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

// Selecionando imagem 57
$imgper57 = $per57['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 57
$tipoimgp57 = $letraaper57['tipo'];


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

// Selecionando imagem 58
$imgper58 = $per58['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 58
$tipoimgp58 = $letraaper58['tipo'];


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

// Selecionando imagem 59
$imgper59 = $per59['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 59
$tipoimgp59 = $letraaper59['tipo'];


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

// Selecionando imagem 60
$imgper60 = $per60['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 60
$tipoimgp60 = $letraaper60['tipo'];
}


// Verificando se a qt de perguntas é maior que 60
if ($qtperguntas >60){
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

// Selecionando imagem 61
$imgper61 = $per61['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 61
$tipoimgp61 = $letraaper61['tipo'];


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

// Selecionando imagem 62
$imgper62 = $per62['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 62
$tipoimgp62 = $letraaper62['tipo'];


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

// Selecionando imagem 63
$imgper63 = $per63['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 63
$tipoimgp63 = $letraaper63['tipo'];


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

// Selecionando imagem 64
$imgper64 = $per64['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 64
$tipoimgp64 = $letraaper64['tipo'];


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

// Selecionando imagem 65
$imgper65 = $per65['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 65
$tipoimgp65 = $letraaper65['tipo'];
}


// Verificando se a qt de perguntas é maior que 65
if ($qtperguntas >65){
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

// Selecionando imagem 66
$imgper66 = $per66['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 66
$tipoimgp66 = $letraaper66['tipo'];


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

// Selecionando imagem 67
$imgper67 = $per67['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 67
$tipoimgp67 = $letraaper67['tipo'];


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

// Selecionando imagem 68
$imgper68 = $per68['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 68
$tipoimgp68 = $letraaper68['tipo'];


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

// Selecionando imagem 69
$imgper69 = $per69['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 69
$tipoimgp69 = $letraaper69['tipo'];


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

// Selecionando imagem 70
$imgper70 = $per70['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 70
$tipoimgp70 = $letraaper70['tipo'];
}


// Verificando se a qt de perguntas é maior que 70
if ($qtperguntas >70){
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

// Selecionando imagem 71
$imgper71 = $per71['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 71
$tipoimgp71 = $letraaper71['tipo'];


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

// Selecionando imagem 72
$imgper72 = $per72['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 72
$tipoimgp72 = $letraaper72['tipo'];


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

// Selecionando imagem 73
$imgper73 = $per73['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 73
$tipoimgp73 = $letraaper73['tipo'];


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

// Selecionando imagem 74
$imgper74 = $per74['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 74
$tipoimgp74 = $letraaper74['tipo'];


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

// Selecionando imagem 75
$imgper75 = $per75['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 75
$tipoimgp75 = $letraaper75['tipo'];
}


// Verificando se a qt de perguntas é maior que 75
if ($qtperguntas >75){
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

// Selecionando imagem 76
$imgper76 = $per76['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 76
$tipoimgp76 = $letraaper76['tipo'];


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

// Selecionando imagem 77
$imgper77 = $per77['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 77
$tipoimgp77 = $letraaper77['tipo'];


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

// Selecionando imagem 78
$imgper78 = $per78['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 78
$tipoimgp78 = $letraaper78['tipo'];


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

// Selecionando imagem 79
$imgper79 = $per79['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 79
$tipoimgp79 = $letraaper79['tipo'];


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

// Selecionando imagem 80
$imgper80 = $per80['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 80
$tipoimgp80 = $letraaper80['tipo'];
}


// Verificando se a qt de perguntas é maior que 80
if ($qtperguntas >80){
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

// Selecionando imagem 81
$imgper81 = $per81['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 81
$tipoimgp81 = $letraaper81['tipo'];


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

// Selecionando imagem 82
$imgper82 = $per82['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 82
$tipoimgp82 = $letraaper82['tipo'];


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

// Selecionando imagem 83
$imgper83 = $per83['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 83
$tipoimgp83 = $letraaper83['tipo'];


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

// Selecionando imagem 84
$imgper84 = $per84['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 84
$tipoimgp84 = $letraaper84['tipo'];


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

// Selecionando imagem 85
$imgper85 = $per85['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 85
$tipoimgp85 = $letraaper85['tipo'];
}


// Verificando se a qt de perguntas é maior que 85
if ($qtperguntas >85){
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

// Selecionando imagem 86
$imgper86 = $per86['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 86
$tipoimgp86 = $letraaper86['tipo'];


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

// Selecionando imagem 87
$imgper87 = $per87['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 87
$tipoimgp87 = $letraaper87['tipo'];


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

// Selecionando imagem 88
$imgper88 = $per88['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 88
$tipoimgp88 = $letraaper88['tipo'];


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

// Selecionando imagem 89
$imgper89 = $per89['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 89
$tipoimgp89 = $letraaper89['tipo'];


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

// Selecionando imagem 90
$imgper90 = $per90['imagem'];

// Verificando sea resposta é do tipo imagem ou texto 90
$tipoimgp90 = $letraaper90['tipo'];
}
?>

<!-- Iniciando o corpo da página -->
<!DOCTYPE HTML>
<html>

<!-- Definindo caracteristicas basicas para a pagina -->
<meta charset="UTF-8">
<title><?php echo $dados_prova['nome']; ?></title>

<!-- Colocando ícone na página -->
<link rel="icon" type="image/png" href="img/img_icone1.png"/>

<!-- link para icones -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

<script>

// Função para abrir a pagina sobre -->
function sobre() {
      location.href='sobreadm.php';
}

// Função para abrir a pagina alterar dados adm -->
function pgaltdados() {
      location.href='alterar_dadosadm.php';
}

// Função para imprimir -->
function imprimir() {
    header.style.display = "none"; 

    window.print();
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
          <i class="bi bi-printer" onclick="imprimir()" title='Imprimir Gabarito'></i>
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


<!-- Fechando cabeçalho -->

<div class="box">
<b>Escola:</b> <input type="text" style="border: 0 none; width: 90%;" name="escola" pattern="[a-z\s]+$" style=" font-size:20px;" maxlength="150">
<b>Nome: _________________________________________________________________________ Série: </b><input type="text" style="border: 0 none; width: 10%;" name="serie" pattern="[a-z\s]+$" style=" font-size:20px;" maxlength="4">
<br><br>
<b>Data: ___/___/______ </b>
<br><br>
<b>Professor: </b><input type="text" style="border: 0 none; width: 90%;" name="professor" pattern="[a-z\s]+$" style=" font-size:20px;" maxlength="150">
<br><br><br>

<!-- Inserindo qustão 1 -->
<b>Questão 1:</b>
<br><br>
<?php echo $per1['pergunta']; ?>
<br><br><br>

<!-- Verificando caracteristicas da questão 1 -->
<?php 

// Se possui imagem
if ($imgper1 != "Não possui"){
    echo "<img src='uploads/$imgper1' width='500'>";
    echo "<br><br><br>";
}
else{

}

// O tipo de resposta
if ($tipoimgp1 == 0) {
echo "<label>A) ".$letraaper1['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper1['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper1['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper1['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper1['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap1 = $letraaper1['alternativa'];
$imgletbp1 = $letrabper1['alternativa'];
$imgletcp1 = $letracper1['alternativa'];
$imgletdp1 = $letradper1['alternativa'];
$imgletep1 = $letraeper1['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap1' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp1' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp1' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp1' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep1' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
?>

<!-- Verificando caracteristicas da questão 2 -->
<b>Questão 2:</b>
<br><br>
<?php echo $per2['pergunta']; ?>
<br><br><br>

<?php 

// Se possui imagem
if ($imgper2 != "Não possui"){
    echo "<img src='uploads/$imgper2' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp2 == 0) {

echo "<label>A) ".$letraaper2['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper2['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper2['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper2['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper2['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap2 = $letraaper2['alternativa'];
$imgletbp2 = $letrabper2['alternativa'];
$imgletcp2 = $letracper2['alternativa'];
$imgletdp2 = $letradper2['alternativa'];
$imgletep2 = $letraeper2['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap2' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp2' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp2' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp2' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep2' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
?>

<!-- Verificando caracteristicas da questão 3 -->
<b>Questão 3:</b>
<br><br>
<?php echo $per3['pergunta']; ?>
<br><br><br>

<?php 

// Se possui imagem
if ($imgper3 != "Não possui"){
    echo "<img src='uploads/$imgper3' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp3 == 0) {

echo "<label>A) ".$letraaper3['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper3['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper3['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper3['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper3['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap3 = $letraaper3['alternativa'];
$imgletbp3 = $letrabper3['alternativa'];
$imgletcp3 = $letracper3['alternativa'];
$imgletdp3 = $letradper3['alternativa'];
$imgletep3 = $letraeper3['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap3' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp3' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp3' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp3' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep3' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
?>

<!-- Verificando caracteristicas da questão 4 -->
<b>Questão 4:</b>
<br><br>
<?php echo $per4['pergunta']; ?>
<br><br><br>

<?php 

// Se possui imagem
if ($imgper4 != "Não possui"){
    echo "<img src='uploads/$imgper4' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp4 == 0) {

echo "<label>A) ".$letraaper4['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper4['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper4['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper4['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper4['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap4 = $letraaper4['alternativa'];
$imgletbp4 = $letrabper4['alternativa'];
$imgletcp4 = $letracper4['alternativa'];
$imgletdp4 = $letradper4['alternativa'];
$imgletep4 = $letraeper4['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap4' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp4' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp4' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp4' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep4' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
?>

<!-- Verificando caracteristicas da questão 5 -->
<b>Questão 5:</b>
<br><br>
<?php echo $per5['pergunta']; ?>
<br><br><br>

<?php 

// Se possui imagem
if ($imgper5 != "Não possui"){
    echo "<img src='uploads/$imgper5' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp5 == 0) {

echo "<label>A) ".$letraaper5['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper5['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper5['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper5['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper5['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap5 = $letraaper5['alternativa'];
$imgletbp5 = $letrabper5['alternativa'];
$imgletcp5 = $letracper5['alternativa'];
$imgletdp5 = $letradper5['alternativa'];
$imgletep5 = $letraeper5['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap5' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp5' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp5' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp5' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep5' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
?>

<!-- Verificando se à questões de 6 à 10 e suas caracteristicas -->
<?php
if ($qtperguntas>5){

// Verificando caracteristicas 6
echo "<b>Questão 6:</b>";
echo "<br><br>";
echo $per6['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper6 != "Não possui"){
    echo "<img src='uploads/$imgper6' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp6 == 0) {

echo "<label>A) ".$letraaper6['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper6['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper6['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper6['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper6['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap6 = $letraaper6['alternativa'];
$imgletbp6 = $letrabper6['alternativa'];
$imgletcp6 = $letracper6['alternativa'];
$imgletdp6 = $letradper6['alternativa'];
$imgletep6 = $letraeper6['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap6' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp6' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp6' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp6' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep6' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 7
echo "<b>Questão 7:</b>";
echo "<br><br>";
echo $per7['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper7 != "Não possui"){
    echo "<img src='uploads/$imgper7' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp7 == 0) {

echo "<label>A) ".$letraaper7['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper7['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper7['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper7['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper7['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap7 = $letraaper7['alternativa'];
$imgletbp7 = $letrabper7['alternativa'];
$imgletcp7 = $letracper7['alternativa'];
$imgletdp7 = $letradper7['alternativa'];
$imgletep7 = $letraeper7['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap7' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp7' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp7' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp7' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep7' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 8
echo "<b>Questão 8:</b>";
echo "<br><br>";
echo $per8['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper8 != "Não possui"){
    echo "<img src='uploads/$imgper8' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp8 == 0) {

echo "<label>A) ".$letraaper8['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper8['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper8['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper8['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper8['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap8 = $letraaper8['alternativa'];
$imgletbp8 = $letrabper8['alternativa'];
$imgletcp8 = $letracper8['alternativa'];
$imgletdp8 = $letradper8['alternativa'];
$imgletep8 = $letraeper8['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap8' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp8' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp8' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp8' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep8' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 9
echo "<b>Questão 9:</b>";
echo "<br><br>";
echo $per9['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper9 != "Não possui"){
    echo "<img src='uploads/$imgper9' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp9 == 0) {

echo "<label>A) ".$letraaper9['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>B) ".$letrabper9['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>C) ".$letracper9['alternativa'];
echo "</label>";
echo "<br><br>";
echo "<label>D) ".$letradper9['alternativa']; 
echo "</label>";
echo "<br><br>";
echo "<label>E) ".$letraeper9['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap9 = $letraaper9['alternativa'];
$imgletbp9 = $letrabper9['alternativa'];
$imgletcp9 = $letracper9['alternativa'];
$imgletdp9 = $letradper9['alternativa'];
$imgletep9 = $letraeper9['alternativa'];


echo "<label>A) <br> <img src='img_res/$imgletap9' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>B) <br> <img src='img_res/$imgletbp9' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>C) <br> <img src='img_res/$imgletcp9' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>D) <br> <img src='img_res/$imgletdp9' width='300'>"; 
echo "</label>";
echo "<br><br>";
echo "<label>E) <br> <img src='img_res/$imgletep9' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 10
echo "<b>Questão 10:</b>";
echo "<br><br>";
echo $per10['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper10 != "Não possui"){
    echo "<img src='uploads/$imgper10' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp10 == 0) {
echo "<label>A) ".$letraaper10['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper10['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper10['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper10['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper10['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap10 = $letraaper10['alternativa'];
$imgletbp10 = $letrabper10['alternativa'];
$imgletcp10 = $letracper10['alternativa'];
$imgletdp10 = $letradper10['alternativa'];
$imgletep10 = $letraeper10['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap10' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp10' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp10' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp10' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep10' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 11 à 15 e suas caracteristicas -->
<?php
if ($qtperguntas>10){

// Verificando caracteristicas 11
echo "<b>Questão 11:</b>";
echo "<br><br>";
echo $per11['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper11 != "Não possui"){
    echo "<img src='uploads/$imgper11' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp11 == 0) {
echo "<label>A) ".$letraaper11['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper11['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper11['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper11['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper11['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap11 = $letraaper11['alternativa'];
$imgletbp11 = $letrabper11['alternativa'];
$imgletcp11 = $letracper11['alternativa'];
$imgletdp11 = $letradper11['alternativa'];
$imgletep11 = $letraeper11['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap11' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp11' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp11' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp11' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep11' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 12
echo "<b>Questão 12:</b>";
echo "<br><br>";
echo $per12['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper12 != "Não possui"){
    echo "<img src='uploads/$imgper12' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp12 == 0) {
echo "<label>A) ".$letraaper12['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper12['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper12['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper12['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper12['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap12 = $letraaper12['alternativa'];
$imgletbp12 = $letrabper12['alternativa'];
$imgletcp12 = $letracper12['alternativa'];
$imgletdp12 = $letradper12['alternativa'];
$imgletep12 = $letraeper12['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap12' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp12' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp12' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp12' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep12' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 13
echo "<b>Questão 13:</b>";
echo "<br><br>";
echo $per13['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper13 != "Não possui"){
    echo "<img src='uploads/$imgper13' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp13 == 0) {
echo "<label>A) ".$letraaper13['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper13['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper13['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper13['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper13['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap13 = $letraaper13['alternativa'];
$imgletbp13 = $letrabper13['alternativa'];
$imgletcp13 = $letracper13['alternativa'];
$imgletdp13 = $letradper13['alternativa'];
$imgletep13 = $letraeper13['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap13' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp13' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp13' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp13' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep13' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 14
echo "<b>Questão 14:</b>";
echo "<br><br>";
echo $per14['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper14 != "Não possui"){
    echo "<img src='uploads/$imgper14' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp14 == 0) {
echo "<label>A) ".$letraaper14['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper14['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper14['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper14['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper14['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap14 = $letraaper14['alternativa'];
$imgletbp14 = $letrabper14['alternativa'];
$imgletcp14 = $letracper14['alternativa'];
$imgletdp14 = $letradper14['alternativa'];
$imgletep14 = $letraeper14['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap14' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp14' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp14' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp14' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep14' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 15
echo "<b>Questão 15:</b>";
echo "<br><br>";
echo $per15['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper15 != "Não possui"){
    echo "<img src='uploads/$imgper15' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp15 == 0) {
echo "<label>A) ".$letraaper15['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper15['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper15['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper15['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper15['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap15 = $letraaper15['alternativa'];
$imgletbp15 = $letrabper15['alternativa'];
$imgletcp15 = $letracper15['alternativa'];
$imgletdp15 = $letradper15['alternativa'];
$imgletep15 = $letraeper15['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap15' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp15' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp15' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp15' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep15' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 16 à 20 e suas caracteristicas -->
<?php
if ($qtperguntas>15){

// Verificando caracteristicas 16
echo "<b>Questão 16:</b>";
echo "<br><br>";
echo $per16['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper16 != "Não possui"){
    echo "<img src='uploads/$imgper16' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp16 == 0) {
echo "<label>A) ".$letraaper16['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper16['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper16['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper16['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper16['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap16 = $letraaper16['alternativa'];
$imgletbp16 = $letrabper16['alternativa'];
$imgletcp16 = $letracper16['alternativa'];
$imgletdp16 = $letradper16['alternativa'];
$imgletep16 = $letraeper16['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap16' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp16' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp16' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp16' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep16' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 17
echo "<b>Questão 17:</b>";
echo "<br><br>";
echo $per17['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper17 != "Não possui"){
    echo "<img src='uploads/$imgper17' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp17 == 0) {
echo "<label>A) ".$letraaper17['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper17['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper17['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper17['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper17['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap17 = $letraaper17['alternativa'];
$imgletbp17 = $letrabper17['alternativa'];
$imgletcp17 = $letracper17['alternativa'];
$imgletdp17 = $letradper17['alternativa'];
$imgletep17 = $letraeper17['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap17' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp17' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp17' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp17' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep17' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 18
echo "<b>Questão 18:</b>";
echo "<br><br>";
echo $per18['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper18 != "Não possui"){
    echo "<img src='uploads/$imgper18' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp18 == 0) {
echo "<label>A) ".$letraaper18['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper18['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper18['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper18['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper18['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap18 = $letraaper18['alternativa'];
$imgletbp18 = $letrabper18['alternativa'];
$imgletcp18 = $letracper18['alternativa'];
$imgletdp18 = $letradper18['alternativa'];
$imgletep18 = $letraeper18['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap18' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp18' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp18' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp18' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep18' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 19
echo "<b>Questão 19:</b>";
echo "<br><br>";
echo $per19['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper19 != "Não possui"){
    echo "<img src='uploads/$imgper19' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp19 == 0) {
echo "<label>A) ".$letraaper19['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper19['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper19['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper19['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper19['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap19 = $letraaper19['alternativa'];
$imgletbp19 = $letrabper19['alternativa'];
$imgletcp19 = $letracper19['alternativa'];
$imgletdp19 = $letradper19['alternativa'];
$imgletep19 = $letraeper19['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap19' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp19' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp19' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp19' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep19' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 20
echo "<b>Questão 20:</b>";
echo "<br><br>";
echo $per20['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper20 != "Não possui"){
    echo "<img src='uploads/$imgper20' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp20 == 0) {
echo "<label>A) ".$letraaper20['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper20['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper20['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper20['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper20['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap20 = $letraaper20['alternativa'];
$imgletbp20 = $letrabper20['alternativa'];
$imgletcp20 = $letracper20['alternativa'];
$imgletdp20 = $letradper20['alternativa'];
$imgletep20 = $letraeper20['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap20' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp20' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp20' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp20' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep20' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 21 à 25 e suas caracteristicas -->
<?php
if ($qtperguntas>20){

// Verificando caracteristicas 21
echo "<b>Questão 21:</b>";
echo "<br><br>";
echo $per21['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper21 != "Não possui"){
    echo "<img src='uploads/$imgper21' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp21 == 0) {
echo "<label>A) ".$letraaper21['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper21['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper21['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper21['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper21['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap21 = $letraaper21['alternativa'];
$imgletbp21 = $letrabper21['alternativa'];
$imgletcp21 = $letracper21['alternativa'];
$imgletdp21 = $letradper21['alternativa'];
$imgletep21 = $letraeper21['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap21' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp21' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp21' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp21' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep21' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 22
echo "<b>Questão 22:</b>";
echo "<br><br>";
echo $per22['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper22 != "Não possui"){
    echo "<img src='uploads/$imgper22' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp22 == 0) {
echo "<label>A) ".$letraaper22['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper22['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper22['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper22['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper22['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap22 = $letraaper22['alternativa'];
$imgletbp22 = $letrabper22['alternativa'];
$imgletcp22 = $letracper22['alternativa'];
$imgletdp22 = $letradper22['alternativa'];
$imgletep22 = $letraeper22['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap22' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp22' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp22' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp22' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep22' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 23
echo "<b>Questão 23:</b>";
echo "<br><br>";
echo $per23['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper23 != "Não possui"){
    echo "<img src='uploads/$imgper23' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp23 == 0) {
echo "<label>A) ".$letraaper23['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper23['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper23['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper23['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper23['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap23 = $letraaper23['alternativa'];
$imgletbp23 = $letrabper23['alternativa'];
$imgletcp23 = $letracper23['alternativa'];
$imgletdp23 = $letradper23['alternativa'];
$imgletep23 = $letraeper23['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap23' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp23' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp23' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp23' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep23' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 24
echo "<b>Questão 24:</b>";
echo "<br><br>";
echo $per24['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper24 != "Não possui"){
    echo "<img src='uploads/$imgper24' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp24 == 0) {
echo "<label>A) ".$letraaper24['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper24['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper24['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper24['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper24['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap24 = $letraaper24['alternativa'];
$imgletbp24 = $letrabper24['alternativa'];
$imgletcp24 = $letracper24['alternativa'];
$imgletdp24 = $letradper24['alternativa'];
$imgletep24 = $letraeper24['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap24' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp24' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp24' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp24' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep24' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 25
echo "<b>Questão 25:</b>";
echo "<br><br>";
echo $per25['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper25 != "Não possui"){
    echo "<img src='uploads/$imgper25' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp25 == 0) {
echo "<label>A) ".$letraaper25['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper25['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper25['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper25['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper25['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap25 = $letraaper25['alternativa'];
$imgletbp25 = $letrabper25['alternativa'];
$imgletcp25 = $letracper25['alternativa'];
$imgletdp25 = $letradper25['alternativa'];
$imgletep25 = $letraeper25['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap25' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp25' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp25' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp25' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep25' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 26 à 30 e suas caracteristicas -->
<?php
if ($qtperguntas>25){

// Verificando caracteristicas 26
echo "<b>Questão 26:</b>";
echo "<br><br>";
echo $per26['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper26 != "Não possui"){
    echo "<img src='uploads/$imgper26' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp26 == 0) {
echo "<label>A) ".$letraaper26['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper26['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper26['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper26['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper26['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap26 = $letraaper26['alternativa'];
$imgletbp26 = $letrabper26['alternativa'];
$imgletcp26 = $letracper26['alternativa'];
$imgletdp26 = $letradper26['alternativa'];
$imgletep26 = $letraeper26['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap26' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp26' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp26' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp26' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep26' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 27
echo "<b>Questão 27:</b>";
echo "<br><br>";
echo $per27['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper27 != "Não possui"){
    echo "<img src='uploads/$imgper27' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp27 == 0) {
echo "<label>A) ".$letraaper27['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper27['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper27['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper27['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper27['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap27 = $letraaper27['alternativa'];
$imgletbp27 = $letrabper27['alternativa'];
$imgletcp27 = $letracper27['alternativa'];
$imgletdp27 = $letradper27['alternativa'];
$imgletep27 = $letraeper27['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap27' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp27' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp27' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp27' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep27' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 28
echo "<b>Questão 28:</b>";
echo "<br><br>";
echo $per28['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper28 != "Não possui"){
    echo "<img src='uploads/$imgper28' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp28 == 0) {
echo "<label>A) ".$letraaper28['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper28['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper28['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper28['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper28['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap28 = $letraaper28['alternativa'];
$imgletbp28 = $letrabper28['alternativa'];
$imgletcp28 = $letracper28['alternativa'];
$imgletdp28 = $letradper28['alternativa'];
$imgletep28 = $letraeper28['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap28' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp28' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp28' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp28' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep28' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 29
echo "<b>Questão 29:</b>";
echo "<br><br>";
echo $per29['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper29 != "Não possui"){
    echo "<img src='uploads/$imgper29' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp29 == 0) {
echo "<label>A) ".$letraaper29['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper29['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper29['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper29['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper29['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap29 = $letraaper29['alternativa'];
$imgletbp29 = $letrabper29['alternativa'];
$imgletcp29 = $letracper29['alternativa'];
$imgletdp29 = $letradper29['alternativa'];
$imgletep29 = $letraeper29['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap29' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp29' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp29' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp29' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep29' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 30
echo "<b>Questão 30:</b>";
echo "<br><br>";
echo $per30['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper30 != "Não possui"){
    echo "<img src='uploads/$imgper30' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp30 == 0) {
echo "<label>A) ".$letraaper30['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper30['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper30['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper30['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper30['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap30 = $letraaper30['alternativa'];
$imgletbp30 = $letrabper30['alternativa'];
$imgletcp30 = $letracper30['alternativa'];
$imgletdp30 = $letradper30['alternativa'];
$imgletep30 = $letraeper30['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap30' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp30' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp30' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp30' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep30' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 31 à 35 e suas caracteristicas -->
<?php
if ($qtperguntas>30){

// Verificando caracteristicas 31
echo "<b>Questão 31:</b>";
echo "<br><br>";
echo $per31['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper31 != "Não possui"){
    echo "<img src='uploads/$imgper31' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp31 == 0) {
echo "<label>A) ".$letraaper31['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper31['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper31['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper31['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper31['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap31 = $letraaper31['alternativa'];
$imgletbp31 = $letrabper31['alternativa'];
$imgletcp31 = $letracper31['alternativa'];
$imgletdp31 = $letradper31['alternativa'];
$imgletep31 = $letraeper31['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap31' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp31' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp31' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp31' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep31' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 32
echo "<b>Questão 32:</b>";
echo "<br><br>";
echo $per32['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper32 != "Não possui"){
    echo "<img src='uploads/$imgper32' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp32 == 0) {
echo "<label>A) ".$letraaper32['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper32['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper32['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper32['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper32['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap32 = $letraaper32['alternativa'];
$imgletbp32 = $letrabper32['alternativa'];
$imgletcp32 = $letracper32['alternativa'];
$imgletdp32 = $letradper32['alternativa'];
$imgletep32 = $letraeper32['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap32' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp32' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp32' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp32' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep32' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 33
echo "<b>Questão 33:</b>";
echo "<br><br>";
echo $per33['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper33 != "Não possui"){
    echo "<img src='uploads/$imgper33' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp33 == 0) {
echo "<label>A) ".$letraaper33['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper33['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper33['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper33['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper33['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap33 = $letraaper33['alternativa'];
$imgletbp33 = $letrabper33['alternativa'];
$imgletcp33 = $letracper33['alternativa'];
$imgletdp33 = $letradper33['alternativa'];
$imgletep33 = $letraeper33['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap33' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp33' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp33' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp33' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep33' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 34
echo "<b>Questão 34:</b>";
echo "<br><br>";
echo $per34['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper34 != "Não possui"){
    echo "<img src='uploads/$imgper34' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp34 == 0) {
echo "<label>A) ".$letraaper34['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper34['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper34['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper34['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper34['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap34 = $letraaper34['alternativa'];
$imgletbp34 = $letrabper34['alternativa'];
$imgletcp34 = $letracper34['alternativa'];
$imgletdp34 = $letradper34['alternativa'];
$imgletep34 = $letraeper34['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap34' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp34' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp34' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp34' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep34' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 35
echo "<b>Questão 35:</b>";
echo "<br><br>";
echo $per35['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper35 != "Não possui"){
    echo "<img src='uploads/$imgper35' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp35 == 0) {
echo "<label>A) ".$letraaper35['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper35['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper35['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper35['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper35['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap35 = $letraaper35['alternativa'];
$imgletbp35 = $letrabper35['alternativa'];
$imgletcp35 = $letracper35['alternativa'];
$imgletdp35 = $letradper35['alternativa'];
$imgletep35 = $letraeper35['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap35' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp35' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp35' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp35' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep35' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 36 à 40 e suas caracteristicas -->
<?php
if ($qtperguntas>35){

// Verificando caracteristicas 36
echo "<b>Questão 36:</b>";
echo "<br><br>";
echo $per36['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper36 != "Não possui"){
    echo "<img src='uploads/$imgper36' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp36 == 0) {
echo "<label>A) ".$letraaper36['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper36['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper36['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper36['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper36['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap36 = $letraaper36['alternativa'];
$imgletbp36 = $letrabper36['alternativa'];
$imgletcp36 = $letracper36['alternativa'];
$imgletdp36 = $letradper36['alternativa'];
$imgletep36 = $letraeper36['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap36' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp36' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp36' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp36' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep36' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 37
echo "<b>Questão 37:</b>";
echo "<br><br>";
echo $per37['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper37 != "Não possui"){
    echo "<img src='uploads/$imgper37' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp37 == 0) {
echo "<label>A) ".$letraaper37['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper37['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper37['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper37['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper37['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap37 = $letraaper37['alternativa'];
$imgletbp37 = $letrabper37['alternativa'];
$imgletcp37 = $letracper37['alternativa'];
$imgletdp37 = $letradper37['alternativa'];
$imgletep37 = $letraeper37['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap37' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp37' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp37' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp37' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep37' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 38
echo "<b>Questão 38:</b>";
echo "<br><br>";
echo $per38['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper38 != "Não possui"){
    echo "<img src='uploads/$imgper38' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp38 == 0) {
echo "<label>A) ".$letraaper38['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper38['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper38['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper38['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper38['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap38 = $letraaper38['alternativa'];
$imgletbp38 = $letrabper38['alternativa'];
$imgletcp38 = $letracper38['alternativa'];
$imgletdp38 = $letradper38['alternativa'];
$imgletep38 = $letraeper38['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap38' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp38' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp38' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp38' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep38' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 39
echo "<b>Questão 39:</b>";
echo "<br><br>";
echo $per39['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper39 != "Não possui"){
    echo "<img src='uploads/$imgper39' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp39 == 0) {
echo "<label>A) ".$letraaper39['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper39['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper39['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper39['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper39['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap39 = $letraaper39['alternativa'];
$imgletbp39 = $letrabper39['alternativa'];
$imgletcp39 = $letracper39['alternativa'];
$imgletdp39 = $letradper39['alternativa'];
$imgletep39 = $letraeper39['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap39' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp39' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp39' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp39' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep39' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 40
echo "<b>Questão 40:</b>";
echo "<br><br>";
echo $per40['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper40 != "Não possui"){
    echo "<img src='uploads/$imgper40' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp40 == 0) {
echo "<label>A) ".$letraaper40['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper40['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper40['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper40['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper40['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap40 = $letraaper40['alternativa'];
$imgletbp40 = $letrabper40['alternativa'];
$imgletcp40 = $letracper40['alternativa'];
$imgletdp40 = $letradper40['alternativa'];
$imgletep40 = $letraeper40['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap40' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp40' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp40' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp40' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep40' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 41 à 45 e suas caracteristicas -->
<?php
if ($qtperguntas>40){

// Verificando caracteristicas 41
echo "<b>Questão 41:</b>";
echo "<br><br>";
echo $per41['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper41 != "Não possui"){
    echo "<img src='uploads/$imgper41' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp41 == 0) {
echo "<label>A) ".$letraaper41['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper41['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper41['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper41['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper41['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap41 = $letraaper41['alternativa'];
$imgletbp41 = $letrabper41['alternativa'];
$imgletcp41 = $letracper41['alternativa'];
$imgletdp41 = $letradper41['alternativa'];
$imgletep41 = $letraeper41['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap41' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp41' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp41' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp41' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep41' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 42
echo "<b>Questão 42:</b>";
echo "<br><br>";
echo $per42['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper42 != "Não possui"){
    echo "<img src='uploads/$imgper42' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp42 == 0) {
echo "<label>A) ".$letraaper42['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper42['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper42['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper42['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper42['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap42 = $letraaper42['alternativa'];
$imgletbp42 = $letrabper42['alternativa'];
$imgletcp42 = $letracper42['alternativa'];
$imgletdp42 = $letradper42['alternativa'];
$imgletep42 = $letraeper42['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap42' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp42' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp42' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp42' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep42' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 43
echo "<b>Questão 43:</b>";
echo "<br><br>";
echo $per43['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper43 != "Não possui"){
    echo "<img src='uploads/$imgper43' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp43 == 0) {
echo "<label>A) ".$letraaper43['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper43['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper43['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper43['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper43['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap43 = $letraaper43['alternativa'];
$imgletbp43 = $letrabper43['alternativa'];
$imgletcp43 = $letracper43['alternativa'];
$imgletdp43 = $letradper43['alternativa'];
$imgletep43 = $letraeper43['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap43' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp43' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp43' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp43' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep43' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 44
echo "<b>Questão 44:</b>";
echo "<br><br>";
echo $per44['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper44 != "Não possui"){
    echo "<img src='uploads/$imgper44' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp44 == 0) {
echo "<label>A) ".$letraaper44['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper44['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper44['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper44['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper44['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap44 = $letraaper44['alternativa'];
$imgletbp44 = $letrabper44['alternativa'];
$imgletcp44 = $letracper44['alternativa'];
$imgletdp44 = $letradper44['alternativa'];
$imgletep44 = $letraeper44['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap44' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp44' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp44' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp44' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep44' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 45
echo "<b>Questão 45:</b>";
echo "<br><br>";
echo $per45['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper45 != "Não possui"){
    echo "<img src='uploads/$imgper45' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp45 == 0) {
echo "<label>A) ".$letraaper45['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper45['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper45['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper45['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper45['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap45 = $letraaper45['alternativa'];
$imgletbp45 = $letrabper45['alternativa'];
$imgletcp45 = $letracper45['alternativa'];
$imgletdp45 = $letradper45['alternativa'];
$imgletep45 = $letraeper45['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap45' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp45' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp45' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp45' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep45' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 46 à 50 e suas caracteristicas -->
<?php
if ($qtperguntas>45){

// Verificando caracteristicas 46
echo "<b>Questão 46:</b>";
echo "<br><br>";
echo $per46['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper46 != "Não possui"){
    echo "<img src='uploads/$imgper46' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp46 == 0) {
echo "<label>A) ".$letraaper46['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper46['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper46['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper46['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper46['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap46 = $letraaper46['alternativa'];
$imgletbp46 = $letrabper46['alternativa'];
$imgletcp46 = $letracper46['alternativa'];
$imgletdp46 = $letradper46['alternativa'];
$imgletep46 = $letraeper46['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap46' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp46' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp46' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp46' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep46' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 47
echo "<b>Questão 47:</b>";
echo "<br><br>";
echo $per47['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper47 != "Não possui"){
    echo "<img src='uploads/$imgper47' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp47 == 0) {
echo "<label>A) ".$letraaper47['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper47['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper47['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper47['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper47['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap47 = $letraaper47['alternativa'];
$imgletbp47 = $letrabper47['alternativa'];
$imgletcp47 = $letracper47['alternativa'];
$imgletdp47 = $letradper47['alternativa'];
$imgletep47 = $letraeper47['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap47' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp47' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp47' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp47' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep47' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 48
echo "<b>Questão 48:</b>";
echo "<br><br>";
echo $per48['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper48 != "Não possui"){
    echo "<img src='uploads/$imgper48' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp48 == 0) {
echo "<label>A) ".$letraaper48['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper48['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper48['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper48['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper48['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap48 = $letraaper48['alternativa'];
$imgletbp48 = $letrabper48['alternativa'];
$imgletcp48 = $letracper48['alternativa'];
$imgletdp48 = $letradper48['alternativa'];
$imgletep48 = $letraeper48['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap48' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp48' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp48' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp48' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep48' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 49
echo "<b>Questão 49:</b>";
echo "<br><br>";
echo $per49['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper49 != "Não possui"){
    echo "<img src='uploads/$imgper49' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp49 == 0) {
echo "<label>A) ".$letraaper49['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper49['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper49['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper49['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper49['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap49 = $letraaper49['alternativa'];
$imgletbp49 = $letrabper49['alternativa'];
$imgletcp49 = $letracper49['alternativa'];
$imgletdp49 = $letradper49['alternativa'];
$imgletep49 = $letraeper49['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap49' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp49' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp49' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp49' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep49' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 50
echo "<b>Questão 50:</b>";
echo "<br><br>";
echo $per50['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper50 != "Não possui"){
    echo "<img src='uploads/$imgper50' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp50 == 0) {
echo "<label>A) ".$letraaper50['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper50['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper50['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper50['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper50['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap50 = $letraaper50['alternativa'];
$imgletbp50 = $letrabper50['alternativa'];
$imgletcp50 = $letracper50['alternativa'];
$imgletdp50 = $letradper50['alternativa'];
$imgletep50 = $letraeper50['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap50' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp50' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp50' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp50' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep50' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 51 à 155 e suas caracteristicas -->
<?php
if ($qtperguntas>50){

// Verificando caracteristicas 51
echo "<b>Questão 51:</b>";
echo "<br><br>";
echo $per51['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper51 != "Não possui"){
    echo "<img src='uploads/$imgper51' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp51 == 0) {
echo "<label>A) ".$letraaper51['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper51['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper51['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper51['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper51['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap51 = $letraaper51['alternativa'];
$imgletbp51 = $letrabper51['alternativa'];
$imgletcp51 = $letracper51['alternativa'];
$imgletdp51 = $letradper51['alternativa'];
$imgletep51 = $letraeper51['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap51' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp51' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp51' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp51' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep51' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 52
echo "<b>Questão 52:</b>";
echo "<br><br>";
echo $per52['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper52 != "Não possui"){
    echo "<img src='uploads/$imgper52' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp52 == 0) {
echo "<label>A) ".$letraaper52['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper52['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper52['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper52['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper52['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap52 = $letraaper52['alternativa'];
$imgletbp52 = $letrabper52['alternativa'];
$imgletcp52 = $letracper52['alternativa'];
$imgletdp52 = $letradper52['alternativa'];
$imgletep52 = $letraeper52['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap52' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp52' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp52' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp52' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep52' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 53
echo "<b>Questão 53:</b>";
echo "<br><br>";
echo $per53['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper53 != "Não possui"){
    echo "<img src='uploads/$imgper53' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp53 == 0) {
echo "<label>A) ".$letraaper53['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper53['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper53['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper53['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper53['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap53 = $letraaper53['alternativa'];
$imgletbp53 = $letrabper53['alternativa'];
$imgletcp53 = $letracper53['alternativa'];
$imgletdp53 = $letradper53['alternativa'];
$imgletep53 = $letraeper53['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap53' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp53' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp53' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp53' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep53' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 54
echo "<b>Questão 54:</b>";
echo "<br><br>";
echo $per54['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper54 != "Não possui"){
    echo "<img src='uploads/$imgper54' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp54 == 0) {
echo "<label>A) ".$letraaper54['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper54['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper54['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper54['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper54['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap54 = $letraaper54['alternativa'];
$imgletbp54 = $letrabper54['alternativa'];
$imgletcp54 = $letracper54['alternativa'];
$imgletdp54 = $letradper54['alternativa'];
$imgletep54 = $letraeper54['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap54' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp54' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp54' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp54' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep54' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 55
echo "<b>Questão 55:</b>";
echo "<br><br>";
echo $per55['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper55 != "Não possui"){
    echo "<img src='uploads/$imgper55' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp55 == 0) {
echo "<label>A) ".$letraaper55['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper55['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper55['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper55['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper55['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap55 = $letraaper55['alternativa'];
$imgletbp55 = $letrabper55['alternativa'];
$imgletcp55 = $letracper55['alternativa'];
$imgletdp55 = $letradper55['alternativa'];
$imgletep55 = $letraeper55['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap55' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp55' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp55' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp55' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep55' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 56 à 60 e suas caracteristicas -->
<?php
if ($qtperguntas>55){

// Verificando caracteristicas 56
echo "<b>Questão 56:</b>";
echo "<br><br>";
echo $per56['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper56 != "Não possui"){
    echo "<img src='uploads/$imgper56' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp56 == 0) {
echo "<label>A) ".$letraaper56['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper56['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper56['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper56['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper56['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap56 = $letraaper56['alternativa'];
$imgletbp56 = $letrabper56['alternativa'];
$imgletcp56 = $letracper56['alternativa'];
$imgletdp56 = $letradper56['alternativa'];
$imgletep56 = $letraeper56['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap56' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp56' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp56' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp56' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep56' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 57
echo "<b>Questão 57:</b>";
echo "<br><br>";
echo $per57['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper57 != "Não possui"){
    echo "<img src='uploads/$imgper57' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp57 == 0) {
echo "<label>A) ".$letraaper57['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper57['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper57['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper57['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper57['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap57 = $letraaper57['alternativa'];
$imgletbp57 = $letrabper57['alternativa'];
$imgletcp57 = $letracper57['alternativa'];
$imgletdp57 = $letradper57['alternativa'];
$imgletep57 = $letraeper57['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap57' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp57' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp57' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp57' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep57' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 58
echo "<b>Questão 58:</b>";
echo "<br><br>";
echo $per58['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper58 != "Não possui"){
    echo "<img src='uploads/$imgper58' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp58 == 0) {
echo "<label>A) ".$letraaper58['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper58['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper58['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper58['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper58['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap58 = $letraaper58['alternativa'];
$imgletbp58 = $letrabper58['alternativa'];
$imgletcp58 = $letracper58['alternativa'];
$imgletdp58 = $letradper58['alternativa'];
$imgletep58 = $letraeper58['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap58' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp58' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp58' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp58' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep58' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 59
echo "<b>Questão 59:</b>";
echo "<br><br>";
echo $per59['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper59 != "Não possui"){
    echo "<img src='uploads/$imgper59' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp59 == 0) {
echo "<label>A) ".$letraaper59['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper59['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper59['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper59['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper59['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap59 = $letraaper59['alternativa'];
$imgletbp59 = $letrabper59['alternativa'];
$imgletcp59 = $letracper59['alternativa'];
$imgletdp59 = $letradper59['alternativa'];
$imgletep59 = $letraeper59['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap59' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp59' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp59' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp59' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep59' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 60
echo "<b>Questão 60:</b>";
echo "<br><br>";
echo $per60['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper60 != "Não possui"){
    echo "<img src='uploads/$imgper60' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp60 == 0) {
echo "<label>A) ".$letraaper60['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper60['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper60['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper60['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper60['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap60 = $letraaper60['alternativa'];
$imgletbp60 = $letrabper60['alternativa'];
$imgletcp60 = $letracper60['alternativa'];
$imgletdp60 = $letradper60['alternativa'];
$imgletep60 = $letraeper60['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap60' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp60' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp60' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp60' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep60' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 61 à 65 e suas caracteristicas -->
<?php
if ($qtperguntas>60){

// Verificando caracteristicas 61
echo "<b>Questão 61:</b>";
echo "<br><br>";
echo $per61['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper61 != "Não possui"){
    echo "<img src='uploads/$imgper61' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp61 == 0) {
echo "<label>A) ".$letraaper61['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper61['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper61['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper61['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper61['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap61 = $letraaper61['alternativa'];
$imgletbp61 = $letrabper61['alternativa'];
$imgletcp61 = $letracper61['alternativa'];
$imgletdp61 = $letradper61['alternativa'];
$imgletep61 = $letraeper61['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap61' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp61' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp61' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp61' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep61' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 62
echo "<b>Questão 62:</b>";
echo "<br><br>";
echo $per62['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper62 != "Não possui"){
    echo "<img src='uploads/$imgper62' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp62 == 0) {
echo "<label>A) ".$letraaper62['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper62['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper62['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper62['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper62['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap62 = $letraaper62['alternativa'];
$imgletbp62 = $letrabper62['alternativa'];
$imgletcp62 = $letracper62['alternativa'];
$imgletdp62 = $letradper62['alternativa'];
$imgletep62 = $letraeper62['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap62' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp62' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp62' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp62' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep62' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 63
echo "<b>Questão 63:</b>";
echo "<br><br>";
echo $per63['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper63 != "Não possui"){
    echo "<img src='uploads/$imgper63' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp63 == 0) {
echo "<label>A) ".$letraaper63['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper63['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper63['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper63['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper63['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap63 = $letraaper63['alternativa'];
$imgletbp63 = $letrabper63['alternativa'];
$imgletcp63 = $letracper63['alternativa'];
$imgletdp63 = $letradper63['alternativa'];
$imgletep63 = $letraeper63['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap63' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp63' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp63' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp63' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep63' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 64
echo "<b>Questão 64:</b>";
echo "<br><br>";
echo $per64['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper64 != "Não possui"){
    echo "<img src='uploads/$imgper64' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp64 == 0) {
echo "<label>A) ".$letraaper64['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper64['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper64['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper64['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper64['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap64 = $letraaper64['alternativa'];
$imgletbp64 = $letrabper64['alternativa'];
$imgletcp64 = $letracper64['alternativa'];
$imgletdp64 = $letradper64['alternativa'];
$imgletep64 = $letraeper64['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap64' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp64' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp64' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp64' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep64' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 65
echo "<b>Questão 65:</b>";
echo "<br><br>";
echo $per65['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper65 != "Não possui"){
    echo "<img src='uploads/$imgper65' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp65 == 0) {
echo "<label>A) ".$letraaper65['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper65['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper65['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper65['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper65['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap65 = $letraaper65['alternativa'];
$imgletbp65 = $letrabper65['alternativa'];
$imgletcp65 = $letracper65['alternativa'];
$imgletdp65 = $letradper65['alternativa'];
$imgletep65 = $letraeper65['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap65' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp65' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp65' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp65' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep65' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 66 à 70 e suas caracteristicas -->
<?php
if ($qtperguntas>65){

// Verificando caracteristicas 66
echo "<b>Questão 66:</b>";
echo "<br><br>";
echo $per66['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper66 != "Não possui"){
    echo "<img src='uploads/$imgper66' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp66 == 0) {
echo "<label>A) ".$letraaper66['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper66['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper66['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper66['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper66['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap66 = $letraaper66['alternativa'];
$imgletbp66 = $letrabper66['alternativa'];
$imgletcp66 = $letracper66['alternativa'];
$imgletdp66 = $letradper66['alternativa'];
$imgletep66 = $letraeper66['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap66' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp66' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp66' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp66' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep66' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 67
echo "<b>Questão 67:</b>";
echo "<br><br>";
echo $per67['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper67 != "Não possui"){
    echo "<img src='uploads/$imgper67' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp67 == 0) {
echo "<label>A) ".$letraaper67['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper67['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper67['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper67['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper67['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap67 = $letraaper67['alternativa'];
$imgletbp67 = $letrabper67['alternativa'];
$imgletcp67 = $letracper67['alternativa'];
$imgletdp67 = $letradper67['alternativa'];
$imgletep67 = $letraeper67['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap67' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp67' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp67' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp67' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep67' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 68
echo "<b>Questão 68:</b>";
echo "<br><br>";
echo $per68['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper68 != "Não possui"){
    echo "<img src='uploads/$imgper68' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp68 == 0) {
echo "<label>A) ".$letraaper68['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper68['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper68['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper68['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper68['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap68 = $letraaper68['alternativa'];
$imgletbp68 = $letrabper68['alternativa'];
$imgletcp68 = $letracper68['alternativa'];
$imgletdp68 = $letradper68['alternativa'];
$imgletep68 = $letraeper68['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap68' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp68' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp68' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp68' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep68' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 69
echo "<b>Questão 69:</b>";
echo "<br><br>";
echo $per69['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper69 != "Não possui"){
    echo "<img src='uploads/$imgper69' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp69 == 0) {
echo "<label>A) ".$letraaper69['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper69['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper69['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper69['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper69['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap69 = $letraaper69['alternativa'];
$imgletbp69 = $letrabper69['alternativa'];
$imgletcp69 = $letracper69['alternativa'];
$imgletdp69 = $letradper69['alternativa'];
$imgletep69 = $letraeper69['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap69' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp69' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp69' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp69' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep69' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 70
echo "<b>Questão 70:</b>";
echo "<br><br>";
echo $per70['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper70 != "Não possui"){
    echo "<img src='uploads/$imgper70' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp70 == 0) {
echo "<label>A) ".$letraaper70['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper70['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper70['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper70['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper70['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap70 = $letraaper70['alternativa'];
$imgletbp70 = $letrabper70['alternativa'];
$imgletcp70 = $letracper70['alternativa'];
$imgletdp70 = $letradper70['alternativa'];
$imgletep70 = $letraeper70['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap70' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp70' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp70' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp70' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep70' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 71 à 75 e suas caracteristicas -->
<?php
if ($qtperguntas>70){

// Verificando caracteristicas 71
echo "<b>Questão 71:</b>";
echo "<br><br>";
echo $per71['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper71 != "Não possui"){
    echo "<img src='uploads/$imgper71' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp71 == 0) {
echo "<label>A) ".$letraaper71['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper71['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper71['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper71['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper71['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap71 = $letraaper71['alternativa'];
$imgletbp71 = $letrabper71['alternativa'];
$imgletcp71 = $letracper71['alternativa'];
$imgletdp71 = $letradper71['alternativa'];
$imgletep71 = $letraeper71['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap71' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp71' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp71' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp71' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep71' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 72
echo "<b>Questão 72:</b>";
echo "<br><br>";
echo $per72['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper72 != "Não possui"){
    echo "<img src='uploads/$imgper72' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp72 == 0) {
echo "<label>A) ".$letraaper72['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper72['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper72['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper72['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper72['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap72 = $letraaper72['alternativa'];
$imgletbp72 = $letrabper72['alternativa'];
$imgletcp72 = $letracper72['alternativa'];
$imgletdp72 = $letradper72['alternativa'];
$imgletep72 = $letraeper72['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap72' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp72' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp72' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp72' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep72' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 73
echo "<b>Questão 73:</b>";
echo "<br><br>";
echo $per73['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper73 != "Não possui"){
    echo "<img src='uploads/$imgper73' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp73 == 0) {
echo "<label>A) ".$letraaper73['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper73['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper73['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper73['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper73['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap73 = $letraaper73['alternativa'];
$imgletbp73 = $letrabper73['alternativa'];
$imgletcp73 = $letracper73['alternativa'];
$imgletdp73 = $letradper73['alternativa'];
$imgletep73 = $letraeper73['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap73' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp73' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp73' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp73' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep73' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 74
echo "<b>Questão 74:</b>";
echo "<br><br>";
echo $per74['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper74 != "Não possui"){
    echo "<img src='uploads/$imgper74' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp74 == 0) {
echo "<label>A) ".$letraaper74['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper74['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper74['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper74['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper74['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap74 = $letraaper74['alternativa'];
$imgletbp74 = $letrabper74['alternativa'];
$imgletcp74 = $letracper74['alternativa'];
$imgletdp74 = $letradper74['alternativa'];
$imgletep74 = $letraeper74['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap74' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp74' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp74' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp74' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep74' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 75
echo "<b>Questão 75:</b>";
echo "<br><br>";
echo $per75['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper75 != "Não possui"){
    echo "<img src='uploads/$imgper75' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp75 == 0) {
echo "<label>A) ".$letraaper75['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper75['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper75['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper75['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper75['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap75 = $letraaper75['alternativa'];
$imgletbp75 = $letrabper75['alternativa'];
$imgletcp75 = $letracper75['alternativa'];
$imgletdp75 = $letradper75['alternativa'];
$imgletep75 = $letraeper75['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap75' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp75' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp75' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp75' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep75' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 76 à 80 e suas caracteristicas -->
<?php
if ($qtperguntas>75){

// Verificando caracteristicas 76
echo "<b>Questão 76:</b>";
echo "<br><br>";
echo $per76['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper76 != "Não possui"){
    echo "<img src='uploads/$imgper76' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp76 == 0) {
echo "<label>A) ".$letraaper76['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper76['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper76['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper76['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper76['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap76 = $letraaper76['alternativa'];
$imgletbp76 = $letrabper76['alternativa'];
$imgletcp76 = $letracper76['alternativa'];
$imgletdp76 = $letradper76['alternativa'];
$imgletep76 = $letraeper76['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap76' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp76' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp76' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp76' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep76' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 77
echo "<b>Questão 77:</b>";
echo "<br><br>";
echo $per77['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper77 != "Não possui"){
    echo "<img src='uploads/$imgper77' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp77 == 0) {
echo "<label>A) ".$letraaper77['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper77['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper77['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper77['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper77['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap77 = $letraaper77['alternativa'];
$imgletbp77 = $letrabper77['alternativa'];
$imgletcp77 = $letracper77['alternativa'];
$imgletdp77 = $letradper77['alternativa'];
$imgletep77 = $letraeper77['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap77' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp77' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp77' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp77' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep77' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 78
echo "<b>Questão 78:</b>";
echo "<br><br>";
echo $per78['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper78 != "Não possui"){
    echo "<img src='uploads/$imgper78' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp78 == 0) {
echo "<label>A) ".$letraaper78['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper78['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper78['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper78['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper78['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap78 = $letraaper78['alternativa'];
$imgletbp78 = $letrabper78['alternativa'];
$imgletcp78 = $letracper78['alternativa'];
$imgletdp78 = $letradper78['alternativa'];
$imgletep78 = $letraeper78['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap78' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp78' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp78' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp78' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep78' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 79
echo "<b>Questão 79:</b>";
echo "<br><br>";
echo $per79['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper79 != "Não possui"){
    echo "<img src='uploads/$imgper79' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp79 == 0) {
echo "<label>A) ".$letraaper79['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper79['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper79['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper79['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper79['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap79 = $letraaper79['alternativa'];
$imgletbp79 = $letrabper79['alternativa'];
$imgletcp79 = $letracper79['alternativa'];
$imgletdp79 = $letradper79['alternativa'];
$imgletep79 = $letraeper79['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap79' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp79' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp79' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp79' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep79' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 80
echo "<b>Questão 80:</b>";
echo "<br><br>";
echo $per80['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper80 != "Não possui"){
    echo "<img src='uploads/$imgper80' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp80 == 0) {
echo "<label>A) ".$letraaper80['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper80['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper80['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper80['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper80['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap80 = $letraaper80['alternativa'];
$imgletbp80 = $letrabper80['alternativa'];
$imgletcp80 = $letracper80['alternativa'];
$imgletdp80 = $letradper80['alternativa'];
$imgletep80 = $letraeper80['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap80' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp80' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp80' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp80' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep80' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 81 à 85 e suas caracteristicas -->
<?php
if ($qtperguntas>80){

// Verificando caracteristicas 81
echo "<b>Questão 81:</b>";
echo "<br><br>";
echo $per81['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper81 != "Não possui"){
    echo "<img src='uploads/$imgper81' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp81 == 0) {
echo "<label>A) ".$letraaper81['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper81['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper81['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper81['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper81['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap81 = $letraaper81['alternativa'];
$imgletbp81 = $letrabper81['alternativa'];
$imgletcp81 = $letracper81['alternativa'];
$imgletdp81 = $letradper81['alternativa'];
$imgletep81 = $letraeper81['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap81' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp81' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp81' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp81' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep81' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 82
echo "<b>Questão 82:</b>";
echo "<br><br>";
echo $per82['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper82 != "Não possui"){
    echo "<img src='uploads/$imgper82' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp82 == 0) {
echo "<label>A) ".$letraaper82['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper82['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper82['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper82['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper82['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap82 = $letraaper82['alternativa'];
$imgletbp82 = $letrabper82['alternativa'];
$imgletcp82 = $letracper82['alternativa'];
$imgletdp82 = $letradper82['alternativa'];
$imgletep82 = $letraeper82['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap82' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp82' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp82' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp82' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep82' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 83
echo "<b>Questão 83:</b>";
echo "<br><br>";
echo $per83['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper83 != "Não possui"){
    echo "<img src='uploads/$imgper83' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp83 == 0) {
echo "<label>A) ".$letraaper83['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper83['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper83['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper83['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper83['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap83 = $letraaper83['alternativa'];
$imgletbp83 = $letrabper83['alternativa'];
$imgletcp83 = $letracper83['alternativa'];
$imgletdp83 = $letradper83['alternativa'];
$imgletep83 = $letraeper83['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap83' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp83' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp83' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp83' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep83' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 84
echo "<b>Questão 84:</b>";
echo "<br><br>";
echo $per84['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper84 != "Não possui"){
    echo "<img src='uploads/$imgper84' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp84 == 0) {
echo "<label>A) ".$letraaper84['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper84['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper84['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper84['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper84['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap84 = $letraaper84['alternativa'];
$imgletbp84 = $letrabper84['alternativa'];
$imgletcp84 = $letracper84['alternativa'];
$imgletdp84 = $letradper84['alternativa'];
$imgletep84 = $letraeper84['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap84' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp84' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp84' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp84' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep84' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 85
echo "<b>Questão 85:</b>";
echo "<br><br>";
echo $per85['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper85 != "Não possui"){
    echo "<img src='uploads/$imgper85' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp85 == 0) {
echo "<label>A) ".$letraaper85['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper85['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper85['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper85['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper85['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap85 = $letraaper85['alternativa'];
$imgletbp85 = $letrabper85['alternativa'];
$imgletcp85 = $letracper85['alternativa'];
$imgletdp85 = $letradper85['alternativa'];
$imgletep85 = $letraeper85['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap85' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp85' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp85' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp85' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep85' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

<!-- Verificando se à questões de 86 à 90 e suas caracteristicas -->
<?php
if ($qtperguntas>85){

// Verificando caracteristicas 86
echo "<b>Questão 86:</b>";
echo "<br><br>";
echo $per86['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper86 != "Não possui"){
    echo "<img src='uploads/$imgper86' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp86 == 0) {
echo "<label>A) ".$letraaper86['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper86['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper86['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper86['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper86['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap86 = $letraaper86['alternativa'];
$imgletbp86 = $letrabper86['alternativa'];
$imgletcp86 = $letracper86['alternativa'];
$imgletdp86 = $letradper86['alternativa'];
$imgletep86 = $letraeper86['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap86' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp86' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp86' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp86' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep86' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 87
echo "<b>Questão 87:</b>";
echo "<br><br>";
echo $per87['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper87 != "Não possui"){
    echo "<img src='uploads/$imgper87' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp87 == 0) {
echo "<label>A) ".$letraaper87['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper87['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper87['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper87['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper87['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap87 = $letraaper87['alternativa'];
$imgletbp87 = $letrabper87['alternativa'];
$imgletcp87 = $letracper87['alternativa'];
$imgletdp87 = $letradper87['alternativa'];
$imgletep87 = $letraeper87['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap87' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp87' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp87' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp87' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep87' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 88
echo "<b>Questão 88:</b>";
echo "<br><br>";
echo $per88['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper88 != "Não possui"){
    echo "<img src='uploads/$imgper88' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp88 == 0) {
echo "<label>A) ".$letraaper88['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper88['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper88['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper88['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper88['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap88 = $letraaper88['alternativa'];
$imgletbp88 = $letrabper88['alternativa'];
$imgletcp88 = $letracper88['alternativa'];
$imgletdp88 = $letradper88['alternativa'];
$imgletep88 = $letraeper88['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap88' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp88' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp88' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp88' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep88' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 89
echo "<b>Questão 89:</b>";
echo "<br><br>";
echo $per89['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper89 != "Não possui"){
    echo "<img src='uploads/$imgper89' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp89 == 0) {
echo "<label>A) ".$letraaper89['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper89['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper89['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper89['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper89['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap89 = $letraaper89['alternativa'];
$imgletbp89 = $letrabper89['alternativa'];
$imgletcp89 = $letracper89['alternativa'];
$imgletdp89 = $letradper89['alternativa'];
$imgletep89 = $letraeper89['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap89' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp89' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp89' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp89' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep89' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}

// Verificando caracteristicas 90
echo "<b>Questão 90:</b>";
echo "<br><br>";
echo $per90['pergunta'];
echo "<br><br><br>";

// Se possui imagem
if ($imgper90 != "Não possui"){
    echo "<img src='uploads/$imgper90' width='500'>";
    echo "<br><br><br>";
}
else{

}

// Tipo da resposta
if ($tipoimgp90 == 0) {
echo "<label>A) ".$letraaper90['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>B) ".$letrabper90['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>C) ".$letracper90['alternativa'];
echo "</label>";
echo "<br><br>";echo "<label>D) ".$letradper90['alternativa']; 
echo "</label>";
echo "<br><br>";echo "<label>E) ".$letraeper90['alternativa']; 
echo "</label>";
echo "<br><br><br>";
}
else{
$imgletap90 = $letraaper90['alternativa'];
$imgletbp90 = $letrabper90['alternativa'];
$imgletcp90 = $letracper90['alternativa'];
$imgletdp90 = $letradper90['alternativa'];
$imgletep90 = $letraeper90['alternativa'];

echo "<label>A) <br> <img src='img_res/$imgletap90' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>B) <br> <img src='img_res/$imgletbp90' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>C) <br> <img src='img_res/$imgletcp90' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>D) <br> <img src='img_res/$imgletdp90' width='300'>"; 
echo "</label>";
echo "<br><br>";echo "<label>E) <br> <img src='img_res/$imgletep90' width='300'>"; 
echo "</label>";
echo "<br><br><br>";
}
}
?>

</div>

<!-- Fechando tags abertas -->
</font>
</body>
</html>