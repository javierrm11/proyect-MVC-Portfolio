<?php
require_once __DIR__ . '/../../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . "/view_header.php"; ?>
    <h1>Iniciar Sesión</h1>
    <form action="" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $data['email']; ?>">
        <p><?php echo $data['eEmail']; ?></p>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>">
        <p><?php echo $data['ePassword']; ?></p>

        <input type="submit" value="Iniciar sesión" name="login" id="login">
        <p><?php echo $data['eCredenciales']; ?></p>
    </form>
</body>
</html>