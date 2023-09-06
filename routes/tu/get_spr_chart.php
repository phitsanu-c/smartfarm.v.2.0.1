<?php
    require "../connectdb.php";
    $val = $_POST['val'];
    $s_id = $_POST['s_id'];
    $r_colp = $dbcon->query("SELECT `plant_colp` FROM `tbn_plant_name` WHERE `plant_id`='$s_id' ")->fetch();
    $s_colp = $r_colp[0]; //$_POST['colp'];
    $channel[] = "plantD_day_planting AS nDate";
    // echo $val[4];
    for ($i=0; $i < 5; $i++) {
        if(isset($val[$i])){
            if($val[$i] == 0){
                $channel[] = "plantD_height AS data_".($i+1);
            }
            if($val[$i] == 1){
                $channel[] = "plantD_canopy_width AS data_".($i+1);
            }
            if($val[$i] == 2){
                $channel[] = "plantD_num_leaves AS data_".($i+1);
            }
            if($val[$i] == 3){
                $channel[] = "plantD_leaf_area AS data_".($i+1);
            }
            if($val[$i] == 4){
                $channel[] = "plantD_weight AS data_".($i+1);
            }
        }
    }
    $cha_list = implode(', ',$channel);
    // echo $cha_list.' x '.implode(', ',$val);exit();
    $sql = "SELECT $cha_list FROM `tbn_plant_data` WHERE plantD_sid = '$s_id' AND plantD_colp = '$s_colp' ";
    $stmt = $dbcon->query($sql);
    // $i = 1;
    $count_columns = count($val);
    // echo $count_columns;exit();
    while ($row = $stmt->fetch()) {
        $data0['timestamp'][] = $row['nDate'];
        if($count_columns >= 1){
            $data0['data_1'][] = $row['data_1'];
        }
        if($count_columns >= 2){
            $data0['data_2'][] = $row['data_2'];
        }
        if($count_columns >= 3){
            $data0['data_3'][] = $row['data_3'];
        }
        if($count_columns >= 4){
            $data0['data_4'][] = $row['data_4'];
        }
        if($count_columns >= 5){
            $data0['data_5'][] = $row['data_5'];
        }
       // $i++;
    }
 // DATE_FORMAT(NOW(),'%Y-%m-%d %H-%i-%s')
// echo $sql;
// echo $channel1;
// exit();
   echo json_encode($data0);
?>
