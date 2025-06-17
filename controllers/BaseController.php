<?php
class BaseController {
    protected function view($viewPath, $data = []) {
        extract($data);
        
        ob_start();
        include BASE_PATH . '/views/' . $viewPath . '.php';
        $content = ob_get_clean();
        
        // Load main layout
        include BASE_PATH . '/views/layouts/main.php';
    }
    
    protected function redirect($route) {
        header("Location: " . BASE_URL . "?route=" . $route);
        exit;
    }
    
    protected function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>