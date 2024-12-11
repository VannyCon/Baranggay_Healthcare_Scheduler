<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');
        //////////////////////////////////// UPDATE HEALTH HISTORY NOT INCLUDE PATIENT INFO /////////////////////////////////////
?>

<div class="container mt-5">

    <h2 class="mb-4">Patient Information Form</h2>
    <form action="" method="POST">
        <a href="patient_history.php?PatientID=<?php echo htmlspecialchars($patientID); ?>" class="btn btn-danger my-2"> Back </a>
        <div class="card mb-4">
            <div class="card-header">Choose Refferal Type</div>
            <div class="card-body">
            <label for="Services" class="form-label">Services</label>
            <select class="form-select" name="refferal_for" id="refferal_for" required>
                <option value="" disabled <?php echo empty($specificHistory['refferal_for']) ? 'selected' : ''; ?>>Select a barangay service</option>
                <option value="DP" <?php echo $specificHistory['refferal_for'] === 'DP' ? 'selected' : ''; ?>>Dengue Prevention and Management</option>
                <option value="PR" <?php echo $specificHistory['refferal_for'] === 'PR' ? 'selected' : ''; ?>>Prenatal Referral</option>
                <option value="IP" <?php echo $specificHistory['refferal_for'] === 'IP' ? 'selected' : ''; ?>>Immunization Programs</option>
                <option value="MCH" <?php echo $specificHistory['refferal_for'] === 'MCH' ? 'selected' : ''; ?>>Maternal and Child Health Services</option>
                <option value="NP" <?php echo $specificHistory['refferal_for'] === 'NP' ? 'selected' : ''; ?>>Nutrition Programs</option>
                <option value="HE" <?php echo $specificHistory['refferal_for'] === 'HE' ? 'selected' : ''; ?>>Health Education</option>
                <option value="BMC" <?php echo $specificHistory['refferal_for'] === 'BMC' ? 'selected' : ''; ?>>Basic Medical Consultations</option>
                <option value="EHC" <?php echo $specificHistory['refferal_for'] === 'EHC' ? 'selected' : ''; ?>>Environmental Health Campaigns</option>
                <option value="TBC" <?php echo $specificHistory['refferal_for'] === 'TBC' ? 'selected' : ''; ?>>Tuberculosis Control</option>
                <option value="EFA" <?php echo $specificHistory['refferal_for'] === 'EFA' ? 'selected' : ''; ?>>Emergency and First Aid Services</option>
                <option value="LP" <?php echo $specificHistory['refferal_for'] === 'LP' ? 'selected' : ''; ?>>Livelihood Programs</option>
                <option value="DPD" <?php echo $specificHistory['refferal_for'] === 'DPD' ? 'selected' : ''; ?>>Disaster Preparedness</option>
                <option value="CBR" <?php echo $specificHistory['refferal_for'] === 'CBR' ? 'selected' : ''; ?>>Community-Based Rehabilitation</option>
                <option value="SCP" <?php echo $specificHistory['refferal_for'] === 'SCP' ? 'selected' : ''; ?>>Senior Citizen and PWD Assistance</option>
                <option value="MHS" <?php echo $specificHistory['refferal_for'] === 'MHS' ? 'selected' : ''; ?>>Mental Health Support</option>
                <option value="CPS" <?php echo $specificHistory['refferal_for'] === 'CPS' ? 'selected' : ''; ?>>Child Protection Services</option>
            </select>
            <label for="center" class="form-label">Center</label>
              <select class="form-select" name="refferal_from" id="refferal_from" required>
                  <option value="" disabled selected>Select a Center</option>
                  <option value="JonobJonob Center" <?php echo $specificHistory['refferal_from'] === 'JonobJonob Center' ? 'selected' : ''; ?>>JonobJonob Center</option>
                  <option value="Habitat Center" <?php echo $specificHistory['refferal_from'] === 'Habitat Center' ? 'selected' : ''; ?>>Habitat Center</option>
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
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['blood_pressure']); ?>" id="blood_pressure" name="blood_pressure" required>
                    </div>
                    <div class="col-md-6">
                        <label for="temperature" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" value="<?php echo htmlspecialchars($specificHistory['temperature']); ?>" id="temperature" name="temperature" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pulse_rate" class="form-label">Pulse Rate (BPM)</label>
                        <input type="number" class="form-control" value="<?php echo htmlspecialchars($specificHistory['pulse_rate']); ?>" id="pulse_rate" name="pulse_rate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                        <input type="number" class="form-control" value="<?php echo htmlspecialchars($specificHistory['respiratory_rate']); ?>" id="respiratory_rate" name="respiratory_rate" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" value="<?php echo htmlspecialchars($specificHistory['weight']); ?>" id="weight" name="weight" required>
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" step="0.1" class="form-control" value="<?php echo htmlspecialchars($specificHistory['height']); ?>" id="height" name="height" required>
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
                    <input type="datetime-local" class="form-control" value="<?php echo htmlspecialchars($specificHistory['cho_schedule']); ?>" id="cho_schedule" name="cho_schedule" required>
                </div>
                <div class="mb-3">
                    <label for="name_of_attending_provider" class="form-label">Attending Provider</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['name_of_attending_provider']); ?>" id="name_of_attending_provider" name="name_of_attending_provider" readonly required>
                </div>

                <div class="mb-3">
                    <label for="type_of_consultation" class="form-label">Type of Consultation</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['type_of_consultation']); ?>" id="type_of_consultation" name="type_of_consultation" required>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <select class="form-select" id="diagnosis" name="diagnosis" required>
                        <option value="" disabled <?php echo empty($specificHistory['diagnosis']) ? 'selected' : ''; ?>>Select a Diagnosis</option>
                        <option value="Hypertension" <?php echo $specificHistory['diagnosis'] == 'Hypertension' ? 'selected' : ''; ?>>Hypertension</option>
                        <option value="Diabetes" <?php echo $specificHistory['diagnosis'] == 'Diabetes' ? 'selected' : ''; ?>>Diabetes</option>
                        <option value="Asthma" <?php echo $specificHistory['diagnosis'] == 'Asthma' ? 'selected' : ''; ?>>Asthma</option>
                        <option value="Pneumonia" <?php echo $specificHistory['diagnosis'] == 'Pneumonia' ? 'selected' : ''; ?>>Pneumonia</option>
                        <option value="Tuberculosis" <?php echo $specificHistory['diagnosis'] == 'Tuberculosis' ? 'selected' : ''; ?>>Tuberculosis</option>
                        <option value="Bronchitis" <?php echo $specificHistory['diagnosis'] == 'Bronchitis' ? 'selected' : ''; ?>>Bronchitis</option>
                        <option value="Chronic Kidney Disease" <?php echo $specificHistory['diagnosis'] == 'Chronic Kidney Disease' ? 'selected' : ''; ?>>Chronic Kidney Disease</option>
                        <option value="Cancer" <?php echo $specificHistory['diagnosis'] == 'Cancer' ? 'selected' : ''; ?>>Cancer</option>
                        <option value="Anemia" <?php echo $specificHistory['diagnosis'] == 'Anemia' ? 'selected' : ''; ?>>Anemia</option>
                        <option value="Influenza" <?php echo $specificHistory['diagnosis'] == 'Influenza' ? 'selected' : ''; ?>>Influenza</option>
                        <option value="Fever" <?php echo $specificHistory['diagnosis'] == 'Fever' ? 'selected' : ''; ?>>Fever</option>
                        <option value="Dengue" <?php echo $specificHistory['diagnosis'] == 'Dengue' ? 'selected' : ''; ?>>Dengue</option>
                        <option value="Diarrhea" <?php echo $specificHistory['diagnosis'] == 'Diarrhea' ? 'selected' : ''; ?>>Diarrhea</option>
                        <option value="Vomiting" <?php echo $specificHistory['diagnosis'] == 'Vomiting' ? 'selected' : ''; ?>>Vomiting</option>
                        <option value="Headache" <?php echo $specificHistory['diagnosis'] == 'Headache' ? 'selected' : ''; ?>>Headache</option>
                        <option value="Stomach Ache" <?php echo $specificHistory['diagnosis'] == 'Stomach Ache' ? 'selected' : ''; ?>>Stomach Ache</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="medication" class="form-label">Medication</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['medication']); ?>" id="medication" name="medication" >
                </div>
                <div class="mb-3">
                    <label for="laboratory_findings" class="form-label">Laboratory Findings</label>
                    <textarea class="form-control" id="laboratory_findings" name="laboratory_findings" rows="3" ><?php echo htmlspecialchars($specificHistory['laboratory_findings']); ?></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="updateHealthStatus">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../../components/footer.php'); ?>
