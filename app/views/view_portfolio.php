<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="../styles/user.css">
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
                    echo "<li><a href='../logout'>Logout</a></li>";
                } else {
                    echo "<li><a href='../registro'>Registro</a></li>";
                    echo "<li><a href='../login'>Login</a></li>";
                }
                ?>

            </ul>
    </header>
    <main>
        <h1>Portfolio</h1>
        <article>
            <h2><?php echo $data['usuario'][0]['nombre'] . " " . $data['usuario'][0]['apellidos'] ?></h2>
            <p><?php echo $data["usuario"][0]["categoria_profesional"] ?></p>
            <img src="/imagenes/<?php echo $data['usuario'][0]['foto']; ?>" alt="Foto de perfil">
            <p><?php echo $data["usuario"][0]["email"] ?></p>
            <?php
            if($data['portfolioExists']) { ?>
                <div>
                    <h3>Trabajos</h3>
                    <?php
                    if (empty($data['trabajos'])) {
                        echo "<p>No tiene trabajos visibles</p>";
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
                        echo "<p>No tiene proyectos visibles</p>";
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
                        echo "<p>No tiene skills visibles</p>";
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
                    foreach ($data['redes_sociales'] as $redes) { ?>
                        <h4><?php echo $redes["redes_socialescol"] ?></h4>
                        <p><?php echo $redes["url"] ?></p>
                    <?php } ?>
                </div>
            <?php } else {
                echo "<p>No tiene portfolio creado</p>";
            }
            ?>
        </article>
    </main>
</body>

</html>