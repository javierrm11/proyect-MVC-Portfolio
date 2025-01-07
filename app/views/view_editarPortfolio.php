<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/editarPortfolio.css">
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

        article>form div {
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

        form>div>div {
            flex: 0 0 100%;
            display: flex;
            margin: 0;
        }

        form>div>div>input {
            flex: 1;
        }

        form>div>div>label {
            flex: 1;
            color: white;
        }

        form>div>a {
            text-decoration: none;
            color: blue;
            background: white;
            padding: 1vh 1.5vw;
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
                    echo "<li><a href='/editar'>Editar</a></li>";
                    echo "<li><a href='/borrar'>Borrar</a></li>";
                } else {
                    echo "<li><a href='/crearPortfolio'>Crear</a></li>";
                }
                ?>
            </ul>
        </nav>
        <article>
            <?php
            if ($data['portfolioExists']) { ?>
                <h2><?php echo $_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellidos"] ?></h2>
                <p><?php echo $_SESSION["usuario"]["categoria_profesional"] ?></p>
                <img src="<?php echo $_SESSION["usuario"]["foto"] ?>" alt="Foto de perfil">
                <p><?php echo $_SESSION["usuario"]["email"] ?></p>
                <form action="" method="post">
                    <div>
                        <h3>Trabajos</h3>
                        <?php
                        foreach ($data['trabajos'] as $trabajo) { ?>
                            <div>
                                <label><?php echo $trabajo["titulo"] ?></label>
                                <input type="text" name="tituloTrabajos" value="<?php echo $trabajo["titulo"] ?>">
                                <p><?php echo $data['eTituloTrabajos'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $trabajo["descripcion"] ?></label>
                                <input type="text" name="descripcionTrabajos" value="<?php echo $trabajo["descripcion"] ?>">
                                <p><?php echo $data['eDescripcionTrabajos'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $trabajo["fecha_inicio"] ?></label>
                                <input type="date" name="fecha_inicioTrabajos" value="<?php echo $trabajo["fecha_inicio"] ?>">
                                <p><?php echo $data['eFecha_inicioTrabajos'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $trabajo["fecha_final"] ?></label>
                                <input type="date" name="fecha_finTrabajos" value="<?php echo $trabajo["fecha_final"] ?>">
                                <p><?php echo $data['eFecha_finTrabajos'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $trabajo["logros"] ?></label>
                                <input type="text" name="logrosTrabajos" value="<?php echo $trabajo["logros"] ?>">
                                <p><?php echo $data['eLogrosTrabajos'] ?></p>
                            </div>
                            <?php
                            if ($trabajo["visible"] == 1) { ?>
                                <a href="/ocultarTrabajo/<?php echo $trabajo['id']; ?>">Ocultar</a>
                            <?php } else { ?>
                                <a href="/mostrarTrabajo/<?php echo $trabajo['id']; ?>">Mostrar</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div>
                        <h3>Proyectos</h3>
                        <?php
                        foreach ($data['proyectos'] as $proyecto) { ?>
                            <div>
                                <label><?php echo $proyecto["titulo"] ?></label>
                                <input type="text" name="tituloProyectos" value="<?php echo $proyecto["titulo"] ?>">
                                <p><?php echo $data['eTituloProyectos'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $proyecto["descripcion"] ?></label>
                                <input type="text" name="descripcionProyectos" value="<?php echo $proyecto["descripcion"] ?>">
                                <p><?php echo $data['eDescripcionProyectos'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $proyecto["tecnologias"] ?></label>
                                <input type="text" name="tecnologiasProyectos" value="<?php echo $proyecto["tecnologias"] ?>">
                                <p><?php echo $data['eTecnologiasProyectos'] ?></p>
                            </div>
                            <?php
                            if ($proyecto["visible"] == 1) { ?>
                                <a href="/ocultarProyecto/<?php echo $proyecto['id']; ?>">Ocultar</a>
                            <?php } else { ?>
                                <a href="/mostrarProyecto/<?php echo $proyecto['id']; ?>">Mostrar</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div>
                        <h3>Skills</h3>
                        <?php
                        foreach ($data['skills'] as $skill) { ?>
                            <div>
                                <label><?php echo $skill["habilidades"] ?></label>
                                <input type="text" name="habilidades" value="<?php echo $skill["habilidades"] ?>">
                                <p><?php echo $data['eHabilidades'] ?></p>
                            </div>
                            <div>
                                <label><?php echo $skill["categorias_skills_categoria"] ?></label>
                                <input type="text" name="categoria" value="<?php echo $skill["categorias_skills_categoria"] ?>">
                                <p><?php echo $data['eCategoria'] ?></p>
                            </div>
                            <?php
                            if ($skill["visible"] == 1) { ?>
                                <a href="/ocultarSkill/<?php echo $skill['id']; ?>">Ocultar</a>
                            <?php } else { ?>
                                <a href="/mostrarSkill/<?php echo $skill['id']; ?>">Mostrar</a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div>
                        <h3>Redes Sociales</h3>
                        <?php
                        foreach ($data['redesSociales'] as $redes) { ?>
                            <div>
                                <h4><?php echo $redes["redes_socialescol"] ?></h4>
                                <input type="text" name="<?php echo $redes["redes_socialescol"] ?>" value="<?php echo $redes["url"] ?>">
                                <p><?php echo $data['e' . ucfirst($redes["redes_socialescol"])] ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="submit" name="guardar" value="Guardar">
                </form>
            <?php } else {
                echo "<p>No tienes un portfolio creado</p>";
            }
            ?>
        </article>
    </main>
</body>

</html>