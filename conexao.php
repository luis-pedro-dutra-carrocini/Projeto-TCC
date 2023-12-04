<?php

//Dados de Acesso
$host = "bd_enem.mysql.dbaas.com.br";
$user = "bd_enem";
$pass = "ds@enem2023TcT";
$dbn  = "bd_enem";

// varialvel para a Conexão
$conexao = mysqli_connect($host, $user, $pass, $dbn);
$conexao -> set_charset("utf8");
?>