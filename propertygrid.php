<?php
include("./dbconn.php");
if (!isset($session)) {
    include("./session.php");
}

require("./include/card_display.php");

$userID = isset($_REQUEST["userID"]) ? $_REQUEST["userID"] : 0;
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$usertype = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

if ($userID == 0 || $action == "" || $usertype == "") {
    header("location:index.php");
    exit;
}

$sql = "SELECT COUNT(*) AS property_count FROM property WHERE iUID = $userID";

$res =$conn->fetch_raw($sql);
$count = isset($res[0]["property_count"]) && !empty($res[0]["property_count"]) ? $res[0]["property_count"] : 0;
$showpopup = "false";

if($count >= 5){
    $showpopup = "true";
}
else{
    $showpopup = "false";
}
// echo $showpopup;
$addItem = "";

$userArray = $session->get('userArray');
$UID= $userArray["uid"];
$type = false;
$sql = "";
if (trim($action) == "buy" && $userID > 0 && ($usertype == "buyer" || "seller")) {
    $sql = "SELECT * FROM property WHERE iUID!= $userID";
    $addItem = "";
    $msg = "Featured Properties  ...";
    if($usertype == "buyer"){
         $type = true;
    }
    $type = false;
}
else if ($action == "yourproperty" && $userID > 0 && ($usertype == "seller" || $usertype == "buyer")) {
    $sql = "SELECT * FROM property WHERE iUID = $userID";
    $addItem = "";
    $msg = "Your properties ... ";
    $type = true;
} 
// echo $sql;exit;
if( (strpos($_SERVER["SCRIPT_FILENAME"], "propertygrid.php") !== false)  ||  (strpos($_SERVER["SCRIPT_FILENAME"], "feature.php") !== false) ) {
    $addItem = "<a class='option' href='submitproperty.php?userID=$userID&action=add&modalShow=$showpopup'><button class='btn btn-primary'>Wanna Sell ?</button></a>";    
    // $type = true;
}



$html = '';
// $userdata = $session->get("userArray");
// $uid = isset($userdata["uid"]) && !empty($userdata["uid"]) ? $userdata["uid"] : 0;
// $utype = isset($userdata["utype"]) ? $userdata["utype"] : "";
// $sql = "";
// if ($utype == "seller" && $userID > 0) {
//     $sql = "SELECT * FROM property WHERE iUID = $uid";
//     $msg  = "Your Properties";
// } else {
//     $sql = "SELECT * FROM property";
//     $msg = "Featured Properties ...";
//     $utype ="buyer";
// }
$propertyData = $conn->fetch_raw($sql);

$msg2 = count($propertyData) == 0 ? "No Properties , Yet to be Addedd.." : $msg;


// print_r($propertyData);exit;

$head = '<link rel="stylesheet" href=' . $CSS_PATH . '/custom.css>';
$li_data = Type::getHtml($propertyData, $msg2, $UID , $addItem);

?>

<?php echo $head ?>
<?php echo $li_data; ?>




<a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a>