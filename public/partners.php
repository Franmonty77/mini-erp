<?php
require_once __DIR__ . '/../app/config/config.php';
auth_require();

$action = $_GET['action'] ?? 'index';
$pdo = db();

// Handle CREATE
if ($action === 'create') {
    $view = 'partners/create';
    require_once __DIR__ . '/../app/views/layouts/header.php';
    require_once __DIR__ . '/../app/views/' . $view . '.php';
    require_once __DIR__ . '/../app/views/layouts/footer.php';
    exit;
}

// Handle STORE
if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("INSERT INTO partners (type, name, email, phone, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$type, $name, $email, $phone, $address]);

    header('Location: ' . BASE_URL . '/partners.php');
    exit;
}

// Handle EDIT
if ($action === 'edit') {
    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("SELECT * FROM partners WHERE id = ?");
    $stmt->execute([$id]);
    $partner = $stmt->fetch();

    if (!$partner) {
        die("Partner not found");
    }

    $view = 'partners/edit';
    require_once __DIR__ . '/../app/views/layouts/header.php';
    require_once __DIR__ . '/../app/views/' . $view . '.php';
    require_once __DIR__ . '/../app/views/layouts/footer.php';
    exit;
}

// Handle UPDATE
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("UPDATE partners SET type = ?, name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->execute([$type, $name, $email, $phone, $address, $id]);

    header('Location: ' . BASE_URL . '/partners.php');
    exit;
}

// Handle DELETE
if ($action === 'delete') {
    $id = $_POST['id'] ?? 0;
    $stmt = $pdo->prepare("DELETE FROM partners WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: ' . BASE_URL . '/partners.php');
    exit;
}

// Handle INDEX (List & Search)
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM partners";
$params = [];

if ($search) {
    $sql .= " WHERE name LIKE ? OR email LIKE ?";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$partners = $stmt->fetchAll();

$view = 'partners/index';
require_once __DIR__ . '/../app/views/layouts/header.php';
require_once __DIR__ . '/../app/views/' . $view . '.php';
require_once __DIR__ . '/../app/views/layouts/footer.php';
