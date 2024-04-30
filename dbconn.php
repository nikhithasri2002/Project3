<?php


include_once("./config.php");

include_once("$CLASS_PATH/class.DB.php");

$conn = new DB(DBHOST, DBUSER, DBPASS, DBNAME);
