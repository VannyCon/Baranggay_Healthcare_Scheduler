<?php
require_once("../../../connection/connection.php");

class PatientServices extends config {

    // GENERATE CUSTOME PATIENT ID
    function generatePatientID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "PATIENTNUM-";
        
        // Get the current timestamp in microseconds
        $timestamp = microtime(true);
        
        // Generate a random number to add more uniqueness
        $randomNumber = mt_rand(100000, 999999);
        
        // Hash the timestamp and random number to create a unique identifier
        $uniqueHash = hash('sha256', $timestamp . $randomNumber);
        
        // Take the first 12 characters of the hash (or any desired length)
        $patientID = substr($uniqueHash, 0, 12);
        
        // Return the final patient ID with prefix
        return $prefix . strtoupper($patientID);
    }
    // GENERATE CUSTOME HISTORY ID
    function generatehistoryID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "HISTORY-";
        
        // Get the current timestamp in microseconds
        $timestamp = microtime(true);
        
        // Generate a random number to add more uniqueness
        $randomNumber = mt_rand(100000, 999999);
        
        // Hash the timestamp and random number to create a unique identifier
        $uniqueHash = hash('sha256', $timestamp . $randomNumber);
        
        // Take the first 12 characters of the hash (or any desired length)
        $historyID = substr($uniqueHash, 0, 5);
        
        // Return the final patient ID with prefix
        return $prefix . strtoupper($historyID);
    }
    
    // Example usage


    //READ ALL THE PATIENT
    public function getAllPatient() {
        try {
            $query = "SELECT `id`, `patient_id`,CONCAT(`fname`, ' ', `mname`, ' ', `lname`) AS full_name,  `birthdate`, `purok`, `phone_number`, `civil_status`, `sex`, `religion`,`occupation`, `guardian`  FROM `tbl_patient_info` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //Data Gathering and Analysis
    public function getDiagnosisData() {
        try {
            $query = "SELECT `diagnosis`, `diagnosis_count` FROM `view_diagnosis_count` WHERE 1;";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //Data Gathering and Analysis
    public function getPurokData() {
        try {
            $query = "SELECT `purok`, `purok_count` FROM `view_purok_count` WHERE 1;";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

        
    
    //Data Gathering and Analysis
    public function getDataAnalysis() {
        try {
            $query = "SELECT `service_name`, `total_count` 
                        FROM `referral_summary` 
                        WHERE 1 
                        ORDER BY `total_count` DESC;
                        ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // GET PATIENT HEALTH HISTORY BY "HISTORY ID"
    public function getPatientHistoryById($historyID) {
        try {
             // Prepare the query
        $query = "SELECT 
                        v.id AS vital_id, 
                        v.patient_id_fk, 
                        v.history_id_fk, 
                        v.blood_pressure, 
                        v.temperature, 
                        v.pulse_rate, 
                        v.respiratory_rate, 
                        v.weight, 
                        v.height, 
                        f.id AS findings_id, 
                        f.refferal_for,
                        f.refferal_from,
                        f.cho_schedule, 
                        f.name_of_attending_provider, 
                        f.type_of_consultation, 
                        f.diagnosis, 
                        f.medication, 
                        f.laboratory_findings, 
                        h.id AS history_id, 
                        h.history_ids,
                        h.date AS history_date, 
                        h.created_by AS history_created_by, 
                        h.last_update AS history_last_update
                    FROM 
                        tbl_vital_sign v
                    JOIN 
                        tbl_findings f ON v.history_id_fk = f.history_id_fk
                    JOIN 
                        tbl_history h ON v.history_id_fk = h.history_ids
                    WHERE 
                        v.history_id_fk = :historyID;
                ";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':historyID', $historyID);
            $stmt->execute();
    
            // Fetch the result
            $histroryInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if patient information is found
            if ($histroryInfo) {
                return $histroryInfo;
            } else {
                return null; // No patient found with the given ID
            }
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    // GET PATIENT HISTORY BY "PATIENT ID"
    public function getPatientHistory($patientID){
        try {
            $query = "SELECT 
                        h.id AS history_id, 
                        h.patient_id_fk, 
                        h.history_ids, 
                        h.date AS history_date, 
                        h.created_by, 
                        h.last_update,
                        f.cho_schedule, 
                        f.name_of_attending_provider, 
                        f.type_of_consultation, 
                        f.refferal_for, 
                        f.refferal_from, 
                        f.diagnosis, 
                        f.medication, 
                        f.laboratory_findings, 
                        v.blood_pressure, 
                        v.temperature, 
                        v.pulse_rate, 
                        v.respiratory_rate, 
                        v.weight, 
                        v.height
                    FROM 
                        tbl_history h
                    LEFT JOIN 
                        tbl_findings f ON h.history_ids = f.history_id_fk
                    LEFT JOIN 
                        tbl_vital_sign v ON h.history_ids = v.history_id_fk
                    WHERE 
                        h.patient_id_fk = :patientID";
                        
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':patientID', $patientID); // Bind the patient ID
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }   
    }
    
    // GET ALL THE PATIENT INFORMATION BY PATIENT ID
    public function getAllPatientById($patientID) {
        try {
             // Prepare the query
        $query = "SELECT 
                        pi.fname,
                        pi.mname,
                        pi.lname,
                        pi.birthdate,
                        pi.address,
                        pi.purok,
                        pi.phone_number,
                        pi.civil_status,
                        pi.sex,
                        pi.religion,
                        pi.occupation,
                        pi.guardian,
                        h.date,
                        h.created_by,
                        h.last_update
                    FROM 
                        tbl_patient_info AS pi
                    JOIN 
                        tbl_history AS h ON pi.patient_id = h.patient_id_fk
                    WHERE 
                        pi.patient_id = :patientID";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':patientID', $patientID);
            $stmt->execute();
    
            // Fetch the result
            $patientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if patient information is found
            if ($patientInfo) {
                return $patientInfo;
            } else {
                return null; // No patient found with the given ID
            }
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // GET SPECIFIC PATIENT BY ID
    public function getSpecificPatientById($patientID) {
        try {
             // Prepare the query
        $query = "SELECT 
                        pi.fname,
                        pi.mname,
                        pi.lname,
                        pi.birthdate,
                        pi.purok,
                        pi.address,
                        pi.phone_number,
                        pi.civil_status,
                        pi.sex,
                        pi.religion,
                        pi.occupation,
                        pi.guardian,
                        vs.blood_pressure,
                        vs.temperature,
                        vs.pulse_rate,
                        vs.respiratory_rate,
                        vs.weight,
                        vs.height,
                        f.refferal_for,
                        f.refferal_from,
                        f.cho_schedule,
                        f.name_of_attending_provider,
                        f.type_of_consultation,
                        f.diagnosis,
                        f.medication,
                        f.laboratory_findings,
                        h.date,
                        h.created_by,
                        h.last_update
                    FROM 
                        tbl_patient_info AS pi
                    JOIN 
                        tbl_vital_sign AS vs ON pi.patient_id = vs.patient_id_fk
                    JOIN 
                        tbl_findings AS f ON pi.patient_id = f.patient_id_fk
                    JOIN 
                        tbl_history AS h ON pi.patient_id = h.patient_id_fk
                    WHERE 
                        pi.patient_id = :patientID";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':patientID', $patientID);
            $stmt->execute();
    
            // Fetch the result
            $patientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Check if patient information is found
            if ($patientInfo) {
                return $patientInfo;
            } else {
                return null; // No patient found with the given ID
            }
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // CREATE PATIENT
    public function create(
        $refferal_for, $refferal_from, $fname, $mname, $lname, $birthdate, $purok, $address, $phone_number, $civil_status, $sex, $religion, $occupation, $guardian,
        $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
        $cho_schedule, $name_of_attending_provider, $type_of_consultation, 
        $diagnosis, $medication, $laboratory_findings, $admin_name
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            $historyID = $this->generatehistoryID();

            // Generate patient ID (assuming this method exists in your class)
            $patientID = $this->generatePatientID();

            // Prepare the first query (tbl_patient_info)
            $tbl_patient_info_query = "INSERT INTO `tbl_patient_info`(`patient_id`, `fname`, `mname`, `lname`, `birthdate`, `purok`, `address`, `phone_number`, `civil_status`, `sex`, `religion`, `occupation`, `guardian`)
                                VALUES (:patientID, :fname, :mname, :lname, :birthdate, :purok, :address, :phone_number, :civil_status, :sex, :religion, :occupation, :guardian)";
            $stmt1 = $this->pdo->prepare($tbl_patient_info_query);
            $stmt1->bindParam(':patientID', $patientID);
            $stmt1->bindParam(':fname', $fname);
            $stmt1->bindParam(':mname', $mname);
            $stmt1->bindParam(':lname', $lname);
            $stmt1->bindParam(':birthdate', $birthdate);
            $stmt1->bindParam(':purok', $purok);
            $stmt1->bindParam(':address', $address);
            $stmt1->bindParam(':phone_number', $phone_number);
            $stmt1->bindParam(':civil_status', $civil_status);
            $stmt1->bindParam(':sex', $sex);
            $stmt1->bindParam(':religion', $religion);
            $stmt1->bindParam(':occupation', $occupation);
            $stmt1->bindParam(':guardian', $guardian);


            // Execute the first query
            $stmt1->execute();


                        // Prepare the fourth query (tbl_history)
            $history_query = "INSERT INTO `tbl_history`(`patient_id_fk`, `history_ids`, `date`, `created_by`, `last_update`)
            VALUES (:patientID, :historyID, NOW(), :admin_name, NOW())";
            $stmt2 = $this->pdo->prepare($history_query);
            $stmt2->bindParam(':historyID', $historyID);
            $stmt2->bindParam(':patientID', $patientID);
            $stmt2->bindParam(':admin_name', $admin_name);

            // Execute the fourth query
            $stmt2->execute();


            // Prepare the second query (tbl_vital_sign)
            $vital_sign_query = "INSERT INTO `tbl_vital_sign`(`patient_id_fk`, `history_id_fk`, `blood_pressure`, `temperature`, `pulse_rate`, `respiratory_rate`, `weight`, `height`)
                                VALUES (:patientID, :historyID,  :blood_pressure, :temperature, :pulse_rate, :respiratory_rate, :weight, :height)";
            $stmt3 = $this->pdo->prepare($vital_sign_query);
            $stmt3->bindParam(':patientID', $patientID);
            $stmt3->bindParam(':historyID', $historyID);
            $stmt3->bindParam(':blood_pressure', $blood_pressure);
            $stmt3->bindParam(':temperature', $temperature);
            $stmt3->bindParam(':pulse_rate', $pulse_rate);
            $stmt3->bindParam(':respiratory_rate', $respiratory_rate);
            $stmt3->bindParam(':weight', $weight);
            $stmt3->bindParam(':height', $height);

            // Execute the second query
            $stmt3->execute();

            // Prepare the third query (tbl_findings)
            $findings_query = "INSERT INTO `tbl_findings`(`patient_id_fk`,`history_id_fk`, `refferal_for`, `refferal_from`, `cho_schedule`, `name_of_attending_provider`, `type_of_consultation`, `diagnosis`, `medication`, `laboratory_findings`)
                            VALUES (:patientID, :historyID, :refferal_for, :refferal_from, :cho_schedule, :name_of_attending_provider, :type_of_consultation, :diagnosis, :medication, :laboratory_findings)";
            $stmt4 = $this->pdo->prepare($findings_query);
            $stmt4->bindParam(':patientID', $patientID);
            $stmt4->bindParam(':historyID', $historyID);
            $stmt4->bindParam(':refferal_for', $refferal_for);
            $stmt4->bindParam(':refferal_from', $refferal_from);
            $stmt4->bindParam(':cho_schedule', $cho_schedule);
            $stmt4->bindParam(':name_of_attending_provider', $name_of_attending_provider);
            $stmt4->bindParam(':type_of_consultation', $type_of_consultation);
            $stmt4->bindParam(':diagnosis', $diagnosis);
            $stmt4->bindParam(':medication', $medication);
            $stmt4->bindParam(':laboratory_findings', $laboratory_findings);

            // Execute the third query
            $stmt4->execute();


            // Commit the transaction
            $this->pdo->commit();

            // Return success
            // Return patient ID and history ID
        return [
            'status' => true,
            'patientID' => $patientID,
            'historyID' => $historyID
        ];


        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // UPDATE PATIENT
    public function update(
        $patientID, $fname, $mname, $lname, $birthdate, $purok, $address, $phone_number, 
        $civil_status, $sex, $religion, $occupation, $guardian
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            

            // Prepare the first query (tbl_patient_info)
            $tbl_patient_info_query = "UPDATE `tbl_patient_info` 
                                SET `fname` = :fname, `mname` = :mname, `lname` = :lname, 
                                    `birthdate` = :birthdate,`address` = :address, `purok` = :purok, `phone_number` = :phone_number, 
                                    `civil_status` = :civil_status, `sex` = :sex , `religion` = :religion , `occupation` = :occupation , `guardian` = :guardian 
                                WHERE `patient_id` = :patientID";
            $stmt1 = $this->pdo->prepare($tbl_patient_info_query);
            $stmt1->bindParam(':patientID', $patientID);
            $stmt1->bindParam(':fname', $fname);
            $stmt1->bindParam(':mname', $mname);
            $stmt1->bindParam(':lname', $lname);
            $stmt1->bindParam(':birthdate', $birthdate);
            $stmt1->bindParam(':purok', $purok);
            $stmt1->bindParam(':address', $address);
            $stmt1->bindParam(':phone_number', $phone_number);
            $stmt1->bindParam(':civil_status', $civil_status);
            $stmt1->bindParam(':sex', $sex);
            $stmt1->bindParam(':religion', $religion);
            $stmt1->bindParam(':occupation', $occupation);
            $stmt1->bindParam(':guardian', $guardian);

            // Execute the first query
            $stmt1->execute();

            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // DELETE PATIENT
    public function delete($patientID) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            // Prepare the delete query for tbl_patient_info
            $delete_tbl_patient_info_query = "DELETE FROM `tbl_patient_info` WHERE `patient_id` = :patientID";
            $stmt = $this->pdo->prepare($delete_tbl_patient_info_query);
            $stmt->bindParam(':patientID', $patientID);

            // Execute the delete query for tbl_patient_info
            $stmt->execute();

            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage(); 
            return false;
        }
    }

    // CREATE PATIENT HEALTH HISTORY
    public function createHealthStatus( 
        $refferal_for, $refferal_from, $patientID, $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
        $cho_schedule, $name_of_attending_provider, $type_of_consultation, 
        $diagnosis, $medication, $laboratory_findings, $admin_name
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            $historyID = $this->generatehistoryID();

                        // Prepare the fourth query (tbl_history)
            $history_query = "INSERT INTO `tbl_history`(`patient_id_fk`, `history_ids`, `date`, `created_by`, `last_update`)
            VALUES (:patientID, :historyID, NOW(), :admin_name, NOW())";
            $stmt1 = $this->pdo->prepare($history_query);
            $stmt1->bindParam(':historyID', $historyID);
            $stmt1->bindParam(':patientID', $patientID);
            $stmt1->bindParam(':admin_name', $admin_name);

            // Execute the fourth query
            $stmt1->execute();


            // Prepare the second query (tbl_vital_sign)
            $vital_sign_query = "INSERT INTO `tbl_vital_sign`(`patient_id_fk`, `history_id_fk`, `blood_pressure`, `temperature`, `pulse_rate`, `respiratory_rate`, `weight`, `height`)
                                VALUES (:patientID, :historyID,  :blood_pressure, :temperature, :pulse_rate, :respiratory_rate, :weight, :height)";
            $stmt2 = $this->pdo->prepare($vital_sign_query);
            $stmt2->bindParam(':patientID', $patientID);
            $stmt2->bindParam(':historyID', $historyID);
            $stmt2->bindParam(':blood_pressure', $blood_pressure);
            $stmt2->bindParam(':temperature', $temperature);
            $stmt2->bindParam(':pulse_rate', $pulse_rate);
            $stmt2->bindParam(':respiratory_rate', $respiratory_rate);
            $stmt2->bindParam(':weight', $weight);
            $stmt2->bindParam(':height', $height);

            // Execute the second query
            $stmt2->execute();

            // Prepare the third query (tbl_findings)
            $findings_query = "INSERT INTO `tbl_findings`(`patient_id_fk`,`history_id_fk`,   `refferal_for`, `refferal_from`, `cho_schedule`, `name_of_attending_provider`, `type_of_consultation`, `diagnosis`, `medication`, `laboratory_findings`)
                            VALUES (:patientID, :historyID, :refferal_for, :refferal_from, :cho_schedule, :name_of_attending_provider, :type_of_consultation, :diagnosis, :medication, :laboratory_findings)";
            $stmt3 = $this->pdo->prepare($findings_query);
            $stmt3->bindParam(':patientID', $patientID);
            $stmt3->bindParam(':historyID', $historyID);
            $stmt3->bindParam(':refferal_for', $refferal_for);
            $stmt3->bindParam(':refferal_from', $refferal_from);
            $stmt3->bindParam(':cho_schedule', $cho_schedule);
            $stmt3->bindParam(':name_of_attending_provider', $name_of_attending_provider);
            $stmt3->bindParam(':type_of_consultation', $type_of_consultation);
            $stmt3->bindParam(':diagnosis', $diagnosis);
            $stmt3->bindParam(':medication', $medication);
            $stmt3->bindParam(':laboratory_findings', $laboratory_findings);

            // Execute the third query
            $stmt3->execute();



            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    // CREATE PATIENT HEALTH HISTORY
    public function updateHealthStatus( 
        $refferal_for,$refferal_from, $historyID, $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
        $cho_schedule, $name_of_attending_provider, $type_of_consultation, 
        $diagnosis, $medication, $laboratory_findings, $admin_name
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

                        // Prepare the fourth query (tbl_history)
            $history_query = "UPDATE `tbl_history` SET`created_by`=:admin_name,`last_update`= NOW() WHERE history_ids = :historyID";
            $stmt1 = $this->pdo->prepare($history_query);
            $stmt1->bindParam(':historyID', $historyID);
            $stmt1->bindParam(':admin_name', $admin_name);

            // Execute the fourth query
            $stmt1->execute();


            // Prepare the second query (tbl_vital_sign)
            $vital_sign_query = "UPDATE `tbl_vital_sign` SET `blood_pressure`=:blood_pressure,`temperature`=:temperature,`pulse_rate`=:pulse_rate,`respiratory_rate`=:respiratory_rate,`weight`=:weight,`height`=:height WHERE history_id_fk = :historyID";
            $stmt2 = $this->pdo->prepare($vital_sign_query);
            $stmt2->bindParam(':historyID', $historyID);
            $stmt2->bindParam(':blood_pressure', $blood_pressure);
            $stmt2->bindParam(':temperature', $temperature);
            $stmt2->bindParam(':pulse_rate', $pulse_rate);
            $stmt2->bindParam(':respiratory_rate', $respiratory_rate);
            $stmt2->bindParam(':weight', $weight);
            $stmt2->bindParam(':height', $height);

            // Execute the second query
            $stmt2->execute();

            // Prepare the third query (tbl_findings)
            $findings_query = "UPDATE `tbl_findings` SET `cho_schedule`=:cho_schedule, `refferal_for`=:refferal_for, `refferal_from`=:refferal_from, `name_of_attending_provider`=:name_of_attending_provider,`type_of_consultation`=:type_of_consultation,`diagnosis`=:diagnosis,`medication`=:medication,`laboratory_findings`=:laboratory_findings WHERE history_id_fk = :historyID";
            $stmt3 = $this->pdo->prepare($findings_query);
            $stmt3->bindParam(':historyID', $historyID);
            $stmt3->bindParam(':refferal_for', $refferal_for);
            $stmt3->bindParam(':refferal_from', $refferal_from);
            $stmt3->bindParam(':cho_schedule', $cho_schedule);
            $stmt3->bindParam(':name_of_attending_provider', $name_of_attending_provider);
            $stmt3->bindParam(':type_of_consultation', $type_of_consultation);
            $stmt3->bindParam(':diagnosis', $diagnosis);
            $stmt3->bindParam(':medication', $medication);
            $stmt3->bindParam(':laboratory_findings', $laboratory_findings);

            // Execute the third query
            $stmt3->execute();



            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // DELETE PATIENT HISTORY
    public function deleteHealthHistory($historyID) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            // Delete from tbl_history
            $historyTbl = "DELETE FROM `tbl_history` WHERE history_ids = :historyID";
            $stmt = $this->pdo->prepare($historyTbl);
            $stmt->bindParam(':historyID', $historyID);
            $stmt->execute();

            // Delete from tbl_findings
            $tbl_findings = "DELETE FROM `tbl_findings` WHERE history_id_fk = :historyID";
            $stmt1 = $this->pdo->prepare($tbl_findings);
            $stmt1->bindParam(':historyID', $historyID);
            $stmt1->execute();

            // Delete from tbl_vital_sign
            $tbl_vitals = "DELETE FROM `tbl_vital_sign` WHERE history_id_fk = :historyID";
            $stmt2 = $this->pdo->prepare($tbl_vitals);
            $stmt2->bindParam(':historyID', $historyID);
            $stmt2->execute();

            // Commit the transaction
            $this->pdo->commit();

            // Return success
            return true;

        } catch (PDOException $e) {
            // Rollback the transaction in case of error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}




?>
