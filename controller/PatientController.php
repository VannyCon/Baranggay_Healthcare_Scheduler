<?php
/////////////////////////// THIS PART IS FOR ADMIN ACCOUNT CONTROLLER ///////////////////////////////
session_start();
// Redirect to login if not logged in
if (!isset($_SESSION['fullname'])) {
    header("Location: ../../../index.php");
    exit();
}
require_once('../../../services/PatientServices.php');
// Instantiate the class and get nursery owners
$patientServices = new PatientServices();
$patients = $patientServices->getAllPatient();
// THIS PART USE TO TRACE WHO THE ADMIN CREATE THE PATIENT INFO
$admin_name = $_SESSION['fullname'];


// THIS PART USE TO GET THE USER HISTORY (VITAL SIGNS, FINDINGS)
if(isset($_GET['HistoryID'])){
    // Sanitize the ID parameter
    $historyID = $_GET['HistoryID'];
    // Get specific patient history by ID
    $specificHistory = $patientServices->getPatientHistoryById($historyID);

}


// TO DELETE PATIENT HEALTH HISTORY
if (isset($_POST['action']) && $_POST['action'] == 'deleteHealthHistory') {
    $historyID = $patientServices->clean('history_id', 'post');
    $patientID = $patientServices->clean('patient_id', 'post');
    $result = $patientServices->deleteHealthHistory($historyID);
    
    
    if ($result) {
        header("Location: patient_history.php?PatientID=$patientID");
        exit();
    } else {
        error_log("Deletion failed for ID: $id");
         header("Location: patient_history.php?PatientID=$patientID");
        exit();
    }
}


// THIS PART USE TO CRUD VITAL SIGNS, FINDINGS IT SHOULD HAVE A GET PatientID
if(isset($_GET['PatientID'])){
    // Sanitize the ID parameter
    $patientID = $_GET['PatientID'];


    // Get specific patient details by ID
    $specificPatient = $patientServices->getAllPatientById($patientID);
    // Get specific patient health history by patient ID
    $getHealthHistorys = $patientServices->getPatientHistory($patientID);

     $refferal_for = $patientServices->clean('refferal_for', 'post');

     // Vital Signs
     $blood_pressure = $patientServices->clean('blood_pressure', 'post');
     $temperature = $patientServices->clean('temperature', 'post');
     $pulse_rate = $patientServices->clean('pulse_rate', 'post');
     $respiratory_rate = $patientServices->clean('respiratory_rate', 'post');
     $weight = $patientServices->clean('weight', 'post');
     $height = $patientServices->clean('height', 'post');

     // Findings
     $cho_schedule = $patientServices->clean('cho_schedule', 'post');
     $name_of_attending_provider = $patientServices->clean('name_of_attending_provider', 'post');
     $nature_of_visit = $patientServices->clean('nature_of_visit', 'post');
     $type_of_consultation = $patientServices->clean('type_of_consultation', 'post');
     $diagnosis = $patientServices->clean('diagnosis', 'post');
     $medication = $patientServices->clean('medication', 'post');
     $laboratory_findings = $patientServices->clean('laboratory_findings', 'post');


    
    //IF CREATE HEALTH HISTORY
    if (isset($_POST['action'])) {


       if($_POST['action'] == 'createHealthStatus'){
            // Call create method to add the new patient
            $status = $patientServices->createHealthStatus($refferal_for,
                $patientID, $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
                $cho_schedule, $name_of_attending_provider, $nature_of_visit, $type_of_consultation, 
                $diagnosis, $medication, $laboratory_findings, $admin_name
            );
            if($status == true){
                // Redirect to index.php
                header("Location: patient_history.php?PatientID=" . $patientID); 
                exit(); // Important to stop the script after the redirection
            }else{
                header("Location: create.php"); 
            }
       // IF UPDATE HEALTH HISTORY
       }else if($_POST['action'] == 'updateHealthStatus'){

            if(isset($_GET['HistoryID'])){
                $historyID = $_GET['HistoryID'];
                // Call create method to add the new patient
                $status = $patientServices->updateHealthStatus(
                    $refferal_for,
                    $historyID, $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
                    $cho_schedule, $name_of_attending_provider, $nature_of_visit, $type_of_consultation, 
                    $diagnosis, $medication, $laboratory_findings, $admin_name
                );
            }
            if($status == true){
                // Redirect to index.php
                header("Location: patient_history.php?PatientID=" . $patientID);

                exit(); // Important to stop the script after the redirection
            }else{
                header("Location: create.php"); 
            }
       }

    //IF UPDATE
    }
}


// TO DELETE PATIENT INFORMATION
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $patientID = $patientServices->clean('patient_id', 'post');
    $result = $patientServices->delete($patientID);
    
    if ($result) {
        header("Location: index.php");
        exit();
    } else {
        error_log("Deletion failed for ID: $id");
        header("Location: index.php");
    }
// THIS PART NEED ACTION THEN PERFORM EITHER CREATE AND UPDATE
}else if (isset($_POST['action'])) 

{
    $refferal_for = $patientServices->clean('refferal_for', 'post');
   // Clean input data
    $fname = $patientServices->clean('fname', 'post');
    $mname = $patientServices->clean('mname', 'post');
    $lname = $patientServices->clean('lname', 'post');
    $birthdate = $patientServices->clean('birthdate', 'post');
    $age = $patientServices->clean('age', 'post');
    $purok = $patientServices->clean('purok', 'post');
    $address = $patientServices->clean('address', 'post');
    $phone_number = $patientServices->clean('phone_number', 'post');
    $civil_status = $patientServices->clean('civil_status', 'post');
    $sex = $patientServices->clean('sex', 'post');

    // Vital Signs
    $blood_pressure = $patientServices->clean('blood_pressure', 'post');
    $temperature = $patientServices->clean('temperature', 'post');
    $pulse_rate = $patientServices->clean('pulse_rate', 'post');
    $respiratory_rate = $patientServices->clean('respiratory_rate', 'post');
    $weight = $patientServices->clean('weight', 'post');
    $height = $patientServices->clean('height', 'post');

    // Findings
    $cho_schedule = $patientServices->clean('cho_schedule', 'post');
    $name_of_attending_provider = $patientServices->clean('name_of_attending_provider', 'post');
    $nature_of_visit = $patientServices->clean('nature_of_visit', 'post');
    $type_of_consultation = $patientServices->clean('type_of_consultation', 'post');
    $diagnosis = $patientServices->clean('diagnosis', 'post');
    $medication = $patientServices->clean('medication', 'post');
    $laboratory_findings = $patientServices->clean('laboratory_findings', 'post');

    //IF CREATE
    if($_POST['action'] == 'create') {
        // Call create method to add the new patient
        $status = $patientServices->create($refferal_for,
            $fname, $mname, $lname, $birthdate, $age, $purok, $address, $phone_number, $civil_status, $sex, 
            $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
            $cho_schedule, $name_of_attending_provider, $nature_of_visit, $type_of_consultation, 
            $diagnosis, $medication, $laboratory_findings, $admin_name
        );
        if ($status['status'] === true) {
            // Redirect to done.php with query parameters
            $historyID = $status['historyID'];
            $patientID = $status['patientID'];
        
            header("Location: done.php?Hid=$historyID&Pid=$patientID");
            exit(); // Stop further execution after redirection
        } else {
            // Redirect to create.php on failure
            header("Location: create.php");
            exit(); // Ensure the script stops here too
        }
        

    //IF UPDATE
    }else if($_POST['action'] == 'update' ) { 
         // Call create method to add the new patient
         $status = $patientServices->update(
            $patientID, $fname, $mname, $lname, $birthdate, $age, $purok, $address, $phone_number, $civil_status, $sex, 
        );
        if($status == true){
            // Redirect to index.php
            header("Location: index.php"); 
            exit(); // Important to stop the script after the redirection
        }else{
            header("Location: create.php"); 
        }
    }
}










if($title = "patientServices Update"){

    if(isset($_GET['userID'])){
        // Instantiate the class and get nursery owners
        $user_id = $_GET['userID'];
        $patientServices = new patientServices();
        $getSpecificOwner = $patientServices->getpatientServicesById($user_id);

        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            // Clean input data
            $fullname = $patientServices->clean('fullname', 'post');
            $contact_number = $patientServices->clean('contact_number', 'post');
            $purok = $patientServices->clean('purok', 'post');
            $address = $patientServices->clean('address', 'post');
            // Call create method to add the new owner
            $owners = $patientServices->update($getSpecificOwner['id'], $fullname, $contact_number, $purok, $address);
            // Optionally, you can redirect or show a success message after creation
            if($owners == true){
                // Redirect to index.php
                header("Location: index.php"); 
                exit(); // Important to stop the script after the redirection
            }else{
                header("Location: create.php"); 
            }
        }
    }
}

?>