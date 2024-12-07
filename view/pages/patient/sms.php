<?php
require_once('../../../services/PatientServices.php'); // Load services
session_start();


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
        . "Type of Consultation - $type_of_consultation\n"
        . "Diagnosis - $diagnosis\n"
        . "Medicaiton - $medication\n"
        . "Laboratory Findings - $laboratory_findings.";




    /////////////////////////////////////////////////////////////////////

    
        // Array to hold data to send
        $send_data = [];

        // START - Parameters to Change
        // Set the Sender ID
        $send_data['sender_id'] = "PhilSMS"; // Replace with your sender ID

        $cleaned_contact = ltrim($contactNumber, '0');

        // Prepend "+63" to the cleaned contact number
        $send_data['recipient'] = "+63$cleaned_contact";

        // Add your message content
        $send_data['message'] = "Hello $patientName, this is a reminder of your recent health check. \n"
                                . "Vital Signs\n"
                                . "BP - $bloodPressure\n"
                                . "Temp (°C) - $temperature °C\n"
                                . "PR (BPM) - $pulseRate\n"
                                . "RR - $respiratoryRate\n"
                                . "Wt (kg) - $weight.\n"
                                . "Ht (cm) - $height.\n"
                                . "Findings\n"
                                . "CHO Schedule - $CHO_Schedule\n"
                                . "Attending Provider - $name_of_attending_provider\n"
                                . "Type of Consultation - $type_of_consultation\n"
                                . "Diagnosis - $diagnosis\n"
                                . "Medicaiton - $medication\n"
                                . "Laboratory Findings - $laboratory_findings.";

        // Your API Token
        $token = "1185|QIFNfb8NzFhL4HkbJ0hEgzkgOtrBQptuhkKKKkmF"; // Replace with your API token
        // END - Parameters to Change

        // Convert the data array to JSON
        $parameters = json_encode($send_data);

        // Initialize cURL
        $ch = curl_init();

        // Set the API endpoint for sending SMS
        curl_setopt($ch, CURLOPT_URL, "https://app.philsms.com/api/v3/sms/send");

        // Use POST method
        curl_setopt($ch, CURLOPT_POST, true);

        // Add the JSON data as the request body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);

        // Expect a response from the server
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Add headers
        $headers = [
            "Content-Type: application/json",            // Set content type to JSON
            "Authorization: Bearer $token"              // Add Authorization Bearer Token
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute the request
        $get_sms_status = curl_exec($ch);

        // Close the cURL session
        curl_close($ch);

        // Output the response
        echo "Response from API:\n";
        var_dump($get_sms_status);
        // Redirect back to the patient history page or any relevant page
        header("Location: patient_history.php?PatientID=" . $patientID."&success=Done sending SMS reminder");
        exit();
}
