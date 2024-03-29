<?php
    require "connect_mqtt_uptime.php";

    $house_master = $_POST["house_master"];
    $config_cn = $_POST["config_cn"];
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
?>
<div class="table-responsive m-t-10">
    <table id="table_re_cnManual" class="table table-striped table-bordered dataTable" style="width:100%">
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
                $sql = "SELECT $channel1 FROM tbn_control_mn_log WHERE mn_sn = '$house_master' AND mn_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY mn_timestamp ";
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
</div>

<script type="text/javascript">
    var countColumn = '<?= $rowCount ?>';
    if(countColumn == 0){
        $('#table_re_cnManual').DataTable({
            "scrollY": '90vh',
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
    }else {
        $('#table_re_cnManual').DataTable({
            "scrollY": 330,
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
            buttons: [{
                    text: 'Export csv',
                    title: "Smart Farm Report Setting Control",
                    charset: 'UTF-8',
                    extension: '.csv',
                    // exportOptions: {
                    //    columns: [ 0, 2, 5 ]
                    // },
                    className:'btn btn-outline-success px-5 btnexport3',
                    extend: 'csv',
                    format: 'YYYY/MM/dd',
                    // fieldSeparator: ';',
                    // fieldBoundary: '',
                    filename: 'smart_farm_control_Setting_'+datetime,
                    // className: 'btn-info',
                    bom: true
                }
            ]
        });
    }

    // table3.button('.btnexport3').nodes().css("display", "none")
    // table3.clear().draw();
    //
    // if(res.length > 0){
    //     table3.button('.btnexport3').nodes().css("display", "block")
    // }
    // table3.clear().rows.add(res).draw();
</script>
