<?php
// session_start();
require "../connectdb.php";
$house_master = $_POST["house_master"];
// $channel = $_POST["channel"];
$row_master = $dbcon->query("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE house_master = '$house_master'")->fetch();
$row_2 = $dbcon->query("SELECT * FROM tbn_dashstatus WHERE dashstatus_sn = '$house_master'")->fetch();
$row_3 = $dbcon->query("SELECT * FROM tbn_dashname WHERE dashname_sn = '$house_master'")->fetch();
$row_4 = $dbcon->query("SELECT * FROM tbn_dashchannel WHERE dashchannel_sn = '$house_master'")->fetch();
$row_5 = $dbcon->query("SELECT * FROM tbn_dashmode WHERE dashmode_sn = '$house_master'")->fetch();
$row_9 = $dbcon->query("SELECT * FROM tbn_map_img WHERE map_sn = '$house_master'")->fetch();

for($i = 1; $i <= 40; $i++){
    // if($row_2[($i+1)] == 1){
        $dashStatus[$i] = intval($row_2[($i+1)]);
        $dashName[$i] = $row_3[($i+41)]; // บน
        $dashName2[$i] = $row_3[($i+1)];  // ล่าง
        $dashSncanel[$i] = $row_4[($i+1)];
        $dashMode[$i] = intval($row_5[($i+1)]);
        $imgMap[$i] = $row_9[($i+1)];
    // }
}

$row_sn = $dbcon->query("SELECT * FROM tb_sensor");
foreach ($row_sn as $row_) {
    $sensor[] = $row_;
}


$row_6 = $dbcon->query("SELECT * FROM tbn_controlstatus WHERE controlstatus_sn = '$house_master'")->fetch();
$row_7 = $dbcon->query("SELECT * FROM tbn_conttrolname WHERE conttrolname_sn = '$house_master'")->fetch();
$row_8 = $dbcon->query("SELECT * FROM tbn_controlmode WHERE controlmode_sn = '$house_master'")->fetch();
for($i = 1; $i <= 12; $i++){
    // if($row_6[($i+1)] == 1){
        $controlstatus[$i] = intval($row_6[($i+1)]);
        $conttrolname[$i] = $row_7[($i+1)];
        $controlcanel[$i] = intval($row_8[($i+1)]);
    // }
}

$row_cn = $dbcon->query("SELECT * from tb_loard");
foreach ($row_cn as $row_) {
    $control[] = $row_;
}
// ----------------------
$account_id = $_SESSION['account_id'];
$houseID = $row_master['house_id'];
if($_SESSION['account_status'] > 2){
    $row_6 = $dbcon->query("SELECT `userST_level` FROM `tbn_userst` WHERE `userST_accountID`=$account_id AND `userST_houseID`=$houseID")->fetch();
    $account_status = $row_6['userST_level'];
}else {
    $account_status = $_SESSION['account_status'];
}
$row_m = $dbcon->query("SELECT * FROM tbn_set_maxmin WHERE set_maxmin_sn = '$house_master'")->fetch();
// echo "SELECT * FROM tbn_set_maxmin WHERE set_maxmin_sn = '$house_master'<br>";
// echo json_encode($row_m);
// exit();
$set_maxmin = [
    'Tmin' => $row_m["set_Tmin"],
    'Tmax' => $row_m["set_Tmax"],
    'Hmin' => $row_m["set_Hmin"],
    'Hmax' => $row_m["set_Hmax"],
    'Lmin' => $row_m["set_Lmin"],
    'Lmax' => $row_m["set_Lmax"],
    'Smin' => $row_m["set_Smin"],
    'Smax' => $row_m["set_Smax"]
];
echo json_encode([
    's_master'=> $row_master,
    'dashStatus'=> $dashStatus,
    'dashName'=> $dashName,
    'dashName2'=> $dashName2,
    'dashSncanel'=> $dashSncanel,
    'dashMode'=> $dashMode,
    's_sensor'=> $sensor,
    'set_maxmin' => $set_maxmin,
    'controlStatus'=> $controlstatus,
    'conttrolname'=> $conttrolname,
    'controlMode'=> $controlcanel,
    's_control'=> $control,
    'imgMap' => $imgMap,
    // 'meter_status' => $meter_status,
    // 'meter_chenal' => $meter_chenal,
    // 'meter_mode' => $meter_mode,
    // 'meterImg' => $meterImg,
    // 'meterUnit' => $meterUnit,
    // 'time_update' => $r,
    // 'theme' => $_SESSION["login_theme"],
    'account_user' => $_SESSION['account_user'],
    'userLevel'=> $account_status,
    // $row_m
]);

exit();
$row_10 = $dbcon->query("SELECT * FROM tb3_meter_status WHERE meter_status_sn = '$house_master'")->fetch();
$row_11 = $dbcon->query("SELECT * FROM tb3_meter_chenal_mode WHERE meter_chenal_mode_sn = '$house_master'")->fetch();

$meter_status[1] = intval($row_10["meter_status_v"]);
$meter_status[2] = intval($row_10["meter_status_a"]);
$meter_status[3] = intval($row_10["meter_status_p"]);
$meter_status[4] = intval($row_10["meter_status_pf"]);
$meter_status[5] = intval($row_10["meter_status_engy"]);
$meter_status[6] = intval($row_10["meter_status_water"]);
$meter_status[7] = intval($row_10["meter_status_wind_speed"]);
$meter_status[8] = intval($row_10["meter_status_wind_direction"]);

$meter_chenal[1] = $row_11["meter_chenal_1"];
$meter_chenal[2] = $row_11["meter_chenal_2"];
$meter_chenal[3] = $row_11["meter_chenal_3"];
$meter_chenal[4] = $row_11["meter_chenal_4"];
$meter_chenal[5] = $row_11["meter_chenal_5"];
$meter_chenal[6] = $row_11["meter_chenal_6"];
$meter_chenal[7] = $row_11["meter_chenal_7"];
$meter_chenal[8] = $row_11["meter_chenal_8"];

$meter_mode[1] = $row_11["meter_mode_1"];
$meter_mode[2] = $row_11["meter_mode_2"];
$meter_mode[3] = $row_11["meter_mode_3"];
$meter_mode[4] = $row_11["meter_mode_4"];
$meter_mode[5] = $row_11["meter_mode_5"];
$meter_mode[6] = $row_11["meter_mode_6"];
$meter_mode[7] = $row_11["meter_mode_7"];

if ($meter_status[1] == 1) {
    $resm_1 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[1]' ")->fetch();
    $meterImg['Img_v'] = $resm_1["sensor_imgNor"];
    $meterUnit['Unit_v'] = $resm_1["sensor_unit"];
}else{
    $meterImg['Img_v'] = "";
    $meterUnit['Unit_v'] = "";
}
if ($meter_status[2] == 1) {
    $resm_2 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[2]' ")->fetch();
    $meterImg['Img_a'] = $resm_2["sensor_imgNor"];
    $meterUnit['Unit_a'] = $resm_2["sensor_unit"];
}else{
    $meterImg['Img_a'] = "";
    $meterUnit['Unit_a'] = "";
}
if ($meter_status[3] == 1) {
    $resm_3 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[3]' ")->fetch();
    $meterImg['Img_p'] = $resm_3["sensor_imgNor"];
    $meterUnit['Unit_p'] = $resm_3["sensor_unit"];
}else{
    $meterImg['Img_p'] = "";
    $meterUnit['Unit_p'] = "";
}
if ($meter_status[4] == 1) {
    $resm_4 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[4]' ")->fetch();
    $meterImg['Img_pf'] = $resm_4["sensor_imgNor"];
    $meterUnit['Unit_pf'] = $resm_4["sensor_unit"];
}else{
    $meterImg['Img_pf'] = "";
    $meterUnit['Unit_pf'] = "";
}
if ($meter_status[5] == 1) {
    $resm_5 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[5]' ")->fetch();
    $meterImg['Img_engy'] = $resm_5["sensor_imgNor"];
    $meterUnit['Unit_engy'] = $resm_5["sensor_unit"];
}else{
    $meterImg['Img_engy'] = "";
    $meterUnit['Unit_engy'] = "";
}
if ($meter_status[6] == 1) {
    $resm_6 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[6]' ")->fetch();
    $meterImg['Img_water'] = $resm_6["sensor_imgNor"];
    $meterUnit['Unit_water'] = $resm_6["sensor_unit"];
}else{
    $meterImg['Img_water'] = "";
    $meterUnit['Unit_water'] = "";
}
if ($meter_status[7] == 1) {
    $resm_7 = $dbcon->query("SELECT * from tb_sensor  WHERE sensor_id = '$meter_mode[7]' ")->fetch();
    $meterImg['Img_wind_speed'] = $resm_7["sensor_imgNor"];
    $meterUnit['Unit_wind_speed'] = $resm_7["sensor_unit"];
}else{
    $meterImg['Img_wind_speed'] = "";
    $meterUnit['Unit_wind_speed'] = "";
}
$row_9 = $dbcon->query("SELECT `data_timestamp` FROM `tb_data_sensor` WHERE `data_sn`= '$house_master' ORDER BY `data_id` DESC LIMIT 1")->fetch();
 if($row_9 == false){
     $r = false;
 }else{
     $r = $row_9[0];
 }
echo json_encode([
    's_master'=> $row_master,
    'dashStatus'=> $dashStatus,
    'dashName'=> $dashName,
    'dashSncanel'=> $dashSncanel,
    'dashMode'=> $dashMode,
    's_sensor'=> $row_sensor,
    'controlstatus'=> $controlstatus,
    'conttrolname'=> $conttrolname,
    'imgCon'=> [
        'drip_1'=> $drip_1,
        'drip_2'=> $drip_2,
        'drip_3'=> $drip_3,
        'drip_4'=> $drip_4,
        'drip_5'=> $drip_5,
        'drip_6'=> $drip_6,
        'drip_7'=> $drip_7,
        'drip_8'=> $drip_8,
        'foggy'=> $foggy,
        'fan'=> $fan,
        'shader'=> $shader,
        'fertilizer'=> $fertilizer
    ],
    'ingMap' => $ingMap,
    'meter_status' => $meter_status,
    'meter_chenal' => $meter_chenal,
    'meter_mode' => $meter_mode,
    'meterImg' => $meterImg,
    'meterUnit' => $meterUnit,
    'time_update' => $r,
    'theme' => $_SESSION["login_theme"],
    'user' => $_SESSION['account_user']
]);
