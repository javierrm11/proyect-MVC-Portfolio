<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/user.css">
    <style>
        /* nav */
        h1 {
            text-align: center;
        }

        main nav {
            background-color: #333;
            color: white;
            padding: 1em 0;
        }

        main nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            gap: 1em;
        }

        main nav ul li {
            flex: 0 0 10vw;
            text-align: center;
        }

        main nav ul li a {
            color: white;
            text-decoration: none;
        }

        /* info */
        main article {
            padding: 1em;
        }

        article h2 {
            text-align: center;
            color: #333;
        }

        article>p {
            text-align: center;
            color: #333;
        }

        article img {
            display: block;
            margin: 0 auto;
            width: 50%;
        }

        article>div {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1em;
            margin: 5vh 20vw;
            background-color: blue;
            padding: 2em;
        }

        div h3 {
            color: white;
            flex: 0 0 100%;
        }

        div p,
        h4 {
            color: white;
            flex: 0 0 100%;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . "/view_header.php"; ?>
    <main>
        <h1>Portfolio</h1>
        <nav>
            <ul>
                <?php
                if ($data['portfolioExists']) {
                    echo "<li><a href='./editar'>Editar</a></li>";
                    echo "<li><a href='./borrar'>Borrar</a></li>";
                } else {
                    echo "<li><a href='./crearPortfolio'>Crear</a></li>";
                }
                ?>
            </ul>
        </nav>
        <article>
            <?php
            if ($data['portfolioExists']) { ?>
                <h2><?php echo $_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellidos"] ?></h2>
                <p><?php echo $_SESSION["usuario"]["categoria_profesional"] ?></p>
                <img src="/imagenes/<?php echo $_SESSION['usuario']['foto']; ?>" alt="Foto de perfil">
                <p><?php echo $_SESSION["usuario"]["email"] ?></p>
                <div>
                    <h3>Trabajos</h3>
                    <?php
                    if (empty($data['trabajos'])) {
                        echo "<p>No tienes trabajos visibles</p>";
                    } else {
                        foreach ($data['trabajos'] as $trabajo) { ?>
                            <h4><?php echo $trabajo["titulo"] ?></h4>
                            <p><?php echo $trabajo["descripcion"] ?></p>
                            <p><?php echo $trabajo["fecha_inicio"] ?></p>
                            <p><?php echo $trabajo["fecha_final"] ?></p>
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
                            <p><?php echo $skill["visible"] ?></p>
                            <p><?php echo $skill["created_at"] ?></p>
                            <p><?php echo $skill["updated_at"] ?></p>
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
        </article>
    </main>
</body>

</html>