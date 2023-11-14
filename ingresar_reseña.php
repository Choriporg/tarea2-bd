<?php

require "connect.php";
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
}

$email = $_SESSION["username"];
$nombre_receta = trim($_POST["nombre_receta"]);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $check_recepy = "SELECT COUNT(NOMBRE_PLATO) FROM RECETA WHERE NOMBRE_PLATO = ?";

    $check_stmt = $link -> prepare($check_recepy);
    $check_stmt -> bind_param("s", $nombre_receta);
    $check_stmt -> execute();
    $check_stmt -> bind_result($resultado);
    $check_stmt -> fetch();
    $check_stmt -> free_result();

    if($resultado == 0){
        //Caso donde no existe la receta
        echo "La receta no existe en la base de datos";
        echo "<a href = 'ingresar_receta.php' > Registrar receta </a>";
    } else {
        //Caso donde la receta existe
        $review_query = "INSERT INTO RESEÑA(EMAIL, NOMBRE_PLATO, CALIFICACION, FAVORITO, COMENTARIOS) VALUES(?,?,?,?,?)";
        $check_review = "SELECT COUNT(*) FROM RESEÑA WHERE EMAIL = ? AND NOMBRE_PLATO = ?";

        $check_review_existance = $link -> prepare($check_review);
        $check_review_existance -> bind_param("ss", $email, $nombre_receta);
        $check_review_existance -> execute();
        $check_review_existance -> bind_result($resultado_review);
        $check_review_existance -> fetch();
        $check_review_existance -> free_result();

        //Caso donde un usuario no ha reseñado la receta
        if($resultado_review == 0){
            $calificacion = $_POST["calificacion"];
            $favorito = 0;

            if(isset($_REQUEST["favorito"])){ //Verificar si la checkbox favorito a sido marcada.
                $favorito = 1;
            }

            $comentarios = trim($_REQUEST["comentarios"]);

            $insert_stmt = $link -> prepare($review_query);
            $insert_stmt -> bind_param("ssiis", $email, $nombre_receta, $calificacion, $favorito, $comentarios);
            if($insert_stmt -> execute()){
                echo("Query ejecutada con exito");
            }  
        }
    }
}

?>

<html>
    <head>
        <title>Ingresar reseña</title>
    </head>
    <body>
        <a href = "main_page.php">Pagina principal</a>
        <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
            <label>Nombre receta</label>
            <input type = "text" name = "nombre_receta" placeholder = "Nombre de la receta" value = "<?php echo $nombre_receta; ?>">
            <label>Calificacion</label>
            <input type = "number" name = "calificacion" placeholder = "Ingrese calificación" value = "<?php echo $calificacion; ?>">
            <div>
                <textarea name = "comentarios" rows = "10" cols = "40"> Comentarios </textarea>
                <input type = "checkbox" name = "favorito">
                <label for = "favorito">Favorito</label>
            </div>
            <input type = "submit" value = "enviar">
        </form>
    </body>
</html>