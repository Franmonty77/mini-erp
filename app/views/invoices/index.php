<div class="row mb-4">
    <div class="col-md-6">
        <h1>Facturas</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?= BASE_URL ?>/invoices.php?action=create" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nueva Factura
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select name="type" class="form-select">
                    <option value="">Todos</option>
                    <option value="issued" <?= ($type ?? '') === 'issued' ? 'selected' : '' ?>>Emitidas</option>
                    <option value="received" <?= ($type ?? '') === 'received' ? 'selected' : '' ?>>Recibidas</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Cliente / Proveedor</label>
                <select name="partner_id" class="form-select">
                    <option value="">Todos</option>
                    <?php foreach ($partners as $partner): ?>
                        <option value="<?= $partner['id'] ?>" <?= ($partner_id ?? '') == $partner['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($partner['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Estado</label>
                <select name="status" class="form-select">
                    <option value="">Todos</option>
                    <option value="paid" <?= ($status ?? '') === 'paid' ? 'selected' : '' ?>>Pagada</option>
                    <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Buscar</label>
                <input type="text" name="search" class="form-control" placeholder="Número..." value="<?= htmlspecialchars($search ?? '') ?>">
            </div>
            
            <div class="col-md-3">
                <label class="form-label">Desde</label>
                <input type="date" name="date_from" class="form-control" value="<?= htmlspecialchars($date_from ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Hasta</label>
                <input type="date" name="date_to" class="form-control" value="<?= htmlspecialchars($date_to ?? '') ?>">
            </div>
            
            <div class="col-md-6 d-flex align-items-end">
                <button class="btn btn-primary me-2" type="submit">
                    <i class="bi bi-filter"></i> Filtrar
                </button>
                <a href="<?= BASE_URL ?>/invoices.php" class="btn btn-outline-secondary me-2">Limpiar</a>
                
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download"></i> Exportar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <button type="submit" name="action" value="export" class="dropdown-item" onclick="document.getElementById('export_format').value='csv'">
                                <i class="bi bi-file-earmark-excel"></i> CSV (Excel)
                            </button>
                        </li>
                        <li>
                            <button type="submit" name="action" value="export" class="dropdown-item" onclick="document.getElementById('export_format').value='pdf'; this.form.target='_blank'; setTimeout(() => { this.form.target=''; }, 500);">
                                <i class="bi bi-file-earmark-pdf"></i> PDF (Imprimir)
                            </button>
                        </li>
                    </ul>
                </div>
                <input type="hidden" name="format" id="export_format" value="">
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Número</th>
                        <th>Tipo</th>
                        <th>Cliente / Proveedor</th>
                        <th>Estado</th>
                        <th>Vencimiento</th>
                        <th class="text-end">Importe</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($invoices)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">No se encontraron facturas.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($invoices as $inv): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($inv['issue_date'])) ?></td>
                                <td class="fw-bold"><?= htmlspecialchars($inv['number']) ?></td>
                                <td>
                                    <?php if($inv['type'] === 'issued'): ?>
                                        <span class="badge bg-primary">Emitida</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Recibida</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($inv['partner_name'] ?? 'Desconocido') ?></td>
                                <td>
                                    <?php if($inv['status'] === 'paid'): ?>
                                        <span class="badge bg-success">Pagada</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        if($inv['due_date']) {
                                            $due = strtotime($inv['due_date']);
                                            $today = time();
                                            $class = '';
                                            if ($inv['status'] === 'pending' && $due < $today) {
                                                $class = 'text-danger fw-bold';
                                            }
                                            echo '<span class="'.$class.'">' . date('d/m/Y', $due) . '</span>';
                                        } else {
                                            echo '-';
                                        }
                                    ?>
                                </td>
                                <td class="text-end fw-bold">
                                    <?= number_format((float)$inv['amount'], 2) ?> €
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= BASE_URL ?>/invoices.php?action=edit&id=<?= $inv['id'] ?>" class="btn btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?= BASE_URL ?>/invoices.php?action=delete" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta factura?');">
                                            <input type="hidden" name="id" value="<?= $inv['id'] ?>">
                                            <button type="submit" class="btn btn-outline-danger" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
