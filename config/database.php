<?php
class DatabaseConfig {
    const HOST = 'localhost';
    const DB_NAME = 'shiprocket_clone';
    const USERNAME = 'root';
    const PASSWORD = '';
    
    public static function getConnection() {
        try {
            $pdo = new PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME,
                self::USERNAME,
                self::PASSWORD,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            return $pdo;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
?>