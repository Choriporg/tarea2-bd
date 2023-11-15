<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedOption = $_POST["vote_option"];

    $updateTable = "UPDATE VOTACION SET VOTOS = VOTOS + 1 WHERE NOMBRE_PLATO = '$selectedOption'";
    $mysqli->query($updateTable);

    header("Location: votacion_semanal.php");
    exit();
}
?>
