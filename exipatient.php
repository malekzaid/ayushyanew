<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
if(isset($_POST['submit']))
{   
    require("connection.php");
    extract($_POST);

    $query="select * from patient where id= $id";
    $result = $conn->query($query);
    $data= $result->fetch_assoc();
    if(!empty($data)){
        $query2="insert into appointments(p_id,doc_id,complaint) values($id,3,'$complain')";
        $result2 = $conn->query($query2);   
        if($result2){
            $id=mysqli_insert_id($conn);
            $query3="insert into token(ap_id,status) values($id,'pending')";
            $result3 = $conn->query($query3); 
            echo "here";
            header("Location: index.php");
        }
        else{
            echo "here";
        }
    }
    else{
        echo "Patient Not Found";
    }
}
else{
    header("Location: index.php");
}
?>