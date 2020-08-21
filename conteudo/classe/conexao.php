<?php

define("servidor","localhost");
define("banco","bd_loja_test_1");
define("porta","3306");
define("usuario","root");
define("senha","");

$con = new mysqli(servidor,usuario,senha,banco,porta);
if($con->connect_error)
    echo "Falha na conexão: (" . $con->connect_error .") ". $con->connect_error;

?>