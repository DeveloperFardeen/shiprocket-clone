<div class="auth-container">
    <div class="card">
        <div class="card-header text-center">
            <h2>Login to Shiprocket Clone</h2>
        </div>
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            
            <div class="text-center mt-3">
                <a href="?route=auth/register">Don't have an account? Register</a>
            </div>
        </div>
    </div>
</div>