<?php
    require "../connectdb2.php";

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

    $channel[] = "SUBSTRING(control_timestamp,1,10) AS nDate";
    $channel[] = "SUBSTRING(control_timestamp,-8, 8) AS nTime";
    $channel[] = "control_user";
    $channel[] = "control_mode";
    $channel[] = "control_dripper_1 AS cn_1";
    $channel[] = "control_dripper_2 AS cn_2";
    $channel[] = "control_dripper_3 AS cn_3";
    $channel[] = "control_dripper_4 AS cn_4";
    $channel[] = "control_dripper_5 AS cn_5";

    $channel1 = implode(', ',$channel);
    // exit();
?>

<div class="table-responsive m-t-10">
    <table id="tb_re_cn" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
            <tr>
                <!-- <th class="text-center">#</th> -->
                <th class="text-center">วัน </th>
                <th class="text-center">เวลา</th>
                <th class="text-center">ผู้ดำเนินการ</th>
                <th class="text-center">โหมด</th>
                <th class="text-center">น้ำหยด 1</th>
                <th class="text-center">น้ำหยด 2</th>
                <th class="text-center">พ่นหมอกในโรงเรือน</th>
                <th class="text-center">สปริสปริงเกอร์หลังคา</th>
                <th class="text-center">ม่านพรางแสง</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT $channel1 FROM tb3_control WHERE control_sn = '$house_master' AND control_timestamp BETWEEN '$start_day' AND '$stop_day' ORDER BY control_timestamp DESC";
                $stmt = $dbcon->query($sql);
                $rowCount = $stmt->rowCount();
                $colcount = $stmt->columnCount();
                while ($row = $stmt->fetch()) {
                    echo '<tr>
                        <td class="text-center">'.$row[0].'</td>
                        <td class="text-center">'.$row[1].'</td>
                        <td class="text-center">'.$row[2].'</td>';
                    if($row[3] == 'Manual'){ echo '<td class="text-center text-success">กำหนดเอง</td>'; }else { echo '<td class="text-center text-primary">อัตโนมัติ</td>';}
                    if($colcount >= 4){ if($row[4] == 'on'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                    if($colcount >= 5){ if($row[5] == 'on'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                    if($colcount >= 6){ if($row[6] == 'on'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                    if($colcount >= 7){ if($row[7] == 'on'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                    if($colcount >= 8){ if($row[8] == 'on'){ echo '<td class="text-center text-success">เปิด</td>'; }else { echo '<td class="text-center text-danger">ปิด</td>'; } }
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var countColumn = '<?= $rowCount ?>';
    if(countColumn == 0){
        $('#tb_re_cn').DataTable({
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
    }else {
        $('#tb_re_cn').DataTable({
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
                    title: "Smart Farm Report Control",
                    charset: 'utf-8',
                    extension: '.csv',
                    // exportOptions: {
                    //    columns: [ 0, 2, 5 ]
                    // },
                    className:'btn btn-outline-success px-5 btnexport',
                    extend: 'csv',
                    format: 'YYYY/MM/dd',
                    // fieldSeparator: ';',
                    // fieldBoundary: '',
                    filename: 'smart_farm_control_'+datetime,
                    // className: 'btn-info',
                    bom: true
                }
            ]
        });
    }
</script>
