<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Red Social</title>
    <link rel="stylesheet" href="../styles/crearPortfolio.css">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <header>
        <div>
            <a href="/">PortfoliosHub</a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo "<li><a href=../user>Perfil</a></li>";
                    echo "<li><a href='../logut'>Logout</a></li>";
                } else {
                    echo "<li><a href='../registro'>Registro</a></li>";
                    echo "<li><a href='../login'>Login</a></li>";
                }
                ?>

            </ul>
    </header>
    <main>
        <h1><?php echo $_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellidos"] ?></h1>
        <h2>Añadir Red Social</h2>
        <form action="" method="post">
            <div>
                <h3>Red Social</h3>
                <label for="redSocial">Red Social</label>
                <input type="text" name="redSocial" id="redSocial" value="">
                <label for="url">Url</label>
                <input type="url" name="url" id="url">
            </div>
            <p><?php echo $data['error'] ?></p>
            <input type="submit" value="Guardar" name="anadirRedSocial">
        </form>
    </main>
</body>

</html>