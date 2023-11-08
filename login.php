<?php

require "connect.php";

$email = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql = "SELECT EMAIL, CONTRASEÑA FROM USUARIO WHERE EMAIL = ?";
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $stmt = $link -> prepare($sql);
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($bd_email, $bd_password);

    //Verificar que el correo exista en la base de datos
    if($stmt -> num_rows() != 0){
        $stmt -> fetch();
        if(password_verify($password, $bd_password)){
            session_start();
            $_SESSION["username"] = $email;
            $sql_query = "UPDATE USUARIO SET LAST_LOGIN = NOW() WHERE EMAIL = ?";
            $update_stmt = $link -> prepare($sql_query);
            $update_stmt -> bind_param("s", $email);
            $update_stmt -> execute();
            header("Location: main_page.php");
        }else{
            echo ("Clave incorrecta.");
        }
    }
}
?>

<html>
    <title>Login</title>
    <body>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
            <label> Email </label>
            <input type = "text" name = "email" placeholder = "Correo electrónico" value = "<?php echo $email; ?>">
            <label> Contraseña </label>
            <input type = "password" name = "password" placeholder = "Contraseña" value = "<?php echo $password; ?>">
            <input type = "submit" value = "enviar">
            <a href = "reset_password.php"> No recuerdo la contraseña</a>
            <a href = "register.php"> ¿No estás registrado? </a>  
        </form>
    </body>
</html>