<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="conteudo/estilo/Style.css">
    <link rel="sortcut icon" href="conteudo/img/logo.jpg" type="image/jpg"/>;
    <title>Gestão de Funcionários</title>
</head>
<body>
    <main>
        <header>
            <!--CABEÇALHO DAS PÁGINAS --> 
             <h2>Gestão de Funcionários</h2>            
        </header>
        <section>
            <?php 
                 //DIRECIONAMENTO DAS PÁGINAS

                 if(isset($_GET['p']))
                    {
                        $pagina = $_GET['p'].".php";
                        if(is_file("conteudo/$pagina"))
                        include("conteudo/$pagina");
                        else
                        include("conteudo/404.php");

                    }
                    else 
                        include("conteudo/inicial.php");

            ?>

           
        </section>
        <footer>  
             <!--RODAPÉ DAS PÁGINAS --> 
             <img src="conteudo/img/logo.jpg" alt="clubemercado" id="logo">
        </footer>
    <main>
</body>
</html>