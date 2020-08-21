<?php
include "classe/conexao.php";



?>
    
    <h3> Lista de funcionários</h3>
    <!--BOTAO PARA REDIRECIONAMENTO PAGINA INICIAL-->
   
    <a href="index.php?p=inicial"><input type="submit" value="Início" id="bt_listar"> </a>
    <!--FORM PARA PESQUISAR PELO NOME-->
    <form name="new" method="POST" action="index.php?p=listar">
        <label for="nome_pesquisa">Digite um nome para pesquisar: </label>           
            <input type="text" name="nome_pesquisa">      

        <input type="submit" name = "bt_pesquisar" value="Pesquisar" id="bt_pesquisar_id">
    </form>
     <!--TABELA FUNCIONARIO-->
    </br></br>
    <table class="table_funcionario">  
        <thead>
                <tr>
                    <td>Id</td>
                    <td>nome</td>
                    <td>sobrenome</td>
                    <td>data de nascimento</td>
                    <td>data de admissão</td>
                    <td>cargo</td> 
                    <td>Opções</td>
                    <td>Opções</td>  
                    </td>                
                </tr>
        </thead>
        <tbody>       
                <?php 
                /*
                *   PREENCHIMENTO DA TABELA FUNCIONARIO 
                */   
                session_start();
                $name_pesq='';
            
                if(isset($_POST['nome_pesquisa']))
                {
                    $name_pesq=$_POST['nome_pesquisa'];
                }

                    $sql_code= "SELECT f.id_funcionario, f.nome_funcionario, f.sobrenome_funcionario, f.d_nascimento, f.d_admissao, c.nome_cargo FROM funcionario f JOIN cargo c ON f.fk_Cargo_id_cargo = c.id_cargo WHERE f.nome_funcionario LIKE '$name_pesq%' ORDER BY  id_funcionario ASC;";
                    $sql_dados = mysqli_query($con, $sql_code);

                    while($vetor = mysqli_fetch_array($sql_dados))
                    {
                ?>
                    <tr>
                        <td> <?php echo $id_funcionario = $vetor['id_funcionario']; ?></td>
                        <td> <?php echo $vetor['nome_funcionario']; ?> </td>
                        <td> <?php echo $vetor['sobrenome_funcionario']; ?> </td>
                        <td> <?php echo date("d/m/Y", strtotime($vetor['d_nascimento']));  ?> </td>
                        <td> <?php echo date("d/m/Y", strtotime($vetor['d_admissao'])); ?> </td>
                        <td> <?php echo $vetor['nome_cargo']; ?> </td>
                        <td> <a href="javascript: if(confirm('Tem certeza que deseja deletar o usuário <?php echo $vetor['nome_funcionario']; ?>')) location.href='index.php?p=deletar&id_funcionario=<?php echo $vetor['id_funcionario']; ?>';"> <input type="submit" value="Deletar" class="bt_listar2"></a> </td>

                        <td> <a href="index.php?p=update&id_funcionario=<?php echo $vetor['id_funcionario']; ?>"> <input type="submit" value="Atualizar" class="bt_listar2"></a> </td>
                    </tr>  
                <?php
                }
                ?>


        </tbody>
    </table>
   








