<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');
    // Redirect to login if not logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: ../../../index.php");
        exit();
    }
?>
<div class="container mt-5">
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
                    <label for="address" class="form-label">Address</label>
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

        <!-- Vital Signs Section -->
        <div class="card mb-4">
            <div class="card-header">Vital Signs</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="blood_pressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['blood_pressure']); ?>" id="blood_pressure" name="blood_pressure" required>
                    </div>
                    <div class="col-md-6">
                        <label for="temperature" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" value="<?php echo htmlspecialchars($specificPatient['temperature']); ?>" id="temperature" name="temperature" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pulse_rate" class="form-label">Pulse Rate (BPM)</label>
                        <input type="number" class="form-control" value="<?php echo htmlspecialchars($specificPatient['pulse_rate']); ?>" id="pulse_rate" name="pulse_rate" required>
                    </div>
                    <div class="col-md-6">
                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                        <input type="number" class="form-control" value="<?php echo htmlspecialchars($specificPatient['respiratory_rate']); ?>" id="respiratory_rate" name="respiratory_rate" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.1" class="form-control" value="<?php echo htmlspecialchars($specificPatient['weight']); ?>" id="weight" name="weight" required>
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" step="0.1" class="form-control" value="<?php echo htmlspecialchars($specificPatient['height']); ?>" id="height" name="height" required>
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
                    <input type="datetime-local" class="form-control" value="<?php echo htmlspecialchars($specificPatient['cho_schedule']); ?>" id="cho_schedule" name="cho_schedule" required>
                </div>
                <div class="mb-3">
                    <label for="name_of_attending_provider" class="form-label">Attending Provider</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['name_of_attending_provider']); ?>" id="name_of_attending_provider" name="name_of_attending_provider" required>
                </div>
                <div class="mb-3">
                    <label for="nature_of_visit" class="form-label">Nature of Visit</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['nature_of_visit']); ?>" id="nature_of_visit" name="nature_of_visit" required>
                </div>
                <div class="mb-3">
                    <label for="type_of_consultation" class="form-label">Type of Consultation</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificPatient['type_of_consultation']); ?>" id="type_of_consultation" name="type_of_consultation" required>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required><?php echo htmlspecialchars($specificPatient['diagnosis']); ?></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="update">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php include_once('../../components/footer.php'); ?>
