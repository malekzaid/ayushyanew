<?php
if(isset($_POST['submit']))
{
    require("connection.php");
    extract($_POST);

    if($gender == "Male") {
        $gender = 'M';
    } elseif ($gender == "Female") {
        $gender = 'F';
    } else {
        $gender = 'O';
    }

    // Insert patient data
    $query = "INSERT INTO patient(name, email, city, phone, gender, dob, bloodgroup) 
              VALUES('$name', '$email', '$city', '$contact', '$gender', '$dob', '$blood')";
    $result = $conn->query($query);

    if($result) {
        $last_id = mysqli_insert_id($conn);

        // Ensure doctor_id is set and valid
        if (!empty($doctor_id)) {
            $query2 = "INSERT INTO appointments(p_id, doc_id, complaint) 
                       VALUES($last_id, '$doctor_id', '$complain')";
            $result2 = $conn->query($query2);

            if($result2) {
                $appointment_id = mysqli_insert_id($conn);
                $query3 = "INSERT INTO token(ap_id, status) VALUES($appointment_id, 'pending')";
                $result3 = $conn->query($query3);

                if($result3) {
                    header("Location: printcard.php?id=$appointment_id&name=$name&gender=$gender&dob=$dob&contact=$contact&blood=$blood");
                    exit;
                }
            }
        } else {
            echo "Error: No doctor selected!";
        }
    }
}