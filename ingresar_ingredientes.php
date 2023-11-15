<?php
require "connect.php";
session_start();
?>
<title>Ingresar Ingredientes</title>
<head>
    <meta charset="UTF-8">
    <title>Sabor USM</title>
    <style>
        body {
        margin: 0;
        overflow-x: scroll;}

        header {
        background-color: #000000;
        color: #ffffff;
        padding: 20px;
        text-align: center;
        text-shadow: #a64747;
    }
    </style>
</head>
<header>
    <h1>Sabor USM</h1>
    <p>Bienvenido <?php echo $_SESSION['username'];?></p>
</header>
<a href = "main_page.php">Home</a>

<?php

require "connect.php";
session_start();


if(!isset($_SESSION["username"])){
    header("Location: login.php");
}

$nombre_ingrediente = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION["numero_ingredientes"]) and isset($_SESSION["nombre_receta"])){
        $nombre_receta = $_SESSION["nombre_receta"];
        $numero_ingredientes = $_SESSION["numero_ingredientes"];
        $check_existance = "SELECT COUNT(NOMBRE_INGREDIENTE) FROM INGREDIENTES WHERE NOMBRE_INGREDIENTE = ?";
        $check_stmt = $link -> prepare($check_existance);
        

        for($cont = 0; $cont < $numero_ingredientes; $cont++){
            $nombre_ingrediente = $_POST["nombre_ingrediente"][$cont];
            $check_stmt -> bind_param("s", $nombre_ingrediente);
            $check_stmt -> execute();
            $check_stmt -> bind_result($resultado);
            $check_stmt -> fetch();
            $check_stmt -> free_result();
            
            $insert_relation = "INSERT INTO RECETA_INGREDIENTES(NOMBRE_PLATO, NOMBRE_INGREDIENTE) VALUES (?,?)";
            $relation_stmt = $link -> prepare($insert_relation);

            if($resultado == 0){
                $lactosa = $diabetico = $gluten = $vegano = 0;

                if(isset($_REQUEST["Lactosa"][$cont])){
                    $lactosa = 1;
                }

                if(isset($_REQUEST["Diabetico"][$cont])){
                    $diabetico = 1;
                }

                if(isset($_REQUEST["Gluten"][$cont])){
                    $gluten = 1;
                }

                if(isset($_REQUEST["Vegano"][$cont])){
                    $vegano = 1;
                }

                $insert_ingredientes = "INSERT INTO INGREDIENTES(NOMBRE_INGREDIENTE, VEGANO, GLUTEN, DIABETICO, LACTOSA) VALUES (?,?,?,?,?)";
                $ingredientes_stmt = $link -> prepare($insert_ingredientes);
                $ingredientes_stmt -> bind_param("siiii", $nombre_ingrediente, $vegano, $gluten, $diabetico, $lactosa);
                $ingredientes_stmt -> execute();
            }

            $relation_stmt -> bind_param("ss", $nombre_receta, $nombre_ingrediente);
            $relation_stmt -> execute();
        }
    }
}
?>

<html>
    
<head>
    <title>Ingresar ingredientes</title>
</head>

<body>
    <h1> Ingrese los detalles de los ingredientes</h1>
    <form action = "ingresar_ingredientes.php" method = "post">
        <?php
       if(isset($_SESSION["numero_ingredientes"])){
        $numero_ingredientes = (int)$_SESSION["numero_ingredientes"];
       }

        for($cont = 0; $cont < $numero_ingredientes; $cont++){
            echo "<div>";
            echo "<br></br>";
            echo '<label>Ingrediente ' . $cont . ':</label>';
            echo '<input type ="text" name = "nombre_ingrediente[' . $cont . ']" placeholder = "Nombre Ingrediente" value = "' . $nombre_ingrediente . '">';
            echo "</div>";
            echo "<label> Apto para: </label>";
            echo "<div>";

            echo '<input type = "checkbox" name = "Lactosa[' . $cont . ']">';
            echo '<label for="Lactosa">Lactosa</label>';

            echo '<input type = "checkbox" name = "Diabetico[' . $cont . ']">';
            echo '<label for="Diabetico">Diabetico</label>';

            echo '<input type = "checkbox" name = "Gluten[' . $cont . ']">';
            echo '<label for="Gluten">Gluten</label>';

            echo '<input type = "checkbox" name = "Vegano[' . $cont . ']">'; 
            echo '<label for="Vegano">Vegano</label>';    

            echo '</div>';        
        }
        ?>
        <br></br>
        <input type = "submit" value = "enviar">
    </form>
</body>
</html>