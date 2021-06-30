<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "agenda777";

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_errno) {
        die("Error de conexión: " . $cnn->connect_error);
    }