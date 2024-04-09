<?php
    // // Database connection settings
    // $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    // $connectionOptions = array(
    //     "Database" => "Speed_Geer",
    //     "Uid" => "your_username",
    //     "PWD" => "your_password"
    // );

    // Database connection settings
    // $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    // $connectionOptions = array( "Database" => "Speed_Geer", "CharacterSet" => "UTF-8");


    $serverName = "DESKTOP-I92KCB1\SQLEXPRESS";
    $connectionOptions = array( "Database" => "Speed_Geer", 
                                 "CharacterSet" => "UTF-8"
                                );

    // Establishing the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
?>    