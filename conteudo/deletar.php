<?php
include "classe/conexao.php";

$id_funcionario = intval($_GET['id_funcionario']);

/*
* EXCLUSAO DE FUNCIONARIO
*/

$sql_code = "DELETE FROM funcionario WHERE id_funcionario= '$id_funcionario'";

$resposta = $con->query($sql_code) or die($con->errir);

/*
* REDIRECIONAMENTO PARA PAGINA INICIAL
*/
if($resposta)  
    echo "alert('Deletado com sucesso.');
    <script>
    location.href='index.php?p=inicial';
</script>";
else 
echo "
<script> alert('Não foi possível deletar o funcionário.');
location.href='index.php?p=inicial';
</script>";

?>

