<?php 
$title = "Nursery";
include_once('../../components/header.php');
include_once('../../../controller/DashboardController.php');
?>

<!-- Create Admin Modal -->
<div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createAdminModalLabel">Create/Update Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="adminForm">
          <div class="mb-3">
            <label for="fullname" class="form-label">Fullname</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" required>
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye" id="eyeIcon"></i>
              </button>
            </div>
          </div>
          <input type="hidden" name="adminID" id="adminID" value="value">
          <input type="hidden" name="action" id="method" value="create">
          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAdminAccModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminAccModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAdminAccModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this owner?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="" method="POST">
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="adminID" id="admin_id"> <!-- Changed to hidden -->
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="p-3">
  <div class="card p-4">
    <p><strong>Admin Account Table</strong> </p>

    <!-- Search Input -->
    <div class="mb-3 d-flex justify-content-between">
      <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#createAdminModal">Create</button>
      <input type="text" id="searchInput" class="form-control w-50" placeholder="Search for owner...">
    </div>
    
    <div class="table-responsive">
      <!-- Table for nursery owners -->
      <table border="1" class="table" id="nurseryOwnersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($adminAccs)): ?>
            <?php foreach ($adminAccs as $adminAcc): ?>
              <tr>
                <td><?php echo htmlspecialchars($adminAcc['id']); ?></td>
                <td><?php echo htmlspecialchars($adminAcc['fullname']); ?></td>
                <td><?php echo htmlspecialchars($adminAcc['username']); ?></td>
                <td>
                  <?php 
                  if ($adminAcc['id'] != 1) { ?>
                      <button type='button' class='btn btn-outline-info mx-0 mx-md-2' 
                              data-bs-toggle='modal' 
                              data-bs-target='#createAdminModal' 
                              onclick='populateModal(<?php echo htmlspecialchars(json_encode($adminAcc)); ?>)'>Update</button>
                      <button type='button' class='btn btn-outline-danger mt-1 mt-md-0' 
                              data-id='<?php echo htmlspecialchars($adminAcc['id']); ?>' 
                              onclick='setDeleteAdminById(this)'>Delete</button>
                  <?php } ?>
              </td>

              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center">No records found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Button if no records are found -->
      <div id="noRecords" class="text-center mt-3" style="display: none;">
        <p>No results found.</p>
        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#createAdminModal">Create</button>
      </div>
    </div>
  </div>
</div>

<script>

document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    // Toggle the type attribute and icon
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.remove('bi-eye');
      eyeIcon.classList.add('bi-eye-slash');
    } else {
      passwordInput.type = 'password';
      eyeIcon.classList.remove('bi-eye-slash');
      eyeIcon.classList.add('bi-eye');
    }
  });

function populateModal(adminAcc) {
    document.getElementById('adminID').value = adminAcc.id; // Set the ID
    document.getElementById('fullname').value = adminAcc.fullname; // Set Fullname
    document.getElementById('username').value = adminAcc.username; // Set Username
    document.getElementById('password').value = adminAcc.password;; // Clear Password field (or set default if needed)
    document.getElementById('method').value = 'update'; // Set method to update
    document.getElementById('createAdminModalLabel').innerText = 'Update Admin'; // Change modal title
}
</script>

<?php include_once('../../components/footer.php'); ?>
