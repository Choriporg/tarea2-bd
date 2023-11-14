<?php

require "connect.php";

if(isset($_SESSION["username"])){
    $email = $_SESSION["username"];
    
}

?>

<html>
    <head>
        <title>Pagina principal</title>    
    </head>
    <body>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
            <a href = "insertar_receta.php"> Ingresar receta</a>
            <a href = "ingresar_reseña.php"> Ingresar reseña</a>
        </form>
    </body>
</html>