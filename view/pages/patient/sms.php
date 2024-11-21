<?php
require_once('../../../services/PatientServices.php'); // Load services
session_start();

// SMS Gateway API details
define("SERVER", "https://app.sms-gateway.app");
define("API_KEY", "a5c4ecaf4c15268ff086464c3af8ae8600156ff8");

// Function to send cURL request (same as provided)
function sendRequest($url, $postData)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $serverOutput = curl_exec($ch);
    curl_close($ch);

    return json_decode($serverOutput, true);
}

// Function to send a single message (same as provided)
function sendSingleMessage($number, $message, $device = 0, $schedule = null, $isMMS = false, $attachments = null, $prioritize = false)
{
    $url = SERVER . "/services/send.php";
    $postData = array(
        'number' => $number,
        'message' => $message,
        'schedule' => $schedule,
        'key' => API_KEY,
        'devices' => $device,
        'type' => $isMMS ? "mms" : "sms",
        'attachments' => $attachments,
        'prioritize' => $prioritize ? 1 : 0
    );

    return sendRequest($url, $postData);
}

if (isset($_GET['Hid']) && isset($_GET['Pid'])) {
    $historyID = $_GET['Hid'];
    $patientID = $_GET['Pid'];

    // Fetch patient and history data
    $patientServices = new PatientServices();
    $patientInfo = $patientServices->getSpecificPatientById($patientID);
    $historyInfo = $patientServices->getPatientHistoryById($historyID);

    // Prepare the SMS content
    $patientName = $patientInfo['fname'] . ' ' . $patientInfo['mname'] . ' ' . $patientInfo['lname'];
    $contactNumber = $patientInfo['phone_number'];

    $bloodPressure = $historyInfo['blood_pressure'];
    $temperature = $historyInfo['temperature'];
    $pulseRate = $historyInfo['pulse_rate'];
    $respiratoryRate = $historyInfo['respiratory_rate'];
    $weight = $historyInfo['weight'];
    $height = $historyInfo['height'];

    $CHO_Schedule = date('F d, Y  -  h:i A', strtotime($historyInfo['cho_schedule']));
    $name_of_attending_provider = $historyInfo['name_of_attending_provider'];
    $nature_of_visit = $historyInfo['nature_of_visit'];
    $type_of_consultation = $historyInfo['type_of_consultation'];
    $diagnosis = $historyInfo['diagnosis'];
    $medication = $historyInfo['medication'];
    $laboratory_findings = $historyInfo['laboratory_findings'];

    $message = "Hello $patientName, this is a reminder of your recent health check. \n"
        . "Vital Signs\n"
        . "Blood Pressure - $bloodPressure\n"
        . "Temperature (°C) - $temperature °C\n"
        . "Pulse Rate (BPM) - $pulseRate\n"
        . "Respiratory Rate - $respiratoryRate\n"
        . "Weight (kg) - $weight.\n"
        . "Height (cm) - $height.\n \n"

        . "Findings\n"
        . "CHO Schedule - $CHO_Schedule\n"
        . "Attending Provider - $name_of_attending_provider\n"
        . "Nature of Visit - $nature_of_visit\n"
        . "Type of Consultation - $type_of_consultation\n"
        . "Diagnosis - $diagnosis\n"
        . "Medicaiton - $medication\n"
        . "Laboratory Findings - $laboratory_findings.";

    // Send the SMS
    $response = sendSingleMessage($contactNumber, $message);

    // Handle the response and provide feedback
    if (isset($response['success']) && $response['success'] == true) {
        $_SESSION['status'] = "Reminder SMS has been sent successfully to $patientName ";
    } else {
        $_SESSION['error'] = "Failed to send reminder SMS. Please try again.";
    }

    // Redirect back to the patient history page or any relevant page
    header("Location: patient_history.php?PatientID=" . $patientID);
    exit();
}
