<?php
    $config = $_POST['data'];
    $account_user = $config["account_user"];
    $s_sensor = $_POST['s_sensor'];
    // echo json_encode($config);
    // exit();
    $s_master = $config["s_master"];
    $control_V = $s_master["house_control_V"];
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
    <div class="page-breadcrumb d-flex align-items-center mb-1">
        <div class="breadcrumb-title pe-3 d-none d-sm-block">
            <h5><?php if($s_master["site_id"] == 10){echo '<img src="public/images/logo/768px-Emblem_of_Thammasat_University.png" style="height: 38px; border: 0 solid #e5e5e5; padding: 0;">';}?>
                <?= $s_master['site_name'] ?>
            </h5>
        </div>
        <div class="ps-3 d-none d-sm-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a> </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <h5>
                            <?= $s_master['house_name'] ?>
                        </h5>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <span class="text-right">
                    <h5 class="date"></h5>
                    <!-- <span class="time"></span> -->
                </span>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr />
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 col-12 d-flex">
            <div class="card radius-10">
                <div class="card-body row">
                    <div class="card col-md-12 col-sm-6 radius-10 shadow-none " style="flex-direction:row">
                        <?php if($s_master["house_img"] == ''){echo '<img src="public/images/site/'. $house_img .'" alt="..." class="card-img ">';}
                        else {echo '<img src="public/images/house/'. $s_master["house_img"] .'" alt="..." class="card-img ">';} ?>
                    </div>
                    <div class="card col-md-12 col-sm-6 radius-10 shadow-none">
                        <div class="card-body border radius-10 shadow-none mb-3">
                            <div class="d-flex">
                                <span class="text-responsive2">สถานที่ : <b> <?= $s_master["site_name"] ?> </b></span>
                            </div>
                            <div class="d-flex">
                                <span class="text-responsive2">โรงเรือน : <b> <?= $s_master["house_name"] ?> </b></span>
                            </div>
                            <div class="d-flex">
                                <span class="text-responsive2">ที่ตั้ง : <b> <?= $s_master["site_address"] ?> </b></span>
                            </div>
                            <div class="d-flex">
                                <span class="text-responsive2">สถานะโรงเรือน : <b class="status_timeUpdate"></b></span>
                            </div>
                            <div class="d-flex">
                                <span class="text-responsive2">ขนาดโรงเรือน : <b><?= substr($s_master["house_size"],9,13) ?></b> เมตร</span>
                            </div>
                            <?php if($config['userLevel'] < 3){?>
                                <div class="d-flex">
                                    <span class="text-responsive2">ระบบอินเตอร์เน็ต : <b>Internet SIM</b></span>
                                </div>
                                <div class="d-flex">
                                    <span class="text-responsive2">หมายเลขอินเตอร์เน็ต : <b><?php if($s_master["site_internet"] != ''){echo $s_master["site_internet"];}else {echo $s_master['house_internet']; } ?></b></span>
                                </div>
                                <div class="d-flex">
                                    <span class="text-responsive2">วันหมดอายุ : <b><?php if($s_master["site_internetO"] != ''){echo $s_master["site_internetO"];}else {echo $s_master['house_internetO']; } ?></b></span>
                                </div>
                            <?php } ?>
                            <!-- <div class="col-12">
                                <div class="d-flex">
                                    <h5>จุดติดตั้งเซ็นเซอร์ : <b class="image-popups"> -->
                            <?php
                                            // if($s_master["house_img_map"] != ""){
                                            //     echo '<a href="public/images/img_map/'.$s_master["house_img_map"].'"><i class="lni lni-map-marker"></i></a>';
                                            // }else{echo "-";}
                                        ?>
                                <!-- </b></h5>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-9 col-sm-12 col-12 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body">
                    <!-- <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="text-center">สภาพอากาศจากกรมอุตุนิยมวิทยา</h5>
                            <div class="row">
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h5 class="mb-0">อุณหภูมิ</h5><br>
                                    <h5 class="mb-0 font-semibold text-primary weather-temperature"></h5><br>
                                    <h5 class="mb-0 text-primary"> (<span class="weather-min-temperature"></span> - <span class="weather-max-temperature"></span>)</h5><br>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <img src="" class="weather-icon" alt="Weather Icon" style=" width: 30%;" /><br>
                                    <span class="text-primary weather-description capitalize"></span><br><br>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h5 class="mb-0">ความชื้นในอากาศ</h5><br>
                                    <h5 class="mb-0 text-primary weather-humidity"></h5><br>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h5 class="mb-0">ความเร็วลม</h5><br>
                                    <h5 class="mb-0 text-primary weather-wind-speed"></h5>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h5 class="mb-0">พระอาทิตย์ขึ้น</h5><br>
                                    <h5 class="mb-0 text-primary weather-sunrise"></h5>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-6 text-center">
                                    <h5 class="mb-0">พระอาทิตย์ตก</h5><br>
                                    <h5 class="mb-0 text-primary weather-sunset"></h5>
                                </div>
                            </div>
                        </div>
                    </div><br/> -->
                    <?php if($config_sn['sn_status_1'] == 1 || $config_sn['sn_status_2'] == 1 || $config_sn['sn_status_3'] == 1){?>
                        <div class="card radius-10 border shadow-none">
                            <div class="card-body">
                                <h5 class="card-title text-center"><b>ข้อมูลเซนเซอร์นอกโรงเรือน</b></h5>
                                <div class="row text-center">
                                    <?php for($i = 1; $i <= 3; $i++){
                                            if($config_sn['sn_status_'.$i] == 1){ ?>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="card-body border radius-10 shadow-none mb-3">
                                            <div class="col">
                                                <b class="text-nameSN"> <?php if($i == 1){echo "อุณหภูมิ";}elseif($i == 2){ echo "ความชื้น"; }elseif($i == 3){ echo "ความเข้มแสง"; } ?> </b>
                                                <div class="ms-auto mt-2 image-popups">
                                                    <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                        echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker "></i></a>';
                                                    }?>
                                                </div>
                                            </div>
                                            <img src="" alt="..." class="dash_img_<?= $i ?> img-resSN">
                                            <?php if($control_V == 2){ ?>
                                                <h5 class="text-data dash_data__l_<?= $i ?>">
                                                <h5 class="text-data dash_data__<?= $i ?>">
                                            <?php }else { ?>
                                                <h5 class="text-data dash_data__<?= $i ?>">
                                            <?php } ?>

                                            </h5>
                                        </div>
                                    </div>
                                    <?php }
                                        } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="card-title text-center"><b>ข้อมูลเซนเซอร์ในโรงเรือน</b></h5>
                            <div class="row text-center">
                                <?php for($i = 4; $i <= 7; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="col">
                                            <B class="text-nameSN"> <?php if($i == 4){echo "อุณหภูมิ";}elseif($i == 5){ echo "ความชื้น"; }elseif($i == 6){ echo "ความเข้มแสง"; }elseif($i == 7){ echo "ความชื้นดิน"; } ?> </B>
                                            <div class="ms-auto mt-2 image-popups">
                                                <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                        echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker"></i></a>';
                                                    }?>
                                            </div>
                                        </div>
                                        <img src="" alt="..." class="dash_img_<?= $i ?> img-resSN">
                                        <?php if($control_V == 2){ ?>
                                            <p class="text-data dash_data__l_<?= $i ?>"></p>
                                            <p class="text-data dash_data__<?= $i ?>"></p>
                                        <?php }else { ?>
                                            <p class="text-data dash_data__<?= $i ?>"></p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <?php if($_POST["count_cn"] != 0){?>
        <div class="col-12 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center"><b>สถานะการทำงาน</b></h5>
                        <!-- <h5 class="card-title text-center"><b>โหมดอัตโนมัติ </b></h5> -->
                        <!-- <div class="row g-2"> -->
                        <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12" > -->
                        <!-- <div class="row"> -->
                            <button type="button" class="btn px-5 radius-30 dash_mode text_btn" disabled></button>
                            <button type="button" class="btn px-5 radius-30 dash_panel_mode text_btn" disabled></button>
                        <!-- </div> -->
                        <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12">
                                        <button type="button" class="col-lg-6 col-xl-6 col-sm-12 col-12 btn btn-outline-info px-5 radius-30 sw_mode_Manual" style="font-size:18px">โหมดสั่งงานด้วยตนเอง</button>
                                    </div> -->
                        <!-- </div> -->
                    </div>
                    <div class="row">
                        <?php for($i = 1; $i <= 12; $i++){
                                // if($config_cn['cn_status_'.$i] == 1){ ?>
                        <div class="col-xl-3 col-lg-3 col-mb-3 col-sm-4 col-12">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <h6 class="text-center"><b>
                                    <?php if($i <= 4){echo 'น้ำหยด '.$i;}
                                        elseif($i > 4 && $i <= 8){echo 'พัดลม '.($i-4);}
                                        elseif($i > 8 && $i <= 10){echo 'พ่นหมอก '.($i-8);}
                                        elseif($i == 11){echo 'สเปรย์';}
                                        elseif($i == 12){echo 'ม่านพรางแสง';}
                                    ?> </b>
                                </h6>
                                <h6 class="text-center">
                                    <?php if($config_cn['cn_name_'.$i] == ''){echo "<br>";}else {echo $config_cn['cn_name_'.$i];} ?></h6>
                                <div class="text-center">
                                    <img class="dash_img_con dash_img_con_<?= $i ?>">
                                </div>
                            </div>
                        </div>
                        <?php //}
                            } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Control -->
        <div class="modal fade" id="Modal_control" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title">Modal title</h5>
        					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <h4 class="modal-title"><b>ระบบควบคุม <?= $s_master['house_name'] ?></b></h4>
                                <div class="ms-auto">
                                    <button type="button" class="btn-close close_modal" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true"></span> </button>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm text_btn sw_mode_Auto" style="width: 100%; border-radius:20px;">อัตโนมัติ</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm text_btn sw_mode_Manual" style="width: 100%; border-radius:20px;">กำหนดเอง</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 ul_Auto">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm text_btn sw_mode_tracking" style="width: 100%; border-radius:20px;">ตามเซนเซอร์</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm text_btn sw_mode_timer" style="width: 100%;  border-radius:20px;">ตั้งเวลา</button>
                                    </div>
                                </div>
                            </div>

                            <?php if ($config['userLevel'] < 3) {?>
                                <div class="row" style="padding-left: 12px; padding-right: 12px; padding-top: 12px">
                                <div class="d-flex align-items-center ridge" style="height: 50px; text-align: justify;">
                                    <b class=" ">ปุ่มกดหน้าตู้</b>
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-sm btn-outline-primary sw_mode_ sw_mode_lock"><i class="fadeIn animated bx bx-lock-alt"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-primary sw_mode_ sw_mode_unlock"><i class="fadeIn animated bx bx-lock-open-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container ul_Auto">
                            <div class="ul_sub_timer">
                                <div class="col-12 mt-2 control-mode mb-1">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 ">
                                            <div class="row">
                                                <?php
                                                    for($i=1; $i <=4; $i++){
                                                        echo '<div class="col-3 col-lg-6">
                                                             <button class="btn btn-control sw_sel_load_auto" id="'.$i.'">
                                                                <div class="control-text">น้ำหยด '.$i.'</div>
                                                                 <img class="img_sw_sel_load_auto'.$i.'" src="" width="100%" />
                                                             </button>
                                                        </div>';
                                                    } ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <?php for($i=5; $i <=8; $i++){
                                                        echo '<div class="col-3 col-lg-6">
                                                             <button class="btn btn-control sw_sel_load_auto"  id="'.$i.'">
                                                                <div class="control-text">พัดลม '.($i-4).'</div>
                                                                 <img class="img_sw_sel_load_auto'.$i.'" src="" width="100%" />
                                                             </button>
                                                        </div>';
                                                    } ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-3 col-lg-6">
                                                    <button class="btn btn-control sw_sel_load_auto" id="9">
                                                        <div class="control-text">พ่นหมอก 1</div>
                                                        <img class="img_sw_sel_load_auto9" src="" width="100%" />
                                                     </button>
                                                </div>
                                                <div class="col-3 col-lg-6">
                                                    <button class="btn btn-control sw_sel_load_auto" id="10">
                                                        <div class="control-text">พ่นหมอก 2</div>
                                                        <img class="img_sw_sel_load_auto10" src="" width="100%" />
                                                     </button>
                                                </div>
                                                <div class="col-3 col-lg-6">
                                                    <button class="btn btn-control sw_sel_load_auto" id="11">
                                                        <div class="control-text">สเปรย์</div>
                                                        <img class="img_sw_sel_load_auto11" src="" width="100%" />
                                                     </button>
                                                </div>
                                                <div class="col-3 col-lg-6">
                                                    <button class="btn btn-control sw_sel_load_auto" id="12">
                                                        <div class="control-text">พรางแสง</div>
                                                        <img class="img_sw_sel_load_auto12" src="" width="100%" />
                                                     </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ridge">
                                    <div class="col-12 ridge">
                                        <div class="row">
                                            <div class="d-flex align-items-center user-box" style="background-color: #283A6C; height: 50px; text-align: justify;">
                                                <a class="col-8"><b class="title_load_auto"> </b></a>
                                                <div class="ms-auto">
                                                    <a class="menu_config_auto btn btn-sm btn-primary px-2 radius-30" href="javascript:void(0)"><b> <i class='bx bx-cog user-info'></i> ตั้งค่า</b></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12"> -->
                                                        <button type="button" class="btn btn-sm text_btn sw_mode_timeSet">
                                                            <i class='bx bx-time font-18 me-1'></i> ตั้งเวลาทำงาน
                                                        </button>
                                                    <!-- </div> -->
                                                    <!-- <div class="col-lg-6 ccol-md-6 col-sm-6 col-12"> -->
                                                        <button type="button" class="btn btn-sm text_btn sw_mode_timeLoop">
                                                            <i class='bx bx-timer font-18 me-1'></i> ตั้งเวลาการทำงานต่อเนื่อง
                                                        </button>
                                                    <!-- </div> -->
                                                </div>
                                                <!-- ตั้งเวลาทำงาน เริ่ม---------->
                                                <div class="ul_mode_timeSet">
                                                    <?php for($i = 1; $i <= 6; $i++){
                                                        echo '<div class="col-12 border-bottom border-top">
                                                                <div class="d-flex align-items-center mb-2 mt-2">
                                                                    <div class="pt-2"><b>ตั้งเวลา '.$i.'</b></div>
                                                                    <div class="ms-auto">
                                                                        <img class="img_sw img_'.$i.'" src="" alt="">
                                                                        <div class="sw_toggle">
                                                                            <input class="input_check" type="checkbox" id="swch_'.$i.'" data-toggle="toggle" data-onstyle="success" data-size="sm" data-offstyle="secondary" data-style="ios">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group text-left">
                                                                            <div class="row">
                                                                                <div class="col-md-4 mt-2 text-center ">
                                                                                    <small class="form-control-feedback L_start"> เริ่ม </small>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text" id="time_s_'.$i.'" class="form-control text-center input_tSet"><!--  data-field="time" data-view="Popup" data-format="hh:mm:ss" -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group text-left">
                                                                            <div class="row">
                                                                                <div class="col-md-4 mt-2 text-center ">
                                                                                    <small class="form-control-feedback L_stop"> สิ้นสุด </small>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text" id="time_e_'.$i.'" class="form-control text-center input_tSet"><!--  data-field="time" data-view="Popup" data-format="hh:mm:ss" -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                    } ?>
                                                </div>
                                                <!----- ตั้งเวลาทำงาน จบ---------->

                                                <!----- โปรแกรมต่อเนื่อง เริ่ม---------->
                                                <div class="ul_mode_timeLoop">
                                                    <?php for($i = 1; $i <= 6; $i++){
                                                        echo '<div class="col-12 border-bottom border-top">
                                                            <div class="d-flex align-items-center mb-2 mt-2">
                                                                <div class="pt-2"><b>ตั้งเวลา '.$i.'</b></div>
                                                                <div class="ms-auto">
                                                                    <img class="img_sw imgL_'.$i.'" src="" alt="">
                                                                    <div class="sw_toggle">
                                                                        <input class="input_check" id="swchL_'.$i.'" type="checkbox" data-toggle="toggle" data-onstyle="success" data-size="sm" data-offstyle="secondary" data-style="ios">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <div class="form-group text-left">
                                                                        <div class="row">
                                                                            <div class="col-md-3 mt-2 text-center ">
                                                                                <small class="form-control-feedback"> เริ่ม </small>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <input type="text" id="time_sL_'.$i.'" class="form-control text-center input_tLoop input_tL"><!-- data-field="time" data-view="Popup" data-format="hh:mm" -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group text-left">
                                                                        <div class="row">
                                                                            <div class="col-md-3 mt-2 text-center ">
                                                                                <small class="form-control-feedback"> จำนวน </small>
                                                                            </div>
                                                                            <div class="col-md-9"><div class="input-group">
                                                                                <input type="text" class="form-control text-center input_tLoop" id="time_cy_'.$i.'" placeholder="รอบ" min="0" onchange="if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }"> <span class="input-group-text">รอบ</span>
                                                                            </div></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-lg-6 ccol-md-6 col-sm-12">
                                                                    <div class="form-group text-left">
                                                                        <div class="row">
                                                                            <div class="col-md-3 mt-2 text-center ">
                                                                                <small class="form-control-feedback"> เปิด </small>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="input-group">
			                                                                        <input type="number" class="form-control text-center input_tLoop" id="time_on1_'.$i.'" placeholder="นาที" min="0" max="999" onchange="if(Math.round(this.value) > 999){this.value = 999;}else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }"> <span class="input-group-text">:</span>
                                                                                    <input type="number" class="form-control text-center input_tLoop" id="time_on2_'.$i.'" placeholder="วินาที"  min="0" max="59"  onchange="if(Math.round(this.value) > 59 ){this.value = 59; }else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }"> <span class="input-group-text">นาที</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 ccol-md-6 col-sm-12">
                                                                    <div class="form-group text-left">
                                                                        <div class="row">
                                                                            <div class="col-md-3 mt-2 text-center ">
                                                                                <small class="form-control-feedback"> ปิด </small>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <div class="input-group">
			                                                                        <input type="number" class="form-control text-center input_tLoop" id="time_off1_'.$i.'" placeholder="นาที" min="0" max="999" onchange="if(Math.round(this.value) > 999){this.value = 999;}else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }"> <span class="input-group-text">:</span>
                                                                                    <input type="number" class="form-control text-center input_tLoop" id="time_off2_'.$i.'" placeholder="วินาที"  min="0" max="59"  onchange="if(Math.round(this.value) > 59 ){this.value = 59; }else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }"> <span class="input-group-text">นาที</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center span_se_'.$i.'"></div>
                                                        </div>';
                                                    } ?>
                                                </div>
                                                <!----- โปรแกรมต่อเนื่อง จบ---------->

                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ul_sub_sensor">
                                <div class="row ridge">
                                    <div class="d-flex align-items-center user-box" style="background-color: #283A6C; height: 50px; text-align: justify;">
                                        <a><b style="color:#FFF; font-size:18px"> ตั้งค่าโหมดตามเซนเซอร์</b></a>
                                        <div class="ms-auto">
                                            <a class="menu_config_auto2 btn btn-sm btn-primary px-2 radius-30" style="color:#FFF;" href="javascript:void(0)"><b> <i class='bx bx-cog user-info'></i> ตั้งค่า</b></a>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="card radius-10 border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2 mt-2">
                                                    <div class="pt-2"><b><h5>ควบคุมความชื้นดิน (%)</h5></b></div>
                                                    <div class="ms-auto">
                                                        <img class="img_swST imgST_1" src="" alt="">
                                                        <div class="sw_toggleST">
                                                            <input class="input_checkST" type="checkbox" id="swST_1" data-toggle="toggle" data-onstyle="success" data-size="sm" data-offstyle="secondary" data-style="ios">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="range_soil"/>
                                                <div class="text-center">
                                                    <h6 class="form-check-label">ควบคุมการทำงานน้ำหยด</h6>
                                                    <?php for($i =1; $i < 5; $i++){
                                                        echo '<div class="form-check form-switch">
                                                                <input class="form-check-input check_ check_d_'.$i.'" type="checkbox">
                                                                <label class="form-check-label">น้ำหยด '.$i.' ('. $config_cn['cn_name_'.$i] .')</label>
                                                            </div>';
                                                        }
                                                    ?>
                                                    <button type="button" class="btn btn-primary waves-light view_tracking" id="st_1">
                                                        <i class="fadeIn animated bx bx-list-check"></i> เงื่อนไขการทำงาน
                                                    </button>
                                                </div>
                                                <!-- <div class="form-check form-switch">
                                                    <input class="form-check-input check_ check_d_2" type="checkbox">
                                                    <label class="form-check-label check_dl_2"></label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input check_ check_d_3" type="checkbox">
                                                    <label class="form-check-label check_dl_3"></label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input check_ check_d_4" type="checkbox">
                                                    <label class="form-check-label check_dl_4"></label>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card radius-10 border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2 mt-2">
                                                    <div class="pt-2"><b><h5>ควบคุมความชื้นอากาศ (%Rh)</h5></b></div>
                                                    <div class="ms-auto">
                                                        <img class="img_swST imgST_2" src="" alt="">
                                                        <div class="sw_toggleST">
                                                            <input class="input_checkST" type="checkbox" id="swST_2" data-toggle="toggle" data-onstyle="success" data-size="sm" data-offstyle="secondary" data-style="ios">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="range_hum"/>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text col">ปิดพ่นหมอก และเปิดสเปรย์เมื่อ</span>
                                                    <span class="input-group-text"><b style="font-size: 0.8rem;">ความชื้นอากาศสูงกว่า </b></span>
                									<input type="number" class="form-control text_chum2 text-center" placeholder="">
                                                    <span class="input-group-text" style="font-size: 0.8rem;">%Rh</span>
                                                    <div class="invalid-feedback">ต้องมากกว่าความชื้นอากาศ Min และน้อยกว่าความชื้นอากาศ Max</div>
                								</div>
                                                <div class="text-center">
                                                    <h6 class="form-check-label">ควบคุมการทำงาน พ่นหมอก 1 (<?= $config_cn['cn_name_9'] ?>) และสเปรย์ (<?= $config_cn['cn_name_11'] ?>)</h6>
                                                    <button type="button" class="btn btn-primary waves-light view_tracking" id="st_2">
                                                        <i class="fadeIn animated bx bx-list-check"></i> เงื่อนไขการทำงาน
                                                    </button>
                                                </div>
                                                <!--
                                                <label class="form-check-label text_chum">กรณีความชื้นดินสูงกว่า <span class="text_soil"></span></label><br>
                                                <label class="form-check-label text_chum check_spl"></label><br>
                                                <label class="form-check-label text_chum">กรณีความชื้นดินต่ำกว่า <span class="text_soil"></span></label><br>
                                                <label class="form-check-label text_chum check_fgl_1"></label><br>
                                                <label class="form-check-label text_chum check_spl"></label> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card radius-10 border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2 mt-2">
                                                    <div class="pt-2"><b><h5>ควบคุมอุณหภูมิ (℃)</h5></b></div>
                                                    <div class="ms-auto">
                                                        <img class="img_swST imgST_3">
                                                        <div class="sw_toggleST">
                                                            <input class="input_checkST" type="checkbox" id="swST_3" data-toggle="toggle" data-onstyle="success" data-size="sm" data-offstyle="secondary" data-style="ios">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="range_temp"/>
                                                <div class="text-center">
                                                    <h6 class="form-check-label">ควบคุมการทำงาน พัดลม (<?= $config_cn['cn_name_5'] ?>), พ่นหมอก 1 (<?= $config_cn['cn_name_9'] ?>) และสเปรย์ (<?= $config_cn['cn_name_11'] ?>)</h6>
                                                    <div class="form-check form-switch" style="display:none">
                                                        <input class="form-check-input check_ check_fn_1" type="checkbox">
                                                        <label class="form-check-label check_fnl_1"></label>
                                                    </div>
                                                    <div class="form-check form-switch" style="display:none">
                                                        <input class="form-check-input check_ check_fn_2" type="checkbox">
                                                        <label class="form-check-label check_fnl_2"></label>
                                                    </div>
                                                    <div class="form-check form-switch" style="display:none">
                                                        <input class="form-check-input check_ check_fn_3" type="checkbox">
                                                        <label class="form-check-label check_fnl_3"></label>
                                                    </div>
                                                    <div class="form-check form-switch" style="display:none">
                                                        <input class="form-check-input check_ check_fn_4" type="checkbox">
                                                        <label class="form-check-label check_fnl_4"></label>
                                                    </div><!-- <hr/> -->
                                                    <button type="button" class="btn btn-primary waves-light view_tracking" id="st_3">
                                                        <i class="fadeIn animated bx bx-list-check"></i> เงื่อนไขการทำงาน
                                                    </button>
                                                </div>
                                                <!-- <h6 class="text_ctemp">เปิดพัดลมผ่านไป 15 นาที แต่อุณหภูมิยังมากกว่า MAX</h6>
                                                <h6 class="text_ctemp">กรณีความชื้นดินต่ำกว่า <span class="text_soil"></span></h6>
                                                <h6 class="text_ctemp">&ensp; - เมื่อความชื้นอากาศต่ำกว่า <span class="text_humT"></span></h6>
                                                <h6 class="text_ctemp">&emsp;&emsp; - <span class="check_fgl_1t"></span> ทำงานต่อเนื่อง (เปิด 2 นาที และปิด 13 นาที)</h6>
                                                <h6 class="text_ctemp">&emsp;&emsp; - <span class="check_splt"></span> หยุดทำงาน</h6>
                                                <h6 class="text_ctemp">&ensp; - เมื่อความชื้นอากาศสูงกว่า <span class="text_humT"></span></h6>
                                                <h6 class="text_ctemp">&emsp;&emsp; - <span class="check_fgl_1t"></span> หยุดทำงาน</h6>
                                                <h6 class="text_ctemp">&emsp;&emsp; - <span class="check_splt"></span> ทำงานต่อเนื่อง (เปิด 5 นาที และปิด 5 นาที)</h6>
                                                <h6 class="text_ctemp">กรณีความชื้นดินสูงกว่า <span class="text_soil"></span></h6>
                                                <h6 class="text_ctemp">&ensp; - เมื่อความชื้นอากาศต่ำกว่า <span class="text_humT"></span></h6>
                                                <h6 class="text_ctemp">&emsp;&emsp; - <span class="check_fgl_1t"></span> หยุดทำงาน</h6>
                                                <h6 class="text_ctemp">&emsp;&emsp; - <span class="check_splt"></span> ทำงานต่อเนื่อง (เปิด 5 นาที และปิด 5 นาที)</h6> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card radius-10 border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2 mt-2">
                                                    <div class="pt-2"><b><h5 class="title_l"></h5></b></div>
                                                    <div class="ms-auto">
                                                        <img class="img_swST imgST_4" src="" alt="">
                                                        <div class="sw_toggleST">
                                                            <input class="input_checkST" type="checkbox" id="swST_4" data-toggle="toggle" data-onstyle="success" data-size="sm" data-offstyle="secondary" data-style="ios">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" class="range_light"/>
                                                <div class="text-center">
                                                    <h6 class="form-check-label">ควบคุมการทำงานม่านพรางแสง</h6>
                                                    <div class="col-12 row">
                                                        <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                                            <h6 class="form-check-label">แสงต่ำสุด</h6>
                                                            <h6 class="form-check-label lk_min"></h6>
                                                            <h6 class="form-check-label lu_min"></h6>
                                                        </div>
                                                        <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
                                                            <h6 class="form-check-label">แสงสูงสุด</h6>
                                                            <h6 class="form-check-label lk_max"></h6>
                                                            <h6 class="form-check-label lu_max"></h6>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary waves-light view_tracking" id="st_4">
                                                        <i class="fadeIn animated bx bx-list-check"></i> เงื่อนไขการทำงาน
                                                    </button>
                                                </div>
                                                <!-- <label class="form-check-label text_light"></label> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ================================ -->
                        <div class="container ul_Manual">
                            <!-- <div class="col-12 text-center  "> -->
                                <div class="row mt-2 mb-2">
                                    <?php echo '
                                            <button class="btn btn-control sw_sel_load_manual" id="s1">
                                                <div class="text_icon_manual">น้ำหยด</div>
                                                <img class="img_m img_sw_sel_load_manual_1" src="" />
                                            </button>
                                            <button class="btn btn-control sw_sel_load_manual" id="s3">
                                                <div class="text_icon_manual">พ่นหมอก</div>
                                                <img class="img_m img_sw_sel_load_manual_3" src="" />
                                            </button>
                                            <button class="btn btn-control sw_sel_load_manual" id="s4">
                                                <div class="text_icon_manual">สเปรย์</div>
                                                <img class="img_m img_sw_sel_load_manual_4" src="" />
                                            </button>
                                            <button class="btn btn-control sw_sel_load_manual" id="s2">
                                                <div class="text_icon_manual">พัดลม</div>
                                                <img class="img_m img_sw_sel_load_manual_2" src="" />
                                            </button>
                                            <button class="btn btn-control sw_sel_load_manual" style="width:100% border-radius:20px" id="s5">
                                                <div class="text_icon_manual ">พรางแสง</div>
                                                <img class="img_m img_sw_sel_load_manual_5" src="" />
                                            </button>
                                        ';
                                    ?>
                                </div>
                            <!-- </div> -->
                            <div class="row ridge">
                                <h3 class="text-center title_load_manual" style="background-color: #283A6C; color:#FFF"></h3>
                                <div class="col text-end  me-2 mb-3 mt-2">
                                    <button class="btn sw_manual_on"><img src="public/images/icons/menu_control/on_off.png" class="img_sw_manl"></button>
                                </div>
                                <div class="col text-start ms-2 mb-3 mt-2">
                                    <button class="btn sw_manual_off active"><img src="public/images/icons/menu_control/off_on.png" class="img_sw_manl"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <div class="ul_sub_timer"> -->
                        <div class="ul_Auto">
                            <button type="button" id="view_auto" class="btn btn-primary waves-light">
                                <i class="fadeIn animated bx bx-time"></i> ตรวจสอบเวลาทำงาน
                            </button>
                            <button type="button" id="save_auto_cont" class="btn btn-success waves-light">
                                <i class="fadeIn animated bx bx-save"></i> บันทึก
                            </button>
                            <button type="button" id="close_auto_cont" class="btn btn-danger waves-effect">
                                <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                            </button>
                        </div>
                        <!-- </div> -->
                        <div class="ul_Manual" style="width: 100%;">
                            <div class="d-flex align-items-center">
                                <div class="form-check status_config_manual">
                                    <input class="form-check-input " type="checkbox" id="checkbox_all_manual">
                                    <label class="form-check-label">เลือกทั้งหมด</label>
                                </div>
                                <div class="ms-auto">
                                    <a class="menu_config_manual btn btn-sm btn-primary px-2 radius-30" style="color:#FFF; font-size:16px" href="javascript:void(0)"><b> <i class='bx bx-cog'></i> ตั้งค่า</b></a>
                                    <!-- <button type="button" class="btn btn-primary px-2 radius-30 menu_config_manual"><label>ตั้งค่า</label></button> -->
                                    <button type="button" id="save_manual_cont" class="btn btn-success waves-light">
                                        <i class="fadeIn animated bx bx-save"></i> บันทึก
                                    </button>
                                    <button type="button" id="close_manual_cont" class="btn btn-danger waves-effect">
                                        <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-3 text-center">
                                    <label class="text_icon_manual label_1"></label>
                                    <div class="status_config_manual">
                                        <input class="input_check2" type="checkbox" id="label_1" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <label class="text_icon_manual label_2"></label>
                                    <div class="status_config_manual">
                                        <input class="input_check2" type="checkbox" id="label_2" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <label class="text_icon_manual label_3"></label>
                                    <div class="status_config_manual status_config_manual_3">
                                        <input class="input_check2" type="checkbox" id="label_3" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <label class="text_icon_manual label_4"></label>
                                    <div class="status_config_manual status_config_manual_4">
                                        <input class="input_check2" type="checkbox" id="label_4" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- exit Modal Control -->
    <?php } ?>
    <script>
        // let config_sn = $.parseJSON('<?// json_encode($config_sn) ?>');
        let config_cn2 = $.parseJSON('<?= json_encode($config_cn) ?>');
        let set_maxmin = $.parseJSON('<?= json_encode($set_maxmin) ?>');
        let sensor = $.parseJSON('<?= json_encode($sensor) ?>');
        let s_sensor = $.parseJSON('<?= json_encode($s_sensor) ?>');

        let status_dripper = [], status_fan = [],  status_foggy = [],  control_V = '<?= $control_V ?>';
        status_dripper.push(parseInt(config_cn2.cn_status_1))
        status_dripper.push(parseInt(config_cn2.cn_status_2))
        status_dripper.push(parseInt(config_cn2.cn_status_3))
        status_dripper.push(parseInt(config_cn2.cn_status_4))
        status_fan.push(parseInt(config_cn2.cn_status_5))
        status_fan.push(parseInt(config_cn2.cn_status_6))
        status_fan.push(parseInt(config_cn2.cn_status_7))
        status_fan.push(parseInt(config_cn2.cn_status_8))
        status_foggy.push(parseInt(config_cn2.cn_status_9))
        status_foggy.push(parseInt(config_cn2.cn_status_10))

        let range1 = $(".range_soil"), range_instance1;
        let range2 = $(".range_hum"), range_instance2;
        let range3 = $(".range_temp"), range_instance3;
        let range4 = $(".range_light"), range_instance4;

        range1.ionRangeSlider({
            'type': "double",
            'grid': true,
            // onChange: function (data) {
                // console.log(data);
                // check_load($('.check_d_1').prop('checked'), 'dl_1', 1, ' -> เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+data.from+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+data.to+' %')
                // check_load($('.check_d_2').prop('checked'), 'dl_2', 2, ' -> เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+data.from+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+data.to+' %')
                // check_load($('.check_d_3').prop('checked'), 'dl_3', 3, ' -> เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+data.from+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+data.to+' %')
                // check_load($('.check_d_4').prop('checked'), 'dl_4', 4, ' -> เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+data.from+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+data.to+' %')
            // }
        });
        range_instance1 = range1.data("ionRangeSlider");
        range1.css({ fontSize: 20 });
        range2.ionRangeSlider({
            'type': "double",
            'grid': true,
        });
        range_instance2 = range2.data("ionRangeSlider");
        range3.ionRangeSlider({
            'type': "double",
            'grid': true
        });
        range_instance3 = range3.data("ionRangeSlider");
        range4.ionRangeSlider({
            'type': "double",
            'grid': true,
        });
        range_instance4 = range4.data("ionRangeSlider");
        $('.memu_control').click(function() {
            $.getJSON("routes/tu/check_level_user.php?siteID=" + url[1] + "&house_master=" + house_master, function(res_j) {
                if (res_j.user_level > 2) {
                    if (res_j.count_level > 0) {
                        Swal.fire({
                            'type': 'warning',
                            'title': '<strong><b>ผู้ดูแลระบบกำลังใช้งาน</b></strong>',
                            'html': 'ขณะนี้ <b>ผู้ดูแลระบบ</b> กำลังใช้งาน <br> คุณไม่สามารถสั่งงานอุปกรณ์ได้ !',
                            // footer: '<a href="">Why do I have this issue?</a>'
                        });
                        return false;
                    }
                }

                $(".memu_dash").show().addClass("mm-active");
                $(this).removeClass("mm-active");
                $("#Modal_control").modal('show');
                $('#Modal_control').on('shown.bs.modal', function() {
                    $(document).off('focusin.modal');
                });
                // var client = null;
                // // These are configs
                // var hostname = "203.150.37.144"; //'103.2.115.15'; // 203.150.37.144   decccloud.com
                // var port = "8083";
                // var clientId = "mqtt_js_3074" + parseInt(Math.random() * 100000, 10);
                // // Create a client instance
                // client = new Paho.MQTT.Client(hostname, Number(port), "mqtt_control_324" + parseInt(Math.random() * 1000, 10));
                //
                // // set callback handlers
                // client.onConnectionLost = onConnectionLost;
                // client.onMessageArrived = onMessageArrived;
                //
                // // connect the client
                // client.connect({
                //     onSuccess: onConnect
                // });
                //
                // // called when the client connects
                // function onConnect() {
                //     // Once a connection has been made, make a subscription and send a message.
                //     console.log("onConnect");
                //     client.subscribe(house_master + "/control/config/auto");
                // }
                //
                // // called when the client loses its connection
                // function onConnectionLost(responseObject) {
                //     if (responseObject.errorCode !== 0) {
                //         console.log("onConnectionLost:" + responseObject.errorMessage);
                //     }
                // }
                //
                // // called when a message arrives
                // function onMessageArrived(message) {
                //     $("#save_auto_cont").click(function() {
                //         for (var i = 1; i <= 6; i++) {
                //             if ($("#swch_" + i).prop('checked') == true) {
                //                 if ($("#time_s_" + i).val() == "") {
                //                     $('#time_s_' + i).addClass('is-invalid')
                //                     return false;
                //                 } else {
                //                     $('#time_s_' + i).removeClass('is-invalid')
                //                 }
                //                 if ($("#time_e_" + i).val() == "") {
                //                     $('#time_e_' + i).addClass('is-invalid')
                //                     return false;
                //                 } else {
                //                     $('#time_e_+i').removeClass('is-invalid')
                //                 }
                //                 if ($('#12').hasClass('active') == false) {
                //                     if ($("#time_s_" + i).val() >= $("#time_e_" + i).val()) {
                //                         swal_c(type = 'error', title = 'Error...', text = 'ตั้งเวลา ' + i + ' : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                //                         $('#time_s_1').addClass('is-invalid')
                //                         $('#time_e_1').addClass('is-invalid')
                //                         return false;
                //                     } else {
                //                         $('#time_s_' + i).removeClass('is-invalid')
                //                         $('#time_e_' + i).removeClass('is-invalid')
                //                     }
                //                 }
                //             }
                //         }
                //
                //         function swal_c(type, title, text) {
                //             Swal({
                //                 type: type,
                //                 title: title,
                //                 html: text,
                //                 allowOutsideClick: false
                //             });
                //         }
                //         // alert($('#12').hasClass('active'));
                //         // return false
                //         swal({
                //             title: 'บันทึกการเปลี่ยนแปลง',
                //             text: "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                //             type: 'warning',
                //             allowOutsideClick: false,
                //             showCancelButton: true,
                //             confirmButtonColor: '#32CD32',
                //             cancelButtonColor: '#FF3333',
                //             confirmButtonText: 'ใช่',
                //             cancelButtonText: 'ยกเลิก'
                //         }).
                //         then((result) => {
                //             if (result.value) {
                //                 if ($("#swch_1").prop('checked') == true) {
                //                     var sw_1 = 1;
                //                 } else {
                //                     var sw_1 = 0;
                //                 }
                //                 if ($("#swch_2").prop('checked') == true) {
                //                     var sw_2 = 1;
                //                 } else {
                //                     var sw_2 = 0;
                //                 }
                //                 if ($("#swch_3").prop('checked') == true) {
                //                     var sw_3 = 1;
                //                 } else {
                //                     var sw_3 = 0;
                //                 }
                //                 if ($("#swch_4").prop('checked') == true) {
                //                     var sw_4 = 1;
                //                 } else {
                //                     var sw_4 = 0;
                //                 }
                //                 if ($("#swch_5").prop('checked') == true) {
                //                     var sw_5 = 1;
                //                 } else {
                //                     var sw_5 = 0;
                //                 }
                //                 if ($("#swch_6").prop('checked') == true) {
                //                     var sw_6 = 1;
                //                 } else {
                //                     var sw_6 = 0;
                //                 }
                //                 $.ajax({
                //                     type: "POST",
                //                     url: "routes/tu/save_autoControl.php",
                //                     data: {
                //                         house_master: house_master,
                //                         hidden_select_sw_auto: $(".hidden_select_sw_auto").val(),
                //                         sw_1: sw_1,
                //                         sw_2: sw_2,
                //                         sw_3: sw_3,
                //                         sw_4: sw_4,
                //                         sw_5: sw_5,
                //                         sw_6: sw_6,
                //                         s_1: $("#time_s_1").val(),
                //                         s_2: $("#time_s_2").val(),
                //                         s_3: $("#time_s_3").val(),
                //                         s_4: $("#time_s_4").val(),
                //                         s_5: $("#time_s_5").val(),
                //                         s_6: $("#time_s_6").val(),
                //                         e_1: $("#time_e_1").val(),
                //                         e_2: $("#time_e_2").val(),
                //                         e_3: $("#time_e_3").val(),
                //                         e_4: $("#time_e_4").val(),
                //                         e_5: $("#time_e_5").val(),
                //                         e_6: $("#time_e_6").val(),
                //                         parseJSON: JSON.parse($('#val_sw_auto_time_set').val())
                //                     },
                //                     dataType: 'json',
                //                     success: function(res) {
                //                         console.log(res.data)
                //                         if (res.status == "Insert_Success") {
                //                             $("#Modal_Auto_control").modal("hide");
                //                             var originalArray = res.data;
                //                             var separator = '\r\n';
                //                             var implodedArray = '';
                //
                //                             for (let i = 0; i < originalArray.length; i++) {
                //
                //                                 // add a string from original array
                //                                 implodedArray += originalArray[i];
                //
                //                                 // unless the iterator reaches the end of
                //                                 // the array add the separator string
                //                                 if (i != originalArray.length - 1) {
                //                                     implodedArray += separator;
                //                                 }
                //                             }
                //                             // console.log(implodedArray);
                //                             // if (message.destinationName == house_master + "/control/config/auto") {
                //                             // var parseJSON = JSON.parse($('#val_sw_auto_time_set').val())
                //                             // var result = message.payloadString;
                //                             // var parseJSON = $.parseJSON(result);
                //                             // console.log(parseJSON);
                //                             // $.extend(parseJSON, res.data);
                //                             // var json_msg = JSON.stringify(parseJSON);
                //                             // console.log(parseJSON.length)
                //                             mqtt_send(house_master + '/control/config/auto', implodedArray, '')
                //                                 // }
                //                             swal({
                //                                 title: 'บันทึกข้อมูลสำเร็จ',
                //                                 type: 'success',
                //                                 allowOutsideClick: false,
                //                                 confirmButtonColor: '#32CD32'
                //                             });
                //                             // fn_df_logdata_auto($('.hidden_select_sw_auto').val())
                //                             for (var i = 1; i <= 6; i++) {
                //                                 if ($("#swch_" + i).prop('checked') == true) {
                //                                     $(".img_" + i).attr("src", "public/images/control/switck_on.png");
                //                                 } else {
                //                                     $(".img_" + i).attr("src", "public/images/control/switck_off.png");
                //                                 }
                //                             }
                //                             $(".img_sw").show();
                //                             $('.input_tSet').prop('disabled', true);
                //                             $(".sw_toggle").hide();
                //                             $(".menu_config_auto").show();
                //                             $(".sw_mode_Auto").attr('disabled', false);
                //                             $(".sw_mode_Manual").attr('disabled', false);
                //                             $("#save_auto_cont").hide();
                //                             $("#close_auto_cont").hide();
                //                         } else {
                //                             swal({
                //                                 title: 'Error !',
                //                                 text: "เกิดข้อผิดพลาด ?",
                //                                 type: 'error',
                //                                 allowOutsideClick: false,
                //                                 confirmButtonColor: '#32CD32'
                //                             }).then((result) => {
                //                                 if (result.value) {
                //                                     // location.reload();
                //                                     return false;
                //                                 }
                //                             });
                //                         }
                //                     }
                //                 });
                //
                //             }
                //         });
                //     }); // exit_save_Auto
                //     $("#save_manual_cont").click(function() {
                //         var log_sw = [];
                //         var n_countSB = [];
                //         var numb = $('.hidden_select_sw_manual').val();
                //         if (numb == 1) {
                //             if (parseInt(config_cn2.cn_status_1) == 1) {
                //                 if ($("#label_1").prop('checked') == true) {
                //                     log_sw['sw_1'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_1'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_1'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_2) == 1) {
                //                 if ($("#label_2").prop('checked') == true) {
                //                     log_sw['sw_2'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_2'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_2'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_3) == 1) {
                //                 if ($("#label_3").prop('checked') == true) {
                //                     log_sw['sw_3'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_3'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_3'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_4) == 1) {
                //                 if ($("#label_4").prop('checked') == true) {
                //                     log_sw['sw_4'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_4'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_4'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //
                //         } else if (numb == 2) {
                //             if (parseInt(config_cn2.cn_status_5) == 1) {
                //                 if ($("#label_1").prop('checked') == true) {
                //                     log_sw['sw_1'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_1'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_1'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_6) == 1) {
                //                 if ($("#label_2").prop('checked') == true) {
                //                     log_sw['sw_2'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_2'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_2'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_7) == 1) {
                //                 if ($("#label_3").prop('checked') == true) {
                //                     log_sw['sw_3'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_3'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_3'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_8) == 1) {
                //                 if ($("#label_4").prop('checked') == true) {
                //                     log_sw['sw_4'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_4'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_4'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //         } else if (numb == 3) {
                //             if (parseInt(config_cn2.cn_status_9) == 1) {
                //                 if ($("#label_1").prop('checked') == true) {
                //                     log_sw['sw_1'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_1'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_1'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             if (parseInt(config_cn2.cn_status_10) == 1) {
                //                 if ($("#label_2").prop('checked') == true) {
                //                     log_sw['sw_2'] = "ON";
                //                     n_countSB.push(1);
                //                 } else {
                //                     log_sw['sw_2'] = "OFF";
                //                     n_countSB.push(0);
                //                 }
                //             } else {
                //                 log_sw['sw_2'] = "OFF";
                //                 n_countSB.push(0);
                //             }
                //             log_sw['sw_3'] = "OFF";
                //             log_sw['sw_4'] = "OFF";
                //         }
                //         if (countElement(1, n_countSB) == 0) {
                //             swal({
                //                     html: 'ต้องมีอุปกรณ์เปิดใช้งาน<br>อย่างน้อย 1 ตัว !',
                //                     // text: "ต้องมีอุปกรณ์เปิดใช้งานอย่างน้อย 1 ตัว !",
                //                     type: 'warning',
                //                     allowOutsideClick: false,
                //                     confirmButtonColor: '#32CD32'
                //                 })
                //                 // then((result) => {
                //                 //     if (result.value) {
                //                 //         location.reload();
                //                 //         return false;
                //                 //     }
                //                 // });
                //         } else {
                //             swal({
                //                 title: 'บันทึกการเปลี่ยนแปลง',
                //                 text: "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                //                 type: 'warning',
                //                 allowOutsideClick: false,
                //                 showCancelButton: true,
                //                 confirmButtonColor: '#32CD32',
                //                 cancelButtonColor: '#FF3333',
                //                 confirmButtonText: 'ใช่',
                //                 cancelButtonText: 'ยกเลิก'
                //             }).then((result) => {
                //                 if (result.value) {
                //                     var log_sw2 = {
                //                             'mode': numb,
                //                             'sw_1': log_sw['sw_1'],
                //                             'sw_2': log_sw['sw_2'],
                //                             'sw_3': log_sw['sw_3'],
                //                             'sw_4': log_sw['sw_4']
                //                         }
                //                         // console.log(log_sw)
                //                     $.ajax({
                //                         type: "POST",
                //                         url: "routes/tu/save_manualControl.php",
                //                         data: {
                //                             house_master: house_master,
                //                             log_sw: log_sw2
                //                         },
                //                         dataType: 'json',
                //                         success: function(res) {
                //                             // console.log(res.data)
                //                             if (res.status == "Insert_Success") {
                //                                 $("#Modal_Auto_control").modal("hide");
                //                                 $('#val_sw_manual').val(JSON.stringify(res.data));
                //                                 // console.log(res.data);
                //                                 var new_res = //JSON.stringify(
                //                                     '[config]' + '\r\n' +
                //                                     'serial_id=' + house_master + '\r\n' +
                //                                     'dripper_1=' + res.data['dripper_1'] + '\r\n' +
                //                                     'dripper_2=' + res.data['dripper_2'] + '\r\n' +
                //                                     'dripper_3=' + res.data['dripper_3'] + '\r\n' +
                //                                     'dripper_4=' + res.data['dripper_4'] + '\r\n' +
                //                                     'fan_1=' + res.data['fan_1'] + '\r\n' +
                //                                     'fan_2=' + res.data['fan_2'] + '\r\n' +
                //                                     'fan_3=' + res.data['fan_3'] + '\r\n' +
                //                                     'fan_4=' + res.data['fan_4'] + '\r\n' +
                //                                     'foggy_1=' + res.data['foggy_1'] + '\r\n' +
                //                                     'foggy_2=' + res.data['foggy_2']
                //
                //                                 // );
                //                                 mqtt_send(house_master + '/control/config/manual', new_res, '')
                //                                 for (var i = 1; i <= 10; i++) {
                //                                     if (i <= 4) {
                //                                         if (config_cn2['cn_status_' + i] == 1) {
                //                                             if (res.data['dripper_' + i] == 'ON') {
                //                                                 $(".dash_img_con_" + i).attr("src", "public/images/control/TU/sprinkler-off.svg");
                //                                             } else {
                //                                                 $(".dash_img_con_" + i).attr("src", "public/images/control/TU/Sprinkler_disable.svg");
                //                                             }
                //                                         } else {
                //                                             $(".dash_img_con_" + i).attr("src", "public/images/control/TU/Sprinkler_disable.svg");
                //                                         }
                //                                     } else if (i > 4 && i <= 8) {
                //                                         if (config_cn2['cn_status_' + i] == 1) {
                //                                             if (res.data['fan_' + (i - 4)] == 'ON') {
                //                                                 $(".dash_img_con_" + i).attr("src", "public/images/control/TU/fan-off.svg");
                //                                             } else {
                //                                                 $(".dash_img_con_" + i).attr("src", "public/images/control/TU/fan-disable.svg");
                //                                             }
                //                                         } else {
                //                                             $(".dash_img_con_" + i).attr("src", "public/images/control/TU/fan-disable.svg");
                //                                         }
                //                                     } else if (i > 8) {
                //                                         if (config_cn2['cn_status_' + i] == 1) {
                //                                             if (res.data['foggy_' + (i - 8)] == 'ON') {
                //                                                 $(".dash_img_con_" + i).attr("src", "public/images/control/TU/foggy-off.svg");
                //                                             } else {
                //                                                 $(".dash_img_con_" + i).attr("src", "public/images/control/TU/foggy-disable.svg");
                //                                             }
                //                                         } else {
                //                                             $(".dash_img_con_" + i).attr("src", "public/images/control/TU/foggy-disable.svg");
                //                                         }
                //                                     }
                //                                 }
                //                                 swal({
                //                                     title: 'บันทึกข้อมูลสำเร็จ',
                //                                     type: 'success',
                //                                     allowOutsideClick: false,
                //                                     confirmButtonColor: '#32CD32'
                //                                 });
                //                                 $(".menu_config_manual").show();
                //                                 $('.status_config_manual').hide();
                //                                 $(".sw_mode_Auto").attr('disabled', false);
                //                                 $(".sw_mode_Manual").attr('disabled', false);
                //                                 $("#save_manual_cont").hide();
                //                                 $("#close_manual_cont").hide();
                //                                 fn_label_manual($('.hidden_select_sw_manual').val());
                //                             } else {
                //                                 swal({
                //                                     title: 'Error !',
                //                                     text: "เกิดข้อผิดพลาด ?",
                //                                     type: 'error',
                //                                     allowOutsideClick: false,
                //                                     confirmButtonColor: '#32CD32'
                //                                 }).then((result) => {
                //                                     if (result.value) {
                //                                         location.reload();
                //                                         return false;
                //                                     }
                //                                 });
                //                             }
                //                         }
                //                     });
                //
                //                 }
                //             });
                //         }
                //     }); // exit_save_Manual
                //     function mqtt_send(msg_dn, msg, user) {
                //         message = new Paho.MQTT.Message(msg);
                //         message.destinationName = msg_dn;
                //         message.qos = 1;
                //         message.retained = true;
                //         client.send(message);
                //     }
                //     $('.sw_mode_Auto').click(function() { // console.log($(this).attr("id"));
                //         // alert($(this).attr("id"))
                //         if ($(this).hasClass("active") == false) {
                //             switch_mode(sw_name = "อัตโนมัติ", mess = "Auto");
                //         }
                //     });
                //     $('.sw_mode_Manual').click(function() { // console.log($(this).attr("id"));
                //         if ($(this).hasClass("btn-success") == false) {
                //             switch_mode(sw_name = "กำหนดเอง", mess = "Manual");
                //         }
                //     });
                //
                //     function switch_mode(sw_name, mess, mqtt_name_us) {
                //         swal({
                //             title: 'เปลี่ยนโหมดการทำงาน !',
                //             text: "คุณต้องการเปลี่ยนเป็นไปใช้โหมด" + sw_name + " ?",
                //             type: 'warning',
                //             allowOutsideClick: false,
                //             showCancelButton: true,
                //             confirmButtonColor: '#32CD32',
                //             cancelButtonColor: '#FF3333',
                //             confirmButtonText: 'ใช่',
                //             cancelButtonText: 'ยกเลิก'
                //         }).then((result) => {
                //             if (result.value) {
                //                 // console.log(login_user);
                //                 // message = new Paho.MQTT.Message(login_user);
                //                 // message.destinationName = house_master + "/control/status/user_control";
                //                 // message.retained = true;
                //                 // message.qos = 1;
                //                 // client.send(message);
                //                 //
                //                 // message = new Paho.MQTT.Message(mess);
                //                 // message.destinationName = house_master + "/control/status/mode";
                //                 // message.retained = true;
                //                 // message.qos = 1;
                //                 // client.send(message);
                //                 // ----------------------------------------------------------
                //                 message = new Paho.MQTT.Message(login_user);
                //                 message.destinationName = house_master + "/control/loads/user_control";
                //                 message.retained = true;
                //                 message.qos = 1;
                //                 client.send(message);
                //
                //                 message = new Paho.MQTT.Message(mess);
                //                 message.destinationName = house_master + "/control/loads/mode";
                //                 message.retained = true;
                //                 message.qos = 1;
                //                 client.send(message);
                //             }
                //         });
                //     }
                //     $('.sw_manual_on').click(function() {
                //         if ($(this).hasClass("active") == false) {
                //             switch_control("ON", $('.hidden_select_sw_manual').val());
                //         }
                //     });
                //     $('.sw_manual_off').click(function() {
                //         if ($(this).hasClass("active") == false) {
                //             switch_control("OFF", $('.hidden_select_sw_manual').val());
                //         }
                //     });
                //
                //     function switch_control(sts, val) {
                //         if (sts == "ON") {
                //             var status = 'เปิด';
                //         } else {
                //             var status = 'ปิด';
                //         }
                //         var sw_log = $.parseJSON($('#val_sw_manual').val());
                //         if (val == 1) {
                //             var name = 'น้ำหยด';
                //             if (sw_log.dripper_1 == 'ON') {
                //                 var sw_1 = 1;
                //                 var mqtt_name_1 = 'dripper_1';
                //             } else {
                //                 var sw_1 = 0;
                //             }
                //             if (sw_log.dripper_2 == 'ON') {
                //                 var sw_2 = 1;
                //                 var mqtt_name_2 = 'dripper_2';
                //             } else {
                //                 var sw_2 = 0;
                //             }
                //             if (sw_log.dripper_3 == 'ON') {
                //                 var sw_1 = 3;
                //                 var mqtt_name_3 = 'dripper_3';
                //             } else {
                //                 var sw_3 = 0;
                //             }
                //             if (sw_log.dripper_4 == 'ON') {
                //                 var sw_4 = 1;
                //                 var mqtt_name_4 = 'dripper_4';
                //             } else {
                //                 var sw_4 = 0;
                //             }
                //         } else if (val == 2) {
                //             var name = 'พัดลม';
                //             if (sw_log.fan_1 == 'ON') {
                //                 var sw_1 = 1;
                //                 var mqtt_name_1 = 'fan_1';
                //             } else {
                //                 var sw_1 = 0;
                //             }
                //             if (sw_log.fan_2 == 'ON') {
                //                 var sw_2 = 1;
                //                 var mqtt_name_2 = 'fan_2';
                //             } else {
                //                 var sw_2 = 0;
                //             }
                //             if (sw_log.fan_3 == 'ON') {
                //                 var sw_1 = 3;
                //                 var mqtt_name_3 = 'fan_3';
                //             } else {
                //                 var sw_3 = 0;
                //             }
                //             if (sw_log.fan_4 == 'ON') {
                //                 var sw_4 = 1;
                //                 var mqtt_name_4 = 'fan_4';
                //             } else {
                //                 var sw_4 = 0;
                //             }
                //         } else if (val == 3) {
                //             var name = 'พ่นหมอก';
                //             if (sw_log.foggy_1 == 'ON') {
                //                 var sw_1 = 1;
                //                 var mqtt_name_1 = 'foggy_1';
                //             } else {
                //                 var sw_1 = 0;
                //             }
                //             if (sw_log.foggy_2 == 'ON') {
                //                 var sw_2 = 1;
                //                 var mqtt_name_2 = 'foggy_2';
                //             } else {
                //                 var sw_2 = 0;
                //             }
                //             var sw_3 = 0;
                //             var sw_4 = 0;
                //         } else if (val == 4) {
                //             var name = 'สเปรย์';
                //             var sw_1 = 1;
                //             var mqtt_name_1 = 'spray';
                //             var sw_2 = 0;
                //             var sw_3 = 0;
                //             var sw_4 = 0;
                //         } else if (val == 5) {
                //             var name = 'ม่านพรางแสง';
                //             var mqtt_name_1 = 'shading';
                //             var sw_1 = 1;
                //             var sw_2 = 0;
                //             var sw_3 = 0;
                //             var sw_4 = 0;
                //         }
                //         swal({
                //             title: 'คุณต้องการ ' + status + ' ' + name + ' ?',
                //             // text: "คุณต้องการเปลี่ยนไปใช้โหมด Manual !!!",
                //             type: 'warning',
                //             allowOutsideClick: false,
                //             showCancelButton: true,
                //             confirmButtonColor: '#32CD32',
                //             cancelButtonColor: '#FF3333',
                //             confirmButtonText: 'ใช่',
                //             cancelButtonText: 'ยกเลิก'
                //         }).then((result) => {
                //             // console.log(result)
                //             if (result.value) {
                //                 // alert(sta)
                //                 // return false;
                //
                //                 // message = new Paho.MQTT.Message(login_user);
                //                 // message.destinationName = house_master + "/control/status/user_control";
                //                 // message.qos = 1;
                //                 // message.retained = true;
                //                 // client.send(message);
                //                 // if(sw_1 == 1){
                //                 //     message = new Paho.MQTT.Message(sts);
                //                 //     message.destinationName = house_master + "/control/status/" + mqtt_name_1;
                //                 //     message.qos = 1;
                //                 //     message.retained = true;
                //                 //     client.send(message);
                //                 //     // console.log(message.qos);
                //                 // }
                //                 // if(sw_2 == 1){
                //                 //     message = new Paho.MQTT.Message(sts);
                //                 //     message.destinationName = house_master + "/control/status/" + mqtt_name_2;
                //                 //     message.qos = 1;
                //                 //     message.retained = true;
                //                 //     client.send(message);
                //                 // }
                //                 // if(sw_3 == 1){
                //                 //     message = new Paho.MQTT.Message(sts);
                //                 //     message.destinationName = house_master + "/control/status/" + mqtt_name_3;
                //                 //     message.qos = 1;
                //                 //     message.retained = true;
                //                 //     client.send(message);
                //                 // }
                //                 // if(sw_4 == 1){
                //                 //     message = new Paho.MQTT.Message(sts);
                //                 //     message.destinationName = house_master + "/control/status/" + mqtt_name_4;
                //                 //     message.qos = 1;
                //                 //     message.retained = true;
                //                 //     client.send(message);
                //                 // }
                //
                //                 message = new Paho.MQTT.Message(login_user);
                //                 message.destinationName = house_master + "/control/loads/user_control";
                //                 message.qos = 1;
                //                 message.retained = true;
                //                 client.send(message);
                //                 if (val == 1) {
                //                     message = new Paho.MQTT.Message(sts);
                //                     message.destinationName = house_master + "/control/loads/dripper";
                //                     message.qos = 1;
                //                     message.retained = true;
                //                     client.send(message);
                //                 } else if (val == 2) {
                //                     message = new Paho.MQTT.Message(sts);
                //                     message.destinationName = house_master + "/control/loads/fan";
                //                     message.qos = 1;
                //                     message.retained = true;
                //                     client.send(message);
                //                 } else if (val == 3) {
                //                     message = new Paho.MQTT.Message(sts);
                //                     message.destinationName = house_master + "/control/loads/foggy";
                //                     message.qos = 1;
                //                     message.retained = true;
                //                     client.send(message);
                //                 } else if (val == 4) {
                //                     message = new Paho.MQTT.Message(sts);
                //                     message.destinationName = house_master + "/control/loads/spray";
                //                     message.qos = 1;
                //                     message.retained = true;
                //                     client.send(message);
                //                 } else if (val == 5) {
                //                     message = new Paho.MQTT.Message(sts);
                //                     message.destinationName = house_master + "/control/loads/shading";
                //                     message.qos = 1;
                //                     message.retained = true;
                //                     client.send(message);
                //
                //                 }
                //             }
                //         });
                //     }
                // } // exit_message
                // // ================================================
                // Auto
                // $(".menu_config_auto").show();
                $(".img_sw").show();
                $(".sw_toggle").hide();
                $('.input_tSet').prop('disabled', true);
                $('.input_tLoop').prop('disabled', true);
                fn_df_checkbox_auto($('.hidden_select_sw_auto').val());
                fn_df_logdata_auto($('.hidden_select_sw_auto').val())
                $("#save_auto_cont").hide();
                $("#close_auto_cont").hide();
                $('.sw_mode_timeSet').prop('disabled', true);
                $('.sw_mode_timeLoop').prop('disabled', true);
                $(".menu_config_auto").show();
                $(".menu_config_auto").click(function() { // เมนูตั้งค่า
                    fn_df_checkbox_auto($('.hidden_select_sw_auto').val());
                    fn_df_logdata_auto($('.hidden_select_sw_auto').val())
                    // var res = JSON.parse($('#val_sw_auto_time_set').val())
                        // console.log(res);
                        // $(".nav-link").addClass('disabled');
                    let config_parse = JSON.parse($('#val_config').val());
                    let res = config_parse.config_timeSet;
                    let channel = $('.hidden_select_sw_auto').val();
                    // if(channel < 12 && channel > 8 || channel < 5){
                    let res2 = config_parse.config_timeLoop;
                    // }
                    $(this).hide();
                    $(".img_sw").hide();
                    $(".sw_toggle").show();
                    $("#close_auto_cont").show();
                    $(".sw_mode_Auto").attr('disabled', true);
                    $(".sw_mode_Manual").attr('disabled', true);
                    $('.sw_mode_tracking').prop('disabled', true)
                    $('.sw_mode_timer').prop('disabled', true)
                    $('.sw_mode_timeSet').prop('disabled', false)
                    $('.sw_mode_timeLoop').prop('disabled', false)
                    $(".close_modal").hide();
                    // return false;
                    for (let i = 1; i <= 6; i++) {
                        if (res["load_" + $('.hidden_select_sw_auto').val()]["load_st_" + i] == 1) {
                            $("#time_s_" + i).prop('disabled', false);
                            $("#time_e_" + i).prop('disabled', false);
                        } else {
                            $("#time_s_" + i).prop('disabled', true);
                            $("#time_e_" + i).prop('disabled', true);
                        }
                        if(channel < 12 && channel > 8 || channel < 5){
                            if (res2["load_" + $('.hidden_select_sw_auto').val()]["load_st_" + i] == 1) {
                                $("#time_sL_" + i).prop('disabled', false);
                                $("#time_cy_" + i).prop('disabled', false);
                                $("#time_on1_" + i).prop('disabled', false);
                                $("#time_on2_" + i).prop('disabled', false);
                                $("#time_off1_" + i).prop('disabled', false);
                                $("#time_off2_" + i).prop('disabled', false);
                            }else {
                                $("#time_sL_" + i).prop('disabled', true);
                                $("#time_cy_" + i).prop('disabled', true);
                                $("#time_on1_" + i).prop('disabled', true);
                                $("#time_on2_" + i).prop('disabled', true);
                                $("#time_off1_" + i).prop('disabled', true);
                                $("#time_off2_" + i).prop('disabled', true);
                            }
                        }
                    }
                });

                $("#close_auto_cont").click(function() { // เมนู close การตั้งค่า
                    if($('.sw_mode_timer').hasClass('btn-info') == true){
                        fn_check_auto_timer_save($('.hidden_select_sw_auto').val(), 'close');
                    }else {
                        fn_check_auto_tracking_save('close');
                    }
                });
                $('.sw_sel_load_auto').click(function() { // เลือกโหลด_auto
                    if ($('.menu_config_auto').is(":hidden") == true) {
                        swal({
                            'title': 'ข้อผิดพลาด !',
                            'text': "กรุณาบันทึกหรือยกเลิกการตั้งค่าก่อน !!!",
                            'type': 'warning',
                            'allowOutsideClick': false,
                            'confirmButtonColor': '#32CD32',
                            'confirmButtonText': 'ตกลง',
                        });
                    } else {
                        let numb = $(this).attr('id');
                        if (parseInt(config_cn2['cn_status_' + numb]) == 0) {
                            swal({
                                'title': 'โหลดนี้ไม่ถูกต่อใช้งาน !!!',
                                'text': "กรุณาเลือกโหลดอื่น",
                                'type': 'warning',
                                'allowOutsideClick': false,
                                'confirmButtonColor': '#32CD32',
                                'confirmButtonText': 'ตกลง',
                            });
                        } else {
                            $('.hidden_select_sw_auto').val(numb)
                            fn_df_checkbox_auto(numb);
                            fn_df_logdata_auto(numb);
                            $("#save_auto_cont").hide();
                            if (numb == 12) {
                                $('.L_start').html('ปิดม่าน');
                                $('.L_stop').html('เปิดม่าน');
                            } else {
                                $('.L_start').html('เริ่ม');
                                $('.L_stop').html('สิ้นสุด');
                            }
                        }
                    }
                })
                $('.sw_mode_Auto').click(function() {
                    // alert($(this).hasClass("active"))
                    if ($(this).hasClass("btn-success") == false) {
                        switch_mode('อัตโนมัติ', 'Auto', '', 'mode');
                    }
                });
                $('.sw_mode_Manual').click(function() { // console.log($(this).attr("id"));
                    if ($(this).hasClass("btn-success") == false) {
                        switch_mode('กำหนดเอง', 'Manual', '', 'mode');
                    }
                });
                $('.sw_mode_tracking').click(function(){
                    if($(this).hasClass('btn-info') == false){
                        switch_mode('ตามเซนเซอร์', 'Tracking', '', 'submode');
                    }
                });
                $('.sw_mode_timer').click(function(){
                    if($(this).hasClass('btn-info') == false){
                        switch_mode('ตั้งเวลา', 'Timer', '', 'submode');
                    }
                });
                // Mode_Auto =====================================================
                $('.sw_mode_timeSet').click(function(){
                    if($(this).hasClass('btn-primary') == false){
                        switch_mode('ตั้งเวลาทำงาน', 'Time_set', $('.hidden_select_sw_auto').val(), 'subtimer');
                    }
                });
                $('.sw_mode_timeLoop').click(function(){
                    if($(this).hasClass('btn-primary') == false){
                        switch_mode('โปรแกรมต่อเนื่อง', 'Time_loop', $('.hidden_select_sw_auto').val(), 'subtimer');
                    }
                });
                function switch_mode(sw_name, mess, channel, mode) { // หังก์ชั่นส่งค่าไปยัง mqtt
                    swal({
                        'title': 'เปลี่ยนโหมดการทำงาน !',
                        'text': "คุณต้องการเปลี่ยนเป็นไปใช้โหมด " + sw_name + " ?",
                        'type': 'warning',
                        'allowOutsideClick': false,
                        'showCancelButton': true,
                        'confirmButtonColor': '#32CD32',
                        'cancelButtonColor': '#FF3333',
                        'confirmButtonText': 'ใช่',
                        'cancelButtonText': 'ยกเลิก'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                'type': "POST",
                                'url': "routes/tu/save_config_mqtt.php",
                                'data': {
                                    'house_master': house_master,
                                    'mess': mess,
                                    'channel': channel,
                                    'mode': mode
                                },
                                dataType: 'json',
                                success: function(res) {
                                    // console.log(res)
                                    // return false;
                                    if (res.status == "Insert_Success") {
                                        fn_df_checkbox_auto($('.hidden_select_sw_auto').val());
                                        swal({
                                            'title': 'ส่งข้อมูลสำเร็จ',
                                            'type': 'success',
                                            'allowOutsideClick': false,
                                            'confirmButtonColor': '#32CD32'
                                        });
                                    } else {
                                        swal({
                                            'title': 'Error !',
                                            'text': "เกิดข้อผิดพลาด ?",
                                            'type': 'error',
                                            'allowOutsideClick': false,
                                            'confirmButtonColor': '#32CD32'
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
                // df sw Auto
                function fn_df_checkbox_auto(val) { // switch_เลือกโหลด
                    for (let i = 1; i <= 12; i++) {
                        if (i == val) {
                            if (i <= 4) {
                                $('.title_load_auto').html('น้ำหยด '+i+' '+config_cn2['cn_name_' + i]);
                            }else if (i > 4 && i <= 8) {
                                $('.title_load_auto').html('พัดลม '+(i-4)+' '+config_cn2['cn_name_' + i]);
                            }else if (i > 8 && i <= 10) {
                                $('.title_load_auto').html('พ่นหมอก '+(i-8)+' '+config_cn2['cn_name_' + i]);
                            }else if (i == 11) {
                                $('.title_load_auto').html('สเปรย์ '+config_cn2['cn_name_' + i]);
                            }else if (i == 12) {
                                $('.title_load_auto').html('ม่านพรางแสง');
                            }
                            $("#" + i).addClass('active');
                        } else {
                            $('#' + i).removeClass('active');
                        }
                    }

                    let parseJSON = JSON.parse($('#val_config').val());
                    let sub_mode = parseJSON.sub_mode;
                    if (sub_mode.sub_mode == 'Timer') {
                        $('.sw_mode_tracking').show().removeClass('btn-info').addClass('btn-outline-info');
                        $('.sw_mode_timer').show().addClass('btn-info').removeClass('btn-outline-info');
                        $('.ul_sub_timer').show();
                        $('.ul_sub_sensor').hide();
                        if(val < 5 || val > 8 && val < 12){
                            // alert($('.hidden_select_sw_auto').val())
                            if (sub_mode['sub_mode_'+$('.hidden_select_sw_auto').val()] == 'Time_set') {
                                $('.sw_mode_timeSet').show().addClass('btn-primary').removeClass('btn-outline-primary');
                                $('.sw_mode_timeLoop').show().removeClass('btn-primary').addClass('btn-outline-primary');
                                $('.ul_mode_timeSet').show();
                                $('.ul_mode_timeLoop').hide();
                                $('#view_auto').hide();
                            }
                            else { // Time_loop
                                $('.sw_mode_timeSet').show().removeClass('btn-primary').addClass('btn-outline-primary');
                                $('.sw_mode_timeLoop').show().addClass('btn-primary').removeClass('btn-outline-primary');
                                $('.ul_mode_timeSet').hide();
                                $('.ul_mode_timeLoop').show();
                                $('#view_auto').show();
                            }
                        }
                        else { // load 5 6 7 8 12
                            $('.sw_mode_timeSet').hide();//.addClass('btn-primary').removeClass('btn-outline-primary');
                            $('.sw_mode_timeLoop').hide();//.removeClass('btn-primary').addClass('btn-outline-primary');
                            $('.ul_mode_timeSet').show();
                            $('.ul_mode_timeLoop').hide();
                            $('#view_auto').hide();
                        }
                    }
                    else { // Sensor_Tracking
                        $('.sw_mode_tracking').show().addClass('btn-info').removeClass('btn-outline-info');
                        $('.sw_mode_timer').show().removeClass('btn-info').addClass('btn-outline-info');
                        $('.ul_sub_timer').hide();
                        $('.ul_sub_sensor').show();
                        $('#view_auto').hide();
                    }
                }
                // df input Auto
                function fn_df_logdata_auto(numb) { // input_value
                    let config_parse = JSON.parse($('#val_config').val());
                    let res = config_parse.config_timeSet;
                    // if(numb < 12 && numb > 8 || numb < 5){
                    let res2 = config_parse.config_timeLoop;
                    // }
                    // var res2 = JSON.parse($('#val_sw_auto_time_loop').val());
                    // console.log(config_parse);
                    // return false;
                    let se_data;
                    for (let i = 1; i <= 6; i++) {
                        if (res["load_" + numb]["load_st_" + i] == 1) {
                            $("#swch_" + i).bootstrapToggle('on');
                            $(".img_" + i).attr("src", "public/images/control/switck_on.png");
                            if(res["load_" + numb]["load_s_" + i].length > 5){
                                $("#time_s_" + i).prop('disabled', true).val(res["load_" + numb]["load_s_" + i]);
                            }else {
                                $("#time_s_" + i).prop('disabled', true).val(res["load_" + numb]["load_s_" + i]+':00');
                            }
                            if(res["load_" + numb]["load_e_" + i].length > 5){
                                $("#time_e_" + i).prop('disabled', true).val(res["load_" + numb]["load_e_" + i]);
                            }else {
                                $("#time_e_" + i).prop('disabled', true).val(res["load_" + numb]["load_e_" + i]+':00');
                            }
                        }
                        else {
                            $("#swch_" + i).bootstrapToggle('off');
                            $(".img_" + i).attr("src", "public/images/control/switck_off.png");
                            $("#time_s_" + i).prop('disabled', true).val("");
                            $("#time_e_" + i).prop('disabled', true).val("");
                        }
                        if(numb < 5 || numb > 8 && numb < 12){
                            if (res2["load_" + numb]["load_st_" + i] == 1) {
                                $("#swchL_" + i).bootstrapToggle('on');
                                $(".imgL_" + i).attr("src", "public/images/control/switck_on.png");
                                $("#time_sL_" + i).prop('disabled', true).val(res2["load_" + numb]["load_s_" + i]);
                                $("#time_cy_" + i).prop('disabled', true).val(res2["load_" + numb]["load_cycle_" + i]);
                                if(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[0] > 59){
                                    $("#time_on1_" + i).prop('disabled', true).val( parseInt(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[0]) + parseInt(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[1]) );
                                }else {
                                    if(parseInt(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[1]) == 0){
                                        $("#time_on1_" + i).prop('disabled', true).val("");
                                    }else {
                                        $("#time_on1_" + i).prop('disabled', true).val( parseInt(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[1]) );
                                    }
                                }
                                if(parseInt(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[2]) == 0){
                                    $("#time_on2_" + i).prop('disabled', true).val("");
                                }else {
                                    $("#time_on2_" + i).prop('disabled', true).val( parseInt(moment(res2["load_" + numb]["load_on_" + i] * 1000).format("HH:mm:ss").split(':')[2]) );
                                }
                                if(moment.utc(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[0] > 59){
                                    $("#time_off1_" + i).prop('disabled', true).val( parseInt(moment(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[0]) + parseInt(moment(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[1]) );
                                }else {
                                    if (parseInt(moment(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[1]) == 0) {
                                        $("#time_off1_" + i).prop('disabled', true).val("");
                                    }else{
                                        $("#time_off1_" + i).prop('disabled', true).val( parseInt(moment(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[1]) );
                                    }
                                }
                                if(parseInt(moment(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[2]) == 0){
                                    $("#time_off2_" + i).prop('disabled', true).val("");
                                }else {
                                    $("#time_off2_" + i).prop('disabled', true).val( parseInt(moment(res2["load_" + numb]["load_off_" + i] * 1000).format("HH:mm:ss").split(':')[2]) );
                                }
                                se_data = [];
                                for (let v = 1; v <= res2["load_" + numb]["load_cycle_" + i]; v++) {
                                    if(v == 1){
                                        se_data['s_'+v] = moment(res2["load_" + numb]["load_s_" + i],'HH:mm').format('HH:mm:ss');
                                        se_data['e_'+v] = moment(se_data['s_'+v], 'HH:mm:ss').add(res2["load_" + numb]["load_on_" + i], 'seconds').format('HH:mm:ss');
                                    }else {
                                        se_data['s_'+v] = moment(se_data['e_'+parseFloat(v-1)], 'HH:mm:ss').add(res2["load_" + numb]["load_off_" + i], 'seconds').format('HH:mm:ss');
                                        se_data['e_'+v] = moment(se_data['s_'+v], 'HH:mm:ss').add(res2["load_" + numb]["load_on_" + i], 'seconds').format('HH:mm:ss');
                                    }
                                }
                                $('.span_se_'+i).html('ตั้งเวลา '+i+' เริ่มทำงานเวลา '+se_data['s_1']+' - '+se_data['e_'+res2["load_" + numb]["load_cycle_" + i]]+' น.');
                                // se_data2[i] = se_data;
                                // $('.span_se_'+i).html('ตั้งเวลา '+i+' เริ่มทำงานเวลา '+se_data2[i]['s_1']+' - '+se_data2[i]['e_'+res2["load_" + numb]["load_cycle_" + i]]+' น.');
                            }
                            else {
                                $("#swchL_" + i).bootstrapToggle('off');
                                $(".imgL_" + i).attr("src", "public/images/control/switck_off.png");
                                $("#time_sL_" + i).prop('disabled', true).val("");
                                $("#time_cy_" + i).prop('disabled', true).val("");
                                $("#time_on1_" + i).prop('disabled', true).val("");
                                $("#time_on2_" + i).prop('disabled', true).val("");
                                $("#time_off1_" + i).prop('disabled', true).val("");
                                $("#time_off2_" + i).prop('disabled', true).val("");
                                $('.span_se_'+i).html('ตั้งเวลา '+i+' ปิดใช้งาน');
                            }
                        }
                    }
                }
                // check save Auto
                function fn_check_auto_timer_save(channel, mode) {
                    // alert(moment($("#time_sL_1").val(),'HH:mm').format('HH:mm:ss'))
                    let config_parse = JSON.parse($('#val_config').val());
                    let sub_mode = config_parse.sub_mode;
                    let sw_gd=[], sw = [], cy = [], Ton = [], Toff = [], se_data, df_log = [];
                    if(channel < 12 && channel > 8 || channel < 5){
                        if(sub_mode.sub_mode == "Timer"){
                            if(sub_mode['sub_mode_'+channel] == "Time_set"){
                                sumbmode_timeset();
                            }
                            else { // time_loop
                                let res = config_parse.config_timeLoop;
                                for(let s = 1; s <= 6; s++){
                                    if ($("#swchL_"+s).prop('checked') == true) {
                                        sw[s] = 1;
                                        cy[s] = parseFloat($("#time_cy_"+s).val());
                                        if($("#time_on1_" + s).val() == "" && $("#time_on2_" + s).val() != ""){
                                            Ton[s] = $("#time_on2_" + s).val();
                                        }else if($("#time_on1_" + s).val() != "" && $("#time_on2_" + s).val() == ""){
                                            Ton[s] = $("#time_on1_" + s).val()*60;
                                        }else {
                                            Ton[s] = parseFloat($("#time_on1_" + s).val()*60) + parseFloat($("#time_on2_" + s).val());
                                        }
                                        if($("#time_off1_" + s).val() == "" && $("#time_off2_" + s).val() != ""){
                                            Toff[s] = $("#time_off2_" + s).val();
                                        }else if($("#time_off1_" + s).val() != "" && $("#time_off2_" + s).val() == ""){
                                            Toff[s] = $("#time_off1_" + s).val()*60;
                                        }else {
                                            Toff[s] = parseFloat($("#time_off1_" + s).val()*60) + parseFloat($("#time_off2_" + s).val());
                                        }
                                        se_data = [];
                                        for (let v = 1; v <= parseInt($("#time_cy_"+s).val()); v++) {
                                            if(v == 1){
                                                se_data['s_'+v] = moment($("#time_sL_"+s).val(),'HH:mm').format('HH:mm:ss');
                                                se_data['e_'+v] = moment(se_data['s_'+v], 'HH:mm:ss').add(Ton[s], 'seconds').format('HH:mm:ss');
                                            }else {
                                                se_data['s_'+v] = moment(se_data['e_'+parseFloat(v-1)], 'HH:mm:ss').add(Toff[s], 'seconds').format('HH:mm:ss');
                                                se_data['e_'+v] = moment(se_data['s_'+v], 'HH:mm:ss').add(Ton[s], 'seconds').format('HH:mm:ss');
                                            }
                                        }
                                        $('.span_se_'+s).html('ตั้งเวลา '+s+' เริ่มทำงานเวลา '+se_data['s_1']+' - '+se_data['e_'+parseInt($("#time_cy_"+s).val())]+' น.');
                                    }
                                    else {
                                        sw[s] = 0;
                                        cy[s] = 0;
                                        Ton[s] = "";
                                        Toff[s] = "";
                                        $('.span_se_'+s).html('ตั้งเวลา '+s+' ปิดใช้งาน');
                                    }
                                }
                                let sw_gd2 = {
                                    'load_st_1': sw[1].toString(),
                                    'load_st_2': sw[2].toString(),
                                    'load_st_3': sw[3].toString(),
                                    'load_st_4': sw[4].toString(),
                                    'load_st_5': sw[5].toString(),
                                    'load_st_6': sw[6].toString(),
                                    'load_s_1': $("#time_sL_1").val(),
                                    'load_s_2': $("#time_sL_2").val(),
                                    'load_s_3': $("#time_sL_3").val(),
                                    'load_s_4': $("#time_sL_4").val(),
                                    'load_s_5': $("#time_sL_5").val(),
                                    'load_s_6': $("#time_sL_6").val(),
                                    'load_cycle_1': cy[1].toString(),
                                    'load_cycle_2': cy[2].toString(),
                                    'load_cycle_3': cy[3].toString(),
                                    'load_cycle_4': cy[4].toString(),
                                    'load_cycle_5': cy[5].toString(),
                                    'load_cycle_6': cy[6].toString(),
                                    'load_on_1': Ton[1].toString(),
                                    'load_on_2': Ton[2].toString(),
                                    'load_on_3': Ton[3].toString(),
                                    'load_on_4': Ton[4].toString(),
                                    'load_on_5': Ton[5].toString(),
                                    'load_on_6': Ton[6].toString(),
                                    'load_off_1': Toff[1].toString(),
                                    'load_off_2': Toff[2].toString(),
                                    'load_off_3': Toff[3].toString(),
                                    'load_off_4': Toff[4].toString(),
                                    'load_off_5': Toff[5].toString(),
                                    'load_off_6': Toff[6].toString()
                                };
                                // df_log = res['load_'+channel];
                                let df_log = {
                                    'load_st_1': res['load_'+channel].load_st_1.toString(),
                                    'load_st_2': res['load_'+channel].load_st_2.toString(),
                                    'load_st_3': res['load_'+channel].load_st_3.toString(),
                                    'load_st_4': res['load_'+channel].load_st_4.toString(),
                                    'load_st_5': res['load_'+channel].load_st_5.toString(),
                                    'load_st_6': res['load_'+channel].load_st_6.toString(),
                                    'load_s_1': res['load_'+channel].load_s_1,
                                    'load_s_2': res['load_'+channel].load_s_2,
                                    'load_s_3': res['load_'+channel].load_s_3,
                                    'load_s_4': res['load_'+channel].load_s_4,
                                    'load_s_5': res['load_'+channel].load_s_5,
                                    'load_s_6': res['load_'+channel].load_s_6,
                                    'load_cycle_1': res['load_'+channel].load_cycle_1.toString(),
                                    'load_cycle_2': res['load_'+channel].load_cycle_2.toString(),
                                    'load_cycle_3': res['load_'+channel].load_cycle_3.toString(),
                                    'load_cycle_4': res['load_'+channel].load_cycle_4.toString(),
                                    'load_cycle_5': res['load_'+channel].load_cycle_5.toString(),
                                    'load_cycle_6': res['load_'+channel].load_cycle_6.toString(),
                                    'load_on_1': res['load_'+channel].load_on_1.toString(),
                                    'load_on_2': res['load_'+channel].load_on_2.toString(),
                                    'load_on_3': res['load_'+channel].load_on_3.toString(),
                                    'load_on_4': res['load_'+channel].load_on_4.toString(),
                                    'load_on_5': res['load_'+channel].load_on_5.toString(),
                                    'load_on_6': res['load_'+channel].load_on_6.toString(),
                                    'load_off_1': res['load_'+channel].load_off_1.toString(),
                                    'load_off_2': res['load_'+channel].load_off_2.toString(),
                                    'load_off_3': res['load_'+channel].load_off_3.toString(),
                                    'load_off_4': res['load_'+channel].load_off_4.toString(),
                                    'load_off_5': res['load_'+channel].load_off_5.toString(),
                                    'load_off_6': res['load_'+channel].load_off_6.toString(),
                                };
                                // delete df_log["user_control"];
                                // console.log(JSON.stringify(res['load_' + channel]) +'==='+ JSON.stringify(sw_gd2));
                                // console.log(df_log);
                                // console.log(sw_gd2);
                                // return false;
                                if (mode == 'close') {
                                    if (JSON.stringify(df_log) == JSON.stringify(sw_gd2)) {
                                        $(".img_sw").show();
                                        $('.input_tLoop').prop('disabled', true);
                                        $(".sw_toggle").hide();
                                        $(".menu_config_auto").show();
                                        $("#save_auto_cont").hide();
                                        $("#close_auto_cont").hide();
                                        $(".sw_mode_Auto").attr('disabled', false);
                                        $(".sw_mode_Manual").attr('disabled', false);
                                        $('.sw_mode_tracking').prop('disabled', false)
                                        $('.sw_mode_timer').prop('disabled', false)
                                        $('.sw_mode_timeSet').prop('disabled', true)
                                        $('.sw_mode_timeLoop').prop('disabled', true)
                                        $(".close_modal").show();
                                        for (let i = 1; i <= 6; i++) {
                                            $("#time_sL_" + i).removeClass('is-invalid');
                                            $("#time_cy_" + i).removeClass('is-invalid');
                                            $("#time_on1_" + i).removeClass('is-invalid');
                                            $("#time_on2_" + i).removeClass('is-invalid');
                                            $("#time_off1_" + i).removeClass('is-invalid');
                                            $("#time_off2_" + i).removeClass('is-invalid');
                                        }
                                    } else {
                                        swal({
                                            'title': 'คุณแน่ใจหรือไม่?',
                                            'text': "คุณต้องการยกเลิกการตั้งค่า?",
                                            'type': 'warning',
                                            'allowOutsideClick': false,
                                            'showCancelButton': true,
                                            'confirmButtonColor': '#da3444',
                                            'cancelButtonColor': '#8e8e8e',
                                            'confirmButtonText': 'ยืนยัน',
                                            'cancelButtonText': 'ยกเลิก',
                                        }).then((result) => {
                                            if (result.value) {
                                                $(".img_sw").show();
                                                $('.input_tLoop').removeClass("input_err").prop('disabled', true);
                                                $(".sw_toggle").hide();
                                                $(".menu_config_auto").show();
                                                $(".sw_mode_Auto").attr('disabled', false);
                                                $(".sw_mode_Manual").attr('disabled', false);
                                                $('.sw_mode_tracking').prop('disabled', false)
                                                $('.sw_mode_timer').prop('disabled', false)
                                                $('.sw_mode_timeSet').prop('disabled', true)
                                                $('.sw_mode_timeLoop').prop('disabled', true)
                                                $(".close_modal").show();
                                                fn_df_logdata_auto(channel);
                                                $("#save_auto_cont").hide();
                                                $("#close_auto_cont").hide();
                                                for (let i = 1; i <= 6; i++) {
                                                    $("#time_sL_" + i).removeClass('is-invalid');
                                                    $("#time_cy_" + i).removeClass('is-invalid');
                                                    $("#time_on1_" + i).removeClass('is-invalid');
                                                    $("#time_on2_" + i).removeClass('is-invalid');
                                                    $("#time_off1_" + i).removeClass('is-invalid');
                                                    $("#time_off2_" + i).removeClass('is-invalid');
                                                }
                                            }
                                        });
                                    }
                                }
                                else {
                                    if (JSON.stringify(df_log) == JSON.stringify(sw_gd2)) {
                                        $("#save_auto_cont").hide();
                                    } else {
                                        $("#save_auto_cont").show();
                                    }
                                }
                            }
                        }
                    }
                    else { // channel = 5,6,7,8,12
                        sumbmode_timeset();
                    }
                    function sumbmode_timeset(){
                        let res = config_parse.config_timeSet;
                        for (let i = 1; i <= 6; i++) {
                            if ($("#swch_" + i).prop('checked') == true) {
                                sw_gd['load_st_' + i] = '1';
                                if($("#time_s_" + i).val().length > 5){
                                    sw_gd['load_s_' + i] = $("#time_s_" + i).val();
                                }else {
                                    sw_gd['load_s_' + i] = $("#time_s_" + i).val()+':00';
                                }
                                if($("#time_e_" + i).val().length > 5){
                                    sw_gd['load_e_' + i] = $("#time_e_" + i).val();
                                }else {
                                    sw_gd['load_e_' + i] = $("#time_e_" + i).val()+':00';
                                }
                            }
                            else {
                                sw_gd['load_st_' + i] = '0';
                                sw_gd['load_s_' + i] = "";
                                sw_gd['load_e_' + i] = "";
                            }
                            df_log['load_st_' + i] = res["load_" + channel]["load_st_" + i];
                            if (res["load_" + channel]["load_st_" + i] == 1) {
                                if(res["load_" + channel]["load_s_" + i].length > 5){
                                    df_log['load_s_' + i] = res["load_" + channel]["load_s_" + i];
                                }else {
                                    df_log['load_s_' + i] = res["load_" + channel]["load_s_" + i]+':00';
                                }
                                if(res["load_" + channel]["load_e_" + i].length > 5){
                                    df_log['load_e_' + i] = res["load_" + channel]["load_e_" + i];
                                }else {
                                    df_log['load_e_' + i] = res["load_" + channel]["load_e_" + i]+':00';
                                }
                            }else {
                                df_log['load_s_' + i] = res["load_" + channel]["load_s_" + i];
                                df_log['load_e_' + i] = res["load_" + channel]["load_e_" + i];
                            }
                        }
                        let df_log2 = {
                            'load_st_1': df_log['load_st_1'].toString(),
                            'load_st_2': df_log['load_st_2'].toString(),
                            'load_st_3': df_log['load_st_3'].toString(),
                            'load_st_4': df_log['load_st_4'].toString(),
                            'load_st_5': df_log['load_st_5'].toString(),
                            'load_st_6': df_log['load_st_6'].toString(),
                            'load_s_1': df_log['load_s_1'],
                            'load_s_2': df_log['load_s_2'],
                            'load_s_3': df_log['load_s_3'],
                            'load_s_4': df_log['load_s_4'],
                            'load_s_5': df_log['load_s_5'],
                            'load_s_6': df_log['load_s_6'],
                            'load_e_1': df_log['load_e_1'],
                            'load_e_2': df_log['load_e_2'],
                            'load_e_3': df_log['load_e_3'],
                            'load_e_4': df_log['load_e_4'],
                            'load_e_5': df_log['load_e_5'],
                            'load_e_6': df_log['load_e_6']
                        };
                        let sw_gd2 = {
                            'load_st_1': sw_gd['load_st_1'].toString(),
                            'load_st_2': sw_gd['load_st_2'].toString(),
                            'load_st_3': sw_gd['load_st_3'].toString(),
                            'load_st_4': sw_gd['load_st_4'].toString(),
                            'load_st_5': sw_gd['load_st_5'].toString(),
                            'load_st_6': sw_gd['load_st_6'].toString(),
                            'load_s_1': sw_gd['load_s_1'],
                            'load_s_2': sw_gd['load_s_2'],
                            'load_s_3': sw_gd['load_s_3'],
                            'load_s_4': sw_gd['load_s_4'],
                            'load_s_5': sw_gd['load_s_5'],
                            'load_s_6': sw_gd['load_s_6'],
                            'load_e_1': sw_gd['load_e_1'],
                            'load_e_2': sw_gd['load_e_2'],
                            'load_e_3': sw_gd['load_e_3'],
                            'load_e_4': sw_gd['load_e_4'],
                            'load_e_5': sw_gd['load_e_5'],
                            'load_e_6': sw_gd['load_e_6']
                        };
                        // console.log(df_log2);
                        // console.log(sw_gd2);
                        if (mode == 'close') {
                            if (JSON.stringify(df_log2) == JSON.stringify(sw_gd2)) {
                                $(".img_sw").show();
                                $('.input_tSet').prop('disabled', true);
                                $(".sw_toggle").hide();
                                $(".menu_config_auto").show();
                                $("#save_auto_cont").hide();
                                $("#close_auto_cont").hide();
                                $(".sw_mode_Auto").attr('disabled', false);
                                $(".sw_mode_Manual").attr('disabled', false);
                                $('.sw_mode_tracking').prop('disabled', false)
                                $('.sw_mode_timer').prop('disabled', false)
                                $('.sw_mode_timeSet').prop('disabled', true)
                                $('.sw_mode_timeLoop').prop('disabled', true)
                                $(".close_modal").show();
                                for (var i = 1; i <= 6; i++) {
                                    $('#time_s_' + i).removeClass('is-invalid');
                                    $('#time_e_' + i).removeClass('is-invalid');
                                }
                            }
                            else {
                                swal({
                                    'title': 'คุณแน่ใจหรือไม่?',
                                    'text': "คุณต้องการยกเลิกการตั้งค่า?",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'showCancelButton': true,
                                    'confirmButtonColor': '#da3444',
                                    'cancelButtonColor': '#8e8e8e',
                                    'confirmButtonText': 'ยืนยัน',
                                    'cancelButtonText': 'ยกเลิก',
                                }).then((result) => {
                                    if (result.value) {
                                        $(".img_sw").show();
                                        $('.input_tSet').removeClass("input_err").prop('disabled', true);
                                        $(".sw_toggle").hide();
                                        $(".menu_config_auto").show();
                                        $(".sw_mode_Auto").attr('disabled', false);
                                        $(".sw_mode_Manual").attr('disabled', false);
                                        $('.sw_mode_tracking').prop('disabled', false)
                                        $('.sw_mode_timer').prop('disabled', false)
                                        $('.sw_mode_timeSet').prop('disabled', true)
                                        $('.sw_mode_timeLoop').prop('disabled', true)
                                        $(".close_modal").show();
                                        fn_df_logdata_auto(channel);
                                        $("#save_auto_cont").hide();
                                        $("#close_auto_cont").hide();
                                        for (var i = 1; i <= 6; i++) {
                                            $('#time_s_' + i).removeClass('is-invalid')
                                            $('#time_e_' + i).removeClass('is-invalid')
                                        }
                                    }
                                });
                            }
                        }
                        else {
                            if (JSON.stringify(df_log2) == JSON.stringify(sw_gd2)) {
                                $("#save_auto_cont").hide();
                            } else {
                                $("#save_auto_cont").show();
                            }
                        }
                    }
                }
                $("#save_auto_cont").click(function() {
                    let tracking = JSON.parse($('#val_config').val()).config_tracking;
                    if($('.sw_mode_timer').hasClass('btn-info') == true){
                        let channel = $('.hidden_select_sw_auto').val();
                        let sw=[], cy=[], Ton=[], Toff=[], se_data, se_data2=[], mode, mess;
                        if(channel < 12 && channel > 8 || channel < 5){
                            if($('.sw_mode_timeSet').hasClass('btn-primary') == true){
                                for (let i = 1; i <= 6; i++) {
                                    if ($("#swch_" + i).prop('checked') == true) {
                                        if ($("#time_s_" + i).val() == "") {
                                            $('#time_s_' + i).addClass('is-invalid')
                                            return false;
                                        } else {
                                            $('#time_s_' + i).removeClass('is-invalid')
                                        }
                                        if ($("#time_e_" + i).val() == "") {
                                            $('#time_e_' + i).addClass('is-invalid')
                                            return false;
                                        } else {
                                            $('#time_e_+i').removeClass('is-invalid')
                                        }
                                        // if ($('#12').hasClass('active') == false) {
                                        if ($("#time_s_" + i).val() >= $("#time_e_" + i).val()) {
                                            swal_c('error', 'Error...', 'ตั้งเวลา ' + i + ' : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                                            $('#time_s_' + i).addClass('is-invalid');
                                            $('#time_e_' + i).addClass('is-invalid');
                                            return false;
                                        } else {
                                            $('#time_s_' + i).removeClass('is-invalid')
                                            $('#time_e_' + i).removeClass('is-invalid')
                                        }
                                        // }
                                        sw[i] = 1;
                                    }
                                    else {
                                        sw[i] = 0;
                                    }
                                }
                                mode = 'config_timeSet';
                                mess = {
                                    'load_st_1': sw[1],
                                    'load_st_2': sw[2],
                                    'load_st_3': sw[3],
                                    'load_st_4': sw[4],
                                    'load_st_5': sw[5],
                                    'load_st_6': sw[6],
                                    'load_s_1': $("#time_s_1").val(),
                                    'load_s_2': $("#time_s_2").val(),
                                    'load_s_3': $("#time_s_3").val(),
                                    'load_s_4': $("#time_s_4").val(),
                                    'load_s_5': $("#time_s_5").val(),
                                    'load_s_6': $("#time_s_6").val(),
                                    'load_e_1': $("#time_e_1").val(),
                                    'load_e_2': $("#time_e_2").val(),
                                    'load_e_3': $("#time_e_3").val(),
                                    'load_e_4': $("#time_e_4").val(),
                                    'load_e_5': $("#time_e_5").val(),
                                    'load_e_6': $("#time_e_6").val()
                                };
                            }
                            else { // TLoop;
                                for (let i = 1; i <= 6; i++) {
                                    if ($("#swchL_" + i).prop('checked') == true) {
                                        if ($("#time_sL_" + i).val() == "") {
                                            $('#time_sL_' + i).addClass('is-invalid');
                                            return false;
                                        } else {
                                            $('#time_sL_' + i).removeClass('is-invalid');
                                        }
                                        if($("#time_cy_" + i).val() == "" || $("#time_cy_" + i).val() == 0){
                                            $('#time_cy_' + i).addClass('is-invalid');
                                            return false;
                                        } else {
                                            $('#time_cy_' + i).removeClass('is-invalid');
                                        }
                                        if($("#time_on1_" + i).val() == "" && $("#time_on2_" + i).val() == ""){
                                            $('#time_on1_' + i).addClass('is-invalid');
                                            $('#time_on2_' + i).addClass('is-invalid');
                                            swal_c('error', 'Error...', 'กรุณาระบุเวลาเปิด เป็นนาทีหรือวินาที</b> !');
                                            return false;
                                        } else {
                                            $('#time_on1_' + i).removeClass('is-invalid');
                                            $('#time_on2_' + i).removeClass('is-invalid');
                                        }
                                        if($("#time_off1_" + i).val() == "" && $("#time_off2_" + i).val() == ""){
                                            $('#time_off1_' + i).addClass('is-invalid');
                                            $('#time_off2_' + i).addClass('is-invalid');
                                            swal_c('error', 'Error...', 'กรุณาระบุเวลาปิด เป็นนาทีหรือวินาที</b> !');
                                            return false;
                                        } else {
                                            $('#time_off1_' + i).removeClass('is-invalid');
                                            $('#time_off2_' + i).removeClass('is-invalid');
                                        }
                                        // values
                                        sw[i] = 1;
                                        cy[i] = parseInt($("#time_cy_"+i).val());
                                        if($("#time_on1_" + i).val() == "" && $("#time_on2_" + i).val() != ""){
                                            Ton[i] = $("#time_on2_" + i).val();
                                        }else if($("#time_on1_" + i).val() != "" && $("#time_on2_" + i).val() == ""){
                                            Ton[i] = $("#time_on1_" + i).val()*60;
                                        }else {
                                            Ton[i] = parseFloat($("#time_on1_" + i).val()*60) + parseFloat($("#time_on2_" + i).val());
                                        }
                                        if($("#time_off1_" + i).val() == "" && $("#time_off2_" + i).val() != ""){
                                            Toff[i] = $("#time_off2_" + i).val();
                                        }else if($("#time_off1_" + i).val() != "" && $("#time_off2_" + i).val() == ""){
                                            Toff[i] = $("#time_off1_" + i).val()*60;
                                        }else {
                                            Toff[i] = parseFloat($("#time_off1_" + i).val()*60) + parseFloat($("#time_off2_" + i).val());
                                        }

                                        se_data = [];
                                        for (v = 1; v <= cy[i]; v++) {
                                            if(v == 1){
                                                se_data['s_'+v] = moment($("#time_sL_"+i).val(),'HH:mm').format('DD HH:mm:ss');
                                                se_data['e_'+v] = moment(se_data['s_'+v], 'DD HH:mm:ss').add(Ton[i], 'seconds').format('DD HH:mm:ss');
                                            }else {
                                                se_data['s_'+v] = moment(se_data['e_'+parseFloat(v-1)], 'DD HH:mm:ss').add(Toff[i], 'seconds').format('DD HH:mm:ss');
                                                se_data['e_'+v] = moment(se_data['s_'+v], 'DD HH:mm:ss').add(Ton[i], 'seconds').format('DD HH:mm:ss');
                                            }
                                        }
                                        if(se_data['s_1'].substring(0, 2) != se_data['e_'+cy[i]].substring(0, 2)){
                                            alert(se_data['s_1'].substring(0, 2) +' != '+ se_data['e_'+cy[i]])
                                            swal_c('error', 'Error...', 'ตั้งเวลา ' + i + ' : <b>เวลาจบการทำงาน<br>ต้องไม่เกิน 23:59:59 น. ของวัน</b>!');
                                            return false;
                                        }
                                        console.log(se_data);
                                        se_data2[i] = se_data;
                                    }
                                    else {
                                        sw[i] = 0;
                                        cy[i] = 0;
                                        Ton[i] = "";
                                        Toff[i] = "";
                                    }
                                } // exit_for
                                mode = 'config_timeLoop';
                                mess = {
                                    'load_st_1': sw[1],
                                    'load_st_2': sw[2],
                                    'load_st_3': sw[3],
                                    'load_st_4': sw[4],
                                    'load_st_5': sw[5],
                                    'load_st_6': sw[6],
                                    'load_s_1': $("#time_sL_1").val(),
                                    'load_s_2': $("#time_sL_2").val(),
                                    'load_s_3': $("#time_sL_3").val(),
                                    'load_s_4': $("#time_sL_4").val(),
                                    'load_s_5': $("#time_sL_5").val(),
                                    'load_s_6': $("#time_sL_6").val(),
                                    'load_cycle_1': cy[1],
                                    'load_cycle_2': cy[2],
                                    'load_cycle_3': cy[3],
                                    'load_cycle_4': cy[4],
                                    'load_cycle_5': cy[5],
                                    'load_cycle_6': cy[6],
                                    'load_on_1': Ton[1],
                                    'load_on_2': Ton[2],
                                    'load_on_3': Ton[3],
                                    'load_on_4': Ton[4],
                                    'load_on_5': Ton[5],
                                    'load_on_6': Ton[6],
                                    'load_off_1': Toff[1],
                                    'load_off_2': Toff[2],
                                    'load_off_3': Toff[3],
                                    'load_off_4': Toff[4],
                                    'load_off_5': Toff[5],
                                    'load_off_6': Toff[6]
                                };
                            }
                        }
                        else { // channel = 5,6,7,8,12
                            for (let i = 1; i <= 6; i++) {
                                if ($("#swch_" + i).prop('checked') == true) {
                                    if ($("#time_s_" + i).val() == "") {
                                        $('#time_s_' + i).addClass('is-invalid')
                                        return false;
                                    } else {
                                        $('#time_s_' + i).removeClass('is-invalid')
                                    }
                                    if ($("#time_e_" + i).val() == "") {
                                        $('#time_e_' + i).addClass('is-invalid')
                                        return false;
                                    } else {
                                        $('#time_e_+i').removeClass('is-invalid')
                                    }
                                    // if ($('#12').hasClass('active') == false) {
                                    if ($("#time_s_" + i).val() >= $("#time_e_" + i).val()) {
                                        swal_c('error', 'Error...', 'ตั้งเวลา ' + i + ' : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                                        $('#time_s_1').addClass('is-invalid')
                                        $('#time_e_1').addClass('is-invalid')
                                        return false;
                                    } else {
                                        $('#time_s_' + i).removeClass('is-invalid')
                                        $('#time_e_' + i).removeClass('is-invalid')
                                    }
                                    // }
                                    sw[i] = 1;
                                }
                                else {
                                    sw[i] = 0;
                                }
                            }
                            mode = 'config_timeSet';
                            mess = {
                                'load_st_1': sw[1],
                                'load_st_2': sw[2],
                                'load_st_3': sw[3],
                                'load_st_4': sw[4],
                                'load_st_5': sw[5],
                                'load_st_6': sw[6],
                                'load_s_1': $("#time_s_1").val(),
                                'load_s_2': $("#time_s_2").val(),
                                'load_s_3': $("#time_s_3").val(),
                                'load_s_4': $("#time_s_4").val(),
                                'load_s_5': $("#time_s_5").val(),
                                'load_s_6': $("#time_s_6").val(),
                                'load_e_1': $("#time_e_1").val(),
                                'load_e_2': $("#time_e_2").val(),
                                'load_e_3': $("#time_e_3").val(),
                                'load_e_4': $("#time_e_4").val(),
                                'load_e_5': $("#time_e_5").val(),
                                'load_e_6': $("#time_e_6").val()
                            };
                        }
                        function swal_c(type, title, text) {
                            Swal({
                                'type': type,
                                'title': title,
                                'html': text,
                                'allowOutsideClick': false,
                                'confirmButtonColor': '#FF3333',
                                'confirmButtonText': 'ปิด'
                            });
                        }
                        if(mess['load_st_1'] == 1){
                            if(mess['load_st_2'] == 1){
                                if (check_overlap(1, 2, mode) == 0) { return false; }
                            }
                            if(mess['load_st_3'] == 1){
                                if (check_overlap(1, 3, mode) == 0) { return false; }
                            }
                            if(mess['load_st_4'] == 1){
                                if (check_overlap(1, 4, mode) == 0) { return false; }
                            }
                            if(mess['load_st_5'] == 1){
                                if (check_overlap(1, 5, mode) == 0) { return false; }
                            }
                            if(mess['load_st_6'] == 1){
                                if (check_overlap(1, 6, mode) == 0) { return false; }
                            }
                        }
                        if(mess['load_st_2'] == 1){
                            if(mess['load_st_3'] == 1){
                                if (check_overlap(2, 3, mode) == 0) { return false; }
                            }
                            if(mess['load_st_4'] == 1){
                                if (check_overlap(2, 4, mode) == 0) { return false; }
                            }
                            if(mess['load_st_5'] == 1){
                                if (check_overlap(2, 5, mode) == 0) { return false; }
                            }
                            if(mess['load_st_6'] == 1){
                                if (check_overlap(2, 6, mode) == 0) { return false; }
                            }
                        }
                        if(mess['load_st_3'] == 1){
                            if(mess['load_st_4'] == 1){
                                if (check_overlap(3, 4, mode) == 0) { return false; }
                            }
                            if(mess['load_st_5'] == 1){
                                if (check_overlap(3, 5, mode) == 0) { return false; }
                            }
                            if(mess['load_st_6'] == 1){
                                if (check_overlap(3, 6, mode) == 0) { return false; }
                            }
                        }
                        if(mess['load_st_4'] == 1){
                            if(mess['load_st_5'] == 1){
                                if (check_overlap(4, 5, mode) == 0) { return false; }
                            }
                            if(mess['load_st_6'] == 1){
                                if (check_overlap(4, 6, mode) == 0) { return false; }
                            }
                        }
                        if(mess['load_st_5'] == 1){
                            if(mess['load_st_6'] == 1){
                                if (check_overlap(5, 6, mode) == 0) { return false; }
                            }
                        }
                        function check_overlap(min, max, mode){
                            if (mode == 'config_timeSet') {
                                if ((mess['load_s_'+min] < mess['load_s_'+max]) && (mess['load_s_'+min] < mess['load_e_'+max]) && (mess['load_e_'+min] < mess['load_s_'+max]) && (mess['load_e_'+min] < mess['load_e_'+max])) {
                                    // if(mess['load_e_'+min] >)
                                    return 1;
                                }else if ((mess['load_s_'+min] > mess['load_s_'+max]) && (mess['load_s_'+min] > mess['load_e_'+max]) && (mess['load_e_'+min] > mess['load_s_'+max]) && (mess['load_e_'+min] > mess['load_e_'+max])) {
                                    return 1;
                                }else {
                                    swal_c('error', 'Error...', '<b>ตั้งเวลา '+min+' เวลาทับซ้อนกับ ตั้งเวลา '+max+'</b> !');
                                    return 0;
                                }
                            }
                            else {
                                // console.log('min1 '+se_data2[min]['s_1']+' max1 '+se_data2[min]['e_'+mess['load_cycle_'+min]]+' <br> min2 '+se_data2[max]['s_1']+' max2 '+se_data2[max]['e_'+mess['load_cycle_'+max]])
                                if (
                                    (se_data2[min]['s_1'] < se_data2[max]['s_1']) &&
                                    (se_data2[min]['s_1'] < se_data2[max]['e_'+mess['load_cycle_'+max]]) &&
                                    (se_data2[min]['e_'+mess['load_cycle_'+min]] < se_data2[max]['s_1']) &&
                                    (se_data2[min]['e_'+mess['load_cycle_'+min]] < se_data2[max]['e_'+mess['load_cycle_'+max]])
                                ) {
                                    return 1;
                                }else if (
                                    (se_data2[min]['s_1'] > se_data2[max]['s_1']) &&
                                    (se_data2[min]['s_1'] > se_data2[max]['e_'+mess['load_cycle_'+max]]) &&
                                    (se_data2[min]['e_'+mess['load_cycle_'+min]] > se_data2[max]['s_1']) &&
                                    (se_data2[min]['e_'+mess['load_cycle_'+min]] > se_data2[max]['e_'+mess['load_cycle_'+max]])
                                ) {
                                    return 1;
                                }else {
                                    swal_c('error', 'Error...', '<b>ตั้งเวลา '+min+' เวลาทับซ้อนกับ ตั้งเวลา '+max+'</b> !');
                                    return 0;
                                }
                            }
                        }
                        swal({
                            'title': 'บันทึกการเปลี่ยนแปลง',
                            'text': "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                            'type': 'warning',
                            'allowOutsideClick': false,
                            'showCancelButton': true,
                            'confirmButtonColor': '#32CD32',
                            'cancelButtonColor': '#FF3333',
                            'confirmButtonText': 'ใช่',
                            'cancelButtonText': 'ยกเลิก'
                        }).
                        then((result) => {
                            if (result.value) {
                                // console.log(mess);
                                // return false
                                $.ajax({
                                    'type': "POST",
                                    'url': "routes/tu/save_config_mqtt.php",
                                    'data': {
                                        'house_master': house_master,
                                        'mess': mess,
                                        'channel': channel,
                                        'mode': mode
                                    },
                                    dataType: 'json',
                                    success: function(res) {
                                        console.log(res)
                                        if (res.status == "Insert_Success") {
                                            fn_df_checkbox_auto($('.hidden_select_sw_auto').val());
                                            $(".img_sw").show();
                                            $(".sw_toggle").hide();
                                            $("#close_auto_cont").hide();
                                            $(".sw_mode_Auto").attr('disabled', false);
                                            $(".sw_mode_Manual").attr('disabled', false);
                                            $('.sw_mode_tracking').prop('disabled', false)
                                            $('.sw_mode_timer').prop('disabled', false)
                                            $('.sw_mode_timeSet').prop('disabled', true)
                                            $('.sw_mode_timeLoop').prop('disabled', true)
                                            $(".close_modal").show();
                                            // return false;
                                            // for (var i = 1; i <= 6; i++) {
                                            //     if ($("#swch_" + i).prop('checked') == true) {
                                            //         $(".img_" + i).attr("src", "public/images/control/switck_on.png");
                                            //     } else {
                                            //         $(".img_" + i).attr("src", "public/images/control/switck_off.png");
                                            //     }
                                            //     if(channel < 12 && channel > 8 || channel < 5){
                                            //         if ($("#swchL_" + i).prop('checked') == true) {
                                            //             $(".imgL_" + i).attr("src", "public/images/control/switck_on.png");
                                            //         } else {
                                            //             $(".imgL_" + i).attr("src", "public/images/control/switck_off.png");
                                            //         }
                                            //     }
                                            // }
                                            swal({
                                                'title': 'บันทึกข้อมูลสำเร็จ',
                                                'type': 'success',
                                                'allowOutsideClick': false,
                                                'confirmButtonColor': '#32CD32'
                                            });
                                        }
                                        else {
                                            swal({
                                                'title': 'Error !',
                                                'text': "เกิดข้อผิดพลาด ?",
                                                'type': 'error',
                                                'allowOutsideClick': false,
                                                'confirmButtonColor': '#32CD32'
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
                    else{ // Sensor_Tracking
                        let sw_1, drip_1, drip_2, drip_3, drip_4;
                        if($('#swST_1').prop('checked') == true){
                            sw_1 = 1;
                            if($('.check_d_1').prop('checked') == true){ drip_1 = 'ON'; }else { drip_1 = 'OFF'; }
                            if($('.check_d_2').prop('checked') == true){ drip_2 = 'ON'; }else { drip_2 = 'OFF'; }
                            if($('.check_d_3').prop('checked') == true){ drip_3 = 'ON'; }else { drip_3 = 'OFF'; }
                            if($('.check_d_4').prop('checked') == true){ drip_4 = 'ON'; }else { drip_4 = 'OFF'; }
                        }
                        else {
                            sw_1 = 0;
                            drip_1 = tracking.dripper_1;
                            drip_2 = tracking.dripper_2;
                            drip_3 = tracking.dripper_3;
                            drip_4 = tracking.dripper_4;
                        }
                        let sw_2, fg_1, fg_2, spr;
                        if($('#swST_2').prop('checked') == true){
                            sw_2 = 1;
                            if (parseInt(config_cn2.cn_status_9) == 1) { fg_1 = 'ON'; }else { fg_1 = 'OFF'; }
                            fg_2 = 'OFF'; // if (parseInt(config_cn2.cn_status_10) == 1) {var fg_2 = 'ON'; }else { var fg_2 = 'OFF'; }
                            if (parseInt(config_cn2.cn_status_11) == 1) { spr = 'ON'; }else { spr = 'OFF'; }
                        }
                        else {
                            sw_2 = 0;
                            fg_1 = tracking.foggy_1;
                            fg_2 = tracking.foggy_2;
                            spr = tracking.spray;
                        }
                        let sw_3, fn_1, fn_2, fn_3, fn_4
                        if($('#swST_3').prop('checked') == true){
                            sw_3 = 1;
                            if($('.check_fn_1').prop('checked') == true){ fn_1 = 'ON'; }else { fn_1 = 'OFF'; }
                            if($('.check_fn_2').prop('checked') == true){ fn_2 = 'ON'; }else { fn_2 = 'OFF'; }
                            if($('.check_fn_3').prop('checked') == true){ fn_3 = 'ON'; }else { fn_3 = 'OFF'; }
                            if($('.check_fn_4').prop('checked') == true){ fn_4 = 'ON'; }else { fn_4 = 'OFF'; }
                        }
                        else {
                            sw_3 = 0;
                            fn_1 = tracking.fan_1;
                            fn_2 = tracking.fan_2;
                            fn_3 = tracking.fan_3;
                            fn_4 = tracking.fan_4;
                        }
                        let sw_4, shr
                        if($('#swST_4').prop('checked') == true){
                            sw_4 = 1;
                            if (parseInt(config_cn2.cn_status_12) == 1) { shr = 'ON'; }else { shr = 'OFF'; }
                        }
                        else {
                            sw_4 = 0;
                            shr = tracking.shading;
                        }
                        let Rmx1 = $(".range_soil").val().split(";");
                        let Rmx2 = $(".range_hum").val().split(";");
                        let Rmx3 = $(".range_temp").val().split(";");
                        let Rmx4 = $(".range_light").val().split(";");
                        if(Number(sw_2) == 1){
                            if(Number(Rmx2[0]) > Number($('.text_chum2').val()) || Number(Rmx2[1]) < Number($('.text_chum2').val())){
                                $('.text_chum2').addClass('is-invalid');
                                return false;
                            }
                        }
                        $('.text_chum2').removeClass('is-invalid');
                        swal({
                            'title': 'บันทึกการเปลี่ยนแปลง',
                            'text': "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                            'type': 'warning',
                            'allowOutsideClick': false,
                            'showCancelButton': true,
                            'confirmButtonColor': '#32CD32',
                            'cancelButtonColor': '#FF3333',
                            'confirmButtonText': 'ใช่',
                            'cancelButtonText': 'ยกเลิก'
                        }).
                        then((result) => {
                            if (result.value) {
                                let newl_min, newl_max
                                if(control_V == 1){
                                    if(parseInt(config_sn.sn_sensor_6) == 5){
                                        newl_min = ((Rmx4[0]*54)/1000).toFixed();
                                        newl_max = ((Rmx4[1]*54)/1000).toFixed();
                                    }else {
                                        newl_min = Rmx4[0];
                                        newl_max = Rmx4[1];
                                    }
                                }
                                else { // V อ.อร
                                    newl_min = ((Rmx4[0]*54)/1000).toFixed();
                                    newl_max = ((Rmx4[1]*54)/1000).toFixed();
                                }
                                let new_data = {
                                    "status_1": Number(sw_1),
                                    "status_2": Number(sw_2),
                                    "status_3": Number(sw_3),
                                    "status_4": Number(sw_4),
                                    "soil_min": Number(Rmx1[0]),
                                    "soil_max": Number(Rmx1[1]),
                                    "hum_min":  Number(Rmx2[0]),
                                    "hum_max":  Number(Rmx2[1]),
                                    "hum_max2": Number($('.text_chum2').val()),
                                    "temp_min": Number(Rmx3[0]),
                                    "temp_max": Number(Rmx3[1]),
                                    "light_min":Number(newl_min),
                                    "light_max":Number(newl_max),
                                    "dripper_1":drip_1,
                                    "dripper_2":drip_2,
                                    "dripper_3":drip_3,
                                    "dripper_4":drip_4,
                                    "fan_1":    fn_1,
                                    "fan_2":    fn_2,
                                    "fan_3":    fn_3,
                                    "fan_4":    fn_4,
                                    "foggy_1":  fg_1,
                                    "foggy_2":  fg_2,
                                    "spray":    spr,
                                    "shading":  shr,
                                    "light_in_mode": Number(config_sn.sn_sensor_6)
                                };
                                // console.log(JSON.stringify(new_data));
                                // return false;
                                $.ajax({
                                    'type': "POST",
                                    'url': "routes/tu/save_config_mqtt.php",
                                    'data': {
                                        'house_master': house_master,
                                        'mess': new_data,
                                        'channel': '',
                                        'mode': 'Sensor_Tracking'
                                    },
                                    'dataType': 'json',
                                    success: function(res) {
                                        console.log(res)
                                        if (res.status == "Insert_Success") {
                                            $('.menu_config_auto2').show();
                                            range_auto_mode('dash', new_data);
                                            $(".sw_mode_Auto").attr('disabled', false);
                                            $(".sw_mode_Manual").attr('disabled', false);
                                            $('.sw_mode_tracking').prop('disabled', false)
                                            $('.sw_mode_timer').prop('disabled', false)
                                            $('.sw_mode_timeSet').prop('disabled', true)
                                            $('.sw_mode_timeLoop').prop('disabled', true)
                                            $(".close_modal").show();
                                            $("#close_auto_cont").hide();
                                            $("#save_auto_cont").hide();
                                            swal({
                                                title: 'บันทึกข้อมูลสำเร็จ',
                                                type: 'success',
                                                allowOutsideClick: false,
                                                confirmButtonColor: '#32CD32'
                                            });
                                        }
                                        else {
                                            swal({
                                                'title': 'Error !',
                                                'text': "เกิดข้อผิดพลาด ?",
                                                'type': 'error',
                                                'allowOutsideClick': false,
                                                'confirmButtonColor': '#32CD32'
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
                $('#view_auto').click(function() {
                    let channel = $('.hidden_select_sw_auto').val();
                    let name, sw = [], Ton = [], Toff = [], se_data, se_data2 = [], n_data = [];
                    for (let i = 1; i <= 6; i++) {
                        if ($("#swchL_" + i).prop('checked') == true) {
                            sw[i] = 1;
                            if($("#time_on1_" + i).val() == "" && $("#time_on2_" + i).val() != ""){
                                Ton[i] = $("#time_on2_" + i).val();
                            }else if($("#time_on1_" + i).val() != "" && $("#time_on2_" + i).val() == ""){
                                Ton[i] = $("#time_on1_" + i).val()*60;
                            }else {
                                Ton[i] = parseFloat($("#time_on1_" + i).val()*60) + parseFloat($("#time_on2_" + i).val());
                            }
                            if($("#time_off1_" + i).val() == "" && $("#time_off2_" + i).val() != ""){
                                Toff[i] = $("#time_off2_" + i).val();
                            }else if($("#time_off1_" + i).val() != "" && $("#time_off2_" + i).val() == ""){
                                Toff[i] = $("#time_off1_" + i).val()*60;
                            }else {
                                Toff[i] = parseFloat($("#time_off1_" + i).val()*60) + parseFloat($("#time_off2_" + i).val());
                            }

                            se_data = [];
                            for (v = 1; v <= parseInt($("#time_cy_"+i).val()); v++) {
                                if(v == 1){
                                    se_data['s_'+v] = moment($("#time_sL_"+i).val(),'HH:mm').format('HH:mm:ss');
                                    se_data['e_'+v] = moment(se_data['s_'+v], 'HH:mm:ss').add(Ton[i], 'seconds').format('HH:mm:ss');
                                }else {
                                    se_data['s_'+v] = moment(se_data['e_'+parseFloat(v-1)], 'HH:mm:ss').add(Toff[i], 'seconds').format('HH:mm:ss');
                                    se_data['e_'+v] = moment(se_data['s_'+v], 'HH:mm:ss').add(Ton[i], 'seconds').format('HH:mm:ss');
                                }
                            }
                            se_data2[i] = se_data;
                        }
                        else {
                            sw[i] = 0;
                        }
                    } // exit_for
                    if(channel == 1){ name = 'น้ำหยด 1'; }
                    if(channel == 2){ name = 'น้ำหยด 2'; }
                    if(channel == 3){ name = 'น้ำหยด 3'; }
                    if(channel == 4){ name = 'น้ำหยด 4'; }
                    if(channel == 9){ name = 'พ่นหมอก 1'; }
                    if(channel == 10){ name = 'พ่นหมอก 2'; }
                    if(channel == 11){ name = 'สเปรย์'; }
                    for(let i = 1; i < 7; i++){
                        if(sw[i] == 1){
                            n_data.push('<span>ตั้งเวลา '+i+' : </span><br>');
                            for(let s = 1; s <=  parseInt($("#time_cy_"+i).val()); s++){
                                if (s == parseInt($("#time_cy_"+i).val())) {
                                    n_data.push('<span>เปิด '+se_data2[i]['s_'+s]+'&nbsp;&nbsp;&nbsp;&nbsp;ปิด '+se_data2[i]['e_'+s]+'</span><hr>');
                                }else {
                                    n_data.push('<span>เปิด '+se_data2[i]['s_'+s]+'&nbsp;&nbsp;&nbsp;&nbsp;ปิด '+se_data2[i]['e_'+s]+'</span><br>');
                                }
                            }
                        }else {
                                n_data.push('<span>ตั้งเวลา '+i+' : ปิดใช้งาน</span><hr>');
                        }
                    }
                    // console.log(n_data);
                    Swal({
                        // type: type,
                        'title': 'เวลาทำงานของ '+name,
                        'html': n_data.join(' '),
                        'allowOutsideClick': false,
                        'confirmButtonColor': '#FF3333',
                        'confirmButtonText': 'ปิด'
                    });
                });

                $('.input_tL').click(function(){
                    let val = $(this).val(), id = $(this).attr('id'), val_h, val_m, ntime_h, ntime_m;
                    // alert(val)
                    if (val == '') {
                        val_h = moment(new Date()).format('HH')//.split(":")[0];
                        val_m = moment(new Date()).format('mm')//.split(":")[1];
                    }else {
                        val_h = moment(val, 'HH:mm').format('HH')//val.split(":")[0];
                        val_m = moment(val, 'HH:mm').format('mm')//val.split(":")[1];
                    }
                    // var list_oh = [];
                    // for(var i = 0; i < 24; i++){
                    //     list_oh.push('<option value="'+i+'">');
                    // }
                    $('#Modal_control').modal('hide')
                    Swal.fire({
                        title: '<strong><b>ตั้งเวลา</b><br><i class="fadeIn animated bx bx-time" style="font-size:5em;"></i></strong>',
                        html://'<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/></svg>'+
                        '<div class="input-group">'+
                            // '<input class="input-group-text form-control" type="text" readonly value="ระบุเวลา">'+
                            '<input type="number" class="form-control text-center" id="time_h" placeholder="ชั่วโมง" min="0" max="23" value="'+val_h+'" onchange="if(Math.round(this.value) > 23){this.value = 23;}else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }">'+// style="background-color: #fff; text-color: #191919">'+
                            // '<option id="list_h">'+
                            //     list_oh.join(" ")+
                            //     // '<option value="0">'+
                            //   '</option>'+
                            '<span class="input-group-text">:</span>'+
                            '<input type="number" class="form-control text-center" id="time_m" placeholder="นาที" min="0" max="59" value="'+val_m+'" onchange="if(Math.round(this.value) > 59){this.value = 59;}else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }">'+ //style="background-color: #fff; text-color: #191919">'+
                            // '<span class="input-group-text">:</span>'+
                            // '<input type="number" class="form-control text-center" id="time_s" placeholder="วินาที"  min="0" max="59"  onchange="if(Math.round(this.value) > 59 ){this.value = 59; }else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }">'+ //style="background-color: #fff; text-color: #191919"">'+// <span class="input-group-text"></span>'+
                        '</div><br>',
                        // '<input list="list_h" id="time_h"> : <input list="ice-cream-flavors" id="time_m"> : <input list="list_h" id="time_s">'+
                        // '<datalist id="ice-cream-flavors"><option value="Chocolate"><option value="Coconut"><option value="Mint"><option value="Strawberry"><option value="Vanilla"></datalist>',
                        'allowOutsideClick': false,
                        'showCancelButton': true,
                        'confirmButtonColor': '#32CD32',
                        'cancelButtonColor': '#FF3333',
                        'confirmButtonText': 'ตกลง',
                        'cancelButtonText': 'ยกเลิก',
                        'focusConfirm': false,
                        preConfirm: () => {
                            const time_h = Swal.getPopup().querySelector('#time_h').value
                            const time_m = Swal.getPopup().querySelector('#time_m').value
                            // const time_s = Swal.getPopup().querySelector('#time_s').value
                            if (!time_h) {
                                Swal.showValidationMessage(`กรุณาระบุชั่วโมง`)
                            }
                            else if (!time_m) {
                                Swal.showValidationMessage(`กรุณาระบุนาที`)
                            }
                            else {
                                if(time_h.length == 1){ ntime_h = '0'+time_h; }else { ntime_h = time_h; }
                                if(time_m.length == 1){ ntime_m = '0'+time_m; }else { ntime_m = time_m; }
                                return { time_h: ntime_h, time_m: ntime_m }
                            }
                        }
                    }).
                    then((result) => {
                        // alert(Swal.DismissReason.cancel)
                        // console.log(result)
                        if (result.value) {
                            $('#'+id).val(result.value.time_h+':'+result.value.time_m);
                            $('#Modal_control').modal('show')
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            $('#Modal_control').modal('show')
                        }
                        fn_check_auto_timer_save($('.hidden_select_sw_auto').val(), '');
                    });
                    if($("html").hasClass('dark-theme') == true){
                        $(".swal2-modal").css('background-color', '#21214bf3');
                        $(".swal2-title").css('color', '#e4e5e6');
                    }
                });
                $('.input_tSet').click(function(){
                    let val = $(this).val(), id = $(this).attr('id'), val_h, val_m, ntime_h, ntime_m, ntime_s;
                    // alert(val)
                    if (val == '') {
                        val_h = moment(new Date()).format('HH')//.split(":")[0];
                        val_m = moment(new Date()).format('mm')//.split(":")[1];
                        val_s = '00'//moment(new Date()).format('HH:mm:ss').split(":")[2];
                    }else {
                        val_h = moment(val, 'HH:mm:ss').format('HH')//val.split(":")[0];
                        val_m = moment(val, 'HH:mm:ss').format('mm')//val.split(":")[1];
                        val_s = moment(val, 'HH:mm:ss').format('ss')//val.split(":")[2];
                    }
                    // var list_oh = [];
                    // for(var i = 0; i < 24; i++){
                    //     list_oh.push('<option value="'+i+'">');
                    // }
                    $('#Modal_control').modal('hide')
                    Swal.fire({
                        title: '<strong><b>ตั้งเวลา</b><br><i class="fadeIn animated bx bx-time" style="font-size:5em;"></i></strong>',
                        html://'<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/></svg>'+
                        '<div class="input-group">'+
                            // '<input class="input-group-text form-control" type="text" readonly value="ระบุเวลา">'+
                            '<input type="number" class="form-control text-center" id="time_h" placeholder="ชั่วโมง" min="0" max="23" value="'+val_h+'" onchange="if(Math.round(this.value) > 23){this.value = 23;}else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }">'+// style="background-color: #fff; text-color: #191919">'+
                            // '<option id="list_h">'+
                            //     list_oh.join(" ")+
                            //     // '<option value="0">'+
                            //   '</option>'+
                            '<span class="input-group-text">:</span>'+
                            '<input type="number" class="form-control text-center" id="time_m" placeholder="นาที" min="0" max="59" value="'+val_m+'" onchange="if(Math.round(this.value) > 59){this.value = 59;}else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }">'+ //style="background-color: #fff; text-color: #191919">'+
                            '<span class="input-group-text">:</span>'+
                            '<input type="number" class="form-control text-center" id="time_s" placeholder="วินาที"  min="0" max="59" value="'+val_s+'" onchange="if(Math.round(this.value) > 59 ){this.value = 59; }else if(this.value < 0){this.value = 0;}else { this.value = Math.round(this.value); }">'+ //style="background-color: #fff; text-color: #191919"">'+// <span class="input-group-text"></span>'+
                        '</div><br>',
                        // '<input list="list_h" id="time_h"> : <input list="ice-cream-flavors" id="time_m"> : <input list="list_h" id="time_s">'+
                        // '<datalist id="ice-cream-flavors"><option value="Chocolate"><option value="Coconut"><option value="Mint"><option value="Strawberry"><option value="Vanilla"></datalist>',
                        'allowOutsideClick': false,
                        'showCancelButton': true,
                        'confirmButtonColor': '#32CD32',
                        'cancelButtonColor': '#FF3333',
                        'confirmButtonText': 'ตกลง',
                        'cancelButtonText': 'ยกเลิก',
                        'focusConfirm': false,
                        preConfirm: () => {
                            const time_h = Swal.getPopup().querySelector('#time_h').value
                            const time_m = Swal.getPopup().querySelector('#time_m').value
                            const time_s = Swal.getPopup().querySelector('#time_s').value
                            if (!time_h) {
                                Swal.showValidationMessage(`กรุณาระบุชั่วโมง`)
                            }
                            else if (!time_m) {
                                Swal.showValidationMessage(`กรุณาระบุนาที`)
                            }
                            else {
                                if(time_h.length == 1){ ntime_h = '0'+time_h; }else { ntime_h = time_h; }
                                if(time_m.length == 1){ ntime_m = '0'+time_m; }else { ntime_m = time_m; }
                                if(time_s == ''){ ntime_s = '00'; }else {
                                    ntime_s = time_s;
                                    if(time_s.length == 1){ ntime_s = '0'+time_s; }else { ntime_s = time_s; }
                                }
                                return { 'time_h': ntime_h, 'time_m': ntime_m, 'time_s': ntime_s}
                            }
                        }
                    }).then((result) => {
                        // alert(Swal.DismissReason.cancel)
                        // console.log(result)
                        if (result.value) {
                            $('#'+id).val(result.value.time_h+':'+result.value.time_m+':'+result.value.time_s);
                            $('#Modal_control').modal('show')
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            $('#Modal_control').modal('show')
                        }
                        fn_check_auto_timer_save($('.hidden_select_sw_auto').val(), '');
                    });
                    if($("html").hasClass('dark-theme') == true){
                        $(".swal2-modal").css('background-color', '#21214bf3');
                        $(".swal2-title").css('color', '#e4e5e6');
                    }
                });

                $('.input_check').change(function() { // bootstrap_switch
                    let input_num = this.id.split("_");
                    let config_parse = JSON.parse($('#val_config').val());
                    let res = config_parse.config_timeSet;
                    let channel = $('.hidden_select_sw_auto').val();
                    let res2
                    if(channel < 12 && channel > 8 || channel < 5){
                        res2 = config_parse.config_timeLoop;
                    }
                    // return false;
                    if(input_num[0] == 'swch'){
                        if ($(this).prop('checked') == true) {
                            $("#time_s_" + input_num[1]).prop('disabled', false).val(res["load_" + $('.hidden_select_sw_auto').val()]["load_s_" + input_num[1]]).removeClass('is-invalid');
                            $("#time_e_" + input_num[1]).prop('disabled', false).val(res["load_" + $('.hidden_select_sw_auto').val()]["load_e_" + input_num[1]]).removeClass('is-invalid');
                        } else {
                            $("#time_s_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                            $("#time_e_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                        }
                        fn_check_auto_timer_save($('.hidden_select_sw_auto').val(), '');
                    }
                    else if (input_num[0] == 'swchL') {
                        if ($(this).prop('checked') == true) {
                            $("#time_sL_" + input_num[1]).prop('disabled', false).val(res2["load_" + $('.hidden_select_sw_auto').val()]["load_s_" + input_num[1]]).removeClass('is-invalid');
                            if(res2["load_" + $('.hidden_select_sw_auto').val()]["load_cycle_" + input_num[1]] == 0){
                                $("#time_cy_" + input_num[1]).prop('disabled', false).val(1).removeClass('is-invalid');
                            }else {
                                $("#time_cy_" + input_num[1]).prop('disabled', false).val(res2["load_" + $('.hidden_select_sw_auto').val()]["load_cycle_" + input_num[1]]).removeClass('is-invalid');
                            }
                            $("#time_on1_" + input_num[1]).prop('disabled', false).val(res2["load_" + $('.hidden_select_sw_auto').val()]["load_on_" + input_num[1]]).removeClass('is-invalid');
                            $("#time_on2_" + input_num[1]).prop('disabled', false).val(res2["load_" + $('.hidden_select_sw_auto').val()]["load_on_" + input_num[1]]).removeClass('is-invalid');
                            $("#time_off1_" + input_num[1]).prop('disabled', false).val(res2["load_" + $('.hidden_select_sw_auto').val()]["load_off_" + input_num[1]]).removeClass('is-invalid');
                            $("#time_off2_" + input_num[1]).prop('disabled', false).val(res2["load_" + $('.hidden_select_sw_auto').val()]["load_off_" + input_num[1]]).removeClass('is-invalid');
                        }else {
                            $("#time_sL_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                            $("#time_cy_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                            $("#time_on1_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                            $("#time_on2_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                            $("#time_off1_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                            $("#time_off2_" + input_num[1]).prop('disabled', true).val("").removeClass('is-invalid');
                        }
                        fn_check_auto_timer_save($('.hidden_select_sw_auto').val(), '');
                    }
                });
                // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                $('.menu_config_auto2').show();
                range_auto_mode('dash');
                function range_auto_mode(mode, set_config) {
                    let tracking, de, ndde, nfgde, nfde, ched_1, dis_1, val_1, ched_2, dis_2, val_2, ched_3, dis_3, val_3, ched_4, dis_4, val_4
                    if(typeof(set_config) == "undefined" && set_config === null) {
                        tracking = set_config;
                    }else {
                        tracking = JSON.parse($('#val_config').val()).config_tracking;
                    }
                    console.log(tracking);
                    if(mode == 'dash'){
                        de = true;
                        $('.img_swST').show();
                        $('.sw_toggleST').hide();
                    }
                    else {
                        de = false;
                        $('.img_swST').hide();
                        $('.sw_toggleST').show();
                    }
                    for(let i = 1; i <= 4; i++){
                        if (parseInt(tracking['status_'+i]) == 1) {
                            $('.imgST_'+i).attr("src", "public/images/control/switck_on.png");
                            $('#swST_'+i).bootstrapToggle('on');
                        }
                        else {
                            $('.imgST_'+i).attr("src", "public/images/control/switck_off.png");
                            $('#swST_'+i).bootstrapToggle('off');
                        }
                    }

                    // dripper
                    if (parseInt(tracking['status_1']) == 1) {
                        ndde = de;
                        if (parseInt(config_cn2['cn_status_1']) == 1) {
                            if(tracking['dripper_1'] == 'ON'){
                                ched_1 = true, dis_1 = de, val_1 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                            }else {
                                ched_1 = false, dis_1 = de, val_1 = 'ปิด';
                            }
                        }
                        else {
                            ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                        }
                        if (parseInt(config_cn2['cn_status_2']) == 1) {
                            if(tracking['dripper_2'] == 'ON'){
                                ched_2 = true, dis_2 = de, val_2 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                            }else {
                                ched_2 = false, dis_2 = de, val_2 = 'ปิด';
                            }
                        }
                        else {
                            ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                        }
                        if (parseInt(config_cn2['cn_status_3']) == 1) {
                            if(tracking['dripper_3'] == 'ON'){
                                ched_3 = true, dis_3 = de, val_3 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                            }else {
                                ched_3 = false, dis_3 = de, val_3 = 'ปิด';
                            }
                        }
                        else {
                            ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                        }
                        if (parseInt(config_cn2['cn_status_4']) == 1) {
                            if(tracking['dripper_4'] == 'ON'){
                                ched_4 = true, dis_4 = de, val_4 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                            }else {
                                ched_4 = false, dis_4 = de, val_4 = 'ปิด';
                            }
                        }
                        else {
                            ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                        }
                    }
                    else {
                        ndde = true;
                        ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                        ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                        ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                        ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                    }
                    $('.check_d_1').prop({'checked': ched_1,'disabled': dis_1});
                    $('.check_d_2').prop({'checked': ched_2,'disabled': dis_2});
                    $('.check_d_3').prop({'checked': ched_3,'disabled': dis_3});
                    $('.check_d_4').prop({'checked': ched_4,'disabled': dis_4});
                    range_instance1.update({
                        min: 0,
                        max: 100,
                        from: tracking.soil_min,
                        to: tracking.soil_max,
                        disable: ndde
                    });
                    // foggy
                    if (parseInt(tracking['status_2']) == 1) { nfgde = de; }
                    else { nfgde = true; }
                    range_instance2.update({
                        min: 0,
                        max: 100,
                        from: tracking.hum_min,
                        to: tracking.hum_max,
                        disable: nfgde
                    });
                    $('.text_chum2').val(tracking.hum_max2).prop({'disabled': nfgde});
                    // FAN
                    if (parseInt(tracking['status_3']) == 1) {
                        nfde = de;
                        if (parseInt(config_cn2['cn_status_5']) == 1) {
                            if(tracking['fan_1'] == 'ON'){
                                ched_1 = true, dis_1 = de, val_1 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                            }else {
                                ched_1 = false, dis_1 = de, val_1 = 'ปิด';
                            }
                        }
                        else {
                            ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                        }
                        if (parseInt(config_cn2['cn_status_6']) == 1) {
                            if(tracking['fan_2'] == 'ON'){
                                ched_2 = true, dis_2 = de, val_2 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                            }else {
                                ched_2 = false, dis_2 = de, val_2 = 'ปิด';
                            }
                        }
                        else {
                            ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                        }
                        if (parseInt(config_cn2['cn_status_7']) == 1) {
                            if(tracking['fan_3'] == 'ON'){
                                ched_3 = true, dis_3 = de, val_3 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                            }else {
                                ched_3 = false, dis_3 = de, val_3 = 'ปิด';
                            }
                        }
                        else {
                            ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                        }
                        if (parseInt(config_cn2['cn_status_8']) == 1) {
                            if(tracking['fan_4'] == 'ON'){
                                ched_4 = true, dis_4 = de, val_4 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                            }else {
                                ched_4 = false, dis_4 = de, val_4 = 'ปิด';
                            }
                        }
                        else {
                            ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                        }
                    }
                    else {
                        nfde = true;
                        ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                        ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                        ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                        ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                    }
                    $('.check_fn_1').prop({'checked': ched_1,'disabled': dis_1});
                    // $('.check_fnl_1').html('พัดลม 1 ('+config_cn2['cn_name_5']+') : '+val_1);
                    $('.check_fn_2').prop({'checked': ched_2,'disabled': dis_2});
                    // $('.check_fnl_2').html('พัดลม 2 ('+config_cn2['cn_name_6']+') : '+val_2);
                    $('.check_fn_3').prop({'checked': ched_3,'disabled': dis_3});
                    // $('.check_fnl_3').html('พัดลม 3 ('+config_cn2['cn_name_7']+') : '+val_3);
                    $('.check_fn_4').prop({'checked': ched_4,'disabled': dis_4});
                    // $('.check_fnl_4').html('พัดลม 4 ('+config_cn2['cn_name_8']+') : '+val_4);
                    range_instance3.update({
                        min: 20,
                        max: 50,
                        from: tracking.temp_min,
                        to: tracking.temp_max,
                        disable: nfde
                    });

                    // shading
                    let maxL, unitl, minl, maxl, nlde
                    if(control_V == 1){
                        if(parseInt(config_sn.sn_sensor_6) == 5){
                            maxL = (200000/54).toFixed();
                            unitl = "µmol m<sup>-2</sup>s<sup>-1</sup>";
                            minl = ((tracking.light_min*1000)/54).toFixed();
                            maxl = ((tracking.light_max*1000)/54).toFixed();
                        }
                        else { // KLUX
                            maxL = 200;
                            unitl = "KLux";
                            minl = tracking.light_min;
                            maxl = tracking.light_max;
                        }
                        $('.title_l').html('ควบคุมแสง ('+unitl+')');
                    }else {
                        maxL = (200000/54).toFixed();
                        unitl = "µmol m<sup>-2</sup>s<sup>-1</sup>";
                        minl = ((tracking.light_min*1000)/54).toFixed();
                        maxl = ((tracking.light_max*1000)/54).toFixed();
                        $('.title_l').html('ควบคุมแสง (µmol m<sup>-2</sup>s<sup>-1</sup>)');
                    }
                    if (parseInt(tracking['status_4']) == 1) { nlde = de; }
                    else { nlde = true; }
                    range_instance4.update({
                        min: 0,
                        max: maxL,
                        from: minl,
                        to: maxl,
                        disable: nlde
                    });
                    $('.lk_min').html(((tracking.light_min*1000)/54).toFixed()+' µmol m<sup>-2</sup>s<sup>-1</sup>');
                    $('.lu_min').html( (tracking.light_min*1).toFixed()+' Klux');
                    $('.lk_max').html(((tracking.light_max*1000)/54).toFixed()+' µmol m<sup>-2</sup>s<sup>-1</sup>');
                    $('.lu_max').html( (tracking.light_max*1).toFixed()+' Klux');
                    if (mode == 'dash') {
                        $('.text_chum').addClass('text_blur');
                        // $('.text_ctemp').addClass('text_blur');
                        // $('.text_light').html(val_lig).addClass('text_blur');
                    }
                    else {
                        $('.text_chum').removeClass('text_blur');
                        // $('.text_ctemp').removeClass('text_blur');
                        // $('.text_light').html(val_lig).removeClass('text_blur');
                    }
                }
                function check_load(input, cls, name, val){
                    fn_check_auto_tracking_save('');
                }
                function fn_check_auto_tracking_save(mode) {
                    let df_log = JSON.parse($('#val_config').val()).config_tracking;
                    delete df_log['user_control'];
                    delete df_log['light_in_mode'];
                    if (parseInt(config_cn2.cn_status_1) != 1){ df_log['dripper_1'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_2) != 1){ df_log['dripper_2'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_3) != 1){ df_log['dripper_3'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_4) != 1){ df_log['dripper_4'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_5) != 1){ df_log['fan_1'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_6) != 1){ df_log['fan_2'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_7) != 1){ df_log['fan_3'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_8) != 1){ df_log['fan_4'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_9) != 1){ df_log['foggy_1'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_10) != 1){ df_log['foggy_2'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_11) != 1){ df_log['spray'] = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_12) != 1){ df_log['shading'] = 'OFF'; }
                    let Rmx1 = $(".range_temp").val().split(";");
                    let Rmx2 = $(".range_hum").val().split(";");
                    let Rmx3 = $(".range_light").val().split(";");
                    let newl_min, newl_max
                    if (control_V == 1) {
                        if(parseInt(config_sn.sn_sensor_6) == 5){
                            newl_min = ((Rmx3[0]*54)/1000).toFixed();
                            newl_max = ((Rmx3[1]*54)/1000).toFixed();
                        }
                        else {
                            newl_max = Rmx3[0];
                            newl_max = Rmx3[1];
                        }
                    }else {
                        newl_min = ((Rmx3[0]*54)/1000).toFixed();
                        newl_max = ((Rmx3[1]*54)/1000).toFixed();
                    }
                    $('.lk_min').html(((newl_min*1000)/54).toFixed()+' µmol m<sup>-2</sup>s<sup>-1</sup>');
                    $('.lu_min').html( newl_min+' Klux');
                    $('.lk_max').html(((newl_max*1000)/54).toFixed()+' µmol m<sup>-2</sup>s<sup>-1</sup>');
                    $('.lu_max').html( newl_max+' Klux');
                    let Rmx4 = $(".range_soil").val().split(";");
                    let sw_1, sw_2, sw_3, sw_4, drip_1, drip_2, drip_3, drip_4, fn_1, fn_2, fn_3, fn_4, fg_1, fg_2 = 'OFF', spr, shr;
                    if ($('#swST_1').prop('checked') == true){ sw_1 = 1; }else { sw_1 = 0; }
                    if ($('#swST_2').prop('checked') == true){ sw_2 = 1; }else { sw_2 = 0; }
                    if ($('#swST_3').prop('checked') == true){ sw_3 = 1; }else { sw_3 = 0; }
                    if ($('#swST_4').prop('checked') == true){ sw_4 = 1; }else { sw_4 = 0; }
                    if ($('.check_d_1').prop('checked') == true){ drip_1 = 'ON'; }else { drip_1 = 'OFF'; }
                    if ($('.check_d_2').prop('checked') == true){ drip_2 = 'ON'; }else { drip_2 = 'OFF'; }
                    if ($('.check_d_3').prop('checked') == true){ drip_3 = 'ON'; }else { drip_3 = 'OFF'; }
                    if ($('.check_d_4').prop('checked') == true){ drip_4 = 'ON'; }else { drip_4 = 'OFF'; }
                    if ($('.check_fn_1').prop('checked') == true){ fn_1 = 'ON'; }else { fn_1 = 'OFF'; }
                    if ($('.check_fn_2').prop('checked') == true){ fn_2 = 'ON'; }else { fn_2 = 'OFF'; }
                    if ($('.check_fn_3').prop('checked') == true){ fn_3 = 'ON'; }else { fn_3 = 'OFF'; }
                    if ($('.check_fn_4').prop('checked') == true){ fn_4 = 'ON'; }else { fn_4 = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_9) == 1) { fg_1 = 'ON'; }else { fg_1 = 'OFF'; }
                    // if (parseInt(config_cn2.cn_status_10) == 1) {var fg_2 = 'ON'; }else { var fg_2 = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_11) == 1) { spr = 'ON'; }else { spr = 'OFF'; }
                    if (parseInt(config_cn2.cn_status_12) == 1) { shr = 'ON'; }else { shr = 'OFF'; }
                    let new_data = {
                        "status_1": Number(sw_1),
                        "status_2": Number(sw_2),
                        "status_3": Number(sw_3),
                        "status_4": Number(sw_4),
                        "temp_min": Number(Rmx1[0]),
                        "temp_max": Number(Rmx1[1]),
                        "hum_min":  Number(Rmx2[0]),
                        "hum_max":  Number(Rmx2[1]),
                        "hum_max2": Number($('.text_chum2').val()),
                        "light_min":Number(newl_min),
                        "light_max":Number(newl_max),
                        "soil_min": Number(Rmx4[0]),
                        "soil_max": Number(Rmx4[1]),
                        "dripper_1":drip_1,
                        "dripper_2":drip_2,
                        "dripper_3":drip_3,
                        "dripper_4":drip_4,
                        "fan_1":    fn_1,
                        "fan_2":    fn_2,
                        "fan_3":    fn_3,
                        "fan_4":    fn_4,
                        "foggy_1":  fg_1,
                        "foggy_2":  fg_2,
                        "spray":    spr,
                        "shading":  shr
                    };
                    // console.log(JSON.stringify(df_log));
                    // console.log(JSON.stringify(new_data));
                    if (mode == 'close') {
                        if (JSON.stringify(df_log) == JSON.stringify(new_data)) {
                            $('.menu_config_auto2').show();
                            range_auto_mode('dash');
                            $(".sw_mode_Auto").attr('disabled', false);
                            $(".sw_mode_Manual").attr('disabled', false);
                            $('.sw_mode_tracking').prop('disabled', false)
                            $('.sw_mode_timer').prop('disabled', false)
                            $('.sw_mode_timeSet').prop('disabled', true)
                            $('.sw_mode_timeLoop').prop('disabled', true)
                            $(".close_modal").show();
                            $("#close_auto_cont").hide();
                            $("#save_auto_cont").hide();
                        }
                        else {
                            swal({
                                'title': 'คุณแน่ใจหรือไม่?',
                                'text': "คุณต้องการยกเลิกการตั้งค่า?",
                                'type': 'warning',
                                'allowOutsideClick': false,
                                'showCancelButton': true,
                                'confirmButtonColor': '#da3444',
                                'cancelButtonColor': '#8e8e8e',
                                'confirmButtonText': 'ยืนยัน',
                                'cancelButtonText': 'ยกเลิก',
                            }).then((result) => {
                                if (result.value) {
                                    $('.menu_config_auto2').show();
                                    range_auto_mode('dash');
                                    $(".sw_mode_Auto").attr('disabled', false);
                                    $(".sw_mode_Manual").attr('disabled', false);
                                    $('.sw_mode_tracking').prop('disabled', false)
                                    $('.sw_mode_timer').prop('disabled', false)
                                    $('.sw_mode_timeSet').prop('disabled', true)
                                    $('.sw_mode_timeLoop').prop('disabled', true)
                                    $(".close_modal").show();
                                    $("#close_auto_cont").hide();
                                    $("#save_auto_cont").hide();
                                }
                            });
                        }
                    }
                    else {
                        if (JSON.stringify(df_log) == JSON.stringify(new_data)) {
                            $("#save_auto_cont").hide();
                        } else {
                            $("#save_auto_cont").show();
                        }
                    }
                }
                $('.menu_config_auto2').click(function(){
                    $(".sw_mode_Auto").attr('disabled', true);
                    $(".sw_mode_Manual").attr('disabled', true);
                    $('.sw_mode_tracking').prop('disabled', true)
                    $('.sw_mode_timer').prop('disabled', true)
                    $('.sw_mode_timeSet').prop('disabled', false)
                    $('.sw_mode_timeLoop').prop('disabled', false)
                    $(".close_modal").hide();
                    $(this).hide();
                    $("#close_auto_cont").show();
                    range_auto_mode('config');
                    $('#swST_1').change(function(){
                        let tracking = JSON.parse($('#val_config').val()).config_tracking;
                        // let Rmx = $(".range_soil").val().split(";");
                        let de, ched_1, dis_1, val_1, ched_2, dis_2, val_2, ched_3, dis_3, val_3, ched_4, dis_4, val_4
                        if ($(this).prop('checked') == true){
                            de = false;
                            if (parseInt(config_cn2.cn_status_1) == 1) {
                                if(tracking.dripper_1 == 'ON'){
                                    ched_1 = true, dis_1 = false, val_1 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                                }else {
                                    ched_1 = false, dis_1 = false, val_1 = 'ปิด';
                                }
                            }else {
                                ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_2) == 1) {
                                if(tracking.dripper_2 == 'ON'){
                                    ched_2 = true, dis_2 = false, val_2 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                                }else {
                                    ched_2 = false, dis_2 = false, val_2 = 'ปิด';
                                }
                            }else {
                                ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_3) == 1) {
                                if(tracking.dripper_3 == 'ON'){
                                    ched_3 = true, dis_3 = false, val_3 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                                }else {
                                    ched_3 = false, dis_3 = false, val_3 = 'ปิด';
                                }
                            }else {
                                ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_4) == 1) {
                                if(tracking.dripper_4 == 'ON'){
                                    ched_4 = true, dis_4 = false, val_4 = 'เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+tracking.soil_min+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+tracking.soil_max+' %';
                                }else {
                                    ched_4 = false, dis_4 = false, val_4 = 'ปิด';
                                }
                            }else {
                                ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                            }
                        }
                        else {
                            de = true;
                            if (parseInt(config_cn2.cn_status_1) == 1) {
                                ched_1 = false, dis_1 = true, val_1 = 'ปิด';
                            }else {
                                ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_2) == 1) {
                                ched_2 = false, dis_2 = true, val_2 = 'ปิด';
                            }else {
                                ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_3) == 1) {
                                ched_3 = false, dis_3 = true, val_3 = 'ปิด';
                            }else {
                                ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_4) == 1) {
                                ched_4 = false, dis_4 = true, val_4 = 'ปิด';
                            }else {
                                ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                            }
                        }
                        console.log(tracking);
                        $('.check_d_1').prop({'checked': ched_1,'disabled': dis_1});
                        $('.check_d_2').prop({'checked': ched_2,'disabled': dis_2});
                        $('.check_d_3').prop({'checked': ched_3, 'disabled': dis_3});
                        $('.check_d_4').prop({'checked': ched_4, 'disabled': dis_4});
                        range_instance1.update({
                            min: 0,
                            max: 100,
                            from: tracking.soil_min,
                            to: tracking.soil_max,
                            disable: de
                        });
                        fn_check_auto_tracking_save('');
                    });
                    $('#swST_2').change(function(){
                        let tracking = JSON.parse($('#val_config').val()).config_tracking;
                        // var Rmx = $(".range_hum").val().split(";");
                        let de
                        if ($(this).prop('checked') == true){
                            de = false;
                            $('.text_chum').removeClass('text_blur');
                        }
                        else {
                            de = true;
                            $('.text_chum').addClass('text_blur');
                        }
                        range_instance2.update({
                            min: 0,
                            max: 100,
                            from: tracking.hum_min,
                            to: tracking.hum_max,
                            disable: de
                        });
                        fn_check_auto_tracking_save('');
                    });
                    $('#swST_3').change(function(){
                        let tracking = JSON.parse($('#val_config').val()).config_tracking;
                        let de, ched_1, dis_1, val_1, ched_2, dis_2, val_2, ched_3, dis_3, val_3, ched_4, dis_4, val_4
                        if ($(this).prop('checked') == true){
                            $('.text_ctemp').removeClass('text_blur');
                            de = false;
                            if (parseInt(config_cn2.cn_status_5) == 1) {
                                if(tracking.fan_1 == 'ON'){
                                    ched_1 = true, dis_1 = false, val_1 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                                }else {
                                    ched_1 = false, dis_1 = false, val_1 = 'ปิด';
                                }
                            }else {
                                ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_6) == 1) {
                                if(tracking.fan_2 == 'ON'){
                                    ched_2 = true, dis_2 = false, val_2 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                                }else {
                                    ched_2 = false, dis_2 = false, val_2 = 'ปิด';
                                }
                            }else {
                                ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_7) == 1) {
                                if(tracking.fan_3 == 'ON'){
                                    ched_3 = true, dis_3 = false, val_3 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                                }else {
                                    ched_3 = false, dis_3 = false, val_3 = 'ปิด';
                                }
                            }else {
                                ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_8) == 1) {
                                if(tracking.fan_4 == 'ON'){
                                    ched_4 = true, dis_4 = false, val_4 = 'เปิดเมื่ออุอุณหภูมิสูงกว่า '+tracking.temp_max+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+tracking.temp_min+' ℃';
                                }else {
                                    ched_4 = false, dis_4 = false, val_4 = 'ปิด';
                                }
                            }else {
                                ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                            }
                        }
                        else {
                            $('.text_ctemp').addClass('text_blur');
                            de = true;
                            if (parseInt(config_cn2.cn_status_5) == 1) {
                                ched_1 = false, dis_1 = true, val_1 = 'ปิด';
                            }else {
                                ched_1 = false, dis_1 = true, val_1 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_6) == 1) {
                                ched_2 = false, dis_2 = true, val_2 = 'ปิด';
                            }else {
                                ched_2 = false, dis_2 = true, val_2 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_7) == 1) {
                                ched_3 = false, dis_3 = true, val_3 = 'ปิด';
                            }else {
                                ched_3 = false, dis_3 = true, val_3 = 'ไม่ใช้งาน';
                            }
                            if (parseInt(config_cn2.cn_status_8) == 1) {
                                ched_4 = false, dis_4 = true, val_4 = 'ปิด';
                            }else {
                                ched_4 = false, dis_4 = true, val_4 = 'ไม่ใช้งาน';
                            }
                        }
                        $('.check_fn_1').prop({'checked': ched_1,'disabled': dis_1});
                        $('.check_fn_2').prop({'checked': ched_2,'disabled': dis_2});
                        $('.check_fn_3').prop({'checked': ched_3, 'disabled': dis_3});
                        $('.check_fn_4').prop({'checked': ched_4, 'disabled': dis_4});
                        range_instance3.update({
                            min: 20,
                            max: 50,
                            from: tracking.temp_min,
                            to: tracking.temp_max,
                            disable: de
                        });
                        fn_check_auto_tracking_save('');
                    });
                    $('#swST_4').change(function(){
                        let tracking = JSON.parse($('#val_config').val()).config_tracking;
                        let maxL, unitl, minl, maxl, de
                        if(control_V == 1){
                            if(parseInt(config_sn.sn_sensor_6) == 5){
                                maxL = (100000/54).toFixed();
                                unitl = "µmol m<sup>-2</sup>s<sup>-1</sup>";
                                minl = ((tracking.light_min*1000)/54).toFixed();
                                maxl = ((tracking.light_max*1000)/54).toFixed();
                            }
                            else { // KLUX
                                maxL = 100,
                                unitl = "KLux",
                                minl = tracking.light_min,
                                maxl = tracking.light_max;
                            }
                        }
                        else {
                            maxL = (100000/54).toFixed();
                            unitl = "µmol m<sup>-2</sup>s<sup>-1</sup>";
                            minl = ((tracking.light_min*1000)/54).toFixed();
                            maxl = ((tracking.light_max*1000)/54).toFixed();
                        }
                        if ($(this).prop('checked') == true){ de = false; }
                        else { de = true; }
                        range_instance4.update({
                            min: 0,
                            max: maxL,
                            from: minl,
                            to: maxl,
                            disable: de
                        });
                        fn_check_auto_tracking_save('');
                    });
                    $(".range_soil").change(function(){
                        let Rmx4 = $(".range_soil").val().split(";")
                        check_load($('.check_d_1').prop('checked'), 'dl_1', 'น้ำหยด 1 ('+config_cn2["cn_name_1"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx4[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx4[1]+' %')
                        check_load($('.check_d_2').prop('checked'), 'dl_2', 'น้ำหยด 2 ('+config_cn2["cn_name_2"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx4[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx4[1]+' %')
                        check_load($('.check_d_3').prop('checked'), 'dl_3', 'น้ำหยด 3 ('+config_cn2["cn_name_3"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx4[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx4[1]+' %')
                        check_load($('.check_d_4').prop('checked'), 'dl_4', 'น้ำหยด 4 ('+config_cn2["cn_name_4"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx4[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx4[1]+' %')
                        $('.text_soil').html(Rmx4[1]+' %');
                        fn_check_auto_tracking_save('');
                    });
                    $(".range_hum").change(function(){
                        let Rmx2 = $(".range_hum").val().split(";")
                        $(".text_chum2").val(Rmx2[1]-10)
                        fn_check_auto_tracking_save('');
                    });
                    $(".text_chum2").change(function(){
                        fn_check_auto_tracking_save('');
                    });
                    $(".range_temp").change(function(){
                        fn_check_auto_tracking_save('');
                    });
                    $(".range_light").change(function(){
                        fn_check_auto_tracking_save('');
                    });

                    $('.check_d_1').change(function(){
                        let Rmx = $(".range_soil").val().split(";")
                        check_load($('.check_d_1').prop('checked'), 'dl_1', 'น้ำหยด 1 ('+config_cn2["cn_name_1"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx[1]+' %');
                    });
                    $('.check_d_2').change(function(){
                        let Rmx = $(".range_soil").val().split(";")
                        check_load($('.check_d_2').prop('checked'), 'dl_2', 'น้ำหยด 2 ('+config_cn2["cn_name_2"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx[1]+' %');
                    });
                    $('.check_d_3').change(function(){
                        let Rmx = $(".range_soil").val().split(";")
                        check_load($('.check_d_3').prop('checked'), 'dl_3', 'น้ำหยด 3 ('+config_cn2["cn_name_3"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx[1]+' %');
                    });
                    $('.check_d_4').change(function(){
                        let Rmx = $(".range_soil").val().split(";")
                        check_load($('.check_d_4').prop('checked'), 'dl_4', 'น้ำหยด 4 ('+config_cn2["cn_name_4"]+')', ' เปิดน้ำเมื่อความชื้นดินต่ำกว่า '+Rmx[0]+' % และปิดน้ำเมื่อความชื้นดินสูงกว่า '+Rmx[1]+' %');
                    });
                    $('.check_fn_1').change(function(){
                        let Rmx = $(".range_temp").val().split(";")
                        check_load($('.check_fn_1').prop('checked'), 'fnl_1', 'พัดลม 1 ('+config_cn2["cn_name_5"]+')', ' เปิดเมื่ออุอุณหภูมิสูงกว่า '+Rmx[1]+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+Rmx[0]+' ℃');
                    });
                    $('.check_fn_2').change(function(){
                        let Rmx = $(".range_temp").val().split(";")
                        check_load($('.check_fn_2').prop('checked'), 'fnl_2', 'พัดลม 2 ('+config_cn2["cn_name_6"]+')', ' เปิดเมื่ออุอุณหภูมิสูงกว่า '+Rmx[1]+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+Rmx[0]+' ℃');
                    });
                    $('.check_fn_3').change(function(){
                        let Rmx = $(".range_temp").val().split(";")
                        check_load($('.check_fn_3').prop('checked'), 'fnl_3', 'พัดลม 3 ('+config_cn2["cn_name_7"]+')', ' เปิดเมื่ออุอุณหภูมิสูงกว่า '+Rmx[1]+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+Rmx[0]+' ℃');
                    });
                    $('.check_fn_4').change(function(){
                        let Rmx = $(".range_temp").val().split(";")
                        check_load($('.check_fn_4').prop('checked'), 'fnl_4', 'พัดลม 4 ('+config_cn2["cn_name_8"]+')', ' เปิดเมื่ออุอุณหภูมิสูงกว่า '+Rmx[1]+' ℃ และปิดเมื่ออุอุณหภูมิต่ำกว่า '+Rmx[0]+' ℃');
                    });
                });
                $('.view_tracking').click(function(){
                    let id = $(this).attr('id'), name, n_data=[],Rmx, Rmx1, Rmx2;
                    n_data.push('<div style="text-align: left">');
                    if (id == 'st_1') {
                        name = 'ความชื้นดิน';
                        Rmx = $(".range_soil").val().split(";")
                        n_data.push('<span>1. ระบบเริ่มทำงานเวลา 07:00 - 18:00 น.</span><br>');
                        n_data.push('<span>2. เปิดน้ำหยดเมื่อความชื้นดินต่ำกว่า '+Rmx[0]+' %</span><br>');
                        n_data.push('<span>3. ปิดน้ำหยดเมื่อความชื้นดินสูงกว่า '+Rmx[1]+' %</span><br>');
                    }else if (id == 'st_2') {
                        name = 'ความชื้นอากาศ';
                        Rmx = $(".range_soil").val().split(";")
                        Rmx1 = $(".range_hum").val().split(";")
                        n_data.push('<span>1. ระบบเริ่มทำงานเวลา 07:00 - 18:00 น.</span><br>');
                        n_data.push('<span>2. กรณีความชื้นดินต่ำกว่า '+Rmx[1]+' %</span><br>');
                        n_data.push('<span>&emsp;2.1. เมื่อความชื้นอากาศต่ำกว่า '+Rmx1[0]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- เปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>&emsp;2.2. เมื่อความชื้นอากาศสูงกว่า '+$('.text_chum2').val()+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- เปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>&emsp;2.3. เมื่อความชื้นอากาศสูงกว่า '+Rmx1[1]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>3. กรณีความชื้นดินสูงกว่า '+Rmx[1]+' %</span><br>');
                        n_data.push('<span>&emsp;3.1. เมื่อความชื้นอากาศต่ำกว่า '+$('.text_chum2').val()+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- เปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>&emsp;3.2. เมื่อความชื้นอากาศสูงกว่า '+Rmx1[1]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                    }else if (id == 'st_3') {
                        name = 'อุณหภูมิ';
                        Rmx = $(".range_soil").val().split(";")
                        Rmx1 = $(".range_hum").val().split(";")
                        Rmx2 = $(".range_temp").val().split(";")
                        n_data.push('<span>1. เมื่ออุณหภูมิสูงกว่า '+Rmx[1]+' ℃ เปิดพัดลม</span><br>');
                        n_data.push('<span>2. เมื่ออุณหภูมิต่ำกว่า '+Rmx[0]+' ℃ ปิดพัดลม</span><br>');
                        n_data.push('<span>3. กรณีอุณหภูมิสูงกว่า '+Rmx[1]+' ℃ และเปิดพัดลมผ่านไป 15 นาที</span><br>');
                        n_data.push('<span>&emsp;3.1. กรณีอยู่ในช่วงเวลา 07:00 - 18:00 น.</span><br>');
                        n_data.push('<span>&emsp;3.2. กรณีความชื้นดินต่ำกว่า '+Rmx[1]+' %</span><br>');
                        n_data.push('<span>&emsp;&emsp;3.2.1. เมื่อความชื้นอากาศต่ำกว่า '+$('.text_chum2').val()+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- พ่นหมอก 1 ('+config_cn2["cn_name_9"]+') ทำงานต่อเนื่อง (เปิด 2 นาที และปิด 13 นาที)</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;3.2.2. เมื่อความชื้นอากาศสูงกว่า '+$('.text_chum2').val()+' %Rh และต่ำกว่า '+Rmx1[1]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- สเปรย์ ('+config_cn2["cn_name_11"]+') ทำงานต่อเนื่อง (เปิด 5 นาที และปิด 5 นาที)</span><br>');
                        n_data.push('<span>&emsp;&emsp;3.2.3. เมื่อความชื้นอากาศสูงกว่า '+Rmx1[1]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>&emsp;3.3. กรณีความชื้นดินสูงกว่า '+Rmx[1]+' %</span><br>');
                        n_data.push('<span>&emsp;&emsp;3.3.1. เมื่อความชื้นอากาศต่ำกว่า '+Rmx1[1]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- สเปรย์ ('+config_cn2["cn_name_11"]+') ทำงานต่อเนื่อง (เปิด 5 นาที และปิด 5 นาที)</span><br>');
                        n_data.push('<span>&emsp;&emsp;3.3.2. เมื่อความชื้นอากาศสูงกว่า '+Rmx1[1]+' %Rh</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดพ่นหมอก 1 ('+config_cn2["cn_name_9"]+')</span><br>');
                        n_data.push('<span>&emsp;&emsp;&emsp;- ปิดสเปรย์ ('+config_cn2["cn_name_11"]+')</span><br>');
                        n_data.push('<span>4. ในช่วงเวลา 12:00 - 16:00 น. ถ้าอุณหภูมิสูงกว่า '+Rmx[1]+' ℃ ผ่านมาแล้วมากกว่า 45 นาที ม่านพรางแสงจะปิดรับแสง</span><br>');
                        n_data.push('<span>4. ในช่วงเวลา 12:00 - 16:00 น. ถ้าอุณหภูมิต่ำกว่า '+Rmx[1]+' ℃ ม่านพรางแสงจะทำงานตามเงื่อนไขของระบบพรางแสง</span><br>');
                    }else if (id == 'st_4') {
                        name = 'แสง';
                        let unitl1 = "µmol m<sup>-2</sup>s<sup>-1</sup>";
                        let unitl2 = "KLux";
                        Rmx = $(".range_light").val().split(";")
                        n_data.push('<span>1. ระบบเริ่มทำงานเวลา 07:00 - 18:00 น.</span><br>');
                        if(control_V == 1){
                            n_data.push('<span>2. เปิดม่านพรางแสงเมื่อความเข้มแสงต่ำกว่า '+((Rmx[0]*1000)/54).toFixed()+' '+unitl1+' ('+Rmx[0]+' '+unitl2+')</span><br>');
                            n_data.push('<span>3. ปิดม่านพรางแสงเมื่อความเข้มแสงสูงกว่า '+((Rmx[1]*1000)/54).toFixed()+' '+unitl1+' ('+Rmx[1]+' '+unitl2+')</span><br>');
                        }else { // V อ.อร
                            n_data.push('<span>2. เปิดม่านพรางแสงเมื่อความเข้มแสงต่ำกว่า '+Rmx[0]+' '+unitl1+' ('+((Rmx[0]*54)/1000).toFixed()+' '+unitl2+')</span><br>');
                            n_data.push('<span>3. ปิดม่านพรางแสงเมื่อความเข้มแสงสูงกว่า '+Rmx[1]+' '+unitl1+' ('+((Rmx[1]*54)/1000).toFixed()+' '+unitl2+')</span><br>');
                        }
                    }
                    n_data.push('</div>');
                    Swal({
                        // type: type,
                        'title': 'เงื่อนไขการควบคุม '+name,
                        'html': n_data.join(' '),
                        'allowOutsideClick': false,
                        'confirmButtonColor': '#FF3333',
                        'confirmButtonText': 'ปิด'
                    });
                });
                // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx


                // Mode_Manual ================================================
                $('.status_config_manual').hide();
                $('#save_manual_cont').hide();
                $('#close_manual_cont').hide();
                // alert($('.hidden_select_sw_manual').val());
                fn_df_sw_manual($('.hidden_select_sw_manual').val());
                $('.sw_sel_load_manual').click(function() {
                    let numb = Number($(this).attr('id').substring(1));
                    if ($('#close_manual_cont').is(":hidden") == false) {
                        swal({
                            'title': 'ข้อผิดพลาด !',
                            'text': "กรุณาบันทึกหรือยกเลิกการตั้งค่าก่อน !!!",
                            'type': 'warning',
                            'allowOutsideClick': false,
                            'confirmButtonColor': '#32CD32',
                            'confirmButtonText': 'ตกลง',
                        });
                        return false;
                    } else {
                        if (numb == 1) {
                            if (countElement(1, status_dripper) == 0) {
                                swal({
                                    'title': 'โหลดนี้ไม่ถูกต่อใช้งาน !!!',
                                    'text': "กรุณาเลือกโหลดอื่น",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'confirmButtonColor': '#32CD32',
                                    'confirmButtonText': 'ตกลง',
                                });
                                return false;
                            }
                        } else if (numb == 2) {
                            if (countElement(1, status_fan) == 0) {
                                swal({
                                    'title': 'โหลดนี้ไม่ถูกต่อใช้งาน !!!',
                                    'text': "กรุณาเลือกโหลดอื่น",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'confirmButtonColor': '#32CD32',
                                    'confirmButtonText': 'ตกลง',
                                });
                                return false;
                            }
                        } else if (numb == 3) {
                            if (countElement(1, status_foggy) == 0) {
                                swal({
                                    'title': 'โหลดนี้ไม่ถูกต่อใช้งาน !!!',
                                    'text': "กรุณาเลือกโหลดอื่น",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'confirmButtonColor': '#32CD32',
                                    'confirmButtonText': 'ตกลง',
                                });
                                return false;
                            }
                        } else if (numb == 4) {
                            if (parseInt(config_cn2.cn_status_11) == 0) {
                                swal({
                                    'title': 'โหลดนี้ไม่ถูกต่อใช้งาน !!!',
                                    'text': "กรุณาเลือกโหลดอื่น",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'confirmButtonColor': '#32CD32',
                                    'confirmButtonText': 'ตกลง',
                                });
                                return false;
                            }
                        } else if (numb == 5) {
                            if (parseInt(config_cn2.cn_status_12) == 0) {
                                swal({
                                    'title': 'โหลดนี้ไม่ถูกต่อใช้งาน !!!',
                                    'text': "กรุณาเลือกโหลดอื่น",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'confirmButtonColor': '#32CD32',
                                    'confirmButtonText': 'ตกลง',
                                });
                                return false;
                            }
                        }
                        $('.hidden_select_sw_manual').val(numb)
                        fn_df_sw_manual(numb);
                    }
                });
                $('.menu_config_manual').click(function() {
                    let name, val = $('.hidden_select_sw_manual').val();
                    if ($('.sw_manual_on').hasClass('active') == true) {
                        if (val == 1) {
                            name = 'น้ำหยด';
                        } else if (val == 2) {
                            name = 'พัดลม';
                        } else if (val == 3) {
                            name = 'พ่นหมอก';
                        }
                        swal({
                            'title': 'ข้อผิดพลาด !',
                            'text': "กรุณาปิด " + name + " ก่อน !!!",
                            'type': 'warning',
                            'allowOutsideClick': false,
                            'confirmButtonColor': '#32CD32',
                            'confirmButtonText': 'ตกลง',
                        });
                        return false;
                    }
                    $(this).hide();
                    $('.status_config_manual').show();
                    $('#close_manual_cont').show();
                    $(".sw_mode_Auto").attr('disabled', true);
                    $(".sw_mode_Manual").attr('disabled', true);
                    // =================================================
                    let config_parse = JSON.parse($('#val_config').val());
                    let sw_log = config_parse.config_manual;//$.parseJSON($('#val_sw_manual').val());
                    $('.label_1').show();
                    $('.label_2').show();
                    $('.label_3').show();
                    $('.label_4').show();
                    if (val == 1) {
                        if (parseInt(config_cn2.cn_status_1) == 1) {
                            if (sw_log.dripper_1 == 'ON') {
                                $('#label_1').bootstrapToggle('on')
                            } else {
                                $('#label_1').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_1').hide();
                            $('.status_config_manual_1').hide();
                        }
                        if (parseInt(config_cn2.cn_status_2) == 1) {
                            if (sw_log.dripper_2 == 'ON') {
                                $('#label_2').bootstrapToggle('on')
                            } else {
                                $('#label_2').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_2').hide();
                            $('.status_config_manual_2').hide();
                        }
                        if (parseInt(config_cn2.cn_status_3) == 1) {
                            if (sw_log.dripper_3 == 'ON') {
                                $('#label_3').bootstrapToggle('on')
                            } else {
                                $('#label_3').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_3').hide();
                            $('.status_config_manual_3').hide();
                        }
                        if (parseInt(config_cn2.cn_status_4) == 1) {
                            if (sw_log.dripper_4 == 'ON') {
                                $('#label_4').bootstrapToggle('on')
                            } else {
                                $('#label_4').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_4').hide();
                            $('.status_config_manual_4').hide();
                        }
                        checkbox_select_all(val);
                    }
                    else if (val == 2) {
                        if (parseInt(config_cn2.cn_status_5) == 1) {
                            $('.label_1').show();
                            if (sw_log.fan_1 == 'ON') {
                                $('#label_1').bootstrapToggle('on')
                            } else {
                                $('#label_1').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_1').hide();
                            $('#label_1').hide();
                        }
                        if (parseInt(config_cn2.cn_status_6) == 1) {
                            $('.label_2').show();
                            if (sw_log.fan_2 == 'ON') {
                                $('#label_2').bootstrapToggle('on')
                            } else {
                                $('#label_2').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_2').hide();
                            $('#label_2').hide();
                        }
                        if (parseInt(config_cn2.cn_status_7) == 1) {
                            if (sw_log.fan_3 == 'ON') {
                                $('#label_3').bootstrapToggle('on')
                            } else {
                                $('#label_3').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_3').hide();
                            $('#label_3').hide();
                        }
                        if (parseInt(config_cn2.cn_status_8) == 1) {
                            if (sw_log.fan_4 == 'ON') {
                                $('#label_4').bootstrapToggle('on')
                            } else {
                                $('#label_4').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_4').hide();
                            $('#label_4').hide();
                        }
                        checkbox_select_all(val);
                    }
                    else if (val == 3) {
                        if (parseInt(config_cn2.cn_status_9) == 1) {
                            if (sw_log.foggy_1 == 'ON') {
                                $('#label_1').bootstrapToggle('on')
                            } else {
                                $('#label_1').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_1').hide();
                            $('#label_1').hide();
                        }
                        if (parseInt(config_cn2.cn_status_10) == 1) {
                            if (sw_log.foggy_2 == 'ON') {
                                $('#label_2').bootstrapToggle('on')
                            } else {
                                $('#label_2').bootstrapToggle('off')
                            }
                        } else {
                            $('.label_2').hide();
                            $('#label_2').hide();
                        }
                        $('.label_3').hide();
                        $('.label_4').hide();
                        $('.status_config_manual_3').hide();
                        $('.status_config_manual_4').hide();
                        checkbox_select_all(val);
                    }
                    // =============================================
                    $('#checkbox_all_manual').click(function() {
                        if ($(this).prop('checked') == true) {
                            $('.input_check2').bootstrapToggle('on')
                        } else {
                            $('.input_check2').bootstrapToggle('off')
                        }
                        fn_check_manual_save($('.hidden_select_sw_manual').val(), '')
                    });
                    $('.input_check2').on('change', function() {
                        let numb = $('.hidden_select_sw_manual').val();
                        checkbox_select_all(numb);
                        fn_check_manual_save($('.hidden_select_sw_manual').val(), '');
                    });

                    function checkbox_select_all(numb) {
                        let n_countSB = [];
                        if (numb == 1) {
                            // if( $('#label_1').prop('checked') == true && parseInt(config_cn2.cn_status_1) == 1 ||
                            //     $('#label_2').prop('checked') == true && parseInt(config_cn2.cn_status_2) == 1 ||
                            //     $('#label_3').prop('checked') == true && parseInt(config_cn2.cn_status_3) == 1 ||
                            //     $('#label_4').prop('checked') == true && parseInt(config_cn2.cn_status_4) == 1 ) {
                            if (parseInt(config_cn2.cn_status_1) == 1 && $('#label_1').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            if (parseInt(config_cn2.cn_status_2) == 1 && $('#label_2').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            if (parseInt(config_cn2.cn_status_3) == 1 && $('#label_3').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            if (parseInt(config_cn2.cn_status_4) == 1 && $('#label_4').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            // alert(countElement(1,n_countSB))
                            if (countElement(1, status_dripper) == countElement(1, n_countSB)) {
                                $('#checkbox_all_manual').prop('checked', true);
                            } else {
                                $('#checkbox_all_manual').prop('checked', false);
                            }
                        }
                        else if (numb == 2) {
                            // countElement(1,status_fan)
                            if (parseInt(config_cn2.cn_status_5) == 1 && $('#label_1').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            if (parseInt(config_cn2.cn_status_6) == 1 && $('#label_2').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            if (parseInt(config_cn2.cn_status_7) == 1 && $('#label_3').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            if (parseInt(config_cn2.cn_status_8) == 1 && $('#label_4').prop('checked') == true) {
                                n_countSB.push(1)
                            } else {
                                n_countSB.push(0)
                            }
                            // alert(countElement(1,n_countSB))
                            if (countElement(1, status_fan) == countElement(1, n_countSB)) {
                                $('#checkbox_all_manual').prop('checked', true);
                            } else {
                                $('#checkbox_all_manual').prop('checked', false);
                            }
                        }
                        else if (numb == 3) {
                            if ($('#label_1').prop('checked') == true && $('#label_2').prop('checked') == true) {
                                $('#checkbox_all_manual').prop('checked', true);
                            } else {
                                $('#checkbox_all_manual').prop('checked', false);
                            }
                        }
                    }
                    $('#close_manual_cont').click(function() {
                        fn_check_manual_save($('.hidden_select_sw_manual').val(), 'close');
                    });
                    fn_check_manual_save($('.hidden_select_sw_manual').val(), '');
                    function fn_check_manual_save(numb, mode) {
                        let config_parse = JSON.parse($('#val_config').val());
                        let sw_log = config_parse.config_manual;// $.parseJSON($('#val_sw_manual').val());
                        let new_log = [];
                        if (parseInt(config_cn2.cn_status_1) == 0) { sw_log['dripper_1'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_2) == 0) { sw_log['dripper_2'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_3) == 0) { sw_log['dripper_3'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_4) == 0) { sw_log['dripper_4'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_5) == 0) { sw_log['fan_1'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_6) == 0) { sw_log['fan_2'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_7) == 0) { sw_log['fan_3'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_8) == 0) { sw_log['fan_4'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_9) == 0) { sw_log['foggy_1'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_10) == 0) { sw_log['foggy_2'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_11) == 0) { sw_log['spray'] = "OFF"; }
                        if (parseInt(config_cn2.cn_status_12) == 0) { sw_log['shading'] = "OFF"; }
                        if (numb == 1) {
                            if (parseInt(config_cn2.cn_status_1) == 1) {
                                if ($("#label_1").prop('checked') == true) {
                                    new_log['dripper_1'] = "ON";
                                } else {
                                    new_log['dripper_1'] = "OFF";
                                }
                            } else {
                                new_log['dripper_1'] = "OFF";
                                $('.status_config_manual_1').hide();
                            }
                            if (parseInt(config_cn2.cn_status_2) == 1) {
                                if ($("#label_2").prop('checked') == true) {
                                    new_log['dripper_2'] = "ON";
                                } else {
                                    new_log['dripper_2'] = "OFF";
                                }
                            } else {
                                new_log['dripper_2'] = "OFF";
                                $('.status_config_manual_2').hide();
                            }
                            if (parseInt(config_cn2.cn_status_3) == 1) {
                                if ($("#label_3").prop('checked') == true) {
                                    new_log['dripper_3'] = "ON";
                                } else {
                                    new_log['dripper_3'] = "OFF";
                                }
                            } else {
                                new_log['dripper_3'] = "OFF";
                                $('.status_config_manual_3').hide();
                            }
                            if (parseInt(config_cn2.cn_status_4) == 1) {
                                if ($("#label_4").prop('checked') == true) {
                                    new_log['dripper_4'] = "ON";
                                } else {
                                    new_log['dripper_4'] = "OFF";
                                }
                            } else {
                                new_log['dripper_4'] = "OFF";
                                $('.status_config_manual_4').hide();
                            }
                            new_log['fan_1'] = sw_log.fan_1;
                            new_log['fan_2'] = sw_log.fan_2;
                            new_log['fan_3'] = sw_log.fan_3;
                            new_log['fan_4'] = sw_log.fan_4;
                            new_log['foggy_1'] = sw_log.foggy_1;
                            new_log['foggy_2'] = sw_log.foggy_2;
                            new_log['spray'] = sw_log.spray;
                            new_log['shading'] = sw_log.shading;
                        }
                        else if (numb == 2) {
                            new_log['dripper_1'] = sw_log.dripper_1;
                            new_log['dripper_2'] = sw_log.dripper_2;
                            new_log['dripper_3'] = sw_log.dripper_3;
                            new_log['dripper_4'] = sw_log.dripper_4;
                            if (parseInt(config_cn2.cn_status_5) == 1) {
                                if ($("#label_1").prop('checked') == true) {
                                    new_log['fan_1'] = "ON";
                                } else {
                                    new_log['fan_1'] = "OFF";
                                }
                            } else {
                                new_log['fan_1'] = "OFF";
                                $('.status_config_manual_1').hide();
                            }
                            if (parseInt(config_cn2.cn_status_6) == 1) {
                                if ($("#label_2").prop('checked') == true) {
                                    new_log['fan_2'] = "ON";
                                } else {
                                    new_log['fan_2'] = "OFF";
                                }
                            } else {
                                new_log['fan_2'] = "OFF";
                                $('.status_config_manual_2').hide();
                            }
                            if (parseInt(config_cn2.cn_status_7) == 1) {
                                if ($("#label_3").prop('checked') == true) {
                                    new_log['fan_3'] = "ON";
                                } else {
                                    new_log['fan_3'] = "OFF";
                                }
                            } else {
                                new_log['fan_3'] = "OFF";
                                $('.status_config_manual_3').hide();
                            }
                            if (parseInt(config_cn2.cn_status_8) == 1) {
                                if ($("#label_4").prop('checked') == true) {
                                    new_log['fan_4'] = "ON";
                                } else {
                                    new_log['fan_4'] = "OFF";
                                }
                            } else {
                                new_log['fan_4'] = "OFF";
                                $('.status_config_manual_4').hide();
                            }
                            new_log['foggy_1'] = sw_log.foggy_1;
                            new_log['foggy_2'] = sw_log.foggy_2;
                            new_log['spray'] = sw_log.spray;
                            new_log['shading'] = sw_log.shading;
                        }
                        else if (numb == 3) {
                            new_log['dripper_1'] = sw_log.dripper_1;
                            new_log['dripper_2'] = sw_log.dripper_2;
                            new_log['dripper_3'] = sw_log.dripper_3;
                            new_log['dripper_4'] = sw_log.dripper_4;
                            new_log['fan_1'] = sw_log.fan_1;
                            new_log['fan_2'] = sw_log.fan_2;
                            new_log['fan_3'] = sw_log.fan_3;
                            new_log['fan_4'] = sw_log.fan_4;
                            if (parseInt(config_cn2.cn_status_9) == 1) {
                                if ($("#label_1").prop('checked') == true) {
                                    new_log['foggy_1'] = "ON";
                                } else {
                                    new_log['foggy_1'] = "OFF";
                                }
                            } else {
                                new_log['foggy_1'] = "OFF";
                                $('.status_config_manual_1').hide();
                            }
                            if (parseInt(config_cn2.cn_status_10) == 1) {
                                if ($("#label_2").prop('checked') == true) {
                                    new_log['foggy_2'] = "ON";
                                } else {
                                    new_log['foggy_2'] = "OFF";
                                }
                            } else {
                                new_log['foggy_2'] = "OFF";
                                $('.status_config_manual_2').hide();
                            }
                            new_log['spray'] = sw_log.spray;
                            new_log['shading'] = sw_log.shading;
                        }
                        let new_log2 = {
                            'dripper_1': new_log.dripper_1,
                            'dripper_2': new_log.dripper_2,
                            'dripper_3': new_log.dripper_3,
                            'dripper_4': new_log.dripper_4,
                            'fan_1': new_log.fan_1,
                            'fan_2': new_log.fan_2,
                            'fan_3': new_log.fan_3,
                            'fan_4': new_log.fan_4,
                            'foggy_1': new_log.foggy_1,
                            'foggy_2': new_log.foggy_2,
                            'spray': new_log.spray,
                            'shading': new_log.shading,
                        };
                        delete sw_log['serial_id'];
                        delete sw_log['control_user'];
                        // console.log(JSON.stringify(sw_log));
                        // console.log(JSON.stringify(new_log2));
                        if (mode == 'close') {
                            if (JSON.stringify(sw_log) == JSON.stringify(new_log2)) {
                                $(".menu_config_manual").show();
                                $('.status_config_manual').hide();
                                $(".sw_mode_Auto").attr('disabled', false);
                                $(".sw_mode_Manual").attr('disabled', false);
                                $("#save_manual_cont").hide();
                                $("#close_manual_cont").hide();
                                fn_df_sw_manual(numb);
                            } else {
                                swal({
                                    'title': 'คุณแน่ใจหรือไม่?',
                                    'text': "คุณต้องการยกเลิกการตั้งค่า?",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'showCancelButton': true,
                                    'confirmButtonColor': '#da3444',
                                    'cancelButtonColor': '#8e8e8e',
                                    'confirmButtonText': 'ยืนยัน',
                                    'cancelButtonText': 'ยกเลิก',
                                }).then((result) => {
                                    if (result.value) {
                                        $(".menu_config_manual").show();
                                        $('.status_config_manual').hide();
                                        $(".sw_mode_Auto").attr('disabled', false);
                                        $(".sw_mode_Manual").attr('disabled', false);
                                        $("#save_manual_cont").hide();
                                        $("#close_manual_cont").hide();
                                        fn_df_sw_manual(numb);
                                    }
                                });
                            }
                        }
                        else {
                            if (JSON.stringify(sw_log) == JSON.stringify(new_log2)) {
                                $("#save_manual_cont").hide();
                            } else {
                                $("#save_manual_cont").show();
                            }
                        }
                    }

                    $("#save_manual_cont").click(function() {
                        let log_sw = [], n_countSB = [], numb = $('.hidden_select_sw_manual').val();
                        if (numb == 1) {
                            if (parseInt(config_cn2.cn_status_1) == 1) {
                                if ($("#label_1").prop('checked') == true) {
                                    log_sw['sw_1'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_1'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_1'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_2) == 1) {
                                if ($("#label_2").prop('checked') == true) {
                                    log_sw['sw_2'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_2'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_2'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_3) == 1) {
                                if ($("#label_3").prop('checked') == true) {
                                    log_sw['sw_3'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_3'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_3'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_4) == 1) {
                                if ($("#label_4").prop('checked') == true) {
                                    log_sw['sw_4'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_4'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_4'] = "OFF";
                                n_countSB.push(0);
                            }

                        }
                        else if (numb == 2) {
                            if (parseInt(config_cn2.cn_status_5) == 1) {
                                if ($("#label_1").prop('checked') == true) {
                                    log_sw['sw_1'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_1'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_1'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_6) == 1) {
                                if ($("#label_2").prop('checked') == true) {
                                    log_sw['sw_2'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_2'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_2'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_7) == 1) {
                                if ($("#label_3").prop('checked') == true) {
                                    log_sw['sw_3'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_3'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_3'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_8) == 1) {
                                if ($("#label_4").prop('checked') == true) {
                                    log_sw['sw_4'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_4'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_4'] = "OFF";
                                n_countSB.push(0);
                            }
                        }
                        else if (numb == 3) {
                            if (parseInt(config_cn2.cn_status_9) == 1) {
                                if ($("#label_1").prop('checked') == true) {
                                    log_sw['sw_1'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_1'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_1'] = "OFF";
                                n_countSB.push(0);
                            }
                            if (parseInt(config_cn2.cn_status_10) == 1) {
                                if ($("#label_2").prop('checked') == true) {
                                    log_sw['sw_2'] = "ON";
                                    n_countSB.push(1);
                                } else {
                                    log_sw['sw_2'] = "OFF";
                                    n_countSB.push(0);
                                }
                            } else {
                                log_sw['sw_2'] = "OFF";
                                n_countSB.push(0);
                            }
                            log_sw['sw_3'] = "OFF";
                            log_sw['sw_4'] = "OFF";
                        }
                        if (countElement(1, n_countSB) == 0) {
                            swal({
                                    'html': 'ต้องมีอุปกรณ์เปิดใช้งาน<br>อย่างน้อย 1 ตัว !',
                                    // text: "ต้องมีอุปกรณ์เปิดใช้งานอย่างน้อย 1 ตัว !",
                                    'type': 'warning',
                                    'allowOutsideClick': false,
                                    'confirmButtonColor': '#32CD32'
                                })
                                // then((result) => {
                                //     if (result.value) {
                                //         location.reload();
                                //         return false;
                                //     }
                                // });
                        }
                        else {
                            swal({
                                'title': 'บันทึกการเปลี่ยนแปลง',
                                'text': "คุณต้องการบันทึกการเปลี่ยนแปลง ?",
                                'type': 'warning',
                                'allowOutsideClick': false,
                                'showCancelButton': true,
                                'confirmButtonColor': '#32CD32',
                                'cancelButtonColor': '#FF3333',
                                'confirmButtonText': 'ใช่',
                                'cancelButtonText': 'ยกเลิก'
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        'type': "POST",
                                        'url': "routes/tu/save_config_mqtt.php",
                                        'data': {
                                            'house_master': house_master,
                                            'mess': {
                                                'sw_1': log_sw['sw_1'],
                                                'sw_2': log_sw['sw_2'],
                                                'sw_3': log_sw['sw_3'],
                                                'sw_4': log_sw['sw_4']
                                            },
                                            'channel': numb,
                                            'mode': 'set_manual'
                                        },
                                        'dataType': 'json',
                                        success: function(res) {
                                            console.log(res)
                                            if (res.status == "Insert_Success") {
                                                swal({
                                                    'title': 'บันทึกข้อมูลสำเร็จ',
                                                    'type': 'success',
                                                    'allowOutsideClick': false,
                                                    'confirmButtonColor': '#32CD32'
                                                });
                                                $(".menu_config_manual").show();
                                                $('.status_config_manual').hide();
                                                $('#close_manual_cont').show();
                                                $(".sw_mode_Auto").attr('disabled', false);
                                                $(".sw_mode_Manual").attr('disabled', false);
                                                $("#save_manual_cont").hide();
                                                $("#close_manual_cont").hide();
                                                fn_label_manual($('.hidden_select_sw_manual').val());
                                            } else {
                                                swal({
                                                    'title': 'Error !',
                                                    'text': "เกิดข้อผิดพลาด ?",
                                                    'type': 'error',
                                                    'allowOutsideClick': false,
                                                    'confirmButtonColor': '#32CD32'
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
                    }); // exit_save_Manual
                });
                // label_manual
                function fn_label_manual(val) {
                    let config_parse = JSON.parse($('#val_config').val());
                    let sw_log = config_parse.config_manual;//$.parseJSON($('#val_sw_manual').val());
                    // console.log(sw_log);
                    // return false;
                    if (val == 1) {
                        $('.title_load_manual').html('ควบคุมน้ำหยด');
                        $('.menu_config_manual').show();
                        $('.label_1').html('น้ำหยด 1');
                        $('.label_2').html('น้ำหยด 2');
                        $('.label_3').html('น้ำหยด 3');
                        $('.label_4').html('น้ำหยด 4');
                        if ($('#close_manual_cont').is(":hidden") == true) {
                            if (parseInt(config_cn2.cn_status_1) == 1) {
                                if (sw_log.dripper_1 == 'ON') {
                                    $('.label_1').show();
                                } else {
                                    $('.label_1').hide();
                                }
                            } else {
                                $('.label_1').hide();
                                $('.status_config_manual_1').hide();
                            }
                            if (parseInt(config_cn2.cn_status_2) == 1) {
                                if (sw_log.dripper_2 == 'ON') {
                                    $('.label_2').show();
                                } else {
                                    $('.label_2').hide();
                                }
                            } else {
                                $('.label_2').hide();
                                $('.status_config_manual_2').hide();
                            }
                            if (parseInt(config_cn2.cn_status_3) == 1) {
                                if (sw_log.dripper_3 == 'ON') {
                                    $('.label_3').show();
                                } else {
                                    $('.label_3').hide();
                                }
                            } else {
                                $('.label_3').hide();
                                $('.status_config_manual_3').hide();
                            }
                            if (parseInt(config_cn2.cn_status_4) == 1) {
                                if (sw_log.dripper_4 == 'ON') {
                                    $('.label_4').show();
                                } else {
                                    $('.label_4').hide();
                                }
                            } else {
                                $('.label_4').hide();
                                $('.status_config_manual_4').hide();
                            }
                        }
                        if (countElement(1, status_dripper) > 1) {
                            $('.menu_config_manual').show();
                        } else {
                            $('.menu_config_manual').hide();
                            $('.label_1').hide();
                            $('.label_2').hide();
                            $('.label_3').hide();
                            $('.label_4').hide();
                        }
                    } else if (val == 2) {
                        $('.title_load_manual').html('ควบคุมพัดลม');
                        $('.label_1').html('พัดลม 1');
                        $('.label_2').html('พัดลม 2');
                        $('.label_3').html('พัดลม 3');
                        $('.label_4').html('พัดลม 4');
                        if ($('#close_manual_cont').is(":hidden") == true) {
                            if (parseInt(config_cn2.cn_status_5) == 1) {
                                if (sw_log.fan_1 == 'ON') {
                                    $('.label_1').show();
                                } else {
                                    $('.label_1').hide();
                                }
                            } else {
                                $('.label_1').hide();
                                $('.status_config_manual_1').hide();
                            }
                            if (parseInt(config_cn2.cn_status_6) == 1) {
                                if (sw_log.fan_2 == 'ON') {
                                    $('.label_2').show();
                                } else {
                                    $('.label_2').hide();
                                }
                            } else {
                                $('.label_2').hide();
                                $('.status_config_manual_2').hide();
                            }
                            if (parseInt(config_cn2.cn_status_7) == 1) {
                                if (sw_log.fan_3 == 'ON') {
                                    $('.label_3').show();
                                } else {
                                    $('.label_3').hide();
                                }
                            } else {
                                $('.label_3').hide();
                                $('.status_config_manual_3').hide();
                            }
                            if (parseInt(config_cn2.cn_status_8) == 1) {
                                if (sw_log.fan_4 == 'ON') {
                                    $('.label_4').show();
                                } else {
                                    $('.label_4').hide();
                                }
                            } else {
                                $('.label_4').hide();
                                $('.status_config_manual_4').hide();
                            }
                        }
                        if (countElement(1, status_fan) > 1) {
                            $('.menu_config_manual').show();
                        } else {
                            $('.menu_config_manual').hide();
                            $('.label_1').hide();
                            $('.label_2').hide();
                            $('.label_3').hide();
                            $('.label_4').hide();
                        }
                    } else if (val == 3) {
                        $('.title_load_manual').html('ควบคุมพ่นหมอก');
                        $('.label_1').html('พ่นหมอก 1');
                        $('.label_2').html('พ่นหมอก 2');
                        if ($('#close_manual_cont').is(":hidden") == true) {
                            if (parseInt(config_cn2.cn_status_9) == 1) {
                                if (sw_log.foggy_1 == 'ON') {
                                    $('.label_1').show();
                                } else {
                                    $('.label_1').hide();
                                }
                            } else {
                                $('.label_1').hide();
                                $('.status_config_manual_1').hide();
                            }
                            if (parseInt(config_cn2.cn_status_10) == 1) {
                                if (sw_log.foggy_2 == 'ON') {
                                    $('.label_2').show();
                                } else {
                                    $('.label_2').hide();
                                }
                            } else {
                                $('.label_2').hide();
                                $('.status_config_manual_2').hide();
                            }
                            $('.label_3').hide();
                            $('.label_4').hide();
                            $('.status_config_manual_3').hide();
                            $('.status_config_manual_4').hide();
                        }
                        if (countElement(1, status_foggy) > 1) {
                            $('.menu_config_manual').show();
                        } else {
                            $('.menu_config_manual').hide();
                            $('.label_1').hide();
                            $('.label_2').hide();
                            $('.label_3').hide();
                            $('.label_4').hide();
                        }
                    } else if (val == 4) {
                        $('.title_load_manual').html('ควบคุมสเปรย์');
                    } else if (val == 5) {
                        $('.title_load_manual').html('ควบคุมม่านพรางแสง');
                    }
                    if (val >= 4) {
                        $('.menu_config_manual').hide();
                        $('.label_1').hide();
                        $('.label_2').hide();
                        $('.label_3').hide();
                        $('.label_4').hide();
                    }
                }
                // switch_manual
                function fn_df_sw_manual(val) {
                    for (let i = 1; i <= 5; i++) {
                        if (i == val) {
                            $("#s" + i).addClass('active'); // .addClass('btn-outline-success')
                        } else {
                            $('#s' + i).removeClass('active') //.removeClass('btn-outline-success')
                        }
                    }
                    fn_label_manual(val);
                }
                $('.sw_manual_on').click(function() {
                    if ($(this).hasClass("active") == false) {
                        switch_control("ON", $('.hidden_select_sw_manual').val());
                    }
                });
                $('.sw_manual_off').click(function() {
                    if ($(this).hasClass("active") == false) {
                        switch_control("OFF", $('.hidden_select_sw_manual').val());
                    }
                });
                function switch_control(sts, val) {
                    let config_parse = JSON.parse($('#val_config').val());
                    let sw_log = config_parse.config_manual;//$.parseJSON($('#val_sw_manual').val());
                    let status, name, sw_1, sw_2, sw_3, sw_4, mqtt_name_1, mqtt_name_2, mqtt_name_3, mqtt_name_4;
                    if (sts == "ON") { status = 'เปิด'; }
                    else { status = 'ปิด'; }
                    if (val == 1) {
                        name = 'น้ำหยด';
                        if (sw_log.dripper_1 == 'ON') {
                            sw_1 = 1;
                            mqtt_name_1 = 'dripper_1';
                        } else { sw_1 = 0; }
                        if (sw_log.dripper_2 == 'ON') {
                            sw_2 = 1;
                            mqtt_name_2 = 'dripper_2';
                        } else { sw_2 = 0; }
                        if (sw_log.dripper_3 == 'ON') {
                            sw_1 = 3;
                            mqtt_name_3 = 'dripper_3';
                        } else { sw_3 = 0; }
                        if (sw_log.dripper_4 == 'ON') {
                            sw_4 = 1;
                            mqtt_name_4 = 'dripper_4';
                        } else { sw_4 = 0; }
                    }
                    else if (val == 2) {
                        name = 'พัดลม';
                        if (sw_log.fan_1 == 'ON') {
                            sw_1 = 1;
                            mqtt_name_1 = 'fan_1';
                        } else { sw_1 = 0; }
                        if (sw_log.fan_2 == 'ON') {
                            sw_2 = 1;
                            mqtt_name_2 = 'fan_2';
                        } else { sw_2 = 0; }
                        if (sw_log.fan_3 == 'ON') {
                            sw_1 = 3;
                            mqtt_name_3 = 'fan_3';
                        } else { sw_3 = 0; }
                        if (sw_log.fan_4 == 'ON') {
                            sw_4 = 1;
                            mqtt_name_4 = 'fan_4';
                        } else { sw_4 = 0; }
                    }
                    else if (val == 3) {
                        name = 'พ่นหมอก';
                        if (sw_log.foggy_1 == 'ON') {
                            sw_1 = 1;
                            mqtt_name_1 = 'foggy_1';
                        } else { sw_1 = 0; }
                        if (sw_log.foggy_2 == 'ON') {
                            sw_2 = 1;
                            mqtt_name_2 = 'foggy_2';
                        } else { sw_2 = 0; }
                        sw_3 = 0;
                        sw_4 = 0;
                    }
                    else if (val == 4) {
                        name = 'สเปรย์';
                        sw_1 = 1;
                        mqtt_name_1 = 'spray';
                        sw_2 = 0;
                        sw_3 = 0;
                        sw_4 = 0;
                    }
                    else if (val == 5) {
                        name = 'ม่านพรางแสง';
                        mqtt_name_1 = 'shading';
                        sw_1 = 1;
                        sw_2 = 0;
                        sw_3 = 0;
                        sw_4 = 0;
                    }
                    swal({
                        'title': 'คุณต้องการ ' + status + ' ' + name + ' ?',
                        // text: "คุณต้องการเปลี่ยนไปใช้โหมด Manual !!!",
                        'type': 'warning',
                        'allowOutsideClick': false,
                        'showCancelButton': true,
                        'confirmButtonColor': '#32CD32',
                        'cancelButtonColor': '#FF3333',
                        'confirmButtonText': 'ใช่',
                        'cancelButtonText': 'ยกเลิก'
                    }).then((result) => {
                        // console.log(result)
                        if (result.value) {
                            // alert(sta)
                            // return false;

                            $.ajax({
                                'type': "POST",
                                'url': "routes/tu/save_config_mqtt.php",
                                'data': {
                                    'house_master': house_master,
                                    'mess': sts,
                                    'channel': val,
                                    'mode': 'manual_load'
                                },
                                'dataType': 'json',
                                success: function(res) {
                                    console.log(res)
                                    if (res.status == "Insert_Success") {
                                        swal({
                                            'title': 'ส่งข้อมูลสำเร็จ',
                                            'type': 'success',
                                            'allowOutsideClick': false,
                                            'confirmButtonColor': '#32CD32'
                                        });
                                    } else {
                                        swal({
                                            'title': 'Error !',
                                            'text': "เกิดข้อผิดพลาด ?",
                                            'type': 'error',
                                            'allowOutsideClick': false,
                                            'confirmButtonColor': '#32CD32'
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
                // lock_panel
                $('.sw_mode_lock').click(function(){
                    if ($(this).hasClass("active") == false) {
                        switch_mode_lock('ล็อคปุ่มกดหน้าตู้', 'lock', '', 'lock_unlock');
                    }
                });
                $('.sw_mode_unlock').click(function(){
                    if ($(this).hasClass("active") == false) {
                        switch_mode_lock('ปลดล็อคปุ่มกดหน้าตู้', 'unlock', '', 'lock_unlock');
                    }
                });
                function switch_mode_lock(sw_name, mess, channel, mode) { // หังก์ชั่น lock_panel
                    swal({
                        'title': 'ตั้งค่าปุ่มกดหน้าตู้ !',
                        'text': "คุณต้องการ " + sw_name + " ?",
                        'type': 'warning',
                        'allowOutsideClick': false,
                        'showCancelButton': true,
                        'confirmButtonColor': '#32CD32',
                        'cancelButtonColor': '#FF3333',
                        'confirmButtonText': 'ใช่',
                        'cancelButtonText': 'ยกเลิก'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                'type': "POST",
                                'url': "routes/tu/save_config_mqtt.php",
                                'data': {
                                    'house_master': house_master,
                                    'mess': mess,
                                    'channel': channel,
                                    'mode': mode
                                },
                                'dataType': 'json',
                                success: function(res) {
                                    // console.log(res)
                                    // return false;
                                    if (res.status == "Insert_Success") {
                                        fn_df_checkbox_auto($('.hidden_select_sw_auto').val());
                                        swal({
                                            'title': 'ส่งข้อมูลสำเร็จ',
                                            'type': 'success',
                                            'allowOutsideClick': false,
                                            'confirmButtonColor': '#32CD32'
                                        });
                                    } else {
                                        swal({
                                            'title': 'Error !',
                                            'text': "เกิดข้อผิดพลาด ?",
                                            'type': 'error',
                                            'allowOutsideClick': false,
                                            'confirmButtonColor': '#32CD32'
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
            });
        });
    </script>
