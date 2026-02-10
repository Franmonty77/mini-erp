<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Editar Factura</h5>
                <a href="<?= BASE_URL ?>/invoices.php" class="btn btn-sm btn-light">Volver</a>
            </div>
            <div class="card-body">
                <form action="<?= BASE_URL ?>/invoices.php?action=update" method="POST">
                    <input type="hidden" name="id" value="<?= $invoice['id'] ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo de Factura</label>
                            <select name="type" id="type" class="form-select" required>
                                <option value="issued" <?= $invoice['type'] === 'issued' ? 'selected' : '' ?>>Emitida (A Cliente)</option>
                                <option value="received" <?= $invoice['type'] === 'received' ? 'selected' : '' ?>>Recibida (De Proveedor)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="partner_id" class="form-label">Cliente / Proveedor</label>
                            <select name="partner_id" id="partner_id" class="form-select" required>
                                <option value="">Selecciona uno...</option>
                                <?php foreach ($partners as $partner): ?>
                                    <option value="<?= $partner['id'] ?>" <?= $partner['id'] == $invoice['partner_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($partner['name']) ?> (<?= $partner['type'] === 'client' ? 'Cliente' : 'Proveedor' ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="number" class="form-label">Número de Factura</label>
                            <input type="text" name="number" id="number" class="form-control" value="<?= htmlspecialchars($invoice['number']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="amount" class="form-label">Importe Total</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="<?= $invoice['amount'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="issue_date" class="form-label">Fecha de Emisión</label>
                            <input type="date" name="issue_date" id="issue_date" class="form-control" value="<?= $invoice['issue_date'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="due_date" class="form-label">Fecha de Vencimiento</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" value="<?= $invoice['due_date'] ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" <?= $invoice['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="paid" <?= $invoice['status'] === 'paid' ? 'selected' : '' ?>>Pagada</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Actualizar Factura</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
