<?php
    require '../connectdb.php';
    echo '<div class="table-responsive m-t-10">';
    if($_GET['id'] == 1){ ?>
        <table id="table_spr1" class="table table-striped table-bordered dataTable" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">วัน - เวลา</th>
                    <th class="text-center">ชื่อพืช</th>
                    <th class="text-center">คอล์ปที่แสดง</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt_spr = $dbcon->query("SELECT * FROM `tbn_plant_name` ORDER BY plant_id  ");
                    $i=1;
                    while ($row_spr = $stmt_spr->fetch()) {
                        echo '
                            <tr>
                                <td>'.$i.'</td>
                                <td>'.$row_spr[1].'</td>
                                <td>'.$row_spr[2].'</td>
                                <td>'.$row_spr[3].'</td>
                                <td  class="text-center">
                                    <div class="buttons">
                                        <a href="javascript:void(0)" class="text-info edit_spr1"
                                            spr_id="' . $row_spr[0] . '"
                                            spr_name="' . $row_spr[2] .'"
                                            spr_colp="' . $row_spr[3] .'">
                                            <i class="fadeIn animated bx bx-message-square-edit"></i>
                                        </a>&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="text-danger delete_spr1"
                                            spr_id="' . $row_spr[0] . '"
                                            spr_name="' . $row_spr[2] .'">
                                            <i class="fadeIn animated bx bx-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                       $i++;
                   }
                ?>
            </tbody>
        </table>
    <?php  }
    else { ?>
        <table id="table_spr2" class="table table-striped table-bordered dataTable" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">ชื่อพืช</th>
                    <th class="text-center">คอล์ป</th>
                    <th class="text-center">วันหลังปลูก</th>
                    <th class="text-center">ความสูง (cm)</th>
                    <th class="text-center">ความกว้างทรงพุ่ม (cm)</th>
                    <th class="text-center">จำนวนใบ (ใบ)</th>
                    <th class="text-center">พื้นที่ใบ (cm<sup>2</sup>)</th>
                    <th class="text-center">น้ำหนักสดต้น (g)</th>
                    <th class="text-center">หมายเหตุ</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt_spr2 = $dbcon->query("SELECT * FROM `tbn_plant_data` INNER JOIN `tbn_plant_name` ON tbn_plant_data.plantD_sid = tbn_plant_name.plant_id ORDER BY plantD_id ");
                    $i=1;
                    while ($row_spr2 = $stmt_spr2->fetch()) {
                        echo '
                            <tr>
                                <td>'.$i.'</td>
                                <td>'.$row_spr2['plant_name'].'</td>
                                <td>'.$row_spr2['plantD_colp'].'</td>
                                <td>'.$row_spr2['plantD_day_planting'].'</td>
                                <td>'.$row_spr2['plantD_height'].'</td>
                                <td>'.$row_spr2['plantD_canopy_width'].'</td>
                                <td>'.$row_spr2['plantD_num_leaves'].'</td>
                                <td>'.$row_spr2['plantD_leaf_area'].'</td>
                                <td>'.$row_spr2['plantD_weight'].'</td>
                                <td>'.$row_spr2['plantD_note'].'</td>
                                <td  class="text-center">
                                    <div class="buttons">
                                        <a href="javascript:void(0)" class="text-info edit_spr2"
                                            vel_s = "'. $row_spr2['plantD_sid'] .'"
                                            vel_c = "'. $row_spr2['plantD_colp'] .'"
                                            vel_d = "'. $row_spr2['plantD_day_planting'] .'"
                                            vel_h = "'. $row_spr2['plantD_height'] .'"
                                            vel_w = "'. $row_spr2['plantD_canopy_width'] .'"
                                            vel_b = "'. $row_spr2['plantD_num_leaves'] .'"
                                            vel_p = "'. $row_spr2['plantD_leaf_area'] .'"
                                            vel_g = "'. $row_spr2['plantD_weight'] .'"
                                            note = "'.$row_spr2['plantD_note'].'"
                                            spr_id = "'. $row_spr2['plantD_id'] .'">
                                            <i class="fadeIn animated bx bx-message-square-edit"></i>
                                        </a>&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="text-danger delete_spr2"
                                            spr_id="' . $row_spr2['plantD_id'] . '"
                                            spr_num="' . $i .'">
                                            <i class="fadeIn animated bx bx-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                       $i++;
                   }
                ?>
            </tbody>
        </table>
    <?php }
    echo "</div>";
?>

<script type="text/javascript">
    var a = $(window).height(), b = $('.simplebar-content').height();

    $('#table_spr1').DataTable({
        "scrollY": (a-b).toFixed(),//'90vh',
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "destroy": true,
        "order": [
            [0, "desc"]
        ],
    });
    // alert((a-b-150).toFixed())
    $('#table_spr2').DataTable({
        "scrollY": (a-b).toFixed(),//'90vh',
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "destroy": true,
        "order": [
            [0, "desc"]
        ],
    });
    $('.edit_spr1').click(function(){
        $.get('routes/tu/get_corp_sel.php?id='+$(this).attr('spr_id'), function(req){
            $('.val_colp').attr("disabled", false).html(req);
        });
        $('#Modal_spr').modal('show');
        $('#m_spr1').show()
        $('#m_spr2').hide()
        $('.val_spr_1').val($(this).attr('spr_name'));
        $('.spr_mtitle').html('แก้ไขชนิดพืช')
        $('#val_hide_1').val($(this).attr('spr_id'));
        let spr_colp = $(this).attr('spr_colp');
        setTimeout(() => $('.val_colp').val(spr_colp), 1000);
    });
    $('.delete_spr1').click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบ : "+$(this).attr('spr_name')+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'routes/profile/save_sprout.php',
                    type: 'POST',
                    data: {
                        'mode': 1,
                        'name': 'delete_spr_name',
                        'id' : $(this).attr('spr_id')
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == "error") {
                            swal({
                                title: 'เกิดข้อผลิดพลาด !',
                                text: "บันทึกไม่สำเร็จ !!!",
                                type: 'error',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                            return false;
                        }
                        if (data.status == "Delete_success"){
                            get_tb_spr2(1);
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                        }
                    }
                });
            }
        });
    });

    $('.edit_spr2').click(function(){
        $.get('routes/tu/get_corp_sel.php?s_mode=1',function(req){
            $('.val_spr_n').html(req);
        });
        $('#Modal_spr').modal('show');
        $('.spr_mtitle').html('แก้ไขข้อมูลพืช')
        $('#m_spr1').hide()
        $('#m_spr2').show()
        setTimeout(() => $('.val_spr_n').val($(this).attr('vel_s')), 1000);
        $('.val_spr_c').val($(this).attr('vel_c'))
        $('.val_spr_d').val($(this).attr('vel_d'))
        $('.val_spr_h').val($(this).attr('vel_h'))
        $('.val_spr_w').val($(this).attr('vel_w'))
        $('.val_spr_b').val($(this).attr('vel_b'))
        $('.val_spr_p').val($(this).attr('vel_p'))
        $('.val_spr_g').val($(this).attr('vel_g'))
        $('#val_hide_2').val($(this).attr('spr_id'))
        $('.val_note').val($(this).attr('note'))
    });
    $('.delete_spr2').click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบข้อมูลหมายเลข : "+$(this).attr('spr_num')+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'routes/profile/save_sprout.php',
                    type: 'POST',
                    data: {
                        'mode': 2,
                        'vel_s': 'delete_spr_data',
                        'id' : $(this).attr('spr_id')
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == "error") {
                            swal({
                                title: 'เกิดข้อผลิดพลาด !',
                                text: "บันทึกไม่สำเร็จ !!!",
                                type: 'error',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            }).then((result) => {
                                if (result.value) {
                                    location.reload();
                                }
                            });
                            return false;
                        }
                        if (data.status == "Delete_success"){
                            get_tb_spr2(2);
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                        }
                    }
                });
            }
        });
    });
</script>
