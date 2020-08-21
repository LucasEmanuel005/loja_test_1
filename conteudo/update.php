<?php
include "classe/conexao.php";

$id_funcionario = intval($_GET['id_funcionario']);






if(isset($_POST['bt_atualizar']))
{
    

/*
* VALIDAÇÃO DOS DADOS
*/
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['sobrenome'] = $_POST['sobrenome'];
    $_SESSION['d_nascimento'] = $_POST['d_nascimento'];
    $_SESSION['d_admissao'] = $_POST['d_admissao'];
    $_SESSION['cargo'] = $_POST['cargo'];

    if (strlen($_SESSION['nome'])== 0)
    $erro[]= "Preencha o nome.";
    if (strlen($_SESSION['sobrenome'])== 0)
    $erro[]= "Preencha o sobrenome.";
    if (strlen($_SESSION['d_nascimento'])== 0)
    $erro[]= "Preencha o campo data de nascimento.";
    if (strlen($_SESSION['d_admissao'])== 0)
    $erro[]= "Preencha o campo data admissão.";
   



    if(count($erro) == 0)
    {
  
        /*
        * INSERCAO NO BANCO E REDIRECIONAMENTO 
        */

        $sql_code = "UPDATE  funcionario SET 
        nome_funcionario = '$_SESSION[nome]', 
        sobrenome_funcionario = '$_SESSION[sobrenome]', 
        d_nascimento = '$_SESSION[d_nascimento]',
        d_admissao = '$_SESSION[d_admissao]',
        fk_Cargo_id_cargo = '$_SESSION[cargo]' WHERE id_funcionario = '$id_funcionario'";

        $resposta = $con->query($sql_code) or die ($con->error);


        if($resposta)
        {
            unset(
                $_SESSION[nome], $_SESSION[sobrenome], $_SESSION[d_nascimento], $_SESSION[d_admissao], $_SESSION[cargo]);
            echo 
            " <script> 
                    alert('Atualizado com sucesso');
                    location.href = 'index.php?p=inicial'; 
                </script>";
        }
        else
        {
            echo " <script> 
                        alert('Não foi possível atualizar, tente de novo.');                     
                        location.href='index.php?p=update&id_funcionario=$id_funcionario';
                    </script>";
        }
        
    }
    else
    {
        echo " <script> 
                    alert('Todos os campos são de preenchimento obrigatório.');                     
                    location.href='index.php?p=update&id_funcionario=$id_funcionario';
                </script>";
                


    }
}

/*
*  REDIRECIONAMENTO 'VOLTAR'
*/
elseif(isset($_POST['bt_inicial']))
{
  
    unset($_SESSION[nome], $_SESSION[sobrenome], $_SESSION[d_nascimento], $_SESSION[d_admissao], $_SESSION[cargo]);
    
    echo 
    " <script>      
            location.href = 'index.php?p=listar'; 
        </script>";

}

/*
* PREENCHIMENTO DOS CAMPOS PARA ATUALIZAR
*/ 
else
{
    session_start();
    $sql_code= "SELECT id_funcionario, nome_funcionario, sobrenome_funcionario, DATE_FORMAT(d_nascimento,'%d/%m/%Y') AS d_nascimento_f, DATE_FORMAT(d_admissao,'%d/%m/%Y') AS d_admissao_f, fk_Cargo_id_cargo FROM funcionario WHERE id_funcionario = '$id_funcionario'";
    $sql_dados = mysqli_query($con, $sql_code);

    while($vetor = mysqli_fetch_array($sql_dados))
    {
        $_SESSION["id_funcionario"] = $vetor["id_funcionario"];
        $_SESSION["nome"] = $vetor["nome_funcionario"];
        $_SESSION["sobrenome"] = $vetor["sobrenome_funcionario"];
        $_SESSION["d_nascimento"] = $vetor["d_nascimento_f"];
        $_SESSION["d_admissao"] = $vetor["d_admissao_f"];
    }
}




/*
* PESQUISA PARA PREENCHIMENTO DOS CARGOS
*/
$sql_code= "SELECT * FROM cargo";
$sql_dados= mysqli_query($con, $sql_code);


?>




<div id="d_cadastar">
    <h3>Atualiza Funcionário</h3></br></br>

    <form name="new" method="POST" action="index.php?p=update&id_funcionario= <?php echo  $id_funcionario; ?> ">
        <label for="id_funcionario">Id funcionário: </label>   
            <input type="text" name="id_funcionario" value= "<?php echo $_SESSION['id_funcionario']; ?> " readonly ></br></br>

        <label for="name">Nome: </label>   
            <input type="text" name="nome" value= "<?php echo $_SESSION['nome']; ?> " ></br></br>

        <label for="sobrenome"> Sobrenome: </label>
            <input type="text" name="sobrenome" value= "<?php echo $_SESSION['sobrenome']; ?> "  ></br></br>

        <label for="d_nascimento">Data de Nascimento: </label>
            <input type="date" name="d_nascimento" ></br></br>

        <label for="d_admissao">Data de Admissão: </label>
            <input type="date" name="d_admissao" ></br></br>

        
    
        <label for="cargo">Cargo: </label>
        <select name="cargo">
            <?php 
            /*
            * PREECHIMENTO DOS CARGOS
            */ 
            while($vetor = mysqli_fetch_array($sql_dados))
            {        
                $id_cargo = $vetor['id_cargo'];
                $nome_cargo = $vetor['nome_cargo'];
                ?>
                <option value= " <?php echo "$id_cargo"; ?> ">  <?php echo "$nome_cargo"; ?> </option>
            <?php 
            } ?>
        </select></br></br>
        
    

        <input type="submit" name = "bt_atualizar" value="Atualizar" class='bt_cadastrar'>
        <input type="submit" name="bt_inicial" value="Voltar" class='bt_cadastrar'></br></br>
    </form>

</div>