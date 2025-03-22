<?php
    // if (substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == "doctorDash.php") {
    //     header("Location: index.php");
    // }
    // require ("connection.php");
    // if(isset($_GET["id"])) {
    //     $id = $_GET["id"];
    //     $query = "delete from patient where id = $id";
    //     if($conn->query($query)){
    //         $query = "delete from token where ap_id = $id";
    //         if($conn->query($query)) {
    //             $query = "delete from appointments where p_id = $id";
    //             if($conn->query(query: $query)) {
    //                 header("Location: all-patient.php");
    //             }
    //         }
    //     }
        
    // }

    require("connection.php");

    if(isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        $conn->begin_transaction();

        try{ 
            $query4 = "delete from token 
                where ap_id in (select id from appointments 
                where p_id in (select id from patient where id = ?))";
            $stmt4 = $conn->prepare($query4);
            $stmt4->bind_param("i",$id);
            $stmt4->execute();

            $query3 = "delete from examine 
                where ap_id in (select id from appointments 
                where p_id in (select id from patient where id = ?))";
            $stmt3 = $conn->prepare($query3);
            $stmt3->bind_param("i",$id);
            $stmt3->execute();

            $query2 = "delete from appointments where p_id = ?";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("i", $id);
            $stmt2->execute();

            $query1 = "delete from patient where id = ?";
            $stmt1 = $conn->prepare($query1);
            $stmt1->bind_param("i",$id);
            $stmt1->execute();
            
            $conn->commit();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }

        $conn->close();
        header('Location: all-patient.php');
    } else {
        echo "Patient ID not provided.";
    }
?>