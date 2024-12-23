<?php 
  $title = "Nursery";
  include_once('../../components/header.php');
  include_once('../../../controller/PatientController.php');
  
$referralSummary = $patientServices->getDataAnalysis();
$getDiagnosis = $patientServices->getDiagnosisData();
$getPurok = $patientServices->getPurokData();
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
    <h3><strong>Dashboard</strong></h3>
    <!-- Card for Data Graph -->
    <div class="card mb-3">
      <div class="card-header">Data Graph</div>
      <div class="card-body">
        <div class="row">
          <!-- Canvas for Higher Cases -->
          <div class="mt-2 col-12">
            <canvas id="higherCases"></canvas>
          </div>
          <!-- Canvas for Types of Diagnosis -->
          <div class="mt-2 col-12">
            <canvas id="typesDiagnosis"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Card for Data Analysis -->
    <div class="card mt-4">
      <div class="card-header">
        <strong>Data Analysis this Year</strong>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <!-- Table for Referral Summary -->
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


    document.addEventListener("DOMContentLoaded", function () {
        // Fetch Purok Data from PHP
        const purokData = <?php echo json_encode($getPurok); ?>;
        const purokLabels = purokData.map(item => item.purok);
        const purokCounts = purokData.map(item => parseInt(item.purok_count));

        // Fetch Diagnosis Data from PHP
        const diagnosisData = <?php echo json_encode($getDiagnosis); ?>;
        const diagnosisLabels = diagnosisData.map(item => item.diagnosis);
        const diagnosisCounts = diagnosisData.map(item => parseInt(item.diagnosis_count));

        // Create the Purok (Higher Cases) Line Chart
        const higherCasesCtx = document.getElementById('higherCases').getContext('2d');
        const higherCases = new Chart(higherCasesCtx, {
            type: 'line',
            data: {
                labels: purokLabels,
                datasets: [{
                    label: 'Higher Cases by Purok',
                    data: purokCounts,
                    backgroundColor: 'rgba(219, 31, 131, 0.2)', // Light pink
                    borderColor: 'rgba(219, 31, 131, 1)', // Dark pink
                    borderWidth: 2,
                    fill: true, // Fill under the line
                    tension: 0.3 // Smooth the line
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create the Diagnosis Cases Bar Chart
        const typesDiagnosisCtx = document.getElementById('typesDiagnosis').getContext('2d');
        const typesDiagnosis = new Chart(typesDiagnosisCtx, {
            type: 'line',
            data: {
                labels: diagnosisLabels,
                datasets: [{
                    label: 'Diagnosis Cases',
                    data: diagnosisCounts,
                    backgroundColor: 'rgba(219, 31, 34, 0.2)', // Light red
                    borderColor: 'rgba(219, 31, 34, 1)', // Dark red
                    borderWidth: 2,
                    fill: true // Fill under the bars
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });



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
