<?php
require_once("../../../connection/connection.php");

class DashboardServices extends config {

    // READ ALL ADMIN ACCOUNTS
    public function getAdminAccount() {
        try {
            $query = "SELECT `id`, `fullname`, `username`, `password` FROM `tbl_admin_access` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }





    // CREATE ADMIN ACCOUNT
    public function create($fullname, $username, $password) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            // Prepare the first query (patient_info)
            $createAdmin = "INSERT INTO `tbl_admin_access`(`fullname`, `username`, `password`) VALUES (:fullname, :username, :password)";
            $stmt1 = $this->pdo->prepare($createAdmin);
            $stmt1->bindParam(':fullname', $fullname);
            $stmt1->bindParam(':username', $username);
            $stmt1->bindParam(':password', $password);

            // Execute the first query
            $stmt1->execute();
            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // UPDATE ADMIN ACCOUNT
    public function update($id, $fullname, $username, $password) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            

            // Prepare the first query (patient_info)
            $updateAdmin = "UPDATE `tbl_admin_access` SET `fullname`=:fullname,`username`=:username,`password`=:password WHERE id=:id";
            $stmt1 = $this->pdo->prepare($updateAdmin);
            $stmt1->bindParam(':fullname', $fullname);
            $stmt1->bindParam(':username', $username);
            $stmt1->bindParam(':password', $password);
            $stmt1->bindParam(':id', $id);
            // Execute the first query
            $stmt1->execute();

            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // DELETE ADMIN ACCOUNT
    public function delete($id) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            // Prepare the delete query for patient_info
            $deletAdminAcc = "DELETE FROM `tbl_admin_access` WHERE id= :id";
            $stmt = $this->pdo->prepare($deletAdminAcc);
            $stmt->bindParam(':id', $id);

            // Execute the delete query for patient_info
            $stmt->execute();

            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage(); 
            return false;
        }
    }
    
}




?>
