<?php
require_once __DIR__ . '/../app/config/config.php';

auth_logout();

header('Location: ' . BASE_URL . '/login.php');
exit;
