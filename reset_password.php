<?php

require "connect.php";

$email= $new_password = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE USUARIO SET CONTRASEÑA = ? WHERE EMAIL = ?";
        $update_stmt = $link -> prepare($update_query);
        $update_stmt -> bind_param("ss", $hash, $email);
        $update_stmt -> execute();
        echo "Contraseña cambiada con exito, redirigiendo a Login";
        header("Location: login.php");
        exit;
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
            <input type = "submit" value = "enviar">
        </form>
    </body>
</html>