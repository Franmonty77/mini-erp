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

    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <?php if ($error): ?>
            <div class="rounded-md bg-red-50 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ph ph-warning-circle text-red-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Error de acceso</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p><?= htmlspecialchars($error) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <form class="space-y-6" action="" method="POST">
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Correo Electrónico</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-slate-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
                    Ingresar
                </button>
            </div>
        </form>
    </div>

<?php require_once __DIR__ . '/../app/views/layouts/footer.php'; ?>
