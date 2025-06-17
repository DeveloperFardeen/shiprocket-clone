<?php
class OrderController extends BaseController {
    private $orderModel;
    
    public function __construct() {
        $this->orderModel = new Order();
    }
    
    public function index() {
        $this->requireAuth();
        
        $userId = $_SESSION['user_id'];
        $orders = $this->orderModel->findByUserId($userId);
        
        return $this->view('orders/index', ['orders' => $orders]);
    }
    
    public function create() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'order_number' => $this->orderModel->generateOrderNumber(),
                'customer_name' => $_POST['customer_name'] ?? '',
                'customer_email' => $_POST['customer_email'] ?? '',
                'customer_phone' => $_POST['customer_phone'] ?? '',
                'shipping_address' => $_POST['shipping_address'] ?? '',
                'total_amount' => $_POST['total_amount'] ?? 0
            ];
            
            // Basic validation
            if (empty($data['customer_name']) || empty($data['customer_email'])) {
                return $this->view('orders/create', ['error' => 'Customer name and email are required']);
            }
            
            $this->orderModel->create($data);
            $this->redirect('orders/index');
        }
        
        return $this->view('orders/create');
    }
    
    public function view() {
        $this->requireAuth();
        
        $orderId = $_GET['id'] ?? 0;
        $order = $this->orderModel->findById($orderId);
        
        if (!$order) {
            $this->redirect('orders/index');
        }
        
        return $this->view('orders/view', ['order' => $order]);
    }
}
?>