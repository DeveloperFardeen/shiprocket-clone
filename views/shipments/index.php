<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Shipments Management</h1>
    <a href="?route=shipments/create" class="btn btn-primary">Create New Shipment</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($shipments)): ?>
            <div class="text-center" style="padding: 3rem;">
                <h3>No Shipments Found</h3>
                <p>You haven't created any shipments yet.</p>
                <a href="?route=shipments/create" class="btn btn-primary">Create Your First Shipment</a>
            </div>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tracking Number</th>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Courier Partner</th>
                        <th>Pickup Date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($shipments as $shipment): ?>
                    <tr>
                        <td><?= htmlspecialchars($shipment['tracking_number']) ?></td>
                        <td><?= htmlspecialchars($shipment['order_number']) ?></td>
                        <td><?= htmlspecialchars($shipment['customer_name']) ?></td>
                        <td><?= htmlspecialchars($shipment['courier_partner']) ?></td>
                        <td><?= $shipment['pickup_date'] ? date('M j, Y', strtotime($shipment['pickup_date'])) : '-' ?></td>
                        <td><?= $shipment['delivery_date'] ? date('M j, Y', strtotime($shipment['delivery_date'])) : '-' ?></td>
                        <td><span class="badge badge-<?= $shipment['status'] ?>"><?= ucfirst(str_replace('_', ' ', $shipment['status'])) ?></span></td>
                        <td><?= date('M j, Y', strtotime($shipment['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>