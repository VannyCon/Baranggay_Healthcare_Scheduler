<?php
require_once('../../../services/PatientServices.php'); // Load services
if (isset($_GET['Hid']) && isset($_GET['Pid'])) {
    $historyID = $_GET['Hid'];
    $patientID = $_GET['Pid'];

    // Fetch patient and history data
    $patientServices = new PatientServices();

    // you will get data here which the data send number of patient
    $patientInfo = $patientServices->getSpecificPatientById($patientID);
    $historyInfo = $patientServices->getPatientHistoryById($historyID);

}
?>