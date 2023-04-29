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
	<!-- <div class="loading">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div> -->
	<!--/Pre Loader -->
	
	<nav class="navbar navbar-default">
		<div class="container-fluid nav d-flex justify-content-between">
			<!-- <ul class="" > -->
				<div>
					<li class="nav-item">
						<div class="responsive-logo text-dark bg-dark">
							<a href="index.html" class="text-dark p-3"><img src="images/logo.png" class="ayushya-logo" alt="logo"></a>
						</div>
					</li>			
				</div>
				<div>
					<li class="nav-item">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
							aria-haspopup="true" aria-expanded="false">
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
                    <div class="col-md-6">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">Patient Details</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                <?php
                                    if(isset($_GET["id"])) {
                                        require("connection.php");
                                        $id = $_GET["id"];
                                        $update_token = "update token set status = 1 where ap_id = $id";
                                        $conn->query($update_token);
                                        $query = "select p.id,p.name, p.dob, p.gender, p.address, p.phone, p.email, p.bloodgroup, t.id as token from patient p join appointments a on a.p_id = p.id join token t on a.id = t.ap_id where a.id = $id and t.status=1";
                                        // echo $query;
                                        $res = $conn->query($query);
                                        $row = $res->fetch_assoc();
                                        $pid=$row["id"];
                                        $tid=$row['token'];
                                ?>
                                    <tbody>
                                        <tr>											
                                            <td><strong>Token Number</strong></td>
                                            <td><?php
                                                echo $row["token"];
                                            ?></td>
                                        </tr>
                                        <tr>											
                                            <td><strong>Name</strong></td>
                                            <td><?php
                                                echo $row["name"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Blood Group</strong> </td>
                                            <td><?php
                                                echo ucfirst($row["bloodgroup"]);
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date Of Birth</strong> </td>
                                            <td><?php
                                                echo $row["dob"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Gender</strong></td>
                                            <td><?php
                                                if($row["gender"] == "M") {
                                                    echo "Male";
                                                } else {
                                                    echo "Female";
                                                }
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Address</strong></td>
                                            <td><?php
                                                echo $row["address"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone </strong></td>
                                            <td><?php
                                                echo $row["phone"];
                                            ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><?php
                                                echo $row["email"];
                                            ?></td>
                                        </tr>									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">Patient Visits</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    
                                    <thead>
                                        <tr>										
                                            <th>Doctor Name</th>
                                            <th>Visit Date</th>
                                            <th>Complaint</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "select distinct a.id as ap_id, u.name as doc_name, date(a.created_at) as visit_date, a.complaint as complaint from appointments a join patient u on a.p_id = u.id where a.p_id = $pid";
                                        $res = $conn->query($query);
                                        while($row = $res->fetch_assoc()) {
                                    ?>
                                        <?php echo "<tr>";?>
                                            <?php echo "<td>" . $row["doc_name"] . "</td>"?>
                                            <?php echo "<td>" . $row["visit_date"] . "</td>"?>
                                            <?php echo "<td>" . $row["complaint"] . "</td>"?>
                                            <?php $ap_id = $row["ap_id"]; echo "<td><button class='btn-success p-1' onclick='show_prev_visit($ap_id)'>Show</button></td></tr>"?>
                                            <?php        
                            }
                        ?>
                                    						
                                    </tbody>
                                </table>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-around mt-4">
                    <button class="btn btn-primary"><a href="add-prescription.php?id=<?php echo $id?>">Add Prescription</a></button>
                    <button class="btn btn-success"><a href="out-patient.php?id=<?php echo $tid?>">Check Out</a></button>
                </div>
            </div>            
        </div>
    </div>
    <?php
        }
    ?>
    <!-- modal Add Prescription -->
	<div class="modal proclinic-modal-lg" id="previous-appointment-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lorvens">
			<div class="modal-content proclinic-box-shadow2">
				<div class="modal-header">
					<h5 class="modal-title"><b id="patient_name"></b></h5>
					<span class="ti-close" data-dismiss="modal" aria-label="Close" onclick="close1()">
					</span>
				</div>
				<div class="modal-body ">
                    <div class="sub-head-modal d-flex justify-content-between">
                        <p>Appointment Date: <b id="prev_appoint_date"></b></p>
                        <p>Doctor Name: <b id="doctor_name"></b></p>
                    </div>
                    <div class="sub-head-modal d-flex justify-content-between">
                        <p>Appointment Id: <b id="prev_appoint_id"></b></p>
                    </div>
                    <div class="container d-flex p-2 justify-content-between mt-3">
                        <div class="border border-dark p-2">
                            <h5>Blood Pressure</h5>
                            <p><h3 id="bloodpressure"></h3></p>
                        </div>
                        <div class="border border-dark p-2">
                            <h5>Height</h5>
                            <p><h3 id="pheight"></h3></p>
                        </div>
                        <div class="border border-dark p-2">
                            <h5>Weight</h5>
                            <p><h3 id="pweight"></h3></p>
                        </div>
                    </div>
                    <div class="container p-2">
                        <div class="d-flex mt-3">
                            <h4><b>Complaint: </b></h4>
                            <h4 id="complaint"></h4>
                        </div>
                        <div class="d-flex mt-3">
                            <h4><b>Findings: </b></h4>
                            <h4 id="findings"></h4>
                        </div>
                        <div class="d-flex mt-3">
                            <h4><b>Advice: </b></h4>
                            <h4 id="advice"></h4>
                        </div>
                    </div>
					<input type="button" class="w-25 btn-danger p-1 mt-4" value="Close" id="prev_desc_modal">
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
