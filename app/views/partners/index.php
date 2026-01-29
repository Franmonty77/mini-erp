<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Clientes / Proveedores</h2>
    <a href="<?= BASE_URL ?>/partners.php?action=create" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="<?= BASE_URL ?>/partners.php" method="GET" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o email..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Tipo</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($partners)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">No se encontraron registros.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($partners as $partner): ?>
                            <tr>
                                <td>
                                    <?php if ($partner['type'] === 'client'): ?>
                                        <span class="badge bg-success">Cliente</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Proveedor</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($partner['name']) ?></td>
                                <td><?= htmlspecialchars($partner['email'] ?? '') ?></td>
                                <td><?= htmlspecialchars($partner['phone'] ?? '') ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>/partners.php?action=edit&id=<?= $partner['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    <form action="<?= BASE_URL ?>/partners.php?action=delete" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este registro?');">
                                        <input type="hidden" name="id" value="<?= $partner['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
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
