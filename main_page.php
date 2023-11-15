<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
//    echo $_SESSION['username'];
} else {
    header("Location: login.php");
//    echo $_SESSION['username'];
}

require "connect.php";

?>
<html lang="en">
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

    nav {
        background-color: #ffe920;
        padding: 10px;
    }

    nav a {
        padding: 10px;
        margin: 0px;
        text-decoration: none;/*le quita las lineas*/
        color: #000000;
        font-weight: bold;
    }

    section {
        display: none;
    }
    #Form_Register,#is_user,#login_button {
        display: none;
    }

    
    </style>
</head>

<body>
    <header>
        <h1>Sabor USM</h1>
        <p>Bienvenido <?php echo $_SESSION['username'];?></p>
    </header>

    <nav>
        <a href="#" onclick="showPage('Home')">Sabor</a>
        <a href="#" onclick="showPage('Busqueda')">Busqueda</a>
        <a href="#" onclick="showPage('Tops Semanal')">Tops Semanal</a>
        <a href="#" onclick="showPage('Votacion Semanal')">Votacion Semanal</a>
        <a href="#" onclick="showPage('Usuario')">Usuario</a>
    </nav>
    
    <section id="Home">
        <h2>Welcome to the Sabor USM</h2>
        <p>Nuevas recetas todas las semanas!.</p>
        <p>Por favor dejen sus reseñas!</p>
    </section>

    <section id="Busqueda">
        <h2>Barra de busqueda</h2>
        <form action="search.php" method="post">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search">
        <input type="submit" value="Search">
        </form>
    </section>
    <section id="Tops Semanal">
        <h2>Tops de esta semana</h2>
        <a href="tops_recetas.php">click me!</a>
    </section>
    <section id="Usuario">
        <h2>Ir a mi perfil</h2>
        <a href="usuarios_sabor.php">click me!</a>
    </section>

    <section id="Votacion Semanal">
        <h2>Votacion Semanal</h2>
        <a href="votacion_semanal.php">click me!</a>
    </section>

    <script>
        function showPage(pageId) {
            // Hide sections (all)
            document.querySelectorAll('section').forEach(section => {
                section.style.display = 'none';
            });
            // Show the chosen (one) section
            document.getElementById(pageId).style.display = 'block';
        }
        document.getElementById('Home').style.display = 'block';
    </script>
</body>
</html>