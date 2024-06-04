<?php
    // Si no hay un parámetro 'c' en la solicitud (generalmente en la URL), se carga el controlador predeterminado 'Landing'.
    if (!isset($_REQUEST['c'])) {
        // Se incluye el archivo del controlador 'Landing'.
        require_once "controllers/Landing.php";  
        // Se crea una instancia del controlador 'Landing'.
        $controller = new Landing;
        // Se llama al método 'main' del controlador 'Landing'.
        $controller->main();
    } else {           
        // Si existe un parámetro 'c' en la solicitud, se toma su valor y se asigna a la variable '$controller'.
        $controller = $_REQUEST['c'];
        // Se incluye el archivo del controlador correspondiente al valor de '$controller'.
        require_once "controllers/" . $controller . ".php";
        // Se crea una instancia del controlador solicitado.
        $controller = new $controller;  
        // Se verifica si hay un parámetro 'a' en la solicitud, que representa la acción o método a ejecutar. Si no, se usa 'main' por defecto.
        $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'main';
        // Se llama a la acción (método) en el controlador usando 'call_user_func'.
        call_user_func(array($controller, $action));
    }
?>


