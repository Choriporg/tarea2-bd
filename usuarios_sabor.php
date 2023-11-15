<?php
require "connect.php";
session_start();
?>
<title>Usuario</title>
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
if(isset($_SESSION["username"])){
        $email = $_SESSION["username"];
    
    }

    echo "cuenta";
    echo "nombre usuario:";
    $_POST[$_SESSION["username"]] = $email;
    /*correo: $_POST;
    ultimo inicio de sesion: $_POST;
    almuerzos disponibles: $_POST
    recetas favoritas: <a href></a>
    Calificaciones y reseñas: <a href></a>

    editar perfil <a href></a>
                    crear/eliminar cuenta
                    editar info de perfil
                    visualizar info Usuario
    */



?>