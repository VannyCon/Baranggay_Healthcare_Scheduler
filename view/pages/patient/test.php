<?php
require_once('../../../vendor/autoload.php'); // Load PHPWord
require_once('../../../services/PatientServices.php'); // Load services
require_once('../../../vendor/autoload.php'); // Load PHPWord

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Shared\Converter;

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Clear any previous output
if (ob_get_level()) ob_end_clean();


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
    $refferalForAbbreviation = $historyInfo['refferal_for'];

    // Get the full meaning from the mapping
    $refferalForMeaning = isset($barangayServices[$refferalForAbbreviation]) 
        ? $barangayServices[$refferalForAbbreviation] 
        : "Unknown Service";


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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Initialize PHPWord and create a new document
    $phpWord = new PhpWord();

    // Set up A4 page size and margins
    $sectionStyle = [
        'orientation' => 'portrait',
        'pageSizeW'   => Converter::inchToTwip(8.27), // A4 width
        'pageSizeH'   => Converter::inchToTwip(11.69), // A4 height
        'marginTop'    => Converter::inchToTwip(0.2),
        'marginBottom' => Converter::inchToTwip(0.2),
        'marginLeft'   => Converter::inchToTwip(0.5),
        'marginRight'  => Converter::inchToTwip(0.5),
    ];

    $section = $phpWord->addSection($sectionStyle);

    // Set table style
    $tableStyle = [
        'cellMargin' => 30,
        'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
    ];
    $phpWord->addTableStyle('Table', $tableStyle);

    // Add a table for the layout
    $table = $section->addTable('Table');

    // Add a row for two columns
    $table->addRow();
    $paragraphStyle = ['spacing' => 0, 'spaceAfter' => 0];
    // Left Column (First Side)
    $cellLeft = $table->addCell(6000, ['valign' => 'top']); // Reduced width
    $cellLeft->addText("REFERRED TO:", ['bold' => true, 'size' => 11], $paragraphStyle);

 
    // Assuming $historyInfo['cho_schedule'] contains a datetime string like "2024-10-15 09:11:34.000000"

    // Extract date and time from the cho_schedule
    $datetime = new DateTime($historyInfo['cho_schedule']);
    $date = $datetime->format('Y-m-d'); // Date in YYYY-MM-DD format
    $time = $datetime->format('H:i:s'); // Time in HH:MM:SS format

    // Add text with the formatted date and time
    $textRun = $cellLeft->addTextRun($paragraphStyle); // Apply spacing here
    $textRun->addText("Facility:", ['size' => 11], $paragraphStyle);
    $textRun->addText("City Health Office", ['underline' => 'single','size' => 11], $paragraphStyle);

    // Date Field
    $textRun2 = $cellLeft->addTextRun($paragraphStyle); // Apply spacing here
    $textRun2->addText("Date:", ['size' => 11], $paragraphStyle);
    $textRun2->addText($date, ['underline' => 'single','size' => 11], $paragraphStyle);

    // Time Field
    $textRun3 = $cellLeft->addTextRun($paragraphStyle); // Apply spacing here
    $textRun3->addText("Time:", ['size' => 11], $paragraphStyle);
    $textRun3->addText($time, ['underline' => 'single','size' => 11], $paragraphStyle);

    // Add a line break at the end
    $cellLeft->addTextBreak(1);


    $cellLeft->addText("REFERRED FROM:", ['bold' => true, 'size' => 11]);
    $cellLeft->addText("Facility: __________________", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("Date: ____________________", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("Time: ____________________", ['size' => 11], $paragraphStyle);
    $cellLeft->addTextBreak(1);

    // Remove space after paragraph

    $cellLeft->addText("REASON FOR REFERRAL:", ['bold' => true, 'size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ Further evaluation and management", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ For Work-up", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ For Medico-Legal", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ Isolation", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ Patient's Request", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ OPD Consult", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ Others: _______________", ['size' => 11], $paragraphStyle);

    $cellLeft->addTextBreak(1);


    $cellLeft->addText("PHILHEALTH INFORMATION:", ['bold' => true, 'size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ PHIC ID No: ________________________", ['size' => 11], $paragraphStyle);
    $cellLeft->addText("☐ Non-PHIC", ['size' => 11], $paragraphStyle);
    $cellLeft->addTextBreak(1);

    $cellLeft->addText("REFERRED BY:", ['bold' => true, 'size' => 11], $paragraphStyle);
    $cellLeft->addText("{$historyInfo['name_of_attending_provider']}   ", ['underline' => 'single','size' => 11], $paragraphStyle);
    $cellLeft->addText(" Printed Name and Signature", ['size' => 8], $paragraphStyle);
    $cellLeft->addText("_____________________", ['size' => 11] , $paragraphStyle);
    $cellLeft->addText("     Designation", ['size' => 8] , $paragraphStyle);

    // Right Column (Second Side)
    $cellRight = $table->addCell(9000, ['valign' => 'top']); // Reduced width
    // Create an inner table for the layout inside the cell
    $innerTable = $cellRight->addTable();

    // Add a row to the inner table
    $innerTable->addRow();

    // Left cell for the left logo
    $cellLeftLogo = $innerTable->addCell(3000, ['valign' => 'center']);
    $cellLeftLogo->addImage(
        '../../../assets/images/scho.png', // Left logo path
        [
            'width' => 40,
            'height' => 40,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        ]
    );

    // Center cell for the text
    $cellCenterText = $innerTable->addCell(6000, ['valign' => 'center']); // Adjust width to your preference
    $cellCenterText->addText('Republic of the Philippines', ['size' => 10], ['spacing' => 0, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
    $cellCenterText->addText('Province of Negros Occidental', ['size' => 10], ['spacing' => 0, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
    $cellCenterText->addText('HEALTHCARE REFERRAL FORM', ['bold' => true, 'size' => 10], ['spacing' => 0, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

    // Right cell for the right logo
    $cellRightLogo = $innerTable->addCell(3000, ['valign' => 'center']);
    $cellRightLogo->addImage(
        '../../../assets/images/doh.jpg', // Right logo path
        [
            'width' => 40,
            'height' => 40,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        ]
    );

    $fullName = "{$patientInfo['fname']} {$patientInfo['mname']} {$patientInfo['lname']}";
    $length = strlen($fullName); // Get the length of the full name
    
    // Calculate the number of underscores needed to make the total length 29
    $underscoresNeeded = max(0, 40 - $length); // Ensure we don't get a negative number
    
    // Add the underscores dynamically
    $underscores = str_repeat("_", $underscoresNeeded);
    
    // Define paragraph styles
    $paragraphStyle4 = ['spacing' => 0, 'spaceAfter' => 0];
    $paragraphStyle1 = ['spacing' => 1.15, 'spaceAfter' => 1.15];
    
    // Add Patient Name Section
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("PATIENT NAME: ", ['size' => 11, 'bold' => true]); // Font size 11
    $textRun->addText("{$patientInfo['fname']} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText("{$patientInfo['mname']} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText("{$patientInfo['lname']} ", ['underline' => 'single', 'size' => 11]);
    
    // Add the calculated number of underscores
    $textRun->addText($underscores, ['size' => 11]);    
    

    // Add Age, Sex, and Birthdate
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("AGE: ", ['size' => 11, 'bold' => true]);
    $textRun->addText(" {$age} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText(" SEX: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("  {$patientInfo['sex']} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText(" BIRTHDATE: ",['size' => 11, 'bold' => true]);

    // Format birthdate
    $birthdate = new DateTime($patientInfo['birthdate']); // Assuming 'birthdate' is in 'YYYY-MM-DD' format
    $formattedBirthdate = $birthdate->format('F j, Y'); // Format as "Month Day, Year"
    $textRun->addText(" {$formattedBirthdate}   ", ['underline' => 'single', 'size' => 11]);

    $address = $patientInfo['address'].",".$patientInfo['purok'];
    // Add Address
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("ADDRESS: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("{$address}", ['underline' => 'single', 'size' => 11]);

    // Add Age, Sex, and Birthdate
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("OCCUPATION: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("    {$patientInfo['occupation']}    ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText(" RELIGION: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("  {$patientInfo['religion']}     ", ['underline' => 'single', 'size' => 11]);
    
    $paragraphStyle6 = [
        'spacing' => 1.15,    // Line spacing
        'spaceAfter' => 120,  // Space after the line in twips
        'spaceBefore' => 120, // Space before the line in twips
    ];
    
    // Add Guardian information
    $textRun = $cellRight->addTextRun($paragraphStyle6); // Apply spacing here
    $textRun->addText("PARENT/GUARDIAN (In case of a minor): ", ['size' => 11, 'bold' => true]);
    $textRun->addText("     {$patientInfo['guardian']}     ", ['underline' => 'single', 'size' => 11]);
    

    // Add Chief Complaint section
    // Add Chief Complaint section with rectangle box
    $chiefComplaintTable = $cellRight->addTable();
    $chiefComplaintRow = $chiefComplaintTable->addRow();

    // Cell for "CHIEF COMPLAINT:" text (left side)
    $labelCell = $chiefComplaintRow->addCell(2000);
    $labelCell->addText("CHIEF COMPLAINT:", ['bold' => true, 'size' => 11], $paragraphStyle);

    // Cell for rectangle box (right side)
    $boxCell = $chiefComplaintRow->addCell(7000, [
        'borderSize' => 1,         // Add border
        'borderColor' => '000000', // Black border
        'valign' => 'center',
        'height' => 600,          // Adjust height as needed
        'borderTopSize' => 10,     // Add top border
        'borderRightSize' => 10,   // Add right border
        'borderBottomSize' => 10,  // Add bottom border
        'borderLeftSize' => 10     // Add left border
    ]);
    $boxCell->addText("{$refferalForMeaning}", $paragraphStyle); // Empty text to maintain the box shape
    $cellRight->addText('', [], ['spacing' => 0, 'spaceAfter' => 30,]); // Adjust 10 to control spacing


    $briefHistory = $cellRight->addTable();
    $briefHistoryRow = $briefHistory->addRow();

    // Cell for "CHIEF COMPLAINT:" text (left side)
    $labelCell = $briefHistoryRow->addCell(2500);
    $labelCell->addText("BRIEF HISTORY ", ['bold' => true, 'size' => 10], $paragraphStyle);
    $labelCell->addText("AND PERTINENT ", ['bold' => true, 'size' => 10], $paragraphStyle);
    $labelCell->addText("P.E:", ['bold' => true, 'size' => 10], $paragraphStyle);

    // Cell for rectangle box with vital signs (right side)
    $boxCell = $briefHistoryRow->addCell(6500, [
        'borderSize' => 1,
        'borderColor' => '000000',
        'valign' => 'top',
        'height' => 700,
        'borderTopSize' => 10,
        'borderRightSize' => 10,
        'borderBottomSize' => 10,
        'borderLeftSize' => 10,
        'paddingTop' => 100,
        'paddingLeft' => 100,
        'paddingRight' => 100,
        'paddingBottom' => 100
    ]);

    // Add Vital Signs section inside the box
    $vitalSignsRun = $boxCell->addTextRun();
    $vitalSignsRun->addText("   BP: ", ['size' => 10]);
    $vitalSignsRun->addText("{$historyInfo['blood_pressure']}", ['underline' => 'single', 'size' => 10]);
    $vitalSignsRun->addText("   RR: ", ['size' => 10]);
    $vitalSignsRun->addText("{$historyInfo['respiratory_rate']}", ['underline' => 'single', 'size' => 10]);
    $vitalSignsRun->addText("   PR: ", ['size' => 10]);
    $vitalSignsRun->addText("{$historyInfo['pulse_rate']}", ['underline' => 'single', 'size' => 10]);
    $vitalSignsRun->addText("   Temp: ", ['size' => 10]);
    $vitalSignsRun->addText("{$historyInfo['temperature']}", ['underline' => 'single', 'size' => 10]);


    $vitalSignsRun2 = $boxCell->addTextRun();
    $vitalSignsRun2->addText("    Wt: ", ['size' => 10]);
    $vitalSignsRun2->addText("{$historyInfo['height']}", ['underline' => 'single', 'size' => 10]);
    $vitalSignsRun2->addText("    Ht: ", ['size' => 10]);
    $vitalSignsRun2->addText("{$historyInfo['weight']}", ['underline' => 'single', 'size' => 10]);
    $vitalSignsRun2->addText("    Waist: ", ['size' => 10]);
    $vitalSignsRun2->addText("____", ['underline' => 'single', 'size' => 10]);
    $vitalSignsRun2->addText("    O₂ Sat: ", ['size' => 10]);
    $vitalSignsRun2->addText("____", ['underline' => 'single', 'size' => 10]);

    $cellRight->addText('', [], ['spacing' => 0, 'spaceAfter' => 30,]); // Adjust 10 to control spacing

    // Add Chief Complaint section
    // Add Chief Complaint section with rectangle box
    $impressionTable = $cellRight->addTable();
    $impressionRow = $impressionTable->addRow();

    // Cell for "CHIEF COMPLAINT:" text (left side)
    $labelCell = $impressionRow->addCell(2000);
    $labelCell->addText("IMPRESSION/  ", ['bold' => true, 'size' => 10] , $paragraphStyle);
    $labelCell->addText("DIAGNOSIS", ['bold' => true, 'size' => 10] , $paragraphStyle);

    // Cell for rectangle box (right side)
    $boxCell = $impressionRow->addCell(7000, [
        'borderSize' => 1,         // Add border
        'borderColor' => '000000', // Black border
        'valign' => 'center',
        'height' => 600,          // Adjust height as needed
        'borderTopSize' => 10,     // Add top border
        'borderRightSize' => 10,   // Add right border
        'borderBottomSize' => 10,  // Add bottom border
        'borderLeftSize' => 10     // Add left border
    ]);
    $boxCell->addText("{$historyInfo['diagnosis']}"); // Empty text to maintain the box shape
    $cellRight->addTextBreak(1);
    // Now add the lines to the table cells
    $cellRight->addText("ACTION TAKEN/TREATMENT/MEDICATION GIVEN", ['bold' => true, 'size' => 11]);
    $cellRight->addText("         Medication        Dosage   Date Started    Time last dose given", ['bold' => true,'size' => 10], $paragraphStyle6);
    
    $cellRight->addText("{$historyInfo['medication']}", ['underline' => 'single','size' => 11]);
    // Start output buffering



    // Add the remarks
    $cellRight->addText("REMARKS", ['size' => 11], $paragraphStyle);





    $textRun = $section->addTextRun();
    $textRun->addText("_____________________________________________________________________________________", ['size' => 11,$paragraphStyle]); // Font size 11








    // Add a table for the layout
    $table2 = $section->addTable('Table');

    // Add a row for two columns
    $table2->addRow();
    // Left Column (First Side)
    $cellBottomLeft = $table2->addCell(6000, ['valign' => 'top']); // Reduced width
    // Extract date and time from the cho_schedule
    $datetime = new DateTime($historyInfo['cho_schedule']);
    $date = $datetime->format('Y-m-d'); // Date in YYYY-MM-DD format
    $time = $datetime->format('H:i:s'); // Time in HH:MM:SS format

    // Add text with the formatted date and time
    $textRun = $cellBottomLeft->addTextRun($paragraphStyle); // Apply spacing here
    $textRun->addText("Facility : ", ['size' => 11], $paragraphStyle);
    $textRun->addText("City Health Office", ['underline' => 'single','size' => 11], $paragraphStyle);

    // Date Field
    $textRun2 = $cellBottomLeft->addTextRun($paragraphStyle); // Apply spacing here
    $textRun2->addText("Date:", ['size' => 11], $paragraphStyle);
    $textRun2->addText($date, ['underline' => 'single','size' => 11], $paragraphStyle);

    // Time Field
    $textRun3 = $cellBottomLeft->addTextRun($paragraphStyle); // Apply spacing here
    $textRun3->addText("Time:", ['size' => 11], $paragraphStyle);
    $textRun3->addText($time, ['underline' => 'single','size' => 11], $paragraphStyle);

    // Add a line break at the end
    $cellBottomLeft->addTextBreak(1);

    $cellBottomLeft->addText("REFERRED FROM:", ['bold' => true, 'size' => 11]);
    $cellBottomLeft->addText("Facility: __________________", ['size' => 11], $paragraphStyle);
    $cellBottomLeft->addText("Date: ____________________", ['size' => 11], $paragraphStyle);
    $cellBottomLeft->addText("Time: ____________________", ['size' => 11], $paragraphStyle);
    $cellBottomLeft->addTextBreak(1);
    $cellBottomLeft->addText("ACCOMPLISH BY:", ['bold' => true, 'size' => 11]);
    $cellBottomLeft->addText("__________________________", ['size' => 11], $paragraphStyle);
    $cellBottomLeft->addText("  Printed Name and Signature", ['size' => 11]);


    // Right Column (Second Side)
    $cellRight = $table2->addCell(9000, ['valign' => 'top']); // Reduced width
    // Create an inner table for the layout inside the cell
    $innerTable = $cellRight->addTable();

    // Add a row to the inner table
    $innerTable->addRow();

    // Left cell for the left logo
    $cellLeftLogo = $innerTable->addCell(3000, ['valign' => 'center']);
    $cellLeftLogo->addImage(
        '../../../assets/images/scho.png', // Left logo path
        [
            'width' => 40,
            'height' => 40,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        ]
    );

    // Center cell for the text
    $cellCenterText = $innerTable->addCell(6000, ['valign' => 'center']); // Adjust width to your preference
    $cellCenterText->addText('Republic of the Philippines', ['size' => 10], ['spacing' => 0, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
    $cellCenterText->addText('Province of Negros Occidental', ['size' => 10], ['spacing' => 0, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
    $cellCenterText->addText('HEALTHCARE REFERRAL FORM', ['bold' => true, 'size' => 10], ['spacing' => 0, 'spaceAfter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

    // Right cell for the right logo
    $cellRightLogo = $innerTable->addCell(3000, ['valign' => 'center']);
    $cellRightLogo->addImage(
        '../../../assets/images/doh.jpg', // Right logo path
        [
            'width' => 40,
            'height' => 40,
            'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
        ]
    );



    $paragraphStyle1 = ['spacing' => 1.15, 'spaceAfter' => 1.15];
    
    // Add Patient Name Section
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("PATIENT NAME: ", ['size' => 11, 'bold' => true]); // Font size 11
    $textRun->addText("{$patientInfo['fname']} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText("{$patientInfo['mname']} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText("{$patientInfo['lname']} ", ['underline' => 'single', 'size' => 11]);
    
    // Add the calculated number of underscores
    $textRun->addText($underscores, ['size' => 11]);    

    // Add Age, Sex, and Birthdate
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("AGE: ", ['size' => 11, 'bold' => true]);
    $textRun->addText(" {$age} ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText(" SEX: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("  {$patientInfo['sex']}  ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText(" BIRTHDATE: ", ['size' => 11, 'bold' => true]);

    // Format birthdate
    $birthdate = new DateTime($patientInfo['birthdate']); // Assuming 'birthdate' is in 'YYYY-MM-DD' format
    $formattedBirthdate = $birthdate->format('F j, Y'); // Format as "Month Day, Year"
    $textRun->addText(" {$formattedBirthdate}     ", ['underline' => 'single', 'size' => 11]);
    $address = $patientInfo['address'].",".$patientInfo['purok'];
    // Add Address
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("ADDRESS: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("{$address}", ['underline' => 'single', 'size' => 11]);

    // Add Age, Sex, and Birthdate
    $textRun = $cellRight->addTextRun($paragraphStyle4); // Apply spacing here
    $textRun->addText("OCCUPATION: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("    {$patientInfo['occupation']}    ", ['underline' => 'single', 'size' => 11]);
    $textRun->addText(" RELIGION: ", ['size' => 11, 'bold' => true]);
    $textRun->addText("  {$patientInfo['religion']}     ", ['underline' => 'single', 'size' => 11]);
    
    $paragraphStyle6 = [
        'spacing' => 1.15,    // Line spacing
        'spaceAfter' => 120,  // Space after the line in twips
        'spaceBefore' => 120, // Space before the line in twips
    ];
    
  // Add Guardian information
  $textRun = $cellRight->addTextRun($paragraphStyle6); // Apply spacing here
  $textRun->addText("PARENT/GUARDIAN (In case of a minor): ", ['size' => 11, 'bold' => true]);
  $textRun->addText("     {$patientInfo['guardian']}     ", ['underline' => 'single', 'size' => 11]);
  
    

    // Add Chief Complaint section
    // Add Chief Complaint section with rectangle box
    $chiefComplaintTable = $cellRight->addTable();
    $chiefComplaintRow = $chiefComplaintTable->addRow();

    // Cell for "CHIEF COMPLAINT:" text (left side)
    $labelCell = $chiefComplaintRow->addCell(2000);
    $labelCell->addText("FINAL DIAGNOSIS:", ['bold' => true, 'size' => 11], $paragraphStyle);


    // Cell for rectangle box (right side)
    $boxCell = $chiefComplaintRow->addCell(7000, [
        'borderSize' => 1,         // Add border
        'borderColor' => '000000', // Black border
        'valign' => 'center',
        'height' => 600,          // Adjust height as needed
        'borderTopSize' => 10,     // Add top border
        'borderRightSize' => 10,   // Add right border
        'borderBottomSize' => 10,  // Add bottom border
        'borderLeftSize' => 10     // Add left border
    ]);
    $boxCell->addText("", $paragraphStyle); // Empty text to maintain the box shape

    $cellRight->addText("  ACTION                            OUTCOME:", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);
    $cellRight->addText("☐ Admitted                                   ☐ Recover          ☐Died", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);
    $cellRight->addText("☐ Consultation done                    ☐ Improved", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);
    $cellRight->addText("☐ Work-up Done                          ☐ Improved", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);
    $cellRight->addText("☐ Referred to higher center         ☐ Worsened", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);

    $cellRight->addTextBreak(1);
    $cellRight->addText("         MEDICATION DOSAGE DATE STARTED", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);
    $cellRight->addText("_____________________________________________________________", ['size' => 10] , ['spacing' => 0, 'spaceAfter' => 0]);



    // Save the document
    $fileName = "Referral_Form.docx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header("Content-Disposition: attachment; filename={$fileName}");
    header('Cache-Control: max-age=0');

    // Save the file directly to the output stream
    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');
    exit;
    } else {
        echo "Patient or history information not found.";
    }
} else {
    echo "Invalid request.";
}
