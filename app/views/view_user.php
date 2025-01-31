<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" href="../styles/style.css">
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
    <main>
        <h1>Portfolio</h1>
        <nav>
            <ul>
                <?php
                if ($data['portfolioExists']) {
                    if ($_SESSION['usuario']['visible'] == 1) {
                        echo "<li><a href='./ocultarUsuario'>Ocultar usuario</a></li>";
                    } else {
                        echo "<li><a href='./mostrarUsuario'>Mostrar usuario</a></li>";
                    }
                    echo "<li><a href='./editar'>Editar</a></li>";
                    echo "<li><a href='./borrar'>Borrar</a></li>";
                } else {
                    echo "<li><a href='./crearPortfolio'>Crear</a></li>";
                }
                ?>
            </ul>
        </nav>
        <article>
            <h2><?php echo $_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellidos"] ?></h2>
            <p><?php echo $_SESSION["usuario"]["categoria_profesional"] ?></p>
            <img src="/imagenes/<?php echo $_SESSION['usuario']['foto']; ?>" alt="Foto de perfil">
            <p><?php echo $_SESSION["usuario"]["email"] ?></p>
            <?php
            if ($data['portfolioExists']) { ?>
                <div>
                    <h3>Trabajos</h3>
                    <?php
                    if (empty($data['trabajos'])) {
                        echo "<p>No tienes trabajos visibles</p>";
                    } else {
                        foreach ($data['trabajos'] as $trabajo) { ?>
                            <h4><?php echo $trabajo["titulo"] ?></h4>
                            <p><?php echo $trabajo["descripcion"] ?></p>
                            <p>Fecha de Inicio: <?php echo $trabajo["fecha_inicio"] ?></p>
                            <p>Fecha Final: <?php echo $trabajo["fecha_final"] ?></p>
                            <p><?php echo $trabajo["logros"] ?></p>
                    <?php }
                    } ?>
                </div>
                <div>
                    <h3>Proyectos</h3>
                    <?php
                    if (empty($data['proyectos'])) {
                        echo "<p>No tienes proyectos visibles</p>";
                    } else {
                        foreach ($data['proyectos'] as $proyecto) { ?>
                            <h4><?php echo $proyecto["titulo"] ?></h4>
                            <p><?php echo $proyecto["descripcion"] ?></p>
                            <p><?php echo $proyecto["tecnologias"] ?></p>
                    <?php }
                    } ?>
                </div>
                <div>
                    <h3>Skills</h3>
                    <?php
                    if (empty($data['skills'])) {
                        echo "<p>No tienes skills visibles</p>";
                    } else {
                        foreach ($data['skills'] as $skill) { ?>
                            <h4><?php echo $skill["habilidades"] ?></h4>
                            <p>Categoria: <?php echo $skill["categorias_skills_categoria"] ?></p>
                    <?php }
                    } ?>
                </div>
                <div>
                    <h3>Redes Sociales</h3>
                    <?php
                    foreach ($data['redesSociales'] as $redes) { ?>
                        <h4><?php echo $redes["redes_socialescol"] ?></h4>
                        <p><?php echo $redes["url"] ?></p>
                    <?php } ?>
                </div>
            <?php } else {
                echo "<p>No tienes un portfolio creado</p>";
            }
            ?>
            <div class="button-container">
                <a href="./borrarUsuario" class="button">Borrar Cuenta</a>
            </div>
        </article>
    </main>
</body>

</html>