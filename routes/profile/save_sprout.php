<?php
    require "../connectdb.php";
    if($_POST['mode'] == 1){
        $name = $_POST['name'];
        $sid = $_POST['id'];
        if($name == 'delete_spr_name'){
            if ($dbcon->prepare("DELETE FROM `tbn_plant_name` WHERE plant_id = '$sid' ")->execute() === TRUE) {
                echo json_encode(['status' => 'Delete_success']);
            }else {
                echo json_encode(['status' => 'error']);
            }
        }
        else {
            if($sid == ''){
                $row = $dbcon->query("SELECT count(`plant_name`) FROM `tbn_plant_name` WHERE plant_name = '$name'")->fetch();
                if($row[0] == 1){
                    echo json_encode(['status' => 'sum']);
                }else {
                    if ($dbcon->prepare("INSERT INTO `tbn_plant_name` (plant_name) VALUES ('$name')")->execute() === TRUE) {
                        echo json_encode(['status' => 'success']);
                    }else {
                        echo json_encode(['status' => 'error']);
                    }
                }
            }else {
                $row = $dbcon->query("SELECT `plant_name` FROM `tbn_plant_name` WHERE plant_id = '$sid'")->fetch();
                if($row[0] != $name){
                    $row2 = $dbcon->query("SELECT count(`plant_name`) FROM `tbn_plant_name` WHERE plant_name = '$name'")->fetch();
                    if($row2[0] == 1){
                        echo json_encode(['status' => 'sum']);
                        return false;
                    }
                }
                $data = [
                    'dt' => date("Y-m-d H:m:s"),
                    'name' => $name,
                    'colp' => $_POST['colp'],
                    'id' => $sid
                ];
                // echo json_encode($data);
                if ($dbcon->prepare("UPDATE `tbn_plant_name` SET `plant_timestamp` = :dt, `plant_name` = :name, `plant_colp`= :colp WHERE `plant_id` = :id ")->execute($data) === TRUE) {
                    echo json_encode(['status' => 'success']);
                }else {
                    echo json_encode(['status' => 'error']);
                }
            }
        }
    } else { // data_spr
        $sid = $_POST['id'];
        if ($_POST['vel_s'] == 'delete_spr_data') {
            if ($dbcon->prepare("DELETE FROM `tbn_plant_data` WHERE plantD_id = '$sid' ")->execute() === TRUE) {
                echo json_encode(['status' => 'Delete_success']);
            }else {
                echo json_encode(['status' => 'error']);
            }
        }else {
            $data = [
                'vel_s' => $_POST['vel_s'],
                'vel_c' => $_POST['vel_c'],
                'vel_d' => $_POST['vel_d'],
                'vel_h' => $_POST['vel_h'],
                'vel_w' => $_POST['vel_w'],
                'vel_b' => $_POST['vel_b'],
                'vel_p' => $_POST['vel_p'],
                'vel_g' => $_POST['vel_g'],
                'note' => $_POST['note']
            ];
            if($sid == ''){
                if ($dbcon->prepare("INSERT INTO `tbn_plant_data`
                    (`plantD_sid`, `plantD_colp`, `plantD_day_planting`, `plantD_height`,
                    `plantD_canopy_width`, `plantD_num_leaves`, `plantD_leaf_area`, `plantD_weight`, `plantD_note`) VALUES
                    (:vel_s, :vel_c, :vel_d, :vel_h, :vel_w, :vel_b, :vel_p, :vel_g, :note )")->execute($data) === TRUE) {
                    echo json_encode(['status' => 'success']);
                }else {
                    echo json_encode(['status' => 'error']);
                }
            }else {
                $data['id'] = $_POST['id'];
                // echo json_encode($data); exit();
                if ($dbcon->prepare("UPDATE `tbn_plant_data` SET
                    `plantD_sid` = :vel_s, `plantD_colp` = :vel_c, `plantD_day_planting` = :vel_d, `plantD_height` = :vel_h,
                    `plantD_canopy_width` = :vel_w, `plantD_num_leaves` = :vel_b, `plantD_leaf_area` = :vel_p, `plantD_weight` = :vel_g, `plantD_note` = :note
                     WHERE `plantD_id` = :id ")->execute($data) === TRUE) {
                    echo json_encode(['status' => 'success']);
                }else {
                    echo json_encode(['status' => 'error']);
                }
            }
        }
    }
?>
