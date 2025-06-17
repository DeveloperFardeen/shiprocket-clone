<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define constants
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://localhost/shiprocket-clone');

// Autoloader
spl_autoload_register(function ($class) {
    $directories = ['models', 'controllers'];
    foreach ($directories as $dir) {
        $file = BASE_PATH . '/' . $dir . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Simple Router
$request = $_GET['route'] ?? 'dashboard/index';
$parts = explode('/', $request);
$controllerName = ucfirst($parts[0]) . 'Controller';
$action = $parts[1] ?? 'index';

try {
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            echo $controller->$action();
        } else {
            throw new Exception("Action not found");
        }
    } else {
        throw new Exception("Controller not found");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>