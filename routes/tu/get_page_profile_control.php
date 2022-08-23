<?php
    require "../connectdb.php";
    $house_master = $_POST["sn"];
    $row_3 = $dbcon->query("SELECT * FROM tbn_status_cn INNER JOIN tbn_house ON tbn_status_cn.cn_status_sn = tbn_house.house_master WHERE cn_status_sn = '$house_master' ")->fetch();
    echo '<br>
        <div class="d-flex">
            <h3>'.$row_3["house_name"].'</h3>
            <div class="ms-auto">
                <button class="btn btn-info me-1 cn_edit me-3" val=""><i class="bi bi-plus-square"></i> แก้ไข</button>
                    <button class="btn btn-success me-1 cn_save mb-3" val=""><i class="bi bi-plus-square"></i> บันทึก</button>
                        <button class="btn btn-danger me-1 cn_close mb-3" val=""><i class="bi bi-plus-square"></i> ยกเลิก</button>
            </div>
        </div><br>
        <div class="col-12 col-lg-12 col-xl-12 col-sm-12 d-flex">
            <div class="row">
                <form class="row g-3" id="config_control_from" enctype="multipart/form-data" onSubmit="return false;">
                <input type="hidden" name="house_master" value="'.$row_3['house_master'].'">';
                    for($i=1; $i<=12; $i++){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="text-center text-responsive2"><b>
                                    <?php if($i <= 4){echo 'น้ำหยด '.$i;}
                                    elseif($i > 4 && $i <= 8){echo 'พัดลม '.($i-4);}
                                    elseif($i > 8 && $i <= 10){echo 'พ่นหมอก '.($i-8);}
                                    elseif($i == 11){echo 'สเปรย์';}
                                    elseif($i == 12){echo 'ม่านพรางแสง';}
                                    if ($i == 12) { echo "<br><br>"; }else{ echo '<br>'.$row_3['cn_name_'.$i];}?></b>
                                </div>
								<div class="input-group mb-3">
									<label class="input-group-text" for="">Status </label>
									<select class="form-select sel_<?= $i ?> sel_" name="sel_<?= $i ?>">
										<option value="0">ปิดใช้งาน</option>
										<option value="1">เปิดใช้งาน</option>
									</select>
								</div>
                                <div class="input-group mb-3">
									<label class="input-group-text" for="">Name </label>
									<input class="form-control name_<?= $i ?> name_" name="name_<?= $i ?>">
								</div>
                            </div>
                        </div>

                    <?php }
            echo '</form>
            </div>
        </div>'; ?>

<script type="text/javascript">
    var val = <?= json_encode($row_3)?>;//$(this).attr('val')
    for(var i=1; i<= 12; i++){
        $('.sel_'+i).val(val['cn_status_'+i]);
        $('.name_'+i).val(val['cn_name_'+i]);
    }
    $('.sel_').prop('disabled', true);
    $('.name_').prop('disabled', true);
    $('.cn_edit').show();
    $('.cn_save').hide();
    $('.cn_close').hide();
    $('.cn_edit').click(function(){
        $(this).hide();
        $('.sel_').prop('disabled', false);
        $('.name_').prop('disabled', false);
        $('.cn_save').show();
        $('.cn_close').show();
    })
    $('.cn_save').click(function(){
        $.ajax({
            type: "POST",
            url: "routes/tu/get_page_profile_control_save.php",
            data: new FormData($("#config_control_from")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                // loadingOut(loading);
                var parseJSON = $.parseJSON(res);
                if (parseJSON.status == "Insert_Error") {
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
                if (parseJSON.status == "Insert_success"){
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "routes/tu/get_page_profile_control.php",
                                method: "post",
                                data: {
                                    sn: $('.cont_sel').val()
                                },
                                // dataType: "json",
                                success: function(res) {
                                    $('#get_set_cont').html(res);
                                }
                            });
                        }
                    });
                }
            }
        });
    });
    $('.cn_close').click(function(){
        for(var i=1; i<= 12; i++){
            $('.sel_'+i).val(val['cn_status_'+i]);
            $('.name_'+i).val(val['cn_name_'+i]);
        }
        $('.sel_').prop('disabled', true);
        $('.name_').prop('disabled', true);
        $('.cn_edit').show();
        $('.cn_save').hide();
        $('.cn_close').hide();
    });
</script>
