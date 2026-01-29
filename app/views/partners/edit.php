<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="card-title mb-0">Editar Cliente / Proveedor</h5>
            </div>
            <div class="card-body">
                <form action="<?= BASE_URL ?>/partners.php?action=update" method="POST">
                    <input type="hidden" name="id" value="<?= $partner['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="type" class="form-select" required>
                            <option value="client" <?= $partner['type'] === 'client' ? 'selected' : '' ?>>Cliente</option>
                            <option value="supplier" <?= $partner['type'] === 'supplier' ? 'selected' : '' ?>>Proveedor</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($partner['name']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($partner['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($partner['phone'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($partner['address'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= BASE_URL ?>/partners.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
