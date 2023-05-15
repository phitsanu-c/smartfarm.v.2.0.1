<?php
    require '../../phpMQTT.php';
    require "../connectdb.php";
    $host = '203.150.37.144';     // change if necessary
    $port = 1883;                     // change if necessary
    $username = '';                   // set your username
    $password = '';                   // set your password

    $data = [
        'dt' => date("Y-m-d H:i:s"),
        'sn' => $_POST['sn'],
        'mode' => $_POST['mode'],
        'user' => $_POST['user'],

    ];
    if(isset($_POST['submode'])){
        $data['submode'] = $_POST['submode'];
    }else {
        $data['submode'] = '';
    }
    if(isset($_POST['num_'])){
        $data['num_'] = $_POST['num_'];
    }else {
        $data['num_'] = '';
    }
    $mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
    if ($mqtt->connect(true,NULL,$username,$password)) {
        $sn = $_POST['sn'];
        if(isset($_POST['mode'])){
            if($_POST['mode'] == "Timer"){
                $mqtt->publish($sn.'/control/loads/user_control', $_POST['user'], 1);
                $mqtt->publish($sn.'/control/loads_auto/'.$_POST['load'], $_POST['status'], 1);
                $data['load'] = $_POST['load'];
                $data['status'] = $_POST['status'];
                $sql = "INSERT INTO `tbn_log_mode_auto`(
                        `log_dt`, `log_sn`, `log_mode`, `log_submode`, `log_load`, `log_status`, `log_user`, `log_num`)
                        VALUES (
                        :dt, :sn, :mode, :submode,
                        :load, :status, :user, :num_)";
                if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                    echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
                }else{
                    echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
                }
            }else{
                $load = json_decode($_POST['load']);
                $status = json_decode($_POST['status']);
                $mqtt->publish($sn.'/control/loads/user_control', $_POST['user'], 1);
                for($i = 0; $i < count($load); $i++){
                    $mqtt->publish($sn.'/control/loads_auto/'.$load[$i], $status[$i], 1);
                    $data['load'] = $load[$i];
                    $data['status'] = $status[$i];
                    $sql = "INSERT INTO `tbn_log_mode_auto`(
                            `log_dt`, `log_sn`, `log_mode`, `log_submode`, `log_load`, `log_status`, `log_user`, `log_num`)
                            VALUES (
                            :dt, :sn, :mode, :submode,
                            :load, :status, :user, :num_)";
                    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                        echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
                    }else{
                        echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
                    }
                }
            }
        }else{
            $mqtt->publish($sn.'/control/loads/user_control', $_POST['user'], 1);
            $mqtt->publish($sn.'/control/loads_auto/'.$_POST['load'], $_POST['status'], 1);
            $data['load'] = $_POST['load'];
            $data['status'] = $_POST['status'];
            $sql = "INSERT INTO `tbn_log_mode_auto`(
                    `log_dt`, `log_sn`, `log_mode`, `log_submode`, `log_load`, `log_status`, `log_user`, `log_num`)
                    VALUES (
                    :dt, :sn, :mode, :submode,
                    :load, :status, :user, :num_)";
            if ($dbcon->prepare($sql)->execute($data) === TRUE) {
                echo json_encode(['status' => "OK",'data' => "Insert_Success" ], JSON_UNESCAPED_UNICODE );
            }else{
                echo json_encode(['status' => 'Error','data' => "Insert_Error"] , JSON_UNESCAPED_UNICODE );
            }
        }
    }
    $mqtt->close();
