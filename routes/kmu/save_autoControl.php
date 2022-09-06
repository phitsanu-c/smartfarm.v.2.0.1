<?php
    require '../connectdb2.php';
    require '../tu/phpMQTT.php';
    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password
    // echo $_POST['topic2'].'<br>'.$_POST['user'].'<br>'.$_POST['topic'].'<br>'.$_POST['mess'];
    // exit();
    // $topic = $_POST['topic'];
    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());

    $house_master = $_POST["house_master"];
    $A1 =  explode(";",$_POST["A1"]);
    $A2 =  explode(";",$_POST["A2"]);
    $A3 =  explode(";",$_POST["A3"]);
    // $A4 =  explode(";",$_POST["A4"]);
    $A5 =  explode(";",$_POST["A5"]);

    $data = [
        // 'a1'    => $day_date." - ".$today_time,
        'min1' => $A1[0],
        'max1' => $A1[1],
        'min2' => $A2[0],
        'max2' => $A2[1],
        'min3' => $A3[0],
        'max3' => $A3[1],
        // 'min4' => $A4[0] + $row["loadm_B4"] ) / $row["loadm_A4"] ,4),
        // 'max4' => $A4[1] + $row["loadm_B4"] ) / $row["loadm_A4"] ,4),
        'min5' => $A5[0],
        'max5' => $A5[1],
        'sn'   => $house_master,
        'account_user' => $_SESSION['account_user']
    ];
    // print_r($data);
    // exit();
    $sql_maxmin = "INSERT INTO tb_control_maxmin (
                            maxmin_min_1, maxmin_max_1, maxmin_min_2, maxmin_max_2,
                            maxmin_min_3, maxmin_max_3, maxmin_min_5, maxmin_max_5, maxmin_max_sn, maxmin_user
                        ) VALUES (:min1, :max1, :min2, :max2, :min3, :max3, :min5, :max5, :sn, :account_user)";
    if ($dbcon->prepare($sql_maxmin)->execute($data) === TRUE) {
        if ($mqtt->connect(true,NULL,$username,$password)) {
            // $mqtt->publish($_POST['topic2'], $_POST['user'], 1);
            // $mqtt->close();

            // $mqtt->publish($_POST['topic'], $_POST['mess'], 1);
            // $mqtt->close();

            $mqtt->publish( $house_master."/1/data_config/data_config_sprinnker_base_down", $A1[0] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_sprinnker_base_up", $A1[1] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_sprinnker_down", $A2[0] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_sprinnker_up", $A2[1] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_foggy_down", $A3[0] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_foggy_up", $A3[1] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_sprinnker_top_down", $A3[0] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_sprinnker_top_up", $A3[1] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_slan_down", $A5[0] , 1);
            $mqtt->publish( $house_master."/1/data_config/data_config_slan_up", $A5[1] , 1);
            $mqtt->close();

            echo json_encode(["Success",$data]);
        }
    }else{
        echo json_encode("Insert_Error");
    }
