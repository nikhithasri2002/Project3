<?php

require("dbconn.php");
require("session.php");

if (isset($_POST["profileUpdate"])) {
    // Get form data
    $name = isset($_POST["profileName"]) ? $_POST["profileName"] : "";
    $email = isset($_POST["profileEmail"]) ? $_POST["profileEmail"] : "";
    $mobile = isset($_POST["profileMobile"]) ? $_POST["profileMobile"] : "";

    // Get user data from session
    $userData = $session->get('userArray');
    $userID = isset($_POST["userID"]) ? $_POST["userID"] : 0;

    // Check if profile image is uploaded
    if (!empty($_FILES["profileImg"]["tmp_name"])) {
        $targetDir = "uploads/";
        $profileImg = $targetDir . basename($_FILES["profileImg"]["name"]);
        move_uploaded_file($_FILES["profileImg"]["tmp_name"], $profileImg);
    } else {
        // If no profile image uploaded, use the existing one from session
        $profileImg = isset($userData["uimage"]) ? $userData["uimage"] : "";
    }

    // Check if any data has changed
    if ($userData["uname"] != $name || $userData["uemail"] != $email || $userData["uphone"] != $mobile || $userData["uimage"] != $profileImg) {
        // Update user data in the database
        $update_sql = "UPDATE `user` SET `uname`='$name', `uemail`='$email', `uphone`='$mobile', `uimage`='$profileImg' WHERE uid =$userID";
        $update_result = $conn->update_raw($update_sql);
        if ($update_result > 0) {
            // Update user data in session
            $userData["uname"] = $name;
            $userData["uemail"] = $email;
            $userData["uphone"] = $mobile;
            $userData["uimage"] = $profileImg;
            $session->set('userArray', $userData);

            header("location:sellerdashboard.php?action=yourproperty&userID=$userID&type=buyer");
            exit;
        } else {
            $error = "Error updating profile.";
        }
    } else {
        // No changes were made
        header("location:sellerdashboard.php?action=yourproperty&userID=$userID&type=buyer");
        exit;
    }
}
