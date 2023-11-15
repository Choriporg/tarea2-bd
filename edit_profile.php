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

