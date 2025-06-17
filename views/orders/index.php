<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Orders Management</h1>
    <a href="?route=orders/create" class="btn btn-primary">Create New Order</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($orders)): ?>
            <div class="text-center" style="padding: 3rem;">
                <h3>No Orders Found</h3>
                <p>You haven't created any orders yet.</p>
                <a href="?route=orders/create" class="btn btn-primary">Create Your First Order</a>
            </div>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_number']) ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td><?= htmlspecialchars($order['customer_email']) ?></td>
                        <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                        <td>$<?= number_format($order['total_amount'], 2) ?></td>
                        <td><span class="badge badge-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
                        <td><?= date('M j, Y', strtotime($order['created_at'])) ?></td>
                        <td>
                            <a href="?route=orders/view&id=<?= $order['id'] ?>" class="btn btn-sm" style="background: #17a2b8; color: white;">View</a>
                            <?php if ($order['status'] === 'pending'): ?>
                                <a href="?route=shipments/create&order_id=<?= $order['id'] ?>" class="btn btn-sm btn-success">Ship</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>