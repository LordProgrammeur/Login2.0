<?php
require_once 'models/User.php'; // Asegúrate de incluir la clase User
require 'vendor/autoload.php'; // Asegúrate de incluir el autoload de Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Users {
    public function mostrarFormularioRegistro() {
        require 'views/registro.view.php';
    }

    public function mostrarFormularioLogin() {
        require 'views/login.view.php';
    }

    public function procesarRegistro() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm-password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mensaje = "El correo electrónico no es válido.";
                require 'views/resultado.php';
                return;
            }

            if ($password !== $confirm_password) {
                $mensaje = "Las contraseñas no coinciden.";
                require 'views/resultado.php';
                return;
            }

            // Comprobación de la contraseña
            if (!preg_match('/^(?=.*[A-Z])(?=.*\W).{8,}$/', $password)) {
                $mensaje = "La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un signo especial.";
                require 'views/resultado.php';
                return;
            }

            $user = new User();
            $resultado = $user->crearUsuario($email, $password);

            if ($resultado === true) {
                // Enviar correo de confirmación
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor SMTP
                    $mail->SMTPDebug = 2; // Mostrar información de depuración detallada
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                    $mail->SMTPAuth = true;
                    $mail->Username = 'petstylobog@gmail.com'; // Tu correo de Gmail
                    $mail->Password = 'kube xkah hjrr qsse'; // Tu contraseña de aplicación de Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                     // Desactivar la depuración de SMTP
                     $mail->SMTPDebug = 0;

                    // Configuración del correo
                    $mail->setFrom('petstylobog@gmail.com', 'Pet Stylo');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Registro exitoso';
                    $mail->Body = 'Hola,<br><br>Te has registrado exitosamente en nuestro sitio.';

                    $mail->send();
                    $mensaje = "Usuario creado exitosamente y correo enviado.";
                } catch (Exception $e) {
                    $mensaje = 'Usuario creado, pero no se pudo enviar el correo. Error: ' . $mail->ErrorInfo;
                }
            } else {
                $mensaje = "Error al crear el registro.";
            }

            require 'views/resultado.php'; // Mostrar el mensaje
        }
    }

    public function procesarFormularioLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $resultado = $user->verificarUsuario($email, $password);

            if ($resultado) {
                session_start();
                $_SESSION['email'] = $email;
                require 'views/bienvenida.php';
            } else {
                $mensaje = "Email o contraseña incorrectos.";
                require 'views/resultado.php';
            }
        }
    }

    public function mostrarLogin() {
        $this->mostrarFormularioLogin();
    }

    public function cerrarSesion() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=Users&action=mostrarLogin&message=logout_success");
        exit();
    }
}


?>





