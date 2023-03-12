<?php
    include_once('conexao.php');
    $nome = $_GET['nome'];
    if(isset($_POST["alterar"]))
    {
        $confalte = filter_input(INPUT_POST, 'confalte', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($confalte == "True"){
            $novonome = $_POST['nome'];
            $novoemail = $_POST['email'];
            
            $sqlInsert = "UPDATE tab_usuarios 
            SET nome_usuario='$novonome',email_usuario='$novoemail'
            WHERE nome_usuario='$nome';";
            $result = $conexao->query($sqlInsert);
            print_r($result);
            echo $novonome;
          }
    }

    if(!empty($_GET['nome']))
    {
        $nome = $_GET['nome'];
        $sqlSelect = "SELECT * FROM tab_usuarios WHERE nome_usuario='$nome'";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
         $user_data = mysqli_fetch_assoc($result);
         $nomemos = $user_data['nome_usuario'];
         $email = $user_data['email_usuario'];

        }
        else
        {
            header('Location: mostrar_usuarios.php');
        }
    }
    else
    {
        header('Location: mostrar_usuarios.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/icone_exemplo.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Dados do Usuário</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            padding: 10px;
            text-align: left;
            border-radius: 8px;
            font-size: 19px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 17px;
            width: 100%;
            letter-spacing: 2px;
        }
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
            color: dodgerblue;
        }
        #alterar{
            width: 50%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: Green;
        }
        #alterar:hover{
            background-color: ForestGreen;
        }
        #cancelar{
            width: 47%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            background-color: #971506;
        }
        #cancelar:hover{
            background-color: FireBrick;
        }
    </style>
</head>
<body>
    <div class="box">
        <form action="" method="POST">
            <fieldset>
                <legend><b>Alterar Dados Usuário</b></legend>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nomemos;?>" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email;?>" required>
                    <label for="email" class="labelInput">Email</label>
                <br><br>
                </div>
				<input type="hidden" name="id" value=<?php echo $nome;?>>
                <input type="hidden" value="" id="confalte" name="confalte"> 
                <button type ="submit" id="alterar" onclick="alterardados()" name="alterar">Alterar</button>
                <button type ="button" id="cancelar" onclick="voltar()" name="cancelar">Cancelar</button>
            </fieldset>
</form>
</div>
<script>
function alterardados() {
var resultadoalterar = confirm("Deseja Realmente alterar esses Dados?");
if (resultadoalterar == true) {
    var confalte = "True";
    document.getElementById("confalte").value = confalte;
  }
}

  function voltar() {
  var resultadovoltar = confirm("Cancelar Alteração?");
    if (resultadovoltar == true) {
      location.href='mostrar_usuarios.php';
    }
  }
</script>
</body>
</html>