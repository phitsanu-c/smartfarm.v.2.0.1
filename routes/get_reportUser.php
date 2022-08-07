<?php
    require "connectdb.php";
    $siteID = $_POST['siteID'];
    $status = $_POST['status'];
?>
<div class="table-responsive m-t-10">
    <table id="tb_users2" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">ชื้อผู้ใช้งาน</th>
                <th class="text-center">Images</th>
                <th class="text-center">สถานะ</th>
                <th class="text-center">วัน-เวลา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($status == 'day'){
                // $start_day = date("Y/m/d", strtotime('-1 day'));
                $_day = date("Y-m-d");
                $stmt = $dbcon->prepare("SELECT * FROM `tbn_login_log` INNER JOIN `tbn_account` ON `tbn_login_log`.`logLogin_UserID` = `tbn_account`.`account_id` WHERE `logLogin_siteID`= '$siteID' AND substr(`logLogin_timestamp`, 1,10) = '$_day' GROUP BY `logLogin_timestamp` ORDER BY `logLogin_timestamp` ");
            }
            if($status == 'week'){
                $start_day = date("Y-m-d", strtotime('-6 day'));
                $stop_day = date("Y-m-d");
                $stmt = $dbcon->prepare("SELECT * FROM `tbn_login_log` INNER JOIN `tbn_account` ON `tbn_login_log`.`logLogin_UserID` = `tbn_account`.`account_id` WHERE `logLogin_siteID`= '$siteID' AND substr(`logLogin_timestamp`, 1,11) BETWEEN '$start_day' AND '$stop_day' GROUP BY `logLogin_timestamp` ORDER BY `logLogin_timestamp` ");
            }
            if($status == 'month'){
                $start_day = date("Y-m-d", strtotime('-30 day'));
                $stop_day = date("Y-m-d");
                $stmt = $dbcon->prepare("SELECT * FROM `tbn_login_log` INNER JOIN `tbn_account` ON `tbn_login_log`.`logLogin_UserID`= `tbn_account`.`account_id` WHERE `logLogin_siteID`= '$siteID' AND substr(`logLogin_timestamp`, 1,10) BETWEEN '$start_day' AND '$stop_day' GROUP BY `logLogin_timestamp` ORDER BY `logLogin_timestamp` ");
            }
            if($status == 'from_to'){
                $start_day = $_POST['s_time'];
                $stop_day = $_POST['e_time'];
                $stmt = $dbcon->prepare("SELECT * FROM `tbn_login_log` INNER JOIN `tbn_account`ON  `tbn_login_log`.`logLogin_UserID`= `tbn_account`.`account_id` WHERE `logLogin_siteID`= '$siteID' AND substr(`logLogin_timestamp`, 1,10) BETWEEN '$start_day' AND '$stop_day' GROUP BY `logLogin_timestamp` ORDER BY `logLogin_timestamp` ");
            }
            $stmt->execute();
            $count = $stmt->rowCount();
            $i = 1;
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                echo '<tr>
                        <td class="text-center">' . $i . '</td>
                        <td class="text-center">' . $row["account_user"] . '</td>';
                if ($row["account_img"] == "") {
                    echo '<td class="text-center"><img src="public/images/users/user.png" width="50"  height="50" alt="..."></td>';
                } else {
                    echo '<td class="text-center"><img src="public/images/users/' . $row["account_img"] . '" width="50"  height="50" alt="..."></td>';
                }
                if ($row["logLogin_status"] == 'เข้าสู่ระบบ') {
                    echo '<td class="text-center"><span class="badge bg-success"> ' . $row["logLogin_status"] . ' <span></td>';
                }else {
                    echo '<td class="text-center"><span class="badge bg-warning"> ' . $row["logLogin_status"] . ' <span></td>';
                }
                echo '<td class="text-center">' . $row["logLogin_timestamp"] . '</td>
                </tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    // var countColumn = '<?= $count ?>';
    // var currentdate = new Date();
    // var datetime = currentdate.getFullYear() + "-"
    //             + (currentdate.getMonth()+1)  + "-"
    //             + currentdate.getDate() + "_"
    //             + currentdate.getHours() + "."
    //             + currentdate.getMinutes(); //+ ":"
    //             // + currentdate.getSeconds();
    //
    // if(countColumn == 0){
    //     $('#tb_users2').DataTable({
    //         "scrollY": '90vh',
    //         "scrollX": true,
    //         "scrollCollapse": false,
    //         "paging":    false,
    //         "searching": false,
    //         "destroy": true,
    //         "order": [
    //             [0, "desc"]
    //         ],
    //         "columnDefs": [
    //             {
    //                 // "targets": [ 1 ],
    //                 // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
    //                 // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
    //                 "visible": false,
    //                 "searchable": false,
    //             },
    //         ],
    //     });
    // }
    // else {
    //     $('#tb_users2').DataTable({
    //         "scrollY": 330,
    //         "scrollX": true,
    //         "scrollCollapse": false,
    //         "paging":    false,
    //         "searching": false,
    //         "destroy": true,
    //         "order": [
    //             [0, "desc"]
    //         ],
    //       //   "processing": true,
    //       //   'language':{
    //       //     "loadingRecords": "&nbsp;",
    //       //     "processing": "Loading..."
    //       // },
    //         "columnDefs": [
    //             {
    //                 // "targets": [ 1 ],
    //                 // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
    //                 // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
    //                 "visible": false,
    //                 "searchable": false,
    //             },
    //         ],
    //         dom: "<'floatRight'B><'clear'>frtip",
    //         buttons: [{
    //                 text: 'Export csv',
    //                 title: "Smart Farm Access Control",
    //                 charset: 'utf-8',
    //                 extension: '.csv',
    //                 // exportOptions: {
    //                 //    columns: [ 0, 2, 5 ]
    //                 // },
    //                 className:'btn btn-outline-success px-5 btnexport3',
    //                 extend: 'csv',
    //                 format: 'YYYY/MM/dd',
    //                 // fieldSeparator: ';',
    //                 // fieldBoundary: '',
    //                 filename: 'smart_farm_access_control_'+datetime,
    //                 // className: 'btn-info',
    //                 bom: true
    //             }
    //         ]
    //     });
    // }
</script>
