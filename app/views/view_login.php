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
    <link rel="stylesheet" href="../styles/login.css">
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
    <h1>Iniciar Sesión</h1>
    <p><?php echo $_SESSION['mensaje'] ??  "" ?></p>
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