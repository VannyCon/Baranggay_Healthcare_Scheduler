<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');

    //////////////////////////////////// CREATE HEALTH HISTORY /////////////////////////////////////
?>

<div class="container mt-5">
    <h2 class="mb-4">Patient Information Form</h2>
    <a href="patient_history.php?PatientID=<?php echo htmlspecialchars($patientID); ?>" class="btn btn-danger my-2"> Back </a>
        
    <form action="" method="POST">
    <div class="card mb-4">
        <div class="card-header">Refferal</div>
            <div class="card-body">
            <label for="fname" class="form-label">Service</label>
            <select class="form-select mb-3" name="refferal_for" id="refferal_for" required>
                <option value="" disabled selected>Select a barangay service</option>
                <option value="DP">Dengue Prevention and Management</option>
                <option value="PR">Prenatal Referral</option>
                <option value="IP">Immunization Programs</option>
                <option value="MCH">Maternal and Child Health Services</option>
                <option value="NP">Nutrition Programs</option>
                <option value="HE">Health Education</option>
                <option value="BMC">Basic Medical Consultations</option>
                <option value="EHC">Environmental Health Campaigns</option>
                <option value="TBC">Tuberculosis Control</option>
                <option value="EFA">Emergency and First Aid Services</option>
                <option value="LP">Livelihood Programs</option>
                <option value="DPD">Disaster Preparedness</option>
                <option value="CBR">Community-Based Rehabilitation</option>
                <option value="SCP">Senior Citizen and PWD Assistance</option>
                <option value="MHS">Mental Health Support</option>
                <option value="CPS">Child Protection Services</option>
            </select>
            <label for="fname" class="form-label">Center</label>
              <select class="form-select" name="refferal_from" id="refferal_from" required>
                  <option value="" disabled selected>Select a Center</option>
                  <option value="JonobJonob Center">JonobJonob Center</option>
                  <option value="Habitat Center">Habitat Center</option>
              </select>
            </div>
        </div>
        <!-- Vital Signs Section -->
        <div class="card mb-4">
            <div class="card-header">Vital Signs</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="blood_pressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" required>
                    </div>
                    <div class="col-md-6">
                        <label for="temperature" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" id="temperature" name="temperature" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pulse_rate" class="form-label">Pulse Rate (BPM)</label>
                        <input type="number" class="form-control" id="pulse_rate" name="pulse_rate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                        <input type="number" class="form-control" id="respiratory_rate" name="respiratory_rate" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="weight" name="weight" required>
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" step="0.1" class="form-control" id="height" name="height" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Findings Section -->
        <div class="card mb-4">
            <div class="card-header">Findings</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="cho_schedule" class="form-label">CHO Schedule</label>
                    <input type="datetime-local" class="form-control" id="cho_schedule" name="cho_schedule" required>
                </div>
                <div class="mb-3">
                    <label for="name_of_attending_provider" class="form-label">Attending Provider</label>
                    <input type="text" class="form-control" id="name_of_attending_provider" name="name_of_attending_provider" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="nature_of_visit" class="form-label">Nature of Visit</label>
                    <input type="text" class="form-control" id="nature_of_visit" name="nature_of_visit" required>
                </div> -->
                <div class="mb-3">
                    <label for="type_of_consultation" class="form-label">Type of Consultation</label>
                    <input type="text" class="form-control" id="type_of_consultation" name="type_of_consultation" required>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="medication" class="form-label">Medication</label>
                    <textarea class="form-control" id="medication" name="medication" rows="3" ></textarea>
                </div>
                <div class="mb-3">
                    <label for="laboratory_findings" class="form-label">Laboratory Findings</label>
                    <textarea class="form-control" id="laboratory_findings" name="laboratory_findings" rows="3" ></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="createHealthStatus">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../../components/footer.php'); ?>
