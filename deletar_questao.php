<?php
if(!empty($_GET['codigo']))
{
    include_once('conexao.php');

    $codigo = $_GET['codigo'];

    $sqlSelect = "SELECT *  FROM tab_questoes WHERE codigo_questao='$codigo'";

    $result = $conexao->query($sqlSelect);

    if($result->num_rows > 0)
    {
        $sqlDelete = "DELETE FROM tab_questoes WHERE codigo_questao='$codigo'";
        $resultDelete = $conexao->query($sqlDelete);
    }
}
header('Location: mostrar_questoes.php');
?>