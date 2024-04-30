<?php


include("dbconn.php");
include("session.php");
print_r($_SESSION);exit;
$error = '';
$msg = '';
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $content = $_POST['content'];

    $uid = isset($_SESSION['uid']) && !empty($_SESSION['uid']) ? $_SESSION['uid'] :  0;

    if (!empty($name) && !empty($phone) && !empty($content)) {

        $sql = "INSERT INTO feedback (uid,fdescription,status) VALUES ('$uid','$content','0')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $msg = "<p class='alert alert-success'>Feedback Send Successfully</p> ";
        } else {
            $error = "<p class='alert alert-warning'>Feedback Not Send Successfully</p> ";
        }
    } else {
        $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
    }
}
?>




<div>
    <!-- <div> -->
    <!--	Header start  -->
    <?php include("include/header.php"); ?>
    <!--	Header end  -->

    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-secondary double-down-line text-center">Profile</h2>
                </div>
            </div>
            <div class="dashboard-personal-info p-5 bg-white">
                <form action="#" method="post">
                    <h5 class="text-secondary border-bottom-on-white pb-3 mb-4">Feedback Form</h5>
                    <?php echo $msg; ?><?php echo $error; ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label for="user-id">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone" maxlength="10">
                            </div>

                            <div class="form-group">
                                <label for="about-me">Description</label>
                                <textarea class="form-control" name="content" rows="7" placeholder="Enter Description"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary mb-4" name="insert" value="Send">
                        </div>
                </form>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-12">
                    <?php
                    $uid = $_SESSION['uid'];
                    $query = mysqli_query($con, "SELECT * FROM `user` WHERE uid='$uid'");
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <div class="user-info mt-md-50"> <img src="admin/user/<?php echo $row['6']; ?>" alt="userimage">
                            <div class="mb-4 mt-3">

                            </div>

                            <div class="font-18">
                                <div class="mb-1 text-capitalize"><b>Name:</b> <?php echo $row['1']; ?></div>
                                <div class="mb-1 text-capitalize"><b>Email:</b> <?php echo $row['2']; ?></div>
                                <div class="mb-1 text-capitalize"><b>Phone:</b> <?php echo $row['3']; ?></div>
                                <div class="mb-1 text-capitalize"><b>Role:</b> <?php echo $row['5']; ?></div>
                            </div>
                        <?php } ?>
                        </div>
                </div>
            </div>

        </div>
    </div>
    <!-- </div> -->
    <!--	Submit property   -->


    <!--	Footer   start-->
    <?php include("include/footer.php"); ?>
    <!--	Footer   start-->

    <!-- Scroll to top -->
    <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
    <!-- End Scroll To top -->
</div>
</div>
<!-- Wrapper End -->