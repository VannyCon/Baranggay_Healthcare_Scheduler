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
<a href="index.php" class="btn btn-danger my-2"> Back </a>
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
                        <input type="date" class="form-control" value="<?php echo htmlspecialchars($specificPatient['birthdate']); ?>" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" value="<?php echo htmlspecialchars($specificPatient['age']); ?>" id="age" name="age" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="purok" class="form-label">Purok</label>
                    <select class="form-select" name="purok" id="Purok" required>
                        <option value="" disabled selected>Select a Purok</option>
                        
                        <option value="Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental" <?php echo ($specificPatient['purok'] == 'Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental') ? 'selected' : ''; ?>>
                            Prk. Napungalan 1 Brgy. JonobJonob Escalante City Negros Occidental
                        </option>

                        <option value="Prk. Napungalan 2 Brgy. JonobJonob Escalante City Negros Occidental" <?php echo ($specificPatient['purok'] == 'Prk. Napungalan 2 Brgy. JonobJonob Escalante City Negros Occidental') ? 'selected' : ''; ?>>
                            Prk. Napungalan 2 Brgy. JonobJonob Escalante City Negros Occidental
                        </option>

                        <option value="So. Golden Rosary Brgy. JonobJonob Escalante City Negros Occidental" <?php echo ($specificPatient['purok'] == 'So. Golden Rosary Brgy. JonobJonob Escalante City Negros Occidental') ? 'selected' : ''; ?>>
                            So. Golden Rosary Brgy. JonobJonob Escalante City Negros Occidental
                        </option>

                        <option value="Habitat Homes Brgy. JonobJonob Escalante City Negros Occidental" <?php echo ($specificPatient['purok'] == 'Habitat Homes Brgy. JonobJonob Escalante City Negros Occidental') ? 'selected' : ''; ?>>
                            Habitat Homes Brgy. JonobJonob Escalante City Negros Occidental
                        </option>

                        <option value="Prk. Mahogany Brgy. JonobJonob Escalante City Negros Occidental" <?php echo ($specificPatient['purok'] == 'Prk. Mahogany Brgy. JonobJonob Escalante City Negros Occidental') ? 'selected' : ''; ?>>
                            Prk. Mahogany Brgy. JonobJonob Escalante City Negros Occidental
                        </option>

                        <option value="Prk. Sambag Brgy. JonobJonob Escalante City Negros Occidental" <?php echo ($specificPatient['purok'] == 'Prk. Sambag Brgy. JonobJonob Escalante City Negros Occidental') ? 'selected' : ''; ?>>
                            Prk. Sambag Brgy. JonobJonob Escalante City Negros Occidental
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Street</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['address']); ?>" id="address" name="address" required>
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
            </div>
        </div>
        <input type="hidden" name="action" value="update">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php include_once('../../components/footer.php'); ?>
