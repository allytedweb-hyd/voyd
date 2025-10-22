<?php
include 'includes/header.php';
include 'includes/db.php';

$Vendors = mysqli_query($conn, "SELECT * FROM vendor WHERE status!=0");
$getVendors = mysqli_num_rows($Vendors);

$Brands = mysqli_query($conn, "SELECT * FROM brand_master WHERE status=1");
$getBrands = mysqli_num_rows($Brands);



$Project = mysqli_query($conn, "SELECT * FROM gallery WHERE status=1");
$getProjects = mysqli_num_rows($Project);

$Products = mysqli_query($conn, "SELECT * FROM products WHERE status=1");
$getProducts = mysqli_num_rows($Products);


$Leads = mysqli_query($conn, "SELECT * FROM leads WHERE status=1");
$getLeads = mysqli_num_rows($Leads);

$Customer = mysqli_query($conn, "SELECT * FROM customer WHERE status=1");
$getCustomers = mysqli_num_rows($Customer);


$Designer = mysqli_query($conn, "SELECT * FROM designers WHERE status=1");
$getDesigners = mysqli_num_rows($Designer);


?>
<!--end header -->
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
		
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Brands</p>
							<h5><?php echo $getBrands; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage2.png" alt="">
						</div>
					</div>
				</div>
			</div>
				<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Customers</p>
							<h5><?php echo $getCustomers; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage1.png" alt="">
						</div>
					</div>
				</div>
			</div>
				<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Designers</p>
							<h5><?php echo $getDesigners; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage4.png" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Leads</p>
							<h5><?php echo $getLeads; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage3.png" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Projects</p>
							<h5><?php echo $getProjects; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage3.png" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Products</p>
							<h5><?php echo $getProducts; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage4.png" alt="">
						</div>
					</div>
				</div>
			</div>
				<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Vendors</p>
							<h5><?php echo $getVendors; ?></h5>
						</div>
						<div class="dbImg">
							<img src="assets/images/dbImage2.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div><!--end row-->

		<!-- <div class="row">
						<div class="col-12 col-lg-12 col-xl-6">
						  <div class="card radius-10">
							<div class="card-body dbCards">
								<div class="d-flex align-items-center mb-3">
									<div>
										<h5 class="mb-0">Selling Region</h5>
									</div>
									<div class="dropdown options ms-auto">
										<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
											<i class='bx bx-dots-horizontal-rounded'></i>
										</div>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="javascript:;">Action</a></li>
											<li><a class="dropdown-item" href="javascript:;">Another action</a></li>
											<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
										</ul>
									</div>
								</div>
							 <div id="dashboard-map" style="height: 335px;"></div>
							</div>
							<div class="table-responsive">
							   <table class="table table-hover align-items-center mb-0">
								  <thead class="table-light">
									 <tr>
										 <th>Country</th>
										 <th>Income</th>
										 <th>Trend</th>
									 </tr>
								 </thead>
								 <tbody>
									 <tr>
										 <td><i class="flag-icon flag-icon-ca me-2"></i> USA</td>
										 <td>$4,586</td>
										 <td><span id="trendchart1"></span></td>
									 </tr>
									 <tr>
										 <td><i class="flag-icon flag-icon-us me-2"></i>Canada</td>
										 <td>$2,089</td>
										 <td><span id="trendchart2"></span></td>
									 </tr>
				   
									 <tr>
										 <td><i class="flag-icon flag-icon-in me-2"></i>India</td>
										 <td>$3,039</td>
										 <td><span id="trendchart3"></span></td>
									 </tr>
				   
									 <tr>
										 <td><i class="flag-icon flag-icon-gb me-2"></i>UK</td>
										 <td>$2,309</td>
										 <td><span id="trendchart4"></span></td>
									 </tr>
				   
									 <tr>
										 <td><i class="flag-icon flag-icon-de me-2"></i>Germany</td>
										 <td>$7,209</td>
										 <td><span id="trendchart5"></span></td>
									 </tr>
									 
								 </tbody>
							 </table>
							 </div>
						  </div>
						</div>
						
						<div class="col-12 col-lg-12 col-xl-6">
						   <div class="row">
							 <div class="col-12 col-lg-6">
							   <div class="card radius-10 overflow-hidden">
								<div class="card-body dbCards">
								   <p class="mb-2">Page Views</p>
								   <h4 class="mb-0">8,293 <small class="font-13 text-success">5.2% <i class="bx bx-up-arrow-alt"></i></small></h4>
								</div>
								<div class="chart-container-2">
								  <canvas id="chart3"></canvas>
								</div>
							  </div>
							 </div>
							 <div class="col-12 col-lg-6">
							   <div class="card radius-10 overflow-hidden">
								<div class="card-body dbCards">
								   <p class="mb-2">Total Clicks</p>
								   <h4 class="mb-0">7,493 <small class="font-13 text-success">1.4% <i class="bx bx-up-arrow-alt"></i></small></h4>
								   
								</div>
								<div class="chart-container-2">
									<canvas id="chart4"></canvas>
								</div>
							  </div>
							 </div>
							 <div class="col-12 col-lg-6">
							   <div class="card radius-10">
								<div class="card-body dbCards text-center">
								   <p class="mb-4">Total Downloads</p>
								   <input class="knob" data-width="190" data-height="190" data-readOnly="true" data-thickness=".15" data-angleoffset="90" data-linecap="round" data-bgcolor="rgba(0, 0, 0, 0.08)" data-fgcolor="#843cf7" data-max="15000" value="8550"/>
								   <hr>
								   <p class="mb-0 small-font text-center">3.4% <i class="zmdi zmdi-long-arrow-up"></i> since yesterday</p>
								</div>
							  </div>
							 </div>
							 <div class="col-12 col-lg-6">
							   <div class="card radius-10">
								<div class="card-body dbCards">
								   <p>Device Storage</p>
								   <h4 class="mb-3">42620/50000</h4>
								   <hr>
								   <div class="progress-wrapper mb-4">
									  <p>Documents <span class="float-end">12GB</span></p>
									  <div class="progress" style="height:5px;">
										  <div class="progress-bar bg-success" style="width:80%"></div>
									  </div>
								   </div>
								   
								   <div class="progress-wrapper mb-4">
									  <p>Images <span class="float-end">10GB</span></p>
									  <div class="progress" style="height:5px;">
										  <div class="progress-bar bg-danger" style="width:60%"></div>
									  </div>
								   </div>
								   
								   <div class="progress-wrapper mb-4">
									   <p>Mails <span class="float-end">5GB</span></p>
									  <div class="progress" style="height:5px;">
										  <div class="progress-bar bg-primary" style="width:40%"></div>
									  </div>
								   </div>
								   
								</div>
							  </div>
							 </div>
						   </div>
						</div>
				</div> -->

		<!-- <div class="row">
						<div class="col-12 col-lg-6 col-xl-4 d-flex">
						  <div class="card radius-10 overflow-hidden w-100">
							 <div class="card-body dbCards">
							   <p>Total Sales</p>
							   <h4 class="mb-0">$87,493</h4>
							   <small>5.43% <i class='bx bx-up-arrow-alt'></i> Since Last Month</small>
							   <div class="mt-5">
							   <div class="chart-container-4">
								 <canvas id="chart5"></canvas>
								</div>
							  </div>
							 </div>
						  </div>
						</div>
				  

				</div> -->




	</div>
</div>
<!--end page wrapper -->

<!-- Bootstrap JS -->

<?php include './includes/footer.php' ?>