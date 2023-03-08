<?php
include('conexao.php');

$consulta = mysqli_query($conexao,"select * from tab_questoes");

?>

<html>
<meta charset="UTF-8">
<title>Visualizar Questões</title>
<link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
<bodY bgcolor="cyan">
<center>

<table border="1" style="background-color:silver;">
<tr>
<td>Código Questão</td>
<td>Questão</td>
<td>Ano do Vestibulinho</td>
<td>Nome do Vestibulinho</td>
<td>Resposta Correta</td>
<td>Resposta A</td>
<td>Resposta B</td>
<td>Resposta C</td>
<td>Resposta D</td>
<td>Resposta E</td>
<td>Nome Imagem</td>
</tr>
<?php while ($dado=$consulta->fetch_array()) {?> 
<tr>
<td><?php echo $dado["codigo_questao"];?></td>
<td><?php echo $dado["texto_questao"];?></td>
<td><?php echo $dado["ano_vestibular"];?></td>
<td><?php echo $dado["nome_vestibulinho"];?></td>
<td><?php echo $dado["resposta_correta"];?></td>
<td><?php echo $dado["resposta_a"];?></td>
<td><?php echo $dado["resposta_b"];?></td>
<td><?php echo $dado["resposta_c"];?></td>
<td><?php echo $dado["resposta_d"];?></td>
<td><?php echo $dado["resposta_e"];?></td>
<td><?php echo $dado["nome_imagem"];?></td>
</tr>
<?php }?>
</table>
</center>





</bodY>
</html>