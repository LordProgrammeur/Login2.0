<?php
require_once 'models/User.php'; // Asegúrate de incluir la clase User
use PHPMailer\PHPMailer;
use PHPMailer\Exception;
use PHPMailer\SMTP;

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

            $user = new User();
            $resultado = $user->crearUsuario($email, $password);

            if ($resultado === true) {
                // Enviar correo de confirmación
                $mail = new PHPMailer\PHPMailer(true);
                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.example.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'your_email@example.com';
                    $mail->Password = 'your_email_password';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Configuración del correo
                    $mail->setFrom('your_email@example.com', 'Your Name');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Registro exitoso';
                    $mail->Body = 'Hola,<br><br>Te has registrado exitosamente en nuestro sitio.';

                    $mail->send();
                    $mensaje = "Usuario creado exitosamente y correo enviado.";
                } catch (PHPMailer\Exception $e) {
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





