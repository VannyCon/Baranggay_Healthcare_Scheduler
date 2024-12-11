<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');

        //////////////////////////////////// CREATE PATIENT INFO AND HEALTH HISTORY  /////////////////////////////////////
?>

<div class="container mt-5">
<a href="index.php" class="btn btn-danger my-2"> Back </a>
    <h2 class="mb-4">Refferal Form</h2>
    <form action="" method="POST" id="createForm">

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

        <!-- Patient Information Section -->
        <div class="card mb-4">
            <div class="card-header">Patient Information</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>
                    <div class="col-md-4">
                        <label for="mname" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="mname" name="mname" required>
                    </div>
                    <div class="col-md-4">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required onchange="updateAge()">
                    </div>
                    <div class="col-md-6">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="province" class="form-label">Province</label>
                    <select class="form-select" name="province" id="Province" required>
                        <option value="" disabled selected>Select a Province</option>
                        <option value="Negros Occidental">Negros Occidental</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <select class="form-select" name="city" id="City" required>
                        <option value="" disabled selected>Select a City</option>
                        <option value="Escalante City">Escalante City</option>
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Barangay" class="form-label">Barangay</label>
                    <select class="form-select" name="baranggay" id="Barangay" required>
                        <option value="" disabled selected>Select a Barangay</option>
                        <option value="Brgy. JonobJonob">Brgy. JonobJonob</option>
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="purok" class="form-label">Purok</label>
                    <select class="form-select" name="purok" id="Purok" required>
                        <option value="" disabled selected>Select a Purok</option>
                        <option value="Prk. Napungalan 1">Prk. Napungalan 1</option>
                        <option value="Prk. Napungalan 2">Prk. Napungalan 2</option>
                        <option value="So. Golden Rosary">So. Golden Rosary</option>
                        <option value="Habitat Homes">Habitat Homes</option>
                        <option value="Prk. Mahogany">Prk. Mahogany</option>
                        <option value="Prk. Sambag">Prk. Sambag</option>
                    </select>
                </div>
                <!-- <div class="mb-3">
                    <label for="address" class="form-label">Street <span><small class="text-danger">(Optional)</small></span></label>
                    <input type="text" class="form-control" id="address" name="address">
                </div> -->
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Contact Number</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select class="form-select" id="civil_status" name="civil_status" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-select" id="sex" name="sex" required>
                            <option value="" selected disabled>Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" required>
                    </div>
                    <div class="col-md-6">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="guardian" class="form-label">Guardian <span class="text-danger">(optional)</span></label>
                        <input type="text" class="form-control" id="guardian" name="guardian">
                    </div>
                </div>
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
                    <input type="datetime-local" class="form-control" id="cho_schedule" name="cho_schedule" 
                    required>
                </div>
                <div class="mb-3">
                    <label for="name_of_attending_provider" class="form-label">Attending Provider</label>
                    <input type="text" class="form-control" id="name_of_attending_provider" name="name_of_attending_provider" 
                    value="Ms. Tessie Cuanan M.D" readonly >
                </div>
                <!-- <div class="mb-3">
                    <label for="nature_of_visit" class="form-label">Nature of Visit</label>
                    <input type="text" class="form-control" id="nature_of_visit" name="nature_of_visit" required>
                </div> -->
                <div class="mb-3">
                    <label for="type_of_consultation" class="form-label">Type of Consultation</label>
                    <input type="text" class="form-control" id="type_of_consultation" name="type_of_consultation" >
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <select class="form-select" id="diagnosis" name="diagnosis" required>
                        <option value="" disabled selected>Select a Diagnosis</option>
                        <option value="Hypertension">Hypertension</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Asthma">Asthma</option>
                        <option value="Pneumonia">Pneumonia</option>
                        <option value="Tuberculosis">Tuberculosis</option>
                        <option value="Bronchitis">Bronchitis</option>
                        <option value="Chronic Kidney Disease">Chronic Kidney Disease</option>
                        <option value="Cancer">Cancer</option>
                        <option value="Anemia">Anemia</option>
                        <option value="Influenza">Influenza</option>
                        <option value="Fever">Fever</option>
                        <option value="Dengue">Dengue</option>
                        <option value="Diarrhea">Diarrhea</option>
                        <option value="Vomiting">Vomiting</option>
                        <option value="Headache">Headache</option>
                        <option value="Stomach Ache">Stomach Ache</option>
                    </select>
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
        <input type="hidden" name="action" value="create">
        <!-- Submit Button -->
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#previewModal">
        Preview Referral Form
        </button>

    </form>
</div>


<!-- Add this modal for preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Preview Referral Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h6 class="border-bottom pb-2"><strong>Service</strong></h6>
              <p id="preview_refferal_for"></p>
          
            </div>
            <div class="col-12">
              <h6 class="border-bottom pb-2"><strong>Referral From</strong></h6>
              <p id="preview_refferal_from"></p>
            </div>
           
            
            <div class="col-12 mt-3">
              <h6 class="border-bottom pb-2">Patient Information</h6>
              <div class="row">
                <div class="col-md-4">
                  <p><strong>First Name:</strong> <span id="preview_fname"></span></p>
                </div>
                <div class="col-md-4">
                  <p><strong>Middle Name:</strong> <span id="preview_mname"></span></p>
                </div>
                <div class="col-md-4">
                  <p><strong>Last Name:</strong> <span id="preview_lname"></span></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Birthdate:</strong> <span id="preview_birthdate"></span></p>
                </div>
                <div class="col-md-6">
                  <p><strong>Age:</strong> <span id="preview_age"></span></p>
                </div>
              </div>
              <p><strong>Province:</strong> <span id="preview_province"></span></p>
              <p><strong>City:</strong> <span id="preview_city"></span></p>
              <p><strong>Barangay:</strong> <span id="preview_barangay"></span></p>
              <p><strong>Purok:</strong> <span id="preview_purok"></span></p>
              <p><strong>Contact Number:</strong> <span id="preview_phone_number"></span></p>
              <p><strong>Civil Status:</strong> <span id="preview_civil_status"></span></p>
              <p><strong>Sex:</strong> <span id="preview_sex"></span></p>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Religion:</strong> <span id="preview_religion"></span></p>
                </div>
                <div class="col-md-6">
                  <p><strong>Occupation:</strong> <span id="preview_occupation"></span></p>
                </div>
              </div>
              <p><strong>Guardian:</strong> <span id="preview_guardian"></span></p>

            <div class="col-12 mt-3">
              <h6 class="border-bottom pb-2">Vital Signs</h6>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Blood Pressure:</strong> <span id="preview_blood_pressure"></span></p>
                  <p><strong>Temperature:</strong> <span id="preview_temperature"></span> °C</p>
                </div>
                <div class="col-md-6">
                  <p><strong>Pulse Rate:</strong> <span id="preview_pulse_rate"></span> BPM</p>
                  <p><strong>Respiratory Rate:</strong> <span id="preview_respiratory_rate"></span></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Weight:</strong> <span id="preview_weight"></span> kg</p>
                </div>
                <div class="col-md-6">
                  <p><strong>Height:</strong> <span id="preview_height"></span> cm</p>
                </div>
              </div>
            </div>

            <div class="col-12 mt-3">
              <h6 class="border-bottom pb-2">Findings</h6>
              <p><strong>CHO Schedule:</strong> <span id="preview_cho_schedule"></span></p>
              <p><strong>Attending Provider:</strong> <span id="preview_name_of_attending_provider"></span></p>
              <p><strong>Type of Consultation:</strong> <span id="preview_type_of_consultation"></span></p>
              <p><strong>Diagnosis:</strong> <span id="preview_diagnosis"></span></p>
              <p><strong>Medication:</strong> <span id="preview_medication"></span></p>
              <p><strong>Laboratory Findings:</strong> <span id="preview_laboratory_findings"></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
        <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm Submit</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewButton = document.querySelector('[data-bs-target="#previewModal"]');
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    
    // Function to update the preview modal with the form values
    function updatePreviewModal() {
        // Referral Type
        const referralSelect = document.getElementById('refferal_for');
        document.getElementById('preview_refferal_for').textContent = referralSelect.options[referralSelect.selectedIndex].text;
        const referralFromSelect = document.getElementById('refferal_from');
        document.getElementById('preview_refferal_from').textContent = referralFromSelect.options[referralFromSelect.selectedIndex].text;
        // Patient Information
        document.getElementById('preview_fname').textContent = document.getElementById('fname').value;
        document.getElementById('preview_mname').textContent = document.getElementById('mname').value;
        document.getElementById('preview_lname').textContent = document.getElementById('lname').value;
        document.getElementById('preview_birthdate').textContent = document.getElementById('birthdate').value;
        document.getElementById('preview_age').textContent = document.getElementById('age').value;

        // Province, City, Barangay, Purok
        document.getElementById('preview_province').textContent = document.getElementById('Province').value;
        document.getElementById('preview_city').textContent = document.getElementById('City').value;
        document.getElementById('preview_barangay').textContent = document.getElementById('Barangay').value;
        document.getElementById('preview_purok').textContent = document.getElementById('Purok').value;

        document.getElementById('preview_phone_number').textContent = document.getElementById('phone_number').value;

        // Civil Status & Sex
        document.getElementById('preview_civil_status').textContent = document.getElementById('civil_status').value;
        document.getElementById('preview_sex').textContent = document.getElementById('sex').value;

        // Civil Status & Sex
        document.getElementById('preview_religion').textContent = document.getElementById('religion').value;
        document.getElementById('preview_occupation').textContent = document.getElementById('occupation').value;
        document.getElementById('preview_guardian').textContent = document.getElementById('guardian').value;
        // Vital Signs
        document.getElementById('preview_blood_pressure').textContent = document.getElementById('blood_pressure').value;
        document.getElementById('preview_temperature').textContent = document.getElementById('temperature').value;
        document.getElementById('preview_pulse_rate').textContent = document.getElementById('pulse_rate').value;
        document.getElementById('preview_respiratory_rate').textContent = document.getElementById('respiratory_rate').value;
        document.getElementById('preview_weight').textContent = document.getElementById('weight').value;
        document.getElementById('preview_height').textContent = document.getElementById('height').value;

        // Findings Section
        document.getElementById('preview_cho_schedule').textContent = document.getElementById('cho_schedule').value;
        document.getElementById('preview_name_of_attending_provider').textContent = document.getElementById('name_of_attending_provider').value;
        document.getElementById('preview_type_of_consultation').textContent = document.getElementById('type_of_consultation').value;
        document.getElementById('preview_diagnosis').textContent = document.getElementById('diagnosis').value;
        document.getElementById('preview_medication').textContent = document.getElementById('medication').value;
        document.getElementById('preview_laboratory_findings').textContent = document.getElementById('laboratory_findings').value;
    }

    // When the preview button is clicked, update the modal
    previewButton.addEventListener('click', function() {
        updatePreviewModal();
        previewModal.show();
    });

    // Optional: If you want to handle form submission after preview
    document.getElementById('confirmSubmit').addEventListener('click', function () {
        document.getElementById('createForm').submit();
    });// or whatever the submit button's id is
});

</script>
<script>
    function updateAge() {
        const birthdate = document.getElementById("birthdate").value;
        const ageInput = document.getElementById("age");

        if (birthdate) {
            const birthDateObj = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDateObj.getFullYear();
            const monthDifference = today.getMonth() - birthDateObj.getMonth();

            // Adjust age if the current month and day haven't reached the birth month and day
            if (
                monthDifference < 0 || 
                (monthDifference === 0 && today.getDate() < birthDateObj.getDate())
            ) {
                age--;
            }

            ageInput.value = age;
        } else {
            ageInput.value = ""; // Clear age if no birthdate is selected
        }
    }
</script>
<script>
  window.onload = function() {
    // Check if there is a success or error message in the URL
    <?php if (isset($_GET['success']) || isset($_GET['error'])) { ?>
      var myModal = new bootstrap.Modal(document.getElementById('statusModal'), {
        keyboard: false
      });
      myModal.show();  // Show the modal
    <?php } ?>
  };
</script>
<?php include_once('../../components/footer.php'); ?>
