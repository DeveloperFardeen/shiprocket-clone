<?php
class ShipmentController extends BaseController {
    private $shipmentModel;
    private $orderModel;
    
    public function __construct() {
        $this->shipmentModel = new Shipment();
        $this->orderModel = new Order();
    }
    
    public function index() {
        $this->requireAuth();
        
        $userId = $_SESSION['user_id'];
        $shipments = $this->shipmentModel->findByUserId($userId);
        
        return $this->view('shipments/index', ['shipments' => $shipments]);
    }
    
    public function create() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'order_id' => $_POST['order_id'] ?? 0,
                'tracking_number' => $this->shipmentModel->generateTrackingNumber(),
                'courier_partner' => $_POST['courier_partner'] ?? '',
                'pickup_date' => $_POST['pickup_date'] ?? '',
                'delivery_date' => $_POST['delivery_date'] ?? ''
            ];
            
            $this->shipmentModel->create($data);
            $this->orderModel->updateStatus($data['order_id'], 'shipped');
            
            $this->redirect('shipments/index');
        }
        
        $userId = $_SESSION['user_id'];
        $orders = $this->orderModel->findByUserId($userId);
        
        return $this->view('shipments/create', ['orders' => $orders]);
    }
}
?>