<?php
class SessionManager {
    public function __construct() {
        session_start();
    }

    public function checkSession() {
        if (!isset($_SESSION['sandi'])) {
            $this->redirectToLogin();
        }
    }

    private function redirectToLogin() {
        echo "<script>
            alert('Silakan login dahulu');        
            window.location = 'index.php'; 
        </script>";
        exit;
    }
}

// Create an instance of the SessionManager class and check the session
$sessionManager = new SessionManager();
$sessionManager->checkSession();
?>
