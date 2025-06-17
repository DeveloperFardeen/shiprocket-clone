<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>Create New Shipment</h1>
    <a href="?route=shipments/index" class="btn" style="background: #6c757d; color: white;">Back to Shipments</a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="order_id">Select Order *</label>
                <select class="form-control" id="order_id" name="order_id" required>
                    <option value="">Choose an order...</option>
                    <?php foreach ($orders as $order): ?>
                        <?php if ($order['status'] === 'pending'): ?>
                            <option value="<?= $order['id'] ?>" <?= (isset($_GET['order_id']) && $_GET['order_id'] == $order['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($order['order_number']) ?> - <?= htmlspecialchars($order['customer_name']) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="courier_partner">Courier Partner *</label>
                <select class="form-control" id="courier_partner" name="courier_partner" required>
                    <option value="">Select courier...</option>
                    <option value="FedEx">FedEx</option>
                    <option value="UPS">UPS</option>
                    <option value="DHL">DHL</option>
                    <option value="Blue Dart">Blue Dart</option>
                    <option value="DTDC">DTDC</option>
                    <option value="Ecom Express">Ecom Express</option>
                </select>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="pickup_date">Pickup Date</label>
                    <input type="date" class="form-control" id="pickup_date" name="pickup_date">
                </div>
                
                <div class="form-group">
                    <label for="delivery_date">Expected Delivery Date</label>
                    <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Create Shipment</button>
                <a href="?route=shipments/index" class="btn" style="background: #6c757d; color: white;">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Add some basic JavaScript for better UX
document.addEventListener('DOMContentLoaded', function() {
    // Auto-set pickup date to tomorrow
    const pickupDate = document.getElementById('pickup_date');
    if (pickupDate && !pickupDate.value) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        pickupDate.value = tomorrow.toISOString().split('T')[0];
    }
    
    // Auto-set delivery date to 3 days from pickup
    const deliveryDate = document.getElementById('delivery_date');
    if (pickupDate && deliveryDate) {
        pickupDate.addEventListener('change', function() {
            if (this.value) {
                const pickup = new Date(this.value);
                pickup.setDate(pickup.getDate() + 3);
                deliveryDate.value = pickup.toISOString().split('T')[0];
            }
        });
    }
    
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let hasError = false;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    hasError = true;
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            
            if (hasError) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
});
</script>