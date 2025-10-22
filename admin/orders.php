 <?php
include 'includes/header.php';
include 'includes/db.php';

$Placedorder =mysqli_query ($conn,"SELECT * FROM orders WHERE status=1");
$getplaced = mysqli_num_rows($Placedorder);

$Confirmorder =mysqli_query ($conn,"SELECT * FROM orders WHERE status=2");
$getconfirm = mysqli_num_rows($Confirmorder);

$Intransit =mysqli_query ($conn,"SELECT * FROM orders WHERE status=3");
$getTransit = mysqli_num_rows($Intransit);

$Delivered =mysqli_query ($conn,"SELECT * FROM orders WHERE status=4");
$getdelivered = mysqli_num_rows($Delivered);

$palcedCancel =mysqli_query ($conn,"SELECT * FROM orders WHERE status=5");
$getpalcedCancel = mysqli_num_rows($palcedCancel);

$Cancelled =mysqli_query ($conn,"SELECT * FROM orders WHERE status=6");
$getCancelled = mysqli_num_rows($Cancelled);

$Failed =mysqli_query ($conn,"SELECT * FROM orders WHERE status=7");
$getFailed = mysqli_num_rows($Failed);
?>

<!--end header -->
    <!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
 
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <!-- <div class="breadcrumb-title pe-3">Forms</div> -->
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="./index.php"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div> 
        
                   <!-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
						<div class="col--xl-6">
							<div class="card radius-10 bg-gradient-deepblue">
							 <div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getplaced; ?></h5>
									<div class="ms-auto">
                                        <i class='bx bx-cart fs-3 text-white'></i>
									</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">Placed Orders</p>
								</div>
							</div>
						  </div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-ohhappiness">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getconfirm; ?></h5>
									<div class="ms-auto">
									<i class='bx bx-list-check fs-3 text-white'></i>
										</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">Confirmed Orders</p>
								</div>
							</div>
						  </div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-ibiza">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getTransit; ?></h5>
									<div class="ms-auto">
									<i class='bx bxs-truck fs-3 text-white'></i>									
								</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">In Transist</p>
								</div>
							</div>
						</div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-moonlit">
							 <div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getdelivered; ?></h5>
									<div class="ms-auto">
                                        <i class='bx bx-envelope fs-3 text-white'></i>
									</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">Delivered Orders</p>
								</div>
							</div>
						 </div>
						</div>
					</div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
						<div class="col">
							<div class="card radius-10 bg-gradient-ibiza">
							 <div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getpalcedCancel; ?></h5>
									<div class="ms-auto">
                                        <i class='bx bx-cart fs-3 text-white'></i>
									</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">Placed Cancellation Orders</p>
								</div>
							</div>
						  </div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-deepblue">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getCancelled; ?></h5>
									<div class="ms-auto">
									<i class='bx bx-x fs-3 text-white'></i>
									</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">Cancelled Products</p>
								</div>
							</div>
						  </div>
						</div>
						<div class="col">
							<div class="card radius-10 bg-gradient-ohhappiness">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<h5 class="mb-0 text-white"><?php echo $getFailed; ?></h5>
									<div class="ms-auto">
									<i class='bx bxs-message-alt-x fs-3 text-white'></i>
										</div>
								</div>
								<div class="d-flex align-items-center text-white">
									<p class="mb-0 order">Failed Orders</p>
								</div>
							</div>
						</div>
						</div>
						
					</div> -->


					<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 mt-4">

					<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Cancellation Orders</p>
							<h5><?php echo $getpalcedCancel; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage1.png" alt=""> -->
							      <i class='bx bx-cart fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Cancelled Products</p>
							<h5><?php echo $getCancelled; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage2.png" alt=""> -->
							 <i class='bx bx-x fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>


			
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Confirmed Orders</p>
							<h5><?php echo $getconfirm; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage2.png" alt=""> -->
							 <i class='bx bx-list-check fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Delivered Orders</p>
							<h5><?php echo $getdelivered; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage4.png" alt=""> -->
							  <i class='bx bx-envelope fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>


		
		
		</div>

					<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
			
			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Failed Orders</p>
							<h5><?php echo $getFailed; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage3.png" alt=""> -->
							<i class='bx bxs-message-alt-x fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>In Transist</p>
							<h5><?php echo $getTransit; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage3.png" alt=""> -->
							 <i class='bx bxs-truck fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card radius-10 ">
					<div class="card-body dbCards">
						<div class="details">
							<p>Placed Orders</p>
							<h5><?php echo $getplaced; ?></h5>
						</div>
						<div class="dbImg">
							<!-- <img src="assets/images/dbImage1.png" alt=""> -->
							     <i class='bx bx-cart fs-3 text-white'></i>
						</div>
					</div>
				</div>
			</div>

		
		</div>



					
 

     </div>
</div> 








		<!--end page wrapper -->
	
	<!-- Bootstrap JS -->
	
	<?php include './includes/footer.php'?>
