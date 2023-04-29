<?php
    if (substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == "doctorDash.php") {
        header("Location: index.php");
    }
    require ("connection.php");
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $query = "delete from token where ap_id = $id";
        if($conn->query($query)) {
            $query = "delete from appointments where id = $id";
            if($conn->query($query)) {
                header("Location: doctorDash.php");
            }
        }
    }
?>