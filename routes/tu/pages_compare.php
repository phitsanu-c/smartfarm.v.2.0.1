<?php
    require "../connectdb.php";
    $siteID = $_GET['s'];
    $house_master1 = 'TUSMT006';
    $house_master2 = 'TUSMT007';
    $house_master3 = 'TUSMT003';
    $house_master4 = 'TUSMT004';
    $house_master5 = 'TUSMT005';
    $house_master6 = 'TUSMT001';
    $house_master7 = 'TUSMT002';
    $row_1 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master1'")->fetch();
    $row_2 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master2'")->fetch();
    $row_3 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master3'")->fetch();
    $row_4 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master4'")->fetch();
    $row_5 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master5'")->fetch();
    $row_6 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master6'")->fetch();
    $row_7 = $dbcon->query("SELECT * FROM tbn_status_sn INNER JOIN tbn_house ON tbn_status_sn.sn_status_sn = tbn_house.house_master WHERE tbn_status_sn.sn_status_sn = '$house_master7'")->fetch();
?>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 te_st"></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item te_ht" aria-current="page"></li>
                    <li class="breadcrumb-item" aria-current="page"> เปรียบเทียบข้อมูล </li>
                </ol>
            </nav>
        </div>
    </div>
    <hr/>
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card w-100 radius-10">
            <div class="card-body">
                <div class="d-sm-flex">
                    <div class="d-flex col-lg-6 col-xl-6 col-12  ">
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 c_day">24 ชั่วโมง</button>
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 c_week">7 วัน</button>
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 c_month">30 วัน</button>
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 c_from_to">กำหนดเอง</button>

                    </div>
                    <ul class="ms-auto col-lg-3 col-md-4 col-xl-3 col-12 nav nav-pills mode_sn" role="tablist">
                        <li class="nav-item col-6" role="presentation">
                            <a class="nav-link active text-center re_ch" data-bs-toggle="pill" href="#p-chart" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                                <i class="fadeIn animated bx bx-line-chart"></i> กราฟ
                            </a>
                        </li>
                        <li class="nav-item col-6" role="presentation">
                            <a class="nav-link text-center re_tb" data-bs-toggle="pill" href="#p-table" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                <i class="fadeIn animated bx bx-table"></i> ตาราง
                            </a>
                        </li>
                    </ul>
                </div><br>
                <div class="tab-content chart">
                    <div class="tab-pane fade show active" id="p-chart" role="tabpanel">
                        <div id="chart_compare" style=""></div>
                    </div>
                    <div class="tab-pane fade" id="p-table" role="tabpanel">
                        <div id="tablr_compare" style=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal_select_sn -->
    <div class="modal fade" id="Modal_select_sn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">
                        <b class="title_mod"></b>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row hide_dwm">
                        <div class="col-lg-6 col-xl-6 col-sm-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text col-sm-4" id="basic-addon3">เวลาเริ่ม</span>
                                <input type="text" class="form-control text-center val_start" placeholder="วันเวลาเริ่มต้น" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <div class="invalid-feedback">กรุณาระบุเวลาเริ่ม</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-sm-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text col-sm-4" id="basic-addon3">เวลาสิ้นสุด</span>
                                <input type="text" class="form-control text-center val_end" placeholder="วันเวลาสิ้นสุด" aria-label="วันเวลาสิ้นสุด" aria-describedby="button-addon2">
                                <div class="invalid-feedback">กรุณาระบุเวลาสิ้นสุด</div>
                            </div>
                        </div>
                    </div>

                    <!-- เลือกเซ็นเซอร์ -->
                    <div class="mode_sn">
                        <h4 class="card-title text-center">
                            <b>เลือกประเถท</b>
                        </h4><hr/>
                        <div class="d-flex mb-2">
                            <div class="form-check mb-3">
                                <div id="count_checkbox_s"></div>
                                <input type="hidden" id="count_checkbox" value="0">
                                <!-- <h5 style="margin-left:40px">
                                <input type="checkbox" class="form-check-input" id="checkbox_all_sn">
                                <label class="form-check-label">เลือกทุกประเภท</label></h5> -->
                                <input type="hidden" class="mode_dwm">
                            </div>
                            <div class="ms-auto">
                                <label class="form-check-label" for="flexSwitchCheckCheckedDanger">แสดงข้อมูล : </label>
                                <select id="sel_all_every" class="form-check-label">
                                    <option value="1">ทุก ๆ 1 นาที</option>
                                    <option value="5">ทุก ๆ 5 นาที</option>
                                    <option value="10">ทุก ๆ 10 นาที</option>
                                    <option value="15">ทุก ๆ 15 นาที</option>
                                    <option value="30">ทุก ๆ 30 นาที</option>
                                    <option value="60">ทุก ๆ 1 ชั่วโมง</option>
                                </select>
                            </div>
                        </div>
                        <?php //echo json_encode($row_1);?>
                        <div class="row">
                            <?php //if($s_sensor['s_btnT'] > 0){ // อุณหภูมิ ?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_temp" type="radio" onchange="ch_radio('temp', $(this))" ><!-- checked -->
                                            <h5>อุณหภูมิ</h5>
                                            <!-- <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_temp" onchange="checkbox_all('temp',$(this))" checked >
                                                <label class="form-check-label">เลือกทั้งหมด </label>
                                            </div> -->
                                            <hr/>
                                            <label class="form-check-label"><?= $row_1['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_1['sn_status_'.$i] == 1){
                                                    if($row_1['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_1['sn_channel_'.$i] ?>" d_name="<?= $row_1['house_name'].' - '.$row_1['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_1['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_1['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_2['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_2['sn_status_'.$i] == 1){
                                                    if($row_2['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_2['sn_channel_'.$i] ?>" d_name="<?= $row_2['house_name'].' - '.$row_2['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_2['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_2['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_3['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_3['sn_status_'.$i] == 1){
                                                    if($row_3['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_3['sn_channel_'.$i] ?>" d_name="<?= $row_3['house_name'].' - '.$row_3['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_3['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_3['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_4['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_4['sn_status_'.$i] == 1){
                                                    if($row_4['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_4['sn_channel_'.$i] ?>" d_name="<?= $row_4['house_name'].' - '.$row_4['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_4['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_4['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_5['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_5['sn_status_'.$i] == 1){
                                                    if($row_5['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_5['sn_channel_'.$i] ?>" d_name="<?= $row_5['house_name'].' - '.$row_5['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_5['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_5['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_6['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_6['sn_status_'.$i] == 1){
                                                    if($row_6['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_6['sn_channel_'.$i] ?>" d_name="<?= $row_6['house_name'].' - '.$row_6['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_6['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_6['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_7['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_7['sn_status_'.$i] == 1){
                                                    if($row_7['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $row_7['sn_channel_'.$i] ?>" d_name="<?= $row_7['house_name'].' - '.$row_7['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $row_7['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'temp')" >
                                                            <label class="form-check-label"><?= $row_7['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php //} if($s_sensor['s_btnH'] > 0){ // ความชื้นอากาศ ?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_hum" type="radio" onchange="ch_radio('hum',$(this))" >
                                            <h5>ความชื้นอากาศ</h5>
                                            <!-- <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_hum" onchange="checkbox_all('hum')" <?php //if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด</label>
                                            </div> -->
                                            <hr/>
                                            <label class="form-check-label"><?= $row_1['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_1['sn_status_'.$i] == 1){
                                                    if($row_1['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_1['sn_channel_'.$i] ?>" d_name="<?= $row_1['house_name'].' - '.$row_1['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_1['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_1['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_2['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_2['sn_status_'.$i] == 1){
                                                    if($row_2['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_2['sn_channel_'.$i] ?>" d_name="<?= $row_2['house_name'].' - '.$row_2['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_2['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_2['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_3['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_3['sn_status_'.$i] == 1){
                                                    if($row_3['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_3['sn_channel_'.$i] ?>" d_name="<?= $row_3['house_name'].' - '.$row_3['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_3['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_3['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_4['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_4['sn_status_'.$i] == 1){
                                                    if($row_4['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_4['sn_channel_'.$i] ?>" d_name="<?= $row_4['house_name'].' - '.$row_4['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_4['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_4['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_5['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_5['sn_status_'.$i] == 1){
                                                    if($row_5['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_5['sn_channel_'.$i] ?>" d_name="<?= $row_5['house_name'].' - '.$row_5['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_5['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_5['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_6['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_6['sn_status_'.$i] == 1){
                                                    if($row_6['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_6['sn_channel_'.$i] ?>" d_name="<?= $row_6['house_name'].' - '.$row_6['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_6['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_6['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_7['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_7['sn_status_'.$i] == 1){
                                                    if($row_7['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $row_7['sn_channel_'.$i] ?>" d_name="<?= $row_7['house_name'].' - '.$row_7['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $row_7['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'hum')" >
                                                            <label class="form-check-label"><?= $row_7['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php //} if($s_sensor['s_btnL'] > 0){ // ความเข้มแสง ?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_light" type="radio" onchange="ch_radio('light', $(this))" >
                                            <h5>ความเข้มแสง</h5>
                                            <!-- <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_light" onchange="checkbox_all('light')" <?php //if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด</label>
                                            </div> -->
                                            <hr/>
                                            <label class="form-check-label"><?= $row_1['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_1['sn_status_'.$i] == 1){
                                                    if($row_1['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_1['sn_channel_'.$i] ?>" d_name="<?= $row_1['house_name'].' - '.$row_1['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_1['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_1['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_1['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_1['sn_channel_'.$i] ?>" d_name="<?= $row_1['house_name'].' - '.$row_1['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_1['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_1['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_2['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_2['sn_status_'.$i] == 1){
                                                    if($row_2['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_2['sn_channel_'.$i] ?>" d_name="<?= $row_2['house_name'].' - '.$row_2['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_2['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_2['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_2['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_2['sn_channel_'.$i] ?>" d_name="<?= $row_2['house_name'].' - '.$row_2['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_2['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_2['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_3['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_3['sn_status_'.$i] == 1){
                                                    if($row_3['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_3['sn_channel_'.$i] ?>" d_name="<?= $row_3['house_name'].' - '.$row_3['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_3['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_3['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_3['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_3['sn_channel_'.$i] ?>" d_name="<?= $row_3['house_name'].' - '.$row_3['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_3['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_3['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_4['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_4['sn_status_'.$i] == 1){
                                                    if($row_4['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_4['sn_channel_'.$i] ?>" d_name="<?= $row_4['house_name'].' - '.$row_4['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_4['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_4['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_4['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_4['sn_channel_'.$i] ?>" d_name="<?= $row_4['house_name'].' - '.$row_4['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_4['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_4['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_5['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_5['sn_status_'.$i] == 1){
                                                    if($row_5['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_5['sn_channel_'.$i] ?>" d_name="<?= $row_5['house_name'].' - '.$row_5['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_5['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_5['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_5['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_5['sn_channel_'.$i] ?>" d_name="<?= $row_5['house_name'].' - '.$row_5['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_5['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_5['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_6['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_6['sn_status_'.$i] == 1){
                                                    if($row_6['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_6['sn_channel_'.$i] ?>" d_name="<?= $row_6['house_name'].' - '.$row_6['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_6['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_6['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_6['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_6['sn_channel_'.$i] ?>" d_name="<?= $row_6['house_name'].' - '.$row_6['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_6['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_6['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_7['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_7['sn_status_'.$i] == 1){
                                                    if($row_7['sn_sensor_'.$i] == 4){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_7['sn_channel_'.$i] ?>" d_name="<?= $row_7['house_name'].' - '.$row_7['sn_name_'.$i]." (KLux)" ?>" d_mode="<?= $row_7['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                            <label class="form-check-label"><?= $row_7['sn_name_'.$i] ?></label>
                                                        </div>
                                                <?php }else if($row_7['sn_sensor_'.$i] == 5){ ?>
                                                    <div class="form-check mb-3">
                                                        <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="<?= $row_7['sn_channel_'.$i] ?>" d_name="<?= $row_7['house_name'].' - '.$row_7['sn_name_'.$i]." (µmol m<sup>-2</sup>s<sup>-1</sup>)" ?>" d_mode="<?= $row_7['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'light')" >
                                                        <label class="form-check-label"><?= $row_7['sn_name_'.$i] ?></label>
                                                    </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php //} if($s_sensor['s_btnS'] > 0){?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_soil" type="radio" onchange="ch_radio('soil', $(this))" >
                                            <h5>ความชื้นในดิน</h5>
                                            <!-- <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_soil" onchange="checkbox_all('soil')" <?php //if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด</label>
                                            </div> -->
                                            <hr/>
                                            <label class="form-check-label"><?= $row_1['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_1['sn_status_'.$i] == 1){
                                                    if($row_1['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_1['sn_channel_'.$i] ?>" d_name="<?= $row_1['house_name'].' - '.$row_1['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_1['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_1['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_2['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_2['sn_status_'.$i] == 1){
                                                    if($row_2['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_2['sn_channel_'.$i] ?>" d_name="<?= $row_2['house_name'].' - '.$row_2['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_2['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_2['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_3['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_3['sn_status_'.$i] == 1){
                                                    if($row_3['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_3['sn_channel_'.$i] ?>" d_name="<?= $row_3['house_name'].' - '.$row_3['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_3['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_3['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_4['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_4['sn_status_'.$i] == 1){
                                                    if($row_4['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_4['sn_channel_'.$i] ?>" d_name="<?= $row_4['house_name'].' - '.$row_4['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_4['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_4['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_5['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_5['sn_status_'.$i] == 1){
                                                    if($row_5['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_5['sn_channel_'.$i] ?>" d_name="<?= $row_5['house_name'].' - '.$row_5['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_5['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_5['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_6['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_6['sn_status_'.$i] == 1){
                                                    if($row_6['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_6['sn_channel_'.$i] ?>" d_name="<?= $row_6['house_name'].' - '.$row_6['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_6['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_6['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                            <hr/>
                                            <label class="form-check-label"><?= $row_7['house_name'] ?> </label>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($row_7['sn_status_'.$i] == 1){
                                                    if($row_7['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $row_7['sn_channel_'.$i] ?>" d_name="<?= $row_7['house_name'].' - '.$row_7['sn_name_'.$i]." (%)" ?>" d_mode="<?= $row_7['sn_sensor_'.$i] ?>" onchange="checkbox_check($(this) ,'soil')" >
                                                            <label class="form-check-label"><?= $row_7['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php //} ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" id="submit_fromTo" class="btn btn-success waves-light">
                    <i class="fadeIn animated bx bx-check"></i> ตกลง
                    </button>
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">
                        <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- exit Modal_select_sn -->
</div>
<script type="text/javascript">
    $('.val_start').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        minYear: 2016,
        // maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            cancelLabel: 'Close'
        }
    });
    $('.val_end').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
        timePicker24Hour: true,
        minYear: 2016,
        // maxDate: moment($('.val_start').val()).add(30, 'days'),
        // maxYear: parseInt(moment('2022-05-20').format('YYYY-MM-DD'), 10),
        locale: {
           cancelLabel: 'Close'
        },
    });

    ch_radio('temp', $('#radio_temp'));
    $('.mode_sn').show()
    $(".mode_dwm").val('');
    // $('#mode_report').val('re_sensor');
    $('#table_re_Sensor').wrap('<div id="hide0" style="display:none"/>');
    $('#hide0').css( 'display', 'none' );
    $(".c_day").click(function() {
        // alert($('#mode_report').val())
        $(".mode_dwm").val('day');
        $(".title_mod").html('เปรียบเทียบข้อมูลย้อนหลัง 1 วัน');
        $(".hide_dwm").hide();
        $("#Modal_select_sn").modal("show");
    });
    $(".c_week").click(function() {
        $(".mode_dwm").val('week');
        $(".title_mod").html('เปรียบเทียบข้อมูลย้อนหลัง 7 วัน');
        $(".hide_dwm").hide();
        $("#Modal_select_sn").modal("show");
    });
    $(".c_month").click(function() {
        $(".mode_dwm").val('month');
        $(".title_mod").html('เปรียบเทียบข้อมูลย้อนหลัง 30 วัน');
        $(".hide_dwm").hide();
        $("#Modal_select_sn").modal("show");
    });
    $(".c_from_to").click(function() {
        $(".mode_dwm").val('from_to');
        $(".title_mod").html('เปรียบเทียบข้อมูลย้อนหลัง &nbsp; &nbsp;&nbsp;');
        $(".hide_dwm").show();
        $("#Modal_select_sn").modal("show");

        $('.val_start').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
            if($('.val_end').val() != ''){
                if(moment($(this).val()).format('YYYY-MM-DD HH:mm') < moment($('.val_end').val()).add(-31, 'days').format('YYYY-MM-DD HH:mm')) {
                    Swal({
                        type: "warning",
                        html: "เลือกวันได้สูงสุด<b> ไม่เกิน 31</b> วัน/ครั้ง",
                        // html: text,
                        allowOutsideClick: false
                    });
                    $(this).val('').addClass('is-invalid');
                    return false;
                }else if(moment($(this).val()).format('YYYY-MM-DD HH:mm') >= moment($('.val_end').val()).format('YYYY-MM-DD HH:mm')) {
                    Swal({
                        type: "warning",
                        html: "เวลาเริ่มต้น <b>ต้องน้อยกว่า</b> เวลาสิ้นสุด",
                        // html: text,
                        allowOutsideClick: false
                    });
                    $(this).val('').addClass('is-invalid');
                    return false;
                }else {
                    $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm')).removeClass('is-invalid');
                }
            }else {
                $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm')).removeClass('is-invalid');
            }
        });

        $('.val_end').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
            // console.log(moment($(this).val()).format('YYYY-MM-DD') +' ++ '+moment($('.val_start').val()).format('YYYY-MM-DD') )
            if($('.val_start').val() != ''){
                if(moment($(this).val()).format('YYYY-MM-DD HH:mm') > moment($('.val_start').val()).add(31, 'days').format('YYYY-MM-DD HH:mm')) {
                    Swal({
                        type: "warning",
                        html: "เลือกวันได้สูงสุด<b> ไม่เกิน 31</b> วัน/ครั้ง",
                        // html: text,
                        allowOutsideClick: false
                    });
                    $(this).val('').addClass('is-invalid');
                    return false;
                    return false;
                }else if(moment($(this).val()).format('YYYY-MM-DD HH:mm') <= moment($('.val_start').val()).format('YYYY-MM-DD HH:mm')) {
                    Swal({
                        type: "warning",
                        html: "เวลาเริ่มต้น <b>ต้องน้อยกว่า</b> เวลาสิ้นสุด",
                        // html: text,
                        allowOutsideClick: false
                    });
                    $(this).val('').addClass('is-invalid');
                    return false;
                }else {
                    $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm')).removeClass('is-invalid');
                }
            }else {
                $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm')).removeClass('is-invalid');
            }
        });
    });

    $('#submit_fromTo').click(function() {
        report_sn('')
    });

    $(".re_ch").click(function () {
        $(this).addClass("active");
        $(".re_tb").removeClass("active");
        if($(".mode_dwm").val() != ""){
            if($("#p-chart").hasClass("active") == false){
                if( $(".c_day").hasClass("active") != false ||
                    $(".c_week").hasClass("active") != false ||
                    $(".c_month").hasClass("active") != false ||
                    $(".c_from_to").hasClass("active") != false
                ){ report_sn('click_chart_menu'); }
            }
        }
    });
    $(".re_tb").click(function () {
        $(".re_ch").removeClass("active");
        $(this).addClass("active");
        if($(".mode_dwm").val() != ""){
            if($("#p-table").hasClass("active") == false){
                if( $(".c_day").hasClass("active") != false ||
                    $(".c_week").hasClass("active") != false ||
                    $(".c_month").hasClass("active") != false ||
                    $(".c_from_to").hasClass("active") != false
                ){report_sn('');}
            }
        }
    });

    function ch_radio(val, thiss){
        $("input[name='radio_c']").prop( "checked", false );
        thiss.prop( 'checked', true );

        $('#count_checkbox').val(0);
        if ($("#radio_temp").prop('checked') == true) {
            $("input[name='checkbox_temp[]']").attr("disabled", false).prop( "checked", false );
            $("input[name='checkbox_all_temp']").attr("disabled", false).prop( "checked", false );
        }else{
            $("input[name='checkbox_temp[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_temp']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_hum").prop('checked') == true) {
            $("input[name='checkbox_hum[]']").attr("disabled", false).prop( "checked", false );
            $("input[name='checkbox_all_hum']").attr("disabled", false).prop( "checked", false );
        }else{
            $("input[name='checkbox_hum[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_hum']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_soil").prop('checked') == true) {
            $("input[name='checkbox_soil[]']").attr("disabled", false).prop( "checked", false );
            $("input[name='checkbox_all_soil']").attr("disabled", false).prop( "checked", false );
        }else{
            $("input[name='checkbox_soil[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_soil']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_light").prop('checked') == true) {
            $("input[name='checkbox_light[]']").attr("disabled", false).prop( "checked", false );
            $("input[name='checkbox_all_light']").attr("disabled", false).prop( "checked", false );
        }else{
            $("input[name='checkbox_light[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_light']").attr("disabled", true).prop( "checked", false );
        }
    }

    function checkbox_check(thiss,mode){
        // alert(thiss.prop('checked'))
        if(thiss.prop('checked') == true){
            if($('#count_checkbox').val() == 0){
                $('#count_checkbox').val(1)
            }else {
                $('#count_checkbox').val(parseInt($('#count_checkbox').val() ) +1)
            }
        }else {
            if($('#count_checkbox').val() != 0){
                $('#count_checkbox').val( parseInt( $('#count_checkbox').val() ) -1)
            }
        }
        $('#count_checkbox_s').html($('#count_checkbox').val());
        if($('#count_checkbox').val() == 8){
            $("input[name='checkbox_"+mode+"[]']:not(:checked)").attr("disabled", true).prop( "checked", false );
        }else {
            $("input[name='checkbox_"+mode+"[]']:not(:checked)").attr("disabled", false).prop( "checked", false );
        }
    }

    function report_sn(c_menu){
        var ch_value = [];
        var checked = [];
        var d_name = [];
        var d_mode = [];

        if ($("#radio_temp").prop('checked') == true) {
            ch_value.push("อุณหภูมิ");
            $("input[name='checkbox_temp[]']:checked").map(function (){
                checked.push($(this).val());
                d_name.push($(this).attr("d_name"));
                d_mode.push($(this).attr("d_mode"));
            });
            ch_value.push(checked);
            ch_value.push(d_name);
            ch_value.push(d_mode);
        }
        if ($("#radio_hum").prop('checked') == true) {
            ch_value.push("ความชื้นอากาศ");
            $("input[name='checkbox_hum[]']:checked").map(function (){
                checked.push($(this).val());
                d_name.push($(this).attr("d_name"));
                d_mode.push($(this).attr("d_mode"));
            });
            ch_value.push(checked);
            ch_value.push(d_name);
            ch_value.push(d_mode);
        }
        if ($("#radio_light").prop('checked') == true) {
            ch_value.push("ความเข้มแสง");
            $("input[name='checkbox_light[]']:checked").map(function (){
                checked.push($(this).val());
                if($(this).attr("d_mode") == 5 || $(this).attr("d_mode") == 7){
                    d_name.push($(this).attr("d_name"));//(µmol m[baseline-shift: super; font-size: 10;]-2[baseline-shift: baseline;]s[baseline-shift: super; font-size: 10;]-1[baseline-shift: baseline;])");
                }else{
                    d_name.push($(this).attr("d_name"));
                }
                d_mode.push($(this).attr("d_mode"));
            });
            ch_value.push(checked);
            ch_value.push(d_name);
            ch_value.push(d_mode);
        }
        if ($("#radio_soil").prop('checked') == true) {
            ch_value.push("ความชื้นดิน");
            $("input[name='checkbox_soil[]']:checked").map(function (){
                checked.push($(this).val());
                d_name.push($(this).attr("d_name"));
                d_mode.push($(this).attr("d_mode"));
            });
            ch_value.push(checked);
            ch_value.push(d_name);
            ch_value.push(d_mode);
        }

        if (checked.length == 0) {
            Swal({
                type: "warning",
                title: "กรุณาเลือกเซ็นเซอร์",
                // html: text,
                allowOutsideClick: false
            });
            return false;
        }
        // console.log(ch_value);
        // return false;
        if($(".mode_dwm").val() === "from_to"){
            if ($(".val_start").val() === "") {
                $(".val_start").addClass('is-invalid');
                return false;
            }else{
                $(".val_start").removeClass('is-invalid');
            }
            if ($(".val_end").val() === "") {
                $(".val_end").addClass('is-invalid');
                return false;
            }else{
                $(".val_end").removeClass('is-invalid');
            }
            if ($(".val_start").val() >= $(".val_end").val()) {
                $(".val_start").addClass('is-invalid');
                $(".val_end").addClass('is-invalid');
                Swal({
                    type: "warning",
                    html: "เวลาเริ่มต้น <b>ต้องน้อยกว่า</b> เวลาสิ้นสุด",
                    // html: text,
                    allowOutsideClick: false
                });
                return false;
            }else{
                $(".val_start").removeClass('is-invalid');
                $(".val_end").removeClass('is-invalid');
            }
        }

        if(c_menu != ''){var loading = verticalNoTitle();}
        $("#Modal_select_sn").modal("hide");
        // alert($(".re_tb").hasClass("active"))
        // return false
        active_btn($(".mode_dwm").val());
        if($(".re_ch").hasClass("active") == true){
            $('#chart_compare').html('')
            report_chart_sn(ch_value, $(".mode_dwm").val())
        }else if($(".re_tb").hasClass("active") == true){
            $("#tablr_compare").html('')
            report_table_sn(ch_value, $(".mode_dwm").val());
        }
        function report_table_sn(val, mode_dwm){
            var loading = verticalNoTitle();
            $.ajax({
                type: "POST",
                url: "routes/tu/get_re_table.php",
                data: {
                    house_master: house_master,
                    mode : mode_dwm,
                    mode_report: 'compare',
                    config_cn : val,
                    val_start : $(".val_start").val(),
                    val_end : $(".val_end").val(),
                    sel_all_every : $("#sel_all_every").val()
                },
                // dataType: 'json',
                success: function(res) {
                    setTimeout(function () {$("#tablr_compare").html(res);loadingOut(loading);}, 2000);
                }
            });
        }
        function report_chart_sn(val, mode_dwm){
            $('#chart_compare').html('');
            var options = {
                chart: {
                    id: 'realtime',
                    foreColor: '#9ba7b2',
                    height: 560,
                    type: 'line',
                    toolbar: {
                        show: true,
                        tools: {
                            download: true,
                            selection: true,
                             zoom: true,
                             zoomin: true,
                             zoomout: true,
                             pan: true,
                        }
                    },
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 2,
                        blur: 4,
                        opacity: 0.1,
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                colors: ["#85583F", '#00FF00','#0000FF', '#FFFF00', '#FF0000', '#9400D3', '#00FFFF','#406E1C'],
                // series: [{
                //   data: data.slice()
                // }],
                series: [],
                // [{
                //     name: "temp_out",
                //     data: res.data.temp_out//[1, 15, 56, 20, 33, 27]
                // }, {
                //     name: "temp_in",
                //     data: res.data.temp_in//[30, 33, 21, 42, 19, 32]
                // }],
                title: {
                    // text: 'Multiline Chart',
                    align: 'left',
                    offsetY: 30,
                    // offsetX: 20
                },
                animations: {
                  enabled: true,
                  easing: 'linear',
                  // dynamicAnimation: {
                  //   speed: 1000
                  // }
                },
                markers: {
                    size: 2,
                    strokeWidth: 0,
                    hover: {
                        size: 7
                    }
                },
                grid: {
                    show: true,
                    padding: {
                        bottom: 0
                    }
                },
                xaxis: {
                    type: 'datetime',
                    // categories:res.data.timestamp,
                    labels: {
                        datetimeUTC: false,
                        // format: 'dd/MM HH:mm',
                        datetimeFormatter: {
                            year: 'yyyy',
                            month: 'MMM \'yy',
                            day: 'dd MMM',
                            hour: 'HH:mm'
                        }
                    }
                },
                legend: {
                    // position: 'top',
                    // horizontalAlign: 'right',
                    // offsetY: -30
                },
                fill: {
                    type: "solid",
                    fillOpacity: 0.7
                },
                noData: {
                    text: 'Loading...'
                },
                tooltip: {
                    x: {
                        format: 'yyyy-MM-dd HH:mm'
                    },
                },
                    // subtitle: {
                    //     text: '(℃)',
                    //     offsetY: 55,
                    //     offsetX: 10
                    // },
            }
            var chart = new ApexCharts(document.querySelector('#chart_compare'), options);
            chart.render();
            $.ajax({
                type: "POST",
                url: "routes/tu/get_compare.php",
                data: {
                    house_master: 'TUSMT',
                    mode : mode_dwm,
                    // mode_report: $('#mode_report').val(),
                    config_cn : val,
                    val_start : $(".val_start").val(),
                    val_end : $(".val_end").val(),
                    sel_all_every : $("#sel_all_every").val(),
                    // ct_mode: 'chart'
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    // if(res.length > 0){

                        var Series_ = []
                        // column_tb.push({title: "วัน-เวลา"})
                        // alert(val[1].length)
                        for(var i =1; i <= val[1].length; i++){
                            Series_.push({name: val[2][(i-1)], data: res['data_cn'+i]})
                        }
                        console.log(Series_);
                        chart.updateSeries(Series_)
                        // chart.updateSeries([Series_[0]
                        //     {
                        //         name: config_sn.sn_name_1,
                        //         data: data_temp_out
                        //     }, {
                        //         name: config_sn.sn_name_4,
                        //         data: data_temp_in
                        //     }
                        // ])
                        if($('#radio_temp').prop('checked') == true){
                            var title_chart = 'อุณหภูมิ';
                            var unit = '(℃)';
                        }else if($('#radio_hum').prop('checked') == true){
                            var title_chart = 'ความชื้นอากาศ';
                            var unit = '(%Rh)';
                        }else if ($('#radio_light').prop('checked') == true) {
                            var title_chart = 'ความเข้มแสง';
                            var unit = '(µmol m<sup>-2</sup>s<sup>-1</sup>)';
                        }else if ($('#radio_soil').prop('checked') == true) {
                            var title_chart = 'ความชื้นดิน';
                            var unit = '(%)';
                        }else {
                            var title_chart = '';
                        }
                        if($('#radio_hum').prop('checked') == true){
                            chart.updateOptions({
                                xaxis: {
                                   categories: res.timestamp
                                },
                                yaxis: {
                                   max: 100
                               },
                               title:  {text: title_chart},
                               tooltip: {
                                   y: {
                                       formatter: function (val) {
                                           return  val + unit
                                       }
                                   }
                               }
                            });
                        }else {
                            chart.updateOptions({
                                xaxis: {
                                   categories: res.timestamp
                               },
                                title:  {text: title_chart},
                            });
                        }
                    // }
                    $('.exportCSV').hide();
                    if(c_menu != ''){loadingOut(loading);}
                }
            });
        }
    }
    function active_btn(mode_dwm){
        if(mode_dwm === 'day'){
            $(".c_day").addClass('active')
            $(".c_week").removeClass('active')
            $(".c_month").removeClass('active')
            $(".c_from_to").removeClass('active')
        }else if(mode_dwm === 'week'){
            $(".c_day").removeClass('active')
            $(".c_week").addClass('active')
            $(".c_month").removeClass('active')
            $(".c_from_to").removeClass('active')
        }else if(mode_dwm === 'month'){
            $(".c_day").removeClass('active')
            $(".c_week").removeClass('active')
            $(".c_month").addClass('active')
            $(".c_from_to").removeClass('active')
        }else if(mode_dwm === 'from_to'){
            $(".c_day").removeClass('active')
            $(".c_week").removeClass('active')
            $(".c_month").removeClass('active')
            $(".c_from_to").addClass('active')
        }
    }

    // // NOTE:
    // $('#hide0').css( 'display', 'block' );
    // console.log(val[1])
    // alert(val[1].length);
    // var column_tb = []
    // column_tb.push({title: "วัน-เวลา"})
    // for(var i =1; i <= val[1].length; i++){
    //     column_tb.push({title: val[2][(i-1)],"sClass": "center",
    //     "orderable":      false,
    //     // "data":           null,
    //     "defaultContent": ""})
    //     // if(i <= val[1].length){
    //     //     $('.th_'+i).html(val[2][(i-1)])
    //     // }else {
    //     //     $('.th_'+i).hide()
    //     // }
    // }
    // var table = $('#table_re_Sensor').DataTable({
    //     "scrollY": '90vh',
    //     "scrollX": true,
    //     "scrollCollapse": false,
    //     "paging":    false,
    //     "searching": false,
    //     "destroy": true,
    //     "order": [
    //         [0, "desc"]
    //     ],
    //     //  "processing": "<span class='fa-stack fa-lg'>\n\
    //     //      <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
    //     // </span>&nbsp;&nbsp;&nbsp;&nbsp;Processing ...",
    //     "language": {
    //        "processing": "<span class='fa-stack fa-lg'>\n\
    //             <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
    //         </span>&emsp;Processing ...",
    //     },
    //     columns: column_tb,
    //     "columnDefs": [{
    //         // "targets": [ 1 ],
    //         // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
    //         // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
    //         "visible": false,
    //         // "searchable": false,
    //     }],
    //     dom: "<'floatRight'B><'clear'>frtip",
    //     buttons: [{
    //             text: 'Export csv',
    //             title: "Smart Farm Report",
    //             charset: 'utf-8',
    //             extension: '.csv',
    //             // exportOptions: {
    //             //    columns: [ 0, 2, 5 ]
    //             // },
    //             className:'btn btn-outline-success px-5 btnexport0',
    //             extend: 'csv',
    //             format: 'YYYY/MM/dd',
    //             // fieldSeparator: ';',
    //             // fieldBoundary: '',
    //             filename: 'smart_farm_'+datetime,
    //             // className: 'btn-info',
    //             bom: true
    //         }
    //     ]
    // });
    // $("thead", table).remove();
    // console.log(column_tb);
    // table.button('.btnexport0').nodes().css("display", "none")
    // table.reload()
    // return false;
    // $.ajax({
    //     type: "POST",
    //     url: "routes/tu/get_re_table.php",
    //     data: {
    //         house_master: house_master,
    //         mode : mode_dwm,
    //         mode_report: $('#mode_report').val(),
    //         config_cn : val,
    //         val_start : $(".val_start").val(),
    //         val_end : $(".val_end").val(),
    //         sel_all_every : $("#sel_all_every").val()
    //     },
    //     // dataType: 'json',
    //     success: function(res) {
    //         $("#tablr_compare").html(res)
            // console.log(res);
            // if(res.length > 0){
            //     table.button('.btnexport0').nodes().css("display", "block")
            //
            // }
            // else {
            //     $('#table_re_Sensor').DataTable({
            //         "scrollY": '90vh',
            //         "scrollX": true,
            //         "scrollCollapse": false,
            //         "paging":    false,
            //         "searching": false,
            //         "destroy": true,
            //         "order": [
            //             [0, "desc"]
            //         ],
            //         //  "processing": "<span class='fa-stack fa-lg'>\n\
            //         //      <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
            //         // </span>&nbsp;&nbsp;&nbsp;&nbsp;Processing ...",
            //         "language": {
            //            "processing": "<span class='fa-stack fa-lg'>\n\
            //                 <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
            //             </span>&emsp;Processing ...",
            //         },
            //         columns: column_tb,
            //         "columnDefs": [{
            //             orderable: false,
            //             // "targets": [ 1 ],
            //             // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
            //             // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
            //             "visible": false,
            //             // "searchable": false,
            //         }],
            //         // dom: "<'floatRight'B><'clear'>frtip",
            //         // buttons: [{
            //         //         text: 'Export csv',
            //         //         title: "Smart Farm Report",
            //         //         charset: 'utf-8',
            //         //         extension: '.csv',
            //         //         // exportOptions: {
            //         //         //    columns: [ 0, 2, 5 ]
            //         //         // },
            //         //         className:'btn btn-outline-success px-5 btnexport0',
            //         //         extend: 'csv',
            //         //         format: 'YYYY/MM/dd',
            //         //         // fieldSeparator: ';',
            //         //         // fieldBoundary: '',
            //         //         filename: 'smart_farm_'+datetime,
            //         //         // className: 'btn-info',
            //         //         bom: true
            //         //     }
            //         // ]
            //     });
            // }
            // table.clear().rows.add(res).draw();
    //     }
    // });
</script>
