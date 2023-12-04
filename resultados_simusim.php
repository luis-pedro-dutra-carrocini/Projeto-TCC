<!-- Iniciando PHP --->

<?php



// Inicinado sessão

session_start();



// Verificando se a quantidade de perguntas existe

if (isset($_SESSION['qtperguntas'])){



// Verificando a quantidade de perguntas

$qtperguntas = $_SESSION['qtperguntas'];

}else{



  // Redirecionando para a pagina index, pois a quantidade de perguntas não existe

  header('location: index.php');

  exit;

}



// Guardando o dia em uma variavel

date_default_timezone_set('America/Sao_Paulo');

$hoje = date('Y/m/d');



// Obtendo a hora do final do simulado

date_default_timezone_set('America/Sao_Paulo');

$hora_final = date('H:i:s');



// Verificando se a hora inicial existe existe

if (isset($_SESSION['hora_inicio'])){



  // Obtendo a hora inicial

  $hora_inicio = $_SESSION['hora_inicio'];

  }else{

  

    // Redirecionando para a pagina index, pois não existe a hora inicial

    header('location: index.php');

    exit;

  }



//Ajustando o formato da hora inicial e final

$unix_data1 = strtotime($hora_inicio);

$unix_data2 = strtotime($hora_final);



// Calculando o tempo do simulado

// Horas

$nHoras   = ($unix_data2 - $unix_data1) / 3600;



// Minutos

$nMinutos = (($unix_data2 - $unix_data1) % 3600) / 60;



// Segundos

$nSegundos = (($unix_data2 - $unix_data1) % 3600);



// Calculando os segundos

$segundos   = ($unix_data2 - $unix_data1);



// Calculando a média por pergunta

$media_por_pergunta =  ($segundos / 60) / $qtperguntas;



// Definindo cores para as respostas



// Correta

$corcorr = "Green";



// Errada

$corerr = "FireBrick";



// Criando variavel para guardar a quantidade de perguntas corretas

$contrescorr = 0;



// Obtendo codigo das questões e seus dados

include_once('conexao.php');



//Questão 1

$codper1 = $_SESSION['codper1'];

$select_per1 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper1");

$per1 = mysqli_fetch_assoc($select_per1);



$select_letraaper1 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper1 and letra = 'a'");

$letraaper1 = mysqli_fetch_assoc($select_letraaper1);

$select_letrabper1 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper1 and letra = 'b'");

$letrabper1 = mysqli_fetch_assoc($select_letrabper1);

$select_letracper1 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper1 and letra = 'c'");

$letracper1 = mysqli_fetch_assoc($select_letracper1);

$select_letradper1 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper1 and letra = 'd'");

$letradper1 = mysqli_fetch_assoc($select_letradper1);

$select_letraeper1 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper1 and letra = 'e'");

$letraeper1 = mysqli_fetch_assoc($select_letraeper1);



// Selecionando alternativa correta 1 suas cores

// Correta

if ($letraaper1["correta"]==1){

  $alt_corr1 = "Letra A";

  $cora1 = $corcorr;
  $sima1 = " ✓";

  $corb1 = "black";
  $simb1 = "";

  $corc1 = "black";
  $simc1 = "";

  $cord1 = "black";
  $simd1 = "";

  $core1 = "black";
  $sime1 = "";

}

elseif ($letrabper1["correta"]==1){

  $alt_corr1 = "Letra B";

  $corb1 = $corcorr;
  $simb1 = " ✓";

  $cora1 = "black";
  $sima1 = "";

  $corc1 = "black";
  $simc1 = "";

  $cord1 = "black";
  $simd1 = "";

  $core1 = "black";
  $sime1 = "";

}

elseif ($letracper1["correta"]==1){

  $alt_corr1 = "Letra C";

  $corc1 = $corcorr;
  $simc1 = " ✓";

  $cora1 = "black";
  $sima1 = "";

  $corb1 = "black";
  $simb1 = "";

  $cord1 = "black";
  $simd1 = "";

  $core1 = "black";
  $sime1 = "";

}

elseif ($letradper1["correta"]==1){

  $alt_corr1 = "Letra D";

  $cord1 = $corcorr;
  $simd1 = " ✓";

  $cora1 = "black";
  $sima1 = "";

  $corc1 = "black";
  $simc1 = "";

  $corb1 = "black";
  $simb1 = "";

  $core1 = "black";
  $sime1 = "";

}

elseif ($letraeper1["correta"]==1){

  $alt_corr1 = "Letra E";

  $core1 = $corcorr;
  $sime1 = " ✓";

  $cora1 = "black";
  $sima1 = "";

  $corc1 = "black";
  $simc1 = "";

  $cord1 = "black";
  $simd1 = "";

  $corb1 = "black";
  $simb1 = "";

}



//Errada

if ($alt_corr1 != $_POST['radper1'] && $_POST['radper1'] == "Letra A"){

  $cora1 = $corerr;
  $sima1 = " X";

}

elseif ($alt_corr1 != $_POST['radper1'] && $_POST['radper1'] == "Letra B"){

  $corb1 = $corerr;
  $simb1 = " X";

}

elseif ($alt_corr1 != $_POST['radper1'] && $_POST['radper1'] == "Letra C"){

  $corc1 = $corerr;
  $simc1 = " X";

}

elseif ($alt_corr1 != $_POST['radper1'] && $_POST['radper1'] == "Letra D"){

  $cord1 = $corerr;
  $simd1 = " X";

}

elseif ($alt_corr1 != $_POST['radper1'] && $_POST['radper1'] == "Letra E"){

  $core1 = $corerr;
  $sime1 = " X";

}



// Verficando qual será checado 1

if ($_POST['radper1'] == "Letra A"){

  $chea1 = "Checked";

  $cheb1 = "";

  $chec1 = "";

  $ched1 = "";

  $chee1 = "";

}elseif ($_POST['radper1'] == "Letra B"){

  $chea1 = "";

  $cheb1 = "Checked";

  $chec1 = "";

  $ched1 = "";

  $chee1 = "";

}elseif ($_POST['radper1'] == "Letra C"){

  $chea1 = "";

  $cheb1 = "";

  $chec1 = "Checked";

  $ched1 = "";

  $chee1 = "";

}elseif ($_POST['radper1'] == "Letra D"){

  $chea1 = "";

  $cheb1 = "";

  $chec1 = "";

  $ched1 = "Checked";

  $chee1 = "";

}elseif ($_POST['radper1'] == "Letra E"){

  $chea1 = "";

  $cheb1 = "";

  $chec1 = "";

  $ched1 = "";

  $chee1 = "Checked";

}



// Verificando se respsota esta correta 1

if ($_POST['radper1'] == $alt_corr1){

  $contrescorr = $contrescorr + 1;

  $cer_err1 = 1;

}

else{

  $cer_err1 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 1

if ($_POST['radper1'] == "Letra A"){

  $codigo_resposta1 = $letraaper1['codigo_resposta'];

}elseif ($_POST['radper1'] == "Letra B"){

  $codigo_resposta1 = $letrabper1['codigo_resposta'];

}elseif ($_POST['radper1'] == "Letra C"){

  $codigo_resposta1 = $letracper1['codigo_resposta'];

}elseif ($_POST['radper1'] == "Letra D"){

  $codigo_resposta1 = $letradper1['codigo_resposta'];

}elseif ($_POST['radper1'] == "Letra E"){

  $codigo_resposta1 = $letraeper1['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 1

$codigo_disciplina1 = $per1['codigo_disciplina'];



// Selecionando imagem 1

$imgper1 = $per1['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp1 = $letraaper1['tipo'];





//Questão 2

$codper2 = $_SESSION['codper2'];

$select_per2 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper2");

$per2 = mysqli_fetch_assoc($select_per2);



$select_letraaper2 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper2 and letra = 'a'");

$letraaper2 = mysqli_fetch_assoc($select_letraaper2);

$select_letrabper2 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper2 and letra = 'b'");

$letrabper2 = mysqli_fetch_assoc($select_letrabper2);

$select_letracper2 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper2 and letra = 'c'");

$letracper2 = mysqli_fetch_assoc($select_letracper2);

$select_letradper2 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper2 and letra = 'd'");

$letradper2 = mysqli_fetch_assoc($select_letradper2);

$select_letraeper2 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper2 and letra = 'e'");

$letraeper2 = mysqli_fetch_assoc($select_letraeper2);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper2["correta"]==1){

  $alt_corr2 = "Letra A";

  $cora2 = $corcorr;
  $sima2 = " ✓";

  $corb2 = "black";
  $simb2 = "";

  $corc2 = "black";
  $simc2 = "";

  $cord2 = "black";
  $simd2 = "";

  $core2 = "black";
  $sime2 = "";

}

elseif ($letrabper2["correta"]==1){

  $alt_corr2 = "Letra B";

  $corb2 = $corcorr;
  $simb2 = " ✓";

  $cora2 = "black";
  $sima2 = "";

  $corc2 = "black";
  $simc2 = "";

  $cord2 = "black";
  $simd2 = "";

  $core2 = "black";
  $sime2 = "";

}

elseif ($letracper2["correta"]==1){

  $alt_corr2 = "Letra C";

  $corc2 = $corcorr;
  $simc2 = " ✓";

  $cora2 = "black";
  $sima2 = "";

  $corb2 = "black";
  $simb2 = "";

  $cord2 = "black";
  $simd2 = "";

  $core2 = "black";
  $sime2 = "";

}

elseif ($letradper2["correta"]==1){

  $alt_corr2 = "Letra D";

  $cord2 = $corcorr;
  $simd2 = " ✓";

  $cora2 = "black";
  $sima2 = "";

  $corc2 = "black";
  $simc2 = "";

  $corb2 = "black";
  $simb2 = "";

  $core2 = "black";
  $sime2 = "";

}

elseif ($letraeper2["correta"]==1){

  $alt_corr2 = "Letra E";

  $core2 = $corcorr;
  $sime2 = " ✓";

  $cora2 = "black";
  $sima2 = "";

  $corc2 = "black";
  $simc2 = "";

  $cord2 = "black";
  $simd2 = "";

  $corb2 = "black";
  $simb2 = "";

}

//Errada

if ($alt_corr2 != $_POST['radper2'] && $_POST['radper2'] == "Letra A"){

  $cora2 = $corerr;
  $sima2 = " X";

}

elseif ($alt_corr2 != $_POST['radper2'] && $_POST['radper2'] == "Letra B"){

  $corb2 = $corerr;
  $simb2 = " X";

}

elseif ($alt_corr2 != $_POST['radper2'] && $_POST['radper2'] == "Letra C"){

  $corc2 = $corerr;
  $simc2 = " X";

}

elseif ($alt_corr2 != $_POST['radper2'] && $_POST['radper2'] == "Letra D"){

  $cord2 = $corerr;
  $simd2 = " X";

}

elseif ($alt_corr2 != $_POST['radper2'] && $_POST['radper2'] == "Letra E"){

  $core2 = $corerr;
  $sime2 = " X";

}



// Verficando qual será checado 2

if ($_POST['radper2'] == "Letra A"){

  $chea2 = "Checked";

  $cheb2 = "";

  $chec2 = "";

  $ched2 = "";

  $chee2 = "";

}elseif ($_POST['radper2'] == "Letra B"){

  $chea2 = "";

  $cheb2 = "Checked";

  $chec2 = "";

  $ched2 = "";

  $chee2 = "";

}elseif ($_POST['radper2'] == "Letra C"){

  $chea2 = "";

  $cheb2 = "";

  $chec2 = "Checked";

  $ched2 = "";

  $chee2 = "";

}elseif ($_POST['radper2'] == "Letra D"){

  $chea2 = "";

  $cheb2 = "";

  $chec2 = "";

  $ched2 = "Checked";

  $chee2 = "";

}elseif ($_POST['radper2'] == "Letra E"){

  $chea2 = "";

  $cheb2 = "";

  $chec2 = "";

  $ched2 = "";

  $chee2 = "Checked";

}



// Verificando se respsota esta correta 2

if ($_POST['radper2'] == $alt_corr2){

  $contrescorr = $contrescorr + 1;

  $cer_err2 = 1;

}

else{

  $cer_err2 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 2

if ($_POST['radper2'] == "Letra A"){

  $codigo_resposta2 = $letraaper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra B"){

  $codigo_resposta2 = $letrabper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra C"){

  $codigo_resposta2 = $letracper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra D"){

  $codigo_resposta2 = $letradper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra E"){

  $codigo_resposta2 = $letraeper2['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 2

$codigo_disciplina2 = $per2['codigo_disciplina'];



// Selecionando imagem 2

$imgper2 = $per2['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp2 = $letraaper2['tipo'];





//Questão 3

$codper3 = $_SESSION['codper3'];

$select_per3 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper3");

$per3 = mysqli_fetch_assoc($select_per3);



$select_letraaper3 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper3 and letra = 'a'");

$letraaper3 = mysqli_fetch_assoc($select_letraaper3);

$select_letrabper3 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper3 and letra = 'b'");

$letrabper3 = mysqli_fetch_assoc($select_letrabper3);

$select_letracper3 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper3 and letra = 'c'");

$letracper3 = mysqli_fetch_assoc($select_letracper3);

$select_letradper3 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper3 and letra = 'd'");

$letradper3 = mysqli_fetch_assoc($select_letradper3);

$select_letraeper3 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper3 and letra = 'e'");

$letraeper3 = mysqli_fetch_assoc($select_letraeper3);



// Selecionando alternativa correta 3 suas cores

// Correta

if ($letraaper3["correta"]==1){

  $alt_corr3 = "Letra A";

  $cora3 = $corcorr;
  $sima3 = " ✓";

  $corb3 = "black";
  $simb3 = "";

  $corc3 = "black";
  $simc3 = "";

  $cord3 = "black";
  $simd3 = "";

  $core3 = "black";
  $sime3 = "";

}

elseif ($letrabper3["correta"]==1){

  $alt_corr3 = "Letra B";

  $corb3 = $corcorr;
  $simb3 = " ✓";

  $cora3 = "black";
  $sima3 = "";

  $corc3 = "black";
  $simc3 = "";

  $cord3 = "black";
  $simd3 = "";

  $core3 = "black";
  $sime3 = "";

}

elseif ($letracper3["correta"]==1){

  $alt_corr3 = "Letra C";

  $corc3 = $corcorr;
  $simc3 = " ✓";

  $cora3 = "black";
  $sima3 = "";

  $corb3 = "black";
  $simb3 = "";

  $cord3 = "black";
  $simd3 = "";

  $core3 = "black";
  $sime3 = "";

}

elseif ($letradper3["correta"]==1){

  $alt_corr3 = "Letra D";

  $cord3 = $corcorr;
  $simd3 = " ✓";

  $cora3 = "black";
  $sima3 = "";

  $corc3 = "black";
  $simc3 = "";

  $corb3 = "black";
  $simb3 = "";

  $core3 = "black";
  $sime3 = "";

}

elseif ($letraeper3["correta"]==1){

  $alt_corr3 = "Letra E";

  $core3 = $corcorr;
  $sime3 = " ✓";

  $cora3 = "black";
  $sima3 = "";

  $corc3 = "black";
  $simc3 = "";

  $cord3 = "black";
  $simd3 = "";

  $corb3 = "black";
  $simb3 = "";

}

//Errada

if ($alt_corr3 != $_POST['radper3'] && $_POST['radper3'] == "Letra A"){

  $cora3 = $corerr;
  $sima3 = " X";

}

elseif ($alt_corr3 != $_POST['radper3'] && $_POST['radper3'] == "Letra B"){

  $corb3 = $corerr;
  $simb3 = " X";

}

elseif ($alt_corr3 != $_POST['radper3'] && $_POST['radper3'] == "Letra C"){

  $corc3 = $corerr;
  $simc3 = " X";

}

elseif ($alt_corr3 != $_POST['radper3'] && $_POST['radper3'] == "Letra D"){

  $cord3 = $corerr;
  $simd3 = " X";

}

elseif ($alt_corr3 != $_POST['radper3'] && $_POST['radper3'] == "Letra E"){

  $core3 = $corerr;
  $sime3 = " X";

}


// Verficando qual será checado 3

if ($_POST['radper3'] == "Letra A"){

  $chea3 = "Checked";

  $cheb3 = "";

  $chec3 = "";

  $ched3 = "";

  $chee3 = "";

}elseif ($_POST['radper3'] == "Letra B"){

  $chea3 = "";

  $cheb3 = "Checked";

  $chec3 = "";

  $ched3 = "";

  $chee3 = "";

}elseif ($_POST['radper3'] == "Letra C"){

  $chea3 = "";

  $cheb3 = "";

  $chec3 = "Checked";

  $ched3 = "";

  $chee3 = "";

}elseif ($_POST['radper3'] == "Letra D"){

  $chea3 = "";

  $cheb3 = "";

  $chec3 = "";

  $ched3 = "Checked";

  $chee3 = "";

}elseif ($_POST['radper3'] == "Letra E"){

  $chea3 = "";

  $cheb3 = "";

  $chec3 = "";

  $ched3 = "";

  $chee3 = "Checked";

}



// Verificando se respsota esta correta 3

if ($_POST['radper3'] == $alt_corr3){

  $contrescorr = $contrescorr + 1;

  $cer_err3 = 1;

}

else{

  $cer_err3 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 3

if ($_POST['radper3'] == "Letra A"){

  $codigo_resposta3 = $letraaper3['codigo_resposta'];

}elseif ($_POST['radper3'] == "Letra B"){

  $codigo_resposta3 = $letrabper3['codigo_resposta'];

}elseif ($_POST['radper3'] == "Letra C"){

  $codigo_resposta3 = $letracper3['codigo_resposta'];

}elseif ($_POST['radper3'] == "Letra D"){

  $codigo_resposta3 = $letradper3['codigo_resposta'];

}elseif ($_POST['radper3'] == "Letra E"){

  $codigo_resposta3 = $letraeper3['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 3

$codigo_disciplina3 = $per3['codigo_disciplina'];



// Selecionando imagem 3

$imgper3 = $per3['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp3 = $letraaper3['tipo'];





//Questão 4

$codper4 = $_SESSION['codper4'];

$select_per4 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper4");

$per4 = mysqli_fetch_assoc($select_per4);



$select_letraaper4 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper4 and letra = 'a'");

$letraaper4 = mysqli_fetch_assoc($select_letraaper4);

$select_letrabper4 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper4 and letra = 'b'");

$letrabper4 = mysqli_fetch_assoc($select_letrabper4);

$select_letracper4 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper4 and letra = 'c'");

$letracper4 = mysqli_fetch_assoc($select_letracper4);

$select_letradper4 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper4 and letra = 'd'");

$letradper4 = mysqli_fetch_assoc($select_letradper4);

$select_letraeper4 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper4 and letra = 'e'");

$letraeper4 = mysqli_fetch_assoc($select_letraeper4);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper4["correta"]==1){

  $alt_corr4 = "Letra A";

  $cora4 = $corcorr;
  $sima4 = " ✓";

  $corb4 = "black";
  $simb4 = "";

  $corc4 = "black";
  $simc4 = "";

  $cord4 = "black";
  $simd4 = "";

  $core4 = "black";
  $sime4 = "";

}

elseif ($letrabper4["correta"]==1){

  $alt_corr4 = "Letra B";

  $corb4 = $corcorr;
  $simb4 = " ✓";

  $cora4 = "black";
  $sima4 = "";

  $corc4 = "black";
  $simc4 = "";

  $cord4 = "black";
  $simd4 = "";

  $core4 = "black";
  $sime4 = "";

}

elseif ($letracper4["correta"]==1){

  $alt_corr4 = "Letra C";

  $corc4 = $corcorr;
  $simc4 = " ✓";

  $cora4 = "black";
  $sima4 = "";

  $corb4 = "black";
  $simb4 = "";

  $cord4 = "black";
  $simd4 = "";

  $core4 = "black";
  $sime4 = "";

}

elseif ($letradper4["correta"]==1){

  $alt_corr4 = "Letra D";

  $cord4 = $corcorr;
  $simd4 = " ✓";

  $cora4 = "black";
  $sima4 = "";

  $corc4 = "black";
  $simc4 = "";

  $corb4 = "black";
  $simb4 = "";

  $core4 = "black";
  $sime4 = "";

}

elseif ($letraeper4["correta"]==1){

  $alt_corr4 = "Letra E";

  $core4 = $corcorr;
  $sime4 = " ✓";

  $cora4 = "black";
  $sima4 = "";

  $corc4 = "black";
  $simc4 = "";

  $cord4 = "black";
  $simd4 = "";

  $corb4 = "black";
  $simb4 = "";

}

//Errada

if ($alt_corr4 != $_POST['radper4'] && $_POST['radper4'] == "Letra A"){

  $cora4 = $corerr;
  $sima4 = " X";

}

elseif ($alt_corr4 != $_POST['radper4'] && $_POST['radper4'] == "Letra B"){

  $corb4 = $corerr;
  $simb4 = " X";

}

elseif ($alt_corr4 != $_POST['radper4'] && $_POST['radper4'] == "Letra C"){

  $corc4 = $corerr;
  $simc4 = " X";

}

elseif ($alt_corr4 != $_POST['radper4'] && $_POST['radper4'] == "Letra D"){

  $cord4 = $corerr;
  $simd4 = " X";

}

elseif ($alt_corr4 != $_POST['radper4'] && $_POST['radper4'] == "Letra E"){

  $core4 = $corerr;
  $sime4 = " X";

}



// Verficando qual será checado 4

if ($_POST['radper4'] == "Letra A"){

  $chea4 = "Checked";

  $cheb4 = "";

  $chec4 = "";

  $ched4 = "";

  $chee4 = "";

}elseif ($_POST['radper4'] == "Letra B"){

  $chea4 = "";

  $cheb4 = "Checked";

  $chec4 = "";

  $ched4 = "";

  $chee4 = "";

}elseif ($_POST['radper4'] == "Letra C"){

  $chea4 = "";

  $cheb4 = "";

  $chec4 = "Checked";

  $ched4 = "";

  $chee4 = "";

}elseif ($_POST['radper4'] == "Letra D"){

  $chea4 = "";

  $cheb4 = "";

  $chec4 = "";

  $ched4 = "Checked";

  $chee4 = "";

}elseif ($_POST['radper4'] == "Letra E"){

  $chea4 = "";

  $cheb4 = "";

  $chec4 = "";

  $ched4 = "";

  $chee4 = "Checked";

}



// Verificando se respsota esta correta 4

if ($_POST['radper4'] == $alt_corr4){

  $contrescorr = $contrescorr + 1;

  $cer_err4 = 1;

}

else{

  $cer_err4 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 4

if ($_POST['radper4'] == "Letra A"){

  $codigo_resposta4 = $letraaper4['codigo_resposta'];

}elseif ($_POST['radper4'] == "Letra B"){

  $codigo_resposta4 = $letrabper4['codigo_resposta'];

}elseif ($_POST['radper4'] == "Letra C"){

  $codigo_resposta4 = $letracper4['codigo_resposta'];

}elseif ($_POST['radper4'] == "Letra D"){

  $codigo_resposta4 = $letradper4['codigo_resposta'];

}elseif ($_POST['radper4'] == "Letra E"){

  $codigo_resposta4 = $letraeper4['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 4

$codigo_disciplina4 = $per4['codigo_disciplina'];



// Selecionando imagem 4

$imgper4 = $per4['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp4 = $letraaper4['tipo'];





//Questão 5

$codper5 = $_SESSION['codper5'];

$select_per5 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper5");

$per5 = mysqli_fetch_assoc($select_per5);



$select_letraaper5 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper5 and letra = 'a'");

$letraaper5 = mysqli_fetch_assoc($select_letraaper5);

$select_letrabper5 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper5 and letra = 'b'");

$letrabper5 = mysqli_fetch_assoc($select_letrabper5);

$select_letracper5 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper5 and letra = 'c'");

$letracper5 = mysqli_fetch_assoc($select_letracper5);

$select_letradper5 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper5 and letra = 'd'");

$letradper5 = mysqli_fetch_assoc($select_letradper5);

$select_letraeper5 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper5 and letra = 'e'");

$letraeper5 = mysqli_fetch_assoc($select_letraeper5);



// Selecionando alternativa correta 5 suas cores

// Correta

if ($letraaper5["correta"]==1){

  $alt_corr5 = "Letra A";

  $cora5 = $corcorr;
  $sima5 = " ✓";

  $corb5 = "black";
  $simb5 = "";

  $corc5 = "black";
  $simc5 = "";

  $cord5 = "black";
  $simd5 = "";

  $core5 = "black";
  $sime5 = "";

}

elseif ($letrabper5["correta"]==1){

  $alt_corr5 = "Letra B";

  $corb5 = $corcorr;
  $simb5 = " ✓";

  $cora5 = "black";
  $sima5 = "";

  $corc5 = "black";
  $simc5 = "";

  $cord5 = "black";
  $simd5 = "";

  $core5 = "black";
  $sime5 = "";

}

elseif ($letracper5["correta"]==1){

  $alt_corr5 = "Letra C";

  $corc5 = $corcorr;
  $simc5 = " ✓";

  $cora5 = "black";
  $sima5 = "";

  $corb5 = "black";
  $simb5 = "";

  $cord5 = "black";
  $simd5 = "";

  $core5 = "black";
  $sime5 = "";

}

elseif ($letradper5["correta"]==1){

  $alt_corr5 = "Letra D";

  $cord5 = $corcorr;
  $simd5 = " ✓";

  $cora5 = "black";
  $sima5 = "";

  $corc5 = "black";
  $simc5 = "";

  $corb5 = "black";
  $simb5 = "";

  $core5 = "black";
  $sime5 = "";

}

elseif ($letraeper5["correta"]==1){

  $alt_corr5 = "Letra E";

  $core5 = $corcorr;
  $sime5 = " ✓";

  $cora5 = "black";
  $sima5 = "";

  $corc5 = "black";
  $simc5 = "";

  $cord5 = "black";
  $simd5 = "";

  $corb5 = "black";
  $simb5 = "";

}

//Errada

if ($alt_corr5 != $_POST['radper5'] && $_POST['radper5'] == "Letra A"){

  $cora5 = $corerr;
  $sima5 = " X";

}

elseif ($alt_corr5 != $_POST['radper5'] && $_POST['radper5'] == "Letra B"){

  $corb5 = $corerr;
  $simb5 = " X";

}

elseif ($alt_corr5 != $_POST['radper5'] && $_POST['radper5'] == "Letra C"){

  $corc5 = $corerr;
  $simc5 = " X";

}

elseif ($alt_corr5 != $_POST['radper5'] && $_POST['radper5'] == "Letra D"){

  $cord5 = $corerr;
  $simd5 = " X";

}

elseif ($alt_corr5 != $_POST['radper5'] && $_POST['radper5'] == "Letra E"){

  $core5 = $corerr;
  $sime5 = " X";

}



// Verficando qual será checado 5

if ($_POST['radper5'] == "Letra A"){

  $chea5 = "Checked";

  $cheb5 = "";

  $chec5 = "";

  $ched5 = "";

  $chee5 = "";

}elseif ($_POST['radper5'] == "Letra B"){

  $chea5 = "";

  $cheb5 = "Checked";

  $chec5 = "";

  $ched5 = "";

  $chee5 = "";

}elseif ($_POST['radper5'] == "Letra C"){

  $chea5 = "";

  $cheb5 = "";

  $chec5 = "Checked";

  $ched5 = "";

  $chee5 = "";

}elseif ($_POST['radper5'] == "Letra D"){

  $chea5 = "";

  $cheb5 = "";

  $chec5 = "";

  $ched5 = "Checked";

  $chee5 = "";

}elseif ($_POST['radper5'] == "Letra E"){

  $chea5 = "";

  $cheb5 = "";

  $chec5 = "";

  $ched5 = "";

  $chee5 = "Checked";

}



// Verificando se respsota esta correta 5

if ($_POST['radper5'] == $alt_corr5){

  $contrescorr = $contrescorr + 1;

  $cer_err5 = 1;

}

else{

  $cer_err5 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 5

if ($_POST['radper5'] == "Letra A"){

  $codigo_resposta5 = $letraaper5['codigo_resposta'];

}elseif ($_POST['radper5'] == "Letra B"){

  $codigo_resposta5 = $letrabper5['codigo_resposta'];

}elseif ($_POST['radper5'] == "Letra C"){

  $codigo_resposta5 = $letracper5['codigo_resposta'];

}elseif ($_POST['radper5'] == "Letra D"){

  $codigo_resposta5 = $letradper5['codigo_resposta'];

}elseif ($_POST['radper5'] == "Letra E"){

  $codigo_resposta5 = $letraeper5['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 5

$codigo_disciplina5 = $per5['codigo_disciplina'];



// Selecionando imagem 5

$imgper5 = $per5['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp5 = $letraaper5['tipo'];





// Verificando se existe perguntas de 6 à 10

if ($qtperguntas>5){



//Questão 6

$codper6 = $_SESSION['codper6'];

$select_per6 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper6");

$per6 = mysqli_fetch_assoc($select_per6);



$select_letraaper6 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper6 and letra = 'a'");

$letraaper6 = mysqli_fetch_assoc($select_letraaper6);

$select_letrabper6 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper6 and letra = 'b'");

$letrabper6 = mysqli_fetch_assoc($select_letrabper6);

$select_letracper6 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper6 and letra = 'c'");

$letracper6 = mysqli_fetch_assoc($select_letracper6);

$select_letradper6 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper6 and letra = 'd'");

$letradper6 = mysqli_fetch_assoc($select_letradper6);

$select_letraeper6 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper6 and letra = 'e'");

$letraeper6 = mysqli_fetch_assoc($select_letraeper6);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper6["correta"]==1){

  $alt_corr6 = "Letra A";

  $cora6 = $corcorr;
  $sima6 = " ✓";

  $corb6 = "black";
  $simb6 = "";

  $corc6 = "black";
  $simc6 = "";

  $cord6 = "black";
  $simd6 = "";

  $core6 = "black";
  $sime6 = "";

}

elseif ($letrabper6["correta"]==1){

  $alt_corr6 = "Letra B";

  $corb6 = $corcorr;
  $simb6 = " ✓";

  $cora6 = "black";
  $sima6 = "";

  $corc6 = "black";
  $simc6 = "";

  $cord6 = "black";
  $simd6 = "";

  $core6 = "black";
  $sime6 = "";

}

elseif ($letracper6["correta"]==1){

  $alt_corr6 = "Letra C";

  $corc6 = $corcorr;
  $simc6 = " ✓";

  $cora6 = "black";
  $sima6 = "";

  $corb6 = "black";
  $simb6 = "";

  $cord6 = "black";
  $simd6 = "";

  $core6 = "black";
  $sime6 = "";

}

elseif ($letradper6["correta"]==1){

  $alt_corr6 = "Letra D";

  $cord6 = $corcorr;
  $simd6 = " ✓";

  $cora6 = "black";
  $sima6 = "";

  $corc6 = "black";
  $simc6 = "";

  $corb6 = "black";
  $simb6 = "";

  $core6 = "black";
  $sime6 = "";

}

elseif ($letraeper6["correta"]==1){

  $alt_corr6 = "Letra E";

  $core6 = $corcorr;
  $sime6 = " ✓";

  $cora6 = "black";
  $sima6 = "";

  $corc6 = "black";
  $simc6 = "";

  $cord6 = "black";
  $simd6 = "";

  $corb6 = "black";
  $simb6 = "";

}

//Errada

if ($alt_corr6 != $_POST['radper6'] && $_POST['radper6'] == "Letra A"){

  $cora6 = $corerr;
  $sima6 = " X";

}

elseif ($alt_corr6 != $_POST['radper6'] && $_POST['radper6'] == "Letra B"){

  $corb6 = $corerr;
  $simb6 = " X";

}

elseif ($alt_corr6 != $_POST['radper6'] && $_POST['radper6'] == "Letra C"){

  $corc6 = $corerr;
  $simc6 = " X";

}

elseif ($alt_corr6 != $_POST['radper6'] && $_POST['radper6'] == "Letra D"){

  $cord6 = $corerr;
  $simd6 = " X";

}

elseif ($alt_corr6 != $_POST['radper6'] && $_POST['radper6'] == "Letra E"){

  $core6 = $corerr;
  $sime6 = " X";

}



// Verficando qual será checado 6

if ($_POST['radper6'] == "Letra A"){

  $chea6 = "Checked";

  $cheb6 = "";

  $chec6 = "";

  $ched6 = "";

  $chee6 = "";

}elseif ($_POST['radper6'] == "Letra B"){

  $chea6 = "";

  $cheb6 = "Checked";

  $chec6 = "";

  $ched6 = "";

  $chee6 = "";

}elseif ($_POST['radper6'] == "Letra C"){

  $chea6 = "";

  $cheb6 = "";

  $chec6 = "Checked";

  $ched6 = "";

  $chee6 = "";

}elseif ($_POST['radper6'] == "Letra D"){

  $chea6 = "";

  $cheb6 = "";

  $chec6 = "";

  $ched6 = "Checked";

  $chee6 = "";

}elseif ($_POST['radper6'] == "Letra E"){

  $chea6 = "";

  $cheb6 = "";

  $chec6 = "";

  $ched6 = "";

  $chee6 = "Checked";

}



// Verificando se respsota esta correta 6

if ($_POST['radper6'] == $alt_corr6){

  $contrescorr = $contrescorr + 1;

  $cer_err6 = 1;

}

else{

  $cer_err6 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 6

if ($_POST['radper6'] == "Letra A"){

  $codigo_resposta6 = $letraaper6['codigo_resposta'];

}elseif ($_POST['radper6'] == "Letra B"){

  $codigo_resposta6 = $letrabper6['codigo_resposta'];

}elseif ($_POST['radper6'] == "Letra C"){

  $codigo_resposta6 = $letracper6['codigo_resposta'];

}elseif ($_POST['radper6'] == "Letra D"){

  $codigo_resposta6 = $letradper6['codigo_resposta'];

}elseif ($_POST['radper6'] == "Letra E"){

  $codigo_resposta6 = $letraeper6['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 6

$codigo_disciplina6 = $per6['codigo_disciplina'];



// Selecionando imagem 6

$imgper6 = $per6['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp6 = $letraaper6['tipo'];





//Questão 7

$codper7 = $_SESSION['codper7'];

$select_per7 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper7");

$per7 = mysqli_fetch_assoc($select_per7);



$select_letraaper7 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper7 and letra = 'a'");

$letraaper7 = mysqli_fetch_assoc($select_letraaper7);

$select_letrabper7 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper7 and letra = 'b'");

$letrabper7 = mysqli_fetch_assoc($select_letrabper7);

$select_letracper7 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper7 and letra = 'c'");

$letracper7 = mysqli_fetch_assoc($select_letracper7);

$select_letradper7 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper7 and letra = 'd'");

$letradper7 = mysqli_fetch_assoc($select_letradper7);

$select_letraeper7 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper7 and letra = 'e'");

$letraeper7 = mysqli_fetch_assoc($select_letraeper7);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper7["correta"]==1){

  $alt_corr7 = "Letra A";

  $cora7 = $corcorr;
  $sima7 = " ✓";

  $corb7 = "black";
  $simb7 = "";

  $corc7 = "black";
  $simc7 = "";

  $cord7 = "black";
  $simd7 = "";

  $core7 = "black";
  $sime7 = "";

}

elseif ($letrabper7["correta"]==1){

  $alt_corr7 = "Letra B";

  $corb7 = $corcorr;
  $simb7 = " ✓";

  $cora7 = "black";
  $sima7 = "";

  $corc7 = "black";
  $simc7 = "";

  $cord7 = "black";
  $simd7 = "";

  $core7 = "black";
  $sime7 = "";

}

elseif ($letracper7["correta"]==1){

  $alt_corr7 = "Letra C";

  $corc7 = $corcorr;
  $simc7 = " ✓";

  $cora7 = "black";
  $sima7 = "";

  $corb7 = "black";
  $simb7 = "";

  $cord7 = "black";
  $simd7 = "";

  $core7 = "black";
  $sime7 = "";

}

elseif ($letradper7["correta"]==1){

  $alt_corr7 = "Letra D";

  $cord7 = $corcorr;
  $simd7 = " ✓";

  $cora7 = "black";
  $sima7 = "";

  $corc7 = "black";
  $simc7 = "";

  $corb7 = "black";
  $simb7 = "";

  $core7 = "black";
  $sime7 = "";

}

elseif ($letraeper7["correta"]==1){

  $alt_corr7 = "Letra E";

  $core7 = $corcorr;
  $sime7 = " ✓";

  $cora7 = "black";
  $sima7 = "";

  $corc7 = "black";
  $simc7 = "";

  $cord7 = "black";
  $simd7 = "";

  $corb7 = "black";
  $simb7 = "";

}

//Errada

if ($alt_corr7 != $_POST['radper7'] && $_POST['radper7'] == "Letra A"){

  $cora7 = $corerr;
  $sima7 = " X";

}

elseif ($alt_corr7 != $_POST['radper7'] && $_POST['radper7'] == "Letra B"){

  $corb7 = $corerr;
  $simb7 = " X";

}

elseif ($alt_corr7 != $_POST['radper7'] && $_POST['radper7'] == "Letra C"){

  $corc7 = $corerr;
  $simc7 = " X";

}

elseif ($alt_corr7 != $_POST['radper7'] && $_POST['radper7'] == "Letra D"){

  $cord7 = $corerr;
  $simd7 = " X";

}

elseif ($alt_corr7 != $_POST['radper7'] && $_POST['radper7'] == "Letra E"){

  $core7 = $corerr;
  $sime7 = " X";

}



// Verficando qual será checado 7

if ($_POST['radper7'] == "Letra A"){

  $chea7 = "Checked";

  $cheb7 = "";

  $chec7 = "";

  $ched7 = "";

  $chee7 = "";

}elseif ($_POST['radper7'] == "Letra B"){

  $chea7 = "";

  $cheb7 = "Checked";

  $chec7 = "";

  $ched7 = "";

  $chee7 = "";

}elseif ($_POST['radper7'] == "Letra C"){

  $chea7 = "";

  $cheb7 = "";

  $chec7 = "Checked";

  $ched7 = "";

  $chee7 = "";

}elseif ($_POST['radper7'] == "Letra D"){

  $chea7 = "";

  $cheb7 = "";

  $chec7 = "";

  $ched7 = "Checked";

  $chee7 = "";

}elseif ($_POST['radper7'] == "Letra E"){

  $chea7 = "";

  $cheb7 = "";

  $chec7 = "";

  $ched7 = "";

  $chee7 = "Checked";

}



// Verificando se respsota esta correta 7

if ($_POST['radper7'] == $alt_corr7){

  $contrescorr = $contrescorr + 1;

  $cer_err7 = 1;

}

else{

  $cer_err7 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 7

if ($_POST['radper7'] == "Letra A"){

  $codigo_resposta7 = $letraaper7['codigo_resposta'];

}elseif ($_POST['radper7'] == "Letra B"){

  $codigo_resposta7 = $letrabper7['codigo_resposta'];

}elseif ($_POST['radper7'] == "Letra C"){

  $codigo_resposta7 = $letracper7['codigo_resposta'];

}elseif ($_POST['radper7'] == "Letra D"){

  $codigo_resposta7 = $letradper7['codigo_resposta'];

}elseif ($_POST['radper7'] == "Letra E"){

  $codigo_resposta7 = $letraeper7['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 7

$codigo_disciplina7 = $per7['codigo_disciplina'];



// Selecionando imagem 7

$imgper7 = $per7['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp7 = $letraaper7['tipo'];





//Questão 8

$codper8 = $_SESSION['codper8'];

$select_per8 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper8");

$per8 = mysqli_fetch_assoc($select_per8);



$select_letraaper8 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper8 and letra = 'a'");

$letraaper8 = mysqli_fetch_assoc($select_letraaper8);

$select_letrabper8 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper8 and letra = 'b'");

$letrabper8 = mysqli_fetch_assoc($select_letrabper8);

$select_letracper8 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper8 and letra = 'c'");

$letracper8 = mysqli_fetch_assoc($select_letracper8);

$select_letradper8 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper8 and letra = 'd'");

$letradper8 = mysqli_fetch_assoc($select_letradper8);

$select_letraeper8 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper8 and letra = 'e'");

$letraeper8 = mysqli_fetch_assoc($select_letraeper8);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper8["correta"]==1){

  $alt_corr8 = "Letra A";

  $cora8 = $corcorr;
  $sima8 = " ✓";

  $corb8 = "black";
  $simb8 = "";

  $corc8 = "black";
  $simc8 = "";

  $cord8 = "black";
  $simd8 = "";

  $core8 = "black";
  $sime8 = "";

}

elseif ($letrabper8["correta"]==1){

  $alt_corr8 = "Letra B";

  $corb8 = $corcorr;
  $simb8 = " ✓";

  $cora8 = "black";
  $sima8 = "";

  $corc8 = "black";
  $simc8 = "";

  $cord8 = "black";
  $simd8 = "";

  $core8 = "black";
  $sime8 = "";

}

elseif ($letracper8["correta"]==1){

  $alt_corr8 = "Letra C";

  $corc8 = $corcorr;
  $simc8 = " ✓";

  $cora8 = "black";
  $sima8 = "";

  $corb8 = "black";
  $simb8 = "";

  $cord8 = "black";
  $simd8 = "";

  $core8 = "black";
  $sime8 = "";

}

elseif ($letradper8["correta"]==1){

  $alt_corr8 = "Letra D";

  $cord8 = $corcorr;
  $simd8 = " ✓";

  $cora8 = "black";
  $sima8 = "";

  $corc8 = "black";
  $simc8 = "";

  $corb8 = "black";
  $simb8 = "";

  $core8 = "black";
  $sime8 = "";

}

elseif ($letraeper8["correta"]==1){

  $alt_corr8 = "Letra E";

  $core8 = $corcorr;
  $sime8 = " ✓";

  $cora8 = "black";
  $sima8 = "";

  $corc8 = "black";
  $simc8 = "";

  $cord8 = "black";
  $simd8 = "";

  $corb8 = "black";
  $simb8 = "";

}

//Errada

if ($alt_corr8 != $_POST['radper8'] && $_POST['radper8'] == "Letra A"){

  $cora8 = $corerr;
  $sima8 = " X";

}

elseif ($alt_corr8 != $_POST['radper8'] && $_POST['radper8'] == "Letra B"){

  $corb8 = $corerr;
  $simb8 = " X";

}

elseif ($alt_corr8 != $_POST['radper8'] && $_POST['radper8'] == "Letra C"){

  $corc8 = $corerr;
  $simc8 = " X";

}

elseif ($alt_corr8 != $_POST['radper8'] && $_POST['radper8'] == "Letra D"){

  $cord8 = $corerr;
  $simd8 = " X";

}

elseif ($alt_corr8 != $_POST['radper8'] && $_POST['radper8'] == "Letra E"){

  $core8 = $corerr;
  $sime8 = " X";

}



// Verficando qual será checado 8

if ($_POST['radper8'] == "Letra A"){

  $chea8 = "Checked";

  $cheb8 = "";

  $chec8 = "";

  $ched8 = "";

  $chee8 = "";

}elseif ($_POST['radper8'] == "Letra B"){

  $chea8 = "";

  $cheb8 = "Checked";

  $chec8 = "";

  $ched8 = "";

  $chee8 = "";

}elseif ($_POST['radper8'] == "Letra C"){

  $chea8 = "";

  $cheb8 = "";

  $chec8 = "Checked";

  $ched8 = "";

  $chee8 = "";

}elseif ($_POST['radper8'] == "Letra D"){

  $chea8 = "";

  $cheb8 = "";

  $chec8 = "";

  $ched8 = "Checked";

  $chee8 = "";

}elseif ($_POST['radper8'] == "Letra E"){

  $chea8 = "";

  $cheb8 = "";

  $chec8 = "";

  $ched8 = "";

  $chee8 = "Checked";

}



// Verificando se respsota esta correta 8

if ($_POST['radper8'] == $alt_corr8){

  $contrescorr = $contrescorr + 1;

  $cer_err8 = 1;

}

else{

  $cer_err8 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 8

if ($_POST['radper8'] == "Letra A"){

  $codigo_resposta8 = $letraaper8['codigo_resposta'];

}elseif ($_POST['radper8'] == "Letra B"){

  $codigo_resposta8 = $letrabper8['codigo_resposta'];

}elseif ($_POST['radper8'] == "Letra C"){

  $codigo_resposta8 = $letracper8['codigo_resposta'];

}elseif ($_POST['radper8'] == "Letra D"){

  $codigo_resposta8 = $letradper8['codigo_resposta'];

}elseif ($_POST['radper8'] == "Letra E"){

  $codigo_resposta8 = $letraeper8['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 8

$codigo_disciplina8 = $per8['codigo_disciplina'];



// Selecionando imagem 8

$imgper8 = $per8['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp8 = $letraaper8['tipo'];





//Questão 9

$codper9 = $_SESSION['codper9'];

$select_per9 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper9");

$per9 = mysqli_fetch_assoc($select_per9);



$select_letraaper9 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper9 and letra = 'a'");

$letraaper9 = mysqli_fetch_assoc($select_letraaper9);

$select_letrabper9 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper9 and letra = 'b'");

$letrabper9 = mysqli_fetch_assoc($select_letrabper9);

$select_letracper9 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper9 and letra = 'c'");

$letracper9 = mysqli_fetch_assoc($select_letracper9);

$select_letradper9 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper9 and letra = 'd'");

$letradper9 = mysqli_fetch_assoc($select_letradper9);

$select_letraeper9 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper9 and letra = 'e'");

$letraeper9 = mysqli_fetch_assoc($select_letraeper9);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper9["correta"]==1){

  $alt_corr9 = "Letra A";

  $cora9 = $corcorr;
  $sima9 = " ✓";

  $corb9 = "black";
  $simb9 = "";

  $corc9 = "black";
  $simc9 = "";

  $cord9 = "black";
  $simd9 = "";

  $core9 = "black";
  $sime9 = "";

}

elseif ($letrabper9["correta"]==1){

  $alt_corr9 = "Letra B";

  $corb9 = $corcorr;
  $simb9 = " ✓";

  $cora9 = "black";
  $sima9 = "";

  $corc9 = "black";
  $simc9 = "";

  $cord9 = "black";
  $simd9 = "";

  $core9 = "black";
  $sime9 = "";

}

elseif ($letracper9["correta"]==1){

  $alt_corr9 = "Letra C";

  $corc9 = $corcorr;
  $simc9 = " ✓";

  $cora9 = "black";
  $sima9 = "";

  $corb9 = "black";
  $simb9 = "";

  $cord9 = "black";
  $simd9 = "";

  $core9 = "black";
  $sime9 = "";

}

elseif ($letradper9["correta"]==1){

  $alt_corr9 = "Letra D";

  $cord9 = $corcorr;
  $simd9 = " ✓";

  $cora9 = "black";
  $sima9 = "";

  $corc9 = "black";
  $simc9 = "";

  $corb9 = "black";
  $simb9 = "";

  $core9 = "black";
  $sime9 = "";

}

elseif ($letraeper9["correta"]==1){

  $alt_corr9 = "Letra E";

  $core9 = $corcorr;
  $sime9 = " ✓";

  $cora9 = "black";
  $sima9 = "";

  $corc9 = "black";
  $simc9 = "";

  $cord9 = "black";
  $simd9 = "";

  $corb9 = "black";
  $simb9 = "";

}

//Errada

if ($alt_corr9 != $_POST['radper9'] && $_POST['radper9'] == "Letra A"){

  $cora9 = $corerr;
  $sima9 = " X";

}

elseif ($alt_corr9 != $_POST['radper9'] && $_POST['radper9'] == "Letra B"){

  $corb9 = $corerr;
  $simb9 = " X";

}

elseif ($alt_corr9 != $_POST['radper9'] && $_POST['radper9'] == "Letra C"){

  $corc9 = $corerr;
  $simc9 = " X";

}

elseif ($alt_corr9 != $_POST['radper9'] && $_POST['radper9'] == "Letra D"){

  $cord9 = $corerr;
  $simd9 = " X";

}

elseif ($alt_corr9 != $_POST['radper9'] && $_POST['radper9'] == "Letra E"){

  $core9 = $corerr;
  $sime9 = " X";

}



// Verficando qual será checado 9

if ($_POST['radper9'] == "Letra A"){

  $chea9 = "Checked";

  $cheb9 = "";

  $chec9 = "";

  $ched9 = "";

  $chee9 = "";

}elseif ($_POST['radper9'] == "Letra B"){

  $chea9 = "";

  $cheb9 = "Checked";

  $chec9 = "";

  $ched9 = "";

  $chee9 = "";

}elseif ($_POST['radper9'] == "Letra C"){

  $chea9 = "";

  $cheb9 = "";

  $chec9 = "Checked";

  $ched9 = "";

  $chee9 = "";

}elseif ($_POST['radper9'] == "Letra D"){

  $chea9 = "";

  $cheb9 = "";

  $chec9 = "";

  $ched9 = "Checked";

  $chee9 = "";

}elseif ($_POST['radper9'] == "Letra E"){

  $chea9 = "";

  $cheb9 = "";

  $chec9 = "";

  $ched9 = "";

  $chee9 = "Checked";

}



// Verificando se respsota esta correta 9

if ($_POST['radper9'] == $alt_corr9){

  $contrescorr = $contrescorr + 1;

  $cer_err9 = 1;

}

else{

  $cer_err9 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 9

if ($_POST['radper9'] == "Letra A"){

  $codigo_resposta9 = $letraaper9['codigo_resposta'];

}elseif ($_POST['radper9'] == "Letra B"){

  $codigo_resposta9 = $letrabper9['codigo_resposta'];

}elseif ($_POST['radper9'] == "Letra C"){

  $codigo_resposta9 = $letracper9['codigo_resposta'];

}elseif ($_POST['radper9'] == "Letra D"){

  $codigo_resposta9 = $letradper9['codigo_resposta'];

}elseif ($_POST['radper9'] == "Letra E"){

  $codigo_resposta9 = $letraeper9['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 9

$codigo_disciplina9 = $per9['codigo_disciplina'];



// Selecionando imagem 9

$imgper9 = $per9['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp9 = $letraaper9['tipo'];





//Questão 10

$codper10 = $_SESSION['codper10'];

$select_per10 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper10");

$per10 = mysqli_fetch_assoc($select_per10);



$select_letraaper10 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper10 and letra = 'a'");

$letraaper10 = mysqli_fetch_assoc($select_letraaper10);

$select_letrabper10 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper10 and letra = 'b'");

$letrabper10 = mysqli_fetch_assoc($select_letrabper10);

$select_letracper10 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper10 and letra = 'c'");

$letracper10 = mysqli_fetch_assoc($select_letracper10);

$select_letradper10 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper10 and letra = 'd'");

$letradper10 = mysqli_fetch_assoc($select_letradper10);

$select_letraeper10 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper10 and letra = 'e'");

$letraeper10 = mysqli_fetch_assoc($select_letraeper10);



// Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper10["correta"]==1){

  $alt_corr10 = "Letra A";

  $cora10 = $corcorr;
  $sima10 = " ✓";

  $corb10 = "black";
  $simb10 = "";

  $corc10 = "black";
  $simc10 = "";

  $cord10 = "black";
  $simd10 = "";

  $core10 = "black";
  $sime10 = "";

}

elseif ($letrabper10["correta"]==1){

  $alt_corr10 = "Letra B";

  $corb10 = $corcorr;
  $simb10 = " ✓";

  $cora10 = "black";
  $sima10 = "";

  $corc10 = "black";
  $simc10 = "";

  $cord10 = "black";
  $simd10 = "";

  $core10 = "black";
  $sime10 = "";

}

elseif ($letracper10["correta"]==1){

  $alt_corr10 = "Letra C";

  $corc10 = $corcorr;
  $simc10 = " ✓";

  $cora10 = "black";
  $sima10 = "";

  $corb10 = "black";
  $simb10 = "";

  $cord10 = "black";
  $simd10 = "";

  $core10 = "black";
  $sime10 = "";

}

elseif ($letradper10["correta"]==1){

  $alt_corr10 = "Letra D";

  $cord10 = $corcorr;
  $simd10 = " ✓";

  $cora10 = "black";
  $sima10 = "";

  $corc10 = "black";
  $simc10 = "";

  $corb10 = "black";
  $simb10 = "";

  $core10 = "black";
  $sime10 = "";

}

elseif ($letraeper10["correta"]==1){

  $alt_corr10 = "Letra E";

  $core10 = $corcorr;
  $sime10 = " ✓";

  $cora10 = "black";
  $sima10 = "";

  $corc10 = "black";
  $simc10 = "";

  $cord10 = "black";
  $simd10 = "";

  $corb10 = "black";
  $simb10 = "";

}

//Errada

if ($alt_corr10 != $_POST['radper10'] && $_POST['radper10'] == "Letra A"){

  $cora10 = $corerr;
  $sima10 = " X";

}

elseif ($alt_corr10 != $_POST['radper10'] && $_POST['radper10'] == "Letra B"){

  $corb10 = $corerr;
  $simb10 = " X";

}

elseif ($alt_corr10 != $_POST['radper10'] && $_POST['radper10'] == "Letra C"){

  $corc10 = $corerr;
  $simc10 = " X";

}

elseif ($alt_corr10 != $_POST['radper10'] && $_POST['radper10'] == "Letra D"){

  $cord10 = $corerr;
  $simd10 = " X";

}

elseif ($alt_corr10 != $_POST['radper10'] && $_POST['radper10'] == "Letra E"){

  $core10 = $corerr;
  $sime10 = " X";

}



// Verficando qual será checado 10

if ($_POST['radper10'] == "Letra A"){

  $chea10 = "Checked";

  $cheb10 = "";

  $chec10 = "";

  $ched10 = "";

  $chee10 = "";

}elseif ($_POST['radper10'] == "Letra B"){

  $chea10 = "";

  $cheb10 = "Checked";

  $chec10 = "";

  $ched10 = "";

  $chee10 = "";

}elseif ($_POST['radper10'] == "Letra C"){

  $chea10 = "";

  $cheb10 = "";

  $chec10 = "Checked";

  $ched10 = "";

  $chee10 = "";

}elseif ($_POST['radper10'] == "Letra D"){

  $chea10 = "";

  $cheb10 = "";

  $chec10 = "";

  $ched10 = "Checked";

  $chee10 = "";

}elseif ($_POST['radper10'] == "Letra E"){

  $chea10 = "";

  $cheb10 = "";

  $chec10 = "";

  $ched10 = "";

  $chee10 = "Checked";

}



// Verificando se respsota esta correta 10

if ($_POST['radper10'] == $alt_corr10){

  $contrescorr = $contrescorr + 1;

  $cer_err10 = 1;

}

else{

  $cer_err10 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 10

if ($_POST['radper10'] == "Letra A"){

  $codigo_resposta10 = $letraaper10['codigo_resposta'];

}elseif ($_POST['radper10'] == "Letra B"){

  $codigo_resposta10 = $letrabper10['codigo_resposta'];

}elseif ($_POST['radper10'] == "Letra C"){

  $codigo_resposta10 = $letracper10['codigo_resposta'];

}elseif ($_POST['radper10'] == "Letra D"){

  $codigo_resposta10 = $letradper10['codigo_resposta'];

}elseif ($_POST['radper10'] == "Letra E"){

  $codigo_resposta10 = $letraeper10['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 10

$codigo_disciplina10 = $per10['codigo_disciplina'];



// Selecionando imagem 10

$imgper10 = $per10['imagem'];



// Verificando sea resposta é do tipo imagem ou texto

$tipoimgp10 = $letraaper10['tipo'];



}





// Verificando se existe perguntas de 11 à 15

if ($qtperguntas>10){



  //Questão 11

  $codper11 = $_SESSION['codper11'];

  $select_per11 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper11");

  $per11 = mysqli_fetch_assoc($select_per11);

  

  $select_letraaper11 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper11 and letra = 'a'");

  $letraaper11 = mysqli_fetch_assoc($select_letraaper11);

  $select_letrabper11 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper11 and letra = 'b'");

  $letrabper11 = mysqli_fetch_assoc($select_letrabper11);

  $select_letracper11 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper11 and letra = 'c'");

  $letracper11 = mysqli_fetch_assoc($select_letracper11);

  $select_letradper11 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper11 and letra = 'd'");

  $letradper11 = mysqli_fetch_assoc($select_letradper11);

  $select_letraeper11 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper11 and letra = 'e'");

  $letraeper11 = mysqli_fetch_assoc($select_letraeper11);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper11["correta"]==1){

  $alt_corr11 = "Letra A";

  $cora11 = $corcorr;
  $sima11 = " ✓";

  $corb11 = "black";
  $simb11 = "";

  $corc11 = "black";
  $simc11 = "";

  $cord11 = "black";
  $simd11 = "";

  $core11 = "black";
  $sime11 = "";

}

elseif ($letrabper11["correta"]==1){

  $alt_corr11 = "Letra B";

  $corb11 = $corcorr;
  $simb11 = " ✓";

  $cora11 = "black";
  $sima11 = "";

  $corc11 = "black";
  $simc11 = "";

  $cord11 = "black";
  $simd11 = "";

  $core11 = "black";
  $sime11 = "";

}

elseif ($letracper11["correta"]==1){

  $alt_corr11 = "Letra C";

  $corc11 = $corcorr;
  $simc11 = " ✓";

  $cora11 = "black";
  $sima11 = "";

  $corb11 = "black";
  $simb11 = "";

  $cord11 = "black";
  $simd11 = "";

  $core11 = "black";
  $sime11 = "";

}

elseif ($letradper11["correta"]==1){

  $alt_corr11 = "Letra D";

  $cord11 = $corcorr;
  $simd11 = " ✓";

  $cora11 = "black";
  $sima11 = "";

  $corc11 = "black";
  $simc11 = "";

  $corb11 = "black";
  $simb11 = "";

  $core11 = "black";
  $sime11 = "";

}

elseif ($letraeper11["correta"]==1){

  $alt_corr11 = "Letra E";

  $core11 = $corcorr;
  $sime11 = " ✓";

  $cora11 = "black";
  $sima11 = "";

  $corc11 = "black";
  $simc11 = "";

  $cord11 = "black";
  $simd11 = "";

  $corb11 = "black";
  $simb11 = "";

}

//Errada

if ($alt_corr11 != $_POST['radper11'] && $_POST['radper11'] == "Letra A"){

  $cora11 = $corerr;
  $sima11 = " X";

}

elseif ($alt_corr11 != $_POST['radper11'] && $_POST['radper11'] == "Letra B"){

  $corb11 = $corerr;
  $simb11 = " X";

}

elseif ($alt_corr11 != $_POST['radper11'] && $_POST['radper11'] == "Letra C"){

  $corc11 = $corerr;
  $simc11 = " X";

}

elseif ($alt_corr11 != $_POST['radper11'] && $_POST['radper11'] == "Letra D"){

  $cord11 = $corerr;
  $simd11 = " X";

}

elseif ($alt_corr11 != $_POST['radper11'] && $_POST['radper11'] == "Letra E"){

  $core11 = $corerr;
  $sime11 = " X";

}

  

  // Verficando qual será checado 11

  if ($_POST['radper11'] == "Letra A"){

    $chea11 = "Checked";

    $cheb11 = "";

    $chec11 = "";

    $ched11 = "";

    $chee11 = "";

  }elseif ($_POST['radper11'] == "Letra B"){

    $chea11 = "";

    $cheb11 = "Checked";

    $chec11 = "";

    $ched11 = "";

    $chee11 = "";

  }elseif ($_POST['radper11'] == "Letra C"){

    $chea11 = "";

    $cheb11 = "";

    $chec11 = "Checked";

    $ched11 = "";

    $chee11 = "";

  }elseif ($_POST['radper11'] == "Letra D"){

    $chea11 = "";

    $cheb11 = "";

    $chec11 = "";

    $ched11 = "Checked";

    $chee11 = "";

  }elseif ($_POST['radper11'] == "Letra E"){

    $chea11 = "";

    $cheb11 = "";

    $chec11 = "";

    $ched11 = "";

    $chee11 = "Checked";

  }

  

  // Verificando se respsota esta correta 11

  if ($_POST['radper11'] == $alt_corr11){

    $contrescorr = $contrescorr + 1;

    $cer_err11 = 1;

}

else{

  $cer_err11 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 11

if ($_POST['radper11'] == "Letra A"){

  $codigo_resposta11 = $letraaper11['codigo_resposta'];

}elseif ($_POST['radper11'] == "Letra B"){

  $codigo_resposta11 = $letrabper11['codigo_resposta'];

}elseif ($_POST['radper11'] == "Letra C"){

  $codigo_resposta11 = $letracper11['codigo_resposta'];

}elseif ($_POST['radper11'] == "Letra D"){

  $codigo_resposta11 = $letradper11['codigo_resposta'];

}elseif ($_POST['radper11'] == "Letra E"){

  $codigo_resposta11 = $letraeper11['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 11

$codigo_disciplina11 = $per11['codigo_disciplina'];



  // Selecionando imagem 11

  $imgper11 = $per11['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp11 = $letraaper11['tipo'];

  

  

  //Questão 12

  $codper12 = $_SESSION['codper12'];

  $select_per12 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper12");

  $per12 = mysqli_fetch_assoc($select_per12);

  

  $select_letraaper12 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper12 and letra = 'a'");

  $letraaper12 = mysqli_fetch_assoc($select_letraaper12);

  $select_letrabper12 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper12 and letra = 'b'");

  $letrabper12 = mysqli_fetch_assoc($select_letrabper12);

  $select_letracper12 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper12 and letra = 'c'");

  $letracper12 = mysqli_fetch_assoc($select_letracper12);

  $select_letradper12 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper12 and letra = 'd'");

  $letradper12 = mysqli_fetch_assoc($select_letradper12);

  $select_letraeper12 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper12 and letra = 'e'");

  $letraeper12 = mysqli_fetch_assoc($select_letraeper12);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper12["correta"]==1){

  $alt_corr12 = "Letra A";

  $cora12 = $corcorr;
  $sima12 = " ✓";

  $corb12 = "black";
  $simb12 = "";

  $corc12 = "black";
  $simc12 = "";

  $cord12 = "black";
  $simd12 = "";

  $core12 = "black";
  $sime12 = "";

}

elseif ($letrabper12["correta"]==1){

  $alt_corr12 = "Letra B";

  $corb12 = $corcorr;
  $simb12 = " ✓";

  $cora12 = "black";
  $sima12 = "";

  $corc12 = "black";
  $simc12 = "";

  $cord12 = "black";
  $simd12 = "";

  $core12 = "black";
  $sime12 = "";

}

elseif ($letracper12["correta"]==1){

  $alt_corr12 = "Letra C";

  $corc12 = $corcorr;
  $simc12 = " ✓";

  $cora12 = "black";
  $sima12 = "";

  $corb12 = "black";
  $simb12 = "";

  $cord12 = "black";
  $simd12 = "";

  $core12 = "black";
  $sime12 = "";

}

elseif ($letradper12["correta"]==1){

  $alt_corr12 = "Letra D";

  $cord12 = $corcorr;
  $simd12 = " ✓";

  $cora12 = "black";
  $sima12 = "";

  $corc12 = "black";
  $simc12 = "";

  $corb12 = "black";
  $simb12 = "";

  $core12 = "black";
  $sime12 = "";

}

elseif ($letraeper12["correta"]==1){

  $alt_corr12 = "Letra E";

  $core12 = $corcorr;
  $sime12 = " ✓";

  $cora12 = "black";
  $sima12 = "";

  $corc12 = "black";
  $simc12 = "";

  $cord12 = "black";
  $simd12 = "";

  $corb12 = "black";
  $simb12 = "";

}

//Errada

if ($alt_corr12 != $_POST['radper12'] && $_POST['radper12'] == "Letra A"){

  $cora12 = $corerr;
  $sima12 = " X";

}

elseif ($alt_corr12 != $_POST['radper12'] && $_POST['radper12'] == "Letra B"){

  $corb12 = $corerr;
  $simb12 = " X";

}

elseif ($alt_corr12 != $_POST['radper12'] && $_POST['radper12'] == "Letra C"){

  $corc12 = $corerr;
  $simc12 = " X";

}

elseif ($alt_corr12 != $_POST['radper12'] && $_POST['radper12'] == "Letra D"){

  $cord12 = $corerr;
  $simd12 = " X";

}

elseif ($alt_corr12 != $_POST['radper12'] && $_POST['radper12'] == "Letra E"){

  $core12 = $corerr;
  $sime12 = " X";

}

  

  // Verficando qual será checado 12

  if ($_POST['radper12'] == "Letra A"){

    $chea12 = "Checked";

    $cheb12 = "";

    $chec12 = "";

    $ched12 = "";

    $chee12 = "";

  }elseif ($_POST['radper12'] == "Letra B"){

    $chea12 = "";

    $cheb12 = "Checked";

    $chec12 = "";

    $ched12 = "";

    $chee12 = "";

  }elseif ($_POST['radper12'] == "Letra C"){

    $chea12 = "";

    $cheb12 = "";

    $chec12 = "Checked";

    $ched12 = "";

    $chee12 = "";

  }elseif ($_POST['radper12'] == "Letra D"){

    $chea12 = "";

    $cheb12 = "";

    $chec12 = "";

    $ched12 = "Checked";

    $chee12 = "";

  }elseif ($_POST['radper12'] == "Letra E"){

    $chea12 = "";

    $cheb12 = "";

    $chec12 = "";

    $ched12 = "";

    $chee12 = "Checked";

  }

  

  // Verificando se respsota esta correta 12

  if ($_POST['radper12'] == $alt_corr12){

    $contrescorr = $contrescorr + 1;

    $cer_err12 = 1;

}

else{

  $cer_err12 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 12

if ($_POST['radper12'] == "Letra A"){

  $codigo_resposta12 = $letraaper12['codigo_resposta'];

}elseif ($_POST['radper12'] == "Letra B"){

  $codigo_resposta12 = $letrabper12['codigo_resposta'];

}elseif ($_POST['radper12'] == "Letra C"){

  $codigo_resposta12 = $letracper12['codigo_resposta'];

}elseif ($_POST['radper12'] == "Letra D"){

  $codigo_resposta12 = $letradper12['codigo_resposta'];

}elseif ($_POST['radper12'] == "Letra E"){

  $codigo_resposta12 = $letraeper12['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 12

$codigo_disciplina12 = $per12['codigo_disciplina'];

  

  // Selecionando imagem 12

  $imgper12 = $per12['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp12 = $letraaper12['tipo'];

  

  

  //Questão 13

  $codper13 = $_SESSION['codper13'];

  $select_per13 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper13");

  $per13 = mysqli_fetch_assoc($select_per13);

  

  $select_letraaper13 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper13 and letra = 'a'");

  $letraaper13 = mysqli_fetch_assoc($select_letraaper13);

  $select_letrabper13 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper13 and letra = 'b'");

  $letrabper13 = mysqli_fetch_assoc($select_letrabper13);

  $select_letracper13 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper13 and letra = 'c'");

  $letracper13 = mysqli_fetch_assoc($select_letracper13);

  $select_letradper13 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper13 and letra = 'd'");

  $letradper13 = mysqli_fetch_assoc($select_letradper13);

  $select_letraeper13 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper13 and letra = 'e'");

  $letraeper13 = mysqli_fetch_assoc($select_letraeper13);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper13["correta"]==1){

  $alt_corr13 = "Letra A";

  $cora13 = $corcorr;
  $sima13 = " ✓";

  $corb13 = "black";
  $simb13 = "";

  $corc13 = "black";
  $simc13 = "";

  $cord13 = "black";
  $simd13 = "";

  $core13 = "black";
  $sime13 = "";

}

elseif ($letrabper13["correta"]==1){

  $alt_corr13 = "Letra B";

  $corb13 = $corcorr;
  $simb13 = " ✓";

  $cora13 = "black";
  $sima13 = "";

  $corc13 = "black";
  $simc13 = "";

  $cord13 = "black";
  $simd13 = "";

  $core13 = "black";
  $sime13 = "";

}

elseif ($letracper13["correta"]==1){

  $alt_corr13 = "Letra C";

  $corc13 = $corcorr;
  $simc13 = " ✓";

  $cora13 = "black";
  $sima13 = "";

  $corb13 = "black";
  $simb13 = "";

  $cord13 = "black";
  $simd13 = "";

  $core13 = "black";
  $sime13 = "";

}

elseif ($letradper13["correta"]==1){

  $alt_corr13 = "Letra D";

  $cord13 = $corcorr;
  $simd13 = " ✓";

  $cora13 = "black";
  $sima13 = "";

  $corc13 = "black";
  $simc13 = "";

  $corb13 = "black";
  $simb13 = "";

  $core13 = "black";
  $sime13 = "";

}

elseif ($letraeper13["correta"]==1){

  $alt_corr13 = "Letra E";

  $core13 = $corcorr;
  $sime13 = " ✓";

  $cora13 = "black";
  $sima13 = "";

  $corc13 = "black";
  $simc13 = "";

  $cord13 = "black";
  $simd13 = "";

  $corb13 = "black";
  $simb13 = "";

}

//Errada

if ($alt_corr13 != $_POST['radper13'] && $_POST['radper13'] == "Letra A"){

  $cora13 = $corerr;
  $sima13 = " X";

}

elseif ($alt_corr13 != $_POST['radper13'] && $_POST['radper13'] == "Letra B"){

  $corb13 = $corerr;
  $simb13 = " X";

}

elseif ($alt_corr13 != $_POST['radper13'] && $_POST['radper13'] == "Letra C"){

  $corc13 = $corerr;
  $simc13 = " X";

}

elseif ($alt_corr13 != $_POST['radper13'] && $_POST['radper13'] == "Letra D"){

  $cord13 = $corerr;
  $simd13 = " X";

}

elseif ($alt_corr13 != $_POST['radper13'] && $_POST['radper13'] == "Letra E"){

  $core13 = $corerr;
  $sime13 = " X";

}

  

  // Verficando qual será checado 13

  if ($_POST['radper13'] == "Letra A"){

    $chea13 = "Checked";

    $cheb13 = "";

    $chec13 = "";

    $ched13 = "";

    $chee13 = "";

  }elseif ($_POST['radper13'] == "Letra B"){

    $chea13 = "";

    $cheb13 = "Checked";

    $chec13 = "";

    $ched13 = "";

    $chee13 = "";

  }elseif ($_POST['radper13'] == "Letra C"){

    $chea13 = "";

    $cheb13 = "";

    $chec13 = "Checked";

    $ched13 = "";

    $chee13 = "";

  }elseif ($_POST['radper13'] == "Letra D"){

    $chea13 = "";

    $cheb13 = "";

    $chec13 = "";

    $ched13 = "Checked";

    $chee13 = "";

  }elseif ($_POST['radper13'] == "Letra E"){

    $chea13 = "";

    $cheb13 = "";

    $chec13 = "";

    $ched13 = "";

    $chee13 = "Checked";

  }

  

  // Verificando se respsota esta correta 13

  if ($_POST['radper13'] == $alt_corr13){

    $contrescorr = $contrescorr + 1;

    $cer_err13 = 1;

}

else{

  $cer_err13 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 13

if ($_POST['radper13'] == "Letra A"){

  $codigo_resposta13 = $letraaper13['codigo_resposta'];

}elseif ($_POST['radper13'] == "Letra B"){

  $codigo_resposta13 = $letrabper13['codigo_resposta'];

}elseif ($_POST['radper13'] == "Letra C"){

  $codigo_resposta13 = $letracper13['codigo_resposta'];

}elseif ($_POST['radper13'] == "Letra D"){

  $codigo_resposta13 = $letradper13['codigo_resposta'];

}elseif ($_POST['radper13'] == "Letra E"){

  $codigo_resposta13 = $letraeper13['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 13

$codigo_disciplina13 = $per13['codigo_disciplina'];

  

  // Selecionando imagem 13

  $imgper13 = $per13['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp13 = $letraaper13['tipo'];

  

  

  //Questão 14

  $codper14 = $_SESSION['codper14'];

  $select_per14 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper14");

  $per14 = mysqli_fetch_assoc($select_per14);

  

  $select_letraaper14 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper14 and letra = 'a'");

  $letraaper14 = mysqli_fetch_assoc($select_letraaper14);

  $select_letrabper14 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper14 and letra = 'b'");

  $letrabper14 = mysqli_fetch_assoc($select_letrabper14);

  $select_letracper14 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper14 and letra = 'c'");

  $letracper14 = mysqli_fetch_assoc($select_letracper14);

  $select_letradper14 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper14 and letra = 'd'");

  $letradper14 = mysqli_fetch_assoc($select_letradper14);

  $select_letraeper14 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper14 and letra = 'e'");

  $letraeper14 = mysqli_fetch_assoc($select_letraeper14);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper14["correta"]==1){

  $alt_corr14 = "Letra A";

  $cora14 = $corcorr;
  $sima14 = " ✓";

  $corb14 = "black";
  $simb14 = "";

  $corc14 = "black";
  $simc14 = "";

  $cord14 = "black";
  $simd14 = "";

  $core14 = "black";
  $sime14 = "";

}

elseif ($letrabper14["correta"]==1){

  $alt_corr14 = "Letra B";

  $corb14 = $corcorr;
  $simb14 = " ✓";

  $cora14 = "black";
  $sima14 = "";

  $corc14 = "black";
  $simc14 = "";

  $cord14 = "black";
  $simd14 = "";

  $core14 = "black";
  $sime14 = "";

}

elseif ($letracper14["correta"]==1){

  $alt_corr14 = "Letra C";

  $corc14 = $corcorr;
  $simc14 = " ✓";

  $cora14 = "black";
  $sima14 = "";

  $corb14 = "black";
  $simb14 = "";

  $cord14 = "black";
  $simd14 = "";

  $core14 = "black";
  $sime14 = "";

}

elseif ($letradper14["correta"]==1){

  $alt_corr14 = "Letra D";

  $cord14 = $corcorr;
  $simd14 = " ✓";

  $cora14 = "black";
  $sima14 = "";

  $corc14 = "black";
  $simc14 = "";

  $corb14 = "black";
  $simb14 = "";

  $core14 = "black";
  $sime14 = "";

}

elseif ($letraeper14["correta"]==1){

  $alt_corr14 = "Letra E";

  $core14 = $corcorr;
  $sime14 = " ✓";

  $cora14 = "black";
  $sima14 = "";

  $corc14 = "black";
  $simc14 = "";

  $cord14 = "black";
  $simd14 = "";

  $corb14 = "black";
  $simb14 = "";

}

//Errada

if ($alt_corr14 != $_POST['radper14'] && $_POST['radper14'] == "Letra A"){

  $cora14 = $corerr;
  $sima14 = " X";

}

elseif ($alt_corr14 != $_POST['radper14'] && $_POST['radper14'] == "Letra B"){

  $corb14 = $corerr;
  $simb14 = " X";

}

elseif ($alt_corr14 != $_POST['radper14'] && $_POST['radper14'] == "Letra C"){

  $corc14 = $corerr;
  $simc14 = " X";

}

elseif ($alt_corr14 != $_POST['radper14'] && $_POST['radper14'] == "Letra D"){

  $cord14 = $corerr;
  $simd14 = " X";

}

elseif ($alt_corr14 != $_POST['radper14'] && $_POST['radper14'] == "Letra E"){

  $core14 = $corerr;
  $sime14 = " X";

}

  

  // Verficando qual será checado 14

  if ($_POST['radper14'] == "Letra A"){

    $chea14 = "Checked";

    $cheb14 = "";

    $chec14 = "";

    $ched14 = "";

    $chee14 = "";

  }elseif ($_POST['radper14'] == "Letra B"){

    $chea14 = "";

    $cheb14 = "Checked";

    $chec14 = "";

    $ched14 = "";

    $chee14 = "";

  }elseif ($_POST['radper14'] == "Letra C"){

    $chea14 = "";

    $cheb14 = "";

    $chec14 = "Checked";

    $ched14 = "";

    $chee14 = "";

  }elseif ($_POST['radper14'] == "Letra D"){

    $chea14 = "";

    $cheb14 = "";

    $chec14 = "";

    $ched14 = "Checked";

    $chee14 = "";

  }elseif ($_POST['radper14'] == "Letra E"){

    $chea14 = "";

    $cheb14 = "";

    $chec14 = "";

    $ched14 = "";

    $chee14 = "Checked";

  }

  

  // Verificando se respsota esta correta 14

  if ($_POST['radper14'] == $alt_corr14){

    $contrescorr = $contrescorr + 1;

    $cer_err14 = 1;

}

else{

  $cer_err14 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 14

if ($_POST['radper14'] == "Letra A"){

  $codigo_resposta14 = $letraaper14['codigo_resposta'];

}elseif ($_POST['radper14'] == "Letra B"){

  $codigo_resposta14 = $letrabper14['codigo_resposta'];

}elseif ($_POST['radper14'] == "Letra C"){

  $codigo_resposta14 = $letracper14['codigo_resposta'];

}elseif ($_POST['radper14'] == "Letra D"){

  $codigo_resposta14 = $letradper14['codigo_resposta'];

}elseif ($_POST['radper14'] == "Letra E"){

  $codigo_resposta14 = $letraeper14['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 14

$codigo_disciplina14 = $per14['codigo_disciplina'];

  

  // Selecionando imagem 14

  $imgper14 = $per14['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp14 = $letraaper14['tipo'];

  

  

  //Questão 15

  $codper15 = $_SESSION['codper15'];

  $select_per15 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper15");

  $per15 = mysqli_fetch_assoc($select_per15);

  

  $select_letraaper15 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper15 and letra = 'a'");

  $letraaper15 = mysqli_fetch_assoc($select_letraaper15);

  $select_letrabper15 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper15 and letra = 'b'");

  $letrabper15 = mysqli_fetch_assoc($select_letrabper15);

  $select_letracper15 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper15 and letra = 'c'");

  $letracper15 = mysqli_fetch_assoc($select_letracper15);

  $select_letradper15 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper15 and letra = 'd'");

  $letradper15 = mysqli_fetch_assoc($select_letradper15);

  $select_letraeper15 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper15 and letra = 'e'");

  $letraeper15 = mysqli_fetch_assoc($select_letraeper15);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper15["correta"]==1){

  $alt_corr15 = "Letra A";

  $cora15 = $corcorr;
  $sima15 = " ✓";

  $corb15 = "black";
  $simb15 = "";

  $corc15 = "black";
  $simc15 = "";

  $cord15 = "black";
  $simd15 = "";

  $core15 = "black";
  $sime15 = "";

}

elseif ($letrabper15["correta"]==1){

  $alt_corr15 = "Letra B";

  $corb15 = $corcorr;
  $simb15 = " ✓";

  $cora15 = "black";
  $sima15 = "";

  $corc15 = "black";
  $simc15 = "";

  $cord15 = "black";
  $simd15 = "";

  $core15 = "black";
  $sime15 = "";

}

elseif ($letracper15["correta"]==1){

  $alt_corr15 = "Letra C";

  $corc15 = $corcorr;
  $simc15 = " ✓";

  $cora15 = "black";
  $sima15 = "";

  $corb15 = "black";
  $simb15 = "";

  $cord15 = "black";
  $simd15 = "";

  $core15 = "black";
  $sime15 = "";

}

elseif ($letradper15["correta"]==1){

  $alt_corr15 = "Letra D";

  $cord15 = $corcorr;
  $simd15 = " ✓";

  $cora15 = "black";
  $sima15 = "";

  $corc15 = "black";
  $simc15 = "";

  $corb15 = "black";
  $simb15 = "";

  $core15 = "black";
  $sime15 = "";

}

elseif ($letraeper15["correta"]==1){

  $alt_corr15 = "Letra E";

  $core15 = $corcorr;
  $sime15 = " ✓";

  $cora15 = "black";
  $sima15 = "";

  $corc15 = "black";
  $simc15 = "";

  $cord15 = "black";
  $simd15 = "";

  $corb15 = "black";
  $simb15 = "";

}

//Errada

if ($alt_corr15 != $_POST['radper15'] && $_POST['radper15'] == "Letra A"){

  $cora15 = $corerr;
  $sima15 = " X";

}

elseif ($alt_corr15 != $_POST['radper15'] && $_POST['radper15'] == "Letra B"){

  $corb15 = $corerr;
  $simb15 = " X";

}

elseif ($alt_corr15 != $_POST['radper15'] && $_POST['radper15'] == "Letra C"){

  $corc15 = $corerr;
  $simc15 = " X";

}

elseif ($alt_corr15 != $_POST['radper15'] && $_POST['radper15'] == "Letra D"){

  $cord15 = $corerr;
  $simd15 = " X";

}

elseif ($alt_corr15 != $_POST['radper15'] && $_POST['radper15'] == "Letra E"){

  $core15 = $corerr;
  $sime15 = " X";

}

  

  // Verficando qual será checado 15

  if ($_POST['radper15'] == "Letra A"){

    $chea15 = "Checked";

    $cheb15 = "";

    $chec15 = "";

    $ched15 = "";

    $chee15 = "";

  }elseif ($_POST['radper15'] == "Letra B"){

    $chea15 = "";

    $cheb15 = "Checked";

    $chec15 = "";

    $ched15 = "";

    $chee15 = "";

  }elseif ($_POST['radper15'] == "Letra C"){

    $chea15 = "";

    $cheb15 = "";

    $chec15 = "Checked";

    $ched15 = "";

    $chee15 = "";

  }elseif ($_POST['radper15'] == "Letra D"){

    $chea15 = "";

    $cheb15 = "";

    $chec15 = "";

    $ched15 = "Checked";

    $chee15 = "";

  }elseif ($_POST['radper15'] == "Letra E"){

    $chea15 = "";

    $cheb15 = "";

    $chec15 = "";

    $ched15 = "";

    $chee15 = "Checked";

  }

  

  // Verificando se respsota esta correta 15

  if ($_POST['radper15'] == $alt_corr15){

    $contrescorr = $contrescorr + 1;

    $cer_err15 = 1;

}

else{

  $cer_err15 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 15

if ($_POST['radper15'] == "Letra A"){

  $codigo_resposta15 = $letraaper15['codigo_resposta'];

}elseif ($_POST['radper15'] == "Letra B"){

  $codigo_resposta15 = $letrabper15['codigo_resposta'];

}elseif ($_POST['radper15'] == "Letra C"){

  $codigo_resposta15 = $letracper15['codigo_resposta'];

}elseif ($_POST['radper15'] == "Letra D"){

  $codigo_resposta15 = $letradper15['codigo_resposta'];

}elseif ($_POST['radper15'] == "Letra E"){

  $codigo_resposta15 = $letraeper15['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 15

$codigo_disciplina15 = $per15['codigo_disciplina'];

  

  // Selecionando imagem 15

  $imgper15 = $per15['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp15 = $letraaper15['tipo'];

  

  }





  // Verificando se existe perguntas de 16 à 20

if ($qtperguntas>15){



  //Questão 16

  $codper16 = $_SESSION['codper16'];

  $select_per16 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper16");

  $per16 = mysqli_fetch_assoc($select_per16);

  

  $select_letraaper16 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper16 and letra = 'a'");

  $letraaper16 = mysqli_fetch_assoc($select_letraaper16);

  $select_letrabper16 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper16 and letra = 'b'");

  $letrabper16 = mysqli_fetch_assoc($select_letrabper16);

  $select_letracper16 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper16 and letra = 'c'");

  $letracper16 = mysqli_fetch_assoc($select_letracper16);

  $select_letradper16 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper16 and letra = 'd'");

  $letradper16 = mysqli_fetch_assoc($select_letradper16);

  $select_letraeper16 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper16 and letra = 'e'");

  $letraeper16 = mysqli_fetch_assoc($select_letraeper16);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper16["correta"]==1){

  $alt_corr16 = "Letra A";

  $cora16 = $corcorr;
  $sima16 = " ✓";

  $corb16 = "black";
  $simb16 = "";

  $corc16 = "black";
  $simc16 = "";

  $cord16 = "black";
  $simd16 = "";

  $core16 = "black";
  $sime16 = "";

}

elseif ($letrabper16["correta"]==1){

  $alt_corr16 = "Letra B";

  $corb16 = $corcorr;
  $simb16 = " ✓";

  $cora16 = "black";
  $sima16 = "";

  $corc16 = "black";
  $simc16 = "";

  $cord16 = "black";
  $simd16 = "";

  $core16 = "black";
  $sime16 = "";

}

elseif ($letracper16["correta"]==1){

  $alt_corr16 = "Letra C";

  $corc16 = $corcorr;
  $simc16 = " ✓";

  $cora16 = "black";
  $sima16 = "";

  $corb16 = "black";
  $simb16 = "";

  $cord16 = "black";
  $simd16 = "";

  $core16 = "black";
  $sime16 = "";

}

elseif ($letradper16["correta"]==1){

  $alt_corr16 = "Letra D";

  $cord16 = $corcorr;
  $simd16 = " ✓";

  $cora16 = "black";
  $sima16 = "";

  $corc16 = "black";
  $simc16 = "";

  $corb16 = "black";
  $simb16 = "";

  $core16 = "black";
  $sime16 = "";

}

elseif ($letraeper16["correta"]==1){

  $alt_corr16 = "Letra E";

  $core16 = $corcorr;
  $sime16 = " ✓";

  $cora16 = "black";
  $sima16 = "";

  $corc16 = "black";
  $simc16 = "";

  $cord16 = "black";
  $simd16 = "";

  $corb16 = "black";
  $simb16 = "";

}

//Errada

if ($alt_corr16 != $_POST['radper16'] && $_POST['radper16'] == "Letra A"){

  $cora16 = $corerr;
  $sima16 = " X";

}

elseif ($alt_corr16 != $_POST['radper16'] && $_POST['radper16'] == "Letra B"){

  $corb16 = $corerr;
  $simb16 = " X";

}

elseif ($alt_corr16 != $_POST['radper16'] && $_POST['radper16'] == "Letra C"){

  $corc16 = $corerr;
  $simc16 = " X";

}

elseif ($alt_corr16 != $_POST['radper16'] && $_POST['radper16'] == "Letra D"){

  $cord16 = $corerr;
  $simd16 = " X";

}

elseif ($alt_corr16 != $_POST['radper16'] && $_POST['radper16'] == "Letra E"){

  $core16 = $corerr;
  $sime16 = " X";

}

  

  // Verficando qual será checado 16

  if ($_POST['radper16'] == "Letra A"){

    $chea16 = "Checked";

    $cheb16 = "";

    $chec16 = "";

    $ched16 = "";

    $chee16 = "";

  }elseif ($_POST['radper16'] == "Letra B"){

    $chea16 = "";

    $cheb16 = "Checked";

    $chec16 = "";

    $ched16 = "";

    $chee16 = "";

  }elseif ($_POST['radper16'] == "Letra C"){

    $chea16 = "";

    $cheb16 = "";

    $chec16 = "Checked";

    $ched16 = "";

    $chee16 = "";

  }elseif ($_POST['radper16'] == "Letra D"){

    $chea16 = "";

    $cheb16 = "";

    $chec16 = "";

    $ched16 = "Checked";

    $chee16 = "";

  }elseif ($_POST['radper16'] == "Letra E"){

    $chea16 = "";

    $cheb16 = "";

    $chec16 = "";

    $ched16 = "";

    $chee16 = "Checked";

  }

  

  // Verificando se respsota esta correta 16

  if ($_POST['radper16'] == $alt_corr16){

    $contrescorr = $contrescorr + 1;

    $cer_err16 = 1;

}

else{

  $cer_err16 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 16

if ($_POST['radper16'] == "Letra A"){

  $codigo_resposta16 = $letraaper16['codigo_resposta'];

}elseif ($_POST['radper16'] == "Letra B"){

  $codigo_resposta16 = $letrabper16['codigo_resposta'];

}elseif ($_POST['radper16'] == "Letra C"){

  $codigo_resposta16 = $letracper16['codigo_resposta'];

}elseif ($_POST['radper16'] == "Letra D"){

  $codigo_resposta16 = $letradper16['codigo_resposta'];

}elseif ($_POST['radper16'] == "Letra E"){

  $codigo_resposta16 = $letraeper16['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 16

$codigo_disciplina16 = $per16['codigo_disciplina'];

  

  // Selecionando imagem 16

  $imgper16 = $per16['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp16 = $letraaper16['tipo'];

  

  

  //Questão 17

  $codper17 = $_SESSION['codper17'];

  $select_per17 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper17");

  $per17 = mysqli_fetch_assoc($select_per17);

  

  $select_letraaper17 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper17 and letra = 'a'");

  $letraaper17 = mysqli_fetch_assoc($select_letraaper17);

  $select_letrabper17 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper17 and letra = 'b'");

  $letrabper17 = mysqli_fetch_assoc($select_letrabper17);

  $select_letracper17 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper17 and letra = 'c'");

  $letracper17 = mysqli_fetch_assoc($select_letracper17);

  $select_letradper17 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper17 and letra = 'd'");

  $letradper17 = mysqli_fetch_assoc($select_letradper17);

  $select_letraeper17 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper17 and letra = 'e'");

  $letraeper17 = mysqli_fetch_assoc($select_letraeper17);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper17["correta"]==1){

  $alt_corr17 = "Letra A";

  $cora17 = $corcorr;
  $sima17 = " ✓";

  $corb17 = "black";
  $simb17 = "";

  $corc17 = "black";
  $simc17 = "";

  $cord17 = "black";
  $simd17 = "";

  $core17 = "black";
  $sime17 = "";

}

elseif ($letrabper17["correta"]==1){

  $alt_corr17 = "Letra B";

  $corb17 = $corcorr;
  $simb17 = " ✓";

  $cora17 = "black";
  $sima17 = "";

  $corc17 = "black";
  $simc17 = "";

  $cord17 = "black";
  $simd17 = "";

  $core17 = "black";
  $sime17 = "";

}

elseif ($letracper17["correta"]==1){

  $alt_corr17 = "Letra C";

  $corc17 = $corcorr;
  $simc17 = " ✓";

  $cora17 = "black";
  $sima17 = "";

  $corb17 = "black";
  $simb17 = "";

  $cord17 = "black";
  $simd17 = "";

  $core17 = "black";
  $sime17 = "";

}

elseif ($letradper17["correta"]==1){

  $alt_corr17 = "Letra D";

  $cord17 = $corcorr;
  $simd17 = " ✓";

  $cora17 = "black";
  $sima17 = "";

  $corc17 = "black";
  $simc17 = "";

  $corb17 = "black";
  $simb17 = "";

  $core17 = "black";
  $sime17 = "";

}

elseif ($letraeper17["correta"]==1){

  $alt_corr17 = "Letra E";

  $core17 = $corcorr;
  $sime17 = " ✓";

  $cora17 = "black";
  $sima17 = "";

  $corc17 = "black";
  $simc17 = "";

  $cord17 = "black";
  $simd17 = "";

  $corb17 = "black";
  $simb17 = "";

}

//Errada

if ($alt_corr17 != $_POST['radper17'] && $_POST['radper17'] == "Letra A"){

  $cora17 = $corerr;
  $sima17 = " X";

}

elseif ($alt_corr17 != $_POST['radper17'] && $_POST['radper17'] == "Letra B"){

  $corb17 = $corerr;
  $simb17 = " X";

}

elseif ($alt_corr17 != $_POST['radper17'] && $_POST['radper17'] == "Letra C"){

  $corc17 = $corerr;
  $simc17 = " X";

}

elseif ($alt_corr17 != $_POST['radper17'] && $_POST['radper17'] == "Letra D"){

  $cord17 = $corerr;
  $simd17 = " X";

}

elseif ($alt_corr17 != $_POST['radper17'] && $_POST['radper17'] == "Letra E"){

  $core17 = $corerr;
  $sime17 = " X";

}

  

  // Verficando qual será checado 17

  if ($_POST['radper17'] == "Letra A"){

    $chea17 = "Checked";

    $cheb17 = "";

    $chec17 = "";

    $ched17 = "";

    $chee17 = "";

  }elseif ($_POST['radper17'] == "Letra B"){

    $chea17 = "";

    $cheb17 = "Checked";

    $chec17 = "";

    $ched17 = "";

    $chee17 = "";

  }elseif ($_POST['radper17'] == "Letra C"){

    $chea17 = "";

    $cheb17 = "";

    $chec17 = "Checked";

    $ched17 = "";

    $chee17 = "";

  }elseif ($_POST['radper17'] == "Letra D"){

    $chea17 = "";

    $cheb17 = "";

    $chec17 = "";

    $ched17 = "Checked";

    $chee17 = "";

  }elseif ($_POST['radper17'] == "Letra E"){

    $chea17 = "";

    $cheb17 = "";

    $chec17 = "";

    $ched17 = "";

    $chee17 = "Checked";

  }

  

  // Verificando se respsota esta correta 17

  if ($_POST['radper17'] == $alt_corr17){

    $contrescorr = $contrescorr + 1;

    $cer_err17 = 1;

}

else{

  $cer_err17 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 2

if ($_POST['radper2'] == "Letra A"){

  $codigo_resposta2 = $letraaper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra B"){

  $codigo_resposta2 = $letrabper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra C"){

  $codigo_resposta2 = $letracper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra D"){

  $codigo_resposta2 = $letradper2['codigo_resposta'];

}elseif ($_POST['radper2'] == "Letra E"){

  $codigo_resposta2 = $letraeper2['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 2

$codigo_disciplina2 = $per2['codigo_disciplina'];

  

  // Selecionando imagem 17

  $imgper17 = $per17['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp17 = $letraaper17['tipo'];

  

  

  //Questão 18

  $codper18 = $_SESSION['codper18'];

  $select_per18 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper18");

  $per18 = mysqli_fetch_assoc($select_per18);

  

  $select_letraaper18 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper18 and letra = 'a'");

  $letraaper18 = mysqli_fetch_assoc($select_letraaper18);

  $select_letrabper18 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper18 and letra = 'b'");

  $letrabper18 = mysqli_fetch_assoc($select_letrabper18);

  $select_letracper18 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper18 and letra = 'c'");

  $letracper18 = mysqli_fetch_assoc($select_letracper18);

  $select_letradper18 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper18 and letra = 'd'");

  $letradper18 = mysqli_fetch_assoc($select_letradper18);

  $select_letraeper18 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper18 and letra = 'e'");

  $letraeper18 = mysqli_fetch_assoc($select_letraeper18);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper18["correta"]==1){

  $alt_corr18 = "Letra A";

  $cora18 = $corcorr;
  $sima18 = " ✓";

  $corb18 = "black";
  $simb18 = "";

  $corc18 = "black";
  $simc18 = "";

  $cord18 = "black";
  $simd18 = "";

  $core18 = "black";
  $sime18 = "";

}

elseif ($letrabper18["correta"]==1){

  $alt_corr18 = "Letra B";

  $corb18 = $corcorr;
  $simb18 = " ✓";

  $cora18 = "black";
  $sima18 = "";

  $corc18 = "black";
  $simc18 = "";

  $cord18 = "black";
  $simd18 = "";

  $core18 = "black";
  $sime18 = "";

}

elseif ($letracper18["correta"]==1){

  $alt_corr18 = "Letra C";

  $corc18 = $corcorr;
  $simc18 = " ✓";

  $cora18 = "black";
  $sima18 = "";

  $corb18 = "black";
  $simb18 = "";

  $cord18 = "black";
  $simd18 = "";

  $core18 = "black";
  $sime18 = "";

}

elseif ($letradper18["correta"]==1){

  $alt_corr18 = "Letra D";

  $cord18 = $corcorr;
  $simd18 = " ✓";

  $cora18 = "black";
  $sima18 = "";

  $corc18 = "black";
  $simc18 = "";

  $corb18 = "black";
  $simb18 = "";

  $core18 = "black";
  $sime18 = "";

}

elseif ($letraeper18["correta"]==1){

  $alt_corr18 = "Letra E";

  $core18 = $corcorr;
  $sime18 = " ✓";

  $cora18 = "black";
  $sima18 = "";

  $corc18 = "black";
  $simc18 = "";

  $cord18 = "black";
  $simd18 = "";

  $corb18 = "black";
  $simb18 = "";

}

//Errada

if ($alt_corr18 != $_POST['radper18'] && $_POST['radper18'] == "Letra A"){

  $cora18 = $corerr;
  $sima18 = " X";

}

elseif ($alt_corr18 != $_POST['radper18'] && $_POST['radper18'] == "Letra B"){

  $corb18 = $corerr;
  $simb18 = " X";

}

elseif ($alt_corr18 != $_POST['radper18'] && $_POST['radper18'] == "Letra C"){

  $corc18 = $corerr;
  $simc18 = " X";

}

elseif ($alt_corr18 != $_POST['radper18'] && $_POST['radper18'] == "Letra D"){

  $cord18 = $corerr;
  $simd18 = " X";

}

elseif ($alt_corr18 != $_POST['radper18'] && $_POST['radper18'] == "Letra E"){

  $core18 = $corerr;
  $sime18 = " X";

}

  

  // Verficando qual será checado 18

  if ($_POST['radper18'] == "Letra A"){

    $chea18 = "Checked";

    $cheb18 = "";

    $chec18 = "";

    $ched18 = "";

    $chee18 = "";

  }elseif ($_POST['radper18'] == "Letra B"){

    $chea18 = "";

    $cheb18 = "Checked";

    $chec18 = "";

    $ched18 = "";

    $chee18 = "";

  }elseif ($_POST['radper18'] == "Letra C"){

    $chea18 = "";

    $cheb18 = "";

    $chec18 = "Checked";

    $ched18 = "";

    $chee18 = "";

  }elseif ($_POST['radper18'] == "Letra D"){

    $chea18 = "";

    $cheb18 = "";

    $chec18 = "";

    $ched18 = "Checked";

    $chee18 = "";

  }elseif ($_POST['radper18'] == "Letra E"){

    $chea18 = "";

    $cheb18 = "";

    $chec18 = "";

    $ched18 = "";

    $chee18 = "Checked";

  }

  

  // Verificando se respsota esta correta 18

  if ($_POST['radper18'] == $alt_corr18){

    $contrescorr = $contrescorr + 1;

    $cer_err18 = 1;

}

else{

  $cer_err18 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 18

if ($_POST['radper18'] == "Letra A"){

  $codigo_resposta18 = $letraaper18['codigo_resposta'];

}elseif ($_POST['radper18'] == "Letra B"){

  $codigo_resposta18 = $letrabper18['codigo_resposta'];

}elseif ($_POST['radper18'] == "Letra C"){

  $codigo_resposta18 = $letracper18['codigo_resposta'];

}elseif ($_POST['radper18'] == "Letra D"){

  $codigo_resposta18 = $letradper18['codigo_resposta'];

}elseif ($_POST['radper18'] == "Letra E"){

  $codigo_resposta18 = $letraeper18['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 18

$codigo_disciplina18 = $per18['codigo_disciplina'];

  

  // Selecionando imagem 18

  $imgper18 = $per18['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp18 = $letraaper18['tipo'];

  

  

  //Questão 19

  $codper19 = $_SESSION['codper19'];

  $select_per19 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper19");

  $per19 = mysqli_fetch_assoc($select_per19);

  

  $select_letraaper19 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper19 and letra = 'a'");

  $letraaper19 = mysqli_fetch_assoc($select_letraaper19);

  $select_letrabper19 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper19 and letra = 'b'");

  $letrabper19 = mysqli_fetch_assoc($select_letrabper19);

  $select_letracper19 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper19 and letra = 'c'");

  $letracper19 = mysqli_fetch_assoc($select_letracper19);

  $select_letradper19 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper19 and letra = 'd'");

  $letradper19 = mysqli_fetch_assoc($select_letradper19);

  $select_letraeper19 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper19 and letra = 'e'");

  $letraeper19 = mysqli_fetch_assoc($select_letraeper19);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper19["correta"]==1){

  $alt_corr19 = "Letra A";

  $cora19 = $corcorr;
  $sima19 = " ✓";

  $corb19 = "black";
  $simb19 = "";

  $corc19 = "black";
  $simc19 = "";

  $cord19 = "black";
  $simd19 = "";

  $core19 = "black";
  $sime19 = "";

}

elseif ($letrabper19["correta"]==1){

  $alt_corr19 = "Letra B";

  $corb19 = $corcorr;
  $simb19 = " ✓";

  $cora19 = "black";
  $sima19 = "";

  $corc19 = "black";
  $simc19 = "";

  $cord19 = "black";
  $simd19 = "";

  $core19 = "black";
  $sime19 = "";

}

elseif ($letracper19["correta"]==1){

  $alt_corr19 = "Letra C";

  $corc19 = $corcorr;
  $simc19 = " ✓";

  $cora19 = "black";
  $sima19 = "";

  $corb19 = "black";
  $simb19 = "";

  $cord19 = "black";
  $simd19 = "";

  $core19 = "black";
  $sime19 = "";

}

elseif ($letradper19["correta"]==1){

  $alt_corr19 = "Letra D";

  $cord19 = $corcorr;
  $simd19 = " ✓";

  $cora19 = "black";
  $sima19 = "";

  $corc19 = "black";
  $simc19 = "";

  $corb19 = "black";
  $simb19 = "";

  $core19 = "black";
  $sime19 = "";

}

elseif ($letraeper19["correta"]==1){

  $alt_corr19 = "Letra E";

  $core19 = $corcorr;
  $sime19 = " ✓";

  $cora19 = "black";
  $sima19 = "";

  $corc19 = "black";
  $simc19 = "";

  $cord19 = "black";
  $simd19 = "";

  $corb19 = "black";
  $simb19 = "";

}

//Errada

if ($alt_corr19 != $_POST['radper19'] && $_POST['radper19'] == "Letra A"){

  $cora19 = $corerr;
  $sima19 = " X";

}

elseif ($alt_corr19 != $_POST['radper19'] && $_POST['radper19'] == "Letra B"){

  $corb19 = $corerr;
  $simb19 = " X";

}

elseif ($alt_corr19 != $_POST['radper19'] && $_POST['radper19'] == "Letra C"){

  $corc19 = $corerr;
  $simc19 = " X";

}

elseif ($alt_corr19 != $_POST['radper19'] && $_POST['radper19'] == "Letra D"){

  $cord19 = $corerr;
  $simd19 = " X";

}

elseif ($alt_corr19 != $_POST['radper19'] && $_POST['radper19'] == "Letra E"){

  $core19 = $corerr;
  $sime19 = " X";

}

  

  // Verficando qual será checado 19

  if ($_POST['radper19'] == "Letra A"){

    $chea19 = "Checked";

    $cheb19 = "";

    $chec19 = "";

    $ched19 = "";

    $chee19 = "";

  }elseif ($_POST['radper19'] == "Letra B"){

    $chea19 = "";

    $cheb19 = "Checked";

    $chec19 = "";

    $ched19 = "";

    $chee19 = "";

  }elseif ($_POST['radper19'] == "Letra C"){

    $chea19 = "";

    $cheb19 = "";

    $chec19 = "Checked";

    $ched19 = "";

    $chee19 = "";

  }elseif ($_POST['radper19'] == "Letra D"){

    $chea19 = "";

    $cheb19 = "";

    $chec19 = "";

    $ched19 = "Checked";

    $chee19 = "";

  }elseif ($_POST['radper19'] == "Letra E"){

    $chea19 = "";

    $cheb19 = "";

    $chec19 = "";

    $ched19 = "";

    $chee19 = "Checked";

  }

  

  // Verificando se respsota esta correta 19

  if ($_POST['radper19'] == $alt_corr19){

    $contrescorr = $contrescorr + 1;

    $cer_err19 = 1;

}

else{

  $cer_err19 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 19

if ($_POST['radper19'] == "Letra A"){

  $codigo_resposta19 = $letraaper19['codigo_resposta'];

}elseif ($_POST['radper19'] == "Letra B"){

  $codigo_resposta19 = $letrabper19['codigo_resposta'];

}elseif ($_POST['radper19'] == "Letra C"){

  $codigo_resposta19 = $letracper19['codigo_resposta'];

}elseif ($_POST['radper19'] == "Letra D"){

  $codigo_resposta19 = $letradper19['codigo_resposta'];

}elseif ($_POST['radper19'] == "Letra E"){

  $codigo_resposta19 = $letraeper19['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 19

$codigo_disciplina19 = $per19['codigo_disciplina'];

  

  // Selecionando imagem 19

  $imgper19 = $per19['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp19 = $letraaper19['tipo'];

  

  

  //Questão 20

  $codper20 = $_SESSION['codper20'];

  $select_per20 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper20");

  $per20 = mysqli_fetch_assoc($select_per20);

  

  $select_letraaper20 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper20 and letra = 'a'");

  $letraaper20 = mysqli_fetch_assoc($select_letraaper20);

  $select_letrabper20 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper20 and letra = 'b'");

  $letrabper20 = mysqli_fetch_assoc($select_letrabper20);

  $select_letracper20 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper20 and letra = 'c'");

  $letracper20 = mysqli_fetch_assoc($select_letracper20);

  $select_letradper20 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper20 and letra = 'd'");

  $letradper20 = mysqli_fetch_assoc($select_letradper20);

  $select_letraeper20 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper20 and letra = 'e'");

  $letraeper20 = mysqli_fetch_assoc($select_letraeper20);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper20["correta"]==1){

  $alt_corr20 = "Letra A";

  $cora20 = $corcorr;
  $sima20 = " ✓";

  $corb20 = "black";
  $simb20 = "";

  $corc20 = "black";
  $simc20 = "";

  $cord20 = "black";
  $simd20 = "";

  $core20 = "black";
  $sime20 = "";

}

elseif ($letrabper20["correta"]==1){

  $alt_corr20 = "Letra B";

  $corb20 = $corcorr;
  $simb20 = " ✓";

  $cora20 = "black";
  $sima20 = "";

  $corc20 = "black";
  $simc20 = "";

  $cord20 = "black";
  $simd20 = "";

  $core20 = "black";
  $sime20 = "";

}

elseif ($letracper20["correta"]==1){

  $alt_corr20 = "Letra C";

  $corc20 = $corcorr;
  $simc20 = " ✓";

  $cora20 = "black";
  $sima20 = "";

  $corb20 = "black";
  $simb20 = "";

  $cord20 = "black";
  $simd20 = "";

  $core20 = "black";
  $sime20 = "";

}

elseif ($letradper20["correta"]==1){

  $alt_corr20 = "Letra D";

  $cord20 = $corcorr;
  $simd20 = " ✓";

  $cora20 = "black";
  $sima20 = "";

  $corc20 = "black";
  $simc20 = "";

  $corb20 = "black";
  $simb20 = "";

  $core20 = "black";
  $sime20 = "";

}

elseif ($letraeper20["correta"]==1){

  $alt_corr20 = "Letra E";

  $core20 = $corcorr;
  $sime20 = " ✓";

  $cora20 = "black";
  $sima20 = "";

  $corc20 = "black";
  $simc20 = "";

  $cord20 = "black";
  $simd20 = "";

  $corb20 = "black";
  $simb20 = "";

}

//Errada

if ($alt_corr20 != $_POST['radper20'] && $_POST['radper20'] == "Letra A"){

  $cora20 = $corerr;
  $sima20 = " X";

}

elseif ($alt_corr20 != $_POST['radper20'] && $_POST['radper20'] == "Letra B"){

  $corb20 = $corerr;
  $simb20 = " X";

}

elseif ($alt_corr20 != $_POST['radper20'] && $_POST['radper20'] == "Letra C"){

  $corc20 = $corerr;
  $simc20 = " X";

}

elseif ($alt_corr20 != $_POST['radper20'] && $_POST['radper20'] == "Letra D"){

  $cord20 = $corerr;
  $simd20 = " X";

}

elseif ($alt_corr20 != $_POST['radper20'] && $_POST['radper20'] == "Letra E"){

  $core20 = $corerr;
  $sime20 = " X";

}

  

  // Verficando qual será checado 20

  if ($_POST['radper20'] == "Letra A"){

    $chea20 = "Checked";

    $cheb20 = "";

    $chec20 = "";

    $ched20 = "";

    $chee20 = "";

  }elseif ($_POST['radper20'] == "Letra B"){

    $chea20 = "";

    $cheb20 = "Checked";

    $chec20 = "";

    $ched20 = "";

    $chee20 = "";

  }elseif ($_POST['radper20'] == "Letra C"){

    $chea20 = "";

    $cheb20 = "";

    $chec20 = "Checked";

    $ched20 = "";

    $chee20 = "";

  }elseif ($_POST['radper20'] == "Letra D"){

    $chea20 = "";

    $cheb20 = "";

    $chec20 = "";

    $ched20 = "Checked";

    $chee20 = "";

  }elseif ($_POST['radper20'] == "Letra E"){

    $chea20 = "";

    $cheb20 = "";

    $chec20 = "";

    $ched20 = "";

    $chee20 = "Checked";

  }

  

  // Verificando se respsota esta correta 20

  if ($_POST['radper20'] == $alt_corr20){

    $contrescorr = $contrescorr + 1;

    $cer_err20 = 1;

}

else{

  $cer_err20 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 20

if ($_POST['radper20'] == "Letra A"){

  $codigo_resposta20 = $letraaper20['codigo_resposta'];

}elseif ($_POST['radper20'] == "Letra B"){

  $codigo_resposta20 = $letrabper20['codigo_resposta'];

}elseif ($_POST['radper20'] == "Letra C"){

  $codigo_resposta20 = $letracper20['codigo_resposta'];

}elseif ($_POST['radper20'] == "Letra D"){

  $codigo_resposta20 = $letradper20['codigo_resposta'];

}elseif ($_POST['radper20'] == "Letra E"){

  $codigo_resposta20 = $letraeper20['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 20

$codigo_disciplina20 = $per20['codigo_disciplina'];

  

  // Selecionando imagem 20

  $imgper20 = $per20['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp20 = $letraaper20['tipo'];

  

  }





  // Verificando se existe perguntas de 21 à 25

if ($qtperguntas>20){



  //Questão 21

  $codper21 = $_SESSION['codper21'];

  $select_per21 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper21");

  $per21 = mysqli_fetch_assoc($select_per21);

  

  $select_letraaper21 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper21 and letra = 'a'");

  $letraaper21 = mysqli_fetch_assoc($select_letraaper21);

  $select_letrabper21 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper21 and letra = 'b'");

  $letrabper21 = mysqli_fetch_assoc($select_letrabper21);

  $select_letracper21 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper21 and letra = 'c'");

  $letracper21 = mysqli_fetch_assoc($select_letracper21);

  $select_letradper21 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper21 and letra = 'd'");

  $letradper21 = mysqli_fetch_assoc($select_letradper21);

  $select_letraeper21 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper21 and letra = 'e'");

  $letraeper21 = mysqli_fetch_assoc($select_letraeper21);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper21["correta"]==1){

  $alt_corr21 = "Letra A";

  $cora21 = $corcorr;
  $sima21 = " ✓";

  $corb21 = "black";
  $simb21 = "";

  $corc21 = "black";
  $simc21 = "";

  $cord21 = "black";
  $simd21 = "";

  $core21 = "black";
  $sime21 = "";

}

elseif ($letrabper21["correta"]==1){

  $alt_corr21 = "Letra B";

  $corb21 = $corcorr;
  $simb21 = " ✓";

  $cora21 = "black";
  $sima21 = "";

  $corc21 = "black";
  $simc21 = "";

  $cord21 = "black";
  $simd21 = "";

  $core21 = "black";
  $sime21 = "";

}

elseif ($letracper21["correta"]==1){

  $alt_corr21 = "Letra C";

  $corc21 = $corcorr;
  $simc21 = " ✓";

  $cora21 = "black";
  $sima21 = "";

  $corb21 = "black";
  $simb21 = "";

  $cord21 = "black";
  $simd21 = "";

  $core21 = "black";
  $sime21 = "";

}

elseif ($letradper21["correta"]==1){

  $alt_corr21 = "Letra D";

  $cord21 = $corcorr;
  $simd21 = " ✓";

  $cora21 = "black";
  $sima21 = "";

  $corc21 = "black";
  $simc21 = "";

  $corb21 = "black";
  $simb21 = "";

  $core21 = "black";
  $sime21 = "";

}

elseif ($letraeper21["correta"]==1){

  $alt_corr21 = "Letra E";

  $core21 = $corcorr;
  $sime21 = " ✓";

  $cora21 = "black";
  $sima21 = "";

  $corc21 = "black";
  $simc21 = "";

  $cord21 = "black";
  $simd21 = "";

  $corb21 = "black";
  $simb21 = "";

}

//Errada

if ($alt_corr21 != $_POST['radper21'] && $_POST['radper21'] == "Letra A"){

  $cora21 = $corerr;
  $sima21 = " X";

}

elseif ($alt_corr21 != $_POST['radper21'] && $_POST['radper21'] == "Letra B"){

  $corb21 = $corerr;
  $simb21 = " X";

}

elseif ($alt_corr21 != $_POST['radper21'] && $_POST['radper21'] == "Letra C"){

  $corc21 = $corerr;
  $simc21 = " X";

}

elseif ($alt_corr21 != $_POST['radper21'] && $_POST['radper21'] == "Letra D"){

  $cord21 = $corerr;
  $simd21 = " X";

}

elseif ($alt_corr21 != $_POST['radper21'] && $_POST['radper21'] == "Letra E"){

  $core21 = $corerr;
  $sime21 = " X";

}

  

  // Verficando qual será checado 21

  if ($_POST['radper21'] == "Letra A"){

    $chea21 = "Checked";

    $cheb21 = "";

    $chec21 = "";

    $ched21 = "";

    $chee21 = "";

  }elseif ($_POST['radper21'] == "Letra B"){

    $chea21 = "";

    $cheb21 = "Checked";

    $chec21 = "";

    $ched21 = "";

    $chee21 = "";

  }elseif ($_POST['radper21'] == "Letra C"){

    $chea21 = "";

    $cheb21 = "";

    $chec21 = "Checked";

    $ched21 = "";

    $chee21 = "";

  }elseif ($_POST['radper21'] == "Letra D"){

    $chea21 = "";

    $cheb21 = "";

    $chec21 = "";

    $ched21 = "Checked";

    $chee21 = "";

  }elseif ($_POST['radper21'] == "Letra E"){

    $chea21 = "";

    $cheb21 = "";

    $chec21 = "";

    $ched21 = "";

    $chee21 = "Checked";

  }

  

  // Verificando se respsota esta correta 21

  if ($_POST['radper21'] == $alt_corr21){

    $contrescorr = $contrescorr + 1;

    $cer_err21 = 1;

}

else{

  $cer_err21 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 21

if ($_POST['radper21'] == "Letra A"){

  $codigo_resposta21 = $letraaper21['codigo_resposta'];

}elseif ($_POST['radper21'] == "Letra B"){

  $codigo_resposta21 = $letrabper21['codigo_resposta'];

}elseif ($_POST['radper21'] == "Letra C"){

  $codigo_resposta21 = $letracper21['codigo_resposta'];

}elseif ($_POST['radper21'] == "Letra D"){

  $codigo_resposta21 = $letradper21['codigo_resposta'];

}elseif ($_POST['radper21'] == "Letra E"){

  $codigo_resposta21 = $letraeper21['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 21

$codigo_disciplina21 = $per21['codigo_disciplina'];



  // Selecionando imagem 21

  $imgper21 = $per21['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp21 = $letraaper21['tipo'];

  

  

  //Questão 22

  $codper22 = $_SESSION['codper22'];

  $select_per22 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper22");

  $per22 = mysqli_fetch_assoc($select_per22);

  

  $select_letraaper22 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper22 and letra = 'a'");

  $letraaper22 = mysqli_fetch_assoc($select_letraaper22);

  $select_letrabper22 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper22 and letra = 'b'");

  $letrabper22 = mysqli_fetch_assoc($select_letrabper22);

  $select_letracper22 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper22 and letra = 'c'");

  $letracper22 = mysqli_fetch_assoc($select_letracper22);

  $select_letradper22 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper22 and letra = 'd'");

  $letradper22 = mysqli_fetch_assoc($select_letradper22);

  $select_letraeper22 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper22 and letra = 'e'");

  $letraeper22 = mysqli_fetch_assoc($select_letraeper22);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper22["correta"]==1){

  $alt_corr22 = "Letra A";

  $cora22 = $corcorr;
  $sima22 = " ✓";

  $corb22 = "black";
  $simb22 = "";

  $corc22 = "black";
  $simc22 = "";

  $cord22 = "black";
  $simd22 = "";

  $core22 = "black";
  $sime22 = "";

}

elseif ($letrabper22["correta"]==1){

  $alt_corr22 = "Letra B";

  $corb22 = $corcorr;
  $simb22 = " ✓";

  $cora22 = "black";
  $sima22 = "";

  $corc22 = "black";
  $simc22 = "";

  $cord22 = "black";
  $simd22 = "";

  $core22 = "black";
  $sime22 = "";

}

elseif ($letracper22["correta"]==1){

  $alt_corr22 = "Letra C";

  $corc22 = $corcorr;
  $simc22 = " ✓";

  $cora22 = "black";
  $sima22 = "";

  $corb22 = "black";
  $simb22 = "";

  $cord22 = "black";
  $simd22 = "";

  $core22 = "black";
  $sime22 = "";

}

elseif ($letradper22["correta"]==1){

  $alt_corr22 = "Letra D";

  $cord22 = $corcorr;
  $simd22 = " ✓";

  $cora22 = "black";
  $sima22 = "";

  $corc22 = "black";
  $simc22 = "";

  $corb22 = "black";
  $simb22 = "";

  $core22 = "black";
  $sime22 = "";

}

elseif ($letraeper22["correta"]==1){

  $alt_corr22 = "Letra E";

  $core22 = $corcorr;
  $sime22 = " ✓";

  $cora22 = "black";
  $sima22 = "";

  $corc22 = "black";
  $simc22 = "";

  $cord22 = "black";
  $simd22 = "";

  $corb22 = "black";
  $simb22 = "";

}

//Errada

if ($alt_corr22 != $_POST['radper22'] && $_POST['radper22'] == "Letra A"){

  $cora22 = $corerr;
  $sima22 = " X";

}

elseif ($alt_corr22 != $_POST['radper22'] && $_POST['radper22'] == "Letra B"){

  $corb22 = $corerr;
  $simb22 = " X";

}

elseif ($alt_corr22 != $_POST['radper22'] && $_POST['radper22'] == "Letra C"){

  $corc22 = $corerr;
  $simc22 = " X";

}

elseif ($alt_corr22 != $_POST['radper22'] && $_POST['radper22'] == "Letra D"){

  $cord22 = $corerr;
  $simd22 = " X";

}

elseif ($alt_corr22 != $_POST['radper22'] && $_POST['radper22'] == "Letra E"){

  $core22 = $corerr;
  $sime22 = " X";

}

  

  // Verficando qual será checado 22

  if ($_POST['radper22'] == "Letra A"){

    $chea22 = "Checked";

    $cheb22 = "";

    $chec22 = "";

    $ched22 = "";

    $chee22 = "";

  }elseif ($_POST['radper22'] == "Letra B"){

    $chea22 = "";

    $cheb22 = "Checked";

    $chec22 = "";

    $ched22 = "";

    $chee22 = "";

  }elseif ($_POST['radper22'] == "Letra C"){

    $chea22 = "";

    $cheb22 = "";

    $chec22 = "Checked";

    $ched22 = "";

    $chee22 = "";

  }elseif ($_POST['radper22'] == "Letra D"){

    $chea22 = "";

    $cheb22 = "";

    $chec22 = "";

    $ched22 = "Checked";

    $chee22 = "";

  }elseif ($_POST['radper22'] == "Letra E"){

    $chea22 = "";

    $cheb22 = "";

    $chec22 = "";

    $ched22 = "";

    $chee22 = "Checked";

  }

  

  // Verificando se respsota esta correta 22

  if ($_POST['radper22'] == $alt_corr22){

    $contrescorr = $contrescorr + 1;

    $cer_err22 = 1;

}

else{

  $cer_err22 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 22

if ($_POST['radper22'] == "Letra A"){

  $codigo_resposta22 = $letraaper22['codigo_resposta'];

}elseif ($_POST['radper22'] == "Letra B"){

  $codigo_resposta22 = $letrabper22['codigo_resposta'];

}elseif ($_POST['radper22'] == "Letra C"){

  $codigo_resposta22 = $letracper22['codigo_resposta'];

}elseif ($_POST['radper22'] == "Letra D"){

  $codigo_resposta22 = $letradper22['codigo_resposta'];

}elseif ($_POST['radper22'] == "Letra E"){

  $codigo_resposta22 = $letraeper22['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 22

$codigo_disciplina22 = $per22['codigo_disciplina'];

  

  // Selecionando imagem 22

  $imgper22 = $per22['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp22 = $letraaper22['tipo'];

  

  

  //Questão 23

  $codper23 = $_SESSION['codper23'];

  $select_per23 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper23");

  $per23 = mysqli_fetch_assoc($select_per23);

  

  $select_letraaper23 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper23 and letra = 'a'");

  $letraaper23 = mysqli_fetch_assoc($select_letraaper23);

  $select_letrabper23 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper23 and letra = 'b'");

  $letrabper23 = mysqli_fetch_assoc($select_letrabper23);

  $select_letracper23 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper23 and letra = 'c'");

  $letracper23 = mysqli_fetch_assoc($select_letracper23);

  $select_letradper23 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper23 and letra = 'd'");

  $letradper23 = mysqli_fetch_assoc($select_letradper23);

  $select_letraeper23 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper23 and letra = 'e'");

  $letraeper23 = mysqli_fetch_assoc($select_letraeper23);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper23["correta"]==1){

  $alt_corr23 = "Letra A";

  $cora23 = $corcorr;
  $sima23 = " ✓";

  $corb23 = "black";
  $simb23 = "";

  $corc23 = "black";
  $simc23 = "";

  $cord23 = "black";
  $simd23 = "";

  $core23 = "black";
  $sime23 = "";

}

elseif ($letrabper23["correta"]==1){

  $alt_corr23 = "Letra B";

  $corb23 = $corcorr;
  $simb23 = " ✓";

  $cora23 = "black";
  $sima23 = "";

  $corc23 = "black";
  $simc23 = "";

  $cord23 = "black";
  $simd23 = "";

  $core23 = "black";
  $sime23 = "";

}

elseif ($letracper23["correta"]==1){

  $alt_corr23 = "Letra C";

  $corc23 = $corcorr;
  $simc23 = " ✓";

  $cora23 = "black";
  $sima23 = "";

  $corb23 = "black";
  $simb23 = "";

  $cord23 = "black";
  $simd23 = "";

  $core23 = "black";
  $sime23 = "";

}

elseif ($letradper23["correta"]==1){

  $alt_corr23 = "Letra D";

  $cord23 = $corcorr;
  $simd23 = " ✓";

  $cora23 = "black";
  $sima23 = "";

  $corc23 = "black";
  $simc23 = "";

  $corb23 = "black";
  $simb23 = "";

  $core23 = "black";
  $sime23 = "";

}

elseif ($letraeper23["correta"]==1){

  $alt_corr23 = "Letra E";

  $core23 = $corcorr;
  $sime23 = " ✓";

  $cora23 = "black";
  $sima23 = "";

  $corc23 = "black";
  $simc23 = "";

  $cord23 = "black";
  $simd23 = "";

  $corb23 = "black";
  $simb23 = "";

}

//Errada

if ($alt_corr23 != $_POST['radper23'] && $_POST['radper23'] == "Letra A"){

  $cora23 = $corerr;
  $sima23 = " X";

}

elseif ($alt_corr23 != $_POST['radper23'] && $_POST['radper23'] == "Letra B"){

  $corb23 = $corerr;
  $simb23 = " X";

}

elseif ($alt_corr23 != $_POST['radper23'] && $_POST['radper23'] == "Letra C"){

  $corc23 = $corerr;
  $simc23 = " X";

}

elseif ($alt_corr23 != $_POST['radper23'] && $_POST['radper23'] == "Letra D"){

  $cord23 = $corerr;
  $simd23 = " X";

}

elseif ($alt_corr23 != $_POST['radper23'] && $_POST['radper23'] == "Letra E"){

  $core23 = $corerr;
  $sime23 = " X";

}

  

  // Verficando qual será checado 23

  if ($_POST['radper23'] == "Letra A"){

    $chea23 = "Checked";

    $cheb23 = "";

    $chec23 = "";

    $ched23 = "";

    $chee23 = "";

  }elseif ($_POST['radper23'] == "Letra B"){

    $chea23 = "";

    $cheb23 = "Checked";

    $chec23 = "";

    $ched23 = "";

    $chee23 = "";

  }elseif ($_POST['radper23'] == "Letra C"){

    $chea23 = "";

    $cheb23 = "";

    $chec23 = "Checked";

    $ched23 = "";

    $chee23 = "";

  }elseif ($_POST['radper23'] == "Letra D"){

    $chea23 = "";

    $cheb23 = "";

    $chec23 = "";

    $ched23 = "Checked";

    $chee23 = "";

  }elseif ($_POST['radper23'] == "Letra E"){

    $chea23 = "";

    $cheb23 = "";

    $chec23 = "";

    $ched23 = "";

    $chee23 = "Checked";

  }

  

  // Verificando se respsota esta correta 23

  if ($_POST['radper23'] == $alt_corr23){

    $contrescorr = $contrescorr + 1;

    $cer_err23 = 1;

}

else{

  $cer_err23 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 23

if ($_POST['radper23'] == "Letra A"){

  $codigo_resposta23 = $letraaper23['codigo_resposta'];

}elseif ($_POST['radper23'] == "Letra B"){

  $codigo_resposta23 = $letrabper23['codigo_resposta'];

}elseif ($_POST['radper23'] == "Letra C"){

  $codigo_resposta23 = $letracper23['codigo_resposta'];

}elseif ($_POST['radper23'] == "Letra D"){

  $codigo_resposta23 = $letradper23['codigo_resposta'];

}elseif ($_POST['radper23'] == "Letra E"){

  $codigo_resposta23 = $letraeper23['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 23

$codigo_disciplina23 = $per23['codigo_disciplina'];

  

  // Selecionando imagem 23

  $imgper23 = $per23['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp23 = $letraaper23['tipo'];

  

  

  //Questão 24

  $codper24 = $_SESSION['codper24'];

  $select_per24 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper24");

  $per24 = mysqli_fetch_assoc($select_per24);

  

  $select_letraaper24 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper24 and letra = 'a'");

  $letraaper24 = mysqli_fetch_assoc($select_letraaper24);

  $select_letrabper24 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper24 and letra = 'b'");

  $letrabper24 = mysqli_fetch_assoc($select_letrabper24);

  $select_letracper24 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper24 and letra = 'c'");

  $letracper24 = mysqli_fetch_assoc($select_letracper24);

  $select_letradper24 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper24 and letra = 'd'");

  $letradper24 = mysqli_fetch_assoc($select_letradper24);

  $select_letraeper24 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper24 and letra = 'e'");

  $letraeper24 = mysqli_fetch_assoc($select_letraeper24);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper24["correta"]==1){

  $alt_corr24 = "Letra A";

  $cora24 = $corcorr;
  $sima24 = " ✓";

  $corb24 = "black";
  $simb24 = "";

  $corc24 = "black";
  $simc24 = "";

  $cord24 = "black";
  $simd24 = "";

  $core24 = "black";
  $sime24 = "";

}

elseif ($letrabper24["correta"]==1){

  $alt_corr24 = "Letra B";

  $corb24 = $corcorr;
  $simb24 = " ✓";

  $cora24 = "black";
  $sima24 = "";

  $corc24 = "black";
  $simc24 = "";

  $cord24 = "black";
  $simd24 = "";

  $core24 = "black";
  $sime24 = "";

}

elseif ($letracper24["correta"]==1){

  $alt_corr24 = "Letra C";

  $corc24 = $corcorr;
  $simc24 = " ✓";

  $cora24 = "black";
  $sima24 = "";

  $corb24 = "black";
  $simb24 = "";

  $cord24 = "black";
  $simd24 = "";

  $core24 = "black";
  $sime24 = "";

}

elseif ($letradper24["correta"]==1){

  $alt_corr24 = "Letra D";

  $cord24 = $corcorr;
  $simd24 = " ✓";

  $cora24 = "black";
  $sima24 = "";

  $corc24 = "black";
  $simc24 = "";

  $corb24 = "black";
  $simb24 = "";

  $core24 = "black";
  $sime24 = "";

}

elseif ($letraeper24["correta"]==1){

  $alt_corr24 = "Letra E";

  $core24 = $corcorr;
  $sime24 = " ✓";

  $cora24 = "black";
  $sima24 = "";

  $corc24 = "black";
  $simc24 = "";

  $cord24 = "black";
  $simd24 = "";

  $corb24 = "black";
  $simb24 = "";

}

//Errada

if ($alt_corr24 != $_POST['radper24'] && $_POST['radper24'] == "Letra A"){

  $cora24 = $corerr;
  $sima24 = " X";

}

elseif ($alt_corr24 != $_POST['radper24'] && $_POST['radper24'] == "Letra B"){

  $corb24 = $corerr;
  $simb24 = " X";

}

elseif ($alt_corr24 != $_POST['radper24'] && $_POST['radper24'] == "Letra C"){

  $corc24 = $corerr;
  $simc24 = " X";

}

elseif ($alt_corr24 != $_POST['radper24'] && $_POST['radper24'] == "Letra D"){

  $cord24 = $corerr;
  $simd24 = " X";

}

elseif ($alt_corr24 != $_POST['radper24'] && $_POST['radper24'] == "Letra E"){

  $core24 = $corerr;
  $sime24 = " X";

}

  

  // Verficando qual será checado 24

  if ($_POST['radper24'] == "Letra A"){

    $chea24 = "Checked";

    $cheb24 = "";

    $chec24 = "";

    $ched24 = "";

    $chee24 = "";

  }elseif ($_POST['radper24'] == "Letra B"){

    $chea24 = "";

    $cheb24 = "Checked";

    $chec24 = "";

    $ched24 = "";

    $chee24 = "";

  }elseif ($_POST['radper24'] == "Letra C"){

    $chea24 = "";

    $cheb24 = "";

    $chec24 = "Checked";

    $ched24 = "";

    $chee24 = "";

  }elseif ($_POST['radper24'] == "Letra D"){

    $chea24 = "";

    $cheb24 = "";

    $chec24 = "";

    $ched24 = "Checked";

    $chee24 = "";

  }elseif ($_POST['radper24'] == "Letra E"){

    $chea24 = "";

    $cheb24 = "";

    $chec24 = "";

    $ched24 = "";

    $chee24 = "Checked";

  }

  

  // Verificando se respsota esta correta 24

  if ($_POST['radper24'] == $alt_corr24){

    $contrescorr = $contrescorr + 1;

    $cer_err24 = 1;

}

else{

  $cer_err24 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 24

if ($_POST['radper24'] == "Letra A"){

  $codigo_resposta24 = $letraaper24['codigo_resposta'];

}elseif ($_POST['radper24'] == "Letra B"){

  $codigo_resposta24 = $letrabper24['codigo_resposta'];

}elseif ($_POST['radper24'] == "Letra C"){

  $codigo_resposta24 = $letracper24['codigo_resposta'];

}elseif ($_POST['radper24'] == "Letra D"){

  $codigo_resposta24 = $letradper24['codigo_resposta'];

}elseif ($_POST['radper24'] == "Letra E"){

  $codigo_resposta24 = $letraeper24['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 24

$codigo_disciplina24 = $per24['codigo_disciplina'];



  // Selecionando imagem 24

  $imgper24 = $per24['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp24 = $letraaper24['tipo'];

  

  

  //Questão 25

  $codper25 = $_SESSION['codper25'];

  $select_per25 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper25");

  $per25 = mysqli_fetch_assoc($select_per25);

  

  $select_letraaper25 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper25 and letra = 'a'");

  $letraaper25 = mysqli_fetch_assoc($select_letraaper25);

  $select_letrabper25 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper25 and letra = 'b'");

  $letrabper25 = mysqli_fetch_assoc($select_letrabper25);

  $select_letracper25 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper25 and letra = 'c'");

  $letracper25 = mysqli_fetch_assoc($select_letracper25);

  $select_letradper25 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper25 and letra = 'd'");

  $letradper25 = mysqli_fetch_assoc($select_letradper25);

  $select_letraeper25 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper25 and letra = 'e'");

  $letraeper25 = mysqli_fetch_assoc($select_letraeper25);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper25["correta"]==1){

  $alt_corr25 = "Letra A";

  $cora25 = $corcorr;
  $sima25 = " ✓";

  $corb25 = "black";
  $simb25 = "";

  $corc25 = "black";
  $simc25 = "";

  $cord25 = "black";
  $simd25 = "";

  $core25 = "black";
  $sime25 = "";

}

elseif ($letrabper25["correta"]==1){

  $alt_corr25 = "Letra B";

  $corb25 = $corcorr;
  $simb25 = " ✓";

  $cora25 = "black";
  $sima25 = "";

  $corc25 = "black";
  $simc25 = "";

  $cord25 = "black";
  $simd25 = "";

  $core25 = "black";
  $sime25 = "";

}

elseif ($letracper25["correta"]==1){

  $alt_corr25 = "Letra C";

  $corc25 = $corcorr;
  $simc25 = " ✓";

  $cora25 = "black";
  $sima25 = "";

  $corb25 = "black";
  $simb25 = "";

  $cord25 = "black";
  $simd25 = "";

  $core25 = "black";
  $sime25 = "";

}

elseif ($letradper25["correta"]==1){

  $alt_corr25 = "Letra D";

  $cord25 = $corcorr;
  $simd25 = " ✓";

  $cora25 = "black";
  $sima25 = "";

  $corc25 = "black";
  $simc25 = "";

  $corb25 = "black";
  $simb25 = "";

  $core25 = "black";
  $sime25 = "";

}

elseif ($letraeper25["correta"]==1){

  $alt_corr25 = "Letra E";

  $core25 = $corcorr;
  $sime25 = " ✓";

  $cora25 = "black";
  $sima25 = "";

  $corc25 = "black";
  $simc25 = "";

  $cord25 = "black";
  $simd25 = "";

  $corb25 = "black";
  $simb25 = "";

}

//Errada

if ($alt_corr25 != $_POST['radper25'] && $_POST['radper25'] == "Letra A"){

  $cora25 = $corerr;
  $sima25 = " X";

}

elseif ($alt_corr25 != $_POST['radper25'] && $_POST['radper25'] == "Letra B"){

  $corb25 = $corerr;
  $simb25 = " X";

}

elseif ($alt_corr25 != $_POST['radper25'] && $_POST['radper25'] == "Letra C"){

  $corc25 = $corerr;
  $simc25 = " X";

}

elseif ($alt_corr25 != $_POST['radper25'] && $_POST['radper25'] == "Letra D"){

  $cord25 = $corerr;
  $simd25 = " X";

}

elseif ($alt_corr25 != $_POST['radper25'] && $_POST['radper25'] == "Letra E"){

  $core25 = $corerr;
  $sime25 = " X";

}

  

  // Verficando qual será checado 25

  if ($_POST['radper25'] == "Letra A"){

    $chea25 = "Checked";

    $cheb25 = "";

    $chec25 = "";

    $ched25 = "";

    $chee25 = "";

  }elseif ($_POST['radper25'] == "Letra B"){

    $chea25 = "";

    $cheb25 = "Checked";

    $chec25 = "";

    $ched25 = "";

    $chee25 = "";

  }elseif ($_POST['radper25'] == "Letra C"){

    $chea25 = "";

    $cheb25 = "";

    $chec25 = "Checked";

    $ched25 = "";

    $chee25 = "";

  }elseif ($_POST['radper25'] == "Letra D"){

    $chea25 = "";

    $cheb25 = "";

    $chec25 = "";

    $ched25 = "Checked";

    $chee25 = "";

  }elseif ($_POST['radper25'] == "Letra E"){

    $chea25 = "";

    $cheb25 = "";

    $chec25 = "";

    $ched25 = "";

    $chee25 = "Checked";

  }

  

  // Verificando se respsota esta correta 25

  if ($_POST['radper25'] == $alt_corr25){

    $contrescorr = $contrescorr + 1;

    $cer_err25 = 1;

}

else{

  $cer_err25 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 25

if ($_POST['radper25'] == "Letra A"){

  $codigo_resposta25 = $letraaper25['codigo_resposta'];

}elseif ($_POST['radper25'] == "Letra B"){

  $codigo_resposta25 = $letrabper25['codigo_resposta'];

}elseif ($_POST['radper25'] == "Letra C"){

  $codigo_resposta25 = $letracper25['codigo_resposta'];

}elseif ($_POST['radper25'] == "Letra D"){

  $codigo_resposta25 = $letradper25['codigo_resposta'];

}elseif ($_POST['radper25'] == "Letra E"){

  $codigo_resposta25 = $letraeper25['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 25

$codigo_disciplina25 = $per25['codigo_disciplina'];

  

  // Selecionando imagem 25

  $imgper25 = $per25['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp25 = $letraaper25['tipo'];

  

  }





  // Verificando se existe perguntas de 26 à 30

if ($qtperguntas>25){



  //Questão 26

  $codper26 = $_SESSION['codper26'];

  $select_per26 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper26");

  $per26 = mysqli_fetch_assoc($select_per26);

  

  $select_letraaper26 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper26 and letra = 'a'");

  $letraaper26 = mysqli_fetch_assoc($select_letraaper26);

  $select_letrabper26 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper26 and letra = 'b'");

  $letrabper26 = mysqli_fetch_assoc($select_letrabper26);

  $select_letracper26 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper26 and letra = 'c'");

  $letracper26 = mysqli_fetch_assoc($select_letracper26);

  $select_letradper26 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper26 and letra = 'd'");

  $letradper26 = mysqli_fetch_assoc($select_letradper26);

  $select_letraeper26 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper26 and letra = 'e'");

  $letraeper26 = mysqli_fetch_assoc($select_letraeper26);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper26["correta"]==1){

  $alt_corr26 = "Letra A";

  $cora26 = $corcorr;
  $sima26 = " ✓";

  $corb26 = "black";
  $simb26 = "";

  $corc26 = "black";
  $simc26 = "";

  $cord26 = "black";
  $simd26 = "";

  $core26 = "black";
  $sime26 = "";

}

elseif ($letrabper26["correta"]==1){

  $alt_corr26 = "Letra B";

  $corb26 = $corcorr;
  $simb26 = " ✓";

  $cora26 = "black";
  $sima26 = "";

  $corc26 = "black";
  $simc26 = "";

  $cord26 = "black";
  $simd26 = "";

  $core26 = "black";
  $sime26 = "";

}

elseif ($letracper26["correta"]==1){

  $alt_corr26 = "Letra C";

  $corc26 = $corcorr;
  $simc26 = " ✓";

  $cora26 = "black";
  $sima26 = "";

  $corb26 = "black";
  $simb26 = "";

  $cord26 = "black";
  $simd26 = "";

  $core26 = "black";
  $sime26 = "";

}

elseif ($letradper26["correta"]==1){

  $alt_corr26 = "Letra D";

  $cord26 = $corcorr;
  $simd26 = " ✓";

  $cora26 = "black";
  $sima26 = "";

  $corc26 = "black";
  $simc26 = "";

  $corb26 = "black";
  $simb26 = "";

  $core26 = "black";
  $sime26 = "";

}

elseif ($letraeper26["correta"]==1){

  $alt_corr26 = "Letra E";

  $core26 = $corcorr;
  $sime26 = " ✓";

  $cora26 = "black";
  $sima26 = "";

  $corc26 = "black";
  $simc26 = "";

  $cord26 = "black";
  $simd26 = "";

  $corb26 = "black";
  $simb26 = "";

}

//Errada

if ($alt_corr26 != $_POST['radper26'] && $_POST['radper26'] == "Letra A"){

  $cora26 = $corerr;
  $sima26 = " X";

}

elseif ($alt_corr26 != $_POST['radper26'] && $_POST['radper26'] == "Letra B"){

  $corb26 = $corerr;
  $simb26 = " X";

}

elseif ($alt_corr26 != $_POST['radper26'] && $_POST['radper26'] == "Letra C"){

  $corc26 = $corerr;
  $simc26 = " X";

}

elseif ($alt_corr26 != $_POST['radper26'] && $_POST['radper26'] == "Letra D"){

  $cord26 = $corerr;
  $simd26 = " X";

}

elseif ($alt_corr26 != $_POST['radper26'] && $_POST['radper26'] == "Letra E"){

  $core26 = $corerr;
  $sime26 = " X";

}

  

  // Verficando qual será checado 26

  if ($_POST['radper26'] == "Letra A"){

    $chea26 = "Checked";

    $cheb26 = "";

    $chec26 = "";

    $ched26 = "";

    $chee26 = "";

  }elseif ($_POST['radper26'] == "Letra B"){

    $chea26 = "";

    $cheb26 = "Checked";

    $chec26 = "";

    $ched26 = "";

    $chee26 = "";

  }elseif ($_POST['radper26'] == "Letra C"){

    $chea26 = "";

    $cheb26 = "";

    $chec26 = "Checked";

    $ched26 = "";

    $chee26 = "";

  }elseif ($_POST['radper26'] == "Letra D"){

    $chea26 = "";

    $cheb26 = "";

    $chec26 = "";

    $ched26 = "Checked";

    $chee26 = "";

  }elseif ($_POST['radper26'] == "Letra E"){

    $chea26 = "";

    $cheb26 = "";

    $chec26 = "";

    $ched26 = "";

    $chee26 = "Checked";

  }

  

  // Verificando se respsota esta correta 26

  if ($_POST['radper26'] == $alt_corr26){

    $contrescorr = $contrescorr + 1;

    $cer_err26 = 1;

}

else{

  $cer_err26 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 26

if ($_POST['radper26'] == "Letra A"){

  $codigo_resposta26 = $letraaper26['codigo_resposta'];

}elseif ($_POST['radper26'] == "Letra B"){

  $codigo_resposta26 = $letrabper26['codigo_resposta'];

}elseif ($_POST['radper26'] == "Letra C"){

  $codigo_resposta26 = $letracper26['codigo_resposta'];

}elseif ($_POST['radper26'] == "Letra D"){

  $codigo_resposta26 = $letradper26['codigo_resposta'];

}elseif ($_POST['radper26'] == "Letra E"){

  $codigo_resposta26 = $letraeper26['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 26

$codigo_disciplina26 = $per26['codigo_disciplina'];

  

  // Selecionando imagem 26

  $imgper26 = $per26['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp26 = $letraaper26['tipo'];

  

  

  //Questão 27

  $codper27 = $_SESSION['codper27'];

  $select_per27 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper27");

  $per27 = mysqli_fetch_assoc($select_per27);

  

  $select_letraaper27 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper27 and letra = 'a'");

  $letraaper27 = mysqli_fetch_assoc($select_letraaper27);

  $select_letrabper27 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper27 and letra = 'b'");

  $letrabper27 = mysqli_fetch_assoc($select_letrabper27);

  $select_letracper27 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper27 and letra = 'c'");

  $letracper27 = mysqli_fetch_assoc($select_letracper27);

  $select_letradper27 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper27 and letra = 'd'");

  $letradper27 = mysqli_fetch_assoc($select_letradper27);

  $select_letraeper27 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper27 and letra = 'e'");

  $letraeper27 = mysqli_fetch_assoc($select_letraeper27);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper27["correta"]==1){

  $alt_corr27 = "Letra A";

  $cora27 = $corcorr;
  $sima27 = " ✓";

  $corb27 = "black";
  $simb27 = "";

  $corc27 = "black";
  $simc27 = "";

  $cord27 = "black";
  $simd27 = "";

  $core27 = "black";
  $sime27 = "";

}

elseif ($letrabper27["correta"]==1){

  $alt_corr27 = "Letra B";

  $corb27 = $corcorr;
  $simb27 = " ✓";

  $cora27 = "black";
  $sima27 = "";

  $corc27 = "black";
  $simc27 = "";

  $cord27 = "black";
  $simd27 = "";

  $core27 = "black";
  $sime27 = "";

}

elseif ($letracper27["correta"]==1){

  $alt_corr27 = "Letra C";

  $corc27 = $corcorr;
  $simc27 = " ✓";

  $cora27 = "black";
  $sima27 = "";

  $corb27 = "black";
  $simb27 = "";

  $cord27 = "black";
  $simd27 = "";

  $core27 = "black";
  $sime27 = "";

}

elseif ($letradper27["correta"]==1){

  $alt_corr27 = "Letra D";

  $cord27 = $corcorr;
  $simd27 = " ✓";

  $cora27 = "black";
  $sima27 = "";

  $corc27 = "black";
  $simc27 = "";

  $corb27 = "black";
  $simb27 = "";

  $core27 = "black";
  $sime27 = "";

}

elseif ($letraeper27["correta"]==1){

  $alt_corr27 = "Letra E";

  $core27 = $corcorr;
  $sime27 = " ✓";

  $cora27 = "black";
  $sima27 = "";

  $corc27 = "black";
  $simc27 = "";

  $cord27 = "black";
  $simd27 = "";

  $corb27 = "black";
  $simb27 = "";

}

//Errada

if ($alt_corr27 != $_POST['radper27'] && $_POST['radper27'] == "Letra A"){

  $cora27 = $corerr;
  $sima27 = " X";

}

elseif ($alt_corr27 != $_POST['radper27'] && $_POST['radper27'] == "Letra B"){

  $corb27 = $corerr;
  $simb27 = " X";

}

elseif ($alt_corr27 != $_POST['radper27'] && $_POST['radper27'] == "Letra C"){

  $corc27 = $corerr;
  $simc27 = " X";

}

elseif ($alt_corr27 != $_POST['radper27'] && $_POST['radper27'] == "Letra D"){

  $cord27 = $corerr;
  $simd27 = " X";

}

elseif ($alt_corr27 != $_POST['radper27'] && $_POST['radper27'] == "Letra E"){

  $core27 = $corerr;
  $sime27 = " X";

}

  

  // Verficando qual será checado 27

  if ($_POST['radper27'] == "Letra A"){

    $chea27 = "Checked";

    $cheb27 = "";

    $chec27 = "";

    $ched27 = "";

    $chee27 = "";

  }elseif ($_POST['radper27'] == "Letra B"){

    $chea27 = "";

    $cheb27 = "Checked";

    $chec27 = "";

    $ched27 = "";

    $chee27 = "";

  }elseif ($_POST['radper27'] == "Letra C"){

    $chea27 = "";

    $cheb27 = "";

    $chec27 = "Checked";

    $ched27 = "";

    $chee27 = "";

  }elseif ($_POST['radper27'] == "Letra D"){

    $chea27 = "";

    $cheb27 = "";

    $chec27 = "";

    $ched27 = "Checked";

    $chee27 = "";

  }elseif ($_POST['radper27'] == "Letra E"){

    $chea27 = "";

    $cheb27 = "";

    $chec27 = "";

    $ched27 = "";

    $chee27 = "Checked";

  }

  

  // Verificando se respsota esta correta 27

  if ($_POST['radper27'] == $alt_corr27){

    $contrescorr = $contrescorr + 1;

    $cer_err27 = 1;

}

else{

  $cer_err27 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 27

if ($_POST['radper27'] == "Letra A"){

  $codigo_resposta27 = $letraaper27['codigo_resposta'];

}elseif ($_POST['radper27'] == "Letra B"){

  $codigo_resposta27 = $letrabper27['codigo_resposta'];

}elseif ($_POST['radper27'] == "Letra C"){

  $codigo_resposta27 = $letracper27['codigo_resposta'];

}elseif ($_POST['radper27'] == "Letra D"){

  $codigo_resposta27 = $letradper27['codigo_resposta'];

}elseif ($_POST['radper27'] == "Letra E"){

  $codigo_resposta27 = $letraeper27['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 27

$codigo_disciplina27 = $per27['codigo_disciplina'];

  

  // Selecionando imagem 27

  $imgper27 = $per27['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp27 = $letraaper27['tipo'];

  

  

  //Questão 28

  $codper28 = $_SESSION['codper28'];

  $select_per28 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper28");

  $per28 = mysqli_fetch_assoc($select_per28);

  

  $select_letraaper28 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper28 and letra = 'a'");

  $letraaper28 = mysqli_fetch_assoc($select_letraaper28);

  $select_letrabper28 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper28 and letra = 'b'");

  $letrabper28 = mysqli_fetch_assoc($select_letrabper28);

  $select_letracper28 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper28 and letra = 'c'");

  $letracper28 = mysqli_fetch_assoc($select_letracper28);

  $select_letradper28 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper28 and letra = 'd'");

  $letradper28 = mysqli_fetch_assoc($select_letradper28);

  $select_letraeper28 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper28 and letra = 'e'");

  $letraeper28 = mysqli_fetch_assoc($select_letraeper28);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper28["correta"]==1){

  $alt_corr28 = "Letra A";

  $cora28 = $corcorr;
  $sima28 = " ✓";

  $corb28 = "black";
  $simb28 = "";

  $corc28 = "black";
  $simc28 = "";

  $cord28 = "black";
  $simd28 = "";

  $core28 = "black";
  $sime28 = "";

}

elseif ($letrabper28["correta"]==1){

  $alt_corr28 = "Letra B";

  $corb28 = $corcorr;
  $simb28 = " ✓";

  $cora28 = "black";
  $sima28 = "";

  $corc28 = "black";
  $simc28 = "";

  $cord28 = "black";
  $simd28 = "";

  $core28 = "black";
  $sime28 = "";

}

elseif ($letracper28["correta"]==1){

  $alt_corr28 = "Letra C";

  $corc28 = $corcorr;
  $simc28 = " ✓";

  $cora28 = "black";
  $sima28 = "";

  $corb28 = "black";
  $simb28 = "";

  $cord28 = "black";
  $simd28 = "";

  $core28 = "black";
  $sime28 = "";

}

elseif ($letradper28["correta"]==1){

  $alt_corr28 = "Letra D";

  $cord28 = $corcorr;
  $simd28 = " ✓";

  $cora28 = "black";
  $sima28 = "";

  $corc28 = "black";
  $simc28 = "";

  $corb28 = "black";
  $simb28 = "";

  $core28 = "black";
  $sime28 = "";

}

elseif ($letraeper28["correta"]==1){

  $alt_corr28 = "Letra E";

  $core28 = $corcorr;
  $sime28 = " ✓";

  $cora28 = "black";
  $sima28 = "";

  $corc28 = "black";
  $simc28 = "";

  $cord28 = "black";
  $simd28 = "";

  $corb28 = "black";
  $simb28 = "";

}

//Errada

if ($alt_corr28 != $_POST['radper28'] && $_POST['radper28'] == "Letra A"){

  $cora28 = $corerr;
  $sima28 = " X";

}

elseif ($alt_corr28 != $_POST['radper28'] && $_POST['radper28'] == "Letra B"){

  $corb28 = $corerr;
  $simb28 = " X";

}

elseif ($alt_corr28 != $_POST['radper28'] && $_POST['radper28'] == "Letra C"){

  $corc28 = $corerr;
  $simc28 = " X";

}

elseif ($alt_corr28 != $_POST['radper28'] && $_POST['radper28'] == "Letra D"){

  $cord28 = $corerr;
  $simd28 = " X";

}

elseif ($alt_corr28 != $_POST['radper28'] && $_POST['radper28'] == "Letra E"){

  $core28 = $corerr;
  $sime28 = " X";

}

  

  // Verficando qual será checado 28

  if ($_POST['radper28'] == "Letra A"){

    $chea28 = "Checked";

    $cheb28 = "";

    $chec28 = "";

    $ched28 = "";

    $chee28 = "";

  }elseif ($_POST['radper28'] == "Letra B"){

    $chea28 = "";

    $cheb28 = "Checked";

    $chec28 = "";

    $ched28 = "";

    $chee28 = "";

  }elseif ($_POST['radper28'] == "Letra C"){

    $chea28 = "";

    $cheb28 = "";

    $chec28 = "Checked";

    $ched28 = "";

    $chee28 = "";

  }elseif ($_POST['radper28'] == "Letra D"){

    $chea28 = "";

    $cheb28 = "";

    $chec28 = "";

    $ched28 = "Checked";

    $chee28 = "";

  }elseif ($_POST['radper28'] == "Letra E"){

    $chea28 = "";

    $cheb28 = "";

    $chec28 = "";

    $ched28 = "";

    $chee28 = "Checked";

  }

  

  // Verificando se respsota esta correta 28

  if ($_POST['radper28'] == $alt_corr28){

    $contrescorr = $contrescorr + 1;

    $cer_err28 = 1;

}

else{

  $cer_err28 = 0;

}



// Verificando qual é o codigo da resposta escolhida -- Per 28

if ($_POST['radper28'] == "Letra A"){

  $codigo_resposta28 = $letraaper28['codigo_resposta'];

}elseif ($_POST['radper28'] == "Letra B"){

  $codigo_resposta28 = $letrabper28['codigo_resposta'];

}elseif ($_POST['radper28'] == "Letra C"){

  $codigo_resposta28 = $letracper28['codigo_resposta'];

}elseif ($_POST['radper28'] == "Letra D"){

  $codigo_resposta28 = $letradper28['codigo_resposta'];

}elseif ($_POST['radper28'] == "Letra E"){

  $codigo_resposta28 = $letraeper28['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 28

$codigo_disciplina28 = $per28['codigo_disciplina'];

  

  // Selecionando imagem 28

  $imgper28 = $per28['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp28 = $letraaper28['tipo'];

  

  

  //Questão 29

  $codper29 = $_SESSION['codper29'];

  $select_per29 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper29");

  $per29 = mysqli_fetch_assoc($select_per29);

  

  $select_letraaper29 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper29 and letra = 'a'");

  $letraaper29 = mysqli_fetch_assoc($select_letraaper29);

  $select_letrabper29 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper29 and letra = 'b'");

  $letrabper29 = mysqli_fetch_assoc($select_letrabper29);

  $select_letracper29 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper29 and letra = 'c'");

  $letracper29 = mysqli_fetch_assoc($select_letracper29);

  $select_letradper29 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper29 and letra = 'd'");

  $letradper29 = mysqli_fetch_assoc($select_letradper29);

  $select_letraeper29 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper29 and letra = 'e'");

  $letraeper29 = mysqli_fetch_assoc($select_letraeper29);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper29["correta"]==1){

  $alt_corr29 = "Letra A";

  $cora29 = $corcorr;
  $sima29 = " ✓";

  $corb29 = "black";
  $simb29 = "";

  $corc29 = "black";
  $simc29 = "";

  $cord29 = "black";
  $simd29 = "";

  $core29 = "black";
  $sime29 = "";

}

elseif ($letrabper29["correta"]==1){

  $alt_corr29 = "Letra B";

  $corb29 = $corcorr;
  $simb29 = " ✓";

  $cora29 = "black";
  $sima29 = "";

  $corc29 = "black";
  $simc29 = "";

  $cord29 = "black";
  $simd29 = "";

  $core29 = "black";
  $sime29 = "";

}

elseif ($letracper29["correta"]==1){

  $alt_corr29 = "Letra C";

  $corc29 = $corcorr;
  $simc29 = " ✓";

  $cora29 = "black";
  $sima29 = "";

  $corb29 = "black";
  $simb29 = "";

  $cord29 = "black";
  $simd29 = "";

  $core29 = "black";
  $sime29 = "";

}

elseif ($letradper29["correta"]==1){

  $alt_corr29 = "Letra D";

  $cord29 = $corcorr;
  $simd29 = " ✓";

  $cora29 = "black";
  $sima29 = "";

  $corc29 = "black";
  $simc29 = "";

  $corb29 = "black";
  $simb29 = "";

  $core29 = "black";
  $sime29 = "";

}

elseif ($letraeper29["correta"]==1){

  $alt_corr29 = "Letra E";

  $core29 = $corcorr;
  $sime29 = " ✓";

  $cora29 = "black";
  $sima29 = "";

  $corc29 = "black";
  $simc29 = "";

  $cord29 = "black";
  $simd29 = "";

  $corb29 = "black";
  $simb29 = "";

}

//Errada

if ($alt_corr29 != $_POST['radper29'] && $_POST['radper29'] == "Letra A"){

  $cora29 = $corerr;
  $sima29 = " X";

}

elseif ($alt_corr29 != $_POST['radper29'] && $_POST['radper29'] == "Letra B"){

  $corb29 = $corerr;
  $simb29 = " X";

}

elseif ($alt_corr29 != $_POST['radper29'] && $_POST['radper29'] == "Letra C"){

  $corc29 = $corerr;
  $simc29 = " X";

}

elseif ($alt_corr29 != $_POST['radper29'] && $_POST['radper29'] == "Letra D"){

  $cord29 = $corerr;
  $simd29 = " X";

}

elseif ($alt_corr29 != $_POST['radper29'] && $_POST['radper29'] == "Letra E"){

  $core29 = $corerr;
  $sime29 = " X";

}

  

  // Verficando qual será checado 29

  if ($_POST['radper29'] == "Letra A"){

    $chea29 = "Checked";

    $cheb29 = "";

    $chec29 = "";

    $ched29 = "";

    $chee29 = "";

  }elseif ($_POST['radper29'] == "Letra B"){

    $chea29 = "";

    $cheb29 = "Checked";

    $chec29 = "";

    $ched29 = "";

    $chee29 = "";

  }elseif ($_POST['radper29'] == "Letra C"){

    $chea29 = "";

    $cheb29 = "";

    $chec29 = "Checked";

    $ched29 = "";

    $chee29 = "";

  }elseif ($_POST['radper29'] == "Letra D"){

    $chea29 = "";

    $cheb29 = "";

    $chec29 = "";

    $ched29 = "Checked";

    $chee29 = "";

  }elseif ($_POST['radper29'] == "Letra E"){

    $chea29 = "";

    $cheb29 = "";

    $chec29 = "";

    $ched29 = "";

    $chee29 = "Checked";

  }

  

  // Verificando se respsota esta correta 29

  if ($_POST['radper29'] == $alt_corr29){

    $contrescorr = $contrescorr + 1;

    $cer_err29 = 1;

}

else{

  $cer_err29 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 29

if ($_POST['radper29'] == "Letra A"){

  $codigo_resposta29 = $letraaper29['codigo_resposta'];

}elseif ($_POST['radper29'] == "Letra B"){

  $codigo_resposta29 = $letrabper29['codigo_resposta'];

}elseif ($_POST['radper29'] == "Letra C"){

  $codigo_resposta29 = $letracper29['codigo_resposta'];

}elseif ($_POST['radper29'] == "Letra D"){

  $codigo_resposta29 = $letradper29['codigo_resposta'];

}elseif ($_POST['radper29'] == "Letra E"){

  $codigo_resposta29 = $letraeper29['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 29

$codigo_disciplina29 = $per29['codigo_disciplina'];



  // Selecionando imagem 29

  $imgper29 = $per29['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp29 = $letraaper29['tipo'];

  

  

  //Questão 30

  $codper30 = $_SESSION['codper30'];

  $select_per30 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper30");

  $per30 = mysqli_fetch_assoc($select_per30);

  

  $select_letraaper30 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper30 and letra = 'a'");

  $letraaper30 = mysqli_fetch_assoc($select_letraaper30);

  $select_letrabper30 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper30 and letra = 'b'");

  $letrabper30 = mysqli_fetch_assoc($select_letrabper30);

  $select_letracper30 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper30 and letra = 'c'");

  $letracper30 = mysqli_fetch_assoc($select_letracper30);

  $select_letradper30 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper30 and letra = 'd'");

  $letradper30 = mysqli_fetch_assoc($select_letradper30);

  $select_letraeper30 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper30 and letra = 'e'");

  $letraeper30 = mysqli_fetch_assoc($select_letraeper30);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper30["correta"]==1){

  $alt_corr30 = "Letra A";

  $cora30 = $corcorr;
  $sima30 = " ✓";

  $corb30 = "black";
  $simb30 = "";

  $corc30 = "black";
  $simc30 = "";

  $cord30 = "black";
  $simd30 = "";

  $core30 = "black";
  $sime30 = "";

}

elseif ($letrabper30["correta"]==1){

  $alt_corr30 = "Letra B";

  $corb30 = $corcorr;
  $simb30 = " ✓";

  $cora30 = "black";
  $sima30 = "";

  $corc30 = "black";
  $simc30 = "";

  $cord30 = "black";
  $simd30 = "";

  $core30 = "black";
  $sime30 = "";

}

elseif ($letracper30["correta"]==1){

  $alt_corr30 = "Letra C";

  $corc30 = $corcorr;
  $simc30 = " ✓";

  $cora30 = "black";
  $sima30 = "";

  $corb30 = "black";
  $simb30 = "";

  $cord30 = "black";
  $simd30 = "";

  $core30 = "black";
  $sime30 = "";

}

elseif ($letradper30["correta"]==1){

  $alt_corr30 = "Letra D";

  $cord30 = $corcorr;
  $simd30 = " ✓";

  $cora30 = "black";
  $sima30 = "";

  $corc30 = "black";
  $simc30 = "";

  $corb30 = "black";
  $simb30 = "";

  $core30 = "black";
  $sime30 = "";

}

elseif ($letraeper30["correta"]==1){

  $alt_corr30 = "Letra E";

  $core30 = $corcorr;
  $sime30 = " ✓";

  $cora30 = "black";
  $sima30 = "";

  $corc30 = "black";
  $simc30 = "";

  $cord30 = "black";
  $simd30 = "";

  $corb30 = "black";
  $simb30 = "";

}

//Errada

if ($alt_corr30 != $_POST['radper30'] && $_POST['radper30'] == "Letra A"){

  $cora30 = $corerr;
  $sima30 = " X";

}

elseif ($alt_corr30 != $_POST['radper30'] && $_POST['radper30'] == "Letra B"){

  $corb30 = $corerr;
  $simb30 = " X";

}

elseif ($alt_corr30 != $_POST['radper30'] && $_POST['radper30'] == "Letra C"){

  $corc30 = $corerr;
  $simc30 = " X";

}

elseif ($alt_corr30 != $_POST['radper30'] && $_POST['radper30'] == "Letra D"){

  $cord30 = $corerr;
  $simd30 = " X";

}

elseif ($alt_corr30 != $_POST['radper30'] && $_POST['radper30'] == "Letra E"){

  $core30 = $corerr;
  $sime30 = " X";

}

  

  // Verficando qual será checado 30

  if ($_POST['radper30'] == "Letra A"){

    $chea30 = "Checked";

    $cheb30 = "";

    $chec30 = "";

    $ched30 = "";

    $chee30 = "";

  }elseif ($_POST['radper30'] == "Letra B"){

    $chea30 = "";

    $cheb30 = "Checked";

    $chec30 = "";

    $ched30 = "";

    $chee30 = "";

  }elseif ($_POST['radper30'] == "Letra C"){

    $chea30 = "";

    $cheb30 = "";

    $chec30 = "Checked";

    $ched30 = "";

    $chee30 = "";

  }elseif ($_POST['radper30'] == "Letra D"){

    $chea30 = "";

    $cheb30 = "";

    $chec30 = "";

    $ched30 = "Checked";

    $chee30 = "";

  }elseif ($_POST['radper30'] == "Letra E"){

    $chea30 = "";

    $cheb30 = "";

    $chec30 = "";

    $ched30 = "";

    $chee30 = "Checked";

  }

  

  // Verificando se respsota esta correta 30

  if ($_POST['radper30'] == $alt_corr30){

    $contrescorr = $contrescorr + 1;

    $cer_err30 = 1;

}

else{

  $cer_err30 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 30

if ($_POST['radper30'] == "Letra A"){

  $codigo_resposta30 = $letraaper30['codigo_resposta'];

}elseif ($_POST['radper30'] == "Letra B"){

  $codigo_resposta30 = $letrabper30['codigo_resposta'];

}elseif ($_POST['radper30'] == "Letra C"){

  $codigo_resposta30 = $letracper30['codigo_resposta'];

}elseif ($_POST['radper30'] == "Letra D"){

  $codigo_resposta30 = $letradper30['codigo_resposta'];

}elseif ($_POST['radper30'] == "Letra E"){

  $codigo_resposta30 = $letraeper30['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 30

$codigo_disciplina30 = $per30['codigo_disciplina'];



  // Selecionando imagem 30

  $imgper30 = $per30['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp30 = $letraaper30['tipo'];

  

  }





  // Verificando se existe perguntas de 31 à 35

if ($qtperguntas>30){



  //Questão 31

  $codper31 = $_SESSION['codper31'];

  $select_per31 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper31");

  $per31 = mysqli_fetch_assoc($select_per31);

  

  $select_letraaper31 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper31 and letra = 'a'");

  $letraaper31 = mysqli_fetch_assoc($select_letraaper31);

  $select_letrabper31 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper31 and letra = 'b'");

  $letrabper31 = mysqli_fetch_assoc($select_letrabper31);

  $select_letracper31 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper31 and letra = 'c'");

  $letracper31 = mysqli_fetch_assoc($select_letracper31);

  $select_letradper31 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper31 and letra = 'd'");

  $letradper31 = mysqli_fetch_assoc($select_letradper31);

  $select_letraeper31 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper31 and letra = 'e'");

  $letraeper31 = mysqli_fetch_assoc($select_letraeper31);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper31["correta"]==1){

  $alt_corr31 = "Letra A";

  $cora31 = $corcorr;
  $sima31 = " ✓";

  $corb31 = "black";
  $simb31 = "";

  $corc31 = "black";
  $simc31 = "";

  $cord31 = "black";
  $simd31 = "";

  $core31 = "black";
  $sime31 = "";

}

elseif ($letrabper31["correta"]==1){

  $alt_corr31 = "Letra B";

  $corb31 = $corcorr;
  $simb31 = " ✓";

  $cora31 = "black";
  $sima31 = "";

  $corc31 = "black";
  $simc31 = "";

  $cord31 = "black";
  $simd31 = "";

  $core31 = "black";
  $sime31 = "";

}

elseif ($letracper31["correta"]==1){

  $alt_corr31 = "Letra C";

  $corc31 = $corcorr;
  $simc31 = " ✓";

  $cora31 = "black";
  $sima31 = "";

  $corb31 = "black";
  $simb31 = "";

  $cord31 = "black";
  $simd31 = "";

  $core31 = "black";
  $sime31 = "";

}

elseif ($letradper31["correta"]==1){

  $alt_corr31 = "Letra D";

  $cord31 = $corcorr;
  $simd31 = " ✓";

  $cora31 = "black";
  $sima31 = "";

  $corc31 = "black";
  $simc31 = "";

  $corb31 = "black";
  $simb31 = "";

  $core31 = "black";
  $sime31 = "";

}

elseif ($letraeper31["correta"]==1){

  $alt_corr31 = "Letra E";

  $core31 = $corcorr;
  $sime31 = " ✓";

  $cora31 = "black";
  $sima31 = "";

  $corc31 = "black";
  $simc31 = "";

  $cord31 = "black";
  $simd31 = "";

  $corb31 = "black";
  $simb31 = "";

}

//Errada

if ($alt_corr31 != $_POST['radper31'] && $_POST['radper31'] == "Letra A"){

  $cora31 = $corerr;
  $sima31 = " X";

}

elseif ($alt_corr31 != $_POST['radper31'] && $_POST['radper31'] == "Letra B"){

  $corb31 = $corerr;
  $simb31 = " X";

}

elseif ($alt_corr31 != $_POST['radper31'] && $_POST['radper31'] == "Letra C"){

  $corc31 = $corerr;
  $simc31 = " X";

}

elseif ($alt_corr31 != $_POST['radper31'] && $_POST['radper31'] == "Letra D"){

  $cord31 = $corerr;
  $simd31 = " X";

}

elseif ($alt_corr31 != $_POST['radper31'] && $_POST['radper31'] == "Letra E"){

  $core31 = $corerr;
  $sime31 = " X";

}

  

  // Verficando qual será checado 31

  if ($_POST['radper31'] == "Letra A"){

    $chea31 = "Checked";

    $cheb31 = "";

    $chec31 = "";

    $ched31 = "";

    $chee31 = "";

  }elseif ($_POST['radper31'] == "Letra B"){

    $chea31 = "";

    $cheb31 = "Checked";

    $chec31 = "";

    $ched31 = "";

    $chee31 = "";

  }elseif ($_POST['radper31'] == "Letra C"){

    $chea31 = "";

    $cheb31 = "";

    $chec31 = "Checked";

    $ched31 = "";

    $chee31 = "";

  }elseif ($_POST['radper31'] == "Letra D"){

    $chea31 = "";

    $cheb31 = "";

    $chec31 = "";

    $ched31 = "Checked";

    $chee31 = "";

  }elseif ($_POST['radper31'] == "Letra E"){

    $chea31 = "";

    $cheb31 = "";

    $chec31 = "";

    $ched31 = "";

    $chee31 = "Checked";

  }

  

  // Verificando se respsota esta correta 31

  if ($_POST['radper31'] == $alt_corr31){

    $contrescorr = $contrescorr + 1;

    $cer_err31 = 1;

}

else{

  $cer_err31 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 31

if ($_POST['radper31'] == "Letra A"){

  $codigo_resposta31 = $letraaper31['codigo_resposta'];

}elseif ($_POST['radper31'] == "Letra B"){

  $codigo_resposta31 = $letrabper31['codigo_resposta'];

}elseif ($_POST['radper31'] == "Letra C"){

  $codigo_resposta31 = $letracper31['codigo_resposta'];

}elseif ($_POST['radper31'] == "Letra D"){

  $codigo_resposta31 = $letradper31['codigo_resposta'];

}elseif ($_POST['radper31'] == "Letra E"){

  $codigo_resposta31 = $letraeper31['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 31

$codigo_disciplina31 = $per31['codigo_disciplina'];

  

  // Selecionando imagem 31

  $imgper31 = $per31['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp31 = $letraaper31['tipo'];

  

  

  //Questão 32

  $codper32 = $_SESSION['codper32'];

  $select_per32 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper32");

  $per32 = mysqli_fetch_assoc($select_per32);

  

  $select_letraaper32 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper32 and letra = 'a'");

  $letraaper32 = mysqli_fetch_assoc($select_letraaper32);

  $select_letrabper32 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper32 and letra = 'b'");

  $letrabper32 = mysqli_fetch_assoc($select_letrabper32);

  $select_letracper32 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper32 and letra = 'c'");

  $letracper32 = mysqli_fetch_assoc($select_letracper32);

  $select_letradper32 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper32 and letra = 'd'");

  $letradper32 = mysqli_fetch_assoc($select_letradper32);

  $select_letraeper32 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper32 and letra = 'e'");

  $letraeper32 = mysqli_fetch_assoc($select_letraeper32);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper32["correta"]==1){

  $alt_corr32 = "Letra A";

  $cora32 = $corcorr;
  $sima32 = " ✓";

  $corb32 = "black";
  $simb32 = "";

  $corc32 = "black";
  $simc32 = "";

  $cord32 = "black";
  $simd32 = "";

  $core32 = "black";
  $sime32 = "";

}

elseif ($letrabper32["correta"]==1){

  $alt_corr32 = "Letra B";

  $corb32 = $corcorr;
  $simb32 = " ✓";

  $cora32 = "black";
  $sima32 = "";

  $corc32 = "black";
  $simc32 = "";

  $cord32 = "black";
  $simd32 = "";

  $core32 = "black";
  $sime32 = "";

}

elseif ($letracper32["correta"]==1){

  $alt_corr32 = "Letra C";

  $corc32 = $corcorr;
  $simc32 = " ✓";

  $cora32 = "black";
  $sima32 = "";

  $corb32 = "black";
  $simb32 = "";

  $cord32 = "black";
  $simd32 = "";

  $core32 = "black";
  $sime32 = "";

}

elseif ($letradper32["correta"]==1){

  $alt_corr32 = "Letra D";

  $cord32 = $corcorr;
  $simd32 = " ✓";

  $cora32 = "black";
  $sima32 = "";

  $corc32 = "black";
  $simc32 = "";

  $corb32 = "black";
  $simb32 = "";

  $core32 = "black";
  $sime32 = "";

}

elseif ($letraeper32["correta"]==1){

  $alt_corr32 = "Letra E";

  $core32 = $corcorr;
  $sime32 = " ✓";

  $cora32 = "black";
  $sima32 = "";

  $corc32 = "black";
  $simc32 = "";

  $cord32 = "black";
  $simd32 = "";

  $corb32 = "black";
  $simb32 = "";

}

//Errada

if ($alt_corr32 != $_POST['radper32'] && $_POST['radper32'] == "Letra A"){

  $cora32 = $corerr;
  $sima32 = " X";

}

elseif ($alt_corr32 != $_POST['radper32'] && $_POST['radper32'] == "Letra B"){

  $corb32 = $corerr;
  $simb32 = " X";

}

elseif ($alt_corr32 != $_POST['radper32'] && $_POST['radper32'] == "Letra C"){

  $corc32 = $corerr;
  $simc32 = " X";

}

elseif ($alt_corr32 != $_POST['radper32'] && $_POST['radper32'] == "Letra D"){

  $cord32 = $corerr;
  $simd32 = " X";

}

elseif ($alt_corr32 != $_POST['radper32'] && $_POST['radper32'] == "Letra E"){

  $core32 = $corerr;
  $sime32 = " X";

}

  

  // Verficando qual será checado 32

  if ($_POST['radper32'] == "Letra A"){

    $chea32 = "Checked";

    $cheb32 = "";

    $chec32 = "";

    $ched32 = "";

    $chee32 = "";

  }elseif ($_POST['radper32'] == "Letra B"){

    $chea32 = "";

    $cheb32 = "Checked";

    $chec32 = "";

    $ched32 = "";

    $chee32 = "";

  }elseif ($_POST['radper32'] == "Letra C"){

    $chea32 = "";

    $cheb32 = "";

    $chec32 = "Checked";

    $ched32 = "";

    $chee32 = "";

  }elseif ($_POST['radper32'] == "Letra D"){

    $chea32 = "";

    $cheb32 = "";

    $chec32 = "";

    $ched32 = "Checked";

    $chee32 = "";

  }elseif ($_POST['radper32'] == "Letra E"){

    $chea32 = "";

    $cheb32 = "";

    $chec32 = "";

    $ched32 = "";

    $chee32 = "Checked";

  }

  

  // Verificando se respsota esta correta 32

  if ($_POST['radper32'] == $alt_corr32){

    $contrescorr = $contrescorr + 1;

    $cer_err32 = 1;

}

else{

  $cer_err32 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 32

if ($_POST['radper32'] == "Letra A"){

  $codigo_resposta32 = $letraaper32['codigo_resposta'];

}elseif ($_POST['radper32'] == "Letra B"){

  $codigo_resposta32 = $letrabper32['codigo_resposta'];

}elseif ($_POST['radper32'] == "Letra C"){

  $codigo_resposta32 = $letracper32['codigo_resposta'];

}elseif ($_POST['radper32'] == "Letra D"){

  $codigo_resposta32 = $letradper32['codigo_resposta'];

}elseif ($_POST['radper32'] == "Letra E"){

  $codigo_resposta32 = $letraeper32['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 32

$codigo_disciplina32 = $per32['codigo_disciplina'];



  // Selecionando imagem 32

  $imgper32 = $per32['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp32 = $letraaper32['tipo'];

  

  

  //Questão 33

  $codper33 = $_SESSION['codper33'];

  $select_per33 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper33");

  $per33 = mysqli_fetch_assoc($select_per33);

  

  $select_letraaper33 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper33 and letra = 'a'");

  $letraaper33 = mysqli_fetch_assoc($select_letraaper33);

  $select_letrabper33 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper33 and letra = 'b'");

  $letrabper33 = mysqli_fetch_assoc($select_letrabper33);

  $select_letracper33 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper33 and letra = 'c'");

  $letracper33 = mysqli_fetch_assoc($select_letracper33);

  $select_letradper33 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper33 and letra = 'd'");

  $letradper33 = mysqli_fetch_assoc($select_letradper33);

  $select_letraeper33 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper33 and letra = 'e'");

  $letraeper33 = mysqli_fetch_assoc($select_letraeper33);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper33["correta"]==1){

  $alt_corr33 = "Letra A";

  $cora33 = $corcorr;
  $sima33 = " ✓";

  $corb33 = "black";
  $simb33 = "";

  $corc33 = "black";
  $simc33 = "";

  $cord33 = "black";
  $simd33 = "";

  $core33 = "black";
  $sime33 = "";

}

elseif ($letrabper33["correta"]==1){

  $alt_corr33 = "Letra B";

  $corb33 = $corcorr;
  $simb33 = " ✓";

  $cora33 = "black";
  $sima33 = "";

  $corc33 = "black";
  $simc33 = "";

  $cord33 = "black";
  $simd33 = "";

  $core33 = "black";
  $sime33 = "";

}

elseif ($letracper33["correta"]==1){

  $alt_corr33 = "Letra C";

  $corc33 = $corcorr;
  $simc33 = " ✓";

  $cora33 = "black";
  $sima33 = "";

  $corb33 = "black";
  $simb33 = "";

  $cord33 = "black";
  $simd33 = "";

  $core33 = "black";
  $sime33 = "";

}

elseif ($letradper33["correta"]==1){

  $alt_corr33 = "Letra D";

  $cord33 = $corcorr;
  $simd33 = " ✓";

  $cora33 = "black";
  $sima33 = "";

  $corc33 = "black";
  $simc33 = "";

  $corb33 = "black";
  $simb33 = "";

  $core33 = "black";
  $sime33 = "";

}

elseif ($letraeper33["correta"]==1){

  $alt_corr33 = "Letra E";

  $core33 = $corcorr;
  $sime33 = " ✓";

  $cora33 = "black";
  $sima33 = "";

  $corc33 = "black";
  $simc33 = "";

  $cord33 = "black";
  $simd33 = "";

  $corb33 = "black";
  $simb33 = "";

}

//Errada

if ($alt_corr33 != $_POST['radper33'] && $_POST['radper33'] == "Letra A"){

  $cora33 = $corerr;
  $sima33 = " X";

}

elseif ($alt_corr33 != $_POST['radper33'] && $_POST['radper33'] == "Letra B"){

  $corb33 = $corerr;
  $simb33 = " X";

}

elseif ($alt_corr33 != $_POST['radper33'] && $_POST['radper33'] == "Letra C"){

  $corc33 = $corerr;
  $simc33 = " X";

}

elseif ($alt_corr33 != $_POST['radper33'] && $_POST['radper33'] == "Letra D"){

  $cord33 = $corerr;
  $simd33 = " X";

}

elseif ($alt_corr33 != $_POST['radper33'] && $_POST['radper33'] == "Letra E"){

  $core33 = $corerr;
  $sime33 = " X";

}

  

  // Verficando qual será checado 33

  if ($_POST['radper33'] == "Letra A"){

    $chea33 = "Checked";

    $cheb33 = "";

    $chec33 = "";

    $ched33 = "";

    $chee33 = "";

  }elseif ($_POST['radper33'] == "Letra B"){

    $chea33 = "";

    $cheb33 = "Checked";

    $chec33 = "";

    $ched33 = "";

    $chee33 = "";

  }elseif ($_POST['radper33'] == "Letra C"){

    $chea33 = "";

    $cheb33 = "";

    $chec33 = "Checked";

    $ched33 = "";

    $chee33 = "";

  }elseif ($_POST['radper33'] == "Letra D"){

    $chea33 = "";

    $cheb33 = "";

    $chec33 = "";

    $ched33 = "Checked";

    $chee33 = "";

  }elseif ($_POST['radper33'] == "Letra E"){

    $chea33 = "";

    $cheb33 = "";

    $chec33 = "";

    $ched33 = "";

    $chee33 = "Checked";

  }

  

  // Verificando se respsota esta correta 33

  if ($_POST['radper33'] == $alt_corr33){

    $contrescorr = $contrescorr + 1;

    $cer_err33 = 1;

}

else{

  $cer_err33 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 33

if ($_POST['radper33'] == "Letra A"){

  $codigo_resposta33 = $letraaper33['codigo_resposta'];

}elseif ($_POST['radper33'] == "Letra B"){

  $codigo_resposta33 = $letrabper33['codigo_resposta'];

}elseif ($_POST['radper33'] == "Letra C"){

  $codigo_resposta33 = $letracper33['codigo_resposta'];

}elseif ($_POST['radper33'] == "Letra D"){

  $codigo_resposta33 = $letradper33['codigo_resposta'];

}elseif ($_POST['radper33'] == "Letra E"){

  $codigo_resposta33 = $letraeper33['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 33

$codigo_disciplina33 = $per33['codigo_disciplina'];

  

  // Selecionando imagem 33

  $imgper33 = $per33['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp33 = $letraaper33['tipo'];

  

  

  //Questão 34

  $codper34 = $_SESSION['codper34'];

  $select_per34 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper34");

  $per34 = mysqli_fetch_assoc($select_per34);

  

  $select_letraaper34 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper34 and letra = 'a'");

  $letraaper34 = mysqli_fetch_assoc($select_letraaper34);

  $select_letrabper34 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper34 and letra = 'b'");

  $letrabper34 = mysqli_fetch_assoc($select_letrabper34);

  $select_letracper34 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper34 and letra = 'c'");

  $letracper34 = mysqli_fetch_assoc($select_letracper34);

  $select_letradper34 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper34 and letra = 'd'");

  $letradper34 = mysqli_fetch_assoc($select_letradper34);

  $select_letraeper34 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper34 and letra = 'e'");

  $letraeper34 = mysqli_fetch_assoc($select_letraeper34);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper34["correta"]==1){

  $alt_corr34 = "Letra A";

  $cora34 = $corcorr;
  $sima34 = " ✓";

  $corb34 = "black";
  $simb34 = "";

  $corc34 = "black";
  $simc34 = "";

  $cord34 = "black";
  $simd34 = "";

  $core34 = "black";
  $sime34 = "";

}

elseif ($letrabper34["correta"]==1){

  $alt_corr34 = "Letra B";

  $corb34 = $corcorr;
  $simb34 = " ✓";

  $cora34 = "black";
  $sima34 = "";

  $corc34 = "black";
  $simc34 = "";

  $cord34 = "black";
  $simd34 = "";

  $core34 = "black";
  $sime34 = "";

}

elseif ($letracper34["correta"]==1){

  $alt_corr34 = "Letra C";

  $corc34 = $corcorr;
  $simc34 = " ✓";

  $cora34 = "black";
  $sima34 = "";

  $corb34 = "black";
  $simb34 = "";

  $cord34 = "black";
  $simd34 = "";

  $core34 = "black";
  $sime34 = "";

}

elseif ($letradper34["correta"]==1){

  $alt_corr34 = "Letra D";

  $cord34 = $corcorr;
  $simd34 = " ✓";

  $cora34 = "black";
  $sima34 = "";

  $corc34 = "black";
  $simc34 = "";

  $corb34 = "black";
  $simb34 = "";

  $core34 = "black";
  $sime34 = "";

}

elseif ($letraeper34["correta"]==1){

  $alt_corr34 = "Letra E";

  $core34 = $corcorr;
  $sime34 = " ✓";

  $cora34 = "black";
  $sima34 = "";

  $corc34 = "black";
  $simc34 = "";

  $cord34 = "black";
  $simd34 = "";

  $corb34 = "black";
  $simb34 = "";

}

//Errada

if ($alt_corr34 != $_POST['radper34'] && $_POST['radper34'] == "Letra A"){

  $cora34 = $corerr;
  $sima34 = " X";

}

elseif ($alt_corr34 != $_POST['radper34'] && $_POST['radper34'] == "Letra B"){

  $corb34 = $corerr;
  $simb34 = " X";

}

elseif ($alt_corr34 != $_POST['radper34'] && $_POST['radper34'] == "Letra C"){

  $corc34 = $corerr;
  $simc34 = " X";

}

elseif ($alt_corr34 != $_POST['radper34'] && $_POST['radper34'] == "Letra D"){

  $cord34 = $corerr;
  $simd34 = " X";

}

elseif ($alt_corr34 != $_POST['radper34'] && $_POST['radper34'] == "Letra E"){

  $core34 = $corerr;
  $sime34 = " X";

}

  

  // Verficando qual será checado 34

  if ($_POST['radper34'] == "Letra A"){

    $chea34 = "Checked";

    $cheb34 = "";

    $chec34 = "";

    $ched34 = "";

    $chee34 = "";

  }elseif ($_POST['radper34'] == "Letra B"){

    $chea34 = "";

    $cheb34 = "Checked";

    $chec34 = "";

    $ched34 = "";

    $chee34 = "";

  }elseif ($_POST['radper34'] == "Letra C"){

    $chea34 = "";

    $cheb34 = "";

    $chec34 = "Checked";

    $ched34 = "";

    $chee34 = "";

  }elseif ($_POST['radper34'] == "Letra D"){

    $chea34 = "";

    $cheb34 = "";

    $chec34 = "";

    $ched34 = "Checked";

    $chee34 = "";

  }elseif ($_POST['radper34'] == "Letra E"){

    $chea34 = "";

    $cheb34 = "";

    $chec34 = "";

    $ched34 = "";

    $chee34 = "Checked";

  }

  

  // Verificando se respsota esta correta 34

  if ($_POST['radper34'] == $alt_corr34){

    $contrescorr = $contrescorr + 1;

    $cer_err34 = 1;

}

else{

  $cer_err34 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 34

if ($_POST['radper34'] == "Letra A"){

  $codigo_resposta34 = $letraaper34['codigo_resposta'];

}elseif ($_POST['radper34'] == "Letra B"){

  $codigo_resposta34 = $letrabper34['codigo_resposta'];

}elseif ($_POST['radper34'] == "Letra C"){

  $codigo_resposta34 = $letracper34['codigo_resposta'];

}elseif ($_POST['radper34'] == "Letra D"){

  $codigo_resposta34 = $letradper34['codigo_resposta'];

}elseif ($_POST['radper34'] == "Letra E"){

  $codigo_resposta34 = $letraeper34['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 34

$codigo_disciplina34 = $per34['codigo_disciplina'];

  

  // Selecionando imagem 34

  $imgper34 = $per34['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp34 = $letraaper34['tipo'];

  

  

  //Questão 35

  $codper35 = $_SESSION['codper35'];

  $select_per35 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper35");

  $per35 = mysqli_fetch_assoc($select_per35);

  

  $select_letraaper35 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper35 and letra = 'a'");

  $letraaper35 = mysqli_fetch_assoc($select_letraaper35);

  $select_letrabper35 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper35 and letra = 'b'");

  $letrabper35 = mysqli_fetch_assoc($select_letrabper35);

  $select_letracper35 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper35 and letra = 'c'");

  $letracper35 = mysqli_fetch_assoc($select_letracper35);

  $select_letradper35 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper35 and letra = 'd'");

  $letradper35 = mysqli_fetch_assoc($select_letradper35);

  $select_letraeper35 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper35 and letra = 'e'");

  $letraeper35 = mysqli_fetch_assoc($select_letraeper35);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper35["correta"]==1){

  $alt_corr35 = "Letra A";

  $cora35 = $corcorr;
  $sima35 = " ✓";

  $corb35 = "black";
  $simb35 = "";

  $corc35 = "black";
  $simc35 = "";

  $cord35 = "black";
  $simd35 = "";

  $core35 = "black";
  $sime35 = "";

}

elseif ($letrabper35["correta"]==1){

  $alt_corr35 = "Letra B";

  $corb35 = $corcorr;
  $simb35 = " ✓";

  $cora35 = "black";
  $sima35 = "";

  $corc35 = "black";
  $simc35 = "";

  $cord35 = "black";
  $simd35 = "";

  $core35 = "black";
  $sime35 = "";

}

elseif ($letracper35["correta"]==1){

  $alt_corr35 = "Letra C";

  $corc35 = $corcorr;
  $simc35 = " ✓";

  $cora35 = "black";
  $sima35 = "";

  $corb35 = "black";
  $simb35 = "";

  $cord35 = "black";
  $simd35 = "";

  $core35 = "black";
  $sime35 = "";

}

elseif ($letradper35["correta"]==1){

  $alt_corr35 = "Letra D";

  $cord35 = $corcorr;
  $simd35 = " ✓";

  $cora35 = "black";
  $sima35 = "";

  $corc35 = "black";
  $simc35 = "";

  $corb35 = "black";
  $simb35 = "";

  $core35 = "black";
  $sime35 = "";

}

elseif ($letraeper35["correta"]==1){

  $alt_corr35 = "Letra E";

  $core35 = $corcorr;
  $sime35 = " ✓";

  $cora35 = "black";
  $sima35 = "";

  $corc35 = "black";
  $simc35 = "";

  $cord35 = "black";
  $simd35 = "";

  $corb35 = "black";
  $simb35 = "";

}

//Errada

if ($alt_corr35 != $_POST['radper35'] && $_POST['radper35'] == "Letra A"){

  $cora35 = $corerr;
  $sima35 = " X";

}

elseif ($alt_corr35 != $_POST['radper35'] && $_POST['radper35'] == "Letra B"){

  $corb35 = $corerr;
  $simb35 = " X";

}

elseif ($alt_corr35 != $_POST['radper35'] && $_POST['radper35'] == "Letra C"){

  $corc35 = $corerr;
  $simc35 = " X";

}

elseif ($alt_corr35 != $_POST['radper35'] && $_POST['radper35'] == "Letra D"){

  $cord35 = $corerr;
  $simd35 = " X";

}

elseif ($alt_corr35 != $_POST['radper35'] && $_POST['radper35'] == "Letra E"){

  $core35 = $corerr;
  $sime35 = " X";

}

  

  // Verficando qual será checado 35

  if ($_POST['radper35'] == "Letra A"){

    $chea35 = "Checked";

    $cheb35 = "";

    $chec35 = "";

    $ched35 = "";

    $chee35 = "";

  }elseif ($_POST['radper35'] == "Letra B"){

    $chea35 = "";

    $cheb35 = "Checked";

    $chec35 = "";

    $ched35 = "";

    $chee35 = "";

  }elseif ($_POST['radper35'] == "Letra C"){

    $chea35 = "";

    $cheb35 = "";

    $chec35 = "Checked";

    $ched35 = "";

    $chee35 = "";

  }elseif ($_POST['radper35'] == "Letra D"){

    $chea35 = "";

    $cheb35 = "";

    $chec35 = "";

    $ched35 = "Checked";

    $chee35 = "";

  }elseif ($_POST['radper35'] == "Letra E"){

    $chea35 = "";

    $cheb35 = "";

    $chec35 = "";

    $ched35 = "";

    $chee35 = "Checked";

  }

  

  // Verificando se respsota esta correta 35

  if ($_POST['radper35'] == $alt_corr35){

    $contrescorr = $contrescorr + 1;

    $cer_err35 = 1;

}

else{

  $cer_err35 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 35

if ($_POST['radper35'] == "Letra A"){

  $codigo_resposta35 = $letraaper35['codigo_resposta'];

}elseif ($_POST['radper35'] == "Letra B"){

  $codigo_resposta35 = $letrabper35['codigo_resposta'];

}elseif ($_POST['radper35'] == "Letra C"){

  $codigo_resposta35 = $letracper35['codigo_resposta'];

}elseif ($_POST['radper35'] == "Letra D"){

  $codigo_resposta35 = $letradper35['codigo_resposta'];

}elseif ($_POST['radper35'] == "Letra E"){

  $codigo_resposta35 = $letraeper35['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 35

$codigo_disciplina35 = $per35['codigo_disciplina'];



  // Selecionando imagem 35

  $imgper35 = $per35['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp35 = $letraaper35['tipo'];

  

  }





  // Verificando se existe perguntas de 36 à 40

if ($qtperguntas>35){



  //Questão 36

  $codper36 = $_SESSION['codper36'];

  $select_per36 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper36");

  $per36 = mysqli_fetch_assoc($select_per36);

  

  $select_letraaper36 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper36 and letra = 'a'");

  $letraaper36 = mysqli_fetch_assoc($select_letraaper36);

  $select_letrabper36 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper36 and letra = 'b'");

  $letrabper36 = mysqli_fetch_assoc($select_letrabper36);

  $select_letracper36 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper36 and letra = 'c'");

  $letracper36 = mysqli_fetch_assoc($select_letracper36);

  $select_letradper36 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper36 and letra = 'd'");

  $letradper36 = mysqli_fetch_assoc($select_letradper36);

  $select_letraeper36 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper36 and letra = 'e'");

  $letraeper36 = mysqli_fetch_assoc($select_letraeper36);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper36["correta"]==1){

  $alt_corr36 = "Letra A";

  $cora36 = $corcorr;
  $sima36 = " ✓";

  $corb36 = "black";
  $simb36 = "";

  $corc36 = "black";
  $simc36 = "";

  $cord36 = "black";
  $simd36 = "";

  $core36 = "black";
  $sime36 = "";

}

elseif ($letrabper36["correta"]==1){

  $alt_corr36 = "Letra B";

  $corb36 = $corcorr;
  $simb36 = " ✓";

  $cora36 = "black";
  $sima36 = "";

  $corc36 = "black";
  $simc36 = "";

  $cord36 = "black";
  $simd36 = "";

  $core36 = "black";
  $sime36 = "";

}

elseif ($letracper36["correta"]==1){

  $alt_corr36 = "Letra C";

  $corc36 = $corcorr;
  $simc36 = " ✓";

  $cora36 = "black";
  $sima36 = "";

  $corb36 = "black";
  $simb36 = "";

  $cord36 = "black";
  $simd36 = "";

  $core36 = "black";
  $sime36 = "";

}

elseif ($letradper36["correta"]==1){

  $alt_corr36 = "Letra D";

  $cord36 = $corcorr;
  $simd36 = " ✓";

  $cora36 = "black";
  $sima36 = "";

  $corc36 = "black";
  $simc36 = "";

  $corb36 = "black";
  $simb36 = "";

  $core36 = "black";
  $sime36 = "";

}

elseif ($letraeper36["correta"]==1){

  $alt_corr36 = "Letra E";

  $core36 = $corcorr;
  $sime36 = " ✓";

  $cora36 = "black";
  $sima36 = "";

  $corc36 = "black";
  $simc36 = "";

  $cord36 = "black";
  $simd36 = "";

  $corb36 = "black";
  $simb36 = "";

}

//Errada

if ($alt_corr36 != $_POST['radper36'] && $_POST['radper36'] == "Letra A"){

  $cora36 = $corerr;
  $sima36 = " X";

}

elseif ($alt_corr36 != $_POST['radper36'] && $_POST['radper36'] == "Letra B"){

  $corb36 = $corerr;
  $simb36 = " X";

}

elseif ($alt_corr36 != $_POST['radper36'] && $_POST['radper36'] == "Letra C"){

  $corc36 = $corerr;
  $simc36 = " X";

}

elseif ($alt_corr36 != $_POST['radper36'] && $_POST['radper36'] == "Letra D"){

  $cord36 = $corerr;
  $simd36 = " X";

}

elseif ($alt_corr36 != $_POST['radper36'] && $_POST['radper36'] == "Letra E"){

  $core36 = $corerr;
  $sime36 = " X";

}

  

  // Verficando qual será checado 36

  if ($_POST['radper36'] == "Letra A"){

    $chea36 = "Checked";

    $cheb36 = "";

    $chec36 = "";

    $ched36 = "";

    $chee36 = "";

  }elseif ($_POST['radper36'] == "Letra B"){

    $chea36 = "";

    $cheb36 = "Checked";

    $chec36 = "";

    $ched36 = "";

    $chee36 = "";

  }elseif ($_POST['radper36'] == "Letra C"){

    $chea36 = "";

    $cheb36 = "";

    $chec36 = "Checked";

    $ched36 = "";

    $chee36 = "";

  }elseif ($_POST['radper36'] == "Letra D"){

    $chea36 = "";

    $cheb36 = "";

    $chec36 = "";

    $ched36 = "Checked";

    $chee36 = "";

  }elseif ($_POST['radper36'] == "Letra E"){

    $chea36 = "";

    $cheb36 = "";

    $chec36 = "";

    $ched36 = "";

    $chee36 = "Checked";

  }

  

  // Verificando se respsota esta correta 36

  if ($_POST['radper36'] == $alt_corr36){

    $contrescorr = $contrescorr + 1;

    $cer_err36 = 1;

}

else{

  $cer_err36 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 36

if ($_POST['radper36'] == "Letra A"){

  $codigo_resposta36 = $letraaper36['codigo_resposta'];

}elseif ($_POST['radper36'] == "Letra B"){

  $codigo_resposta36 = $letrabper36['codigo_resposta'];

}elseif ($_POST['radper36'] == "Letra C"){

  $codigo_resposta36 = $letracper36['codigo_resposta'];

}elseif ($_POST['radper36'] == "Letra D"){

  $codigo_resposta36 = $letradper36['codigo_resposta'];

}elseif ($_POST['radper36'] == "Letra E"){

  $codigo_resposta36 = $letraeper36['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 36

$codigo_disciplina36 = $per36['codigo_disciplina'];

  

  // Selecionando imagem 36

  $imgper36 = $per36['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp36 = $letraaper36['tipo'];

  

  

  //Questão 37

  $codper37 = $_SESSION['codper37'];

  $select_per37 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper37");

  $per37 = mysqli_fetch_assoc($select_per37);

  

  $select_letraaper37 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper37 and letra = 'a'");

  $letraaper37 = mysqli_fetch_assoc($select_letraaper37);

  $select_letrabper37 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper37 and letra = 'b'");

  $letrabper37 = mysqli_fetch_assoc($select_letrabper37);

  $select_letracper37 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper37 and letra = 'c'");

  $letracper37 = mysqli_fetch_assoc($select_letracper37);

  $select_letradper37 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper37 and letra = 'd'");

  $letradper37 = mysqli_fetch_assoc($select_letradper37);

  $select_letraeper37 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper37 and letra = 'e'");

  $letraeper37 = mysqli_fetch_assoc($select_letraeper37);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper37["correta"]==1){

  $alt_corr37 = "Letra A";

  $cora37 = $corcorr;
  $sima37 = " ✓";

  $corb37 = "black";
  $simb37 = "";

  $corc37 = "black";
  $simc37 = "";

  $cord37 = "black";
  $simd37 = "";

  $core37 = "black";
  $sime37 = "";

}

elseif ($letrabper37["correta"]==1){

  $alt_corr37 = "Letra B";

  $corb37 = $corcorr;
  $simb37 = " ✓";

  $cora37 = "black";
  $sima37 = "";

  $corc37 = "black";
  $simc37 = "";

  $cord37 = "black";
  $simd37 = "";

  $core37 = "black";
  $sime37 = "";

}

elseif ($letracper37["correta"]==1){

  $alt_corr37 = "Letra C";

  $corc37 = $corcorr;
  $simc37 = " ✓";

  $cora37 = "black";
  $sima37 = "";

  $corb37 = "black";
  $simb37 = "";

  $cord37 = "black";
  $simd37 = "";

  $core37 = "black";
  $sime37 = "";

}

elseif ($letradper37["correta"]==1){

  $alt_corr37 = "Letra D";

  $cord37 = $corcorr;
  $simd37 = " ✓";

  $cora37 = "black";
  $sima37 = "";

  $corc37 = "black";
  $simc37 = "";

  $corb37 = "black";
  $simb37 = "";

  $core37 = "black";
  $sime37 = "";

}

elseif ($letraeper37["correta"]==1){

  $alt_corr37 = "Letra E";

  $core37 = $corcorr;
  $sime37 = " ✓";

  $cora37 = "black";
  $sima37 = "";

  $corc37 = "black";
  $simc37 = "";

  $cord37 = "black";
  $simd37 = "";

  $corb37 = "black";
  $simb37 = "";

}

//Errada

if ($alt_corr37 != $_POST['radper37'] && $_POST['radper37'] == "Letra A"){

  $cora37 = $corerr;
  $sima37 = " X";

}

elseif ($alt_corr37 != $_POST['radper37'] && $_POST['radper37'] == "Letra B"){

  $corb37 = $corerr;
  $simb37 = " X";

}

elseif ($alt_corr37 != $_POST['radper37'] && $_POST['radper37'] == "Letra C"){

  $corc37 = $corerr;
  $simc37 = " X";

}

elseif ($alt_corr37 != $_POST['radper37'] && $_POST['radper37'] == "Letra D"){

  $cord37 = $corerr;
  $simd37 = " X";

}

elseif ($alt_corr37 != $_POST['radper37'] && $_POST['radper37'] == "Letra E"){

  $core37 = $corerr;
  $sime37 = " X";

}

  

  // Verficando qual será checado 37

  if ($_POST['radper37'] == "Letra A"){

    $chea37 = "Checked";

    $cheb37 = "";

    $chec37 = "";

    $ched37 = "";

    $chee37 = "";

  }elseif ($_POST['radper37'] == "Letra B"){

    $chea37 = "";

    $cheb37 = "Checked";

    $chec37 = "";

    $ched37 = "";

    $chee37 = "";

  }elseif ($_POST['radper37'] == "Letra C"){

    $chea37 = "";

    $cheb37 = "";

    $chec37 = "Checked";

    $ched37 = "";

    $chee37 = "";

  }elseif ($_POST['radper37'] == "Letra D"){

    $chea37 = "";

    $cheb37 = "";

    $chec37 = "";

    $ched37 = "Checked";

    $chee37 = "";

  }elseif ($_POST['radper37'] == "Letra E"){

    $chea37 = "";

    $cheb37 = "";

    $chec37 = "";

    $ched37 = "";

    $chee37 = "Checked";

  }

  

  // Verificando se respsota esta correta 37

  if ($_POST['radper37'] == $alt_corr37){

    $contrescorr = $contrescorr + 1;

    $cer_err37 = 1;

}

else{

  $cer_err37 = 0;

}

  

// Verificando qual é o codigo da resposta escolhida -- Per 37

if ($_POST['radper37'] == "Letra A"){

  $codigo_resposta37 = $letraaper37['codigo_resposta'];

}elseif ($_POST['radper37'] == "Letra B"){

  $codigo_resposta37 = $letrabper37['codigo_resposta'];

}elseif ($_POST['radper37'] == "Letra C"){

  $codigo_resposta37 = $letracper37['codigo_resposta'];

}elseif ($_POST['radper37'] == "Letra D"){

  $codigo_resposta37 = $letradper37['codigo_resposta'];

}elseif ($_POST['radper37'] == "Letra E"){

  $codigo_resposta37 = $letraeper37['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 37

$codigo_disciplina37 = $per37['codigo_disciplina'];



  // Selecionando imagem 37

  $imgper37 = $per37['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp37 = $letraaper37['tipo'];

  

  

  //Questão 38

  $codper38 = $_SESSION['codper38'];

  $select_per38 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper38");

  $per38 = mysqli_fetch_assoc($select_per38);

  

  $select_letraaper38 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper38 and letra = 'a'");

  $letraaper38 = mysqli_fetch_assoc($select_letraaper38);

  $select_letrabper38 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper38 and letra = 'b'");

  $letrabper38 = mysqli_fetch_assoc($select_letrabper38);

  $select_letracper38 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper38 and letra = 'c'");

  $letracper38 = mysqli_fetch_assoc($select_letracper38);

  $select_letradper38 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper38 and letra = 'd'");

  $letradper38 = mysqli_fetch_assoc($select_letradper38);

  $select_letraeper38 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper38 and letra = 'e'");

  $letraeper38 = mysqli_fetch_assoc($select_letraeper38);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper38["correta"]==1){

  $alt_corr38 = "Letra A";

  $cora38 = $corcorr;
  $sima38 = " ✓";

  $corb38 = "black";
  $simb38 = "";

  $corc38 = "black";
  $simc38 = "";

  $cord38 = "black";
  $simd38 = "";

  $core38 = "black";
  $sime38 = "";

}

elseif ($letrabper38["correta"]==1){

  $alt_corr38 = "Letra B";

  $corb38 = $corcorr;
  $simb38 = " ✓";

  $cora38 = "black";
  $sima38 = "";

  $corc38 = "black";
  $simc38 = "";

  $cord38 = "black";
  $simd38 = "";

  $core38 = "black";
  $sime38 = "";

}

elseif ($letracper38["correta"]==1){

  $alt_corr38 = "Letra C";

  $corc38 = $corcorr;
  $simc38 = " ✓";

  $cora38 = "black";
  $sima38 = "";

  $corb38 = "black";
  $simb38 = "";

  $cord38 = "black";
  $simd38 = "";

  $core38 = "black";
  $sime38 = "";

}

elseif ($letradper38["correta"]==1){

  $alt_corr38 = "Letra D";

  $cord38 = $corcorr;
  $simd38 = " ✓";

  $cora38 = "black";
  $sima38 = "";

  $corc38 = "black";
  $simc38 = "";

  $corb38 = "black";
  $simb38 = "";

  $core38 = "black";
  $sime38 = "";

}

elseif ($letraeper38["correta"]==1){

  $alt_corr38 = "Letra E";

  $core38 = $corcorr;
  $sime38 = " ✓";

  $cora38 = "black";
  $sima38 = "";

  $corc38 = "black";
  $simc38 = "";

  $cord38 = "black";
  $simd38 = "";

  $corb38 = "black";
  $simb38 = "";

}

//Errada

if ($alt_corr38 != $_POST['radper38'] && $_POST['radper38'] == "Letra A"){

  $cora38 = $corerr;
  $sima38 = " X";

}

elseif ($alt_corr38 != $_POST['radper38'] && $_POST['radper38'] == "Letra B"){

  $corb38 = $corerr;
  $simb38 = " X";

}

elseif ($alt_corr38 != $_POST['radper38'] && $_POST['radper38'] == "Letra C"){

  $corc38 = $corerr;
  $simc38 = " X";

}

elseif ($alt_corr38 != $_POST['radper38'] && $_POST['radper38'] == "Letra D"){

  $cord38 = $corerr;
  $simd38 = " X";

}

elseif ($alt_corr38 != $_POST['radper38'] && $_POST['radper38'] == "Letra E"){

  $core38 = $corerr;
  $sime38 = " X";

}

  

  // Verficando qual será checado 38

  if ($_POST['radper38'] == "Letra A"){

    $chea38 = "Checked";

    $cheb38 = "";

    $chec38 = "";

    $ched38 = "";

    $chee38 = "";

  }elseif ($_POST['radper38'] == "Letra B"){

    $chea38 = "";

    $cheb38 = "Checked";

    $chec38 = "";

    $ched38 = "";

    $chee38 = "";

  }elseif ($_POST['radper38'] == "Letra C"){

    $chea38 = "";

    $cheb38 = "";

    $chec38 = "Checked";

    $ched38 = "";

    $chee38 = "";

  }elseif ($_POST['radper38'] == "Letra D"){

    $chea38 = "";

    $cheb38 = "";

    $chec38 = "";

    $ched38 = "Checked";

    $chee38 = "";

  }elseif ($_POST['radper38'] == "Letra E"){

    $chea38 = "";

    $cheb38 = "";

    $chec38 = "";

    $ched38 = "";

    $chee38 = "Checked";

  }

  

  // Verificando se respsota esta correta 38

  if ($_POST['radper38'] == $alt_corr38){

    $contrescorr = $contrescorr + 1;

    $cer_err38 = 1;

}

else{

  $cer_err38 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 38

if ($_POST['radper38'] == "Letra A"){

  $codigo_resposta38 = $letraaper38['codigo_resposta'];

}elseif ($_POST['radper38'] == "Letra B"){

  $codigo_resposta38 = $letrabper38['codigo_resposta'];

}elseif ($_POST['radper38'] == "Letra C"){

  $codigo_resposta38 = $letracper38['codigo_resposta'];

}elseif ($_POST['radper38'] == "Letra D"){

  $codigo_resposta38 = $letradper38['codigo_resposta'];

}elseif ($_POST['radper38'] == "Letra E"){

  $codigo_resposta38 = $letraeper38['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 38

$codigo_disciplina38 = $per38['codigo_disciplina'];

  

  // Selecionando imagem 38

  $imgper38 = $per38['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp38 = $letraaper38['tipo'];

  

  

  //Questão 39

  $codper39 = $_SESSION['codper39'];

  $select_per39 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper39");

  $per39 = mysqli_fetch_assoc($select_per39);

  

  $select_letraaper39 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper39 and letra = 'a'");

  $letraaper39 = mysqli_fetch_assoc($select_letraaper39);

  $select_letrabper39 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper39 and letra = 'b'");

  $letrabper39 = mysqli_fetch_assoc($select_letrabper39);

  $select_letracper39 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper39 and letra = 'c'");

  $letracper39 = mysqli_fetch_assoc($select_letracper39);

  $select_letradper39 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper39 and letra = 'd'");

  $letradper39 = mysqli_fetch_assoc($select_letradper39);

  $select_letraeper39 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper39 and letra = 'e'");

  $letraeper39 = mysqli_fetch_assoc($select_letraeper39);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper39["correta"]==1){

  $alt_corr39 = "Letra A";

  $cora39 = $corcorr;
  $sima39 = " ✓";

  $corb39 = "black";
  $simb39 = "";

  $corc39 = "black";
  $simc39 = "";

  $cord39 = "black";
  $simd39 = "";

  $core39 = "black";
  $sime39 = "";

}

elseif ($letrabper39["correta"]==1){

  $alt_corr39 = "Letra B";

  $corb39 = $corcorr;
  $simb39 = " ✓";

  $cora39 = "black";
  $sima39 = "";

  $corc39 = "black";
  $simc39 = "";

  $cord39 = "black";
  $simd39 = "";

  $core39 = "black";
  $sime39 = "";

}

elseif ($letracper39["correta"]==1){

  $alt_corr39 = "Letra C";

  $corc39 = $corcorr;
  $simc39 = " ✓";

  $cora39 = "black";
  $sima39 = "";

  $corb39 = "black";
  $simb39 = "";

  $cord39 = "black";
  $simd39 = "";

  $core39 = "black";
  $sime39 = "";

}

elseif ($letradper39["correta"]==1){

  $alt_corr39 = "Letra D";

  $cord39 = $corcorr;
  $simd39 = " ✓";

  $cora39 = "black";
  $sima39 = "";

  $corc39 = "black";
  $simc39 = "";

  $corb39 = "black";
  $simb39 = "";

  $core39 = "black";
  $sime39 = "";

}

elseif ($letraeper39["correta"]==1){

  $alt_corr39 = "Letra E";

  $core39 = $corcorr;
  $sime39 = " ✓";

  $cora39 = "black";
  $sima39 = "";

  $corc39 = "black";
  $simc39 = "";

  $cord39 = "black";
  $simd39 = "";

  $corb39 = "black";
  $simb39 = "";

}

//Errada

if ($alt_corr39 != $_POST['radper39'] && $_POST['radper39'] == "Letra A"){

  $cora39 = $corerr;
  $sima39 = " X";

}

elseif ($alt_corr39 != $_POST['radper39'] && $_POST['radper39'] == "Letra B"){

  $corb39 = $corerr;
  $simb39 = " X";

}

elseif ($alt_corr39 != $_POST['radper39'] && $_POST['radper39'] == "Letra C"){

  $corc39 = $corerr;
  $simc39 = " X";

}

elseif ($alt_corr39 != $_POST['radper39'] && $_POST['radper39'] == "Letra D"){

  $cord39 = $corerr;
  $simd39 = " X";

}

elseif ($alt_corr39 != $_POST['radper39'] && $_POST['radper39'] == "Letra E"){

  $core39 = $corerr;
  $sime39 = " X";

}

  

  // Verficando qual será checado 39

  if ($_POST['radper39'] == "Letra A"){

    $chea39 = "Checked";

    $cheb39 = "";

    $chec39 = "";

    $ched39 = "";

    $chee39 = "";

  }elseif ($_POST['radper39'] == "Letra B"){

    $chea39 = "";

    $cheb39 = "Checked";

    $chec39 = "";

    $ched39 = "";

    $chee39 = "";

  }elseif ($_POST['radper39'] == "Letra C"){

    $chea39 = "";

    $cheb39 = "";

    $chec39 = "Checked";

    $ched39 = "";

    $chee39 = "";

  }elseif ($_POST['radper39'] == "Letra D"){

    $chea39 = "";

    $cheb39 = "";

    $chec39 = "";

    $ched39 = "Checked";

    $chee39 = "";

  }elseif ($_POST['radper39'] == "Letra E"){

    $chea39 = "";

    $cheb39 = "";

    $chec39 = "";

    $ched39 = "";

    $chee39 = "Checked";

  }

  

  // Verificando se respsota esta correta 39

  if ($_POST['radper39'] == $alt_corr39){

    $contrescorr = $contrescorr + 1;

    $cer_err39 = 1;

}

else{

  $cer_err39 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 39

if ($_POST['radper39'] == "Letra A"){

  $codigo_resposta39 = $letraaper39['codigo_resposta'];

}elseif ($_POST['radper39'] == "Letra B"){

  $codigo_resposta39 = $letrabper39['codigo_resposta'];

}elseif ($_POST['radper39'] == "Letra C"){

  $codigo_resposta39 = $letracper39['codigo_resposta'];

}elseif ($_POST['radper39'] == "Letra D"){

  $codigo_resposta39 = $letradper39['codigo_resposta'];

}elseif ($_POST['radper39'] == "Letra E"){

  $codigo_resposta39 = $letraeper39['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 39

$codigo_disciplina39 = $per39['codigo_disciplina'];

  

  // Selecionando imagem 39

  $imgper39 = $per39['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp39 = $letraaper39['tipo'];

  

  

  //Questão 40

  $codper40 = $_SESSION['codper40'];

  $select_per40 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper40");

  $per40 = mysqli_fetch_assoc($select_per40);

  

  $select_letraaper40 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper40 and letra = 'a'");

  $letraaper40 = mysqli_fetch_assoc($select_letraaper40);

  $select_letrabper40 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper40 and letra = 'b'");

  $letrabper40 = mysqli_fetch_assoc($select_letrabper40);

  $select_letracper40 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper40 and letra = 'c'");

  $letracper40 = mysqli_fetch_assoc($select_letracper40);

  $select_letradper40 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper40 and letra = 'd'");

  $letradper40 = mysqli_fetch_assoc($select_letradper40);

  $select_letraeper40 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper40 and letra = 'e'");

  $letraeper40 = mysqli_fetch_assoc($select_letraeper40);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper40["correta"]==1){

  $alt_corr40 = "Letra A";

  $cora40 = $corcorr;
  $sima40 = " ✓";

  $corb40 = "black";
  $simb40 = "";

  $corc40 = "black";
  $simc40 = "";

  $cord40 = "black";
  $simd40 = "";

  $core40 = "black";
  $sime40 = "";

}

elseif ($letrabper40["correta"]==1){

  $alt_corr40 = "Letra B";

  $corb40 = $corcorr;
  $simb40 = " ✓";

  $cora40 = "black";
  $sima40 = "";

  $corc40 = "black";
  $simc40 = "";

  $cord40 = "black";
  $simd40 = "";

  $core40 = "black";
  $sime40 = "";

}

elseif ($letracper40["correta"]==1){

  $alt_corr40 = "Letra C";

  $corc40 = $corcorr;
  $simc40 = " ✓";

  $cora40 = "black";
  $sima40 = "";

  $corb40 = "black";
  $simb40 = "";

  $cord40 = "black";
  $simd40 = "";

  $core40 = "black";
  $sime40 = "";

}

elseif ($letradper40["correta"]==1){

  $alt_corr40 = "Letra D";

  $cord40 = $corcorr;
  $simd40 = " ✓";

  $cora40 = "black";
  $sima40 = "";

  $corc40 = "black";
  $simc40 = "";

  $corb40 = "black";
  $simb40 = "";

  $core40 = "black";
  $sime40 = "";

}

elseif ($letraeper40["correta"]==1){

  $alt_corr40 = "Letra E";

  $core40 = $corcorr;
  $sime40 = " ✓";

  $cora40 = "black";
  $sima40 = "";

  $corc40 = "black";
  $simc40 = "";

  $cord40 = "black";
  $simd40 = "";

  $corb40 = "black";
  $simb40 = "";

}

//Errada

if ($alt_corr40 != $_POST['radper40'] && $_POST['radper40'] == "Letra A"){

  $cora40 = $corerr;
  $sima40 = " X";

}

elseif ($alt_corr40 != $_POST['radper40'] && $_POST['radper40'] == "Letra B"){

  $corb40 = $corerr;
  $simb40 = " X";

}

elseif ($alt_corr40 != $_POST['radper40'] && $_POST['radper40'] == "Letra C"){

  $corc40 = $corerr;
  $simc40 = " X";

}

elseif ($alt_corr40 != $_POST['radper40'] && $_POST['radper40'] == "Letra D"){

  $cord40 = $corerr;
  $simd40 = " X";

}

elseif ($alt_corr40 != $_POST['radper40'] && $_POST['radper40'] == "Letra E"){

  $core40 = $corerr;
  $sime40 = " X";

}

  

  // Verficando qual será checado 40

  if ($_POST['radper40'] == "Letra A"){

    $chea40 = "Checked";

    $cheb40 = "";

    $chec40 = "";

    $ched40 = "";

    $chee40 = "";

  }elseif ($_POST['radper40'] == "Letra B"){

    $chea40 = "";

    $cheb40 = "Checked";

    $chec40 = "";

    $ched40 = "";

    $chee40 = "";

  }elseif ($_POST['radper40'] == "Letra C"){

    $chea40 = "";

    $cheb40 = "";

    $chec40 = "Checked";

    $ched40 = "";

    $chee40 = "";

  }elseif ($_POST['radper40'] == "Letra D"){

    $chea40 = "";

    $cheb40 = "";

    $chec40 = "";

    $ched40 = "Checked";

    $chee40 = "";

  }elseif ($_POST['radper40'] == "Letra E"){

    $chea40 = "";

    $cheb40 = "";

    $chec40 = "";

    $ched40 = "";

    $chee40 = "Checked";

  }

  

  // Verificando se respsota esta correta 40

  if ($_POST['radper40'] == $alt_corr40){

    $contrescorr = $contrescorr + 1;

    $cer_err40 = 1;

}

else{

  $cer_err40 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 40

if ($_POST['radper40'] == "Letra A"){

  $codigo_resposta40 = $letraaper40['codigo_resposta'];

}elseif ($_POST['radper40'] == "Letra B"){

  $codigo_resposta40 = $letrabper40['codigo_resposta'];

}elseif ($_POST['radper40'] == "Letra C"){

  $codigo_resposta40 = $letracper40['codigo_resposta'];

}elseif ($_POST['radper40'] == "Letra D"){

  $codigo_resposta40 = $letradper40['codigo_resposta'];

}elseif ($_POST['radper40'] == "Letra E"){

  $codigo_resposta40 = $letraeper40['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 40

$codigo_disciplina40 = $per40['codigo_disciplina'];

  

  // Selecionando imagem 40

  $imgper40 = $per40['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp40 = $letraaper40['tipo'];

  

  }





  // Verificando se existe perguntas de 41 à 45

if ($qtperguntas>40){



  //Questão 41

  $codper41 = $_SESSION['codper41'];

  $select_per41 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper41");

  $per41 = mysqli_fetch_assoc($select_per41);

  

  $select_letraaper41 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper41 and letra = 'a'");

  $letraaper41 = mysqli_fetch_assoc($select_letraaper41);

  $select_letrabper41 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper41 and letra = 'b'");

  $letrabper41 = mysqli_fetch_assoc($select_letrabper41);

  $select_letracper41 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper41 and letra = 'c'");

  $letracper41 = mysqli_fetch_assoc($select_letracper41);

  $select_letradper41 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper41 and letra = 'd'");

  $letradper41 = mysqli_fetch_assoc($select_letradper41);

  $select_letraeper41 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper41 and letra = 'e'");

  $letraeper41 = mysqli_fetch_assoc($select_letraeper41);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper41["correta"]==1){

  $alt_corr41 = "Letra A";

  $cora41 = $corcorr;
  $sima41 = " ✓";

  $corb41 = "black";
  $simb41 = "";

  $corc41 = "black";
  $simc41 = "";

  $cord41 = "black";
  $simd41 = "";

  $core41 = "black";
  $sime41 = "";

}

elseif ($letrabper41["correta"]==1){

  $alt_corr41 = "Letra B";

  $corb41 = $corcorr;
  $simb41 = " ✓";

  $cora41 = "black";
  $sima41 = "";

  $corc41 = "black";
  $simc41 = "";

  $cord41 = "black";
  $simd41 = "";

  $core41 = "black";
  $sime41 = "";

}

elseif ($letracper41["correta"]==1){

  $alt_corr41 = "Letra C";

  $corc41 = $corcorr;
  $simc41 = " ✓";

  $cora41 = "black";
  $sima41 = "";

  $corb41 = "black";
  $simb41 = "";

  $cord41 = "black";
  $simd41 = "";

  $core41 = "black";
  $sime41 = "";

}

elseif ($letradper41["correta"]==1){

  $alt_corr41 = "Letra D";

  $cord41 = $corcorr;
  $simd41 = " ✓";

  $cora41 = "black";
  $sima41 = "";

  $corc41 = "black";
  $simc41 = "";

  $corb41 = "black";
  $simb41 = "";

  $core41 = "black";
  $sime41 = "";

}

elseif ($letraeper41["correta"]==1){

  $alt_corr41 = "Letra E";

  $core41 = $corcorr;
  $sime41 = " ✓";

  $cora41 = "black";
  $sima41 = "";

  $corc41 = "black";
  $simc41 = "";

  $cord41 = "black";
  $simd41 = "";

  $corb41 = "black";
  $simb41 = "";

}

//Errada

if ($alt_corr41 != $_POST['radper41'] && $_POST['radper41'] == "Letra A"){

  $cora41 = $corerr;
  $sima41 = " X";

}

elseif ($alt_corr41 != $_POST['radper41'] && $_POST['radper41'] == "Letra B"){

  $corb41 = $corerr;
  $simb41 = " X";

}

elseif ($alt_corr41 != $_POST['radper41'] && $_POST['radper41'] == "Letra C"){

  $corc41 = $corerr;
  $simc41 = " X";

}

elseif ($alt_corr41 != $_POST['radper41'] && $_POST['radper41'] == "Letra D"){

  $cord41 = $corerr;
  $simd41 = " X";

}

elseif ($alt_corr41 != $_POST['radper41'] && $_POST['radper41'] == "Letra E"){

  $core41 = $corerr;
  $sime41 = " X";

}

  

  // Verficando qual será checado 41

  if ($_POST['radper41'] == "Letra A"){

    $chea41 = "Checked";

    $cheb41 = "";

    $chec41 = "";

    $ched41 = "";

    $chee41 = "";

  }elseif ($_POST['radper41'] == "Letra B"){

    $chea41 = "";

    $cheb41 = "Checked";

    $chec41 = "";

    $ched41 = "";

    $chee41 = "";

  }elseif ($_POST['radper41'] == "Letra C"){

    $chea41 = "";

    $cheb41 = "";

    $chec41 = "Checked";

    $ched41 = "";

    $chee41 = "";

  }elseif ($_POST['radper41'] == "Letra D"){

    $chea41 = "";

    $cheb41 = "";

    $chec41 = "";

    $ched41 = "Checked";

    $chee41 = "";

  }elseif ($_POST['radper41'] == "Letra E"){

    $chea41 = "";

    $cheb41 = "";

    $chec41 = "";

    $ched41 = "";

    $chee41 = "Checked";

  }

  

  // Verificando se respsota esta correta 41

  if ($_POST['radper41'] == $alt_corr41){

    $contrescorr = $contrescorr + 1;

    $cer_err41 = 1;

  }

  else{

    $cer_err41 = 0;

  }

  

    // Verificando qual é o codigo da resposta escolhida -- Per 41

  if ($_POST['radper41'] == "Letra A"){

    $codigo_resposta41 = $letraaper41['codigo_resposta'];

  }elseif ($_POST['radper41'] == "Letra B"){

    $codigo_resposta41 = $letrabper41['codigo_resposta'];

  }elseif ($_POST['radper41'] == "Letra C"){

    $codigo_resposta41 = $letracper41['codigo_resposta'];

  }elseif ($_POST['radper41'] == "Letra D"){

    $codigo_resposta41 = $letradper41['codigo_resposta'];

  }elseif ($_POST['radper41'] == "Letra E"){

    $codigo_resposta41 = $letraeper41['codigo_resposta'];

  }

  

  // obtendo o codigo da disciplina da pergunta 41

  $codigo_disciplina41 = $per41['codigo_disciplina'];

  

  // Selecionando imagem 41

  $imgper41 = $per41['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp41 = $letraaper41['tipo'];

  

  

  //Questão 42

  $codper42 = $_SESSION['codper42'];

  $select_per42 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper42");

  $per42 = mysqli_fetch_assoc($select_per42);

  

  $select_letraaper42 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper42 and letra = 'a'");

  $letraaper42 = mysqli_fetch_assoc($select_letraaper42);

  $select_letrabper42 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper42 and letra = 'b'");

  $letrabper42 = mysqli_fetch_assoc($select_letrabper42);

  $select_letracper42 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper42 and letra = 'c'");

  $letracper42 = mysqli_fetch_assoc($select_letracper42);

  $select_letradper42 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper42 and letra = 'd'");

  $letradper42 = mysqli_fetch_assoc($select_letradper42);

  $select_letraeper42 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper42 and letra = 'e'");

  $letraeper42 = mysqli_fetch_assoc($select_letraeper42);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper42["correta"]==1){

  $alt_corr42 = "Letra A";

  $cora42 = $corcorr;
  $sima42 = " ✓";

  $corb42 = "black";
  $simb42 = "";

  $corc42 = "black";
  $simc42 = "";

  $cord42 = "black";
  $simd42 = "";

  $core42 = "black";
  $sime42 = "";

}

elseif ($letrabper42["correta"]==1){

  $alt_corr42 = "Letra B";

  $corb42 = $corcorr;
  $simb42 = " ✓";

  $cora42 = "black";
  $sima42 = "";

  $corc42 = "black";
  $simc42 = "";

  $cord42 = "black";
  $simd42 = "";

  $core42 = "black";
  $sime42 = "";

}

elseif ($letracper42["correta"]==1){

  $alt_corr42 = "Letra C";

  $corc42 = $corcorr;
  $simc42 = " ✓";

  $cora42 = "black";
  $sima42 = "";

  $corb42 = "black";
  $simb42 = "";

  $cord42 = "black";
  $simd42 = "";

  $core42 = "black";
  $sime42 = "";

}

elseif ($letradper42["correta"]==1){

  $alt_corr42 = "Letra D";

  $cord42 = $corcorr;
  $simd42 = " ✓";

  $cora42 = "black";
  $sima42 = "";

  $corc42 = "black";
  $simc42 = "";

  $corb42 = "black";
  $simb42 = "";

  $core42 = "black";
  $sime42 = "";

}

elseif ($letraeper42["correta"]==1){

  $alt_corr42 = "Letra E";

  $core42 = $corcorr;
  $sime42 = " ✓";

  $cora42 = "black";
  $sima42 = "";

  $corc42 = "black";
  $simc42 = "";

  $cord42 = "black";
  $simd42 = "";

  $corb42 = "black";
  $simb42 = "";

}

//Errada

if ($alt_corr42 != $_POST['radper42'] && $_POST['radper42'] == "Letra A"){

  $cora42 = $corerr;
  $sima42 = " X";

}

elseif ($alt_corr42 != $_POST['radper42'] && $_POST['radper42'] == "Letra B"){

  $corb42 = $corerr;
  $simb42 = " X";

}

elseif ($alt_corr42 != $_POST['radper42'] && $_POST['radper42'] == "Letra C"){

  $corc42 = $corerr;
  $simc42 = " X";

}

elseif ($alt_corr42 != $_POST['radper42'] && $_POST['radper42'] == "Letra D"){

  $cord42 = $corerr;
  $simd42 = " X";

}

elseif ($alt_corr42 != $_POST['radper42'] && $_POST['radper42'] == "Letra E"){

  $core42 = $corerr;
  $sime42 = " X";

}

  

  // Verficando qual será checado 42

  if ($_POST['radper42'] == "Letra A"){

    $chea42 = "Checked";

    $cheb42 = "";

    $chec42 = "";

    $ched42 = "";

    $chee42 = "";

  }elseif ($_POST['radper42'] == "Letra B"){

    $chea42 = "";

    $cheb42 = "Checked";

    $chec42 = "";

    $ched42 = "";

    $chee42 = "";

  }elseif ($_POST['radper42'] == "Letra C"){

    $chea42 = "";

    $cheb42 = "";

    $chec42 = "Checked";

    $ched42 = "";

    $chee42 = "";

  }elseif ($_POST['radper42'] == "Letra D"){

    $chea42 = "";

    $cheb42 = "";

    $chec42 = "";

    $ched42 = "Checked";

    $chee42 = "";

  }elseif ($_POST['radper42'] == "Letra E"){

    $chea42 = "";

    $cheb42 = "";

    $chec42 = "";

    $ched42 = "";

    $chee42 = "Checked";

  }

  

  // Verificando se respsota esta correta 42

  if ($_POST['radper42'] == $alt_corr42){

    $contrescorr = $contrescorr + 1;

    $cer_err42 = 1;

}

else{

  $cer_err42 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 42

if ($_POST['radper42'] == "Letra A"){

  $codigo_resposta42 = $letraaper42['codigo_resposta'];

}elseif ($_POST['radper42'] == "Letra B"){

  $codigo_resposta42 = $letrabper42['codigo_resposta'];

}elseif ($_POST['radper42'] == "Letra C"){

  $codigo_resposta42 = $letracper42['codigo_resposta'];

}elseif ($_POST['radper42'] == "Letra D"){

  $codigo_resposta42 = $letradper42['codigo_resposta'];

}elseif ($_POST['radper42'] == "Letra E"){

  $codigo_resposta42 = $letraeper42['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 42

$codigo_disciplina42 = $per42['codigo_disciplina'];

  

  // Selecionando imagem 42

  $imgper42 = $per42['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp42 = $letraaper42['tipo'];

  

  

  //Questão 43

  $codper43 = $_SESSION['codper43'];

  $select_per43 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper43");

  $per43 = mysqli_fetch_assoc($select_per43);

  

  $select_letraaper43 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper43 and letra = 'a'");

  $letraaper43 = mysqli_fetch_assoc($select_letraaper43);

  $select_letrabper43 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper43 and letra = 'b'");

  $letrabper43 = mysqli_fetch_assoc($select_letrabper43);

  $select_letracper43 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper43 and letra = 'c'");

  $letracper43 = mysqli_fetch_assoc($select_letracper43);

  $select_letradper43 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper43 and letra = 'd'");

  $letradper43 = mysqli_fetch_assoc($select_letradper43);

  $select_letraeper43 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper43 and letra = 'e'");

  $letraeper43 = mysqli_fetch_assoc($select_letraeper43);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper43["correta"]==1){

  $alt_corr43 = "Letra A";

  $cora43 = $corcorr;
  $sima43 = " ✓";

  $corb43 = "black";
  $simb43 = "";

  $corc43 = "black";
  $simc43 = "";

  $cord43 = "black";
  $simd43 = "";

  $core43 = "black";
  $sime43 = "";

}

elseif ($letrabper43["correta"]==1){

  $alt_corr43 = "Letra B";

  $corb43 = $corcorr;
  $simb43 = " ✓";

  $cora43 = "black";
  $sima43 = "";

  $corc43 = "black";
  $simc43 = "";

  $cord43 = "black";
  $simd43 = "";

  $core43 = "black";
  $sime43 = "";

}

elseif ($letracper43["correta"]==1){

  $alt_corr43 = "Letra C";

  $corc43 = $corcorr;
  $simc43 = " ✓";

  $cora43 = "black";
  $sima43 = "";

  $corb43 = "black";
  $simb43 = "";

  $cord43 = "black";
  $simd43 = "";

  $core43 = "black";
  $sime43 = "";

}

elseif ($letradper43["correta"]==1){

  $alt_corr43 = "Letra D";

  $cord43 = $corcorr;
  $simd43 = " ✓";

  $cora43 = "black";
  $sima43 = "";

  $corc43 = "black";
  $simc43 = "";

  $corb43 = "black";
  $simb43 = "";

  $core43 = "black";
  $sime43 = "";

}

elseif ($letraeper43["correta"]==1){

  $alt_corr43 = "Letra E";

  $core43 = $corcorr;
  $sime43 = " ✓";

  $cora43 = "black";
  $sima43 = "";

  $corc43 = "black";
  $simc43 = "";

  $cord43 = "black";
  $simd43 = "";

  $corb43 = "black";
  $simb43 = "";

}

//Errada

if ($alt_corr43 != $_POST['radper43'] && $_POST['radper43'] == "Letra A"){

  $cora43 = $corerr;
  $sima43 = " X";

}

elseif ($alt_corr43 != $_POST['radper43'] && $_POST['radper43'] == "Letra B"){

  $corb43 = $corerr;
  $simb43 = " X";

}

elseif ($alt_corr43 != $_POST['radper43'] && $_POST['radper43'] == "Letra C"){

  $corc43 = $corerr;
  $simc43 = " X";

}

elseif ($alt_corr43 != $_POST['radper43'] && $_POST['radper43'] == "Letra D"){

  $cord43 = $corerr;
  $simd43 = " X";

}

elseif ($alt_corr43 != $_POST['radper43'] && $_POST['radper43'] == "Letra E"){

  $core43 = $corerr;
  $sime43 = " X";

}

  

  // Verficando qual será checado 43

  if ($_POST['radper43'] == "Letra A"){

    $chea43 = "Checked";

    $cheb43 = "";

    $chec43 = "";

    $ched43 = "";

    $chee43 = "";

  }elseif ($_POST['radper43'] == "Letra B"){

    $chea43 = "";

    $cheb43 = "Checked";

    $chec43 = "";

    $ched43 = "";

    $chee43 = "";

  }elseif ($_POST['radper43'] == "Letra C"){

    $chea43 = "";

    $cheb43 = "";

    $chec43 = "Checked";

    $ched43 = "";

    $chee43 = "";

  }elseif ($_POST['radper43'] == "Letra D"){

    $chea43 = "";

    $cheb43 = "";

    $chec43 = "";

    $ched43 = "Checked";

    $chee43 = "";

  }elseif ($_POST['radper43'] == "Letra E"){

    $chea43 = "";

    $cheb43 = "";

    $chec43 = "";

    $ched43 = "";

    $chee43 = "Checked";

  }

  

  // Verificando se respsota esta correta 43

  if ($_POST['radper43'] == $alt_corr43){

    $contrescorr = $contrescorr + 1;

    $cer_err43 = 1;

  }

  else{

    $cer_err43 = 0;

  }

  

    // Verificando qual é o codigo da resposta escolhida -- Per 43

  if ($_POST['radper43'] == "Letra A"){

    $codigo_resposta43 = $letraaper43['codigo_resposta'];

  }elseif ($_POST['radper43'] == "Letra B"){

    $codigo_resposta43 = $letrabper43['codigo_resposta'];

  }elseif ($_POST['radper43'] == "Letra C"){

    $codigo_resposta43 = $letracper43['codigo_resposta'];

  }elseif ($_POST['radper43'] == "Letra D"){

    $codigo_resposta43 = $letradper43['codigo_resposta'];

  }elseif ($_POST['radper43'] == "Letra E"){

    $codigo_resposta43 = $letraeper43['codigo_resposta'];

  }

  

  // obtendo o codigo da disciplina da pergunta 43

  $codigo_disciplina43 = $per43['codigo_disciplina'];

  

  // Selecionando imagem 43

  $imgper43 = $per43['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp43 = $letraaper43['tipo'];

  

  

  //Questão 44

  $codper44 = $_SESSION['codper44'];

  $select_per44 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper44");

  $per44 = mysqli_fetch_assoc($select_per44);

  

  $select_letraaper44 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper44 and letra = 'a'");

  $letraaper44 = mysqli_fetch_assoc($select_letraaper44);

  $select_letrabper44 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper44 and letra = 'b'");

  $letrabper44 = mysqli_fetch_assoc($select_letrabper44);

  $select_letracper44 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper44 and letra = 'c'");

  $letracper44 = mysqli_fetch_assoc($select_letracper44);

  $select_letradper44 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper44 and letra = 'd'");

  $letradper44 = mysqli_fetch_assoc($select_letradper44);

  $select_letraeper44 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper44 and letra = 'e'");

  $letraeper44 = mysqli_fetch_assoc($select_letraeper44);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper44["correta"]==1){

  $alt_corr44 = "Letra A";

  $cora44 = $corcorr;
  $sima44 = " ✓";

  $corb44 = "black";
  $simb44 = "";

  $corc44 = "black";
  $simc44 = "";

  $cord44 = "black";
  $simd44 = "";

  $core44 = "black";
  $sime44 = "";

}

elseif ($letrabper44["correta"]==1){

  $alt_corr44 = "Letra B";

  $corb44 = $corcorr;
  $simb44 = " ✓";

  $cora44 = "black";
  $sima44 = "";

  $corc44 = "black";
  $simc44 = "";

  $cord44 = "black";
  $simd44 = "";

  $core44 = "black";
  $sime44 = "";

}

elseif ($letracper44["correta"]==1){

  $alt_corr44 = "Letra C";

  $corc44 = $corcorr;
  $simc44 = " ✓";

  $cora44 = "black";
  $sima44 = "";

  $corb44 = "black";
  $simb44 = "";

  $cord44 = "black";
  $simd44 = "";

  $core44 = "black";
  $sime44 = "";

}

elseif ($letradper44["correta"]==1){

  $alt_corr44 = "Letra D";

  $cord44 = $corcorr;
  $simd44 = " ✓";

  $cora44 = "black";
  $sima44 = "";

  $corc44 = "black";
  $simc44 = "";

  $corb44 = "black";
  $simb44 = "";

  $core44 = "black";
  $sime44 = "";

}

elseif ($letraeper44["correta"]==1){

  $alt_corr44 = "Letra E";

  $core44 = $corcorr;
  $sime44 = " ✓";

  $cora44 = "black";
  $sima44 = "";

  $corc44 = "black";
  $simc44 = "";

  $cord44 = "black";
  $simd44 = "";

  $corb44 = "black";
  $simb44 = "";

}

//Errada

if ($alt_corr44 != $_POST['radper44'] && $_POST['radper44'] == "Letra A"){

  $cora44 = $corerr;
  $sima44 = " X";

}

elseif ($alt_corr44 != $_POST['radper44'] && $_POST['radper44'] == "Letra B"){

  $corb44 = $corerr;
  $simb44 = " X";

}

elseif ($alt_corr44 != $_POST['radper44'] && $_POST['radper44'] == "Letra C"){

  $corc44 = $corerr;
  $simc44 = " X";

}

elseif ($alt_corr44 != $_POST['radper44'] && $_POST['radper44'] == "Letra D"){

  $cord44 = $corerr;
  $simd44 = " X";

}

elseif ($alt_corr44 != $_POST['radper44'] && $_POST['radper44'] == "Letra E"){

  $core44 = $corerr;
  $sime44 = " X";

}

  

  // Verficando qual será checado 44

  if ($_POST['radper44'] == "Letra A"){

    $chea44 = "Checked";

    $cheb44 = "";

    $chec44 = "";

    $ched44 = "";

    $chee44 = "";

  }elseif ($_POST['radper44'] == "Letra B"){

    $chea44 = "";

    $cheb44 = "Checked";

    $chec44 = "";

    $ched44 = "";

    $chee44 = "";

  }elseif ($_POST['radper44'] == "Letra C"){

    $chea44 = "";

    $cheb44 = "";

    $chec44 = "Checked";

    $ched44 = "";

    $chee44 = "";

  }elseif ($_POST['radper44'] == "Letra D"){

    $chea44 = "";

    $cheb44 = "";

    $chec44 = "";

    $ched44 = "Checked";

    $chee44 = "";

  }elseif ($_POST['radper44'] == "Letra E"){

    $chea44 = "";

    $cheb44 = "";

    $chec44 = "";

    $ched44 = "";

    $chee44 = "Checked";

  }

  

  // Verificando se respsota esta correta 44

  if ($_POST['radper44'] == $alt_corr44){

    $contrescorr = $contrescorr + 1;

    $cer_err44 = 1;

}

else{

  $cer_err44 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 44

if ($_POST['radper44'] == "Letra A"){

  $codigo_resposta44 = $letraaper44['codigo_resposta'];

}elseif ($_POST['radper44'] == "Letra B"){

  $codigo_resposta44 = $letrabper44['codigo_resposta'];

}elseif ($_POST['radper44'] == "Letra C"){

  $codigo_resposta44 = $letracper44['codigo_resposta'];

}elseif ($_POST['radper44'] == "Letra D"){

  $codigo_resposta44 = $letradper44['codigo_resposta'];

}elseif ($_POST['radper44'] == "Letra E"){

  $codigo_resposta44 = $letraeper44['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 44

$codigo_disciplina44 = $per44['codigo_disciplina'];

  

  // Selecionando imagem 44

  $imgper44 = $per44['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp44 = $letraaper44['tipo'];

  

  

  //Questão 45

  $codper45 = $_SESSION['codper45'];

  $select_per45 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper45");

  $per45 = mysqli_fetch_assoc($select_per45);

  

  $select_letraaper45 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper45 and letra = 'a'");

  $letraaper45 = mysqli_fetch_assoc($select_letraaper45);

  $select_letrabper45 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper45 and letra = 'b'");

  $letrabper45 = mysqli_fetch_assoc($select_letrabper45);

  $select_letracper45 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper45 and letra = 'c'");

  $letracper45 = mysqli_fetch_assoc($select_letracper45);

  $select_letradper45 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper45 and letra = 'd'");

  $letradper45 = mysqli_fetch_assoc($select_letradper45);

  $select_letraeper45 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper45 and letra = 'e'");

  $letraeper45 = mysqli_fetch_assoc($select_letraeper45);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper45["correta"]==1){

  $alt_corr45 = "Letra A";

  $cora45 = $corcorr;
  $sima45 = " ✓";

  $corb45 = "black";
  $simb45 = "";

  $corc45 = "black";
  $simc45 = "";

  $cord45 = "black";
  $simd45 = "";

  $core45 = "black";
  $sime45 = "";

}

elseif ($letrabper45["correta"]==1){

  $alt_corr45 = "Letra B";

  $corb45 = $corcorr;
  $simb45 = " ✓";

  $cora45 = "black";
  $sima45 = "";

  $corc45 = "black";
  $simc45 = "";

  $cord45 = "black";
  $simd45 = "";

  $core45 = "black";
  $sime45 = "";

}

elseif ($letracper45["correta"]==1){

  $alt_corr45 = "Letra C";

  $corc45 = $corcorr;
  $simc45 = " ✓";

  $cora45 = "black";
  $sima45 = "";

  $corb45 = "black";
  $simb45 = "";

  $cord45 = "black";
  $simd45 = "";

  $core45 = "black";
  $sime45 = "";

}

elseif ($letradper45["correta"]==1){

  $alt_corr45 = "Letra D";

  $cord45 = $corcorr;
  $simd45 = " ✓";

  $cora45 = "black";
  $sima45 = "";

  $corc45 = "black";
  $simc45 = "";

  $corb45 = "black";
  $simb45 = "";

  $core45 = "black";
  $sime45 = "";

}

elseif ($letraeper45["correta"]==1){

  $alt_corr45 = "Letra E";

  $core45 = $corcorr;
  $sime45 = " ✓";

  $cora45 = "black";
  $sima45 = "";

  $corc45 = "black";
  $simc45 = "";

  $cord45 = "black";
  $simd45 = "";

  $corb45 = "black";
  $simb45 = "";

}

//Errada

if ($alt_corr45 != $_POST['radper45'] && $_POST['radper45'] == "Letra A"){

  $cora45 = $corerr;
  $sima45 = " X";

}

elseif ($alt_corr45 != $_POST['radper45'] && $_POST['radper45'] == "Letra B"){

  $corb45 = $corerr;
  $simb45 = " X";

}

elseif ($alt_corr45 != $_POST['radper45'] && $_POST['radper45'] == "Letra C"){

  $corc45 = $corerr;
  $simc45 = " X";

}

elseif ($alt_corr45 != $_POST['radper45'] && $_POST['radper45'] == "Letra D"){

  $cord45 = $corerr;
  $simd45 = " X";

}

elseif ($alt_corr45 != $_POST['radper45'] && $_POST['radper45'] == "Letra E"){

  $core45 = $corerr;
  $sime45 = " X";

}

  

  // Verficando qual será checado 45

  if ($_POST['radper45'] == "Letra A"){

    $chea45 = "Checked";

    $cheb45 = "";

    $chec45 = "";

    $ched45 = "";

    $chee45 = "";

  }elseif ($_POST['radper45'] == "Letra B"){

    $chea45 = "";

    $cheb45 = "Checked";

    $chec45 = "";

    $ched45 = "";

    $chee45 = "";

  }elseif ($_POST['radper45'] == "Letra C"){

    $chea45 = "";

    $cheb45 = "";

    $chec45 = "Checked";

    $ched45 = "";

    $chee45 = "";

  }elseif ($_POST['radper45'] == "Letra D"){

    $chea45 = "";

    $cheb45 = "";

    $chec45 = "";

    $ched45 = "Checked";

    $chee45 = "";

  }elseif ($_POST['radper45'] == "Letra E"){

    $chea45 = "";

    $cheb45 = "";

    $chec45 = "";

    $ched45 = "";

    $chee45 = "Checked";

  }

  

  // Verificando se respsota esta correta 45

  if ($_POST['radper45'] == $alt_corr45){

    $contrescorr = $contrescorr + 1;

    $cer_err45 = 1;

}

else{

  $cer_err45 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 45

if ($_POST['radper45'] == "Letra A"){

  $codigo_resposta45 = $letraaper45['codigo_resposta'];

}elseif ($_POST['radper45'] == "Letra B"){

  $codigo_resposta45 = $letrabper45['codigo_resposta'];

}elseif ($_POST['radper45'] == "Letra C"){

  $codigo_resposta45 = $letracper45['codigo_resposta'];

}elseif ($_POST['radper45'] == "Letra D"){

  $codigo_resposta45 = $letradper45['codigo_resposta'];

}elseif ($_POST['radper45'] == "Letra E"){

  $codigo_resposta45 = $letraeper45['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 45

$codigo_disciplina45 = $per45['codigo_disciplina'];

  

  // Selecionando imagem 45

  $imgper45 = $per45['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp45 = $letraaper45['tipo'];

  

  }





  // Verificando se existe perguntas de 46 à 50

if ($qtperguntas>45){



  //Questão 46

  $codper46 = $_SESSION['codper46'];

  $select_per46 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper46");

  $per46 = mysqli_fetch_assoc($select_per46);

  

  $select_letraaper46 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper46 and letra = 'a'");

  $letraaper46 = mysqli_fetch_assoc($select_letraaper46);

  $select_letrabper46 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper46 and letra = 'b'");

  $letrabper46 = mysqli_fetch_assoc($select_letrabper46);

  $select_letracper46 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper46 and letra = 'c'");

  $letracper46 = mysqli_fetch_assoc($select_letracper46);

  $select_letradper46 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper46 and letra = 'd'");

  $letradper46 = mysqli_fetch_assoc($select_letradper46);

  $select_letraeper46 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper46 and letra = 'e'");

  $letraeper46 = mysqli_fetch_assoc($select_letraeper46);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper46["correta"]==1){

  $alt_corr46 = "Letra A";

  $cora46 = $corcorr;
  $sima46 = " ✓";

  $corb46 = "black";
  $simb46 = "";

  $corc46 = "black";
  $simc46 = "";

  $cord46 = "black";
  $simd46 = "";

  $core46 = "black";
  $sime46 = "";

}

elseif ($letrabper46["correta"]==1){

  $alt_corr46 = "Letra B";

  $corb46 = $corcorr;
  $simb46 = " ✓";

  $cora46 = "black";
  $sima46 = "";

  $corc46 = "black";
  $simc46 = "";

  $cord46 = "black";
  $simd46 = "";

  $core46 = "black";
  $sime46 = "";

}

elseif ($letracper46["correta"]==1){

  $alt_corr46 = "Letra C";

  $corc46 = $corcorr;
  $simc46 = " ✓";

  $cora46 = "black";
  $sima46 = "";

  $corb46 = "black";
  $simb46 = "";

  $cord46 = "black";
  $simd46 = "";

  $core46 = "black";
  $sime46 = "";

}

elseif ($letradper46["correta"]==1){

  $alt_corr46 = "Letra D";

  $cord46 = $corcorr;
  $simd46 = " ✓";

  $cora46 = "black";
  $sima46 = "";

  $corc46 = "black";
  $simc46 = "";

  $corb46 = "black";
  $simb46 = "";

  $core46 = "black";
  $sime46 = "";

}

elseif ($letraeper46["correta"]==1){

  $alt_corr46 = "Letra E";

  $core46 = $corcorr;
  $sime46 = " ✓";

  $cora46 = "black";
  $sima46 = "";

  $corc46 = "black";
  $simc46 = "";

  $cord46 = "black";
  $simd46 = "";

  $corb46 = "black";
  $simb46 = "";

}

//Errada

if ($alt_corr46 != $_POST['radper46'] && $_POST['radper46'] == "Letra A"){

  $cora46 = $corerr;
  $sima46 = " X";

}

elseif ($alt_corr46 != $_POST['radper46'] && $_POST['radper46'] == "Letra B"){

  $corb46 = $corerr;
  $simb46 = " X";

}

elseif ($alt_corr46 != $_POST['radper46'] && $_POST['radper46'] == "Letra C"){

  $corc46 = $corerr;
  $simc46 = " X";

}

elseif ($alt_corr46 != $_POST['radper46'] && $_POST['radper46'] == "Letra D"){

  $cord46 = $corerr;
  $simd46 = " X";

}

elseif ($alt_corr46 != $_POST['radper46'] && $_POST['radper46'] == "Letra E"){

  $core46 = $corerr;
  $sime46 = " X";

}

  

  // Verficando qual será checado 46

  if ($_POST['radper46'] == "Letra A"){

    $chea46 = "Checked";

    $cheb46 = "";

    $chec46 = "";

    $ched46 = "";

    $chee46 = "";

  }elseif ($_POST['radper46'] == "Letra B"){

    $chea46 = "";

    $cheb46 = "Checked";

    $chec46 = "";

    $ched46 = "";

    $chee46 = "";

  }elseif ($_POST['radper46'] == "Letra C"){

    $chea46 = "";

    $cheb46 = "";

    $chec46 = "Checked";

    $ched46 = "";

    $chee46 = "";

  }elseif ($_POST['radper46'] == "Letra D"){

    $chea46 = "";

    $cheb46 = "";

    $chec46 = "";

    $ched46 = "Checked";

    $chee46 = "";

  }elseif ($_POST['radper46'] == "Letra E"){

    $chea46 = "";

    $cheb46 = "";

    $chec46 = "";

    $ched46 = "";

    $chee46 = "Checked";

  }

  

  // Verificando se respsota esta correta 46

  if ($_POST['radper46'] == $alt_corr46){

    $contrescorr = $contrescorr + 1;

    $cer_err46 = 1;

}

else{

  $cer_err46 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 46

if ($_POST['radper46'] == "Letra A"){

  $codigo_resposta46 = $letraaper46['codigo_resposta'];

}elseif ($_POST['radper46'] == "Letra B"){

  $codigo_resposta46 = $letrabper46['codigo_resposta'];

}elseif ($_POST['radper46'] == "Letra C"){

  $codigo_resposta46 = $letracper46['codigo_resposta'];

}elseif ($_POST['radper46'] == "Letra D"){

  $codigo_resposta46 = $letradper46['codigo_resposta'];

}elseif ($_POST['radper46'] == "Letra E"){

  $codigo_resposta46 = $letraeper46['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 46

$codigo_disciplina46 = $per46['codigo_disciplina'];

  

  // Selecionando imagem 46

  $imgper46 = $per46['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp46 = $letraaper46['tipo'];

  

  

  //Questão 47

  $codper47 = $_SESSION['codper47'];

  $select_per47 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper47");

  $per47 = mysqli_fetch_assoc($select_per47);

  

  $select_letraaper47 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper47 and letra = 'a'");

  $letraaper47 = mysqli_fetch_assoc($select_letraaper47);

  $select_letrabper47 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper47 and letra = 'b'");

  $letrabper47 = mysqli_fetch_assoc($select_letrabper47);

  $select_letracper47 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper47 and letra = 'c'");

  $letracper47 = mysqli_fetch_assoc($select_letracper47);

  $select_letradper47 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper47 and letra = 'd'");

  $letradper47 = mysqli_fetch_assoc($select_letradper47);

  $select_letraeper47 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper47 and letra = 'e'");

  $letraeper47 = mysqli_fetch_assoc($select_letraeper47);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper47["correta"]==1){

  $alt_corr47 = "Letra A";

  $cora47 = $corcorr;
  $sima47 = " ✓";

  $corb47 = "black";
  $simb47 = "";

  $corc47 = "black";
  $simc47 = "";

  $cord47 = "black";
  $simd47 = "";

  $core47 = "black";
  $sime47 = "";

}

elseif ($letrabper47["correta"]==1){

  $alt_corr47 = "Letra B";

  $corb47 = $corcorr;
  $simb47 = " ✓";

  $cora47 = "black";
  $sima47 = "";

  $corc47 = "black";
  $simc47 = "";

  $cord47 = "black";
  $simd47 = "";

  $core47 = "black";
  $sime47 = "";

}

elseif ($letracper47["correta"]==1){

  $alt_corr47 = "Letra C";

  $corc47 = $corcorr;
  $simc47 = " ✓";

  $cora47 = "black";
  $sima47 = "";

  $corb47 = "black";
  $simb47 = "";

  $cord47 = "black";
  $simd47 = "";

  $core47 = "black";
  $sime47 = "";

}

elseif ($letradper47["correta"]==1){

  $alt_corr47 = "Letra D";

  $cord47 = $corcorr;
  $simd47 = " ✓";

  $cora47 = "black";
  $sima47 = "";

  $corc47 = "black";
  $simc47 = "";

  $corb47 = "black";
  $simb47 = "";

  $core47 = "black";
  $sime47 = "";

}

elseif ($letraeper47["correta"]==1){

  $alt_corr47 = "Letra E";

  $core47 = $corcorr;
  $sime47 = " ✓";

  $cora47 = "black";
  $sima47 = "";

  $corc47 = "black";
  $simc47 = "";

  $cord47 = "black";
  $simd47 = "";

  $corb47 = "black";
  $simb47 = "";

}

//Errada

if ($alt_corr47 != $_POST['radper47'] && $_POST['radper47'] == "Letra A"){

  $cora47 = $corerr;
  $sima47 = " X";

}

elseif ($alt_corr47 != $_POST['radper47'] && $_POST['radper47'] == "Letra B"){

  $corb47 = $corerr;
  $simb47 = " X";

}

elseif ($alt_corr47 != $_POST['radper47'] && $_POST['radper47'] == "Letra C"){

  $corc47 = $corerr;
  $simc47 = " X";

}

elseif ($alt_corr47 != $_POST['radper47'] && $_POST['radper47'] == "Letra D"){

  $cord47 = $corerr;
  $simd47 = " X";

}

elseif ($alt_corr47 != $_POST['radper47'] && $_POST['radper47'] == "Letra E"){

  $core47 = $corerr;
  $sime47 = " X";

}

  

  // Verficando qual será checado 47

  if ($_POST['radper47'] == "Letra A"){

    $chea47 = "Checked";

    $cheb47 = "";

    $chec47 = "";

    $ched47 = "";

    $chee47 = "";

  }elseif ($_POST['radper47'] == "Letra B"){

    $chea47 = "";

    $cheb47 = "Checked";

    $chec47 = "";

    $ched47 = "";

    $chee47 = "";

  }elseif ($_POST['radper47'] == "Letra C"){

    $chea47 = "";

    $cheb47 = "";

    $chec47 = "Checked";

    $ched47 = "";

    $chee47 = "";

  }elseif ($_POST['radper47'] == "Letra D"){

    $chea47 = "";

    $cheb47 = "";

    $chec47 = "";

    $ched47 = "Checked";

    $chee47 = "";

  }elseif ($_POST['radper47'] == "Letra E"){

    $chea47 = "";

    $cheb47 = "";

    $chec47 = "";

    $ched47 = "";

    $chee47 = "Checked";

  }

  

  // Verificando se respsota esta correta 47

  if ($_POST['radper47'] == $alt_corr47){

    $contrescorr = $contrescorr + 1;

    $cer_err47 = 1;

}

else{

  $cer_err47 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 47

if ($_POST['radper47'] == "Letra A"){

  $codigo_resposta47 = $letraaper47['codigo_resposta'];

}elseif ($_POST['radper47'] == "Letra B"){

  $codigo_resposta47 = $letrabper47['codigo_resposta'];

}elseif ($_POST['radper47'] == "Letra C"){

  $codigo_resposta47 = $letracper47['codigo_resposta'];

}elseif ($_POST['radper47'] == "Letra D"){

  $codigo_resposta47 = $letradper47['codigo_resposta'];

}elseif ($_POST['radper47'] == "Letra E"){

  $codigo_resposta47 = $letraeper47['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 47

$codigo_disciplina47 = $per47['codigo_disciplina'];

  

  // Selecionando imagem 47

  $imgper47 = $per47['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp47 = $letraaper47['tipo'];

  

  

  //Questão 48

  $codper48 = $_SESSION['codper48'];

  $select_per48 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper48");

  $per48 = mysqli_fetch_assoc($select_per48);

  

  $select_letraaper48 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper48 and letra = 'a'");

  $letraaper48 = mysqli_fetch_assoc($select_letraaper48);

  $select_letrabper48 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper48 and letra = 'b'");

  $letrabper48 = mysqli_fetch_assoc($select_letrabper48);

  $select_letracper48 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper48 and letra = 'c'");

  $letracper48 = mysqli_fetch_assoc($select_letracper48);

  $select_letradper48 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper48 and letra = 'd'");

  $letradper48 = mysqli_fetch_assoc($select_letradper48);

  $select_letraeper48 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper48 and letra = 'e'");

  $letraeper48 = mysqli_fetch_assoc($select_letraeper48);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper48["correta"]==1){

  $alt_corr48 = "Letra A";

  $cora48 = $corcorr;
  $sima48 = " ✓";

  $corb48 = "black";
  $simb48 = "";

  $corc48 = "black";
  $simc48 = "";

  $cord48 = "black";
  $simd48 = "";

  $core48 = "black";
  $sime48 = "";

}

elseif ($letrabper48["correta"]==1){

  $alt_corr48 = "Letra B";

  $corb48 = $corcorr;
  $simb48 = " ✓";

  $cora48 = "black";
  $sima48 = "";

  $corc48 = "black";
  $simc48 = "";

  $cord48 = "black";
  $simd48 = "";

  $core48 = "black";
  $sime48 = "";

}

elseif ($letracper48["correta"]==1){

  $alt_corr48 = "Letra C";

  $corc48 = $corcorr;
  $simc48 = " ✓";

  $cora48 = "black";
  $sima48 = "";

  $corb48 = "black";
  $simb48 = "";

  $cord48 = "black";
  $simd48 = "";

  $core48 = "black";
  $sime48 = "";

}

elseif ($letradper48["correta"]==1){

  $alt_corr48 = "Letra D";

  $cord48 = $corcorr;
  $simd48 = " ✓";

  $cora48 = "black";
  $sima48 = "";

  $corc48 = "black";
  $simc48 = "";

  $corb48 = "black";
  $simb48 = "";

  $core48 = "black";
  $sime48 = "";

}

elseif ($letraeper48["correta"]==1){

  $alt_corr48 = "Letra E";

  $core48 = $corcorr;
  $sime48 = " ✓";

  $cora48 = "black";
  $sima48 = "";

  $corc48 = "black";
  $simc48 = "";

  $cord48 = "black";
  $simd48 = "";

  $corb48 = "black";
  $simb48 = "";

}

//Errada

if ($alt_corr48 != $_POST['radper48'] && $_POST['radper48'] == "Letra A"){

  $cora48 = $corerr;
  $sima48 = " X";

}

elseif ($alt_corr48 != $_POST['radper48'] && $_POST['radper48'] == "Letra B"){

  $corb48 = $corerr;
  $simb48 = " X";

}

elseif ($alt_corr48 != $_POST['radper48'] && $_POST['radper48'] == "Letra C"){

  $corc48 = $corerr;
  $simc48 = " X";

}

elseif ($alt_corr48 != $_POST['radper48'] && $_POST['radper48'] == "Letra D"){

  $cord48 = $corerr;
  $simd48 = " X";

}

elseif ($alt_corr48 != $_POST['radper48'] && $_POST['radper48'] == "Letra E"){

  $core48 = $corerr;
  $sime48 = " X";

}

  

  // Verficando qual será checado 48

  if ($_POST['radper48'] == "Letra A"){

    $chea48 = "Checked";

    $cheb48 = "";

    $chec48 = "";

    $ched48 = "";

    $chee48 = "";

  }elseif ($_POST['radper48'] == "Letra B"){

    $chea48 = "";

    $cheb48 = "Checked";

    $chec48 = "";

    $ched48 = "";

    $chee48 = "";

  }elseif ($_POST['radper48'] == "Letra C"){

    $chea48 = "";

    $cheb48 = "";

    $chec48 = "Checked";

    $ched48 = "";

    $chee48 = "";

  }elseif ($_POST['radper48'] == "Letra D"){

    $chea48 = "";

    $cheb48 = "";

    $chec48 = "";

    $ched48 = "Checked";

    $chee48 = "";

  }elseif ($_POST['radper48'] == "Letra E"){

    $chea48 = "";

    $cheb48 = "";

    $chec48 = "";

    $ched48 = "";

    $chee48 = "Checked";

  }

  

  // Verificando se respsota esta correta 48

  if ($_POST['radper48'] == $alt_corr48){

    $contrescorr = $contrescorr + 1;

    $cer_err48 = 1;

}

else{

  $cer_err48 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 48

if ($_POST['radper48'] == "Letra A"){

  $codigo_resposta48 = $letraaper48['codigo_resposta'];

}elseif ($_POST['radper48'] == "Letra B"){

  $codigo_resposta48 = $letrabper48['codigo_resposta'];

}elseif ($_POST['radper48'] == "Letra C"){

  $codigo_resposta48 = $letracper48['codigo_resposta'];

}elseif ($_POST['radper48'] == "Letra D"){

  $codigo_resposta48 = $letradper48['codigo_resposta'];

}elseif ($_POST['radper48'] == "Letra E"){

  $codigo_resposta48 = $letraeper48['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 48

$codigo_disciplina48 = $per48['codigo_disciplina'];

  

  // Selecionando imagem 48

  $imgper48 = $per48['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp48 = $letraaper48['tipo'];

  

  

  //Questão 49

  $codper49 = $_SESSION['codper49'];

  $select_per49 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper49");

  $per49 = mysqli_fetch_assoc($select_per49);

  

  $select_letraaper49 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper49 and letra = 'a'");

  $letraaper49 = mysqli_fetch_assoc($select_letraaper49);

  $select_letrabper49 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper49 and letra = 'b'");

  $letrabper49 = mysqli_fetch_assoc($select_letrabper49);

  $select_letracper49 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper49 and letra = 'c'");

  $letracper49 = mysqli_fetch_assoc($select_letracper49);

  $select_letradper49 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper49 and letra = 'd'");

  $letradper49 = mysqli_fetch_assoc($select_letradper49);

  $select_letraeper49 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper49 and letra = 'e'");

  $letraeper49 = mysqli_fetch_assoc($select_letraeper49);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper49["correta"]==1){

  $alt_corr49 = "Letra A";

  $cora49 = $corcorr;
  $sima49 = " ✓";

  $corb49 = "black";
  $simb49 = "";

  $corc49 = "black";
  $simc49 = "";

  $cord49 = "black";
  $simd49 = "";

  $core49 = "black";
  $sime49 = "";

}

elseif ($letrabper49["correta"]==1){

  $alt_corr49 = "Letra B";

  $corb49 = $corcorr;
  $simb49 = " ✓";

  $cora49 = "black";
  $sima49 = "";

  $corc49 = "black";
  $simc49 = "";

  $cord49 = "black";
  $simd49 = "";

  $core49 = "black";
  $sime49 = "";

}

elseif ($letracper49["correta"]==1){

  $alt_corr49 = "Letra C";

  $corc49 = $corcorr;
  $simc49 = " ✓";

  $cora49 = "black";
  $sima49 = "";

  $corb49 = "black";
  $simb49 = "";

  $cord49 = "black";
  $simd49 = "";

  $core49 = "black";
  $sime49 = "";

}

elseif ($letradper49["correta"]==1){

  $alt_corr49 = "Letra D";

  $cord49 = $corcorr;
  $simd49 = " ✓";

  $cora49 = "black";
  $sima49 = "";

  $corc49 = "black";
  $simc49 = "";

  $corb49 = "black";
  $simb49 = "";

  $core49 = "black";
  $sime49 = "";

}

elseif ($letraeper49["correta"]==1){

  $alt_corr49 = "Letra E";

  $core49 = $corcorr;
  $sime49 = " ✓";

  $cora49 = "black";
  $sima49 = "";

  $corc49 = "black";
  $simc49 = "";

  $cord49 = "black";
  $simd49 = "";

  $corb49 = "black";
  $simb49 = "";

}

//Errada

if ($alt_corr49 != $_POST['radper49'] && $_POST['radper49'] == "Letra A"){

  $cora49 = $corerr;
  $sima49 = " X";

}

elseif ($alt_corr49 != $_POST['radper49'] && $_POST['radper49'] == "Letra B"){

  $corb49 = $corerr;
  $simb49 = " X";

}

elseif ($alt_corr49 != $_POST['radper49'] && $_POST['radper49'] == "Letra C"){

  $corc49 = $corerr;
  $simc49 = " X";

}

elseif ($alt_corr49 != $_POST['radper49'] && $_POST['radper49'] == "Letra D"){

  $cord49 = $corerr;
  $simd49 = " X";

}

elseif ($alt_corr49 != $_POST['radper49'] && $_POST['radper49'] == "Letra E"){

  $core49 = $corerr;
  $sime49 = " X";

}

  

  // Verficando qual será checado 49

  if ($_POST['radper49'] == "Letra A"){

    $chea49 = "Checked";

    $cheb49 = "";

    $chec49 = "";

    $ched49 = "";

    $chee49 = "";

  }elseif ($_POST['radper49'] == "Letra B"){

    $chea49 = "";

    $cheb49 = "Checked";

    $chec49 = "";

    $ched49 = "";

    $chee49 = "";

  }elseif ($_POST['radper49'] == "Letra C"){

    $chea49 = "";

    $cheb49 = "";

    $chec49 = "Checked";

    $ched49 = "";

    $chee49 = "";

  }elseif ($_POST['radper49'] == "Letra D"){

    $chea49 = "";

    $cheb49 = "";

    $chec49 = "";

    $ched49 = "Checked";

    $chee49 = "";

  }elseif ($_POST['radper49'] == "Letra E"){

    $chea49 = "";

    $cheb49 = "";

    $chec49 = "";

    $ched49 = "";

    $chee49 = "Checked";

  }

  

  // Verificando se respsota esta correta 49

  if ($_POST['radper49'] == $alt_corr49){

    $contrescorr = $contrescorr + 1;

    $cer_err49 = 1;

}

else{

  $cer_err49 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 49

if ($_POST['radper49'] == "Letra A"){

  $codigo_resposta49 = $letraaper49['codigo_resposta'];

}elseif ($_POST['radper49'] == "Letra B"){

  $codigo_resposta49 = $letrabper49['codigo_resposta'];

}elseif ($_POST['radper49'] == "Letra C"){

  $codigo_resposta49 = $letracper49['codigo_resposta'];

}elseif ($_POST['radper49'] == "Letra D"){

  $codigo_resposta49 = $letradper49['codigo_resposta'];

}elseif ($_POST['radper49'] == "Letra E"){

  $codigo_resposta49 = $letraeper49['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 49

$codigo_disciplina49 = $per49['codigo_disciplina'];

  

  // Selecionando imagem 49

  $imgper49 = $per49['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp49 = $letraaper49['tipo'];

  

  

  //Questão 50

  $codper50 = $_SESSION['codper50'];

  $select_per50 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper50");

  $per50 = mysqli_fetch_assoc($select_per50);

  

  $select_letraaper50 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper50 and letra = 'a'");

  $letraaper50 = mysqli_fetch_assoc($select_letraaper50);

  $select_letrabper50 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper50 and letra = 'b'");

  $letrabper50 = mysqli_fetch_assoc($select_letrabper50);

  $select_letracper50 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper50 and letra = 'c'");

  $letracper50 = mysqli_fetch_assoc($select_letracper50);

  $select_letradper50 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper50 and letra = 'd'");

  $letradper50 = mysqli_fetch_assoc($select_letradper50);

  $select_letraeper50 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper50 and letra = 'e'");

  $letraeper50 = mysqli_fetch_assoc($select_letraeper50);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper50["correta"]==1){

  $alt_corr50 = "Letra A";

  $cora50 = $corcorr;
  $sima50 = " ✓";

  $corb50 = "black";
  $simb50 = "";

  $corc50 = "black";
  $simc50 = "";

  $cord50 = "black";
  $simd50 = "";

  $core50 = "black";
  $sime50 = "";

}

elseif ($letrabper50["correta"]==1){

  $alt_corr50 = "Letra B";

  $corb50 = $corcorr;
  $simb50 = " ✓";

  $cora50 = "black";
  $sima50 = "";

  $corc50 = "black";
  $simc50 = "";

  $cord50 = "black";
  $simd50 = "";

  $core50 = "black";
  $sime50 = "";

}

elseif ($letracper50["correta"]==1){

  $alt_corr50 = "Letra C";

  $corc50 = $corcorr;
  $simc50 = " ✓";

  $cora50 = "black";
  $sima50 = "";

  $corb50 = "black";
  $simb50 = "";

  $cord50 = "black";
  $simd50 = "";

  $core50 = "black";
  $sime50 = "";

}

elseif ($letradper50["correta"]==1){

  $alt_corr50 = "Letra D";

  $cord50 = $corcorr;
  $simd50 = " ✓";

  $cora50 = "black";
  $sima50 = "";

  $corc50 = "black";
  $simc50 = "";

  $corb50 = "black";
  $simb50 = "";

  $core50 = "black";
  $sime50 = "";

}

elseif ($letraeper50["correta"]==1){

  $alt_corr50 = "Letra E";

  $core50 = $corcorr;
  $sime50 = " ✓";

  $cora50 = "black";
  $sima50 = "";

  $corc50 = "black";
  $simc50 = "";

  $cord50 = "black";
  $simd50 = "";

  $corb50 = "black";
  $simb50 = "";

}

//Errada

if ($alt_corr50 != $_POST['radper50'] && $_POST['radper50'] == "Letra A"){

  $cora50 = $corerr;
  $sima50 = " X";

}

elseif ($alt_corr50 != $_POST['radper50'] && $_POST['radper50'] == "Letra B"){

  $corb50 = $corerr;
  $simb50 = " X";

}

elseif ($alt_corr50 != $_POST['radper50'] && $_POST['radper50'] == "Letra C"){

  $corc50 = $corerr;
  $simc50 = " X";

}

elseif ($alt_corr50 != $_POST['radper50'] && $_POST['radper50'] == "Letra D"){

  $cord50 = $corerr;
  $simd50 = " X";

}

elseif ($alt_corr50 != $_POST['radper50'] && $_POST['radper50'] == "Letra E"){

  $core50 = $corerr;
  $sime50 = " X";

}

  

  // Verficando qual será checado 50

  if ($_POST['radper50'] == "Letra A"){

    $chea50 = "Checked";

    $cheb50 = "";

    $chec50 = "";

    $ched50 = "";

    $chee50 = "";

  }elseif ($_POST['radper50'] == "Letra B"){

    $chea50 = "";

    $cheb50 = "Checked";

    $chec50 = "";

    $ched50 = "";

    $chee50 = "";

  }elseif ($_POST['radper50'] == "Letra C"){

    $chea50 = "";

    $cheb50 = "";

    $chec50 = "Checked";

    $ched50 = "";

    $chee50 = "";

  }elseif ($_POST['radper50'] == "Letra D"){

    $chea50 = "";

    $cheb50 = "";

    $chec50 = "";

    $ched50 = "Checked";

    $chee50 = "";

  }elseif ($_POST['radper50'] == "Letra E"){

    $chea50 = "";

    $cheb50 = "";

    $chec50 = "";

    $ched50 = "";

    $chee50 = "Checked";

  }

  

  // Verificando se respsota esta correta 50

  if ($_POST['radper50'] == $alt_corr50){

    $contrescorr = $contrescorr + 1;

    $cer_err50 = 1;

}

else{

  $cer_err50 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 50

if ($_POST['radper50'] == "Letra A"){

  $codigo_resposta50 = $letraaper50['codigo_resposta'];

}elseif ($_POST['radper50'] == "Letra B"){

  $codigo_resposta50 = $letrabper50['codigo_resposta'];

}elseif ($_POST['radper50'] == "Letra C"){

  $codigo_resposta50 = $letracper50['codigo_resposta'];

}elseif ($_POST['radper50'] == "Letra D"){

  $codigo_resposta50 = $letradper50['codigo_resposta'];

}elseif ($_POST['radper50'] == "Letra E"){

  $codigo_resposta50 = $letraeper50['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 50

$codigo_disciplina50 = $per50['codigo_disciplina'];

  

  // Selecionando imagem 50

  $imgper50 = $per50['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp50 = $letraaper50['tipo'];

  

  }





  // Verificando se existe perguntas de 51 à 55

if ($qtperguntas>50){



  //Questão 51

  $codper51 = $_SESSION['codper51'];

  $select_per51 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper51");

  $per51 = mysqli_fetch_assoc($select_per51);

  

  $select_letraaper51 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper51 and letra = 'a'");

  $letraaper51 = mysqli_fetch_assoc($select_letraaper51);

  $select_letrabper51 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper51 and letra = 'b'");

  $letrabper51 = mysqli_fetch_assoc($select_letrabper51);

  $select_letracper51 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper51 and letra = 'c'");

  $letracper51 = mysqli_fetch_assoc($select_letracper51);

  $select_letradper51 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper51 and letra = 'd'");

  $letradper51 = mysqli_fetch_assoc($select_letradper51);

  $select_letraeper51 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper51 and letra = 'e'");

  $letraeper51 = mysqli_fetch_assoc($select_letraeper51);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper51["correta"]==1){

  $alt_corr51 = "Letra A";

  $cora51 = $corcorr;
  $sima51 = " ✓";

  $corb51 = "black";
  $simb51 = "";

  $corc51 = "black";
  $simc51 = "";

  $cord51 = "black";
  $simd51 = "";

  $core51 = "black";
  $sime51 = "";

}

elseif ($letrabper51["correta"]==1){

  $alt_corr51 = "Letra B";

  $corb51 = $corcorr;
  $simb51 = " ✓";

  $cora51 = "black";
  $sima51 = "";

  $corc51 = "black";
  $simc51 = "";

  $cord51 = "black";
  $simd51 = "";

  $core51 = "black";
  $sime51 = "";

}

elseif ($letracper51["correta"]==1){

  $alt_corr51 = "Letra C";

  $corc51 = $corcorr;
  $simc51 = " ✓";

  $cora51 = "black";
  $sima51 = "";

  $corb51 = "black";
  $simb51 = "";

  $cord51 = "black";
  $simd51 = "";

  $core51 = "black";
  $sime51 = "";

}

elseif ($letradper51["correta"]==1){

  $alt_corr51 = "Letra D";

  $cord51 = $corcorr;
  $simd51 = " ✓";

  $cora51 = "black";
  $sima51 = "";

  $corc51 = "black";
  $simc51 = "";

  $corb51 = "black";
  $simb51 = "";

  $core51 = "black";
  $sime51 = "";

}

elseif ($letraeper51["correta"]==1){

  $alt_corr51 = "Letra E";

  $core51 = $corcorr;
  $sime51 = " ✓";

  $cora51 = "black";
  $sima51 = "";

  $corc51 = "black";
  $simc51 = "";

  $cord51 = "black";
  $simd51 = "";

  $corb51 = "black";
  $simb51 = "";

}

//Errada

if ($alt_corr51 != $_POST['radper51'] && $_POST['radper51'] == "Letra A"){

  $cora51 = $corerr;
  $sima51 = " X";

}

elseif ($alt_corr51 != $_POST['radper51'] && $_POST['radper51'] == "Letra B"){

  $corb51 = $corerr;
  $simb51 = " X";

}

elseif ($alt_corr51 != $_POST['radper51'] && $_POST['radper51'] == "Letra C"){

  $corc51 = $corerr;
  $simc51 = " X";

}

elseif ($alt_corr51 != $_POST['radper51'] && $_POST['radper51'] == "Letra D"){

  $cord51 = $corerr;
  $simd51 = " X";

}

elseif ($alt_corr51 != $_POST['radper51'] && $_POST['radper51'] == "Letra E"){

  $core51 = $corerr;
  $sime51 = " X";

}

  

  // Verficando qual será checado 51

  if ($_POST['radper51'] == "Letra A"){

    $chea51 = "Checked";

    $cheb51 = "";

    $chec51 = "";

    $ched51 = "";

    $chee51 = "";

  }elseif ($_POST['radper51'] == "Letra B"){

    $chea51 = "";

    $cheb51 = "Checked";

    $chec51 = "";

    $ched51 = "";

    $chee51 = "";

  }elseif ($_POST['radper51'] == "Letra C"){

    $chea51 = "";

    $cheb51 = "";

    $chec51 = "Checked";

    $ched51 = "";

    $chee51 = "";

  }elseif ($_POST['radper51'] == "Letra D"){

    $chea51 = "";

    $cheb51 = "";

    $chec51 = "";

    $ched51 = "Checked";

    $chee51 = "";

  }elseif ($_POST['radper51'] == "Letra E"){

    $chea51 = "";

    $cheb51 = "";

    $chec51 = "";

    $ched51 = "";

    $chee51 = "Checked";

  }

  

  // Verificando se respsota esta correta 51

  if ($_POST['radper51'] == $alt_corr51){

    $contrescorr = $contrescorr + 1;

    $cer_err51 = 1;

}

else{

  $cer_err51 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 51

if ($_POST['radper51'] == "Letra A"){

  $codigo_resposta51 = $letraaper51['codigo_resposta'];

}elseif ($_POST['radper51'] == "Letra B"){

  $codigo_resposta51 = $letrabper51['codigo_resposta'];

}elseif ($_POST['radper51'] == "Letra C"){

  $codigo_resposta51 = $letracper51['codigo_resposta'];

}elseif ($_POST['radper51'] == "Letra D"){

  $codigo_resposta51 = $letradper51['codigo_resposta'];

}elseif ($_POST['radper51'] == "Letra E"){

  $codigo_resposta51 = $letraeper51['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 51

$codigo_disciplina51 = $per51['codigo_disciplina'];

  

  // Selecionando imagem 51

  $imgper51 = $per51['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp51 = $letraaper51['tipo'];

  

  

  //Questão 52

  $codper52 = $_SESSION['codper52'];

  $select_per52 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper52");

  $per52 = mysqli_fetch_assoc($select_per52);

  

  $select_letraaper52 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper52 and letra = 'a'");

  $letraaper52 = mysqli_fetch_assoc($select_letraaper52);

  $select_letrabper52 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper52 and letra = 'b'");

  $letrabper52 = mysqli_fetch_assoc($select_letrabper52);

  $select_letracper52 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper52 and letra = 'c'");

  $letracper52 = mysqli_fetch_assoc($select_letracper52);

  $select_letradper52 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper52 and letra = 'd'");

  $letradper52 = mysqli_fetch_assoc($select_letradper52);

  $select_letraeper52 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper52 and letra = 'e'");

  $letraeper52 = mysqli_fetch_assoc($select_letraeper52);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper52["correta"]==1){

  $alt_corr52 = "Letra A";

  $cora52 = $corcorr;
  $sima52 = " ✓";

  $corb52 = "black";
  $simb52 = "";

  $corc52 = "black";
  $simc52 = "";

  $cord52 = "black";
  $simd52 = "";

  $core52 = "black";
  $sime52 = "";

}

elseif ($letrabper52["correta"]==1){

  $alt_corr52 = "Letra B";

  $corb52 = $corcorr;
  $simb52 = " ✓";

  $cora52 = "black";
  $sima52 = "";

  $corc52 = "black";
  $simc52 = "";

  $cord52 = "black";
  $simd52 = "";

  $core52 = "black";
  $sime52 = "";

}

elseif ($letracper52["correta"]==1){

  $alt_corr52 = "Letra C";

  $corc52 = $corcorr;
  $simc52 = " ✓";

  $cora52 = "black";
  $sima52 = "";

  $corb52 = "black";
  $simb52 = "";

  $cord52 = "black";
  $simd52 = "";

  $core52 = "black";
  $sime52 = "";

}

elseif ($letradper52["correta"]==1){

  $alt_corr52 = "Letra D";

  $cord52 = $corcorr;
  $simd52 = " ✓";

  $cora52 = "black";
  $sima52 = "";

  $corc52 = "black";
  $simc52 = "";

  $corb52 = "black";
  $simb52 = "";

  $core52 = "black";
  $sime52 = "";

}

elseif ($letraeper52["correta"]==1){

  $alt_corr52 = "Letra E";

  $core52 = $corcorr;
  $sime52 = " ✓";

  $cora52 = "black";
  $sima52 = "";

  $corc52 = "black";
  $simc52 = "";

  $cord52 = "black";
  $simd52 = "";

  $corb52 = "black";
  $simb52 = "";

}

//Errada

if ($alt_corr52 != $_POST['radper52'] && $_POST['radper52'] == "Letra A"){

  $cora52 = $corerr;
  $sima52 = " X";

}

elseif ($alt_corr52 != $_POST['radper52'] && $_POST['radper52'] == "Letra B"){

  $corb52 = $corerr;
  $simb52 = " X";

}

elseif ($alt_corr52 != $_POST['radper52'] && $_POST['radper52'] == "Letra C"){

  $corc52 = $corerr;
  $simc52 = " X";

}

elseif ($alt_corr52 != $_POST['radper52'] && $_POST['radper52'] == "Letra D"){

  $cord52 = $corerr;
  $simd52 = " X";

}

elseif ($alt_corr52 != $_POST['radper52'] && $_POST['radper52'] == "Letra E"){

  $core52 = $corerr;
  $sime52 = " X";

}

  

  // Verficando qual será checado 52

  if ($_POST['radper52'] == "Letra A"){

    $chea52 = "Checked";

    $cheb52 = "";

    $chec52 = "";

    $ched52 = "";

    $chee52 = "";

  }elseif ($_POST['radper52'] == "Letra B"){

    $chea52 = "";

    $cheb52 = "Checked";

    $chec52 = "";

    $ched52 = "";

    $chee52 = "";

  }elseif ($_POST['radper52'] == "Letra C"){

    $chea52 = "";

    $cheb52 = "";

    $chec52 = "Checked";

    $ched52 = "";

    $chee52 = "";

  }elseif ($_POST['radper52'] == "Letra D"){

    $chea52 = "";

    $cheb52 = "";

    $chec52 = "";

    $ched52 = "Checked";

    $chee52 = "";

  }elseif ($_POST['radper52'] == "Letra E"){

    $chea52 = "";

    $cheb52 = "";

    $chec52 = "";

    $ched52 = "";

    $chee52 = "Checked";

  }

  

  // Verificando se respsota esta correta 52

  if ($_POST['radper52'] == $alt_corr52){

    $contrescorr = $contrescorr + 1;

    $cer_err52 = 1;

}

else{

  $cer_err52 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 52

if ($_POST['radper52'] == "Letra A"){

  $codigo_resposta52 = $letraaper52['codigo_resposta'];

}elseif ($_POST['radper52'] == "Letra B"){

  $codigo_resposta52 = $letrabper52['codigo_resposta'];

}elseif ($_POST['radper52'] == "Letra C"){

  $codigo_resposta52 = $letracper52['codigo_resposta'];

}elseif ($_POST['radper52'] == "Letra D"){

  $codigo_resposta52 = $letradper52['codigo_resposta'];

}elseif ($_POST['radper52'] == "Letra E"){

  $codigo_resposta52 = $letraeper52['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 52

$codigo_disciplina52 = $per52['codigo_disciplina'];

  

  // Selecionando imagem 52

  $imgper52 = $per52['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp52 = $letraaper52['tipo'];

  

  

  //Questão 53

  $codper53 = $_SESSION['codper53'];

  $select_per53 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper53");

  $per53 = mysqli_fetch_assoc($select_per53);

  

  $select_letraaper53 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper53 and letra = 'a'");

  $letraaper53 = mysqli_fetch_assoc($select_letraaper53);

  $select_letrabper53 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper53 and letra = 'b'");

  $letrabper53 = mysqli_fetch_assoc($select_letrabper53);

  $select_letracper53 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper53 and letra = 'c'");

  $letracper53 = mysqli_fetch_assoc($select_letracper53);

  $select_letradper53 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper53 and letra = 'd'");

  $letradper53 = mysqli_fetch_assoc($select_letradper53);

  $select_letraeper53 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper53 and letra = 'e'");

  $letraeper53 = mysqli_fetch_assoc($select_letraeper53);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper53["correta"]==1){

  $alt_corr53 = "Letra A";

  $cora53 = $corcorr;
  $sima53 = " ✓";

  $corb53 = "black";
  $simb53 = "";

  $corc53 = "black";
  $simc53 = "";

  $cord53 = "black";
  $simd53 = "";

  $core53 = "black";
  $sime53 = "";

}

elseif ($letrabper53["correta"]==1){

  $alt_corr53 = "Letra B";

  $corb53 = $corcorr;
  $simb53 = " ✓";

  $cora53 = "black";
  $sima53 = "";

  $corc53 = "black";
  $simc53 = "";

  $cord53 = "black";
  $simd53 = "";

  $core53 = "black";
  $sime53 = "";

}

elseif ($letracper53["correta"]==1){

  $alt_corr53 = "Letra C";

  $corc53 = $corcorr;
  $simc53 = " ✓";

  $cora53 = "black";
  $sima53 = "";

  $corb53 = "black";
  $simb53 = "";

  $cord53 = "black";
  $simd53 = "";

  $core53 = "black";
  $sime53 = "";

}

elseif ($letradper53["correta"]==1){

  $alt_corr53 = "Letra D";

  $cord53 = $corcorr;
  $simd53 = " ✓";

  $cora53 = "black";
  $sima53 = "";

  $corc53 = "black";
  $simc53 = "";

  $corb53 = "black";
  $simb53 = "";

  $core53 = "black";
  $sime53 = "";

}

elseif ($letraeper53["correta"]==1){

  $alt_corr53 = "Letra E";

  $core53 = $corcorr;
  $sime53 = " ✓";

  $cora53 = "black";
  $sima53 = "";

  $corc53 = "black";
  $simc53 = "";

  $cord53 = "black";
  $simd53 = "";

  $corb53 = "black";
  $simb53 = "";

}

//Errada

if ($alt_corr53 != $_POST['radper53'] && $_POST['radper53'] == "Letra A"){

  $cora53 = $corerr;
  $sima53 = " X";

}

elseif ($alt_corr53 != $_POST['radper53'] && $_POST['radper53'] == "Letra B"){

  $corb53 = $corerr;
  $simb53 = " X";

}

elseif ($alt_corr53 != $_POST['radper53'] && $_POST['radper53'] == "Letra C"){

  $corc53 = $corerr;
  $simc53 = " X";

}

elseif ($alt_corr53 != $_POST['radper53'] && $_POST['radper53'] == "Letra D"){

  $cord53 = $corerr;
  $simd53 = " X";

}

elseif ($alt_corr53 != $_POST['radper53'] && $_POST['radper53'] == "Letra E"){

  $core53 = $corerr;
  $sime53 = " X";

}

  

  // Verficando qual será checado 53

  if ($_POST['radper53'] == "Letra A"){

    $chea53 = "Checked";

    $cheb53 = "";

    $chec53 = "";

    $ched53 = "";

    $chee53 = "";

  }elseif ($_POST['radper53'] == "Letra B"){

    $chea53 = "";

    $cheb53 = "Checked";

    $chec53 = "";

    $ched53 = "";

    $chee53 = "";

  }elseif ($_POST['radper53'] == "Letra C"){

    $chea53 = "";

    $cheb53 = "";

    $chec53 = "Checked";

    $ched53 = "";

    $chee53 = "";

  }elseif ($_POST['radper53'] == "Letra D"){

    $chea53 = "";

    $cheb53 = "";

    $chec53 = "";

    $ched53 = "Checked";

    $chee53 = "";

  }elseif ($_POST['radper53'] == "Letra E"){

    $chea53 = "";

    $cheb53 = "";

    $chec53 = "";

    $ched53 = "";

    $chee53 = "Checked";

  }

  

  // Verificando se respsota esta correta 53

  if ($_POST['radper53'] == $alt_corr53){

    $contrescorr = $contrescorr + 1;

    $cer_err53 = 1;

}

else{

  $cer_err53 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 53

if ($_POST['radper53'] == "Letra A"){

  $codigo_resposta53 = $letraaper53['codigo_resposta'];

}elseif ($_POST['radper53'] == "Letra B"){

  $codigo_resposta53 = $letrabper53['codigo_resposta'];

}elseif ($_POST['radper53'] == "Letra C"){

  $codigo_resposta53 = $letracper53['codigo_resposta'];

}elseif ($_POST['radper53'] == "Letra D"){

  $codigo_resposta53 = $letradper53['codigo_resposta'];

}elseif ($_POST['radper53'] == "Letra E"){

  $codigo_resposta53 = $letraeper53['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 53

$codigo_disciplina53 = $per53['codigo_disciplina'];

  

  // Selecionando imagem 53

  $imgper53 = $per53['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp53 = $letraaper53['tipo'];

  

  

  //Questão 54

  $codper54 = $_SESSION['codper54'];

  $select_per54 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper54");

  $per54 = mysqli_fetch_assoc($select_per54);

  

  $select_letraaper54 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper54 and letra = 'a'");

  $letraaper54 = mysqli_fetch_assoc($select_letraaper54);

  $select_letrabper54 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper54 and letra = 'b'");

  $letrabper54 = mysqli_fetch_assoc($select_letrabper54);

  $select_letracper54 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper54 and letra = 'c'");

  $letracper54 = mysqli_fetch_assoc($select_letracper54);

  $select_letradper54 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper54 and letra = 'd'");

  $letradper54 = mysqli_fetch_assoc($select_letradper54);

  $select_letraeper54 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper54 and letra = 'e'");

  $letraeper54 = mysqli_fetch_assoc($select_letraeper54);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper54["correta"]==1){

  $alt_corr54 = "Letra A";

  $cora54 = $corcorr;
  $sima54 = " ✓";

  $corb54 = "black";
  $simb54 = "";

  $corc54 = "black";
  $simc54 = "";

  $cord54 = "black";
  $simd54 = "";

  $core54 = "black";
  $sime54 = "";

}

elseif ($letrabper54["correta"]==1){

  $alt_corr54 = "Letra B";

  $corb54 = $corcorr;
  $simb54 = " ✓";

  $cora54 = "black";
  $sima54 = "";

  $corc54 = "black";
  $simc54 = "";

  $cord54 = "black";
  $simd54 = "";

  $core54 = "black";
  $sime54 = "";

}

elseif ($letracper54["correta"]==1){

  $alt_corr54 = "Letra C";

  $corc54 = $corcorr;
  $simc54 = " ✓";

  $cora54 = "black";
  $sima54 = "";

  $corb54 = "black";
  $simb54 = "";

  $cord54 = "black";
  $simd54 = "";

  $core54 = "black";
  $sime54 = "";

}

elseif ($letradper54["correta"]==1){

  $alt_corr54 = "Letra D";

  $cord54 = $corcorr;
  $simd54 = " ✓";

  $cora54 = "black";
  $sima54 = "";

  $corc54 = "black";
  $simc54 = "";

  $corb54 = "black";
  $simb54 = "";

  $core54 = "black";
  $sime54 = "";

}

elseif ($letraeper54["correta"]==1){

  $alt_corr54 = "Letra E";

  $core54 = $corcorr;
  $sime54 = " ✓";

  $cora54 = "black";
  $sima54 = "";

  $corc54 = "black";
  $simc54 = "";

  $cord54 = "black";
  $simd54 = "";

  $corb54 = "black";
  $simb54 = "";

}

//Errada

if ($alt_corr54 != $_POST['radper54'] && $_POST['radper54'] == "Letra A"){

  $cora54 = $corerr;
  $sima54 = " X";

}

elseif ($alt_corr54 != $_POST['radper54'] && $_POST['radper54'] == "Letra B"){

  $corb54 = $corerr;
  $simb54 = " X";

}

elseif ($alt_corr54 != $_POST['radper54'] && $_POST['radper54'] == "Letra C"){

  $corc54 = $corerr;
  $simc54 = " X";

}

elseif ($alt_corr54 != $_POST['radper54'] && $_POST['radper54'] == "Letra D"){

  $cord54 = $corerr;
  $simd54 = " X";

}

elseif ($alt_corr54 != $_POST['radper54'] && $_POST['radper54'] == "Letra E"){

  $core54 = $corerr;
  $sime54 = " X";

}

  

  // Verficando qual será checado 54

  if ($_POST['radper54'] == "Letra A"){

    $chea54 = "Checked";

    $cheb54 = "";

    $chec54 = "";

    $ched54 = "";

    $chee54 = "";

  }elseif ($_POST['radper54'] == "Letra B"){

    $chea54 = "";

    $cheb54 = "Checked";

    $chec54 = "";

    $ched54 = "";

    $chee54 = "";

  }elseif ($_POST['radper54'] == "Letra C"){

    $chea54 = "";

    $cheb54 = "";

    $chec54 = "Checked";

    $ched54 = "";

    $chee54 = "";

  }elseif ($_POST['radper54'] == "Letra D"){

    $chea54 = "";

    $cheb54 = "";

    $chec54 = "";

    $ched54 = "Checked";

    $chee54 = "";

  }elseif ($_POST['radper54'] == "Letra E"){

    $chea54 = "";

    $cheb54 = "";

    $chec54 = "";

    $ched54 = "";

    $chee54 = "Checked";

  }

  

  // Verificando se respsota esta correta 54

  if ($_POST['radper54'] == $alt_corr54){

    $contrescorr = $contrescorr + 1;

    $cer_err54 = 1;

}

else{

  $cer_err54 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 54

if ($_POST['radper54'] == "Letra A"){

  $codigo_resposta54 = $letraaper54['codigo_resposta'];

}elseif ($_POST['radper54'] == "Letra B"){

  $codigo_resposta54 = $letrabper54['codigo_resposta'];

}elseif ($_POST['radper54'] == "Letra C"){

  $codigo_resposta54 = $letracper54['codigo_resposta'];

}elseif ($_POST['radper54'] == "Letra D"){

  $codigo_resposta54 = $letradper54['codigo_resposta'];

}elseif ($_POST['radper54'] == "Letra E"){

  $codigo_resposta54 = $letraeper54['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 54

$codigo_disciplina54 = $per54['codigo_disciplina'];

  

  // Selecionando imagem 54

  $imgper54 = $per54['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp54 = $letraaper54['tipo'];

  

  

  //Questão 55

  $codper55 = $_SESSION['codper55'];

  $select_per55 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper55");

  $per55 = mysqli_fetch_assoc($select_per55);

  

  $select_letraaper55 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper55 and letra = 'a'");

  $letraaper55 = mysqli_fetch_assoc($select_letraaper55);

  $select_letrabper55 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper55 and letra = 'b'");

  $letrabper55 = mysqli_fetch_assoc($select_letrabper55);

  $select_letracper55 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper55 and letra = 'c'");

  $letracper55 = mysqli_fetch_assoc($select_letracper55);

  $select_letradper55 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper55 and letra = 'd'");

  $letradper55 = mysqli_fetch_assoc($select_letradper55);

  $select_letraeper55 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper55 and letra = 'e'");

  $letraeper55 = mysqli_fetch_assoc($select_letraeper55);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper55["correta"]==1){

  $alt_corr55 = "Letra A";

  $cora55 = $corcorr;
  $sima55 = " ✓";

  $corb55 = "black";
  $simb55 = "";

  $corc55 = "black";
  $simc55 = "";

  $cord55 = "black";
  $simd55 = "";

  $core55 = "black";
  $sime55 = "";

}

elseif ($letrabper55["correta"]==1){

  $alt_corr55 = "Letra B";

  $corb55 = $corcorr;
  $simb55 = " ✓";

  $cora55 = "black";
  $sima55 = "";

  $corc55 = "black";
  $simc55 = "";

  $cord55 = "black";
  $simd55 = "";

  $core55 = "black";
  $sime55 = "";

}

elseif ($letracper55["correta"]==1){

  $alt_corr55 = "Letra C";

  $corc55 = $corcorr;
  $simc55 = " ✓";

  $cora55 = "black";
  $sima55 = "";

  $corb55 = "black";
  $simb55 = "";

  $cord55 = "black";
  $simd55 = "";

  $core55 = "black";
  $sime55 = "";

}

elseif ($letradper55["correta"]==1){

  $alt_corr55 = "Letra D";

  $cord55 = $corcorr;
  $simd55 = " ✓";

  $cora55 = "black";
  $sima55 = "";

  $corc55 = "black";
  $simc55 = "";

  $corb55 = "black";
  $simb55 = "";

  $core55 = "black";
  $sime55 = "";

}

elseif ($letraeper55["correta"]==1){

  $alt_corr55 = "Letra E";

  $core55 = $corcorr;
  $sime55 = " ✓";

  $cora55 = "black";
  $sima55 = "";

  $corc55 = "black";
  $simc55 = "";

  $cord55 = "black";
  $simd55 = "";

  $corb55 = "black";
  $simb55 = "";

}

//Errada

if ($alt_corr55 != $_POST['radper55'] && $_POST['radper55'] == "Letra A"){

  $cora55 = $corerr;
  $sima55 = " X";

}

elseif ($alt_corr55 != $_POST['radper55'] && $_POST['radper55'] == "Letra B"){

  $corb55 = $corerr;
  $simb55 = " X";

}

elseif ($alt_corr55 != $_POST['radper55'] && $_POST['radper55'] == "Letra C"){

  $corc55 = $corerr;
  $simc55 = " X";

}

elseif ($alt_corr55 != $_POST['radper55'] && $_POST['radper55'] == "Letra D"){

  $cord55 = $corerr;
  $simd55 = " X";

}

elseif ($alt_corr55 != $_POST['radper55'] && $_POST['radper55'] == "Letra E"){

  $core55 = $corerr;
  $sime55 = " X";

}

  

  // Verficando qual será checado 55

  if ($_POST['radper55'] == "Letra A"){

    $chea55 = "Checked";

    $cheb55 = "";

    $chec55 = "";

    $ched55 = "";

    $chee55 = "";

  }elseif ($_POST['radper55'] == "Letra B"){

    $chea55 = "";

    $cheb55 = "Checked";

    $chec55 = "";

    $ched55 = "";

    $chee55 = "";

  }elseif ($_POST['radper55'] == "Letra C"){

    $chea55 = "";

    $cheb55 = "";

    $chec55 = "Checked";

    $ched55 = "";

    $chee55 = "";

  }elseif ($_POST['radper55'] == "Letra D"){

    $chea55 = "";

    $cheb55 = "";

    $chec55 = "";

    $ched55 = "Checked";

    $chee55 = "";

  }elseif ($_POST['radper55'] == "Letra E"){

    $chea55 = "";

    $cheb55 = "";

    $chec55 = "";

    $ched55 = "";

    $chee55 = "Checked";

  }

  

  // Verificando se respsota esta correta 55

  if ($_POST['radper55'] == $alt_corr55){

    $contrescorr = $contrescorr + 1;

    $cer_err55 = 1;

}

else{

  $cer_err55 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 55

if ($_POST['radper55'] == "Letra A"){

  $codigo_resposta55 = $letraaper55['codigo_resposta'];

}elseif ($_POST['radper55'] == "Letra B"){

  $codigo_resposta55 = $letrabper55['codigo_resposta'];

}elseif ($_POST['radper55'] == "Letra C"){

  $codigo_resposta55 = $letracper55['codigo_resposta'];

}elseif ($_POST['radper55'] == "Letra D"){

  $codigo_resposta55 = $letradper55['codigo_resposta'];

}elseif ($_POST['radper55'] == "Letra E"){

  $codigo_resposta55 = $letraeper55['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 55

$codigo_disciplina55 = $per55['codigo_disciplina'];

  

  // Selecionando imagem 55

  $imgper55 = $per55['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp55 = $letraaper55['tipo'];

  

  }





  // Verificando se existe perguntas de 56 à 60

if ($qtperguntas>55){



  //Questão 56

  $codper56 = $_SESSION['codper56'];

  $select_per56 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper56");

  $per56 = mysqli_fetch_assoc($select_per56);

  

  $select_letraaper56 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper56 and letra = 'a'");

  $letraaper56 = mysqli_fetch_assoc($select_letraaper56);

  $select_letrabper56 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper56 and letra = 'b'");

  $letrabper56 = mysqli_fetch_assoc($select_letrabper56);

  $select_letracper56 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper56 and letra = 'c'");

  $letracper56 = mysqli_fetch_assoc($select_letracper56);

  $select_letradper56 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper56 and letra = 'd'");

  $letradper56 = mysqli_fetch_assoc($select_letradper56);

  $select_letraeper56 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper56 and letra = 'e'");

  $letraeper56 = mysqli_fetch_assoc($select_letraeper56);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper56["correta"]==1){

  $alt_corr56 = "Letra A";

  $cora56 = $corcorr;
  $sima56 = " ✓";

  $corb56 = "black";
  $simb56 = "";

  $corc56 = "black";
  $simc56 = "";

  $cord56 = "black";
  $simd56 = "";

  $core56 = "black";
  $sime56 = "";

}

elseif ($letrabper56["correta"]==1){

  $alt_corr56 = "Letra B";

  $corb56 = $corcorr;
  $simb56 = " ✓";

  $cora56 = "black";
  $sima56 = "";

  $corc56 = "black";
  $simc56 = "";

  $cord56 = "black";
  $simd56 = "";

  $core56 = "black";
  $sime56 = "";

}

elseif ($letracper56["correta"]==1){

  $alt_corr56 = "Letra C";

  $corc56 = $corcorr;
  $simc56 = " ✓";

  $cora56 = "black";
  $sima56 = "";

  $corb56 = "black";
  $simb56 = "";

  $cord56 = "black";
  $simd56 = "";

  $core56 = "black";
  $sime56 = "";

}

elseif ($letradper56["correta"]==1){

  $alt_corr56 = "Letra D";

  $cord56 = $corcorr;
  $simd56 = " ✓";

  $cora56 = "black";
  $sima56 = "";

  $corc56 = "black";
  $simc56 = "";

  $corb56 = "black";
  $simb56 = "";

  $core56 = "black";
  $sime56 = "";

}

elseif ($letraeper56["correta"]==1){

  $alt_corr56 = "Letra E";

  $core56 = $corcorr;
  $sime56 = " ✓";

  $cora56 = "black";
  $sima56 = "";

  $corc56 = "black";
  $simc56 = "";

  $cord56 = "black";
  $simd56 = "";

  $corb56 = "black";
  $simb56 = "";

}

//Errada

if ($alt_corr56 != $_POST['radper56'] && $_POST['radper56'] == "Letra A"){

  $cora56 = $corerr;
  $sima56 = " X";

}

elseif ($alt_corr56 != $_POST['radper56'] && $_POST['radper56'] == "Letra B"){

  $corb56 = $corerr;
  $simb56 = " X";

}

elseif ($alt_corr56 != $_POST['radper56'] && $_POST['radper56'] == "Letra C"){

  $corc56 = $corerr;
  $simc56 = " X";

}

elseif ($alt_corr56 != $_POST['radper56'] && $_POST['radper56'] == "Letra D"){

  $cord56 = $corerr;
  $simd56 = " X";

}

elseif ($alt_corr56 != $_POST['radper56'] && $_POST['radper56'] == "Letra E"){

  $core56 = $corerr;
  $sime56 = " X";

}

  

  // Verficando qual será checado 56

  if ($_POST['radper56'] == "Letra A"){

    $chea56 = "Checked";

    $cheb56 = "";

    $chec56 = "";

    $ched56 = "";

    $chee56 = "";

  }elseif ($_POST['radper56'] == "Letra B"){

    $chea56 = "";

    $cheb56 = "Checked";

    $chec56 = "";

    $ched56 = "";

    $chee56 = "";

  }elseif ($_POST['radper56'] == "Letra C"){

    $chea56 = "";

    $cheb56 = "";

    $chec56 = "Checked";

    $ched56 = "";

    $chee56 = "";

  }elseif ($_POST['radper56'] == "Letra D"){

    $chea56 = "";

    $cheb56 = "";

    $chec56 = "";

    $ched56 = "Checked";

    $chee56 = "";

  }elseif ($_POST['radper56'] == "Letra E"){

    $chea56 = "";

    $cheb56 = "";

    $chec56 = "";

    $ched56 = "";

    $chee56 = "Checked";

  }

  

  // Verificando se respsota esta correta 56

  if ($_POST['radper56'] == $alt_corr56){

    $contrescorr = $contrescorr + 1;

    $cer_err56 = 1;

}

else{

  $cer_err56 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 56

if ($_POST['radper56'] == "Letra A"){

  $codigo_resposta56 = $letraaper56['codigo_resposta'];

}elseif ($_POST['radper56'] == "Letra B"){

  $codigo_resposta56 = $letrabper56['codigo_resposta'];

}elseif ($_POST['radper56'] == "Letra C"){

  $codigo_resposta56 = $letracper56['codigo_resposta'];

}elseif ($_POST['radper56'] == "Letra D"){

  $codigo_resposta56 = $letradper56['codigo_resposta'];

}elseif ($_POST['radper56'] == "Letra E"){

  $codigo_resposta56 = $letraeper56['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 56

$codigo_disciplina56 = $per56['codigo_disciplina'];

  

  // Selecionando imagem 56

  $imgper56 = $per56['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp56 = $letraaper56['tipo'];

  

  

  //Questão 57

  $codper57 = $_SESSION['codper57'];

  $select_per57 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper57");

  $per57 = mysqli_fetch_assoc($select_per57);

  

  $select_letraaper57 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper57 and letra = 'a'");

  $letraaper57 = mysqli_fetch_assoc($select_letraaper57);

  $select_letrabper57 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper57 and letra = 'b'");

  $letrabper57 = mysqli_fetch_assoc($select_letrabper57);

  $select_letracper57 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper57 and letra = 'c'");

  $letracper57 = mysqli_fetch_assoc($select_letracper57);

  $select_letradper57 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper57 and letra = 'd'");

  $letradper57 = mysqli_fetch_assoc($select_letradper57);

  $select_letraeper57 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper57 and letra = 'e'");

  $letraeper57 = mysqli_fetch_assoc($select_letraeper57);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper57["correta"]==1){

  $alt_corr57 = "Letra A";

  $cora57 = $corcorr;
  $sima57 = " ✓";

  $corb57 = "black";
  $simb57 = "";

  $corc57 = "black";
  $simc57 = "";

  $cord57 = "black";
  $simd57 = "";

  $core57 = "black";
  $sime57 = "";

}

elseif ($letrabper57["correta"]==1){

  $alt_corr57 = "Letra B";

  $corb57 = $corcorr;
  $simb57 = " ✓";

  $cora57 = "black";
  $sima57 = "";

  $corc57 = "black";
  $simc57 = "";

  $cord57 = "black";
  $simd57 = "";

  $core57 = "black";
  $sime57 = "";

}

elseif ($letracper57["correta"]==1){

  $alt_corr57 = "Letra C";

  $corc57 = $corcorr;
  $simc57 = " ✓";

  $cora57 = "black";
  $sima57 = "";

  $corb57 = "black";
  $simb57 = "";

  $cord57 = "black";
  $simd57 = "";

  $core57 = "black";
  $sime57 = "";

}

elseif ($letradper57["correta"]==1){

  $alt_corr57 = "Letra D";

  $cord57 = $corcorr;
  $simd57 = " ✓";

  $cora57 = "black";
  $sima57 = "";

  $corc57 = "black";
  $simc57 = "";

  $corb57 = "black";
  $simb57 = "";

  $core57 = "black";
  $sime57 = "";

}

elseif ($letraeper57["correta"]==1){

  $alt_corr57 = "Letra E";

  $core57 = $corcorr;
  $sime57 = " ✓";

  $cora57 = "black";
  $sima57 = "";

  $corc57 = "black";
  $simc57 = "";

  $cord57 = "black";
  $simd57 = "";

  $corb57 = "black";
  $simb57 = "";

}

//Errada

if ($alt_corr57 != $_POST['radper57'] && $_POST['radper57'] == "Letra A"){

  $cora57 = $corerr;
  $sima57 = " X";

}

elseif ($alt_corr57 != $_POST['radper57'] && $_POST['radper57'] == "Letra B"){

  $corb57 = $corerr;
  $simb57 = " X";

}

elseif ($alt_corr57 != $_POST['radper57'] && $_POST['radper57'] == "Letra C"){

  $corc57 = $corerr;
  $simc57 = " X";

}

elseif ($alt_corr57 != $_POST['radper57'] && $_POST['radper57'] == "Letra D"){

  $cord57 = $corerr;
  $simd57 = " X";

}

elseif ($alt_corr57 != $_POST['radper57'] && $_POST['radper57'] == "Letra E"){

  $core57 = $corerr;
  $sime57 = " X";

}

  

  // Verficando qual será checado 57

  if ($_POST['radper57'] == "Letra A"){

    $chea57 = "Checked";

    $cheb57 = "";

    $chec57 = "";

    $ched57 = "";

    $chee57 = "";

  }elseif ($_POST['radper57'] == "Letra B"){

    $chea57 = "";

    $cheb57 = "Checked";

    $chec57 = "";

    $ched57 = "";

    $chee57 = "";

  }elseif ($_POST['radper57'] == "Letra C"){

    $chea57 = "";

    $cheb57 = "";

    $chec57 = "Checked";

    $ched57 = "";

    $chee57 = "";

  }elseif ($_POST['radper57'] == "Letra D"){

    $chea57 = "";

    $cheb57 = "";

    $chec57 = "";

    $ched57 = "Checked";

    $chee57 = "";

  }elseif ($_POST['radper57'] == "Letra E"){

    $chea57 = "";

    $cheb57 = "";

    $chec57 = "";

    $ched57 = "";

    $chee57 = "Checked";

  }

  

  // Verificando se respsota esta correta 57

  if ($_POST['radper57'] == $alt_corr57){

    $contrescorr = $contrescorr + 1;

    $cer_err57 = 1;

}

else{

  $cer_err57 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 57

if ($_POST['radper57'] == "Letra A"){

  $codigo_resposta57 = $letraaper57['codigo_resposta'];

}elseif ($_POST['radper57'] == "Letra B"){

  $codigo_resposta57 = $letrabper57['codigo_resposta'];

}elseif ($_POST['radper57'] == "Letra C"){

  $codigo_resposta57 = $letracper57['codigo_resposta'];

}elseif ($_POST['radper57'] == "Letra D"){

  $codigo_resposta57 = $letradper57['codigo_resposta'];

}elseif ($_POST['radper57'] == "Letra E"){

  $codigo_resposta57 = $letraeper57['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 57

$codigo_disciplina57 = $per57['codigo_disciplina'];

  

  // Selecionando imagem 57

  $imgper57 = $per57['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp57 = $letraaper57['tipo'];

  

  

  //Questão 58

  $codper58 = $_SESSION['codper58'];

  $select_per58 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper58");

  $per58 = mysqli_fetch_assoc($select_per58);

  

  $select_letraaper58 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper58 and letra = 'a'");

  $letraaper58 = mysqli_fetch_assoc($select_letraaper58);

  $select_letrabper58 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper58 and letra = 'b'");

  $letrabper58 = mysqli_fetch_assoc($select_letrabper58);

  $select_letracper58 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper58 and letra = 'c'");

  $letracper58 = mysqli_fetch_assoc($select_letracper58);

  $select_letradper58 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper58 and letra = 'd'");

  $letradper58 = mysqli_fetch_assoc($select_letradper58);

  $select_letraeper58 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper58 and letra = 'e'");

  $letraeper58 = mysqli_fetch_assoc($select_letraeper58);

  

  // Selecionando alternativa correta 2 suas cores

 // Correta

if ($letraaper58["correta"]==1){

  $alt_corr58 = "Letra A";

  $cora58 = $corcorr;
  $sima58 = " ✓";

  $corb58 = "black";
  $simb58 = "";

  $corc58 = "black";
  $simc58 = "";

  $cord58 = "black";
  $simd58 = "";

  $core58 = "black";
  $sime58 = "";

}

elseif ($letrabper58["correta"]==1){

  $alt_corr58 = "Letra B";

  $corb58 = $corcorr;
  $simb58 = " ✓";

  $cora58 = "black";
  $sima58 = "";

  $corc58 = "black";
  $simc58 = "";

  $cord58 = "black";
  $simd58 = "";

  $core58 = "black";
  $sime58 = "";

}

elseif ($letracper58["correta"]==1){

  $alt_corr58 = "Letra C";

  $corc58 = $corcorr;
  $simc58 = " ✓";

  $cora58 = "black";
  $sima58 = "";

  $corb58 = "black";
  $simb58 = "";

  $cord58 = "black";
  $simd58 = "";

  $core58 = "black";
  $sime58 = "";

}

elseif ($letradper58["correta"]==1){

  $alt_corr58 = "Letra D";

  $cord58 = $corcorr;
  $simd58 = " ✓";

  $cora58 = "black";
  $sima58 = "";

  $corc58 = "black";
  $simc58 = "";

  $corb58 = "black";
  $simb58 = "";

  $core58 = "black";
  $sime58 = "";

}

elseif ($letraeper58["correta"]==1){

  $alt_corr58 = "Letra E";

  $core58 = $corcorr;
  $sime58 = " ✓";

  $cora58 = "black";
  $sima58 = "";

  $corc58 = "black";
  $simc58 = "";

  $cord58 = "black";
  $simd58 = "";

  $corb58 = "black";
  $simb58 = "";

}

//Errada

if ($alt_corr58 != $_POST['radper58'] && $_POST['radper58'] == "Letra A"){

  $cora58 = $corerr;
  $sima58 = " X";

}

elseif ($alt_corr58 != $_POST['radper58'] && $_POST['radper58'] == "Letra B"){

  $corb58 = $corerr;
  $simb58 = " X";

}

elseif ($alt_corr58 != $_POST['radper58'] && $_POST['radper58'] == "Letra C"){

  $corc58 = $corerr;
  $simc58 = " X";

}

elseif ($alt_corr58 != $_POST['radper58'] && $_POST['radper58'] == "Letra D"){

  $cord58 = $corerr;
  $simd58 = " X";

}

elseif ($alt_corr58 != $_POST['radper58'] && $_POST['radper58'] == "Letra E"){

  $core58 = $corerr;
  $sime58 = " X";

}

  

  // Verficando qual será checado 58

  if ($_POST['radper58'] == "Letra A"){

    $chea58 = "Checked";

    $cheb58 = "";

    $chec58 = "";

    $ched58 = "";

    $chee58 = "";

  }elseif ($_POST['radper58'] == "Letra B"){

    $chea58 = "";

    $cheb58 = "Checked";

    $chec58 = "";

    $ched58 = "";

    $chee58 = "";

  }elseif ($_POST['radper58'] == "Letra C"){

    $chea58 = "";

    $cheb58 = "";

    $chec58 = "Checked";

    $ched58 = "";

    $chee58 = "";

  }elseif ($_POST['radper58'] == "Letra D"){

    $chea58 = "";

    $cheb58 = "";

    $chec58 = "";

    $ched58 = "Checked";

    $chee58 = "";

  }elseif ($_POST['radper58'] == "Letra E"){

    $chea58 = "";

    $cheb58 = "";

    $chec58 = "";

    $ched58 = "";

    $chee58 = "Checked";

  }

  

  // Verificando se respsota esta correta 58

  if ($_POST['radper58'] == $alt_corr58){

    $contrescorr = $contrescorr + 1;

    $cer_err58 = 1;

}

else{

  $cer_err58 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 58

if ($_POST['radper58'] == "Letra A"){

  $codigo_resposta58 = $letraaper58['codigo_resposta'];

}elseif ($_POST['radper58'] == "Letra B"){

  $codigo_resposta58 = $letrabper58['codigo_resposta'];

}elseif ($_POST['radper58'] == "Letra C"){

  $codigo_resposta58 = $letracper58['codigo_resposta'];

}elseif ($_POST['radper58'] == "Letra D"){

  $codigo_resposta58 = $letradper58['codigo_resposta'];

}elseif ($_POST['radper58'] == "Letra E"){

  $codigo_resposta58 = $letraeper58['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 58

$codigo_disciplina58 = $per58['codigo_disciplina'];

  

  // Selecionando imagem 58

  $imgper58 = $per58['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp58 = $letraaper58['tipo'];

  

  

  //Questão 59

  $codper59 = $_SESSION['codper59'];

  $select_per59 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper59");

  $per59 = mysqli_fetch_assoc($select_per59);

  

  $select_letraaper59 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper59 and letra = 'a'");

  $letraaper59 = mysqli_fetch_assoc($select_letraaper59);

  $select_letrabper59 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper59 and letra = 'b'");

  $letrabper59 = mysqli_fetch_assoc($select_letrabper59);

  $select_letracper59 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper59 and letra = 'c'");

  $letracper59 = mysqli_fetch_assoc($select_letracper59);

  $select_letradper59 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper59 and letra = 'd'");

  $letradper59 = mysqli_fetch_assoc($select_letradper59);

  $select_letraeper59 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper59 and letra = 'e'");

  $letraeper59 = mysqli_fetch_assoc($select_letraeper59);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper59["correta"]==1){

  $alt_corr59 = "Letra A";

  $cora59 = $corcorr;
  $sima59 = " ✓";

  $corb59 = "black";
  $simb59 = "";

  $corc59 = "black";
  $simc59 = "";

  $cord59 = "black";
  $simd59 = "";

  $core59 = "black";
  $sime59 = "";

}

elseif ($letrabper59["correta"]==1){

  $alt_corr59 = "Letra B";

  $corb59 = $corcorr;
  $simb59 = " ✓";

  $cora59 = "black";
  $sima59 = "";

  $corc59 = "black";
  $simc59 = "";

  $cord59 = "black";
  $simd59 = "";

  $core59 = "black";
  $sime59 = "";

}

elseif ($letracper59["correta"]==1){

  $alt_corr59 = "Letra C";

  $corc59 = $corcorr;
  $simc59 = " ✓";

  $cora59 = "black";
  $sima59 = "";

  $corb59 = "black";
  $simb59 = "";

  $cord59 = "black";
  $simd59 = "";

  $core59 = "black";
  $sime59 = "";

}

elseif ($letradper59["correta"]==1){

  $alt_corr59 = "Letra D";

  $cord59 = $corcorr;
  $simd59 = " ✓";

  $cora59 = "black";
  $sima59 = "";

  $corc59 = "black";
  $simc59 = "";

  $corb59 = "black";
  $simb59 = "";

  $core59 = "black";
  $sime59 = "";

}

elseif ($letraeper59["correta"]==1){

  $alt_corr59 = "Letra E";

  $core59 = $corcorr;
  $sime59 = " ✓";

  $cora59 = "black";
  $sima59 = "";

  $corc59 = "black";
  $simc59 = "";

  $cord59 = "black";
  $simd59 = "";

  $corb59 = "black";
  $simb59 = "";

}

//Errada

if ($alt_corr59 != $_POST['radper59'] && $_POST['radper59'] == "Letra A"){

  $cora59 = $corerr;
  $sima59 = " X";

}

elseif ($alt_corr59 != $_POST['radper59'] && $_POST['radper59'] == "Letra B"){

  $corb59 = $corerr;
  $simb59 = " X";

}

elseif ($alt_corr59 != $_POST['radper59'] && $_POST['radper59'] == "Letra C"){

  $corc59 = $corerr;
  $simc59 = " X";

}

elseif ($alt_corr59 != $_POST['radper59'] && $_POST['radper59'] == "Letra D"){

  $cord59 = $corerr;
  $simd59 = " X";

}

elseif ($alt_corr59 != $_POST['radper59'] && $_POST['radper59'] == "Letra E"){

  $core59 = $corerr;
  $sime59 = " X";

}

  

  // Verficando qual será checado 59

  if ($_POST['radper59'] == "Letra A"){

    $chea59 = "Checked";

    $cheb59 = "";

    $chec59 = "";

    $ched59 = "";

    $chee59 = "";

  }elseif ($_POST['radper59'] == "Letra B"){

    $chea59 = "";

    $cheb59 = "Checked";

    $chec59 = "";

    $ched59 = "";

    $chee59 = "";

  }elseif ($_POST['radper59'] == "Letra C"){

    $chea59 = "";

    $cheb59 = "";

    $chec59 = "Checked";

    $ched59 = "";

    $chee59 = "";

  }elseif ($_POST['radper59'] == "Letra D"){

    $chea59 = "";

    $cheb59 = "";

    $chec59 = "";

    $ched59 = "Checked";

    $chee59 = "";

  }elseif ($_POST['radper59'] == "Letra E"){

    $chea59 = "";

    $cheb59 = "";

    $chec59 = "";

    $ched59 = "";

    $chee59 = "Checked";

  }

  

  // Verificando se respsota esta correta 59

  if ($_POST['radper59'] == $alt_corr59){

    $contrescorr = $contrescorr + 1;

    $cer_err59 = 1;

}

else{

  $cer_err59 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 59

if ($_POST['radper59'] == "Letra A"){

  $codigo_resposta59 = $letraaper59['codigo_resposta'];

}elseif ($_POST['radper59'] == "Letra B"){

  $codigo_resposta59 = $letrabper59['codigo_resposta'];

}elseif ($_POST['radper59'] == "Letra C"){

  $codigo_resposta59 = $letracper59['codigo_resposta'];

}elseif ($_POST['radper59'] == "Letra D"){

  $codigo_resposta59 = $letradper59['codigo_resposta'];

}elseif ($_POST['radper59'] == "Letra E"){

  $codigo_resposta59 = $letraeper59['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 59

$codigo_disciplina59 = $per59['codigo_disciplina'];

  

  // Selecionando imagem 59

  $imgper59 = $per59['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp59 = $letraaper59['tipo'];

  

  

  //Questão 60

  $codper60 = $_SESSION['codper60'];

  $select_per60 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper60");

  $per60 = mysqli_fetch_assoc($select_per60);

  

  $select_letraaper60 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper60 and letra = 'a'");

  $letraaper60 = mysqli_fetch_assoc($select_letraaper60);

  $select_letrabper60 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper60 and letra = 'b'");

  $letrabper60 = mysqli_fetch_assoc($select_letrabper60);

  $select_letracper60 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper60 and letra = 'c'");

  $letracper60 = mysqli_fetch_assoc($select_letracper60);

  $select_letradper60 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper60 and letra = 'd'");

  $letradper60 = mysqli_fetch_assoc($select_letradper60);

  $select_letraeper60 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper60 and letra = 'e'");

  $letraeper60 = mysqli_fetch_assoc($select_letraeper60);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper60["correta"]==1){

  $alt_corr60 = "Letra A";

  $cora60 = $corcorr;
  $sima60 = " ✓";

  $corb60 = "black";
  $simb60 = "";

  $corc60 = "black";
  $simc60 = "";

  $cord60 = "black";
  $simd60 = "";

  $core60 = "black";
  $sime60 = "";

}

elseif ($letrabper60["correta"]==1){

  $alt_corr60 = "Letra B";

  $corb60 = $corcorr;
  $simb60 = " ✓";

  $cora60 = "black";
  $sima60 = "";

  $corc60 = "black";
  $simc60 = "";

  $cord60 = "black";
  $simd60 = "";

  $core60 = "black";
  $sime60 = "";

}

elseif ($letracper60["correta"]==1){

  $alt_corr60 = "Letra C";

  $corc60 = $corcorr;
  $simc60 = " ✓";

  $cora60 = "black";
  $sima60 = "";

  $corb60 = "black";
  $simb60 = "";

  $cord60 = "black";
  $simd60 = "";

  $core60 = "black";
  $sime60 = "";

}

elseif ($letradper60["correta"]==1){

  $alt_corr60 = "Letra D";

  $cord60 = $corcorr;
  $simd60 = " ✓";

  $cora60 = "black";
  $sima60 = "";

  $corc60 = "black";
  $simc60 = "";

  $corb60 = "black";
  $simb60 = "";

  $core60 = "black";
  $sime60 = "";

}

elseif ($letraeper60["correta"]==1){

  $alt_corr60 = "Letra E";

  $core60 = $corcorr;
  $sime60 = " ✓";

  $cora60 = "black";
  $sima60 = "";

  $corc60 = "black";
  $simc60 = "";

  $cord60 = "black";
  $simd60 = "";

  $corb60 = "black";
  $simb60 = "";

}

//Errada

if ($alt_corr60 != $_POST['radper60'] && $_POST['radper60'] == "Letra A"){

  $cora60 = $corerr;
  $sima60 = " X";

}

elseif ($alt_corr60 != $_POST['radper60'] && $_POST['radper60'] == "Letra B"){

  $corb60 = $corerr;
  $simb60 = " X";

}

elseif ($alt_corr60 != $_POST['radper60'] && $_POST['radper60'] == "Letra C"){

  $corc60 = $corerr;
  $simc60 = " X";

}

elseif ($alt_corr60 != $_POST['radper60'] && $_POST['radper60'] == "Letra D"){

  $cord60 = $corerr;
  $simd60 = " X";

}

elseif ($alt_corr60 != $_POST['radper60'] && $_POST['radper60'] == "Letra E"){

  $core60 = $corerr;
  $sime60 = " X";

}

  

  // Verficando qual será checado 60

  if ($_POST['radper60'] == "Letra A"){

    $chea60 = "Checked";

    $cheb60 = "";

    $chec60 = "";

    $ched60 = "";

    $chee60 = "";

  }elseif ($_POST['radper60'] == "Letra B"){

    $chea60 = "";

    $cheb60 = "Checked";

    $chec60 = "";

    $ched60 = "";

    $chee60 = "";

  }elseif ($_POST['radper60'] == "Letra C"){

    $chea60 = "";

    $cheb60 = "";

    $chec60 = "Checked";

    $ched60 = "";

    $chee60 = "";

  }elseif ($_POST['radper60'] == "Letra D"){

    $chea60 = "";

    $cheb60 = "";

    $chec60 = "";

    $ched60 = "Checked";

    $chee60 = "";

  }elseif ($_POST['radper60'] == "Letra E"){

    $chea60 = "";

    $cheb60 = "";

    $chec60 = "";

    $ched60 = "";

    $chee60 = "Checked";

  }

  

  // Verificando se respsota esta correta 60

  if ($_POST['radper60'] == $alt_corr60){

    $contrescorr = $contrescorr + 1;

    $cer_err60 = 1;

}

else{

  $cer_err60 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 60

if ($_POST['radper60'] == "Letra A"){

  $codigo_resposta60 = $letraaper60['codigo_resposta'];

}elseif ($_POST['radper60'] == "Letra B"){

  $codigo_resposta60 = $letrabper60['codigo_resposta'];

}elseif ($_POST['radper60'] == "Letra C"){

  $codigo_resposta60 = $letracper60['codigo_resposta'];

}elseif ($_POST['radper60'] == "Letra D"){

  $codigo_resposta60 = $letradper60['codigo_resposta'];

}elseif ($_POST['radper60'] == "Letra E"){

  $codigo_resposta60 = $letraeper60['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 60

$codigo_disciplina60 = $per60['codigo_disciplina'];

  

  // Selecionando imagem 60

  $imgper60 = $per60['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp60 = $letraaper60['tipo'];

  

  }





  // Verificando se existe perguntas de 61 à 65

if ($qtperguntas>60){



  //Questão 61

  $codper61 = $_SESSION['codper61'];

  $select_per61 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper61");

  $per61 = mysqli_fetch_assoc($select_per61);

  

  $select_letraaper61 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper61 and letra = 'a'");

  $letraaper61 = mysqli_fetch_assoc($select_letraaper61);

  $select_letrabper61 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper61 and letra = 'b'");

  $letrabper61 = mysqli_fetch_assoc($select_letrabper61);

  $select_letracper61 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper61 and letra = 'c'");

  $letracper61 = mysqli_fetch_assoc($select_letracper61);

  $select_letradper61 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper61 and letra = 'd'");

  $letradper61 = mysqli_fetch_assoc($select_letradper61);

  $select_letraeper61 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper61 and letra = 'e'");

  $letraeper61 = mysqli_fetch_assoc($select_letraeper61);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper61["correta"]==1){

  $alt_corr61 = "Letra A";

  $cora61 = $corcorr;
  $sima61 = " ✓";

  $corb61 = "black";
  $simb61 = "";

  $corc61 = "black";
  $simc61 = "";

  $cord61 = "black";
  $simd61 = "";

  $core61 = "black";
  $sime61 = "";

}

elseif ($letrabper61["correta"]==1){

  $alt_corr61 = "Letra B";

  $corb61 = $corcorr;
  $simb61 = " ✓";

  $cora61 = "black";
  $sima61 = "";

  $corc61 = "black";
  $simc61 = "";

  $cord61 = "black";
  $simd61 = "";

  $core61 = "black";
  $sime61 = "";

}

elseif ($letracper61["correta"]==1){

  $alt_corr61 = "Letra C";

  $corc61 = $corcorr;
  $simc61 = " ✓";

  $cora61 = "black";
  $sima61 = "";

  $corb61 = "black";
  $simb61 = "";

  $cord61 = "black";
  $simd61 = "";

  $core61 = "black";
  $sime61 = "";

}

elseif ($letradper61["correta"]==1){

  $alt_corr61 = "Letra D";

  $cord61 = $corcorr;
  $simd61 = " ✓";

  $cora61 = "black";
  $sima61 = "";

  $corc61 = "black";
  $simc61 = "";

  $corb61 = "black";
  $simb61 = "";

  $core61 = "black";
  $sime61 = "";

}

elseif ($letraeper61["correta"]==1){

  $alt_corr61 = "Letra E";

  $core61 = $corcorr;
  $sime61 = " ✓";

  $cora61 = "black";
  $sima61 = "";

  $corc61 = "black";
  $simc61 = "";

  $cord61 = "black";
  $simd61 = "";

  $corb61 = "black";
  $simb61 = "";

}

//Errada

if ($alt_corr61 != $_POST['radper61'] && $_POST['radper61'] == "Letra A"){

  $cora61 = $corerr;
  $sima61 = " X";

}

elseif ($alt_corr61 != $_POST['radper61'] && $_POST['radper61'] == "Letra B"){

  $corb61 = $corerr;
  $simb61 = " X";

}

elseif ($alt_corr61 != $_POST['radper61'] && $_POST['radper61'] == "Letra C"){

  $corc61 = $corerr;
  $simc61 = " X";

}

elseif ($alt_corr61 != $_POST['radper61'] && $_POST['radper61'] == "Letra D"){

  $cord61 = $corerr;
  $simd61 = " X";

}

elseif ($alt_corr61 != $_POST['radper61'] && $_POST['radper61'] == "Letra E"){

  $core61 = $corerr;
  $sime61 = " X";

}

  

  // Verficando qual será checado 61

  if ($_POST['radper61'] == "Letra A"){

    $chea61 = "Checked";

    $cheb61 = "";

    $chec61 = "";

    $ched61 = "";

    $chee61 = "";

  }elseif ($_POST['radper61'] == "Letra B"){

    $chea61 = "";

    $cheb61 = "Checked";

    $chec61 = "";

    $ched61 = "";

    $chee61 = "";

  }elseif ($_POST['radper61'] == "Letra C"){

    $chea61 = "";

    $cheb61 = "";

    $chec61 = "Checked";

    $ched61 = "";

    $chee61 = "";

  }elseif ($_POST['radper61'] == "Letra D"){

    $chea61 = "";

    $cheb61 = "";

    $chec61 = "";

    $ched61 = "Checked";

    $chee61 = "";

  }elseif ($_POST['radper61'] == "Letra E"){

    $chea61 = "";

    $cheb61 = "";

    $chec61 = "";

    $ched61 = "";

    $chee61 = "Checked";

  }

  

  // Verificando se respsota esta correta 61

  if ($_POST['radper61'] == $alt_corr61){

    $contrescorr = $contrescorr + 1;

    $cer_err61 = 1;

}

else{

  $cer_err61 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 61

if ($_POST['radper61'] == "Letra A"){

  $codigo_resposta61 = $letraaper61['codigo_resposta'];

}elseif ($_POST['radper61'] == "Letra B"){

  $codigo_resposta61 = $letrabper61['codigo_resposta'];

}elseif ($_POST['radper61'] == "Letra C"){

  $codigo_resposta61 = $letracper61['codigo_resposta'];

}elseif ($_POST['radper61'] == "Letra D"){

  $codigo_resposta61 = $letradper61['codigo_resposta'];

}elseif ($_POST['radper61'] == "Letra E"){

  $codigo_resposta61 = $letraeper61['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 61

$codigo_disciplina61 = $per61['codigo_disciplina'];

  

  // Selecionando imagem 61

  $imgper61 = $per61['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp61 = $letraaper61['tipo'];

  

  

  //Questão 62

  $codper62 = $_SESSION['codper62'];

  $select_per62 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper62");

  $per62 = mysqli_fetch_assoc($select_per62);

  

  $select_letraaper62 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper62 and letra = 'a'");

  $letraaper62 = mysqli_fetch_assoc($select_letraaper62);

  $select_letrabper62 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper62 and letra = 'b'");

  $letrabper62 = mysqli_fetch_assoc($select_letrabper62);

  $select_letracper62 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper62 and letra = 'c'");

  $letracper62 = mysqli_fetch_assoc($select_letracper62);

  $select_letradper62 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper62 and letra = 'd'");

  $letradper62 = mysqli_fetch_assoc($select_letradper62);

  $select_letraeper62 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper62 and letra = 'e'");

  $letraeper62 = mysqli_fetch_assoc($select_letraeper62);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper62["correta"]==1){

  $alt_corr62 = "Letra A";

  $cora62 = $corcorr;
  $sima62 = " ✓";

  $corb62 = "black";
  $simb62 = "";

  $corc62 = "black";
  $simc62 = "";

  $cord62 = "black";
  $simd62 = "";

  $core62 = "black";
  $sime62 = "";

}

elseif ($letrabper62["correta"]==1){

  $alt_corr62 = "Letra B";

  $corb62 = $corcorr;
  $simb62 = " ✓";

  $cora62 = "black";
  $sima62 = "";

  $corc62 = "black";
  $simc62 = "";

  $cord62 = "black";
  $simd62 = "";

  $core62 = "black";
  $sime62 = "";

}

elseif ($letracper62["correta"]==1){

  $alt_corr62 = "Letra C";

  $corc62 = $corcorr;
  $simc62 = " ✓";

  $cora62 = "black";
  $sima62 = "";

  $corb62 = "black";
  $simb62 = "";

  $cord62 = "black";
  $simd62 = "";

  $core62 = "black";
  $sime62 = "";

}

elseif ($letradper62["correta"]==1){

  $alt_corr62 = "Letra D";

  $cord62 = $corcorr;
  $simd62 = " ✓";

  $cora62 = "black";
  $sima62 = "";

  $corc62 = "black";
  $simc62 = "";

  $corb62 = "black";
  $simb62 = "";

  $core62 = "black";
  $sime62 = "";

}

elseif ($letraeper62["correta"]==1){

  $alt_corr62 = "Letra E";

  $core62 = $corcorr;
  $sime62 = " ✓";

  $cora62 = "black";
  $sima62 = "";

  $corc62 = "black";
  $simc62 = "";

  $cord62 = "black";
  $simd62 = "";

  $corb62 = "black";
  $simb62 = "";

}

//Errada

if ($alt_corr62 != $_POST['radper62'] && $_POST['radper62'] == "Letra A"){

  $cora62 = $corerr;
  $sima62 = " X";

}

elseif ($alt_corr62 != $_POST['radper62'] && $_POST['radper62'] == "Letra B"){

  $corb62 = $corerr;
  $simb62 = " X";

}

elseif ($alt_corr62 != $_POST['radper62'] && $_POST['radper62'] == "Letra C"){

  $corc62 = $corerr;
  $simc62 = " X";

}

elseif ($alt_corr62 != $_POST['radper62'] && $_POST['radper62'] == "Letra D"){

  $cord62 = $corerr;
  $simd62 = " X";

}

elseif ($alt_corr62 != $_POST['radper62'] && $_POST['radper62'] == "Letra E"){

  $core62 = $corerr;
  $sime62 = " X";

}

  

  // Verficando qual será checado 62

  if ($_POST['radper62'] == "Letra A"){

    $chea62 = "Checked";

    $cheb62 = "";

    $chec62 = "";

    $ched62 = "";

    $chee62 = "";

  }elseif ($_POST['radper62'] == "Letra B"){

    $chea62 = "";

    $cheb62 = "Checked";

    $chec62 = "";

    $ched62 = "";

    $chee62 = "";

  }elseif ($_POST['radper62'] == "Letra C"){

    $chea62 = "";

    $cheb62 = "";

    $chec62 = "Checked";

    $ched62 = "";

    $chee62 = "";

  }elseif ($_POST['radper62'] == "Letra D"){

    $chea62 = "";

    $cheb62 = "";

    $chec62 = "";

    $ched62 = "Checked";

    $chee62 = "";

  }elseif ($_POST['radper62'] == "Letra E"){

    $chea62 = "";

    $cheb62 = "";

    $chec62 = "";

    $ched62 = "";

    $chee62 = "Checked";

  }

  

  // Verificando se respsota esta correta 62

  if ($_POST['radper62'] == $alt_corr62){

    $contrescorr = $contrescorr + 1;

    $cer_err62 = 1;

}

else{

  $cer_err62 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 62

if ($_POST['radper62'] == "Letra A"){

  $codigo_resposta62 = $letraaper62['codigo_resposta'];

}elseif ($_POST['radper62'] == "Letra B"){

  $codigo_resposta62 = $letrabper62['codigo_resposta'];

}elseif ($_POST['radper62'] == "Letra C"){

  $codigo_resposta62 = $letracper62['codigo_resposta'];

}elseif ($_POST['radper62'] == "Letra D"){

  $codigo_resposta62 = $letradper62['codigo_resposta'];

}elseif ($_POST['radper62'] == "Letra E"){

  $codigo_resposta62 = $letraeper62['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 62

$codigo_disciplina62 = $per62['codigo_disciplina'];

  

  // Selecionando imagem 62

  $imgper62 = $per62['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp62 = $letraaper62['tipo'];

  

  

  //Questão 63

  $codper63 = $_SESSION['codper63'];

  $select_per63 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper63");

  $per63 = mysqli_fetch_assoc($select_per63);

  

  $select_letraaper63 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper63 and letra = 'a'");

  $letraaper63 = mysqli_fetch_assoc($select_letraaper63);

  $select_letrabper63 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper63 and letra = 'b'");

  $letrabper63 = mysqli_fetch_assoc($select_letrabper63);

  $select_letracper63 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper63 and letra = 'c'");

  $letracper63 = mysqli_fetch_assoc($select_letracper63);

  $select_letradper63 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper63 and letra = 'd'");

  $letradper63 = mysqli_fetch_assoc($select_letradper63);

  $select_letraeper63 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper63 and letra = 'e'");

  $letraeper63 = mysqli_fetch_assoc($select_letraeper63);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper63["correta"]==1){

  $alt_corr63 = "Letra A";

  $cora63 = $corcorr;
  $sima63 = " ✓";

  $corb63 = "black";
  $simb63 = "";

  $corc63 = "black";
  $simc63 = "";

  $cord63 = "black";
  $simd63 = "";

  $core63 = "black";
  $sime63 = "";

}

elseif ($letrabper63["correta"]==1){

  $alt_corr63 = "Letra B";

  $corb63 = $corcorr;
  $simb63 = " ✓";

  $cora63 = "black";
  $sima63 = "";

  $corc63 = "black";
  $simc63 = "";

  $cord63 = "black";
  $simd63 = "";

  $core63 = "black";
  $sime63 = "";

}

elseif ($letracper63["correta"]==1){

  $alt_corr63 = "Letra C";

  $corc63 = $corcorr;
  $simc63 = " ✓";

  $cora63 = "black";
  $sima63 = "";

  $corb63 = "black";
  $simb63 = "";

  $cord63 = "black";
  $simd63 = "";

  $core63 = "black";
  $sime63 = "";

}

elseif ($letradper63["correta"]==1){

  $alt_corr63 = "Letra D";

  $cord63 = $corcorr;
  $simd63 = " ✓";

  $cora63 = "black";
  $sima63 = "";

  $corc63 = "black";
  $simc63 = "";

  $corb63 = "black";
  $simb63 = "";

  $core63 = "black";
  $sime63 = "";

}

elseif ($letraeper63["correta"]==1){

  $alt_corr63 = "Letra E";

  $core63 = $corcorr;
  $sime63 = " ✓";

  $cora63 = "black";
  $sima63 = "";

  $corc63 = "black";
  $simc63 = "";

  $cord63 = "black";
  $simd63 = "";

  $corb63 = "black";
  $simb63 = "";

}

//Errada

if ($alt_corr63 != $_POST['radper63'] && $_POST['radper63'] == "Letra A"){

  $cora63 = $corerr;
  $sima63 = " X";

}

elseif ($alt_corr63 != $_POST['radper63'] && $_POST['radper63'] == "Letra B"){

  $corb63 = $corerr;
  $simb63 = " X";

}

elseif ($alt_corr63 != $_POST['radper63'] && $_POST['radper63'] == "Letra C"){

  $corc63 = $corerr;
  $simc63 = " X";

}

elseif ($alt_corr63 != $_POST['radper63'] && $_POST['radper63'] == "Letra D"){

  $cord63 = $corerr;
  $simd63 = " X";

}

elseif ($alt_corr63 != $_POST['radper63'] && $_POST['radper63'] == "Letra E"){

  $core63 = $corerr;
  $sime63 = " X";

}

  

  // Verficando qual será checado 63

  if ($_POST['radper63'] == "Letra A"){

    $chea63 = "Checked";

    $cheb63 = "";

    $chec63 = "";

    $ched63 = "";

    $chee63 = "";

  }elseif ($_POST['radper63'] == "Letra B"){

    $chea63 = "";

    $cheb63 = "Checked";

    $chec63 = "";

    $ched63 = "";

    $chee63 = "";

  }elseif ($_POST['radper63'] == "Letra C"){

    $chea63 = "";

    $cheb63 = "";

    $chec63 = "Checked";

    $ched63 = "";

    $chee63 = "";

  }elseif ($_POST['radper63'] == "Letra D"){

    $chea63 = "";

    $cheb63 = "";

    $chec63 = "";

    $ched63 = "Checked";

    $chee63 = "";

  }elseif ($_POST['radper63'] == "Letra E"){

    $chea63 = "";

    $cheb63 = "";

    $chec63 = "";

    $ched63 = "";

    $chee63 = "Checked";

  }

  

  // Verificando se respsota esta correta 63

  if ($_POST['radper63'] == $alt_corr63){

    $contrescorr = $contrescorr + 1;

    $cer_err63 = 1;

}

else{

  $cer_err63 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 63

if ($_POST['radper63'] == "Letra A"){

  $codigo_resposta63 = $letraaper63['codigo_resposta'];

}elseif ($_POST['radper63'] == "Letra B"){

  $codigo_resposta63 = $letrabper63['codigo_resposta'];

}elseif ($_POST['radper63'] == "Letra C"){

  $codigo_resposta63 = $letracper63['codigo_resposta'];

}elseif ($_POST['radper63'] == "Letra D"){

  $codigo_resposta63 = $letradper63['codigo_resposta'];

}elseif ($_POST['radper63'] == "Letra E"){

  $codigo_resposta63 = $letraeper63['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 63

$codigo_disciplina63 = $per63['codigo_disciplina'];

  

  // Selecionando imagem 63

  $imgper63 = $per63['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp63 = $letraaper63['tipo'];

  

  

  //Questão 64

  $codper64 = $_SESSION['codper64'];

  $select_per64 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper64");

  $per64 = mysqli_fetch_assoc($select_per64);

  

  $select_letraaper64 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper64 and letra = 'a'");

  $letraaper64 = mysqli_fetch_assoc($select_letraaper64);

  $select_letrabper64 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper64 and letra = 'b'");

  $letrabper64 = mysqli_fetch_assoc($select_letrabper64);

  $select_letracper64 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper64 and letra = 'c'");

  $letracper64 = mysqli_fetch_assoc($select_letracper64);

  $select_letradper64 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper64 and letra = 'd'");

  $letradper64 = mysqli_fetch_assoc($select_letradper64);

  $select_letraeper64 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper64 and letra = 'e'");

  $letraeper64 = mysqli_fetch_assoc($select_letraeper64);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper64["correta"]==1){

  $alt_corr64 = "Letra A";

  $cora64 = $corcorr;
  $sima64 = " ✓";

  $corb64 = "black";
  $simb64 = "";

  $corc64 = "black";
  $simc64 = "";

  $cord64 = "black";
  $simd64 = "";

  $core64 = "black";
  $sime64 = "";

}

elseif ($letrabper64["correta"]==1){

  $alt_corr64 = "Letra B";

  $corb64 = $corcorr;
  $simb64 = " ✓";

  $cora64 = "black";
  $sima64 = "";

  $corc64 = "black";
  $simc64 = "";

  $cord64 = "black";
  $simd64 = "";

  $core64 = "black";
  $sime64 = "";

}

elseif ($letracper64["correta"]==1){

  $alt_corr64 = "Letra C";

  $corc64 = $corcorr;
  $simc64 = " ✓";

  $cora64 = "black";
  $sima64 = "";

  $corb64 = "black";
  $simb64 = "";

  $cord64 = "black";
  $simd64 = "";

  $core64 = "black";
  $sime64 = "";

}

elseif ($letradper64["correta"]==1){

  $alt_corr64 = "Letra D";

  $cord64 = $corcorr;
  $simd64 = " ✓";

  $cora64 = "black";
  $sima64 = "";

  $corc64 = "black";
  $simc64 = "";

  $corb64 = "black";
  $simb64 = "";

  $core64 = "black";
  $sime64 = "";

}

elseif ($letraeper64["correta"]==1){

  $alt_corr64 = "Letra E";

  $core64 = $corcorr;
  $sime64 = " ✓";

  $cora64 = "black";
  $sima64 = "";

  $corc64 = "black";
  $simc64 = "";

  $cord64 = "black";
  $simd64 = "";

  $corb64 = "black";
  $simb64 = "";

}

//Errada

if ($alt_corr64 != $_POST['radper64'] && $_POST['radper64'] == "Letra A"){

  $cora64 = $corerr;
  $sima64 = " X";

}

elseif ($alt_corr64 != $_POST['radper64'] && $_POST['radper64'] == "Letra B"){

  $corb64 = $corerr;
  $simb64 = " X";

}

elseif ($alt_corr64 != $_POST['radper64'] && $_POST['radper64'] == "Letra C"){

  $corc64 = $corerr;
  $simc64 = " X";

}

elseif ($alt_corr64 != $_POST['radper64'] && $_POST['radper64'] == "Letra D"){

  $cord64 = $corerr;
  $simd64 = " X";

}

elseif ($alt_corr64 != $_POST['radper64'] && $_POST['radper64'] == "Letra E"){

  $core64 = $corerr;
  $sime64 = " X";

}

  

  // Verficando qual será checado 64

  if ($_POST['radper64'] == "Letra A"){

    $chea64 = "Checked";

    $cheb64 = "";

    $chec64 = "";

    $ched64 = "";

    $chee64 = "";

  }elseif ($_POST['radper64'] == "Letra B"){

    $chea64 = "";

    $cheb64 = "Checked";

    $chec64 = "";

    $ched64 = "";

    $chee64 = "";

  }elseif ($_POST['radper64'] == "Letra C"){

    $chea64 = "";

    $cheb64 = "";

    $chec64 = "Checked";

    $ched64 = "";

    $chee64 = "";

  }elseif ($_POST['radper64'] == "Letra D"){

    $chea64 = "";

    $cheb64 = "";

    $chec64 = "";

    $ched64 = "Checked";

    $chee64 = "";

  }elseif ($_POST['radper64'] == "Letra E"){

    $chea64 = "";

    $cheb64 = "";

    $chec64 = "";

    $ched64 = "";

    $chee64 = "Checked";

  }

  

  // Verificando se respsota esta correta 64

  if ($_POST['radper64'] == $alt_corr64){

    $contrescorr = $contrescorr + 1;

    $cer_err64 = 1;

}

else{

  $cer_err64 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 64

if ($_POST['radper64'] == "Letra A"){

  $codigo_resposta64 = $letraaper64['codigo_resposta'];

}elseif ($_POST['radper64'] == "Letra B"){

  $codigo_resposta64 = $letrabper64['codigo_resposta'];

}elseif ($_POST['radper64'] == "Letra C"){

  $codigo_resposta64 = $letracper64['codigo_resposta'];

}elseif ($_POST['radper64'] == "Letra D"){

  $codigo_resposta64 = $letradper64['codigo_resposta'];

}elseif ($_POST['radper64'] == "Letra E"){

  $codigo_resposta64 = $letraeper64['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 64

$codigo_disciplina64 = $per64['codigo_disciplina'];

  

  // Selecionando imagem 64

  $imgper64 = $per64['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp64 = $letraaper64['tipo'];

  

  

  //Questão 65

  $codper65 = $_SESSION['codper65'];

  $select_per65 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper65");

  $per65 = mysqli_fetch_assoc($select_per65);

  

  $select_letraaper65 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper65 and letra = 'a'");

  $letraaper65 = mysqli_fetch_assoc($select_letraaper65);

  $select_letrabper65 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper65 and letra = 'b'");

  $letrabper65 = mysqli_fetch_assoc($select_letrabper65);

  $select_letracper65 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper65 and letra = 'c'");

  $letracper65 = mysqli_fetch_assoc($select_letracper65);

  $select_letradper65 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper65 and letra = 'd'");

  $letradper65 = mysqli_fetch_assoc($select_letradper65);

  $select_letraeper65 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper65 and letra = 'e'");

  $letraeper65 = mysqli_fetch_assoc($select_letraeper65);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper65["correta"]==1){

  $alt_corr65 = "Letra A";

  $cora65 = $corcorr;
  $sima65 = " ✓";

  $corb65 = "black";
  $simb65 = "";

  $corc65 = "black";
  $simc65 = "";

  $cord65 = "black";
  $simd65 = "";

  $core65 = "black";
  $sime65 = "";

}

elseif ($letrabper65["correta"]==1){

  $alt_corr65 = "Letra B";

  $corb65 = $corcorr;
  $simb65 = " ✓";

  $cora65 = "black";
  $sima65 = "";

  $corc65 = "black";
  $simc65 = "";

  $cord65 = "black";
  $simd65 = "";

  $core65 = "black";
  $sime65 = "";

}

elseif ($letracper65["correta"]==1){

  $alt_corr65 = "Letra C";

  $corc65 = $corcorr;
  $simc65 = " ✓";

  $cora65 = "black";
  $sima65 = "";

  $corb65 = "black";
  $simb65 = "";

  $cord65 = "black";
  $simd65 = "";

  $core65 = "black";
  $sime65 = "";

}

elseif ($letradper65["correta"]==1){

  $alt_corr65 = "Letra D";

  $cord65 = $corcorr;
  $simd65 = " ✓";

  $cora65 = "black";
  $sima65 = "";

  $corc65 = "black";
  $simc65 = "";

  $corb65 = "black";
  $simb65 = "";

  $core65 = "black";
  $sime65 = "";

}

elseif ($letraeper65["correta"]==1){

  $alt_corr65 = "Letra E";

  $core65 = $corcorr;
  $sime65 = " ✓";

  $cora65 = "black";
  $sima65 = "";

  $corc65 = "black";
  $simc65 = "";

  $cord65 = "black";
  $simd65 = "";

  $corb65 = "black";
  $simb65 = "";

}

//Errada

if ($alt_corr65 != $_POST['radper65'] && $_POST['radper65'] == "Letra A"){

  $cora65 = $corerr;
  $sima65 = " X";

}

elseif ($alt_corr65 != $_POST['radper65'] && $_POST['radper65'] == "Letra B"){

  $corb65 = $corerr;
  $simb65 = " X";

}

elseif ($alt_corr65 != $_POST['radper65'] && $_POST['radper65'] == "Letra C"){

  $corc65 = $corerr;
  $simc65 = " X";

}

elseif ($alt_corr65 != $_POST['radper65'] && $_POST['radper65'] == "Letra D"){

  $cord65 = $corerr;
  $simd65 = " X";

}

elseif ($alt_corr65 != $_POST['radper65'] && $_POST['radper65'] == "Letra E"){

  $core65 = $corerr;
  $sime65 = " X";

}

  

  // Verficando qual será checado 65

  if ($_POST['radper65'] == "Letra A"){

    $chea65 = "Checked";

    $cheb65 = "";

    $chec65 = "";

    $ched65 = "";

    $chee65 = "";

  }elseif ($_POST['radper65'] == "Letra B"){

    $chea65 = "";

    $cheb65 = "Checked";

    $chec65 = "";

    $ched65 = "";

    $chee65 = "";

  }elseif ($_POST['radper65'] == "Letra C"){

    $chea65 = "";

    $cheb65 = "";

    $chec65 = "Checked";

    $ched65 = "";

    $chee65 = "";

  }elseif ($_POST['radper65'] == "Letra D"){

    $chea65 = "";

    $cheb65 = "";

    $chec65 = "";

    $ched65 = "Checked";

    $chee65 = "";

  }elseif ($_POST['radper65'] == "Letra E"){

    $chea65 = "";

    $cheb65 = "";

    $chec65 = "";

    $ched65 = "";

    $chee65 = "Checked";

  }

  

  // Verificando se respsota esta correta 65

  if ($_POST['radper65'] == $alt_corr65){

    $contrescorr = $contrescorr + 1;

    $cer_err65 = 1;

}

else{

  $cer_err65 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 65

if ($_POST['radper65'] == "Letra A"){

  $codigo_resposta65 = $letraaper65['codigo_resposta'];

}elseif ($_POST['radper65'] == "Letra B"){

  $codigo_resposta65 = $letrabper65['codigo_resposta'];

}elseif ($_POST['radper65'] == "Letra C"){

  $codigo_resposta65 = $letracper65['codigo_resposta'];

}elseif ($_POST['radper65'] == "Letra D"){

  $codigo_resposta65 = $letradper65['codigo_resposta'];

}elseif ($_POST['radper65'] == "Letra E"){

  $codigo_resposta65 = $letraeper65['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 65

$codigo_disciplina65 = $per65['codigo_disciplina'];

  

  // Selecionando imagem 65

  $imgper65 = $per65['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp65 = $letraaper65['tipo'];

  

  }





  // Verificando se existe perguntas de 66 à 70

if ($qtperguntas>65){



  //Questão 66

  $codper66 = $_SESSION['codper66'];

  $select_per66 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper66");

  $per66 = mysqli_fetch_assoc($select_per66);

  

  $select_letraaper66 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper66 and letra = 'a'");

  $letraaper66 = mysqli_fetch_assoc($select_letraaper66);

  $select_letrabper66 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper66 and letra = 'b'");

  $letrabper66 = mysqli_fetch_assoc($select_letrabper66);

  $select_letracper66 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper66 and letra = 'c'");

  $letracper66 = mysqli_fetch_assoc($select_letracper66);

  $select_letradper66 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper66 and letra = 'd'");

  $letradper66 = mysqli_fetch_assoc($select_letradper66);

  $select_letraeper66 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper66 and letra = 'e'");

  $letraeper66 = mysqli_fetch_assoc($select_letraeper66);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper66["correta"]==1){

  $alt_corr66 = "Letra A";

  $cora66 = $corcorr;
  $sima66 = " ✓";

  $corb66 = "black";
  $simb66 = "";

  $corc66 = "black";
  $simc66 = "";

  $cord66 = "black";
  $simd66 = "";

  $core66 = "black";
  $sime66 = "";

}

elseif ($letrabper66["correta"]==1){

  $alt_corr66 = "Letra B";

  $corb66 = $corcorr;
  $simb66 = " ✓";

  $cora66 = "black";
  $sima66 = "";

  $corc66 = "black";
  $simc66 = "";

  $cord66 = "black";
  $simd66 = "";

  $core66 = "black";
  $sime66 = "";

}

elseif ($letracper66["correta"]==1){

  $alt_corr66 = "Letra C";

  $corc66 = $corcorr;
  $simc66 = " ✓";

  $cora66 = "black";
  $sima66 = "";

  $corb66 = "black";
  $simb66 = "";

  $cord66 = "black";
  $simd66 = "";

  $core66 = "black";
  $sime66 = "";

}

elseif ($letradper66["correta"]==1){

  $alt_corr66 = "Letra D";

  $cord66 = $corcorr;
  $simd66 = " ✓";

  $cora66 = "black";
  $sima66 = "";

  $corc66 = "black";
  $simc66 = "";

  $corb66 = "black";
  $simb66 = "";

  $core66 = "black";
  $sime66 = "";

}

elseif ($letraeper66["correta"]==1){

  $alt_corr66 = "Letra E";

  $core66 = $corcorr;
  $sime66 = " ✓";

  $cora66 = "black";
  $sima66 = "";

  $corc66 = "black";
  $simc66 = "";

  $cord66 = "black";
  $simd66 = "";

  $corb66 = "black";
  $simb66 = "";

}

//Errada

if ($alt_corr66 != $_POST['radper66'] && $_POST['radper66'] == "Letra A"){

  $cora66 = $corerr;
  $sima66 = " X";

}

elseif ($alt_corr66 != $_POST['radper66'] && $_POST['radper66'] == "Letra B"){

  $corb66 = $corerr;
  $simb66 = " X";

}

elseif ($alt_corr66 != $_POST['radper66'] && $_POST['radper66'] == "Letra C"){

  $corc66 = $corerr;
  $simc66 = " X";

}

elseif ($alt_corr66 != $_POST['radper66'] && $_POST['radper66'] == "Letra D"){

  $cord66 = $corerr;
  $simd66 = " X";

}

elseif ($alt_corr66 != $_POST['radper66'] && $_POST['radper66'] == "Letra E"){

  $core66 = $corerr;
  $sime66 = " X";

}

  

  // Verficando qual será checado 66

  if ($_POST['radper66'] == "Letra A"){

    $chea66 = "Checked";

    $cheb66 = "";

    $chec66 = "";

    $ched66 = "";

    $chee66 = "";

  }elseif ($_POST['radper66'] == "Letra B"){

    $chea66 = "";

    $cheb66 = "Checked";

    $chec66 = "";

    $ched66 = "";

    $chee66 = "";

  }elseif ($_POST['radper66'] == "Letra C"){

    $chea66 = "";

    $cheb66 = "";

    $chec66 = "Checked";

    $ched66 = "";

    $chee66 = "";

  }elseif ($_POST['radper66'] == "Letra D"){

    $chea66 = "";

    $cheb66 = "";

    $chec66 = "";

    $ched66 = "Checked";

    $chee66 = "";

  }elseif ($_POST['radper66'] == "Letra E"){

    $chea66 = "";

    $cheb66 = "";

    $chec66 = "";

    $ched66 = "";

    $chee66 = "Checked";

  }

  

  // Verificando se respsota esta correta 66

  if ($_POST['radper66'] == $alt_corr66){

    $contrescorr = $contrescorr + 1;

    $cer_err66 = 1;

}

else{

  $cer_err66 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 66

if ($_POST['radper66'] == "Letra A"){

  $codigo_resposta66 = $letraaper66['codigo_resposta'];

}elseif ($_POST['radper66'] == "Letra B"){

  $codigo_resposta66 = $letrabper66['codigo_resposta'];

}elseif ($_POST['radper66'] == "Letra C"){

  $codigo_resposta66 = $letracper66['codigo_resposta'];

}elseif ($_POST['radper66'] == "Letra D"){

  $codigo_resposta66 = $letradper66['codigo_resposta'];

}elseif ($_POST['radper66'] == "Letra E"){

  $codigo_resposta66 = $letraeper66['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 66

$codigo_disciplina66 = $per66['codigo_disciplina'];

  

  // Selecionando imagem 66

  $imgper66 = $per66['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp66 = $letraaper66['tipo'];

  

  

  //Questão 67

  $codper67 = $_SESSION['codper67'];

  $select_per67 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper67");

  $per67 = mysqli_fetch_assoc($select_per67);

  

  $select_letraaper67 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper67 and letra = 'a'");

  $letraaper67 = mysqli_fetch_assoc($select_letraaper67);

  $select_letrabper67 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper67 and letra = 'b'");

  $letrabper67 = mysqli_fetch_assoc($select_letrabper67);

  $select_letracper67 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper67 and letra = 'c'");

  $letracper67 = mysqli_fetch_assoc($select_letracper67);

  $select_letradper67 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper67 and letra = 'd'");

  $letradper67 = mysqli_fetch_assoc($select_letradper67);

  $select_letraeper67 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper67 and letra = 'e'");

  $letraeper67 = mysqli_fetch_assoc($select_letraeper67);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper67["correta"]==1){

  $alt_corr67 = "Letra A";

  $cora67 = $corcorr;
  $sima67 = " ✓";

  $corb67 = "black";
  $simb67 = "";

  $corc67 = "black";
  $simc67 = "";

  $cord67 = "black";
  $simd67 = "";

  $core67 = "black";
  $sime67 = "";

}

elseif ($letrabper67["correta"]==1){

  $alt_corr67 = "Letra B";

  $corb67 = $corcorr;
  $simb67 = " ✓";

  $cora67 = "black";
  $sima67 = "";

  $corc67 = "black";
  $simc67 = "";

  $cord67 = "black";
  $simd67 = "";

  $core67 = "black";
  $sime67 = "";

}

elseif ($letracper67["correta"]==1){

  $alt_corr67 = "Letra C";

  $corc67 = $corcorr;
  $simc67 = " ✓";

  $cora67 = "black";
  $sima67 = "";

  $corb67 = "black";
  $simb67 = "";

  $cord67 = "black";
  $simd67 = "";

  $core67 = "black";
  $sime67 = "";

}

elseif ($letradper67["correta"]==1){

  $alt_corr67 = "Letra D";

  $cord67 = $corcorr;
  $simd67 = " ✓";

  $cora67 = "black";
  $sima67 = "";

  $corc67 = "black";
  $simc67 = "";

  $corb67 = "black";
  $simb67 = "";

  $core67 = "black";
  $sime67 = "";

}

elseif ($letraeper67["correta"]==1){

  $alt_corr67 = "Letra E";

  $core67 = $corcorr;
  $sime67 = " ✓";

  $cora67 = "black";
  $sima67 = "";

  $corc67 = "black";
  $simc67 = "";

  $cord67 = "black";
  $simd67 = "";

  $corb67 = "black";
  $simb67 = "";

}

//Errada

if ($alt_corr67 != $_POST['radper67'] && $_POST['radper67'] == "Letra A"){

  $cora67 = $corerr;
  $sima67 = " X";

}

elseif ($alt_corr67 != $_POST['radper67'] && $_POST['radper67'] == "Letra B"){

  $corb67 = $corerr;
  $simb67 = " X";

}

elseif ($alt_corr67 != $_POST['radper67'] && $_POST['radper67'] == "Letra C"){

  $corc67 = $corerr;
  $simc67 = " X";

}

elseif ($alt_corr67 != $_POST['radper67'] && $_POST['radper67'] == "Letra D"){

  $cord67 = $corerr;
  $simd67 = " X";

}

elseif ($alt_corr67 != $_POST['radper67'] && $_POST['radper67'] == "Letra E"){

  $core67 = $corerr;
  $sime67 = " X";

}

  

  // Verficando qual será checado 67

  if ($_POST['radper67'] == "Letra A"){

    $chea67 = "Checked";

    $cheb67 = "";

    $chec67 = "";

    $ched67 = "";

    $chee67 = "";

  }elseif ($_POST['radper67'] == "Letra B"){

    $chea67 = "";

    $cheb67 = "Checked";

    $chec67 = "";

    $ched67 = "";

    $chee67 = "";

  }elseif ($_POST['radper67'] == "Letra C"){

    $chea67 = "";

    $cheb67 = "";

    $chec67 = "Checked";

    $ched67 = "";

    $chee67 = "";

  }elseif ($_POST['radper67'] == "Letra D"){

    $chea67 = "";

    $cheb67 = "";

    $chec67 = "";

    $ched67 = "Checked";

    $chee67 = "";

  }elseif ($_POST['radper67'] == "Letra E"){

    $chea67 = "";

    $cheb67 = "";

    $chec67 = "";

    $ched67 = "";

    $chee67 = "Checked";

  }

  

  // Verificando se respsota esta correta 67

  if ($_POST['radper67'] == $alt_corr67){

    $contrescorr = $contrescorr + 1;

    $cer_err67 = 1;

}

else{

  $cer_err67 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 67

if ($_POST['radper67'] == "Letra A"){

  $codigo_resposta67 = $letraaper67['codigo_resposta'];

}elseif ($_POST['radper67'] == "Letra B"){

  $codigo_resposta67 = $letrabper67['codigo_resposta'];

}elseif ($_POST['radper67'] == "Letra C"){

  $codigo_resposta67 = $letracper67['codigo_resposta'];

}elseif ($_POST['radper67'] == "Letra D"){

  $codigo_resposta67 = $letradper67['codigo_resposta'];

}elseif ($_POST['radper67'] == "Letra E"){

  $codigo_resposta67 = $letraeper67['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 67

$codigo_disciplina67 = $per67['codigo_disciplina'];

  

  // Selecionando imagem 67

  $imgper67 = $per67['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp67 = $letraaper67['tipo'];

  

  

  //Questão 68

  $codper68 = $_SESSION['codper68'];

  $select_per68 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper68");

  $per68 = mysqli_fetch_assoc($select_per68);

  

  $select_letraaper68 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper68 and letra = 'a'");

  $letraaper68 = mysqli_fetch_assoc($select_letraaper68);

  $select_letrabper68 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper68 and letra = 'b'");

  $letrabper68 = mysqli_fetch_assoc($select_letrabper68);

  $select_letracper68 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper68 and letra = 'c'");

  $letracper68 = mysqli_fetch_assoc($select_letracper68);

  $select_letradper68 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper68 and letra = 'd'");

  $letradper68 = mysqli_fetch_assoc($select_letradper68);

  $select_letraeper68 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper68 and letra = 'e'");

  $letraeper68 = mysqli_fetch_assoc($select_letraeper68);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper68["correta"]==1){

  $alt_corr68 = "Letra A";

  $cora68 = $corcorr;
  $sima68 = " ✓";

  $corb68 = "black";
  $simb68 = "";

  $corc68 = "black";
  $simc68 = "";

  $cord68 = "black";
  $simd68 = "";

  $core68 = "black";
  $sime68 = "";

}

elseif ($letrabper68["correta"]==1){

  $alt_corr68 = "Letra B";

  $corb68 = $corcorr;
  $simb68 = " ✓";

  $cora68 = "black";
  $sima68 = "";

  $corc68 = "black";
  $simc68 = "";

  $cord68 = "black";
  $simd68 = "";

  $core68 = "black";
  $sime68 = "";

}

elseif ($letracper68["correta"]==1){

  $alt_corr68 = "Letra C";

  $corc68 = $corcorr;
  $simc68 = " ✓";

  $cora68 = "black";
  $sima68 = "";

  $corb68 = "black";
  $simb68 = "";

  $cord68 = "black";
  $simd68 = "";

  $core68 = "black";
  $sime68 = "";

}

elseif ($letradper68["correta"]==1){

  $alt_corr68 = "Letra D";

  $cord68 = $corcorr;
  $simd68 = " ✓";

  $cora68 = "black";
  $sima68 = "";

  $corc68 = "black";
  $simc68 = "";

  $corb68 = "black";
  $simb68 = "";

  $core68 = "black";
  $sime68 = "";

}

elseif ($letraeper68["correta"]==1){

  $alt_corr68 = "Letra E";

  $core68 = $corcorr;
  $sime68 = " ✓";

  $cora68 = "black";
  $sima68 = "";

  $corc68 = "black";
  $simc68 = "";

  $cord68 = "black";
  $simd68 = "";

  $corb68 = "black";
  $simb68 = "";

}

//Errada

if ($alt_corr68 != $_POST['radper68'] && $_POST['radper68'] == "Letra A"){

  $cora68 = $corerr;
  $sima68 = " X";

}

elseif ($alt_corr68 != $_POST['radper68'] && $_POST['radper68'] == "Letra B"){

  $corb68 = $corerr;
  $simb68 = " X";

}

elseif ($alt_corr68 != $_POST['radper68'] && $_POST['radper68'] == "Letra C"){

  $corc68 = $corerr;
  $simc68 = " X";

}

elseif ($alt_corr68 != $_POST['radper68'] && $_POST['radper68'] == "Letra D"){

  $cord68 = $corerr;
  $simd68 = " X";

}

elseif ($alt_corr68 != $_POST['radper68'] && $_POST['radper68'] == "Letra E"){

  $core68 = $corerr;
  $sime68 = " X";

}

  

  // Verficando qual será checado 68

  if ($_POST['radper68'] == "Letra A"){

    $chea68 = "Checked";

    $cheb68 = "";

    $chec68 = "";

    $ched68 = "";

    $chee68 = "";

  }elseif ($_POST['radper68'] == "Letra B"){

    $chea68 = "";

    $cheb68 = "Checked";

    $chec68 = "";

    $ched68 = "";

    $chee68 = "";

  }elseif ($_POST['radper68'] == "Letra C"){

    $chea68 = "";

    $cheb68 = "";

    $chec68 = "Checked";

    $ched68 = "";

    $chee68 = "";

  }elseif ($_POST['radper68'] == "Letra D"){

    $chea68 = "";

    $cheb68 = "";

    $chec68 = "";

    $ched68 = "Checked";

    $chee68 = "";

  }elseif ($_POST['radper68'] == "Letra E"){

    $chea68 = "";

    $cheb68 = "";

    $chec68 = "";

    $ched68 = "";

    $chee68 = "Checked";

  }

  

  // Verificando se respsota esta correta 68

  if ($_POST['radper68'] == $alt_corr68){

    $contrescorr = $contrescorr + 1;

    $cer_err68 = 1;

}

else{

  $cer_err68 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 68

if ($_POST['radper68'] == "Letra A"){

  $codigo_resposta68 = $letraaper68['codigo_resposta'];

}elseif ($_POST['radper68'] == "Letra B"){

  $codigo_resposta68 = $letrabper68['codigo_resposta'];

}elseif ($_POST['radper68'] == "Letra C"){

  $codigo_resposta68 = $letracper68['codigo_resposta'];

}elseif ($_POST['radper68'] == "Letra D"){

  $codigo_resposta68 = $letradper68['codigo_resposta'];

}elseif ($_POST['radper68'] == "Letra E"){

  $codigo_resposta68 = $letraeper68['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 68

$codigo_disciplina68 = $per68['codigo_disciplina'];

  

  // Selecionando imagem 68

  $imgper68 = $per68['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp68 = $letraaper68['tipo'];

  

  

  //Questão 69

  $codper69 = $_SESSION['codper69'];

  $select_per69 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper69");

  $per69 = mysqli_fetch_assoc($select_per69);

  

  $select_letraaper69 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper69 and letra = 'a'");

  $letraaper69 = mysqli_fetch_assoc($select_letraaper69);

  $select_letrabper69 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper69 and letra = 'b'");

  $letrabper69 = mysqli_fetch_assoc($select_letrabper69);

  $select_letracper69 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper69 and letra = 'c'");

  $letracper69 = mysqli_fetch_assoc($select_letracper69);

  $select_letradper69 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper69 and letra = 'd'");

  $letradper69 = mysqli_fetch_assoc($select_letradper69);

  $select_letraeper69 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper69 and letra = 'e'");

  $letraeper69 = mysqli_fetch_assoc($select_letraeper69);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper69["correta"]==1){

  $alt_corr69 = "Letra A";

  $cora69 = $corcorr;
  $sima69 = " ✓";

  $corb69 = "black";
  $simb69 = "";

  $corc69 = "black";
  $simc69 = "";

  $cord69 = "black";
  $simd69 = "";

  $core69 = "black";
  $sime69 = "";

}

elseif ($letrabper69["correta"]==1){

  $alt_corr69 = "Letra B";

  $corb69 = $corcorr;
  $simb69 = " ✓";

  $cora69 = "black";
  $sima69 = "";

  $corc69 = "black";
  $simc69 = "";

  $cord69 = "black";
  $simd69 = "";

  $core69 = "black";
  $sime69 = "";

}

elseif ($letracper69["correta"]==1){

  $alt_corr69 = "Letra C";

  $corc69 = $corcorr;
  $simc69 = " ✓";

  $cora69 = "black";
  $sima69 = "";

  $corb69 = "black";
  $simb69 = "";

  $cord69 = "black";
  $simd69 = "";

  $core69 = "black";
  $sime69 = "";

}

elseif ($letradper69["correta"]==1){

  $alt_corr69 = "Letra D";

  $cord69 = $corcorr;
  $simd69 = " ✓";

  $cora69 = "black";
  $sima69 = "";

  $corc69 = "black";
  $simc69 = "";

  $corb69 = "black";
  $simb69 = "";

  $core69 = "black";
  $sime69 = "";

}

elseif ($letraeper69["correta"]==1){

  $alt_corr69 = "Letra E";

  $core69 = $corcorr;
  $sime69 = " ✓";

  $cora69 = "black";
  $sima69 = "";

  $corc69 = "black";
  $simc69 = "";

  $cord69 = "black";
  $simd69 = "";

  $corb69 = "black";
  $simb69 = "";

}

//Errada

if ($alt_corr69 != $_POST['radper69'] && $_POST['radper69'] == "Letra A"){

  $cora69 = $corerr;
  $sima69 = " X";

}

elseif ($alt_corr69 != $_POST['radper69'] && $_POST['radper69'] == "Letra B"){

  $corb69 = $corerr;
  $simb69 = " X";

}

elseif ($alt_corr69 != $_POST['radper69'] && $_POST['radper69'] == "Letra C"){

  $corc69 = $corerr;
  $simc69 = " X";

}

elseif ($alt_corr69 != $_POST['radper69'] && $_POST['radper69'] == "Letra D"){

  $cord69 = $corerr;
  $simd69 = " X";

}

elseif ($alt_corr69 != $_POST['radper69'] && $_POST['radper69'] == "Letra E"){

  $core69 = $corerr;
  $sime69 = " X";

}

  

  // Verficando qual será checado 69

  if ($_POST['radper69'] == "Letra A"){

    $chea69 = "Checked";

    $cheb69 = "";

    $chec69 = "";

    $ched69 = "";

    $chee69 = "";

  }elseif ($_POST['radper69'] == "Letra B"){

    $chea69 = "";

    $cheb69 = "Checked";

    $chec69 = "";

    $ched69 = "";

    $chee69 = "";

  }elseif ($_POST['radper69'] == "Letra C"){

    $chea69 = "";

    $cheb69 = "";

    $chec69 = "Checked";

    $ched69 = "";

    $chee69 = "";

  }elseif ($_POST['radper69'] == "Letra D"){

    $chea69 = "";

    $cheb69 = "";

    $chec69 = "";

    $ched69 = "Checked";

    $chee69 = "";

  }elseif ($_POST['radper69'] == "Letra E"){

    $chea69 = "";

    $cheb69 = "";

    $chec69 = "";

    $ched69 = "";

    $chee69 = "Checked";

  }

  

  // Verificando se respsota esta correta 69

  if ($_POST['radper69'] == $alt_corr69){

    $contrescorr = $contrescorr + 1;

    $cer_err69 = 1;

}

else{

  $cer_err69 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 69

if ($_POST['radper69'] == "Letra A"){

  $codigo_resposta69 = $letraaper69['codigo_resposta'];

}elseif ($_POST['radper69'] == "Letra B"){

  $codigo_resposta69 = $letrabper69['codigo_resposta'];

}elseif ($_POST['radper69'] == "Letra C"){

  $codigo_resposta69 = $letracper69['codigo_resposta'];

}elseif ($_POST['radper69'] == "Letra D"){

  $codigo_resposta69 = $letradper69['codigo_resposta'];

}elseif ($_POST['radper69'] == "Letra E"){

  $codigo_resposta69 = $letraeper69['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 69

$codigo_disciplina69 = $per69['codigo_disciplina'];

  

  // Selecionando imagem 69

  $imgper69 = $per69['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp69 = $letraaper69['tipo'];

  

  

  //Questão 70

  $codper70 = $_SESSION['codper70'];

  $select_per70 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper70");

  $per70 = mysqli_fetch_assoc($select_per70);

  

  $select_letraaper70 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper70 and letra = 'a'");

  $letraaper70 = mysqli_fetch_assoc($select_letraaper70);

  $select_letrabper70 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper70 and letra = 'b'");

  $letrabper70 = mysqli_fetch_assoc($select_letrabper70);

  $select_letracper70 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper70 and letra = 'c'");

  $letracper70 = mysqli_fetch_assoc($select_letracper70);

  $select_letradper70 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper70 and letra = 'd'");

  $letradper70 = mysqli_fetch_assoc($select_letradper70);

  $select_letraeper70 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper70 and letra = 'e'");

  $letraeper70 = mysqli_fetch_assoc($select_letraeper70);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper70["correta"]==1){

  $alt_corr70 = "Letra A";

  $cora70 = $corcorr;
  $sima70 = " ✓";

  $corb70 = "black";
  $simb70 = "";

  $corc70 = "black";
  $simc70 = "";

  $cord70 = "black";
  $simd70 = "";

  $core70 = "black";
  $sime70 = "";

}

elseif ($letrabper70["correta"]==1){

  $alt_corr70 = "Letra B";

  $corb70 = $corcorr;
  $simb70 = " ✓";

  $cora70 = "black";
  $sima70 = "";

  $corc70 = "black";
  $simc70 = "";

  $cord70 = "black";
  $simd70 = "";

  $core70 = "black";
  $sime70 = "";

}

elseif ($letracper70["correta"]==1){

  $alt_corr70 = "Letra C";

  $corc70 = $corcorr;
  $simc70 = " ✓";

  $cora70 = "black";
  $sima70 = "";

  $corb70 = "black";
  $simb70 = "";

  $cord70 = "black";
  $simd70 = "";

  $core70 = "black";
  $sime70 = "";

}

elseif ($letradper70["correta"]==1){

  $alt_corr70 = "Letra D";

  $cord70 = $corcorr;
  $simd70 = " ✓";

  $cora70 = "black";
  $sima70 = "";

  $corc70 = "black";
  $simc70 = "";

  $corb70 = "black";
  $simb70 = "";

  $core70 = "black";
  $sime70 = "";

}

elseif ($letraeper70["correta"]==1){

  $alt_corr70 = "Letra E";

  $core70 = $corcorr;
  $sime70 = " ✓";

  $cora70 = "black";
  $sima70 = "";

  $corc70 = "black";
  $simc70 = "";

  $cord70 = "black";
  $simd70 = "";

  $corb70 = "black";
  $simb70 = "";

}

//Errada

if ($alt_corr70 != $_POST['radper70'] && $_POST['radper70'] == "Letra A"){

  $cora70 = $corerr;
  $sima70 = " X";

}

elseif ($alt_corr70 != $_POST['radper70'] && $_POST['radper70'] == "Letra B"){

  $corb70 = $corerr;
  $simb70 = " X";

}

elseif ($alt_corr70 != $_POST['radper70'] && $_POST['radper70'] == "Letra C"){

  $corc70 = $corerr;
  $simc70 = " X";

}

elseif ($alt_corr70 != $_POST['radper70'] && $_POST['radper70'] == "Letra D"){

  $cord70 = $corerr;
  $simd70 = " X";

}

elseif ($alt_corr70 != $_POST['radper70'] && $_POST['radper70'] == "Letra E"){

  $core70 = $corerr;
  $sime70 = " X";

}

  

  // Verficando qual será checado 70

  if ($_POST['radper70'] == "Letra A"){

    $chea70 = "Checked";

    $cheb70 = "";

    $chec70 = "";

    $ched70 = "";

    $chee70 = "";

  }elseif ($_POST['radper70'] == "Letra B"){

    $chea70 = "";

    $cheb70 = "Checked";

    $chec70 = "";

    $ched70 = "";

    $chee70 = "";

  }elseif ($_POST['radper70'] == "Letra C"){

    $chea70 = "";

    $cheb70 = "";

    $chec70 = "Checked";

    $ched70 = "";

    $chee70 = "";

  }elseif ($_POST['radper70'] == "Letra D"){

    $chea70 = "";

    $cheb70 = "";

    $chec70 = "";

    $ched70 = "Checked";

    $chee70 = "";

  }elseif ($_POST['radper70'] == "Letra E"){

    $chea70 = "";

    $cheb70 = "";

    $chec70 = "";

    $ched70 = "";

    $chee70 = "Checked";

  }

  

  // Verificando se respsota esta correta 70

  if ($_POST['radper70'] == $alt_corr70){

    $contrescorr = $contrescorr + 1;

    $cer_err70 = 1;

}

else{

  $cer_err70 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 70

if ($_POST['radper70'] == "Letra A"){

  $codigo_resposta70 = $letraaper70['codigo_resposta'];

}elseif ($_POST['radper70'] == "Letra B"){

  $codigo_resposta70 = $letrabper70['codigo_resposta'];

}elseif ($_POST['radper70'] == "Letra C"){

  $codigo_resposta70 = $letracper70['codigo_resposta'];

}elseif ($_POST['radper70'] == "Letra D"){

  $codigo_resposta70 = $letradper70['codigo_resposta'];

}elseif ($_POST['radper70'] == "Letra E"){

  $codigo_resposta70 = $letraeper70['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 70

$codigo_disciplina70 = $per70['codigo_disciplina'];

  

  // Selecionando imagem 70

  $imgper70 = $per70['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp70 = $letraaper70['tipo'];

  

  }





  // Verificando se existe perguntas de 71 à 75

if ($qtperguntas>70){



  //Questão 71

  $codper71 = $_SESSION['codper71'];

  $select_per71 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper71");

  $per71 = mysqli_fetch_assoc($select_per71);

  

  $select_letraaper71 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper71 and letra = 'a'");

  $letraaper71 = mysqli_fetch_assoc($select_letraaper71);

  $select_letrabper71 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper71 and letra = 'b'");

  $letrabper71 = mysqli_fetch_assoc($select_letrabper71);

  $select_letracper71 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper71 and letra = 'c'");

  $letracper71 = mysqli_fetch_assoc($select_letracper71);

  $select_letradper71 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper71 and letra = 'd'");

  $letradper71 = mysqli_fetch_assoc($select_letradper71);

  $select_letraeper71 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper71 and letra = 'e'");

  $letraeper71 = mysqli_fetch_assoc($select_letraeper71);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper71["correta"]==1){

  $alt_corr71 = "Letra A";

  $cora71 = $corcorr;
  $sima71 = " ✓";

  $corb71 = "black";
  $simb71 = "";

  $corc71 = "black";
  $simc71 = "";

  $cord71 = "black";
  $simd71 = "";

  $core71 = "black";
  $sime71 = "";

}

elseif ($letrabper71["correta"]==1){

  $alt_corr71 = "Letra B";

  $corb71 = $corcorr;
  $simb71 = " ✓";

  $cora71 = "black";
  $sima71 = "";

  $corc71 = "black";
  $simc71 = "";

  $cord71 = "black";
  $simd71 = "";

  $core71 = "black";
  $sime71 = "";

}

elseif ($letracper71["correta"]==1){

  $alt_corr71 = "Letra C";

  $corc71 = $corcorr;
  $simc71 = " ✓";

  $cora71 = "black";
  $sima71 = "";

  $corb71 = "black";
  $simb71 = "";

  $cord71 = "black";
  $simd71 = "";

  $core71 = "black";
  $sime71 = "";

}

elseif ($letradper71["correta"]==1){

  $alt_corr71 = "Letra D";

  $cord71 = $corcorr;
  $simd71 = " ✓";

  $cora71 = "black";
  $sima71 = "";

  $corc71 = "black";
  $simc71 = "";

  $corb71 = "black";
  $simb71 = "";

  $core71 = "black";
  $sime71 = "";

}

elseif ($letraeper71["correta"]==1){

  $alt_corr71 = "Letra E";

  $core71 = $corcorr;
  $sime71 = " ✓";

  $cora71 = "black";
  $sima71 = "";

  $corc71 = "black";
  $simc71 = "";

  $cord71 = "black";
  $simd71 = "";

  $corb71 = "black";
  $simb71 = "";

}

//Errada

if ($alt_corr71 != $_POST['radper71'] && $_POST['radper71'] == "Letra A"){

  $cora71 = $corerr;
  $sima71 = " X";

}

elseif ($alt_corr71 != $_POST['radper71'] && $_POST['radper71'] == "Letra B"){

  $corb71 = $corerr;
  $simb71 = " X";

}

elseif ($alt_corr71 != $_POST['radper71'] && $_POST['radper71'] == "Letra C"){

  $corc71 = $corerr;
  $simc71 = " X";

}

elseif ($alt_corr71 != $_POST['radper71'] && $_POST['radper71'] == "Letra D"){

  $cord71 = $corerr;
  $simd71 = " X";

}

elseif ($alt_corr71 != $_POST['radper71'] && $_POST['radper71'] == "Letra E"){

  $core71 = $corerr;
  $sime71 = " X";

}

  

  // Verficando qual será checado 71

  if ($_POST['radper71'] == "Letra A"){

    $chea71 = "Checked";

    $cheb71 = "";

    $chec71 = "";

    $ched71 = "";

    $chee71 = "";

  }elseif ($_POST['radper71'] == "Letra B"){

    $chea71 = "";

    $cheb71 = "Checked";

    $chec71 = "";

    $ched71 = "";

    $chee71 = "";

  }elseif ($_POST['radper71'] == "Letra C"){

    $chea71 = "";

    $cheb71 = "";

    $chec71 = "Checked";

    $ched71 = "";

    $chee71 = "";

  }elseif ($_POST['radper71'] == "Letra D"){

    $chea71 = "";

    $cheb71 = "";

    $chec71 = "";

    $ched71 = "Checked";

    $chee71 = "";

  }elseif ($_POST['radper71'] == "Letra E"){

    $chea71 = "";

    $cheb71 = "";

    $chec71 = "";

    $ched71 = "";

    $chee71 = "Checked";

  }

  

  // Verificando se respsota esta correta 71

  if ($_POST['radper71'] == $alt_corr71){

    $contrescorr = $contrescorr + 1;

    $cer_err71 = 1;

}

else{

  $cer_err71 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 71

if ($_POST['radper71'] == "Letra A"){

  $codigo_resposta71 = $letraaper71['codigo_resposta'];

}elseif ($_POST['radper71'] == "Letra B"){

  $codigo_resposta71 = $letrabper71['codigo_resposta'];

}elseif ($_POST['radper71'] == "Letra C"){

  $codigo_resposta71 = $letracper71['codigo_resposta'];

}elseif ($_POST['radper71'] == "Letra D"){

  $codigo_resposta71 = $letradper71['codigo_resposta'];

}elseif ($_POST['radper71'] == "Letra E"){

  $codigo_resposta71 = $letraeper71['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 71

$codigo_disciplina71 = $per71['codigo_disciplina'];

  

  // Selecionando imagem 71

  $imgper71 = $per71['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp71 = $letraaper71['tipo'];

  

  

  //Questão 72

  $codper72 = $_SESSION['codper72'];

  $select_per72 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper72");

  $per72 = mysqli_fetch_assoc($select_per72);

  

  $select_letraaper72 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper72 and letra = 'a'");

  $letraaper72 = mysqli_fetch_assoc($select_letraaper72);

  $select_letrabper72 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper72 and letra = 'b'");

  $letrabper72 = mysqli_fetch_assoc($select_letrabper72);

  $select_letracper72 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper72 and letra = 'c'");

  $letracper72 = mysqli_fetch_assoc($select_letracper72);

  $select_letradper72 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper72 and letra = 'd'");

  $letradper72 = mysqli_fetch_assoc($select_letradper72);

  $select_letraeper72 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper72 and letra = 'e'");

  $letraeper72 = mysqli_fetch_assoc($select_letraeper72);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper72["correta"]==1){

  $alt_corr72 = "Letra A";

  $cora72 = $corcorr;
  $sima72 = " ✓";

  $corb72 = "black";
  $simb72 = "";

  $corc72 = "black";
  $simc72 = "";

  $cord72 = "black";
  $simd72 = "";

  $core72 = "black";
  $sime72 = "";

}

elseif ($letrabper72["correta"]==1){

  $alt_corr72 = "Letra B";

  $corb72 = $corcorr;
  $simb72 = " ✓";

  $cora72 = "black";
  $sima72 = "";

  $corc72 = "black";
  $simc72 = "";

  $cord72 = "black";
  $simd72 = "";

  $core72 = "black";
  $sime72 = "";

}

elseif ($letracper72["correta"]==1){

  $alt_corr72 = "Letra C";

  $corc72 = $corcorr;
  $simc72 = " ✓";

  $cora72 = "black";
  $sima72 = "";

  $corb72 = "black";
  $simb72 = "";

  $cord72 = "black";
  $simd72 = "";

  $core72 = "black";
  $sime72 = "";

}

elseif ($letradper72["correta"]==1){

  $alt_corr72 = "Letra D";

  $cord72 = $corcorr;
  $simd72 = " ✓";

  $cora72 = "black";
  $sima72 = "";

  $corc72 = "black";
  $simc72 = "";

  $corb72 = "black";
  $simb72 = "";

  $core72 = "black";
  $sime72 = "";

}

elseif ($letraeper72["correta"]==1){

  $alt_corr72 = "Letra E";

  $core72 = $corcorr;
  $sime72 = " ✓";

  $cora72 = "black";
  $sima72 = "";

  $corc72 = "black";
  $simc72 = "";

  $cord72 = "black";
  $simd72 = "";

  $corb72 = "black";
  $simb72 = "";

}

//Errada

if ($alt_corr72 != $_POST['radper72'] && $_POST['radper72'] == "Letra A"){

  $cora72 = $corerr;
  $sima72 = " X";

}

elseif ($alt_corr72 != $_POST['radper72'] && $_POST['radper72'] == "Letra B"){

  $corb72 = $corerr;
  $simb72 = " X";

}

elseif ($alt_corr72 != $_POST['radper72'] && $_POST['radper72'] == "Letra C"){

  $corc72 = $corerr;
  $simc72 = " X";

}

elseif ($alt_corr72 != $_POST['radper72'] && $_POST['radper72'] == "Letra D"){

  $cord72 = $corerr;
  $simd72 = " X";

}

elseif ($alt_corr72 != $_POST['radper72'] && $_POST['radper72'] == "Letra E"){

  $core72 = $corerr;
  $sime72 = " X";

}

  

  // Verficando qual será checado 72

  if ($_POST['radper72'] == "Letra A"){

    $chea72 = "Checked";

    $cheb72 = "";

    $chec72 = "";

    $ched72 = "";

    $chee72 = "";

  }elseif ($_POST['radper72'] == "Letra B"){

    $chea72 = "";

    $cheb72 = "Checked";

    $chec72 = "";

    $ched72 = "";

    $chee72 = "";

  }elseif ($_POST['radper72'] == "Letra C"){

    $chea72 = "";

    $cheb72 = "";

    $chec72 = "Checked";

    $ched72 = "";

    $chee72 = "";

  }elseif ($_POST['radper72'] == "Letra D"){

    $chea72 = "";

    $cheb72 = "";

    $chec72 = "";

    $ched72 = "Checked";

    $chee72 = "";

  }elseif ($_POST['radper72'] == "Letra E"){

    $chea72 = "";

    $cheb72 = "";

    $chec72 = "";

    $ched72 = "";

    $chee72 = "Checked";

  }

  

  // Verificando se respsota esta correta 72

  if ($_POST['radper72'] == $alt_corr72){

    $contrescorr = $contrescorr + 1;

    $cer_err72 = 1;

}

else{

  $cer_err72 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 72

if ($_POST['radper72'] == "Letra A"){

  $codigo_resposta72 = $letraaper72['codigo_resposta'];

}elseif ($_POST['radper72'] == "Letra B"){

  $codigo_resposta72 = $letrabper72['codigo_resposta'];

}elseif ($_POST['radper72'] == "Letra C"){

  $codigo_resposta72 = $letracper72['codigo_resposta'];

}elseif ($_POST['radper72'] == "Letra D"){

  $codigo_resposta72 = $letradper72['codigo_resposta'];

}elseif ($_POST['radper72'] == "Letra E"){

  $codigo_resposta72 = $letraeper72['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 72

$codigo_disciplina72 = $per72['codigo_disciplina'];

  

  // Selecionando imagem 72

  $imgper72 = $per72['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp72 = $letraaper72['tipo'];

  

  

  //Questão 73

  $codper73 = $_SESSION['codper73'];

  $select_per73 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper73");

  $per73 = mysqli_fetch_assoc($select_per73);

  

  $select_letraaper73 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper73 and letra = 'a'");

  $letraaper73 = mysqli_fetch_assoc($select_letraaper73);

  $select_letrabper73 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper73 and letra = 'b'");

  $letrabper73 = mysqli_fetch_assoc($select_letrabper73);

  $select_letracper73 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper73 and letra = 'c'");

  $letracper73 = mysqli_fetch_assoc($select_letracper73);

  $select_letradper73 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper73 and letra = 'd'");

  $letradper73 = mysqli_fetch_assoc($select_letradper73);

  $select_letraeper73 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper73 and letra = 'e'");

  $letraeper73 = mysqli_fetch_assoc($select_letraeper73);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper73["correta"]==1){

  $alt_corr73 = "Letra A";

  $cora73 = $corcorr;
  $sima73 = " ✓";

  $corb73 = "black";
  $simb73 = "";

  $corc73 = "black";
  $simc73 = "";

  $cord73 = "black";
  $simd73 = "";

  $core73 = "black";
  $sime73 = "";

}

elseif ($letrabper73["correta"]==1){

  $alt_corr73 = "Letra B";

  $corb73 = $corcorr;
  $simb73 = " ✓";

  $cora73 = "black";
  $sima73 = "";

  $corc73 = "black";
  $simc73 = "";

  $cord73 = "black";
  $simd73 = "";

  $core73 = "black";
  $sime73 = "";

}

elseif ($letracper73["correta"]==1){

  $alt_corr73 = "Letra C";

  $corc73 = $corcorr;
  $simc73 = " ✓";

  $cora73 = "black";
  $sima73 = "";

  $corb73 = "black";
  $simb73 = "";

  $cord73 = "black";
  $simd73 = "";

  $core73 = "black";
  $sime73 = "";

}

elseif ($letradper73["correta"]==1){

  $alt_corr73 = "Letra D";

  $cord73 = $corcorr;
  $simd73 = " ✓";

  $cora73 = "black";
  $sima73 = "";

  $corc73 = "black";
  $simc73 = "";

  $corb73 = "black";
  $simb73 = "";

  $core73 = "black";
  $sime73 = "";

}

elseif ($letraeper73["correta"]==1){

  $alt_corr73 = "Letra E";

  $core73 = $corcorr;
  $sime73 = " ✓";

  $cora73 = "black";
  $sima73 = "";

  $corc73 = "black";
  $simc73 = "";

  $cord73 = "black";
  $simd73 = "";

  $corb73 = "black";
  $simb73 = "";

}

//Errada

if ($alt_corr73 != $_POST['radper73'] && $_POST['radper73'] == "Letra A"){

  $cora73 = $corerr;
  $sima73 = " X";

}

elseif ($alt_corr73 != $_POST['radper73'] && $_POST['radper73'] == "Letra B"){

  $corb73 = $corerr;
  $simb73 = " X";

}

elseif ($alt_corr73 != $_POST['radper73'] && $_POST['radper73'] == "Letra C"){

  $corc73 = $corerr;
  $simc73 = " X";

}

elseif ($alt_corr73 != $_POST['radper73'] && $_POST['radper73'] == "Letra D"){

  $cord73 = $corerr;
  $simd73 = " X";

}

elseif ($alt_corr73 != $_POST['radper73'] && $_POST['radper73'] == "Letra E"){

  $core73 = $corerr;
  $sime73 = " X";

}

  

  // Verficando qual será checado 73

  if ($_POST['radper73'] == "Letra A"){

    $chea73 = "Checked";

    $cheb73 = "";

    $chec73 = "";

    $ched73 = "";

    $chee73 = "";

  }elseif ($_POST['radper73'] == "Letra B"){

    $chea73 = "";

    $cheb73 = "Checked";

    $chec73 = "";

    $ched73 = "";

    $chee73 = "";

  }elseif ($_POST['radper73'] == "Letra C"){

    $chea73 = "";

    $cheb73 = "";

    $chec73 = "Checked";

    $ched73 = "";

    $chee73 = "";

  }elseif ($_POST['radper73'] == "Letra D"){

    $chea73 = "";

    $cheb73 = "";

    $chec73 = "";

    $ched73 = "Checked";

    $chee73 = "";

  }elseif ($_POST['radper73'] == "Letra E"){

    $chea73 = "";

    $cheb73 = "";

    $chec73 = "";

    $ched73 = "";

    $chee73 = "Checked";

  }

  

  // Verificando se respsota esta correta 73

  if ($_POST['radper73'] == $alt_corr73){

    $contrescorr = $contrescorr + 1;

    $cer_err73 = 1;

}

else{

  $cer_err73 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 73

if ($_POST['radper73'] == "Letra A"){

  $codigo_resposta73 = $letraaper73['codigo_resposta'];

}elseif ($_POST['radper73'] == "Letra B"){

  $codigo_resposta73 = $letrabper73['codigo_resposta'];

}elseif ($_POST['radper73'] == "Letra C"){

  $codigo_resposta73 = $letracper73['codigo_resposta'];

}elseif ($_POST['radper73'] == "Letra D"){

  $codigo_resposta73 = $letradper73['codigo_resposta'];

}elseif ($_POST['radper73'] == "Letra E"){

  $codigo_resposta73 = $letraeper73['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 73

$codigo_disciplina73 = $per73['codigo_disciplina'];

  

  // Selecionando imagem 73

  $imgper73 = $per73['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp73 = $letraaper73['tipo'];

  

  

  //Questão 74

  $codper74 = $_SESSION['codper74'];

  $select_per74 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper74");

  $per74 = mysqli_fetch_assoc($select_per74);

  

  $select_letraaper74 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper74 and letra = 'a'");

  $letraaper74 = mysqli_fetch_assoc($select_letraaper74);

  $select_letrabper74 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper74 and letra = 'b'");

  $letrabper74 = mysqli_fetch_assoc($select_letrabper74);

  $select_letracper74 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper74 and letra = 'c'");

  $letracper74 = mysqli_fetch_assoc($select_letracper74);

  $select_letradper74 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper74 and letra = 'd'");

  $letradper74 = mysqli_fetch_assoc($select_letradper74);

  $select_letraeper74 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper74 and letra = 'e'");

  $letraeper74 = mysqli_fetch_assoc($select_letraeper74);

  

  // Selecionando alternativa correta 2 suas cores

// Correta

if ($letraaper74["correta"]==1){

  $alt_corr74 = "Letra A";

  $cora74 = $corcorr;
  $sima74 = " ✓";

  $corb74 = "black";
  $simb74 = "";

  $corc74 = "black";
  $simc74 = "";

  $cord74 = "black";
  $simd74 = "";

  $core74 = "black";
  $sime74 = "";

}

elseif ($letrabper74["correta"]==1){

  $alt_corr74 = "Letra B";

  $corb74 = $corcorr;
  $simb74 = " ✓";

  $cora74 = "black";
  $sima74 = "";

  $corc74 = "black";
  $simc74 = "";

  $cord74 = "black";
  $simd74 = "";

  $core74 = "black";
  $sime74 = "";

}

elseif ($letracper74["correta"]==1){

  $alt_corr74 = "Letra C";

  $corc74 = $corcorr;
  $simc74 = " ✓";

  $cora74 = "black";
  $sima74 = "";

  $corb74 = "black";
  $simb74 = "";

  $cord74 = "black";
  $simd74 = "";

  $core74 = "black";
  $sime74 = "";

}

elseif ($letradper74["correta"]==1){

  $alt_corr74 = "Letra D";

  $cord74 = $corcorr;
  $simd74 = " ✓";

  $cora74 = "black";
  $sima74 = "";

  $corc74 = "black";
  $simc74 = "";

  $corb74 = "black";
  $simb74 = "";

  $core74 = "black";
  $sime74 = "";

}

elseif ($letraeper74["correta"]==1){

  $alt_corr74 = "Letra E";

  $core74 = $corcorr;
  $sime74 = " ✓";

  $cora74 = "black";
  $sima74 = "";

  $corc74 = "black";
  $simc74 = "";

  $cord74 = "black";
  $simd74 = "";

  $corb74 = "black";
  $simb74 = "";

}

//Errada

if ($alt_corr74 != $_POST['radper74'] && $_POST['radper74'] == "Letra A"){

  $cora74 = $corerr;
  $sima74 = " X";

}

elseif ($alt_corr74 != $_POST['radper74'] && $_POST['radper74'] == "Letra B"){

  $corb74 = $corerr;
  $simb74 = " X";

}

elseif ($alt_corr74 != $_POST['radper74'] && $_POST['radper74'] == "Letra C"){

  $corc74 = $corerr;
  $simc74 = " X";

}

elseif ($alt_corr74 != $_POST['radper74'] && $_POST['radper74'] == "Letra D"){

  $cord74 = $corerr;
  $simd74 = " X";

}

elseif ($alt_corr74 != $_POST['radper74'] && $_POST['radper74'] == "Letra E"){

  $core74 = $corerr;
  $sime74 = " X";

}

  

  // Verficando qual será checado 74

  if ($_POST['radper74'] == "Letra A"){

    $chea74 = "Checked";

    $cheb74 = "";

    $chec74 = "";

    $ched74 = "";

    $chee74 = "";

  }elseif ($_POST['radper74'] == "Letra B"){

    $chea74 = "";

    $cheb74 = "Checked";

    $chec74 = "";

    $ched74 = "";

    $chee74 = "";

  }elseif ($_POST['radper74'] == "Letra C"){

    $chea74 = "";

    $cheb74 = "";

    $chec74 = "Checked";

    $ched74 = "";

    $chee74 = "";

  }elseif ($_POST['radper74'] == "Letra D"){

    $chea74 = "";

    $cheb74 = "";

    $chec74 = "";

    $ched74 = "Checked";

    $chee74 = "";

  }elseif ($_POST['radper74'] == "Letra E"){

    $chea74 = "";

    $cheb74 = "";

    $chec74 = "";

    $ched74 = "";

    $chee74 = "Checked";

  }

  

  // Verificando se respsota esta correta 74

  if ($_POST['radper74'] == $alt_corr74){

    $contrescorr = $contrescorr + 1;

    $cer_err74 = 1;

}

else{

  $cer_err74 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 74

if ($_POST['radper74'] == "Letra A"){

  $codigo_resposta74 = $letraaper74['codigo_resposta'];

}elseif ($_POST['radper74'] == "Letra B"){

  $codigo_resposta74 = $letrabper74['codigo_resposta'];

}elseif ($_POST['radper74'] == "Letra C"){

  $codigo_resposta74 = $letracper74['codigo_resposta'];

}elseif ($_POST['radper74'] == "Letra D"){

  $codigo_resposta74 = $letradper74['codigo_resposta'];

}elseif ($_POST['radper74'] == "Letra E"){

  $codigo_resposta74 = $letraeper74['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 74

$codigo_disciplina74 = $per74['codigo_disciplina'];

  

  // Selecionando imagem 74

  $imgper74 = $per74['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp74 = $letraaper74['tipo'];

  

  

  //Questão 75

  $codper75 = $_SESSION['codper75'];

  $select_per75 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper75");

  $per75 = mysqli_fetch_assoc($select_per75);

  

  $select_letraaper75 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper75 and letra = 'a'");

  $letraaper75 = mysqli_fetch_assoc($select_letraaper75);

  $select_letrabper75 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper75 and letra = 'b'");

  $letrabper75 = mysqli_fetch_assoc($select_letrabper75);

  $select_letracper75 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper75 and letra = 'c'");

  $letracper75 = mysqli_fetch_assoc($select_letracper75);

  $select_letradper75 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper75 and letra = 'd'");

  $letradper75 = mysqli_fetch_assoc($select_letradper75);

  $select_letraeper75 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper75 and letra = 'e'");

  $letraeper75 = mysqli_fetch_assoc($select_letraeper75);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper75["correta"]==1){

  $alt_corr75 = "Letra A";

  $cora75 = $corcorr;
  $sima75 = " ✓";

  $corb75 = "black";
  $simb75 = "";

  $corc75 = "black";
  $simc75 = "";

  $cord75 = "black";
  $simd75 = "";

  $core75 = "black";
  $sime75 = "";

}

elseif ($letrabper75["correta"]==1){

  $alt_corr75 = "Letra B";

  $corb75 = $corcorr;
  $simb75 = " ✓";

  $cora75 = "black";
  $sima75 = "";

  $corc75 = "black";
  $simc75 = "";

  $cord75 = "black";
  $simd75 = "";

  $core75 = "black";
  $sime75 = "";

}

elseif ($letracper75["correta"]==1){

  $alt_corr75 = "Letra C";

  $corc75 = $corcorr;
  $simc75 = " ✓";

  $cora75 = "black";
  $sima75 = "";

  $corb75 = "black";
  $simb75 = "";

  $cord75 = "black";
  $simd75 = "";

  $core75 = "black";
  $sime75 = "";

}

elseif ($letradper75["correta"]==1){

  $alt_corr75 = "Letra D";

  $cord75 = $corcorr;
  $simd75 = " ✓";

  $cora75 = "black";
  $sima75 = "";

  $corc75 = "black";
  $simc75 = "";

  $corb75 = "black";
  $simb75 = "";

  $core75 = "black";
  $sime75 = "";

}

elseif ($letraeper75["correta"]==1){

  $alt_corr75 = "Letra E";

  $core75 = $corcorr;
  $sime75 = " ✓";

  $cora75 = "black";
  $sima75 = "";

  $corc75 = "black";
  $simc75 = "";

  $cord75 = "black";
  $simd75 = "";

  $corb75 = "black";
  $simb75 = "";

}

//Errada

if ($alt_corr75 != $_POST['radper75'] && $_POST['radper75'] == "Letra A"){

  $cora75 = $corerr;
  $sima75 = " X";

}

elseif ($alt_corr75 != $_POST['radper75'] && $_POST['radper75'] == "Letra B"){

  $corb75 = $corerr;
  $simb75 = " X";

}

elseif ($alt_corr75 != $_POST['radper75'] && $_POST['radper75'] == "Letra C"){

  $corc75 = $corerr;
  $simc75 = " X";

}

elseif ($alt_corr75 != $_POST['radper75'] && $_POST['radper75'] == "Letra D"){

  $cord75 = $corerr;
  $simd75 = " X";

}

elseif ($alt_corr75 != $_POST['radper75'] && $_POST['radper75'] == "Letra E"){

  $core75 = $corerr;
  $sime75 = " X";

}

  

  // Verficando qual será checado 75

  if ($_POST['radper75'] == "Letra A"){

    $chea75 = "Checked";

    $cheb75 = "";

    $chec75 = "";

    $ched75 = "";

    $chee75 = "";

  }elseif ($_POST['radper75'] == "Letra B"){

    $chea75 = "";

    $cheb75 = "Checked";

    $chec75 = "";

    $ched75 = "";

    $chee75 = "";

  }elseif ($_POST['radper75'] == "Letra C"){

    $chea75 = "";

    $cheb75 = "";

    $chec75 = "Checked";

    $ched75 = "";

    $chee75 = "";

  }elseif ($_POST['radper75'] == "Letra D"){

    $chea75 = "";

    $cheb75 = "";

    $chec75 = "";

    $ched75 = "Checked";

    $chee75 = "";

  }elseif ($_POST['radper75'] == "Letra E"){

    $chea75 = "";

    $cheb75 = "";

    $chec75 = "";

    $ched75 = "";

    $chee75 = "Checked";

  }

  

  // Verificando se respsota esta correta 75

  if ($_POST['radper75'] == $alt_corr75){

    $contrescorr = $contrescorr + 1;

    $cer_err75 = 1;

}

else{

  $cer_err75 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 75

if ($_POST['radper75'] == "Letra A"){

  $codigo_resposta75 = $letraaper75['codigo_resposta'];

}elseif ($_POST['radper75'] == "Letra B"){

  $codigo_resposta75 = $letrabper75['codigo_resposta'];

}elseif ($_POST['radper75'] == "Letra C"){

  $codigo_resposta75 = $letracper75['codigo_resposta'];

}elseif ($_POST['radper75'] == "Letra D"){

  $codigo_resposta75 = $letradper75['codigo_resposta'];

}elseif ($_POST['radper75'] == "Letra E"){

  $codigo_resposta75 = $letraeper75['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 75

$codigo_disciplina75 = $per75['codigo_disciplina'];

  

  // Selecionando imagem 75

  $imgper75 = $per75['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp75 = $letraaper75['tipo'];

  

  }





  // Verificando se existe perguntas de 76 à 80

if ($qtperguntas>75){



  //Questão 76

  $codper76 = $_SESSION['codper76'];

  $select_per76 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper76");

  $per76 = mysqli_fetch_assoc($select_per76);

  

  $select_letraaper76 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper76 and letra = 'a'");

  $letraaper76 = mysqli_fetch_assoc($select_letraaper76);

  $select_letrabper76 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper76 and letra = 'b'");

  $letrabper76 = mysqli_fetch_assoc($select_letrabper76);

  $select_letracper76 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper76 and letra = 'c'");

  $letracper76 = mysqli_fetch_assoc($select_letracper76);

  $select_letradper76 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper76 and letra = 'd'");

  $letradper76 = mysqli_fetch_assoc($select_letradper76);

  $select_letraeper76 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper76 and letra = 'e'");

  $letraeper76 = mysqli_fetch_assoc($select_letraeper76);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper76["correta"]==1){

  $alt_corr76 = "Letra A";

  $cora76 = $corcorr;
  $sima76 = " ✓";

  $corb76 = "black";
  $simb76 = "";

  $corc76 = "black";
  $simc76 = "";

  $cord76 = "black";
  $simd76 = "";

  $core76 = "black";
  $sime76 = "";

}

elseif ($letrabper76["correta"]==1){

  $alt_corr76 = "Letra B";

  $corb76 = $corcorr;
  $simb76 = " ✓";

  $cora76 = "black";
  $sima76 = "";

  $corc76 = "black";
  $simc76 = "";

  $cord76 = "black";
  $simd76 = "";

  $core76 = "black";
  $sime76 = "";

}

elseif ($letracper76["correta"]==1){

  $alt_corr76 = "Letra C";

  $corc76 = $corcorr;
  $simc76 = " ✓";

  $cora76 = "black";
  $sima76 = "";

  $corb76 = "black";
  $simb76 = "";

  $cord76 = "black";
  $simd76 = "";

  $core76 = "black";
  $sime76 = "";

}

elseif ($letradper76["correta"]==1){

  $alt_corr76 = "Letra D";

  $cord76 = $corcorr;
  $simd76 = " ✓";

  $cora76 = "black";
  $sima76 = "";

  $corc76 = "black";
  $simc76 = "";

  $corb76 = "black";
  $simb76 = "";

  $core76 = "black";
  $sime76 = "";

}

elseif ($letraeper76["correta"]==1){

  $alt_corr76 = "Letra E";

  $core76 = $corcorr;
  $sime76 = " ✓";

  $cora76 = "black";
  $sima76 = "";

  $corc76 = "black";
  $simc76 = "";

  $cord76 = "black";
  $simd76 = "";

  $corb76 = "black";
  $simb76 = "";

}

//Errada

if ($alt_corr76 != $_POST['radper76'] && $_POST['radper76'] == "Letra A"){

  $cora76 = $corerr;
  $sima76 = " X";

}

elseif ($alt_corr76 != $_POST['radper76'] && $_POST['radper76'] == "Letra B"){

  $corb76 = $corerr;
  $simb76 = " X";

}

elseif ($alt_corr76 != $_POST['radper76'] && $_POST['radper76'] == "Letra C"){

  $corc76 = $corerr;
  $simc76 = " X";

}

elseif ($alt_corr76 != $_POST['radper76'] && $_POST['radper76'] == "Letra D"){

  $cord76 = $corerr;
  $simd76 = " X";

}

elseif ($alt_corr76 != $_POST['radper76'] && $_POST['radper76'] == "Letra E"){

  $core76 = $corerr;
  $sime76 = " X";

}

  

  // Verficando qual será checado 76

  if ($_POST['radper76'] == "Letra A"){

    $chea76 = "Checked";

    $cheb76 = "";

    $chec76 = "";

    $ched76 = "";

    $chee76 = "";

  }elseif ($_POST['radper76'] == "Letra B"){

    $chea76 = "";

    $cheb76 = "Checked";

    $chec76 = "";

    $ched76 = "";

    $chee76 = "";

  }elseif ($_POST['radper76'] == "Letra C"){

    $chea76 = "";

    $cheb76 = "";

    $chec76 = "Checked";

    $ched76 = "";

    $chee76 = "";

  }elseif ($_POST['radper76'] == "Letra D"){

    $chea76 = "";

    $cheb76 = "";

    $chec76 = "";

    $ched76 = "Checked";

    $chee76 = "";

  }elseif ($_POST['radper76'] == "Letra E"){

    $chea76 = "";

    $cheb76 = "";

    $chec76 = "";

    $ched76 = "";

    $chee76 = "Checked";

  }

  

  // Verificando se respsota esta correta 76

  if ($_POST['radper76'] == $alt_corr76){

    $contrescorr = $contrescorr + 1;

    $cer_err76 = 1;

}

else{

  $cer_err76 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 76

if ($_POST['radper76'] == "Letra A"){

  $codigo_resposta76 = $letraaper76['codigo_resposta'];

}elseif ($_POST['radper76'] == "Letra B"){

  $codigo_resposta76 = $letrabper76['codigo_resposta'];

}elseif ($_POST['radper76'] == "Letra C"){

  $codigo_resposta76 = $letracper76['codigo_resposta'];

}elseif ($_POST['radper76'] == "Letra D"){

  $codigo_resposta76 = $letradper76['codigo_resposta'];

}elseif ($_POST['radper76'] == "Letra E"){

  $codigo_resposta76 = $letraeper76['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 76

$codigo_disciplina76 = $per76['codigo_disciplina'];

  

  // Selecionando imagem 76

  $imgper76 = $per76['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp76 = $letraaper76['tipo'];

  

  

  //Questão 77

  $codper77 = $_SESSION['codper77'];

  $select_per77 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper77");

  $per77 = mysqli_fetch_assoc($select_per77);

  

  $select_letraaper77 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper77 and letra = 'a'");

  $letraaper77 = mysqli_fetch_assoc($select_letraaper77);

  $select_letrabper77 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper77 and letra = 'b'");

  $letrabper77 = mysqli_fetch_assoc($select_letrabper77);

  $select_letracper77 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper77 and letra = 'c'");

  $letracper77 = mysqli_fetch_assoc($select_letracper77);

  $select_letradper77 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper77 and letra = 'd'");

  $letradper77 = mysqli_fetch_assoc($select_letradper77);

  $select_letraeper77 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper77 and letra = 'e'");

  $letraeper77 = mysqli_fetch_assoc($select_letraeper77);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper77["correta"]==1){

  $alt_corr77 = "Letra A";

  $cora77 = $corcorr;
  $sima77 = " ✓";

  $corb77 = "black";
  $simb77 = "";

  $corc77 = "black";
  $simc77 = "";

  $cord77 = "black";
  $simd77 = "";

  $core77 = "black";
  $sime77 = "";

}

elseif ($letrabper77["correta"]==1){

  $alt_corr77 = "Letra B";

  $corb77 = $corcorr;
  $simb77 = " ✓";

  $cora77 = "black";
  $sima77 = "";

  $corc77 = "black";
  $simc77 = "";

  $cord77 = "black";
  $simd77 = "";

  $core77 = "black";
  $sime77 = "";

}

elseif ($letracper77["correta"]==1){

  $alt_corr77 = "Letra C";

  $corc77 = $corcorr;
  $simc77 = " ✓";

  $cora77 = "black";
  $sima77 = "";

  $corb77 = "black";
  $simb77 = "";

  $cord77 = "black";
  $simd77 = "";

  $core77 = "black";
  $sime77 = "";

}

elseif ($letradper77["correta"]==1){

  $alt_corr77 = "Letra D";

  $cord77 = $corcorr;
  $simd77 = " ✓";

  $cora77 = "black";
  $sima77 = "";

  $corc77 = "black";
  $simc77 = "";

  $corb77 = "black";
  $simb77 = "";

  $core77 = "black";
  $sime77 = "";

}

elseif ($letraeper77["correta"]==1){

  $alt_corr77 = "Letra E";

  $core77 = $corcorr;
  $sime77 = " ✓";

  $cora77 = "black";
  $sima77 = "";

  $corc77 = "black";
  $simc77 = "";

  $cord77 = "black";
  $simd77 = "";

  $corb77 = "black";
  $simb77 = "";

}

//Errada

if ($alt_corr77 != $_POST['radper77'] && $_POST['radper77'] == "Letra A"){

  $cora77 = $corerr;
  $sima77 = " X";

}

elseif ($alt_corr77 != $_POST['radper77'] && $_POST['radper77'] == "Letra B"){

  $corb77 = $corerr;
  $simb77 = " X";

}

elseif ($alt_corr77 != $_POST['radper77'] && $_POST['radper77'] == "Letra C"){

  $corc77 = $corerr;
  $simc77 = " X";

}

elseif ($alt_corr77 != $_POST['radper77'] && $_POST['radper77'] == "Letra D"){

  $cord77 = $corerr;
  $simd77 = " X";

}

elseif ($alt_corr77 != $_POST['radper77'] && $_POST['radper77'] == "Letra E"){

  $core77 = $corerr;
  $sime77 = " X";

}

  

  // Verficando qual será checado 77

  if ($_POST['radper77'] == "Letra A"){

    $chea77 = "Checked";

    $cheb77 = "";

    $chec77 = "";

    $ched77 = "";

    $chee77 = "";

  }elseif ($_POST['radper77'] == "Letra B"){

    $chea77 = "";

    $cheb77 = "Checked";

    $chec77 = "";

    $ched77 = "";

    $chee77 = "";

  }elseif ($_POST['radper77'] == "Letra C"){

    $chea77 = "";

    $cheb77 = "";

    $chec77 = "Checked";

    $ched77 = "";

    $chee77 = "";

  }elseif ($_POST['radper77'] == "Letra D"){

    $chea77 = "";

    $cheb77 = "";

    $chec77 = "";

    $ched77 = "Checked";

    $chee77 = "";

  }elseif ($_POST['radper77'] == "Letra E"){

    $chea77 = "";

    $cheb77 = "";

    $chec77 = "";

    $ched77 = "";

    $chee77 = "Checked";

  }

  

  // Verificando se respsota esta correta 77

  if ($_POST['radper77'] == $alt_corr77){

    $contrescorr = $contrescorr + 1;

    $cer_err77 = 1;

}

else{

  $cer_err77 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 77

if ($_POST['radper77'] == "Letra A"){

  $codigo_resposta77 = $letraaper77['codigo_resposta'];

}elseif ($_POST['radper77'] == "Letra B"){

  $codigo_resposta77 = $letrabper77['codigo_resposta'];

}elseif ($_POST['radper77'] == "Letra C"){

  $codigo_resposta77 = $letracper77['codigo_resposta'];

}elseif ($_POST['radper77'] == "Letra D"){

  $codigo_resposta77 = $letradper77['codigo_resposta'];

}elseif ($_POST['radper77'] == "Letra E"){

  $codigo_resposta77 = $letraeper77['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 77

$codigo_disciplina77 = $per77['codigo_disciplina'];

  

  // Selecionando imagem 77

  $imgper77 = $per77['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp77 = $letraaper77['tipo'];

  

  

  //Questão 78

  $codper78 = $_SESSION['codper78'];

  $select_per78 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper78");

  $per78 = mysqli_fetch_assoc($select_per78);

  

  $select_letraaper78 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper78 and letra = 'a'");

  $letraaper78 = mysqli_fetch_assoc($select_letraaper78);

  $select_letrabper78 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper78 and letra = 'b'");

  $letrabper78 = mysqli_fetch_assoc($select_letrabper78);

  $select_letracper78 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper78 and letra = 'c'");

  $letracper78 = mysqli_fetch_assoc($select_letracper78);

  $select_letradper78 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper78 and letra = 'd'");

  $letradper78 = mysqli_fetch_assoc($select_letradper78);

  $select_letraeper78 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper78 and letra = 'e'");

  $letraeper78 = mysqli_fetch_assoc($select_letraeper78);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper78["correta"]==1){

  $alt_corr78 = "Letra A";

  $cora78 = $corcorr;
  $sima78 = " ✓";

  $corb78 = "black";
  $simb78 = "";

  $corc78 = "black";
  $simc78 = "";

  $cord78 = "black";
  $simd78 = "";

  $core78 = "black";
  $sime78 = "";

}

elseif ($letrabper78["correta"]==1){

  $alt_corr78 = "Letra B";

  $corb78 = $corcorr;
  $simb78 = " ✓";

  $cora78 = "black";
  $sima78 = "";

  $corc78 = "black";
  $simc78 = "";

  $cord78 = "black";
  $simd78 = "";

  $core78 = "black";
  $sime78 = "";

}

elseif ($letracper78["correta"]==1){

  $alt_corr78 = "Letra C";

  $corc78 = $corcorr;
  $simc78 = " ✓";

  $cora78 = "black";
  $sima78 = "";

  $corb78 = "black";
  $simb78 = "";

  $cord78 = "black";
  $simd78 = "";

  $core78 = "black";
  $sime78 = "";

}

elseif ($letradper78["correta"]==1){

  $alt_corr78 = "Letra D";

  $cord78 = $corcorr;
  $simd78 = " ✓";

  $cora78 = "black";
  $sima78 = "";

  $corc78 = "black";
  $simc78 = "";

  $corb78 = "black";
  $simb78 = "";

  $core78 = "black";
  $sime78 = "";

}

elseif ($letraeper78["correta"]==1){

  $alt_corr78 = "Letra E";

  $core78 = $corcorr;
  $sime78 = " ✓";

  $cora78 = "black";
  $sima78 = "";

  $corc78 = "black";
  $simc78 = "";

  $cord78 = "black";
  $simd78 = "";

  $corb78 = "black";
  $simb78 = "";

}

//Errada

if ($alt_corr78 != $_POST['radper78'] && $_POST['radper78'] == "Letra A"){

  $cora78 = $corerr;
  $sima78 = " X";

}

elseif ($alt_corr78 != $_POST['radper78'] && $_POST['radper78'] == "Letra B"){

  $corb78 = $corerr;
  $simb78 = " X";

}

elseif ($alt_corr78 != $_POST['radper78'] && $_POST['radper78'] == "Letra C"){

  $corc78 = $corerr;
  $simc78 = " X";

}

elseif ($alt_corr78 != $_POST['radper78'] && $_POST['radper78'] == "Letra D"){

  $cord78 = $corerr;
  $simd78 = " X";

}

elseif ($alt_corr78 != $_POST['radper78'] && $_POST['radper78'] == "Letra E"){

  $core78 = $corerr;
  $sime78 = " X";

}

  

  // Verficando qual será checado 78

  if ($_POST['radper78'] == "Letra A"){

    $chea78 = "Checked";

    $cheb78 = "";

    $chec78 = "";

    $ched78 = "";

    $chee78 = "";

  }elseif ($_POST['radper78'] == "Letra B"){

    $chea78 = "";

    $cheb78 = "Checked";

    $chec78 = "";

    $ched78 = "";

    $chee78 = "";

  }elseif ($_POST['radper78'] == "Letra C"){

    $chea78 = "";

    $cheb78 = "";

    $chec78 = "Checked";

    $ched78 = "";

    $chee78 = "";

  }elseif ($_POST['radper78'] == "Letra D"){

    $chea78 = "";

    $cheb78 = "";

    $chec78 = "";

    $ched78 = "Checked";

    $chee78 = "";

  }elseif ($_POST['radper78'] == "Letra E"){

    $chea78 = "";

    $cheb78 = "";

    $chec78 = "";

    $ched78 = "";

    $chee78 = "Checked";

  }

  

  // Verificando se respsota esta correta 78

  if ($_POST['radper78'] == $alt_corr78){

    $contrescorr = $contrescorr + 1;

    $cer_err78 = 1;

}

else{

  $cer_err78 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 78

if ($_POST['radper78'] == "Letra A"){

  $codigo_resposta78 = $letraaper78['codigo_resposta'];

}elseif ($_POST['radper78'] == "Letra B"){

  $codigo_resposta78 = $letrabper78['codigo_resposta'];

}elseif ($_POST['radper78'] == "Letra C"){

  $codigo_resposta78 = $letracper78['codigo_resposta'];

}elseif ($_POST['radper78'] == "Letra D"){

  $codigo_resposta78 = $letradper78['codigo_resposta'];

}elseif ($_POST['radper78'] == "Letra E"){

  $codigo_resposta78 = $letraeper78['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 78

$codigo_disciplina78 = $per78['codigo_disciplina'];

  

  // Selecionando imagem 78

  $imgper78 = $per78['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp78 = $letraaper78['tipo'];

  

  

  //Questão 79

  $codper79 = $_SESSION['codper79'];

  $select_per79 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper79");

  $per79 = mysqli_fetch_assoc($select_per79);

  

  $select_letraaper79 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper79 and letra = 'a'");

  $letraaper79 = mysqli_fetch_assoc($select_letraaper79);

  $select_letrabper79 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper79 and letra = 'b'");

  $letrabper79 = mysqli_fetch_assoc($select_letrabper79);

  $select_letracper79 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper79 and letra = 'c'");

  $letracper79 = mysqli_fetch_assoc($select_letracper79);

  $select_letradper79 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper79 and letra = 'd'");

  $letradper79 = mysqli_fetch_assoc($select_letradper79);

  $select_letraeper79 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper79 and letra = 'e'");

  $letraeper79 = mysqli_fetch_assoc($select_letraeper79);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper79["correta"]==1){

  $alt_corr79 = "Letra A";

  $cora79 = $corcorr;
  $sima79 = " ✓";

  $corb79 = "black";
  $simb79 = "";

  $corc79 = "black";
  $simc79 = "";

  $cord79 = "black";
  $simd79 = "";

  $core79 = "black";
  $sime79 = "";

}

elseif ($letrabper79["correta"]==1){

  $alt_corr79 = "Letra B";

  $corb79 = $corcorr;
  $simb79 = " ✓";

  $cora79 = "black";
  $sima79 = "";

  $corc79 = "black";
  $simc79 = "";

  $cord79 = "black";
  $simd79 = "";

  $core79 = "black";
  $sime79 = "";

}

elseif ($letracper79["correta"]==1){

  $alt_corr79 = "Letra C";

  $corc79 = $corcorr;
  $simc79 = " ✓";

  $cora79 = "black";
  $sima79 = "";

  $corb79 = "black";
  $simb79 = "";

  $cord79 = "black";
  $simd79 = "";

  $core79 = "black";
  $sime79 = "";

}

elseif ($letradper79["correta"]==1){

  $alt_corr79 = "Letra D";

  $cord79 = $corcorr;
  $simd79 = " ✓";

  $cora79 = "black";
  $sima79 = "";

  $corc79 = "black";
  $simc79 = "";

  $corb79 = "black";
  $simb79 = "";

  $core79 = "black";
  $sime79 = "";

}

elseif ($letraeper79["correta"]==1){

  $alt_corr79 = "Letra E";

  $core79 = $corcorr;
  $sime79 = " ✓";

  $cora79 = "black";
  $sima79 = "";

  $corc79 = "black";
  $simc79 = "";

  $cord79 = "black";
  $simd79 = "";

  $corb79 = "black";
  $simb79 = "";

}

//Errada

if ($alt_corr79 != $_POST['radper79'] && $_POST['radper79'] == "Letra A"){

  $cora79 = $corerr;
  $sima79 = " X";

}

elseif ($alt_corr79 != $_POST['radper79'] && $_POST['radper79'] == "Letra B"){

  $corb79 = $corerr;
  $simb79 = " X";

}

elseif ($alt_corr79 != $_POST['radper79'] && $_POST['radper79'] == "Letra C"){

  $corc79 = $corerr;
  $simc79 = " X";

}

elseif ($alt_corr79 != $_POST['radper79'] && $_POST['radper79'] == "Letra D"){

  $cord79 = $corerr;
  $simd79 = " X";

}

elseif ($alt_corr79 != $_POST['radper79'] && $_POST['radper79'] == "Letra E"){

  $core79 = $corerr;
  $sime79 = " X";

}

  

  // Verficando qual será checado 79

  if ($_POST['radper79'] == "Letra A"){

    $chea79 = "Checked";

    $cheb79 = "";

    $chec79 = "";

    $ched79 = "";

    $chee79 = "";

  }elseif ($_POST['radper79'] == "Letra B"){

    $chea79 = "";

    $cheb79 = "Checked";

    $chec79 = "";

    $ched79 = "";

    $chee79 = "";

  }elseif ($_POST['radper79'] == "Letra C"){

    $chea79 = "";

    $cheb79 = "";

    $chec79 = "Checked";

    $ched79 = "";

    $chee79 = "";

  }elseif ($_POST['radper79'] == "Letra D"){

    $chea79 = "";

    $cheb79 = "";

    $chec79 = "";

    $ched79 = "Checked";

    $chee79 = "";

  }elseif ($_POST['radper79'] == "Letra E"){

    $chea79 = "";

    $cheb79 = "";

    $chec79 = "";

    $ched79 = "";

    $chee79 = "Checked";

  }

  

  // Verificando se respsota esta correta 79

  if ($_POST['radper79'] == $alt_corr79){

    $contrescorr = $contrescorr + 1;

    $cer_err79 = 1;

}

else{

  $cer_err79 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 79

if ($_POST['radper79'] == "Letra A"){

  $codigo_resposta79 = $letraaper79['codigo_resposta'];

}elseif ($_POST['radper79'] == "Letra B"){

  $codigo_resposta79 = $letrabper79['codigo_resposta'];

}elseif ($_POST['radper79'] == "Letra C"){

  $codigo_resposta79 = $letracper79['codigo_resposta'];

}elseif ($_POST['radper79'] == "Letra D"){

  $codigo_resposta79 = $letradper79['codigo_resposta'];

}elseif ($_POST['radper79'] == "Letra E"){

  $codigo_resposta79 = $letraeper79['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 79

$codigo_disciplina79 = $per79['codigo_disciplina'];

  

  // Selecionando imagem 79

  $imgper79 = $per79['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp79 = $letraaper79['tipo'];

  

  

  //Questão 80

  $codper80 = $_SESSION['codper80'];

  $select_per80 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper80");

  $per80 = mysqli_fetch_assoc($select_per80);

  

  $select_letraaper80 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper80 and letra = 'a'");

  $letraaper80 = mysqli_fetch_assoc($select_letraaper80);

  $select_letrabper80 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper80 and letra = 'b'");

  $letrabper80 = mysqli_fetch_assoc($select_letrabper80);

  $select_letracper80 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper80 and letra = 'c'");

  $letracper80 = mysqli_fetch_assoc($select_letracper80);

  $select_letradper80 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper80 and letra = 'd'");

  $letradper80 = mysqli_fetch_assoc($select_letradper80);

  $select_letraeper80 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper80 and letra = 'e'");

  $letraeper80 = mysqli_fetch_assoc($select_letraeper80);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper80["correta"]==1){

  $alt_corr80 = "Letra A";

  $cora80 = $corcorr;
  $sima80 = " ✓";

  $corb80 = "black";
  $simb80 = "";

  $corc80 = "black";
  $simc80 = "";

  $cord80 = "black";
  $simd80 = "";

  $core80 = "black";
  $sime80 = "";

}

elseif ($letrabper80["correta"]==1){

  $alt_corr80 = "Letra B";

  $corb80 = $corcorr;
  $simb80 = " ✓";

  $cora80 = "black";
  $sima80 = "";

  $corc80 = "black";
  $simc80 = "";

  $cord80 = "black";
  $simd80 = "";

  $core80 = "black";
  $sime80 = "";

}

elseif ($letracper80["correta"]==1){

  $alt_corr80 = "Letra C";

  $corc80 = $corcorr;
  $simc80 = " ✓";

  $cora80 = "black";
  $sima80 = "";

  $corb80 = "black";
  $simb80 = "";

  $cord80 = "black";
  $simd80 = "";

  $core80 = "black";
  $sime80 = "";

}

elseif ($letradper80["correta"]==1){

  $alt_corr80 = "Letra D";

  $cord80 = $corcorr;
  $simd80 = " ✓";

  $cora80 = "black";
  $sima80 = "";

  $corc80 = "black";
  $simc80 = "";

  $corb80 = "black";
  $simb80 = "";

  $core80 = "black";
  $sime80 = "";

}

elseif ($letraeper80["correta"]==1){

  $alt_corr80 = "Letra E";

  $core80 = $corcorr;
  $sime80 = " ✓";

  $cora80 = "black";
  $sima80 = "";

  $corc80 = "black";
  $simc80 = "";

  $cord80 = "black";
  $simd80 = "";

  $corb80 = "black";
  $simb80 = "";

}

//Errada

if ($alt_corr80 != $_POST['radper80'] && $_POST['radper80'] == "Letra A"){

  $cora80 = $corerr;
  $sima80 = " X";

}

elseif ($alt_corr80 != $_POST['radper80'] && $_POST['radper80'] == "Letra B"){

  $corb80 = $corerr;
  $simb80 = " X";

}

elseif ($alt_corr80 != $_POST['radper80'] && $_POST['radper80'] == "Letra C"){

  $corc80 = $corerr;
  $simc80 = " X";

}

elseif ($alt_corr80 != $_POST['radper80'] && $_POST['radper80'] == "Letra D"){

  $cord80 = $corerr;
  $simd80 = " X";

}

elseif ($alt_corr80 != $_POST['radper80'] && $_POST['radper80'] == "Letra E"){

  $core80 = $corerr;
  $sime80 = " X";

}

  

  // Verficando qual será checado 80

  if ($_POST['radper80'] == "Letra A"){

    $chea80 = "Checked";

    $cheb80 = "";

    $chec80 = "";

    $ched80 = "";

    $chee80 = "";

  }elseif ($_POST['radper80'] == "Letra B"){

    $chea80 = "";

    $cheb80 = "Checked";

    $chec80 = "";

    $ched80 = "";

    $chee80 = "";

  }elseif ($_POST['radper80'] == "Letra C"){

    $chea80 = "";

    $cheb80 = "";

    $chec80 = "Checked";

    $ched80 = "";

    $chee80 = "";

  }elseif ($_POST['radper80'] == "Letra D"){

    $chea80 = "";

    $cheb80 = "";

    $chec80 = "";

    $ched80 = "Checked";

    $chee80 = "";

  }elseif ($_POST['radper80'] == "Letra E"){

    $chea80 = "";

    $cheb80 = "";

    $chec80 = "";

    $ched80 = "";

    $chee80 = "Checked";

  }

  

  // Verificando se respsota esta correta 80

  if ($_POST['radper80'] == $alt_corr80){

    $contrescorr = $contrescorr + 1;

    $cer_err80 = 1;

}

else{

  $cer_err80 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 80

if ($_POST['radper80'] == "Letra A"){

  $codigo_resposta80 = $letraaper80['codigo_resposta'];

}elseif ($_POST['radper80'] == "Letra B"){

  $codigo_resposta80 = $letrabper80['codigo_resposta'];

}elseif ($_POST['radper80'] == "Letra C"){

  $codigo_resposta80 = $letracper80['codigo_resposta'];

}elseif ($_POST['radper80'] == "Letra D"){

  $codigo_resposta80 = $letradper80['codigo_resposta'];

}elseif ($_POST['radper80'] == "Letra E"){

  $codigo_resposta80 = $letraeper80['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 80

$codigo_disciplina80 = $per80['codigo_disciplina'];

  

  // Selecionando imagem 80

  $imgper80 = $per80['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp80 = $letraaper80['tipo'];

  

  }





  // Verificando se existe perguntas de 81 à 85

if ($qtperguntas>80){



  //Questão 81

  $codper81 = $_SESSION['codper81'];

  $select_per81 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper81");

  $per81 = mysqli_fetch_assoc($select_per81);

  

  $select_letraaper81 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper81 and letra = 'a'");

  $letraaper81 = mysqli_fetch_assoc($select_letraaper81);

  $select_letrabper81 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper81 and letra = 'b'");

  $letrabper81 = mysqli_fetch_assoc($select_letrabper81);

  $select_letracper81 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper81 and letra = 'c'");

  $letracper81 = mysqli_fetch_assoc($select_letracper81);

  $select_letradper81 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper81 and letra = 'd'");

  $letradper81 = mysqli_fetch_assoc($select_letradper81);

  $select_letraeper81 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper81 and letra = 'e'");

  $letraeper81 = mysqli_fetch_assoc($select_letraeper81);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper81["correta"]==1){

  $alt_corr81 = "Letra A";

  $cora81 = $corcorr;
  $sima81 = " ✓";

  $corb81 = "black";
  $simb81 = "";

  $corc81 = "black";
  $simc81 = "";

  $cord81 = "black";
  $simd81 = "";

  $core81 = "black";
  $sime81 = "";

}

elseif ($letrabper81["correta"]==1){

  $alt_corr81 = "Letra B";

  $corb81 = $corcorr;
  $simb81 = " ✓";

  $cora81 = "black";
  $sima81 = "";

  $corc81 = "black";
  $simc81 = "";

  $cord81 = "black";
  $simd81 = "";

  $core81 = "black";
  $sime81 = "";

}

elseif ($letracper81["correta"]==1){

  $alt_corr81 = "Letra C";

  $corc81 = $corcorr;
  $simc81 = " ✓";

  $cora81 = "black";
  $sima81 = "";

  $corb81 = "black";
  $simb81 = "";

  $cord81 = "black";
  $simd81 = "";

  $core81 = "black";
  $sime81 = "";

}

elseif ($letradper81["correta"]==1){

  $alt_corr81 = "Letra D";

  $cord81 = $corcorr;
  $simd81 = " ✓";

  $cora81 = "black";
  $sima81 = "";

  $corc81 = "black";
  $simc81 = "";

  $corb81 = "black";
  $simb81 = "";

  $core81 = "black";
  $sime81 = "";

}

elseif ($letraeper81["correta"]==1){

  $alt_corr81 = "Letra E";

  $core81 = $corcorr;
  $sime81 = " ✓";

  $cora81 = "black";
  $sima81 = "";

  $corc81 = "black";
  $simc81 = "";

  $cord81 = "black";
  $simd81 = "";

  $corb81 = "black";
  $simb81 = "";

}

//Errada

if ($alt_corr81 != $_POST['radper81'] && $_POST['radper81'] == "Letra A"){

  $cora81 = $corerr;
  $sima81 = " X";

}

elseif ($alt_corr81 != $_POST['radper81'] && $_POST['radper81'] == "Letra B"){

  $corb81 = $corerr;
  $simb81 = " X";

}

elseif ($alt_corr81 != $_POST['radper81'] && $_POST['radper81'] == "Letra C"){

  $corc81 = $corerr;
  $simc81 = " X";

}

elseif ($alt_corr81 != $_POST['radper81'] && $_POST['radper81'] == "Letra D"){

  $cord81 = $corerr;
  $simd81 = " X";

}

elseif ($alt_corr81 != $_POST['radper81'] && $_POST['radper81'] == "Letra E"){

  $core81 = $corerr;
  $sime81 = " X";

}

  

  // Verficando qual será checado 81

  if ($_POST['radper81'] == "Letra A"){

    $chea81 = "Checked";

    $cheb81 = "";

    $chec81 = "";

    $ched81 = "";

    $chee81 = "";

  }elseif ($_POST['radper81'] == "Letra B"){

    $chea81 = "";

    $cheb81 = "Checked";

    $chec81 = "";

    $ched81 = "";

    $chee81 = "";

  }elseif ($_POST['radper81'] == "Letra C"){

    $chea81 = "";

    $cheb81 = "";

    $chec81 = "Checked";

    $ched81 = "";

    $chee81 = "";

  }elseif ($_POST['radper81'] == "Letra D"){

    $chea81 = "";

    $cheb81 = "";

    $chec81 = "";

    $ched81 = "Checked";

    $chee81 = "";

  }elseif ($_POST['radper81'] == "Letra E"){

    $chea81 = "";

    $cheb81 = "";

    $chec81 = "";

    $ched81 = "";

    $chee81 = "Checked";

  }

  

  // Verificando se respsota esta correta 81

  if ($_POST['radper81'] == $alt_corr81){

    $contrescorr = $contrescorr + 1;

    $cer_err81 = 1;

}

else{

  $cer_err81 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 81

if ($_POST['radper81'] == "Letra A"){

  $codigo_resposta81 = $letraaper81['codigo_resposta'];

}elseif ($_POST['radper81'] == "Letra B"){

  $codigo_resposta81 = $letrabper81['codigo_resposta'];

}elseif ($_POST['radper81'] == "Letra C"){

  $codigo_resposta81 = $letracper81['codigo_resposta'];

}elseif ($_POST['radper81'] == "Letra D"){

  $codigo_resposta81 = $letradper81['codigo_resposta'];

}elseif ($_POST['radper81'] == "Letra E"){

  $codigo_resposta81 = $letraeper81['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 81

$codigo_disciplina81 = $per81['codigo_disciplina'];

  

  // Selecionando imagem 81

  $imgper81 = $per81['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp81 = $letraaper81['tipo'];

  

  

  //Questão 82

  $codper82 = $_SESSION['codper82'];

  $select_per82 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper82");

  $per82 = mysqli_fetch_assoc($select_per82);

  

  $select_letraaper82 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper82 and letra = 'a'");

  $letraaper82 = mysqli_fetch_assoc($select_letraaper82);

  $select_letrabper82 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper82 and letra = 'b'");

  $letrabper82 = mysqli_fetch_assoc($select_letrabper82);

  $select_letracper82 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper82 and letra = 'c'");

  $letracper82 = mysqli_fetch_assoc($select_letracper82);

  $select_letradper82 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper82 and letra = 'd'");

  $letradper82 = mysqli_fetch_assoc($select_letradper82);

  $select_letraeper82 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper82 and letra = 'e'");

  $letraeper82 = mysqli_fetch_assoc($select_letraeper82);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper82["correta"]==1){

  $alt_corr82 = "Letra A";

  $cora82 = $corcorr;
  $sima82 = " ✓";

  $corb82 = "black";
  $simb82 = "";

  $corc82 = "black";
  $simc82 = "";

  $cord82 = "black";
  $simd82 = "";

  $core82 = "black";
  $sime82 = "";

}

elseif ($letrabper82["correta"]==1){

  $alt_corr82 = "Letra B";

  $corb82 = $corcorr;
  $simb82 = " ✓";

  $cora82 = "black";
  $sima82 = "";

  $corc82 = "black";
  $simc82 = "";

  $cord82 = "black";
  $simd82 = "";

  $core82 = "black";
  $sime82 = "";

}

elseif ($letracper82["correta"]==1){

  $alt_corr82 = "Letra C";

  $corc82 = $corcorr;
  $simc82 = " ✓";

  $cora82 = "black";
  $sima82 = "";

  $corb82 = "black";
  $simb82 = "";

  $cord82 = "black";
  $simd82 = "";

  $core82 = "black";
  $sime82 = "";

}

elseif ($letradper82["correta"]==1){

  $alt_corr82 = "Letra D";

  $cord82 = $corcorr;
  $simd82 = " ✓";

  $cora82 = "black";
  $sima82 = "";

  $corc82 = "black";
  $simc82 = "";

  $corb82 = "black";
  $simb82 = "";

  $core82 = "black";
  $sime82 = "";

}

elseif ($letraeper82["correta"]==1){

  $alt_corr82 = "Letra E";

  $core82 = $corcorr;
  $sime82 = " ✓";

  $cora82 = "black";
  $sima82 = "";

  $corc82 = "black";
  $simc82 = "";

  $cord82 = "black";
  $simd82 = "";

  $corb82 = "black";
  $simb82 = "";

}

//Errada

if ($alt_corr82 != $_POST['radper82'] && $_POST['radper82'] == "Letra A"){

  $cora82 = $corerr;
  $sima82 = " X";

}

elseif ($alt_corr82 != $_POST['radper82'] && $_POST['radper82'] == "Letra B"){

  $corb82 = $corerr;
  $simb82 = " X";

}

elseif ($alt_corr82 != $_POST['radper82'] && $_POST['radper82'] == "Letra C"){

  $corc82 = $corerr;
  $simc82 = " X";

}

elseif ($alt_corr82 != $_POST['radper82'] && $_POST['radper82'] == "Letra D"){

  $cord82 = $corerr;
  $simd82 = " X";

}

elseif ($alt_corr82 != $_POST['radper82'] && $_POST['radper82'] == "Letra E"){

  $core82 = $corerr;
  $sime82 = " X";

}

  

  // Verficando qual será checado 82

  if ($_POST['radper82'] == "Letra A"){

    $chea82 = "Checked";

    $cheb82 = "";

    $chec82 = "";

    $ched82 = "";

    $chee82 = "";

  }elseif ($_POST['radper82'] == "Letra B"){

    $chea82 = "";

    $cheb82 = "Checked";

    $chec82 = "";

    $ched82 = "";

    $chee82 = "";

  }elseif ($_POST['radper82'] == "Letra C"){

    $chea82 = "";

    $cheb82 = "";

    $chec82 = "Checked";

    $ched82 = "";

    $chee82 = "";

  }elseif ($_POST['radper82'] == "Letra D"){

    $chea82 = "";

    $cheb82 = "";

    $chec82 = "";

    $ched82 = "Checked";

    $chee82 = "";

  }elseif ($_POST['radper82'] == "Letra E"){

    $chea82 = "";

    $cheb82 = "";

    $chec82 = "";

    $ched82 = "";

    $chee82 = "Checked";

  }

  

  // Verificando se respsota esta correta 82

  if ($_POST['radper82'] == $alt_corr82){

    $contrescorr = $contrescorr + 1;

    $cer_err82 = 1;

}

else{

  $cer_err82 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 82

if ($_POST['radper82'] == "Letra A"){

  $codigo_resposta82 = $letraaper82['codigo_resposta'];

}elseif ($_POST['radper82'] == "Letra B"){

  $codigo_resposta82 = $letrabper82['codigo_resposta'];

}elseif ($_POST['radper82'] == "Letra C"){

  $codigo_resposta82 = $letracper82['codigo_resposta'];

}elseif ($_POST['radper82'] == "Letra D"){

  $codigo_resposta82 = $letradper82['codigo_resposta'];

}elseif ($_POST['radper82'] == "Letra E"){

  $codigo_resposta82 = $letraeper82['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 82

$codigo_disciplina82 = $per82['codigo_disciplina'];

  

  // Selecionando imagem 82

  $imgper82 = $per82['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp82 = $letraaper82['tipo'];

  

  

  //Questão 83

  $codper83 = $_SESSION['codper83'];

  $select_per83 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper83");

  $per83 = mysqli_fetch_assoc($select_per83);

  

  $select_letraaper83 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper83 and letra = 'a'");

  $letraaper83 = mysqli_fetch_assoc($select_letraaper83);

  $select_letrabper83 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper83 and letra = 'b'");

  $letrabper83 = mysqli_fetch_assoc($select_letrabper83);

  $select_letracper83 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper83 and letra = 'c'");

  $letracper83 = mysqli_fetch_assoc($select_letracper83);

  $select_letradper83 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper83 and letra = 'd'");

  $letradper83 = mysqli_fetch_assoc($select_letradper83);

  $select_letraeper83 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper83 and letra = 'e'");

  $letraeper83 = mysqli_fetch_assoc($select_letraeper83);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper83["correta"]==1){

  $alt_corr83 = "Letra A";

  $cora83 = $corcorr;
  $sima83 = " ✓";

  $corb83 = "black";
  $simb83 = "";

  $corc83 = "black";
  $simc83 = "";

  $cord83 = "black";
  $simd83 = "";

  $core83 = "black";
  $sime83 = "";

}

elseif ($letrabper83["correta"]==1){

  $alt_corr83 = "Letra B";

  $corb83 = $corcorr;
  $simb83 = " ✓";

  $cora83 = "black";
  $sima83 = "";

  $corc83 = "black";
  $simc83 = "";

  $cord83 = "black";
  $simd83 = "";

  $core83 = "black";
  $sime83 = "";

}

elseif ($letracper83["correta"]==1){

  $alt_corr83 = "Letra C";

  $corc83 = $corcorr;
  $simc83 = " ✓";

  $cora83 = "black";
  $sima83 = "";

  $corb83 = "black";
  $simb83 = "";

  $cord83 = "black";
  $simd83 = "";

  $core83 = "black";
  $sime83 = "";

}

elseif ($letradper83["correta"]==1){

  $alt_corr83 = "Letra D";

  $cord83 = $corcorr;
  $simd83 = " ✓";

  $cora83 = "black";
  $sima83 = "";

  $corc83 = "black";
  $simc83 = "";

  $corb83 = "black";
  $simb83 = "";

  $core83 = "black";
  $sime83 = "";

}

elseif ($letraeper83["correta"]==1){

  $alt_corr83 = "Letra E";

  $core83 = $corcorr;
  $sime83 = " ✓";

  $cora83 = "black";
  $sima83 = "";

  $corc83 = "black";
  $simc83 = "";

  $cord83 = "black";
  $simd83 = "";

  $corb83 = "black";
  $simb83 = "";

}

//Errada

if ($alt_corr83 != $_POST['radper83'] && $_POST['radper83'] == "Letra A"){

  $cora83 = $corerr;
  $sima83 = " X";

}

elseif ($alt_corr83 != $_POST['radper83'] && $_POST['radper83'] == "Letra B"){

  $corb83 = $corerr;
  $simb83 = " X";

}

elseif ($alt_corr83 != $_POST['radper83'] && $_POST['radper83'] == "Letra C"){

  $corc83 = $corerr;
  $simc83 = " X";

}

elseif ($alt_corr83 != $_POST['radper83'] && $_POST['radper83'] == "Letra D"){

  $cord83 = $corerr;
  $simd83 = " X";

}

elseif ($alt_corr83 != $_POST['radper83'] && $_POST['radper83'] == "Letra E"){

  $core83 = $corerr;
  $sime83 = " X";

}

  

  // Verficando qual será checado 83

  if ($_POST['radper83'] == "Letra A"){

    $chea83 = "Checked";

    $cheb83 = "";

    $chec83 = "";

    $ched83 = "";

    $chee83 = "";

  }elseif ($_POST['radper83'] == "Letra B"){

    $chea83 = "";

    $cheb83 = "Checked";

    $chec83 = "";

    $ched83 = "";

    $chee83 = "";

  }elseif ($_POST['radper83'] == "Letra C"){

    $chea83 = "";

    $cheb83 = "";

    $chec83 = "Checked";

    $ched83 = "";

    $chee83 = "";

  }elseif ($_POST['radper83'] == "Letra D"){

    $chea83 = "";

    $cheb83 = "";

    $chec83 = "";

    $ched83 = "Checked";

    $chee83 = "";

  }elseif ($_POST['radper83'] == "Letra E"){

    $chea83 = "";

    $cheb83 = "";

    $chec83 = "";

    $ched83 = "";

    $chee83 = "Checked";

  }

  

  // Verificando se respsota esta correta 83

  if ($_POST['radper83'] == $alt_corr83){

    $contrescorr = $contrescorr + 1;

    $cer_err83 = 1;

}

else{

  $cer_err83 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 83

if ($_POST['radper83'] == "Letra A"){

  $codigo_resposta83 = $letraaper83['codigo_resposta'];

}elseif ($_POST['radper83'] == "Letra B"){

  $codigo_resposta83 = $letrabper83['codigo_resposta'];

}elseif ($_POST['radper83'] == "Letra C"){

  $codigo_resposta83 = $letracper83['codigo_resposta'];

}elseif ($_POST['radper83'] == "Letra D"){

  $codigo_resposta83 = $letradper83['codigo_resposta'];

}elseif ($_POST['radper83'] == "Letra E"){

  $codigo_resposta83 = $letraeper83['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 83

$codigo_disciplina83 = $per83['codigo_disciplina'];

  

  // Selecionando imagem 83

  $imgper83 = $per83['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp83 = $letraaper83['tipo'];

  

  

  //Questão 84

  $codper84 = $_SESSION['codper84'];

  $select_per84 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper84");

  $per84 = mysqli_fetch_assoc($select_per84);

  

  $select_letraaper84 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper84 and letra = 'a'");

  $letraaper84 = mysqli_fetch_assoc($select_letraaper84);

  $select_letrabper84 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper84 and letra = 'b'");

  $letrabper84 = mysqli_fetch_assoc($select_letrabper84);

  $select_letracper84 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper84 and letra = 'c'");

  $letracper84 = mysqli_fetch_assoc($select_letracper84);

  $select_letradper84 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper84 and letra = 'd'");

  $letradper84 = mysqli_fetch_assoc($select_letradper84);

  $select_letraeper84 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper84 and letra = 'e'");

  $letraeper84 = mysqli_fetch_assoc($select_letraeper84);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper84["correta"]==1){

  $alt_corr84 = "Letra A";

  $cora84 = $corcorr;
  $sima84 = " ✓";

  $corb84 = "black";
  $simb84 = "";

  $corc84 = "black";
  $simc84 = "";

  $cord84 = "black";
  $simd84 = "";

  $core84 = "black";
  $sime84 = "";

}

elseif ($letrabper84["correta"]==1){

  $alt_corr84 = "Letra B";

  $corb84 = $corcorr;
  $simb84 = " ✓";

  $cora84 = "black";
  $sima84 = "";

  $corc84 = "black";
  $simc84 = "";

  $cord84 = "black";
  $simd84 = "";

  $core84 = "black";
  $sime84 = "";

}

elseif ($letracper84["correta"]==1){

  $alt_corr84 = "Letra C";

  $corc84 = $corcorr;
  $simc84 = " ✓";

  $cora84 = "black";
  $sima84 = "";

  $corb84 = "black";
  $simb84 = "";

  $cord84 = "black";
  $simd84 = "";

  $core84 = "black";
  $sime84 = "";

}

elseif ($letradper84["correta"]==1){

  $alt_corr84 = "Letra D";

  $cord84 = $corcorr;
  $simd84 = " ✓";

  $cora84 = "black";
  $sima84 = "";

  $corc84 = "black";
  $simc84 = "";

  $corb84 = "black";
  $simb84 = "";

  $core84 = "black";
  $sime84 = "";

}

elseif ($letraeper84["correta"]==1){

  $alt_corr84 = "Letra E";

  $core84 = $corcorr;
  $sime84 = " ✓";

  $cora84 = "black";
  $sima84 = "";

  $corc84 = "black";
  $simc84 = "";

  $cord84 = "black";
  $simd84 = "";

  $corb84 = "black";
  $simb84 = "";

}

//Errada

if ($alt_corr84 != $_POST['radper84'] && $_POST['radper84'] == "Letra A"){

  $cora84 = $corerr;
  $sima84 = " X";

}

elseif ($alt_corr84 != $_POST['radper84'] && $_POST['radper84'] == "Letra B"){

  $corb84 = $corerr;
  $simb84 = " X";

}

elseif ($alt_corr84 != $_POST['radper84'] && $_POST['radper84'] == "Letra C"){

  $corc84 = $corerr;
  $simc84 = " X";

}

elseif ($alt_corr84 != $_POST['radper84'] && $_POST['radper84'] == "Letra D"){

  $cord84 = $corerr;
  $simd84 = " X";

}

elseif ($alt_corr84 != $_POST['radper84'] && $_POST['radper84'] == "Letra E"){

  $core84 = $corerr;
  $sime84 = " X";

}

  

  // Verficando qual será checado 84

  if ($_POST['radper84'] == "Letra A"){

    $chea84 = "Checked";

    $cheb84 = "";

    $chec84 = "";

    $ched84 = "";

    $chee84 = "";

  }elseif ($_POST['radper84'] == "Letra B"){

    $chea84 = "";

    $cheb84 = "Checked";

    $chec84 = "";

    $ched84 = "";

    $chee84 = "";

  }elseif ($_POST['radper84'] == "Letra C"){

    $chea84 = "";

    $cheb84 = "";

    $chec84 = "Checked";

    $ched84 = "";

    $chee84 = "";

  }elseif ($_POST['radper84'] == "Letra D"){

    $chea84 = "";

    $cheb84 = "";

    $chec84 = "";

    $ched84 = "Checked";

    $chee84 = "";

  }elseif ($_POST['radper84'] == "Letra E"){

    $chea84 = "";

    $cheb84 = "";

    $chec84 = "";

    $ched84 = "";

    $chee84 = "Checked";

  }

  

  // Verificando se respsota esta correta 84

  if ($_POST['radper84'] == $alt_corr84){

    $contrescorr = $contrescorr + 1;

    $cer_err84 = 1;

}

else{

  $cer_err84 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 84

if ($_POST['radper84'] == "Letra A"){

  $codigo_resposta84 = $letraaper84['codigo_resposta'];

}elseif ($_POST['radper84'] == "Letra B"){

  $codigo_resposta84 = $letrabper84['codigo_resposta'];

}elseif ($_POST['radper84'] == "Letra C"){

  $codigo_resposta84 = $letracper84['codigo_resposta'];

}elseif ($_POST['radper84'] == "Letra D"){

  $codigo_resposta84 = $letradper84['codigo_resposta'];

}elseif ($_POST['radper84'] == "Letra E"){

  $codigo_resposta84 = $letraeper84['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 84

$codigo_disciplina84 = $per84['codigo_disciplina'];

  

  // Selecionando imagem 84

  $imgper84 = $per84['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp84 = $letraaper84['tipo'];

  

  

  //Questão 85

  $codper85 = $_SESSION['codper85'];

  $select_per85 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper85");

  $per85 = mysqli_fetch_assoc($select_per85);

  

  $select_letraaper85 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper85 and letra = 'a'");

  $letraaper85 = mysqli_fetch_assoc($select_letraaper85);

  $select_letrabper85 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper85 and letra = 'b'");

  $letrabper85 = mysqli_fetch_assoc($select_letrabper85);

  $select_letracper85 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper85 and letra = 'c'");

  $letracper85 = mysqli_fetch_assoc($select_letracper85);

  $select_letradper85 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper85 and letra = 'd'");

  $letradper85 = mysqli_fetch_assoc($select_letradper85);

  $select_letraeper85 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper85 and letra = 'e'");

  $letraeper85 = mysqli_fetch_assoc($select_letraeper85);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper85["correta"]==1){

  $alt_corr85 = "Letra A";

  $cora85 = $corcorr;
  $sima85 = " ✓";

  $corb85 = "black";
  $simb85 = "";

  $corc85 = "black";
  $simc85 = "";

  $cord85 = "black";
  $simd85 = "";

  $core85 = "black";
  $sime85 = "";

}

elseif ($letrabper85["correta"]==1){

  $alt_corr85 = "Letra B";

  $corb85 = $corcorr;
  $simb85 = " ✓";

  $cora85 = "black";
  $sima85 = "";

  $corc85 = "black";
  $simc85 = "";

  $cord85 = "black";
  $simd85 = "";

  $core85 = "black";
  $sime85 = "";

}

elseif ($letracper85["correta"]==1){

  $alt_corr85 = "Letra C";

  $corc85 = $corcorr;
  $simc85 = " ✓";

  $cora85 = "black";
  $sima85 = "";

  $corb85 = "black";
  $simb85 = "";

  $cord85 = "black";
  $simd85 = "";

  $core85 = "black";
  $sime85 = "";

}

elseif ($letradper85["correta"]==1){

  $alt_corr85 = "Letra D";

  $cord85 = $corcorr;
  $simd85 = " ✓";

  $cora85 = "black";
  $sima85 = "";

  $corc85 = "black";
  $simc85 = "";

  $corb85 = "black";
  $simb85 = "";

  $core85 = "black";
  $sime85 = "";

}

elseif ($letraeper85["correta"]==1){

  $alt_corr85 = "Letra E";

  $core85 = $corcorr;
  $sime85 = " ✓";

  $cora85 = "black";
  $sima85 = "";

  $corc85 = "black";
  $simc85 = "";

  $cord85 = "black";
  $simd85 = "";

  $corb85 = "black";
  $simb85 = "";

}

//Errada

if ($alt_corr85 != $_POST['radper85'] && $_POST['radper85'] == "Letra A"){

  $cora85 = $corerr;
  $sima85 = " X";

}

elseif ($alt_corr85 != $_POST['radper85'] && $_POST['radper85'] == "Letra B"){

  $corb85 = $corerr;
  $simb85 = " X";

}

elseif ($alt_corr85 != $_POST['radper85'] && $_POST['radper85'] == "Letra C"){

  $corc85 = $corerr;
  $simc85 = " X";

}

elseif ($alt_corr85 != $_POST['radper85'] && $_POST['radper85'] == "Letra D"){

  $cord85 = $corerr;
  $simd85 = " X";

}

elseif ($alt_corr85 != $_POST['radper85'] && $_POST['radper85'] == "Letra E"){

  $core85 = $corerr;
  $sime85 = " X";

}

  

  // Verficando qual será checado 85

  if ($_POST['radper85'] == "Letra A"){

    $chea85 = "Checked";

    $cheb85 = "";

    $chec85 = "";

    $ched85 = "";

    $chee85 = "";

  }elseif ($_POST['radper85'] == "Letra B"){

    $chea85 = "";

    $cheb85 = "Checked";

    $chec85 = "";

    $ched85 = "";

    $chee85 = "";

  }elseif ($_POST['radper85'] == "Letra C"){

    $chea85 = "";

    $cheb85 = "";

    $chec85 = "Checked";

    $ched85 = "";

    $chee85 = "";

  }elseif ($_POST['radper85'] == "Letra D"){

    $chea85 = "";

    $cheb85 = "";

    $chec85 = "";

    $ched85 = "Checked";

    $chee85 = "";

  }elseif ($_POST['radper85'] == "Letra E"){

    $chea85 = "";

    $cheb85 = "";

    $chec85 = "";

    $ched85 = "";

    $chee85 = "Checked";

  }

  

  // Verificando se respsota esta correta 85

  if ($_POST['radper85'] == $alt_corr85){

    $contrescorr = $contrescorr + 1;

    $cer_err85 = 1;

}

else{

  $cer_err85 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 85

if ($_POST['radper85'] == "Letra A"){

  $codigo_resposta85 = $letraaper85['codigo_resposta'];

}elseif ($_POST['radper85'] == "Letra B"){

  $codigo_resposta85 = $letrabper85['codigo_resposta'];

}elseif ($_POST['radper85'] == "Letra C"){

  $codigo_resposta85 = $letracper85['codigo_resposta'];

}elseif ($_POST['radper85'] == "Letra D"){

  $codigo_resposta85 = $letradper85['codigo_resposta'];

}elseif ($_POST['radper85'] == "Letra E"){

  $codigo_resposta85 = $letraeper85['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 85

$codigo_disciplina85 = $per85['codigo_disciplina'];

  

  // Selecionando imagem 85

  $imgper85 = $per85['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp85 = $letraaper85['tipo'];

  

  }





  // Verificando se existe perguntas de 86 à 90

if ($qtperguntas>85){



  //Questão 86

  $codper86 = $_SESSION['codper86'];

  $select_per86 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper86");

  $per86 = mysqli_fetch_assoc($select_per86);

  

  $select_letraaper86 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper86 and letra = 'a'");

  $letraaper86 = mysqli_fetch_assoc($select_letraaper86);

  $select_letrabper86 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper86 and letra = 'b'");

  $letrabper86 = mysqli_fetch_assoc($select_letrabper86);

  $select_letracper86 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper86 and letra = 'c'");

  $letracper86 = mysqli_fetch_assoc($select_letracper86);

  $select_letradper86 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper86 and letra = 'd'");

  $letradper86 = mysqli_fetch_assoc($select_letradper86);

  $select_letraeper86 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper86 and letra = 'e'");

  $letraeper86 = mysqli_fetch_assoc($select_letraeper86);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper86["correta"]==1){

  $alt_corr86 = "Letra A";

  $cora86 = $corcorr;
  $sima86 = " ✓";

  $corb86 = "black";
  $simb86 = "";

  $corc86 = "black";
  $simc86 = "";

  $cord86 = "black";
  $simd86 = "";

  $core86 = "black";
  $sime86 = "";

}

elseif ($letrabper86["correta"]==1){

  $alt_corr86 = "Letra B";

  $corb86 = $corcorr;
  $simb86 = " ✓";

  $cora86 = "black";
  $sima86 = "";

  $corc86 = "black";
  $simc86 = "";

  $cord86 = "black";
  $simd86 = "";

  $core86 = "black";
  $sime86 = "";

}

elseif ($letracper86["correta"]==1){

  $alt_corr86 = "Letra C";

  $corc86 = $corcorr;
  $simc86 = " ✓";

  $cora86 = "black";
  $sima86 = "";

  $corb86 = "black";
  $simb86 = "";

  $cord86 = "black";
  $simd86 = "";

  $core86 = "black";
  $sime86 = "";

}

elseif ($letradper86["correta"]==1){

  $alt_corr86 = "Letra D";

  $cord86 = $corcorr;
  $simd86 = " ✓";

  $cora86 = "black";
  $sima86 = "";

  $corc86 = "black";
  $simc86 = "";

  $corb86 = "black";
  $simb86 = "";

  $core86 = "black";
  $sime86 = "";

}

elseif ($letraeper86["correta"]==1){

  $alt_corr86 = "Letra E";

  $core86 = $corcorr;
  $sime86 = " ✓";

  $cora86 = "black";
  $sima86 = "";

  $corc86 = "black";
  $simc86 = "";

  $cord86 = "black";
  $simd86 = "";

  $corb86 = "black";
  $simb86 = "";

}

//Errada

if ($alt_corr86 != $_POST['radper86'] && $_POST['radper86'] == "Letra A"){

  $cora86 = $corerr;
  $sima86 = " X";

}

elseif ($alt_corr86 != $_POST['radper86'] && $_POST['radper86'] == "Letra B"){

  $corb86 = $corerr;
  $simb86 = " X";

}

elseif ($alt_corr86 != $_POST['radper86'] && $_POST['radper86'] == "Letra C"){

  $corc86 = $corerr;
  $simc86 = " X";

}

elseif ($alt_corr86 != $_POST['radper86'] && $_POST['radper86'] == "Letra D"){

  $cord86 = $corerr;
  $simd86 = " X";

}

elseif ($alt_corr86 != $_POST['radper86'] && $_POST['radper86'] == "Letra E"){

  $core86 = $corerr;
  $sime86 = " X";

}

  

  // Verficando qual será checado 86

  if ($_POST['radper86'] == "Letra A"){

    $chea86 = "Checked";

    $cheb86 = "";

    $chec86 = "";

    $ched86 = "";

    $chee86 = "";

  }elseif ($_POST['radper86'] == "Letra B"){

    $chea86 = "";

    $cheb86 = "Checked";

    $chec86 = "";

    $ched86 = "";

    $chee86 = "";

  }elseif ($_POST['radper86'] == "Letra C"){

    $chea86 = "";

    $cheb86 = "";

    $chec86 = "Checked";

    $ched86 = "";

    $chee86 = "";

  }elseif ($_POST['radper86'] == "Letra D"){

    $chea86 = "";

    $cheb86 = "";

    $chec86 = "";

    $ched86 = "Checked";

    $chee86 = "";

  }elseif ($_POST['radper86'] == "Letra E"){

    $chea86 = "";

    $cheb86 = "";

    $chec86 = "";

    $ched86 = "";

    $chee86 = "Checked";

  }

  

  // Verificando se respsota esta correta 86

  if ($_POST['radper86'] == $alt_corr86){

    $contrescorr = $contrescorr + 1;

    $cer_err86 = 1;

}

else{

  $cer_err86 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 86

if ($_POST['radper86'] == "Letra A"){

  $codigo_resposta86 = $letraaper86['codigo_resposta'];

}elseif ($_POST['radper86'] == "Letra B"){

  $codigo_resposta86 = $letrabper86['codigo_resposta'];

}elseif ($_POST['radper86'] == "Letra C"){

  $codigo_resposta86 = $letracper86['codigo_resposta'];

}elseif ($_POST['radper86'] == "Letra D"){

  $codigo_resposta86 = $letradper86['codigo_resposta'];

}elseif ($_POST['radper86'] == "Letra E"){

  $codigo_resposta86 = $letraeper86['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 86

$codigo_disciplina86 = $per86['codigo_disciplina'];

  

  // Selecionando imagem 86

  $imgper86 = $per86['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp86 = $letraaper86['tipo'];

  

  

  //Questão 87

  $codper87 = $_SESSION['codper87'];

  $select_per87 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper87");

  $per87 = mysqli_fetch_assoc($select_per87);

  

  $select_letraaper87 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper87 and letra = 'a'");

  $letraaper87 = mysqli_fetch_assoc($select_letraaper87);

  $select_letrabper87 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper87 and letra = 'b'");

  $letrabper87 = mysqli_fetch_assoc($select_letrabper87);

  $select_letracper87 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper87 and letra = 'c'");

  $letracper87 = mysqli_fetch_assoc($select_letracper87);

  $select_letradper87 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper87 and letra = 'd'");

  $letradper87 = mysqli_fetch_assoc($select_letradper87);

  $select_letraeper87 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper87 and letra = 'e'");

  $letraeper87 = mysqli_fetch_assoc($select_letraeper87);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper87["correta"]==1){

  $alt_corr87 = "Letra A";

  $cora87 = $corcorr;
  $sima87 = " ✓";

  $corb87 = "black";
  $simb87 = "";

  $corc87 = "black";
  $simc87 = "";

  $cord87 = "black";
  $simd87 = "";

  $core87 = "black";
  $sime87 = "";

}

elseif ($letrabper87["correta"]==1){

  $alt_corr87 = "Letra B";

  $corb87 = $corcorr;
  $simb87 = " ✓";

  $cora87 = "black";
  $sima87 = "";

  $corc87 = "black";
  $simc87 = "";

  $cord87 = "black";
  $simd87 = "";

  $core87 = "black";
  $sime87 = "";

}

elseif ($letracper87["correta"]==1){

  $alt_corr87 = "Letra C";

  $corc87 = $corcorr;
  $simc87 = " ✓";

  $cora87 = "black";
  $sima87 = "";

  $corb87 = "black";
  $simb87 = "";

  $cord87 = "black";
  $simd87 = "";

  $core87 = "black";
  $sime87 = "";

}

elseif ($letradper87["correta"]==1){

  $alt_corr87 = "Letra D";

  $cord87 = $corcorr;
  $simd87 = " ✓";

  $cora87 = "black";
  $sima87 = "";

  $corc87 = "black";
  $simc87 = "";

  $corb87 = "black";
  $simb87 = "";

  $core87 = "black";
  $sime87 = "";

}

elseif ($letraeper87["correta"]==1){

  $alt_corr87 = "Letra E";

  $core87 = $corcorr;
  $sime87 = " ✓";

  $cora87 = "black";
  $sima87 = "";

  $corc87 = "black";
  $simc87 = "";

  $cord87 = "black";
  $simd87 = "";

  $corb87 = "black";
  $simb87 = "";

}

//Errada

if ($alt_corr87 != $_POST['radper87'] && $_POST['radper87'] == "Letra A"){

  $cora87 = $corerr;
  $sima87 = " X";

}

elseif ($alt_corr87 != $_POST['radper87'] && $_POST['radper87'] == "Letra B"){

  $corb87 = $corerr;
  $simb87 = " X";

}

elseif ($alt_corr87 != $_POST['radper87'] && $_POST['radper87'] == "Letra C"){

  $corc87 = $corerr;
  $simc87 = " X";

}

elseif ($alt_corr87 != $_POST['radper87'] && $_POST['radper87'] == "Letra D"){

  $cord87 = $corerr;
  $simd87 = " X";

}

elseif ($alt_corr87 != $_POST['radper87'] && $_POST['radper87'] == "Letra E"){

  $core87 = $corerr;
  $sime87 = " X";

}

  

  // Verficando qual será checado 87

  if ($_POST['radper87'] == "Letra A"){

    $chea87 = "Checked";

    $cheb87 = "";

    $chec87 = "";

    $ched87 = "";

    $chee87 = "";

  }elseif ($_POST['radper87'] == "Letra B"){

    $chea87 = "";

    $cheb87 = "Checked";

    $chec87 = "";

    $ched87 = "";

    $chee87 = "";

  }elseif ($_POST['radper87'] == "Letra C"){

    $chea87 = "";

    $cheb87 = "";

    $chec87 = "Checked";

    $ched87 = "";

    $chee87 = "";

  }elseif ($_POST['radper87'] == "Letra D"){

    $chea87 = "";

    $cheb87 = "";

    $chec87 = "";

    $ched87 = "Checked";

    $chee87 = "";

  }elseif ($_POST['radper87'] == "Letra E"){

    $chea87 = "";

    $cheb87 = "";

    $chec87 = "";

    $ched87 = "";

    $chee87 = "Checked";

  }

  

  // Verificando se respsota esta correta 87

  if ($_POST['radper87'] == $alt_corr87){

    $contrescorr = $contrescorr + 1;

    $cer_err87 = 1;

}

else{

  $cer_err87 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 87

if ($_POST['radper87'] == "Letra A"){

  $codigo_resposta87 = $letraaper87['codigo_resposta'];

}elseif ($_POST['radper87'] == "Letra B"){

  $codigo_resposta87 = $letrabper87['codigo_resposta'];

}elseif ($_POST['radper87'] == "Letra C"){

  $codigo_resposta87 = $letracper87['codigo_resposta'];

}elseif ($_POST['radper87'] == "Letra D"){

  $codigo_resposta87 = $letradper87['codigo_resposta'];

}elseif ($_POST['radper87'] == "Letra E"){

  $codigo_resposta87 = $letraeper87['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 87

$codigo_disciplina87 = $per87['codigo_disciplina'];

  

  // Selecionando imagem 87

  $imgper87 = $per87['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp87 = $letraaper87['tipo'];

  

  

  //Questão 88

  $codper88 = $_SESSION['codper88'];

  $select_per88 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper88");

  $per88 = mysqli_fetch_assoc($select_per88);

  

  $select_letraaper88 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper88 and letra = 'a'");

  $letraaper88 = mysqli_fetch_assoc($select_letraaper88);

  $select_letrabper88 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper88 and letra = 'b'");

  $letrabper88 = mysqli_fetch_assoc($select_letrabper88);

  $select_letracper88 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper88 and letra = 'c'");

  $letracper88 = mysqli_fetch_assoc($select_letracper88);

  $select_letradper88 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper88 and letra = 'd'");

  $letradper88 = mysqli_fetch_assoc($select_letradper88);

  $select_letraeper88 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper88 and letra = 'e'");

  $letraeper88 = mysqli_fetch_assoc($select_letraeper88);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper88["correta"]==1){

  $alt_corr88 = "Letra A";

  $cora88 = $corcorr;
  $sima88 = " ✓";

  $corb88 = "black";
  $simb88 = "";

  $corc88 = "black";
  $simc88 = "";

  $cord88 = "black";
  $simd88 = "";

  $core88 = "black";
  $sime88 = "";

}

elseif ($letrabper88["correta"]==1){

  $alt_corr88 = "Letra B";

  $corb88 = $corcorr;
  $simb88 = " ✓";

  $cora88 = "black";
  $sima88 = "";

  $corc88 = "black";
  $simc88 = "";

  $cord88 = "black";
  $simd88 = "";

  $core88 = "black";
  $sime88 = "";

}

elseif ($letracper88["correta"]==1){

  $alt_corr88 = "Letra C";

  $corc88 = $corcorr;
  $simc88 = " ✓";

  $cora88 = "black";
  $sima88 = "";

  $corb88 = "black";
  $simb88 = "";

  $cord88 = "black";
  $simd88 = "";

  $core88 = "black";
  $sime88 = "";

}

elseif ($letradper88["correta"]==1){

  $alt_corr88 = "Letra D";

  $cord88 = $corcorr;
  $simd88 = " ✓";

  $cora88 = "black";
  $sima88 = "";

  $corc88 = "black";
  $simc88 = "";

  $corb88 = "black";
  $simb88 = "";

  $core88 = "black";
  $sime88 = "";

}

elseif ($letraeper88["correta"]==1){

  $alt_corr88 = "Letra E";

  $core88 = $corcorr;
  $sime88 = " ✓";

  $cora88 = "black";
  $sima88 = "";

  $corc88 = "black";
  $simc88 = "";

  $cord88 = "black";
  $simd88 = "";

  $corb88 = "black";
  $simb88 = "";

}

//Errada

if ($alt_corr88 != $_POST['radper88'] && $_POST['radper88'] == "Letra A"){

  $cora88 = $corerr;
  $sima88 = " X";

}

elseif ($alt_corr88 != $_POST['radper88'] && $_POST['radper88'] == "Letra B"){

  $corb88 = $corerr;
  $simb88 = " X";

}

elseif ($alt_corr88 != $_POST['radper88'] && $_POST['radper88'] == "Letra C"){

  $corc88 = $corerr;
  $simc88 = " X";

}

elseif ($alt_corr88 != $_POST['radper88'] && $_POST['radper88'] == "Letra D"){

  $cord88 = $corerr;
  $simd88 = " X";

}

elseif ($alt_corr88 != $_POST['radper88'] && $_POST['radper88'] == "Letra E"){

  $core88 = $corerr;
  $sime88 = " X";

}

  

  // Verficando qual será checado 88

  if ($_POST['radper88'] == "Letra A"){

    $chea88 = "Checked";

    $cheb88 = "";

    $chec88 = "";

    $ched88 = "";

    $chee88 = "";

  }elseif ($_POST['radper88'] == "Letra B"){

    $chea88 = "";

    $cheb88 = "Checked";

    $chec88 = "";

    $ched88 = "";

    $chee88 = "";

  }elseif ($_POST['radper88'] == "Letra C"){

    $chea88 = "";

    $cheb88 = "";

    $chec88 = "Checked";

    $ched88 = "";

    $chee88 = "";

  }elseif ($_POST['radper88'] == "Letra D"){

    $chea88 = "";

    $cheb88 = "";

    $chec88 = "";

    $ched88 = "Checked";

    $chee88 = "";

  }elseif ($_POST['radper88'] == "Letra E"){

    $chea88 = "";

    $cheb88 = "";

    $chec88 = "";

    $ched88 = "";

    $chee88 = "Checked";

  }

  

  // Verificando se respsota esta correta 88

  if ($_POST['radper88'] == $alt_corr88){

    $contrescorr = $contrescorr + 1;

    $cer_err88 = 1;

}

else{

  $cer_err88 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 88

if ($_POST['radper88'] == "Letra A"){

  $codigo_resposta88 = $letraaper88['codigo_resposta'];

}elseif ($_POST['radper88'] == "Letra B"){

  $codigo_resposta88 = $letrabper88['codigo_resposta'];

}elseif ($_POST['radper88'] == "Letra C"){

  $codigo_resposta88 = $letracper88['codigo_resposta'];

}elseif ($_POST['radper88'] == "Letra D"){

  $codigo_resposta88 = $letradper88['codigo_resposta'];

}elseif ($_POST['radper88'] == "Letra E"){

  $codigo_resposta88 = $letraeper88['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 88

$codigo_disciplina88 = $per88['codigo_disciplina'];

  

  // Selecionando imagem 88

  $imgper88 = $per88['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp88 = $letraaper88['tipo'];

  

  

  //Questão 89

  $codper89 = $_SESSION['codper89'];

  $select_per89 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper89");

  $per89 = mysqli_fetch_assoc($select_per89);

  

  $select_letraaper89 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper89 and letra = 'a'");

  $letraaper89 = mysqli_fetch_assoc($select_letraaper89);

  $select_letrabper89 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper89 and letra = 'b'");

  $letrabper89 = mysqli_fetch_assoc($select_letrabper89);

  $select_letracper89 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper89 and letra = 'c'");

  $letracper89 = mysqli_fetch_assoc($select_letracper89);

  $select_letradper89 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper89 and letra = 'd'");

  $letradper89 = mysqli_fetch_assoc($select_letradper89);

  $select_letraeper89 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper89 and letra = 'e'");

  $letraeper89 = mysqli_fetch_assoc($select_letraeper89);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper89["correta"]==1){

  $alt_corr89 = "Letra A";

  $cora89 = $corcorr;
  $sima89 = " ✓";

  $corb89 = "black";
  $simb89 = "";

  $corc89 = "black";
  $simc89 = "";

  $cord89 = "black";
  $simd89 = "";

  $core89 = "black";
  $sime89 = "";

}

elseif ($letrabper89["correta"]==1){

  $alt_corr89 = "Letra B";

  $corb89 = $corcorr;
  $simb89 = " ✓";

  $cora89 = "black";
  $sima89 = "";

  $corc89 = "black";
  $simc89 = "";

  $cord89 = "black";
  $simd89 = "";

  $core89 = "black";
  $sime89 = "";

}

elseif ($letracper89["correta"]==1){

  $alt_corr89 = "Letra C";

  $corc89 = $corcorr;
  $simc89 = " ✓";

  $cora89 = "black";
  $sima89 = "";

  $corb89 = "black";
  $simb89 = "";

  $cord89 = "black";
  $simd89 = "";

  $core89 = "black";
  $sime89 = "";

}

elseif ($letradper89["correta"]==1){

  $alt_corr89 = "Letra D";

  $cord89 = $corcorr;
  $simd89 = " ✓";

  $cora89 = "black";
  $sima89 = "";

  $corc89 = "black";
  $simc89 = "";

  $corb89 = "black";
  $simb89 = "";

  $core89 = "black";
  $sime89 = "";

}

elseif ($letraeper89["correta"]==1){

  $alt_corr89 = "Letra E";

  $core89 = $corcorr;
  $sime89 = " ✓";

  $cora89 = "black";
  $sima89 = "";

  $corc89 = "black";
  $simc89 = "";

  $cord89 = "black";
  $simd89 = "";

  $corb89 = "black";
  $simb89 = "";

}

//Errada

if ($alt_corr89 != $_POST['radper89'] && $_POST['radper89'] == "Letra A"){

  $cora89 = $corerr;
  $sima89 = " X";

}

elseif ($alt_corr89 != $_POST['radper89'] && $_POST['radper89'] == "Letra B"){

  $corb89 = $corerr;
  $simb89 = " X";

}

elseif ($alt_corr89 != $_POST['radper89'] && $_POST['radper89'] == "Letra C"){

  $corc89 = $corerr;
  $simc89 = " X";

}

elseif ($alt_corr89 != $_POST['radper89'] && $_POST['radper89'] == "Letra D"){

  $cord89 = $corerr;
  $simd89 = " X";

}

elseif ($alt_corr89 != $_POST['radper89'] && $_POST['radper89'] == "Letra E"){

  $core89 = $corerr;
  $sime89 = " X";

}

  

  // Verficando qual será checado 89

  if ($_POST['radper89'] == "Letra A"){

    $chea89 = "Checked";

    $cheb89 = "";

    $chec89 = "";

    $ched89 = "";

    $chee89 = "";

  }elseif ($_POST['radper89'] == "Letra B"){

    $chea89 = "";

    $cheb89 = "Checked";

    $chec89 = "";

    $ched89 = "";

    $chee89 = "";

  }elseif ($_POST['radper89'] == "Letra C"){

    $chea89 = "";

    $cheb89 = "";

    $chec89 = "Checked";

    $ched89 = "";

    $chee89 = "";

  }elseif ($_POST['radper89'] == "Letra D"){

    $chea89 = "";

    $cheb89 = "";

    $chec89 = "";

    $ched89 = "Checked";

    $chee89 = "";

  }elseif ($_POST['radper89'] == "Letra E"){

    $chea89 = "";

    $cheb89 = "";

    $chec89 = "";

    $ched89 = "";

    $chee89 = "Checked";

  }

  

  // Verificando se respsota esta correta 89

  if ($_POST['radper89'] == $alt_corr89){

    $contrescorr = $contrescorr + 1;

    $cer_err89 = 1;

}

else{

  $cer_err89 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 89

if ($_POST['radper89'] == "Letra A"){

  $codigo_resposta89 = $letraaper89['codigo_resposta'];

}elseif ($_POST['radper89'] == "Letra B"){

  $codigo_resposta89 = $letrabper89['codigo_resposta'];

}elseif ($_POST['radper89'] == "Letra C"){

  $codigo_resposta89 = $letracper89['codigo_resposta'];

}elseif ($_POST['radper89'] == "Letra D"){

  $codigo_resposta89 = $letradper89['codigo_resposta'];

}elseif ($_POST['radper89'] == "Letra E"){

  $codigo_resposta89 = $letraeper89['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 89

$codigo_disciplina89 = $per89['codigo_disciplina'];

  

  // Selecionando imagem 89

  $imgper89 = $per89['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp89 = $letraaper89['tipo'];

  

  

  //Questão 90

  $codper90 = $_SESSION['codper90'];

  $select_per90 = mysqli_query($conexao, "SELECT * from tabela_pergunta where codigo_pergunta = $codper90");

  $per90 = mysqli_fetch_assoc($select_per90);

  

  $select_letraaper90 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper90 and letra = 'a'");

  $letraaper90 = mysqli_fetch_assoc($select_letraaper90);

  $select_letrabper90 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper90 and letra = 'b'");

  $letrabper90 = mysqli_fetch_assoc($select_letrabper90);

  $select_letracper90 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper90 and letra = 'c'");

  $letracper90 = mysqli_fetch_assoc($select_letracper90);

  $select_letradper90 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper90 and letra = 'd'");

  $letradper90 = mysqli_fetch_assoc($select_letradper90);

  $select_letraeper90 = mysqli_query($conexao, "SELECT * from tabela_resposta where codigo_pergunta = $codper90 and letra = 'e'");

  $letraeper90 = mysqli_fetch_assoc($select_letraeper90);

  

  // Selecionando alternativa correta 2 suas cores

  // Correta

if ($letraaper90["correta"]==1){

  $alt_corr90 = "Letra A";

  $cora90 = $corcorr;
  $sima90 = " ✓";

  $corb90 = "black";
  $simb90 = "";

  $corc90 = "black";
  $simc90 = "";

  $cord90 = "black";
  $simd90 = "";

  $core90 = "black";
  $sime90 = "";

}

elseif ($letrabper90["correta"]==1){

  $alt_corr90 = "Letra B";

  $corb90 = $corcorr;
  $simb90 = " ✓";

  $cora90 = "black";
  $sima90 = "";

  $corc90 = "black";
  $simc90 = "";

  $cord90 = "black";
  $simd90 = "";

  $core90 = "black";
  $sime90 = "";

}

elseif ($letracper90["correta"]==1){

  $alt_corr90 = "Letra C";

  $corc90 = $corcorr;
  $simc90 = " ✓";

  $cora90 = "black";
  $sima90 = "";

  $corb90 = "black";
  $simb90 = "";

  $cord90 = "black";
  $simd90 = "";

  $core90 = "black";
  $sime90 = "";

}

elseif ($letradper90["correta"]==1){

  $alt_corr90 = "Letra D";

  $cord90 = $corcorr;
  $simd90 = " ✓";

  $cora90 = "black";
  $sima90 = "";

  $corc90 = "black";
  $simc90 = "";

  $corb90 = "black";
  $simb90 = "";

  $core90 = "black";
  $sime90 = "";

}

elseif ($letraeper90["correta"]==1){

  $alt_corr90 = "Letra E";

  $core90 = $corcorr;
  $sime90 = " ✓";

  $cora90 = "black";
  $sima90 = "";

  $corc90 = "black";
  $simc90 = "";

  $cord90 = "black";
  $simd90 = "";

  $corb90 = "black";
  $simb90 = "";

}

//Errada

if ($alt_corr90 != $_POST['radper90'] && $_POST['radper90'] == "Letra A"){

  $cora90 = $corerr;
  $sima90 = " X";

}

elseif ($alt_corr90 != $_POST['radper90'] && $_POST['radper90'] == "Letra B"){

  $corb90 = $corerr;
  $simb90 = " X";

}

elseif ($alt_corr90 != $_POST['radper90'] && $_POST['radper90'] == "Letra C"){

  $corc90 = $corerr;
  $simc90 = " X";

}

elseif ($alt_corr90 != $_POST['radper90'] && $_POST['radper90'] == "Letra D"){

  $cord90 = $corerr;
  $simd90 = " X";

}

elseif ($alt_corr90 != $_POST['radper90'] && $_POST['radper90'] == "Letra E"){

  $core90 = $corerr;
  $sime90 = " X";

}

  

  // Verficando qual será checado 90

  if ($_POST['radper90'] == "Letra A"){

    $chea90 = "Checked";

    $cheb90 = "";

    $chec90 = "";

    $ched90 = "";

    $chee90 = "";

  }elseif ($_POST['radper90'] == "Letra B"){

    $chea90 = "";

    $cheb90 = "Checked";

    $chec90 = "";

    $ched90 = "";

    $chee90 = "";

  }elseif ($_POST['radper90'] == "Letra C"){

    $chea90 = "";

    $cheb90 = "";

    $chec90 = "Checked";

    $ched90 = "";

    $chee90 = "";

  }elseif ($_POST['radper90'] == "Letra D"){

    $chea90 = "";

    $cheb90 = "";

    $chec90 = "";

    $ched90 = "Checked";

    $chee90 = "";

  }elseif ($_POST['radper90'] == "Letra E"){

    $chea90 = "";

    $cheb90 = "";

    $chec90 = "";

    $ched90 = "";

    $chee90 = "Checked";

  }

  

  // Verificando se respsota esta correta 90

  if ($_POST['radper90'] == $alt_corr90){

    $contrescorr = $contrescorr + 1;

    $cer_err90 = 1;

}

else{

  $cer_err90 = 0;

}



  // Verificando qual é o codigo da resposta escolhida -- Per 90

if ($_POST['radper90'] == "Letra A"){

  $codigo_resposta90 = $letraaper90['codigo_resposta'];

}elseif ($_POST['radper90'] == "Letra B"){

  $codigo_resposta90 = $letrabper90['codigo_resposta'];

}elseif ($_POST['radper90'] == "Letra C"){

  $codigo_resposta90 = $letracper90['codigo_resposta'];

}elseif ($_POST['radper90'] == "Letra D"){

  $codigo_resposta90 = $letradper90['codigo_resposta'];

}elseif ($_POST['radper90'] == "Letra E"){

  $codigo_resposta90 = $letraeper90['codigo_resposta'];

}



// obtendo o codigo da disciplina da pergunta 90

$codigo_disciplina90 = $per90['codigo_disciplina'];

  

  // Selecionando imagem 90

  $imgper90 = $per90['imagem'];

  

  // Verificando sea resposta é do tipo imagem ou texto

  $tipoimgp90 = $letraaper90['tipo'];

  

  }



// Calculando a porcentagem de acerto 

$poracerto = (100 * $contrescorr) / $qtperguntas;



// Calculando a quantidade de pontos

$pontos = $contrescorr * 6;



// Destruindo sessão para resetar os dados da prova

session_destroy();

?>



<!-- Iniciando o corpo da página -->

<!DOCTYPE HTML>

<html>



<!-- Definindo caracteristicas basicas para a pagina -->

<meta charset="UTF-8">

<title>Resultados do Simulado</title>



<!-- Colocando ícone na página -->

<link rel="icon" type="image/png" href="img/img_icone1.png"/>



<!-- Iniciando java -->

<script>



// Função para abrir a pagina alterar dados

function simucom() {

      location.href='gerar_simucom.php';

}



// Função para abrir a pagina alterar dados

function simusim() {

      location.href='gerar_simusim.php';

}



// Função para voltar à pagina index

function voltar() {

      location.href='index.php';

}



// Função para voltar à pagina cadastrar

function cadastrar() {

      location.href='pagina_inscrever-se.php';

}



// Função para voltar à pagina login

function login() {

      location.href='login.php';

}



</script>



<!-- link para icones -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">



<!-- abrindo o cabeçalho -->



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

        <h1><a href="#intro" class="scrollto">DSENEM</a></h1>

        <!-- Uncomment below if you prefer to use an image logo -->

        <!-- <a href="#intro"><img src="img/logo.png" alt="" title="" /></a>-->

      </div>



      <nav id="nav-menu-container">

        <ul class="nav-menu">

        <li class="menu-has-children"><a >Simulados</a>

            <ul>

            <li><a onclick="simucom()">Completo</a></li>

              <li><a onclick="simusim()">Personalizados</a></li>

            </ul>

          </li>



          

          <li><a onclick="voltar()">Voltar</a></li>

          <li><a onclick="cadastrar()">Cadastrar-se</a></li>

          <li class="menu-active"><a onclick="login()">Entrar</a></li>

          <li class="menu-active"><i class="bi bi-person-circle" title='Entrar' height ='30px' width='30px' onclick="login()"></i></li>

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

<br><br><br><br><br><br><br><br>



<!-- Colocando os campos para a exibição de dados -->

<body>



<!-- Caixa em volta do form -->

<font color="black" size="3">

<div class="box">



<!-- Borda do form -->

<form action="resultados_simusimcad.php" method="POST"> 

<fieldset> 

	

<!-- Legenda do form -->

<legend style="color:grey31; font-size:25px; font-weight: bold;">Resultados</legend>

<br>



<!-- Mostrabdo a quantidade de respostas corretas -->

<label for="">Acertos: <?php echo $contrescorr . " de " . $qtperguntas; ?></label>

<br><br>



<!-- Mostrando a porcentagem de acerto -->

<label for="">Pontuação: <?php echo $pontos . " pontos"; ?></label>

<br><br>



<!-- Mostrando a porcentagem de acerto -->

<label for="">Precisão: <?php echo number_format($poracerto, 2, ",", ".") . "%"; ?></label>

<br><br>



<!-- Mostrando a porcentagem de acerto -->

<label for="">Tempo decorrido: <?php printf('%02d:%02d:%02d', $nHoras, $nMinutos, $nSegundos); ?></label>

<br><br>



<!-- Mostrando a porcentagem de acerto -->

<label for="">Média de tempo por pergunta: <?php echo number_format($media_por_pergunta, 2, ",", ".") . " minutos"; ?></label>

<br><br>



<!-- Inserindo qustão 1 -->

<b>Questão 1:</b>

<br><br>

<?php print "<p>".nl2br($per1['pergunta'])."</p>"; ?>

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

echo "<input type='radio' name='radper1' $chea1 disabled id='radper1' value='Letra A'>";

echo "<label><font color='".$cora1."'>A) ".$letraaper1['alternativa'].$sima1."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' $cheb1 disabled id='radper1' value='Letra B'>";

echo "<label><font color='".$corb1."'>B) ".$letrabper1['alternativa'].$simb1."</font>";

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' $chec1 disabled id='radper1' value='Letra C'>";

echo "<label><font color='".$corc1."'>C) ".$letracper1['alternativa'].$simc1."</font>";

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' $ched1 disabled id='radper1' value='Letra D'>";

echo "<label><font color='".$cord1."'>D) ".$letradper1['alternativa'].$simd1."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' $chee1 disabled id='radper1' value='Letra E'>";

echo "<label><font color='".$core1."'>E) ".$letraeper1['alternativa'].$sime1."</font>"; 

echo "</label>";

echo "<br><br><br>";

}

else{

$imgletap1 = $letraaper1['alternativa'];

$imgletbp1 = $letrabper1['alternativa'];

$imgletcp1 = $letracper1['alternativa'];

$imgletdp1 = $letradper1['alternativa'];

$imgletep1 = $letraeper1['alternativa'];



echo "<input type='radio' name='radper1' disabled id='radper1' value='Letra A' $chea1>";

echo "<label>A) <br> <img src='img_res/$imgletap1' width='300'><font color='".$cora1."'>".$sima1."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' disabled id='radper1' value='Letra B' $cheb1>";

echo "<label>B) <br> <img src='img_res/$imgletbp1' width='300'><font color='".$corb1."'>".$simb1."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' disabled id='radper1' value='Letra C' $chec1>";

echo "<label>C) <br> <img src='img_res/$imgletcp1' width='300'><font color='".$corc1."'>".$simc1."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' disabled id='radper1' value='Letra D' $ched1>";

echo "<label>D) <br> <img src='img_res/$imgletdp1' width='300'><font color='".$cord1."'>".$simd1."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper1' disabled id='radper1' value='Letra E' $chee1>";

echo "<label>E) <br> <img src='img_res/$imgletep1' width='300'><font color='".$core1."'>".$sime1."</font>"; 

echo "</label>";

echo "<br><br><br>";

}

?>





<!-- Inserindo qustão 2 -->

<b>Questão 2:</b>

<br><br>

<?php print "<p>".nl2br($per2['pergunta'])."</p>"; ?>

<br><br><br>



<!-- Verificando caracteristicas da questão 2 -->

<?php 



// Se possui imagem

if ($imgper2 != "Não possui"){

    echo "<img src='uploads/$imgper2' width='500'>";

    echo "<br><br><br>";

}

else{



}



// O tipo de resposta

if ($tipoimgp2 == 0) {

  echo "<input type='radio' name='radper2' $chea2 disabled id='radper2' value='Letra A'>";

  echo "<label><font color='".$cora2."'>A) ".$letraaper2['alternativa'].$sima2."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper2' $cheb2 disabled id='radper2' value='Letra B'>";
  
  echo "<label><font color='".$corb2."'>B) ".$letrabper2['alternativa'].$simb2."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper2' $chec2 disabled id='radper2' value='Letra C'>";
  
  echo "<label><font color='".$corc2."'>C) ".$letracper2['alternativa'].$simc2."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper2' $ched2 disabled id='radper2' value='Letra D'>";
  
  echo "<label><font color='".$cord2."'>D) ".$letradper2['alternativa'].$simd2."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper2' $chee2 disabled id='radper2' value='Letra E'>";
  
  echo "<label><font color='".$core2."'>E) ".$letraeper2['alternativa'].$sime2."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

}

else{

$imgletap2 = $letraaper2['alternativa'];

$imgletbp2 = $letrabper2['alternativa'];

$imgletcp2 = $letracper2['alternativa'];

$imgletdp2 = $letradper2['alternativa'];

$imgletep2 = $letraeper2['alternativa'];



echo "<input type='radio' name='radper2' disabled id='radper2' value='Letra A' $chea2>";

echo "<label>A) <br> <img src='img_res/$imgletap2' width='300'><font color='".$cora2."'>".$sima2."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper2' disabled id='radper2' value='Letra B' $cheb2>";

echo "<label>B) <br> <img src='img_res/$imgletbp2' width='300'><font color='".$corb2."'>".$simb2."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper2' disabled id='radper2' value='Letra C' $chec2>";

echo "<label>C) <br> <img src='img_res/$imgletcp2' width='300'><font color='".$corc2."'>".$simc2."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper2' disabled id='radper2' value='Letra D' $ched2>";

echo "<label>D) <br> <img src='img_res/$imgletdp2' width='300'><font color='".$cord2."'>".$simd2."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper2' disabled id='radper2' value='Letra E' $chee2>";

echo "<label>E) <br> <img src='img_res/$imgletep2' width='300'><font color='".$core2."'>".$sime2."</font>"; 

echo "</label>";

echo "<br><br><br>";

}

?>





<!-- Inserindo qustão 3 -->

<b>Questão 3:</b>

<br><br>

<?php print "<p>".nl2br($per3['pergunta'])."</p>"; ?>

<br><br><br>



<!-- Verificando caracteristicas da questão 3 -->

<?php 



// Se possui imagem

if ($imgper3 != "Não possui"){

    echo "<img src='uploads/$imgper3' width='500'>";

    echo "<br><br><br>";

}

else{



}



// O tipo de resposta

if ($tipoimgp3 == 0) {

  echo "<input type='radio' name='radper3' $chea3 disabled id='radper3' value='Letra A'>";

  echo "<label><font color='".$cora3."'>A) ".$letraaper3['alternativa'].$sima3."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper3' $cheb3 disabled id='radper3' value='Letra B'>";
  
  echo "<label><font color='".$corb3."'>B) ".$letrabper3['alternativa'].$simb3."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper3' $chec3 disabled id='radper3' value='Letra C'>";
  
  echo "<label><font color='".$corc3."'>C) ".$letracper3['alternativa'].$simc3."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper3' $ched3 disabled id='radper3' value='Letra D'>";
  
  echo "<label><font color='".$cord3."'>D) ".$letradper3['alternativa'].$simd3."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper3' $chee3 disabled id='radper3' value='Letra E'>";
  
  echo "<label><font color='".$core3."'>E) ".$letraeper3['alternativa'].$sime3."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

}

else{

$imgletap3 = $letraaper3['alternativa'];

$imgletbp3 = $letrabper3['alternativa'];

$imgletcp3 = $letracper3['alternativa'];

$imgletdp3 = $letradper3['alternativa'];

$imgletep3 = $letraeper3['alternativa'];



echo "<input type='radio' name='radper3' disabled id='radper3' value='Letra A' $chea3>";

echo "<label>A) <br> <img src='img_res/$imgletap3' width='300'><font color='".$cora3."'>".$sima3."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper3' disabled id='radper3' value='Letra B' $cheb3>";

echo "<label>B) <br> <img src='img_res/$imgletbp3' width='300'><font color='".$corb3."'>".$simb3."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper3' disabled id='radper3' value='Letra C' $chec3>";

echo "<label>C) <br> <img src='img_res/$imgletcp3' width='300'><font color='".$corc3."'>".$simc3."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper3' disabled id='radper3' value='Letra D' $ched3>";

echo "<label>D) <br> <img src='img_res/$imgletdp3' width='300'><font color='".$cord3."'>".$simd3."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper3' disabled id='radper3' value='Letra E' $chee3>";

echo "<label>E) <br> <img src='img_res/$imgletep3' width='300'><font color='".$core3."'>".$sime3."</font>"; 

echo "</label>";

echo "<br><br><br>";

}

?>





<!-- Inserindo qustão 4 -->

<b>Questão 4:</b>

<br><br>

<?php print "<p>".nl2br($per4['pergunta'])."</p>"; ?>

<br><br><br>



<!-- Verificando caracteristicas da questão 4 -->

<?php 



// Se possui imagem

if ($imgper4 != "Não possui"){

    echo "<img src='uploads/$imgper4' width='500'>";

    echo "<br><br><br>";

}

else{



}



// O tipo de resposta

if ($tipoimgp4 == 0) {

  echo "<input type='radio' name='radper4' $chea4 disabled id='radper4' value='Letra A'>";

  echo "<label><font color='".$cora4."'>A) ".$letraaper4['alternativa'].$sima4."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper4' $cheb4 disabled id='radper4' value='Letra B'>";
  
  echo "<label><font color='".$corb4."'>B) ".$letrabper4['alternativa'].$simb4."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper4' $chec4 disabled id='radper4' value='Letra C'>";
  
  echo "<label><font color='".$corc4."'>C) ".$letracper4['alternativa'].$simc4."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper4' $ched4 disabled id='radper4' value='Letra D'>";
  
  echo "<label><font color='".$cord4."'>D) ".$letradper4['alternativa'].$simd4."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper4' $chee4 disabled id='radper4' value='Letra E'>";
  
  echo "<label><font color='".$core4."'>E) ".$letraeper4['alternativa'].$sime4."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

}

else{

$imgletap4 = $letraaper4['alternativa'];

$imgletbp4 = $letrabper4['alternativa'];

$imgletcp4 = $letracper4['alternativa'];

$imgletdp4 = $letradper4['alternativa'];

$imgletep4 = $letraeper4['alternativa'];



echo "<input type='radio' name='radper4' disabled id='radper4' value='Letra A' $chea4>";

echo "<label>A) <br> <img src='img_res/$imgletap4' width='300'><font color='".$cora4."'>".$sima4."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper4' disabled id='radper4' value='Letra B' $cheb4>";

echo "<label>B) <br> <img src='img_res/$imgletbp4' width='300'><font color='".$corb4."'>".$simb4."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper4' disabled id='radper4' value='Letra C' $chec4>";

echo "<label>C) <br> <img src='img_res/$imgletcp4' width='300'><font color='".$corc4."'>".$simc4."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper4' disabled id='radper4' value='Letra D' $ched4>";

echo "<label>D) <br> <img src='img_res/$imgletdp4' width='300'><font color='".$cord4."'>".$simd4."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper4' disabled id='radper4' value='Letra E' $chee4>";

echo "<label>E) <br> <img src='img_res/$imgletep4' width='300'><font color='".$core4."'>".$sime4."</font>"; 

echo "</label>";

echo "<br><br><br>";

}

?>





<!-- Inserindo qustão 5 -->

<b>Questão 5:</b>

<br><br>

<?php print "<p>".nl2br($per5['pergunta'])."</p>"; ?>

<br><br><br>



<!-- Verificando caracteristicas da questão 5 -->

<?php 



// Se possui imagem

if ($imgper5 != "Não possui"){

    echo "<img src='uploads/$imgper5' width='500'>";

    echo "<br><br><br>";

}

else{



}



// O tipo de resposta

if ($tipoimgp5 == 0) {

  echo "<input type='radio' name='radper5' $chea5 disabled id='radper5' value='Letra A'>";

  echo "<label><font color='".$cora5."'>A) ".$letraaper5['alternativa'].$sima5."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper5' $cheb5 disabled id='radper5' value='Letra B'>";
  
  echo "<label><font color='".$corb5."'>B) ".$letrabper5['alternativa'].$simb5."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper5' $chec5 disabled id='radper5' value='Letra C'>";
  
  echo "<label><font color='".$corc5."'>C) ".$letracper5['alternativa'].$simc5."</font>";
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper5' $ched5 disabled id='radper5' value='Letra D'>";
  
  echo "<label><font color='".$cord5."'>D) ".$letradper5['alternativa'].$simd5."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper5' $chee5 disabled id='radper5' value='Letra E'>";
  
  echo "<label><font color='".$core5."'>E) ".$letraeper5['alternativa'].$sime5."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

}

else{

$imgletap5 = $letraaper5['alternativa'];

$imgletbp5 = $letrabper5['alternativa'];

$imgletcp5 = $letracper5['alternativa'];

$imgletdp5 = $letradper5['alternativa'];

$imgletep5 = $letraeper5['alternativa'];



echo "<input type='radio' name='radper5' disabled id='radper5' value='Letra A' $chea5>";

echo "<label>A) <br> <img src='img_res/$imgletap5' width='300'><font color='".$cora5."'>".$sima5."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper5' disabled id='radper5' value='Letra B' $cheb5>";

echo "<label>B) <br> <img src='img_res/$imgletbp5' width='300'><font color='".$corb5."'>".$simb5."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper5' disabled id='radper5' value='Letra C' $chec5>";

echo "<label>C) <br> <img src='img_res/$imgletcp5' width='300'><font color='".$corc5."'>".$simc5."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper5' disabled id='radper5' value='Letra D' $ched5>";

echo "<label>D) <br> <img src='img_res/$imgletdp5' width='300'><font color='".$cord5."'>".$simd5."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper5' disabled id='radper5' value='Letra E' $chee5>";

echo "<label>E) <br> <img src='img_res/$imgletep5' width='300'><font color='".$core5."'>".$sime5."</font>"; 

echo "</label>";

echo "<br><br><br>";

}

?>





<!-- Verificando se existe a quetão de 6 à 10 -->

<?php 

if ($qtperguntas>5){

  // Inserindo quetão 6

  echo "<b>Questão 6:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per6['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper6 != "Não possui"){

      echo "<img src='uploads/$imgper6' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp6 == 0) {

    echo "<input type='radio' name='radper6' $chea6 disabled id='radper6' value='Letra A'>";

    echo "<label><font color='".$cora6."'>A) ".$letraaper6['alternativa'].$sima6."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper6' $cheb6 disabled id='radper6' value='Letra B'>";
    
    echo "<label><font color='".$corb6."'>B) ".$letrabper6['alternativa'].$simb6."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper6' $chec6 disabled id='radper6' value='Letra C'>";
    
    echo "<label><font color='".$corc6."'>C) ".$letracper6['alternativa'].$simc6."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper6' $ched6 disabled id='radper6' value='Letra D'>";
    
    echo "<label><font color='".$cord6."'>D) ".$letradper6['alternativa'].$simd6."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper6' $chee6 disabled id='radper6' value='Letra E'>";
    
    echo "<label><font color='".$core6."'>E) ".$letraeper6['alternativa'].$sime6."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap6 = $letraaper6['alternativa'];

  $imgletbp6 = $letrabper6['alternativa'];

  $imgletcp6 = $letracper6['alternativa'];

  $imgletdp6 = $letradper6['alternativa'];

  $imgletep6 = $letraeper6['alternativa'];

  

  echo "<input type='radio' name='radper6' disabled id='radper6' value='Letra A' $chea6>";

  echo "<label>A) <br> <img src='img_res/$imgletap6' width='300'><font color='".$cora6."'>".$sima6."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper6' disabled id='radper6' value='Letra B' $cheb6>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp6' width='300'><font color='".$corb6."'>".$simb6."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper6' disabled id='radper6' value='Letra C' $chec6>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp6' width='300'><font color='".$corc6."'>".$simc6."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper6' disabled id='radper6' value='Letra D' $ched6>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp6' width='300'><font color='".$cord6."'>".$simd6."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper6' disabled id='radper6' value='Letra E' $chee6>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep6' width='300'><font color='".$core6."'>".$sime6."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 7

  echo "<b>Questão 7:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per7['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper7 != "Não possui"){

      echo "<img src='uploads/$imgper7' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp7 == 0) {

    echo "<input type='radio' name='radper7' $chea7 disabled id='radper7' value='Letra A'>";

    echo "<label><font color='".$cora7."'>A) ".$letraaper7['alternativa'].$sima7."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper7' $cheb7 disabled id='radper7' value='Letra B'>";
    
    echo "<label><font color='".$corb7."'>B) ".$letrabper7['alternativa'].$simb7."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper7' $chec7 disabled id='radper7' value='Letra C'>";
    
    echo "<label><font color='".$corc7."'>C) ".$letracper7['alternativa'].$simc7."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper7' $ched7 disabled id='radper7' value='Letra D'>";
    
    echo "<label><font color='".$cord7."'>D) ".$letradper7['alternativa'].$simd7."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper7' $chee7 disabled id='radper7' value='Letra E'>";
    
    echo "<label><font color='".$core7."'>E) ".$letraeper7['alternativa'].$sime7."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap7 = $letraaper7['alternativa'];

  $imgletbp7 = $letrabper7['alternativa'];

  $imgletcp7 = $letracper7['alternativa'];

  $imgletdp7 = $letradper7['alternativa'];

  $imgletep7 = $letraeper7['alternativa'];

  

  echo "<input type='radio' name='radper7' disabled id='radper7' value='Letra A' $chea7>";

  echo "<label>A) <br> <img src='img_res/$imgletap7' width='300'><font color='".$cora7."'>".$sima7."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper7' disabled id='radper7' value='Letra B' $cheb7>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp7' width='300'><font color='".$corb7."'>".$simb7."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper7' disabled id='radper7' value='Letra C' $chec7>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp7' width='300'><font color='".$corc7."'>".$simc7."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper7' disabled id='radper7' value='Letra D' $ched7>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp7' width='300'><font color='".$cord7."'>".$simd7."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper7' disabled id='radper7' value='Letra E' $chee7>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep7' width='300'><font color='".$core7."'>".$sime7."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 8

  echo "<b>Questão 8:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per8['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper8 != "Não possui"){

      echo "<img src='uploads/$imgper8' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp8 == 0) {

    echo "<input type='radio' name='radper8' $chea8 disabled id='radper8' value='Letra A'>";

    echo "<label><font color='".$cora8."'>A) ".$letraaper8['alternativa'].$sima8."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper8' $cheb8 disabled id='radper8' value='Letra B'>";
    
    echo "<label><font color='".$corb8."'>B) ".$letrabper8['alternativa'].$simb8."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper8' $chec8 disabled id='radper8' value='Letra C'>";
    
    echo "<label><font color='".$corc8."'>C) ".$letracper8['alternativa'].$simc8."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper8' $ched8 disabled id='radper8' value='Letra D'>";
    
    echo "<label><font color='".$cord8."'>D) ".$letradper8['alternativa'].$simd8."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper8' $chee8 disabled id='radper8' value='Letra E'>";
    
    echo "<label><font color='".$core8."'>E) ".$letraeper8['alternativa'].$sime8."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap8 = $letraaper8['alternativa'];

  $imgletbp8 = $letrabper8['alternativa'];

  $imgletcp8 = $letracper8['alternativa'];

  $imgletdp8 = $letradper8['alternativa'];

  $imgletep8 = $letraeper8['alternativa'];

  

  echo "<input type='radio' name='radper8' disabled id='radper8' value='Letra A' $chea8>";

  echo "<label>A) <br> <img src='img_res/$imgletap8' width='300'><font color='".$cora8."'>".$sima8."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper8' disabled id='radper8' value='Letra B' $cheb8>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp8' width='300'><font color='".$corb8."'>".$simb8."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper8' disabled id='radper8' value='Letra C' $chec8>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp8' width='300'><font color='".$corc8."'>".$simc8."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper8' disabled id='radper8' value='Letra D' $ched8>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp8' width='300'><font color='".$cord8."'>".$simd8."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper8' disabled id='radper8' value='Letra E' $chee8>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep8' width='300'><font color='".$core8."'>".$sime8."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 9

  echo "<b>Questão 9:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per9['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper9 != "Não possui"){

      echo "<img src='uploads/$imgper9' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp9 == 0) {

    echo "<input type='radio' name='radper9' $chea9 disabled id='radper9' value='Letra A'>";

    echo "<label><font color='".$cora9."'>A) ".$letraaper9['alternativa'].$sima9."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper9' $cheb9 disabled id='radper9' value='Letra B'>";
    
    echo "<label><font color='".$corb9."'>B) ".$letrabper9['alternativa'].$simb9."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper9' $chec9 disabled id='radper9' value='Letra C'>";
    
    echo "<label><font color='".$corc9."'>C) ".$letracper9['alternativa'].$simc9."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper9' $ched9 disabled id='radper9' value='Letra D'>";
    
    echo "<label><font color='".$cord9."'>D) ".$letradper9['alternativa'].$simd9."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper9' $chee9 disabled id='radper9' value='Letra E'>";
    
    echo "<label><font color='".$core9."'>E) ".$letraeper9['alternativa'].$sime9."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap9 = $letraaper9['alternativa'];

  $imgletbp9 = $letrabper9['alternativa'];

  $imgletcp9 = $letracper9['alternativa'];

  $imgletdp9 = $letradper9['alternativa'];

  $imgletep9 = $letraeper9['alternativa'];

  

  echo "<input type='radio' name='radper9' disabled id='radper9' value='Letra A' $chea9>";

  echo "<label>A) <br> <img src='img_res/$imgletap9' width='300'><font color='".$cora9."'>".$sima9."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper9' disabled id='radper9' value='Letra B' $cheb9>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp9' width='300'><font color='".$corb9."'>".$simb9."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper9' disabled id='radper9' value='Letra C' $chec9>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp9' width='300'><font color='".$corc9."'>".$simc9."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper9' disabled id='radper9' value='Letra D' $ched9>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp9' width='300'><font color='".$cord9."'>".$simd9."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper9' disabled id='radper9' value='Letra E' $chee9>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep9' width='300'><font color='".$core9."'>".$sime9."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 10

  echo "<b>Questão 10:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per10['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper10 != "Não possui"){

      echo "<img src='uploads/$imgper10' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp10 == 0) {

    echo "<input type='radio' name='radper10' $chea10 disabled id='radper10' value='Letra A'>";

    echo "<label><font color='".$cora10."'>A) ".$letraaper10['alternativa'].$sima10."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper10' $cheb10 disabled id='radper10' value='Letra B'>";
    
    echo "<label><font color='".$corb10."'>B) ".$letrabper10['alternativa'].$simb10."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper10' $chec10 disabled id='radper10' value='Letra C'>";
    
    echo "<label><font color='".$corc10."'>C) ".$letracper10['alternativa'].$simc10."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper10' $ched10 disabled id='radper10' value='Letra D'>";
    
    echo "<label><font color='".$cord10."'>D) ".$letradper10['alternativa'].$simd10."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper10' $chee10 disabled id='radper10' value='Letra E'>";
    
    echo "<label><font color='".$core10."'>E) ".$letraeper10['alternativa'].$sime10."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap10 = $letraaper10['alternativa'];

  $imgletbp10 = $letrabper10['alternativa'];

  $imgletcp10 = $letracper10['alternativa'];

  $imgletdp10 = $letradper10['alternativa'];

  $imgletep10 = $letraeper10['alternativa'];

  

  echo "<input type='radio' name='radper10' disabled id='radper10' value='Letra A' $chea10>";

  echo "<label>A) <br> <img src='img_res/$imgletap10' width='300'><font color='".$cora10."'>".$sima10."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper10' disabled id='radper10' value='Letra B' $cheb10>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp10' width='300'><font color='".$corb10."'>".$simb10."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper10' disabled id='radper10' value='Letra C' $chec10>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp10' width='300'><font color='".$corc10."'>".$simc10."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper10' disabled id='radper10' value='Letra D' $ched10>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp10' width='300'><font color='".$cord10."'>".$simd10."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper10' disabled id='radper10' value='Letra E' $chee10>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep10' width='300'><font color='".$core10."'>".$sime10."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }

}

?>





<!-- Verificando se existe a quetão de 11 à 15 -->

<?php 

if ($qtperguntas>10){

  // Inserindo quetão 11

  echo "<b>Questão 11:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per11['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper11 != "Não possui"){

      echo "<img src='uploads/$imgper11' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp11 == 0) {

    echo "<input type='radio' name='radper11' $chea11 disabled id='radper11' value='Letra A'>";

    echo "<label><font color='".$cora11."'>A) ".$letraaper11['alternativa'].$sima11."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper11' $cheb11 disabled id='radper11' value='Letra B'>";
    
    echo "<label><font color='".$corb11."'>B) ".$letrabper11['alternativa'].$simb11."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper11' $chec11 disabled id='radper11' value='Letra C'>";
    
    echo "<label><font color='".$corc11."'>C) ".$letracper11['alternativa'].$simc11."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper11' $ched11 disabled id='radper11' value='Letra D'>";
    
    echo "<label><font color='".$cord11."'>D) ".$letradper11['alternativa'].$simd11."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper11' $chee11 disabled id='radper11' value='Letra E'>";
    
    echo "<label><font color='".$core11."'>E) ".$letraeper11['alternativa'].$sime11."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap11 = $letraaper11['alternativa'];

  $imgletbp11 = $letrabper11['alternativa'];

  $imgletcp11 = $letracper11['alternativa'];

  $imgletdp11 = $letradper11['alternativa'];

  $imgletep11 = $letraeper11['alternativa'];

  

  echo "<input type='radio' name='radper11' disabled id='radper11' value='Letra A' $chea11>";

  echo "<label>A) <br> <img src='img_res/$imgletap11' width='300'><font color='".$cora11."'>".$sima11."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper11' disabled id='radper11' value='Letra B' $cheb11>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp11' width='300'><font color='".$corb11."'>".$simb11."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper11' disabled id='radper11' value='Letra C' $chec11>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp11' width='300'><font color='".$corc11."'>".$simc11."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper11' disabled id='radper11' value='Letra D' $ched11>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp11' width='300'><font color='".$cord11."'>".$simd11."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper11' disabled id='radper11' value='Letra E' $chee11>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep11' width='300'><font color='".$core11."'>".$sime11."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 12

  echo "<b>Questão 12:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per12['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper12 != "Não possui"){

      echo "<img src='uploads/$imgper12' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp12 == 0) {

    echo "<input type='radio' name='radper12' $chea12 disabled id='radper12' value='Letra A'>";

    echo "<label><font color='".$cora12."'>A) ".$letraaper12['alternativa'].$sima12."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper12' $cheb12 disabled id='radper12' value='Letra B'>";
    
    echo "<label><font color='".$corb12."'>B) ".$letrabper12['alternativa'].$simb12."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper12' $chec12 disabled id='radper12' value='Letra C'>";
    
    echo "<label><font color='".$corc12."'>C) ".$letracper12['alternativa'].$simc12."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper12' $ched12 disabled id='radper12' value='Letra D'>";
    
    echo "<label><font color='".$cord12."'>D) ".$letradper12['alternativa'].$simd12."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper12' $chee12 disabled id='radper12' value='Letra E'>";
    
    echo "<label><font color='".$core12."'>E) ".$letraeper12['alternativa'].$sime12."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap12 = $letraaper12['alternativa'];

  $imgletbp12 = $letrabper12['alternativa'];

  $imgletcp12 = $letracper12['alternativa'];

  $imgletdp12 = $letradper12['alternativa'];

  $imgletep12 = $letraeper12['alternativa'];

  

  echo "<input type='radio' name='radper12' disabled id='radper12' value='Letra A' $chea12>";

  echo "<label>A) <br> <img src='img_res/$imgletap12' width='300'><font color='".$cora12."'>".$sima12."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper12' disabled id='radper12' value='Letra B' $cheb12>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp12' width='300'><font color='".$corb12."'>".$simb12."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper12' disabled id='radper12' value='Letra C' $chec12>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp12' width='300'><font color='".$corc12."'>".$simc12."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper12' disabled id='radper12' value='Letra D' $ched12>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp12' width='300'><font color='".$cord12."'>".$simd12."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper12' disabled id='radper12' value='Letra E' $chee12>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep12' width='300'><font color='".$core12."'>".$sime12."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 13

  echo "<b>Questão 13:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per13['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper13 != "Não possui"){

      echo "<img src='uploads/$imgper13' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp13 == 0) {

    echo "<input type='radio' name='radper13' $chea13 disabled id='radper13' value='Letra A'>";

    echo "<label><font color='".$cora13."'>A) ".$letraaper13['alternativa'].$sima13."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper13' $cheb13 disabled id='radper13' value='Letra B'>";
    
    echo "<label><font color='".$corb13."'>B) ".$letrabper13['alternativa'].$simb13."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper13' $chec13 disabled id='radper13' value='Letra C'>";
    
    echo "<label><font color='".$corc13."'>C) ".$letracper13['alternativa'].$simc13."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper13' $ched13 disabled id='radper13' value='Letra D'>";
    
    echo "<label><font color='".$cord13."'>D) ".$letradper13['alternativa'].$simd13."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper13' $chee13 disabled id='radper13' value='Letra E'>";
    
    echo "<label><font color='".$core13."'>E) ".$letraeper13['alternativa'].$sime13."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap13 = $letraaper13['alternativa'];

  $imgletbp13 = $letrabper13['alternativa'];

  $imgletcp13 = $letracper13['alternativa'];

  $imgletdp13 = $letradper13['alternativa'];

  $imgletep13 = $letraeper13['alternativa'];

  

  echo "<input type='radio' name='radper13' disabled id='radper13' value='Letra A' $chea13>";

  echo "<label>A) <br> <img src='img_res/$imgletap13' width='300'><font color='".$cora13."'>".$sima13."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper13' disabled id='radper13' value='Letra B' $cheb13>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp13' width='300'><font color='".$corb13."'>".$simb13."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper13' disabled id='radper13' value='Letra C' $chec13>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp13' width='300'><font color='".$corc13."'>".$simc13."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper13' disabled id='radper13' value='Letra D' $ched13>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp13' width='300'><font color='".$cord13."'>".$simd13."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper13' disabled id='radper13' value='Letra E' $chee13>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep13' width='300'><font color='".$core13."'>".$sime13."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 14

  echo "<b>Questão 14:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per14['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper14 != "Não possui"){

      echo "<img src='uploads/$imgper14' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp14 == 0) {

    echo "<input type='radio' name='radper14' $chea14 disabled id='radper14' value='Letra A'>";

    echo "<label><font color='".$cora14."'>A) ".$letraaper14['alternativa'].$sima14."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper14' $cheb14 disabled id='radper14' value='Letra B'>";
    
    echo "<label><font color='".$corb14."'>B) ".$letrabper14['alternativa'].$simb14."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper14' $chec14 disabled id='radper14' value='Letra C'>";
    
    echo "<label><font color='".$corc14."'>C) ".$letracper14['alternativa'].$simc14."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper14' $ched14 disabled id='radper14' value='Letra D'>";
    
    echo "<label><font color='".$cord14."'>D) ".$letradper14['alternativa'].$simd14."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper14' $chee14 disabled id='radper14' value='Letra E'>";
    
    echo "<label><font color='".$core14."'>E) ".$letraeper14['alternativa'].$sime14."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap14 = $letraaper14['alternativa'];

  $imgletbp14 = $letrabper14['alternativa'];

  $imgletcp14 = $letracper14['alternativa'];

  $imgletdp14 = $letradper14['alternativa'];

  $imgletep14 = $letraeper14['alternativa'];

  

  echo "<input type='radio' name='radper14' disabled id='radper14' value='Letra A' $chea14>";

  echo "<label>A) <br> <img src='img_res/$imgletap14' width='300'><font color='".$cora14."'>".$sima14."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper14' disabled id='radper14' value='Letra B' $cheb14>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp14' width='300'><font color='".$corb14."'>".$simb14."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper14' disabled id='radper14' value='Letra C' $chec14>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp14' width='300'><font color='".$corc14."'>".$simc14."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper14' disabled id='radper14' value='Letra D' $ched14>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp14' width='300'><font color='".$cord14."'>".$simd14."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper14' disabled id='radper14' value='Letra E' $chee14>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep14' width='300'><font color='".$core14."'>".$sime14."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 15

  echo "<b>Questão 15:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per15['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper15 != "Não possui"){

      echo "<img src='uploads/$imgper15' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp15 == 0) {

    echo "<input type='radio' name='radper15' $chea15 disabled id='radper15' value='Letra A'>";

    echo "<label><font color='".$cora15."'>A) ".$letraaper15['alternativa'].$sima15."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper15' $cheb15 disabled id='radper15' value='Letra B'>";
    
    echo "<label><font color='".$corb15."'>B) ".$letrabper15['alternativa'].$simb15."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper15' $chec15 disabled id='radper15' value='Letra C'>";
    
    echo "<label><font color='".$corc15."'>C) ".$letracper15['alternativa'].$simc15."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper15' $ched15 disabled id='radper15' value='Letra D'>";
    
    echo "<label><font color='".$cord15."'>D) ".$letradper15['alternativa'].$simd15."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper15' $chee15 disabled id='radper15' value='Letra E'>";
    
    echo "<label><font color='".$core15."'>E) ".$letraeper15['alternativa'].$sime15."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap15 = $letraaper15['alternativa'];

  $imgletbp15 = $letrabper15['alternativa'];

  $imgletcp15 = $letracper15['alternativa'];

  $imgletdp15 = $letradper15['alternativa'];

  $imgletep15 = $letraeper15['alternativa'];

  

  echo "<input type='radio' name='radper15' disabled id='radper15' value='Letra A' $chea15>";

  echo "<label>A) <br> <img src='img_res/$imgletap15' width='300'><font color='".$cora15."'>".$sima15."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper15' disabled id='radper15' value='Letra B' $cheb15>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp15' width='300'><font color='".$corb15."'>".$simb15."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper15' disabled id='radper15' value='Letra C' $chec15>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp15' width='300'><font color='".$corc15."'>".$simc15."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper15' disabled id='radper15' value='Letra D' $ched15>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp15' width='300'><font color='".$cord15."'>".$simd15."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper15' disabled id='radper15' value='Letra E' $chee15>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep15' width='300'><font color='".$core15."'>".$sime15."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }

}

?>





<!-- Verificando se existe a quetão de 16 à 20 -->

<?php 

if ($qtperguntas>15){

  // Inserindo quetão 16

  echo "<b>Questão 16:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per16['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper16 != "Não possui"){

      echo "<img src='uploads/$imgper16' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp16 == 0) {

    echo "<input type='radio' name='radper16' $chea16 disabled id='radper16' value='Letra A'>";

    echo "<label><font color='".$cora16."'>A) ".$letraaper16['alternativa'].$sima16."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper16' $cheb16 disabled id='radper16' value='Letra B'>";
    
    echo "<label><font color='".$corb16."'>B) ".$letrabper16['alternativa'].$simb16."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper16' $chec16 disabled id='radper16' value='Letra C'>";
    
    echo "<label><font color='".$corc16."'>C) ".$letracper16['alternativa'].$simc16."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper16' $ched16 disabled id='radper16' value='Letra D'>";
    
    echo "<label><font color='".$cord16."'>D) ".$letradper16['alternativa'].$simd16."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper16' $chee16 disabled id='radper16' value='Letra E'>";
    
    echo "<label><font color='".$core16."'>E) ".$letraeper16['alternativa'].$sime16."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap16 = $letraaper16['alternativa'];

  $imgletbp16 = $letrabper16['alternativa'];

  $imgletcp16 = $letracper16['alternativa'];

  $imgletdp16 = $letradper16['alternativa'];

  $imgletep16 = $letraeper16['alternativa'];

  

  echo "<input type='radio' name='radper16' disabled id='radper16' value='Letra A' $chea16>";

  echo "<label>A) <br> <img src='img_res/$imgletap16' width='300'><font color='".$cora16."'>".$sima16."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper16' disabled id='radper16' value='Letra B' $cheb16>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp16' width='300'><font color='".$corb16."'>".$simb16."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper16' disabled id='radper16' value='Letra C' $chec16>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp16' width='300'><font color='".$corc16."'>".$simc16."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper16' disabled id='radper16' value='Letra D' $ched16>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp16' width='300'><font color='".$cord16."'>".$simd16."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper16' disabled id='radper16' value='Letra E' $chee16>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep16' width='300'><font color='".$core16."'>".$sime16."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 17

  echo "<b>Questão 17:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per17['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper17 != "Não possui"){

      echo "<img src='uploads/$imgper17' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp17 == 0) {

    echo "<input type='radio' name='radper17' $chea17 disabled id='radper17' value='Letra A'>";

    echo "<label><font color='".$cora17."'>A) ".$letraaper17['alternativa'].$sima17."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper17' $cheb17 disabled id='radper17' value='Letra B'>";
    
    echo "<label><font color='".$corb17."'>B) ".$letrabper17['alternativa'].$simb17."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper17' $chec17 disabled id='radper17' value='Letra C'>";
    
    echo "<label><font color='".$corc17."'>C) ".$letracper17['alternativa'].$simc17."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper17' $ched17 disabled id='radper17' value='Letra D'>";
    
    echo "<label><font color='".$cord17."'>D) ".$letradper17['alternativa'].$simd17."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper17' $chee17 disabled id='radper17' value='Letra E'>";
    
    echo "<label><font color='".$core17."'>E) ".$letraeper17['alternativa'].$sime17."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap17 = $letraaper17['alternativa'];

  $imgletbp17 = $letrabper17['alternativa'];

  $imgletcp17 = $letracper17['alternativa'];

  $imgletdp17 = $letradper17['alternativa'];

  $imgletep17 = $letraeper17['alternativa'];

  

  echo "<input type='radio' name='radper17' disabled id='radper17' value='Letra A' $chea17>";

  echo "<label>A) <br> <img src='img_res/$imgletap17' width='300'><font color='".$cora17."'>".$sima17."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper17' disabled id='radper17' value='Letra B' $cheb17>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp17' width='300'><font color='".$corb17."'>".$simb17."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper17' disabled id='radper17' value='Letra C' $chec17>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp17' width='300'><font color='".$corc17."'>".$simc17."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper17' disabled id='radper17' value='Letra D' $ched17>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp17' width='300'><font color='".$cord17."'>".$simd17."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper17' disabled id='radper17' value='Letra E' $chee17>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep17' width='300'><font color='".$core17."'>".$sime17."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 18

  echo "<b>Questão 18:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per18['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper18 != "Não possui"){

      echo "<img src='uploads/$imgper18' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp18 == 0) {

    echo "<input type='radio' name='radper18' $chea18 disabled id='radper18' value='Letra A'>";

    echo "<label><font color='".$cora18."'>A) ".$letraaper18['alternativa'].$sima18."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper18' $cheb18 disabled id='radper18' value='Letra B'>";
    
    echo "<label><font color='".$corb18."'>B) ".$letrabper18['alternativa'].$simb18."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper18' $chec18 disabled id='radper18' value='Letra C'>";
    
    echo "<label><font color='".$corc18."'>C) ".$letracper18['alternativa'].$simc18."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper18' $ched18 disabled id='radper18' value='Letra D'>";
    
    echo "<label><font color='".$cord18."'>D) ".$letradper18['alternativa'].$simd18."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper18' $chee18 disabled id='radper18' value='Letra E'>";
    
    echo "<label><font color='".$core18."'>E) ".$letraeper18['alternativa'].$sime18."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap18 = $letraaper18['alternativa'];

  $imgletbp18 = $letrabper18['alternativa'];

  $imgletcp18 = $letracper18['alternativa'];

  $imgletdp18 = $letradper18['alternativa'];

  $imgletep18 = $letraeper18['alternativa'];

  

  echo "<input type='radio' name='radper18' disabled id='radper18' value='Letra A' $chea18>";

  echo "<label>A) <br> <img src='img_res/$imgletap18' width='300'><font color='".$cora18."'>".$sima18."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper18' disabled id='radper18' value='Letra B' $cheb18>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp18' width='300'><font color='".$corb18."'>".$simb18."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper18' disabled id='radper18' value='Letra C' $chec18>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp18' width='300'><font color='".$corc18."'>".$simc18."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper18' disabled id='radper18' value='Letra D' $ched18>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp18' width='300'><font color='".$cord18."'>".$simd18."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper18' disabled id='radper18' value='Letra E' $chee18>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep18' width='300'><font color='".$core18."'>".$sime18."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 19

  echo "<b>Questão 19:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per19['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper19 != "Não possui"){

      echo "<img src='uploads/$imgper19' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp19 == 0) {

    echo "<input type='radio' name='radper19' $chea19 disabled id='radper19' value='Letra A'>";

    echo "<label><font color='".$cora19."'>A) ".$letraaper19['alternativa'].$sima19."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper19' $cheb19 disabled id='radper19' value='Letra B'>";
    
    echo "<label><font color='".$corb19."'>B) ".$letrabper19['alternativa'].$simb19."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper19' $chec19 disabled id='radper19' value='Letra C'>";
    
    echo "<label><font color='".$corc19."'>C) ".$letracper19['alternativa'].$simc19."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper19' $ched19 disabled id='radper19' value='Letra D'>";
    
    echo "<label><font color='".$cord19."'>D) ".$letradper19['alternativa'].$simd19."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper19' $chee19 disabled id='radper19' value='Letra E'>";
    
    echo "<label><font color='".$core19."'>E) ".$letraeper19['alternativa'].$sime19."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap19 = $letraaper19['alternativa'];

  $imgletbp19 = $letrabper19['alternativa'];

  $imgletcp19 = $letracper19['alternativa'];

  $imgletdp19 = $letradper19['alternativa'];

  $imgletep19 = $letraeper19['alternativa'];

  

  echo "<input type='radio' name='radper19' disabled id='radper19' value='Letra A' $chea19>";

  echo "<label>A) <br> <img src='img_res/$imgletap19' width='300'><font color='".$cora19."'>".$sima19."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper19' disabled id='radper19' value='Letra B' $cheb19>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp19' width='300'><font color='".$corb19."'>".$simb19."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper19' disabled id='radper19' value='Letra C' $chec19>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp19' width='300'><font color='".$corc19."'>".$simc19."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper19' disabled id='radper19' value='Letra D' $ched19>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp19' width='300'><font color='".$cord19."'>".$simd19."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper19' disabled id='radper19' value='Letra E' $chee19>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep19' width='300'><font color='".$core19."'>".$sime19."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 20

  echo "<b>Questão 20:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per20['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper20 != "Não possui"){

      echo "<img src='uploads/$imgper20' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp20 == 0) {

    echo "<input type='radio' name='radper20' $chea20 disabled id='radper20' value='Letra A'>";

    echo "<label><font color='".$cora20."'>A) ".$letraaper20['alternativa'].$sima20."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper20' $cheb20 disabled id='radper20' value='Letra B'>";
    
    echo "<label><font color='".$corb20."'>B) ".$letrabper20['alternativa'].$simb20."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper20' $chec20 disabled id='radper20' value='Letra C'>";
    
    echo "<label><font color='".$corc20."'>C) ".$letracper20['alternativa'].$simc20."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper20' $ched20 disabled id='radper20' value='Letra D'>";
    
    echo "<label><font color='".$cord20."'>D) ".$letradper20['alternativa'].$simd20."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper20' $chee20 disabled id='radper20' value='Letra E'>";
    
    echo "<label><font color='".$core20."'>E) ".$letraeper20['alternativa'].$sime20."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap20 = $letraaper20['alternativa'];

  $imgletbp20 = $letrabper20['alternativa'];

  $imgletcp20 = $letracper20['alternativa'];

  $imgletdp20 = $letradper20['alternativa'];

  $imgletep20 = $letraeper20['alternativa'];

  

  echo "<input type='radio' name='radper20' disabled id='radper20' value='Letra A' $chea20>";

  echo "<label>A) <br> <img src='img_res/$imgletap20' width='300'><font color='".$cora20."'>".$sima20."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper20' disabled id='radper20' value='Letra B' $cheb20>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp20' width='300'><font color='".$corb20."'>".$simb20."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper20' disabled id='radper20' value='Letra C' $chec20>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp20' width='300'><font color='".$corc20."'>".$simc20."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper20' disabled id='radper20' value='Letra D' $ched20>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp20' width='300'><font color='".$cord20."'>".$simd20."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper20' disabled id='radper20' value='Letra E' $chee20>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep20' width='300'><font color='".$core20."'>".$sime20."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }

}

?>





<!-- Verificando se existe a quetão de 21 à 25 -->

<?php 

if ($qtperguntas>20){

  // Inserindo quetão 21

  echo "<b>Questão 21:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per21['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper21 != "Não possui"){

      echo "<img src='uploads/$imgper21' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp21 == 0) {

    echo "<input type='radio' name='radper21' $chea21 disabled id='radper21' value='Letra A'>";

    echo "<label><font color='".$cora21."'>A) ".$letraaper21['alternativa'].$sima21."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper21' $cheb21 disabled id='radper21' value='Letra B'>";
    
    echo "<label><font color='".$corb21."'>B) ".$letrabper21['alternativa'].$simb21."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper21' $chec21 disabled id='radper21' value='Letra C'>";
    
    echo "<label><font color='".$corc21."'>C) ".$letracper21['alternativa'].$simc21."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper21' $ched21 disabled id='radper21' value='Letra D'>";
    
    echo "<label><font color='".$cord21."'>D) ".$letradper21['alternativa'].$simd21."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper21' $chee21 disabled id='radper21' value='Letra E'>";
    
    echo "<label><font color='".$core21."'>E) ".$letraeper21['alternativa'].$sime21."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap21 = $letraaper21['alternativa'];

  $imgletbp21 = $letrabper21['alternativa'];

  $imgletcp21 = $letracper21['alternativa'];

  $imgletdp21 = $letradper21['alternativa'];

  $imgletep21 = $letraeper21['alternativa'];

  

  echo "<input type='radio' name='radper21' disabled id='radper21' value='Letra A' $chea21>";

  echo "<label>A) <br> <img src='img_res/$imgletap21' width='300'><font color='".$cora21."'>".$sima21."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper21' disabled id='radper21' value='Letra B' $cheb21>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp21' width='300'><font color='".$corb21."'>".$simb21."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper21' disabled id='radper21' value='Letra C' $chec21>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp21' width='300'><font color='".$corc21."'>".$simc21."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper21' disabled id='radper21' value='Letra D' $ched21>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp21' width='300'><font color='".$cord21."'>".$simd21."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper21' disabled id='radper21' value='Letra E' $chee21>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep21' width='300'><font color='".$core21."'>".$sime21."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 22

  echo "<b>Questão 22:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per22['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper22 != "Não possui"){

      echo "<img src='uploads/$imgper22' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp22 == 0) {

    echo "<input type='radio' name='radper22' $chea22 disabled id='radper22' value='Letra A'>";

    echo "<label><font color='".$cora22."'>A) ".$letraaper22['alternativa'].$sima22."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper22' $cheb22 disabled id='radper22' value='Letra B'>";
    
    echo "<label><font color='".$corb22."'>B) ".$letrabper22['alternativa'].$simb22."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper22' $chec22 disabled id='radper22' value='Letra C'>";
    
    echo "<label><font color='".$corc22."'>C) ".$letracper22['alternativa'].$simc22."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper22' $ched22 disabled id='radper22' value='Letra D'>";
    
    echo "<label><font color='".$cord22."'>D) ".$letradper22['alternativa'].$simd22."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper22' $chee22 disabled id='radper22' value='Letra E'>";
    
    echo "<label><font color='".$core22."'>E) ".$letraeper22['alternativa'].$sime22."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap22 = $letraaper22['alternativa'];

  $imgletbp22 = $letrabper22['alternativa'];

  $imgletcp22 = $letracper22['alternativa'];

  $imgletdp22 = $letradper22['alternativa'];

  $imgletep22 = $letraeper22['alternativa'];

  

  echo "<input type='radio' name='radper22' disabled id='radper22' value='Letra A' $chea22>";

  echo "<label>A) <br> <img src='img_res/$imgletap22' width='300'><font color='".$cora22."'>".$sima22."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper22' disabled id='radper22' value='Letra B' $cheb22>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp22' width='300'><font color='".$corb22."'>".$simb22."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper22' disabled id='radper22' value='Letra C' $chec22>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp22' width='300'><font color='".$corc22."'>".$simc22."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper22' disabled id='radper22' value='Letra D' $ched22>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp22' width='300'><font color='".$cord22."'>".$simd22."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper22' disabled id='radper22' value='Letra E' $chee22>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep22' width='300'><font color='".$core22."'>".$sime22."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 23

  echo "<b>Questão 23:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per23['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper23 != "Não possui"){

      echo "<img src='uploads/$imgper23' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp23 == 0) {

    echo "<input type='radio' name='radper23' $chea23 disabled id='radper23' value='Letra A'>";

    echo "<label><font color='".$cora23."'>A) ".$letraaper23['alternativa'].$sima23."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper23' $cheb23 disabled id='radper23' value='Letra B'>";
    
    echo "<label><font color='".$corb23."'>B) ".$letrabper23['alternativa'].$simb23."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper23' $chec23 disabled id='radper23' value='Letra C'>";
    
    echo "<label><font color='".$corc23."'>C) ".$letracper23['alternativa'].$simc23."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper23' $ched23 disabled id='radper23' value='Letra D'>";
    
    echo "<label><font color='".$cord23."'>D) ".$letradper23['alternativa'].$simd23."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper23' $chee23 disabled id='radper23' value='Letra E'>";
    
    echo "<label><font color='".$core23."'>E) ".$letraeper23['alternativa'].$sime23."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap23 = $letraaper23['alternativa'];

  $imgletbp23 = $letrabper23['alternativa'];

  $imgletcp23 = $letracper23['alternativa'];

  $imgletdp23 = $letradper23['alternativa'];

  $imgletep23 = $letraeper23['alternativa'];

  

  echo "<input type='radio' name='radper23' disabled id='radper23' value='Letra A' $chea23>";

  echo "<label>A) <br> <img src='img_res/$imgletap23' width='300'><font color='".$cora23."'>".$sima23."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper23' disabled id='radper23' value='Letra B' $cheb23>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp23' width='300'><font color='".$corb23."'>".$simb23."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper23' disabled id='radper23' value='Letra C' $chec23>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp23' width='300'><font color='".$corc23."'>".$simc23."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper23' disabled id='radper23' value='Letra D' $ched23>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp23' width='300'><font color='".$cord23."'>".$simd23."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper23' disabled id='radper23' value='Letra E' $chee23>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep23' width='300'><font color='".$core23."'>".$sime23."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 24

  echo "<b>Questão 24:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per24['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper24 != "Não possui"){

      echo "<img src='uploads/$imgper24' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp24 == 0) {

    echo "<input type='radio' name='radper24' $chea24 disabled id='radper24' value='Letra A'>";

    echo "<label><font color='".$cora24."'>A) ".$letraaper24['alternativa'].$sima24."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper24' $cheb24 disabled id='radper24' value='Letra B'>";
    
    echo "<label><font color='".$corb24."'>B) ".$letrabper24['alternativa'].$simb24."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper24' $chec24 disabled id='radper24' value='Letra C'>";
    
    echo "<label><font color='".$corc24."'>C) ".$letracper24['alternativa'].$simc24."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper24' $ched24 disabled id='radper24' value='Letra D'>";
    
    echo "<label><font color='".$cord24."'>D) ".$letradper24['alternativa'].$simd24."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper24' $chee24 disabled id='radper24' value='Letra E'>";
    
    echo "<label><font color='".$core24."'>E) ".$letraeper24['alternativa'].$sime24."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap24 = $letraaper24['alternativa'];

  $imgletbp24 = $letrabper24['alternativa'];

  $imgletcp24 = $letracper24['alternativa'];

  $imgletdp24 = $letradper24['alternativa'];

  $imgletep24 = $letraeper24['alternativa'];

  

  echo "<input type='radio' name='radper24' disabled id='radper24' value='Letra A' $chea24>";

  echo "<label>A) <br> <img src='img_res/$imgletap24' width='300'><font color='".$cora24."'>".$sima24."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper24' disabled id='radper24' value='Letra B' $cheb24>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp24' width='300'><font color='".$corb24."'>".$simb24."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper24' disabled id='radper24' value='Letra C' $chec24>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp24' width='300'><font color='".$corc24."'>".$simc24."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper24' disabled id='radper24' value='Letra D' $ched24>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp24' width='300'><font color='".$cord24."'>".$simd24."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper24' disabled id='radper24' value='Letra E' $chee24>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep24' width='300'><font color='".$core24."'>".$sime24."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }



  // Inserindo quetão 25

  echo "<b>Questão 25:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per25['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper25 != "Não possui"){

      echo "<img src='uploads/$imgper25' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp25 == 0) {

    echo "<input type='radio' name='radper25|' $chea25 disabled id='radper25' value='Letra A'>";

    echo "<label><font color='".$cora25."'>A) ".$letraaper25['alternativa'].$sima25."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper25' $cheb25 disabled id='radper25' value='Letra B'>";
    
    echo "<label><font color='".$corb25."'>B) ".$letrabper25['alternativa'].$simb25."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper25' $chec25 disabled id='radper25' value='Letra C'>";
    
    echo "<label><font color='".$corc25."'>C) ".$letracper25['alternativa'].$simc25."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper25' $ched25 disabled id='radper25' value='Letra D'>";
    
    echo "<label><font color='".$cord25."'>D) ".$letradper25['alternativa'].$simd25."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper25' $chee25 disabled id='radper25' value='Letra E'>";
    
    echo "<label><font color='".$core25."'>E) ".$letraeper25['alternativa'].$sime25."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";

  }

  else{

  $imgletap25 = $letraaper25['alternativa'];

  $imgletbp25 = $letrabper25['alternativa'];

  $imgletcp25 = $letracper25['alternativa'];

  $imgletdp25 = $letradper25['alternativa'];

  $imgletep25 = $letraeper25['alternativa'];

  

  echo "<input type='radio' name='radper25' disabled id='radper25' value='Letra A' $chea25>";

  echo "<label>A) <br> <img src='img_res/$imgletap25' width='300'><font color='".$cora25."'>".$sima25."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper25' disabled id='radper25' value='Letra B' $cheb25>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp25' width='300'><font color='".$corb25."'>".$simb25."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper25' disabled id='radper25' value='Letra C' $chec25>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp25' width='300'><font color='".$corc25."'>".$simc25."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper25' disabled id='radper25' value='Letra D' $ched25>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp25' width='300'><font color='".$cord25."'>".$simd25."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper25' disabled id='radper25' value='Letra E' $chee25>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep25' width='300'><font color='".$core25."'>".$sime25."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";

  }

}

?>







<!-- Verificando se existe a quetão de 26 à 30 -->

<?php 

if ($qtperguntas>25){

  // Inserindo quetão 26

  echo "<b>Questão 26:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per26['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper26 != "Não possui"){

      echo "<img src='uploads/$imgper26' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp26 == 0) {

    echo "<input type='radio' name='radper26' $chea26 disabled id='radper26' value='Letra A'>";

    echo "<label><font color='".$cora26."'>A) ".$letraaper26['alternativa'].$sima26."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper26' $cheb26 disabled id='radper26' value='Letra B'>";
    
    echo "<label><font color='".$corb26."'>B) ".$letrabper26['alternativa'].$simb26."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper26' $chec26 disabled id='radper26' value='Letra C'>";
    
    echo "<label><font color='".$corc26."'>C) ".$letracper26['alternativa'].$simc26."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper26' $ched26 disabled id='radper26' value='Letra D'>";
    
    echo "<label><font color='".$cord26."'>D) ".$letradper26['alternativa'].$simd26."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper26' $chee26 disabled id='radper26' value='Letra E'>";
    
    echo "<label><font color='".$core26."'>E) ".$letraeper26['alternativa'].$sime26."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap26 = $letraaper26['alternativa'];

  $imgletbp26 = $letrabper26['alternativa'];

  $imgletcp26 = $letracper26['alternativa'];

  $imgletdp26 = $letradper26['alternativa'];

  $imgletep26 = $letraeper26['alternativa'];

  

  echo "<input type='radio' name='radper26' disabled id='radper26' value='Letra A' $chea26>";

echo "<label>A) <br> <img src='img_res/$imgletap26' width='300'><font color='".$cora26."'>".$sima26."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper26' disabled id='radper26' value='Letra B' $cheb26>";

echo "<label>B) <br> <img src='img_res/$imgletbp26' width='300'><font color='".$corb26."'>".$simb26."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper26' disabled id='radper26' value='Letra C' $chec26>";

echo "<label>C) <br> <img src='img_res/$imgletcp26' width='300'><font color='".$corc26."'>".$simc26."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper26' disabled id='radper26' value='Letra D' $ched26>";

echo "<label>D) <br> <img src='img_res/$imgletdp26' width='300'><font color='".$cord26."'>".$simd26."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper26' disabled id='radper26' value='Letra E' $chee26>";

echo "<label>E) <br> <img src='img_res/$imgletep26' width='300'><font color='".$core26."'>".$sime26."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 27

  echo "<b>Questão 27:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per27['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper27 != "Não possui"){

      echo "<img src='uploads/$imgper27' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp27 == 0) {

    echo "<input type='radio' name='radper27' $chea27 disabled id='radper27' value='Letra A'>";

    echo "<label><font color='".$cora27."'>A) ".$letraaper27['alternativa'].$sima27."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper27' $cheb27 disabled id='radper27' value='Letra B'>";
    
    echo "<label><font color='".$corb27."'>B) ".$letrabper27['alternativa'].$simb27."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper27' $chec27 disabled id='radper27' value='Letra C'>";
    
    echo "<label><font color='".$corc27."'>C) ".$letracper27['alternativa'].$simc27."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper27' $ched27 disabled id='radper27' value='Letra D'>";
    
    echo "<label><font color='".$cord27."'>D) ".$letradper27['alternativa'].$simd27."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper27' $chee27 disabled id='radper27' value='Letra E'>";
    
    echo "<label><font color='".$core27."'>E) ".$letraeper27['alternativa'].$sime27."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap27 = $letraaper27['alternativa'];

  $imgletbp27 = $letrabper27['alternativa'];

  $imgletcp27 = $letracper27['alternativa'];

  $imgletdp27 = $letradper27['alternativa'];

  $imgletep27 = $letraeper27['alternativa'];

  

  echo "<input type='radio' name='radper27' disabled id='radper27' value='Letra A' $chea27>";

echo "<label>A) <br> <img src='img_res/$imgletap27' width='300'><font color='".$cora27."'>".$sima27."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper27' disabled id='radper27' value='Letra B' $cheb27>";

echo "<label>B) <br> <img src='img_res/$imgletbp27' width='300'><font color='".$corb27."'>".$simb27."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper27' disabled id='radper27' value='Letra C' $chec27>";

echo "<label>C) <br> <img src='img_res/$imgletcp27' width='300'><font color='".$corc27."'>".$simc27."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper27' disabled id='radper27' value='Letra D' $ched27>";

echo "<label>D) <br> <img src='img_res/$imgletdp27' width='300'><font color='".$cord27."'>".$simd27."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper27' disabled id='radper27' value='Letra E' $chee27>";

echo "<label>E) <br> <img src='img_res/$imgletep27' width='300'><font color='".$core27."'>".$sime27."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 28

  echo "<b>Questão 28:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per28['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper28 != "Não possui"){

      echo "<img src='uploads/$imgper28' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp28 == 0) {

    echo "<input type='radio' name='radper28' $chea28 disabled id='radper28' value='Letra A'>";

    echo "<label><font color='".$cora28."'>A) ".$letraaper28['alternativa'].$sima28."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper28' $cheb28 disabled id='radper28' value='Letra B'>";
    
    echo "<label><font color='".$corb28."'>B) ".$letrabper28['alternativa'].$simb28."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper28' $chec28 disabled id='radper28' value='Letra C'>";
    
    echo "<label><font color='".$corc28."'>C) ".$letracper28['alternativa'].$simc28."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper28' $ched28 disabled id='radper28' value='Letra D'>";
    
    echo "<label><font color='".$cord28."'>D) ".$letradper28['alternativa'].$simd28."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper28' $chee28 disabled id='radper28' value='Letra E'>";
    
    echo "<label><font color='".$core28."'>E) ".$letraeper28['alternativa'].$sime28."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap28 = $letraaper28['alternativa'];

  $imgletbp28 = $letrabper28['alternativa'];

  $imgletcp28 = $letracper28['alternativa'];

  $imgletdp28 = $letradper28['alternativa'];

  $imgletep28 = $letraeper28['alternativa'];

  

  echo "<input type='radio' name='radper28' disabled id='radper28' value='Letra A' $chea28>";

echo "<label>A) <br> <img src='img_res/$imgletap28' width='300'><font color='".$cora28."'>".$sima28."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper28' disabled id='radper28' value='Letra B' $cheb28>";

echo "<label>B) <br> <img src='img_res/$imgletbp28' width='300'><font color='".$corb28."'>".$simb28."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper28' disabled id='radper28' value='Letra C' $chec28>";

echo "<label>C) <br> <img src='img_res/$imgletcp28' width='300'><font color='".$corc28."'>".$simc28."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper28' disabled id='radper28' value='Letra D' $ched28>";

echo "<label>D) <br> <img src='img_res/$imgletdp28' width='300'><font color='".$cord28."'>".$simd28."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper28' disabled id='radper28' value='Letra E' $chee28>";

echo "<label>E) <br> <img src='img_res/$imgletep28' width='300'><font color='".$core28."'>".$sime28."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 29

  echo "<b>Questão 29:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per29['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper29 != "Não possui"){

      echo "<img src='uploads/$imgper29' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp29 == 0) {

    echo "<input type='radio' name='radper29' $chea29 disabled id='radper29' value='Letra A'>";

    echo "<label><font color='".$cora29."'>A) ".$letraaper29['alternativa'].$sima29."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper29' $cheb29 disabled id='radper29' value='Letra B'>";
    
    echo "<label><font color='".$corb29."'>B) ".$letrabper29['alternativa'].$simb29."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper29' $chec29 disabled id='radper29' value='Letra C'>";
    
    echo "<label><font color='".$corc29."'>C) ".$letracper29['alternativa'].$simc29."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper29' $ched29 disabled id='radper29' value='Letra D'>";
    
    echo "<label><font color='".$cord29."'>D) ".$letradper29['alternativa'].$simd29."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper29' $chee29 disabled id='radper29' value='Letra E'>";
    
    echo "<label><font color='".$core29."'>E) ".$letraeper29['alternativa'].$sime29."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap29 = $letraaper29['alternativa'];

  $imgletbp29 = $letrabper29['alternativa'];

  $imgletcp29 = $letracper29['alternativa'];

  $imgletdp29 = $letradper29['alternativa'];

  $imgletep29 = $letraeper29['alternativa'];

  

  echo "<input type='radio' name='radper29' disabled id='radper29' value='Letra A' $chea29>";

  echo "<label>A) <br> <img src='img_res/$imgletap29' width='300'><font color='".$cora29."'>".$sima29."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper29' disabled id='radper29' value='Letra B' $cheb29>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp29' width='300'><font color='".$corb29."'>".$simb29."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper29' disabled id='radper29' value='Letra C' $chec29>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp29' width='300'><font color='".$corc29."'>".$simc29."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper29' disabled id='radper29' value='Letra D' $ched29>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp29' width='300'><font color='".$cord29."'>".$simd29."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper29' disabled id='radper29' value='Letra E' $chee29>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep29' width='300'><font color='".$core29."'>".$sime29."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 30

  echo "<b>Questão 30:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per30['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper30 != "Não possui"){

      echo "<img src='uploads/$imgper30' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp30 == 0) {

    echo "<input type='radio' name='radper30' $chea30 disabled id='radper30' value='Letra A'>";

    echo "<label><font color='".$cora30."'>A) ".$letraaper30['alternativa'].$sima30."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper30' $cheb30 disabled id='radper30' value='Letra B'>";
    
    echo "<label><font color='".$corb30."'>B) ".$letrabper30['alternativa'].$simb30."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper30' $chec30 disabled id='radper30' value='Letra C'>";
    
    echo "<label><font color='".$corc30."'>C) ".$letracper30['alternativa'].$simc30."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper30' $ched30 disabled id='radper30' value='Letra D'>";
    
    echo "<label><font color='".$cord30."'>D) ".$letradper30['alternativa'].$simd30."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper30' $chee30 disabled id='radper30' value='Letra E'>";
    
    echo "<label><font color='".$core30."'>E) ".$letraeper30['alternativa'].$sime30."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap30 = $letraaper30['alternativa'];

  $imgletbp30 = $letrabper30['alternativa'];

  $imgletcp30 = $letracper30['alternativa'];

  $imgletdp30 = $letradper30['alternativa'];

  $imgletep30 = $letraeper30['alternativa'];

  

  echo "<input type='radio' name='radper30' disabled id='radper30' value='Letra A' $chea30>";

  echo "<label>A) <br> <img src='img_res/$imgletap30' width='300'><font color='".$cora30."'>".$sima30."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper30' disabled id='radper30' value='Letra B' $cheb30>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp30' width='300'><font color='".$corb30."'>".$simb30."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper30' disabled id='radper30' value='Letra C' $chec30>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp30' width='300'><font color='".$corc30."'>".$simc30."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper30' disabled id='radper30' value='Letra D' $ched30>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp30' width='300'><font color='".$cord30."'>".$simd30."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper30' disabled id='radper30' value='Letra E' $chee30>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep30' width='300'><font color='".$core30."'>".$sime30."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 31 à 35 -->

<?php 

if ($qtperguntas>30){

  // Inserindo quetão 31

  echo "<b>Questão 31:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per31['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper31 != "Não possui"){

      echo "<img src='uploads/$imgper31' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp31 == 0) {

    echo "<input type='radio' name='radper31' $chea31 disabled id='radper31' value='Letra A'>";

    echo "<label><font color='".$cora31."'>A) ".$letraaper31['alternativa'].$sima31."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper31' $cheb31 disabled id='radper31' value='Letra B'>";
    
    echo "<label><font color='".$corb31."'>B) ".$letrabper31['alternativa'].$simb31."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper31' $chec31 disabled id='radper31' value='Letra C'>";
    
    echo "<label><font color='".$corc31."'>C) ".$letracper31['alternativa'].$simc31."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper31' $ched31 disabled id='radper31' value='Letra D'>";
    
    echo "<label><font color='".$cord31."'>D) ".$letradper31['alternativa'].$simd31."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper31' $chee31 disabled id='radper31' value='Letra E'>";
    
    echo "<label><font color='".$core31."'>E) ".$letraeper31['alternativa'].$sime31."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap31 = $letraaper31['alternativa'];

  $imgletbp31 = $letrabper31['alternativa'];

  $imgletcp31 = $letracper31['alternativa'];

  $imgletdp31 = $letradper31['alternativa'];

  $imgletep31 = $letraeper31['alternativa'];

  

  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra A' $chea32>";

  echo "<label>A) <br> <img src='img_res/$imgletap32' width='300'><font color='".$cora32."'>".$sima32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra B' $cheb32>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp32' width='300'><font color='".$corb32."'>".$simb32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra C' $chec32>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp32' width='300'><font color='".$corc32."'>".$simc32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra D' $ched32>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp32' width='300'><font color='".$cord32."'>".$simd32."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra E' $chee32>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep32' width='300'><font color='".$core32."'>".$sime32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 32

  echo "<b>Questão 32:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per32['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper32 != "Não possui"){

      echo "<img src='uploads/$imgper32' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp32 == 0) {

    echo "<input type='radio' name='radper32' $chea32 disabled id='radper32' value='Letra A'>";

    echo "<label><font color='".$cora32."'>A) ".$letraaper32['alternativa'].$sima32."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper32' $cheb32 disabled id='radper32' value='Letra B'>";
    
    echo "<label><font color='".$corb32."'>B) ".$letrabper32['alternativa'].$simb32."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper32' $chec32 disabled id='radper32' value='Letra C'>";
    
    echo "<label><font color='".$corc32."'>C) ".$letracper32['alternativa'].$simc32."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper32' $ched32 disabled id='radper32' value='Letra D'>";
    
    echo "<label><font color='".$cord32."'>D) ".$letradper32['alternativa'].$simd32."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper32' $chee32 disabled id='radper32' value='Letra E'>";
    
    echo "<label><font color='".$core32."'>E) ".$letraeper32['alternativa'].$sime32."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap32 = $letraaper32['alternativa'];

  $imgletbp32 = $letrabper32['alternativa'];

  $imgletcp32 = $letracper32['alternativa'];

  $imgletdp32 = $letradper32['alternativa'];

  $imgletep32 = $letraeper32['alternativa'];

  

  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra A' $chea32>";

  echo "<label>A) <br> <img src='img_res/$imgletap32' width='300'><font color='".$cora32."'>".$sima32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra B' $cheb32>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp32' width='300'><font color='".$corb32."'>".$simb32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra C' $chec32>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp32' width='300'><font color='".$corc32."'>".$simc32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra D' $ched32>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp32' width='300'><font color='".$cord32."'>".$simd32."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper32' disabled id='radper32' value='Letra E' $chee32>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep32' width='300'><font color='".$core32."'>".$sime32."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 33

  echo "<b>Questão 33:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per33['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper33 != "Não possui"){

      echo "<img src='uploads/$imgper33' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp33 == 0) {

    echo "<input type='radio' name='radper33' $chea33 disabled id='radper33' value='Letra A'>";

    echo "<label><font color='".$cora33."'>A) ".$letraaper33['alternativa'].$sima33."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper33' $cheb33 disabled id='radper33' value='Letra B'>";
    
    echo "<label><font color='".$corb33."'>B) ".$letrabper33['alternativa'].$simb33."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper33' $chec33 disabled id='radper33' value='Letra C'>";
    
    echo "<label><font color='".$corc33."'>C) ".$letracper33['alternativa'].$simc33."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper33' $ched33 disabled id='radper33' value='Letra D'>";
    
    echo "<label><font color='".$cord33."'>D) ".$letradper33['alternativa'].$simd33."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper33' $chee33 disabled id='radper33' value='Letra E'>";
    
    echo "<label><font color='".$core33."'>E) ".$letraeper33['alternativa'].$sime33."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap33 = $letraaper33['alternativa'];

  $imgletbp33 = $letrabper33['alternativa'];

  $imgletcp33 = $letracper33['alternativa'];

  $imgletdp33 = $letradper33['alternativa'];

  $imgletep33 = $letraeper33['alternativa'];

  

  echo "<input type='radio' name='radper33' disabled id='radper33' value='Letra A' $chea33>";

echo "<label>A) <br> <img src='img_res/$imgletap33' width='300'><font color='".$cora33."'>".$sima33."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper33' disabled id='radper33' value='Letra B' $cheb33>";

echo "<label>B) <br> <img src='img_res/$imgletbp33' width='300'><font color='".$corb33."'>".$simb33."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper33' disabled id='radper33' value='Letra C' $chec33>";

echo "<label>C) <br> <img src='img_res/$imgletcp33' width='300'><font color='".$corc33."'>".$simc33."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper33' disabled id='radper33' value='Letra D' $ched33>";

echo "<label>D) <br> <img src='img_res/$imgletdp33' width='300'><font color='".$cord33."'>".$simd33."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper33' disabled id='radper33' value='Letra E' $chee33>";

echo "<label>E) <br> <img src='img_res/$imgletep33' width='300'><font color='".$core33."'>".$sime33."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 34

  echo "<b>Questão 34:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per34['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper34 != "Não possui"){

      echo "<img src='uploads/$imgper34' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp34 == 0) {

    echo "<input type='radio' name='radper34' $chea34 disabled id='radper34' value='Letra A'>";

    echo "<label><font color='".$cora34."'>A) ".$letraaper34['alternativa'].$sima34."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper34' $cheb34 disabled id='radper34' value='Letra B'>";
    
    echo "<label><font color='".$corb34."'>B) ".$letrabper34['alternativa'].$simb34."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper34' $chec34 disabled id='radper34' value='Letra C'>";
    
    echo "<label><font color='".$corc34."'>C) ".$letracper34['alternativa'].$simc34."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper34' $ched34 disabled id='radper34' value='Letra D'>";
    
    echo "<label><font color='".$cord34."'>D) ".$letradper34['alternativa'].$simd34."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper34' $chee34 disabled id='radper34' value='Letra E'>";
    
    echo "<label><font color='".$core34."'>E) ".$letraeper34['alternativa'].$sime34."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap34 = $letraaper34['alternativa'];

  $imgletbp34 = $letrabper34['alternativa'];

  $imgletcp34 = $letracper34['alternativa'];

  $imgletdp34 = $letradper34['alternativa'];

  $imgletep34 = $letraeper34['alternativa'];

  

  echo "<input type='radio' name='radper34' disabled id='radper34' value='Letra A' $chea34>";

echo "<label>A) <br> <img src='img_res/$imgletap34' width='300'><font color='".$cora34."'>".$sima34."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper34' disabled id='radper34' value='Letra B' $cheb34>";

echo "<label>B) <br> <img src='img_res/$imgletbp34' width='300'><font color='".$corb34."'>".$simb34."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper34' disabled id='radper34' value='Letra C' $chec34>";

echo "<label>C) <br> <img src='img_res/$imgletcp34' width='300'><font color='".$corc34."'>".$simc34."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper34' disabled id='radper34' value='Letra D' $ched34>";

echo "<label>D) <br> <img src='img_res/$imgletdp34' width='300'><font color='".$cord34."'>".$simd34."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper34' disabled id='radper34' value='Letra E' $chee34>";

echo "<label>E) <br> <img src='img_res/$imgletep34' width='300'><font color='".$core34."'>".$sime34."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 35

  echo "<b>Questão 35:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per35['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper35 != "Não possui"){

      echo "<img src='uploads/$imgper35' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp35 == 0) {

    echo "<input type='radio' name='radper35' $chea35 disabled id='radper35' value='Letra A'>";

    echo "<label><font color='".$cora35."'>A) ".$letraaper35['alternativa'].$sima35."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper35' $cheb35 disabled id='radper35' value='Letra B'>";
    
    echo "<label><font color='".$corb35."'>B) ".$letrabper35['alternativa'].$simb35."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper35' $chec35 disabled id='radper35' value='Letra C'>";
    
    echo "<label><font color='".$corc35."'>C) ".$letracper35['alternativa'].$simc35."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper35' $ched35 disabled id='radper35' value='Letra D'>";
    
    echo "<label><font color='".$cord35."'>D) ".$letradper35['alternativa'].$simd35."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper35' $chee35 disabled id='radper35' value='Letra E'>";
    
    echo "<label><font color='".$core35."'>E) ".$letraeper35['alternativa'].$sime35."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap35 = $letraaper35['alternativa'];

  $imgletbp35 = $letrabper35['alternativa'];

  $imgletcp35 = $letracper35['alternativa'];

  $imgletdp35 = $letradper35['alternativa'];

  $imgletep35 = $letraeper35['alternativa'];

  

  echo "<input type='radio' name='radper35' disabled id='radper35' value='Letra A' $chea35>";

echo "<label>A) <br> <img src='img_res/$imgletap35' width='300'><font color='".$cora35."'>".$sima35."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper35' disabled id='radper35' value='Letra B' $cheb35>";

echo "<label>B) <br> <img src='img_res/$imgletbp35' width='300'><font color='".$corb35."'>".$simb35."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper35' disabled id='radper35' value='Letra C' $chec35>";

echo "<label>C) <br> <img src='img_res/$imgletcp35' width='300'><font color='".$corc35."'>".$simc35."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper35' disabled id='radper35' value='Letra D' $ched35>";

echo "<label>D) <br> <img src='img_res/$imgletdp35' width='300'><font color='".$cord35."'>".$simd35."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper35' disabled id='radper35' value='Letra E' $chee35>";

echo "<label>E) <br> <img src='img_res/$imgletep35' width='300'><font color='".$core35."'>".$sime35."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 36 à 40 -->

<?php 

if ($qtperguntas>35){

  // Inserindo quetão 36

  echo "<b>Questão 36:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per36['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper36 != "Não possui"){

      echo "<img src='uploads/$imgper36' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp36 == 0) {

    echo "<input type='radio' name='radper36' $chea36 disabled id='radper36' value='Letra A'>";

    echo "<label><font color='".$cora36."'>A) ".$letraaper36['alternativa'].$sima36."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper36' $cheb36 disabled id='radper36' value='Letra B'>";
    
    echo "<label><font color='".$corb36."'>B) ".$letrabper36['alternativa'].$simb36."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper36' $chec36 disabled id='radper36' value='Letra C'>";
    
    echo "<label><font color='".$corc36."'>C) ".$letracper36['alternativa'].$simc36."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper36' $ched36 disabled id='radper36' value='Letra D'>";
    
    echo "<label><font color='".$cord36."'>D) ".$letradper36['alternativa'].$simd36."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper36' $chee36 disabled id='radper36' value='Letra E'>";
    
    echo "<label><font color='".$core36."'>E) ".$letraeper36['alternativa'].$sime36."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap36 = $letraaper36['alternativa'];

  $imgletbp36 = $letrabper36['alternativa'];

  $imgletcp36 = $letracper36['alternativa'];

  $imgletdp36 = $letradper36['alternativa'];

  $imgletep36 = $letraeper36['alternativa'];

  

  echo "<input type='radio' name='radper36' disabled id='radper36' value='Letra A' $chea36>";

  echo "<label>A) <br> <img src='img_res/$imgletap36' width='300'><font color='".$cora36."'>".$sima36."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper36' disabled id='radper36' value='Letra B' $cheb36>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp36' width='300'><font color='".$corb36."'>".$simb36."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper36' disabled id='radper36' value='Letra C' $chec36>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp36' width='300'><font color='".$corc36."'>".$simc36."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper36' disabled id='radper36' value='Letra D' $ched36>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp36' width='300'><font color='".$cord36."'>".$simd36."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper36' disabled id='radper36' value='Letra E' $chee36>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep36' width='300'><font color='".$core36."'>".$sime36."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 37

  echo "<b>Questão 37:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per37['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper37 != "Não possui"){

      echo "<img src='uploads/$imgper37' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp37 == 0) {

    echo "<input type='radio' name='radper37' $chea37 disabled id='radper37' value='Letra A'>";

    echo "<label><font color='".$cora37."'>A) ".$letraaper37['alternativa'].$sima37."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper37' $cheb37 disabled id='radper37' value='Letra B'>";
    
    echo "<label><font color='".$corb37."'>B) ".$letrabper37['alternativa'].$simb37."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper37' $chec37 disabled id='radper37' value='Letra C'>";
    
    echo "<label><font color='".$corc37."'>C) ".$letracper37['alternativa'].$simc37."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper37' $ched37 disabled id='radper37' value='Letra D'>";
    
    echo "<label><font color='".$cord37."'>D) ".$letradper37['alternativa'].$simd37."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper37' $chee37 disabled id='radper37' value='Letra E'>";
    
    echo "<label><font color='".$core37."'>E) ".$letraeper37['alternativa'].$sime37."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap37 = $letraaper37['alternativa'];

  $imgletbp37 = $letrabper37['alternativa'];

  $imgletcp37 = $letracper37['alternativa'];

  $imgletdp37 = $letradper37['alternativa'];

  $imgletep37 = $letraeper37['alternativa'];

  

  echo "<input type='radio' name='radper1' disabled id='radper1' value='Letra A' $chea37>";

  echo "<label>A) <br> <img src='img_res/$imgletap37' width='300'><font color='".$cora37."'>".$sima37."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper37' disabled id='radper37' value='Letra B' $cheb37>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp37' width='300'><font color='".$corb37."'>".$simb37."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper37' disabled id='radper37' value='Letra C' $chec37>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp37' width='300'><font color='".$corc37."'>".$simc37."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper37' disabled id='radper37' value='Letra D' $ched37>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp37' width='300'><font color='".$cord37."'>".$simd37."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper37' disabled id='radper37' value='Letra E' $chee37>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep37' width='300'><font color='".$core37."'>".$sime37."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 38

  echo "<b>Questão 38:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per38['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper38 != "Não possui"){

      echo "<img src='uploads/$imgper38' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp38 == 0) {

    echo "<input type='radio' name='radper38' $chea38 disabled id='radper38' value='Letra A'>";

    echo "<label><font color='".$cora38."'>A) ".$letraaper38['alternativa'].$sima38."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper38' $cheb38 disabled id='radper38' value='Letra B'>";
    
    echo "<label><font color='".$corb38."'>B) ".$letrabper38['alternativa'].$simb38."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper38' $chec38 disabled id='radper38' value='Letra C'>";
    
    echo "<label><font color='".$corc38."'>C) ".$letracper38['alternativa'].$simc38."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper38' $ched38 disabled id='radper38' value='Letra D'>";
    
    echo "<label><font color='".$cord38."'>D) ".$letradper38['alternativa'].$simd38."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper38' $chee38 disabled id='radper38' value='Letra E'>";
    
    echo "<label><font color='".$core38."'>E) ".$letraeper38['alternativa'].$sime38."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap38 = $letraaper38['alternativa'];

  $imgletbp38 = $letrabper38['alternativa'];

  $imgletcp38 = $letracper38['alternativa'];

  $imgletdp38 = $letradper38['alternativa'];

  $imgletep38 = $letraeper38['alternativa'];

  

  echo "<input type='radio' name='radper38' disabled id='radper38' value='Letra A' $chea38>";

  echo "<label>A) <br> <img src='img_res/$imgletap38' width='300'><font color='".$cora38."'>".$sima38."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper38' disabled id='radper38' value='Letra B' $cheb38>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp38' width='300'><font color='".$corb38."'>".$simb38."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper38' disabled id='radper38' value='Letra C' $chec38>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp38' width='300'><font color='".$corc38."'>".$simc38."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper38' disabled id='radper38' value='Letra D' $ched38>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp38' width='300'><font color='".$cord38."'>".$simd38."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper38' disabled id='radper38' value='Letra E' $chee38>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep38' width='300'><font color='".$core38."'>".$sime38."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 39

  echo "<b>Questão 39:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per39['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper39 != "Não possui"){

      echo "<img src='uploads/$imgper39' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp39 == 0) {

    echo "<input type='radio' name='radper39' $chea39 disabled id='radper39' value='Letra A'>";

    echo "<label><font color='".$cora39."'>A) ".$letraaper39['alternativa'].$sima39."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper39' $cheb39 disabled id='radper39' value='Letra B'>";
    
    echo "<label><font color='".$corb39."'>B) ".$letrabper39['alternativa'].$simb39."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper39' $chec39 disabled id='radper39' value='Letra C'>";
    
    echo "<label><font color='".$corc39."'>C) ".$letracper39['alternativa'].$simc39."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper39' $ched39 disabled id='radper39' value='Letra D'>";
    
    echo "<label><font color='".$cord39."'>D) ".$letradper39['alternativa'].$simd39."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper39' $chee39 disabled id='radper39' value='Letra E'>";
    
    echo "<label><font color='".$core39."'>E) ".$letraeper39['alternativa'].$sime39."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap39 = $letraaper39['alternativa'];

  $imgletbp39 = $letrabper39['alternativa'];

  $imgletcp39 = $letracper39['alternativa'];

  $imgletdp39 = $letradper39['alternativa'];

  $imgletep39 = $letraeper39['alternativa'];

  

  echo "<input type='radio' name='radper39' disabled id='radper39' value='Letra A' $chea39>";

  echo "<label>A) <br> <img src='img_res/$imgletap39' width='300'><font color='".$cora39."'>".$sima39."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper39' disabled id='radper39' value='Letra B' $cheb39>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp39' width='300'><font color='".$corb39."'>".$simb39."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper39' disabled id='radper39' value='Letra C' $chec39>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp39' width='300'><font color='".$corc39."'>".$simc39."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper39' disabled id='radper39' value='Letra D' $ched39>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp39' width='300'><font color='".$cord39."'>".$simd39."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper39' disabled id='radper39' value='Letra E' $chee39>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep39' width='300'><font color='".$core39."'>".$sime39."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 40

  echo "<b>Questão 40:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per40['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper40 != "Não possui"){

      echo "<img src='uploads/$imgper40' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp40 == 0) {

    echo "<input type='radio' name='radper40' $chea40 disabled id='radper40' value='Letra A'>";

    echo "<label><font color='".$cora40."'>A) ".$letraaper40['alternativa'].$sima40."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper40' $cheb40 disabled id='radper40' value='Letra B'>";
    
    echo "<label><font color='".$corb40."'>B) ".$letrabper40['alternativa'].$simb40."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper40' $chec40 disabled id='radper40' value='Letra C'>";
    
    echo "<label><font color='".$corc40."'>C) ".$letracper40['alternativa'].$simc40."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper40' $ched40 disabled id='radper40' value='Letra D'>";
    
    echo "<label><font color='".$cord40."'>D) ".$letradper40['alternativa'].$simd40."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper40' $chee40 disabled id='radper40' value='Letra E'>";
    
    echo "<label><font color='".$core40."'>E) ".$letraeper40['alternativa'].$sime40."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap40 = $letraaper40['alternativa'];

  $imgletbp40 = $letrabper40['alternativa'];

  $imgletcp40 = $letracper40['alternativa'];

  $imgletdp40 = $letradper40['alternativa'];

  $imgletep40 = $letraeper40['alternativa'];

  

  echo "<input type='radio' name='radper40' disabled id='radper40' value='Letra A' $chea40>";

echo "<label>A) <br> <img src='img_res/$imgletap40' width='300'><font color='".$cora40."'>".$sima40."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper40' disabled id='radper40' value='Letra B' $cheb40>";

echo "<label>B) <br> <img src='img_res/$imgletbp40' width='300'><font color='".$corb40."'>".$simb40."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper40' disabled id='radper40' value='Letra C' $chec40>";

echo "<label>C) <br> <img src='img_res/$imgletcp40' width='300'><font color='".$corc40."'>".$simc40."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper40' disabled id='radper40' value='Letra D' $ched40>";

echo "<label>D) <br> <img src='img_res/$imgletdp40' width='300'><font color='".$cord40."'>".$simd40."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper40' disabled id='radper40' value='Letra E' $chee40>";

echo "<label>E) <br> <img src='img_res/$imgletep40' width='300'><font color='".$core40."'>".$sime40."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 41 à 45 -->

<?php 

if ($qtperguntas>40){

  // Inserindo quetão 41

  echo "<b>Questão 41:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per41['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper41 != "Não possui"){

      echo "<img src='uploads/$imgper41' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp41 == 0) {

    echo "<input type='radio' name='radper41' $chea41 disabled id='radper41' value='Letra A'>";

    echo "<label><font color='".$cora41."'>A) ".$letraaper41['alternativa'].$sima41."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper41' $cheb41 disabled id='radper41' value='Letra B'>";
    
    echo "<label><font color='".$corb41."'>B) ".$letrabper41['alternativa'].$simb41."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper41' $chec41 disabled id='radper41' value='Letra C'>";
    
    echo "<label><font color='".$corc41."'>C) ".$letracper41['alternativa'].$simc41."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper41' $ched41 disabled id='radper41' value='Letra D'>";
    
    echo "<label><font color='".$cord41."'>D) ".$letradper41['alternativa'].$simd41."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper41' $chee41 disabled id='radper41' value='Letra E'>";
    
    echo "<label><font color='".$core41."'>E) ".$letraeper41['alternativa'].$sime41."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap41 = $letraaper41['alternativa'];

  $imgletbp41 = $letrabper41['alternativa'];

  $imgletcp41 = $letracper41['alternativa'];

  $imgletdp41 = $letradper41['alternativa'];

  $imgletep41 = $letraeper41['alternativa'];

  

  echo "<input type='radio' name='radper42' disabled id='radper42' value='Letra A' $chea42>";

  echo "<label>A) <br> <img src='img_res/$imgletap42' width='300'><font color='".$cora42."'>".$sima42."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper42' disabled id='radper42' value='Letra B' $cheb42>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp42' width='300'><font color='".$corb42."'>".$simb42."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper42' disabled id='radper42' value='Letra C' $chec42>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp42' width='300'><font color='".$corc42."'>".$simc42."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper42' disabled id='radper42' value='Letra D' $ched42>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp42' width='300'><font color='".$cord42."'>".$simd42."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper42' disabled id='radper42' value='Letra E' $chee42>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep42' width='300'><font color='".$core42."'>".$sime42."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 42

  echo "<b>Questão 42:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per42['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper42 != "Não possui"){

      echo "<img src='uploads/$imgper42' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp42 == 0) {

    echo "<input type='radio' name='radper42' $chea42 disabled id='radper42' value='Letra A'>";

    echo "<label><font color='".$cora42."'>A) ".$letraaper42['alternativa'].$sima42."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper42' $cheb42 disabled id='radper42' value='Letra B'>";
    
    echo "<label><font color='".$corb42."'>B) ".$letrabper42['alternativa'].$simb42."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper42' $chec42 disabled id='radper42' value='Letra C'>";
    
    echo "<label><font color='".$corc42."'>C) ".$letracper42['alternativa'].$simc42."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper42' $ched42 disabled id='radper42' value='Letra D'>";
    
    echo "<label><font color='".$cord42."'>D) ".$letradper42['alternativa'].$simd42."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper42' $chee42 disabled id='radper42' value='Letra E'>";
    
    echo "<label><font color='".$core42."'>E) ".$letraeper42['alternativa'].$sime42."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap42 = $letraaper42['alternativa'];

  $imgletbp42 = $letrabper42['alternativa'];

  $imgletcp42 = $letracper42['alternativa'];

  $imgletdp42 = $letradper42['alternativa'];

  $imgletep42 = $letraeper42['alternativa'];

  

  echo "<input type='radio' name='radper43' disabled id='radper43' value='Letra A' $chea43>";

  echo "<label>A) <br> <img src='img_res/$imgletap43' width='300'><font color='".$cora43."'>".$sima43."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper43' disabled id='radper43' value='Letra B' $cheb43>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp43' width='300'><font color='".$corb43."'>".$simb43."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper43' disabled id='radper43' value='Letra C' $chec43>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp43' width='300'><font color='".$corc43."'>".$simc43."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper43' disabled id='radper43' value='Letra D' $ched43>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp43' width='300'><font color='".$cord43."'>".$simd43."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper43' disabled id='radper43' value='Letra E' $chee43>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep43' width='300'><font color='".$core43."'>".$sime43."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 43

  echo "<b>Questão 43:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per43['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper43 != "Não possui"){

      echo "<img src='uploads/$imgper43' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp43 == 0) {

    echo "<input type='radio' name='radper1' $chea43 disabled id='radper43' value='Letra A'>";

    echo "<label><font color='".$cora43."'>A) ".$letraaper43['alternativa'].$sima43."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper43' $cheb43 disabled id='radper43' value='Letra B'>";
    
    echo "<label><font color='".$corb43."'>B) ".$letrabper43['alternativa'].$simb43."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper43' $chec43 disabled id='radper43' value='Letra C'>";
    
    echo "<label><font color='".$corc43."'>C) ".$letracper43['alternativa'].$simc43."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper43' $ched43 disabled id='radper43' value='Letra D'>";
    
    echo "<label><font color='".$cord43."'>D) ".$letradper43['alternativa'].$simd43."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper43' $chee43 disabled id='radper43' value='Letra E'>";
    
    echo "<label><font color='".$core43."'>E) ".$letraeper43['alternativa'].$sime43."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap43 = $letraaper43['alternativa'];

  $imgletbp43 = $letrabper43['alternativa'];

  $imgletcp43 = $letracper43['alternativa'];

  $imgletdp43 = $letradper43['alternativa'];

  $imgletep43 = $letraeper43['alternativa'];

  

  echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra A' $chea44>";

  echo "<label>A) <br> <img src='img_res/$imgletap44' width='300'><font color='".$cora44."'>".$sima44."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra B' $cheb44>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp44' width='300'><font color='".$corb44."'>".$simb44."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra C' $chec44>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp44' width='300'><font color='".$corc44."'>".$simc44."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra D' $ched44>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp44' width='300'><font color='".$cord44."'>".$simd44."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra E' $chee44>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep44' width='300'><font color='".$core44."'>".$sime44."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 44

  echo "<b>Questão 44:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per44['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper44 != "Não possui"){

      echo "<img src='uploads/$imgper44' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp44 == 0) {

    echo "<input type='radio' name='radper44' $chea44 disabled id='radper44' value='Letra A'>";

    echo "<label><font color='".$cora44."'>A) ".$letraaper44['alternativa'].$sima44."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper44' $cheb44 disabled id='radper44' value='Letra B'>";
    
    echo "<label><font color='".$corb44."'>B) ".$letrabper44['alternativa'].$simb44."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper44' $chec44 disabled id='radper44' value='Letra C'>";
    
    echo "<label><font color='".$corc44."'>C) ".$letracper44['alternativa'].$simc44."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper44' $ched44 disabled id='radper44' value='Letra D'>";
    
    echo "<label><font color='".$cord44."'>D) ".$letradper44['alternativa'].$simd44."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper44' $chee44 disabled id='radper44' value='Letra E'>";
    
    echo "<label><font color='".$core44."'>E) ".$letraeper44['alternativa'].$sime44."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap44 = $letraaper44['alternativa'];

  $imgletbp44 = $letrabper44['alternativa'];

  $imgletcp44 = $letracper44['alternativa'];

  $imgletdp44 = $letradper44['alternativa'];

  $imgletep44 = $letraeper44['alternativa'];

  

  echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra A' $chea44>";

echo "<label>A) <br> <img src='img_res/$imgletap44' width='300'><font color='".$cora44."'>".$sima44."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra B' $cheb44>";

echo "<label>B) <br> <img src='img_res/$imgletbp44' width='300'><font color='".$corb44."'>".$simb44."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra C' $chec44>";

echo "<label>C) <br> <img src='img_res/$imgletcp44' width='300'><font color='".$corc44."'>".$simc44."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra D' $ched44>";

echo "<label>D) <br> <img src='img_res/$imgletdp44' width='300'><font color='".$cord44."'>".$simd44."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper44' disabled id='radper44' value='Letra E' $chee44>";

echo "<label>E) <br> <img src='img_res/$imgletep44' width='300'><font color='".$core44."'>".$sime44."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 45

  echo "<b>Questão 45:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per45['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper45 != "Não possui"){

      echo "<img src='uploads/$imgper45' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp45 == 0) {

    echo "<input type='radio' name='radper45' $chea45 disabled id='radper45' value='Letra A'>";

    echo "<label><font color='".$cora45."'>A) ".$letraaper45['alternativa'].$sima45."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper45' $cheb45 disabled id='radper45' value='Letra B'>";
    
    echo "<label><font color='".$corb45."'>B) ".$letrabper45['alternativa'].$simb45."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper45' $chec45 disabled id='radper45' value='Letra C'>";
    
    echo "<label><font color='".$corc45."'>C) ".$letracper45['alternativa'].$simc45."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper45' $ched45 disabled id='radper45' value='Letra D'>";
    
    echo "<label><font color='".$cord45."'>D) ".$letradper45['alternativa'].$simd45."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper45' $chee45 disabled id='radper45' value='Letra E'>";
    
    echo "<label><font color='".$core45."'>E) ".$letraeper45['alternativa'].$sime45."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap45 = $letraaper45['alternativa'];

  $imgletbp45 = $letrabper45['alternativa'];

  $imgletcp45 = $letracper45['alternativa'];

  $imgletdp45 = $letradper45['alternativa'];

  $imgletep45 = $letraeper45['alternativa'];

  

  echo "<input type='radio' name='radper45' disabled id='radper45' value='Letra A' $chea45>";

echo "<label>A) <br> <img src='img_res/$imgletap45' width='300'><font color='".$cora45."'>".$sima45."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper45' disabled id='radper45' value='Letra B' $cheb45>";

echo "<label>B) <br> <img src='img_res/$imgletbp45' width='300'><font color='".$corb45."'>".$simb45."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper45' disabled id='radper45' value='Letra C' $chec45>";

echo "<label>C) <br> <img src='img_res/$imgletcp45' width='300'><font color='".$corc45."'>".$simc45."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper45' disabled id='radper45' value='Letra D' $ched45>";

echo "<label>D) <br> <img src='img_res/$imgletdp45' width='300'><font color='".$cord45."'>".$simd45."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper45' disabled id='radper45' value='Letra E' $chee45>";

echo "<label>E) <br> <img src='img_res/$imgletep45' width='300'><font color='".$core45."'>".$sime45."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>



<!-- Verificando se existe a quetão de 46 à 50 -->

<?php 

if ($qtperguntas>45){

  // Inserindo quetão 46

  echo "<b>Questão 46:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per46['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper46 != "Não possui"){

      echo "<img src='uploads/$imgper46' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp46 == 0) {

    echo "<input type='radio' name='radper46' $chea46 disabled id='radper46' value='Letra A'>";

    echo "<label><font color='".$cora46."'>A) ".$letraaper46['alternativa'].$sima46."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper46' $cheb46 disabled id='radper46' value='Letra B'>";
    
    echo "<label><font color='".$corb46."'>B) ".$letrabper46['alternativa'].$simb46."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper46' $chec46 disabled id='radper46' value='Letra C'>";
    
    echo "<label><font color='".$corc46."'>C) ".$letracper46['alternativa'].$simc46."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper46' $ched46 disabled id='radper46' value='Letra D'>";
    
    echo "<label><font color='".$cord46."'>D) ".$letradper46['alternativa'].$simd46."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper46' $chee46 disabled id='radper46' value='Letra E'>";
    
    echo "<label><font color='".$core46."'>E) ".$letraeper46['alternativa'].$sime46."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap46 = $letraaper46['alternativa'];

  $imgletbp46 = $letrabper46['alternativa'];

  $imgletcp46 = $letracper46['alternativa'];

  $imgletdp46 = $letradper46['alternativa'];

  $imgletep46 = $letraeper46['alternativa'];

  

  echo "<input type='radio' name='radper46' disabled id='radper46' value='Letra A' $chea46>";

echo "<label>A) <br> <img src='img_res/$imgletap46' width='300'><font color='".$cora46."'>".$sima46."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper46' disabled id='radper46' value='Letra B' $cheb46>";

echo "<label>B) <br> <img src='img_res/$imgletbp46' width='300'><font color='".$corb46."'>".$simb46."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper46' disabled id='radper46' value='Letra C' $chec46>";

echo "<label>C) <br> <img src='img_res/$imgletcp46' width='300'><font color='".$corc46."'>".$simc46."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper46' disabled id='radper46' value='Letra D' $ched46>";

echo "<label>D) <br> <img src='img_res/$imgletdp46' width='300'><font color='".$cord46."'>".$simd46."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper46' disabled id='radper46' value='Letra E' $chee46>";

echo "<label>E) <br> <img src='img_res/$imgletep46' width='300'><font color='".$core46."'>".$sime46."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 47

  echo "<b>Questão 47:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per47['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper47 != "Não possui"){

      echo "<img src='uploads/$imgper47' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp47 == 0) {

    echo "<input type='radio' name='radper47' $chea47 disabled id='radper47' value='Letra A'>";

    echo "<label><font color='".$cora47."'>A) ".$letraaper47['alternativa'].$sima47."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper47' $cheb47 disabled id='radper47' value='Letra B'>";
    
    echo "<label><font color='".$corb47."'>B) ".$letrabper47['alternativa'].$simb47."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper47' $chec47 disabled id='radper47' value='Letra C'>";
    
    echo "<label><font color='".$corc47."'>C) ".$letracper47['alternativa'].$simc47."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper47' $ched47 disabled id='radper47' value='Letra D'>";
    
    echo "<label><font color='".$cord47."'>D) ".$letradper47['alternativa'].$simd47."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper47' $chee47 disabled id='radper47' value='Letra E'>";
    
    echo "<label><font color='".$core47."'>E) ".$letraeper47['alternativa'].$sime47."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap47 = $letraaper47['alternativa'];

  $imgletbp47 = $letrabper47['alternativa'];

  $imgletcp47 = $letracper47['alternativa'];

  $imgletdp47 = $letradper47['alternativa'];

  $imgletep47 = $letraeper47['alternativa'];

  

  echo "<input type='radio' name='radper47' disabled id='radper47' value='Letra A' $chea47>";

  echo "<label>A) <br> <img src='img_res/$imgletap47' width='300'><font color='".$cora47."'>".$sima47."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper47' disabled id='radper47' value='Letra B' $cheb47>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp47' width='300'><font color='".$corb47."'>".$simb47."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper47' disabled id='radper47' value='Letra C' $chec47>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp47' width='300'><font color='".$corc47."'>".$simc47."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper47' disabled id='radper47' value='Letra D' $ched47>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp47' width='300'><font color='".$cord47."'>".$simd47."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper47' disabled id='radper47' value='Letra E' $chee47>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep47' width='300'><font color='".$core47."'>".$sime47."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 48

  echo "<b>Questão 48:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per48['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper48 != "Não possui"){

      echo "<img src='uploads/$imgper48' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp48 == 0) {

    echo "<input type='radio' name='radper48' $chea48 disabled id='radper48' value='Letra A'>";

    echo "<label><font color='".$cora48."'>A) ".$letraaper48['alternativa'].$sima48."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper48' $cheb48 disabled id='radper48' value='Letra B'>";
    
    echo "<label><font color='".$corb48."'>B) ".$letrabper48['alternativa'].$simb48."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper48' $chec48 disabled id='radper48' value='Letra C'>";
    
    echo "<label><font color='".$corc48."'>C) ".$letracper48['alternativa'].$simc48."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper48' $ched48 disabled id='radper48' value='Letra D'>";
    
    echo "<label><font color='".$cord48."'>D) ".$letradper48['alternativa'].$simd48."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper48' $chee48 disabled id='radper48' value='Letra E'>";
    
    echo "<label><font color='".$core48."'>E) ".$letraeper48['alternativa'].$sime48."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap48 = $letraaper48['alternativa'];

  $imgletbp48 = $letrabper48['alternativa'];

  $imgletcp48 = $letracper48['alternativa'];

  $imgletdp48 = $letradper48['alternativa'];

  $imgletep48 = $letraeper48['alternativa'];

  

  echo "<input type='radio' name='radper48' disabled id='radper48' value='Letra A' $chea48>";

  echo "<label>A) <br> <img src='img_res/$imgletap48' width='300'><font color='".$cora48."'>".$sima48."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper48' disabled id='radper48' value='Letra B' $cheb48>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp48' width='300'><font color='".$corb48."'>".$simb48."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper48' disabled id='radper48' value='Letra C' $chec48>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp48' width='300'><font color='".$corc48."'>".$simc48."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper48' disabled id='radper48' value='Letra D' $ched48>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp48' width='300'><font color='".$cord48."'>".$simd48."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper48' disabled id='radper48' value='Letra E' $chee48>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep48' width='300'><font color='".$core48."'>".$sime48."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 49

  echo "<b>Questão 49:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per49['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper49 != "Não possui"){

      echo "<img src='uploads/$imgper49' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp49 == 0) {

    echo "<input type='radio' name='radper49' $chea49 disabled id='radper49' value='Letra A'>";

    echo "<label><font color='".$cora49."'>A) ".$letraaper49['alternativa'].$sima49."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper49' $cheb49 disabled id='radper49' value='Letra B'>";
    
    echo "<label><font color='".$corb49."'>B) ".$letrabper49['alternativa'].$simb49."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper49' $chec49 disabled id='radper49' value='Letra C'>";
    
    echo "<label><font color='".$corc49."'>C) ".$letracper49['alternativa'].$simc49."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper49' $ched49 disabled id='radper49' value='Letra D'>";
    
    echo "<label><font color='".$cord49."'>D) ".$letradper49['alternativa'].$simd49."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper49' $chee49 disabled id='radper49' value='Letra E'>";
    
    echo "<label><font color='".$core49."'>E) ".$letraeper49['alternativa'].$sime49."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap49 = $letraaper49['alternativa'];

  $imgletbp49 = $letrabper49['alternativa'];

  $imgletcp49 = $letracper49['alternativa'];

  $imgletdp49 = $letradper49['alternativa'];

  $imgletep49 = $letraeper49['alternativa'];

  

  echo "<input type='radio' name='radper49' disabled id='radper49' value='Letra A' $chea49>";

echo "<label>A) <br> <img src='img_res/$imgletap49' width='300'><font color='".$cora49."'>".$sima49."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper49' disabled id='radper49' value='Letra B' $cheb49>";

echo "<label>B) <br> <img src='img_res/$imgletbp49' width='300'><font color='".$corb49."'>".$simb49."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper49' disabled id='radper49' value='Letra C' $chec49>";

echo "<label>C) <br> <img src='img_res/$imgletcp49' width='300'><font color='".$corc49."'>".$simc49."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper49' disabled id='radper49' value='Letra D' $ched49>";

echo "<label>D) <br> <img src='img_res/$imgletdp49' width='300'><font color='".$cord49."'>".$simd49."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper49' disabled id='radper49' value='Letra E' $chee49>";

echo "<label>E) <br> <img src='img_res/$imgletep49' width='300'><font color='".$core49."'>".$sime49."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 50

  echo "<b>Questão 50:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per50['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper50 != "Não possui"){

      echo "<img src='uploads/$imgper50' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp50 == 0) {

    echo "<input type='radio' name='radper50' $chea50 disabled id='radper50' value='Letra A'>";

    echo "<label><font color='".$cora50."'>A) ".$letraaper50['alternativa'].$sima50."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper50' $cheb50 disabled id='radper50' value='Letra B'>";
    
    echo "<label><font color='".$corb50."'>B) ".$letrabper50['alternativa'].$simb50."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper50' $chec50 disabled id='radper50' value='Letra C'>";
    
    echo "<label><font color='".$corc50."'>C) ".$letracper50['alternativa'].$simc50."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper50' $ched50 disabled id='radper50' value='Letra D'>";
    
    echo "<label><font color='".$cord50."'>D) ".$letradper50['alternativa'].$simd50."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper50' $chee50 disabled id='radper50' value='Letra E'>";
    
    echo "<label><font color='".$core50."'>E) ".$letraeper50['alternativa'].$sime50."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap50 = $letraaper50['alternativa'];

  $imgletbp50 = $letrabper50['alternativa'];

  $imgletcp50 = $letracper50['alternativa'];

  $imgletdp50 = $letradper50['alternativa'];

  $imgletep50 = $letraeper50['alternativa'];

  

  echo "<input type='radio' name='radper50' disabled id='radper50' value='Letra A' $chea50>";

  echo "<label>A) <br> <img src='img_res/$imgletap50' width='300'><font color='".$cora50."'>".$sima50."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper50' disabled id='radper50' value='Letra B' $cheb50>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp50' width='300'><font color='".$corb50."'>".$simb50."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper50' disabled id='radper50' value='Letra C' $chec50>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp50' width='300'><font color='".$corc50."'>".$simc50."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper50' disabled id='radper50' value='Letra D' $ched50>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp50' width='300'><font color='".$cord50."'>".$simd50."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper50' disabled id='radper50' value='Letra E' $chee50>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep50' width='300'><font color='".$core50."'>".$sime50."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 51 à 55 -->

<?php 

if ($qtperguntas>50){

  // Inserindo quetão 51

  echo "<b>Questão 51:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per51['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper51 != "Não possui"){

      echo "<img src='uploads/$imgper51' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp51 == 0) {

    echo "<input type='radio' name='radper51' $chea51 disabled id='radper51' value='Letra A'>";

    echo "<label><font color='".$cora51."'>A) ".$letraaper51['alternativa'].$sima51."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper51' $cheb51 disabled id='radper51' value='Letra B'>";
    
    echo "<label><font color='".$corb51."'>B) ".$letrabper51['alternativa'].$simb51."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper51' $chec51 disabled id='radper51' value='Letra C'>";
    
    echo "<label><font color='".$corc51."'>C) ".$letracper51['alternativa'].$simc51."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper51' $ched51 disabled id='radper51' value='Letra D'>";
    
    echo "<label><font color='".$cord51."'>D) ".$letradper51['alternativa'].$simd51."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper51' $chee51 disabled id='radper51' value='Letra E'>";
    
    echo "<label><font color='".$core51."'>E) ".$letraeper51['alternativa'].$sime51."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap51 = $letraaper51['alternativa'];

  $imgletbp51 = $letrabper51['alternativa'];

  $imgletcp51 = $letracper51['alternativa'];

  $imgletdp51 = $letradper51['alternativa'];

  $imgletep51 = $letraeper51['alternativa'];

  

  echo "<input type='radio' name='radper51' disabled id='radper51' value='Letra A' $chea51>";

echo "<label>A) <br> <img src='img_res/$imgletap51' width='300'><font color='".$cora51."'>".$sima51."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper51' disabled id='radper51' value='Letra B' $cheb51>";

echo "<label>B) <br> <img src='img_res/$imgletbp51' width='300'><font color='".$corb51."'>".$simb51."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper51' disabled id='radper51' value='Letra C' $chec51>";

echo "<label>C) <br> <img src='img_res/$imgletcp51' width='300'><font color='".$corc51."'>".$simc51."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper51' disabled id='radper51' value='Letra D' $ched51>";

echo "<label>D) <br> <img src='img_res/$imgletdp51' width='300'><font color='".$cord51."'>".$simd51."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper51' disabled id='radper51' value='Letra E' $chee51>";

echo "<label>E) <br> <img src='img_res/$imgletep51' width='300'><font color='".$core51."'>".$sime51."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 52

  echo "<b>Questão 52:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per52['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper52 != "Não possui"){

      echo "<img src='uploads/$imgper52' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp52 == 0) {

    echo "<input type='radio' name='radper52' $chea52 disabled id='radper52' value='Letra A'>";

    echo "<label><font color='".$cora52."'>A) ".$letraaper52['alternativa'].$sima52."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper52' $cheb52 disabled id='radper52' value='Letra B'>";
    
    echo "<label><font color='".$corb52."'>B) ".$letrabper52['alternativa'].$simb52."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper52' $chec52 disabled id='radper52' value='Letra C'>";
    
    echo "<label><font color='".$corc52."'>C) ".$letracper52['alternativa'].$simc52."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper52' $ched52 disabled id='radper52' value='Letra D'>";
    
    echo "<label><font color='".$cord52."'>D) ".$letradper52['alternativa'].$simd52."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper52' $chee52 disabled id='radper52' value='Letra E'>";
    
    echo "<label><font color='".$core52."'>E) ".$letraeper52['alternativa'].$sime52."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap52 = $letraaper52['alternativa'];

  $imgletbp52 = $letrabper52['alternativa'];

  $imgletcp52 = $letracper52['alternativa'];

  $imgletdp52 = $letradper52['alternativa'];

  $imgletep52 = $letraeper52['alternativa'];

  

  echo "<input type='radio' name='radper52' disabled id='radper52' value='Letra A' $chea52>";

  echo "<label>A) <br> <img src='img_res/$imgletap52' width='300'><font color='".$cora52."'>".$sima52."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper52' disabled id='radper52' value='Letra B' $cheb52>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp52' width='300'><font color='".$corb52."'>".$simb52."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper52' disabled id='radper52' value='Letra C' $chec52>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp52' width='300'><font color='".$corc52."'>".$simc52."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper52' disabled id='radper52' value='Letra D' $ched52>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp52' width='300'><font color='".$cord52."'>".$simd52."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper52' disabled id='radper52' value='Letra E' $chee52>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep52' width='300'><font color='".$core52."'>".$sime52."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 53

  echo "<b>Questão 53:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per53['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper53 != "Não possui"){

      echo "<img src='uploads/$imgper53' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp53 == 0) {

    echo "<input type='radio' name='radper53' $chea53 disabled id='radper53' value='Letra A'>";

    echo "<label><font color='".$cora53."'>A) ".$letraaper53['alternativa'].$sima53."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper53' $cheb53 disabled id='radper53' value='Letra B'>";
    
    echo "<label><font color='".$corb53."'>B) ".$letrabper53['alternativa'].$simb53."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper53' $chec53 disabled id='radper53' value='Letra C'>";
    
    echo "<label><font color='".$corc53."'>C) ".$letracper53['alternativa'].$simc53."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper53' $ched53 disabled id='radper53' value='Letra D'>";
    
    echo "<label><font color='".$cord53."'>D) ".$letradper53['alternativa'].$simd53."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper53' $chee53 disabled id='radper53' value='Letra E'>";
    
    echo "<label><font color='".$core53."'>E) ".$letraeper53['alternativa'].$sime53."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap53 = $letraaper53['alternativa'];

  $imgletbp53 = $letrabper53['alternativa'];

  $imgletcp53 = $letracper53['alternativa'];

  $imgletdp53 = $letradper53['alternativa'];

  $imgletep53 = $letraeper53['alternativa'];

  

  echo "<input type='radio' name='radper53' disabled id='radper53' value='Letra A' $chea53>";

echo "<label>A) <br> <img src='img_res/$imgletap53' width='300'><font color='".$cora53."'>".$sima53."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper53' disabled id='radper53' value='Letra B' $cheb53>";

echo "<label>B) <br> <img src='img_res/$imgletbp53' width='300'><font color='".$corb53."'>".$simb53."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper53' disabled id='radper53' value='Letra C' $chec53>";

echo "<label>C) <br> <img src='img_res/$imgletcp53' width='300'><font color='".$corc53."'>".$simc53."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper53' disabled id='radper53' value='Letra D' $ched53>";

echo "<label>D) <br> <img src='img_res/$imgletdp53' width='300'><font color='".$cord53."'>".$simd53."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper53' disabled id='radper53' value='Letra E' $chee53>";

echo "<label>E) <br> <img src='img_res/$imgletep53' width='300'><font color='".$core53."'>".$sime53."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 54

  echo "<b>Questão 54:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per54['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper54 != "Não possui"){

      echo "<img src='uploads/$imgper54' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp54 == 0) {

    echo "<input type='radio' name='radper54' $chea54 disabled id='radper54' value='Letra A'>";

    echo "<label><font color='".$cora54."'>A) ".$letraaper54['alternativa'].$sima54."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper54' $cheb54 disabled id='radper54' value='Letra B'>";
    
    echo "<label><font color='".$corb54."'>B) ".$letrabper54['alternativa'].$simb54."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper54' $chec54 disabled id='radper54' value='Letra C'>";
    
    echo "<label><font color='".$corc54."'>C) ".$letracper54['alternativa'].$simc54."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper54' $ched54 disabled id='radper54' value='Letra D'>";
    
    echo "<label><font color='".$cord54."'>D) ".$letradper54['alternativa'].$simd54."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper54' $chee54 disabled id='radper54' value='Letra E'>";
    
    echo "<label><font color='".$core54."'>E) ".$letraeper54['alternativa'].$sime54."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap54 = $letraaper54['alternativa'];

  $imgletbp54 = $letrabper54['alternativa'];

  $imgletcp54 = $letracper54['alternativa'];

  $imgletdp54 = $letradper54['alternativa'];

  $imgletep54 = $letraeper54['alternativa'];

  

  echo "<input type='radio' name='radper54' disabled id='radper54' value='Letra A' $chea54>";

echo "<label>A) <br> <img src='img_res/$imgletap54' width='300'><font color='".$cora54."'>".$sima54."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper54' disabled id='radper54' value='Letra B' $cheb54>";

echo "<label>B) <br> <img src='img_res/$imgletbp54' width='300'><font color='".$corb54."'>".$simb54."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper54' disabled id='radper54' value='Letra C' $chec54>";

echo "<label>C) <br> <img src='img_res/$imgletcp54' width='300'><font color='".$corc54."'>".$simc54."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper54' disabled id='radper54' value='Letra D' $ched54>";

echo "<label>D) <br> <img src='img_res/$imgletdp54' width='300'><font color='".$cord54."'>".$simd54."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper54' disabled id='radper54' value='Letra E' $chee54>";

echo "<label>E) <br> <img src='img_res/$imgletep54' width='300'><font color='".$core54."'>".$sime54."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 55

  echo "<b>Questão 55:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per55['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper55 != "Não possui"){

      echo "<img src='uploads/$imgper55' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp55 == 0) {

    echo "<input type='radio' name='radper55' $chea55 disabled id='radper55' value='Letra A'>";

    echo "<label><font color='".$cora55."'>A) ".$letraaper55['alternativa'].$sima55."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper55' $cheb55 disabled id='radper55' value='Letra B'>";
    
    echo "<label><font color='".$corb55."'>B) ".$letrabper55['alternativa'].$simb55."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper55' $chec55 disabled id='radper55' value='Letra C'>";
    
    echo "<label><font color='".$corc55."'>C) ".$letracper55['alternativa'].$simc55."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper55' $ched55 disabled id='radper55' value='Letra D'>";
    
    echo "<label><font color='".$cord55."'>D) ".$letradper55['alternativa'].$simd55."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper55' $chee55 disabled id='radper55' value='Letra E'>";
    
    echo "<label><font color='".$core55."'>E) ".$letraeper55['alternativa'].$sime55."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap55 = $letraaper55['alternativa'];

  $imgletbp55 = $letrabper55['alternativa'];

  $imgletcp55 = $letracper55['alternativa'];

  $imgletdp55 = $letradper55['alternativa'];

  $imgletep55 = $letraeper55['alternativa'];

  

  echo "<input type='radio' name='radper55' disabled id='radper55' value='Letra A' $chea55>";

echo "<label>A) <br> <img src='img_res/$imgletap55' width='300'><font color='".$cora55."'>".$sima55."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper55' disabled id='radper55' value='Letra B' $cheb55>";

echo "<label>B) <br> <img src='img_res/$imgletbp55' width='300'><font color='".$corb55."'>".$simb55."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper55' disabled id='radper55' value='Letra C' $chec55>";

echo "<label>C) <br> <img src='img_res/$imgletcp55' width='300'><font color='".$corc55."'>".$simc55."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper55' disabled id='radper55' value='Letra D' $ched55>";

echo "<label>D) <br> <img src='img_res/$imgletdp55' width='300'><font color='".$cord55."'>".$simd55."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper55' disabled id='radper55' value='Letra E' $chee55>";

echo "<label>E) <br> <img src='img_res/$imgletep55' width='300'><font color='".$core55."'>".$sime55."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 56 à 60 -->

<?php 

if ($qtperguntas>55){

  // Inserindo quetão 56

  echo "<b>Questão 56:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per56['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper56 != "Não possui"){

      echo "<img src='uploads/$imgper56' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp56 == 0) {

    echo "<input type='radio' name='radper56' $chea56 disabled id='radper56' value='Letra A'>";

    echo "<label><font color='".$cora56."'>A) ".$letraaper56['alternativa'].$sima56."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper56' $cheb56 disabled id='radper56' value='Letra B'>";
    
    echo "<label><font color='".$corb56."'>B) ".$letrabper56['alternativa'].$simb56."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper56' $chec56 disabled id='radper56' value='Letra C'>";
    
    echo "<label><font color='".$corc56."'>C) ".$letracper56['alternativa'].$simc56."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper56' $ched56 disabled id='radper56' value='Letra D'>";
    
    echo "<label><font color='".$cord56."'>D) ".$letradper56['alternativa'].$simd56."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper56' $chee56 disabled id='radper56' value='Letra E'>";
    
    echo "<label><font color='".$core56."'>E) ".$letraeper56['alternativa'].$sime56."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap56 = $letraaper56['alternativa'];

  $imgletbp56 = $letrabper56['alternativa'];

  $imgletcp56 = $letracper56['alternativa'];

  $imgletdp56 = $letradper56['alternativa'];

  $imgletep56 = $letraeper56['alternativa'];

  

  echo "<input type='radio' name='radper56' disabled id='radper56' value='Letra A' $chea56>";

  echo "<label>A) <br> <img src='img_res/$imgletap56' width='300'><font color='".$cora56."'>".$sima56."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper56' disabled id='radper56' value='Letra B' $cheb56>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp56' width='300'><font color='".$corb56."'>".$simb56."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper56' disabled id='radper56' value='Letra C' $chec56>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp56' width='300'><font color='".$corc56."'>".$simc56."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper56' disabled id='radper56' value='Letra D' $ched56>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp56' width='300'><font color='".$cord56."'>".$simd56."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper56' disabled id='radper56' value='Letra E' $chee56>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep56' width='300'><font color='".$core56."'>".$sime56."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 57

  echo "<b>Questão 57:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per57['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper57 != "Não possui"){

      echo "<img src='uploads/$imgper57' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp57 == 0) {

    echo "<input type='radio' name='radper57' $chea57 disabled id='radper57' value='Letra A'>";

    echo "<label><font color='".$cora57."'>A) ".$letraaper57['alternativa'].$sima57."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper57' $cheb57 disabled id='radper57' value='Letra B'>";
    
    echo "<label><font color='".$corb57."'>B) ".$letrabper57['alternativa'].$simb57."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper57' $chec57 disabled id='radper57' value='Letra C'>";
    
    echo "<label><font color='".$corc57."'>C) ".$letracper57['alternativa'].$simc57."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper57' $ched57 disabled id='radper57' value='Letra D'>";
    
    echo "<label><font color='".$cord57."'>D) ".$letradper57['alternativa'].$simd57."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper57' $chee57 disabled id='radper57' value='Letra E'>";
    
    echo "<label><font color='".$core57."'>E) ".$letraeper57['alternativa'].$sime57."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap57 = $letraaper57['alternativa'];

  $imgletbp57 = $letrabper57['alternativa'];

  $imgletcp57 = $letracper57['alternativa'];

  $imgletdp57 = $letradper57['alternativa'];

  $imgletep57 = $letraeper57['alternativa'];

  

  echo "<input type='radio' name='radper57' disabled id='radper57' value='Letra A' $chea57>";

  echo "<label>A) <br> <img src='img_res/$imgletap57' width='300'><font color='".$cora57."'>".$sima57."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper57' disabled id='radper57' value='Letra B' $cheb57>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp57' width='300'><font color='".$corb57."'>".$simb57."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper57' disabled id='radper57' value='Letra C' $chec57>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp57' width='300'><font color='".$corc57."'>".$simc57."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper57' disabled id='radper57' value='Letra D' $ched57>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp57' width='300'><font color='".$cord57."'>".$simd57."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper57' disabled id='radper57' value='Letra E' $chee57>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep57' width='300'><font color='".$core57."'>".$sime57."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 58

  echo "<b>Questão 58:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per58['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper58 != "Não possui"){

      echo "<img src='uploads/$imgper58' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp58 == 0) {

    echo "<input type='radio' name='radper58' $chea58 disabled id='radper58' value='Letra A'>";

    echo "<label><font color='".$cora58."'>A) ".$letraaper58['alternativa'].$sima58."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper58' $cheb58 disabled id='radper58' value='Letra B'>";
    
    echo "<label><font color='".$corb58."'>B) ".$letrabper58['alternativa'].$simb58."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper58' $chec58 disabled id='radper58' value='Letra C'>";
    
    echo "<label><font color='".$corc58."'>C) ".$letracper58['alternativa'].$simc58."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper58' $ched58 disabled id='radper58' value='Letra D'>";
    
    echo "<label><font color='".$cord58."'>D) ".$letradper58['alternativa'].$simd58."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper58' $chee58 disabled id='radper58' value='Letra E'>";
    
    echo "<label><font color='".$core58."'>E) ".$letraeper58['alternativa'].$sime58."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap58 = $letraaper58['alternativa'];

  $imgletbp58 = $letrabper58['alternativa'];

  $imgletcp58 = $letracper58['alternativa'];

  $imgletdp58 = $letradper58['alternativa'];

  $imgletep58 = $letraeper58['alternativa'];

  

  echo "<input type='radio' name='radper59' disabled id='radper59' value='Letra A' $chea59>";

echo "<label>A) <br> <img src='img_res/$imgletap59' width='300'><font color='".$cora59."'>".$sima59."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper59' disabled id='radper59' value='Letra B' $cheb59>";

echo "<label>B) <br> <img src='img_res/$imgletbp59' width='300'><font color='".$corb59."'>".$simb59."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper59' disabled id='radper59' value='Letra C' $chec59>";

echo "<label>C) <br> <img src='img_res/$imgletcp59' width='300'><font color='".$corc59."'>".$simc59."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper59' disabled id='radper59' value='Letra D' $ched59>";

echo "<label>D) <br> <img src='img_res/$imgletdp59' width='300'><font color='".$cord59."'>".$simd59."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper59' disabled id='radper59' value='Letra E' $chee59>";

echo "<label>E) <br> <img src='img_res/$imgletep59' width='300'><font color='".$core59."'>".$sime59."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 59

  echo "<b>Questão 59:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per59['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper59 != "Não possui"){

      echo "<img src='uploads/$imgper59' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp59 == 0) {

    echo "<input type='radio' name='radper59' $chea59 disabled id='radper59' value='Letra A'>";

    echo "<label><font color='".$cora59."'>A) ".$letraaper59['alternativa'].$sima59."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper59' $cheb59 disabled id='radper59' value='Letra B'>";
    
    echo "<label><font color='".$corb59."'>B) ".$letrabper59['alternativa'].$simb59."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper59' $chec59 disabled id='radper59' value='Letra C'>";
    
    echo "<label><font color='".$corc59."'>C) ".$letracper59['alternativa'].$simc59."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper59' $ched59 disabled id='radper59' value='Letra D'>";
    
    echo "<label><font color='".$cord59."'>D) ".$letradper59['alternativa'].$simd59."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper59' $chee59 disabled id='radper59' value='Letra E'>";
    
    echo "<label><font color='".$core59."'>E) ".$letraeper59['alternativa'].$sime59."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap59 = $letraaper59['alternativa'];

  $imgletbp59 = $letrabper59['alternativa'];

  $imgletcp59 = $letracper59['alternativa'];

  $imgletdp59 = $letradper59['alternativa'];

  $imgletep59 = $letraeper59['alternativa'];

  

  echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra A' $chea60>";

echo "<label>A) <br> <img src='img_res/$imgletap60' width='300'><font color='".$cora60."'>".$sima60."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra B' $cheb60>";

echo "<label>B) <br> <img src='img_res/$imgletbp60' width='300'><font color='".$corb60."'>".$simb60."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra C' $chec60>";

echo "<label>C) <br> <img src='img_res/$imgletcp60' width='300'><font color='".$corc60."'>".$simc60."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra D' $ched60>";

echo "<label>D) <br> <img src='img_res/$imgletdp60' width='300'><font color='".$cord60."'>".$simd60."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra E' $chee60>";

echo "<label>E) <br> <img src='img_res/$imgletep60' width='300'><font color='".$core60."'>".$sime60."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 60

  echo "<b>Questão 60:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per60['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper60 != "Não possui"){

      echo "<img src='uploads/$imgper60' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp60 == 0) {

    echo "<input type='radio' name='radper60' $chea60 disabled id='radper60' value='Letra A'>";

    echo "<label><font color='".$cora60."'>A) ".$letraaper60['alternativa'].$sima60."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper60' $cheb60 disabled id='radper60' value='Letra B'>";
    
    echo "<label><font color='".$corb60."'>B) ".$letrabper60['alternativa'].$simb60."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper60' $chec60 disabled id='radper60' value='Letra C'>";
    
    echo "<label><font color='".$corc60."'>C) ".$letracper60['alternativa'].$simc60."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper60' $ched60 disabled id='radper60' value='Letra D'>";
    
    echo "<label><font color='".$cord60."'>D) ".$letradper60['alternativa'].$simd60."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper60' $chee60 disabled id='radper60' value='Letra E'>";
    
    echo "<label><font color='".$core60."'>E) ".$letraeper60['alternativa'].$sime60."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap60 = $letraaper60['alternativa'];

  $imgletbp60 = $letrabper60['alternativa'];

  $imgletcp60 = $letracper60['alternativa'];

  $imgletdp60 = $letradper60['alternativa'];

  $imgletep60 = $letraeper60['alternativa'];

  

  echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra A' $chea60>";

  echo "<label>A) <br> <img src='img_res/$imgletap60' width='300'><font color='".$cora60."'>".$sima60."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra B' $cheb60>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp60' width='300'><font color='".$corb60."'>".$simb60."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra C' $chec60>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp60' width='300'><font color='".$corc60."'>".$simc60."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra D' $ched60>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp60' width='300'><font color='".$cord60."'>".$simd60."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper60' disabled id='radper60' value='Letra E' $chee60>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep60' width='300'><font color='".$core60."'>".$sime60."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 61 à 65 -->

<?php 

if ($qtperguntas>60){

  // Inserindo quetão 61

  echo "<b>Questão 61:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per61['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper61 != "Não possui"){

      echo "<img src='uploads/$imgper61' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp61 == 0) {

    echo "<input type='radio' name='radper61' $chea61 disabled id='radper61' value='Letra A'>";

    echo "<label><font color='".$cora61."'>A) ".$letraaper61['alternativa'].$sima61."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper61' $cheb61 disabled id='radper61' value='Letra B'>";
    
    echo "<label><font color='".$corb61."'>B) ".$letrabper61['alternativa'].$simb61."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper61' $chec61 disabled id='radper61' value='Letra C'>";
    
    echo "<label><font color='".$corc61."'>C) ".$letracper61['alternativa'].$simc61."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper61' $ched61 disabled id='radper61' value='Letra D'>";
    
    echo "<label><font color='".$cord61."'>D) ".$letradper61['alternativa'].$simd61."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper61' $chee61 disabled id='radper61' value='Letra E'>";
    
    echo "<label><font color='".$core61."'>E) ".$letraeper61['alternativa'].$sime61."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap61 = $letraaper61['alternativa'];

  $imgletbp61 = $letrabper61['alternativa'];

  $imgletcp61 = $letracper61['alternativa'];

  $imgletdp61 = $letradper61['alternativa'];

  $imgletep61 = $letraeper61['alternativa'];

  

  echo "<input type='radio' name='radper61' disabled id='radper61' value='Letra A' $chea61>";

echo "<label>A) <br> <img src='img_res/$imgletap61' width='300'><font color='".$cora61."'>".$sima61."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper61' disabled id='radper61' value='Letra B' $cheb61>";

echo "<label>B) <br> <img src='img_res/$imgletbp61' width='300'><font color='".$corb61."'>".$simb61."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper61' disabled id='radper61' value='Letra C' $chec61>";

echo "<label>C) <br> <img src='img_res/$imgletcp61' width='300'><font color='".$corc61."'>".$simc61."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper61' disabled id='radper61' value='Letra D' $ched61>";

echo "<label>D) <br> <img src='img_res/$imgletdp61' width='300'><font color='".$cord61."'>".$simd61."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper61' disabled id='radper61' value='Letra E' $chee61>";

echo "<label>E) <br> <img src='img_res/$imgletep61' width='300'><font color='".$core61."'>".$sime61."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 62

  echo "<b>Questão 62:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per62['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper62 != "Não possui"){

      echo "<img src='uploads/$imgper62' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp62 == 0) {

    echo "<input type='radio' name='radper62' $chea62 disabled id='radper62' value='Letra A'>";

    echo "<label><font color='".$cora62."'>A) ".$letraaper62['alternativa'].$sima62."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper62' $cheb62 disabled id='radper62' value='Letra B'>";
    
    echo "<label><font color='".$corb62."'>B) ".$letrabper62['alternativa'].$simb62."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper62' $chec62 disabled id='radper62' value='Letra C'>";
    
    echo "<label><font color='".$corc62."'>C) ".$letracper62['alternativa'].$simc62."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper62' $ched62 disabled id='radper62' value='Letra D'>";
    
    echo "<label><font color='".$cord62."'>D) ".$letradper62['alternativa'].$simd62."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper62' $chee62 disabled id='radper62' value='Letra E'>";
    
    echo "<label><font color='".$core62."'>E) ".$letraeper62['alternativa'].$sime62."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap62 = $letraaper62['alternativa'];

  $imgletbp62 = $letrabper62['alternativa'];

  $imgletcp62 = $letracper62['alternativa'];

  $imgletdp62 = $letradper62['alternativa'];

  $imgletep62 = $letraeper62['alternativa'];

  

  echo "<input type='radio' name='radper62' disabled id='radper62' value='Letra A' $chea62>";

echo "<label>A) <br> <img src='img_res/$imgletap62' width='300'><font color='".$cora62."'>".$sima62."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper62' disabled id='radper62' value='Letra B' $cheb62>";

echo "<label>B) <br> <img src='img_res/$imgletbp62' width='300'><font color='".$corb62."'>".$simb62."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper62' disabled id='radper62' value='Letra C' $chec62>";

echo "<label>C) <br> <img src='img_res/$imgletcp62' width='300'><font color='".$corc62."'>".$simc62."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper62' disabled id='radper62' value='Letra D' $ched62>";

echo "<label>D) <br> <img src='img_res/$imgletdp62' width='300'><font color='".$cord62."'>".$simd62."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper62' disabled id='radper62' value='Letra E' $chee62>";

echo "<label>E) <br> <img src='img_res/$imgletep62' width='300'><font color='".$core62."'>".$sime62."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 63

  echo "<b>Questão 63:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per63['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper63 != "Não possui"){

      echo "<img src='uploads/$imgper63' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp63 == 0) {

    echo "<input type='radio' name='radper63' $chea63 disabled id='radper63' value='Letra A'>";

    echo "<label><font color='".$cora63."'>A) ".$letraaper63['alternativa'].$sima63."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper63' $cheb63 disabled id='radper63' value='Letra B'>";
    
    echo "<label><font color='".$corb63."'>B) ".$letrabper63['alternativa'].$simb63."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper63' $chec63 disabled id='radper63' value='Letra C'>";
    
    echo "<label><font color='".$corc63."'>C) ".$letracper63['alternativa'].$simc63."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper63' $ched63 disabled id='radper63' value='Letra D'>";
    
    echo "<label><font color='".$cord63."'>D) ".$letradper63['alternativa'].$simd63."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper63' $chee63 disabled id='radper63' value='Letra E'>";
    
    echo "<label><font color='".$core63."'>E) ".$letraeper63['alternativa'].$sime63."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap63 = $letraaper63['alternativa'];

  $imgletbp63 = $letrabper63['alternativa'];

  $imgletcp63 = $letracper63['alternativa'];

  $imgletdp63 = $letradper63['alternativa'];

  $imgletep63 = $letraeper63['alternativa'];

  

  echo "<input type='radio' name='radper63' disabled id='radper63' value='Letra A' $chea63>";

echo "<label>A) <br> <img src='img_res/$imgletap63' width='300'><font color='".$cora63."'>".$sima63."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper63' disabled id='radper63' value='Letra B' $cheb63>";

echo "<label>B) <br> <img src='img_res/$imgletbp63' width='300'><font color='".$corb63."'>".$simb63."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper63' disabled id='radper63' value='Letra C' $chec63>";

echo "<label>C) <br> <img src='img_res/$imgletcp63' width='300'><font color='".$corc63."'>".$simc63."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper63' disabled id='radper63' value='Letra D' $ched63>";

echo "<label>D) <br> <img src='img_res/$imgletdp63' width='300'><font color='".$cord63."'>".$simd63."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper63' disabled id='radper63' value='Letra E' $chee63>";

echo "<label>E) <br> <img src='img_res/$imgletep63' width='300'><font color='".$core63."'>".$sime63."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 64

  echo "<b>Questão 64:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per64['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper64 != "Não possui"){

      echo "<img src='uploads/$imgper64' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp64 == 0) {

    echo "<input type='radio' name='radper64' $chea64 disabled id='radper64' value='Letra A'>";

    echo "<label><font color='".$cora64."'>A) ".$letraaper64['alternativa'].$sima64."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper64' $cheb64 disabled id='radper64' value='Letra B'>";
    
    echo "<label><font color='".$corb64."'>B) ".$letrabper64['alternativa'].$simb64."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper64' $chec64 disabled id='radper64' value='Letra C'>";
    
    echo "<label><font color='".$corc64."'>C) ".$letracper64['alternativa'].$simc64."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper64' $ched64 disabled id='radper64' value='Letra D'>";
    
    echo "<label><font color='".$cord64."'>D) ".$letradper64['alternativa'].$simd64."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper64' $chee64 disabled id='radper64' value='Letra E'>";
    
    echo "<label><font color='".$core64."'>E) ".$letraeper64['alternativa'].$sime64."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap64 = $letraaper64['alternativa'];

  $imgletbp64 = $letrabper64['alternativa'];

  $imgletcp64 = $letracper64['alternativa'];

  $imgletdp64 = $letradper64['alternativa'];

  $imgletep64 = $letraeper64['alternativa'];

  

  echo "<input type='radio' name='radper64' disabled id='radper64' value='Letra A' $chea64>";

echo "<label>A) <br> <img src='img_res/$imgletap64' width='300'><font color='".$cora64."'>".$sima64."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper64' disabled id='radper64' value='Letra B' $cheb64>";

echo "<label>B) <br> <img src='img_res/$imgletbp64' width='300'><font color='".$corb64."'>".$simb64."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper64' disabled id='radper64' value='Letra C' $chec64>";

echo "<label>C) <br> <img src='img_res/$imgletcp64' width='300'><font color='".$corc64."'>".$simc64."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper64' disabled id='radper64' value='Letra D' $ched64>";

echo "<label>D) <br> <img src='img_res/$imgletdp64' width='300'><font color='".$cord64."'>".$simd64."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper64' disabled id='radper64' value='Letra E' $chee64>";

echo "<label>E) <br> <img src='img_res/$imgletep64' width='300'><font color='".$core64."'>".$sime64."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 65

  echo "<b>Questão 65:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per65['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper65 != "Não possui"){

      echo "<img src='uploads/$imgper65' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp65 == 0) {

    echo "<input type='radio' name='radper65' $chea65 disabled id='radper65' value='Letra A'>";

    echo "<label><font color='".$cora65."'>A) ".$letraaper65['alternativa'].$sima65."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper65' $cheb65 disabled id='radper65' value='Letra B'>";
    
    echo "<label><font color='".$corb65."'>B) ".$letrabper65['alternativa'].$simb65."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper65' $chec65 disabled id='radper65' value='Letra C'>";
    
    echo "<label><font color='".$corc65."'>C) ".$letracper65['alternativa'].$simc65."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper65' $ched65 disabled id='radper65' value='Letra D'>";
    
    echo "<label><font color='".$cord65."'>D) ".$letradper65['alternativa'].$simd65."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper65' $chee65 disabled id='radper65' value='Letra E'>";
    
    echo "<label><font color='".$core65."'>E) ".$letraeper65['alternativa'].$sime65."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap65 = $letraaper65['alternativa'];

  $imgletbp65 = $letrabper65['alternativa'];

  $imgletcp65 = $letracper65['alternativa'];

  $imgletdp65 = $letradper65['alternativa'];

  $imgletep65 = $letraeper65['alternativa'];

  

  echo "<input type='radio' name='radper65' disabled id='radper65' value='Letra A' $chea65>";

echo "<label>A) <br> <img src='img_res/$imgletap65' width='300'><font color='".$cora65."'>".$sima65."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper65' disabled id='radper65' value='Letra B' $cheb65>";

echo "<label>B) <br> <img src='img_res/$imgletbp65' width='300'><font color='".$corb65."'>".$simb65."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper65' disabled id='radper65' value='Letra C' $chec65>";

echo "<label>C) <br> <img src='img_res/$imgletcp65' width='300'><font color='".$corc65."'>".$simc65."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper65' disabled id='radper65' value='Letra D' $ched65>";

echo "<label>D) <br> <img src='img_res/$imgletdp65' width='300'><font color='".$cord65."'>".$simd65."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper65' disabled id='radper65' value='Letra E' $chee65>";

echo "<label>E) <br> <img src='img_res/$imgletep65' width='300'><font color='".$core65."'>".$sime65."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 66 à 70 -->

<?php 

if ($qtperguntas>65){

  // Inserindo quetão 66

  echo "<b>Questão 66:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per66['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper66 != "Não possui"){

      echo "<img src='uploads/$imgper66' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp66 == 0) {

    echo "<input type='radio' name='radper66' $chea66 disabled id='radper66' value='Letra A'>";

    echo "<label><font color='".$cora66."'>A) ".$letraaper66['alternativa'].$sima66."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper66' $cheb66 disabled id='radper66' value='Letra B'>";
    
    echo "<label><font color='".$corb66."'>B) ".$letrabper66['alternativa'].$simb66."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper66' $chec66 disabled id='radper66' value='Letra C'>";
    
    echo "<label><font color='".$corc66."'>C) ".$letracper66['alternativa'].$simc66."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper66' $ched66 disabled id='radper66' value='Letra D'>";
    
    echo "<label><font color='".$cord66."'>D) ".$letradper66['alternativa'].$simd66."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper66' $chee66 disabled id='radper66' value='Letra E'>";
    
    echo "<label><font color='".$core66."'>E) ".$letraeper66['alternativa'].$sime66."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap66 = $letraaper66['alternativa'];

  $imgletbp66 = $letrabper66['alternativa'];

  $imgletcp66 = $letracper66['alternativa'];

  $imgletdp66 = $letradper66['alternativa'];

  $imgletep66 = $letraeper66['alternativa'];

  

  echo "<input type='radio' name='radper66' disabled id='radper66' value='Letra A' $chea66>";

  echo "<label>A) <br> <img src='img_res/$imgletap66' width='300'><font color='".$cora66."'>".$sima66."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper66' disabled id='radper66' value='Letra B' $cheb66>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp66' width='300'><font color='".$corb66."'>".$simb66."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper66' disabled id='radper66' value='Letra C' $chec66>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp66' width='300'><font color='".$corc66."'>".$simc66."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper66' disabled id='radper66' value='Letra D' $ched66>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp66' width='300'><font color='".$cord66."'>".$simd66."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper66' disabled id='radper66' value='Letra E' $chee66>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep66' width='300'><font color='".$core66."'>".$sime66."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 67

  echo "<b>Questão 67:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per67['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper67 != "Não possui"){

      echo "<img src='uploads/$imgper67' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp67 == 0) {

    echo "<input type='radio' name='radper67' $chea67 disabled id='radper67' value='Letra A'>";

    echo "<label><font color='".$cora67."'>A) ".$letraaper67['alternativa'].$sima67."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper67' $cheb67 disabled id='radper67' value='Letra B'>";
    
    echo "<label><font color='".$corb67."'>B) ".$letrabper67['alternativa'].$simb67."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper67' $chec67 disabled id='radper67' value='Letra C'>";
    
    echo "<label><font color='".$corc67."'>C) ".$letracper67['alternativa'].$simc67."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper67' $ched67 disabled id='radper67' value='Letra D'>";
    
    echo "<label><font color='".$cord67."'>D) ".$letradper67['alternativa'].$simd67."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper67' $chee67 disabled id='radper67' value='Letra E'>";
    
    echo "<label><font color='".$core67."'>E) ".$letraeper67['alternativa'].$sime67."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap67 = $letraaper67['alternativa'];

  $imgletbp67 = $letrabper67['alternativa'];

  $imgletcp67 = $letracper67['alternativa'];

  $imgletdp67 = $letradper67['alternativa'];

  $imgletep67 = $letraeper67['alternativa'];

  

  echo "<input type='radio' name='radper67' disabled id='radper67' value='Letra A' $chea67>";

echo "<label>A) <br> <img src='img_res/$imgletap67' width='300'><font color='".$cora67."'>".$sima67."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper67' disabled id='radper67' value='Letra B' $cheb67>";

echo "<label>B) <br> <img src='img_res/$imgletbp67' width='300'><font color='".$corb67."'>".$simb67."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper67' disabled id='radper67' value='Letra C' $chec67>";

echo "<label>C) <br> <img src='img_res/$imgletcp67' width='300'><font color='".$corc67."'>".$simc67."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper67' disabled id='radper67' value='Letra D' $ched67>";

echo "<label>D) <br> <img src='img_res/$imgletdp67' width='300'><font color='".$cord67."'>".$simd67."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper67' disabled id='radper67' value='Letra E' $chee67>";

echo "<label>E) <br> <img src='img_res/$imgletep67' width='300'><font color='".$core67."'>".$sime67."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 68

  echo "<b>Questão 68:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per68['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper68 != "Não possui"){

      echo "<img src='uploads/$imgper68' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp68 == 0) {

    echo "<input type='radio' name='radper68' $chea68 disabled id='radper68' value='Letra A'>";

    echo "<label><font color='".$cora68."'>A) ".$letraaper68['alternativa'].$sima68."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper68' $cheb68 disabled id='radper68' value='Letra B'>";
    
    echo "<label><font color='".$corb68."'>B) ".$letrabper68['alternativa'].$simb68."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper68' $chec68 disabled id='radper68' value='Letra C'>";
    
    echo "<label><font color='".$corc68."'>C) ".$letracper68['alternativa'].$simc68."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper68' $ched68 disabled id='radper68' value='Letra D'>";
    
    echo "<label><font color='".$cord68."'>D) ".$letradper68['alternativa'].$simd68."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper68' $chee68 disabled id='radper68' value='Letra E'>";
    
    echo "<label><font color='".$core68."'>E) ".$letraeper68['alternativa'].$sime68."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap68 = $letraaper68['alternativa'];

  $imgletbp68 = $letrabper68['alternativa'];

  $imgletcp68 = $letracper68['alternativa'];

  $imgletdp68 = $letradper68['alternativa'];

  $imgletep68 = $letraeper68['alternativa'];

  

  echo "<input type='radio' name='radper68' disabled id='radper68' value='Letra A' $chea68>";

echo "<label>A) <br> <img src='img_res/$imgletap68' width='300'><font color='".$cora68."'>".$sima68."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper68' disabled id='radper68' value='Letra B' $cheb68>";

echo "<label>B) <br> <img src='img_res/$imgletbp68' width='300'><font color='".$corb68."'>".$simb68."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper68' disabled id='radper68' value='Letra C' $chec68>";

echo "<label>C) <br> <img src='img_res/$imgletcp68' width='300'><font color='".$corc68."'>".$simc68."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper68' disabled id='radper68' value='Letra D' $ched68>";

echo "<label>D) <br> <img src='img_res/$imgletdp68' width='300'><font color='".$cord68."'>".$simd68."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper68' disabled id='radper68' value='Letra E' $chee68>";

echo "<label>E) <br> <img src='img_res/$imgletep68' width='300'><font color='".$core68."'>".$sime68."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 69

  echo "<b>Questão 69:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per69['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper69 != "Não possui"){

      echo "<img src='uploads/$imgper69' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp69 == 0) {

    echo "<input type='radio' name='radper69' $chea69 disabled id='radper69' value='Letra A'>";

    echo "<label><font color='".$cora69."'>A) ".$letraaper69['alternativa'].$sima69."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper69' $cheb69 disabled id='radper69' value='Letra B'>";
    
    echo "<label><font color='".$corb69."'>B) ".$letrabper69['alternativa'].$simb69."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper69' $chec69 disabled id='radper69' value='Letra C'>";
    
    echo "<label><font color='".$corc69."'>C) ".$letracper69['alternativa'].$simc69."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper69' $ched69 disabled id='radper69' value='Letra D'>";
    
    echo "<label><font color='".$cord69."'>D) ".$letradper69['alternativa'].$simd69."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper69' $chee69 disabled id='radper69' value='Letra E'>";
    
    echo "<label><font color='".$core69."'>E) ".$letraeper69['alternativa'].$sime69."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap69 = $letraaper69['alternativa'];

  $imgletbp69 = $letrabper69['alternativa'];

  $imgletcp69 = $letracper69['alternativa'];

  $imgletdp69 = $letradper69['alternativa'];

  $imgletep69 = $letraeper69['alternativa'];

  

  echo "<input type='radio' name='radper69' disabled id='radper69' value='Letra A' $chea69>";

  echo "<label>A) <br> <img src='img_res/$imgletap69' width='300'><font color='".$cora69."'>".$sima69."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper69' disabled id='radper69' value='Letra B' $cheb69>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp69' width='300'><font color='".$corb69."'>".$simb69."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper69' disabled id='radper69' value='Letra C' $chec69>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp69' width='300'><font color='".$corc69."'>".$simc69."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper69' disabled id='radper69' value='Letra D' $ched69>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp69' width='300'><font color='".$cord69."'>".$simd69."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper69' disabled id='radper69' value='Letra E' $chee69>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep69' width='300'><font color='".$core69."'>".$sime69."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 70

  echo "<b>Questão 70:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per70['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper70 != "Não possui"){

      echo "<img src='uploads/$imgper70' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp70 == 0) {

    echo "<input type='radio' name='radper70' $chea70 disabled id='radper70' value='Letra A'>";

    echo "<label><font color='".$cora70."'>A) ".$letraaper70['alternativa'].$sima70."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper70' $cheb70 disabled id='radper70' value='Letra B'>";
    
    echo "<label><font color='".$corb70."'>B) ".$letrabper70['alternativa'].$simb70."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper70' $chec70 disabled id='radper70' value='Letra C'>";
    
    echo "<label><font color='".$corc70."'>C) ".$letracper70['alternativa'].$simc70."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper70' $ched70 disabled id='radper70' value='Letra D'>";
    
    echo "<label><font color='".$cord70."'>D) ".$letradper70['alternativa'].$simd70."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper70' $chee70 disabled id='radper70' value='Letra E'>";
    
    echo "<label><font color='".$core70."'>E) ".$letraeper70['alternativa'].$sime70."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap70 = $letraaper70['alternativa'];

  $imgletbp70 = $letrabper70['alternativa'];

  $imgletcp70 = $letracper70['alternativa'];

  $imgletdp70 = $letradper70['alternativa'];

  $imgletep70 = $letraeper70['alternativa'];

  

  echo "<input type='radio' name='radper70' disabled id='radper70' value='Letra A' $chea70>";

  echo "<label>A) <br> <img src='img_res/$imgletap70' width='300'><font color='".$cora70."'>".$sima70."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper70' disabled id='radper70' value='Letra B' $cheb70>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp70' width='300'><font color='".$corb70."'>".$simb70."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper70' disabled id='radper70' value='Letra C' $chec70>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp70' width='300'><font color='".$corc70."'>".$simc70."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper70' disabled id='radper70' value='Letra D' $ched70>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp70' width='300'><font color='".$cord70."'>".$simd70."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper70' disabled id='radper70' value='Letra E' $chee70>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep70' width='300'><font color='".$core70."'>".$sime70."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 71 à 75 -->

<?php 

if ($qtperguntas>70){

  // Inserindo quetão 71

  echo "<b>Questão 71:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per71['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper71 != "Não possui"){

      echo "<img src='uploads/$imgper71' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp71 == 0) {

    echo "<input type='radio' name='radper71' $chea71 disabled id='radper71' value='Letra A'>";

    echo "<label><font color='".$cora71."'>A) ".$letraaper71['alternativa'].$sima71."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper71' $cheb71 disabled id='radper71' value='Letra B'>";
    
    echo "<label><font color='".$corb71."'>B) ".$letrabper71['alternativa'].$simb71."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper71' $chec71 disabled id='radper71' value='Letra C'>";
    
    echo "<label><font color='".$corc71."'>C) ".$letracper71['alternativa'].$simc71."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper71' $ched71 disabled id='radper71' value='Letra D'>";
    
    echo "<label><font color='".$cord71."'>D) ".$letradper71['alternativa'].$simd71."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper71' $chee71 disabled id='radper71' value='Letra E'>";
    
    echo "<label><font color='".$core71."'>E) ".$letraeper71['alternativa'].$sime71."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap71 = $letraaper71['alternativa'];

  $imgletbp71 = $letrabper71['alternativa'];

  $imgletcp71 = $letracper71['alternativa'];

  $imgletdp71 = $letradper71['alternativa'];

  $imgletep71 = $letraeper71['alternativa'];

  

  echo "<input type='radio' name='radper71' disabled id='radper71' value='Letra A' $chea71>";

  echo "<label>A) <br> <img src='img_res/$imgletap71' width='300'><font color='".$cora71."'>".$sima71."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper71' disabled id='radper71' value='Letra B' $cheb71>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp71' width='300'><font color='".$corb71."'>".$simb71."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper71' disabled id='radper71' value='Letra C' $chec71>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp71' width='300'><font color='".$corc71."'>".$simc71."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper71' disabled id='radper71' value='Letra D' $ched71>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp71' width='300'><font color='".$cord71."'>".$simd71."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper71' disabled id='radper71' value='Letra E' $chee71>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep71' width='300'><font color='".$core71."'>".$sime71."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 72

  echo "<b>Questão 72:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per72['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper72 != "Não possui"){

      echo "<img src='uploads/$imgper72' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp72 == 0) {

    echo "<input type='radio' name='radper72' $chea72 disabled id='radper72' value='Letra A'>";

echo "<label><font color='".$cora72."'>A) ".$letraaper72['alternativa'].$sima72."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper72' $cheb72 disabled id='radper72' value='Letra B'>";

echo "<label><font color='".$corb72."'>B) ".$letrabper72['alternativa'].$simb72."</font>";

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper72' $chec72 disabled id='radper72' value='Letra C'>";

echo "<label><font color='".$corc72."'>C) ".$letracper72['alternativa'].$simc72."</font>";

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper72' $ched72 disabled id='radper72' value='Letra D'>";

echo "<label><font color='".$cord72."'>D) ".$letradper72['alternativa'].$simd72."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper72' $chee72 disabled id='radper72' value='Letra E'>";

echo "<label><font color='".$core72."'>E) ".$letraeper72['alternativa'].$sime72."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

  else{

  $imgletap72 = $letraaper72['alternativa'];

  $imgletbp72 = $letrabper72['alternativa'];

  $imgletcp72 = $letracper72['alternativa'];

  $imgletdp72 = $letradper72['alternativa'];

  $imgletep72 = $letraeper72['alternativa'];

  

  echo "<input type='radio' name='radper72' disabled id='radper72' value='Letra A' $chea72>";

  echo "<label>A) <br> <img src='img_res/$imgletap72' width='300'><font color='".$cora72."'>".$sima72."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper72' disabled id='radper72' value='Letra B' $cheb72>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp72' width='300'><font color='".$corb72."'>".$simb72."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper72' disabled id='radper72' value='Letra C' $chec72>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp72' width='300'><font color='".$corc72."'>".$simc72."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper72' disabled id='radper72' value='Letra D' $ched72>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp72' width='300'><font color='".$cord72."'>".$simd72."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper72' disabled id='radper72' value='Letra E' $chee72>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep72' width='300'><font color='".$core72."'>".$sime72."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 73

  echo "<b>Questão 73:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per73['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper73 != "Não possui"){

      echo "<img src='uploads/$imgper73' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp73 == 0) {

    echo "<input type='radio' name='radper73' $chea73 disabled id='radper73' value='Letra A'>";

    echo "<label><font color='".$cora73."'>A) ".$letraaper73['alternativa'].$sima73."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper73' $cheb73 disabled id='radper73' value='Letra B'>";
    
    echo "<label><font color='".$corb73."'>B) ".$letrabper73['alternativa'].$simb73."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper73' $chec73 disabled id='radper73' value='Letra C'>";
    
    echo "<label><font color='".$corc73."'>C) ".$letracper73['alternativa'].$simc73."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper73' $ched73 disabled id='radper73' value='Letra D'>";
    
    echo "<label><font color='".$cord73."'>D) ".$letradper73['alternativa'].$simd73."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper73' $chee73 disabled id='radper73' value='Letra E'>";
    
    echo "<label><font color='".$core73."'>E) ".$letraeper73['alternativa'].$sime73."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap73 = $letraaper73['alternativa'];

  $imgletbp73 = $letrabper73['alternativa'];

  $imgletcp73 = $letracper73['alternativa'];

  $imgletdp73 = $letradper73['alternativa'];

  $imgletep73 = $letraeper73['alternativa'];

  

  echo "<input type='radio' name='radper73' disabled id='radper73' value='Letra A' $chea73>";

  echo "<label>A) <br> <img src='img_res/$imgletap73' width='300'><font color='".$cora73."'>".$sima73."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper73' disabled id='radper73' value='Letra B' $cheb73>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp73' width='300'><font color='".$corb73."'>".$simb73."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper73' disabled id='radper73' value='Letra C' $chec73>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp73' width='300'><font color='".$corc73."'>".$simc73."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper73' disabled id='radper73' value='Letra D' $ched73>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp73' width='300'><font color='".$cord73."'>".$simd73."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper73' disabled id='radper73' value='Letra E' $chee73>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep73' width='300'><font color='".$core73."'>".$sime73."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 74

  echo "<b>Questão 74:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per74['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper74 != "Não possui"){

      echo "<img src='uploads/$imgper74' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp74 == 0) {

    echo "<input type='radio' name='radper74' $chea74 disabled id='radper74' value='Letra A'>";

    echo "<label><font color='".$cora74."'>A) ".$letraaper74['alternativa'].$sima74."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper74' $cheb74 disabled id='radper74' value='Letra B'>";
    
    echo "<label><font color='".$corb74."'>B) ".$letrabper74['alternativa'].$simb74."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper74' $chec74 disabled id='radper74' value='Letra C'>";
    
    echo "<label><font color='".$corc74."'>C) ".$letracper74['alternativa'].$simc74."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper74' $ched74 disabled id='radper74' value='Letra D'>";
    
    echo "<label><font color='".$cord74."'>D) ".$letradper74['alternativa'].$simd74."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper74' $chee74 disabled id='radper74' value='Letra E'>";
    
    echo "<label><font color='".$core74."'>E) ".$letraeper74['alternativa'].$sime74."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap74 = $letraaper74['alternativa'];

  $imgletbp74 = $letrabper74['alternativa'];

  $imgletcp74 = $letracper74['alternativa'];

  $imgletdp74 = $letradper74['alternativa'];

  $imgletep74 = $letraeper74['alternativa'];

  

  echo "<input type='radio' name='radper74' disabled id='radper74' value='Letra A' $chea74>";

  echo "<label>A) <br> <img src='img_res/$imgletap74' width='300'><font color='".$cora74."'>".$sima74."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper74' disabled id='radper74' value='Letra B' $cheb74>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp74' width='300'><font color='".$corb74."'>".$simb74."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper74' disabled id='radper74' value='Letra C' $chec74>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp74' width='300'><font color='".$corc74."'>".$simc74."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper74' disabled id='radper74' value='Letra D' $ched74>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp74' width='300'><font color='".$cord74."'>".$simd74."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper74' disabled id='radper74' value='Letra E' $chee74>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep74' width='300'><font color='".$core74."'>".$sime74."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 75

  echo "<b>Questão 75:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per75['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper75 != "Não possui"){

      echo "<img src='uploads/$imgper75' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp75 == 0) {

    echo "<input type='radio' name='radper75' $chea75 disabled id='radper75' value='Letra A'>";

    echo "<label><font color='".$cora75."'>A) ".$letraaper75['alternativa'].$sima75."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper75' $cheb75 disabled id='radper75' value='Letra B'>";
    
    echo "<label><font color='".$corb75."'>B) ".$letrabper75['alternativa'].$simb75."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper75' $chec75 disabled id='radper75' value='Letra C'>";
    
    echo "<label><font color='".$corc75."'>C) ".$letracper75['alternativa'].$simc75."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper75' $ched75 disabled id='radper75' value='Letra D'>";
    
    echo "<label><font color='".$cord75."'>D) ".$letradper75['alternativa'].$simd75."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper75' $chee75 disabled id='radper75' value='Letra E'>";
    
    echo "<label><font color='".$core75."'>E) ".$letraeper75['alternativa'].$sime75."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap75 = $letraaper75['alternativa'];

  $imgletbp75 = $letrabper75['alternativa'];

  $imgletcp75 = $letracper75['alternativa'];

  $imgletdp75 = $letradper75['alternativa'];

  $imgletep75 = $letraeper75['alternativa'];

  

  echo "<input type='radio' name='radper75' disabled id='radper75' value='Letra A' $chea75>";

  echo "<label>A) <br> <img src='img_res/$imgletap75' width='300'><font color='".$cora75."'>".$sima75."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper75' disabled id='radper75' value='Letra B' $cheb75>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp75' width='300'><font color='".$corb75."'>".$simb75."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper75' disabled id='radper75' value='Letra C' $chec75>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp75' width='300'><font color='".$corc75."'>".$simc75."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper75' disabled id='radper75' value='Letra D' $ched75>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp75' width='300'><font color='".$cord75."'>".$simd75."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper75' disabled id='radper75' value='Letra E' $chee75>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep75' width='300'><font color='".$core75."'>".$sime75."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 76 à 80 -->

<?php 

if ($qtperguntas>75){

  // Inserindo quetão 76

  echo "<b>Questão 76:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per76['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper76 != "Não possui"){

      echo "<img src='uploads/$imgper76' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp76 == 0) {

    echo "<input type='radio' name='radper76' $chea76 disabled id='radper76' value='Letra A'>";

    echo "<label><font color='".$cora76."'>A) ".$letraaper76['alternativa'].$sima76."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper76' $cheb76 disabled id='radper76' value='Letra B'>";
    
    echo "<label><font color='".$corb76."'>B) ".$letrabper76['alternativa'].$simb76."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper76' $chec76 disabled id='radper76' value='Letra C'>";
    
    echo "<label><font color='".$corc76."'>C) ".$letracper76['alternativa'].$simc76."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper76' $ched76 disabled id='radper76' value='Letra D'>";
    
    echo "<label><font color='".$cord76."'>D) ".$letradper76['alternativa'].$simd76."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper76' $chee76 disabled id='radper76' value='Letra E'>";
    
    echo "<label><font color='".$core76."'>E) ".$letraeper76['alternativa'].$sime76."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap76 = $letraaper76['alternativa'];

  $imgletbp76 = $letrabper76['alternativa'];

  $imgletcp76 = $letracper76['alternativa'];

  $imgletdp76 = $letradper76['alternativa'];

  $imgletep76 = $letraeper76['alternativa'];

  

  echo "<input type='radio' name='radper76' disabled id='radper76' value='Letra A' $chea76>";

echo "<label>A) <br> <img src='img_res/$imgletap76' width='300'><font color='".$cora76."'>".$sima76."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper76' disabled id='radper76' value='Letra B' $cheb76>";

echo "<label>B) <br> <img src='img_res/$imgletbp76' width='300'><font color='".$corb76."'>".$simb76."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper76' disabled id='radper76' value='Letra C' $chec76>";

echo "<label>C) <br> <img src='img_res/$imgletcp76' width='300'><font color='".$corc76."'>".$simc76."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper76' disabled id='radper76' value='Letra D' $ched76>";

echo "<label>D) <br> <img src='img_res/$imgletdp76' width='300'><font color='".$cord76."'>".$simd76."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper76' disabled id='radper76' value='Letra E' $chee76>";

echo "<label>E) <br> <img src='img_res/$imgletep76' width='300'><font color='".$core76."'>".$sime76."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 77

  echo "<b>Questão 77:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per77['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper77 != "Não possui"){

      echo "<img src='uploads/$imgper77' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp77 == 0) {

    echo "<input type='radio' name='radper77' $chea77 disabled id='radper77' value='Letra A'>";

    echo "<label><font color='".$cora77."'>A) ".$letraaper77['alternativa'].$sima77."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper77' $cheb77 disabled id='radper77' value='Letra B'>";
    
    echo "<label><font color='".$corb77."'>B) ".$letrabper77['alternativa'].$simb77."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper77' $chec77 disabled id='radper77' value='Letra C'>";
    
    echo "<label><font color='".$corc77."'>C) ".$letracper77['alternativa'].$simc77."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper77' $ched77 disabled id='radper77' value='Letra D'>";
    
    echo "<label><font color='".$cord77."'>D) ".$letradper77['alternativa'].$simd77."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper77' $chee77 disabled id='radper77' value='Letra E'>";
    
    echo "<label><font color='".$core77."'>E) ".$letraeper77['alternativa'].$sime77."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap77 = $letraaper77['alternativa'];

  $imgletbp77 = $letrabper77['alternativa'];

  $imgletcp77 = $letracper77['alternativa'];

  $imgletdp77 = $letradper77['alternativa'];

  $imgletep77 = $letraeper77['alternativa'];

  

  echo "<input type='radio' name='radper77' disabled id='radper77' value='Letra A' $chea77>";

  echo "<label>A) <br> <img src='img_res/$imgletap77' width='300'><font color='".$cora77."'>".$sima77."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper77' disabled id='radper77' value='Letra B' $cheb77>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp77' width='300'><font color='".$corb77."'>".$simb77."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper77' disabled id='radper77' value='Letra C' $chec77>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp77' width='300'><font color='".$corc77."'>".$simc77."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper77' disabled id='radper77' value='Letra D' $ched77>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp77' width='300'><font color='".$cord77."'>".$simd77."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper77' disabled id='radper77' value='Letra E' $chee77>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep77' width='300'><font color='".$core77."'>".$sime77."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 78

  echo "<b>Questão 78:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per78['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper78 != "Não possui"){

      echo "<img src='uploads/$imgper78' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp78 == 0) {

    echo "<input type='radio' name='radper78' $chea78 disabled id='radper78' value='Letra A'>";

    echo "<label><font color='".$cora78."'>A) ".$letraaper78['alternativa'].$sima78."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper78' $cheb78 disabled id='radper78' value='Letra B'>";
    
    echo "<label><font color='".$corb78."'>B) ".$letrabper78['alternativa'].$simb78."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper78' $chec78 disabled id='radper78' value='Letra C'>";
    
    echo "<label><font color='".$corc78."'>C) ".$letracper78['alternativa'].$simc78."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper78' $ched78 disabled id='radper78' value='Letra D'>";
    
    echo "<label><font color='".$cord78."'>D) ".$letradper78['alternativa'].$simd78."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper78' $chee78 disabled id='radper78' value='Letra E'>";
    
    echo "<label><font color='".$core78."'>E) ".$letraeper78['alternativa'].$sime78."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap78 = $letraaper78['alternativa'];

  $imgletbp78 = $letrabper78['alternativa'];

  $imgletcp78 = $letracper78['alternativa'];

  $imgletdp78 = $letradper78['alternativa'];

  $imgletep78 = $letraeper78['alternativa'];

  

  echo "<input type='radio' name='radper78' disabled id='radper78' value='Letra A' $chea78>";

  echo "<label>A) <br> <img src='img_res/$imgletap78' width='300'><font color='".$cora78."'>".$sima78."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper78' disabled id='radper78' value='Letra B' $cheb78>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp78' width='300'><font color='".$corb78."'>".$simb78."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper78' disabled id='radper78' value='Letra C' $chec78>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp78' width='300'><font color='".$corc78."'>".$simc78."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper78' disabled id='radper78' value='Letra D' $ched78>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp78' width='300'><font color='".$cord78."'>".$simd78."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper78' disabled id='radper78' value='Letra E' $chee78>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep78' width='300'><font color='".$core78."'>".$sime78."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 79

  echo "<b>Questão 79:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per79['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper79 != "Não possui"){

      echo "<img src='uploads/$imgper79' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp79 == 0) {

    echo "<input type='radio' name='radper79' $chea79 disabled id='radper79' value='Letra A'>";

    echo "<label><font color='".$cora79."'>A) ".$letraaper79['alternativa'].$sima79."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper79' $cheb79 disabled id='radper79' value='Letra B'>";
    
    echo "<label><font color='".$corb79."'>B) ".$letrabper79['alternativa'].$simb79."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper79' $chec79 disabled id='radper79' value='Letra C'>";
    
    echo "<label><font color='".$corc79."'>C) ".$letracper79['alternativa'].$simc79."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper79' $ched79 disabled id='radper79' value='Letra D'>";
    
    echo "<label><font color='".$cord79."'>D) ".$letradper79['alternativa'].$simd79."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper79' $chee79 disabled id='radper79' value='Letra E'>";
    
    echo "<label><font color='".$core79."'>E) ".$letraeper79['alternativa'].$sime79."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap79 = $letraaper79['alternativa'];

  $imgletbp79 = $letrabper79['alternativa'];

  $imgletcp79 = $letracper79['alternativa'];

  $imgletdp79 = $letradper79['alternativa'];

  $imgletep79 = $letraeper79['alternativa'];

  

  echo "<input type='radio' name='radper79' disabled id='radper79' value='Letra A' $chea79>";

  echo "<label>A) <br> <img src='img_res/$imgletap79' width='300'><font color='".$cora79."'>".$sima79."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper79' disabled id='radper79' value='Letra B' $cheb79>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp79' width='300'><font color='".$corb79."'>".$simb79."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper79' disabled id='radper79' value='Letra C' $chec79>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp79' width='300'><font color='".$corc79."'>".$simc79."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper79' disabled id='radper79' value='Letra D' $ched79>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp79' width='300'><font color='".$cord79."'>".$simd79."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper79' disabled id='radper79' value='Letra E' $chee79>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep79' width='300'><font color='".$core79."'>".$sime79."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 80

  echo "<b>Questão 80:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per80['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper80 != "Não possui"){

      echo "<img src='uploads/$imgper80' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp80 == 0) {

    echo "<input type='radio' name='radper80' $chea80 disabled id='radper80' value='Letra A'>";

    echo "<label><font color='".$cora80."'>A) ".$letraaper80['alternativa'].$sima80."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper80' $cheb80 disabled id='radper80' value='Letra B'>";
    
    echo "<label><font color='".$corb80."'>B) ".$letrabper80['alternativa'].$simb80."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper80' $chec80 disabled id='radper80' value='Letra C'>";
    
    echo "<label><font color='".$corc80."'>C) ".$letracper80['alternativa'].$simc80."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper80' $ched80 disabled id='radper80' value='Letra D'>";
    
    echo "<label><font color='".$cord80."'>D) ".$letradper80['alternativa'].$simd80."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper80' $chee80 disabled id='radper80' value='Letra E'>";
    
    echo "<label><font color='".$core80."'>E) ".$letraeper80['alternativa'].$sime80."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap80 = $letraaper80['alternativa'];

  $imgletbp80 = $letrabper80['alternativa'];

  $imgletcp80 = $letracper80['alternativa'];

  $imgletdp80 = $letradper80['alternativa'];

  $imgletep80 = $letraeper80['alternativa'];

  

  echo "<input type='radio' name='radper80' disabled id='radper80' value='Letra A' $chea80>";

echo "<label>A) <br> <img src='img_res/$imgletap80' width='300'><font color='".$cora80."'>".$sima80."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper80' disabled id='radper80' value='Letra B' $cheb80>";

echo "<label>B) <br> <img src='img_res/$imgletbp80' width='300'><font color='".$corb80."'>".$simb80."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper80' disabled id='radper80' value='Letra C' $chec80>";

echo "<label>C) <br> <img src='img_res/$imgletcp80' width='300'><font color='".$corc80."'>".$simc80."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper80' disabled id='radper80' value='Letra D' $ched80>";

echo "<label>D) <br> <img src='img_res/$imgletdp80' width='300'><font color='".$cord80."'>".$simd80."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper80' disabled id='radper80' value='Letra E' $chee80>";

echo "<label>E) <br> <img src='img_res/$imgletep80' width='300'><font color='".$core80."'>".$sime80."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 81 à 85 -->

<?php 

if ($qtperguntas>80){

  // Inserindo quetão 81

  echo "<b>Questão 81:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per81['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper81 != "Não possui"){

      echo "<img src='uploads/$imgper81' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp81 == 0) {

    echo "<input type='radio' name='radper81' $chea81 disabled id='radper81' value='Letra A'>";

    echo "<label><font color='".$cora81."'>A) ".$letraaper81['alternativa'].$sima81."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper81' $cheb81 disabled id='radper81' value='Letra B'>";
    
    echo "<label><font color='".$corb81."'>B) ".$letrabper81['alternativa'].$simb81."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper81' $chec81 disabled id='radper81' value='Letra C'>";
    
    echo "<label><font color='".$corc81."'>C) ".$letracper81['alternativa'].$simc81."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper81' $ched81 disabled id='radper81' value='Letra D'>";
    
    echo "<label><font color='".$cord81."'>D) ".$letradper81['alternativa'].$simd81."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper81' $chee81 disabled id='radper81' value='Letra E'>";
    
    echo "<label><font color='".$core81."'>E) ".$letraeper81['alternativa'].$sime81."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap81 = $letraaper81['alternativa'];

  $imgletbp81 = $letrabper81['alternativa'];

  $imgletcp81 = $letracper81['alternativa'];

  $imgletdp81 = $letradper81['alternativa'];

  $imgletep81 = $letraeper81['alternativa'];

  

  echo "<input type='radio' name='radper81' disabled id='radper81' value='Letra A' $chea81>";

echo "<label>A) <br> <img src='img_res/$imgletap81' width='300'><font color='".$cora81."'>".$sima81."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper81' disabled id='radper81' value='Letra B' $cheb81>";

echo "<label>B) <br> <img src='img_res/$imgletbp81' width='300'><font color='".$corb81."'>".$simb81."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper81' disabled id='radper81' value='Letra C' $chec81>";

echo "<label>C) <br> <img src='img_res/$imgletcp81' width='300'><font color='".$corc81."'>".$simc81."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper81' disabled id='radper81' value='Letra D' $ched81>";

echo "<label>D) <br> <img src='img_res/$imgletdp81' width='300'><font color='".$cord81."'>".$simd81."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper81' disabled id='radper81' value='Letra E' $chee81>";

echo "<label>E) <br> <img src='img_res/$imgletep81' width='300'><font color='".$core81."'>".$sime81."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 82

  echo "<b>Questão 82:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per82['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper82 != "Não possui"){

      echo "<img src='uploads/$imgper82' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp82 == 0) {

    echo "<input type='radio' name='radper82' $chea82 disabled id='radper82' value='Letra A'>";

    echo "<label><font color='".$cora82."'>A) ".$letraaper82['alternativa'].$sima82."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper82' $cheb82 disabled id='radper82' value='Letra B'>";
    
    echo "<label><font color='".$corb82."'>B) ".$letrabper82['alternativa'].$simb82."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper82' $chec82 disabled id='radper82' value='Letra C'>";
    
    echo "<label><font color='".$corc82."'>C) ".$letracper82['alternativa'].$simc82."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper82' $ched82 disabled id='radper82' value='Letra D'>";
    
    echo "<label><font color='".$cord82."'>D) ".$letradper82['alternativa'].$simd82."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper82' $chee82 disabled id='radper82' value='Letra E'>";
    
    echo "<label><font color='".$core82."'>E) ".$letraeper82['alternativa'].$sime82."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap82 = $letraaper82['alternativa'];

  $imgletbp82 = $letrabper82['alternativa'];

  $imgletcp82 = $letracper82['alternativa'];

  $imgletdp82 = $letradper82['alternativa'];

  $imgletep82 = $letraeper82['alternativa'];

  

  echo "<input type='radio' name='radper82' disabled id='radper82' value='Letra A' $chea82>";

echo "<label>A) <br> <img src='img_res/$imgletap82' width='300'><font color='".$cora82."'>".$sima82."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper82' disabled id='radper82' value='Letra B' $cheb82>";

echo "<label>B) <br> <img src='img_res/$imgletbp82' width='300'><font color='".$corb82."'>".$simb82."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper82' disabled id='radper82' value='Letra C' $chec82>";

echo "<label>C) <br> <img src='img_res/$imgletcp82' width='300'><font color='".$corc82."'>".$simc82."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper82' disabled id='radper82' value='Letra D' $ched82>";

echo "<label>D) <br> <img src='img_res/$imgletdp82' width='300'><font color='".$cord82."'>".$simd82."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper82' disabled id='radper82' value='Letra E' $chee82>";

echo "<label>E) <br> <img src='img_res/$imgletep82' width='300'><font color='".$core82."'>".$sime82."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 83

  echo "<b>Questão 83:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per83['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper83 != "Não possui"){

      echo "<img src='uploads/$imgper83' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp83 == 0) {

    echo "<input type='radio' name='radper83' $chea83 disabled id='radper83' value='Letra A'>";

    echo "<label><font color='".$cora83."'>A) ".$letraaper83['alternativa'].$sima83."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper83' $cheb83 disabled id='radper83' value='Letra B'>";
    
    echo "<label><font color='".$corb83."'>B) ".$letrabper83['alternativa'].$simb83."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper83' $chec83 disabled id='radper83' value='Letra C'>";
    
    echo "<label><font color='".$corc83."'>C) ".$letracper83['alternativa'].$simc83."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper83' $ched83 disabled id='radper83' value='Letra D'>";
    
    echo "<label><font color='".$cord83."'>D) ".$letradper83['alternativa'].$simd83."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper83' $chee83 disabled id='radper83' value='Letra E'>";
    
    echo "<label><font color='".$core83."'>E) ".$letraeper83['alternativa'].$sime83."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap83 = $letraaper83['alternativa'];

  $imgletbp83 = $letrabper83['alternativa'];

  $imgletcp83 = $letracper83['alternativa'];

  $imgletdp83 = $letradper83['alternativa'];

  $imgletep83 = $letraeper83['alternativa'];

  

  echo "<input type='radio' name='radper83' disabled id='radper83' value='Letra A' $chea83>";

echo "<label>A) <br> <img src='img_res/$imgletap83' width='300'><font color='".$cora83."'>".$sima83."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper83' disabled id='radper83' value='Letra B' $cheb83>";

echo "<label>B) <br> <img src='img_res/$imgletbp83' width='300'><font color='".$corb83."'>".$simb83."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper83' disabled id='radper83' value='Letra C' $chec83>";

echo "<label>C) <br> <img src='img_res/$imgletcp83' width='300'><font color='".$corc83."'>".$simc83."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper83' disabled id='radper83' value='Letra D' $ched83>";

echo "<label>D) <br> <img src='img_res/$imgletdp83' width='300'><font color='".$cord83."'>".$simd83."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper83' disabled id='radper83' value='Letra E' $chee83>";

echo "<label>E) <br> <img src='img_res/$imgletep83' width='300'><font color='".$core83."'>".$sime83."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 84

  echo "<b>Questão 84:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per84['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper84 != "Não possui"){

      echo "<img src='uploads/$imgper84' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp84 == 0) {

    echo "<input type='radio' name='radper84' $chea84 disabled id='radper84' value='Letra A'>";

    echo "<label><font color='".$cora84."'>A) ".$letraaper84['alternativa'].$sima84."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper84' $cheb84 disabled id='radper84' value='Letra B'>";
    
    echo "<label><font color='".$corb84."'>B) ".$letrabper84['alternativa'].$simb84."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper84' $chec84 disabled id='radper84' value='Letra C'>";
    
    echo "<label><font color='".$corc84."'>C) ".$letracper84['alternativa'].$simc84."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper84' $ched84 disabled id='radper84' value='Letra D'>";
    
    echo "<label><font color='".$cord84."'>D) ".$letradper84['alternativa'].$simd84."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper84' $chee84 disabled id='radper84' value='Letra E'>";
    
    echo "<label><font color='".$core84."'>E) ".$letraeper84['alternativa'].$sime84."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap84 = $letraaper84['alternativa'];

  $imgletbp84 = $letrabper84['alternativa'];

  $imgletcp84 = $letracper84['alternativa'];

  $imgletdp84 = $letradper84['alternativa'];

  $imgletep84 = $letraeper84['alternativa'];

  

  echo "<input type='radio' name='radper84' disabled id='radper84' value='Letra A' $chea84>";

echo "<label>A) <br> <img src='img_res/$imgletap84' width='300'><font color='".$cora84."'>".$sima84."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper84' disabled id='radper84' value='Letra B' $cheb84>";

echo "<label>B) <br> <img src='img_res/$imgletbp84' width='300'><font color='".$corb84."'>".$simb84."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper84' disabled id='radper84' value='Letra C' $chec84>";

echo "<label>C) <br> <img src='img_res/$imgletcp84' width='300'><font color='".$corc84."'>".$simc84."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper84' disabled id='radper84' value='Letra D' $ched84>";

echo "<label>D) <br> <img src='img_res/$imgletdp84' width='300'><font color='".$cord84."'>".$simd84."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper84' disabled id='radper84' value='Letra E' $chee84>";

echo "<label>E) <br> <img src='img_res/$imgletep84' width='300'><font color='".$core84."'>".$sime84."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 85

  echo "<b>Questão 85:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per85['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper85 != "Não possui"){

      echo "<img src='uploads/$imgper85' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp85 == 0) {

    echo "<input type='radio' name='radper85' $chea85 disabled id='radper85' value='Letra A'>";

    echo "<label><font color='".$cora85."'>A) ".$letraaper85['alternativa'].$sima85."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper85' $cheb85 disabled id='radper85' value='Letra B'>";
    
    echo "<label><font color='".$corb85."'>B) ".$letrabper85['alternativa'].$simb85."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper85' $chec85 disabled id='radper85' value='Letra C'>";
    
    echo "<label><font color='".$corc85."'>C) ".$letracper85['alternativa'].$simc85."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper85' $ched85 disabled id='radper85' value='Letra D'>";
    
    echo "<label><font color='".$cord85."'>D) ".$letradper85['alternativa'].$simd85."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper85' $chee85 disabled id='radper85' value='Letra E'>";
    
    echo "<label><font color='".$core85."'>E) ".$letraeper85['alternativa'].$sime85."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap85 = $letraaper85['alternativa'];

  $imgletbp85 = $letrabper85['alternativa'];

  $imgletcp85 = $letracper85['alternativa'];

  $imgletdp85 = $letradper85['alternativa'];

  $imgletep85 = $letraeper85['alternativa'];

  

  echo "<input type='radio' name='radper85' disabled id='radper85' value='Letra A' $chea85>";

echo "<label>A) <br> <img src='img_res/$imgletap85' width='300'><font color='".$cora85."'>".$sima85."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper85' disabled id='radper85' value='Letra B' $cheb85>";

echo "<label>B) <br> <img src='img_res/$imgletbp85' width='300'><font color='".$corb85."'>".$simb85."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper85' disabled id='radper85' value='Letra C' $chec85>";

echo "<label>C) <br> <img src='img_res/$imgletcp85' width='300'><font color='".$corc85."'>".$simc85."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper85' disabled id='radper85' value='Letra D' $ched85>";

echo "<label>D) <br> <img src='img_res/$imgletdp85' width='300'><font color='".$cord85."'>".$simd85."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper85' disabled id='radper85' value='Letra E' $chee85>";

echo "<label>E) <br> <img src='img_res/$imgletep85' width='300'><font color='".$core85."'>".$sime85."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }

}

?>





<!-- Verificando se existe a quetão de 86 à 90 -->

<?php 

if ($qtperguntas>85){

  // Inserindo quetão 86

  echo "<b>Questão 86:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per86['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper86 != "Não possui"){

      echo "<img src='uploads/$imgper86' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp86 == 0) {

    echo "<input type='radio' name='radper86' $chea86 disabled id='radper86' value='Letra A'>";

    echo "<label><font color='".$cora86."'>A) ".$letraaper86['alternativa'].$sima86."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper86' $cheb86 disabled id='radper86' value='Letra B'>";
    
    echo "<label><font color='".$corb86."'>B) ".$letrabper86['alternativa'].$simb86."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper86' $chec86 disabled id='radper86' value='Letra C'>";
    
    echo "<label><font color='".$corc86."'>C) ".$letracper86['alternativa'].$simc86."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper86' $ched86 disabled id='radper86' value='Letra D'>";
    
    echo "<label><font color='".$cord86."'>D) ".$letradper86['alternativa'].$simd86."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper86' $chee86 disabled id='radper86' value='Letra E'>";
    
    echo "<label><font color='".$core86."'>E) ".$letraeper86['alternativa'].$sime86."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap86 = $letraaper86['alternativa'];

  $imgletbp86 = $letrabper86['alternativa'];

  $imgletcp86 = $letracper86['alternativa'];

  $imgletdp86 = $letradper86['alternativa'];

  $imgletep86 = $letraeper86['alternativa'];

  

  echo "<input type='radio' name='radper86' disabled id='radper86' value='Letra A' $chea86>";

  echo "<label>A) <br> <img src='img_res/$imgletap86' width='300'><font color='".$cora86."'>".$sima86."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper86' disabled id='radper86' value='Letra B' $cheb86>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp86' width='300'><font color='".$corb86."'>".$simb86."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper86' disabled id='radper86' value='Letra C' $chec86>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp86' width='300'><font color='".$corc86."'>".$simc86."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper86' disabled id='radper86' value='Letra D' $ched86>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp86' width='300'><font color='".$cord86."'>".$simd86."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper86' disabled id='radper86' value='Letra E' $chee86>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep86' width='300'><font color='".$core86."'>".$sime86."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 87

  echo "<b>Questão 87:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per87['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper87 != "Não possui"){

      echo "<img src='uploads/$imgper87' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp87 == 0) {

    echo "<input type='radio' name='radper87' $chea87 disabled id='radper87' value='Letra A'>";

    echo "<label><font color='".$cora87."'>A) ".$letraaper87['alternativa'].$sima87."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper87' $cheb87 disabled id='radper87' value='Letra B'>";
    
    echo "<label><font color='".$corb87."'>B) ".$letrabper87['alternativa'].$simb87."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper87' $chec87 disabled id='radper87' value='Letra C'>";
    
    echo "<label><font color='".$corc87."'>C) ".$letracper87['alternativa'].$simc87."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper87' $ched87 disabled id='radper87' value='Letra D'>";
    
    echo "<label><font color='".$cord87."'>D) ".$letradper87['alternativa'].$simd87."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper87' $chee87 disabled id='radper87' value='Letra E'>";
    
    echo "<label><font color='".$core87."'>E) ".$letraeper87['alternativa'].$sime87."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap87 = $letraaper87['alternativa'];

  $imgletbp87 = $letrabper87['alternativa'];

  $imgletcp87 = $letracper87['alternativa'];

  $imgletdp87 = $letradper87['alternativa'];

  $imgletep87 = $letraeper87['alternativa'];

  

  echo "<input type='radio' name='radper87' disabled id='radper87' value='Letra A' $chea87>";

  echo "<label>A) <br> <img src='img_res/$imgletap87' width='300'><font color='".$cora87."'>".$sima87."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper87' disabled id='radper87' value='Letra B' $cheb87>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp87' width='300'><font color='".$corb87."'>".$simb87."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper87' disabled id='radper87' value='Letra C' $chec87>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp87' width='300'><font color='".$corc87."'>".$simc87."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper87' disabled id='radper87' value='Letra D' $ched87>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp87' width='300'><font color='".$cord87."'>".$simd87."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper87' disabled id='radper87' value='Letra E' $chee87>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep87' width='300'><font color='".$core87."'>".$sime87."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 88

  echo "<b>Questão 88:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per88['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper88 != "Não possui"){

      echo "<img src='uploads/$imgper88' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp88 == 0) {

    echo "<input type='radio' name='radper88' $chea88 disabled id='radper88' value='Letra A'>";

    echo "<label><font color='".$cora88."'>A) ".$letraaper88['alternativa'].$sima88."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper88' $cheb88 disabled id='radper88' value='Letra B'>";
    
    echo "<label><font color='".$corb88."'>B) ".$letrabper88['alternativa'].$simb88."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper88' $chec88 disabled id='radper88' value='Letra C'>";
    
    echo "<label><font color='".$corc88."'>C) ".$letracper88['alternativa'].$simc88."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper88' $ched88 disabled id='radper88' value='Letra D'>";
    
    echo "<label><font color='".$cord88."'>D) ".$letradper88['alternativa'].$simd88."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper88' $chee88 disabled id='radper88' value='Letra E'>";
    
    echo "<label><font color='".$core88."'>E) ".$letraeper88['alternativa'].$sime88."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap88 = $letraaper88['alternativa'];

  $imgletbp88 = $letrabper88['alternativa'];

  $imgletcp88 = $letracper88['alternativa'];

  $imgletdp88 = $letradper88['alternativa'];

  $imgletep88 = $letraeper88['alternativa'];

  

  echo "<input type='radio' name='radper88' disabled id='radper88' value='Letra A' $chea88>";

echo "<label>A) <br> <img src='img_res/$imgletap88' width='300'><font color='".$cora88."'>".$sima88."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper88' disabled id='radper88' value='Letra B' $cheb88>";

echo "<label>B) <br> <img src='img_res/$imgletbp88' width='300'><font color='".$corb88."'>".$simb88."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper88' disabled id='radper88' value='Letra C' $chec88>";

echo "<label>C) <br> <img src='img_res/$imgletcp88' width='300'><font color='".$corc88."'>".$simc88."</font>"; 

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper88' disabled id='radper88' value='Letra D' $ched88>";

echo "<label>D) <br> <img src='img_res/$imgletdp88' width='300'><font color='".$cord88."'>".$simd88."</font>";  

echo "</label>";

echo "<br><br>";

echo "<input type='radio' name='radper88' disabled id='radper88' value='Letra E' $chee88>";

echo "<label>E) <br> <img src='img_res/$imgletep88' width='300'><font color='".$core88."'>".$sime88."</font>"; 

echo "</label>";

echo "<br><br><br>";
  }



  // Inserindo quetão 89

  echo "<b>Questão 89:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per89['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper89 != "Não possui"){

      echo "<img src='uploads/$imgper89' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp89 == 0) {

    echo "<input type='radio' name='radper89' $chea89 disabled id='radper89' value='Letra A'>";

    echo "<label><font color='".$cora89."'>A) ".$letraaper89['alternativa'].$sima89."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper89' $cheb89 disabled id='radper89' value='Letra B'>";
    
    echo "<label><font color='".$corb89."'>B) ".$letrabper89['alternativa'].$simb89."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper89' $chec89 disabled id='radper89' value='Letra C'>";
    
    echo "<label><font color='".$corc89."'>C) ".$letracper89['alternativa'].$simc89."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper89' $ched89 disabled id='radper89' value='Letra D'>";
    
    echo "<label><font color='".$cord89."'>D) ".$letradper89['alternativa'].$simd89."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper89' $chee89 disabled id='radper89' value='Letra E'>";
    
    echo "<label><font color='".$core89."'>E) ".$letraeper89['alternativa'].$sime89."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap89 = $letraaper89['alternativa'];

  $imgletbp89 = $letrabper89['alternativa'];

  $imgletcp89 = $letracper89['alternativa'];

  $imgletdp89 = $letradper89['alternativa'];

  $imgletep89 = $letraeper89['alternativa'];

  

  echo "<input type='radio' name='radper89' disabled id='radper89' value='Letra A' $chea89>";

  echo "<label>A) <br> <img src='img_res/$imgletap89' width='300'><font color='".$cora89."'>".$sima89."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper89' disabled id='radper89' value='Letra B' $cheb89>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp89' width='300'><font color='".$corb89."'>".$simb89."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper89' disabled id='radper89' value='Letra C' $chec89>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp89' width='300'><font color='".$corc89."'>".$simc89."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper89' disabled id='radper89' value='Letra D' $ched89>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp89' width='300'><font color='".$cord89."'>".$simd89."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper89' disabled id='radper89' value='Letra E' $chee89>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep89' width='300'><font color='".$core89."'>".$sime89."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }



  // Inserindo quetão 90

  echo "<b>Questão 90:</b>";

  echo "<br><br>";

  print "<p>".nl2br($per90['pergunta'])."</p>";

  echo "<br><br><br>";

  

  // Se possui imagem

  if ($imgper90 != "Não possui"){

      echo "<img src='uploads/$imgper90' width='500'>";

      echo "<br><br><br>";

  }

  else{

  

  }

  

  // O tipo de resposta

  if ($tipoimgp90 == 0) {

    echo "<input type='radio' name='radper90' $chea90 disabled id='radper90' value='Letra A'>";

    echo "<label><font color='".$cora90."'>A) ".$letraaper90['alternativa'].$sima90."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper90' $cheb90 disabled id='radper90' value='Letra B'>";
    
    echo "<label><font color='".$corb90."'>B) ".$letrabper90['alternativa'].$simb90."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper90' $chec90 disabled id='radper90' value='Letra C'>";
    
    echo "<label><font color='".$corc90."'>C) ".$letracper90['alternativa'].$simc90."</font>";
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper90' $ched90 disabled id='radper90' value='Letra D'>";
    
    echo "<label><font color='".$cord90."'>D) ".$letradper90['alternativa'].$simd90."</font>"; 
    
    echo "</label>";
    
    echo "<br><br>";
    
    echo "<input type='radio' name='radper90' $chee90 disabled id='radper90' value='Letra E'>";
    
    echo "<label><font color='".$core90."'>E) ".$letraeper90['alternativa'].$sime90."</font>"; 
    
    echo "</label>";
    
    echo "<br><br><br>";
  }

  else{

  $imgletap90 = $letraaper90['alternativa'];

  $imgletbp90 = $letrabper90['alternativa'];

  $imgletcp90 = $letracper90['alternativa'];

  $imgletdp90 = $letradper90['alternativa'];

  $imgletep90 = $letraeper90['alternativa'];

  

  echo "<input type='radio' name='radper90' disabled id='radper90' value='Letra A' $chea90>";

  echo "<label>A) <br> <img src='img_res/$imgletap90' width='300'><font color='".$cora90."'>".$sima90."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper90' disabled id='radper90' value='Letra B' $cheb90>";
  
  echo "<label>B) <br> <img src='img_res/$imgletbp90' width='300'><font color='".$corb90."'>".$simb90."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper90' disabled id='radper90' value='Letra C' $chec90>";
  
  echo "<label>C) <br> <img src='img_res/$imgletcp90' width='300'><font color='".$corc90."'>".$simc90."</font>"; 
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper90' disabled id='radper90' value='Letra D' $ched90>";
  
  echo "<label>D) <br> <img src='img_res/$imgletdp90' width='300'><font color='".$cord90."'>".$simd90."</font>";  
  
  echo "</label>";
  
  echo "<br><br>";
  
  echo "<input type='radio' name='radper90' disabled id='radper90' value='Letra E' $chee90>";
  
  echo "<label>E) <br> <img src='img_res/$imgletep90' width='300'><font color='".$core90."'>".$sime90."</font>"; 
  
  echo "</label>";
  
  echo "<br><br><br>";
  }

}

?>



</body>

</html>

