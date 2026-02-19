<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold leading-6 text-gray-900">Editar Factura</h1>
    <?= ui_button('Volver', 'secondary', 'arrow-left', ['href' => BASE_URL . '/invoices.php', 'tag' => 'a']) ?>
</div>

<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <form action="<?= BASE_URL ?>/invoices.php?action=update" method="POST" class="space-y-6">
            <input type="hidden" name="id" value="<?= $invoice['id'] ?>">

            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                <div>
                    <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Tipo de Factura</label>
                    <div class="mt-2">
                        <select name="type" id="type" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                            <option value="issued" <?= $invoice['type'] === 'issued' ? 'selected' : '' ?>>Emitida (A Cliente)</option>
                            <option value="received" <?= $invoice['type'] === 'received' ? 'selected' : '' ?>>Recibida (De Proveedor)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="partner_id" class="block text-sm font-medium leading-6 text-gray-900">Cliente / Proveedor</label>
                    <div class="mt-2">
                        <select name="partner_id" id="partner_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                            <option value="">Selecciona uno...</option>
                            <?php foreach ($partners as $partner): ?>
                                <option value="<?= $partner['id'] ?>" <?= $partner['id'] == $invoice['partner_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($partner['name']) ?> (<?= $partner['type'] === 'client' ? 'Cliente' : 'Proveedor' ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="number" class="block text-sm font-medium leading-6 text-gray-900">Número de Factura</label>
                    <div class="mt-2">
                         <input type="text" name="number" id="number" value="<?= htmlspecialchars($invoice['number']) ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="amount" class="block text-sm font-medium leading-6 text-gray-900">Importe Total</label>
                    <div class="relative mt-2 rounded-md shadow-sm">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                        <input type="number" step="0.01" name="amount" id="amount" value="<?= $invoice['amount'] ?>" required class="block w-full rounded-md border-0 py-1.5 pl-7 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="issue_date" class="block text-sm font-medium leading-6 text-gray-900">Fecha de Emisión</label>
                    <div class="mt-2">
                        <input type="date" name="issue_date" id="issue_date" value="<?= $invoice['issue_date'] ?>" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium leading-6 text-gray-900">Fecha de Vencimiento</label>
                    <div class="mt-2">
                        <input type="date" name="due_date" id="due_date" value="<?= $invoice['due_date'] ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Estado</label>
                     <div class="mt-2">
                        <select name="status" id="status" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                            <option value="pending" <?= $invoice['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="paid" <?= $invoice['status'] === 'paid' ? 'selected' : '' ?>>Pagada</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 pt-4">
                 <?= ui_button('Actualizar Factura', 'primary', 'check', ['type' => 'submit']) ?>
            </div>
        </form>
    </div>
</div>
