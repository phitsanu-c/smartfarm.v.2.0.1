<?php
    // session_start();
    
    $db["host"] = "localhost";
    $db["user"] = "root";
    $db["pass"] = "67235520";
    $db["name"] = "new_smartfarm"; //"inet_mqtt_smart_farm"; //"smart_farm_mqtt";

    try{
        $dbcon = new PDO( "mysql:host=".$db["host"]."; dbname=".$db["name"]."", $db["user"], $db["pass"],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    function MonthDays($someMonth, $someYear){
        return date("t", strtotime($someYear . "-" . $someMonth . "-01"));
    }

    $house_master = $_POST["sn"];
    if ($_POST["month"] <10) {
        $month = '0'.$_POST["month"];
    }else{
        $month = $_POST["month"];
    }
    for($i= 1; $i<= $_POST["getDay"]; $i++){
        if($i < 10){
            $date = $_POST["year"].'/'.$month.'/0'.$i;
        }else{
            $date = $_POST["year"].'/'.$month.'/'.$i;
        }
        $chack_ = $dbcon->query("SELECT COUNT('analyzeData_sn') FROM tb_analyzedata WHERE analyzeData_sn = '$house_master' AND analyzeData_date = '$date' ")->fetch();
        if($chack_[0] > 0){
            if($i == $_POST["getDay"]){
                echo json_encode(['status' => "มีรายชื่อนี้แล้ว"], JSON_UNESCAPED_UNICODE );
            }
        }else{
            // $stmt2 = $dbcon->query("SELECT count(data_id) AS count_data FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_date ='$date'")->fetch();
            // if($stmt2[0] == 0){
            //     if($i == $_POST["getDay"]){
            //         echo json_encode(['status' => "No data",$stmt2[0]], JSON_UNESCAPED_UNICODE );                    
            //     }else{
            //         echo json_encode(['status' => "No data",$stmt2[0]], JSON_UNESCAPED_UNICODE ); 
            //     }
            //     exit();
            // }
            $sql = "SELECT data_date, count(data_id) AS count_data FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_date ='$date' ";
            $stmt = $dbcon->query($sql);
            while ($row = $stmt->fetch()) {
                // echo $date.' - '.$row['data_date'].", ".$house_master.", ".$row['count_data']."<br />\n";
                // exit();
                if ($dbcon->prepare("INSERT INTO `tb_analyzedata`(`analyzeData_date`, `analyzeData_sn`, `analyzeData_count`) VALUES (:p1, :p2, :p3)")->execute(['p1'=>$row['data_date'], 'p2'=>$house_master, 'p3'=>$row['count_data']]) === TRUE) {
                    if($i == $_POST["getDay"]){
                        echo json_encode(['status'=>"success"]);
                    }
                }else{
                    if($i == $_POST["getDay"]){
                        echo json_encode(['status'=>"error"]);
                    }
                }
            }
        }
    }