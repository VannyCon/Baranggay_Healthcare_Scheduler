<?php
    $title = "Patient";
    include_once('../../components/header.php');
    include_once('../../../controller/PatientController.php');

    if(isset($_GET['Hid']) && isset($_GET['Pid'])){
        // Sanitize the ID parameter
        $historyID = $_GET['Hid'];
        $patientID = $_GET['Pid'];
    }else{
        header('Location: index.php');
        exit();
    }
?>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container p-2">
    <section class="vh-50">
        <div class="container py-2 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong text-center" style="border-radius: 1rem;">
                        <div class="card-body p-4 text-center">
                            <!-- Big Circular Check Mark -->
                            <div class="circle-check mb-4" style="margin: 0 auto; width: 100px; height: 100px; border-radius: 50%; background-color: #28a745; display: flex; justify-content: center; align-items: center;">
                                <i class="fas fa-check" style="font-size: 48px; color: white;"></i>
                            </div>

                            <h5 class="mb-4">Successfully Created, Please Download the Referral Form</h5>

                            <!-- Download Button -->
                            <a id="downloadButton" href="test.php?Hid=<?php echo htmlspecialchars($historyID); ?>&Pid=<?php echo htmlspecialchars($patientID); ?>" class="btn btn-primary w-100 mb-2" onclick="showSMSButton(event)">Download</a>

                            <!-- SMS Button (Initially Hidden) -->
                            <a id="smsButton" href="sms.php?Hid=<?php echo htmlspecialchars($historyID); ?>&Pid=<?php echo htmlspecialchars($patientID); ?>" class="btn btn-success w-100 mb-2" style="display: none;">Send SMS</a>

                            <a type="button" href="index.php" class="text-decoration-none my-2 text-danger">Go back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function showSMSButton(event) {
        // Prevent the default action to allow the process of switching buttons first
        event.preventDefault();

        // Hide the download button
        document.getElementById('downloadButton').style.display = 'none';

        // Show the SMS button
        document.getElementById('smsButton').style.display = 'block';

        // Redirect to the download link after 1 second (to ensure button visibility)
        setTimeout(function() {
            window.location.href = event.target.href;
        }, 1000);
    }
</script>

<?php include_once('../../components/footer.php'); ?>
