<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Create New Order</h1>
    <a href="?route=orders/index" class="btn" style="background: #6c757d; color: white;">Back to Orders</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="customer_name">Customer Name *</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                </div>
                
                <div class="form-group">
                    <label for="customer_email">Customer Email *</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="customer_phone">Customer Phone</label>
                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone">
                </div>
                
                <div class="form-group">
                    <label for="total_amount">Total Amount ($)</label>
                    <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="0.00">
                </div>
            </div>
            
            <div class="form-group">
                <label for="shipping_address">Shipping Address *</label>
                <textarea class="form-control" id="shipping_address" name="shipping_address" rows="4" required></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Create Order</button>
                <a href="?route=orders/index" class="btn" style="background: #6c757d; color: white;">Cancel</a>
            </div>
        </form>
    </div>
</div>