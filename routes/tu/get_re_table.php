<?php
    require "../connectdb.php";
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
    // // exit();

    if ($_POST["mode"] == 'day') {
        $start_day = date("Y-m-d H:i:s", strtotime('-1 day'));
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'week') {
        $start_day = date("Y-m-d H:i:s", strtotime('-7 day'));
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'month') {
        $start_day = date("Y-m-d H:i:s", strtotime('-30 day'));
        $stop_day = date("Y-m-d H:i:s");
    } else if ($_POST["mode"] == 'from_to') {
        $start_day = $_POST["val_start"].':00';
        $stop_day = $_POST["val_end"].':00';
    }

    $numb = intval(substr($house_master, 5,10));
    $data_channel = [];
    //
    if($_POST['mode_report'] == 'compare'){
        $channel[] = "SUBSTRING(data_timestamp,1,10) AS nDate";
    }else {
        $channel[] = "SUBSTRING(data_timestamp_".$numb.",1,16) AS nDate";
    }
    // $channel[] = "SUBSTRING(data_timestamp,-8, 5) AS nTime";
    $count_columns = count($config_cn[2]);

    if($_POST['mode_report'] == 'compare'){
        for($i=0; $i < $count_columns; $i++){
            if ($config_cn[3][$i] == 4) {
                $channel[] = 'round('.$config_cn[1][$i].'/1000, 1) AS data_cn'.($i+1);
            } elseif ($config_cn[3][$i] == 5) {
                $channel[] = 'round('.$config_cn[1][$i].'/54, 1) AS data_cn'.($i+1);
            } else {
                $channel[] = 'round('.$config_cn[1][$i].', 1) AS data_cn'.($i+1);
            }
        }
    }
    else {
        $numb = intval(substr($house_master, 5,10));
        for($i=0; $i < $count_columns; $i++){
            if ($config_cn[3][$i] == 4) {
                $channel[] = 'round('.$config_cn[1][$i].'/1000, 1) AS data_cn'.($i+1);
            } elseif ($config_cn[3][$i] == 5) {
                $channel[] = 'round('.$config_cn[1][$i].'/54, 1) AS data_cn'.($i+1);
            } else {
                $channel[] = 'round('.$config_cn[1][$i].', 1) AS data_cn'.($i+1);
            }
        }
    }
    $channel1 = implode(', ',$channel);
    $house_master2 = 'TUSMT';//substr($house_master, 0,5);

    // $start_day2 = date("Y/m/d H:i:s",strtotime($start_day));
    // $stop_day2 = date("Y/m/d H:i:s",strtotime($stop_day));
    // echo $channel1;
    // exit();

?>
<div class="table-responsive m-t-10">
    <table id="table_compare" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">วัน - เวลา</th>
                <th class="text-center">วัน</th>
                <th class="text-center">เวลา</th>
                <?php
                for($i=0; $i < $count_columns; $i++){
                    echo '<th class="text-center">'.$config_cn[2][$i].'</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $sel_all_every = $_POST["sel_all_every"];
                if($_POST['eq'] == 0){
                    $tb_name = 'tbn_data_tu';
                }else {
                    $tb_name = 'tbn_data_tu_eq';
                }
                $sql = "SELECT $channel1 FROM $tb_name WHERE data_sn = '$house_master2' AND data_timestamp BETWEEN '$start_day' AND '$stop_day' AND mod(minute(`data_timestamp`),'$sel_all_every') = 0 ORDER BY data_timestamp ";
                $stmt = $dbcon->query($sql);
                $data0 = array();
                $i=1;
                // echo $sql;
                // exit();
                while ($row = $stmt->fetch()) {
                    $data0[] = $row;
                    echo '<tr>
                        <td>'.$i.'</td>
                        <td>'.$row["nDate"].'</td>
                        <td>'.substr($row["nDate"], 0 ,10).'</td>
                        <td>'.substr($row["nDate"], 11 ,18).'</td>';
                        if ($count_columns >= 1) {
                            echo '<td>'.$row["data_cn1"].'</td>';
                        }
                        if ($count_columns >= 2) {
                            echo '<td>'.$row["data_cn2"].'</td>';
                        }
                        if ($count_columns >= 3) {
                            echo '<td>'.$row["data_cn3"].'</td>';
                        }
                        if ($count_columns >= 4) {
                            echo '<td>'.$row["data_cn4"].'</td>';
                        }
                        if ($count_columns >= 5) {
                            echo '<td>'.$row["data_cn5"].'</td>';
                        }
                        if ($count_columns >= 6) {
                            echo '<td>'.$row["data_cn6"].'</td>';
                        }
                        if ($count_columns >= 7) {
                            echo '<td>'.$row["data_cn7"].'</td>';
                        }
                        if ($count_columns >= 8) {
                            echo '<td>'.$row["data_cn8"].'</td>';
                        }
                    echo "</tr>";
                   $i++;
               }
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    var a = $(window).height(), b = $('.simplebar-content').height();
    var data0 = <?= json_encode($data0) ?>;
    // alert(data0.length)
    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-"
                + currentdate.getDate() + "_"
                + currentdate.getHours() + "."
                + currentdate.getMinutes(); //+ ":"
                // + currentdate.getSeconds();

    var table = $('#table_compare').DataTable({
        "scrollY": (a-b-150),//'90vh',
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "destroy": true,
        "order": [
            [0, "desc"]
        ],
        //  "processing": "<span class='fa-stack fa-lg'>\n\
        //      <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
        // </span>&nbsp;&nbsp;&nbsp;&nbsp;Processing ...",
        "columnDefs": [{
            "targets": [ 1 ],
            // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
            // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
            "visible": false,
            // "searchable": false,
        }],
        dom: "<'floatRight'B><'clear'>frtip",
        buttons: [{
                text: 'Export csv',
                title: "Smart Farm Report",
                charset: 'UTF-8',
                // fieldSeparator: ';',
                extension: '.csv',
                format: {
                    body: function (data, row, column, node) {
                      var momentDate = moment(data, 'YYYY-MM-DD', true);
                      if (momentDate.isValid()) {
                        return momentDate.format('YYYY-MM-DD');
                      }
                      else {
                        return data;
                      }
                    }
                },
                className:'btn btn-outline-success px-5 btnexport0',
                extend: 'csv',
                // format: 'YYYY/MM/dd',
                // fieldSeparator: ';',
                // fieldBoundary: '',
                filename: 'smart_farm_'+datetime,
                // className: 'btn-info',
                bom: true
            }
        ]
    });
    table.button('.btnexport0').nodes().css("display", "none")
    if(data0.length > 0){
        table.button('.btnexport0').nodes().css("display", "block")
    }
</script>
