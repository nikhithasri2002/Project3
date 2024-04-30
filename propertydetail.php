<?php
$propertyID = isset($_GET['propertyId']) ? $_GET['propertyId'] : 0;
include("./dbconn.php");
$sql = "SELECT * from property WHERE iUniqID=$propertyID";
$propertyData = $conn->fetch_raw($sql);
$uid = $propertyData[0]['iUID'];
$sql = "SELECT * from user WHERE uid=$uid";
$profileData = $conn->fetch_raw($sql);
// print_r($propertyData);
// print_r($profileData);
?>

<div>
    <!-- <div class="row"> -->
    <!--	Header start  -->
    <!-- <?php include("include/meta.php"); ?> -->
    <!--	Header end  -->



    <!-- Custom CSS -->
    <!-- <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .propdetails {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .propertyHeading h2 {
            font-size: 24px;
            color: #333;
        }

        .propertyHeading p {
            color: #666;
        }

        .agentDetails {
            margin-top: 30px;
        }

        .agentDetails h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .imgDiv img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .name {
            font-size: 18px;
            color: #333;
        }

        .contactBtn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contactBtn:hover {
            background-color: #0056b3;
        }

        .icons i {
            font-size: 20px;
            color: #666;
            margin-right: 10px;
            transition: color 0.3s;
        }

        .icons i:hover {
            color: #007bff;
        }

        .aprtName h2 {
            font-size: 24px;
            color: #333;
            margin-top: 20px;
        }

        .location span {
            font-size: 16px;
            color: #666;
        }

        .mainContent {
            margin-top: 30px;
        }

        .mainContent h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .content p {
            color: #666;
            line-height: 1.6;
        }
    </style> -->


    <style>
        /* Custom styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        

        .prop {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            position: relative;
        }

        .propertyHeading {
            /* position: sticky; */
            top: 0;
            background-color: #fff;
            z-index: 1000;
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
            border-radius: 10px 10px 0 0;
        }

        .propertyHeading h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .propertyHeading p {
            color: #666;
            margin: 0;
        }

        .mainImg {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .mainImg:hover {
            transform: scale(1.05);
        }

        .agentDetails {
            position: absolute;
            top: 129px;
            right: 6px;
            width: 250px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .imgSlider {
            position: absolute;
            top: 104px;
            left: -150px;
            width: 150px;
            overflow: hidden;
            z-index: 1;
        }

        .imgSlider .sliderContent {
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: transform 0.3s ease;
        }

        .imgSlider .sliderContent img {
            width: 100%;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .imgSlider .sliderContent img:hover {
            border-color: #007bff;
        }

        .propertyContent {
            padding-top: 80px;
        }

        .propertyDetails {
            margin-left: 100px;
        }

        .propertyDetails h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
        }

        .propertyDetails p {
            color: #666;
            line-height: 1.6;
        }

        .inclusives,
        .location,
        .note {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
    </style>
    </head>

    <body>

        <div class="prop">
            <div class="propertyHeading">
                <h2>Single Property Details</h2>
                <p>You are close to owning your dream home, contact the agent if interested in this property.</p>
            </div>

            <!-- Image Slider -->
            <div class="imgSlider">
                <div class="sliderContent">
                    <!-- PHP Loop to display property images -->
                    <?php foreach ($propertyData as $property) : ?>
                        <!-- <img src="<?php echo $property['vcPropImg1']; ?>" alt="Property Image">
                        <img src="<?php echo $property['vcPropImg2']; ?>" alt="Property Image">
                        <img src="<?php echo $property['vcPropImg3']; ?>" alt="Property Image"> -->
                        <img src="<?php echo empty($property['vcPropImg1']) || !file_exists($property['vcPropImg1']) || $property['vcPropImg1'] === "" ? "./images/slider/03.jpg" : $property['vcPropImg1']; ?>" alt="Property Image">
                        <img src="<?php echo empty($property['vcPropImg2']) || !file_exists($property['vcPropImg2']) || $property['vcPropImg2'] === "" ? "./images/slider/03.jpg" : $property['vcPropImg2']; ?>" alt="Property Image">
                        <img src="<?php echo empty($property['vcPropImg3']) || !file_exists($property['vcPropImg3']) || $property['vcPropImg3'] === "" ? "./images/slider/03.jpg" : $property['vcPropImg3']; ?>" alt="Property Image">


                        <!-- Add more images if available -->
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Main Image -->
            <img class="mainImg" src="<?php echo empty($property['vcPropImg1']) || !file_exists($property['vcPropImg1']) || $property['vcPropImg1'] === "" ? "./images/slider/03.jpg" : $property['vcPropImg1']; ?>" style="width:72%;height:500px;" alt="Main Property Image">

            <!-- Agent Details -->
            <div class="agentDetails">
                <h3>Agent Details</h3>
                <div class="imgDiv">
                    <img src="<?php echo "./uploads/" .  $profileData[0]['uimage']; ?>" alt="Agent Image">
                </div>
                <h3 class="name"><?php echo $profileData[0]['uname']; ?></h3>
                <button class="contactBtn">Contact Agent</button>
                <div class="socials mt-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Property Details -->
            <div class="propertyContent">
                <div class="propertyDetails">
                    <div class="summary">
                        <h3>Summary</h3>
                        <p><i class="far fa-calendar-alt"></i> Posted: <?php echo date('Y-m-d', strtotime($propertyData[0]['dtCreated'])); ?></p>
                        <!-- Other summary items -->
                    </div>
                    <div class="desc">
                        <h3>Description</h3>
                        <p><?php echo $propertyData[0]['vcFeature']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Inclusives -->
            <div class="inclusives">
                <h3>Price Inclusives</h3>
                <p>⚑ All utilities are included (electricity, water, TV, AC/chiller).</p>
                <p>⚑ Access to all building/community facilities such as the pool and the gym.</p>
                <!-- Additional inclusions -->
            </div>

            <!-- Location -->
            <div class="location">
                <h3>Location</h3>
                <span><?php echo $propertyData[0]['vcLocation']; ?></span>
            </div>

            <!-- Note -->
            <div class="note">
                <h3>Note</h3>
                <p>Please note that the monthly price you see on this listing is applicable for check-ins for this current month only. The pricing of short term rentals is not fixed and it varies according to seasonality.</p>
            </div>
        </div>

        <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.sliderContent img').click(function() {
                    $('.mainImg').attr('src', $(this).attr('src'));
                });
            });
        </script>



        <!-- Footer Start -->
        <?php include("include/footer.php"); ?>
        <!--	Footer   start-->


        <!-- Scroll to top -->
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>
        <!-- End Scroll To top -->
        <!-- </div> -->
</div>