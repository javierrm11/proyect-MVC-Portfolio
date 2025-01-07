<?php
// Incluir los archivos necesarios
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/DBAbstractModel.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #invitado {
            padding: 3%;
        }

        #invitado h1 {
            text-align: center;
        }

        #invitado>p {
            text-align: center;
        }

        #invitado>section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 4%;
        }

        #invitado>section>article {
            margin: 2%;
            padding: 2%;
            border: 2px solid blue;
            border-radius: 3%;
        }

        section>article p {
            color: rgb(12, 12, 12);
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/view_header.php'; ?>
    <main id="invitado">
        <h1>Página de inicio</h1>
        <p>Estás como invitado</p>
        <section>
            <?php
            foreach ($data['usuarios'] as $usuario) {
                echo "<article>";
                echo "<h2>" . $usuario['nombre'] . "</h2>";
                echo "<p>" . $usuario['email'] . "</p>";
                echo "</article>";
            }
            ?>
        </section>
    </main>
</body>

</html>