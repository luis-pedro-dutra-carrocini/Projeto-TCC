<?php
if(!empty($_GET['nome']))
{
    include_once('conexao.php');

    $nome = $_GET['nome'];

    $sqlSelect = "SELECT *  FROM tab_usuarios WHERE nome_usuario='$nome'";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
        $sqlDelete = "DELETE FROM tab_usuarios WHERE nome_usuario='$nome'";
        $resultDelete = $conexao->query($sqlDelete);
    }
}
header('Location: mostrar_usuarios.php');
?>