<?php
    require "../connectdb.php";
    $house_master = $_POST["sn"];
    $numb = intval(substr($house_master, 5,10));
    $row_1 = $dbcon->query("SELECT * FROM tb_sensor");
    foreach ($row_1 as $row_) {
        $sensor[] = $row_;
    }
    $row_2 = $dbcon->query("SELECT * FROM tbn_status_sn WHERE sn_status_sn = '$house_master' ")->fetch();
    $row_3 = $dbcon->query("SELECT * FROM tbn_status_cn INNER JOIN tbn_house ON tbn_status_cn.cn_status_sn = tbn_house.house_master WHERE cn_status_sn = '$house_master' ")->fetch();
    $row_4 = $dbcon->query("SELECT * FROM tbn_equation WHERE equation_sn = '$house_master' ORDER BY `equation_timestamp` DESC LIMIT 1 ")->fetch();
    ?>
<br>
<div class="col-12">
    <h3 Class="text-center"><?= $row_3["house_name"] ?></h3>
    <div class="card-body border radius-10 shadow-none mb-3">
        <div class="d-flex">
            <h4 class="mt-2">เซนเซอร์</h4>
            <div class="ms-auto">
                <button class="btn me-1 me-3 btn-info sn_edit" val=""><i class="bi bi-plus-square"></i> แก้ไข</button>
                <button class="btn me-1 me-3 btn-success sn_save" val=""><i class="bi bi-plus-square"></i> บันทึก</button>
                <button class="btn me-1 me-3 btn-danger sn_close" val=""><i class="bi bi-plus-square"></i> ยกเลิก</button>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-12 col-sm-12 d-flex">
            <div class="row">
                <form class="row g-3" id="config_sensor_from" enctype="multipart/form-data" onSubmit="return false;">
                    <input type="hidden" name="mode" value="sensor">
                    <input type="hidden" name="df_val" class="df_val">
                    <input type="hidden" name="df_val_eq" class="df_val_eq">
                    <input type="hidden" name="house_master" value="<?= $house_master ?>">
                    <h4 class="text-center">นอกโรงเรือน</h4>
                    <?php for($i=1; $i<=3; $i++){?>
                        <div class="col-lg-4 col-xl-4 col-sm-12">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="text-center text-responsive2">
                                    <b><?php if($i == 1){echo 'อุณหภูมิ';} elseif($i == 2){echo 'ความชื้น';} elseif($i == 3){echo 'ความเข้มแสง';} ?></b>
                                </div>
                                <div class="row mb-2">
									<label class="col-sm-4 col-form-label">สถานะ </label>
									<div class="col-sm-8">
    									<select class="form-select status_sn_<?= $i ?> status_sn_" name="status_sn_<?= $i ?>">
    										<option value="0">ปิดใช้งาน</option>
    										<option value="1">เปิดใช้งาน</option>
    									</select>
									</div>
								</div>
								<div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">ชื่อ </label>
                                    <div class="col-sm-8">
                                        <input class="form-control name_sn_<?= $i ?> name_sn_" name="name_sn_<?= $i ?>">
                                    </div>
								</div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">ช่อง </label>
                                    <div class="col-sm-8">
                                        <select class="form-select channel_sn_<?= $i ?> channel_sn_" name="channel_sn_<?= $i ?>">
                                            <?php for($a = 1; $a < 8; $a++){ ?>
                                                <option value="data_temp_out_<?= $a ?>">data_temp_out_<?= $a ?></option>
                                                <option value="data_hum_out_<?= $a ?>">data_hum_out_<?= $a ?></option>
                                                <option value="data_light_out_<?= $a ?>">data_light_out_<?= $a ?></option>
                                                <option value="data_temp_in_<?= $a ?>">data_temp_in_<?= $a ?></option>
                                                <option value="data_hum_in_<?= $a ?>">data_hum_in_<?= $a ?></option>
                                                <option value="data_light_in_<?= $a ?>">data_light_in_<?= $a ?></option>
                                                <option value="data_soil_in_<?= $a ?>">data_soil_in_<?= $a ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
								</div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">โหมด </label>
                                    <div class="col-sm-8">
                                        <select class="form-select mode_sn_<?= $i ?> mode_sn_" name="mode_sn_<?= $i ?>">
                                            <?php
                                                for ($j=0; $j < count($sensor); $j++) {
                                                    echo '<option value="'. $sensor[$j]['sensor_id'] .'">'. $sensor[$j]['sensor_name'];
                                                    if ($sensor[$j]['sensor_unit'] == 1) {
                                                        echo ' (℃)';
                                                    }elseif ($sensor[$j]['sensor_unit'] == '') {

                                                    }else {
                                                        echo ' ('.$sensor[$j]['sensor_unit'].')';
                                                    }
                                                    echo '</option>';
                                                }
                                            ?>
    									</select>
                                    </div>
								</div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">สมการ </label>
                                    <div class="col-sm-8">
                                        <input class="form-control equation_sn_<?= $i ?> equation_sn_" name="equation_sn_<?= $i ?>">
                                        <div class="invalid-feedback">สมการไม่ถูกต้อง</div>
                                    </div>
								</div>
                            </div>
                        </div>
                    <?php }
                    echo '<h4 class="text-center">ในโรงเรือน</h4>';
                    for($i=4; $i<=7; $i++){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="text-center text-responsive2">
                                    <b><?php if(($i-3) == 1){echo 'อุณหภูมิ';} elseif(($i-3) == 2){echo 'ความชื้น';} elseif(($i-3) == 3){echo 'ความเข้มแสง';} elseif(($i-3) == 4){echo 'ความชื้นดิน';} ?></b>
                                </div>
                                <div class="row mb-2">
									<label class="col-sm-4 col-form-label">สถานะ </label>
									<div class="col-sm-8">
    									<select class="form-select status_sn_<?= $i ?> status_sn_" name="status_sn_<?= $i ?>">
    										<option value="0">ปิดใช้งาน</option>
    										<option value="1">เปิดใช้งาน</option>
    									</select>
									</div>
								</div>
								<div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">ชื่อ </label>
                                    <div class="col-sm-8">
                                        <input class="form-control name_sn_<?= $i ?> name_sn_" name="name_sn_<?= $i ?>">
                                    </div>
								</div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">ช่อง </label>
                                    <div class="col-sm-8">
                                        <select class="form-select channel_sn_<?= $i ?> channel_sn_" name="channel_sn_<?= $i ?>">
                                            <?php for($a = 1; $a < 8; $a++){ ?>
                                                <option value="data_temp_out_<?= $a ?>">data_temp_out_<?= $a ?></option>
                                                <option value="data_hum_out_<?= $a ?>">data_hum_out_<?= $a ?></option>
                                                <option value="data_light_out_<?= $a ?>">data_light_out_<?= $a ?></option>
                                                <option value="data_temp_in_<?= $a ?>">data_temp_in_<?= $a ?></option>
                                                <option value="data_hum_in_<?= $a ?>">data_hum_in_<?= $a ?></option>
                                                <option value="data_light_in_<?= $a ?>">data_light_in_<?= $a ?></option>
                                                <option value="data_soil_in_<?= $a ?>">data_soil_in_<?= $a ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
								</div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">โหมด </label>
                                    <div class="col-sm-8">
                                        <select class="form-select mode_sn_<?= $i ?> mode_sn_" name="mode_sn_<?= $i ?>">
                                            <?php
                                                for ($j=0; $j < count($sensor); $j++) {
                                                    echo '<option value="'. $sensor[$j]['sensor_id'] .'">'. $sensor[$j]['sensor_name'];
                                                    if ($sensor[$j]['sensor_unit'] == 1) {
                                                        echo ' (℃)';
                                                    }elseif ($sensor[$j]['sensor_unit'] == '') {

                                                    }else {
                                                        echo ' ('.$sensor[$j]['sensor_unit'].')';
                                                    }
                                                    echo '</option>';
                                                }
                                            ?>
    									</select>
                                    </div>
								</div>
                                <div class="row mb-2">
                                    <label class="col-sm-4 col-form-label">สมการ </label>
                                    <div class="col-sm-8">
                                        <input class="form-control equation_sn_<?= $i ?> equation_sn_" name="equation_sn_<?= $i ?>">
                                        <div class="invalid-feedback">สมการไม่ถูกต้อง</div>
                                    </div>
								</div>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body border radius-10 shadow-none mb-3">
        <div class="d-flex">
            <h4 class="mt-2">ระบบควบคุม</h4>
            <div class="ms-auto">
                <button class="btn btn-info me-1 cn_edit me-3" val=""><i class="bi bi-plus-square"></i> แก้ไข</button>
                <button class="btn btn-success me-1 cn_save me-3" val=""><i class="bi bi-plus-square"></i> บันทึก</button>
                <button class="btn btn-danger me-1 cn_close me-3" val=""><i class="bi bi-plus-square"></i> ยกเลิก</button>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-12 col-sm-12 d-flex">
            <div class="row">
                <form class="row g-3" id="config_control_from" enctype="multipart/form-data" onSubmit="return false;">
                    <input type="hidden" name="mode" value="control">
                    <input type="hidden" name="house_master" value="<?= $house_master ?>">
                    <?php for($i=1; $i<=12; $i++){?>
                        <div class="col-lg-3 col-xl-3 col-sm-12">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="text-center text-responsive2"><b>
                                    <?php
                                    if($i <= 4){echo 'น้ำหยด '.$i;}
                                    elseif($i > 4 && $i <= 8){echo 'พัดลม '.($i-4);}
                                    elseif($i > 8 && $i <= 10){echo 'พ่นหมอก '.($i-8);}
                                    elseif($i == 11){echo 'สเปรย์';}
                                    elseif($i == 12){echo 'ม่านพรางแสง';}
                                    // if ($i == 12) { echo "<br><br>"; }else{ echo '<br>'.$row_3['cn_name_'.$i];}?></b>
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

                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var data_sn = <?= json_encode($row_2) ?>;
    var data_equation = <?= json_encode($row_4) ?>;
    $('.df_val').val(JSON.stringify(data_sn))
    $('.df_val_eq').val(JSON.stringify(data_equation))
    // console.log(data_equation)
    for(var i=1; i<= 7; i++){
        $('.status_sn_'+i).val(data_sn['sn_status_'+i]);
        $('.name_sn_'+i).val(data_sn['sn_name_'+i]);
        $('.channel_sn_'+i).val(data_sn['sn_channel_'+i]);
        $('.mode_sn_'+i).val(data_sn['sn_sensor_'+i]);
        $('.equation_sn_'+i).val(data_equation['equation_ch_'+i]);
    }
    $('.status_sn_').prop('disabled', true);
    $('.name_sn_').prop('disabled', true);
    $('.channel_sn_').prop('disabled', true);
    $('.mode_sn_').prop('disabled', true);
    $('.equation_sn_').prop('disabled', true);
    $('.sn_edit').show();
    $('.sn_save').hide();
    $('.sn_close').hide();
    $('.sn_edit').click(function(){
        $(this).hide();
        $('.status_sn_').prop('disabled', false);
        $('.name_sn_').prop('disabled', false);
        $('.channel_sn_').prop('disabled', false);
        $('.mode_sn_').prop('disabled', false);
        $('.equation_sn_').prop('disabled', false);
        $('.sn_save').show();
        $('.sn_close').show();
    })
    $('.sn_close').click(function(){
        for(var i=1; i<= 7; i++){
            $('.status_sn_'+i).val(data_sn['sn_status_'+i]);
            $('.name_sn_'+i).val(data_sn['sn_name_'+i]);
            $('.channel_sn_'+i).val(data_sn['sn_channel_'+i]);
            $('.mode_sn_'+i).val(data_sn['sn_sensor_'+i]);
            $('.equation_sn_'+i).val(data_equation['equation_ch_'+i]);
        }
        $('.status_sn_').prop('disabled', true);
        $('.name_sn_').prop('disabled', true);
        $('.channel_sn_').prop('disabled', true);
        $('.mode_sn_').prop('disabled', true);
        $('.equation_sn_').prop('disabled', true);
        $('.sn_edit').show();
        $('.sn_save').hide();
        $('.sn_close').hide();
    });
    $('.sn_save').click(function(){
        for(var i = 1; i < 8; i++){
            if($('.equation_sn_'+i).val() == ''){
                $('.equation_sn_'+i).addClass('is-invalid');
                return false;
            }
            // else if ( $('.equation_sn_'+i).val().substring(0, 2) != '(x' ) {
            //     $('.equation_sn_'+i).addClass('is-invalid');
            //     swal({
            //         title: 'รูปแบบสมการไม่รูกต้อง !',
            //         html: "สมการต้องขึ้นต้นด้วย (x เช่น (x *5) + 10 หรือ <br>(x + 2) - 15 เป็นต้น !!!",
            //         type: 'warning',
            //         allowOutsideClick: false,
            //         confirmButtonColor: '#32CD32'
            //     })
            //     return false;
            // }
            else {
                $('.equation_sn_'+i).removeClass('is-invalid');
            }
        }
        // return false;
        // else {
        swal({
            title: 'ข้อมูลถูกต้องครบถ้วน !',
            text: "คุณต้องการที่จะบีนทึกการเปลี่ยนแปลงหรือไม่ ?่",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#32CD32',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "routes/tu/save_config_profile_config.php",
                    data: new FormData($("#config_sensor_from")[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        // return false;
                        // loadingOut(loading);
                        var parseJSON = $.parseJSON(res);
                        if (res.status == "Insert_Error") {
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
                                        url: "routes/tu/get_page_profile_config.php",
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
            }
        });
        // }
    });
    // ------------ Control
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
            url: "routes/tu/save_config_profile_config.php",
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
                                url: "routes/tu/get_page_profile_config.php",
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
