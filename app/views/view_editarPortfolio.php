<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Portfolio</title>
    <link rel="stylesheet" href="../styles/editarPortfolio.css">
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
        </nav>
    </header>
    <main>
        <h1>Editar Portfolio</h1>
        <form action="" method="post">
            <div>
                <h3>Trabajos</h3>
                <?php foreach ($data['trabajos'] as $trabajo): ?>
                    <div>
                        <label for="tituloTrabajos_<?php echo $trabajo['id']; ?>">Título</label>
                        <input type="text" id="tituloTrabajos_<?php echo $trabajo['id']; ?>" name="tituloTrabajos_<?php echo $trabajo['id']; ?>" value="<?php echo htmlspecialchars($trabajo['titulo']); ?>">
                    </div>
                    <div>
                        <label for="descripcionTrabajos_<?php echo $trabajo['id']; ?>">Descripción</label>
                        <input type="text" id="descripcionTrabajos_<?php echo $trabajo['id']; ?>" name="descripcionTrabajos_<?php echo $trabajo['id']; ?>" value="<?php echo htmlspecialchars($trabajo['descripcion']); ?>">
                    </div>
                    <div>
                        <label for="fecha_inicioTrabajos_<?php echo $trabajo['id']; ?>">Fecha de inicio</label>
                        <input type="date" id="fecha_inicioTrabajos_<?php echo $trabajo['id']; ?>" name="fecha_inicioTrabajos_<?php echo $trabajo['id']; ?>" value="<?php echo htmlspecialchars($trabajo['fecha_inicio']); ?>">

                    </div>
                    <div>
                        <label for="fecha_finTrabajos_<?php echo $trabajo['id']; ?>">Fecha de fin</label>
                        <input type="date" id="fecha_finTrabajos_<?php echo $trabajo['id']; ?>" name="fecha_finTrabajos_<?php echo $trabajo['id']; ?>" value="<?php echo htmlspecialchars($trabajo['fecha_final']); ?>">
                    </div>
                    <div>
                        <label for="logrosTrabajos_<?php echo $trabajo['id']; ?>">Logros</label>
                        <input type="text" id="logrosTrabajos_<?php echo $trabajo['id']; ?>" name="logrosTrabajos_<?php echo $trabajo['id']; ?>" value="<?php echo htmlspecialchars($trabajo['logros']); ?>">
                        <?php if ($trabajo['visible'] == 1): ?>
                            <a href="/ocultarTrabajo/<?php echo $trabajo['id']; ?>" class="boton-accion">Ocultar</a>
                        <?php else: ?>
                            <a href="/mostrarTrabajo/<?php echo $trabajo['id']; ?>" class="boton-accion">Mostrar</a>
                        <?php endif; ?>
                        <a href="/eliminarTrabajo/<?php echo $trabajo['id']; ?>" class="boton-accion-eliminar">Eliminar</a>
                    </div>
                <?php endforeach; ?>
                <a href="/addTrabajo/<?php echo $_SESSION['usuario']['id']; ?>" class="anadir">Añadir Trabajo</a>
            </div>
            <div>
                <h3>Proyectos</h3>
                <?php foreach ($data['proyectos'] as $proyecto): ?>
                    <div>
                        <label for="tituloProyectos_<?php echo $proyecto['id']; ?>">Título</label>
                        <input type="text" id="tituloProyectos_<?php echo $proyecto['id']; ?>" name="tituloProyectos_<?php echo $proyecto['id']; ?>" value="<?php echo htmlspecialchars($proyecto['titulo']); ?>">
                    </div>
                    <div>
                        <label for="descripcionProyectos_<?php echo $proyecto['id']; ?>">Descripción</label>
                        <input type="text" id="descripcionProyectos_<?php echo $proyecto['id']; ?>" name="descripcionProyectos_<?php echo $proyecto['id']; ?>" value="<?php echo htmlspecialchars($proyecto['descripcion']); ?>">
                    </div>
                    <div>
                        <label for="tecnologiasProyectos_<?php echo $proyecto['id']; ?>">Tecnologías</label>
                        <input type="text" id="tecnologiasProyectos_<?php echo $proyecto['id']; ?>" name="tecnologiasProyectos_<?php echo $proyecto['id']; ?>" value="<?php echo htmlspecialchars($proyecto['tecnologias']); ?>">
                        <?php if ($proyecto['visible'] == 1): ?>
                            <a href="/ocultarProyecto/<?php echo $proyecto['id']; ?>" class="boton-accion">Ocultar</a>
                        <?php else: ?>
                            <a href="/mostrarProyecto/<?php echo $proyecto['id']; ?>" class="boton-accion">Mostrar</a>
                        <?php endif; ?>
                        <a href="/eliminarProyecto/<?php echo $proyecto['id']; ?>" class="boton-accion-eliminar">Eliminar</a>
                    </div>
                <?php endforeach; ?>
                <a href="/addProyecto/<?php echo $_SESSION['usuario']['id']; ?>" class="anadir">Añadir Proyecto</a>
            </div>
            <div>
                <h3>Skills</h3>
                <?php foreach ($data['skills'] as $skill): ?>
                    <div>
                        <label for="habilidades_<?php echo $skill['id']; ?>">Habilidades</label>
                        <input type="text" id="habilidades_<?php echo $skill['id']; ?>" name="habilidades_<?php echo $skill['id']; ?>" value="<?php echo htmlspecialchars($skill['habilidades']); ?>">
                    </div>
                    <div>
                        <label for="categoria_<?php echo $skill['id']; ?>">Categoría</label>
                        <input type="text" id="categoria_<?php echo $skill['id']; ?>" name="categoria_<?php echo $skill['id']; ?>" value="<?php echo htmlspecialchars($skill['categorias_skills_categoria']); ?>">
                        <?php if ($skill['visible'] == 1): ?>
                            <a href="/ocultarSkill/<?php echo $skill['id']; ?>" class="boton-accion">Ocultar</a>
                        <?php else: ?>
                            <a href="/mostrarSkill/<?php echo $skill['id']; ?>" class="boton-accion">Mostrar</a>
                        <?php endif; ?>
                        <a href="/eliminarSkill/<?php echo $skill['id']; ?>" class="boton-accion-eliminar">Eliminar</a>
                    </div>
                <?php endforeach; ?>
                <a href="/addSkill/<?php echo $_SESSION['usuario']['id']; ?>" class="anadir">Añadir Skills</a>
            </div>
            <div>
                <h3>Redes Sociales</h3>
                <?php foreach ($data['redesSociales'] as $redes): ?>
                    <div>
                        <h4><?php echo htmlspecialchars($redes['redes_socialescol']); ?></h4>
                        <input type="text" name="redes_<?php echo $redes['id']; ?>" value="<?php echo htmlspecialchars($redes['url']); ?>">
                        <a href="/eliminarRedSocial/<?php echo $redes['id']; ?>" class="boton-accion-eliminar">Eliminar</a>
                    </div>
                <?php endforeach; ?>
                <a href="/addRedSocial/<?php echo $_SESSION['usuario']['id']; ?>" class="anadir">Añadir Redes Sociales</a>
            </div>
            <p><?php echo $data['error'] ?></p>
            <input type="submit" name="guardar" value="Guardar">
        </form>
    </main>
</body>

</html>