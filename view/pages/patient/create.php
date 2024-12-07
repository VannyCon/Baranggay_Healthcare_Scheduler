<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');

        //////////////////////////////////// CREATE PATIENT INFO AND HEALTH HISTORY  /////////////////////////////////////
?>

<div class="container mt-5">
<a href="index.php" class="btn btn-danger my-2"> Back </a>
    <h2 class="mb-4">Refferal Form</h2>
    <form action="" method="POST">

    <div class="card mb-4">
            <div class="card-header">Choose Refferal Type</div>
            <div class="card-body">
            <select class="form-select" name="refferal_for" id="refferal_for" required>
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
                    <label for="age" class="form-label">Address</label>
                    <select class="form-select" name="purok" id="Purok" required>
                        <option value="" disabled selected>Select a Purok</option>
                        <option value="Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental">Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental</option>
                        <option value="Prk. Napungalan 2 Brgy. JonobJonob Escalante City Negros Occidental">Prk. Napungalan 2 Brgy. JonobJonob Escalante City Negros Occidental</option>
                        <option value="So. Golden Rosary Brgy. JonobJonob Escalante City Negros Occidental">So. Golden Rosary Brgy. JonobJonob Escalante City Negros Occidental</option>
                        <option value="Habitat Homes Brgy. JonobJonob Escalante City Negros Occidental">Habitat Homes Brgy. JonobJonob Escalante City Negros Occidental</option>
                        <option value="Prk. Mahogany Brgy. JonobJonob Escalante City Negros Occidental">Prk. Mahogany Brgy. JonobJonob Escalante City Negros Occidental</option>
                        <option value="Prk. Sambag Brgy. JonobJonob Escalante City Negros Occidental">Prk. Sambag Brgy. JonobJonob Escalante City Negros Occidental</option>
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
        <input type="hidden" name="action" value="create">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Modal HTML (Bootstrap 5.3) -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
        if (isset($_GET['success'])) {
          echo "<div class='alert alert-success' role='alert'>" . htmlspecialchars($_GET['success']) . "</div>";
        }elseif (isset($_GET['error'])) {
            echo "<div class='alert alert-danger' role='alert'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
