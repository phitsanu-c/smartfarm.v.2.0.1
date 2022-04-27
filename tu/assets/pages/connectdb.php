<?php
    // session_start();
    
    // $db["host"] = "localhost";
    $db["host"] = "localhost";
    $db["user"] = "root2";
    $db["pass"] = "67235520";
    $db["name"] = "new_smartfarm"; //"inet_mqtt_smart_farm"; //"smart_farm_mqtt";

    try{
        $dbcon = new PDO( "mysql:host=".$db["host"]."; dbname=".$db["name"]."", $db["user"], $db["pass"],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }

    //วันที่
    date_default_timezone_set('Asia/Bangkok');
    // $today_date=date("d-m-Y");
    // $day_date=date("Y/m/d");
    // $today_time=date("H:i");
    