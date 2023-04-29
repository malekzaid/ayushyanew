<?php
    if(isset($_POST["submit"])) {
        include("connection.php");
        extract($_POST);
        $parameter = array();
        if(isset($_POST["bp"])) {
            $parameter["bp"] = $_POST["bp"];
        }
        if(isset($_POST["height"])) {
            $parameter["height"] = $_POST["height"];
        }
        if(isset($_POST["weight"])) {
            $parameter["weight"] = $_POST["weight"];
        }
        $parameter = serialize($parameter);
        // $advice = str_replace("\n", "<br>", $advice);
        // $findings = str_replace("\n", "<br>", $findings);
        $query = "select * from examine where ap_id = $ap_id";
        $result = $conn->query($query);
        if($result->num_rows > 0) {
            $query = "update examine set parameter = '$parameter', doc_finding = '$findings', advice = '$advice', follow_up_date = '$followupdate' where ap_id = $ap_id";
            $conn->query($query);
        } else {
            $query = "insert into examine (ap_id, parameter, doc_finding, advice, follow_up_date) value ($ap_id, '$parameter', '$findings', '$advice', '$followupdate')";
            echo $query;
            $conn->query($query);
        }
        header("Location: in-patient.php?id=$ap_id");
    }
?>