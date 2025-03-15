<?php
require("connection.php");
if (isset($_POST['submit'])) {
    extract($_POST);
    
    // Convert gender value
    if ($gender == "Male") {
        $gender = 'M';
    } else if ($gender == "Female") {
        $gender = 'F';
    } else {
        $gender = 'O';
    }

    // Fix: Wrap string values in single quotes
    $sql = "UPDATE patient SET 
        name='$name',
        phone='$contact',
        email='$email', 
        city='$city',
        dob='$dob',
        gender='$gender',
        bloodgroup='$blood',
        updated_at=current_timestamp()
        WHERE id = $pid";

    $result = $conn->query($sql);

    if ($result) {
        header("Location: all-patient.php");
    } else {
        echo "Error: " . $conn->error; // Show SQL error
    }
} else {
    header("Location: all-patient.php");
}
?>
