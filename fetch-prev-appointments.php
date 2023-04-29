<?php
    include("connection.php");

    if(isset($_POST["id"])) {
        $id = $_POST["id"];
        $query = "select a.id as ap_id, date(a.created_at) as date, p.name as patient_name, u.name as doctor_name, a.complaint as complaint, e.parameter as parameter, e.doc_finding as findings, e.advice as advice
                  from appointments a
                  join examine e on a.id = e.ap_id
                  join user u on a.doc_id = u.id
                  join patient p on p.id = a.p_id
                  where a.id = $id";

        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $row["parameter"] = unserialize($row["parameter"]);
        echo json_encode($row);
    }
?>