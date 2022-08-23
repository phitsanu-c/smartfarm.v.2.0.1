<?php
    require "../connectdb.php";
    require 'phpMQTT.php';
    $house_master = $_POST['house_master'];

    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password
    $topic = $house_master."/control/config/auto";
    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
    //
    if ($mqtt->connect(true,NULL,$username,$password)) {
        $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);
        $array_mq = explode(PHP_EOL,$data_mq);
        for($i = 0; $i < 13; $i++){
            if($i ==0){$array1[] = substr($array_mq[$i],2);}else { $array1[] = $array_mq[$i]; }
            $array2[] = $array_mq[($i+(13*1))];
            $array3[] = $array_mq[($i+(13*2))];
            $array4[] = $array_mq[($i+(13*3))];
            $array5[] = $array_mq[($i+(13*4))];
            $array6[] = $array_mq[($i+(13*5))];
            $array7[] = $array_mq[($i+(13*6))];
            $array8[] = $array_mq[($i+(13*7))];
            $array9[] = $array_mq[($i+(13*8))];
            $array10[] = $array_mq[($i+(13*9))];
            $array11[] = $array_mq[($i+(13*10))];
            $array12[] = $array_mq[($i+(13*11))];
        }
        if($_POST['sel_1'] == 1){ $new_array[] = implode(PHP_EOL,$array1); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[dripper_1]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_2'] == 1){ $new_array[] = implode(PHP_EOL,$array2); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[dripper_2]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_3'] == 1){ $new_array[] = implode(PHP_EOL,$array3); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[dripper_3]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_4'] == 1){ $new_array[] = implode(PHP_EOL,$array4); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[dripper_4]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_5'] == 1){ $new_array[] = implode(PHP_EOL,$array5); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[fan_1]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_6'] == 1){ $new_array[] = implode(PHP_EOL,$array6); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[fan_2]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_7'] == 1){ $new_array[] = implode(PHP_EOL,$array7); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[fan_3]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_8'] == 1){ $new_array[] = implode(PHP_EOL,$array8); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[fan_4]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_9'] == 1){ $new_array[] = implode(PHP_EOL,$array9); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[foggy_1]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_10'] == 1){ $new_array[] = implode(PHP_EOL,$array10); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[foggy_2]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_11'] == 1){ $new_array[] = implode(PHP_EOL,$array11); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[spray]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        if($_POST['sel_12'] == 1){ $new_array[] = implode(PHP_EOL,$array12); }
        else {
            $new_array[] = implode(PHP_EOL,[
                        '[shading]',
                        'S_1=99:99',
                        'E_1=99:99',
                        'S_2=99:99',
                        'E_2=99:99',
                        'S_3=99:99',
                        'E_3=99:99',
                        'S_4=99:99',
                        'E_4=99:99',
                        'S_5=99:99',
                        'E_5=99:99',
                        'S_6=99:99',
                        'E_6=99:99'
                    ]);
        }
        $data = [
            'p1' => $_POST['sel_1'],
            'p2' => $_POST['sel_2'],
            'p3' => $_POST['sel_3'],
            'p4' => $_POST['sel_4'],
            'p5' => $_POST['sel_5'],
            'p6' => $_POST['sel_6'],
            'p7' => $_POST['sel_7'],
            'p8' => $_POST['sel_8'],
            'p9' => $_POST['sel_9'],
            'p10' => $_POST['sel_10'],
            'p11' => $_POST['sel_11'],
            'p12' => $_POST['sel_12'],
            'n1' => $_POST['name_1'],
            'n2' => $_POST['name_2'],
            'n3' => $_POST['name_3'],
            'n4' => $_POST['name_4'],
            'n5' => $_POST['name_5'],
            'n6' => $_POST['name_6'],
            'n7' => $_POST['name_7'],
            'n8' => $_POST['name_8'],
            'n9' => $_POST['name_9'],
            'n10' => $_POST['name_10'],
            'n11' => $_POST['name_11'],
            'n12' => $_POST['name_12'],
            'sn'  => $house_master
        ];
        $sql = "UPDATE `tbn_status_cn` SET `cn_status_1`=:p1,`cn_status_2`=:p2,`cn_status_3`=:p3,`cn_status_4`=:p4,`cn_status_5`=:p5,`cn_status_6`=:p6,`cn_status_7`=:p7,`cn_status_8`=:p8,`cn_status_9`=:p9,`cn_status_10`=:p10,`cn_status_11`=:p11,`cn_status_12`=:p12,
                                            `cn_name_1`=:n1,`cn_name_2`=:n2,`cn_name_3`=:n3,`cn_name_4`=:n4,`cn_name_5`=:n5,`cn_name_6`=:n6,`cn_name_7`=:n7,`cn_name_8`=:n8,`cn_name_9`=:n9,`cn_name_10`=:n10,`cn_name_11`=:n11,`cn_name_12`=:n12 WHERE `cn_status_sn`=:sn ";
        if ($dbcon->prepare($sql)->execute($data) === TRUE) {
            $mqtt->publish($topic, implode(PHP_EOL,$new_array), 1);
            $mqtt->close();
            echo json_encode(['status' => "Insert_success", "data" => $data], JSON_UNESCAPED_UNICODE );
        }else{
            echo json_encode(['status' => "Insert_Error"], JSON_UNESCAPED_UNICODE );
        }
    }
?>
