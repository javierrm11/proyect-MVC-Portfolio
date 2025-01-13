<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Proyecto</title>
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
        <h2>Añadir Proyecto</h2>
        <form action="" method="post">
            <div>
                <h3>Proyecto</h3>
                <label for="titulo">Titulo</label>
                <input type="text" name="titulo" id="titulo" value="">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>

                <label for="tecnologias">Tecnologias</label>
                <input type="text" name="tecnologias" id="tecnologias" value="">
            </div>
            <p><?php echo $data['error'] ?></p>
            <input type="submit" value="Guardar" name="anadirProyecto">
        </form>
    </main>
</body>

</html>