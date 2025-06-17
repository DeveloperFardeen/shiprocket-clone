<?php
class Order extends Database {
    private $table = 'orders';
    
    public function create($data) {
        $sql = "INSERT INTO {$this->table} 
                (user_id, order_number, customer_name, customer_email, customer_phone, 
                 shipping_address, total_amount, status, created_at) 
                VALUES (:user_id, :order_number, :customer_name, :customer_email, 
                        :customer_phone, :shipping_address, :total_amount, :status, NOW())";
        
        $params = [
            ':user_id' => $data['user_id'],
            ':order_number' => $data['order_number'],
            ':customer_name' => $data['customer_name'],
            ':customer_email' => $data['customer_email'],
            ':customer_phone' => $data['customer_phone'],
            ':shipping_address' => $data['shipping_address'],
            ':total_amount' => $data['total_amount'],
            ':status' => 'pending'
        ];
        
        return $this->execute($sql, $params);
    }
    
    public function findByUserId($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC";
        return $this->fetchAll($sql, [':user_id' => $userId]);
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->fetch($sql, [':id' => $id]);
    }
    
    public function updateStatus($id, $status) {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        return $this->execute($sql, [':status' => $status, ':id' => $id]);
    }
    
    public function generateOrderNumber() {
        return 'ORD' . date('Ymd') . rand(1000, 9999);
    }
}
?>