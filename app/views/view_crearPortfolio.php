
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
        <h1><?php echo $_SESSION["usuario"]["nombre"] . " " . $_SESSION["usuario"]["apellidos"] ?></h1>
        <h2>Añadir Portfolio</h2>
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

        <form action="" method="post">
            <div>
                <h3>Trabajos</h3>
                <label for="tituloTrabajos">Titulo</label>
                <input type="text" name="tituloTrabajos" id="tituloTrabajos" value="<?php echo $data['tituloTrabajos']; ?>">
                <p><?php echo $data['eTituloTrabajos']; ?></p>

                <label for="descripcionTrabajos">Descripción</label>
                <textarea name="descripcionTrabajos" id="descripcionTrabajos" cols="30" rows="10"><?php echo $data['descripcionTrabajos']; ?></textarea>
                <p><?php echo $data['eDescripcionTrabajos']; ?></p>

                <label for="fecha_inicioTrabajos">Fecha Incio</label>
                <input type="date" name="fecha_inicioTrabajos" id="fecha_inicioTrabajos" value="<?php echo $data['fecha_inicioTrabajos']; ?>">
                <p><?php echo $data['eFecha_inicioTrabajos']; ?></p>

                <label for="fecha_finTrabajos">Fecha Fin</label>
                <input type="date" name="fecha_finTrabajos" id="fecha_finTrabajos" value="<?php echo $data['fecha_finTrabajos']; ?>">
                <p><?php echo $data['eFecha_finTrabajos']; ?></p>

                <label for="logrosTrabajos">logros</label>
                <input type="text" name="logrosTrabajos" id="logrosTrabajos" value="<?php echo $data['logrosTrabajos']; ?>">
                <p><?php echo $data['eLogrosTrabajos']; ?></p>
            </div>
            <div>
                <h3>Proyecto</h3>
                <label for="tituloProyectos">Titulo</label>
                <input type="text" name="tituloProyectos" id="tituloProyectos" value="<?php echo $data['tituloProyectos']; ?>">
                <p><?php echo $data['eTituloProyectos']; ?></p>

                <label for="descripcionProyectos">Descripción</label>
                <textarea name="descripcionProyectos" id="descripcionProyectos" cols="30" rows="10"><?php echo $data['descripcionProyectos']; ?></textarea>
                <p><?php echo $data['eDescripcionProyectos']; ?></p>

                <label for="tecnologiasProyectos">tecnologias</label>
                <input type="text" name="tecnologiasProyectos" id="tecnologiasProyectos" value="<?php echo $data['tecnologiasProyectos']; ?>">
                <p><?php echo $data['eTecnologiasProyectos']; ?></p>
            </div>
            <div>
                <h3>Skills</h3>
                <label for="habilidades">Habilidades</label>
                <input type="text" name="habilidades" id="habilidades" value="<?php echo $data['habilidades']; ?>">
                <p><?php echo $data['eHabilidades']; ?></p>

                <label for="categoria">categoria</label>
                <input type="text" name="categoria" id="categoria" value="<?php echo $data['categoria']; ?>">
                <p><?php echo $data['eCategoria']; ?></p>
            </div>
            <div>
                <h3>Redes sociales</h3>
                <label for="facebook">Facebook</label>
                <input type="url" name="facebook" id="facebook" value="<?php echo $data['facebook']; ?>">
                <p><?php echo $data['eFacebook']; ?></p>

                <label for="twitter">Twitter</label>
                <input type="url" name="twitter" id="twitter" value="<?php echo $data['twitter']; ?>">
                <p><?php echo $data['eTwitter']; ?></p>

                <label for="linkedin">Linkedin</label>
                <input type="url" name="linkedin" id="linkedin" value="<?php echo $data['linkedin']; ?>">
                <p><?php echo $data['eLinkedin']; ?></p>

                <label for="github">Github</label>
                <input type="url" name="github" id="github" value="<?php echo $data['github']; ?>">
                <p><?php echo $data['eGithub']; ?></p>

                <label for="instagram">Instagram</label>
                <input type="url" name="instagram" id="instagram" value="<?php echo $data['instagram']; ?>">
                <p><?php echo $data['eInstagram']; ?></p>
            </div>

            <input type="submit" value="Guardar" name="guardar">
        </form>
    </main>
</body>

</html>