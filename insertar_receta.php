<?php
require "connect.php";
session_start();
?>
<title>Ingresar Receta</title>
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
$recepy_name = $tipo_plato = $contenido_imagen = $instrucciones = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION["username"])){     
        //Obtener los valores de cada variable a    
        $recepy_name = trim($_POST["recepy_name"]);
        $numero_ingredientes = $_POST["numero_ingredientes"];
        $tipo_plato = trim($_REQUEST["tipo_plato"]);
        $instrucciones = trim($_REQUEST["instrucciones"]);
        $tiempo_preparacion = $_POST["tiempo_preparacion"];

        $check_image = getimagesize($_FILES["image"]["tmp_name"]);
        if($check_image !== false){
            $image = $_FILES["image"]["tmp_name"];
            $contenido_imagen = addslashes(file_get_contents($image));
        }
        $sql = "INSERT INTO RECETA (NOMBRE_PLATO, FOTO, TIPO, INSTRUCCIONES, TIEMPO_PREPARACION) VALUES (?,?,?,?,?)";
        $stmt = $link -> prepare($sql);
        $stmt -> bind_param("sssss", $recepy_name, $contenido_imagen, $tipo_plato, $instrucciones, $tiempo_preparacion);
        if($stmt -> execute()){
            echo ("Query ejecutada con exito");
        }

        $_SESSION["nombre_receta"] = $recepy_name;
        $_SESSION["numero_ingredientes"] = $numero_ingredientes;

        header("Location: ingresar_ingredientes.php");
        exit();
    }
}

?>

<html>
<title>Ingrsar receta</title>
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
</header>
<a href = "main_page.html">Home</a>

    <body>
        <div>
            <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post" enctype = "multipart/form-data">
                <label>Nombre receta:</label>
                <input type = "text" name = "recepy_name" placeholder = "Nombre de la receta" value = "<?php echo $recepy_name; ?>">
                <label> Foto: </label>
                <input type = "file" name = "image">
        </div>
        <div>
            <label> Tipo plato </label>
            <select name = "tipo_plato">
                <option value = "entrada">Entrada</option>
                <option value = "fondo">Fondo</option>
                <option value = "postre">Postre</option>
            </select>
            <label> Número de ingredientes</label>
            <input type = "number" name = "numero_ingredientes" placeholder = "Número de ingredientes" value = "<?php echo $numero_ingredientes; ?>">
            <div>
                <textarea name = "instrucciones" rows = "10" cols = "40">Ingrese instrucciones</textarea>
            </div>
            <label>Tiempo de preparación</label>
            <input type = "number" name = "tiempo_preparacion" placeholder="Ingrese tiempo de preparación" value = "<?php echo $tiempo_preparacion; ?>"> 
        </div>
            <input type = "submit" value = "enviar">
        </form>
    </body>
</html>