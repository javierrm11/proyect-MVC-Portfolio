<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: 0 auto;
        }

        label {
            margin-top: 10px;
        }

        input {
            margin-top: 5px;
            padding: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            background-color: green;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . "/view_header.php"; ?>
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