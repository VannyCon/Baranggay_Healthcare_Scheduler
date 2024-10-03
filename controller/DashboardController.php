<?php
session_start();
// Redirect to login if not logged in
if (!isset($_SESSION['fullname'])) {
    header("Location: ../../../index.php");
    exit();
}
require_once('../../../services/DashboardServices.php');
// Instantiate the class and get nursery owners
$dashboardServices = new DashboardServices();
$historys = $dashboardServices->getAllHistory();
$adminAccs = $dashboardServices->getAdminAccount();


if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $patientID = $dashboardServices->clean('adminID', 'post');
    $result = $dashboardServices->delete($patientID);
    
    if ($result) {
        header("Location: accounts.php");
        exit();
    } else {
        error_log("Deletion failed for ID: $id");
        header("Location: accounts.php");
    }
}else if (isset($_POST['action'])) {
   // Clean input data
    $fullname = $dashboardServices->clean('fullname', 'post');
    $username = $dashboardServices->clean('username', 'post');
    $password = $dashboardServices->clean('password', 'post');
    $adminID = $dashboardServices->clean('adminID', 'post');

    //IF CREATE
    if($_POST['action'] == 'create') {
        // Call create method to add the new patient
        $status = $dashboardServices->create(
            $fullname, $username, $password
        );
        if($status == true){
            // Redirect to index.php
            header("Location: accounts.php"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: accounts.php"); 
        }

    //IF UPDATE
    }else if($_POST['action'] == 'update' ) { 
         // Call create method to add the new patient
         $status = $dashboardServices->update(
            $adminID, $fullname, $username, $password
        );
        if($status == true){
            // Redirect to index.php
            header("Location: accounts.php"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: accounts.php"); 
        }
    }
}
?>