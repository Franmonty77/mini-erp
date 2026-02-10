<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Facturas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .text-end { text-align: right; }
        h1 { text-align: center; }
        .filters { margin-bottom: 20px; font-size: 14px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h1>Listado de Facturas</h1>
    
    <div class="filters">
        <p><strong>Fecha de impresión:</strong> <?= date('d/m/Y H:i') ?></p>
        <?php if($date_from || $date_to): ?>
            <p><strong>Periodo:</strong> <?= $date_from ? date('d/m/Y', strtotime($date_from)) : 'Inicio' ?> - <?= $date_to ? date('d/m/Y', strtotime($date_to)) : 'Hoy' ?></p>
        <?php endif; ?>
        <?php if($type): ?>
             <p><strong>Tipo:</strong> <?= $type === 'issued' ? 'Emitidas' : 'Recibidas' ?></p>
        <?php endif; ?>
        <?php if($status): ?>
             <p><strong>Estado:</strong> <?= $status === 'paid' ? 'Pagadas' : 'Pendientes' ?></p>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Número</th>
                <th>Tipo</th>
                <th>Cliente/Proveedor</th>
                <th>Estado</th>
                <th class="text-end">Importe</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            foreach ($invoices as $inv): 
                $total += $inv['amount'];
            ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($inv['issue_date'])) ?></td>
                    <td><?= htmlspecialchars($inv['number']) ?></td>
                    <td><?= $inv['type'] === 'issued' ? 'Emitida' : 'Recibida' ?></td>
                    <td><?= htmlspecialchars($inv['partner_name']) ?></td>
                    <td><?= $inv['status'] === 'paid' ? 'Pagada' : 'Pendiente' ?></td>
                    <td class="text-end"><?= number_format((float)$inv['amount'], 2, ',', '.') ?> €</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5" class="text-end"><strong>TOTAL</strong></td>
                <td class="text-end"><strong><?= number_format((float)$total, 2, ',', '.') ?> €</strong></td>
            </tr>
        </tbody>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
