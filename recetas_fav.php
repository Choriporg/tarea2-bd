<?php
require "connect.php";
session_start();
?>
<title>Recetas Favoritas</title>
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


<ol>
    <li>receta 1</li>
        <img src='imagesSaborUsm\platoDefault.jpg'
            alt="recipe 1 img" width="50" height="50" />
    <li>receta 3</li>
    <li>receta 2</li>
    <ul>
        <li>receta 4</li>
        <li>receta 5</li>
    </ul>
</ol>