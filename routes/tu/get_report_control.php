<?php
    require "connect_mqtt_uptime.php";

    $house_master = $_POST["house_master"];
    $config_cn = $_POST["config_cn"];
    $load = $_POST['load_select'];
    // echo $config_cn["cn_status_1"];
    // // exit();

    if ($_POST["mode"] == 'day') {
        $start_day = date("Y-m-d", strtotime('-1 day')).' 00:00:00';
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'week') {
        $start_day = date("Y-m-d", strtotime('-7 day')).' 00:00:00';
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'month') {
        $start_day = date("Y-m-d", strtotime('-30 day')).' 00:00:00';
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'from_to') {
        $start_day = $_POST["val_start"].':00';
        $stop_day = $_POST["val_end"].':00';
    }
    echo '<div class="table-responsive m-t-10">';
        if ($_POST["mode_report"] == 're_conteol_log') { ?>
            <table id="data_table" class="table table-striped table-bordered dataTable" style="width:100%">
                <thead>
                    <tr>
                        <!-- <th class="text-center">#</th> -->
                        <th class="text-center">วัน </th>
                        <th class="text-center">เวลา</th>
                        <th class="text-center">ผู้ดำเนินการ</th>
                        <th class="text-center">โหมด</th>
                        <th class="text-center">โหมดย่อย</th>
                        <?php
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">น้ำหยด 1 '.$config_cn['cn_name_1'].'</th>';}
                            if($config_cn['cn_status_2'] == 1){echo '<th class="text-center">น้ำหยด 2 '.$config_cn['cn_name_2'].'</th>';}
                            if($config_cn['cn_status_3'] == 1){echo '<th class="text-center">น้ำหยด 3 '.$config_cn['cn_name_3'].'</th>';}
                            if($config_cn['cn_status_4'] == 1){echo '<th class="text-center">น้ำหยด 4 '.$config_cn['cn_name_4'].'</th>';}
                            if($config_cn['cn_status_5'] == 1){echo '<th class="text-center">พัดลม 1 '.$config_cn['cn_name_5'].'</th>';}
                            if($config_cn['cn_status_6'] == 1){echo '<th class="text-center">พัดลม 2 '.$config_cn['cn_name_6'].'</th>';}
                            if($config_cn['cn_status_7'] == 1){echo '<th class="text-center">พัดลม 3 '.$config_cn['cn_name_7'].'</th>';}
                            if($config_cn['cn_status_8'] == 1){echo '<th class="text-center">พัดลม 4 '.$config_cn['cn_name_8'].'</th>';}
                            if($config_cn['cn_status_9'] == 1){echo '<th class="text-center">พ่นหมอก 1 '.$config_cn['cn_name_9'].'</th>';}
                            if($config_cn['cn_status_10'] == 1){echo '<th class="text-center">พ่นหมอก 2 '.$config_cn['cn_name_10'].'</th>';}
                            if($config_cn['cn_status_11'] == 1){echo '<th class="text-center">สเปรย์'.$config_cn['cn_name_11'].'</th>';}
                            if($config_cn['cn_status_12'] == 1){echo '<th class="text-center">ม่านพรางแสง</th>';}
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $channel[] = "SUBSTRING(cn_timestamp,1,10) AS nDate";
                        $channel[] = "SUBSTRING(cn_timestamp,-8, 8) AS nTime";
                        $channel[] = "cn_user";
                        $channel[] = "cn_mode";
                        $channel[] = "cn_submode";
                        if($config_cn['cn_status_1'] == 1){$channel[] = "cn_load_1 AS dripper_1";}
                        if($config_cn['cn_status_2'] == 1){$channel[] = "cn_load_2 AS dripper_2";}
                        if($config_cn['cn_status_3'] == 1){$channel[] = "cn_load_3 AS dripper_3";}
                        if($config_cn['cn_status_4'] == 1){$channel[] = "cn_load_4 AS dripper_4";}
                        if($config_cn['cn_status_5'] == 1){$channel[] = "cn_load_5 AS fan_1";}
                        if($config_cn['cn_status_6'] == 1){$channel[] = "cn_load_6 AS fan_2";}
                        if($config_cn['cn_status_7'] == 1){$channel[] = "cn_load_7 AS fan_3";}
                        if($config_cn['cn_status_8'] == 1){$channel[] = "cn_load_8 AS fan_4";}
                        if($config_cn['cn_status_9'] == 1){$channel[] = "cn_load_9 AS foggy_1";}
                        if($config_cn['cn_status_10'] == 1){$channel[] = "cn_load_10 AS foggy_2";}
                        if($config_cn['cn_status_11'] == 1){$channel[] = "cn_load_11 AS spray";}
                        if($config_cn['cn_status_12'] == 1){$channel[] = "cn_load_12 AS shading";}

                        $channel1 = implode(', ',$channel);
                        // exit();
                        if ($_POST["mode"] != 'last_100') {
                            $sql = "SELECT $channel1 FROM tbn_control_log WHERE cn_sn = '$house_master' AND cn_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY cn_timestamp DESC, cn_id DESC";
                        }else {
                            $sql = "SELECT $channel1 FROM tbn_control_log WHERE cn_sn = '$house_master' ORDER BY cn_timestamp DESC, cn_id DESC LIMIT 100 ";
                        }
                        $stmt = $dbcon->query($sql);
                        $rowCount = $stmt->rowCount();
                        $colcount = $stmt->columnCount();
                        while ($row = $stmt->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                            if($row[3] == 'Manual'){ echo '<td class="text-center text-success">กำหนดเอง</td>'; }else { echo '<td class="text-center text-primary">อัตโนมัติ</td>';}
                            if($row[4] == 'Time_set'){echo '<td class="text-center">ตั้งเวลา</td>';}
                            elseif($row[4] == 'Time_loop'){ echo '<td class="text-center">ตั้งเวลาต่อเนื่อง</td>'; }
                            elseif($row[4] == 'Manual'){ echo '<td class="text-center">-</td>'; }
                            elseif($row[4] == 'tracking'){ echo '<td class="text-center">ตามเซนเซอร์</td>'; }
                            else {echo '<td class="text-center">'.$row[4].'</td>';}
                            if($config_cn['cn_status_1'] == 1){ if($row['dripper_1'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_2'] == 1){ if($row['dripper_2'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_3'] == 1){ if($row['dripper_3'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_4'] == 1){ if($row['dripper_4'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_5'] == 1){ if($row['fan_1'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_6'] == 1){ if($row['fan_2'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_7'] == 1){ if($row['fan_3'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_8'] == 1){ if($row['fan_4'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_9'] == 1){ if($row['foggy_1'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_10'] == 1){ if($row['foggy_2'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_11'] == 1){ if($row['spray'] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            if($config_cn['cn_status_12'] == 1){ if($row['shading'] == 'ON'){ echo '<td class="text-center text-danger">ปิดรับแสง</td>'; }else { echo '<td class="text-center text-success">เปิดรับแสง</td>'; } }
                            // if($colcount >= 6){ if($row[5] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 7){ if($row[6] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 8){ if($row[7] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 9){ if($row[8] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 10){ if($row[9] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 11){ if($row[10] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 12){ if($row[11] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 13){ if($row[12] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 14){ if($row[13] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 15){ if($row[14] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 16){ if($row[15] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            // if($colcount >= 17){ if($row[16] == 'ON'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
  <?php }elseif ($_POST["mode_report"] == 're_conteol_Auto_Submode'){ ?>
            <table id="data_table" class="table table-striped table-bordered dataTable" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">วัน </th>
                        <th class="text-center">เวลา</th>
                        <th class="text-center">ผู้สั่งงาน</th>
                        <th class="text-center"> โหมดย่อย </th>
                        <?php
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาน้ำหยด 1 '.$config_cn['cn_name_1'].'</th>';}
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาน้ำหยด 2 '.$config_cn['cn_name_2'].'</th>';}
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาน้ำหยด 3 '.$config_cn['cn_name_3'].'</th>';}
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาน้ำหยด 4 '.$config_cn['cn_name_4'].'</th>';}
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาพ่นหมอก 1 '.$config_cn['cn_name_9'].'</th>';}
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาพ่นหมอก 2 '.$config_cn['cn_name_10'].'</th>';}
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">โหมดตั้งเวลาสเปรย์ '.$config_cn['cn_name_11'].'</th>';}
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $channel[] = "SUBSTRING(cc_timestamp,1,10) AS nDate";
                        $channel[] = "SUBSTRING(cc_timestamp,-8, 8) AS nTime";
                        $channel[] = "cc_user";
                        $channel[] = "cc_submode";
                        if($config_cn['cn_status_1'] == 1){$channel[] = "cc_submode_1 AS dripper_1";}
                        if($config_cn['cn_status_2'] == 1){$channel[] = "cc_submode_2 AS dripper_2";}
                        if($config_cn['cn_status_3'] == 1){$channel[] = "cc_submode_3 AS dripper_31";}
                        if($config_cn['cn_status_4'] == 1){$channel[] = "cc_submode_4 AS dripper_4";}
                        if($config_cn['cn_status_9'] == 1){$channel[] = "cc_submode_9 AS foggy_1";}
                        if($config_cn['cn_status_10'] == 1){$channel[] = "cc_submode_10 AS foggy_2";}
                        if($config_cn['cn_status_11'] == 1){$channel[] = "cc_submode_11 AS spray";}

                        $channel1 = implode(', ',$channel);
                        if ($_POST["mode"] != 'last_100') {
                            $sql = "SELECT $channel1 FROM tbn_control_config WHERE cc_sn = '$house_master' AND cc_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY cc_timestamp DESC, cc_id DESC";
                        }else {
                            $sql = "SELECT $channel1 FROM tbn_control_config WHERE cc_sn = '$house_master' ORDER BY cc_timestamp DESC, cc_id DESC LIMIT 100";
                        }
                        $stmt = $dbcon->query($sql);
                        $rowCount = $stmt->rowCount();
                        $colcount = $stmt->columnCount();
                        while ($row = $stmt->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                            if($row[3] == 'Tracking'){
                                echo '<td class="text-center text-success">ตามเซนเซอร์</td>';
                                if($colcount >= 5){ echo '<td class="text-center"> - </td>'; }
                                if($colcount >= 6){ echo '<td class="text-center"> - </td>'; }
                                if($colcount >= 7){ echo '<td class="text-center"> - </td>'; }
                                if($colcount >= 8){ echo '<td class="text-center"> - </td>'; }
                                if($colcount >= 9){ echo '<td class="text-center"> - </td>'; }
                                if($colcount >= 10){ echo '<td class="text-center"> - </td>'; }
                                if($colcount >= 11){ echo '<td class="text-center"> - </td>'; }
                            }else {
                                echo '<td class="text-center text-primary">ตั้งเวลา</td>';
                                if($colcount >= 5){ if($row[4] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                                if($colcount >= 6){ if($row[5] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                                if($colcount >= 7){ if($row[6] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                                if($colcount >= 8){ if($row[7] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                                if($colcount >= 9){ if($row[8] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                                if($colcount >= 10){ if($row[9] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                                if($colcount >= 11){ if($row[10] == 'Time_set'){echo '<td class="text-center">ตั้งเวลาทำงาน</td>';} else{ echo '<td class="text-center">ตั้งเวลาการทำงานต่อเนื่อง</td>'; } }
                            }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
  <?php }elseif ($_POST["mode_report"] == 're_conteol_Auto_Tracking') { ?>
            <br>
            <table id="data_table" class="table table-striped table-bordered dataTable" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center"><b>ประวัติการตั้งค่าโหมดตามเซนเซอร์</b></th>
                        <th colspan="7" class="text-center" style="background-color:#56e3c4">ความชื้นดิน</th>
                        <th colspan="4" class="text-center" style="background-color:#73de35">ความชื้นอากาศ</th>
                        <th colspan="7" class="text-center" style="background-color:#e571f5">อุณหภูมิ</th>
                        <th colspan="3" class="text-center" style="background-color:#f5ac71">แสง</th>
                    </tr>
                    <tr>
                        <th class="text-center">วัน </th>
                        <th class="text-center">เวลา</th>
                        <th class="text-center">ผู้บันทึก</th>
                        <th class="text-center" style="background-color:#56e3c4">สถานะ</th>
                        <th class="text-center" style="background-color:#56e3c4">เปิดน้ำหยด (%)</th>
                        <th class="text-center" style="background-color:#56e3c4">ปิดน้ำหยด (%)</th>
                        <th class="text-center" style="background-color:#56e3c4">น้ำหยด 1</th>
                        <th class="text-center" style="background-color:#56e3c4">น้ำหยด 2</th>
                        <th class="text-center" style="background-color:#56e3c4">น้ำหยด 3</th>
                        <th class="text-center" style="background-color:#56e3c4">น้ำหยด 4</th>
                        <th class="text-center" style="background-color:#73de35">สถานะ</th>
                        <th class="text-center" style="background-color:#73de35">เปิดพ่นหมอก (%Rh)</th>
                        <th class="text-center" style="background-color:#73de35">ปิดพ่นหมอก-เปิดสเปรย์ (%Rh)</th>
                        <th class="text-center" style="background-color:#73de35">ปิดสเปรย์ (%Rh)</th>
                        <th class="text-center" style="background-color:#e571f5">สถานะ</th>
                        <th class="text-center" style="background-color:#e571f5">เปิดพัดลม (℃)</th>
                        <th class="text-center" style="background-color:#e571f5">ปิดพัดลม (℃)</th>
                        <th class="text-center" style="background-color:#e571f5">พัดลม 1</th>
                        <th class="text-center" style="background-color:#e571f5">พัดลม 2</th>
                        <th class="text-center" style="background-color:#e571f5">พัดลม 3</th>
                        <th class="text-center" style="background-color:#e571f5">พัดลม 4</th>
                        <th class="text-center" style="background-color:#f5ac71">สถานะ</th>
                        <th class="text-center" style="background-color:#f5ac71">เปิดม่านพรางแสง (KLux)</th>
                        <th class="text-center" style="background-color:#f5ac71">ปิดม่านพรางแสง (%Rh)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $channel[] = "SUBSTRING(auto_sensor_timestamp,1,10) AS nDate";
                        $channel[] = "SUBSTRING(auto_sensor_timestamp,-8, 8) AS nTime";
                        $channel[] = "auto_sensor_user";
                        $channel[] = "auto_sensor_status_1";
                        $channel[] = "auto_sensor_soil_min";
                        $channel[] = "auto_sensor_soil_max";
                        $channel[] = "auto_sensor_d_1 AS dripper_1";
                        $channel[] = "auto_sensor_d_2 AS dripper_2";
                        $channel[] = "auto_sensor_d_3 AS dripper_3";
                        $channel[] = "auto_sensor_d_4 AS dripper_4";
                        // if($config_cn['cn_status_1'] == 1){$channel[] = "auto_sensor_d_1 AS dripper_1";}
                        // if($config_cn['cn_status_2'] == 1){$channel[] = "auto_sensor_d_2 AS dripper_2";}
                        // if($config_cn['cn_status_3'] == 1){$channel[] = "auto_sensor_d_3 AS dripper_3";}
                        // if($config_cn['cn_status_4'] == 1){$channel[] = "auto_sensor_d_4 AS dripper_4";}
                        $channel[] = "auto_sensor_status_2";
                        $channel[] = "auto_sensor_hum_min";
                        $channel[] = "auto_sensor_hum_2";
                        $channel[] = "auto_sensor_hum_max";
                        $channel[] = "auto_sensor_status_3";
                        $channel[] = "auto_sensor_temp_max";
                        $channel[] = "auto_sensor_temp_min";
                        $channel[] = "auto_sensor_fn_1 AS fan_1";
                        $channel[] = "auto_sensor_fn_2 AS fan_2";
                        $channel[] = "auto_sensor_fn_3 AS fan_3";
                        $channel[] = "auto_sensor_fn_4 AS fan_4";
                        // if($config_cn['cn_status_5'] == 1){$channel[] = "auto_sensor_fn_1 AS fan_1";}
                        // if($config_cn['cn_status_6'] == 1){$channel[] = "auto_sensor_fn_2 AS fan_2";}
                        // if($config_cn['cn_status_7'] == 1){$channel[] = "auto_sensor_fn_3 AS fan_3";}
                        // if($config_cn['cn_status_8'] == 1){$channel[] = "auto_sensor_fn_4 AS fan_4";}
                        $channel[] = "auto_sensor_status_4";
                        $channel[] = "auto_sensor_light_min";
                        $channel[] = "auto_sensor_light_max";

                        $channel1 = implode(', ',$channel);
                        // exit();
                        if ($_POST["mode"] != 'last_100') {
                            $sql = "SELECT $channel1 FROM tbn_control_sensor_tracking WHERE auto_sensor_sn = '$house_master' AND auto_sensor_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY auto_sensor_timestamp DESC";
                        }else {
                            $sql = "SELECT $channel1 FROM tbn_control_sensor_tracking WHERE auto_sensor_sn = '$house_master' ORDER BY auto_sensor_timestamp DESC LIMIT 100";
                        }
                        $stmt = $dbcon->query($sql);
                        $stmt2 = $dbcon->query($sql);
                        $rowCount = $stmt->rowCount();
                        $colcount = $stmt->columnCount();
                        while ($row = $stmt->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                                if($row[3] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[4].'</td>
                                          <td class="text-center">'.$row[5].'</td>';
                                          if($row[6] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                          if($row[7] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                          if($row[8] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                          if($row[9] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                            ';
                                 }
                                 if($row[10] == '1'){
                                     echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                           <td class="text-center">'.$row[11].'</td>
                                           <td class="text-center">'.$row[12].'</td>
                                           <td class="text-center">'.$row[13].'</td>';
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>';
                                 }
                                 if($row[14] == '1'){
                                     echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                           <td class="text-center">'.$row[15].'</td>
                                           <td class="text-center">'.$row[16].'</td>';
                                           if($row[17] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                           if($row[18] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                           if($row[19] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                           if($row[20] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                            ';
                                 }
                                 if($row[21] == '1'){
                                     echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                           <td class="text-center">'.$row[22].'</td>
                                           <td class="text-center">'.$row[23].'</td>';
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>';
                                 }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            <div id="hide_table" style="display: none">
                <table id="data_table2" class="table table-striped table-bordered dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">วัน </th>
                            <th class="text-center">เวลา</th>
                            <th class="text-center">ผู้บันทึก</th>
                            <th class="text-center">ความชื้นดิน -> สถานะ</th>
                            <th class="text-center">ความชื้นดิน -> เปิดน้ำหยด (%)</th>
                            <th class="text-center">ความชื้นดิน -> ปิดน้ำหยด (%)</th>
                            <th class="text-center">ความชื้นดิน -> น้ำหยด 1</th>
                            <th class="text-center">ความชื้นดิน -> น้ำหยด 2</th>
                            <th class="text-center">ความชื้นดิน -> น้ำหยด 3</th>
                            <th class="text-center">ความชื้นดิน -> น้ำหยด 4</th>
                            <th class="text-center">ความชื้นอากาศ -> สถานะ</th>
                            <th class="text-center">ความชื้นอากาศ -> เปิดพ่นหมอก (%Rh)</th>
                            <th class="text-center">ความชื้นอากาศ -> ปิดพ่นหมอก-เปิดสเปรย์ (%Rh)</th>
                            <th class="text-center">ความชื้นอากาศ -> ปิดสเปรย์ (%Rh)</th>
                            <th class="text-center">อุณหภูมิ -> สถานะ</th>
                            <th class="text-center">อุณหภูมิ -> เปิดพัดลม (℃)</th>
                            <th class="text-center">อุณหภูมิ -> ปิดพัดลม (℃)</th>
                            <th class="text-center">อุณหภูมิ -> พัดลม 1</th>
                            <th class="text-center">อุณหภูมิ -> พัดลม 2</th>
                            <th class="text-center">อุณหภูมิ -> พัดลม 3</th>
                            <th class="text-center">อุณหภูมิ -> พัดลม 4</th>
                            <th class="text-center">แสง -> สถานะ</th>
                            <th class="text-center">แสง -> เปิดม่านพรางแสง (KLux)</th>
                            <th class="text-center">แสง -> ปิดม่านพรางแสง (%Rh)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt2->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                                if($row[3] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[4].'</td>
                                          <td class="text-center">'.$row[5].'</td>';
                                          if($row[6] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                          if($row[7] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                          if($row[8] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                          if($row[9] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                            ';
                                 }
                                 if($row[10] == '1'){
                                     echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                           <td class="text-center">'.$row[11].'</td>
                                           <td class="text-center">'.$row[12].'</td>
                                           <td class="text-center">'.$row[13].'</td>';
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>';
                                 }
                                 if($row[14] == '1'){
                                     echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                           <td class="text-center">'.$row[15].'</td>
                                           <td class="text-center">'.$row[16].'</td>';
                                           if($row[17] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                           if($row[18] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                           if($row[19] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                           if($row[20] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; }
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>';
                                 }
                                 if($row[21] == '1'){
                                     echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                           <td class="text-center">'.$row[22].'</td>
                                           <td class="text-center">'.$row[23].'</td>';
                                 }else {
                                     echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                           <td class="text-center">-</td>
                                           <td class="text-center">-</td>';
                                 }
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
  <?php }elseif ($_POST["mode_report"] == 're_conteol_Auto_Timer') { ?>
            <br>
            <table id="data_table" class="table table-striped table-bordered dataTable" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center"><b class="text_autoTable">
                            <?php
                                if($load <= 4){
                                    echo 'ประวัติ น้ำหยด '.$load.' '.$config_cn['cn_name_'.$load];
                                }else if ($load > 4 && $load <= 8) {
                                    echo 'ประวัติ พัดลม '.($load-4).' '.$config_cn['cn_name_'.$load];
                                }else if ($load > 8 && $load <= 10) {
                                    echo 'ประวัติ พ่นหมอก '.($load-8).' '.$config_cn['cn_name_'.$load];
                                }else if ($load == 11) {
                                    echo 'ประวัติ สเปรย์'.$config_cn['cn_name_'.$load];
                                }else if ($load == 12) {
                                    echo 'ประวัติ ม่านพรางแสง';
                                }
                            ?></b>
                        </th>
                        <th colspan="3" class="text-center" style="background-color:#56e3c4">ตั้งเวลา 1</th>
                        <th colspan="3" class="text-center" style="background-color:#73de35">ตั้งเวลา 2</th>
                        <th colspan="3" class="text-center" style="background-color:#bda857">ตั้งเวลา 3</th>
                        <th colspan="3" class="text-center" style="background-color:#e571f5">ตั้งเวลา 4</th>
                        <th colspan="3" class="text-center" style="background-color:#f04394">ตั้งเวลา 5</th>
                        <th colspan="3" class="text-center" style="background-color:#f5ac71">ตั้งเวลา 6</th>
                    </tr>
                    <tr>
                        <th class="text-center">วัน </th>
                        <th class="text-center">เวลา</th>
                        <th class="text-center">ผู้บันทึก</th>
                        <th class="text-center" style="background-color:#56e3c4">สถานะ</th>
                        <th class="text-center tL_start" style="background-color:#56e3c4"></th>
                        <th class="text-center tL_stop" style="background-color:#56e3c4"></th>
                        <th class="text-center" style="background-color:#73de35">สถานะ</th>
                        <th class="text-center tL_start" style="background-color:#73de35"></th>
                        <th class="text-center tL_stop" style="background-color:#73de35"></th>
                        <th class="text-center" style="background-color:#bda857">สถานะ</th>
                        <th class="text-center tL_start" style="background-color:#bda857"></th>
                        <th class="text-center tL_stop" style="background-color:#bda857"></th>
                        <th class="text-center" style="background-color:#e571f5">สถานะ</th>
                        <th class="text-center tL_start" style="background-color:#e571f5"></th>
                        <th class="text-center tL_stop" style="background-color:#e571f5"></th>
                        <th class="text-center" style="background-color:#f04394">สถานะ</th>
                        <th class="text-center tL_start" style="background-color:#f04394"></th>
                        <th class="text-center tL_stop" style="background-color:#f04394"></th>
                        <th class="text-center" style="background-color:#f5ac71">สถานะ</th>
                        <th class="text-center tL_start" style="background-color:#f5ac71"></th>
                        <th class="text-center tL_stop" style="background-color:#f5ac71"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $table_name = 'tbn_control_au'.$load;
                        $channel[] = "SUBSTRING(load_timestamp,1,10) AS nDate";
                        $channel[] = "SUBSTRING(load_timestamp,-8, 8) AS nTime";
                        $channel[] = "load_user";
                        $channel[] = "load_st_1";
                        $channel[] = "load_s_1";
                        $channel[] = "load_e_1";
                        $channel[] = "load_st_2";
                        $channel[] = "load_s_2";
                        $channel[] = "load_e_2";
                        $channel[] = "load_st_3";
                        $channel[] = "load_s_3";
                        $channel[] = "load_e_3";
                        $channel[] = "load_st_4";
                        $channel[] = "load_s_4";
                        $channel[] = "load_e_4";
                        $channel[] = "load_st_5";
                        $channel[] = "load_s_5";
                        $channel[] = "load_e_5";
                        $channel[] = "load_st_6";
                        $channel[] = "load_s_6";
                        $channel[] = "load_e_6";

                        $channel1 = implode(', ',$channel);
                        // exit();
                        if ($_POST["mode"] != 'last_100') {
                            $sql = "SELECT $channel1 FROM $table_name WHERE load_sn = '$house_master' AND load_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY load_timestamp DESC";
                        }else {
                            $sql = "SELECT $channel1 FROM $table_name WHERE load_sn = '$house_master' ORDER BY load_timestamp DESC LIMIT 100";
                        }
                        $stmt = $dbcon->query($sql);
                        $stmt2 = $dbcon->query($sql);
                        $rowCount = $stmt->rowCount();
                        $colcount = $stmt->columnCount();
                        while ($row = $stmt->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                                if($row[3] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[4].'</td>
                                          <td class="text-center">'.$row[5].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[6] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[7].'</td>
                                          <td class="text-center">'.$row[8].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[9] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[10].'</td>
                                          <td class="text-center">'.$row[11].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[12] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[13].'</td>
                                          <td class="text-center">'.$row[14].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[15] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[16].'</td>
                                          <td class="text-center">'.$row[17].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[18] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[19].'</td>
                                          <td class="text-center">'.$row[20].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                            echo '</tr>';
                        }
                    ?>
                <tbody>
            </table>
            <div id="hide_table" style="display: none">
                <table id="data_table2" class="table table-striped table-bordered dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">วัน </th>
                            <th class="text-center">เวลา</th>
                            <th class="text-center">ผู้บันทึก</th>
                            <th class="text-center">ตั้งเวลา 1 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 1 <div class="tL_start"></div> </th>
                            <th class="text-center">ตั้งเวลา 1 <div class="tL_stop"></div></th>
                            <th class="text-center">ตั้งเวลา 2 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 2 <div class="tL_start"></div> </th>
                            <th class="text-center">ตั้งเวลา 2 <div class="tL_stop"></div></th>
                            <th class="text-center">ตั้งเวลา 3 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 3 <div class="tL_start"></div> </th>
                            <th class="text-center">ตั้งเวลา 3 <div class="tL_stop"></div></th>
                            <th class="text-center">ตั้งเวลา 4 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 4 <div class="tL_start"></div> </th>
                            <th class="text-center">ตั้งเวลา 4 <div class="tL_stop"></div></th>
                            <th class="text-center">ตั้งเวลา 5 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 5 <div class="tL_start"></div> </th>
                            <th class="text-center">ตั้งเวลา 5 <div class="tL_stop"></div></th>
                            <th class="text-center">ตั้งเวลา 6 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 6 <div class="tL_start"></div> </th>
                            <th class="text-center">ตั้งเวลา 6 <div class="tL_stop"></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $stmt2->fetch()) {
                                echo '<tr>
                                    <td class="text-center">'.$row[0].'</td>
                                    <td class="text-center">'.$row[1].'</td>
                                    <td class="text-center">'.$row[2].'</td>';
                                    if($row[3] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[4].'</td>
                                              <td class="text-center">'.$row[5].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[6] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[7].'</td>
                                              <td class="text-center">'.$row[8].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[9] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[10].'</td>
                                              <td class="text-center">'.$row[11].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[12] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[13].'</td>
                                              <td class="text-center">'.$row[14].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[15] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[16].'</td>
                                              <td class="text-center">'.$row[17].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[18] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[19].'</td>
                                              <td class="text-center">'.$row[20].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                echo '</tr>';
                            }
                        ?>
                    <tbody>
                </table>
            </div>
  <?php }elseif ($_POST["mode_report"] == 're_conteol_Auto_Timer_loop') { ?>
            <br>
            <table id="data_table" class="table table-striped table-bordered dataTable" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center"><b class="text_autoTable">
                            <?php
                                if($load <= 4){
                                    echo 'ประวัติ น้ำหยด '.$load.' '.$config_cn['cn_name_'.$load];
                                }else if ($load > 4 && $load <= 8) {
                                    echo 'ประวัติ พัดลม '.($load-4).' '.$config_cn['cn_name_'.$load];
                                }else if ($load > 8 && $load <= 10) {
                                    echo 'ประวัติ พ่นหมอก '.($load-8).' '.$config_cn['cn_name_'.$load];
                                }else if ($load == 11) {
                                    echo 'ประวัติ สเปรย์'.$config_cn['cn_name_'.$load];
                                }else if ($load == 12) {
                                    echo 'ประวัติ ม่านพรางแสง';
                                }
                            ?></b>
                        </th>
                        <th colspan="5" class="text-center" style="background-color:#56e3c4">ตั้งเวลา 1</th>
                        <th colspan="5" class="text-center" style="background-color:#73de35">ตั้งเวลา 2</th>
                        <th colspan="5" class="text-center" style="background-color:#bda857">ตั้งเวลา 3</th>
                        <th colspan="5" class="text-center" style="background-color:#e571f5">ตั้งเวลา 4</th>
                        <th colspan="5" class="text-center" style="background-color:#f04394">ตั้งเวลา 5</th>
                        <th colspan="5" class="text-center" style="background-color:#f5ac71">ตั้งเวลา 6</th>
                    </tr>
                    <tr>
                        <th class="text-center">วัน </th>
                        <th class="text-center">เวลา</th>
                        <th class="text-center">ผู้บันทึก</th>
                        <th class="text-center" style="background-color:#56e3c4">สถานะ</th>
                        <th class="text-center" style="background-color:#56e3c4">เริ่ม</th>
                        <th class="text-center" style="background-color:#56e3c4">จำนวน (รอบ)</th>
                        <th class="text-center" style="background-color:#56e3c4">เปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#56e3c4">ปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#73de35">สถานะ</th>
                        <th class="text-center" style="background-color:#73de35">เริ่ม</th>
                        <th class="text-center" style="background-color:#73de35">จำนวน (รอบ)</th>
                        <th class="text-center" style="background-color:#73de35">เปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#73de35">ปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#bda857">สถานะ</th>
                        <th class="text-center" style="background-color:#bda857">เริ่ม</th>
                        <th class="text-center" style="background-color:#bda857">จำนวน (รอบ)</th>
                        <th class="text-center" style="background-color:#bda857">เปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#bda857">ปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#e571f5">สถานะ</th>
                        <th class="text-center" style="background-color:#e571f5">เริ่ม</th>
                        <th class="text-center" style="background-color:#e571f5">จำนวน (รอบ)</th>
                        <th class="text-center" style="background-color:#e571f5">เปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#e571f5">ปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#f04394">สถานะ</th>
                        <th class="text-center" style="background-color:#f04394">เริ่ม</th>
                        <th class="text-center" style="background-color:#f04394">จำนวน (รอบ)</th>
                        <th class="text-center" style="background-color:#f04394">เปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#f04394">ปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#f5ac71">สถานะ</th>
                        <th class="text-center" style="background-color:#f5ac71">เริ่ม</th>
                        <th class="text-center" style="background-color:#f5ac71">จำนวน (รอบ)</th>
                        <th class="text-center" style="background-color:#f5ac71">เปิด (วินาที)</th>
                        <th class="text-center" style="background-color:#f5ac71">ปิด (วินาที)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $table_name = 'tbn_control_ausub_'.$load;
                        $channel[] = "SUBSTRING(load_timestamp,1,10) AS nDate";
                        $channel[] = "SUBSTRING(load_timestamp,-8, 8) AS nTime";
                        $channel[] = "load_user";
                        $channel[] = "load_st_1";
                        $channel[] = "load_s_1";
                        $channel[] = "load_cycle_1";
                        $channel[] = "load_on_1";
                        $channel[] = "load_off_1";
                        $channel[] = "load_st_2";
                        $channel[] = "load_s_2";
                        $channel[] = "load_cycle_2";
                        $channel[] = "load_on_2";
                        $channel[] = "load_off_2";
                        $channel[] = "load_st_3";
                        $channel[] = "load_s_3";
                        $channel[] = "load_cycle_3";
                        $channel[] = "load_on_3";
                        $channel[] = "load_off_3";
                        $channel[] = "load_st_4";
                        $channel[] = "load_s_4";
                        $channel[] = "load_cycle_4";
                        $channel[] = "load_on_4";
                        $channel[] = "load_off_4";
                        $channel[] = "load_st_5";
                        $channel[] = "load_s_5";
                        $channel[] = "load_cycle_5";
                        $channel[] = "load_on_5";
                        $channel[] = "load_off_5";
                        $channel[] = "load_st_6";
                        $channel[] = "load_s_6";
                        $channel[] = "load_cycle_6";
                        $channel[] = "load_on_6";
                        $channel[] = "load_off_6";

                        $channel1 = implode(', ',$channel);
                        // exit();
                        if ($_POST["mode"] != 'last_100') {
                            $sql = "SELECT $channel1 FROM $table_name WHERE load_sn = '$house_master' AND load_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY load_timestamp DESC";
                        }else {
                            $sql = "SELECT $channel1 FROM $table_name WHERE load_sn = '$house_master' ORDER BY load_timestamp DESC LIMIT 100";
                        }
                        $stmt = $dbcon->query($sql);
                        $stmt2 = $dbcon->query($sql);
                        $rowCount = $stmt->rowCount();
                        $colcount = $stmt->columnCount();
                        while ($row = $stmt->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                                if($row[3] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[4].'</td>
                                          <td class="text-center">'.$row[5].'</td>
                                          <td class="text-center">'.$row[6].'</td>
                                          <td class="text-center">'.$row[7].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[8] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[9].'</td>
                                          <td class="text-center">'.$row[10].'</td>
                                          <td class="text-center">'.$row[11].'</td>
                                          <td class="text-center">'.$row[12].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[13] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[14].'</td>
                                          <td class="text-center">'.$row[15].'</td>
                                          <td class="text-center">'.$row[16].'</td>
                                          <td class="text-center">'.$row[17].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[18] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[19].'</td>
                                          <td class="text-center">'.$row[20].'</td>
                                          <td class="text-center">'.$row[21].'</td>
                                          <td class="text-center">'.$row[22].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[23] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[24].'</td>
                                          <td class="text-center">'.$row[25].'</td>
                                          <td class="text-center">'.$row[26].'</td>
                                          <td class="text-center">'.$row[27].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                                if($row[28] == '1'){
                                    echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                          <td class="text-center">'.$row[29].'</td>
                                          <td class="text-center">'.$row[30].'</td>
                                          <td class="text-center">'.$row[31].'</td>
                                          <td class="text-center">'.$row[32].'</td>';
                                }
                                else {
                                    echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>
                                          <td class="text-center">-</td>';
                                }
                            echo '</tr>';
                        }
                    ?>
                <tbody>
            </table>
            <div id="hide_table" style="display: none">
                <table id="data_table2" class="table table-striped table-bordered dataTable" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">วัน </th>
                            <th class="text-center">เวลา</th>
                            <th class="text-center">ผู้บันทึก</th>
                            <th class="text-center">ตั้งเวลา 1 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 1 เริ่ม</th>
                            <th class="text-center">ตั้งเวลา 1 จำนวน (รอบ)</th>
                            <th class="text-center">ตั้งเวลา 1 เปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 1 ปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 2 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 2 เริ่ม</th>
                            <th class="text-center">ตั้งเวลา 2 จำนวน (รอบ)</th>
                            <th class="text-center">ตั้งเวลา 2 เปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 2 ปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 3 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 3 เริ่ม</th>
                            <th class="text-center">ตั้งเวลา 3 จำนวน (รอบ)</th>
                            <th class="text-center">ตั้งเวลา 3 เปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 3 ปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 4 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 4 เริ่ม</th>
                            <th class="text-center">ตั้งเวลา 4 จำนวน (รอบ)</th>
                            <th class="text-center">ตั้งเวลา 4 เปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 4 ปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 5 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 5 เริ่ม</th>
                            <th class="text-center">ตั้งเวลา 5 จำนวน (รอบ)</th>
                            <th class="text-center">ตั้งเวลา 5 เปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 5 ปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 6 สถานะ</th>
                            <th class="text-center">ตั้งเวลา 6 เริ่ม</th>
                            <th class="text-center">ตั้งเวลา 6 จำนวน (รอบ)</th>
                            <th class="text-center">ตั้งเวลา 6 เปิด (วินาที)</th>
                            <th class="text-center">ตั้งเวลา 6 ปิด (วินาที)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = $stmt2->fetch()) {
                                echo '<tr>
                                    <td class="text-center">'.$row[0].'</td>
                                    <td class="text-center">'.$row[1].'</td>
                                    <td class="text-center">'.$row[2].'</td>';
                                    if($row[3] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[4].'</td>
                                              <td class="text-center">'.$row[5].'</td>
                                              <td class="text-center">'.$row[6].'</td>
                                              <td class="text-center">'.$row[7].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[8] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[9].'</td>
                                              <td class="text-center">'.$row[10].'</td>
                                              <td class="text-center">'.$row[11].'</td>
                                              <td class="text-center">'.$row[12].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[13] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[14].'</td>
                                              <td class="text-center">'.$row[15].'</td>
                                              <td class="text-center">'.$row[16].'</td>
                                              <td class="text-center">'.$row[17].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[18] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[19].'</td>
                                              <td class="text-center">'.$row[20].'</td>
                                              <td class="text-center">'.$row[21].'</td>
                                              <td class="text-center">'.$row[22].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[23] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[24].'</td>
                                              <td class="text-center">'.$row[25].'</td>
                                              <td class="text-center">'.$row[26].'</td>
                                              <td class="text-center">'.$row[27].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                    if($row[28] == '1'){
                                        echo '<td class="text-center text-success">เปิดใช้งาน</td>
                                              <td class="text-center">'.$row[29].'</td>
                                              <td class="text-center">'.$row[30].'</td>
                                              <td class="text-center">'.$row[31].'</td>
                                              <td class="text-center">'.$row[32].'</td>';
                                    }
                                    else {
                                        echo '<td class="text-center text-primary">ปิดใช้งาน</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>
                                              <td class="text-center">-</td>';
                                    }
                                echo '</tr>';
                            }
                        ?>
                    <tbody>
                </table>
            </div>
  <?php }elseif ($_POST["mode_report"] == 're_conteol_Manual') { ?>
            <table id="data_table" class="table table-striped table-bordered dataTable" style="width:100%">
                <thead>
                    <tr>
                        <!-- <th class="text-center">#</th> -->
                        <th class="text-center">วัน </th>
                        <th class="text-center">เวลา</th>
                        <th class="text-center">ผู้ดำเนินการ</th>
                        <?php
                            if($config_cn['cn_status_1'] == 1){echo '<th class="text-center">น้ำหยด 1 '.$config_cn['cn_name_1'].'</th>';}
                            if($config_cn['cn_status_2'] == 1){echo '<th class="text-center">น้ำหยด 2 '.$config_cn['cn_name_2'].'</th>';}
                            if($config_cn['cn_status_3'] == 1){echo '<th class="text-center">น้ำหยด 3 '.$config_cn['cn_name_3'].'</th>';}
                            if($config_cn['cn_status_4'] == 1){echo '<th class="text-center">น้ำหยด 4 '.$config_cn['cn_name_4'].'</th>';}
                            if($config_cn['cn_status_5'] == 1){echo '<th class="text-center">พัดลม 1 '.$config_cn['cn_name_5'].'</th>';}
                            if($config_cn['cn_status_6'] == 1){echo '<th class="text-center">พัดลม 2 '.$config_cn['cn_name_6'].'</th>';}
                            if($config_cn['cn_status_7'] == 1){echo '<th class="text-center">พัดลม 3 '.$config_cn['cn_name_7'].'</th>';}
                            if($config_cn['cn_status_8'] == 1){echo '<th class="text-center">พัดลม 4 '.$config_cn['cn_name_8'].'</th>';}
                            if($config_cn['cn_status_9'] == 1){echo '<th class="text-center">พ่นหมอก 1 '.$config_cn['cn_name_9'].'</th>';}
                            if($config_cn['cn_status_10'] == 1){echo '<th class="text-center">พ่นหมอก 2 '.$config_cn['cn_name_10'].'</th>';}
                            if($config_cn['cn_status_11'] == 1){echo '<th class="text-center">สเปรย์'.$config_cn['cn_name_11'].'</th>';}
                            if($config_cn['cn_status_12'] == 1){echo '<th class="text-center">ม่านพรางแสง</th>';}
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $channel[] = "SUBSTRING(mn_timestamp,1,10) AS nDate";
                        $channel[] = "SUBSTRING(mn_timestamp,-8, 8) AS nTime";
                        $channel[] = "mn_user";
                        if($config_cn['cn_status_1'] == 1){$channel[] = "mn_load_1 AS dripper_1";}
                        if($config_cn['cn_status_2'] == 1){$channel[] = "mn_load_2 AS dripper_2";}
                        if($config_cn['cn_status_3'] == 1){$channel[] = "mn_load_3 AS dripper_3";}
                        if($config_cn['cn_status_4'] == 1){$channel[] = "mn_load_4 AS dripper_4";}
                        if($config_cn['cn_status_5'] == 1){$channel[] = "mn_load_5 AS fan_1";}
                        if($config_cn['cn_status_6'] == 1){$channel[] = "mn_load_6 AS fan_2";}
                        if($config_cn['cn_status_7'] == 1){$channel[] = "mn_load_7 AS fan_3";}
                        if($config_cn['cn_status_8'] == 1){$channel[] = "mn_load_8 AS fan_4";}
                        if($config_cn['cn_status_9'] == 1){$channel[] = "mn_load_9 AS foggy_1";}
                        if($config_cn['cn_status_10'] == 1){$channel[] = "mn_load_10 AS foggy_2";}
                        if($config_cn['cn_status_11'] == 1){$channel[] = "mn_load_11 AS spray";}
                        if($config_cn['cn_status_12'] == 1){$channel[] = "mn_load_12 AS shading";}

                        $channel1 = implode(', ',$channel);
                        // exit();
                        if ($_POST["mode"] != 'last_100') {
                            $sql = "SELECT $channel1 FROM tbn_control_mn_log WHERE mn_sn = '$house_master' AND mn_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY mn_timestamp DESC";
                        }else {
                            $sql = "SELECT $channel1 FROM tbn_control_mn_log WHERE mn_sn = '$house_master' ORDER BY mn_timestamp DESC LIMIT 100";
                        }
                        $stmt = $dbcon->query($sql);
                        $rowCount = $stmt->rowCount();
                        $colcount = $stmt->columnCount();
                        while ($row = $stmt->fetch()) {
                            echo '<tr>
                                <td class="text-center">'.$row[0].'</td>
                                <td class="text-center">'.$row[1].'</td>
                                <td class="text-center">'.$row[2].'</td>';
                                if($colcount >= 4){ if($row[3] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 5){ if($row[4] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 6){ if($row[5] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 7){ if($row[6] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 8){ if($row[7] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 9){ if($row[8] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 10){ if($row[9] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 11){ if($row[10] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 12){ if($row[11] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 13){ if($row[12] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 14){ if($row[13] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                                if($colcount >= 15){ if($row[14] == 'ON'){ echo '<td class="text-center text-success">เปิดใช้งาน</td>'; }else { echo '<td class="text-center text-danger">ปิดใช้งาน</td>'; } }
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
  <?php }
    echo '</div>'; ?>
    <script type="text/javascript">
        var a = $(window).height(), b = $('.simplebar-content').height();
        var countColumn = '<?= $rowCount ?>';
        var mode_report = '<?= $_POST["mode_report"] ?>';
        var currentdate = new Date();
        var datetime = currentdate.getFullYear() + "-"
                    + (currentdate.getMonth()+1)  + "-"
                    + currentdate.getDate() + "_"
                    + currentdate.getHours() + "."
                    + currentdate.getMinutes(); //+ ":"
                    // + currentdate.getSeconds();
        if(mode_report == 're_conteol_Auto_Timer'){
            var load_select = '<?= $load ?>';
            // alert(load_select)
            var flie_name, load_name;
            if(load_select == 12){
               $('.tL_start').html('เปิดรับแสง');
               $('.tL_stop').html('ปิดรับแสง');
               load_name = 'ม่านพรางแสง';
           }else {
               $('.tL_start').html('เริ่ม');
               $('.tL_stop').html('สิ้นสุด');
               if(load_select < 5){
                   load_name = 'น้ำหยด'+load_select
               }else if (load_select > 4 && load_select < 9) {
                   load_name = 'พัดลม'+(load_select-4)
               }else if (load_select == 9 || load_select == 10) {
                   load_name = 'พ่นหมอก'+(load_select-8)
               }else if (load_select == 11) {
                   load_name = 'สเปรย์'
               }
           }
        }
        if(countColumn == 0){
            $('#data_table').DataTable({
                "scrollY": '1000',
                "scrollX": true,
                "scrollCollapse": false,
                "paging":    false,
                "searching": false,
                "destroy": true,
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [
                    {
                        // "targets": [ 1 ],
                        // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                        // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                        "visible": false,
                        "searchable": false,
                    },
                ],
            });
        }
        else {
            if(mode_report == 're_conteol_log'){
                flie_name = 'SmartFarm_ประวัติการทำงาน_'+datetime;
            }else if (mode_report == 're_conteol_Auto_Submode') {
                flie_name = 'SmartFarm_ประวัติการตั้งค่าโหมดอัตโนมัติ_โหมดย่อย_'+datetime;
            }else if (mode_report == 're_conteol_Auto_Tracking') {
                flie_name = 'SmartFarm_ประวัติการตั้งค่าโหมดอัตโนมัติ_โหมดตามเซนเซอร์_'+datetime;
            }else if (mode_report == 're_conteol_Auto_Timer') {
                flie_name = 'SmartFarm_ประวัติการตั้งค่าโหมดอัตโนมัติ_โหมดตั้งเวลาทำงาน_'+load_name+'_'+datetime;
            }else if (mode_report == 're_conteol_Auto_Timer_loop') {
                flie_name = 'SmartFarm_ประวัติการตั้งค่าโหมดอัตโนมัติ_โหมดตั้งเวลาทำงานต่อเนื่อง_'+load_name+'_'+datetime;
            }else if (mode_report == 're_conteol_Manual') {
                flie_name = 'SmartFarm_ประวัติการตั้งค่าโหมดกำหนดเอง_'+datetime;
            }
            if(mode_report == 're_conteol_Auto_Tracking' || mode_report == 're_conteol_Auto_Timer' || mode_report == 're_conteol_Auto_Timer_loop'){
                $('#data_table').DataTable({
                    "scrollY": (a-b-200),
                    "scrollX": true,
                    "scrollCollapse": false,
                    "paging":    false,
                    "searching": false,
                    "destroy": true,
                    "order": [
                        [0, "desc"]
                    ],
                    "columnDefs": [
                        {
                            // "targets": [ 1 ],
                            // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                            // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                            "visible": false,
                            "searchable": false,
                        },
                    ],
                    dom: 'Bfrtip',//"<'floatRight'B><'clear'>frtip",
                    buttons: [
                        {
                            text: 'Export csv',
                            className:'btn btn-outline-success px-5 btnexport',
                            charset: 'UTF-8',
                            // extend: 'csv',
                            // format: 'YYYY/MM/dd',
                            // // fieldSeparator: ';',
                            // // fieldBoundary: '',
                            // filename: flie_name,
                            // // className: 'btn-info',
                            // bom: true,
                            // header: true
                        }
                    ]
                });
                // $('.btnexport').on('click', function() {
                //     var table22 = $('#data_table2').DataTable({
                //         destroy: true,
                //         dom: "<'floatRight'B><'clear'>frtip",
                //         buttons: [{
                //                 text: 'Export csv',
                //                 className:'btn btn-outline-success px-5 btnexport22',
                //                 // title: "Smart Farm Report Control",
                //                 charset: 'UTF-8',
                //                 extension: '.csv',
                //                 extend: 'csv',
                //                 format: 'YYYY-MM-dd',
                //                 // fieldSeparator: ';',
                //                 // fieldBoundary: '',
                //                 filename: flie_name,
                //                 bom: true
                //             }
                //         ],drawCallback: function() {
                //             $('.btnexport22').click()
                //             // setTimeout(function() {
                //             //     $('#table_re_cnAuto2').DataTable().destroy(false);
                //             // }, 200)
                //         }
                //     });
                // })
            }
            else {
                $('#data_table').DataTable({
                    "scrollY": (a-b-150),
                    "scrollX": true,
                    "scrollCollapse": false,
                    "paging":    false,
                    "searching": false,
                    "destroy": true,
                    "order": [
                        [0, "desc"]
                    ],
                  //   "processing": true,
                  //   'language':{
                  //     "loadingRecords": "&nbsp;",
                  //     "processing": "Loading..."
                  // },
                    "columnDefs": [
                        {
                            // "targets": [ 1 ],
                            // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                            // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                            "visible": false,
                            "searchable": false,
                        },
                    ],
                    dom: "<'floatRight'B><'clear'>frtip",
                    buttons: [
                        {
                            text: 'Export csv',
                            // title: "Smart Farm Report Control",
                            charset: 'UTF-8',
                            extension: '.csv',
                            // exportOptions: {
                            //    columns: [ 0, 2, 5 ]
                            // },
                            className:'btn btn-outline-success px-5 btnexport',
                            extend: 'csv',
                            format: 'YYYY/MM/dd',
                            // fieldSeparator: ';',
                            // fieldBoundary: '',
                            filename: flie_name,
                            // className: 'btn-info',
                            bom: true,
                            header: true
                        }
                    ]
                });
            }
        }
        // alert($('#table_report_control').height())
        // alert($(document).height())
        // alert(a+' '+$('.simplebar-content').height())
    </script>
