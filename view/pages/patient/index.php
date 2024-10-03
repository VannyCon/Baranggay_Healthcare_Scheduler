<?php 
  $title = "Nursery";
  include_once('../../components/header.php');
  include_once('../../../controller/PatientController.php');
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
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="patient_id" id="patient_id">
          <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="p-3">
    
    <div class="card p-4">
    <!-- <a class="btn btn-outline-outline-danger m-2 " href="../dashboard/index.php" style="width: 150px"> Back </a> -->
    <p><strong>Patient Table</strong> </p>

    <!-- Search Input -->
    <div class="mb-3 d-flex justify-content-between">
        <a type="button" class="btn btn-outline-warning" href="create.php">Create</a>
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search for owner...">
        
    </div>
    <div class="table-responsive">
       <!-- Table for nursery owners -->
        <table border="1" class="table" id="nurseryOwnersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Birthdate</th>
                    <th>Civil Status</th>
                    <th>Sex</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($patients)): ?>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($patient['id']); ?></td>
                            <td><?php echo htmlspecialchars($patient['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($patient['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($patient['address']); ?></td>
                            <td><?php echo htmlspecialchars($patient['birthdate']); ?></td>
                            <td><?php echo htmlspecialchars($patient['civil_status']); ?></td>
                            <td><?php echo htmlspecialchars($patient['sex']); ?></td>
                            <td>
                                <a type="button" class="btn btn-outline-info mx-0 mx-md-2 " href="update.php?PatientID=<?php echo htmlspecialchars($patient['patient_id']); ?>">Update</a>
                                <button type="button" class="btn btn-outline-danger mt-1 mt-md-0" data-id="<?php echo htmlspecialchars($patient['patient_id']); ?>" onclick="setDeleteId(this)">Delete</button>
                                <a type="button" class="btn btn-outline-primary mx-0 mx-md-2 " href="update.php?PatientID=<?php echo htmlspecialchars($patient['patient_id']); ?>">History</a>
                            </td>

                            
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Button if no records are found -->
        <div id="noRecords" class="text-center mt-3" style="display: none;">
            <p>No results found.</p>
            <a type="button" class="btn btn-outline-warning" href="create.php">Create</a>
        </div>
        </div>
    </div>

    </div>
   


<?php include_once('../../components/footer.php'); ?>
