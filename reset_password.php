<?php
require "connect.php";
session_start();
?>
<title>Reset Password</title>
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
$email= $new_password = $verify_new_password = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Verificar la existencia del correo
    $check_existance = "SELECT EMAIL FROM USUARIO WHERE EMAIL = ?";
    $stmt = $link -> prepare($check_existance);
    $email = trim($_POST["email"]);
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $stmt -> store_result();

    if($stmt -> num_rows() == 0){
        echo "El correo no existe. Redirigiendo a pagina de registro.";
        header("Location: register.php");
        exit;
    }else{
        $new_password = trim($_POST["new_password"]);
        $verify_new_password = trim($_POST["verify_new_password"]);
        if($new_password == $verify_new_password){
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE USUARIO SET CONTRASEÑA = ? WHERE EMAIL = ?";
            $update_stmt = $link -> prepare($update_query);
            $update_stmt -> bind_param("ss", $hash, $email);
            $update_stmt -> execute();
            echo "Contraseña cambiada con exito, redirigiendo a Login";
            header("Location: login.php");
            exit;
        }else{
            echo("Las contraseñas no coinciden.");
        }
    }
}
?>

<html>
    <head> 
        <title> Reset Password </title>
    </head>
    <body>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
            <label> Email </label>
            <input type = "text" name = "email" placeholder = "Correo electrónico" value = "<?php echo $email; ?>" >
            <label> Nueva contraseña </label>
            <input type = "password" name = "new_password" placeholder = "Nueva contraseña" value = "<?php echo $new_password; ?>" >
            <label> Verificar Contraseña </label>
            <input type = "password" name = "verify_new_password" placeholder = "Repita su contraseña" value = "<?php echo $verify_new_password; ?>">
            <input type = "submit" value = "enviar">
        </form>
    </body>
</html>