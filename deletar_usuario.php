<?php
if(!empty($_GET['id']))
    {
        include_once('conexao.php');

        $id = $_GET['id'];
        $consulta = mysqli_query($conexao,"SELECT *  FROM tab_usuarios WHERE nome_usuario='$id';");
echo $id;
        if($consulta->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM tab_usuarios WHERE nome_usuario=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }

?>