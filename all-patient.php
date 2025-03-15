<!DOCTYPE html>
<html>


<?php
require('connection.php');
if (substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1) == "receptionist.php") {
	header("Location: index.php");
}
$query="select count(*) from patient";
$result = $conn->query($query);
$data= $result->fetch_array();
$patients = $data[0];

$query="select count(*) from token";
$result = $conn->query($query);
$data= $result->fetch_array();
$token = $data[0];

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
	
	<div class="wrapper">
		<!-- Sidebar -->
		<?php
		include_once ("recep-nav.php");
		?>
		<!-- /Sidebar -->
		<!-- Page Content -->
		<div id="content">
			<!-- Top Navigation -->
			<?php
				include_once ("top-nav.php");
			?>
			<!-- /Top Navigation -->
			<!-- Breadcrumb -->
			<!-- Page Title -->
			<div class="row no-margin-padding">
				<div class="col-md-6">
					<h3 class="block-title">Receptionist Dashboard</h3>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="index.html">
								<span class="ti-home"></span>
							</a>
						</li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
			<!-- /Page Title -->

			<!-- /Breadcrumb -->
			<!-- Main Content -->
			<div class="container-fluid">

                <div class="row">
                    <!-- Widget Item -->
                    <div class="col-md-12">
                        <div class="widget-area-2 proclinic-box-shadow">
                            <h3 class="widget-title">Patient Details</h3>
                            <div class="table-responsive mb-3">
                                <table id="tableId" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <!-- <th>Staff ID</th> -->
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>City</th>
                                            <th>Phone Number</th>
                                            <th>Gender</th>
											<th>Date of Birth</th>
											<th>Blood Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'connection.php';

                                        $query = "select * from patient";
                                        $result = $conn->query($query);
                                        $c = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $c . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['city'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['gender'] . "</td>";
                                            echo "<td>" . $row['dob'] . "</td>";
                                            echo "<td>" . $row['bloodgroup'] . "</td>";
                                            echo "<td><button type='button' id='{$row['id']}' class='btn btn-default btn btn-primary mt-3 mb-0  btnupdpatient'><span class='ti-pencil' onclick=></span> Edit</button>";
                                            echo "<button type='button' class='btn btn-danger ml-3 mt-3 mb-0 btndel'><a href='delete-patient.php?id={$row['id']}'><span class='ti-trash'></span> Delete</a></button></td>";
                                            echo "</tr>";

                                            $c++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center export-pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="ti-download"></span> csv</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="ti-printer"></span> print</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="ti-file"></span> PDF</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><span class="ti-align-justify"></span>
                                                Excel</a>
                                        </li>`
                                    </ul>
                                </nav>
                                <!-- /Export links-->
                            </div>
                        </div>
                    </div>
                    <!-- /Widget Item -->
                </div>
            </div>
		<!-- /Page Content -->
	</div>
	
	<!-- modal new patient -->
	<div class="modal proclinic-modal-lg" id="updatePatient" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lorvens">
			<div class="modal-content proclinic-box-shadow2">
				<div class="modal-header">
					<h5 class="modal-title">Update Patient</h5>
					<span class="ti-close" data-dismiss="modal" aria-label="Close" onclick="close1()">
					</span>
				</div>
				<div class="modal-body">
					<form method="POST" action="edit-patient.php">
					<div class="form-group">
							<label for="name"> Patient Id* </label>
							<input type="text" name="pid" class="form-control" id="pid" placeholder="Patient Id" hidden>
						</div>
						<div class="form-group">
							<label for="name"> Patient Name* </label>
							<input type="text" name="name" class="form-control" id="name" placeholder="Patient Name" required>
						</div>
						<div class="form-group">
							<label for="contact"> Patient Contact </label>
							<input type="text" name="contact" class="form-control" id="contact" placeholder="Patient Contact">
						</div>
						<div class="form-group">
							<label for="email"> Patient Email </label>
							<input type="email" name="email" class="form-control" id="email" placeholder="Patient Email">
						</div>
						<div class="form-group">
							<label for="city"> Patient City* </label>
							<input type="text" name="city" class="form-control" id="city" placeholder="Patient City" required>
						</div>
						<div class="form-group">
							<label for="gender"> Patient gender* </label>
							<div class="gender-control">
								<input type="radio" name="gender" id="male" value="Male" class="gender" required> Male
								<input type="radio" name="gender" id="female" value="Female"  class="gender"> Female
								<input type="radio" name="gender" id="other" value="Other"  class="gender"> Other
							</div>
						</div>
						<div class="form-group">
							<label for="DOB"> Birth Date </label>
							<input type="date" class="form-control" name="dob" id="DOB" >
						</div>
						<div class="form-group">
							<label for="BG"> Blood Group </label>
							<input type="text" class="form-control" id="BG" name="blood" placeholder="Blood Group">
						</div>
						<input type="Submit" class="btn btn-lorvens proclinic-bg" name="submit" value="Create Case">
				</div>
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
	<!-- jQuery Core -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Datatable  -->
	<script src="datatable/jquery.dataTables.min.js"></script>
    <script src="datatable/dataTables.bootstrap4.min.js"></script>
	<!-- Custom Script-->
	<script src="js/custom.js"></script>
    <script src="js/custom-datatables.js"></script>
</body>


<!-- Mirrored from www.konnectplugins.com/proclinic/Vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Mar 2023 05:55:43 GMT -->
</html>
