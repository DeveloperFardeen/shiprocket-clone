<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Order Details</h1>
    <div>
        <?php if ($order['status'] === 'pending'): ?>
            <a href="?route=shipments/create&order_id=<?= $order['id'] ?>" class="btn btn-success">Create Shipment</a>
        <?php endif; ?>
        <a href="?route=orders/index" class="btn" style="background: #6c757d; color: white;">Back to Orders</a>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <div class="card">
        <div class="card-header">
            <h3>Order Information</h3>
        </div>
        <div class="card-body">
            <table style="width: 100%;">
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Order Number:</td>
                    <td style="padding: 0.5rem;"><?= htmlspecialchars($order['order_number']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Customer Name:</td>
                    <td style="padding: 0.5rem;"><?= htmlspecialchars($order['customer_name']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Email:</td>
                    <td style="padding: 0.5rem;"><?= htmlspecialchars($order['customer_email']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Phone:</td>
                    <td style="padding: 0.5rem;"><?= htmlspecialchars($order['customer_phone']) ?></td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Total Amount:</td>
                    <td style="padding: 0.5rem;">$<?= number_format($order['total_amount'], 2) ?></td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Status:</td>
                    <td style="padding: 0.5rem;"><span class="badge badge-<?= $order['status'] ?>"><?= ucfirst($order['status']) ?></span></td>
                </tr>
                <tr>
                    <td style="padding: 0.5rem; font-weight: bold;">Created:</td>
                    <td style="padding: 0.5rem;"><?= date('M j, Y g:i A', strtotime($order['created_at'])) ?></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h3>Shipping Address</h3>
        </div>
        <div class="card-body">
            <p style="white-space: pre-line;"><?= htmlspecialchars($order['shipping_address']) ?></p>
        </div>
    </div>
</div>