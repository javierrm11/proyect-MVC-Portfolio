<html>

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
        }

        header {
            display: flex;
            color: white;
            background-color: blue;
        }

        header div {
            flex: 2;
            align-content: center;
            text-align: center;
        }

        header div a {
            text-decoration: none;
            color: white;
        }

        header nav {
            flex: 4;
        }

        header nav ul {
            display: flex;
            justify-content: space-around;
            list-style: none;
            padding: 0;
        }

        header nav ul li a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

</html>
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

</html>