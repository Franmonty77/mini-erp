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

<div class="mb-4">
    <h1 class="h3 mb-3">Panel de Control</h1>
    <p class="text-muted">Resumen del estado de tus facturas.</p>
</div>

<div class="row">
    <!-- Facturas Pendientes -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 border-primary border-3 border-start border-0 border-top-0 border-end-0">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pendientes (<?= $pending['count'] ?>)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format((float)($pending['total'] ?? 0), 2, ',', '.') ?> €
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facturas Pagadas -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2 border-success border-3 border-start border-0 border-top-0 border-end-0">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pagadas (<?= $paid['count'] ?>)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format((float)($paid['total'] ?? 0), 2, ',', '.') ?> €
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facturas Vencidas -->
    <div class="col-md-4 mb-4">
        <div class="card border-left-danger shadow h-100 py-2 border-danger border-3 border-start border-0 border-top-0 border-end-0">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Vencidas (<?= $overdue['count'] ?>)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format((float)($overdue['total'] ?? 0), 2, ',', '.') ?> €
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Accesos Rápidos (Opcional) -->
<div class="row mt-4">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-secondary">Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <a href="<?= BASE_URL ?>/invoices.php?action=create" class="btn btn-primary mb-2">
                    Nueva Factura
                </a>
                <a href="<?= BASE_URL ?>/partners.php" class="btn btn-outline-secondary mb-2">
                    Gestionar Clientes/Proveedores
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../app/views/layouts/footer.php'; ?>
