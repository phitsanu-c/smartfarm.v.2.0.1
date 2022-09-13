<?php
require '../connectdb.php';
require 'phpMQTT.php';
$host = '203.150.37.144';     // change if necessary
$port = 1883;                     // change if necessary
$username = '';                   // set your username
$password = '';                   // set your password
$topic = "web_system";
$mqtt = new bluerhinos\phpMQTT($host, $port, "ClientID".rand());
//
if ($mqtt->connect(true,NULL,$username,$password)) {
    $data_mq = $mqtt->subscribeAndWaitForMessage($topic, 1);
    $decodedJson = json_decode(substr($data_mq, 2), true);
    $new_dt = ['account_id' => $_SESSION['account_id'], 'name' => $_SESSION["account_user"], 'dt' => date("Y-m-d H:i:s", strtotime('3 hour')), 'siteID' => $_SESSION["sn"]['siteID'], 'count_site' => $_SESSION['sn']['count_site']]; // '-6 hour'));
    $decodedJson[$_SESSION['account_id']] = $new_dt;
    $message = json_encode($decodedJson);
    $mqtt->publish($topic,$message, 1);
    $mqtt->close();
}

$house_master = $_POST["house_master"];
$config_cn = $_POST["config_cn"];
// echo $config_cn["cn_status_1"];
// exit();
for($i=1; $i<=12; $i++){
    if($config_cn["cn_status_".$i] == "1"){
        $tb_name = 'tbn_control_au'.$i;
        $stmt1 = $dbcon->prepare("SELECT * from $tb_name WHERE load_sn = '$house_master' ORDER BY load_id DESC limit 1 ");
        $stmt1->execute();
        $row1 = $stmt1->fetch();
        $load['load_'.$i] = [
            'load_st_1'  => $row1["load_st_1"],
            'load_s_1'   => $row1["load_s_1"],
            'load_e_1'   => $row1["load_e_1"],
            'load_st_2'  => $row1["load_st_2"],
            'load_s_2'   => $row1["load_s_2"],
            'load_e_2'   => $row1["load_e_2"],
            'load_st_3'  => $row1["load_st_3"],
            'load_s_3'   => $row1["load_s_3"],
            'load_e_3'   => $row1["load_e_3"],
            'load_st_4'  => $row1["load_st_4"],
            'load_s_4'   => $row1["load_s_4"],
            'load_e_4'   => $row1["load_e_4"],
            'load_st_5'  => $row1["load_st_5"],
            'load_s_5'   => $row1["load_s_5"],
            'load_e_5'   => $row1["load_e_5"],
            'load_st_6'  => $row1["load_st_6"],
            'load_s_6'   => $row1["load_s_6"],
            'load_e_6'   => $row1["load_e_6"]
        ];
    }else{ $load['load_'.$i] = ""; }

}
// $load['username'] = $_SESSION["Username"]
echo json_encode($load);
exit();
