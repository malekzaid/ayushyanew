<!DOCTYPE html>
<html>

<?php
require('connection.php');
if (substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1) == "doctorDash.php") {
	header("Location: index.php");
}
require("head.php");
$doc_id = $_SESSION['doc_id'];
?>

<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid nav d-flex justify-content-between">
			<div>
				<li class="nav-item">
					<div class="responsive-logo text-dark bg-dark">
						<a href="index.html" class="text-dark p-3"><img src="images/logo.png" class="ayushya-logo"
								alt="logo"></a>
					</div>
				</li>
			</div>
			<div>
				<li class="nav-item">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
						aria-expanded="false">
						<span class="ti-user"></span>
					</a>
					<div class="dropdown-menu proclinic-box-shadow2 profile animated flipInY">
						<h5><?php echo $_SESSION['name']; ?></h5>

						<a class="dropdown-item" href="logout.php">
							<span class="ti-power-off"></span> Logout</a>
					</div>
				</li>
			</div>
		</div>
	</nav>
	<div class="wrapper">
		<div id="content">
			<div class="container-fluid home">
				<div class="row">
					<!-- Widget Item -->
					<div class="col-md-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Next Appointments</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="appointments-table">
									<thead>
										<tr>
											<th id="sr-no-th">ID</th>
											<th id="patient-name-th">Patient Name</th>
											<th id="patient-complaint-th">Complaint</th>
											<th id="patient-status">Status</th>
											<th id="action-th">Actions</th>
										</tr>
									</thead>
									<tbody id="appointment-table-body">

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="widget-area-2 proclinic-box-shadow">
							<h3 class="widget-title">Previous Appointments</h3>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="appointments-table">
									<thead>
										<tr>
											<th id="sr-no-th">ID</th>
											<th id="Prev-patient-name-th">Patient Name</th>
											<th id="Prev-patient-complaint-th">Complaint</th>
											<th id="Prev-patient-status">Status</th>
											<th id="Prev-action-th">Actions</th>
										</tr>
									</thead>
									<tbody id="appointment-table-body2">
										<?php
										$query = "SELECT p.name,a.id as aid, tk.id, tk.status, a.complaint FROM `token` as tk left join appointments as a on tk.ap_id=a.id LEFT join patient as p on a.p_id=p.id where tk.status!=0 and a.doc_id = " . $doc_id . " order by tk.id desc";
										$result = $conn->query($query); 
										while ($row = $result->fetch_assoc()) {
											?>
											<tr>
												<td>
													<?= $row['id'] ?>
												</td>
												<td>
													<?= $row['name'] ?>
												</td>
												<td>
													<?= $row['complaint'] ?>
												</td>
												<td>
													<?= $row['status'] == '1' ? "Consulting" : 'Completed' ?>
												</td>
												<td>
													<?php
													if ($row['status'] == 'pending') {
														?><button type="button" class="examine btn btn-success" id="<?= $row['aid'] ?>"><a
																href="in-patient.php?id=<?= $row['aid'] ?>"> Add
																Examination</a></button>
														<?php
													} else {
														?><button type="button" class="view btn btn-success" id="<?= $row['aid'] ?>"> View Details</button>
														<?php
													}
													?>
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	
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

	<a id="back-to-top" href="#" class="back-to-top">
		<span class="ti-angle-up"></span>
	</a>
	<!-- /Back to Top -->



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


<!-- Mirrored from www.konnectplugins.com/proclinic/Vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2023 05:55:43 GMT -->

</html>