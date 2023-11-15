<?php

require "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $search = $_POST["search"];

    $sql = "SELECT * FROM RECETA WHERE NOMBRE_PLATO , TIPO LIKE '%$search%'";
    $result = $link->query($sql);

    // Display the search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display the results as needed
            echo "NOMBRE_PLATO: " . $row["NOMBRE_PLATO"] . " - TIPO: " . $row["TIPO"] . "<br>";
        }
    } else {
        echo "No results found";
    }
}


$link->close();
?>
