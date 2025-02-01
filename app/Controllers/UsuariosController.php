<?php

namespace App\Controllers;
// Iniciar la sesión
session_start();
// Importar las clases necesarias
use App\Models\Usuario;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Portfolio;
// Importar las clases necesarias
require_once 'BaseController.php';
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class UsuariosController extends BaseController
{
    public function IndexAction()
    {
        // Creamos una instancia de Usuario
        $usuario = Usuario::getInstancia();

        // Almacenamos los datos en $data
        $data['usuarios'] = $usuario->getAllVisible();

        // Llamamos a la función renderHTML
        $this->renderHTML('../app/views/index_view.php', $data);
    }

    public function AddAction()
    {  
        // Si hay sesión iniciada, redirigir a inicio
        if(isset($_SESSION['usuario'])){
            header('Location: ./');
        }
        // Variables para los campos del formulario
        $data = [
            'nombre' => '',
            'apellidos' => '',
            'foto' => 'predeterminado.png',
            'categoria_profesional' => '',
            'email' => '',
            'resumen_perfil' => '',
            'password' => '',
            'eNombre' => '',
            'eApellidos' => '',
            'eFoto' => '',
            'eCategoria_profesional' => '',
            'eEmail' => '',
            'eResumen_perfil' => '',
            'ePassword' => ''
        ];

        // Si se ha pulsado el botón de registrarse
        if (isset($_POST['registrate'])) {
            $data['nombre'] = $_POST['nombre'];
            $data['apellidos'] = $_POST['apellidos'];
            $data['categoria_profesional'] = $_POST['categoria_profesional'];
            $data['email'] = $_POST['email'];
            $data['resumen_perfil'] = $_POST['resumen_perfil'];
            $data['password'] = $_POST['password'];

            // Validar los campos del formulario
            $lProcesaFormulario = true;
            if (empty($data['nombre'])) {
                $data['eNombre'] = 'El nombre es obligatorio';
                $lProcesaFormulario = false;
            }
            if (empty($data['apellidos'])) {
                $data['eApellidos'] = 'Los apellidos son obligatorios';
                $lProcesaFormulario = false;
            }
            if (empty($data['categoria_profesional'])) {
                $data['eCategoria_profesional'] = 'La categoria profesional es obligatoria';
                $lProcesaFormulario = false;
            }
            if (empty($data['email'])) {
                $data['eEmail'] = 'El email es obligatorio';
                $lProcesaFormulario = false;
            }
            if (empty($data['resumen_perfil'])) {
                $data['eResumen_perfil'] = 'El resumen del perfil es obligatorio';
                $lProcesaFormulario = false;
            }
            if (empty($data['password'])) {
                $data['ePassword'] = 'La contraseña es obligatoria';
                $lProcesaFormulario = false;
            }

            // Subir la imagen
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $foto = $_FILES['foto'];
                $imagenesDir = __DIR__ . '/../../public/imagenes/';
                if (!is_dir($imagenesDir)) {
                    mkdir($imagenesDir, 0777, true);
                }
                $fotoRuta = $imagenesDir . $foto['name'];

                // Mover la imagen a la carpeta 'imagenes'
                if (move_uploaded_file($foto['tmp_name'], $fotoRuta)) {
                    $data['foto'] = $foto['name'];
                } else {
                    $data['eFoto'] = 'Error al subir la imagen';
                    $lProcesaFormulario = false;
                }
            }

            // Si no hay errores, se crea el usuario
            if ($lProcesaFormulario) {
                $usuario = Usuario::getInstancia();
                $usuario->setNombre($data['nombre']);
                $usuario->setApellidos($data['apellidos']);
                $usuario->setFoto($data['foto']);
                $usuario->setCategoriaProfesional($data['categoria_profesional']);
                $usuario->setEmail($data['email']);
                $usuario->setResumenPerfil($data['resumen_perfil']);
                $usuario->setVisible(1);
                $usuario->setPassword($data['password']);
                $usuario->setCreatedAt(date('Y-m-d H:i:s'));
                $usuario->setUpdatedAt(date('Y-m-d H:i:s'));

                // Generar token
                $rb = random_bytes(32);
                $token = base64_encode($rb);
                $secureToken = uniqid('', true) . $token;
                $usuario->setToken($secureToken);
                $usuario->setFechaCreacionToken(date('Y-m-d H:i:s'));

                // Cuenta activa false
                $usuario->setCuentaActiva(0);

                // Guardar usuario
                $usuario->set();
                $data['portfolioExists'] = false;

                // Enviar correo de activación
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = $_ENV["CORREO"]; // Cambia esto por tu correo SMTP
                    $mail->Password = $_ENV["PASS"]; // Cambia esto por tu contraseña SMTP
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Remitente y destinatario
                    $mail->setFrom('javierrumo2@gmail.com', 'Javier');
                    $mail->addAddress($data['email'], $data['nombre']);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Activación de cuenta';
                    $mail->Body = "Hola {$data['nombre']},<br><br>Gracias por registrarte. Por favor, haz clic en el siguiente enlace para activar tu cuenta:<br><br><a href='http://www.proyectnavidad.local/index.php?controller=Usuarios&action=activarAction&token=$secureToken'>Activar cuenta</a><br><br>Este enlace es válido por 24 horas.";
                    $mail->send();
                    echo 'El mensaje ha sido enviado';
                } catch (Exception $e) {
                    echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
                }
                $mensaje = "Verifica su correo electronico para verificar su cuenta";
                $_SESSION['mensaje'] = $mensaje;
                // Redirigir a la página de login
                header('Location: ./login');
            }
        }

        // Llamamos a la función renderHTML
        $this->renderHTML('../app/views/view_registro.php', $data);
    }

    public function LoginAction()
    {
        // Si hay sesión iniciada, redirigir a inicio
        if(isset($_SESSION['usuario'])){
            header('Location: ./');
        }
        $email = $password = '';
        $eEmail = $ePassword = $eCredenciales = '';
        $error = false;

        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email)) {
                $eEmail = 'El email es obligatorio';
                $error = true;
            }
            if (empty($password)) {
                $ePassword = 'La contraseña es obligatoria';
                $error = true;
            }
            if (!$error) {
                $usuarios = Usuario::getInstancia();
                $usuarios = $usuarios->getAll();
                foreach ($usuarios as $usuario) {
                    // Comprobar si el email y la contraseña son correctos
                    if ($usuario['email'] === $email && $usuario['password'] === $password) {
                        $_SESSION['usuario'] = $usuario;
                        header("Location: ./");
                        exit;
                    } else {
                        $eCredenciales = 'Las credenciales no son correctas';
                    }
                }
            }
        }

        $data = [
            'email' => $email,
            'password' => $password,
            'eEmail' => $eEmail,
            'ePassword' => $ePassword,
            'eCredenciales' => $eCredenciales
        ];

        $this->renderHTML('../app/views/view_login.php', $data);
    }
    public function activarAction()
    {
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $token = str_replace(" ", "+", $token);

            $usuario = Usuario::getInstancia();
            $user = $usuario->getT($token);
            if ($user) {
                $fecha_creacion_token = new \DateTime($user[0]['fecha_creacion_token']);
                $fecha_actual = new \DateTime();
                $intervalo = $fecha_creacion_token->diff($fecha_actual);
                var_dump($fecha_creacion_token);
                if ($intervalo->h < 24) {
                    $usuario->setId($user[0]['id']);
                    $usuario->editCuentaActiva();
                    $mensaje = "Cuenta activada con éxito.";
                    $_SESSION['mensaje'] = $mensaje;
                    header('Location: ./login');
                } else {
                    $mensaje = "El token ha expirado.";
                }
            } else {
                $mensaje = "Token no válido.";
            }
        } else {
            $mensaje = "Token no proporcionado.";
        }
    }
    public function buscarAction()
    {
        if(isset($_POST['buscar'])){
            $buscar =  $_POST['buscar'] ?? "";
            $usuario = Usuario::getInstancia();
            $resultados = $usuario->buscar(strtolower($buscar));
            $this->renderHTML('../app/views/index_view.php', ['usuarios' => $resultados, 'buscar' => $buscar]);
        } else {
            header('Location: ./');
        }
    }
    public function ocultarUsuarioAction(){
        if(!isset($_SESSION['usuario'])){
            header('Location: ./');
        }
        $usuario = Usuario::getInstancia();
        $usuario->setId($_SESSION['usuario']['id']);
        $usuario->ocultarUsuario();
        $_SESSION['usuario']['visible'] = 0;
        header('Location: ./user');
    }
    public function mostrarUsuarioAction(){
        if(!isset($_SESSION['usuario'])){
            header('Location: ./');
        }
        $usuario = Usuario::getInstancia();
        $usuario->setId($_SESSION['usuario']['id']);
        $usuario->mostrarUsuario();
        $_SESSION['usuario']['visible'] = 1;
        header('Location: ./user');
    }
    public function LogoutAction()
    {
        session_destroy();
        header('Location: ./');
    }
    public function BorrarUsuarioAction()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ./');
        }
        if($portfolios = Portfolio::getInstancia()->getPortfolioUser($_SESSION['usuario']['id'])){
            foreach ($portfolios as $portfolio) {
                $portfolio = Portfolio::getInstancia();
                $portfolio->deletePortfolio($_SESSION['usuario']['id']);
            }
        }
        $usuario = Usuario::getInstancia();
        $usuario->setId($_SESSION['usuario']['id']);
        $usuario->delete();
        session_destroy();
        header('Location: ./');
    }
}
