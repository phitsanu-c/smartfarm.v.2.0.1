<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
<div class="page-content">
<?php
    $config = $_POST['data'];
    $account_user = $config["account_user"];
    // print_r($config);
    // exit();
    $s_master = $config["s_master"];
    $config_sn = $config['config_sn'];
    $config_cn = $config['config_cn'];
    $set_maxmin = $config['set_maxmin'];
    $sensor = $config['sensor'];
    // $house_master2 = substr($house_master, 0,5);
    // $numb = intval(substr($s_master['house_master'], 5,10));
    // $dashName = $_POST['dashName'];
    // $controlstatus = $_POST['controlstatus'];
    // $conttrolname = $_POST['conttrolname'];
    // $meter_status = $_POST["meter_status"];
    // print_r( $config_sn );
// echo array_count_values($controlstatus)['0'];

    if($s_master["house_img"] == ""){
        $house_img = $s_master["site_img"];
    }else{
        $house_img = $s_master["house_img"];
    }
    // echo $house_img;
    // echo $uumb;
    // echo $_POST['count_cn'];
    // exit();
?>

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $s_master['site_name'] ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a> </li>
                    <li class="breadcrumb-item" aria-current="page"><?= $s_master['house_name'] ?></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <span class="text-center">
                    <span class="date"></span><br>
                    <span class="time"></span>
                </span>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- <h6 class="mb-0 text-uppercase">Horizontal Card</h6> -->
    <hr/>
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body"> 
                    <div class="card radius-10 shadow-none">
                        <img src="public/images/site/<?= $house_img ?>" alt="..." class="card-img">
                    </div>
                    <div class="card radius-10 shadow-none">
                        <div class="card-body border radius-10 shadow-none mb-3">
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>ที่ตั้ง : <b><?= $s_master["site_address"] ?></b></h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>สถานะโรงเรือน : <b class="status_timeUpdate"></b></h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>ขนาดโรงเรือน : <b><?= substr($s_master["house_size"],9,13) ?></b> เมตร</h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>ระบบอินเตอร์เน็ต : <b>Internet SIM</b></h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>หมายเลขอินเตอร์เน็ต : <b><?= $s_master["site_internet"] ?></b></h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>วันหมดอายุ : <b><?= $s_master["site_internetO"] ?></b></h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                    <div class="d-flex">
                                        <h5>จุดติดตั้งเซ็นเซอร์ : <b class="image-popups">
                                        <?php if($s_master["house_img_map"] != ""){
                                                            echo '<a href="public/images/img_map/'.$s_master["house_img_map"].'"><i class="lni lni-map-marker"></i></a>';
                                                        }else{echo "-";}?>
                                            </b></h5>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 col-xl-8 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body"> 
                    <!-- <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="text-center">สภาพอากาศจากกรมอุตุนิยมวิทยา</h5>
                            <div class="row">
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h6 class="mb-0">อุณหภูมิ</h6><br>
                                    <h6 class="mb-0 font-semibold text-primary weather-temperature"></h6><br>
                                    <h6 class="mb-0 text-primary"> (<span class="weather-min-temperature"></span> - <span class="weather-max-temperature"></span>)</h6><br>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <img src="" class="weather-icon" alt="Weather Icon" style=" width: 30%;" /><br>
                                    <span class="text-primary weather-description capitalize"></span><br><br>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h6 class="mb-0">ความชื้นในอากาศ</h6><br>
                                    <h6 class="mb-0 text-primary weather-humidity"></h6><br>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h6 class="mb-0">ความเร็วลม</h6><br>
                                    <h6 class="mb-0 text-primary weather-wind-speed"></h6>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h6 class="mb-0">พระอาทิตย์ขึ้น</h6><br>
                                    <h6 class="mb-0 text-primary weather-sunrise"></h6>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h6 class="mb-0">พระอาทิตย์ตก</h6><br>
                                    <h6 class="mb-0 text-primary weather-sunset"></h6>
                                </div>
                            </div>
                        </div>
                    </div><br/> -->
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="text-center">ข้อมูลเซ็นเซอร์นอกโรงเรือน</h5>
                            <div class="row text-center">
                                <?php for($i = 1; $i <= 3; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                    <div class="col-lg-4 col-xl-4 col-sm-12">
                                        <div class="card-body border radius-10 shadow-none mb-3">
                                           <div class="d-flex">
                                                <h5 class="card-title mt-2 "><B><?= $config_sn['sn_name_'.$i] ?></B></h5>
                                                <div class="ms-auto mt-2 image-popups">
                                                    <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                        echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker"></i></a>';
                                                    }?>
                                                </div>
                                            </div>
                                            <img src="" alt="..." class="dash_img_<?= $i ?>"  style="width:90px; margin-top:10px; text-align: center!important;">
                                            <h6 class="card-text text-center dash_data__<?= $i ?>" style="margin-top:20px"></h6>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="text-center">ข้อมูลเซ็นเซอร์ในโรงเรือน</h5>
                            <div class="row text-center">
                                <?php for($i = 4; $i <= 7; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                    <div class="col-lg-3 col-xl-3 col-sm-12">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                           <div class="d-flex">
                                                <h5 class="card-title mt-2 "><B><?= $config_sn['sn_name_'.$i] ?></B></h5>
                                                <div class="ms-auto mt-2 image-popups">
                                                    <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                        echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker"></i></a>';
                                                    }?>
                                                </div>
                                            </div>
                                            <img src="" alt="..." class="dash_img_<?= $i ?>"  style="width:90px; margin-top:10px; text-align: center!important;">
                                            <h6 class="card-text text-center dash_data__<?= $i ?>" style="margin-top:20px"></h6>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->
    
    <?php if($_POST["count_cn"] != 0){?>
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center"><b>ระบบควบคุม </b></h4>
                        <!-- <h5 class="card-title text-center"><b>โหมดอัตโนมัติ </b></h5> -->
                        <!-- <div class="row g-2"> -->
                            <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12" > -->
                                <button type="button" class="btn btn-outline-success px-5 radius-30 sw_mode_Auto active" style="font-size:18px">โหมดอัตโนมัติ</button>
                            <!-- </div> -->
                            <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12">
                                <button type="button" class="col-lg-6 col-xl-6 col-sm-12 col-12 btn btn-outline-info px-5 radius-30 sw_mode_Manual" style="font-size:18px">โหมดสั่งงานด้วยตนเอง</button>
                            </div> -->
                        <!-- </div> -->
                    </div>
                    <div class="row">
                        <?php for($i = 1; $i <= 12; $i++){ if(
                            $config_cn['cn_status_'.$i] == 1){ ?>
                            <div class="col-lg-3 col-xl-3 col-sm-12">
                                <div class="card-body border radius-10 shadow-none mb-3">
                                    <div class="d-flex">
                                        <h5 class="mb-0 mmn"><b><?= $config_cn['cn_name_'.$i] ?></b></h5>
                                    </div>
                                    <div class="text-center">
                                        <img class="dash_img_con_<?= $i ?>" width="185">
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Control -->
        <div class="modal fade" id="Modal_Auto_control"  tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-4">
                            <!-- <div><i class="bx bxs-user me-1 font-22 text-info"></i></div> -->
                            <b class="modal_autoText"></b>
                       
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="seve_auto">
                            <form class="row g-3" id="seve_auto" onsubmit="return false">
                                <input type="hidden" class="channel" id="channel">
                                <div class="border p-4 rounded mb-3 time_loop">
                                    <div class="d-flex mb-2">
                                    <B>TIMER Loop</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_7" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select id="time_s_7" class="form-select input_time">
                                                            <option value="">Select</option>
                                                            <option value="06:00">06:00</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                        </select>
                                                        <div class="invalid-feedback">กรุณาระบุเวลาเริ่มต้น</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select id="time_e_7" class="form-select input_time">
                                                            <option value="">Select</option>
                                                            <option value="07:00">07:00</option>
                                                            <option value="08:00">08:00</option>
                                                            <option value="09:00">09:00</option>
                                                            <option value="10:00">10:00</option>
                                                            <option value="11:00">11:00</option>
                                                            <option value="12:00">12:00</option>
                                                            <option value="13:00">13:00</option>
                                                            <option value="14:00">14:00</option>
                                                            <option value="15:00">15:00</option>
                                                            <option value="16:00">16:00</option>
                                                            <option value="17:00">17:00</option>
                                                            <option value="18:00">18:00</option>
                                                        </select>
                                                        <div class="invalid-feedback">กรุณาระบุเวลาสิ้นสุด</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback"> ON </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select id="time_on_7" class="form-select input_time">
                                                            <option value="">Select</option>
                                                            <option value="5">5 min.</option>
                                                            <option value="10">10 min.</option>
                                                            <option value="15">15 min.</option>
                                                            <option value="20">20 min.</option>
                                                            <option value="25">25 min.</option>
                                                            <option value="30">30 min.</option>
                                                        </select>
                                                        <div class="invalid-feedback">กรุณาระบุเวลาทำงาน</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback"> OFF </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select id="time_off_7" class="form-select input_time">
                                                            <option value="">Select</option>
                                                            <option value="5">5 min.</option>
                                                            <option value="10">10 min.</option>
                                                            <option value="15">15 min.</option>
                                                            <option value="20">20 min.</option>
                                                            <option value="25">25 min.</option>
                                                            <option value="30">30 min.</option>
                                                        </select>
                                                        <div class="invalid-feedback">กรุณาระบุเวลาหยุดทำงาน</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="border p-4 rounded">
                                    <div class="d-flex mb-2">
                                        <B>TIMER 1</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_1" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback start_7"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_s_1" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback end_7"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_e_1" class="form-control input_time">
                                                        <select id="time_se_1" class="form-select input_time">
                                                            <option value="0">0 : Close 0%</option>
                                                            <option value="1">1 : Close 25%</option>
                                                            <option value="2">2 : Close 50%</option>
                                                            <option value="3">3 : Close 75%</option>
                                                            <option value="4">4 : Close 100%</option>
                                                        </select>
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="d-flex mb-2">
                                        <B>TIMER 2</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_2" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row m-t-10 ">
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback start_7"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_s_2" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback end_7"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_e_2" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                        <select id="time_se_2" class="form-select input_time">
                                                            <option value="0">0 : Close 0%</option>
                                                            <option value="1">1 : Close 25%</option>
                                                            <option value="2">2 : Close 50%</option>
                                                            <option value="3">3 : Close 75%</option>
                                                            <option value="4">4 : Close 100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="d-flex mb-2">
                                        <B>TIMER 3</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_3" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row m-t-10 ">
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback start_7"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_s_3" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback end_7"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_e_3" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                        <select id="time_se_3" class="form-select input_time">
                                                            <option value="0">0 : Close 0%</option>
                                                            <option value="1">1 : Close 25%</option>
                                                            <option value="2">2 : Close 50%</option>
                                                            <option value="3">3 : Close 75%</option>
                                                            <option value="4">4 : Close 100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="d-flex mb-2">
                                        <B>TIMER 4</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_4" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row m-t-10 ">
                                        <div class="col-6 m-t-0">
                                        <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback start_7"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_s_4" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback end_7"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_e_4" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                        <select id="time_se_4" class="form-select input_time">
                                                            <option value="0">0 : Close 0%</option>
                                                            <option value="1">1 : Close 25%</option>
                                                            <option value="2">2 : Close 50%</option>
                                                            <option value="3">3 : Close 75%</option>
                                                            <option value="4">4 : Close 100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="d-flex mb-2">
                                        <B>TIMER 5</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_5" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row m-t-10 ">
                                        <div class="col-6 m-t-0">
                                        <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback start_7"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_s_5" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback end_7"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_e_5" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                        <select id="time_se_5" class="form-select input_time">
                                                            <option value="0">0 : Close 0%</option>
                                                            <option value="1">1 : Close 25%</option>
                                                            <option value="2">2 : Close 50%</option>
                                                            <option value="3">3 : Close 75%</option>
                                                            <option value="4">4 : Close 100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="d-flex mb-2">
                                        <B>TIMER 6</B>
                                        <div class="sw_toggle ms-auto">
                                            <input class="input_check" type="checkbox" id="sw_6" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                        </div>
                                    </div>
                                    <div class="row m-t-10 ">
                                        <div class="col-6 m-t-0">
                                        <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3 align-vertical-center">
                                                        <small class="form-control-feedback start_7"> START </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_s_6" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 m-t-0">
                                            <div class="form-group text-left">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <small class="form-control-feedback end_7"> END </small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="time" id="time_e_6" class="form-control input_time">
                                                        <div class="invalid-feedback">กรุณาระบุเวลา</div>
                                                        <select id="time_se_6" class="form-select input_time">
                                                            <option value="0">0 : Close 0%</option>
                                                            <option value="1">1 : Close 25%</option>
                                                            <option value="2">2 : Close 50%</option>
                                                            <option value="3">3 : Close 75%</option>
                                                            <option value="4">4 : Close 100%</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </from>
                        </div>
                        <div class="seve_auto_kmutt">
                            <form class="row g-3" id="seve_auto_kmutt">
                                <!-- <div class="tab-pane show active ridge" role="tabpanel"> -->
                                    <div class="row">
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>Soil moisture (%)</h5>
                                                <h6>ON - OFF Dripper 1</h6>
                                                <input type="text" class="range_control range_control1"/>
                                            </div>
                                        </div>
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>Soil moisture (%)</h5>
                                                <h6>ON - OFF Dripper 2</h6>
                                                <input type="text" class="range_control range_control2"/>
                                            </div>
                                        </div>
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>temperature (℃)</h5>
                                                <h6>ON - OFF Foggy inside and Sprinkler outside</h6>
                                                <input type="text" class="range_control range_control3"/>
                                            </div>
                                        </div>
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>Light intensity (KLux)</h5>
                                                <h6>ON - OFF Slan</h6>
                                                <input type="text" class="range_control range_control5" />
                                            </div>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save_auto_cont" class="btn btn-success waves-light">
                            <i class="fadeIn animated bx bx-save"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">
                            <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- exit Modal Control -->
    <?php } ?>
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card w-100 radius-10">
            <div class="card-body">
                <div class="d-flex">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <?php if($_POST["s_btnT"] > 0){echo '
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active btn_ch_t" data-bs-toggle="pill" href="" role="tab" aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">อุณหภูมิ</div>
                                    </div>
                                </a>
                            </li>';
                        }if($_POST["s_btnH"] > 0){
                            if($_POST["s_btnT"] == 0 && $_POST["s_btnH"] > 0){echo '
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active btn_ch_h" data-bs-toggle="pill" href="" role="tab" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">ความชื้นอากาศ</div>
                                        </div>
                                    </a>
                                </li>';
                            }else{echo '
                                <li class="nav-item li_ch_h" role="presentation">
                                    <a class="nav-link btn_ch_h" data-bs-toggle="pill" href="" role="tab" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">ความชื้นอากาศ</div>
                                        </div>
                                    </a>
                                </li>';
                            }
                        } if($_POST["s_btnS"] > 0){
                            if($_POST["s_btnT"] == 0 && $_POST["s_btnH"] == 0 && $_POST["s_btnS"] > 0){echo '
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active btn_ch_s" data-bs-toggle="pill" href="" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">ความชื้นดิน</div>
                                        </div>
                                    </a>
                                </li>';
                            }else{echo '
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link btn_ch_s" data-bs-toggle="pill" href="" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">ความชื้นดิน</div>
                                        </div>
                                    </a>
                                </li>';
                            }
                        }if($_POST["s_btnL"] > 0){
                            if($_POST["s_btnT"] == 0 && $_POST["s_btnH"] == 0 && $_POST["s_btnS"] == 0 && $_POST["s_btnL"] > 0){echo '
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active btn_ch_l" data-bs-toggle="pill" href="" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">ความเข้มแสง</div>
                                        </div>
                                    </a>
                                </li>';
                            }else{echo '
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link btn_ch_l" data-bs-toggle="pill" href="" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">ความเข้มแสง</div>
                                        </div>
                                    </a>
                                </li>';
                            }
                        }if($_POST["meter_count"] > 0){
                            if($_POST["s_btnT"] == 0 && $_POST["s_btnH"] == 0 && $_POST["s_btnS"] == 0 && $_POST["s_btnL"] > 0){echo '
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active btn_ch_p" data-bs-toggle="pill" href="" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">พลังงาน</div>
                                        </div>
                                    </a>
                                </li>';
                            }else{
                                // echo '
                                // <li class="nav-item" role="presentation">
                                //     <a class="nav-link btn_ch_p" data-bs-toggle="pill" href="" role="tab" aria-selected="true">
                                //         <div class="d-flex align-items-center">
                                //             <div class="tab-title">พลังงาน</div>
                                //         </div>
                                //     </a>
                                // </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="chartdiv" id='chart_realtime'></div>
            </dic>
        </dic>
    </dic>
</div>
<script>
    var house_master = '<?= $s_master["house_master"] ?>';
    var login_user = '<?= $account_user ?>';
    var config_sn = $.parseJSON('<?= json_encode($config_sn) ?>');
    var config_cn = $.parseJSON('<?= json_encode($config_cn) ?>');
    var set_maxmin = $.parseJSON('<?= json_encode($set_maxmin) ?>');
    var sensor = $.parseJSON('<?= json_encode($sensor) ?>');
    // console.log(sensor[1].sensor_id)
    
    // ++++++--------+++++++++
    // Global variables
    var client = null;
    // These are configs
    var hostname = "203.150.37.144"; //'103.2.115.15'; // 203.150.37.144   decccloud.com
    var port = "8083";
    var clientId = "mqtt_js_3074" + parseInt(Math.random() * 100000, 10);
    var count = 0;

    function connect() {
        client = new Paho.MQTT.Client(hostname, Number(port), clientId);
        console.info('Connecting to Server: Hostname: ', hostname, '. Port: ', port, '. Client ID: ', clientId);

        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        var options = {
            onSuccess: onConnect, // after connected, subscribes
            onFailure: onFail // useful for logging / debugging
        };
        // connect the client
        client.connect(options);
        console.info('Connecting...');
    }
    // ---------------------------------------------------------------------------------------

    function onConnect(context) {
        console.log("Client Connected");
        // And subscribe to our topics	-- both with the same callback function
        options = {
            qos: 1,
            onSuccess: function(context) {
                // console.log("ไม่สามารถเชื่อมต่อกับ เครื่อง ได้ !!!!");
                // setInterval(function() {
                //     location.reload();
                // }, 30000);
                console.log("subscribed");
            }
        }
        client.subscribe(house_master + "/data_sensor/realtime", options);
        client.subscribe(house_master + "/control/resporn", options);
    }

    function onFail(context) {
        location.reload();
    }

    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("Connection Lost: " + responseObject.errorMessage);
            connect();
            // location.reload();
            // window.alert("Someone else took my websocket!\nRefresh to take it back.");
        }
    }
    // +++++++++------------+++++++++++
    function onMessageArrived(message) {
        if (message.destinationName == house_master + "/data_sensor/realtime") {
            var result = message.payloadString;
            var parseJSON = $.parseJSON(result);
            console.log(parseJSON)
            var chart_timestamp = parseJSON['date_time'];
            var time_t = parseJSON['time'];
            var ntime = time_t.substring(0, 5);
            $(".date").html(parseJSON['date']);
            $(".time").html(ntime);
            var data_ = parseJSON['data']
            console.log(sensor)
            for (var i = 1; i <= 7; i++) {
                // console.log(config_sn['sn_sensor_'+i])
                // 
                if (config_sn['sn_status_'+i] == 1) {
                    // for(var s=0; s <= sensor.length; s++){
                    //     if(s == config_sn['sn_sensor_'+i]){
                            console.log(sensor[(config_sn['sn_sensor_'+i] -1)].sensor_name)
                            if(i == 1){
                                dash_status(sn_data= (data_['temp_out']*1).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }else if(i == 2){
                                dash_status(sn_data= (data_['hum_out']*1).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }else if(i == 3){
                                dash_status(sn_data= (data_['light_out']/1000).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }else if(i == 4){
                                dash_status(sn_data= (data_['temp_in']*1).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }else if(i == 5){
                                dash_status(sn_data= (data_['hum_in']*1).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }else if(i == 6){
                                dash_status(sn_data= (data_['light_in']/1000).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }else if(i == 7){
                                dash_status(sn_data= (data_['soil_in']*1).toFixed(1), max= set_maxmin.Tmax, min= set_maxmin.Tmin)
                            }
                            
                    //     }
                    // }
                    
            //     // show_dash(unit = dashUnit[i],snmode = dashMode[i]);
            //     if (house_master !== "KMUMT001") {
            //         if (dashMode[i] === "7") { // µmol / KLux
            //             $(".dash_data_1_" + i).html((data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>' + '<br>' + (data_array[dashSncanel[i]] / 1000).toFixed(1) + " KLux");
            //         } else if (dashMode[i] === "6") {
            //             $(".dash_data_1_" + i).html((data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>');
            //         } else if (dashMode[i] === "5") {
            //             $(".dash_data_1_" + i).html((data_array[dashSncanel[i]] / 1000).toFixed(1) + " KLux" + '<br>' + (data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>');
            //         } else {
            //             if (data_array[dashSncanel[i]] >= 1000) {
            //                 data_dash[i] = (data_array[dashSncanel[i]] / 1000).toFixed(1);
            //                 sn_unit[i] = 'K' + dashUnit[i];
            //             } else if (data_array[dashSncanel[i]] >= 1000000) {
            //                 data_dash[i] = (data_array[dashSncanel[i]] / 1000).toFixed(1);
            //                 sn_unit[i] = 'M' + dashUnit[i];
            //             } else {
            //                 data_dash[i] = (data_array[dashSncanel[i]] * 1).toFixed(1);
            //                 if (dashUnit[i] === "1") {
            //                     sn_unit[i] = "℃";
            //                 } else {
            //                     sn_unit[i] = dashUnit[i];
            //                 }
            //             }
            //         }
            //         // ++++++++++
            //         if ($(".btn_ch_t").hasClass("active") == true) {
            //             if (dashMode[i] === "1") {
            //                 new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
            //             }
            //         }
            //         if ($(".btn_ch_h").hasClass("active") == true) {
            //             if (dashMode[i] === "2") {
            //                 new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
            //             }
            //         }
            //         if ($(".btn_ch_s").hasClass("active") == true) {
            //             if (dashMode[i] === "3") {
            //                 new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
            //             }
            //         }
            //         if ($(".btn_ch_l").hasClass("active") == true) {
            //             if (dashMode[i] === "4" || dashMode[i] === "5") {
            //                 new_chart.push((data_array[dashSncanel[i]] / 1000).toFixed(1));
            //             }
            //             if (dashMode[i] === "6" || dashMode[i] === "7") {
            //                 new_chart.push((data_array[dashSncanel[i]] / 54).toFixed(1));
            //             }
            //         }
            //         if ($(".btn_ch_p").hasClass("active") == true) {
            //             if (dashMode[i] === "10") {
            //                 new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
            //             }
            //         }
                }
                function dash_status(sn_data, max, min){
                    if(sn_data >= max){
                        $(".dash_img_" + i).attr("src", "public/images/Sensor/"+sensor[(config_sn['sn_sensor_'+i] -1)].sensor_imgMax);
                    }else if(sn_data < min){
                        $(".dash_img_" + i).attr("src", "public/images/Sensor/"+sensor[(config_sn['sn_sensor_'+i] -1)].sensor_imgMin);
                    }else{
                        $(".dash_img_" + i).attr("src", "public/images/Sensor/"+sensor[(config_sn['sn_sensor_'+i] -1)].sensor_imgNor);
                    }
                    if(sensor[(config_sn['sn_sensor_'+i] -1)].sensor_unit == 1){
                        $(".dash_data__" + i).html(sn_data + " ℃");
                    }else{
                        $(".dash_data__" + i).html(sn_data + " "+sensor[(config_sn['sn_sensor_'+i] -1)].sensor_unit);
                    }
                }
            }

        }
    }// exit_message
    connect();

    // ++++++++++++++++++
    $('.sw_mode_Auto').click(function() { // console.log($(this).attr("id"));
        // alert($(this).attr("id"))
        // if ($(this).hasClass("active") === false) {
            // if (house_master !== "KMUMT001") {
            //     switch_mode(sw_name = "Auto", mess = "Auto", mqtt_name = "user_control");
            // } else {
            //     switch_mode(sw_name = "Auto", mess = "on", mqtt_name = "control_user");
            // }
        // }
        mqtt_send(msg_dn=house_master + "/control/status/mode", msg="Auto")
    });
    $('.sw_mode_Manual').click(function() { // console.log($(this).attr("id"));
        // if ($(this).hasClass("active") === false) {
        //     if (house_master !== "KMUMT001") {
        //         switch_mode(sw_name = "Manual", mess = "Manual", mqtt_name_us = "user_control");
        //     } else {
        //         switch_mode(sw_name = "Manual", mess = "off", mqtt_name_us = "control_user");
        //     }
        // }
        mqtt_send(msg_dn=house_master + "/control/status/mode", msg="Manual")
    });

    function switch_mode(sw_name, mess, mqtt_name_us) {
        swal({
            title: 'เปลี่ยนโหมดการทำงาน !',
            text: "คุณต้องการเปลี่ยนเป็นไปใช้โหมด" + sw_name + " ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#32CD32',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                // console.log(login_user);
                message = new Paho.MQTT.Message(login_user);
                message.destinationName = house_master + "/control/status/" + mqtt_name_us;
                message.retained = true;
                message.qos = 1;
                client.send(message);

                message = new Paho.MQTT.Message(mess);
                message.destinationName = house_master + "/control/status/mode";
                message.retained = true;
                message.qos = 1;
                client.send(message);

                // swal({
                //     text: "Loading ... ",
                //     allowOutsideClick: false,
                //     onOpen: () => {
                //         swal.showLoading()
                //         timerInterval = setInterval(() => {}, 100)
                //     }
                // });
            }
        });
    }
    // $('.sw_manual_1').attr('checked')
    // alert($(".sw_manual_1").is(":checked"))
    
    $(".Dsw_manual_1").click(function() {
        setTimeout(function(){
            // alert($(".sw_manual_1").prop('checked'));
            if (house_master !== "KMUMT001") {
                switch_control(sta = $(".sw_manual_1").prop('checked'), sw_name = "sw_manual_1", ch_name='<?= $config_cn['cn_name_1'] ?>', mqtt_ch_name = "dripper_1", mqtt_name_us = "user_control" );
            }else{
                switch_control(sta = $(".sw_manual_1").prop('checked'), sw_name = "sw_manual_1", ch_name='<?= $config_cn['cn_name_1'] ?>', mqtt_ch_name = "control_st_1", mqtt_name_us = "control_user" );
            }
        }, 100);
    });
    
    function switch_control(sta, sw_name, ch_name, mqtt_ch_name, mqtt_name_us) {
        if (house_master !== "KMUMT001") {
            if(sta === false){var sw_sta = "ปิด"; var mess = "OFF";}else{var sw_sta = "เปิด";var mess = "ON";}
        }else{
            if(sta === false){var sw_sta = "ปิด"; var mess = "off";}else{var sw_sta = "เปิด";var mess = "on";}
        }
        swal({
            title: 'คุณต้องการ ' + sw_sta + ' ' + ch_name + ' ?',
            // text: "คุณต้องการเปลี่ยนไปใช้โหมด Manual !!!",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#32CD32',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                // alert(sta)
                // return false;
                message = new Paho.MQTT.Message(login_user);
                message.destinationName = house_master + "/1/control/" + mqtt_name_us;
                message.qos = 1;
                message.retained = true;
                client.send(message);

                message = new Paho.MQTT.Message(mess);
                message.destinationName = house_master + "/1/control/" + mqtt_ch_name;
                message.qos = 1;
                message.retained = true;
                client.send(message);
                // console.log(message.qos);
            }else{
                $('.'+sw_name).bootstrapToggle("toggle");
            }
        });
    }
    function switch_control_slan(sta, ch_name, mess, mqtt_ch_name, mqtt_name_us) {
        swal({
            title: 'คุณต้องการ ' + sta + ' ' + ch_name + ' ?',
            // text: "คุณต้องการเปลี่ยนไปใช้โหมด Manual !!!",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#32CD32',
            cancelButtonColor: '#FF3333',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            console.log(result)
            if (result.value) {
                // alert(sta)
                // return false;
                message = new Paho.MQTT.Message(login_user);
                message.destinationName = house_master + "/1/control/" + mqtt_name_us;
                message.qos = 1;
                message.retained = true;
                client.send(message);

                message = new Paho.MQTT.Message(mess);
                message.destinationName = house_master + "/1/control/" + mqtt_ch_name;
                message.qos = 1;
                message.retained = true;
                client.send(message);
                // console.log(message.qos);
            }else{
                // $('.'+sw_name).bootstrapToggle("toggle");
            }
        });
    }
    // ------- Switch control --------------
    $("#save_auto_cont").click(function(){
        if (house_master !== "KMUMT001") {
            var channel = $(".channel").val();
            // alert(channel)
            if(channel == 9){
                if($("#sw_7").prop('checked') == true){
                    if($("#time_s_7").val() === ""){
                        $('#time_s_7').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_7').removeClass('is-invalid')
                    }
                    if($("#time_e_7").val() === ""){
                        $('#time_e_7').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_7').removeClass('is-invalid')
                    }
                    if($("#time_s_7").val() >= $("#time_e_7").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER LOOP : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_7').addClass('is-invalid')
                        $('#time_e_7').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_7').removeClass('is-invalid')
                        $('#time_e_7').removeClass('is-invalid')
                    }
                    if($("#time_on_7").val() === ""){
                        $('#time_on_7').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_on_7').removeClass('is-invalid')
                    }
                    if($("#time_off_7").val() === ""){
                        $('#time_off_7').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_off_7').removeClass('is-invalid')
                    }
                }else{
                    if($("#sw_1").prop('checked') == true){
                        if($("#time_s_1").val() === ""){
                            $('#time_s_1').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_1').removeClass('is-invalid')
                        }
                        if($("#time_e_1").val() === ""){
                            $('#time_e_1').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_e_1').removeClass('is-invalid')
                        }
                        if($("#time_s_1").val() >= $("#time_e_1").val()){
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER 1 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_1').addClass('is-invalid')
                            $('#time_e_1').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_1').removeClass('is-invalid')
                            $('#time_e_1').removeClass('is-invalid')
                        }
                    }
                    if($("#sw_2").prop('checked') == true){
                        if($("#time_s_2").val() === ""){
                            $('#time_s_2').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_2').removeClass('is-invalid')
                        }
                        if($("#time_e_2").val() === ""){
                            $('#time_e_2').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_e_2').removeClass('is-invalid')
                        }
                        if($("#time_s_2").val() >= $("#time_e_2").val()){
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER 2 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_2').addClass('is-invalid')
                            $('#time_e_2').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_2').removeClass('is-invalid')
                            $('#time_e_2').removeClass('is-invalid')
                        }
                    }
                    if($("#sw_3").prop('checked') == true){
                        if($("#time_s_3").val() === ""){
                            $('#time_s_3').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_3').removeClass('is-invalid')
                        }
                        if($("#time_e_3").val() === ""){
                            $('#time_e_3').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_e_3').removeClass('is-invalid')
                        }
                        if($("#time_s_3").val() >= $("#time_e_3").val()){
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER 3 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_3').addClass('is-invalid')
                            $('#time_e_3').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_3').removeClass('is-invalid')
                            $('#time_e_3').removeClass('is-invalid')
                        }
                    }
                    if($("#sw_4").prop('checked') == true){
                        if($("#time_s_4").val() === ""){
                            $('#time_s_4').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_4').removeClass('is-invalid')
                        }
                        if($("#time_e_4").val() === ""){
                            $('#time_e_4').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_e_4').removeClass('is-invalid')
                        }
                        if($("#time_s_4").val() >= $("#time_e_4").val()){
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER 4 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_4').addClass('is-invalid')
                            $('#time_e_4').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_4').removeClass('is-invalid')
                            $('#time_e_4').removeClass('is-invalid')
                        }
                    }
                    if($("#sw_5").prop('checked') == true){
                        if($("#time_s_5").val() === ""){
                            $('#time_s_5').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_5').removeClass('is-invalid')
                        }
                        if($("#time_e_5").val() === ""){
                            $('#time_e_5').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_e_5').removeClass('is-invalid')
                        }
                        if($("#time_s_5").val() >= $("#time_e_5").val()){
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER 5 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_5').addClass('is-invalid')
                            $('#time_e_5').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_5').removeClass('is-invalid')
                            $('#time_e_5').removeClass('is-invalid')
                        }
                    }
                    if($("#sw_6").prop('checked') == true){
                        if($("#time_s_6").val() === ""){
                            $('#time_s_6').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_6').removeClass('is-invalid')
                        }
                        if($("#time_e_6").val() === ""){
                            $('#time_e_6').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_e_6').removeClass('is-invalid')
                        }
                        if($("#time_s_6").val() >= $("#time_e_6").val()){
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER 6 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_6').addClass('is-invalid')
                            $('#time_e_6').addClass('is-invalid')
                            return false;
                        }else{
                            $('#time_s_6').removeClass('is-invalid')
                            $('#time_e_6').removeClass('is-invalid')
                        }
                    }
                }
            }else if(channel == 11){
                var minsToAdd = 15;
                var newTime_d2 = new Date(new Date("1970/01/01 " + $("#time_s_1").val()).getTime() + minsToAdd * 60000).toLocaleTimeString('en-UK', { hour: '2-digit', minute: '2-digit', hour12: false });
                var newTime_d3 = new Date(new Date("1970/01/01 " + $("#time_s_2").val()).getTime() + minsToAdd * 60000).toLocaleTimeString('en-UK', { hour: '2-digit', minute: '2-digit', hour12: false });
                var newTime_d4 = new Date(new Date("1970/01/01 " + $("#time_s_3").val()).getTime() + minsToAdd * 60000).toLocaleTimeString('en-UK', { hour: '2-digit', minute: '2-digit', hour12: false });
                var newTime_d5 = new Date(new Date("1970/01/01 " + $("#time_s_4").val()).getTime() + minsToAdd * 60000).toLocaleTimeString('en-UK', { hour: '2-digit', minute: '2-digit', hour12: false });
                var newTime_d6 = new Date(new Date("1970/01/01 " + $("#time_s_5").val()).getTime() + minsToAdd * 60000).toLocaleTimeString('en-UK', { hour: '2-digit', minute: '2-digit', hour12: false });
                
                    // ----------
                if($("#sw_1").prop('checked') == true){
                    if($("#time_s_1").val() === ""){
                        $('#time_s_1').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_1').removeClass('is-invalid')
                    }
                }
                if($("#sw_2").prop('checked') == true){
                    if($("#time_s_2").val() === ""){
                        $('#time_s_2').addClass('is-invalid')
                        return false;
                    }else if($("#time_s_2").val() <= newTime_d2){
                        swal_c(type = 'error', title = 'Error...', text = '<b>TIMMER 2 : TIME </b> ต้องมากกว่า <b>' + newTime_d2 + '</b> !');
                        $("#time_s_2").addClass("is-invalid");
                        return false;
                    }else{
                        $('#time_s_2').removeClass('is-invalid')
                    }
                    if($("#time_se_1").val() == $("#time_se_2").val()){
                        swal_c(type = 'error', title = 'Error...', text = '<b> LEVEL : TIMMER 2 </b> ต้องไม่เท่ากับ <b> LEVEL : TIMMER 1 </b> !');
                        $("#time_se_2").addClass("is-invalid");
                        return false;
                    }else{
                        $("#time_se_2").removeClass("is-invalid");
                    }
                }
                if($("#sw_3").prop('checked') == true){
                    if($("#time_s_3").val() === ""){
                        $('#time_s_3').addClass('is-invalid')
                        return false;
                    }else if($("#time_s_3").val() <= newTime_d3){
                        swal_c(type = 'error', title = 'Error...', text = '<b>TIMMER 3 : TIME </b> เวลาต้องมากกว่า <b>' + newTime_d3 + '</b> !');
                        $("#time_s_3").addClass("is-invalid");
                        return false;
                    }else{
                        $('#time_s_3').removeClass('is-invalid')
                    }
                    if($("#time_se_2").val() == $("#time_se_3").val()){
                        swal_c(type = 'error', title = 'Error...', text = '<b> LEVEL : TIMMER 3 </b> ต้องไม่เท่ากับ <b> LEVEL : TIMMER 2 </b> !');
                        $("#time_se_3").addClass("is-invalid");
                        return false;
                    }else{
                        $("#time_se_3").removeClass("is-invalid");
                    }
                }
                if($("#sw_4").prop('checked') == true){
                    if($("#time_s_4").val() === ""){
                        $('#time_s_4').addClass('is-invalid')
                        return false;
                    }else if($("#time_s_4").val() <= newTime_d4){
                        swal_c(type = 'error', title = 'Error...', text = '<b>TIMMER 4 : TIME </b> เวลาต้องมากกว่า <b>' + newTime_d4 + '</b> !');
                        $("#time_s_4").addClass("is-invalid");
                        return false;
                    }else{
                        $('#time_s_4').removeClass('is-invalid')
                    }
                    if($("#time_se_3").val() == $("#time_se_4").val()){
                        swal_c(type = 'error', title = 'Error...', text = '<b> LEVEL : TIMMER 4 </b> ต้องไม่เท่ากับ <b> LEVEL : TIMMER 3 </b> !');
                        $("#time_se_4").addClass("is-invalid");
                        return false;
                    }else{
                        $("#time_se_4").removeClass("is-invalid");
                    }
                }
                if($("#sw_5").prop('checked') == true){
                    if($("#time_s_5").val() === ""){
                        $('#time_s_5').addClass('is-invalid')
                        return false;
                    }else if($("#time_s_5").val() <= newTime_d5){
                        swal_c(type = 'error', title = 'Error...', text = '<b>TIMMER 5 : TIME </b> เวลาต้องมากกว่า <b>' + newTime_d5 + '</b> !');
                        $("#time_s_5").addClass("is-invalid");
                        return false;
                    }else{
                        $('#time_s_5').removeClass('is-invalid')
                    }
                    if($("#time_se_4").val() == $("#time_se_5").val()){
                        swal_c(type = 'error', title = 'Error...', text = '<b> LEVEL : TIMMER 5 </b> ต้องไม่เท่ากับ <b> LEVEL : TIMMER 4 </b> !');
                        $("#time_se_5").addClass("is-invalid");
                        return false;
                    }else{
                        $("#time_se_5").removeClass("is-invalid");
                    }
                }
                if($("#sw_6").prop('checked') == true){
                    if($("#time_s_6").val() === ""){
                        $('#time_s_6').addClass('is-invalid')
                        return false;
                    }else if($("#time_s_6").val() <= newTime_d6){
                        swal_c(type = 'error', title = 'Error...', text = '<b>TIMMER 6 : TIME </b> เวลาต้องมากกว่า <b>' + newTime_d6 + '</b> !');
                        $("#time_s_6").addClass("is-invalid");
                        return false;
                    }else{
                        $('#time_s_6').removeClass('is-invalid')
                    }
                    if($("#time_se_5").val() == $("#time_se_6").val()){
                        swal_c(type = 'error', title = 'Error...', text = '<b> LEVEL : TIMMER 6 </b> ต้องไม่เท่ากับ <b> LEVEL : TIMMER 5 </b> !');
                        $("#time_se_6").addClass("is-invalid");
                        return false;
                    }else{
                        $("#time_se_6").removeClass("is-invalid");
                    }
                }
            }else{
                if($("#sw_1").prop('checked') == true){
                    if($("#time_s_1").val() === ""){
                        $('#time_s_1').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_1').removeClass('is-invalid')
                    }
                    if($("#time_e_1").val() === ""){
                        $('#time_e_1').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_1').removeClass('is-invalid')
                    }
                    if($("#time_s_1").val() >= $("#time_e_1").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER 1 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_1').addClass('is-invalid')
                        $('#time_e_1').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_1').removeClass('is-invalid')
                        $('#time_e_1').removeClass('is-invalid')
                    }
                }
                if($("#sw_2").prop('checked') == true){
                    if($("#time_s_2").val() === ""){
                        $('#time_s_2').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_2').removeClass('is-invalid')
                    }
                    if($("#time_e_2").val() === ""){
                        $('#time_e_2').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_2').removeClass('is-invalid')
                    }
                    if($("#time_s_2").val() >= $("#time_e_2").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER 2 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_2').addClass('is-invalid')
                        $('#time_e_2').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_2').removeClass('is-invalid')
                        $('#time_e_2').removeClass('is-invalid')
                    }
                }
                if($("#sw_3").prop('checked') == true){
                    if($("#time_s_3").val() === ""){
                        $('#time_s_3').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_3').removeClass('is-invalid')
                    }
                    if($("#time_e_3").val() === ""){
                        $('#time_e_3').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_3').removeClass('is-invalid')
                    }
                    if($("#time_s_3").val() >= $("#time_e_3").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER 3 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_3').addClass('is-invalid')
                        $('#time_e_3').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_3').removeClass('is-invalid')
                        $('#time_e_3').removeClass('is-invalid')
                    }
                }
                if($("#sw_4").prop('checked') == true){
                    if($("#time_s_4").val() === ""){
                        $('#time_s_4').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_4').removeClass('is-invalid')
                    }
                    if($("#time_e_4").val() === ""){
                        $('#time_e_4').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_4').removeClass('is-invalid')
                    }
                    if($("#time_s_4").val() >= $("#time_e_4").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER 4 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_4').addClass('is-invalid')
                        $('#time_e_4').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_4').removeClass('is-invalid')
                        $('#time_e_4').removeClass('is-invalid')
                    }
                }
                if($("#sw_5").prop('checked') == true){
                    if($("#time_s_5").val() === ""){
                        $('#time_s_5').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_5').removeClass('is-invalid')
                    }
                    if($("#time_e_5").val() === ""){
                        $('#time_e_5').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_5').removeClass('is-invalid')
                    }
                    if($("#time_s_5").val() >= $("#time_e_5").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER 5 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_5').addClass('is-invalid')
                        $('#time_e_5').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_5').removeClass('is-invalid')
                        $('#time_e_5').removeClass('is-invalid')
                    }
                }
                if($("#sw_6").prop('checked') == true){
                    if($("#time_s_6").val() === ""){
                        $('#time_s_6').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_6').removeClass('is-invalid')
                    }
                    if($("#time_e_6").val() === ""){
                        $('#time_e_6').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_e_6').removeClass('is-invalid')
                    }
                    if($("#time_s_6").val() >= $("#time_e_6").val()){
                        swal_c(type = 'error', title = 'Error...', text = 'TIMMER 6 : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                        $('#time_s_6').addClass('is-invalid')
                        $('#time_e_6').addClass('is-invalid')
                        return false;
                    }else{
                        $('#time_s_6').removeClass('is-invalid')
                        $('#time_e_6').removeClass('is-invalid')
                    }
                }
            }
            function swal_c(type, title, text) {
                Swal({
                    type: type,
                    title: title,
                    html: text,
                    allowOutsideClick: false
                });
            }
            swal({
                title: 'บันทึกการเปลี่ยนแปลง',
                text: "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                type: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#32CD32',
                cancelButtonColor: '#FF3333',
                confirmButtonText: 'ไช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.value) {
                    if ($("#sw_1").prop('checked') == true) { var sw_1 = 1; } else { var sw_1 = 0; }
                    if ($("#sw_2").prop('checked') == true) { var sw_2 = 1; } else { var sw_2 = 0; }
                    if ($("#sw_3").prop('checked') == true) { var sw_3 = 1; } else { var sw_3 = 0; }
                    if ($("#sw_4").prop('checked') == true) { var sw_4 = 1; } else { var sw_4 = 0; }
                    if ($("#sw_5").prop('checked') == true) { var sw_5 = 1; } else { var sw_5 = 0; }
                    if ($("#sw_6").prop('checked') == true) { var sw_6 = 1; } else { var sw_6 = 0; }
                    if ($("#sw_7").prop('checked') == true) { var sw_7 = 1; } else { var sw_7 = 0; }
                    if (message.destinationName == house_master + "/1/control/time_control") {
                        var result = message.payloadString;
                        var parseJSON = $.parseJSON(result);
                        // console.log(parseJSON);
                        // return false;
                        $.ajax({
                            type: "POST",
                            url: "routes/save_autoControl.php",
                            data: {
                                house_master: house_master,
                                channel     : $("#channel").val(),
                                sw_1 : sw_1,
                                sw_2 : sw_2,
                                sw_3 : sw_3,
                                sw_4 : sw_4,
                                sw_5 : sw_5,
                                sw_6 : sw_6,
                                sw_7 : sw_7,
                                s_1 : $("#time_s_1").val(),
                                s_2 : $("#time_s_2").val(),
                                s_3 : $("#time_s_3").val(),
                                s_4 : $("#time_s_4").val(),
                                s_5 : $("#time_s_5").val(),
                                s_6 : $("#time_s_6").val(),
                                s_7 : $("#time_s_7").val(),
                                e_1 : $("#time_e_1").val(),
                                e_2 : $("#time_e_2").val(),
                                e_3 : $("#time_e_3").val(),
                                e_4 : $("#time_e_4").val(),
                                e_5 : $("#time_e_5").val(),
                                e_6 : $("#time_e_6").val(),
                                e_7 : $("#time_e_7").val(),
                                on_7 : $("#time_on_7").val(),
                                off_7 : $("#time_off_7").val(),
                                se_1 : $("#time_se_1").val(),
                                se_2 : $("#time_se_2").val(),
                                se_3 : $("#time_se_3").val(),
                                se_4 : $("#time_se_4").val(),
                                se_5 : $("#time_se_5").val(),
                                se_6 : $("#time_se_6").val()
                            },
                            dataType: 'json',
                            success: function(res) {
                                // console.log(res.data)
                                if(res.status === "Insert_Success"){
                                    $("#Modal_Auto_control").modal("hide");
                                    $.extend(parseJSON, res.data);
                                    var json_msg = JSON.stringify(parseJSON);
                                    // console.log(parseJSON)
                                    message = new Paho.MQTT.Message(json_msg);
                                    message.destinationName = house_master + "/1/control/time_control";
                                    message.qos = 1;
                                    message.retained = true;
                                    client.send(message);
                                
                                    swal({
                                        title: 'บันทึกข้อมูลสำเร็จ',
                                        type: 'success',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#32CD32'
                                    });
                                }else{
                                    swal({
                                        title: 'Error !',
                                        text: "เกิดข้อผิดพลาด ?",
                                        type: 'error',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#32CD32'
                                    }).then((result) => {
                                        if (result.value) {
                                            location.reload();
                                            return false;
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }else{ // =KMUMT001
            var Rmx1 = $(".range_control1").val().split(";");
            var Rmx2 = $(".range_control2").val().split(";");
            var Rmx3 = $(".range_control3").val().split(";");
            var Rmx5 = $(".range_control5").val().split(";");
            if(Rmx1[0] == Rmx1[1]){
                swal_c(type = 'error', title = 'Error...', text = 'Soil moisture 1 : <b>ความชื้นเริ่มต้นต้องน้อยกว่าความชื้นสิ้นสุด</b> !');
                return false;
            }
            if(Rmx2[0] == Rmx2[1]){
                swal_c(type = 'error', title = 'Error...', text = 'Soil moisture 2 : <b>ความชื้นเริ่มต้นต้องน้อยกว่าความชื้นสิ้นสุด</b> !');
                return false;
            }
            if(Rmx3[0] == Rmx3[1]){
                swal_c(type = 'error', title = 'Error...', text = 'Temperature : <b>อุณหภูมิเริ่มต้นต้องน้อยกว่าอุณหภูมิสิ้นสุด</b> !');
                return false;
            }if(Rmx5[0] == Rmx5[1]){
                swal_c(type = 'error', title = 'Error...', text = 'Light intensity  : <b>ความเข้มแสงเริ่มต้นต้องน้อยกว่าความเข้มแสงสิ้นสุด</b> !');
                return false;
            }
            function swal_c(type, title, text) {
                Swal({
                    type: type,
                    title: title,
                    html: text,
                    allowOutsideClick: false
                });
            }
            swal({
                title: 'บันทึกการเปลี่ยนแปลง',
                text: "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                type: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#32CD32',
                cancelButtonColor: '#FF3333',
                confirmButtonText: 'ไช่',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "routes/save_autoControl.php",
                        method: "post",
                        data: {
                            house_master: house_master,
                            A1: $(".range_control1").val(),
                            A2: $(".range_control2").val(),
                            A3: $(".range_control3").val(),
                            A5: $(".range_control5").val()
                        },
                        dataType: "json",
                        success: function(res) {
                            $("#Modal_Auto_control").modal("hide");
                            console.log(res);
                            if (res === "Success") {
                                message = new Paho.MQTT.Message(Rmx1[0]);
                                message.destinationName = house_master + "/1/data_config/data_config_sprinnker_base_down";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx1[1]);
                                message.destinationName = house_master + "/1/data_config/data_config_sprinnker_base_up";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx2[0]);
                                message.destinationName = house_master + "/1/data_config/data_config_sprinnker_down";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx2[1]);
                                message.destinationName = house_master + "/1/data_config/data_config_sprinnker_up";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx3[0]);
                                message.destinationName = house_master + "/1/data_config/data_config_foggy_down";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx3[1]);
                                message.destinationName = house_master + "/1/data_config/data_config_foggy_up";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx3[0]);
                                message.destinationName = house_master + "/1/data_config/data_config_sprinnker_top_down";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx3[1]);
                                message.destinationName = house_master + "/1/data_config/data_config_sprinnker_top_up";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx5[0]);
                                message.destinationName = house_master + "/1/data_config/data_config_slan_down";
                                message.retained = true;
                                client.send(message);

                                message = new Paho.MQTT.Message(Rmx5[1]);
                                message.destinationName = house_master + "/1/data_config/data_config_slan_up";
                                message.retained = true;
                                client.send(message);

                            swal({
                                    title: 'บันทึกข้อมูลสำเร็จ',
                                    type: 'success',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#32CD32'
                                });
                            }else{
                                swal({
                                    title: 'Error !',
                                    text: "เกิดข้อผิดพลาด ?",
                                    type: 'error',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#32CD32'
                                }).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                        return false;
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }
    }); // exit_save_Auto
    
    // ++++++++++++++++++
    function mqtt_send(msg_dn, msg){
        // Create a client instance
        client = new Paho.MQTT.Client(hostname, Number(port), "mqtt_js_324" + parseInt(Math.random() * 100000, 10));

        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        // connect the client
        client.connect({onSuccess:onConnect});

        // called when the client connects
        function onConnect() {
            // Once a connection has been made, make a subscription and send a message.
            console.log("onConnect");
            client.subscribe(house_master + "/control/status/mode");
            message = new Paho.MQTT.Message(msg);
            message.destinationName = msg_dn;
            client.send(message);
        }

        // called when the client loses its connection
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("onConnectionLost:"+responseObject.errorMessage);
            }
        }

        // called when a message arrives
        // function onMessageArrived(message) {
        //     // console.log("onMessageArrived:"+message.payloadString);
        //     if (message.destinationName == house_master + "/control/status/mode") {
        //         var result = message.payloadString;
        //         console.log(result)
        //     }
        // }
    }
</script>