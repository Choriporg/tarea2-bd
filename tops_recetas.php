<?php
require "connect.php";
session_start();
?>
<title>Tops Semanal</title>
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


<h2>TOP 10 de esta semana!</h2>
<table>
<tr>
        <th>Nombre</th>
        <th>Apellido</th>
</tr>
<tr>
        <td>Javier</td>
        <td>Villanueva</td>
</tr>
<tr>
        <td>Ignacio</td>
        <td>Panes</td>
</tr>
</table>
<h2>BOTTOM 10 de esta semana!</h2>
<table>
<tr>
        <th>Nombre</th>
        <th>Apellido</th>
</tr>
<tr>
        <td>Javier</td>
        <td>Villanueva</td>
</tr>
<tr>
        <td>Ignacio</td>
        <td>Panes</td>
</tr>
</table>

<?php
$sql = "SELECT * FROM TOP_10";
$result = $link->query($sql);

echo "<table border='1'>";
echo "<tr><th>Column1</th><th>Column2</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['column1'] . "</td><td>" . $row['column2'] . "</td></tr>";
}

echo "</table>";
?>