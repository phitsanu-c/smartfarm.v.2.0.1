<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
        <div class="breadcrumb-title pe-3">
            <?= $s_master['site_name'] ?>
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a> </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <?= $s_master['house_name'] ?>
                    </li>
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
    <hr />
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4 col-sm-12 d-flex">
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
                                    <h5>ขนาดโรงเรือน : <b>
                                            <?= substr($s_master["house_size"],9,13) ?>
                                        </b> เมตร</h5>
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
                                    <h5>หมายเลขอินเตอร์เน็ต : <b>
                                            <?= $s_master["site_internet"] ?>
                                        </b></h5>
                                </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-12">
                                <!-- <div class="card-body radius-10 shadow-none"> -->
                                <div class="d-flex">
                                    <h5>วันหมดอายุ : <b>
                                            <?= $s_master["site_internetO"] ?>
                                        </b></h5>
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
        <div class="col-12 col-lg-8 col-xl-8 col-sm-12 d-flex">
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
                                                    <h5 class="card-title mt-2 "><B>
                                                            <?= $config_sn['sn_name_'.$i] ?>
                                                        </B></h5>
                                                    <div class="ms-auto mt-2 image-popups">
                                                        <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                                echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker "></i></a>';
                                                            }?>
                                                    </div>
                                                </div>
                                                <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle"
                                                    style="width:90px; margin-top:10px; text-align: center!important;">
                                                <h6 class="card-text text-center  dash_data__<?= $i ?>" style="margin-top:20px">
                                                </h6>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
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
                                            <h5 class="card-title mt-2 "><B>
                                                    <?= $config_sn['sn_name_'.$i] ?>
                                                </B></h5>
                                            <div class="ms-auto mt-2 image-popups">
                                                <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                        echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker"></i></a>';
                                                    }?>
                                            </div>
                                        </div>
                                        <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle"
                                            style="width:90px; margin-top:10px; text-align: center!important;">
                                        <h6 class="card-text text-center dash_data__<?= $i ?>" style="margin-top:20px">
                                        </h6>
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
                    <h3 class="card-title text-center"><b>ระบบควบคุม </b></h3>
                    <!-- <h5 class="card-title text-center"><b>โหมดอัตโนมัติ </b></h5> -->
                    <!-- <div class="row g-2"> -->
                    <!-- <div class="col-lg-6 col-xl-6 col-sm-12 col-12" > -->
                    <button type="button" class="btn btn-outline-success px-5 radius-30 dash_mode active"
                        style="font-size:18px">โหมดอัตโนมัติ</button>
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
                            <div class="text-center">
                                <?php
                                            if($i <= 4){echo '<h4><b>Dripper '.$i.'</b></h4>';}
                                            elseif($i > 4 && $i <= 8){echo '<h4><b>Fan '.($i-4).'</b></h4>';}
                                            elseif($i > 8 && $i <= 10){echo '<h4><b>Foggy '.($i-8).'</b></h4>';}
                                            elseif($i == 11){echo '<h4><b>sprinker</b></h4>';}
                                            elseif($i == 12){echo '<h4><b>Roof</b></h4>';}
                                        ?>
                                <h5>
                                    <?= $config_cn['cn_name_'.$i] ?>
                                </h5>
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
    <div class="modal fade" id="Modal_control" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <h5 class="modal-title">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <h4 class="modal-title"><b id="title_modal"></b> Control Status</h4>
                            <div class="ms-auto">
                                <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"
                                    aria-label="Close"> <span aria-hidden="true"></span> </button>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row ">
                                <div class="col-6">
                                    <button type="button" class="btn btn-lg sw_mode_Auto" style="width: 100%; border-radius:20px;">อัตโนมัติ</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-lg  sw_mode_Manual" style="width: 100%; border-radius:20px;">กำหนดเอง</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 ul_Auto">
                            <ul class="nav mt-3">
                                <?php
                                   for($i = 1; $i <= 12; $i++){
                                        if($config_cn['cn_status_'.$i] == 1){
                                            echo '<li class="nav-item col-3 col-lg-2">
                                                    <button class="btn btn-control sw_btn_au" style="width:100% " id="'.$i.'">'.$config_cn['cn_name_'.$i].'<br>
                                                        <img class="cn_memu_img_'.$i.'" src="" width="70" />
                                                    </button>
                                               </li>';
                                       }
                                    }
                                ?>
                            </ul>
                        </div>
                        
                        <div class="row cols-10 text-center mt-2 ul_Manual">
                        <?php
                                    if($config_cn['cn_status_1'] == 1 || $config_cn['cn_status_2'] == 1 || $config_cn['cn_status_3'] == 1 || $config_cn['cn_status_4'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_btn_s" style="width:100% " id="s1">Dripper<br>
                                                    <img class="cn_memu_img_mn_1" width="70"  src=""  />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_5'] == 1 || $config_cn['cn_status_6'] == 1 || $config_cn['cn_status_7'] == 1 || $config_cn['cn_status_8'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_btn_s" style="width:100% " id="s2">Fan<br>
                                                    <img class="cn_memu_img_mn_2" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_9'] == 1 || $config_cn['cn_status_10'] == 1){
                                        echo '<div class="cols-3 cols-lg-5" >
                                                <button class="btn btn-control sw_btn_s" style="width:100% " id="s3">Foggy<br>
                                                    <img class="cn_memu_img_mn_3" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_11'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_btn_s" style="width:100% " id="s4">Sprinker<br>
                                                    <img class="cn_memu_img_mn_4" src="" width="70" />
                                                </button>
                                           </div>';
                                    }
                                    if($config_cn['cn_status_12'] == 1){
                                        echo '<div class="cols-3 cols-lg-5">
                                                <button class="btn btn-control sw_btn_s" style="width:100% " id="s5">Roof<br>
                                                    <img class="cn_memu_img_mn_5" src="" width="70" />
                                                </button>
                                           </div>';

                                    }
                                ?>
                                <input type="hidden" class="manual_select">
                    
                        </div>
                    </div>
				</div>
				<div class="modal-body">
                    <div class="container ul_Auto">
                        <!-- Control 1 -->
                        <div class="row ridge">
                            <div class="d-flex align-items-center"
                                style="background-color: #283A6C; text-align: justify;">
                                <a><b class="text_load " style="color:#FFF; font-size:20px"> </b></a>
                                <div class="ms-auto">
                                    <a class="edit_cont" style="color:#FFF; font-size:15px" href="javascript:void(0)"><b> <i class='bx bx-cog'></i> ตั้งค่า</b></a>
                                    <input type="hidden" class="load_select">
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
                        <!-- Exit Control 1 -->
                    </div>
                    <!-- ================================ -->
                    <div class="container ul_Manual">
                            <div class="row">
                                <div class="col text-end  me-2">
                                     <button class="btn btn-control " > <br>
                                                        <img src="public/images/icons/memu_control/off_off.png" width="100" />
                                                    </button>
                                  
                                </div>
                                <div class="col text-start ms-2">
                                     <button class="btn btn-control " > <br>
                                                        <img src="public/images/icons/memu_control/on_on.png" width="100" />
                                                    </button>
                                  
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
                            <div class="form-check check_m">
                                <input class="form-check-input" type="checkbox" id="manual_check">
                                <label class="form-check-label">เลือกทั้งหมด</label>
                            </div>
                            <div class="ms-auto">
                                <button type="button" class="btn btn-outline-secondary px-5 radius-30 btn_config">ตั้งค่า</button>
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
                                <label class="label_1">Dripper 1</label>
                                <div class="check_m">
                                    <input class="input_check2" type="checkbox" id="label_1" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <label class="label_2">Dripper 2</label>
                                <div class="check_m">
                                    <input class="input_check2" type="checkbox" id="label_2" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <label class="label_3">Dripper 3</label>
                                <div class="check_m">
                                    <input class="input_check2" type="checkbox" id="label_3" data-toggle="toggle" data-onstyle="success" data-size="mini" data-offstyle="secondary" data-style="ios">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <label class="label_4">Dripper 4</label>
                                <div class="check_m">
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
</div>
<script>
    var house_master = '<?= $s_master["house_master"] ?>';
    var login_user = '<?= $account_user ?>';
    var config_sn = $.parseJSON('<?= json_encode($config_sn) ?>');
    var config_cn = $.parseJSON('<?= json_encode($config_cn) ?>');
    var set_maxmin = $.parseJSON('<?= json_encode($set_maxmin) ?>');
    var sensor = $.parseJSON('<?= json_encode($sensor) ?>');
    console.log(config_cn)

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
            // console.log(parseJSON)
            var chart_timestamp = parseJSON['date_time'];
            var time_t = parseJSON['time'];
            var ntime = time_t.substring(0, 5);
            $(".date").html(parseJSON['date']);
            $(".time").html(ntime);
            var data_ = parseJSON['data']
            // console.log(sensor)
            for (var i = 1; i <= 7; i++) {
                // console.log(config_sn['sn_sensor_'+i])
                //
                if (config_sn['sn_status_' + i] == 1) {
                    // for(var s=0; s <= sensor.length; s++){
                    //     if(s == config_sn['sn_sensor_'+i]){
                    // console.log(sensor[(config_sn['sn_sensor_'+i] -1)].sensor_name)
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

        } else if (message.destinationName == house_master + "/control/resporn") {
            var result = message.payloadString;
            var parseJSON = $.parseJSON(result);
            // console.log(parseJSON)
            if (parseJSON.mode === 'Manual') {
                $('.dash_mode').html('โหมดกำหนดเอง')
                $('.sw_mode_Auto').removeClass('btn-success').addClass('btn-outline-success')
                $('.sw_mode_Manual').addClass('btn-success').removeClass('btn-outline-success')
                $('.ul_Auto').hide()
                $('.ul_Manual').show()
            } else {
                $('.dash_mode').html('โหมดอัตโนมัติ')
                $('.sw_mode_Auto').addClass('btn-success').removeClass('btn-outline-success')
                $('.sw_mode_Manual').removeClass('btn-success').addClass('btn-outline-success')
                $('.ul_Auto').show()
                $('.ul_Manual').hide()
            }
            for (var i = 1; i <= 12; i++) {
                if (config_cn['cn_status_' + i] == 1) {
                    if (i <= 4) {
                        if (parseJSON['dripper_' + i] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_OFF2.svg");
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_ON2.svg");
                        }
                    }
                    if (i < 9 && i > 4) {
                        if (parseJSON['fan_' + (i - 4)] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Fan_OFF.svg");
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Fan_ON.svg");
                        }
                    }
                    if (i == 9 || i == 10) {
                        if (parseJSON['fan_' + (i - 8)] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/new_foggy-off.svg");
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/new_foggy-on.svg");
                        }
                    }
                    if (i == 11) {
                        if (parseJSON['sprinker'] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_OFF.svg");
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Sprinkler_ON.svg");
                        }
                    }
                    if (i == 12) {
                        if (parseJSON['roof'] === 'OFF') {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Roof_OFF2.png");
                        } else {
                            $(".dash_img_con_" + i).attr("src", "public/images/control/Roof_ON2.png");
                        }
                    }
                }
            }
        }

    }// exit_message
    connect();

    // ++++++++++++++++++
    $('.sw_mode_Auto').click(function () { // console.log($(this).attr("id"));
        // alert($(this).attr("id"))
        // if ($(this).hasClass("active") === false) {
        // if (house_master !== "KMUMT001") {
        //     switch_mode(sw_name = "Auto", mess = "Auto", mqtt_name = "user_control");
        // } else {
        //     switch_mode(sw_name = "Auto", mess = "on", mqtt_name = "control_user");
        // }
        // }
        mqtt_send(msg_dn = house_master + "/control/status/mode", msg = "Auto")
    });
    $('.sw_mode_Manual').click(function () { // console.log($(this).attr("id"));
        // if ($(this).hasClass("active") === false) {
        //     if (house_master !== "KMUMT001") {
        //         switch_mode(sw_name = "Manual", mess = "Manual", mqtt_name_us = "user_control");
        //     } else {
        //         switch_mode(sw_name = "Manual", mess = "off", mqtt_name_us = "control_user");
        //     }
        // }
        mqtt_send(msg_dn = house_master + "/control/status/mode", msg = "Manual")
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

    $(".Dsw_manual_1").click(function () {
        setTimeout(function () {
            // alert($(".sw_manual_1").prop('checked'));
            if (house_master !== "KMUMT001") {
                switch_control(sta = $(".sw_manual_1").prop('checked'), sw_name = "sw_manual_1", ch_name = '<?= $config_cn['cn_name_1'] ?>', mqtt_ch_name = "dripper_1", mqtt_name_us = "user_control");
            } else {
                switch_control(sta = $(".sw_manual_1").prop('checked'), sw_name = "sw_manual_1", ch_name = '<?= $config_cn['cn_name_1'] ?>', mqtt_ch_name = "control_st_1", mqtt_name_us = "control_user");
            }
        }, 100);
    });

    function switch_control(sta, sw_name, ch_name, mqtt_ch_name, mqtt_name_us) {
        if (house_master !== "KMUMT001") {
            if (sta === false) { var sw_sta = "ปิด"; var mess = "OFF"; } else { var sw_sta = "เปิด"; var mess = "ON"; }
        } else {
            if (sta === false) { var sw_sta = "ปิด"; var mess = "off"; } else { var sw_sta = "เปิด"; var mess = "on"; }
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
            } else {
                $('.' + sw_name).bootstrapToggle("toggle");
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
            } else {
                // $('.'+sw_name).bootstrapToggle("toggle");
            }
        });
    }
    // ------- Switch control --------------

    // ++++++++++++++++++
    $('.memu_control').click(function () {
        // Create a client instance
        client = new Paho.MQTT.Client(hostname, Number(port), "mqtt_js_324" + parseInt(Math.random() * 100000, 10));

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
            function mqtt_send(msg_dn, msg, user) {
                message = new Paho.MQTT.Message(msg);
                message.destinationName = msg_dn;
                message.qos = 1;
                message.retained = true;
                client.send(message);
            }
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
                }).then((result) => {
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
                                load_select: $(".load_select").val(),
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
                                e_6: $("#time_e_6").val()
                            },
                            dataType: 'json',
                            success: function (res) {
                                console.log(res.data)
                                if (res.status === "Insert_Success") {
                                    $("#Modal_Auto_control").modal("hide");
                                    if (message.destinationName == house_master + "/control/config/auto") {
                                        var result = message.payloadString;
                                        var parseJSON = $.parseJSON(result);
                                        // console.log(parseJSON);
                                        $.extend(parseJSON, res.data);
                                        var json_msg = JSON.stringify(parseJSON);
                                        // console.log(parseJSON)
                                        mqtt_send(house_master+'/control/config/auto', json_msg, '')
                                    }
                                    swal({
                                        title: 'บันทึกข้อมูลสำเร็จ',
                                        type: 'success',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#32CD32'
                                    });
                                    for (var i = 1; i <= 6; i++){
                                        if ($("#swch_"+i).prop('checked') == true) { $(".img_"+i).attr("src", "public/images/control/switck_on.png"); } else { $(".img_"+i).attr("src", "public/images/control/switck_off.png"); }
                                    }
                                    $(".img_sw").show();
                                    $('.input_time').prop('disabled', true);
                                    $(".sw_toggle").hide();
                                    $(".edit_cont").show();
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
                                            location.reload();
                                            return false;
                                        }
                                    });
                                }
                            }
                        });

                    }
                });
            }); // exit_save_Auto
        }

        if($('.sw_mode_Auto').hasClass('btn-success') == true){
            $.ajax({
                url: "routes/tu/get_control_au.php",
                method: "post",
                data: {
                    house_master: house_master,
                    config_cn: config_cn
                },
                dataType: "json",
                success: function(res) {
                    // console.log(res);
                    $("#Modal_control").modal('show', { backdrop: "static" })
                    $(".edit_cont").show();
                    $(".img_sw").show();
                    $(".sw_toggle").hide();
                    $('.input_time').prop('disabled', true);
                    if(config_cn.cn_status_1 == 1){
                        $('.load_select').val(1);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 1) {
                        $('.load_select').val(2);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 1) {
                        $('.load_select').val(3);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 1) {
                        $('.load_select').val(4);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 1) {
                        $('.load_select').val(5);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 1) {
                        $('.load_select').val(6);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 1) {
                        $('.load_select').val(7);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 1) {
                        $('.load_select').val(8);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 1) {
                        $('.load_select').val(9);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 1) {
                        $('.load_select').val(10);
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 && config_cn.cn_status_11 == 1) {
                        $('.load_select').val(11); $("#11").addClass('active');
                    }else if (config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 && config_cn.cn_status_11 == 0 && config_cn.cn_status_12 == 1) {
                        $('.load_select').val(12);
                    }
                    memu_auto_check($('.load_select').val());
                    function memu_auto_check(val){
                        for (var i = 1; i <= 12; i++) {
                            if(i == val){
                                $('.text_load').html(config_cn['cn_name_'+i]);
                                $("#"+i).addClass('active');
                                if(i <= 4){
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/dripper_on.png');
                                }else if (i > 4 && i <= 8) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/fan_on.png');
                                }else if (i > 8 && i <= 10) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/foggy_on.png');
                                }else if (i == 11) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/spray_on.png');
                                }else if (i == 12) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/shading_on.png');
                                }
                            }else {
                                $('#'+i).removeClass('active')
                                if(i <= 4){
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/dripper_off.png');
                                }else if (i > 4 && i <= 8) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/fan_off.png');
                                }else if (i > 8 && i <= 10) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/foggy_off.png');
                                }else if (i == 11) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/spray_off.png');
                                }else if (i == 12) {
                                    $('.cn_memu_img_'+i).attr('src','public/images/icons/memu_control/shading_off.png');
                                }
                            }
                        }
                    }
                    // ===============================================
                    df_ed_text($('.load_select').val())
                    function df_ed_text(numb) {
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
                    $(".edit_cont").click(function() {
                        // $(".nav-link").addClass('disabled');
                        $(this).hide();
                        $(".img_sw").hide();
                        $(".sw_toggle").show();
                        $("#close_auto_cont").show();
                        $(".sw_mode_Auto").attr('disabled', true);
                        $(".sw_mode_Manual").attr('disabled', true);
                        $(".close_modal").hide();
                        for (var i = 0; i <= 6; i++) {
                            if (res["load_"+$('.load_select').val()]["load_st_"+i] == 1) {
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

                                $("#time_s_"+input_num[1]).prop('disabled', false).val(res["load_"+$('.load_select').val()]["load_s_"+input_num[1]]);
                                $("#time_e_"+input_num[1]).prop('disabled', false).val(res["load_"+$('.load_select').val()]["load_e_"+input_num[1]]);
                            }else {
                                $("#time_s_"+input_num[1]).prop('disabled', true).val("");
                                $("#time_e_"+input_num[1]).prop('disabled', true).val("");
                            }
                            btn_save_chang($('.load_select').val(), '');
                        });
                        $(".input_time").change(function() {
                            btn_save_chang($('.load_select').val(), '');
                        });
                    });
                    function btn_save_chang(chanel, mode){
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
                            'load_s_1':sw_gd['load_s_1'],
                            'load_e_1':sw_gd['load_e_1'],
                            'load_st_2':sw_gd['load_st_2'],
                            'load_s_2':sw_gd['load_s_2'],
                            'load_e_2':sw_gd['load_e_2'],
                            'load_st_3':sw_gd['load_st_3'],
                            'load_s_3':sw_gd['load_s_3'],
                            'load_e_3':sw_gd['load_e_3'],
                            'load_st_4':sw_gd['load_st_4'],
                            'load_s_4':sw_gd['load_s_4'],
                            'load_e_4':sw_gd['load_e_4'],
                            'load_st_5':sw_gd['load_st_5'],
                            'load_s_5':sw_gd['load_s_5'],
                            'load_e_5':sw_gd['load_e_5'],
                            'load_st_6':sw_gd['load_st_6'],
                            'load_s_6':sw_gd['load_s_6'],
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
                                $(".edit_cont").show();
                                $("#save_auto_cont").hide();
                                $("#close_auto_cont").hide();
                                $(".sw_mode_Auto").attr('disabled', false);
                                $(".sw_mode_Manual").attr('disabled', false);
                                $(".close_modal").show();
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
                                        $(".edit_cont").show();
                                        $(".sw_mode_Auto").attr('disabled', false);
                                        $(".sw_mode_Manual").attr('disabled', false);
                                        $(".close_modal").show();
                                        df_ed_text(chanel);
                                        $("#save_auto_cont").hide();
                                        $("#close_auto_cont").hide();
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
                    $("#close_auto_cont").click(function() {
                        btn_save_chang($('.load_select').val(), 'close')
                    });
                    $('.sw_btn_au').click(function(){
                        $(this).addClass('active')
                        var numb = $(this).attr('id');
                        $('.load_select').val(numb)
                        memu_auto_check(numb);
                        df_ed_text(numb);
                        $("#save_auto_cont").hide();
                    })
                    $("#save_auto_cont").hide();
                    $("#close_auto_cont").hide();
                }
            });
        }else {
            $.ajax({
                url: "routes/tu/get_control_mn.php",
                method: "post",
                data: {
                    house_master: house_master,
                    config_cn: config_cn
                },
                dataType: "json",
                success: function(res) {
                    console.log(res);
                    $("#Modal_control").modal('show', { backdrop: "static" })
                    $('.check_m').hide();
                    $('#save_manual_cont').hide();
                    $('#close_manual_cont').hide();
                    if(config_cn.cn_status_1 == 1 || config_cn.cn_status_2 == 1 || config_cn.cn_status_3 == 1 || config_cn.cn_status_4 == 1){
                        $('.manual_select').val(1);
                    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 || config_cn.cn_status_5 == 1 || config_cn.cn_status_6 == 1 || config_cn.cn_status_7 == 1 || config_cn.cn_status_8 == 1){
                        $('.manual_select').val(2)
                    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 || config_cn.cn_status_9 == 1 || config_cn.cn_status_10 == 1){
                        $('.manual_select').val(3)
                    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 || config_cn.cn_status_11 == 1){
                        $('.manual_select').val(4)
                    }else if(config_cn.cn_status_1 == 0 && config_cn.cn_status_2 == 0 && config_cn.cn_status_3 == 0 && config_cn.cn_status_4 == 0 && config_cn.cn_status_5 == 0 && config_cn.cn_status_6 == 0 && config_cn.cn_status_7 == 0 && config_cn.cn_status_8 == 0 && config_cn.cn_status_9 == 0 && config_cn.cn_status_10 == 0 && config_cn.cn_status_11 == 0 || config_cn.cn_status_12 == 1){
                        $('.manual_select').val(5)
                    }
                    memu_manuak_check($('.manual_select').val());
                    function memu_manuak_check(val){
                        for (var i = 1; i <= 5; i++) {
                            if(i == val){
                                // $('.text_load_mn').html(config_cn['cn_name_'+i]);
                                $("#s"+i).addClass('active');
                                if(i == 1){
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/dripper_on.png');
                                }else if (i == 2) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/fan_on.png');
                                }else if (i == 3) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/foggy_on.png');
                                }else if (i == 4) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/spray_on.png');
                                }else if (i == 5) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/shading_on.png');
                                }
                            }else {
                                $('#s'+i).removeClass('active')
                                if(i == 1){
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/dripper_off.png');
                                }else if (i == 2) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/fan_off.png');
                                }else if (i == 3) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/foggy_off.png');
                                }else if (i == 4) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/spray_off.png');
                                }else if (i == 5) {
                                    $('.cn_memu_img_mn_'+i).attr('src','public/images/icons/memu_control/shading_off.png');
                                }
                            }
                        }
                    }
                    $('.sw_btn_s').click(function(){
                        // $(this).addClass('active')
                        var numb = Number($(this).attr('id').substring(1));
                        $('.manual_select').val(numb)
                        memu_manuak_check(numb);
                    })
                    $('.btn_config').click(function(){
                        $(this).hide();
                        $('.check_m').show();
                        $('#save_manual_cont').show();
                        $('#close_manual_cont').show();
                        $('#manual_check').change(function(){
                            if($(this).prop('checked') === true){
                                $('.input_check2').bootstrapToggle('on')
                            }else {
                                $('.input_check2').bootstrapToggle('off')
                            }
                        });
                    });
                }
            });
        }
    })
</script>
