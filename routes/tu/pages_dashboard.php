
<style>
    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20px;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20px;
    }

    .no-gutters {
        margin-right: 0;
        margin-left: 0;
    }

    .no-gutters>.col,
    .no-gutters>[class*="col-"] {
        padding-right: 0;
        padding-left: 0;
    }
    .text_font_size{
        font-size:16px;
    }
</style>
<div class="page-content">
    <?php
        $config = $_POST['data'];
        $account_user = $config["account_user"];
        $s_sensor = $_POST['s_sensor'];
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
        <div class="breadcrumb-title pe-3"> <h5><?= $s_master['site_name'] ?></h5> </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a> </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <h5><?= $s_master['house_name'] ?></h5>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <!-- <div class="btn-group"> -->
                <!-- <span class="text-center"> -->
                    <h5 class="date"></h5>
                    <!-- <span class="time"></span> -->
                <!-- </span> -->
            <!-- </div> -->
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- <h5 class="mb-0 text-uppercase">Horizontal Card</h5> -->
    <hr />
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4 col-sm-12 d-flex">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="card radius-10 shadow-none">
                        <img src="public/images/site/<?= $house_img ?>" alt="..." class="card-img">
                    </div>
                    <div class="card radius-10 shadow-none">
                        <div class="card-body border radius-10 shadow-none mb-3">
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                <div class="d-flex">
                                    <h5>ที่ตั้ง : <b>
                                            <?= $s_master["site_address"] ?>
                                        </b></h5>
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
                            <?php if($config['userLevel'] < 3){?>
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
                            <?php } ?>
                            <!-- <div class="col-12">
                                <div class="d-flex">
                                    <h5>จุดติดตั้งเซ็นเซอร์ : <b class="image-popups">
                                        <?php if($s_master["house_img_map"] != ""){
                                                echo '<a href="public/images/img_map/'.$s_master["house_img_map"].'"><i class="lni lni-map-marker"></i></a>';
                                            }else{echo "-";}?></b>
                                    </h5>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 col-xl-8 col-sm-12 d-flex">
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
                                <h5 class="text-center">ข้อมูลเซนเซอร์นอกโรงเรือน</h5>
                                <div class="row text-center">
                                    <?php for($i = 1; $i <= 3; $i++){
                                        if($config_sn['sn_status_'.$i] == 1){ ?>
                                            <div class="col-lg-4 col-xl-4 col-sm-12">
                                                <div class="card-body border radius-10 shadow-none mb-3">
                                                    <div class="col">
                                                        <h5 class="card-title mt-2 "><B>
                                                                <?php //$config_sn['sn_name_'.$i]
                                                                    if($i == 1){echo "อุณหภูมิ";}elseif($i == 2){ echo "ความชื้น"; }elseif($i == 3){ echo "ความเข้มแสง"; }
                                                                ?>
                                                            </B></h5>
                                                        <div class="ms-auto mt-2 image-popups">
                                                            <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                                    echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker "></i></a>';
                                                                }?>
                                                        </div>
                                                    </div>
                                                    <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle" style="width:88px; margin-top:10px; text-align: center!important;">
                                                    <h5 class="card-text text-center dash_data__<?= $i ?>" style="margin-top:20px; font-size:1.5vw">
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
                            <h5 class="text-center">ข้อมูลเซนเซอร์ในโรงเรือน</h5>
                            <div class="row text-center">
                                <?php for($i = 4; $i <= 7; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                <div class="col-lg-3 col-xl-3 col-sm-12">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="col">
                                            <h5 class="card-title text-center mt-2 ">
                                                <B> <?php if($i == 4){echo "อุณหภูมิ";}elseif($i == 5){ echo "ความชื้น"; }elseif($i == 6){ echo "ความเข้มแสง"; }elseif($i == 7){ echo "ความชื้นดิน"; } ?> </B>
                                            </h5>
                                            <div class="ms-auto mt-2 image-popups">
                                                <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                        echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker"></i></a>';
                                                    }?>
                                            </div>
                                        </div>
                                        <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle" style="width:88px; margin-top:10px; text-align: center!important;">
                                        <h5 class="card-text text-center dash_data__<?= $i ?>" style="margin-top:20px; font-size:1.5vw">
                                        </h5>
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
        <div class="col-12 col-lg-12 col-xl-12 col-sm-12 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body">
                    <div class="card-body text-center">
                        <h5 class="card-title text-center"><b>สถานะการทำงาน </b></h5>
                        <!-- <h5 class="card-title text-center"><b>โหมดอัตโนมัติ </b></h5> -->
                        <!-- <div class="row g-2"> -->
                        <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12" > -->
                        <button type="button" class="btn btn-outline-success px-5 radius-30 dash_mode active" style="font-size:1.25rem"></button>
                        <!-- </div> -->
                        <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12">
                                    <button type="button" class="col-lg-6 col-xl-6 col-sm-12 col-12 btn btn-outline-info px-5 radius-30 sw_mode_Manual" style="font-size:18px">โหมดสั่งงานด้วยตนเอง</button>
                                </div> -->
                        <!-- </div> -->
                    </div>
                    <div class="row">
                        <?php for($i = 1; $i <= 12; $i++){
                            if($config_cn['cn_status_'.$i] == 1){ ?>
                                <div class="col-lg-3 col-xl-3 col-sm-12">
                                    <div class="card-body border radius-10 shadow-none mb-3">
                                        <div class="text-center"><h5 style="font-size:1.5vw"><b>
                                            <?php
                                                if($i <= 4){echo 'น้ำหยด '.$i;}
                                                elseif($i > 4 && $i <= 8){echo 'พัดลม '.($i-4);}
                                                elseif($i > 8 && $i <= 10){echo 'พ่นหมอก '.($i-8);}
                                                elseif($i == 11){echo 'สเปรย์';}
                                                elseif($i == 12){echo 'ม่านพรางแสง';}
                                            ?></b></h5>
                                        </div>
                                        <div class="text-center">
                                            <img class="dash_img_con_<?= $i ?>" style="width:15vh">
                                        </div>
                                    </div>
                                </div>
                            <?php }
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
                                <h4 class="modal-title"><b>ระบบควบคุม</b></h4>
                                <div class="ms-auto">
                                    <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"
                                        aria-label="Close"> <span aria-hidden="true"></span> </button>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg sw_mode_Auto" style="width: 100%; border-radius:20px;">อัตโนมัติ</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-lg  sw_mode_Manual" style="width: 100%;  border-radius:20px;">กำหนดเอง</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2 ul_Auto">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row"><?php
                                            if($config_cn['cn_status_1'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="1">
                                                            <div class="text_font_size">'.$config_cn['cn_name_1'].'</div>
                                                             <img class="img_sw_sel_load_auto1" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_2'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="2">
                                                            <div class="text_font_size">'.$config_cn['cn_name_2'].'</div>
                                                             <img class="img_sw_sel_load_auto2" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_3'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="3">
                                                            <div class="text_font_size">'.$config_cn['cn_name_3'].'</div>
                                                             <img class="img_sw_sel_load_auto3" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_4'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="4">
                                                            <div class="text_font_size">'.$config_cn['cn_name_4'].'</div>
                                                             <img class="img_sw_sel_load_auto4" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row"><?php
                                            if($config_cn['cn_status_5'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="5">
                                                            <div class="text_font_size">'.$config_cn['cn_name_5'].'</div>
                                                             <img class="img_sw_sel_load_auto5" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_6'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="6">
                                                            <div class="text_font_size">'.$config_cn['cn_name_6'].'</div>
                                                             <img class="img_sw_sel_load_auto6" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_7'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="7">
                                                            <div class="text_font_size">'.$config_cn['cn_name_7'].'</div>
                                                             <img class="img_sw_sel_load_auto7" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_8'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="8">
                                                            <div class="text_font_size">'.$config_cn['cn_name_8'].'</div>
                                                             <img class="img_sw_sel_load_auto8" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row"><?php
                                            if($config_cn['cn_status_9'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="9">
                                                            <div class="text_font_size">'.$config_cn['cn_name_9'].'</div>
                                                             <img class="img_sw_sel_load_auto9" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_10'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="10">
                                                            <div class="text_font_size">'.$config_cn['cn_name_10'].'</div>
                                                             <img class="img_sw_sel_load_auto10" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_11'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="11">
                                                            <div class="text_font_size">'.$config_cn['cn_name_11'].'</div>
                                                             <img class="img_sw_sel_load_auto11" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            }
                                            if($config_cn['cn_status_12'] == 1){
                                                echo '<div class="col-3 col-lg-6">
                                                         <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="12">
                                                            <div class="text_font_size">พรางแสง</div>
                                                             <img class="img_sw_sel_load_auto12" src="" width="70" />
                                                         </button>
                                                    </div>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                   // echo '<ul class="nav mt-3">';
                                   // for($i = 1; $i <= 12; $i++){
                                   //      if($config_cn['cn_status_'.$i] == 1){
                                   //          if($i == 12){
                                   //              echo '<li class="nav-item col-3 col-lg-2">
                                   //                      <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="'.$i.'">พรางแสง<br>
                                   //                          <img class="img_sw_sel_load_auto'.$i.'" src="" width="70" />
                                   //                      </button>
                                   //                 </li>';
                                   //          }else {
                                   //              echo '<li class="nav-item col-3 col-lg-2">
                                   //                  <button class="btn btn-control sw_sel_load_auto" style="width:100% " id="'.$i.'">'.$config_cn['cn_name_'.$i].'<br>
                                   //                      <img class="img_sw_sel_load_auto'.$i.'" src="" width="70" />
                                   //                  </button>
                                   //             </li>';
                                   //          }
                                   //      }
                                   //  }
                                   // echo "</ul>";
                                ?>

                                <input type="hidden" class="hidden_select_sw_auto">
                            </div>
                            <div class="row cols-10 text-center mt-2 ul_Manual">
                                <?php
                                    if($config_cn['cn_status_1'] == 1 || $config_cn['cn_status_2'] == 1 || $config_cn['cn_status_3'] == 1 || $config_cn['cn_status_4'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_sel_load_manual" style="width:100% border-radius:20px;" id="s1">
                                                    <div class="text_font_size">น้ำหยด</div>
                                                    <img class="img_sw_sel_load_manual_1" width="70"  src=""  />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_9'] == 1 || $config_cn['cn_status_10'] == 1){
                                        echo '<div class="cols-3 cols-lg-5" >
                                                <button class="btn btn-control sw_sel_load_manual" style="width:100% " id="s3">
                                                    <div class="text_font_size">พ่นหมอก</div>
                                                    <img class="img_sw_sel_load_manual_3" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_11'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_sel_load_manual" style="width:100% " id="s4">
                                                    <div class="text_font_size">สเปรย์</div>
                                                    <img class="img_sw_sel_load_manual_4" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_5'] == 1 || $config_cn['cn_status_6'] == 1 || $config_cn['cn_status_7'] == 1 || $config_cn['cn_status_8'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_sel_load_manual" style="width:100% " id="s2">
                                                    <div class="text_font_size">พัดลม</div>
                                                    <img class="img_sw_sel_load_manual_2" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_12'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_sel_load_manual" style="width:100% " id="s5">
                                                    <div class="text_font_size">พรางแสง</div>
                                                    <img class="img_sw_sel_load_manual_5" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                ?>
                                <input type="hidden" class="hidden_select_sw_manual">
                            </div>
                        </div>
    				</div>
    				<div class="modal-body">
                        <div class="container ul_Auto">
                            <div class="row ridge">
                                <div class="d-flex align-items-center"
                                    style="background-color: #283A6C; text-align: justify;">
                                    <a><b class="title_load_auto " style="color:#FFF; font-size:20px"> </b></a>
                                    <div class="ms-auto">
                                        <a class="menu_config_auto" style="color:#FFF; font-size:16px" href="javascript:void(0)"><b> <i class='bx bx-cog'></i> ตั้งค่า</b></a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                            for($i = 1; $i <=6; $i++){
                                                echo '<div class="col-12 border-bottom">
                                                    <div class="d-flex align-items-center mb-2 mt-2">
                                                        <div class="pt-2">TIMER '.$i.'</div>
                                                        <div class="ms-auto">
                                                            <img class="img_sw img_'.$i.'" src="" alt="">
                                                            <div class="sw_toggle">
                                                                <input class="input_check" type="checkbox" id="swch_'.$i.'" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <div class="form-group text-left">
                                                                <div class="row">
                                                                    <div class="col-md-3 align-vertical-center">
                                                                        <small class="form-control-feedback"> START </small>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="time" id="time_s_'.$i.'" class="form-control input_time">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group text-left">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <small class="form-control-feedback"> END </small>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input type="time" id="time_e_'.$i.'" class="form-control input_time">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Exit ul_Auto -->
                        <!-- ================================ -->
                        <div class="container ul_Manual">
                            <div class="row ridge">
                                <h3 class="text-center title_load_manual" style="background-color: #283A6C; color:#FFF"></h3>
                                <div class="col text-end  me-2 mb-3 mt-2">
                                     <button class="btn sw_manual_on"></button>
                                </div>
                                <div class="col text-start ms-2 mb-3 mt-2">
                                     <button class="btn sw_manual_off"></button>
                                </div>
                            </div>
                        </div>
    				</div>
    				<div class="modal-footer">
                        <div class="ul_Auto">
                            <button type="button" id="save_auto_cont" class="btn btn-success waves-light">
                                <i class="fadeIn animated bx bx-save"></i> บันทึก
                            </button>
                            <button type="button" id="close_auto_cont" class="btn btn-danger waves-effect">
                                <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                            </button>
                        </div>
    					<div class="ul_Manual" style="width: 100%;">
                            <div class="d-flex align-items-center">
                                <div class="form-check status_config_manual">
                                    <input class="form-check-input " type="checkbox" id="checkbox_all_manual">
                                    <label class="form-check-label text_font_size ">เลือกทั้งหมด</label>
                                </div>
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-outline-secondary px-5 radius-30 menu_config_manual"><label class="text_font_size">ตั้งค่า</label></button>
                                    <input type="hidden" id="val_sw_manual">
                                    <input type="hidden" id="val_sw_auto">
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
                                    <label class="text_font_size label_1"></label>
                                    <div class="status_config_manual">
                                        <input class="input_check2" type="checkbox" id="label_1" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <label class="text_font_size label_2"></label>
                                    <div class="status_config_manual">
                                        <input class="input_check2" type="checkbox" id="label_2" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <label class="text_font_size label_3"></label>
                                    <div class="status_config_manual status_config_manual_3">
                                        <input class="input_check2" type="checkbox" id="label_3" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                    </div>
                                </div>
                                <div class="col-3 text-center">
                                    <label class="text_font_size label_4"></label>
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
    <div class="col-12 col-lg-12 col-xl-12 d-flex chart">
        <div class="card w-100 radius-10">
            <div class="card-body">
                <div class="d-flex">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item btn_ch_t" role="presentation">
                            <a class="nav-link btn_ch_t" data-bs-toggle="pill" href="#hreft_temp" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">อุณหภูมิ</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link btn_ch_h" data-bs-toggle="pill" href="#hreft_hum" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">ความชื้นอากาศ</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link btn_ch_l" data-bs-toggle="pill" href="#hreft_light" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">ความเข้มแสง</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link btn_ch_s" data-bs-toggle="pill" href="#hreft_soil" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title" >ความชื้นดิน</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- <div class="tab-content" id="pills-tabContent"> -->
					<!-- <div class="tab-pane fade" id="hreft_temp" role="tabpanel"> -->
		                <!-- <div class="chartdiv" id="chart1"></div> -->
					<!-- </div>
					<div class="tab-pane fade" id="hreft_hum" role="tabpanel"> -->
    				    <!-- <div class="chartdiv" id="chart2"></div> -->
					<!-- </div>
					<div class="tab-pane fade" id="hreft_light" role="tabpanel"> -->
    				    <!-- <div class="chartdiv" id="chart3"></div> -->
					<!-- </div>
					<div class="tab-pane fade" id="hreft_soil" role="tabpanel"> -->
    				    <!-- <div class="chartdiv" id="chart4"></div> -->
					<!-- </div> -->
				<!-- </div> -->
                <div class="chartdiv" id="chart_realtime"></div>
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
    var s_sensor = $.parseJSON('<?= json_encode($s_sensor) ?>');
    console.log(sensor);
    var data_temp_out = [];
    var data_temp_in = [];
    var data_hum_out = [];
    var data_hum_in = [];
    var data_light_out = [];
    var data_light_in = [];
    var data_soil_in = [];
    // console.log(Number(house_master.substring(5,10)))
    if(config_cn.cn_status_1 == 1 || config_cn.cn_status_2 == 1 || config_cn.cn_status_3 == 1 || config_cn.cn_status_4 == 1){
        $('.hidden_select_sw_manual').val(1);
    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 || config_cn.cn_status_5 == 1 || config_cn.cn_status_6 == 1 || config_cn.cn_status_7 == 1 || config_cn.cn_status_8 == 1){
        $('.hidden_select_sw_manual').val(2)
    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 || config_cn.cn_status_9 == 1 || config_cn.cn_status_10 == 1){
        $('.hidden_select_sw_manual').val(3)
    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 || config_cn.cn_status_11 == 1){
        $('.hidden_select_sw_manual').val(4)
    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 && config_cn.cn_status_11 == 0 || config_cn.cn_status_12 == 1){
        $('.hidden_select_sw_manual').val(5)
    }
    // -------------------------------------
    if(config_cn.cn_status_1 == 1){
        $('.hidden_select_sw_auto').val(1);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 1) {
        $('.hidden_select_sw_auto').val(2);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 1) {
        $('.hidden_select_sw_auto').val(3);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 1) {
        $('.hidden_select_sw_auto').val(4);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 1) {
        $('.hidden_select_sw_auto').val(5);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 1) {
        $('.hidden_select_sw_auto').val(6);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 1) {
        $('.hidden_select_sw_auto').val(7);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 1) {
        $('.hidden_select_sw_auto').val(8);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 1) {
        $('.hidden_select_sw_auto').val(9);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 1) {
        $('.hidden_select_sw_auto').val(10);
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 && config_cn.cn_status_11 == 1) {
        $('.hidden_select_sw_auto').val(11); //$("#11").addClass('active');
    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 && config_cn.cn_status_11 == 0 && config_cn.cn_status_12 == 1) {
        $('.hidden_select_sw_auto').val(12);
    }
    if(s_sensor.s_btnT > 0){
        $('.btn_ch_t').addClass('active');
        // $('#hreft_temp').addClass('active show');
    }
    else {
        $('.btn_ch_t').hide();
        if(s_sensor.s_btnH > 0){
            $('.btn_ch_h').addClass('active');
            // $('#hreft_hum').addClass('active show');
        }else {
            $('.btn_ch_h').hide();
            if(s_sensor.s_btnL > 0){
                $('.btn_ch_l').addClass('active');
                // $('#hreft_light').addClass('active show');
            }else {
                $('.btn_ch_l').hide();
                if(s_sensor.s_btnS > 0){
                    $('.btn_ch_s').addClass('active');
                    // $('#hreft_soil').addClass('active show');
                }else {
                    $('.btn_ch_s').hide();
                }
            }
        }
    }
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
            onSuccess: function (context) {
                // console.log("ไม่สามารถเชื่อมต่อกับ เครื่อง ได้ !!!!");
                // setInterval(function() {
                //     location.reload();
                // }, 30000);
                console.log("subscribed");
            }
        }
        client.subscribe(house_master + "/control/config/manual", options);
        client.subscribe(house_master + "/data_sensor/filter", options);
        client.subscribe(house_master + "/control/response", options);
        client.subscribe(house_master + "/control/config/auto", options);
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
        if(message.destinationName ==  house_master + "/control/config/manual"){
            var result = message.payloadString;
            var n_result = result.split('\r\n')
            // var parseJSON = $.parseJSON(result);
            // console.log(n_result);
            $('#val_sw_manual').val(JSON.stringify({
              "dripper_1":  result.split('\r\n')[2].split('=')[1],
              "dripper_2":  result.split('\r\n')[3].split('=')[1],
              "dripper_3":  result.split('\r\n')[4].split('=')[1],
              "dripper_4":  result.split('\r\n')[5].split('=')[1],
              "fan_1":      result.split('\r\n')[6].split('=')[1],
              "fan_2":      result.split('\r\n')[7].split('=')[1],
              "fan_3":      result.split('\r\n')[8].split('=')[1],
              "fan_4":      result.split('\r\n')[9].split('=')[1],
              "foggy_1":    result.split('\r\n')[10].split('=')[1],
              "foggy_2":    result.split('\r\n')[11].split('=')[1]
            }));
        }
        else if(message.destinationName == house_master + "/data_sensor/filter") {
            var result = message.payloadString;
            var parseJSON = $.parseJSON(result);
            // console.log('parseJSON')
            var time_t = parseJSON['time'];
            var ntime = time_t.substring(0, 5);
            $(".date").html(parseJSON['date']+' '+ntime);
            // $(".time").html(ntime);
            var data_ = parseJSON['data']
            // console.log(sensor)
            for (var i = 1; i <= 7; i++) {
                // console.log(config_sn['sn_sensor_'+i])
                //
                if (config_sn['sn_status_' + i] == 1) {
                    if (i == 1) {
                        dash_status(sn_data = (data_['temp_out'] * 1).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    } else if (i == 2) {
                        dash_status(sn_data = (data_['hum_out'] * 1).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    } else if (i == 3) {
                        dash_status(sn_data = (data_['light_out'] / 1000).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    } else if (i == 4) {
                        dash_status(sn_data = (data_['temp_in'] * 1).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    } else if (i == 5) {
                        dash_status(sn_data = (data_['hum_in'] * 1).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    } else if (i == 6) {
                        dash_status(sn_data = (data_['light_in'] / 1000).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    } else if (i == 7) {
                        dash_status(sn_data = (data_['soil_in'] * 1).toFixed(1), max = set_maxmin.Tmax, min = set_maxmin.Tmin)
                    }
                }
                function dash_status(sn_data, max, min) {
                    if (sn_data >= max) {
                        $(".dash_img_" + i).attr("src", "public/images/Sensor/" + sensor[(config_sn['sn_sensor_' + i] - 1)].sensor_imgMax);
                    } else if (sn_data < min) {
                        $(".dash_img_" + i).attr("src", "public/images/Sensor/" + sensor[(config_sn['sn_sensor_' + i] - 1)].sensor_imgMin);
                    } else {
                        $(".dash_img_" + i).attr("src", "public/images/Sensor/" + sensor[(config_sn['sn_sensor_' + i] - 1)].sensor_imgNor);
                    }
                    if (sensor[(config_sn['sn_sensor_' + i] - 1)].sensor_unit == 1) {
                        $(".dash_data__" + i).html(sn_data + " ℃");
                    } else {
                        $(".dash_data__" + i).html(sn_data + " " + sensor[(config_sn['sn_sensor_' + i] - 1)].sensor_unit);
                    }
                }
            }
            // Chart ----------------------------------------
            data_temp_out.shift();
            data_temp_in.shift();
            data_temp_out.push({
                x: parseJSON['date']+' '+ntime,
                y:(data_['temp_out'] * 1).toFixed(1)
            })
            data_temp_in.push({
                x: parseJSON['date']+' '+ntime,
                y:(data_['temp_in'] * 1).toFixed(1)
            })
            // -------------------
            data_hum_out.shift();
            data_hum_in.shift();
            data_hum_out.push({
                x: parseJSON['date']+' '+ntime,
                y: (data_['hum_out'] * 1).toFixed(1)
            })
            data_hum_in.push({
                x: parseJSON['date']+' '+ntime,
                y: (data_['hum_in'] * 1).toFixed(1)
            })
            // -------------------
            data_light_out.shift();
            data_light_in.shift();
            data_light_out.push({
                x: parseJSON['date']+' '+ntime,
                y:(data_['light_out'] / 1000).toFixed(1)
            })
            data_light_in.push({
                x: parseJSON['date']+' '+ntime,
                y:(data_['light_in'] / 1000).toFixed(1)
            })
            // -------------------
            data_soil_in.shift();
            data_soil_in.push({
                x: parseJSON['date']+' '+ntime,
                y:(data_['soil_in'] * 1).toFixed(1)
            })
            // -------------------
            if($('.btn_ch_t').hasClass('active') == true){
                // console.log(data_temp_out);
                // if(data_temp_out.length > 0){
                    chartLine.updateSeries([
                        {
                            name: config_sn.sn_name_1,
                            data: data_temp_out
                        }, {
                            name: config_sn.sn_name_4,
                            data: data_temp_in
                        }
                    ])
                // }
            }
            if($('.btn_ch_h').hasClass('active') == true){
                // if(data_hum_out.length > 0){
                    chartLine.updateSeries([
                        {
                            name: config_sn.sn_name_2,
                            data: data_hum_out
                        }, {
                            name: config_sn.sn_name_5,
                            data: data_hum_in
                        }
                    ])
                // }
            }
            if($('.btn_ch_L').hasClass('active') == true){
                // if(data_light_out.length > 0){
                    chartLine.updateSeries([
                        {
                            name: config_sn.sn_name_3,
                            data: data_light_out
                        }, {
                            name: config_sn.sn_name_6,
                            data: data_light_in
                        }
                    ])
                // }
            }
            if($('.btn_ch_s').hasClass('active') == true){
                // if(data_soil_in.length > 0){
                    chartLine.updateSeries([
                        {
                            name: config_sn.sn_name_7,
                            data: data_soil_in
                        }
                    ])
                // }
            }
        }
        else if(message.destinationName == house_master + "/control/response") {
            var result = message.payloadString;
            var parseJSON = $.parseJSON(result);
            // console.log(parseJSON)
            if (parseJSON.mode === 'Manual') {
                $('.dash_mode').html('โหมดกำหนดเอง');
                $('.sw_mode_Auto').removeClass('btn-success').addClass('btn-outline-success');
                $('.sw_mode_Manual').addClass('btn-success').removeClass('btn-outline-success');
                $('.ul_Auto').hide();
                $('.ul_Manual').show();
                var sw_log = $.parseJSON($('#val_sw_manual').val());
                var count_sw1 = [];
                var count_stats1_on = [];
                var count_sw2 = [];
                var count_stats2_on = [];
                var count_sw3 = [];
                var count_stats3_on = [];
                if(sw_log.dripper_1 == 'ON'){ count_sw1[1] = 1; }else { count_sw1[1] = 0; }
                if(sw_log.dripper_2 == 'ON'){ count_sw1[2] = 1; }else { count_sw1[2] = 0; }
                if(sw_log.dripper_3 == 'ON'){ count_sw1[3] = 1; }else { count_sw1[3] = 0; }
                if(sw_log.dripper_4 == 'ON'){ count_sw1[4] = 1; }else { count_sw1[4] = 0; }
                if(parseJSON.dripper_1 == 'ON'){ count_stats1_on[1] = 1; }else { count_stats1_on[1] = 0; }
                if(parseJSON.dripper_2 == 'ON'){ count_stats1_on[2] = 1; }else { count_stats1_on[2] = 0; }
                if(parseJSON.dripper_3 == 'ON'){ count_stats1_on[3] = 1; }else { count_stats1_on[3] = 0; }
                if(parseJSON.dripper_4 == 'ON'){ count_stats1_on[4] = 1; }else { count_stats1_on[4] = 0; }
                if(sw_log.fan_1 == 'ON'){ count_sw2[1] = 1; }else { count_sw2[1] = 0; }
                if(sw_log.fan_2 == 'ON'){ count_sw2[2] = 1; }else { count_sw2[2] = 0; }
                if(sw_log.fan_3 == 'ON'){ count_sw2[3] = 1; }else { count_sw2[3] = 0; }
                if(sw_log.fan_4 == 'ON'){ count_sw2[4] = 1; }else { count_sw2[4] = 0; }
                if(parseJSON.fan_1 == 'ON'){ count_stats2_on[1] = 1; }else { count_stats2_on[1] = 0; }
                if(parseJSON.fan_2 == 'ON'){ count_stats2_on[2] = 1; }else { count_stats2_on[2] = 0; }
                if(parseJSON.fan_3 == 'ON'){ count_stats2_on[3] = 1; }else { count_stats2_on[3] = 0; }
                if(parseJSON.fan_4 == 'ON'){ count_stats2_on[4] = 1; }else { count_stats2_on[4] = 0; }
                if(sw_log.foggy_1 == 'ON'){ count_sw3[1] = 1; }else { count_sw3[1] = 0; }
                if(sw_log.foggy_2 == 'ON'){ count_sw3[2] = 1; }else { count_sw3[2] = 0; }
                if(parseJSON.foggy_1 == 'ON'){ count_stats3_on[1] = 1; }else { count_stats3_on[1] = 0; }
                if(parseJSON.foggy_2 == 'ON'){ count_stats3_on[2] = 1; }else { count_stats3_on[2] = 0; }

                fn_check_sw_on_off($('.hidden_select_sw_manual').val());
                function fn_check_sw_on_off(val){
                    if(val == 1){ // dripper
                        if(countElement(1,count_sw1) == countElement(1,count_stats1_on)){
                            $('.sw_manual_on').addClass('active').html('<img src="public/images/icons/menu_control/on_on.png" width="75" />');
                            $('.sw_manual_off').removeClass('active').html('<img src="public/images/icons/menu_control/off_off.png" width="75" />');
                        }
                        else {
                            $('.sw_manual_on').removeClass('active').html('<img src="public/images/icons/menu_control/on_off.png" width="75" />');
                            $('.sw_manual_off').addClass('active').html('<img src="public/images/icons/menu_control/off_on.png" width="75" />');
                        }
                    }
                    else if(val == 2){ // FAN
                        if(countElement(1,count_sw2) == countElement(1,count_stats2_on)){
                            $('.sw_manual_on').addClass('active').html('<img src="public/images/icons/menu_control/on_on.png" width="75" />');
                            $('.sw_manual_off').removeClass('active').html('<img src="public/images/icons/menu_control/off_off.png" width="75" />');
                        }else {
                            $('.sw_manual_on').removeClass('active').html('<img src="public/images/icons/menu_control/on_off.png" width="75" />');
                            $('.sw_manual_off').addClass('active').html('<img src="public/images/icons/menu_control/off_on.png" width="75" />');
                        }
                    }
                    else if(val == 3){ // foggy
                        if(countElement(1,count_sw3) == countElement(1,count_stats3_on)){
                            $('.sw_manual_on').addClass('active').html('<img src="public/images/icons/menu_control/on_on.png" width="75" />');
                            $('.sw_manual_off').removeClass('active').html('<img src="public/images/icons/menu_control/off_off.png" width="75" />');
                        }else {
                            $('.sw_manual_on').removeClass('active').html('<img src="public/images/icons/menu_control/on_off.png" width="75" />');
                            $('.sw_manual_off').addClass('active').html('<img src="public/images/icons/menu_control/off_on.png" width="75" />');
                        }
                    }
                    else if(val == 4){ // spray
                        if(parseJSON.spray == 'ON'){
                            $('.sw_manual_on').addClass('active').html('<img src="public/images/icons/menu_control/on_on.png" width="75" />');
                            $('.sw_manual_off').removeClass('active').html('<img src="public/images/icons/menu_control/off_off.png" width="75" />');
                        }else {
                            $('.sw_manual_on').removeClass('active').html('<img src="public/images/icons/menu_control/on_off.png" width="75" />');
                            $('.sw_manual_off').addClass('active').html('<img src="public/images/icons/menu_control/off_on.png" width="75" />');
                        }
                    }
                    else if(val == 5){ // shading
                        if(parseJSON.shading == 'ON'){
                            $('.sw_manual_on').addClass('active').html('<img src="public/images/icons/menu_control/on_on.png" width="75" />');
                            $('.sw_manual_off').removeClass('active').html('<img src="public/images/icons/menu_control/off_off.png" width="75" />');
                        }else {
                            $('.sw_manual_on').removeClass('active').html('<img src="public/images/icons/menu_control/on_off.png" width="75" />');
                            $('.sw_manual_off').addClass('active').html('<img src="public/images/icons/menu_control/off_on.png" width="75" />');
                        }
                    }
                }
                if(countElement(1,count_sw1) == countElement(1,count_stats1_on)){
                    $('.img_sw_sel_load_manual_1').attr('src','public/images/icons/menu_control/dripper_on.png');
                }else {
                    $('.img_sw_sel_load_manual_1').attr('src','public/images/icons/menu_control/dripper_off.png');
                }
                if(countElement(1,count_sw2) == countElement(1,count_stats2_on)){
                    $('.img_sw_sel_load_manual_2').attr('src','public/images/icons/menu_control/fan_on.png');
                }else {
                    $('.img_sw_sel_load_manual_2').attr('src','public/images/icons/menu_control/fan_off.png');
                }
                if(countElement(1,count_sw3) == countElement(1,count_stats3_on)){
                    $('.img_sw_sel_load_manual_3').attr('src','public/images/icons/menu_control/foggy_on.png');
                }else {
                    $('.img_sw_sel_load_manual_3').attr('src','public/images/icons/menu_control/foggy_off.png');
                }
                if(parseJSON.spray == 'ON'){
                    $('.img_sw_sel_load_manual_4').attr('src','public/images/icons/menu_control/spray_on.png');
                }else {
                    $('.img_sw_sel_load_manual_4').attr('src','public/images/icons/menu_control/spray_off.png');
                }
                if(parseJSON.shading == 'ON'){
                    $('.img_sw_sel_load_manual_5').attr('src','public/images/icons/menu_control/shading_on.png');
                }else {
                    $('.img_sw_sel_load_manual_5').attr('src','public/images/icons/menu_control/shading_off.png');
                }
            }
            else { // โหมดอัตโนมัติ
                $('.dash_mode').html('โหมดอัตโนมัติ')
                $('.sw_mode_Auto').addClass('btn-success').removeClass('btn-outline-success')
                $('.sw_mode_Manual').removeClass('btn-success').addClass('btn-outline-success')
                $('.ul_Auto').show()
                $('.ul_Manual').hide()
                if($('#Modal_control').hasClass('show') == true){
                    $(".img_sw").show();
                    $('.input_time').prop('disabled', true);
                    $(".sw_toggle").hide();
                    $(".menu_config_auto").show();
                    $("#save_auto_cont").hide();
                    $("#close_auto_cont").hide();
                    $(".sw_mode_Auto").attr('disabled', false);
                    $(".sw_mode_Manual").attr('disabled', false);
                }
            }
            // status control dashboard
            for (var i = 1; i <= 12; i++) {
                if (config_cn['cn_status_' + i] == 1) {
                    if (i <= 4) {
                        if (parseJSON['dripper_' + i] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_OFF2.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/dripper_off.png');
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_ON2.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/dripper_on.png');
                        }
                    }
                    if (i > 4 && i <= 8) {
                        if (parseJSON['fan_' + (i - 4)] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/TU/Fan2_OFF.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/fan_off.png');
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/TU/Fan2_ON.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/fan_on.png');
                        }
                    }
                    if (i == 9 || i == 10) {
                        if (parseJSON['foggy_' + (i - 8)] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/new_foggy-off.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/foggy_off.png');
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/new_foggy-on.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/foggy_on.png');
                        }
                    }
                    if (i == 11) {
                        if (parseJSON['spray'] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_OFF.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/spray_off.png');
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_ON.svg");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/spray_on.png');
                        }
                    }
                    if (i == 12) {
                        if (parseJSON['shading'] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Roof_OFF2.png");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/shading_off.png');
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Roof_ON2.png");
                            $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/shading_on.png');
                        }
                    }
                }
            }
        }
        else if(message.destinationName == house_master + "/control/config/auto"){
            var result = message.payloadString;
            var n_result = result.split('\r\n')
            console.log(n_result);
            var SW_drip1 = []
            var SW_drip2 = []
            var SW_drip3 = []
            var SW_drip4 = []
            var SW_fan1 = []
            var SW_fan2 = []
            var SW_fan3 = []
            var SW_fan4 = []
            var SW_foggy1 = []
            var SW_foggy2 = []
            var SW_spray = []
            var SW_shading = []
            for(var i=1; i<=6; i++){
                if(config_cn['cn_status_1'] == 1){
                    if(n_result[i].split('=')[1] != '99:99' && n_result[i+1].split('=')[1] != '99:99'){
                        SW_drip1.push({ sw:1, s:n_result[i].split('=')[1], e:n_result[i+1].split('=')[1] });
                    }else {
                        SW_drip1.push({ sw:0, s:'', e:'' })
                    }
                }
                if(config_cn['cn_status_2'] == 1){
                    if(n_result[i+13].split('=')[1] != '99:99' && n_result[i+14].split('=')[1] != '99:99'){
                        SW_drip2.push({ sw:1, s:n_result[i+13].split('=')[1], e:n_result[i+14].split('=')[1] });
                    }else {
                        SW_drip2.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_3'] == 1){
                    if(n_result[i+26].split('=')[1] != '99:99' && n_result[i+27].split('=')[1] != '99:99'){
                        SW_drip3.push({ sw:1, s:n_result[i+26].split('=')[1], e:n_result[i+27].split('=')[1] });
                    }else {
                        SW_drip3.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_4'] == 1){
                    if(n_result[i+39].split('=')[1] != '99:99' && n_result[i+40].split('=')[1] != '99:99'){
                        SW_drip4.push({ sw:1, s:n_result[i+39].split('=')[1], e:n_result[i+40].split('=')[1] });
                    }else {
                        SW_drip4.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_5'] == 1){
                    if(n_result[i+52].split('=')[1] != '99:99' && n_result[i+53].split('=')[1] != '99:99'){
                        SW_fan1.push({ sw:1, s:n_result[i+52].split('=')[1], e:n_result[i+53].split('=')[1] });
                    }else {
                        SW_fan1.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_6'] == 1){
                    if(n_result[i+65].split('=')[1] != '99:99' && n_result[i+66].split('=')[1] != '99:99'){
                        SW_fan2.push({ sw:1, s:n_result[i+65].split('=')[1], e:n_result[i+66].split('=')[1] });
                    }else {
                        SW_fan2.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_7'] == 1){
                    if(n_result[i+78].split('=')[1] != '99:99' && n_result[i+79].split('=')[1] != '99:99'){
                        SW_fan3.push({ sw:1, s:n_result[i+78].split('=')[1], e:n_result[i+79].split('=')[1] });
                    }else {
                        SW_fan3.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_8'] == 1){
                    if(n_result[i+91].split('=')[1] != '99:99' && n_result[i+92].split('=')[1] != '99:99'){
                        SW_fan4.push({ sw:1, s:n_result[i+91].split('=')[1], e:n_result[i+92].split('=')[1] });
                    }else {
                        SW_fan4.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_9'] == 1){
                    if(n_result[i+104].split('=')[1] != '99:99' && n_result[i+105].split('=')[1] != '99:99'){
                        SW_foggy1.push({ sw:1, s:n_result[i+104].split('=')[1], e:n_result[i+105].split('=')[1] });
                    }else {
                        SW_foggy1.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_10'] == 1){
                    if(n_result[i+117].split('=')[1] != '99:99' && n_result[i+118].split('=')[1] != '99:99'){
                        SW_foggy2.push({ sw:1, s:n_result[i+117].split('=')[1], e:n_result[i+118].split('=')[1] });
                    }else {
                        SW_foggy2.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_11'] == 1){
                    if(n_result[i+130].split('=')[1] != '99:99' && n_result[i+131].split('=')[1] != '99:99'){
                        SW_spray.push({ sw:1, s:n_result[i+130].split('=')[1], e:n_result[i+131].split('=')[1] });
                    }else {
                        SW_spray.push({ sw:0, s:'', e:'' });
                    }
                }
                if(config_cn['cn_status_12'] == 1){
                    if(n_result[i+143].split('=')[1] != '99:99' && n_result[i+144].split('=')[1] != '99:99'){
                        SW_shading.push({ sw:1, s:n_result[i+143].split('=')[1], e:n_result[i+144].split('=')[1] });
                    }else {
                        SW_shading.push({ sw:0, s:'', e:'' });
                    }
                }
            }
            // console.log(SW_spray);
            // return false
            var data_auto = {};
            if(config_cn['cn_status_1'] == 1){
                $.extend(data_auto, {
                    'load_1':{
                        'load_st_1':SW_drip1[0].sw,
                        'load_st_2':SW_drip1[1].sw,
                        'load_st_3':SW_drip1[2].sw,
                        'load_st_4':SW_drip1[3].sw,
                        'load_st_5':SW_drip1[4].sw,
                        'load_st_6':SW_drip1[5].sw,
                        'load_s_1':SW_drip1[0].s,
                        'load_s_2':SW_drip1[1].s,
                        'load_s_3':SW_drip1[2].s,
                        'load_s_4':SW_drip1[3].s,
                        'load_s_5':SW_drip1[4].s,
                        'load_s_6':SW_drip1[5].s,
                        'load_e_1':SW_drip1[0].e,
                        'load_e_2':SW_drip1[1].e,
                        'load_e_3':SW_drip1[2].e,
                        'load_e_4':SW_drip1[3].e,
                        'load_e_5':SW_drip1[4].e,
                        'load_e_6':SW_drip1[5].e
                    }
                });
            }
            if(config_cn['cn_status_2'] == 1){
                $.extend(data_auto, {
                    'load_2':{
                        'load_st_1':SW_drip2[0].sw,
                        'load_st_2':SW_drip2[1].sw,
                        'load_st_3':SW_drip2[2].sw,
                        'load_st_4':SW_drip2[3].sw,
                        'load_st_5':SW_drip2[4].sw,
                        'load_st_6':SW_drip2[5].sw,
                        'load_s_1':SW_drip2[0].s,
                        'load_s_2':SW_drip2[1].s,
                        'load_s_3':SW_drip2[2].s,
                        'load_s_4':SW_drip2[3].s,
                        'load_s_5':SW_drip2[4].s,
                        'load_s_6':SW_drip2[5].s,
                        'load_e_1':SW_drip2[0].e,
                        'load_e_2':SW_drip2[1].e,
                        'load_e_3':SW_drip2[2].e,
                        'load_e_4':SW_drip2[3].e,
                        'load_e_5':SW_drip2[4].e,
                        'load_e_6':SW_drip2[5].e
                    }
                });
            }
            if(config_cn['cn_status_3'] == 1){
                $.extend(data_auto, {
                    'load_3':{
                        'load_st_1':SW_drip3[0].sw,
                        'load_st_2':SW_drip3[1].sw,
                        'load_st_3':SW_drip3[2].sw,
                        'load_st_4':SW_drip3[3].sw,
                        'load_st_5':SW_drip3[4].sw,
                        'load_st_6':SW_drip3[5].sw,
                        'load_s_1':SW_drip3[0].s,
                        'load_s_2':SW_drip3[1].s,
                        'load_s_3':SW_drip3[2].s,
                        'load_s_4':SW_drip3[3].s,
                        'load_s_5':SW_drip3[4].s,
                        'load_s_6':SW_drip3[5].s,
                        'load_e_1':SW_drip3[0].e,
                        'load_e_2':SW_drip3[1].e,
                        'load_e_3':SW_drip3[2].e,
                        'load_e_4':SW_drip3[3].e,
                        'load_e_5':SW_drip3[4].e,
                        'load_e_6':SW_drip3[5].e
                    }
                });
            }
            if(config_cn['cn_status_4'] == 1){
                $.extend(data_auto, {
                    'load_4':{
                        'load_st_1':SW_drip4[0].sw,
                        'load_st_2':SW_drip4[1].sw,
                        'load_st_3':SW_drip4[2].sw,
                        'load_st_4':SW_drip4[3].sw,
                        'load_st_5':SW_drip4[4].sw,
                        'load_st_6':SW_drip4[5].sw,
                        'load_s_1':SW_drip4[0].s,
                        'load_s_2':SW_drip4[1].s,
                        'load_s_3':SW_drip4[2].s,
                        'load_s_4':SW_drip4[3].s,
                        'load_s_5':SW_drip4[4].s,
                        'load_s_6':SW_drip4[5].s,
                        'load_e_1':SW_drip4[0].e,
                        'load_e_2':SW_drip4[1].e,
                        'load_e_3':SW_drip4[2].e,
                        'load_e_4':SW_drip4[3].e,
                        'load_e_5':SW_drip4[4].e,
                        'load_e_6':SW_drip4[5].e
                    }
                });
            }
            if(config_cn['cn_status_5'] == 1){
                $.extend(data_auto, {
                    'load_5':{
                        'load_st_1':SW_fan1[0].sw,
                        'load_st_2':SW_fan1[1].sw,
                        'load_st_3':SW_fan1[2].sw,
                        'load_st_4':SW_fan1[3].sw,
                        'load_st_5':SW_fan1[4].sw,
                        'load_st_6':SW_fan1[5].sw,
                        'load_s_1':SW_fan1[0].s,
                        'load_s_2':SW_fan1[1].s,
                        'load_s_3':SW_fan1[2].s,
                        'load_s_4':SW_fan1[3].s,
                        'load_s_5':SW_fan1[4].s,
                        'load_s_6':SW_fan1[5].s,
                        'load_e_1':SW_fan1[0].e,
                        'load_e_2':SW_fan1[1].e,
                        'load_e_3':SW_fan1[2].e,
                        'load_e_4':SW_fan1[3].e,
                        'load_e_5':SW_fan1[4].e,
                        'load_e_6':SW_fan1[5].e
                    }
                });
            }
            if(config_cn['cn_status_6'] == 1){
                $.extend(data_auto, {
                    'load_6':{
                        'load_st_1':SW_fan2[0].sw,
                        'load_st_2':SW_fan2[1].sw,
                        'load_st_3':SW_fan2[2].sw,
                        'load_st_4':SW_fan2[3].sw,
                        'load_st_5':SW_fan2[4].sw,
                        'load_st_6':SW_fan2[5].sw,
                        'load_s_1':SW_fan2[0].s,
                        'load_s_2':SW_fan2[1].s,
                        'load_s_3':SW_fan2[2].s,
                        'load_s_4':SW_fan2[3].s,
                        'load_s_5':SW_fan2[4].s,
                        'load_s_6':SW_fan2[5].s,
                        'load_e_1':SW_fan2[0].e,
                        'load_e_2':SW_fan2[1].e,
                        'load_e_3':SW_fan2[2].e,
                        'load_e_4':SW_fan2[3].e,
                        'load_e_5':SW_fan2[4].e,
                        'load_e_6':SW_fan2[5].e
                    }
                });
            }
            if(config_cn['cn_status_7'] == 1){
                $.extend(data_auto, {
                    'load_7':{
                        'load_st_1':SW_fan3[0].sw,
                        'load_st_2':SW_fan3[1].sw,
                        'load_st_3':SW_fan3[2].sw,
                        'load_st_4':SW_fan3[3].sw,
                        'load_st_5':SW_fan3[4].sw,
                        'load_st_6':SW_fan3[5].sw,
                        'load_s_1':SW_fan3[0].s,
                        'load_s_2':SW_fan3[1].s,
                        'load_s_3':SW_fan3[2].s,
                        'load_s_4':SW_fan3[3].s,
                        'load_s_5':SW_fan3[4].s,
                        'load_s_6':SW_fan3[5].s,
                        'load_e_1':SW_fan3[0].e,
                        'load_e_2':SW_fan3[1].e,
                        'load_e_3':SW_fan3[2].e,
                        'load_e_4':SW_fan3[3].e,
                        'load_e_5':SW_fan3[4].e,
                        'load_e_6':SW_fan3[5].e
                    }
                });
            }
            if(config_cn['cn_status_8'] == 1){
                $.extend(data_auto, {
                    'load_8':{
                        'load_st_1':SW_fan4[0].sw,
                        'load_st_2':SW_fan4[1].sw,
                        'load_st_3':SW_fan4[2].sw,
                        'load_st_4':SW_fan4[3].sw,
                        'load_st_5':SW_fan4[4].sw,
                        'load_st_6':SW_fan4[5].sw,
                        'load_s_1':SW_fan4[0].s,
                        'load_s_2':SW_fan4[1].s,
                        'load_s_3':SW_fan4[2].s,
                        'load_s_4':SW_fan4[3].s,
                        'load_s_5':SW_fan4[4].s,
                        'load_s_6':SW_fan4[5].s,
                        'load_e_1':SW_fan4[0].e,
                        'load_e_2':SW_fan4[1].e,
                        'load_e_3':SW_fan4[2].e,
                        'load_e_4':SW_fan4[3].e,
                        'load_e_5':SW_fan4[4].e,
                        'load_e_6':SW_fan4[5].e
                    }
                });
            }
            if(config_cn['cn_status_9'] == 1){
                $.extend(data_auto, {
                    'load_9':{
                        'load_st_1':SW_foggy1[0].sw,
                        'load_st_2':SW_foggy1[1].sw,
                        'load_st_3':SW_foggy1[2].sw,
                        'load_st_4':SW_foggy1[3].sw,
                        'load_st_5':SW_foggy1[4].sw,
                        'load_st_6':SW_foggy1[5].sw,
                        'load_s_1':SW_foggy1[0].s,
                        'load_s_2':SW_foggy1[1].s,
                        'load_s_3':SW_foggy1[2].s,
                        'load_s_4':SW_foggy1[3].s,
                        'load_s_5':SW_foggy1[4].s,
                        'load_s_6':SW_foggy1[5].s,
                        'load_e_1':SW_foggy1[0].e,
                        'load_e_2':SW_foggy1[1].e,
                        'load_e_3':SW_foggy1[2].e,
                        'load_e_4':SW_foggy1[3].e,
                        'load_e_5':SW_foggy1[4].e,
                        'load_e_6':SW_foggy1[5].e
                    }
                });
            }
            if(config_cn['cn_status_10'] == 1){
                $.extend(data_auto, {
                    'load_10':{
                        'load_st_1':SW_foggy2[0].sw,
                        'load_st_2':SW_foggy2[1].sw,
                        'load_st_3':SW_foggy2[2].sw,
                        'load_st_4':SW_foggy2[3].sw,
                        'load_st_5':SW_foggy2[4].sw,
                        'load_st_6':SW_foggy2[5].sw,
                        'load_s_1':SW_foggy2[0].s,
                        'load_s_2':SW_foggy2[1].s,
                        'load_s_3':SW_foggy2[2].s,
                        'load_s_4':SW_foggy2[3].s,
                        'load_s_5':SW_foggy2[4].s,
                        'load_s_6':SW_foggy2[5].s,
                        'load_e_1':SW_foggy2[0].e,
                        'load_e_2':SW_foggy2[1].e,
                        'load_e_3':SW_foggy2[2].e,
                        'load_e_4':SW_foggy2[3].e,
                        'load_e_5':SW_foggy2[4].e,
                        'load_e_6':SW_foggy2[5].e
                    }
                });
            }
            if(config_cn['cn_status_11'] == 1){
                $.extend(data_auto, {
                    'load_11':{
                        'load_st_1':SW_spray[0].sw,
                        'load_st_2':SW_spray[1].sw,
                        'load_st_3':SW_spray[2].sw,
                        'load_st_4':SW_spray[3].sw,
                        'load_st_5':SW_spray[4].sw,
                        'load_st_6':SW_spray[5].sw,
                        'load_s_1':SW_spray[0].s,
                        'load_s_2':SW_spray[1].s,
                        'load_s_3':SW_spray[2].s,
                        'load_s_4':SW_spray[3].s,
                        'load_s_5':SW_spray[4].s,
                        'load_s_6':SW_spray[5].s,
                        'load_e_1':SW_spray[0].e,
                        'load_e_2':SW_spray[1].e,
                        'load_e_3':SW_spray[2].e,
                        'load_e_4':SW_spray[3].e,
                        'load_e_5':SW_spray[4].e,
                        'load_e_6':SW_spray[5].e
                    }
                });
            }
            if(config_cn['cn_status_12'] == 1){
                $.extend(data_auto, {
                    'load_12':{
                        'load_st_1':SW_shading[0].sw,
                        'load_st_2':SW_shading[1].sw,
                        'load_st_3':SW_shading[2].sw,
                        'load_st_4':SW_shading[3].sw,
                        'load_st_5':SW_shading[4].sw,
                        'load_st_6':SW_shading[5].sw,
                        'load_s_1':SW_shading[0].s,
                        'load_s_2':SW_shading[1].s,
                        'load_s_3':SW_shading[2].s,
                        'load_s_4':SW_shading[3].s,
                        'load_s_5':SW_shading[4].s,
                        'load_s_6':SW_shading[5].s,
                        'load_e_1':SW_shading[0].e,
                        'load_e_2':SW_shading[1].e,
                        'load_e_3':SW_shading[2].e,
                        'load_e_4':SW_shading[3].e,
                        'load_e_5':SW_shading[4].e,
                        'load_e_6':SW_shading[5].e
                    }
                });
            }
            // console.log(JSON.stringify(data_auto) );
            $('#val_sw_auto').val(JSON.stringify(data_auto));
            // console.log($('#val_sw_auto').val());
        }
    }// exit_message
    connect();

    // ++++++++++++++++++
    // alert($('#Modal_control').hasClass('show'))
    $('.memu_control').click(function () {
        $(".memu_dash").show().addClass("mm-active");
        $(this).removeClass("mm-active");
        $("#Modal_control").modal('show', { backdrop: "static" })

        // Create a client instance
        client = new Paho.MQTT.Client(hostname, Number(port), "mqtt_control_324" + parseInt(Math.random() * 1000, 10));

        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        // connect the client
        client.connect({ onSuccess: onConnect });

        // called when the client connects
        function onConnect() {
            // Once a connection has been made, make a subscription and send a message.
            console.log("onConnect");
            client.subscribe(house_master + "/control/config/auto");
        }

        // called when the client loses its connection
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("onConnectionLost:" + responseObject.errorMessage);
            }
        }

        // called when a message arrives
        function onMessageArrived(message) {
            $("#save_auto_cont").click(function () {
                for (var i = 1; i <= 6; i++){
                    if ($("#swch_"+i).prop('checked') == true) {
                        if ($("#time_s_"+i).val() === "") {
                            $('#time_s_'+i).addClass('is-invalid')
                            return false;
                        } else {
                            $('#time_s_'+i).removeClass('is-invalid')
                        }
                        if ($("#time_e_"+i).val() === "") {
                            $('#time_e_'+i).addClass('is-invalid')
                            return false;
                        } else {
                            $('#time_e_+i').removeClass('is-invalid')
                        }
                        if ($("#time_s_"+i).val() >= $("#time_e_"+i).val()) {
                            swal_c(type = 'error', title = 'Error...', text = 'TIMMER '+i+' : <b>เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด</b> !');
                            $('#time_s_1').addClass('is-invalid')
                            $('#time_e_1').addClass('is-invalid')
                            return false;
                        } else {
                            $('#time_s_'+i).removeClass('is-invalid')
                            $('#time_e_'+i).removeClass('is-invalid')
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
                }).
                then((result) => {
                    if (result.value) {
                        if ($("#swch_1").prop('checked') == true) { var sw_1 = 1; } else { var sw_1 = 0; }
                        if ($("#swch_2").prop('checked') == true) { var sw_2 = 1; } else { var sw_2 = 0; }
                        if ($("#swch_3").prop('checked') == true) { var sw_3 = 1; } else { var sw_3 = 0; }
                        if ($("#swch_4").prop('checked') == true) { var sw_4 = 1; } else { var sw_4 = 0; }
                        if ($("#swch_5").prop('checked') == true) { var sw_5 = 1; } else { var sw_5 = 0; }
                        if ($("#swch_6").prop('checked') == true) { var sw_6 = 1; } else { var sw_6 = 0; }
                        $.ajax({
                            type: "POST",
                            url: "routes/tu/save_autoControl.php",
                            data: {
                                house_master: house_master,
                                hidden_select_sw_auto: $(".hidden_select_sw_auto").val(),
                                sw_1: sw_1,
                                sw_2: sw_2,
                                sw_3: sw_3,
                                sw_4: sw_4,
                                sw_5: sw_5,
                                sw_6: sw_6,
                                s_1: $("#time_s_1").val(),
                                s_2: $("#time_s_2").val(),
                                s_3: $("#time_s_3").val(),
                                s_4: $("#time_s_4").val(),
                                s_5: $("#time_s_5").val(),
                                s_6: $("#time_s_6").val(),
                                e_1: $("#time_e_1").val(),
                                e_2: $("#time_e_2").val(),
                                e_3: $("#time_e_3").val(),
                                e_4: $("#time_e_4").val(),
                                e_5: $("#time_e_5").val(),
                                e_6: $("#time_e_6").val(),
                                parseJSON: JSON.parse($('#val_sw_auto').val())
                            },
                            dataType: 'json',
                            success: function (res) {
                                console.log(res.data)
                                if (res.status === "Insert_Success") {
                                    $("#Modal_Auto_control").modal("hide");
                                    var originalArray = res.data;
                                    var separator = '\r\n';
                                    var implodedArray = '';

                                    for(let i = 0; i < originalArray.length; i++) {

                                        // add a string from original array
                                        implodedArray += originalArray[i];

                                        // unless the iterator reaches the end of
                                        // the array add the separator string
                                        if(i != originalArray.length - 1){
                                            implodedArray += separator;
                                        }
                                    }
                                    // console.log(implodedArray);
                                    // if (message.destinationName == house_master + "/control/config/auto") {
                                        // var parseJSON = JSON.parse($('#val_sw_auto').val())
                                        // var result = message.payloadString;
                                        // var parseJSON = $.parseJSON(result);
                                        // console.log(parseJSON);
                                        // $.extend(parseJSON, res.data);
                                        // var json_msg = JSON.stringify(parseJSON);
                                        // console.log(parseJSON.length)
                                        mqtt_send(house_master+'/control/config/auto', implodedArray, '')
                                    // }
                                    swal({
                                        title: 'บันทึกข้อมูลสำเร็จ',
                                        type: 'success',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#32CD32'
                                    });
                                    // fn_df_logdata_auto($('.hidden_select_sw_auto').val())
                                    for (var i = 1; i <= 6; i++){
                                        if ($("#swch_"+i).prop('checked') == true) { $(".img_"+i).attr("src", "public/images/control/switck_on.png"); } else { $(".img_"+i).attr("src", "public/images/control/switck_off.png"); }
                                    }
                                    $(".img_sw").show();
                                    $('.input_time').prop('disabled', true);
                                    $(".sw_toggle").hide();
                                    $(".menu_config_auto").show();
                                    $(".sw_mode_Auto").attr('disabled', false);
                                    $(".sw_mode_Manual").attr('disabled', false);
                                    $("#save_auto_cont").hide();
                                    $("#close_auto_cont").hide();
                                } else {
                                    swal({
                                        title: 'Error !',
                                        text: "เกิดข้อผิดพลาด ?",
                                        type: 'error',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#32CD32'
                                    }).then((result) => {
                                        if (result.value) {
                                            // location.reload();
                                            return false;
                                        }
                                    });
                                }
                            }
                        });

                    }
                });
            }); // exit_save_Auto
            $("#save_manual_cont").click(function () {
                var log_sw = [];
                var numb = $('.hidden_select_sw_manual').val();
                if(numb == 1){
                    if ($("#label_1").prop('checked') === true) {
                        log_sw['sw_1'] = "ON";
                    }else {
                        log_sw['sw_1'] = "OFF";
                    }
                    if ($("#label_2").prop('checked') === true) {
                        log_sw['sw_2'] = "ON";
                    }else {
                        log_sw['sw_2'] = "OFF";
                    }
                    if ($("#label_3").prop('checked') === true) {
                        log_sw['sw_3'] = "ON";
                    }else {
                        log_sw['sw_3'] = "OFF";
                    }
                    if ($("#label_4").prop('checked') === true) {
                        log_sw['sw_4'] = "ON";
                    }else {
                        log_sw['sw_4'] = "OFF";
                    }
                }
                else if (numb == 2){
                    if ($("#label_1").prop('checked') === true) {
                        log_sw['sw_1'] = "ON";
                    }else {
                        log_sw['sw_1'] = "OFF";
                    }
                    if ($("#label_2").prop('checked') === true) {
                        log_sw['sw_2'] = "ON";
                    }else {
                        log_sw['sw_2'] = "OFF";
                    }
                    if ($("#label_3").prop('checked') === true) {
                        log_sw['sw_3'] = "ON";
                    }else {
                        log_sw['sw_3'] = "OFF";
                    }
                    if ($("#label_4").prop('checked') === true) {
                        log_sw['sw_4'] = "ON";
                    }else {
                        log_sw['sw_4'] = "OFF";
                    }
                }
                else if (numb == 3){
                    if ($("#label_1").prop('checked') === true) {
                        log_sw['sw_1'] = "ON";
                    }else {
                        log_sw['sw_1'] = "OFF";
                    }
                    if ($("#label_2").prop('checked') === true) {
                        log_sw['sw_2'] = "ON";
                    }else {
                        log_sw['sw_2'] = "OFF";
                    }
                    log_sw['sw_3'] = "OFF";
                    log_sw['sw_4'] = "OFF";
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
                        var log_sw2 = {
                            'mode':numb,
                            'sw_1':log_sw['sw_1'],
                            'sw_2':log_sw['sw_2'],
                            'sw_3':log_sw['sw_3'],
                            'sw_4':log_sw['sw_4']
                        }
                        // console.log(log_sw)
                        $.ajax({
                            type: "POST",
                            url: "routes/tu/save_manualControl.php",
                            data: {
                                house_master: house_master,
                                log_sw: log_sw2
                            },
                            dataType: 'json',
                            success: function (res) {
                                // console.log(res.data)
                                if (res.status === "Insert_Success") {
                                    $("#Modal_Auto_control").modal("hide");
                                    $('#val_sw_manual').val(JSON.stringify(res.data));
                                    // console.log(res.data);
                                    var new_res = //JSON.stringify(
                                        '[config]'+'\r\n'+
                                        'serial_id='+house_master+'\r\n'+
                                        'dripper_1='+res.data['dripper_1']+'\r\n'+
                                        'dripper_2='+res.data['dripper_2']+'\r\n'+
                                        'dripper_3='+res.data['dripper_3']+'\r\n'+
                                        'dripper_4='+res.data['dripper_4']+'\r\n'+
                                        'fan_1='+res.data['fan_1']+'\r\n'+
                                        'fan_2='+res.data['fan_2']+'\r\n'+
                                        'fan_3='+res.data['fan_3']+'\r\n'+
                                        'fan_4='+res.data['fan_4']+'\r\n'+
                                        'foggy_1='+res.data['foggy_1']+'\r\n'+
                                        'foggy_2='+res.data['foggy_2']

                                    // );
                                    mqtt_send(house_master+'/control/config/manual', new_res, '')
                                    swal({
                                        title: 'บันทึกข้อมูลสำเร็จ',
                                        type: 'success',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#32CD32'
                                    });
                                    $(".menu_config_manual").show();
                                    $('.status_config_manual').hide();
                                    $(".sw_mode_Auto").attr('disabled', false);
                                    $(".sw_mode_Manual").attr('disabled', false);
                                    $("#save_manual_cont").hide();
                                    $("#close_manual_cont").hide();
                                    fn_label_manual($('.hidden_select_sw_manual').val());
                                } else {
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
            }); // exit_save_Manual
            function mqtt_send(msg_dn, msg, user) {
                message = new Paho.MQTT.Message(msg);
                message.destinationName = msg_dn;
                message.qos = 1;
                message.retained = true;
                client.send(message);
            }
            $('.sw_mode_Auto').click(function () { // console.log($(this).attr("id"));
                // alert($(this).attr("id"))
                if ($(this).hasClass("active") === false) {
                    switch_mode(sw_name = "อัตโนมัติ", mess = "Auto");
                }
            });
            $('.sw_mode_Manual').click(function () { // console.log($(this).attr("id"));
                if ($(this).hasClass("btn-success") === false) {
                    switch_mode(sw_name = "กำหนดเอง", mess = "Manual");
                }
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
                        message.destinationName = house_master + "/control/status/user_control";
                        message.retained = true;
                        message.qos = 1;
                        client.send(message);

                        message = new Paho.MQTT.Message(mess);
                        message.destinationName = house_master + "/control/status/mode";
                        message.retained = true;
                        message.qos = 1;
                        client.send(message);
                        // ----------------------------------------------------------
                        message = new Paho.MQTT.Message(login_user);
                        message.destinationName = house_master + "/control/loads/user_control";
                        message.retained = true;
                        message.qos = 1;
                        client.send(message);

                        message = new Paho.MQTT.Message(mess);
                        message.destinationName = house_master + "/control/loads/mode";
                        message.retained = true;
                        message.qos = 1;
                        client.send(message);
                    }
                });
            }
            $('.sw_manual_on').click(function(){
                if ($(this).hasClass("active") === false) {
                    switch_control("ON", $('.hidden_select_sw_manual').val());
                }
            });
            $('.sw_manual_off').click(function(){
                if ($(this).hasClass("active") === false) {
                    switch_control("OFF", $('.hidden_select_sw_manual').val());
                }
            });
            function switch_control(sts, val) {
                if(sts === "ON"){
                    var status = 'เปิด';
                }else {
                    var status = 'ปิด';
                }
                var sw_log = $.parseJSON($('#val_sw_manual').val());
                if(val == 1){
                    var name = 'Dripper';
                    if(sw_log.dripper_1 == 'ON'){
                        var sw_1 = 1;
                        var mqtt_name_1 = 'dripper_1';
                    }else {
                        var sw_1 = 0;
                    }
                    if(sw_log.dripper_2 == 'ON'){
                        var sw_2 = 1;
                        var mqtt_name_2 = 'dripper_2';
                    }else {
                        var sw_2 = 0;
                    }
                    if(sw_log.dripper_3 == 'ON'){
                        var sw_1 = 3;
                        var mqtt_name_3 = 'dripper_3';
                    }else {
                        var sw_3 = 0;
                    }
                    if(sw_log.dripper_4 == 'ON'){
                        var sw_4 = 1;
                        var mqtt_name_4 = 'dripper_4';
                    }else {
                        var sw_4 = 0;
                    }
                }
                else if(val == 2){
                    var name = 'Fan';
                    if(sw_log.fan_1 == 'ON'){
                        var sw_1 = 1;
                        var mqtt_name_1 = 'fan_1';
                    }else {
                        var sw_1 = 0;
                    }
                    if(sw_log.fan_2 == 'ON'){
                        var sw_2 = 1;
                        var mqtt_name_2 = 'fan_2';
                    }else {
                        var sw_2 = 0;
                    }
                    if(sw_log.fan_3 == 'ON'){
                        var sw_1 = 3;
                        var mqtt_name_3 = 'fan_3';
                    }else {
                        var sw_3 = 0;
                    }
                    if(sw_log.fan_4 == 'ON'){
                        var sw_4 = 1;
                        var mqtt_name_4 = 'fan_4';
                    }else {
                        var sw_4 = 0;
                    }
                }
                else if(val == 3){
                    var name = 'Foggy';
                    if(sw_log.foggy_1 == 'ON'){
                        var sw_1 = 1;
                        var mqtt_name_1 = 'foggy_1';
                    }else {
                        var sw_1 = 0;
                    }
                    if(sw_log.foggy_2 == 'ON'){
                        var sw_2 = 1;
                        var mqtt_name_2 = 'foggy_2';
                    }else {
                        var sw_2 = 0;
                    }
                    var sw_3 = 0;
                    var sw_4 = 0;
                }
                else if(val == 4){
                    var name = 'Spray';
                    var sw_1 = 1;
                    var mqtt_name_1 = 'spray';
                    var sw_2 = 0;
                    var sw_3 = 0;
                    var sw_4 = 0;
                }
                else if(val == 5){
                    var name = 'Shading';
                    var mqtt_name_1 = 'shading';
                    var sw_1 = 1;
                    var sw_2 = 0;
                    var sw_3 = 0;
                    var sw_4 = 0;
                }
                swal({
                    title: 'คุณต้องการ ' + status + ' ' + name + ' ?',
                    // text: "คุณต้องการเปลี่ยนไปใช้โหมด Manual !!!",
                    type: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: '#32CD32',
                    cancelButtonColor: '#FF3333',
                    confirmButtonText: 'ไช่',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    // console.log(result)
                    if (result.value) {
                        // alert(sta)
                        // return false;

                        message = new Paho.MQTT.Message(login_user);
                        message.destinationName = house_master + "/control/status/user_control";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);
                        if(sw_1 == 1){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/status/" + mqtt_name_1;
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                            // console.log(message.qos);
                        }
                        if(sw_2 == 1){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/status/" + mqtt_name_2;
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }
                        if(sw_3 == 1){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/status/" + mqtt_name_3;
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }
                        if(sw_4 == 1){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/status/" + mqtt_name_4;
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }

                        message = new Paho.MQTT.Message(login_user);
                        message.destinationName = house_master + "/control/loads/user_control";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);
                        if(val == 1){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/loads/dripper";
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }
                        else if(val == 2){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/loads/fan";
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }
                        else if(val == 3){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/loads/foggy";
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }
                        else if(val == 4){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/loads/spray";
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);
                        }
                        else if(val == 5){
                            message = new Paho.MQTT.Message(sts);
                            message.destinationName = house_master + "/control/loads/shading";
                            message.qos = 1;
                            message.retained = true;
                            client.send(message);

                        }
                    }
                });
            }
        } // exit_message
        // ================================================
        // Auto
        $(".menu_config_auto").show();
        $(".img_sw").show();
        $(".sw_toggle").hide();
        $('.input_time').prop('disabled', true);
        $("#save_auto_cont").hide();
        $("#close_auto_cont").hide();
        fn_df_checkbox_auto($('.hidden_select_sw_auto').val());
        fn_df_logdata_auto($('.hidden_select_sw_auto').val())
        $(".menu_config_auto").click(function() {
            var res = JSON.parse($('#val_sw_auto').val())
            // console.log(res);
            // $(".nav-link").addClass('disabled');
            $(this).hide();
            $(".img_sw").hide();
            $(".sw_toggle").show();
            $("#close_auto_cont").show();
            $(".sw_mode_Auto").attr('disabled', true);
            $(".sw_mode_Manual").attr('disabled', true);
            $(".close_modal").hide();
            for (var i = 0; i <= 6; i++) {
                if (res["load_"+$('.hidden_select_sw_auto').val()]["load_st_"+i] == 1) {
                    $("#time_s_"+i).prop('disabled', false);
                    $("#time_e_"+i).prop('disabled', false);
                } else {
                    $("#time_s_"+i).prop('disabled', true);
                    $("#time_e_"+i).prop('disabled', true);
                }
            }
            $('.input_check').change(function() {
                var input_num = this.id.split("_");
                if ($(this).prop('checked') === true) {
                    $("#time_s_"+input_num[1]).prop('disabled', false).val(res["load_"+$('.hidden_select_sw_auto').val()]["load_s_"+input_num[1]]);
                    $("#time_e_"+input_num[1]).prop('disabled', false).val(res["load_"+$('.hidden_select_sw_auto').val()]["load_e_"+input_num[1]]);
                }else {
                    $("#time_s_"+input_num[1]).prop('disabled', true).val("");
                    $("#time_e_"+input_num[1]).prop('disabled', true).val("");
                }
                fn_check_auto_save($('.hidden_select_sw_auto').val(), '');
            });
            $(".input_time").change(function() {
                fn_check_auto_save($('.hidden_select_sw_auto').val(), '');
            });
        });
        $("#close_auto_cont").click(function() {
            fn_check_auto_save($('.hidden_select_sw_auto').val(), 'close')
        });
        $('.sw_sel_load_auto').click(function(){
            if($('.menu_config_auto').is(":hidden") == true){
                swal({
                    title: 'ข้อผิดพลาด !',
                    text: "กรุณาบ้นทึกหรือยกเลิกการตั้งค่าก่อน !!!",
                    type: 'warning',
                    allowOutsideClick: false,
                    confirmButtonColor: '#32CD32',
                    confirmButtonText: 'ตกลง',
                });
            }
            else {
                var numb = $(this).attr('id');
                $('.hidden_select_sw_auto').val(numb)
                fn_df_checkbox_auto(numb);
                fn_df_logdata_auto(numb);
                $("#save_auto_cont").hide();
            }
        })
        // ================================================
        // Manual
        $('.status_config_manual').hide();
        $('#save_manual_cont').hide();
        $('#close_manual_cont').hide();
        fn_df_sw_manual($('.hidden_select_sw_manual').val());
        $('.sw_sel_load_manual').click(function(){
            var numb = Number($(this).attr('id').substring(1));
            if($('#close_manual_cont').is(":hidden") == false){
                swal({
                    title: 'ข้อผิดพลาด !',
                    text: "กรุณาบ้นทึกหรือยกเลิกการตั้งค่าก่อน !!!",
                    type: 'warning',
                    allowOutsideClick: false,
                    confirmButtonColor: '#32CD32',
                    confirmButtonText: 'ตกลง',
                });
            }else {
                $('.hidden_select_sw_manual').val(numb)
                fn_df_sw_manual(numb);
            }
        });
        $('.menu_config_manual').click(function(){
            $(this).hide();
            $('.status_config_manual').show();
            $('#close_manual_cont').show();
            $(".sw_mode_Auto").attr('disabled', true);
            $(".sw_mode_Manual").attr('disabled', true);
            // fn_label_manual($('.hidden_select_sw_manual').val());
            // =================================================
            var val = $('.hidden_select_sw_manual').val();
            var sw_log = $.parseJSON($('#val_sw_manual').val());
            $('.label_1').show();
            $('.label_2').show();
            $('.label_3').show();
            $('.label_4').show();
            if(val == 1){
                if(sw_log.dripper_1 == 'ON'){
                    $('#label_1').bootstrapToggle('on')
                }else {
                    $('#label_1').bootstrapToggle('off')
                }
                if(sw_log.dripper_2 == 'ON'){
                    $('#label_2').bootstrapToggle('on')
                }else {
                    $('#label_2').bootstrapToggle('off')
                }
                if(sw_log.dripper_3 == 'ON'){
                    $('#label_3').bootstrapToggle('on')
                }else {
                    $('#label_3').bootstrapToggle('off')
                }
                if(sw_log.dripper_4 == 'ON'){
                    $('#label_4').bootstrapToggle('on')
                }else {
                    $('#label_4').bootstrapToggle('off')
                }
                if(sw_log.dripper_1 == 'ON' && sw_log.dripper_2 == 'ON' && sw_log.dripper_3 == 'ON' && sw_log.dripper_4 == 'ON'){
                    $('#checkbox_all_manual').prop('checked', true);
                }else {
                    $('#checkbox_all_manual').prop('checked', false);
                }
            }else if (val == 2){
                if(sw_log.fan_1 == 'ON'){
                    $('#label_1').bootstrapToggle('on')
                }else {
                    $('#label_1').bootstrapToggle('off')
                }
                if(sw_log.fan_2 == 'ON'){
                    $('#label_2').bootstrapToggle('on')
                }else {
                    $('#label_2').bootstrapToggle('off')
                }
                if(sw_log.fan_3 == 'ON'){
                    $('#label_3').bootstrapToggle('on')
                }else {
                    $('#label_3').bootstrapToggle('off')
                }
                if(sw_log.fan_4 == 'ON'){
                    $('#label_4').bootstrapToggle('on')
                }else {
                    $('#label_4').bootstrapToggle('off')
                }
                if(sw_log.fan_1 == 'ON' && sw_log.fan_2 == 'ON' && sw_log.fan_3 == 'ON' && sw_log.fan_4 == 'ON'){
                    $('#checkbox_all_manual').prop('checked', true);
                }else {
                    $('#checkbox_all_manual').prop('checked', false);
                }
            }else if (val == 3){
                if(sw_log.foggy_1 == 'ON'){
                    $('#label_1').bootstrapToggle('on')
                }else {
                    $('#label_1').bootstrapToggle('off')
                }
                if(sw_log.foggy_2 == 'ON'){
                    $('#label_2').bootstrapToggle('on')
                }else {
                    $('#label_2').bootstrapToggle('off')
                }
                $('.label_3').hide();
                $('.label_4').hide();
                $('.status_config_manual_3').hide();
                $('.status_config_manual_4').hide();
                if(sw_log.foggy_1 == 'ON' && sw_log.foggy_2 == 'ON'){
                    $('#checkbox_all_manual').prop('checked', true);
                }else {
                    $('#checkbox_all_manual').prop('checked', false);
                }
            }
            // =============================================
            $('#checkbox_all_manual').click(function(){
                if($(this).prop('checked') === true){
                    $('.input_check2').bootstrapToggle('on')
                }else {
                    $('.input_check2').bootstrapToggle('off')
                }
                fn_check_manual_save($('.hidden_select_sw_manual').val(), '')
            });
            $('.input_check2').on('change',function(){
                var numb = $('.hidden_select_sw_manual').val();
                if(numb <= 2){
                    if($('#label_1').prop('checked') === true && $('#label_2').prop('checked') === true && $('#label_3').prop('checked') === true && $('#label_4').prop('checked') === true) {
                        $('#checkbox_all_manual').prop('checked', true);
                    }else {
                        $('#checkbox_all_manual').prop('checked', false);
                    }
                }else if(numb == 3){
                    if($('#label_1').prop('checked') === true && $('#label_2').prop('checked') === true) {
                        $('#checkbox_all_manual').prop('checked', true);
                    }else {
                        $('#checkbox_all_manual').prop('checked', false);
                    }
                }
                fn_check_manual_save($('.hidden_select_sw_manual').val(), '');
            });
            $('#close_manual_cont').click(function(){
                fn_check_manual_save($('.hidden_select_sw_manual').val(), 'close');
            });
            function fn_check_manual_save(numb, mode){
                var sw_log = $.parseJSON($('#val_sw_manual').val());
                var new_log = [];
                if(numb == 1){
                    if ($("#label_1").prop('checked') == true) {
                        new_log['dripper_1'] = "ON";
                    }else {
                        new_log['dripper_1'] = "OFF";
                    }
                    if ($("#label_2").prop('checked') == true) {
                        new_log['dripper_2'] = "ON";
                    }else {
                        new_log['dripper_2'] = "OFF";
                    }
                    if ($("#label_3").prop('checked') == true) {
                        new_log['dripper_3'] = "ON";
                    }else {
                        new_log['dripper_3'] = "OFF";
                    }
                    if ($("#label_4").prop('checked') == true) {
                        new_log['dripper_4'] = "ON";
                    }else {
                        new_log['dripper_4'] = "OFF";
                    }
                    new_log['fan_1'] = sw_log.fan_1;
                    new_log['fan_2'] = sw_log.fan_2;
                    new_log['fan_3'] = sw_log.fan_3;
                    new_log['fan_4'] = sw_log.fan_4;
                    new_log['foggy_1'] = sw_log.foggy_1;
                    new_log['foggy_2'] = sw_log.foggy_2;
                    new_log['spray'] = sw_log.spray;
                    new_log['shading'] = sw_log.shading;
                }else if (numb == 2){
                    new_log['dripper_1'] = sw_log.dripper_1;
                    new_log['dripper_2'] = sw_log.dripper_2;
                    new_log['dripper_3'] = sw_log.dripper_3;
                    new_log['dripper_4'] = sw_log.dripper_4;
                    if ($("#label_1").prop('checked') == true) {
                        new_log['fan_1'] = "ON";
                    }else {
                        new_log['fan_1'] = "OFF";
                    }
                    if ($("#label_2").prop('checked') == true) {
                        new_log['fan_2'] = "ON";
                    }else {
                        new_log['fan_2'] = "OFF";
                    }
                    if ($("#label_3").prop('checked') == true) {
                        new_log['fan_3'] = "ON";
                    }else {
                        new_log['fan_3'] = "OFF";
                    }
                    if ($("#label_4").prop('checked') == true) {
                        new_log['fan_4'] = "ON";
                    }else {
                        new_log['fan_4'] = "OFF";
                    }
                    new_log['foggy_1'] = sw_log.foggy_1;
                    new_log['foggy_2'] = sw_log.foggy_2;
                    new_log['spray'] = sw_log.spray;
                    new_log['shading'] = sw_log.shading;
                }else if (numb == 3){
                    new_log['dripper_1'] = sw_log.dripper_1;
                    new_log['dripper_2'] = sw_log.dripper_2;
                    new_log['dripper_3'] = sw_log.dripper_3;
                    new_log['dripper_4'] = sw_log.dripper_4;
                    new_log['fan_1'] = sw_log.fan_1;
                    new_log['fan_2'] = sw_log.fan_2;
                    new_log['fan_3'] = sw_log.fan_3;
                    new_log['fan_4'] = sw_log.fan_4;
                    if ($("#label_1").prop('checked') == true) {
                        new_log['foggy_1'] = "ON";
                    }else {
                        new_log['foggy_1'] = "OFF";
                    }
                    if ($("#label_2").prop('checked') == true) {
                        new_log['foggy_2'] = "ON";
                    }else {
                        new_log['foggy_2'] = "OFF";
                    }
                    new_log['spray'] = sw_log.spray;
                    new_log['shading'] = sw_log.shading;
                }
                var new_log2 = {
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
                // console.log($('#val_sw_manual').val())
                // console.log(JSON.stringify(new_log2))
                if(mode === 'close'){
                    if ($('#val_sw_manual').val() === JSON.stringify(new_log2)) {
                        $(".menu_config_manual").show();
                        $('.status_config_manual').hide();
                        $(".sw_mode_Auto").attr('disabled', false);
                        $(".sw_mode_Manual").attr('disabled', false);
                        fn_label_manual($('.hidden_select_sw_manual').val());
                        $("#save_manual_cont").hide();
                        $("#close_manual_cont").hide();
                    } else {
                        swal({
                            title: 'คุณแน่ใจหรือไม่?',
                            text: "คุณต้องการยกเลิกการตั้งค่า?",
                            type: 'warning',
                            allowOutsideClick: false,
                            showCancelButton: true,
                            confirmButtonColor: '#da3444',
                            cancelButtonColor: '#8e8e8e',
                            confirmButtonText: 'ยืนยัน',
                            cancelButtonText: 'ยกเลิก',
                        }).then((result) => {
                            if (result.value) {
                                $(".menu_config_manual").show();
                                $('.status_config_manual').hide();
                                $(".sw_mode_Auto").attr('disabled', false);
                                $(".sw_mode_Manual").attr('disabled', false);
                                fn_label_manual($('.hidden_select_sw_manual').val());
                                $("#save_manual_cont").hide();
                                $("#close_manual_cont").hide();
                            }
                        });
                    }
                }else {
                    if ($('#val_sw_manual').val() === JSON.stringify(new_log2)) {
                        $("#save_manual_cont").hide();
                    } else {
                        $("#save_manual_cont").show();
                    }
                }
            }
        });
    });

    // df sw Auto
    function fn_df_checkbox_auto(val){  // switch
        for (var i = 1; i <= 12; i++) {
            if(i == val){
                $('.title_load_auto').html(config_cn['cn_name_'+i]);
                $("#"+i).addClass('active');
                // if(i <= 4){
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/dripper_on.png');
                // }else if (i > 4 && i <= 8) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/fan_on.png');
                // }else if (i > 8 && i <= 10) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/foggy_on.png');
                // }else if (i == 11) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/spray_on.png');
                // }else if (i == 12) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/shading_on.png');
                // }
            }
            else {
                $('#'+i).removeClass('active')
                // if(i <= 4){
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/dripper_off.png');
                // }else if (i > 4 && i <= 8) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/fan_off.png');
                // }else if (i > 8 && i <= 10) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/foggy_off.png');
                // }else if (i == 11) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/spray_off.png');
                // }else if (i == 12) {
                //     $('.img_sw_sel_load_auto'+i).attr('src','public/images/icons/menu_control/shading_off.png');
                // }
            }
        }
    }
    // df input Auto
    function fn_df_logdata_auto(numb) { // input
        var res = JSON.parse($('#val_sw_auto').val())
            console.log(res);
            // return false;
        for (var i = 0; i <= 6; i++) {
            if (res["load_"+numb]["load_st_"+i] == 1) {
                $("#swch_"+i).bootstrapToggle('on');
                $(".img_"+i).attr("src", "public/images/control/switck_on.png");
                $("#time_s_"+i).prop('disabled', true).val(res["load_"+numb]["load_s_"+i]);
                $("#time_e_"+i).prop('disabled', true).val(res["load_"+numb]["load_e_"+i]);
            } else {
                $("#swch_"+i).bootstrapToggle('off');
                $(".img_"+i).attr("src", "public/images/control/switck_off.png");
                $("#time_s_"+i).prop('disabled', true).val("");
                $("#time_e_"+i).prop('disabled', true).val("");
            }
        }
    }
    // check save Auto
    function fn_check_auto_save(chanel, mode){
        var res = JSON.parse($('#val_sw_auto').val())
        var sw_gd = [];
        for (var i = 1; i <= 6; i++) {
            if ($("#swch_"+i).prop('checked') === true) {
                sw_gd['load_st_'+i] = 1;
                sw_gd['load_s_'+i] = $("#time_s_"+i).val();
                sw_gd['load_e_'+i] = $("#time_e_"+i).val();
            } else {
                sw_gd['load_st_'+i] = 0;
                sw_gd['load_s_'+i] = "";
                sw_gd['load_e_'+i] = "";
            }
        }
        var sw_gd2 = {
            'load_st_1':sw_gd['load_st_1'],
            'load_st_2':sw_gd['load_st_2'],
            'load_st_3':sw_gd['load_st_3'],
            'load_st_4':sw_gd['load_st_4'],
            'load_st_5':sw_gd['load_st_5'],
            'load_st_6':sw_gd['load_st_6'],
            'load_s_1':sw_gd['load_s_1'],
            'load_s_2':sw_gd['load_s_2'],
            'load_s_3':sw_gd['load_s_3'],
            'load_s_4':sw_gd['load_s_4'],
            'load_s_5':sw_gd['load_s_5'],
            'load_s_6':sw_gd['load_s_6'],
            'load_e_1':sw_gd['load_e_1'],
            'load_e_2':sw_gd['load_e_2'],
            'load_e_3':sw_gd['load_e_3'],
            'load_e_4':sw_gd['load_e_4'],
            'load_e_5':sw_gd['load_e_5'],
            'load_e_6':sw_gd['load_e_6']
        };
        // console.log(JSON.stringify(res['load_'+chanel]));
        // console.log(JSON.stringify(sw_gd2));
        // console.log(sw_gd2);

        if(mode === 'close'){
            if (JSON.stringify(res['load_'+chanel]) === JSON.stringify(sw_gd2)) {
                $(".img_sw").show();
                $('.input_time').prop('disabled', true);
                $(".sw_toggle").hide();
                $(".menu_config_auto").show();
                $("#save_auto_cont").hide();
                $("#close_auto_cont").hide();
                $(".sw_mode_Auto").attr('disabled', false);
                $(".sw_mode_Manual").attr('disabled', false);
                // $(".close_modal").show();
            } else {
                swal({
                    title: 'คุณแน่ใจหรือไม่?',
                    text: "คุณต้องการยกเลิกการตั้งค่า?",
                    type: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonColor: '#da3444',
                    cancelButtonColor: '#8e8e8e',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                    if (result.value) {
                        $(".img_sw").show();
                        $('.input_time').removeClass("input_err").prop('disabled', true);
                        $(".sw_toggle").hide();
                        $(".menu_config_auto").show();
                        $(".sw_mode_Auto").attr('disabled', false);
                        $(".sw_mode_Manual").attr('disabled', false);
                        $(".close_modal").show();
                        fn_df_logdata_auto(chanel);
                        $("#save_auto_cont").hide();
                        // $("#close_auto_cont").hide();
                    }
                });
            }
        }else {
            if (JSON.stringify(res['load_'+chanel]) === JSON.stringify(sw_gd2)) {
                $("#save_auto_cont").hide();
            } else {
                $("#save_auto_cont").show();
            }
        }
    }
    // label_manual
    function fn_label_manual(val) {
        var sw_log = $.parseJSON($('#val_sw_manual').val());
        if(val == 1){
            $('.title_load_manual').html('ควบคุมน้ำหยด');
            $('.label_1').html(config_cn.cn_name_1);
            $('.label_2').html(config_cn.cn_name_2);
            $('.label_3').html(config_cn.cn_name_3);
            $('.label_4').html(config_cn.cn_name_4);
            if($('#close_manual_cont').is(":hidden") == true){
                if(sw_log.dripper_1 === 'ON'){
                    $('.label_1').show();
                }else{
                    $('.label_1').hide();
                }
                if(sw_log.dripper_2 === 'ON'){
                    $('.label_2').show();
                }else{
                    $('.label_2').hide();
                }
                if(sw_log.dripper_3 === 'ON'){
                    $('.label_3').show();
                }else{
                    $('.label_3').hide();
                }
                if(sw_log.dripper_4 === 'ON'){
                    $('.label_4').show();
                }else{
                    $('.label_4').hide();
                }
            }
        }
        else if(val == 2){
            $('.title_load_manual').html('ควบคุมพัดลม');
            $('.label_1').html(config_cn.cn_name_5);
            $('.label_2').html(config_cn.cn_name_6);
            $('.label_3').html(config_cn.cn_name_7);
            $('.label_4').html(config_cn.cn_name_8);
            if($('#close_manual_cont').is(":hidden") == true){
                if(sw_log.fan_1 === 'ON'){
                    $('.label_1').show();
                }else{
                    $('.label_1').hide();
                }
                if(sw_log.fan_2 === 'ON'){
                    $('.label_2').show();
                }else{
                    $('.label_2').hide();
                }
                if(sw_log.fan_3 === 'ON'){
                    $('.label_3').show();
                }else{
                    $('.label_3').hide();
                }
                if(sw_log.fan_4 === 'ON'){
                    $('.label_4').show();
                }else{
                    $('.label_4').hide();
                }
            }
        }
        else if(val == 3){
            $('.title_load_manual').html('ควบคุมพ่นหมอก');
            $('.label_1').html(config_cn.cn_name_9);
            $('.label_2').html(config_cn.cn_name_10);
            if($('#close_manual_cont').is(":hidden") == true){
                if(sw_log.foggy_1 === 'ON'){
                    $('.label_1').show();
                }else{
                    $('.label_1').hide();
                }
                if(sw_log.foggy_2 === 'ON'){
                    $('.label_2').show();
                }else{
                    $('.label_2').hide();
                }
                $('.label_3').hide();
                $('.label_4').hide();
                $('.status_config_manual_3').hide();
                $('.status_config_manual_4').hide();
            }
        }
        else if(val == 4){
            $('.title_load_manual').html('ควบคุมสเปรย์');
        }
        else if(val == 5){
            $('.title_load_manual').html('ควบคุมม่านพรางแสง');
        }
        if(val < 4){
            $('.menu_config_manual').show();
        }else {
            $('.menu_config_manual').hide();
            $('.label_1').hide();
            $('.label_2').hide();
            $('.label_3').hide();
            $('.label_4').hide();
        }
    }
    // switch_manual
    function fn_df_sw_manual(val){
        for (var i = 1; i <= 5; i++) {
            if(i == val){
                $("#s"+i).addClass('active'); // .addClass('btn-outline-success') //
                // if(i == 1){
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/dripper_on.png');
                // }else if (i == 2) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/fan_on.png');
                // }else if (i == 3) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/foggy_on.png');
                // }else if (i == 4) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/spray_on.png');
                // }else if (i == 5) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/shading_on.png');
                // }
            }else {
                $('#s'+i).removeClass('active') //.removeClass('btn-outline-success')
                // if(i == 1){
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/dripper_off.png');
                // }else if (i == 2) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/fan_off.png');
                // }else if (i == 3) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/foggy_off.png');
                // }else if (i == 4) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/spray_off.png');
                // }else if (i == 5) {
                //     $('.img_sw_sel_load_manual_'+i).attr('src','public/images/icons/menu_control/shading_off.png');
                // }
            }
        }
        fn_label_manual(val);
    }
    // count array by value
    function countElement(item,array) {
        var count = 0;
        $.each(array, function(i,v) { if (v === item) count++; });
        return count;
    }
</script>
<script>
    var optionsLine = {
        chart: {
            id: 'realtime',
            foreColor: '#9ba7b2',
            height: 560,
            type: 'line',
            toolbar: {
                show: true,
                tools: {
                    download: false,
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
        }
    }
    var chartLine = new ApexCharts(document.querySelector('#chart_realtime'), optionsLine);
    chartLine.render();
    // if(s_sensor.s_btnT > 0){
    //     var chartLine1 = new ApexCharts(document.querySelector('#chart1'), optionsLine);
    //     chartLine1.render();
    // }
    // if(s_sensor.s_btnH > 0){
    //     var chartLine2 = new ApexCharts(document.querySelector('#chart2'), optionsLine);
    //     chartLine2.render();
    // }
    // if(s_sensor.s_btnL > 0){
    //     var chartLine3 = new ApexCharts(document.querySelector('#chart3'), optionsLine);
    //     chartLine3.render();
    // }
    // if(s_sensor.s_btnS > 0){
    //     var chartLine4 = new ApexCharts(document.querySelector('#chart4'), optionsLine);
    //     chartLine4.render();
    // }

    $.ajax({ // Auto
        url: "routes/tu/get_chart_realtime.php",
        method: "post",
        data: {
            house_master: house_master,
            config_sn: config_sn
        },
        dataType: "json",
        success: function(res) {
            // console.log(res);
            // console.log(res.data);
            data_temp_out = res.data.temp_out;
            data_temp_in = res.data.temp_in;
            data_hum_out = res.data.hum_out;
            data_hum_in = res.data.hum_in;
            data_light_out = res.data.light_out;
            data_light_in = res.data.light_in;
            data_soil_in = res.data.soil_in;

            if(s_sensor.s_btnT > 0){
                chartLine.updateSeries([
                    {
                        name: config_sn.sn_name_1,
                        data: data_temp_out
                    }, {
                        name: config_sn.sn_name_4,
                        data: data_temp_in
                    }
                ])
                chartLine.updateOptions({
                    title:  {text: 'อุณหภูมิ'},
                    tooltip: {
                        y: {
                        	formatter: function (val) {
                        		return  val + " ℃"
                        	}
                        }
                    },
                    subtitle: {
                        text: '(℃)',
                        offsetY: 55,
                        offsetX: 10
                    },
                })
            }
            else if(s_sensor.s_btnT == 0 && s_sensor.s_btnH > 0){
                chartLine.updateSeries([
                    {
                        name: config_sn.sn_name_2,
                        data: data_hum_out
                    }, {
                        name: config_sn.sn_name_5,
                        data: data_hum_in
                    }
                ]);
                // console.log(data_hum_out);
                chartLine.updateOptions({
                    title:  {text: 'ความชื้นอากาศ'},
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return  val + " %Rh"
                            }
                        }
                    },
                    subtitle: {
                        text: '(%Rh)',
                        offsetY: 55,
                        offsetX: 10
                    },
                });
            }
            else if(s_sensor.s_btnT == 0 && s_sensor.s_btnH == 0 && s_sensor.s_btnL > 0){
                chartLine.updateSeries([
                    {
                        name: config_sn.sn_name_3,
                        data: data_light_out
                    }, {
                        name: config_sn.sn_name_6,
                        data: data_light_in
                    }
                ]);
                chartLine.updateOptions({
                    title:  {text: 'ความเข้มแสง'},
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return  val + " KLux"
                            }
                        }
                    },
                    subtitle: {
                        text: '(KLux)',
                        offsetY: 55,
                        offsetX: 10
                    },
                })
            }
            else if(s_sensor.s_btnT == 0 && s_sensor.s_btnH == 0 && s_sensor.s_btnL == 0 && s_sensor.s_btnS > 0){
                chartLine.updateSeries([
                    {
                        name: config_sn.sn_name_7,
                        data: data_soil_in
                    }]
                )
                chartLine.updateOptions({
                    title:  {text: 'ความชื้นดิน'},
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return  val + " %"
                            }
                        }
                    },
                    subtitle: {
                        text: '(%)',
                        offsetY: 55,
                        offsetX: 10
                    },
                })
            }
        }
    });
    $('.btn_ch_t').click(function(){
        // $('#chart_realtime').html("")
        // var chartLine = new ApexCharts(document.querySelector('#chart_realtime'), optionsLine);
        // chartLine.render();
        // data_temp_out = res.data.temp_out;
        // data_temp_in = res.data.temp_in;
        chartLine.updateSeries([
            {
                name: config_sn.sn_name_1,
                data: data_temp_out
            }, {
                name: config_sn.sn_name_4,
                data: data_temp_in
            }
        ])
        chartLine.updateOptions({
            title:  {text: 'อุณหภูมิ'},
            tooltip: {
                y: {
                    formatter: function (val) {
                        return  val + " ℃"
                    }
                }
            },
            subtitle: {
                text: '(℃)',
                offsetY: 55,
                offsetX: 10
            },
        })
    })
    $('.btn_ch_h').click(function(){
        // $('#chart_realtime').html("")
        // chartLine.destroy();
        // setTimeout(function () {
            // var chartLine = new ApexCharts(document.querySelector('#chart_realtime'), optionsLine);
            // chartLine.render();
            // data_hum_out = res.data.hum_out;
            // data_hum_in = res.data.hum_in;
            chartLine.updateSeries([
                {
                    name: config_sn.sn_name_2,
                    data: data_hum_out
                }, {
                    name: config_sn.sn_name_5,
                    data: data_hum_in
                }
            ])
            console.log(data_hum_out);
            chartLine.updateOptions({
                title:  {text: 'ความชื้นอากาศ'},
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return  val + " %Rh"
                        }
                    }
                },
                subtitle: {
                    text: '(%Rh)',
                    offsetY: 55,
                    offsetX: 10
                },
            });
        // }, 2000);
    })
    $('.btn_ch_l').click(function(){
        chartLine.updateSeries([
            {
                name: config_sn.sn_name_3,
                data: data_light_out
            }, {
                name: config_sn.sn_name_6,
                data: data_light_in
            }
        ]);
        chartLine.updateOptions({
            title:  {text: 'ความเข้มแสง'},
            tooltip: {
                y: {
                    formatter: function (val) {
                        return  val + " KLux"
                    }
                }
            },
            subtitle: {
                text: '(KLux)',
                offsetY: 55,
                offsetX: 10
            },
        })
    })
    $('.btn_ch_s').click(function(){
        chartLine.updateSeries([
            {
                name: config_sn.sn_name_7,
                data: data_soil_in
            }]
        )
        chartLine.updateOptions({
            title:  {text: 'ความชื้นดิน'},
            tooltip: {
                y: {
                    formatter: function (val) {
                        return  val + " %"
                    }
                }
            },
            subtitle: {
                text: '(%)',
                offsetY: 55,
                offsetX: 10
            },
        })
    })
</script>
