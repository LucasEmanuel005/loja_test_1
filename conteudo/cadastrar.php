<?php
include "classe/conexao.php";


session_start();
$_SESSION['nome'] ='';
$_SESSION['sobrenome'] = '';
$_SESSION['d_nascimento'] = '';
$_SESSION['d_admissao'] ='';
$_SESSION['cargo'] ='';

if(isset($_POST['bt_cadastrar']))
{
   

/*
* REGISTRO DOS DADOS
*/ 
  $_SESSION['nome'] = $_POST['nome'];
  $_SESSION['sobrenome'] = $_POST['sobrenome'];
  $_SESSION['d_nascimento'] = $_POST['d_nascimento'];
  $_SESSION['d_admissao'] = $_POST['d_admissao'];
  $_SESSION['cargo'] = $_POST['cargo'];
  

/*
* VALIDAÇÃO DOS DADOS
*/
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
* INSERÇÃO NO BANCO E REDIRECIONAMENTO 
*/

        $sql_code = "INSERT INTO funcionario (nome_funcionario, sobrenome_funcionario, d_nascimento, d_admissao, fk_Cargo_id_cargo) VALUES ('$_SESSION[nome]', '$_SESSION[sobrenome]', '$_SESSION[d_nascimento]', '$_SESSION[d_admissao]', '$_SESSION[cargo]')";


        echo $sql_code;

        $resposta = $con->query($sql_code) or die ($con->error);


        if($resposta)
        {
            unset(
                $_SESSION[nome], $_SESSION[sobrenome], $_SESSION[d_nascimento], $_SESSION[d_admissao], $_SESSION[cargo]);
            echo 
            " <script> 
                    alert('Cadastrado com sucesso');
                    location.href = 'index.php?p=inicial'; 
                </script>";
        }
        else
        {
            $error[] = $resposta;
        }
    }
    else
    {
        echo " <script> 
        alert('Todos os campos são de preenchimento obrigatório.'); 
    </script>";
       

    }


}
/*
* REDIRECIONAMENTO 'VOLTAR'
*/
elseif(isset($_POST['bt_inicial']))
{
  
    unset($_SESSION[nome], $_SESSION[sobrenome], $_SESSION[d_nascimento], $_SESSION[d_admissao], $_SESSION[cargo]);
    
    echo 
    " <script> 
     
            location.href = 'index.php?p=inicial'; 
        </script>";

}

/*
* PESQUISA PARA PREENCHIMENTO DOS CARGOS
*/
$sql_code= "SELECT * FROM cargo";
$sql_dados = mysqli_query($con, $sql_code);


?>


<div id="d_cadastar">
    </br></br>
    <h3>Novo Funcionário</h3>
    </br></br>

        <form name="new" method="POST" action="index.php?p=cadastrar">
            
            <label for="nome">Nome: </label>   
                <input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" ></br></br>

            <label for="sobrenome"> Sobrenome: </label>
                <input type="text" name="sobrenome" value="<?php echo $_SESSION['sobrenome']; ?>" ></br></br>

            <label for="d_nascimento">Data de Nascimento: </label>
                <input type="date" name="d_nascimento" value="<?php echo $_SESSION['d_nascimento']; ?>" ></br></br>

            <label for="d_admissao">Data de Admissão: </label>
                <input type="date" name="d_admissao"  ></br></br>

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
                    <option value=" <?php echo "$id_cargo"; ?>">  <?php echo "$nome_cargo"; ?> </option>
                <?php 
                } ?>
            </select></br></br>

            <input type="submit" name="bt_cadastrar" value="Cadastrar" class='bt_cadastrar'>
            <input type="submit" name="bt_inicial" value="Voltar" class='bt_cadastrar'></br></br>
        </form>
</div>



