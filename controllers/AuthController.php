<?php
class AuthController extends BaseController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->userModel->authenticate($email, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $this->redirect('dashboard/index');
            } else {
                return $this->view('auth/login', ['error' => 'Invalid credentials']);
            }
        }
        
        return $this->view('auth/login');
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? ''
            ];
            
            // Basic validation
            if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
                return $this->view('auth/register', ['error' => 'All fields are required']);
            }
            
            // Check if user exists
            if ($this->userModel->findByEmail($data['email'])) {
                return $this->view('auth/register', ['error' => 'Email already exists']);
            }
            
            $this->userModel->create($data);
            $this->redirect('auth/login');
        }
        
        return $this->view('auth/register');
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('auth/login');
    }
}
?>