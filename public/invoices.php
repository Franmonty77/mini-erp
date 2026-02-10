<?php
require_once __DIR__ . '/../app/config/config.php';
auth_require();

$action = $_GET['action'] ?? 'index';
$pdo = db();

// Handle CREATE
if ($action === 'create') {
    // Need partners for the select dropdown
    $stmt = $pdo->query("SELECT id, name, type FROM partners ORDER BY name ASC");
    $partners = $stmt->fetchAll();

    $view = 'invoices/create';
    require_once __DIR__ . '/../app/views/layouts/header.php';
    require_once __DIR__ . '/../app/views/' . $view . '.php';
    require_once __DIR__ . '/../app/views/layouts/footer.php';
    exit;
}

// Handle STORE
if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $partner_id = $_POST['partner_id'];
    $type = $_POST['type'];
    $number = $_POST['number'];
    $amount = $_POST['amount'];
    $issue_date = $_POST['issue_date'];
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO invoices (partner_id, type, number, amount, issue_date, due_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$partner_id, $type, $number, $amount, $issue_date, $due_date, $status]);

    header('Location: ' . BASE_URL . '/invoices.php');
    exit;
}

// Handle EDIT
if ($action === 'edit') {
    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("SELECT * FROM invoices WHERE id = ?");
    $stmt->execute([$id]);
    $invoice = $stmt->fetch();

    if (!$invoice) {
        die("Invoice not found");
    }

    // Need partners for the select dropdown
    $stmt = $pdo->query("SELECT id, name, type FROM partners ORDER BY name ASC");
    $partners = $stmt->fetchAll();

    $view = 'invoices/edit';
    require_once __DIR__ . '/../app/views/layouts/header.php';
    require_once __DIR__ . '/../app/views/' . $view . '.php';
    require_once __DIR__ . '/../app/views/layouts/footer.php';
    exit;
}

// Handle UPDATE
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $partner_id = $_POST['partner_id'];
    $type = $_POST['type'];
    $number = $_POST['number'];
    $amount = $_POST['amount'];
    $issue_date = $_POST['issue_date'];
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE invoices SET partner_id = ?, type = ?, number = ?, amount = ?, issue_date = ?, due_date = ?, status = ? WHERE id = ?");
    $stmt->execute([$partner_id, $type, $number, $amount, $issue_date, $due_date, $status, $id]);

    header('Location: ' . BASE_URL . '/invoices.php');
    exit;
}

// Handle DELETE
if ($action === 'delete') {
    $id = $_POST['id'] ?? 0;
    $stmt = $pdo->prepare("DELETE FROM invoices WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: ' . BASE_URL . '/invoices.php');
    exit;
}

// Handle INDEX (List & Search)
// Handle INDEX (List & Search) & EXPORT
$type = $_GET['type'] ?? '';
$search = $_GET['search'] ?? '';
$partner_id = $_GET['partner_id'] ?? '';
$status = $_GET['status'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';
$format = $_GET['format'] ?? '';

$sql = "SELECT invoices.*, partners.name as partner_name 
        FROM invoices 
        LEFT JOIN partners ON invoices.partner_id = partners.id 
        WHERE 1=1";
$params = [];

if ($type) {
    $sql .= " AND invoices.type = ?";
    $params[] = $type;
}

if ($partner_id) {
    $sql .= " AND invoices.partner_id = ?";
    $params[] = $partner_id;
}

if ($status) {
    $sql .= " AND invoices.status = ?";
    $params[] = $status;
}

if ($date_from) {
    $sql .= " AND invoices.issue_date >= ?";
    $params[] = $date_from;
}

if ($date_to) {
    $sql .= " AND invoices.issue_date <= ?";
    $params[] = $date_to;
}

if ($search) {
    $sql .= " AND (invoices.number LIKE ? OR partners.name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$sql .= " ORDER BY invoices.issue_date DESC, invoices.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$invoices = $stmt->fetchAll();

// Handle Export
if ($action === 'export') {
    if ($format === 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="facturas_' . date('Y-m-d') . '.csv"');
        
        $output = fopen('php://output', 'w');
        // Add BOM for Excel compatibility
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, ['Fecha', 'Número', 'Tipo', 'Cliente/Proveedor', 'Estado', 'Vencimiento', 'Importe'], ';');
        
        foreach ($invoices as $inv) {
            fputcsv($output, [
                $inv['issue_date'],
                $inv['number'],
                $inv['type'] === 'issued' ? 'Emitida' : 'Recibida',
                $inv['partner_name'],
                $inv['status'] === 'paid' ? 'Pagada' : 'Pendiente',
                $inv['due_date'],
                number_format((float)$inv['amount'], 2, ',', '.')
            ], ';');
        }
        fclose($output);
        exit;
    } elseif ($format === 'pdf') {
        $view = 'invoices/pdf_list';
        require_once __DIR__ . '/../app/views/' . $view . '.php';
        exit;
    }
}

// Get partners for filter
$stmt = $pdo->query("SELECT id, name FROM partners ORDER BY name ASC");
$partners = $stmt->fetchAll();

$view = 'invoices/index';
require_once __DIR__ . '/../app/views/layouts/header.php';
require_once __DIR__ . '/../app/views/' . $view . '.php';
require_once __DIR__ . '/../app/views/layouts/footer.php';
