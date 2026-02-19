<?php
require_once __DIR__ . '/../app/config/config.php';

auth_require();

$pdo = db();

// Calcular KPIs
// 1. Facturas Pendientes (Total y Cantidad)
$stmt = $pdo->prepare("SELECT COUNT(*) as count, SUM(amount) as total FROM invoices WHERE status = 'pending'");
$stmt->execute();
$pending = $stmt->fetch();

// 2. Facturas Pagadas (Total y Cantidad)
$stmt = $pdo->prepare("SELECT COUNT(*) as count, SUM(amount) as total FROM invoices WHERE status = 'paid'");
$stmt->execute();
$paid = $stmt->fetch();

// 3. Facturas Vencidas (Total y Cantidad) - Son pendientes con fecha de vencimiento menor a hoy
$stmt = $pdo->prepare("SELECT COUNT(*) as count, SUM(amount) as total FROM invoices WHERE status = 'pending' AND due_date < CURDATE()");
$stmt->execute();
$overdue = $stmt->fetch();

require_once __DIR__ . '/../app/views/layouts/header.php';
?>

<div class="mb-8">
    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Panel de Control</h1>
    <p class="mt-2 text-sm text-gray-500">Resumen general del estado de tus facturas.</p>
</div>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Facturas Pendientes -->
    <div class="bg-white overflow-hidden rounded-lg shadow">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="ph ph-clock text-yellow-400 text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Pendientes (<?= $pending['count'] ?>)</dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900"><?= number_format((float)($pending['total'] ?? 0), 2, ',', '.') ?> €</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="<?= BASE_URL ?>/invoices.php?status=pending" class="font-medium text-yellow-700 hover:text-yellow-900">Ver todas</a>
            </div>
        </div>
    </div>

    <!-- Facturas Pagadas -->
    <div class="bg-white overflow-hidden rounded-lg shadow">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="ph ph-check-circle text-green-400 text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Pagadas (<?= $paid['count'] ?>)</dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900"><?= number_format((float)($paid['total'] ?? 0), 2, ',', '.') ?> €</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="<?= BASE_URL ?>/invoices.php?status=paid" class="font-medium text-green-700 hover:text-green-900">Ver todas</a>
            </div>
        </div>
    </div>

    <!-- Facturas Vencidas -->
    <div class="bg-white overflow-hidden rounded-lg shadow">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="ph ph-warning-circle text-red-400 text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Vencidas (<?= $overdue['count'] ?>)</dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900"><?= number_format((float)($overdue['total'] ?? 0), 2, ',', '.') ?> €</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="<?= BASE_URL ?>/invoices.php?status=pending" class="font-medium text-red-700 hover:text-red-900">Gestionar urgentes</a>
            </div>
        </div>
    </div>
</div>

<!-- Accesos Rápidos -->
<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Acciones Rápidas</h3>
            <div class="mt-5 sm:flex sm:items-center sm:gap-4">
                <div class="w-full sm:max-w-xs">
                    <a href="<?= BASE_URL ?>/invoices.php?action=create" class="inline-flex items-center justify-center w-full rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
                        <i class="ph ph-plus mr-2 text-lg"></i> Nueva Factura
                    </a>
                </div>
                <div class="mt-3 w-full sm:mt-0 sm:max-w-xs">
                     <a href="<?= BASE_URL ?>/partners.php" class="inline-flex items-center justify-center w-full rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <i class="ph ph-users mr-2 text-lg"></i> Gestionar Clientes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../app/views/layouts/footer.php'; ?>
