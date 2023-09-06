<?php
    require('../connectdb.php');
    if($_GET['s_mode']){
        echo '<option value="0">เลือกชนิดพืช</option>';
        $stmt_mspr = $dbcon->query("SELECT * FROM `tbn_plant_name` ORDER BY plant_id  ");
        while ($row_mspr = $stmt_mspr->fetch()) {
            echo '<option value="'.$row_mspr[0].'">'.$row_mspr[2].'</option>';
        }
    }else {
        $id = $_GET['id'];
        // echo $id;
        echo '<option value="0">เลือกคอล์ป</option>';
        $stmt = $dbcon->query("SELECT plantD_colp FROM `tbn_plant_data` WHERE `plantD_sid` = '$id' GROUP BY `plantD_colp`");
        while ($row_spr2 = $stmt->fetch()) {
            echo '<option value="'.$row_spr2['plantD_colp'].'">'.$row_spr2['plantD_colp'].'</option>';
        }
    }

?>
