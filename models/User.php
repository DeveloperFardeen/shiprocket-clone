<?php
class User extends Database {
    private $table = 'users';
    
    public function create($data) {
        $sql = "INSERT INTO {$this->table} (username, email, password, created_at) 
                VALUES (:username, :email, :password, NOW())";
        
        $params = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ];
        
        return $this->execute($sql, $params);
    }
    
    public function findByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        return $this->fetch($sql, [':email' => $email]);
    }
    
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->fetch($sql, [':id' => $id]);
    }
    
    public function authenticate($email, $password) {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>