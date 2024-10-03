<?php
require_once("../../../connection/connection.php");

class PatientServices extends config {


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
            $query = "SELECT `id`, `patient_id`,CONCAT(`fname`, ' ', `mname`, ' ', `lname`) AS full_name,  `birthdate`, `address`, `phone_number`, `civil_status`, `sex` FROM `patient_info` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

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
                    f.cho_schedule, 
                    f.name_of_attending_provider, 
                    f.nature_of_visit, 
                    f.type_of_consultation, 
                    f.diagnosis, 
                    f.medication, 
                    f.laboratory_findings
                FROM 
                    vital_sign_tbl v
                JOIN 
                    findings_tbl f ON v.history_id_fk = f.history_id_fk
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
                        f.nature_of_visit, 
                        f.type_of_consultation, 
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
                        history_tbl h
                    LEFT JOIN 
                        findings_tbl f ON h.history_ids = f.history_id_fk
                    LEFT JOIN 
                        vital_sign_tbl v ON h.history_ids = v.history_id_fk
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
    

    public function getAllPatientById($patientID) {
        try {
             // Prepare the query
        $query = "SELECT 
                        pi.fname,
                        pi.mname,
                        pi.lname,
                        pi.birthdate,
                        pi.age,
                        pi.address,
                        pi.phone_number,
                        pi.civil_status,
                        pi.sex,
                        vs.blood_pressure,
                        vs.temperature,
                        vs.pulse_rate,
                        vs.respiratory_rate,
                        vs.weight,
                        vs.height,
                        f.cho_schedule,
                        f.name_of_attending_provider,
                        f.nature_of_visit,
                        f.type_of_consultation,
                        f.diagnosis,
                        f.medication,
                        f.laboratory_findings,
                        h.date,
                        h.created_by,
                        h.last_update
                    FROM 
                        patient_info AS pi
                    JOIN 
                        vital_sign_tbl AS vs ON pi.patient_id = vs.patient_id_fk
                    JOIN 
                        findings_tbl AS f ON pi.patient_id = f.patient_id_fk
                    JOIN 
                        history_tbl AS h ON pi.patient_id = h.patient_id_fk
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
        $fname, $mname, $lname, $birthdate, $age, $address, $phone_number, $civil_status, $sex, 
        $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
        $cho_schedule, $name_of_attending_provider, $nature_of_visit, $type_of_consultation, 
        $diagnosis, $medication, $laboratory_findings, $admin_name
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            $historyID = $this->generatehistoryID();

            // Generate patient ID (assuming this method exists in your class)
            $patientID = $this->generatePatientID();

            // Prepare the first query (patient_info)
            $patient_info_query = "INSERT INTO `patient_info`(`patient_id`, `fname`, `mname`, `lname`, `birthdate`, `age`, `address`, `phone_number`,`civil_status`, `sex`)
                                VALUES (:patientID, :fname, :mname, :lname, :birthdate, :age, :address, :phone_number, :civil_status, :sex)";
            $stmt1 = $this->pdo->prepare($patient_info_query);
            $stmt1->bindParam(':patientID', $patientID);
            $stmt1->bindParam(':fname', $fname);
            $stmt1->bindParam(':mname', $mname);
            $stmt1->bindParam(':lname', $lname);
            $stmt1->bindParam(':birthdate', $birthdate);
            $stmt1->bindParam(':age', $age);
            $stmt1->bindParam(':address', $address);
            $stmt1->bindParam(':phone_number', $phone_number);
            $stmt1->bindParam(':civil_status', $civil_status);
            $stmt1->bindParam(':sex', $sex);

            // Execute the first query
            $stmt1->execute();


                        // Prepare the fourth query (history_tbl)
            $history_query = "INSERT INTO `history_tbl`(`patient_id_fk`, `history_ids`, `date`, `created_by`, `last_update`)
            VALUES (:patientID, :historyID, NOW(), :admin_name, NOW())";
            $stmt2 = $this->pdo->prepare($history_query);
            $stmt2->bindParam(':historyID', $historyID);
            $stmt2->bindParam(':patientID', $patientID);
            $stmt2->bindParam(':admin_name', $admin_name);

            // Execute the fourth query
            $stmt2->execute();


            // Prepare the second query (vital_sign_tbl)
            $vital_sign_query = "INSERT INTO `vital_sign_tbl`(`patient_id_fk`, `history_id_fk`, `blood_pressure`, `temperature`, `pulse_rate`, `respiratory_rate`, `weight`, `height`)
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

            // Prepare the third query (findings_tbl)
            $findings_query = "INSERT INTO `findings_tbl`(`patient_id_fk`,`history_id_fk`, `cho_schedule`, `name_of_attending_provider`, `nature_of_visit`, `type_of_consultation`, `diagnosis`, `medication`, `laboratory_findings`)
                            VALUES (:patientID, :historyID, :cho_schedule, :name_of_attending_provider, :nature_of_visit, :type_of_consultation, :diagnosis, :medication, :laboratory_findings)";
            $stmt4 = $this->pdo->prepare($findings_query);
            $stmt4->bindParam(':patientID', $patientID);
            $stmt4->bindParam(':historyID', $historyID);
            $stmt4->bindParam(':cho_schedule', $cho_schedule);
            $stmt4->bindParam(':name_of_attending_provider', $name_of_attending_provider);
            $stmt4->bindParam(':nature_of_visit', $nature_of_visit);
            $stmt4->bindParam(':type_of_consultation', $type_of_consultation);
            $stmt4->bindParam(':diagnosis', $diagnosis);
            $stmt4->bindParam(':medication', $medication);
            $stmt4->bindParam(':laboratory_findings', $laboratory_findings);

            // Execute the third query
            $stmt4->execute();



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


    // UPDATE PATIENT
    public function update(
        $patientID, $fname, $mname, $lname, $birthdate, $age, $address, $phone_number, 
        $civil_status, $sex
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            

            // Prepare the first query (patient_info)
            $patient_info_query = "UPDATE `patient_info` 
                                SET `fname` = :fname, `mname` = :mname, `lname` = :lname, 
                                    `birthdate` = :birthdate, `age` = :age, 
                                    `address` = :address, `phone_number` = :phone_number, 
                                    `civil_status` = :civil_status, `sex` = :sex 
                                WHERE `patient_id` = :patientID";
            $stmt1 = $this->pdo->prepare($patient_info_query);
            $stmt1->bindParam(':patientID', $patientID);
            $stmt1->bindParam(':fname', $fname);
            $stmt1->bindParam(':mname', $mname);
            $stmt1->bindParam(':lname', $lname);
            $stmt1->bindParam(':birthdate', $birthdate);
            $stmt1->bindParam(':age', $age);
            $stmt1->bindParam(':address', $address);
            $stmt1->bindParam(':phone_number', $phone_number);
            $stmt1->bindParam(':civil_status', $civil_status);
            $stmt1->bindParam(':sex', $sex);

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

            // Prepare the delete query for patient_info
            $delete_patient_info_query = "DELETE FROM `patient_info` WHERE `patient_id` = :patientID";
            $stmt = $this->pdo->prepare($delete_patient_info_query);
            $stmt->bindParam(':patientID', $patientID);

            // Execute the delete query for patient_info
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

    // CREATE PATIENT
    public function createHealthStatus( 
        $patientID, $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
        $cho_schedule, $name_of_attending_provider, $nature_of_visit, $type_of_consultation, 
        $diagnosis, $medication, $laboratory_findings, $admin_name
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

            $historyID = $this->generatehistoryID();

                        // Prepare the fourth query (history_tbl)
            $history_query = "INSERT INTO `history_tbl`(`patient_id_fk`, `history_ids`, `date`, `created_by`, `last_update`)
            VALUES (:patientID, :historyID, NOW(), :admin_name, NOW())";
            $stmt1 = $this->pdo->prepare($history_query);
            $stmt1->bindParam(':historyID', $historyID);
            $stmt1->bindParam(':patientID', $patientID);
            $stmt1->bindParam(':admin_name', $admin_name);

            // Execute the fourth query
            $stmt1->execute();


            // Prepare the second query (vital_sign_tbl)
            $vital_sign_query = "INSERT INTO `vital_sign_tbl`(`patient_id_fk`, `history_id_fk`, `blood_pressure`, `temperature`, `pulse_rate`, `respiratory_rate`, `weight`, `height`)
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

            // Prepare the third query (findings_tbl)
            $findings_query = "INSERT INTO `findings_tbl`(`patient_id_fk`,`history_id_fk`, `cho_schedule`, `name_of_attending_provider`, `nature_of_visit`, `type_of_consultation`, `diagnosis`, `medication`, `laboratory_findings`)
                            VALUES (:patientID, :historyID, :cho_schedule, :name_of_attending_provider, :nature_of_visit, :type_of_consultation, :diagnosis, :medication, :laboratory_findings)";
            $stmt3 = $this->pdo->prepare($findings_query);
            $stmt3->bindParam(':patientID', $patientID);
            $stmt3->bindParam(':historyID', $historyID);
            $stmt3->bindParam(':cho_schedule', $cho_schedule);
            $stmt3->bindParam(':name_of_attending_provider', $name_of_attending_provider);
            $stmt3->bindParam(':nature_of_visit', $nature_of_visit);
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
    
    // CREATE PATIENT
    public function updateHealthStatus( 
        $historyID, $blood_pressure, $temperature, $pulse_rate, $respiratory_rate, $weight, $height, 
        $cho_schedule, $name_of_attending_provider, $nature_of_visit, $type_of_consultation, 
        $diagnosis, $medication, $laboratory_findings, $admin_name
    ) {
        try {
            // Begin the transaction
            $this->pdo->beginTransaction();

                        // Prepare the fourth query (history_tbl)
            $history_query = "UPDATE `history_tbl` SET`created_by`=:admin_name,`last_update`= NOW() WHERE history_ids = :historyID";
            $stmt1 = $this->pdo->prepare($history_query);
            $stmt1->bindParam(':historyID', $historyID);
            $stmt1->bindParam(':admin_name', $admin_name);

            // Execute the fourth query
            $stmt1->execute();


            // Prepare the second query (vital_sign_tbl)
            $vital_sign_query = "UPDATE `vital_sign_tbl` SET `blood_pressure`=:blood_pressure,`temperature`=:temperature,`pulse_rate`=:pulse_rate,`respiratory_rate`=:respiratory_rate,`weight`=:weight,`height`=:height WHERE history_id_fk = :historyID";
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

            // Prepare the third query (findings_tbl)
            $findings_query = "UPDATE `findings_tbl` SET `cho_schedule`=:cho_schedule,`name_of_attending_provider`=:name_of_attending_provider,`nature_of_visit`=:nature_of_visit,`type_of_consultation`=:type_of_consultation,`diagnosis`=:diagnosis,`medication`=:medication,`laboratory_findings`=:laboratory_findings WHERE history_id_fk = :historyID";
            $stmt3 = $this->pdo->prepare($findings_query);
            $stmt3->bindParam(':historyID', $historyID);
            $stmt3->bindParam(':cho_schedule', $cho_schedule);
            $stmt3->bindParam(':name_of_attending_provider', $name_of_attending_provider);
            $stmt3->bindParam(':nature_of_visit', $nature_of_visit);
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
}




?>
