<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-gray-900">Clientes / Proveedores</h1>
        <p class="mt-2 text-sm text-gray-700">Gestión de clientes y proveedores para facturación.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
         <?= ui_button('Nuevo', 'primary', 'plus', ['href' => BASE_URL . '/partners.php?action=create', 'tag' => 'a']) ?>
    </div>
</div>

<div class="mt-8 flow-root">
    <!-- Search Form -->
    <div class="bg-white p-4 shadow sm:rounded-lg mb-6 max-w-2xl">
        <form action="<?= BASE_URL ?>/partners.php" method="GET" class="flex gap-4">
             <div class="flex-grow">
                 <input type="text" name="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6" placeholder="Buscar por nombre o email..." value="<?= htmlspecialchars($search) ?>">
             </div>
             <button type="submit" class="rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
                Buscar
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Tipo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nombre</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Teléfono</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($partners)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500 text-sm">No se encontraron registros.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($partners as $partner): ?>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <?php if ($partner['type'] === 'client'): ?>
                                            <?= ui_badge('success', 'Cliente') ?>
                                        <?php else: ?>
                                            <?= ui_badge('warning', 'Proveedor') ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 font-medium"><?= htmlspecialchars($partner['name']) ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= htmlspecialchars($partner['email'] ?? '-') ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= htmlspecialchars($partner['phone'] ?? '-') ?></td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="<?= BASE_URL ?>/partners.php?action=edit&id=<?= $partner['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Editar"><i class="ph ph-pencil text-lg"></i></a>
                                        
                                        <form action="<?= BASE_URL ?>/partners.php?action=delete" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                            <input type="hidden" name="id" value="<?= $partner['id'] ?>">
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                                <i class="ph ph-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
