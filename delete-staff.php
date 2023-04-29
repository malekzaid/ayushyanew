<?php
     require ("connection.php");
     if(isset($_GET["id"])) {
         $id = $_GET["id"];
         $query = "delete from user where id = $id";
         if($conn->query($query)) {
            header('Location: index.php');
         }
    }
?>