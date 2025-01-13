<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h2>Añadir Trabajo</h2>
        <form action="" method="post">
            <div>
                <h3>Trabajos</h3>
                <label for="tituloTrabajos">Titulo</label>
                <input type="text" name="tituloTrabajos" id="tituloTrabajos" value="">
                <label for="descripcionTrabajos">Descripción</label>
                <textarea name="descripcionTrabajos" id="descripcionTrabajos" cols="30" rows="10"></textarea>

                <label for="fecha_inicioTrabajos">Fecha Incio</label>
                <input type="date" name="fecha_inicioTrabajos" id="fecha_inicioTrabajos" value="">

                <label for="fecha_finTrabajos">Fecha Fin</label>
                <input type="date" name="fecha_finTrabajos" id="fecha_finTrabajos" value="">

                <label for="logrosTrabajos">logros</label>
                <input type="text" name="logrosTrabajos" id="logrosTrabajos" value="">
            </div>
            <p><?php echo $data['error'] ?></p>
            <input type="submit" value="Guardar" name="anadirTrabajo">
        </form>
    </main>
</body>

</html>