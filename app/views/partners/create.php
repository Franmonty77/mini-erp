<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold leading-6 text-gray-900">Nuevo Cliente / Proveedor</h1>
    <?= ui_button('Volver', 'secondary', 'arrow-left', ['href' => BASE_URL . '/partners.php', 'tag' => 'a']) ?>
</div>

<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <form action="<?= BASE_URL ?>/partners.php?action=store" method="POST" class="space-y-6">
            
            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">
                <div>
                    <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                    <div class="mt-2">
                        <select name="type" id="type" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                            <option value="client">Cliente</option>
                            <option value="supplier">Proveedor</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                    <div class="mt-2">
                        <input type="text" name="phone" id="phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Dirección</label>
                    <div class="mt-2">
                        <textarea name="address" id="address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-slate-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 pt-4">
                 <?= ui_button('Guardar', 'primary', 'check', ['type' => 'submit']) ?>
            </div>
        </form>
    </div>
</div>
