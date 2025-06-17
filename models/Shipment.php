<?php
class Shipment extends Database {
    private $table = 'shipments';
    
    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                (order_id, tracking_number, courier_partner, pickup_date, 
                 delivery_date, status, created_at) 
                VALUES (:order_id, :tracking_number, :courier_partner, :pickup_date, 
                        :delivery_date, :status, NOW())";
        
        $params = [
            ':order_id' => $data['order_id'],
            ':tracking_number' => $data['tracking_number'],
            ':courier_partner' => $data['courier_partner'],
            ':pickup_date' => $data['pickup_date'],
            ':delivery_date' => $data['delivery_date'],
            ':status' => 'created'
        ];
        
        return $this->execute($sql, $params);
    }
    
    public function findByOrderId($orderId) {
        $sql = "SELECT s.*, o.order_number, o.customer_name 
                FROM {$this->table} s 
                JOIN orders o ON s.order_id = o.id 
                WHERE s.order_id = :order_id";
        return $this->fetch($sql, [':order_id' => $orderId]);
    }
    
    public function findByUserId($userId) {
        $sql = "SELECT s.*, o.order_number, o.customer_name 
                FROM {$this->table} s 
                JOIN orders o ON s.order_id = o.id 
                WHERE o.user_id = :user_id 
                ORDER BY s.created_at DESC";
        return $this->fetchAll($sql, [':user_id' => $userId]);
    }
    
    public function generateTrackingNumber() {
        return 'TRK' . date('Ymd') . rand(100000, 999999);
    }
    
    public function updateStatus($id, $status) {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        return $this->execute($sql, [':status' => $status, ':id' => $id]);
    }
}
?>