<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');
    // Redirect to login if not logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: ../../../index.php");
        exit();
    }

        //////////////////////////////////// UPDATE PATIENT INFO ONLY NOT INCLUDE THE PATIENT HISTORY /////////////////////////////////////
?>
<div class="container mt-5">
<a href="patient.php" class="btn btn-danger my-2"> Back </a>
    <h2 class="mb-4">Patient Information Form</h2>
    <form action="" method="POST">
        <!-- Patient Information Section -->
        <div class="card mb-4">
            <div class="card-header">Patient Information</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['fname']); ?>" id="fname" name="fname" required>
                    </div>
                    <div class="col-md-4">
                        <label for="mname" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['mname']); ?>" id="mname" name="mname" required>
                    </div>
                    <div class="col-md-4">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['lname']); ?>" id="lname" name="lname" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" value="<?php echo htmlspecialchars($specificPatient['birthdate']); ?>" name="birthdate" required onchange="updateAge()">
                    </div>
                    <?php
                            // Assuming the patient's birthdate is stored in the $specificPatient['birthdate']
                            // The birthdate format is 'YYYY-MM-DD'

                            $birthdate = $specificPatient['birthdate'];  // e.g., '1990-05-15'

                            // Convert the birthdate string into a DateTime object
                            $birthDateObject = new DateTime($birthdate);

                            // Get the current date
                            $today = new DateTime('today');

                            // Calculate the age
                            $age = $birthDateObject->diff($today)->y;
                            ?>

                            <div class="col-md-6">
                                <label for="age" class="form-label">Age</label>
                                <!-- Display the calculated age -->
                                <input type="number" class="form-control" value="<?php echo htmlspecialchars($age); ?>" id="age" name="age" required readonly>
                            </div>

                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Province</label>
                    <select class="form-select" name="province" id="Province" required>
                        <option value="" disabled >Select a Province</option>
                        <option value="Negros Occidental" selected>Negros Occidental</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <select class="form-select" name="city" id="City" required>
                        <option value="" disabled selected>Select a City</option>
                        <option value="Escalante City" selected>Escalante City</option>
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Barangay" class="form-label">Barangay</label>
                    <select class="form-select" name="baranggay" id="Barangay" required>
                        <option value="" disabled selected>Select a Barangay</option>
                        <option value="Brgy. JonobJonob" selected>Brgy. JonobJonob</option>
                        
                    </select>
                </div>
                
                    <div class="mb-3">
                        <label for="purok" class="form-label">Purok</label>
                        <select class="form-select" name="purok" id="Purok" required>
                            <option value="" disabled <?php echo empty($specificPatient['purok']) ? 'selected' : ''; ?>>Select a Purok</option>
                            <option value="Prk. Napungalan 1" <?php echo $specificPatient['purok'] == 'Prk. Napungalan 1' ? 'selected' : ''; ?>>Prk. Napungalan 1</option>
                            <option value="Prk. Napungalan 2" <?php echo $specificPatient['purok'] == 'Prk. Napungalan 2' ? 'selected' : ''; ?>>Prk. Napungalan 2</option>
                            <option value="So. Golden Rosary" <?php echo $specificPatient['purok'] == 'So. Golden Rosary' ? 'selected' : ''; ?>>So. Golden Rosary</option>
                            <option value="Habitat Homes" <?php echo $specificPatient['purok'] == 'Habitat Homes' ? 'selected' : ''; ?>>Habitat Homes</option>
                            <option value="Prk. Mahogany" <?php echo $specificPatient['purok'] == 'Prk. Mahogany' ? 'selected' : ''; ?>>Prk. Mahogany</option>
                            <option value="Prk. Sambag" <?php echo $specificPatient['purok'] == 'Prk. Sambag' ? 'selected' : ''; ?>>Prk. Sambag</option>
                        </select>
                    </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Contact Number</label>
                    <input type="number" class="form-control" value="<?php echo htmlspecialchars($specificPatient['phone_number']); ?>" id="phone_number" name="phone_number" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select class="form-select" id="civil_status" name="civil_status" required>
                            <option value="" disabled>Select Status</option>
                            <option value="Single" <?php echo ($specificPatient['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option value="Married" <?php echo ($specificPatient['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                            <option value="Divorced" <?php echo ($specificPatient['civil_status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-select" id="sex" name="sex" required>
                            <option value="" disabled>Select Gender</option>
                            <option value="Male" <?php echo ($specificPatient['sex'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($specificPatient['sex'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" value="<?php echo htmlspecialchars($specificPatient['religion']); ?>" name="religion" required>
                    </div>
                    <div class="col-md-6">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" value="<?php echo htmlspecialchars($specificPatient['occupation']); ?>" name="occupation" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="guardian" class="form-label">Guardian <span class="text-danger">(optional)</span></label>
                        <input type="text" class="form-control" id="guardian" value="<?php echo htmlspecialchars($specificPatient['guardian']); ?>" name="guardian">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="update">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
<?php include_once('../../components/footer.php'); ?>
