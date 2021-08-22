<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
//    $dbname = "housing-co";
    $dbname = "real-estate";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
//    $conn = new mysqli(localhost, root, "", housing-co);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>