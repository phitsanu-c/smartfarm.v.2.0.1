<?php
    require "connectdb.php";

    // function MonthDays($someMonth, $someYear){
    //     return date("t", strtotime($someYear . "-" . $someMonth . "-01"));
    // }

    $house_master = $_POST["house_master"];
    // $date = date($_POST["date"]);
    $date = date("Y/m/d", strtotime('-1 day'));
    // echo $start_day;
    // exit();
    $chack_ = $dbcon->query("SELECT COUNT('analyzeData_sn') FROM tb_analyzedata WHERE analyzeData_sn = '$house_master' AND analyzeData_date = '$date' ")->fetch();
    // echo $chack_[0];
    //  exit();
    if($chack_[0] > 0){
        echo json_encode(['status' => "มีข้อมูลแล้ว"], JSON_UNESCAPED_UNICODE );
    }else{
        $row = $dbcon->query("SELECT data_date, count(data_id) AS count_data FROM tb_data_sensor WHERE data_sn = '$house_master' AND data_date ='$date' ")->fetch();
        if ($dbcon->prepare("INSERT INTO `tb_analyzedata`(`analyzeData_date`, `analyzeData_sn`, `analyzeData_count`) VALUES (:p1, :p2, :p3)")->execute(['p1'=>$row['data_date'], 'p2'=>$house_master, 'p3'=>$row['count_data']]) === TRUE) {
            echo json_encode(['status'=>"success"]);
        }else{
            echo json_encode(['status'=>"error"]);
        }
    }