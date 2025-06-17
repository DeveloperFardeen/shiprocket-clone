<?php
class DashboardController extends BaseController {
    private $orderModel;
    private $shipmentModel;
    
    public function __construct() {
        $this->orderModel = new Order();
        $this->shipmentModel = new Shipment();
    }
    
    public function index() {
        $this->requireAuth();
        
        $userId = $_SESSION['user_id'];
        $orders = $this->orderModel->findByUserId($userId);
        $shipments = $this->shipmentModel->findByUserId($userId);
        
        $stats = [
            'total_orders' => count($orders),
            'pending_orders' => count(array_filter($orders, fn($o) => $o['status'] === 'pending')),
            'shipped_orders' => count(array_filter($orders, fn($o) => $o['status'] === 'shipped')),
            'total_shipments' => count($shipments)
        ];
        
        return $this->view('dashboard/index', [
            'stats' => $stats,
            'recent_orders' => array_slice($orders, 0, 5),
            'recent_shipments' => array_slice($shipments, 0, 5)
        ]);
    }
}
?>