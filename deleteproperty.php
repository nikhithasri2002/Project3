<?php
require("dbconn.php");
require("session.php");

$propertyID = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";

if ($propertyID == 0) {
    header("location:index.php");
    exit; // Ensure script execution stops after redirect
}
$userArray  =$session->get("userArray");
// print_r($userArray);exit;
$userID = $userArray["uid"];

$sql = "DELETE  FROM property WHERE iUniqID = $propertyID";
// echo $sql;
$del_res = $conn->delete_raw($sql);
// echo $del_res;exit;
if ($del_res > 0) {
    // Loop through the propertyData array in the session
    foreach ($_SESSION['propertyData'] as $key => $property) {
        // Check if the current property's iUniqID matches the given propertyID
        if ($property['iUniqID'] == $propertyID) {
            // Remove the property from the propertyData array
            unset($_SESSION['propertyData'][$key]);
            // Optionally, break the loop if you want to delete only one property even if there are multiple properties with the same ID
            break;
        }
    }

    // Optionally, you can reindex the array after removing the element
    $_SESSION['propertyData'] = array_values($_SESSION['propertyData']);

    // Update the session data
    $_SESSION['propertyData'] = array_values($_SESSION['propertyData']);

    // Redirect the user to index.php after deleting the property
    header("location:sellerdashboard.php?action=yourproperty&userID=$userID&type=buyer");

}
