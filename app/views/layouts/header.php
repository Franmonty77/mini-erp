<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= APP_NAME ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>/index.php"><?= APP_NAME ?></a>
      <?php if (auth_check()): ?>
          <span class="navbar-text text-white me-3">Hola, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?></span>
          <a class="btn btn-outline-light btn-sm" href="<?= BASE_URL ?>/logout.php">Cerrar Sesión</a>
      <?php else: ?>
          <a class="btn btn-outline-light btn-sm" href="<?= BASE_URL ?>/login.php">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<main class="container py-4">
