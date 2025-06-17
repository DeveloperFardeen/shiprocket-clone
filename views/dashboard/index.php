<h1>Dashboard</h1>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number"><?= $stats['total_orders'] ?></div>
        <div class="stat-label">Total Orders</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $stats['pending_orders'] ?></div>
        <div class="stat-label">Pending Orders</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $stats['shipped_orders'] ?></div>
        <div class="stat-label">Shipped Orders</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?= $stats['total_shipments'] ?></div>
        <div class="stat-label">Total Shipments</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <div class="card">
        <div class="card-header">
            <h3>Recent Orders</h3>
        </div>
        <div class="card-body">
            <?php if (empty($recent_orders)): ?>
                <p>No orders yet. <a href="?route=orders/create">Create your first order</a></p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr>
                            <td><?= htmlspecialchars($order['order_number']) ?></td>
                            <td><?= htmlspecialchars($order['customer_name']) ?></td>
                            <td><span class="badge badge-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
                            <td>$<?= number_format($order['total_amount'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3>Recent Shipments</h3>
        </div>
        <div class="card-body">
            <?php if (empty($recent_shipments)): ?>
                <p>No shipments yet. <a href="?route=shipments/create">Create your first shipment</a></p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tracking #</th>
                            <th>Order #</th>
                            <th>Courier</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_shipments as $shipment): ?>
                        <tr>
                            <td><?= htmlspecialchars($shipment['tracking_number']) ?></td>
                            <td><?= htmlspecialchars($shipment['order_number']) ?></td>
                            <td><?= htmlspecialchars($shipment['courier_partner']) ?></td>
                            <td><span class="badge badge-<?= $shipment['status'] ?>"><?= ucfirst($shipment['status']) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>