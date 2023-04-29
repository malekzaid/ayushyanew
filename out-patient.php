<?php
    include("connection.php");
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $query = "update token set status = 2 where id = $id";
        $conn->query($query);
        header("Location: index.php");
    }
?>