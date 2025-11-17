<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "web_vulnerabilities";

    // Create connection
    $con = mysqli_connect($servername, $username, $password, $database);

    // Nếu kết nối không thành công thì $con sẽ bằng false
    if (!$con) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
