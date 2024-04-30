<?php 
require("session.php");
// require("dbconn.php");
$user = $session->get("userArray");
if(!isset($user) || $user == null){
    header("location:index.php");
}


require("./propertygrid.php")
?>