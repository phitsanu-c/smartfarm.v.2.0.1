<?php
    $config = $_POST['data'];
    $account_user = $config["account_user"];
    $s_sensor = $_POST['s_sensor'];
    // print_r($config['s_master']);
    // exit();
    $config_sn = $config['config_sn'];
    $config_cn = $config['config_cn'];
    $sensor = $config['sensor'];
    $house_master = $config_sn["sn_status_an"];
?>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 te_st"></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item te_ht" aria-current="page"></li>
                    <li class="breadcrumb-item" aria-current="page"> รายงาน <?= $config['s_master']['house_name'] ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <hr/>
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card w-100 radius-10">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-1" role="tablist">
                            <li class="nav-item col-12 col-sm-6 col-lg-3 col-xl-3 mb-1" role="presentation">
                                <a class="nav-link active r_reSensor text-center" data-bs-toggle="pill" href="#pills_report_sn" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                                    <div class="tab-title">ข้อมูลสภาพแวดล้อม</div>
                                </a>
                            </li>
                            <li class="nav-item col-12 col-sm-6 col-lg-3 col-xl-3 mb-1" role="presentation">
                                <a class="nav-link r_reControl text-center" data-bs-toggle="pill" href="#pills_report_cn" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    <div class="tab-title">ประวัติการทำงาน</div>
                                </a>
                            </li>
                            <li class="nav-item col-12 col-sm-6 col-lg-3 col-xl-3 mb-1" role="presentation">
                                <a class="nav-link r_reAutoControl text-center" data-bs-toggle="pill" href="#pills_report_cnAuto" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    <div class="tab-title">ประวัติการตั้งค่าโหมดอัตโนมัติ</div>
                                </a>
                            </li>
                            <li class="nav-item col-12 col-sm-6 col-lg-3 col-xl-3 mb-1" role="presentation">
                                <a class="nav-link r_reManualControl text-center" data-bs-toggle="pill" href="#pills_report_cnManual" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    <div class="tab-title">ประวัติการตั้งค่าโหมดกำหนดเอง</div>
                                </a>
                            </li>
                            <input type="hidden" id="mode_report">
                        </ul>
                    </div>
                </div>

                <div class="d-sm-flex">
                    <div class="d-flex col-lg-6 col-xl-6 col-sm-12">
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 all_day">24 ชั่วโมง</button>
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 all_week">7 วัน</button>
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 all_month">30 วัน</button>
                            <button type="button" class="col-3 btn btn-outline-secondary px-2 all_from_to">กำหนดเอง</button>
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
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills_report_sn" role="tabpanel">
                        <div id="report_sensor">
                            <div class="tab-content">
                                <div class="tab-pane fade show active chart" id="p-chart" role="tabpanel">
                                    <div id="chart_report" style=""></div>
                                </div>
                                <div class="tab-pane fade" id="p-table" role="tabpanel">
                                    <div id="table_report"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills_report_cn" role="tabpanel">
                        <div id="table_report_control"></div>
                    </div>
                    <div class="tab-pane fade" id="pills_report_cnAuto" role="tabpanel">
                        <ul class="nav nav-pills" role="tablist">
                            <!-- <li class="col-4 col-lg-1 col-xl-1  nav-item text-center" role="presentation">
                                <a class="nav-link rec_auto" rec_auto="1" href="javascript:;" style="border: 1px solid transparent; border-color: #6c757d; font-size:12px;">
                                    <div class="tab-title">น้ำหยด 1</div>
                                </a>
                            </li> -->
                            <?php
                             for($i=1; $i <= 12; $i++){
                                if($config_cn['cn_status_'.$i] == 1){
                                    if($i <= 4){
                                        echo '<li class="col-4 col-lg-1 col-xl-1  nav-item text-center" role="presentation">
                                                <a class="nav-link rec_auto" rec_auto="'.$i.'" href="javascript:;" style="border: 1px solid transparent; border-color: #6c757d; font-size:12px;">
                                                    <div class="tab-title">น้ำหยด '.$i.'</div>
                                                </a>
                                            </li>';
                                    }elseif ($i > 4 && $i <= 8) {
                                        echo '<li class="col-4 col-lg-1 col-xl-1  nav-item text-center" role="presentation">
                                                <a class="nav-link rec_auto" rec_auto="'.$i.'" href="javascript:;" style="border: 1px solid transparent; border-color: #6c757d; font-size:12px;">
                                                    <div class="tab-title">พัดลม '.($i-4).'</div>
                                                </a>
                                            </li>';
                                    }elseif ($i > 8 && $i <= 10) {
                                        echo '<li class="col-4 col-lg-1 col-xl-1  nav-item text-center" role="presentation">
                                                <a class="nav-link rec_auto" rec_auto="'.$i.'" href="javascript:;" style="border: 1px solid transparent; border-color: #6c757d; font-size:12px;">
                                                    <div class="tab-title">พ่นหมอก '.($i-8).'</div>
                                                </a>
                                            </li>';
                                    }elseif ($i == 11) {
                                        echo '<li class="col-4 col-lg-1 col-xl-1  nav-item text-center" role="presentation">
                                                <a class="nav-link rec_auto" rec_auto="'.$i.'" href="javascript:;" style="border: 1px solid transparent; border-color: #6c757d; font-size:12px;">
                                                    <div class="tab-title">สเปรย์</div>
                                                </a>
                                            </li>';
                                    }elseif ($i == 12) {
                                        echo '<li class="col-4 col-lg-1 col-xl-1  nav-item text-center" role="presentation">
                                                <a class="nav-link rec_auto" rec_auto="'.$i.'" href="javascript:;" style="border: 1px solid transparent; border-color: #6c757d; font-size:12px;">
                                                    <div class="tab-title">พรางแสง</div>
                                                </a>
                                            </li>';
                                    }
                                }
                            }?>
                        </ul>
                        <input type="hidden" id="AutoMode_select">
                        <div class="table-responsive m-t-10">
                            <table id="table_re_cnAuto" class="table table-striped table-bordered dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- <th rowspan="2" class="text-center">#</th> -->
                                        <th colspan="3" class="text-center"><b class="text_autoTable"></b></th>
                                        <th colspan="2" class="text-center">ตั้งเวลา 1</th>
                                        <th colspan="2" class="text-center">ตั้งเวลา 2</th>
                                        <th colspan="2" class="text-center">ตั้งเวลา 3</th>
                                        <th colspan="2" class="text-center">ตั้งเวลา 4</th>
                                        <th colspan="2" class="text-center">ตั้งเวลา 5</th>
                                        <th colspan="2" class="text-center">ตั้งเวลา 6</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">วัน </th>
                                        <th class="text-center">เวลา</th>
                                        <th class="text-center">ผู้บันทึก</th>
                                        <th class="text-center tL_start">  </th>
                                        <th class="text-center tL_stop"> </th>
                                        <th class="text-center tL_start">  </th>
                                        <th class="text-center tL_stop"> </th>
                                        <th class="text-center tL_start">  </th>
                                        <th class="text-center tL_stop"> </th>
                                        <th class="text-center tL_start">  </th>
                                        <th class="text-center tL_stop"> </th>
                                        <th class="text-center tL_start">  </th>
                                        <th class="text-center tL_stop"> </th>
                                        <th class="text-center tL_start">  </th>
                                        <th class="text-center tL_stop"> </th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="hide_table">
                                <table id="table_re_cnAuto2" class="table table-striped table-bordered dataTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">วัน </th>
                                            <th class="text-center">เวลา</th>
                                            <th class="text-center">ผู้บันทึก</th>
                                            <th class="text-center" >ตั้งเวลา 1 <div class="tL_start"></div> </th>
                                            <th class="text-center" >ตั้งเวลา 1 <div class="tL_stop"></div></th>
                                            <th class="text-center" >ตั้งเวลา 2 <div class="tL_start"></div> </th>
                                            <th class="text-center" >ตั้งเวลา 2 <div class="tL_stop"></div></th>
                                            <th class="text-center" >ตั้งเวลา 3 <div class="tL_start"></div> </th>
                                            <th class="text-center" >ตั้งเวลา 3 <div class="tL_stop"></div></th>
                                            <th class="text-center" >ตั้งเวลา 4 <div class="tL_start"></div> </th>
                                            <th class="text-center" >ตั้งเวลา 4 <div class="tL_stop"></div></th>
                                            <th class="text-center" >ตั้งเวลา 5 <div class="tL_start"></div> </th>
                                            <th class="text-center" >ตั้งเวลา 5 <div class="tL_stop"></div></th>
                                            <th class="text-center" >ตั้งเวลา 6 <div class="tL_start"></div> </th>
                                            <th class="text-center" >ตั้งเวลา 6 <div class="tL_stop"></div></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills_report_cnManual" role="tabpanel">
                        <div id="table_report_control_Manual"></div>
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
                            <b>เลือกประเภท</b>
                        </h4><hr/>
                        <div class="d-flex mb-2">
                            <div class="form-check mb-3">
                                <h5 style="margin-left:40px">
                                <input type="checkbox" class="form-check-input" id="checkbox_all_sn">
                                <label class="form-check-label">เลือกทุกประเภท</label></h5>
                                <input type="hidden" class="mode_dwm">
                                <input type="hidden" class="new_mode_dwm">
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
                        <div class="row">
                            <?php if($s_sensor['s_btnT'] > 0){?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_temp" type="radio" onchange="ch_radio('temp')" <?php if($s_sensor['s_btnT'] > 0){echo 'checked';}?>>
                                            <h5>อุณหภูมิ</h5>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_temp" onchange="checkbox_all('temp')" <?php if($s_sensor['s_btnT'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด </label>
                                            </div>
                                            <hr/>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($config_sn['sn_status_'.$i] == 1){
                                                    if($config_sn['sn_sensor_'.$i] == 1){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_temp[]" value="<?= $config_sn['sn_channel_'.$i] ?>" d_name="<?= $config_sn['sn_name_'.$i]." (℃)" ?>" d_mode="<?= $config_sn['sn_sensor_'.$i] ?>" onchange="checkbox_check(<?= $s_sensor['s_btnT'] ?> ,'temp')" checked>
                                                            <label class="form-check-label"><?= $config_sn['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if($s_sensor['s_btnH'] > 0){?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_hum" type="radio" onchange="ch_radio('hum')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 1){echo 'checked';}?>>
                                            <h5>ความชื้นอากาศ</h5>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_hum" onchange="checkbox_all('hum')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด</label>
                                            </div>
                                            <hr/>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($config_sn['sn_status_'.$i] == 1){
                                                    if($config_sn['sn_sensor_'.$i] == 2){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_hum[]" value="<?= $config_sn['sn_channel_'.$i] ?>" d_name="<?= $config_sn['sn_name_'.$i]." (%Rh)" ?>" d_mode="<?= $config_sn['sn_sensor_'.$i] ?>" onchange="checkbox_check(<?= $s_sensor['s_btnH'] ?> ,'hum')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] > 0){echo 'checked';}?>>
                                                            <label class="form-check-label"><?= $config_sn['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if($s_sensor['s_btnL'] > 0){?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_light" type="radio" onchange="ch_radio('light')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] > 0){echo 'checked';}?>>
                                            <h5>ความเข้มแสง</h5>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_light" onchange="checkbox_all('light')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด</label>
                                            </div>
                                            <hr/>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($config_sn['sn_status_'.$i] == 1){
                                                    if($config_sn['sn_sensor_'.$i] == 4){
                                                        echo '<div class="form-check mb-3">
                                                                <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'.$config_sn['sn_channel_'.$i] .'" d_name="'. $config_sn['sn_name_'.$i].' (KLux)" d_mode="'. $config_sn['sn_sensor_'.$i] .'" onchange="checkbox_check('. $s_sensor['s_btnL'] .' ,"light")" ';
                                                                if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] == 1){echo 'checked';} echo '>';
                                                                echo '<label class="form-check-label">'.$config_sn['sn_name_'.$i].'</label>
                                                            </div>';
                                                    }else if($config_sn['sn_sensor_'.$i] == 5){
                                                        echo '<div class="form-check mb-3">
                                                                <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'.$config_sn['sn_channel_'.$i] .'" d_name="'. $config_sn['sn_name_'.$i].'" d_mode="'. $config_sn['sn_sensor_'.$i] .'" onchange="checkbox_check('. $s_sensor['s_btnL'] .' ,"light")" ';
                                                                if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] == 1){echo 'checked';} echo '>';
                                                                echo '<label class="form-check-label">'.$config_sn['sn_name_'.$i].'</label>
                                                            </div>';
                                                    }else if($config_sn['sn_sensor_'.$i] == 6){
                                                        echo '<div class="form-check mb-3">
                                                                <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'.$config_sn['sn_channel_'.$i] .'" d_name="'. $config_sn['sn_name_'.$i].' (KLux)" d_mode="'. $config_sn['sn_sensor_'.$i] .'" onchange="checkbox_check('. $s_sensor['s_btnL'] .' ,"light")" ';
                                                                if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] == 1){echo 'checked';} echo '>';
                                                                echo '<label class="form-check-label">'.$config_sn['sn_name_'.$i].'</label>
                                                            </div>';
                                                    }else if($config_sn['sn_sensor_'.$i] == 7){
                                                        echo '<div class="form-check mb-3">
                                                                <input type="checkbox" class="form-check-input" name="checkbox_light[]" value="'.$config_sn['sn_channel_'.$i] .'" d_name="'. $config_sn['sn_name_'.$i].'" d_mode="'. $config_sn['sn_sensor_'.$i] .'" onchange="checkbox_check('. $s_sensor['s_btnL'] .' ,"light")" ';
                                                                if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] == 0 && $s_sensor['s_btnL'] == 1){echo 'checked';} echo '>';
                                                                echo '<label class="form-check-label">'.$config_sn['sn_name_'.$i].'</label>
                                                            </div>';
                                                    }
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } if($s_sensor['s_btnS'] > 0){?>
                                <div class="col-lg-3 col-xl-3 col-sm-12 d-flex">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" name="radio_c" id="radio_soil" type="radio" onchange="ch_radio('soil')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] > 0){echo 'checked';}?>>
                                            <h5>ความชื้นในดิน</h5>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="checkbox_all_soil" onchange="checkbox_all('soil')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] > 0){echo 'checked';}?>>
                                                <label class="form-check-label">เลือกทั้งหมด</label>
                                            </div>
                                            <hr/>
                                            <?php for($i=1; $i <= 7; $i++ ){
                                                if($config_sn['sn_status_'.$i] == 1){
                                                    if($config_sn['sn_sensor_'.$i] == 3){ ?>
                                                        <div class="form-check mb-3">
                                                            <input type="checkbox" class="form-check-input" name="checkbox_soil[]" value="<?= $config_sn['sn_channel_'.$i] ?>" d_name="<?= $config_sn['sn_name_'.$i]." (%)" ?>" d_mode="<?= $config_sn['sn_sensor_'.$i] ?>" onchange="checkbox_check(<?=  $s_sensor['s_btnS'] ?> ,'soil')" <?php if($s_sensor['s_btnT'] == 0 && $s_sensor['s_btnH'] == 0 && $s_sensor['s_btnS'] > 0){echo 'checked';}?>>
                                                            <label class="form-check-label"><?= $config_sn['sn_name_'.$i] ?></label>
                                                        </div>
                                            <?php } } } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
<script>
    var house_master = '<?= $house_master ?>';
    var login_user = '<?= $account_user ?>';
    var config_sn = $.parseJSON('<?= json_encode($config_sn) ?>');
    var config_cn = $.parseJSON('<?= json_encode($config_cn) ?>');
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

    $('.mode_sn').show()
    ch_radio('temp');
    $(".mode_dwm").val('');
    $('#mode_report').val('re_sensor');
    // $('#table_re_Sensor').wrap('<div id="hide0" style="display:none"/></div>');
    // $('#hide0').css( 'display', 'none' );
    $('#chart_report').html('')
    $('#table_report').html('')
    $("#table_report_control").html('');
    $("#table_report_control_Manual").html('')
    $(".all_day").click(function() {
        // alert($('#mode_report').val())
        $(".mode_dwm").val('day');
        if($('#mode_report').val() === 're_cn'){
            report_cn_table('day')
        }else if($('#mode_report').val() === 're_cnAuto'){
            report_cnAuto_table('day')
        }else if($('#mode_report').val() === 're_cnManual'){
            report_cnManual_table('day')
        }else {
            $(".title_mod").html('แสดงข้อมูลย้อนหลัง 1 วัน');
            $(".hide_dwm").hide();
            $("#Modal_select_sn").modal("show");
        }
    });
    $(".all_week").click(function() {
        $(".mode_dwm").val('week');
        if($('#mode_report').val() === 're_cn'){
            report_cn_table('week')
        }else if($('#mode_report').val() === 're_cnAuto'){
            report_cnAuto_table('week')
        }else if($('#mode_report').val() === 're_cnManual'){
            report_cnManual_table('week')
        }else {
            $(".title_mod").html('แสดงข้อมูลย้อนหลัง 7 วัน');
            $(".hide_dwm").hide();
            $("#Modal_select_sn").modal("show");
        }
    });
    $(".all_month").click(function() {
        $(".mode_dwm").val('month');
        if($('#mode_report').val() === 're_cn'){
            report_cn_table('month')
        }else if($('#mode_report').val() === 're_cnAuto'){
            report_cnAuto_table('month')
        }else if($('#mode_report').val() === 're_cnManual'){
            report_cnManual_table('month')
        }else {
            $(".title_mod").html('แสดงข้อมูลย้อนหลัง 30 วัน');
            $(".hide_dwm").hide();
            $("#Modal_select_sn").modal("show");
        }
    });
    $(".all_from_to").click(function() {
        $(".mode_dwm").val('from_to');
        $(".title_mod").html('แสดงข้อมูลย้อนหลัง &nbsp; &nbsp;&nbsp;');
        $(".hide_dwm").show();
        $("#Modal_select_sn").modal("show");

        $('.val_start').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
            if($('.val_end').val() != ''){
                if(moment($(this).val()).format('YYYY-MM-DD') < moment($('.val_end').val()).add(-31, 'days').format('YYYY-MM-DD')) {
                    Swal({
                        type: "warning",
                        html: "เลือกวันได้สูงสุด<b> ไม่เกิน 31</b> วัน/ครั้ง",
                        // html: text,
                        allowOutsideClick: false
                    });
                    $(this).val('').addClass('is-invalid');
                    return false;
                }else if(moment($(this).val()).format('YYYY-MM-DD') >= moment($('.val_end').val()).format('YYYY-MM-DD')) {
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
                if(moment($(this).val()).format('YYYY-MM-DD') > moment($('.val_start').val()).add(31, 'days').format('YYYY-MM-DD')) {
                    Swal({
                        type: "warning",
                        html: "เลือกวันได้สูงสุด<b> ไม่เกิน 31</b> วัน/ครั้ง",
                        // html: text,
                        allowOutsideClick: false
                    });
                    $(this).val('').addClass('is-invalid');
                    return false;
                    return false;
                }else if(moment($(this).val()).format('YYYY-MM-DD') <= moment($('.val_start').val()).format('YYYY-MM-DD')) {
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
        if($('#mode_report').val() != 're_sensor'){
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
            // alert($(".val_start").val()+' - '+$(".val_end").val())
            $("#Modal_select_sn").modal("hide");
            if($('#mode_report').val() === 're_cn'){
                report_cn_table('from_to')
            }else if($('#mode_report').val() === 're_cnAuto'){
                report_cnAuto_table('from_to')
            }else if($('#mode_report').val() === 're_cnManual'){
                report_cnManual_table('from_to')
            }
        }else {
            report_sn('')
            // $('.new_mode_dwm')
        }
    });

    $("#checkbox_all_sn").change(function () {
        if($(this).prop( "checked") == true){
            $("#radio_temp").attr("disabled", true);
            $("#radio_hum").attr("disabled", true);
            $("#radio_light").attr("disabled", true);
            $("#radio_soil").attr("disabled", true);
            $("#radio_other").attr("disabled", true);
            $("input[name='checkbox_temp[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_temp']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_hum[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_hum']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_light[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_light']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_soil[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_soil']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_other[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_other']").attr("disabled", false).prop( "checked", true );
        }else{
            $("#radio_temp").attr("disabled", false);
            $("#radio_hum").attr("disabled", false);
            $("#radio_light").attr("disabled", false);
            $("#radio_soil").attr("disabled", false);
            $("#radio_other").attr("disabled", false);
            if ($("#radio_temp").prop('checked') == true) {ch_radio('temp');}
            if ($("#radio_hum").prop('checked') == true) {ch_radio('hum');}
            if ($("#radio_light").prop('checked') == true) {ch_radio('light');}
            if ($("#radio_soil").prop('checked') == true) {ch_radio('soil');}
            if ($("#radio_other").prop('checked') == true) {ch_radio('other');}
        }
    });

    $(".re_ch").click(function () {
        $(".re_ch").addClass("active");
        $(".re_tb").removeClass("active");
        if($("#p-chart").hasClass("active") == false){
            if( $(".all_day").hasClass("active") != false ||
                $(".all_week").hasClass("active") != false ||
                $(".all_month").hasClass("active") != false ||
                $(".all_from_to").hasClass("active") != false
            ){ report_sn('click_chart_menu'); }
        }
    });
    $(".re_tb").click(function () {
        $(".re_ch").removeClass("active");
        $(".re_tb").addClass("active");
        if($("#p-table").hasClass("active") == false){
            if( $(".all_day").hasClass("active") != false ||
                $(".all_week").hasClass("active") != false ||
                $(".all_month").hasClass("active") != false ||
                $(".all_from_to").hasClass("active") != false
            ){report_sn('');}
        }
    });

    function ch_radio(){
        if ($("#radio_temp").prop('checked') == true) {
            $("input[name='checkbox_temp[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_temp']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_temp[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_temp']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_hum").prop('checked') == true) {
            $("input[name='checkbox_hum[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_hum']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_hum[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_hum']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_soil").prop('checked') == true) {
            $("input[name='checkbox_soil[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_soil']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_soil[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_soil']").attr("disabled", true).prop( "checked", false );
        }
        if ($("#radio_light").prop('checked') == true) {
            $("input[name='checkbox_light[]']").attr("disabled", false).prop( "checked", true );
            $("input[name='checkbox_all_light']").attr("disabled", false).prop( "checked", true );
        }else{
            $("input[name='checkbox_light[]']").attr("disabled", true).prop( "checked", false );
            $("input[name='checkbox_all_light']").attr("disabled", true).prop( "checked", false );
        }
        // if ($("#radio_other").prop('checked') == true) {
        //     $("input[name='checkbox_other[]']").attr("disabled", false).prop( "checked", true );
        //     $("input[name='checkbox_all_other']").attr("disabled", false).prop( "checked", true );
        // }else{
        //     $("input[name='checkbox_other[]']").attr("disabled", true).prop( "checked", false );
        //     $("input[name='checkbox_all_other']").attr("disabled", true).prop( "checked", false );
        // }
    }
    function checkbox_all(val){
        // $("input[name='checkbox_"+ val.value+"[]']").attr("disabled", false);
        // alert(val.prop('checked'));

        if ($("input[name='checkbox_all_"+val+"']").prop('checked') == true) {
            $("input[name='checkbox_"+ val+"[]']").prop( "checked", true );
        }else{
            $("input[name='checkbox_"+ val+"[]']").prop( "checked", false );
        }
    }
    function checkbox_check(count,mode){
        var count_ch = [];
        $("input[name='checkbox_"+mode+"[]']:checked").map(function (){
            count_ch.push($(this).val());
        });//
        // alert(count_ch.length)
        if(count_ch.length === count){
            $("input[name='checkbox_all_"+mode+"']").prop( "checked", true );
        }else{
            $("input[name='checkbox_all_"+mode+"']").prop( "checked", false );
        }
        // alert("cl "+count_ch.length+" +all "+count)
    }
    function report_sn(c_menu){
        var ch_value = [];
        var checked = [];
        var d_name = [];
        var d_mode = [];
        if($("#checkbox_all_sn").prop("checked") == true){
            ch_value.push("all");
            $("input[name='checkbox_temp[]']:checked").map(function (){
                checked.push($(this).val());
                d_name.push($(this).attr("d_name"));
                d_mode.push($(this).attr("d_mode"));
            });
            $("input[name='checkbox_hum[]']:checked").map(function (){
                checked.push($(this).val());
                d_name.push($(this).attr("d_name"));
                d_mode.push($(this).attr("d_mode"));
            });
            $("input[name='checkbox_light[]']:checked").map(function (){
                checked.push($(this).val());
                if($(this).attr("d_mode") == 5 || $(this).attr("d_mode") == 7){
                    d_name.push($(this).attr("d_name"));//(µmol m[baseline-shift: super; font-size: 10;]-2[baseline-shift: baseline;]s[baseline-shift: super; font-size: 10;]-1[baseline-shift: baseline;])");
                }else{
                    d_name.push($(this).attr("d_name"));
                }
                d_mode.push($(this).attr("d_mode"));
            });
            $("input[name='checkbox_soil[]']:checked").map(function (){
                checked.push($(this).val());
                d_name.push($(this).attr("d_name"));
                d_mode.push($(this).attr("d_mode"));
            });
            ch_value.push(checked);
            ch_value.push(d_name);
            ch_value.push(d_mode);
        }
        else{
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
            // if ($("#radio_other").prop('checked') == true) {
            //     ch_value.push("other");
            //     $("input[name='checkbox_other[]']:checked").map(function (){
            //         checked.push($(this).val());
            //         d_name.push($(this).attr("d_name"));
            //         d_mode.push($(this).attr("d_mode"));
            //     });
            //     ch_value.push(checked);
            //     ch_value.push(d_name);
            //     ch_value.push(d_mode);
            // }
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
        // alert(c_menu)
        if(c_menu != ''){var loading = verticalNoTitle();}
        // function report_chart(){
        //     $("#report_chart").addClass("report_chart");
        //     $.ajax({
        //         type: "POST",
        //         url: "routes/report_allChart.php",
        //         data: {
        //             house_master: $(".house_master").val(),
        //             mode : $(".mode_dwm").val(),
        //             ch_value : ch_value,
        //             val_start : $(".val_start").val(),
        //             val_end : $(".val_end").val(),
        //             sel_all_every : $("#sel_all_every").val()
        //         },
        //         dataType: 'json',
        //         success: function(res) {
        //             if(res.theme === "dark-theme"){
        //                 var theme = 'dark';
        //             }else{
        //                 var theme = '';
        //             }
        //             // console.log(res)
        //             // alert(ch_value[1][1])
        //             var data_chart = [];
        //             // var c_unit = [];
        //             for(var k =1; k<=ch_value[1].length; k++){
        //                 data_chart.push({
        //                         name: ch_value[2][(k-1)],
        //                         type: 'line',
        //                         showSymbol: false,
        //                         // areaStyle: {},
        //                         data: res.data['data_'+k]
        //                 })
        //             }
        //             if(ch_value[0] === "other"){
        //                 var chart_name = 'other';
        //             }else{
        //                 var chart_name = ch_value[0];
        //             }
        //             // console.log(data_chart)
        //             // return false;
        //             var myChart = echarts.init(document.getElementById('report_chart'), theme);
        //             // var unt = "µmol m[baseline-shift: super; font-size: 10;]-2[baseline-shift: baseline;]s[baseline-shift: super; font-size: 10;]-1[baseline-shift: baseline;]";
        //             if(ch_value[3][(0)] == 1){
        //                 var unt = "℃";
        //             }else if(ch_value[3][(0)] == 2){
        //                 var unt = "%Rh";
        //             }else if(ch_value[3][(0)] == 3){
        //                 var unt = "%";
        //             }else if(ch_value[3][(0)] == 4 || ch_value[3][(0)] == 6 ){
        //                 var unt = "KLux";
        //             }else if(ch_value[3][(0)] == 5 || ch_value[3][(0)] == 7){
        //                 var unt = "µmol m^2 s^(-1)";
        //             }else{
        //                 var unt = "W";
        //             }
        //             // alert(ch_value[3][(0)])
        //             // specify chart configuration item and data
        //             var option = {
        //                 title: {
        //                     text: chart_name
        //                 },
        //                 tooltip: {
        //                     trigger: 'axis',
        //                     axisPointer: {
        //                         type: 'cross',
        //                         label: {
        //                             backgroundColor: '#6a7985'
        //                         }
        //                     }
        //                 },
        //                 legend: {
        //                     data: ch_value[2]
        //                 },
        //                 xAxis: {
        //                     type: 'time',//'category',
        //                     boundaryGap: false,
        //                     axisLabel: {
        //                         formatter: (function(value){
        //                             return moment(value).format('YYYY/MM/DD HH:mm:ss');
        //                         })
        //                     },
        //                     // data: res.data.timestamp,
        //                 },
        //                 yAxis: {
        //                     type: 'value',
        //                     name: unt//'µmol m<sup>-2</sup>s<sup>-1</sup>',
        //                     // axisLabel : {
        //                     //     formatter: '{value} (µmol m<sup>-2</sup>s<sup>-1</sup>)'
        //                     // }
        //                 },
        //                 toolbox: {
        //                     feature: {
        //                         saveAsImage: {}
        //                     }
        //                 },
        //                 dataZoom: [{
        //                     type: 'inside',
        //                     start: 0,
        //                     end: 100
        //                     }, {
        //                     start: 0,
        //                     end: 100
        //                 }],
        //                 grid: {
        //                     left: '2%',
        //                     right: '1%',
        //                     bottom: '2%',
        //                     containLabel: true
        //                 },
        //                 series:data_chart
        //             };
        //
        //             // use configuration item and data specified to show chart
        //             myChart.setOption(option);
        //             loadingOut(loading);
        //         }
        //     });
        // }
        $("#Modal_select_sn").modal("hide");
        // alert($(".re_tb").hasClass("active"))
        // return false
        active_btn($(".mode_dwm").val());
        if($(".re_ch").hasClass("active") == true){
            $('#chart_report').html('')
            report_chart_sn(ch_value, $(".mode_dwm").val())
        }else if($(".re_tb").hasClass("active") == true){
            $('#table_report').html('')
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
                    mode_report: $('#mode_report').val(),
                    config_cn : val,
                    val_start : $(".val_start").val(),
                    val_end : $(".val_end").val(),
                    sel_all_every : $("#sel_all_every").val()
                },
                // dataType: 'json',
                success: function(res) {
                    setTimeout(function () {
                        $("#table_report").html(res);
                        loadingOut(loading);
                    }, 2000);
                }
            });
            // // $('#hide0').css( 'display', 'block' );
            // // console.log(val[1])
            // // alert(val[1].length);
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
            // // $("thead", table).remove();
            // console.log(column_tb);
            // table.button('.btnexport0').nodes().css("display", "none")
            // table.reload()
            // // return false;
            // $.ajax({
            //     type: "POST",
            //     url: "routes/tu/get_report_cn_table.php",
            //     data: {
            //         house_master: house_master,
            //         mode : mode_dwm,
            //         mode_report: $('#mode_report').val(),
            //         config_cn : val,
            //         val_start : $(".val_start").val(),
            //         val_end : $(".val_end").val(),
            //         sel_all_every : $("#sel_all_every").val()
            //     },
            //     dataType: 'json',
            //     success: function(res) {
            //         // console.log(res);
            //         if(res.length > 0){
            //             table.button('.btnexport0').nodes().css("display", "block")
            //
            //         }
            //         // else {
            //         //     $('#table_re_Sensor').DataTable({
            //         //         "scrollY": '90vh',
            //         //         "scrollX": true,
            //         //         "scrollCollapse": false,
            //         //         "paging":    false,
            //         //         "searching": false,
            //         //         "destroy": true,
            //         //         "order": [
            //         //             [0, "desc"]
            //         //         ],
            //         //         //  "processing": "<span class='fa-stack fa-lg'>\n\
            //         //         //      <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
            //         //         // </span>&nbsp;&nbsp;&nbsp;&nbsp;Processing ...",
            //         //         "language": {
            //         //            "processing": "<span class='fa-stack fa-lg'>\n\
            //         //                 <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
            //         //             </span>&emsp;Processing ...",
            //         //         },
            //         //         columns: column_tb,
            //         //         "columnDefs": [{
            //         //             orderable: false,
            //         //             // "targets": [ 1 ],
            //         //             // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
            //         //             // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
            //         //             "visible": false,
            //         //             // "searchable": false,
            //         //         }],
            //         //         // dom: "<'floatRight'B><'clear'>frtip",
            //         //         // buttons: [{
            //         //         //         text: 'Export csv',
            //         //         //         title: "Smart Farm Report",
            //         //         //         charset: 'utf-8',
            //         //         //         extension: '.csv',
            //         //         //         // exportOptions: {
            //         //         //         //    columns: [ 0, 2, 5 ]
            //         //         //         // },
            //         //         //         className:'btn btn-outline-success px-5 btnexport0',
            //         //         //         extend: 'csv',
            //         //         //         format: 'YYYY/MM/dd',
            //         //         //         // fieldSeparator: ';',
            //         //         //         // fieldBoundary: '',
            //         //         //         filename: 'smart_farm_'+datetime,
            //         //         //         // className: 'btn-info',
            //         //         //         bom: true
            //         //         //     }
            //         //         // ]
            //         //     });
            //         // }
            //         table.clear().rows.add(res).draw();
            //     }
            // });
        }
        function report_chart_sn(val, mode_dwm){
            // alert( )
            // return false;
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
                            export: {
                                svg: {
                                    filename: SVG,
                                },
                                png: {
                                    filename: undefined,
                                },
                                jpg: {
                                    filename: undefined,
                                },
                                csv: false
                            }
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
                    width: 5
                },
                // colors: ["#0d6efd", '#212529'],
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
                    y: {
                    	formatter: function (val) {
                    		return  val //+ " ℃"
                    	}
                    }
                },
                    // subtitle: {
                    //     text: '(℃)',
                    //     offsetY: 55,
                    //     offsetX: 10
                    // },
            }
            var chart = new ApexCharts(document.querySelector('#chart_report'), options);
            chart.render();
            $.ajax({
                type: "POST",
                url: "routes/tu/get_report_cn_table.php",
                data: {
                    house_master: house_master,
                    mode : mode_dwm,
                    mode_report: $('#mode_report').val(),
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
                        if($('#checkbox_all_sn').prop('checked') == false && $('#radio_hum').prop('checked') == true){
                            chart.updateOptions({
                                xaxis: {
                                  categories: res.timestamp
                              },
                              yaxis: {
                                 max: 100
                              }
                            });
                        }else {
                            chart.updateOptions({
                                xaxis: {
                                  categories: res.timestamp
                              },
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
            $(".all_day").addClass('active')
            $(".all_week").removeClass('active')
            $(".all_month").removeClass('active')
            $(".all_from_to").removeClass('active')
        }else if(mode_dwm === 'week'){
            $(".all_day").removeClass('active')
            $(".all_week").addClass('active')
            $(".all_month").removeClass('active')
            $(".all_from_to").removeClass('active')
        }else if(mode_dwm === 'month'){
            $(".all_day").removeClass('active')
            $(".all_week").removeClass('active')
            $(".all_month").addClass('active')
            $(".all_from_to").removeClass('active')
        }else if(mode_dwm === 'from_to'){
            $(".all_day").removeClass('active')
            $(".all_week").removeClass('active')
            $(".all_month").removeClass('active')
            $(".all_from_to").addClass('active')
        }
    }
</script>
<script type="text/javascript">
    $('.r_reSensor').click(function(){
        $('.mode_sn').show()
        ch_radio('temp');
        $(".mode_dwm").val('');
        $('#mode_report').val('re_sensor');
        $(".all_day").removeClass('active')
        $(".all_week").removeClass('active')
        $(".all_month").removeClass('active')
        $(".all_from_to").removeClass('active')
        $('#chart_report').html('')
        $('#table_report').html('')
        // $('#table_re_Sensor').wrap('<div id="hide0" style="display:none"/></div>');
        // $('#hide0').css( 'display', 'none' );
        $('.val_start').val('').removeClass('is-invalid');
        $('.val_end').val('').removeClass('is-invalid');
    })
    $('.r_reControl').click(function(){
        $('.mode_sn').hide()
        $('#mode_report').val('re_cn');
        $(".all_day").removeClass('active')
        $(".all_week").removeClass('active')
        $(".all_month").removeClass('active')
        $(".all_from_to").removeClass('active')
        $(".mode_dwm").val('');
        // $('#tb_re_cn').wrap('<div id="hide" style="display:none"/>');
        // $('#hide').css( 'display', 'none' );
        $("#table_report_control").html('');
        $('.val_start').val('').removeClass('is-invalid');
        $('.val_end').val('').removeClass('is-invalid');
    })
    $('.r_reAutoControl').click(function(){
        $('.mode_sn').hide()
        $('#mode_report').val('re_cnAuto');
        $(".all_day").removeClass('active')
        $(".all_week").removeClass('active')
        $(".all_month").removeClass('active')
        $(".all_from_to").removeClass('active')
        $(".mode_dwm").val('');
        $("#AutoMode_select").val(1)
        $(".rec_auto").removeClass('active');
        $("a[rec_auto=1]").addClass('active');
        $('.text_autoTable').html('ประวัต ิน้ำหยด 1 '+config_cn['cn_name_1'])
        $('#hide_table').hide();
        $('#table_re_cnAuto').wrap('<div id="hide2" style="display:none"/></div>');
        $('#hide2').css( 'display', 'none' );
        $('.val_start').val('').removeClass('is-invalid');
        $('.val_end').val('').removeClass('is-invalid');
        $('.rec_auto').click(function(){
            // alert($(this).attr('rec_auto'));
            $("#AutoMode_select").val($(this).attr('rec_auto'))
            if($(this).attr('rec_auto') <= 4){
                $('.text_autoTable').html('ประวัติ น้ำหยด '+$(this).attr('rec_auto')+' '+config_cn['cn_name_'+$(this).attr('rec_auto')])
            }else if ($(this).attr('rec_auto') > 4 && $(this).attr('rec_auto') <= 8) {
                $('.text_autoTable').html('ประวัติ พัดลม '+($(this).attr('rec_auto')-4)+' '+config_cn['cn_name_'+$(this).attr('rec_auto')])
            }else if ($(this).attr('rec_auto') > 8 && $(this).attr('rec_auto') <= 10) {
                $('.text_autoTable').html('ประวัติ พ่นหมอก '+($(this).attr('rec_auto')-8)+' '+config_cn['cn_name_'+$(this).attr('rec_auto')])
            }else if ($(this).attr('rec_auto') == 11) {
                $('.text_autoTable').html('ประวัติ สเปรย์'+config_cn['cn_name_'+$(this).attr('rec_auto')])
            }else if ($(this).attr('rec_auto') == 12) {
                $('.text_autoTable').html('ประวัติ ม่านพรางแสง')
            }
            // $('.text_autoTable').html(config_cn['cn_name_'+$(this).attr('rec_auto')])
            $('.rec_auto').removeClass('active')
            $(this).addClass('active')
            if($(".mode_dwm").val() != ''){
                report_cnAuto_table($(".mode_dwm").val());
            }
        });
    })
    $('.r_reManualControl').click(function(){
        $('.mode_sn').hide()
        $('#mode_report').val('re_cnManual');
        $(".all_day").removeClass('active')
        $(".all_week").removeClass('active')
        $(".all_month").removeClass('active')
        $(".all_from_to").removeClass('active')
        $(".mode_dwm").val('');
        $("#table_report_control_Manual").html('')
        // $('#table_re_cnManual').wrap('<div id="hide3" style="display:none"/>');
        // $('#hide3').css( 'display', 'none' );
        $('.val_start').val('').removeClass('is-invalid');
        $('.val_end').val('').removeClass('is-invalid');
    })
    var currentdate = new Date();
    var datetime = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-"
                + currentdate.getDate() + "_"
                + currentdate.getHours() + "."
                + currentdate.getMinutes(); //+ ":"
                // + currentdate.getSeconds();

    function report_cn_table(mode_dwm){
        var loading = verticalNoTitle();
        // $('#hide').css( 'display', 'block' );
        $("#table_report_control").html('');
        active_btn(mode_dwm);
        // table.button('.btnexport').nodes().css("display", "none")
        // table.clear().draw();
        $.ajax({
            type: "POST",
            url: "routes/tu/get_report_control.php",
            data: {
                house_master: house_master,
                mode : mode_dwm,
                mode_report: $('#mode_report').val(),
                config_cn : config_cn,
                val_start : $(".val_start").val(),
                val_end : $(".val_end").val(),
            },
            // dataType: 'json',
            success: function(res) {
                // console.log(res);
                $('#table_report_control').html(res);
                loadingOut(loading);
                // if(res.length > 0){
                //     table.button('.btnexport').nodes().css("display", "block")
                // }
                // table.clear().rows.add(res).draw();
            }
        });
    }
    function report_cnAuto_table(mode_dwm){
        var loading = verticalNoTitle();
        $('#hide2').css( 'display', 'block' );
        active_btn(mode_dwm);
        var table2 = $('#table_re_cnAuto').DataTable({
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
                    // title: "Smart Farm Report Control",
                    // charset: 'UTF-8',
                    // extension: '.csv',
                    className:'btn btn-outline-success px-5 btnexport2',
                    // extend: 'csv',
                    // format: 'YYYY/MM/dd',
                    // // fieldSeparator: ';',
                    // // fieldBoundary: '',
                    // filename: 'smart_farm_control_'+datetime,
                    // // className: 'btn-info',
                    // bom: true
                }
            ]
        });
        table2.button('.btnexport2').nodes().css("display", "none")
        table2.clear().draw();

        // alert($("#AutoMode_select").val())
        if($("#AutoMode_select").val() == 12){
            $('.tL_start').html('เปิดรับแสง');
            $('.tL_stop').html('ปิดรับแสง');
        }else {
            $('.tL_start').html('เริ่ม');
            $('.tL_stop').html('สิ้นสุด');
        }
        $.ajax({
            type: "POST",
            url: "routes/tu/get_report_cn_table.php",
            data: {
                house_master: house_master,
                mode : mode_dwm,
                mode_report: $('#mode_report').val(),
                load_select:$("#AutoMode_select").val(),
                config_cn : config_cn,
                val_start : $(".val_start").val(),
                val_end : $(".val_end").val(),
            },
            dataType: 'json',
            success: function(res) {
                // console.log(res);
                if(res.length > 0){
                    table2.button('.btnexport2').nodes().css("display", "block")
                }
                table2.clear().rows.add(res).draw();
                loadingOut(loading);
                $('.btnexport2').on('click', function() {
                    var table22 = $('#table_re_cnAuto2').DataTable({
                        data: res,
                        destroy: true,
                        dom: "<'floatRight'B><'clear'>frtip",
                        buttons: [{
                                text: 'Export csv',
                                className:'btn btn-outline-success px-5 btnexport22',
                                title: "Smart Farm Report Control",
                                charset: 'UTF-8',
                                extension: '.csv',
                                extend: 'csv',
                                format: 'YYYY-MM-dd',
                                // fieldSeparator: ';',
                                // fieldBoundary: '',
                                filename: 'smart_farm_control_'+datetime,
                                bom: true
                            }
                        ],drawCallback: function() {
                    $('.btnexport22').click()
                    setTimeout(function() {
                            $('#table_re_cnAuto2').DataTable().destroy(false);
                            }, 200)
                        }
                    });
                })
            }
        });
    }
    function report_cnManual_table(mode_dwm){
        var loading = verticalNoTitle();
        // $('#hide3').css( 'display', 'block' );
        $("#table_report_control_Manual").html('')
        active_btn(mode_dwm);
        $.ajax({
            type: "POST",
            url:'routes/tu/get_report_controlManual.php',
            data: {
                house_master: house_master,
                mode : mode_dwm,
                mode_report: $('#mode_report').val(),
                config_cn : config_cn,
                val_start : $(".val_start").val(),
                val_end : $(".val_end").val(),
            },
            // dataType: 'json',
            success: function(res) {
                // console.log(res);
                $("#table_report_control_Manual").html(res);
                loadingOut(loading);
            }
        });
    }
</script>
