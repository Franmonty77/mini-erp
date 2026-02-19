<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!doctype html>
<html lang="es" class="h-full bg-gray-50">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= APP_NAME ?></title>
  <link href="<?= BASE_URL ?>/css/output.css" rel="stylesheet">
  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- Phosphor Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="h-full font-sans text-gray-900 antialiased">

<?php if (auth_check()): ?>
<div class="flex h-screen overflow-hidden bg-gray-50" x-data="{ sidebarOpen: false }">
    
    <!-- Off-canvas menu for mobile -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="sidebarOpen" style="display: none;">
        <div class="fixed inset-0 bg-gray-900/80 transition-opacity" x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"></div>

        <div class="fixed inset-0 flex">
            <div class="relative mr-16 flex w-full max-w-xs flex-1 transform transition transition-transform duration-300 ease-in-out" x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                        <span class="sr-only">Cerrar sidebar</span>
                        <i class="ph ph-x text-white text-2xl"></i>
                    </button>
                </div>

                <!-- Sidebar Responsive -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6 pb-4 ring-1 ring-white/10">
                    <div class="flex h-16 shrink-0 items-center">
                        <span class="text-xl font-bold text-white tracking-wide">MINI ERP</span>
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <?php 
                            $uri = $_SERVER['REQUEST_URI'];
                            $dashboardActive = strpos($uri, 'index.php') !== false || $uri === BASE_URL . '/';
                            $invoicesActive = strpos($uri, 'invoices.php') !== false;
                            $partnersActive = strpos($uri, 'partners.php') !== false;
                            ?>
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="<?= BASE_URL ?>/index.php" class="<?= $dashboardActive ? 'bg-slate-800 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="ph ph-squares-four text-xl shrink-0 <?= $dashboardActive ? 'text-white' : 'group-hover:text-white' ?>"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>/invoices.php" class="<?= $invoicesActive ? 'bg-slate-800 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="ph ph-receipt text-xl shrink-0 <?= $invoicesActive ? 'text-white' : 'group-hover:text-white' ?>"></i>
                                            Facturas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL ?>/partners.php" class="<?= $partnersActive ? 'bg-slate-800 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="ph ph-users text-xl shrink-0 <?= $partnersActive ? 'text-white' : 'group-hover:text-white' ?>"></i>
                                            Clientes / Proveedores
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6 pb-4">
            <div class="flex h-16 shrink-0 items-center">
                 <span class="text-xl font-bold text-white tracking-wide">MINI ERP</span>
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <?php 
                            $uri = $_SERVER['REQUEST_URI'];
                            $dashboardActive = strpos($uri, 'index.php') !== false || $uri === BASE_URL . '/';
                            $invoicesActive = strpos($uri, 'invoices.php') !== false;
                            $partnersActive = strpos($uri, 'partners.php') !== false;
                            ?>
                            <li>
                                <a href="<?= BASE_URL ?>/index.php" class="<?= $dashboardActive ? 'bg-slate-800 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <i class="ph ph-squares-four text-xl shrink-0 <?= $dashboardActive ? 'text-white' : 'group-hover:text-white' ?>"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/invoices.php" class="<?= $invoicesActive ? 'bg-slate-800 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <i class="ph ph-receipt text-xl shrink-0 <?= $invoicesActive ? 'text-white' : 'group-hover:text-white' ?>"></i>
                                    Facturas
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/partners.php" class="<?= $partnersActive ? 'bg-slate-800 text-white' : 'text-gray-400 hover:text-white hover:bg-slate-800' ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                    <i class="ph ph-users text-xl shrink-0 <?= $partnersActive ? 'text-white' : 'group-hover:text-white' ?>"></i>
                                    Clientes / Proveedores
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mt-auto">
                        <a href="<?= BASE_URL ?>/logout.php" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-400 hover:bg-slate-800 hover:text-white">
                            <i class="ph ph-sign-out text-xl shrink-0 group-hover:text-white"></i>
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="lg:pl-72 flex flex-col flex-1 h-screen overflow-hidden">
        <!-- Top header -->
        <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center justify-between gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Abrir sidebar</span>
                <i class="ph ph-list text-2xl"></i>
            </button>
            
            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 justify-end items-center">
                 <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <span class="hidden lg:flex lg:items-center">
                        <span class="text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                            Hola, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <main class="py-10 flex-1 overflow-y-auto">
            <div class="px-4 sm:px-6 lg:px-8">
<?php else: ?>
    <!-- Layout Simple para Login -->
    <div class="flex min-h-screen flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                <?= APP_NAME ?>
            </h2>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
<?php endif; ?>
