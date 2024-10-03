<?php 
  $title = "Nursery";
  include_once('../../components/header.php');
  include_once('../../../controller/DashboardController.php');
?>


<div class="p-3">
    
    <div class="card p-4">
    <!-- <a class="btn btn-outline-outline-danger m-2 " href="../dashboard/index.php" style="width: 150px"> Back </a> -->
    <p><strong>History Table</strong> </p>

    <!-- Search Input -->
    <div class="mb-3 d-flex justify-content-start">
        <input type="text" id="searchInput" class="form-control w-50 py-2" placeholder="Search for owner...">
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
                    <th>Diagnosis</th>
                    <th>Admin</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($historys)): ?>
                    <?php foreach ($historys as $history): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($history['patient_id']); ?></td>
                            <td><?php echo htmlspecialchars($history['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($history['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($history['address']); ?></td>
                            <td><?php echo htmlspecialchars($history['diagnosis']); ?></td>
                            <td><?php echo htmlspecialchars($history['admin_fullname']); ?></td>
                            <td><?php echo htmlspecialchars($history['history_date']); ?></td>
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
