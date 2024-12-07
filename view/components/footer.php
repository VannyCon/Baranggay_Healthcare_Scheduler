<footer class="py-1 px-2  mt-4">
  <ul class="nav justify-content-center border-bottom pb-3 mb-3">
    <p class="nav-item text-center">
      <small>This system made for capstone</small>
    </p>
  </ul>
  <p class="text-center text-body-secondary">© 2024</p>
</footer>
<script>
    // USE IN MODAL
    function setDeleteId(button) {
        var id = button.getAttribute('data-id');
        document.getElementById('patient_id').value = id;
        $('#deleteModal').modal('show');
    }
    function setHealthHistoryDeleteId(button) {
        var id = button.getAttribute('data-id');
        var patient_id = button.getAttribute('data-patient_id');
        document.getElementById('history_id').value = id;
        document.getElementById('patient_id').value = patient_id;
        $('#deleteModal').modal('show');
    }

    function setDeleteAdminById(button) {
        var id = button.getAttribute('data-id');
        console.log("ID to delete:", id);  // Debugging line to check the ID
        document.getElementById('admin_id').value = id;  // Set the value in the input
        $('#deleteAdminAccModal').modal('show');  // Show the modal
    }

    // USE IN SEARCH BAR
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#nurseryOwnersTable tbody tr');
        let hasResults = false;

        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            let rowContainsSearchTerm = false;

            // Loop through each cell in the row
            for (let i = 1; i < cells.length; i++) { // Start at 1 to skip ID column
                const cellValue = cells[i].textContent.toLowerCase();
                if (cellValue.includes(searchTerm)) {
                    rowContainsSearchTerm = true;
                    break;
                }
            }

            if (rowContainsSearchTerm) {
                row.style.display = '';
                hasResults = true;
            } else {
                row.style.display = 'none';
            }
        });

        // Show or hide the no records message
        const noRecords = document.getElementById('noRecords');
        noRecords.style.display = hasResults ? 'none' : 'block';
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>