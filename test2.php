<?php

require_once("config.php");
require("./dbconn.php");
require("session.php");
if (isset($_POST["prop_submit"])) {
    $userdata = $session->get("userArray");
    $userID = $userdata["uid"];
    $usertype = $userdata["utype"];
    $vcTitle = isset($_POST["title"]) && !empty($_POST["title"]) ? $_POST["title"] : "";
    $action = isset($_POST["action"]) && !empty($_POST["action"]) ? $_POST["action"] : "";
    $iUID = isset($_POST["iUID"]) && !empty($_POST["iUID"]) ? $_POST["iUID"] : $userID;
    $iPID = isset($_POST["iPID"]) && !empty($_POST["iPID"]) ? $_POST["iPID"] : 0;
    $vcPropContent = isset($_POST["content"]) && !empty($_POST["content"]) ? $_POST["content"] : "";
    $vcPropType = isset($_POST["ptype"]) && !empty($_POST["ptype"]) ? $_POST["ptype"] : "";
    $vcBHK = isset($_POST["bhk"]) && !empty($_POST["bhk"]) ? $_POST["bhk"] : "";
    $vcStype = isset($_POST["stype"]) && !empty($_POST["stype"]) ? $_POST["stype"]  : "";
    $vcBed = isset($_POST["bed"]) && !empty($_POST["bed"]) ? $_POST["bed"] : "";
    $vcBalcony = isset($_POST["balc"]) && !empty($_POST["balc"]) ? $_POST["balc"] : "";
    $vcBathRoom = isset($_POST["bath"]) && !empty($_POST["bath"]) ? $_POST["bath"] : "";
    $vcKitchen = isset($_POST["kitc"]) && !empty($_POST["kitc"]) ? $_POST["kitc"] : "";
    $vcHall = isset($_POST["hall"]) && !empty($_POST["hall"]) ? $_POST["hall"] : "";
    $vcFloor = isset($_POST["floor"]) && !empty($_POST["floor"]) ? $_POST["floor"] : "";
    $iSize = isset($_POST["iSize"]) && !empty($_POST["iSize"]) ? intval($_POST["iSize"]) : 0;
    $iPrice = isset($_POST["price"]) && !empty($_POST["price"]) ? intval($_POST["price"]) : 100;
    $vcSqft = isset($_POST["asize"]) && !empty($_POST["asize"]) ? $_POST["asize"] : "";
    $vcCity = isset($_POST["city"]) && !empty($_POST["city"]) ? $_POST["city"] : "";
    $vcState = isset($_POST["state"]) && !empty($_POST["state"]) ? $_POST["state"] : "";
    $vcFeature = isset($_POST["feature"]) && !empty($_POST["feature"]) ? $_POST["feature"] : "";
    $vcStatus = isset($_POST["status"]) && !empty($_POST["status"]) ? $_POST["status"] : "";
    $vcTotalFloor = isset($_POST["totalfl"]) && !empty($_POST["totalfl"]) ? $_POST["totalfl"] : "";
    $vcLocation = isset($_POST["loc"]) && !empty($_POST["loc"]) ? $_POST["loc"] : "";
    $saleType = isset($_POST["saleType"]) && !empty($_POST["saleType"]) ? $_POST["saleType"] : "";
    $dtCreated = date("Y-m-d H:i:s");
    $dtUpdated = date("Y-m-d H:i:s");
    $uniqueID = time();
    $uploadDir = "./property_uploads/";

    // Create directory for this property if it doesn't exist
    $propertyDir = $uploadDir . $uniqueID . "/";
    if (!file_exists($propertyDir)) {
        mkdir($propertyDir, 0777, true); // Recursively create directories with full permissions
    }

    $vcPropImg = "";
    $vcPropImg2 = "";
    $vcPropImg3 = "";
    $vcMapImg = "";
    $vcTopMapImg = "";
    $vcgroundmapImg = "";
    $vcgroundfloorPlanImg = "";
    if (isset($_FILES["aimage"]["name"]) && !empty($_FILES["aimage"]["name"])) {
        $vcPropImg = $propertyDir . basename($_FILES["aimage"]["name"]);
        move_uploaded_file($_FILES["aimage"]["tmp_name"], $vcPropImg);
    }
    if (isset($_FILES["aimage1"]["name"]) && !empty($_FILES["aimage1"]["name"])) {
        $vcPropImg2 = $propertyDir . basename($_FILES["aimage1"]["name"]);
        move_uploaded_file($_FILES["aimage1"]["tmp_name"], $vcPropImg2);
    }
    if (isset($_FILES["aimage2"]["name"]) && !empty($_FILES["aimage2"]["name"])) {
        $vcPropImg3 = $propertyDir . basename($_FILES["aimage2"]["name"]);
        move_uploaded_file($_FILES["aimage2"]["tmp_name"], $vcPropImg3);
    }
    if (isset($_FILES["aImage3"]["name"]) && !empty($_FILES["aImage3"]["name"])) {
        $vcMapImg = $propertyDir . basename($_FILES["aImage3"]["name"]);
        move_uploaded_file($_FILES["aImage3"]["tmp_name"], $vcMapImg);
    }
    if (isset($_FILES["aImage4"]["name"]) && !empty($_FILES["aImage4"]["name"])) {
        $vcTopMapImg = $propertyDir . basename($_FILES["aImage4"]["name"]);
        move_uploaded_file($_FILES["aImage4"]["tmp_name"], $vcTopMapImg);
    }
    if (isset($_FILES["fimage1"]["name"]) && !empty($_FILES["fimage1"]["name"])) {
        $vcgroundmapImg = $propertyDir . basename($_FILES["fimage1"]["name"]);
        move_uploaded_file($_FILES["fimage1"]["tmp_name"], $vcgroundmapImg);
    }
    if (isset($_FILES["fimage2"]["name"]) && !empty($_FILES["fimage2"]["name"])) {
        $vcgroundfloorPlanImg = $propertyDir . basename($_FILES["fimage2"]["name"]);
        move_uploaded_file($_FILES["fimage2"]["tmp_name"], $vcgroundmapImg);
    }


    if ($action == "add") {
        $sql = "INSERT INTO `property`(
        `iUID`, `iUniqID`, `vcTitle`, `vcPropContent`, `vcPropType`, `vcBHK`, `vcStype`, 
        `vcBedRoom`, `vcBathroom`, `vcBalcony`, `vcKitchen`, `vcHall`, `vcFloor`, `iSize`, 
        `iPrice`, `vcSqft`, `vcLocation`, `vcCity`, `vcState`, `vcFeature`, `vcPropImg1`, 
        `vcPropImg2`, `vcPropImg3`, `vcStatus`, `vcMapImg`, `vcTopMaIimage`, `vcgroundmapimage`, `vcGroundFloorPlanImg` ,
         `vcTotalFloor` , `dtCreated`, `dtLastUpdated` 
        ) VALUES (
            $iUID, $uniqueID, '$vcTitle', '$vcPropContent', '$vcPropType', '$vcBHK', '$vcStype', 
            '$vcBed', '$vcBathRoom', '$vcBalcony', '$vcKitchen', '$vcHall', '$vcFloor', $iSize, 
            $iPrice, '$vcSqft', '$vcLocation', '$vcCity', '$vcState', '$vcFeature', '$vcPropImg', 
            '$vcPropImg2', '$vcPropImg3', '$vcStatus', '$vcMapImg', '$vcTopMapImg', '$vcgroundmapImg', '$vcgroundfloorPlanImg' , '$vcTotalFloor',
            '$dtCreated', '$dtUpdated'
        )";
        $insertID = $conn->insert_raw($sql);

        if ($insertID > 0) {
            $propertyData = $session->get('propertyData');
            if (!empty($propertyData)) {
                $session->remove('propertyData');
            }
            $sql  = "SELECT * FROM property WHERE 	iUID = $userID";
            $propertyData = $conn->fetch_raw($sql);
            foreach ($propertyData as $key => $value) {
                $session->set('propertyData[' . $key . ']', $value);
            }
            header("Location:sellerdashboard.php?action=yourproperty&userID=$userID&type=$usertype");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    } else if ($action == "update") {
        $tbl = "property";
        $cond = "iUID=" . $iUID . "AND iUniqID = " . $iPID;

        $sql  = "UPDATE `property` SET `vcTitle`='$vcTitle',`vcPropContent`='$vcPropContent',`vcPropType`='$vcPropType',`vcBHK`='$vcBHK',`vcStype`='$vcStype',`vcBedRoom`='$vcBed',`vcBathroom`='$vcBathRoom',`vcBalcony`='$vcBathRoom',`vcKitchen`='$vcKitchen',`vcHall`='$vcHall',`vcFloor`='$vcFloor',`vcTotalFloor`='$vcTotalFloor',`iSize`=$iSize,`iPrice`=$iPrice,`vcSqft`='$vcSqft',`vcLocation`='$vcLocation',`vcCity`='$vcCity',`vcState`='$vcState',`vcFeature`='$vcFeature',`vcPropImg1`='$vcPropImg',`vcPropImg2`='$vcPropImg2',`vcPropImg3`='$vcPropImg3',`vcStatus`='$vcStatus',`vcMapImg`='$vcMapImg',`vcTopMaIimage`='$vcTopMapImg',`vcgroundmapimage`='$vcgroundmapImg',`vcGroundFloorPlanImg`='$vcgroundfloorPlanImg',`dtLastUpdated`=date('Y-m-d H:i:s') WHERE iUID= $iUID AND IUniqID = $iPID";

       

    }
}

/**
 * Recursively change permissions for files and directories inside a directory.
 * @param string $dir The directory path
 * @param int $mode The permission mode
 */
function recursiveChmod($dir, $mode)
{
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                recursiveChmod($path, $mode);
            } else {
                chmod($path, $mode);
            }
        }
    }
    closedir($dh);
}
// Function to move uploaded file if it's new
// function moveUploadedFile($fileName, $tempFilePath, $destinationDir)
// {
//     $filePath = $destinationDir . basename($fileName);
//     // Check if file already exists, if not, move the uploaded file
//     if (!file_exists($filePath)) {
//         move_uploaded_file($tempFilePath, $filePath);
//     }
//     return $filePath;
// }


// if ($vcTitle !== "") {
//     $updateFields[] = "vcTitle = '$vcTitle'";
// }
// if ($vcPropContent !== "") {
//     $updateFields[] = "vcPropContent = '$vcPropContent'";
// }
// if ($vcPropType !== "") {
//     $updateFields[] = "vcPropType = '$vcPropType'";
// }
// if ($vcBalcony !== "") {
//     $updateFields[] = "vcBalcony = '$vcBalcony'";
// }
// if ($vcBHK !== "") {
//     $updateFields[] = "vcBHK = '$vcBHK'";
// }
// if ($vcSqft !== "") {
//     $updateFields[] = "vcBHK = '$vcBHK'";
// }
// if ($vcStype !== "") {
//     $updateFields[] = "vcStype = '$vcStype'";
// }
// if ($vcBedRoom !== "") {
//     $updateFields[] = "vcBedRoom = '$vcBedRoom'";
// }
// if ($vcBathRoom !== "") {
//     $updateFields[] = "vcBathRoom = '$vcBathRoom'";
// }
// if ($vcKitchen !== "") {
//     $updateFields[] = "vcKitchen = '$vcKitchen'";
// }
// if ($vcHall !== "") {
//     $updateFields[] = "vcHall = '$vcHall'";
// }
// if ($vcFloor !== "") {
//     $updateFields[] = "vcFloor = '$vcFloor'";
// }
// if ($iSize !== "") {
//     $updateFields[] = "iSize = '$iSize'";
// }
// if ($iPrice !== "") {
//     $updateFields[] = "iPrice = '$iPrice'";
// }
// if ($vcSqft !== "") {
//     $updateFields[] = "vcSqft = '$vcSqft'";
// }
// if ($vcLocation !== "") {
//     $updateFields[] = "vcLocation = '$vcLocation'";
// }
// if ($vcCity !== "") {
//     $updateFields[] = "vcCity = '$vcCity'";
// }
// if ($vcState !== "") {
//     $updateFields[] = "vcState = '$vcState'";
// }
// if ($vcFeature !== "") {
//     $updateFields[] = "vcFeature = '$vcFeature'";
// }
// if ($vcStatus !== "") {
//     $updateFields[] = "vcStatus = '$vcStatus'";
// }
// if ($saleType !== "") {
//     $updateFields[] = "saleType = '$saleType'";
// }
// if($vcTotalFloor !== "") {
    
// }

// // Move uploaded images to property directory only if they are new
// if (isset($_FILES["aimage"]["name"]) && !empty($_FILES["aimage"]["name"])) {
//     $vcPropImg = moveUploadedFile($_FILES["aimage"]["name"], $_FILES["aimage"]["tmp_name"], $propertyDir);
// }
// if (isset($_FILES["aimage1"]["name"]) && !empty($_FILES["aimage1"]["name"])) {
//     $vcPropImg2 = moveUploadedFile($_FILES["aimage1"]["name"], $_FILES["aimage1"]["tmp_name"], $propertyDir);
// }
// if (isset($_FILES["aimage2"]["name"]) && !empty($_FILES["aimage2"]["name"])) {
//     $vcPropImg3 = moveUploadedFile($_FILES["aimage2"]["name"], $_FILES["aimage2"]["tmp_name"], $propertyDir);
// }
// if (isset($_FILES["aImage3"]["name"]) && !empty($_FILES["aImage3"]["name"])) {
//     $vcMapImg = moveUploadedFile($_FILES["aImage3"]["name"], $_FILES["aImage3"]["tmp_name"], $propertyDir);
// }
// if (isset($_FILES["aImage4"]["name"]) && !empty($_FILES["aImage4"]["name"])) {
//     $vcTopMapImg = moveUploadedFile($_FILES["aImage4"]["name"], $_FILES["aImage4"]["tmp_name"], $propertyDir);
// }
// if (isset($_FILES["fimage2"]["name"]) && !empty($_FILES["fimage2"]["name"])) {
//     $vcgroundmapImg = moveUploadedFile($_FILES["fimage2"]["name"], $_FILES["fimage2"]["tmp_name"], $propertyDir);
// }
// // Check if any of the file upload variables are empty, if not, add them to the update fields array
// if ($vcPropImg !== "") {
//     $updateFields[] = "vcPropImg1 = '$vcPropImg'";
// }
// if ($vcPropImg2 !== "") {
//     $updateFields[] = "vcPropImg2 = '$vcPropImg2'";
// }
// if ($vcPropImg3 !== "") {
//     $updateFields[] = "vcPropImg3 = '$vcPropImg3'";
// }
// if ($vcMapImg !== "") {
//     $updateFields[] = "vcMapImg = '$vcMapImg'";
// }
// if ($vcTopMapImg !== "") {
//     $updateFields[] = "vcTopMapIimage = '$vcTopMapImg'";
// }
// if ($vcgroundmapImg !== "") {
//     $updateFields[] = "vcgroundmapimage = '$vcgroundmapImg'";
// }

// $updateSetClause = implode(", ", $updateFields);
