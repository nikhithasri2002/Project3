<?php

require("config.php");
require("dbconn.php");
require("session.php");

$error = "";
$msg = "";

$propID = isset($_REQUEST["propID"]) && !empty($_REQUEST["propID"]) ? intval($_REQUEST["propID"]) : 0;
$userID = isset($_REQUEST["userID"]) && !empty($_REQUEST["userID"]) ? intval($_REQUEST["userID"]) : 0;
$action = isset($_REQUEST["action"]) && !empty($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$modalShow = isset($_REQUEST["modalShow"]) && !empty($_REQUEST["modalShow"])? $_REQUEST["modalShow"] : "false";

$title = $vcBalcony = $vcBathroom = $vcState = 	$vcPropContent = $vcPropType = $vcBedRoom = $vcBHK = $vcCity = $vcCity = $vcFloor = $vcGroundFloorPlanImg = $vcTotalFloor = $vcTopMaIimage = $vcSqft = $vcStatus = $vcKitchen  = $vcStype = $iSize = $iPrice = $vcLocation = $vcMapImg = $vcPropImg1 = $vcPropImg2 = $vcPropImg3 = $vcStates = "";
if ($action == "update" && $propID >0) {
	$sql = "SELECT * from property WHERE iUniqID = $propID";
	$prop_data = $conn->fetch_raw($sql);

	$title = $prop_data[0]["vcTitle"];
	$vcPropContent = $prop_data[0]["vcPropContent"];
	$vcPropType = $prop_data[0]["vcPropType"];
	$vcBHK = $prop_data[0]["vcBHK"];
	$vcStype = $prop_data[0]["vcStype"];
	$vcBedRoom = $prop_data[0]["vcBedRoom"];
	$vcBathroom = $prop_data[0]["vcBathroom"];
	$vcBalcony = $prop_data[0]["vcBalcony"];
	$vcKitchen = $prop_data[0]["vcKitchen"];
	$vcHall = $prop_data[0]["vcHall"];
	$vcFloor = $prop_data[0]["vcFloor"];
	$vcTotalFloor = $prop_data[0]["vcTotalFloor"];
	$iSize = $prop_data[0]["iSize"];
	$iPrice = $prop_data[0]["iPrice"];
	$vcSqft = $prop_data[0]["vcSqft"];
	$vcLocation = $prop_data[0]["vcLocation"];
	$vcCity = $prop_data[0]["vcCity"];
	$vcState = $prop_data[0]["vcState"];
	$vcFeature = $prop_data[0]["vcFeature"];
	$vcPropImg1 = $prop_data[0]["vcPropImg1"];
	$vcPropImg2 = $prop_data[0]["vcPropImg2"];
	$vcPropImg3 = $prop_data[0]["vcPropImg3"];
	$vcStatus = $prop_data[0]["vcStatus"];
	$vcMapImg = $prop_data[0]["vcMapImg"];
	$vcTopMaIimage = $prop_data[0]["vcTopMaIimage"];
	$vcGroundFloorPlanImg = $prop_data[0]["vcGroundFloorPlanImg"];
}

$userArr = $session->get("userArray");
$usertype = $userArr["utype"];

if ($modalShow == "true") {
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo 'document.getElementById("subscriptionModal").classList.add("show");'; // This line adds the "show" class to the modal to display it
    echo '});';
    echo '</script>';
	echo '<style>.modal.show {
		display: block;
	}</style>';
}



?>

<div>
	<!--	Header start  -->
	<?php include("include/header.php"); ?>
	<!--	Header end  -->

	<div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="subscriptionModalLabel">Subscription Required</h5>
                <a href="sellerdashboard.php?userID=<?php echo $userID?>&action=yourproperty&type=<?php echo $utype?>"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></a>
            </div>
            <div class="modal-body text-center">
                You have reached the limit. If you want to add more properties, please subscribe.
            </div>
            <div class="modal-footer justify-content-center">
               <a href="sellerdashboard.php?userID=<?php echo $userID?>&action=yourproperty&type=<?php echo $utype?>"> <button type="button" class="btn btn-primary">Subscribe</button></a>
            </div>
        </div>
    </div>
</div>
	<!--	Submit property   -->
	<div class="full-row">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="text-secondary double-down-line text-center">Submit Property</h2>
				</div>
			</div>
			<div class="row p-5 bg-white">
				<form method="post" action="propertysubmit.php" enctype="multipart/form-data">
					<div class="description">
						<h5 class="text-secondary">Basic Information</h5>
						<hr>
						<?php echo $error; ?>
						<?php echo $msg; ?>

						<div class="row">
							<div class="col-xl-12">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Title</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="title" value="<?php echo $title ?>" required placeholder="Enter Title">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Content</label>
									<div class="col-lg-9">
										<textarea class="tinymce form-control" name="content" rows="10" value="" cols="30"><?php echo $vcPropContent ?></textarea>
									</div>
								</div>

							</div>
							<div class="col-xl-6">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Property Type</label>
									<div class="col-lg-9">
										<select class="form-control" required name="ptype">
											<option value=""><?php echo  !empty($vcPropType) ?  $vcPropType : "Select Type"; ?></option>
											<option value="appartment">Appartment</option>
											<option value="flat">Flat</option>
											<option value="bunglow">Bunglow</option>
											<option value="house">House</option>
											<option value="villa">Villa</option>
											<option value="office">Office</option>""
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Selling Type</label>
									<div class="col-lg-9">
										<select class="form-control" required name="stype">
											<option value=""><?php echo !empty($vcStype) ?  $vcStype : "Select Status"; ?></option>
											<option value="rent">Rent</option>
											<option value="sale">Sale</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Bathroom</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="bath" value="<?php echo $vcBathroom ?>" required placeholder="Enter Bathroom (only no 1 to 10)">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Kitchen</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="kitc" value ="<?php echo $vcKitchen ?>" required placeholder="Enter Kitchen (only no 1 to 10)">
									</div>
								</div>

							</div>
							<div class="col-xl-6">
								<div class="form-group row mb-3">
									<label class="col-lg-3 col-form-label">BHK</label>
									<div class="col-lg-9">
										<select class="form-control" required name="bhk">
										<option value=""><?php echo !empty($vcBHK) ?  $vcBHK : "Select BHK"; ?></option>

											<option value="">Select BHK</option>
											<option value="1 BHK">1 BHK</option>
											<option value="2 BHK">2 BHK</option>
											<option value="3 BHK">3 BHK</option>
											<option value="4 BHK">4 BHK</option>
											<option value="5 BHK">5 BHK</option>
											<option value="1,2 BHK">1,2 BHK</option>
											<option value="2,3 BHK">2,3 BHK</option>
											<option value="2,3,4 BHK">2,3,4 BHK</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Bedroom</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="bed" value="<?php echo $vcBedRoom ?>" required placeholder="Enter Bedroom  (only no 1 to 10)">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Balcony</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="balc" value="<?php echo $vcBalcony ?>"required placeholder="Enter Balcony  (only no 1 to 10)">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Hall</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="hall" value="<?php echo $vcBalcony ?>" required placeholder="Enter Hall  (only no 1 to 10)">
									</div>
								</div>

							</div>
						</div>
						<h5 class="text-secondary">Price & Location</h5>
						<hr>
						<div class="row">
							<div class="col-xl-6">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Floor</label>
									<div class="col-lg-9">
										<select class="form-control" required name="floor">
											
											<option value=""><?php echo !empty($vcFloor) ?  $vcFloor : "Select BHK"; ?></option>
											<option value="1st Floor">1st Floor</option>
											<option value="2nd Floor">2nd Floor</option>
											<option value="3rd Floor">3rd Floor</option>
											<option value="4th Floor">4th Floor</option>
											<option value="5th Floor">5th Floor</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Price</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="price" value="<?php echo $iPrice ?>" required placeholder="Enter Price">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">City</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="city" value="<?php echo $vcCity ?>" required placeholder="Enter City">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">State</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="state" value="<?php echo $vcState ?>" required placeholder="Enter State">
									</div>
								</div>
							</div>
							<div class="col-xl-6">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Total Floor</label>
									<div class="col-lg-9">
										<select class="form-control" required name="totalfl">
											
											<option value=""><?php echo !empty($vcTotalFloor) ?  $vcBHK : "Select Floor"; ?></option>

											<option value="1 Floor">1 Floor</option>
											<option value="2 Floor">2 Floor</option>
											<option value="3 Floor">3 Floor</option>
											<option value="4 Floor">4 Floor</option>
											<option value="5 Floor">5 Floor</option>
											<option value="6 Floor">6 Floor</option>
											<option value="7 Floor">7 Floor</option>
											<option value="8 Floor">8 Floor</option>
											<option value="9 Floor">9 Floor</option>
											<option value="10 Floor">10 Floor</option>
											<option value="11 Floor">11 Floor</option>
											<option value="12 Floor">12 Floor</option>
											<option value="13 Floor">13 Floor</option>
											<option value="14 Floor">14 Floor</option>
											<option value="15 Floor">15 Floor</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Area Size</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="asize"  value="<?php echo $vcSqft ?>" required placeholder="Enter Area Size (in sqrt)">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Address</label>
									<div class="col-lg-9">
										<input type="text" class="form-control" name="loc" valvalue="<?php echo $vcLocation ?>" required placeholder="Enter Address">
									</div>
								</div>

							</div>
						</div>

						<div class="form-group row" hidden>
							<label class="col-lg-2 col-form-label">Feature</label>
							<div class="col-lg-9" >
								<p class="alert alert-danger">* Important Please Do Not Remove Below Content Only Change <b>Yes</b> Or <b>No</b> or Details and Do Not Add More Details</p>

								<textarea class="tinymce form-control" name="feature" rows="10" cols="30">
												<!---feature area start--->
												<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Property Age : </span>10 Years</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Swiming Pool : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Parking : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">GYM : </span>Yes</li>
														</ul>
													</div>
													<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Type : </span>Appartment</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Security : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Dining Capacity : </span>10 People</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Temple  : </span>Yes</li>
														
														</ul>
													</div>
													<div class="col-md-4">
														<ul>
														<li class="mb-3"><span class="text-secondary font-weight-bold">3rd Party : </span>No</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Alivator : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">CCTV : </span>Yes</li>
														<li class="mb-3"><span class="text-secondary font-weight-bold">Water Supply : </span>Ground Water / Tank</li>
														</ul>
													</div>
												<!---feature area end---->
											</textarea>
							</div>
						</div>

						<h5 class="text-secondary">Image & Status</h5>
						<hr>
						<div class="row">
							<div class="col-xl-6">

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Image</label>
									<div class="col-lg-9">
										<input class="form-control" name="aimage" value="<?php echo $vcPropImg1 ?>" type="file" required="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Image 2</label>
									<div class="col-lg-9">
										<input class="form-control" name="aimage2" value="<?php echo $vcPropImg2 ?>" type="file" required="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Image 4</label>
									<div class="col-lg-9">
										<input class="form-control" name="aimage4" value="<?php echo $vcPropImg3 ?>" type="file" required="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Status</label>
									<div class="col-lg-9">
										<select class="form-control" required name="status" value="<?php echo $vcStatus ?>">
											<option value="">Select Status</option>
											<option value="available">Available</option>
											<option value="sold out">Sold Out</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Basement Floor Plan Image</label>
									<div class="col-lg-9">
										<input class="form-control" name="fimage1" type="file" value="<?php echo $vcGroundFloorPlanImg ?>">
									</div>
								</div>
							</div>
							<div class="col-xl-6">

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Image 1</label>
									<div class="col-lg-9">
										<input class="form-control" name="aimage1" value="<?php echo $vcMapImg ?>" type="file" required="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">image 3</label>
									<div class="col-lg-9">
										<input class="form-control" name="aimage3" type="file" value="<?php echo $vcTopMaIimage ?>" required="">
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Floor Plan Image</label>
									<div class="col-lg-9">
										<input class="form-control" name="fimage" type="file" value="<?php echo $vcPropImg3 ?>">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Ground Floor Plan Image</label>
									<div class="col-lg-9">
										<input class="form-control" name="fimage2" type="file">
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" name="action" value=<?php echo $action ?>>
						<input type="hidden" name="iUID" value=<?php echo $userID ?>>
						<input type="hidden" name="iPID" value=<?php echo $propID ?>>


						<input type="submit" value="Submit" class="btn btn-primary" name="prop_submit" style="margin-left:200px;">

					</div>
				</form>
			</div>
		</div>
	</div>
	<!--	Submit property   -->


	<!--	Footer   start-->
	<?php include("include/footer.php"); ?>
	<!--	Footer   start-->

	<!-- Scroll to top -->
	<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
	<!-- End Scroll To top -->
</div>