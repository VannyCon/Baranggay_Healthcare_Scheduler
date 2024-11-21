<?php
$title = "Nursery History";
include_once('../../components/header.php');
include_once('../../../controller/PatientController.php');
include_once('../../../view/pages/patient/sms_modal.php');
if (session_status() === PHP_SESSION_NONE) {
  session_start();
} //////////////////////////////////// READ ALL THE PATIENT HISTORY /////////////////////////////////////
?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-outline-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this owner?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
          <input type="hidden" name="action" value="deleteHealthHistory">
          <input type="hidden" name="patient_id" id="patient_id">
          <input type="hidden" name="history_id" id="history_id">
          <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="p-3">

  <div class="card p-4">
    <div class="table-responsive">
      <script>
    var messageText = "<?= $_SESSION['status'] ?? ''; ?>";
    if (messageText) {
        Swal.fire({
            title: "Sent Successfully",
            text: messageText,
            icon: "success"
        });
        <?php unset($_SESSION['status']); ?>
    }

    var errorText = "<?= $_SESSION['error'] ?? ''; ?>";
    if (errorText) {
        Swal.fire({
            title: "Error!",
            text: errorText,
            icon: "error"
        });
        <?php unset($_SESSION['error']); ?>
    }
</script>

      <!-- Vital Signs Section -->
      <a href="index.php" class="btn btn-danger my-2"> Back </a>
      <div class="card mb-4">
        <div class="card-header">Patien Information</div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-12">
              <p class="text-success"><span class="text-dark">Fullname : </span><?php echo htmlspecialchars($specificPatient['fname'] . ' ' . $specificPatient['mname'] . ' ' . $specificPatient['lname']); ?></p>
              <p class="text-success"><span class="text-dark">Contact Number : </span><?php echo htmlspecialchars($specificPatient['phone_number']); ?></p>
              <p class="text-success"><span class="text-dark">Address : </span><?php echo htmlspecialchars($specificPatient['address']); ?></p>
              <p class="text-success"><span class="text-dark">Birthdate: </span><?php $formattedBirthdate = date('F d, Y', strtotime($specificPatient['birthdate'])); echo htmlspecialchars($formattedBirthdate);?></p>
              <p class="text-success"><span class="text-dark">Civil Status : </span><?php echo htmlspecialchars($specificPatient['civil_status']); ?></p>
              <p class="text-success"><span class="text-dark">Sex : </span><?php echo htmlspecialchars($specificPatient['sex']); ?></p>
            </div>
          </div>
        </div>
      </div>
      <h2>Patient History</h2>
      <!-- Vital Signs Section -->
      <a type="button" class="btn btn-warning my-2" href="createHealthStatus.php?PatientID=<?php echo htmlspecialchars($patientID); ?>">Create Health Status</a>
      <?php if (!empty($getHealthHistorys)): ?>
        <?php foreach ($getHealthHistorys as $getHealthHistory): ?>
          <div class="card mb-4">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <div>
                  Date: <?php
                        $date = new DateTime($getHealthHistory['history_date']);
                        echo htmlspecialchars($date->format('F j, Y g:i A'));
                        ?>
                </div>
                <div>
                  <button type="button" class="btn btn-outline-danger mt-1 mt-md-0" data-id="<?php echo htmlspecialchars($getHealthHistory['history_ids']); ?>" data-patient_id="<?php echo htmlspecialchars($patientID); ?>" onclick="setHealthHistoryDeleteId(this)">Delete</button>
                </div>

              </div>

            </div>

            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-6">
                  <p><strong>Vital Signs</strong></p>
                  <p class="text-success"><span class="text-dark">Blood Pressure : </span><?php echo htmlspecialchars($getHealthHistory['blood_pressure']); ?></p>
                  <p class="text-success"><span class="text-dark">Temperature (°C) : </span><?php echo htmlspecialchars($getHealthHistory['temperature']); ?></p>
                  <p class="text-success"><span class="text-dark">Pulse Rate (BPM) : </span><?php echo htmlspecialchars($getHealthHistory['pulse_rate']); ?></p>
                  <p class="text-success"><span class="text-dark">Respiratory Rate : </span><?php echo htmlspecialchars($getHealthHistory['respiratory_rate']); ?></p>
                  <p class="text-success"><span class="text-dark">Weight (kg) : </span><?php echo htmlspecialchars($getHealthHistory['weight']); ?></p>
                  <p class="text-success"><span class="text-dark">Height (cm) : </span><?php echo htmlspecialchars($getHealthHistory['height']); ?></p>
                </div>
                <div class="col-md-6">
                  <p><strong>Findings</strong></p>
                  <label for="cho_schedule" class="form-label">CHO Schedule</label>
                  <p class="text-success"><?php $formattedBirthdate = date('F d, Y - h:i A', strtotime($getHealthHistory['cho_schedule'])); echo htmlspecialchars($formattedBirthdate);?></p>
                  <label for="cho_schedule" class="form-label">Attending Provider</label>
                  <p class="text-success"><?php echo htmlspecialchars($getHealthHistory['name_of_attending_provider']); ?></p>
                  <label for="cho_schedule" class="form-label">Nature of Visit</label>
                  <p class="text-success"><?php echo htmlspecialchars($getHealthHistory['nature_of_visit']); ?></p>
                  <label for="cho_schedule" class="form-label">Type of Consultation</label>
                  <p class="text-success"><?php echo htmlspecialchars($getHealthHistory['type_of_consultation']); ?></p>
                  <label for="cho_schedule" class="form-label">Diagnosis</label>
                  <p class="text-success"><?php echo htmlspecialchars($getHealthHistory['diagnosis']); ?></p>
                  <label for="cho_schedule" class="form-label">Medicaiton</label>
                  <p class="text-success"><?php echo htmlspecialchars($getHealthHistory['medication']); ?></p>
                  <label for="cho_schedule" class="form-label">Laboratory Findings</label>
                  <p class="text-success"><?php echo htmlspecialchars($getHealthHistory['laboratory_findings']); ?></p>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-between my-2">
            <a class="btn btn-info mx-2 w-100" href="updateHealthStatus.php?HistoryID=<?php echo htmlspecialchars($getHealthHistory['history_ids']); ?>&PatientID=<?php echo htmlspecialchars($patientID); ?>">Update</a>
            <a class="btn btn-outline-primary mx-2 w-100" href="done.php?Hid=<?php echo htmlspecialchars($getHealthHistory['history_ids']); ?>&Pid=<?php echo htmlspecialchars($patientID); ?>">Print Referral</a>
            <a class="btn btn-primary mx-2 w-100" href="#" data-bs-toggle="modal" data-bs-target="#smsModal"
              data-history-id="<?php echo htmlspecialchars($getHealthHistory['history_ids']); ?>"
              data-patient-id="<?php echo htmlspecialchars($patientID); ?>"
              onclick="setSmsConfirmation(this)">Remind SMS</a>
          </div>
          <script>
            function setSmsConfirmation(button) {
              var historyID = button.getAttribute('data-history-id');
              var patientID = button.getAttribute('data-patient-id');

              // Update the SMS confirmation link in the modal
              var confirmButton = document.getElementById('confirmSmsSend');
              confirmButton.href = 'sms.php?Hid=' + historyID + '&Pid=' + patientID;
            }
          </script>

    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p>No Health History found. </p>

<?php endif; ?>



<!-- Button if no records are found -->
<div id="noRecords" class="text-center mt-3" style="display: none;">
  <p>No results found.</p>
  <a type="button" class="btn btn-outline-warning" href="create.php">Create</a>
</div>
  </div>
</div>

</div>



<?php include_once('../../components/footer.php'); ?>