<?php
include_once("./dbconn.php");
include_once("./session.php");

$sql = "SELECT * from property";
$property_data = $conn->fetch_raw($sql);

$properties_count = count($property_data);
$saletype = 0;
$renttype = 0;
// print_r($property_data);exit();

foreach ($property_data as $property => $val) {
    $stype = $val["vcStype"];
    if ($stype == "sale") {
        $saletype++;
    }

    if ($stype == "rent") {
        $renttype++;
    }
}

$users = $conn->countRows("SELECT count(*) FROM user");

?>


<div>
    <?php include("include/header.php"); ?>

    <!--	Banner Start   -->
    <div class="overlay-black w-100 slider-banner1 position-relative" style="background-image: url('images/banner/04.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <div class="text-white">
                        <h1 class="mb-4"><span class="text-primary">Find</span><br>
                            Your dream house</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--	Banner End  -->

    <!--	Text Block One
		======================================================-->
    <div class="full-row bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-secondary double-down-line text-center mb-5">What We Do</h2>
                </div>
            </div>
            <div class="text-box-one">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                            <i class="flaticon-rent text-primary flat-medium" aria-hidden="true"></i>
                            <h5 class="text-secondary hover-text-primary py-3 m-0"><a href="#">Selling Service</a></h5>
                            <p>Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                            <i class="flaticon-for-rent text-primary flat-medium" aria-hidden="true"></i>
                            <h5 class="text-secondary hover-text-primary py-3 m-0"><a href="#">Rental Service</a></h5>
                            <p>Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                            <i class="flaticon-list text-primary flat-medium" aria-hidden="true"></i>
                            <h5 class="text-secondary hover-text-primary py-3 m-0"><a href="#">Property Listing</a></h5>
                            <p>Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="p-4 text-center hover-bg-white hover-shadow rounded mb-4 transation-3s">
                            <i class="flaticon-diagram text-primary flat-medium" aria-hidden="true"></i>
                            <h5 class="text-secondary hover-text-primary py-3 m-0"><a href="#">Legal Investment</a></h5>
                            <p>Lacinia tempor tortor nibh. Et mattis cubilia suspendisse cras justo potenti.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-----  Our Services  ---->

    <!--	Recent Properties  -->
    <!-- <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-secondary double-down-line text-center mb-4">Recent Property</h2>
                </div>

                <div class="col-md-12">
                    <div class="tab-content mt-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home">
                            <div class="row mb-5">
                                <?php
                                $count =0;
                                foreach ($property_data as $key => $val) {
                                    if($count >= 3){
                                        break;
                                    }
                                    $vcStype = $val["vcStype"];
                                    $vctitle = $val["vcTitle"];
                                    $balcony = $val["vcBalcony"];
                                    $kitchen = $val["vcKitchen"];
                                    $sqft = $val["vcSqft"];
                                    $beds =  $val["vcBedRoom"];
                                    $baths = $val["vcBathroom"];
                                    $propImg = $val["vcPropImg1"];
                                    $price = $val["iPrice"];
                                    $vcStype = $val["vcStype"];
                                    $pid = $val["iPID"];
                                    $uid = $val["iUID"];
                                    $city = $val["vcCity"];
                                    $state = $val["vcState"];

                                    $user_sql = "SELECT * FROM user where uid = $uid";
                                    $user_count = $conn->fetch_raw($user_sql);
                                    $username = isset($user_count["uname"]) && !empty($user_count["uname"]) ? $user_count["uname"] : '';
                                    echo '
                                    
                                        <div class="col-md-6 col-lg-4 ">
                                            <div class="featured-thumb hover-zoomer mb-4">
                                            <div class="overlay-black overflow-hidden position-relative"> <img src="' . $ADMIN_IMG_PATH . '/ ' . $propImg . '" alt=' . $vctitle . '>
                                                <div class="featured bg-primary text-white">New</div>
                                                <div class="sale bg-secondary text-white text-capitalize">For ' . $vcStype . '</div>
                                                <div class="price text-primary"><b>$ ' . $price . '</b><span class="text-white">' . $sqft . ' Sqft</span></div>
                                            </div>
                                            <div class="featured-thumb-data shadow-one">
                                                <div class="p-3">
                                                    <h5 class="text-secondary hover-text-primary mb-2 text-capitalize"><a href="propertydetail.php?pid=' . $pid . '"></a></h5>
                                                    <span class="location text-capitalize"><i class="fas fa-map-marker-alt text-primary"></i>' . $city . ' , ' . $state . '</span>
                                                </div>
                                                <div class="bg-gray quantity px-4 pt-4">
                                                    <ul>
                                                        <li><span>' . $sqft . '</span> Sqft</li>
                                                        <li><span>' . $beds . '</span> Beds</li>
                                                        <li><span>' . $baths . '</span> Baths</li>
                                                        <li><span> ' . $kitchen . ' </span> Kitchen</li>
                                                        <li><span> ' . $balcony . '</span> Balcony</li>
                                    
                                                    </ul>
                                                </div>
                                                <div class="p-4 d-inline-block w-100">
                                                    <div class="float-left text-capitalize"><i class="fas fa-user text-primary mr-1"></i>By : ' . $username . '</div>
                                                    <div class="float-right"><i class="far fa-calendar-alt text-primary mr-1"></i> 6 Months Ago</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                    $count ++;
                                }
                                ?>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <link rel="stylesheet" href="./assets/css/custom.css"> -->
    <section class="service" id="service">
        <div class="container">

          <p class="section-subtitle">Our Services</p>

          <h2 class="h2 section-title">Our Main Focus</h2>

          <ul class="service-list">

            <li>
              <div class="service-card">

                <div class="card-icon">
                  <img src="./images/service-1.png" alt="Service icon">
                </div>

                <h3 class="h3 card-title">
                  <a href="propertygrid.php">Buy a home</a>
                </h3>

                <p class="card-text">
                  over 1 million+ homes for sale available on the website, we can match you with a house you will want
                  to call home.
                </p>

                <a href="#" class="card-link">
                  <span>Find A Home</span>

                  <ion-icon name="arrow-forward-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                </a>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon">
                  <img src="./images/service-2.png" alt="Service icon">
                </div>

                <h3 class="h3 card-title">
                  <a href="#">Rent a home</a>
                </h3>

                <p class="card-text">
                  over 1 million+ homes for sale available on the website, we can match you with a house you will want
                  to call home.
                </p>

                <a href="#" class="card-link">
                  <span>Find A Home</span>

                  <ion-icon name="arrow-forward-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                </a>

              </div>
            </li>

            <li>
              <div class="service-card">

                <div class="card-icon">
                  <img src="./images/service-3.png" alt="Service icon">
                </div>

                <h3 class="h3 card-title">
                  <a href="#">Sell a home</a>
                </h3>

                <p class="card-text">
                  over 1 million+ homes for sale available on the website, we can match you with a house you will want
                  to call home.
                </p>

                <a href="#" class="card-link">
                  <span>Find A Home</span>

                  <ion-icon name="arrow-forward-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                </a>

              </div>
            </li>

          </ul>

        </div>
      </section>

    <!--	Recent Properties  -->

    <!--	Why Choose Us -->
    <div class="full-row living bg-one overlay-secondary-half" style="background-image: url('images/haddyliving.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="living-list pr-4">
                        <h3 class="pb-4 mb-3 text-white">Why Choose Us</h3>
                        <ul>
                            <li class="mb-4 text-white d-flex">
                                <i class="flaticon-reward flat-medium float-left d-table mr-4 text-primary" aria-hidden="true"></i>
                                <div class="pl-2">
                                    <h5 class="mb-3">Experience Quality</h5>
                                    <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
                                </div>
                            </li>
                            <li class="mb-4 text-white d-flex">
                                <i class="flaticon-real-estate flat-medium float-left d-table mr-4 text-primary" aria-hidden="true"></i>
                                <div class="pl-2">
                                    <h5 class="mb-3">Experience Quality</h5>
                                    <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
                                </div>
                            </li>
                            <li class="mb-4 text-white d-flex">
                                <i class="flaticon-seller flat-medium float-left d-table mr-4 text-primary" aria-hidden="true"></i>
                                <div class="pl-2">
                                    <h5 class="mb-3">Experience Quality</h5>
                                    <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--	why choose us -->

    <!--	How it work -->
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-secondary double-down-line text-center mb-5">How It Work</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="icon-thumb-one text-center mb-5">
                        <div class="bg-primary text-white rounded-circle position-absolute z-index-9">1</div>
                        <div class="left-arrow"><i class="flaticon-investor flat-medium icon-primary" aria-hidden="true"></i></div>
                        <h5 class="text-secondary mt-5 mb-4">Discussion</h5>
                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-thumb-one text-center mb-5">
                        <div class="bg-primary text-white rounded-circle position-absolute z-index-9">2</div>
                        <div class="left-arrow"><i class="flaticon-search flat-medium icon-primary" aria-hidden="true"></i></div>
                        <h5 class="text-secondary mt-5 mb-4">Files Review</h5>
                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="icon-thumb-one text-center mb-5">
                        <div class="bg-primary text-white rounded-circle position-absolute z-index-9">3</div>
                        <div><i class="flaticon-handshake flat-medium icon-primary" aria-hidden="true"></i></div>
                        <h5 class="text-secondary mt-5 mb-4">Acquire</h5>
                        <p>Nascetur cubilia sociosqu aliquet ut elit nascetur nullam duis tincidunt nisl non quisque vestibulum platea ornare ridiculus.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--	Achievement -->
    <div class="full-row overlay-secondary" style="background-image: url('images/counterbg.jpg'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
        <div class="container">
            <div class="fact-counter">
                <div class="row">
                    <div class="col-md-3">
                        <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i class="flaticon-house flat-large text-white" aria-hidden="true"></i>

                            <div class="count-num text-primary my-4" data-speed="3000" data-stop=""><?php echo $properties_count ?></div>
                            <div class="text-white h5">Property Available</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i class="flaticon-house flat-large text-white" aria-hidden="true"></i>

                            <div class="count-num text-primary my-4" data-speed="3000" data-stop=""><?php echo $saletype ?></div>
                            <div class="text-white h5">Sale Property Available</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i class="flaticon-house flat-large text-white" aria-hidden="true"></i>

                            <div class="count-num text-primary my-4" data-speed="3000" data-stop=""><?php echo $renttype ?></div>
                            <div class="text-white h5">Rent Property Available</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="count wow text-center  mb-sm-50" data-wow-duration="300ms"> <i class="flaticon-man flat-large text-white" aria-hidden="true"></i>

                            <div class="count-num text-primary my-4" data-speed="3000" data-stop=""><?php echo $users ?></div>
                            <div class="text-white h5">Registered Users</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div> 
                    
    <?php require("./include/footer.php") ?>
</div>