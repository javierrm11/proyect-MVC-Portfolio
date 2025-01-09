<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/registro.css">
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
    <h1>Registrate</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $data['nombre'] ?>">
        <p><?php echo $data['eNombre'] ?></p>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="<?php echo $data['apellidos'] ?>">
        <p><?php echo $data['eApellidos'] ?></p>

        <label for="foto">Foto de Perfil</label>
        <input type="file" name="foto" id="foto">
        <p><?php echo $data['eFoto'] ?></p>

        <label for="categoria_profesional">Categoria Principal</label>
        <input type="text" name="categoria_profesional" id="categoria_profesional" value="<?php echo $data['categoria_profesional'] ?>">
        <p><?php echo $data["eCategoria_profesional"] ?></p>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $data['email'] ?>">
        <p><?php echo $data["eEmail"] ?></p>

        <label for="resumen_perfil">Resumen Perfil</label>
        <input type="text" name="resumen_perfil" id="resumen_perfil" value="<?php echo $data['resumen_perfil'] ?>">
        <p><?php echo $data["eResumen_perfil"] ?></p>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" value="<?php echo $data['password'] ?>">
        <p><?php echo $data["ePassword"] ?></p>

        <input type="submit" value="Registrarse" name="registrate" id="registrate">
    </form>
</body>

</html>