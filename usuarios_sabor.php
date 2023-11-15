<?php
require "connect.php";
session_start();
$sql = "SELECT * FROM USUARIO WHERE EMAIL = ?";
$email = $_SESSION["email"];
$stmt = $link -> prepare($sql);
$stmt -> bind_param("s", $email);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($bd_email, $bd_password, $bd_username,$lunchesLeft,$lastLogin);
$stmt -> fetch();
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
<body>
    <p>Email: <?php echo $bd_email;?></p>
    <p>Nombre: <?php echo $bd_username;?></p>
    <p>Last Session: <?php echo $lastLogin;?></p>
    <p>Almuerzos Disponibles: <?php echo $lunchesLeft;?></p>
    <a href="recetas_fav.php">Recetas Favoritas</a>
    <a href="edit_profile.php">Editar perfil</a>

</body>


<?php

/*
    editar perfil <a href></a>
                    crear/eliminar cuenta
                    editar info de perfil
                    visualizar info Usuario
    */



?>