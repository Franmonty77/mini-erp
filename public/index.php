<?php
require_once __DIR__ . '/../app/config/config.php';

auth_require();

require_once __DIR__ . '/../app/views/layouts/header.php';
?>

<div class="p-4 bg-white rounded shadow-sm">
  <h1 class="h4 mb-2">Bienvenido al Mini ERP</h1>
  <p class="mb-0 text-muted">
    Has iniciado sesión correctamente.
  </p>
</div>

<?php require_once __DIR__ . '/../app/views/layouts/footer.php'; ?>
