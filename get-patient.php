<?php
if (isset($_POST['data'])) {
    require ("connection.php");
    $query = "select e.id,e.ap_id,e.advice,a.complaint,a.p_id,p.name,e.doc_finding,DATE(a.created_at) as date,e.parameter 
                from ayushya.examine e 
                join ayushya.appointments a on e.ap_id = a.id
                join ayushya.patient p on p.id = a.p_id where e.ap_id = "
                .$_POST['data'];
    $result = $conn->query($query);
    $row=$result->fetch_assoc();
    $row["parameter"] = unserialize($row["parameter"]);
    echo json_encode($row);
}
else {
    echo 1;
}
?>