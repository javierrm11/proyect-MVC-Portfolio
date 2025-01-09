<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/invitado.css">
</head>

<body>
    <header>
        <div>
            <a href="/">Nuevas Tecnologias</a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <?php
                if (isset($_SESSION['usuario'])) {
                    echo "<li><a href=./user>Perfil</a></li>";
                    echo "<li><a href='./logout'>Logout</a></li>";
                } else {
                    echo "<li><a href='./registro'>Registro</a></li>";
                    echo "<li><a href='./login'>Login</a></li>";
                }
                ?>

            </ul>
    </header>
    <main id="invitado">
        <?php
        if (isset($_SESSION['usuario'])) {
            echo "<div>";
            echo "<p class='info'>" . $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos'] . "</p>";
            echo "<img src='/imagenes/"  . $_SESSION['usuario']['foto'] . "' alt='Foto de perfil'>";
            echo "</div>";
        } else {
            echo "<p>Invitado</p>";
        }
        ?>
        <h1>PORTFOLIOS</h1>
        <form action="/buscar" method="post">
            <input type="search" value="<?php echo isset($data["buscar"]) ? htmlspecialchars($data["buscar"]) : '' ?>" placeholder="Buscar" name="buscar">
            <input type="submit" value="Buscar" name="submit">
        </form>
        <section>
            <?php
            if (!empty($data['usuarios'])) {
                foreach ($data['usuarios'] as $usuario) {
                    echo "<article>";
                    echo "<img src='/imagenes/" . htmlspecialchars($usuario['foto']) . "' alt='Foto de perfil'>";
                    echo "<h2>" . htmlspecialchars($usuario['nombre']) . "</h2>";
                    echo "<p class='email'>" . htmlspecialchars($usuario['email']) . "</p>";
                    echo "</article>";
                }
            } else {
                echo "<p>No se encontraron resultados.</p>";
            }
            ?>
        </section>
    </main>
</body>

</html>