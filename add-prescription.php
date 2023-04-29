<!DOCTYPE html>
<html>


<?php
if (substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == "doctorDash.php") {
	header("Location: index.php");
}
require ("head.php");
?>

<body>
    <!-- Pre Loader -->
    <div class="loading">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!--/Pre Loader -->

    <nav class="navbar navbar-default">
        <div class="container-fluid nav d-flex justify-content-between">
            <!-- <ul class="" > -->
            <div>
                <li class="nav-item">
                    <div class="responsive-logo text-dark bg-dark">
                        <a href="index.html" class="text-dark p-3"><img src="images/logo.png" class="ayushya-logo"
                                alt="logo"></a>
                    </div>
                </li>
            </div>
            <div>
                <h1 class="">Prescription</h1>
            </div>
            <div>
                <li class="nav-item">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="ti-user"></span>
                    </a>
                    <div class="dropdown-menu proclinic-box-shadow2 profile animated flipInY">
                        <h5><?php  echo $_SESSION['name']; ?></h5>

                        <a class="dropdown-item" href="logout.php">
                            <span class="ti-power-off"></span> Logout</a>
                    </div>
                </li>
            </div>
            <!-- </ul> -->

        </div>
    </nav>
    <div class="wrapper">
        <div id="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                        if(isset($_GET["id"])) {
                            include("connection.php");
                            $appoint_id = $_GET["id"];
                            $row = array();
                            $query = "select e.*, p.name as patient_name, u.name as doctor_name 
                                        from examine e 
                                        join appointments a on a.id = e.ap_id 
                                        join patient p on a.p_id = p.id 
                                        join user u on a.doc_id = u.id 
                                        where e.ap_id = $appoint_id";
                            $result = $conn->query($query);
                            if($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                extract($row);
                                $parameter = unserialize($parameter);
                                extract($parameter);

                            } else {
                                $query = "select p.name as patient_name, u.name as doctor_name from appointments a join patient p on p.id = a.p_id join user u on u.id = a.doc_id where a.id = $appoint_id";
                                $result = $conn->query($query);
                                $row = $result->fetch_assoc();
                            }
                    ?>
                    <form method="POST" action="add-prescription-action.php" class="container bg-white mt-5 p-5" id="prescription-form">
                        <h1 class="mb-5 text-center"><?php echo $row["patient_name"]?></h1>
                        <div class="d-flex justify-content-between">
                            <p><?php echo "Doctor Name: ".$row["doctor_name"]; ?></p>
                            <p><?php echo "Date: ".date("d-m-Y"); ?></p>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="ap_id" id="ap_id" value="<?php echo $appoint_id?>">
                            <div class="d-flex justify-content-around border border-black p-2">
                                <div class="">
                                    <label for="bp"> Blood Pressure </label>
                                    <input type="text" name="bp" class="form-control w-25" id="bp" <?php if(isset($bp)) echo "value='".$bp."'";?>>
                                </div>
                                <div class="">
                                    <label for="hm"> Height </label>
                                    <input type="text" name="height" class="form-control w-25" id="height" <?php if(isset($height)) echo "value='".$height."'";?>>
                                </div>
                                <div class="">
                                    <label for="weight"> Weight </label>
                                    <input type="text" name="weight" class="form-control w-25" id="weight" <?php if(isset($weight)) echo "value='".$weight."'";?>>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="">
                                <label for="findings"> Finding's </label>
                                <textarea name="findings" id="findings" cols="100" class="form-control" rows="2"><?php if(isset($doc_finding)) echo $doc_finding;?></textarea>
                            </div>
                            <div class="">
                                <label for="advice"> Advice </label>
                                <textarea name="advice" id="advice" class="form-control" cols="100" rows="2"><?php if(isset($advice)) echo $advice;?></textarea>
                            </div>
                            <div class="">
                                <label for="followupdate"> Follow Up Date </label>
                                <input type="date" name="followupdate" class="form-control" id="f_u_date" value="<?php echo date('Y-m-d', strtotime($follow_up_date))?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <input type="submit" name="submit" class="btn btn-success w-25" value="Submit" id="submit-btn">
                            <input type="button" name="print" class="btn btn-primary w-25" value="Print" id="print-btn" disabled>
                            <button class="btn btn-danger" name="close" id="close-btn"><a href="in-patient.php?id=<?php echo $appoint_id?>">Close</a></button>
                        </div>
                    </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery Library-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Popper Library-->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap Library-->
    <script src="js/bootstrap.min.js"></script>
    <!-- morris charts -->
    <script src="charts/js/raphael-min.js"></script>
    <script src="charts/js/morris.min.js"></script>
    <script src="js/custom-morris.js"></script>

    <!-- Custom Script-->
    <script src="js/custom.js"></script>
</body>


</html>