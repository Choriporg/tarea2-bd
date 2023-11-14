<?php

require"connect.php";  

$email = $password = $verify_password = "";
$name = "";
$num_almuerzos = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){    
    //Query para verificar si el correo existe o no
    $sql = "SELECT EMAIL FROM USUARIO WHERE EMAIL = ?";
    
    //Variables que se utilizaran
    $email = trim($_POST["email"]);
    $stmt = $link -> prepare($sql);
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $stmt -> store_result();
    


    //Verificar si el correo ya existe en la tabla usuario
    if($stmt ->num_rows() > 0){
        echo("Este correo se encuentra en uso, por favor utilice uno distinto \n");
        
    }else{
        //Si no existe el correo crea el usuario en la base de datos
        $insert_query = "INSERT INTO USUARIO (EMAIL, CONTRASEÑA, NOMBRE, NUM_ALMUERZOS) 
        VALUES (?,?,?,?)";
        $password = trim($_POST["password"]);
        $verify_password = trim($_POST["verify_password"]);
        if($password == $verify_password){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $name = trim($_POST["nombre"]);
            $num_almuerzos = trim($_POST["num_almuerzos"]);
            $insert_stmt = $link -> prepare($insert_query);
            $insert_stmt ->bind_param("ssss", $email, $hash, $name, $num_almuerzos);
            if($insert_stmt -> execute()){
                echo("Registro ingresado con exito!");
                header("Location: login.php");
            }
        }else{
            echo("Las contraseñas no coinciden.");
        }
        
    }
}
?>

<html>
    <head>
        <title> Registro </title>
</head>
    <body>
        <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post"> 
            <div>
                <label> Email: </label>
                <input type = "text" name = "email" placeholder = "Correo electrónico" value = "<?php echo $email;?>" >
                <label> Contraseña </label>
                <input type = "password" name = "password" placeholder = "Contraseña" value = "<?php echo $password;?>">
                <label> Verificar contraseña </label>
                <input type = "password" name = "verify_password" placeholder = "Repita su contraseña" value = "<?php echo $verify_password; ?>">
            </div>
            <label> Nombre </label>
            <input type = "text" name = "nombre" plaseholder = "Ingrese su nombre" value = "<?php echo $name;?>">
            <label> Numero de almuerzos </label>
            <input type ="number" name = "num_almuerzos"placeholder = "Ingrese numero de almuerzos" value = "<?php echo $num_almuerzos;?>">
            <input type ="submit" value="enviar">
        </form> 
   </body>
</html>
