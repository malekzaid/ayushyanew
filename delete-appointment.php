<?php

require('connection.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $conn->begin_transaction();

    try{
        $query = 'delete from appointments where id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $conn->commit();
    }
    catch(Exception $e){
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
    header('Location: index.php');
} else {
    echo "Appointment Id not found.";
}