<?php 
  $title = "Nursery";
  include_once('../../components/header.php');
  include_once('../../../controller/PatientController.php');
?>

   <div class="p-3">
      <a class="btn btn-outline-danger m-2 " href="accounts.php" style="width: 150px"> Back </a>
        <div class="card mb-4">
       
            <div class="card-header">Create Admin</div>
              <div class="card-body">
                <form action="" method="post">
                  <div class="mb-3">
                      <label for="fullname" class="form-label">Fullname</label>
                      <input type="text" class="form-control" id="fullname" name="fullname" required>
                  </div>
                  <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="mb-3">
                      <label for="nature_of_visit" class="form-label">Password</label>
                      <input type="password" class="form-control" id="nature_of_visit" name="nature_of_visit" required>
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
              </div>
        </div>
    </div>
   


<?php include_once('../../components/footer.php'); ?>
