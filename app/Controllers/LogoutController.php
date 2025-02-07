<?php
// Se desloguea al usuario
session_start();
session_unset();
session_destroy();
header("Location: /public"); // Redirige a la página principal
exit;
