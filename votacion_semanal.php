<?php
require "connect.php";
session_start();
?>
<title>Votacion</title>
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
$sql = "SELECT * FROM VOTACION";
$stmt = $link->prepare($sql);
$result = $link->query($sql);
$options = [];
while ($row = $result->fetch_assoc()) {
    $options[] = $row['NOMBRE_PLATO'];
}
?>

<body>
    <h1>Voten por el plato de la semana!</h1>
    <form action="voto.php" method="post">
        <?php foreach ($options as $option): ?>
            <label>
                <input type="radio" name="vote_option" value="<?= $option ?>">
                <?= $option ?>
            </label><br>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Vote">
    </form>
</body>
