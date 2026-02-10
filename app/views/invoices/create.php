<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Nueva Factura</h5>
                <a href="<?= BASE_URL ?>/invoices.php" class="btn btn-sm btn-light">Volver</a>
            </div>
            <div class="card-body">
                <form action="<?= BASE_URL ?>/invoices.php?action=store" method="POST">
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo de Factura</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="issued">Emitida (A Cliente)</option>
                                <option value="received">Recibida (De Proveedor)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="partner_id" class="form-label">Cliente / Proveedor</label>
                            <select name="partner_id" id="partner_id" class="form-select" required>
                                <option value="">Selecciona uno...</option>
                                <?php foreach ($partners as $partner): ?>
                                    <option value="<?= $partner['id'] ?>">
                                        <?= htmlspecialchars($partner['name']) ?> (<?= $partner['type'] === 'client' ? 'Cliente' : 'Proveedor' ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="number" class="form-label">Número de Factura</label>
                            <input type="text" name="number" id="number" class="form-control" required placeholder="Ej: F-2023-001">
                        </div>
                        <div class="col-md-6">
                            <label for="amount" class="form-label">Importe Total</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="issue_date" class="form-label">Fecha de Emisión</label>
                            <input type="date" name="issue_date" id="issue_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="due_date" class="form-label">Fecha de Vencimiento</label>
                            <input type="date" name="due_date" id="due_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending">Pendiente</option>
                            <option value="paid">Pagada</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Guardar Factura</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
