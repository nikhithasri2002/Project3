<?php
require_once("./session.php");


$session->destroy();

header("Location:index.php");