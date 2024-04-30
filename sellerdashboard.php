<?php
require_once("session.php");
require_once("dbconn.php");

$userdata = $session->get("userArray");
if (!isset($userdata) || $userdata == null ) {
    header("location:index.php");
}
$uname = isset($userdata['uname']) ? $userdata['uname'] : "";
$uemail = isset($userdata['uemail']) ? $userdata["uemail"] : "";
$uphone = isset($userdata['uphone']) ? $userdata['uphone'] : "";
$uimg = isset($userdata["uimage"]) && !empty($userdata["uimage"]) ? "./uploads/"  . $userdata["uimage"] : "./images/dashboard/4.png";
$uid = isset($userdata["uid"]) && !empty($userdata["uid"]) ? $userdata["uid"] : 0;
$utype = isset($userdata["utype"]) && !empty($userdata["utype"]) ? $userdata["utype"] : "";
$sql = "SELECT COUNT(*) AS property_count FROM property WHERE iUID = $uid";
$res =$conn->fetch_raw($sql);
$count = isset($res[0]["property_count"]) && !empty($res[0]["property_count"]) ? $res[0]["property_count"] : 0;
$showpopup = "false";

if($count >= 5){
    $showpopup = "true";
}
else{
    $showpopup = "false";
}
?>

    <style>
        /* Customize profile image */
        .profile-img {
            width: 100%;
            height: 100%;
            max-width: 200px;
            /* Adjust maximum width for responsiveness */
            max-height: 200px;
            /* Adjust maximum height for responsiveness */
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 10px auto 0;
        }

        /* Add spacing between profile details */
        .profile-details {
            text-align: center;
            /* Center-align text */
            margin-top: 10px;
            /* Add some top margin */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-left: 20px;
            padding-right: 20px;
        }

        /* Add some padding to the top */
        .header {
            width: 100%;
            padding-top: 15px;
            /* Adjust padding for smaller header */
            /* Apply linear gradient background */
            background: linear-gradient(to right, #5E9DAB, #6498A3, #6A929B, #808080, #7A8588, #748B90);
            color: white;
            /* Text color for the header */
            text-align: center;
            /* Center-align text */
            height: 100px;
            /* Adjust header height for mobile */
        }

        .header-no-padding {
            padding-left: 0!important;
            padding-right: 0!important;
        }

        .custom-cadetblue {
            /* background: linear-gradient(to right, #ab5e77,#5e9dab); */
            background: linear-gradient(to right, #748B90, #7A8588, #808080, #6A929B, #6498A3, #5E9DAB);
            color: white;
            /* Text color for better readability */
            border-bottom: 2px solid black;
            /* Border line below */
            padding-bottom: 10px;
            /* Adjust spacing if needed */
        }

        /* Text animation */
        .animated-text {
            animation: slideInFromLeft 1s ease;
        }

        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>


<body>
<?php require("./include/meta.php");?>
    <div class="container-fluid header-no-padding">

        <div class="header">
            <h2 class="animated-text">Welcome to your dashboard <?php echo $uname; ?></h2>
        </div>

        <div class="row justify-content-center custom-cadetblue"> <!-- Center-align row items -->
            <!-- Profile Image -->
            <div class="col-md-3">
                <img src="<?php echo $uimg; ?>" alt="Profile Picture" class="profile-img">
                <!-- <img src="images/Mumbai_Rain.jpg" alt="ProfileImg" class="profile-img"> -->
            </div>

            <!-- User Details -->
            <div class="col-md-5 profile-details">
                <h2><?php echo $uname; ?></h2>
                <p>Email: <?php echo $uemail; ?></p>
                <p>Phone: <?php echo $uphone; ?></p>
            </div>

            <!-- User Buttons -->
            <div class="col-md-3 text-center profile-details">
                <button class="btn btn-primary btn-block mb-2" style="background: linear-gradient(to right,#5E9DAB,#6b959e,#788d91,#858585, #917c78,#9e746b,#ab6c5e); border: 2px solid #ab6c5e" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                <a href="feature.php?userID=<?php echo $uid?>&action=buy&type=<?php echo $utype?>" class="btn btn-info btn-block" style=" background: linear-gradient(to left,#5E9DAB,#6b959e,#788d91,#858585, #917c78,#9e746b,#ab6c5e); border: 2px solid #ab6c5e">Need A New Property ?</a>
                <a href="submitproperty.php?userID=<?php echo $uid?>&action=add&modalShow=<?php echo $showpopup?>" class="btn btn-success btn-block mb-2" style=" background: linear-gradient(to right,#5E9DAB,#6b959e,#788d91,#858585, #917c78,#9e746b,#ab6c5e); border: 2px solid #ab6c5e">Wanna Sell ? </a>
              
                <a href="logout.php" class="btn btn-danger btn-block mb-2" style=" background: linear-gradient(to left,#5E9DAB,#6b959e,#788d91,#858585, #917c78,#9e746b,#ab6c5e); border: 2px solid #ab6c5e">Logout</a>
              
            </div>
        </div>


        <?php require("./propertygrid.php") ?>

    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" action="./updateprofile.php" method="post" enctype="multipart/form-data">
                        <!-- Add profile image -->
                        <div class="form-group text-center">
                            <!-- <img src="<?php echo $uimg ?>" alt="Profile Picture" class="profile-img mb-2" id="editProfileImage"> -->
                            <img src="<?php echo $uimg ?>" alt="Profile Picture" class="profile-img mb-2" id="editProfileImage">
                            <!-- <img src="./uploads/<?php echo $uimg ?>" alt="Profile Picture" class="profile-img mb-2" id="editProfileImage"> -->
                            <!-- <img src="./uploads/<?php echo $uimg ?>" alt="Profile Picture" class="profile-img mb-2" id="editProfileImage"> -->

                            <!-- <img src="./images/Mumbai_Rain.jpg" alt="Profile Picture" class="profile-img mb-2" id="editProfileImage"> -->
                            <div class="mb-2">
                                <button type="button" class="btn btn-sm btn-primary" onclick="document.getElementById('editProfileImageInput').click()">Change</button>
                                <input type="file" class="d-none" name="profileImg" id="editProfileImageInput" accept="image/*" onchange="loadImagePreview(this)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" name="profileName" id="editName" value="<?php echo $uname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" name="profileEmail" id="editEmail" value="<?php echo $uemail; ?>">
                        </div>
                        <input type="hidden" name="userID" value="<?php echo $uid?>">
                        <div class="form-group">
                            <label for="editPhone">Phone</label>
                            <input type="text" class="form-control" name="profileMobile" id="editPhone" value="<?php echo $uphone; ?>">
                        </div>
                        <!-- Add more input fields as needed -->


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="profileUpdate" >Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Subscription Modal -->

';
    <!-- Script to load image preview -->
    <script>
        function loadImagePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#editProfileImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // function handleSubmit(event) {
        //     const form = document.getElementById("editProfileForm");
        //     const url = new URL(form.action);
        //     const formData = new FormData(form);

        //     const name = document.getElementById("editName").value;
        //     const email = document.getElementById("editEmail").value;
        //     const phone = document.getElementById("editPhone").value;
        //     const image = document.getElementById("editProfileImage").src;

        //     formData.append("name", name);
        //     formData.append("email", email);
        //     formData.append("phone", phone);
        //     formData.append("image", image);
            

        //     /** @type {Parameters<fetch>[1]} */
        //     const fetchOptions = {
        //         method: "POST",
        //         body: formData,
        //     };

        //     fetch(url, fetchOptions);

        //     event.preventDefault();
        // }
    </script>


    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>