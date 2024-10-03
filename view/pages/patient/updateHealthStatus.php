<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');
?>

<div class="container mt-5">

    <h2 class="mb-4">Patient Information Form</h2>
    <form action="" method="POST">
        <a href="patient_history.php?PatientID=<?php echo htmlspecialchars($patientID); ?>" class="btn btn-danger my-2"> Back </a>
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
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['name_of_attending_provider']); ?>" id="name_of_attending_provider" name="name_of_attending_provider" required>
                </div>
                <div class="mb-3">
                    <label for="nature_of_visit" class="form-label">Nature of Visit</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['nature_of_visit']); ?>" id="nature_of_visit" name="nature_of_visit" required>
                </div>
                <div class="mb-3">
                    <label for="type_of_consultation" class="form-label">Type of Consultation</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($specificHistory['type_of_consultation']); ?>" id="type_of_consultation" name="type_of_consultation" required>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required><?php echo htmlspecialchars($specificHistory['diagnosis']); ?></textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="updateHealthStatus">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include_once('../../components/footer.php'); ?>
