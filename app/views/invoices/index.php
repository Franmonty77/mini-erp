<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-gray-900">Facturas</h1>
        <p class="mt-2 text-sm text-gray-700">Lista de todas las facturas emitidas y recibidas.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <?= ui_button('Nueva Factura', 'primary', 'plus', ['href' => BASE_URL . '/invoices.php?action=create', 'tag' => 'a']) ?>
    </div>
</div>

<div class="mt-8 flow-root">
    <!-- Filtros -->
    <div class="bg-white p-4 shadow sm:rounded-lg mb-6">
        <form action="" method="GET" class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
            <div class="sm:col-span-1">
                <label class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                <div class="mt-2">
                    <select name="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option value="">Todos</option>
                        <option value="issued" <?= ($type ?? '') === 'issued' ? 'selected' : '' ?>>Emitidas</option>
                        <option value="received" <?= ($type ?? '') === 'received' ? 'selected' : '' ?>>Recibidas</option>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Cliente / Proveedor</label>
                <div class="mt-2">
                    <select name="partner_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                        <option value="">Todos</option>
                        <?php foreach ($partners as $partner): ?>
                            <option value="<?= $partner['id'] ?>" <?= ($partner_id ?? '') == $partner['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($partner['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-1">
                <label class="block text-sm font-medium leading-6 text-gray-900">Estado</label>
                <div class="mt-2">
                    <select name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option value="">Todos</option>
                        <option value="paid" <?= ($status ?? '') === 'paid' ? 'selected' : '' ?>>Pagada</option>
                        <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium leading-6 text-gray-900">Buscar</label>
                <div class="mt-2">
                    <input type="text" name="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6" placeholder="Número..." value="<?= htmlspecialchars($search ?? '') ?>">
                </div>
            </div>

            <div class="sm:col-span-1">
                <label class="block text-sm font-medium leading-6 text-gray-900">Desde</label>
                <div class="mt-2">
                    <input type="date" name="date_from" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6" value="<?= htmlspecialchars($date_from ?? '') ?>">
                </div>
            </div>
            
            <div class="sm:col-span-1">
                <label class="block text-sm font-medium leading-6 text-gray-900">Hasta</label>
                <div class="mt-2">
                    <input type="date" name="date_to" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6" value="<?= htmlspecialchars($date_to ?? '') ?>">
                </div>
            </div>

            <div class="sm:col-span-4 flex items-end gap-2">
                <button type="submit" class="rounded-md bg-slate-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600">
                    <i class="ph ph-funnel mr-1"></i> Filtrar
                </button>
                <a href="<?= BASE_URL ?>/invoices.php" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Limpiar
                </a>
                
                <!-- Export Dropdown -->
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.away="open = false" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <i class="ph ph-download text-lg"></i>
                        Exportar
                        <i class="ph ph-caret-down text-gray-400"></i>
                    </button>

                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" 
                         style="display: none;">
                        <div class="py-1">
                            <button type="submit" name="action" value="export" onclick="document.getElementById('export_format').value='csv'" class="text-gray-700 block w-full px-4 py-2 text-left text-sm hover:bg-gray-100">
                                <i class="ph ph-file-csv mr-2"></i> CSV (Excel)
                            </button>
                            <button type="submit" name="action" value="export" onclick="document.getElementById('export_format').value='pdf'; this.form.target='_blank'; setTimeout(() => { this.form.target=''; }, 500);" class="text-gray-700 block w-full px-4 py-2 text-left text-sm hover:bg-gray-100">
                                <i class="ph ph-file-pdf mr-2"></i> PDF (Imprimir)
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="format" id="export_format" value="">
            </div>
        </form>
    </div>

    <!-- Tabla -->
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Fecha</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Número</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tipo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cliente / Proveedor</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Estado</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Vencimiento</th>
                            <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">Importe</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($invoices)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500 text-sm">No se encontraron facturas.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($invoices as $inv): ?>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6"><?= date('d/m/Y', strtotime($inv['issue_date'])) ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900"><?= htmlspecialchars($inv['number']) ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php if($inv['type'] === 'issued'): ?>
                                            <?= ui_badge('info', 'Emitida') ?>
                                        <?php else: ?>
                                            <?= ui_badge('gray', 'Recibida') ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= htmlspecialchars($inv['partner_name'] ?? 'Desconocido') ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php if($inv['status'] === 'paid'): ?>
                                            <?= ui_badge('success', 'Pagada') ?>
                                        <?php else: ?>
                                            <?= ui_badge('warning', 'Pendiente') ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php 
                                            if($inv['due_date']) {
                                                $due = strtotime($inv['due_date']);
                                                $today = time();
                                                $class = '';
                                                if ($inv['status'] === 'pending' && $due < $today) {
                                                    $class = 'text-red-600 font-bold';
                                                }
                                                echo '<span class="'.$class.'">' . date('d/m/Y', $due) . '</span>';
                                            } else {
                                                echo '-';
                                            }
                                        ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 text-right">
                                        <?= number_format((float)$inv['amount'], 2) ?> €
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="<?= BASE_URL ?>/invoices.php?action=edit&id=<?= $inv['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Editar"><i class="ph ph-pencil text-lg"></i></a>
                                        
                                        <form action="<?= BASE_URL ?>/invoices.php?action=delete" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta factura?');">
                                            <input type="hidden" name="id" value="<?= $inv['id'] ?>">
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
