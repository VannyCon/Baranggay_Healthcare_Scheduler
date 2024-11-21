<!-- SMS Confirmation Modal -->
<div class="modal fade" id="smsModal" tabindex="-1" role="dialog" aria-labelledby="smsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header text-black">
                <h5 class="modal-title" id="smsModalLabel"><span class="fa fa-send"></span> Remind Client via SMS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to remind this client via SMS?</p>
                <hr>
                <p class="text-muted text-center">
                    This will send a reminder to the patient regarding their health.<br><br>
                    Please confirm to proceed.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                <a id="confirmSmsSend" class="btn btn-success" onclick="sendSms(<?php echo $getHealthHistory['history_ids']; ?>, <?php echo $patientID; ?>)">Send Reminder</a>
            </div>
        </div>
    </div>
</div>

<script>
    function sendSms(historyId, patientId) {
        window.location.href = 'sms.php?Hid=' + historyId + '&Pid=' + patientId;
    }
</script>
