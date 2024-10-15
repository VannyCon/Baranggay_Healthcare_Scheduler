<?php 
// IMPORT THE CONNECTION WHERE THE CONNECTION.PHP IS CONTAIN THE CREDENTIAL TO ACCESS THE DATABASE
require_once("connection/connection.php");

class LoginAccess extends config {

    // USE TO LOGIN , LOGOUT IS LOCATED TO CONNECTION.PHP
    public function login($username, $password){
        try {
            // Prepare and execute query to get user by username
            $query = "SELECT * FROM tbl_admin_access WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && $password === $user['password']) {
                // Password is correct, start a session
                $_SESSION['fullname'] = $user['fullname'];
                // Redirect to a protected page
                return true;
                exit();
            } else {
                $error = "Invalid username or password.";
                return false;
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
            return false;
        }
    }
    
}
?>