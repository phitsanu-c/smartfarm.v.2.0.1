<?php
    $controlstatus = $_POST['controlstatus'];
    $conttrolname = $_POST['conttrolname'];
    // $count_dash = array_count_values($dashMode)['1'];
    // print_r( array_count_values($dashStatus) );
// echo array_count_values($controlstatus)['1'];
// exit();
if($_POST['house_master'] != "KMUMT001"){
?>
<!-- <div class="d-sm-flex"> -->
    <ul class="nav nav-pills mb-3" role="tablist">
        <?php for($i=1; $i <= 11; $i++){
            if($controlstatus[$i] == 1){
            echo '<li class="nav-item" role="presentation">
                    <a class="nav-link rec_auto" id="'.$i.'" house_master="'. $_POST['house_master'] .'" data-bs-toggle="pill" href="" style="border: 1px solid transparent; border-color: #6c757d;">
                        <div class="d-flex align-items-center">
                            <div class="tab-title">'.$conttrolname[$i].'</div>
                        </div>
                    </a>
                </li>';
            }
        }?>
    </ul>
<!-- </div> -->
    <br>
    <div id="rept_controlAuto"></div>

    <script>
        $(".rec_auto").click(function () { 
            var loading = verticalNoTitle();
            $(this).attr("id")
            $.ajax({
                type: "POST",
                url: "routes/report_controlAutoTable.php",
                data: {
                    house_master: $(this).attr("house_master"),
                    channel : $(this).attr("id")
                },
                // dataType: 'json',
                success: function(res) {
                    $("#rept_controlAuto").html(res);
                    loadingOut(loading);
                }
            });
        });
    </script>
<?php }else{?>
    <div class="table-responsive m-t-10">
        <table id="table_" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <!-- <table id="table_" class="table table-striped table-bordered dataTable" style="width:100%"> -->
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">#</th>
                    <th rowspan="2" class="text-center">Date </th>
                    <th rowspan="2" class="text-center">Time</th>
                    <th rowspan="2" class="text-center">User</th>
                    <th colspan="2" class="text-center"><?= $conttrolname[1] ?></th>
                    <th colspan="2" class="text-center"><?= $conttrolname[2] ?></th>
                    <th colspan="2" class="text-center"><?= $conttrolname[3] ?></th>
                    <th colspan="2" class="text-center"><?= $conttrolname[4] ?></th>
                    <th colspan="2" class="text-center"><?= $conttrolname[5] ?></th>
                </tr>
                <tr>
                    <th class="text-center" > Min </th>
                    <th class="text-center" > Max</th>
                    <th class="text-center" > Min </th>
                    <th class="text-center" > Max</th>
                    <th class="text-center" > Min </th>
                    <th class="text-center" > Max</th>
                    <th class="text-center" > Min </th>
                    <th class="text-center" > Max</th>
                    <th class="text-center" > Min </th>
                    <th class="text-center" > Max</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "../routes/connectdb.php";
                $house_master = $_POST['house_master'];
                        $i = 1;
                        $sql = "SELECT * FROM `tb_control_maxmin` INNER JOIN tb2_login ON tb_control_maxmin.maxmin_userID = tb2_login.login_id WHERE `maxmin_max_sn`= '$house_master' ORDER BY maxmin_timestamp DESC";
                        $stmt = $dbcon->query($sql);
                        
                        while ($row = $stmt->fetch()) {
                        echo '<tr>
                                <td class="text-center">'. $i .'</td>
                                <td class="text-center">'. date_format( date_create( substr($row["maxmin_timestamp"], 0, 10) ), 'Y/m/d' ).'</td>
                                <td class="text-center">'. substr($row["maxmin_timestamp"], 10) .'</td>
                                <td class="text-center">'. $row["login_user"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_min_1"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_max_1"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_min_2"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_max_2"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_min_3"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_max_3"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_min_5"] .'</td>
                                <td class="text-center">'. $row[12] .'</td><td class="text-center">'. $row["maxmin_max_5"] .'</td>';
                        echo '</tr>';
                        $i++;
                    } 
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $('#table_').DataTable( {
            "scrollY": 330,
            "scrollX": true,
            "scrollCollapse": false,
            "paging":    false,
            "searching": false,
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [
                {
                // "targets": [ 1 ],
                // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                "visible": false,
                "searchable": false
                },
                
            ],
        });
    </script>
<?php } ?>