<?php 
  $title = "Nursery";
  include_once('../../components/header.php');
  include_once('../../../controller/PatientController.php');
  
$referralSummary = $patientServices->getDataAnalysis();
      //////////////////////////////////// DISPLAY ALL THE PATIENTS /////////////////////////////////////
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
        <p><strong>Patient Table</strong> </p>

        <!-- Search Input -->
        <div class="mb-3 d-flex justify-content-between">
            <a type="button" class="btn btn-outline-warning" href="create.php">Create</a>
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Search for owner...">
        </div>
        
        <div class="table-responsive">
            <!-- Patient Table -->
            <table border="1" class="table" id="nurseryOwnersTable">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Birthdate</th>
                        <th>Civil Status</th>
                        <th>Sex</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php if (!empty($patients)): ?>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($patient['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($patient['phone_number']); ?></td>
                                <td><?php echo htmlspecialchars($patient['purok']); ?></td>
                                <td>
                                  <?php 
                                      // Assuming $patient['birthdate'] is in the format 'YYYY-MM-DD' (e.g., '2024-09-16')
                                      $birthdate = new DateTime($patient['birthdate']);
                                      echo $birthdate->format('F j, Y'); // Outputs: September 16, 2024
                                  ?>
                              </td>

                                <td><?php echo htmlspecialchars($patient['civil_status']); ?></td>
                                <td><?php echo htmlspecialchars($patient['sex']); ?></td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a class="btn btn-outline-info" href="update.php?PatientID=<?php echo htmlspecialchars($patient['patient_id']); ?>">Update</a>
                                        <button class="btn btn-outline-danger mx-1" data-id="<?php echo htmlspecialchars($patient['patient_id']); ?>" onclick="setDeleteId(this)">Delete</button>
                                        <a class="btn btn-outline-primary" href="patient_history.php?PatientID=<?php echo htmlspecialchars($patient['patient_id']); ?>">History</a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <!-- Pagination -->
            <nav>
                <ul class="pagination justify-content-center" id="pagination">
                    <!-- JavaScript will dynamically populate this -->
                </ul>
            </nav>
        </div>
       
    </div>

    <div class="table-responsive">
      <div class="card p-4 mt-4">
        <p><strong>Data Analysis this Year</strong></p>

        <div class="table-responsive">
          <!-- Table for referral summary -->
          <table border="1" class="table" id="referralSummaryTable">
            <thead>
              <tr>
                <th>Service</th>
                <th>Total Count</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($referralSummary)): ?>
                <?php foreach ($referralSummary as $row): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['total_count']); ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="2" class="text-center">No data available.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
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
    document.addEventListener("DOMContentLoaded", function () {
        const rowsPerPage = 10; // Adjust as needed
        const tableBody = document.getElementById("tableBody");
        const rows = Array.from(tableBody.rows); // Convert HTMLCollection to array
        const pagination = document.getElementById("pagination");
        const searchInput = document.getElementById("searchInput");
        let filteredRows = [...rows]; // Initially, all rows are included
        const totalRows = filteredRows.length;

        function renderTable(page) {
            // Clear the table body
            tableBody.innerHTML = "";

            // Calculate start and end indexes
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = Math.min(startIndex + rowsPerPage, filteredRows.length);

            // Append the relevant rows
            for (let i = startIndex; i < endIndex; i++) {
                tableBody.appendChild(filteredRows[i]);
            }
        }

        function renderPagination() {
            // Clear the pagination
            pagination.innerHTML = "";

            // Add pagination buttons
            const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement("li");
                li.className = "page-item" + (i === 1 ? " active" : "");
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener("click", function (e) {
                    e.preventDefault();

                    // Update active page
                    document.querySelectorAll(".page-item").forEach(item => item.classList.remove("active"));
                    li.classList.add("active");

                    // Render the corresponding page
                    renderTable(i);
                });

                pagination.appendChild(li);
            }
        }

        // Search functionality
        searchInput.addEventListener("input", function () {
            const query = searchInput.value.toLowerCase();

            // Filter rows based on the search query
            filteredRows = rows.filter(row => {
                return Array.from(row.cells).some(cell =>
                    cell.textContent.toLowerCase().includes(query)
                );
            });

            // Reinitialize pagination and table
            renderTable(1);
            renderPagination();
        });

        // Initialize table and pagination
        renderTable(1);
        renderPagination();
    });
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
