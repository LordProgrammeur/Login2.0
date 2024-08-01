<?php
require_once "models/database.php"; // Incluir configuración de la base de datos
require_once "models/User.php"; // Incluir el modelo User
require 'vendor/autoload.php'; // Incluir composer

require_once "controllers/Users.php"; // Incluir el controlador Users

// Verificar el controlador y la acción solicitada
if (!isset($_REQUEST['controller'])) {
    // Si no se especifica un controlador, cargar el controlador de Landing o el que desees
    require_once "controllers/Landing.php";
    $controller = new Landing();
    $controller->main();
} else {
    // Si se especifica un controlador
    $controllerName = $_REQUEST['controller'];

    // Incluir el archivo del controlador
    require_once "controllers/Users.php";

    // Crear una instancia del controlador
    $controller = new Users(); // Cambia esto a la clase adecuada si no es Users

    // Determinar la acción a realizar
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'mostrarFormularioRegistro'; // Cambia esto a la acción adecuada

    // Llamar a la acción del controlador
    call_user_func(array($controller, $action));
}
?>

