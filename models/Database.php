<?php
class Database {
    protected $connection;
    
    public function __construct() {
        $this->connection = DatabaseConfig::getConnection();
    }
    
    protected function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    protected function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    protected function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }
    
    protected function execute($sql, $params = []) {
        return $this->query($sql, $params);
    }
}
?>