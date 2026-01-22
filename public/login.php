<?php
require_once __DIR__ . '/../app/config/config.php';

// Si ya está logueado, redirigir al home
if (auth_check()) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (auth_attempt($email, $password)) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    } else {
        $error = "Credenciales incorrectas.";
    }
}

require_once __DIR__ . '/../app/views/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm mt-5">
            <div class="card-body p-4">
                <h2 class="h4 mb-4 text-center">Iniciar Sesión</h2>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../app/views/layouts/footer.php'; ?>
