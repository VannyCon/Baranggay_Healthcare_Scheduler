<?php
require_once('../../../vendor/autoload.php'); // Load PHPWord

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Shared\Converter;

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Clear any previous output
if (ob_get_level()) ob_end_clean();

// Initialize PHPWord and create a new document
$phpWord = new PhpWord();

// Set up A4 page size and margins
$sectionStyle = [
    'orientation' => 'portrait',
    'pageSizeW'   => Converter::inchToTwip(8.27), // A4 width
    'pageSizeH'   => Converter::inchToTwip(11.69), // A4 height
    'marginTop'    => Converter::inchToTwip(0.5),
    'marginBottom' => Converter::inchToTwip(0.5),
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

// Left Column (First Side)
$cellLeft = $table->addCell(6000, ['valign' => 'top']); // Reduced width
$cellLeft->addText("REFERRED TO:", ['bold' => true, 'size' => 11]);
$cellLeft->addText("Facility: __________________", ['size' => 11]);
$cellLeft->addText("Date: ____________________", ['size' => 11]);
$cellLeft->addText("Time: ____________________", ['size' => 11]);
$cellLeft->addTextBreak(1);

$cellLeft->addText("REFERRED FROM:", ['bold' => true, 'size' => 11]);
$cellLeft->addText("Facility: __________________", ['size' => 11]);
$cellLeft->addText("Date: ____________________", ['size' => 11]);
$cellLeft->addText("Time: ____________________", ['size' => 11]);
$cellLeft->addTextBreak(1);

$cellLeft->addText("REASON FOR REFERRAL:", ['bold' => true, 'size' => 11]);
$cellLeft->addText("☐ Further evaluation and management", ['size' => 11]);
$cellLeft->addText("☐ For Work-up", ['size' => 11]);
$cellLeft->addText("☐ For Medico-Legal", ['size' => 11]);
$cellLeft->addText("☐ Isolation", ['size' => 11]);
$cellLeft->addText("☐ Patient's Request", ['size' => 11]);
$cellLeft->addText("☐ OPD Consult", ['size' => 11]);
$cellLeft->addText("☐ Others: _______________", ['size' => 11]);
$cellLeft->addTextBreak(1);

$cellLeft->addText("PHILHEALTH INFORMATION:", ['bold' => true, 'size' => 11]);
$cellLeft->addText("☐ PHIC ID No: __________________________", ['size' => 11]);
$cellLeft->addText("☐ Non-PHIC", ['size' => 11]);
$cellLeft->addTextBreak(2);

$cellLeft->addText("REFERRED BY:", ['bold' => true, 'size' => 11]);
$cellLeft->addText("Name: ____________________________", ['size' => 11]);
$cellLeft->addText("Designation: _____________________", ['size' => 11]);

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
$cellCenterText->addText('Republic of the Philippines', ['size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
$cellCenterText->addText('Province of Negros Occidental', ['size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
$cellCenterText->addText('HEALTHCARE REFERRAL FORM', ['bold' => true, 'size' => 10], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

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


$cellRight->addTextBreak(1);

$cellRight->addText("PATIENT NAME: _______________________________________", ['size' => 11]);
$cellRight->addText("AGE: _______ SEX: _______ BIRTHDATE: __________________", ['size' => 11]);
$cellRight->addText("ADDRESS: ____________________________________________", ['size' => 11]);
$textRun = $cellRight->addTextRun();
$textRun->addText("OCCUPATION: _____________", ['size' => 11]);
$textRun->addText("RELIGION: _________________", ['size' => 11]);
$cellRight->addText("PARENT/GUARDIAN (In case of a minor): ___________________", ['size' => 11]);
$cellRight->addTextBreak(0.5);

// Add Chief Complaint section
// Add Chief Complaint section with rectangle box
$chiefComplaintTable = $cellRight->addTable();
$chiefComplaintRow = $chiefComplaintTable->addRow();

// Cell for "CHIEF COMPLAINT:" text (left side)
$labelCell = $chiefComplaintRow->addCell(2000);
$labelCell->addText("CHIEF COMPLAINT:", ['bold' => true, 'size' => 11]);

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
$boxCell->addText(""); // Empty text to maintain the box shape
$cellRight->addTextBreak(1);


$briefHistory = $cellRight->addTable();
$briefHistoryRow = $briefHistory->addRow();

// Cell for "CHIEF COMPLAINT:" text (left side)
$labelCell = $briefHistoryRow->addCell(2500);
$labelCell->addText("BRIEF HISTORY ", ['bold' => true, 'size' => 10]);
$labelCell->addText("AND PERTINENT ", ['bold' => true, 'size' => 10]);
$labelCell->addText("P.E:", ['bold' => true, 'size' => 10]);

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
$vitalSignsRun0 = $boxCell->addTextRun();
$vitalSignsRun = $boxCell->addTextRun();
$vitalSignsRun->addText("   BP: _____", ['size' => 10]);
$vitalSignsRun->addText("   RR: _____", ['size' => 10]);
$vitalSignsRun->addText("   PR: _____", ['size' => 10]);
$vitalSignsRun->addText("   Temp: _____", ['size' => 10]);


$vitalSignsRun2 = $boxCell->addTextRun();
$vitalSignsRun2->addText("   Wt: _____", ['size' => 10]);
$vitalSignsRun2->addText("   Ht: _____", ['size' => 10]);
$vitalSignsRun2->addText("   Waist: _____", ['size' => 10]);
$vitalSignsRun2->addText("   O₂ Sat: _____", ['size' => 10]);

$cellRight->addTextBreak(1);

// Add Chief Complaint section
// Add Chief Complaint section with rectangle box
$impressionTable = $cellRight->addTable();
$impressionRow = $impressionTable->addRow();

// Cell for "CHIEF COMPLAINT:" text (left side)
$labelCell = $impressionRow->addCell(2000);
$labelCell->addText("IMPRESSION/  ", ['bold' => true, 'size' => 10]);
$labelCell->addText("DIAGNOSIS", ['bold' => true, 'size' => 10]);

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
$boxCell->addText(""); // Empty text to maintain the box shape
$cellRight->addTextBreak(1);

$cellRight->addText("ACTION TAKEN/TREATMENT/MEDICATION GIVEN", ['size' => 11]);
$cellRight->addText("         Medication        Dossage   Date Started    Time last dose given", ['size' => 11]);
$cellRight->addText("_______________________________________________________", ['size' => 11]);
$cellRight->addText("_______________________________________________________", ['size' => 11]);
$cellRight->addText("_______________________________________________________", ['size' => 11]);
$cellRight->addText("_______________________________________________________", ['size' => 11]);

// Save the document
$fileName = "Referral_Form.docx";
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header("Content-Disposition: attachment; filename={$fileName}");
header('Cache-Control: max-age=0');

// Save the file directly to the output stream
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');
exit;
