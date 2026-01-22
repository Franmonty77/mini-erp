<?php
declare(strict_types=1);

session_start();

define('APP_NAME', 'Mini ERP');
define('BASE_URL', '/mini-erp/public'); // Ajusta si tu carpeta se llama distinto

// Mostrar errores en local (desactívalo en producción)
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../helpers/auth.php';

