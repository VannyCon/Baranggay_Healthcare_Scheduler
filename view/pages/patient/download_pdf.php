<?php
require_once('../../../vendor/autoload.php'); // Load PHPWord
require_once('../../../services/PatientServices.php'); // Load services

    //////////////////////////////////// GENARATE REFFERAL DOCS NEED TO ARGUMENT WHICH HISTORYID AND PATIENTID /////////////////////////////////////

use PhpOffice\PhpWord\PhpWord;

// Check if required parameters are set
if (isset($_GET['Hid']) && isset($_GET['Pid'])) {
    $historyID = $_GET['Hid'];
    $patientID = $_GET['Pid'];

    // Fetch patient and history data
    $patientServices = new PatientServices();
    $patientInfo = $patientServices->getSpecificPatientById($patientID);
    $historyInfo = $patientServices->getPatientHistoryById($historyID);

    // Format date to 'Month Day, Year'
    $originalDate = $patientInfo['date']; 
    $date = new DateTime($originalDate);
    $formattedDate = $date->format('F d, Y'); 


    // Assume $specificPatient['birthdate'] contains the birthdate in 'YYYY-MM-DD' format
    $birthdate = $patientInfo['birthdate']; // E.g., '1990-05-15'

    // Convert the birthdate string into a DateTime object
    $birthdateObject = new DateTime($birthdate);
    // Get the current date
    $today = new DateTime('today');

    // Calculate the age
    $age = $birthdateObject->diff($today)->y;

    // Display the birthdate and age


    if ($patientInfo && $historyInfo) {
        // Initialize PHPWord and create a new document
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Create a table with 3 columns: Left Logo, Centered Text, Right Logo
        $table = $section->addTable();

        // Add a row for logos and titles
        $table->addRow();

        // Left Logo Cell
        $cell1 = $table->addCell(2000);
        $cell1->addImage(
            '../../../assets/images/scho.png', // Replace with the actual path to the left logo
            [
                'width' => 80, // Adjust width
                'height' => 80, // Adjust height
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
            ]
        );

        // Center Text Cell
        $cell2 = $table->addCell(5000, ['valign' => 'center']);
        $cell2->addText('Republic of the Philippines', ['size' => 14], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cell2->addText('Province of Negros Occidental', ['size' => 14], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cell2->addText('HEALTHCARE REFERRAL FORM', ['bold' => true, 'size' => 11], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        // Right Logo Cell
        $cell3 = $table->addCell(2000);
        $cell3->addImage(
            '../../../assets/images/doh.jpg', // Replace with the actual path to the right logo
            [
                'width' => 80,
                'height' => 80,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT,
            ]
        );

        // Add some space below the logo section before the patient details
        $section->addTextBreak(1); // Adds two empty lines

        
        // Mapping abbreviations to their meanings
        $barangayServices = [
            "DP" => "Dengue Prevention and Management",
            "PR" => "Prenatal Referral",
            "IP" => "Immunization Programs",
            "MCH" => "Maternal and Child Health Services",
            "NP" => "Nutrition Programs",
            "HE" => "Health Education",
            "BMC" => "Basic Medical Consultations",
            "EHC" => "Environmental Health Campaigns",
            "TBC" => "Tuberculosis Control",
            "EFA" => "Emergency and First Aid Services",
            "LP" => "Livelihood Programs",
            "DPD" => "Disaster Preparedness",
            "CBR" => "Community-Based Rehabilitation",
            "SCP" => "Senior Citizen and PWD Assistance",
            "MHS" => "Mental Health Support",
            "CPS" => "Child Protection Services"
        ];

        // Get the abbreviation from the specific patient data
        $refferalForAbbreviation = $patientInfo['refferal_for'];

        // Get the full meaning from the mapping
        $refferalForMeaning = isset($barangayServices[$refferalForAbbreviation]) 
            ? $barangayServices[$refferalForAbbreviation] 
            : "Unknown Service";


         // Refferal For
         $textRun = $section->addTextRun();
         $textRun->addText("Refferal For: ", ['size' => 11, 'bold' => true]);
         $textRun->addText("{$refferalForMeaning}\n", ['underline' => 'single', 'size' => 11, 'italic' => true]);


        // Add Patient Name and Date with underline
        $textRun = $section->addTextRun();
        $textRun->addText("PATIENT NAME: ", ['size' => 11]); // Font size 11
        $textRun->addText("{$patientInfo['fname']} ", ['underline' => 'single', 'size' => 11]);
        $textRun->addText("{$patientInfo['mname']} ", ['underline' => 'single', 'size' => 11]);
        $textRun->addText("{$patientInfo['lname']} ", ['underline' => 'single', 'size' => 11]);
        $textRun->addText(str_repeat("_", 15), ['underline' => 'single', 'size' => 11]);
        $textRun->addText(" DATE: ", ['size' => 11]);
        $textRun->addText("{$formattedDate}", ['underline' => 'single', 'size' => 11]);

        // Age, Sex, and Birthdate
        $textRun = $section->addTextRun();
        $textRun->addText("AGE: ", ['size' => 11]);
        $textRun->addText("__{$age}__", ['underline' => 'single', 'size' => 11]);
        $textRun->addText("SEX: ", ['size' => 11]);
        $textRun->addText("______{$patientInfo['sex']}______", ['underline' => 'single', 'size' => 11]);
        $textRun->addText("BIRTHDATE: ", ['size' => 11]);
        $textRun->addText("______{$patientInfo['birthdate']}______", ['underline' => 'single', 'size' => 11]);

        // Civil Status
        $textRun = $section->addTextRun();
        $textRun->addText("CIVIL STATUS: ", ['size' => 11]);
        $textRun->addText("{$patientInfo['civil_status']}", ['underline' => 'single', 'size' => 11]);

         // Address
         $textRun = $section->addTextRun();
         $textRun->addText("PUROK: ", ['size' => 11]);
         $textRun->addText("{$patientInfo['purok']}", ['underline' => 'single', 'size' => 11]);

        // Address
        $textRun = $section->addTextRun();
        $textRun->addText("ADDRESS: ", ['size' => 11]);
        $textRun->addText("{$patientInfo['address']}", ['underline' => 'single', 'size' => 11]);

        // Contact Number
        $textRun = $section->addTextRun();
        $textRun->addText("CONTACT NUMBER: ", ['size' => 11]);
        $textRun->addText("{$patientInfo['phone_number']}\n", ['underline' => 'single', 'size' => 11]);

        // Create a new table for Vital Signs
        $tableStyle = [
            'borderSize' => 6,      // Thickness of the border
            'borderColor' => '000000', // Black color for the border
            'cellMargin' => 50,     // Margin inside each cell
        ];

        $phpWord->addTableStyle('VitalsTable', $tableStyle);

        // Create the table using the defined style
        $table = $section->addTable('VitalsTable');

        // Add Header Row
        $table->addRow();
        $cell1 = $table->addCell(2000, ['bgColor' => 'A9A9A9']);
        $cell1->addText("Vital Sign", ['bold' => true, 'size' => 11], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        $cell2 = $table->addCell(2000, ['bgColor' => 'A9A9A9']);
        $cell2->addText("Value", ['bold' => true, 'size' => 11], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

        // Vital Signs Data
        $table->addRow();
        $table->addCell(5000)->addText("Blood Pressure", ['size' => 11]);
        $table->addCell(5000)->addText($historyInfo['blood_pressure'], ['size' => 11]);

        $table->addRow();
        $table->addCell(5000)->addText("Temperature", ['size' => 11]);
        $table->addCell(5000)->addText($historyInfo['temperature'], ['size' => 11]);

        $table->addRow();
        $table->addCell(5000)->addText("Pulse Rate", ['size' => 11]);
        $table->addCell(5000)->addText($historyInfo['pulse_rate'], ['size' => 11]);

        $table->addRow();
        $table->addCell(5000)->addText("Respiratory Rate", ['size' => 11]);
        $table->addCell(5000)->addText($historyInfo['respiratory_rate'], ['size' => 11]);

        $table->addRow();
        $table->addCell(5000)->addText("Height", ['size' => 11]);
        $table->addCell(5000)->addText($historyInfo['height'], ['size' => 11]);

        $table->addRow();
        $table->addCell(5000)->addText("Weight", ['size' => 11]);
        $table->addCell(5000)->addText($historyInfo['weight'], ['size' => 11]);


        // Findings Section with Font Size 11

        $section->addText("Findings", ['bold' => true, 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("City Health Office Schedule: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['cho_schedule']}______", ['underline' => 'single', 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("Attending Provider: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['name_of_attending_provider']}______", ['underline' => 'single', 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("Nature of Visit: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['nature_of_visit']}______", ['underline' => 'single', 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("Type of Consultation: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['type_of_consultation']}______", ['underline' => 'single', 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("Diagnosis: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['diagnosis']}______", ['underline' => 'single', 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("Medication: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['medication']}______", ['underline' => 'single', 'size' => 11]);

        $textRun = $section->addTextRun();
        $textRun->addText("Laboratory Findings: ", ['size' => 11]);
        $textRun->addText("_{$historyInfo['laboratory_findings']}______", ['underline' => 'single', 'size' => 11]);

        $section->addTextBreak(0.7);
        // Create a table for the signature
        $table = $section->addTable();
        $table->addRow();

        // Add an empty cell to the left (to push the signature text to the right)
        $cell1 = $table->addCell(10000); // Adjust the width to push the content to the right

        // Add the signature text at the lower-right corner
        $cell1->addText('________________________________________', ['size' => 11], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);
        $cell1->addText('Baranggay Official Signature', ['bold' => true, 'size' => 11], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT]);


        // Save the document
        $fileName = "Health_Referral_{$patientInfo['lname']}.docx";
        $phpWord->save($fileName, 'Word2007');

        // Output the file for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header("Content-Disposition: attachment; filename={$fileName}");
        readfile($fileName);
        unlink($fileName); // Delete the file after download
    } else {
        echo "Patient or history information not found.";
    }
} else {
    echo "Invalid request.";
}
