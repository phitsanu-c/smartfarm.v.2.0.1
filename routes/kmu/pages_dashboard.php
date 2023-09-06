
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
<!-- <link href="dist/plugin/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
<link href="dist/plugin/ion-rangeslider/css/ion.rangeSlider.skinModern.css" rel="stylesheet"> -->
    <?php
        $config = $_POST['data'];
        $account_user = $config["account_user"];
        // print_r($config);
        // exit();
        $s_master = $config["s_master"];
        $config_sn = $config['config_sn'];
        $config_cn = $config['config_cn'];
        // $set_maxmin = $config['set_maxmin'];
        // $sensor = $config['sensor'];

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
    <div class="page-breadcrumb d-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3 d-none d-sm-block"> <h5><?= $s_master['site_name'] ?></h5> </div>
        <div class="ps-3 d-none d-sm-block">
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
            <div class="btn-group">
                <span class="text-right">
                    <h5 class="date"></h5>
                    <!-- <span class="time"></span> -->
                </span>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- <h5 class="mb-0 text-uppercase">Horizontal Card</h5> -->
    <hr />
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-4 col-sm-12 d-flex">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="card radius-10 shadow-none ">
                        <img src="public/images/site/<?= $house_img ?>" alt="..." class="card-img ">
                    </div>
                    <div class="card radius-10 shadow-none">
                        <div class="card-body border radius-10 shadow-none mb-3">
                            <div class="col-12">
                                <div class="d-flex">
                                    <h5 class="text-responsive2">สถานที่ : <b>
                                            <?= $s_master["site_name"] ?>
                                        </b></h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <h5 class="text-responsive2">โรงเรือน : <b>
                                            <?= $s_master["house_name"] ?>
                                        </b></h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <h5 class="text-responsive2">ที่ตั้ง : <b>
                                            <?= $s_master["site_address"] ?>
                                        </b></h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <h5 class="text-responsive2">สถานะโรงเรือน : <b class="status_timeUpdate"></b></h5>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                \<div class="d-flex">
                                    <h5 class="text-responsive2">ขนาดโรงเรือน : <b><?// substr($s_master["house_size"],9,13) ?></b> เมตร</h5>
                                </div>
                            </div>
                            <?php if($config['userLevel'] < 3){?>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <h5 class="text-responsive2">ระบบอินเตอร์เน็ต : <b>Internet SIM</b></h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <h5 class="text-responsive2">หมายเลขอินเตอร์เน็ต : <b><?// $s_master["site_internet"] ?></b></h5>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex">
                                        <h5 class="text-responsive2">วันหมดอายุ : <b><?// $s_master["site_internetO"] ?></b></h5>
                                    </div>
                                </div>
                            <?php } ?> -->
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
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="text-center text-responsive2">ข้อมูลเซนเซอร์นอกโรงเรือน</h5>
                            <div class="row text-center">
                                <?php for($i = 1; $i <= 3; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                        <div class="col-lg-4 col-xl-4 col-sm-12">
                                            <div class="card-body border radius-10 shadow-none mb-3">
                                                <div class="col">
                                                    <h5 class="card-title text-responsive2 mt-2 "><B>
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
                                                <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle sensor-responsive" style=" margin-top:10px; text-align: center!important;"  width="50%">
                                                <h5 class="card-text text-center dash_data__<?= $i ?> text-responsive" style="margin-top:20px;">
                                                </h5>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card radius-10 border shadow-none">
                        <div class="card-body">
                            <h5 class="text-center text-responsive2">ข้อมูลเซนเซอร์ในโรงเรือน</h5>
                            <div class="row text-center">
                                <?php for($i = 4; $i <= 6; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                        <div class="col-lg-4 col-xl-4 col-sm-12">
                                            <div class="card-body border radius-10 shadow-none mb-3">
                                                <div class="col">
                                                    <h5 class="card-title text-responsive2 mt-2 "><B>
                                                            <?php //$config_sn['sn_name_'.$i]
                                                                if($i == 4){echo "อุณหภูมิ";}elseif($i == 5){ echo "ความชื้น"; }elseif($i == 6){ echo "ความเข้มแสง"; }
                                                            ?>
                                                        </B></h5>
                                                    <div class="ms-auto mt-2 image-popups">
                                                        <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                                echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker "></i></a>';
                                                            }?>
                                                    </div>
                                                </div>
                                                <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle sensor-responsive" style=" margin-top:10px; text-align: center!important;"  width="50%">
                                                <h5 class="card-text text-center dash_data__<?= $i ?> text-responsive" style="margin-top:20px;">
                                                </h5>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                                <?php for($i = 7; $i <= 8; $i++){
                                    if($config_sn['sn_status_'.$i] == 1){ ?>
                                        <div class="col-lg-6 col-xl-6 col-sm-12">
                                            <div class="card-body border radius-10 shadow-none mb-3">
                                                <div class="col">
                                                    <h5 class="card-title text-responsive2 mt-2 "><B>ความชื้นดิน <?= $i-6 ?></B></h5>
                                                    <div class="ms-auto mt-2 image-popups">
                                                        <?php if($config_sn["sn_imgMap_".$i] != ""){
                                                                echo '<a href="public/images/img_map/'.$config_sn["sn_imgMap_".$i].'"><i class="lni lni-map-marker "></i></a>';
                                                            }?>
                                                    </div>
                                                </div>
                                                <img src="" alt="..." class="dash_img_<?= $i ?> rounded-circle sensor-responsive" style=" margin-top:10px; text-align: center!important;"  width="30%">
                                                <h5 class="card-text text-center dash_data__<?= $i ?> text-responsive" style="margin-top:20px;">
                                                </h5>
                                            </div>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="col-12 col-lg-12 col-xl-12 col-sm-12 d-flex">
        <div class="card w-100 radius-10">
            <div class="card-body">
                <div class="card-body text-center">
                    <h5 class="card-title text-responsive2 text-center"><b>สถานะการทำงาน </b></h5>
                    <button type="button" class="btn btn-outline-success text-responsive2 px-5 radius-30 dash_mode active"></button>
                </div>
                <div class="row">
                    <?php for($i = 1; $i <= 5; $i++){
                        // if($config_cn['cn_status_'.$i] == 1){ ?>
                        <div class="col-lg-3 col-xl-3 col-sm-12">
                            <div class="card-body border radius-10 shadow-none mb-3">
                                <div class="text-center text-responsive2">
                                    <div class="d-flex"><b>
                                        <?php
                                            if($i <= 2){echo 'น้ำหยด '.$i;}
                                            // elseif($i > 2 && $i <= 4){echo 'พัดลม '.($i-4);}
                                            elseif($i == 3){echo 'พ่นหมอกในโรงเรือน';}
                                            elseif($i == 4){echo 'สปริสปริงเกอร์หลังคา';}
                                            elseif($i == 5){echo 'ม่านพรางแสง';}
                                        ?></b>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" class="ico-chart memu_control" style="color: rgb(141, 151, 173);"><i class="bx bx-cog"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img class="dash_img_con_<?= $i ?>" style="width:15vh">
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
                    </div>
				</div>
				<div class="modal-body">
                    <div class="container ul_Auto">
                        <div class="container col-12 mt-3 ridge">
                            <div class="row">
                                <div class="d-flex align-items-center" style="background-color: #283A6C; height: 50px; text-align: justify;">
                                    <a><b class="" style="color:#FFF; font-size:20px"> ตั้งค่าโหมดอัตโนมัติ</b></a>
                                    <div class="ms-auto">
                                        <a class="menu_config_auto btn btn-sm btn-primary px-2 radius-30" style="color:#FFF; font-size:16px" href="javascript:void(0)"><b> <i class='bx bx-cog'></i> ตั้งค่า</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container col-12 ridge">
                            <form class="row g-3" id="seve_auto_kmutt">
                                <!-- <div class="tab-pane show active ridge" role="tabpanel"> -->
                                    <div class="row">
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>ความชื้นดิน (%)</h5>
                                                <h6>เปิด - ปิด น้ำหยด 1</h6>
                                                <input type="text" class="range_control range_control1"/>
                                            </div>
                                        </div>
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>ความชื้นดิน (%)</h5>
                                                <h6>เปิด - ปิด น้ำหยด 2</h6>
                                                <input type="text" class="range_control range_control2"/>
                                            </div>
                                        </div>
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>อุณหภูมิ (℃)</h5>
                                                <h6>เปิด - ปิด พ่นหมอกในโรงเรือน และ สปริสปริงเกอร์หลังคา</h6>
                                                <input type="text" class="range_control range_control3"/>
                                            </div>
                                        </div>
                                        <div class="container col-md-12">
                                            <div class="text-center"><br>
                                                <h5>คว่มเข้าแสง (KLux)</h5>
                                                <h6>เปิด - ปิด ม่านพรางแสง</h6>
                                                <input type="text" class="range_control range_control5" />
                                            </div>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="container ul_Manual ridge">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body border radius-10 shadow-none mb-3 mt-3">
                                    <h5 class="text-center ">น้ำหยด 1</h5>
                                    <div class="text-center row">
                                        <div class="col text-end  me-2 mb-3 mt-2">
                                             <button class="btn sw_manual_on_1"></button>
                                        </div>
                                        <div class="col text-start ms-2 mb-3 mt-2">
                                             <button class="btn sw_manual_off_1"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body border radius-10 shadow-none mb-3 mt-3">
                                    <h5 class="text-center ">น้ำหยด 2</h5>
                                    <div class="text-center row">
                                        <div class="col text-end  me-2 mb-3 mt-2">
                                             <button class="btn sw_manual_on_2"></button>
                                        </div>
                                        <div class="col text-start ms-2 mb-3 mt-2">
                                             <button class="btn sw_manual_off_2"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body border radius-10 shadow-none mb-3">
                                    <h5 class="text-center ">พ่นหมอกในโรงเรือน</h5>
                                    <div class="text-center row">
                                        <div class="col text-end  me-2 mb-3 mt-2">
                                             <button class="btn sw_manual_on_3"></button>
                                        </div>
                                        <div class="col text-start ms-2 mb-3 mt-2">
                                             <button class="btn sw_manual_off_3"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body border radius-10 shadow-none mb-3">
                                    <h5 class="text-center ">สปริสปริงเกอร์หลังคา</h5>
                                    <div class="text-center row">
                                        <div class="col text-end  me-2 mb-3 mt-2">
                                             <button class="btn sw_manual_on_4"></button>
                                        </div>
                                        <div class="col text-start ms-2 mb-3 mt-2">
                                             <button class="btn sw_manual_off_4"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body border radius-10 shadow-none mb-3">
                                    <h5 class="text-center ">ม่านพรางแสง</h5>
                                    <div class="text-center row">
                                        <div class="col text-end  me-2 mb-3 mt-2">
                                             <button class="btn sw_manual_on_5"></button>
                                        </div>
                                        <div class="col text-start ms-2 mb-3 mt-2">
                                             <button class="btn sw_manual_off_5"></button>
                                        </div>
                                    </div>
                                </div>
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
				</div>
			</div>
		</div>
    </div>
    <!-- exit Modal Control -->

<!-- <script src="dist/plugin/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="dist/plugin/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider-init.js"></script> -->

<script>
    // var house_master = '<?// $s_master["house_master"] ?>';
    var user = '<?= $account_user ?>';
    // alert(user)
    $('.memu_control').click(function () {
        $(".memu_dash").show().addClass("mm-active");
        $(this).removeClass("mm-active");
        $('.menu_config_auto').show();
        $('#save_auto_cont').hide();
        $('#close_auto_cont').hide();
        $("#Modal_control").modal('show')
        $.ajax({
            url: "routes/get_auto_control.php",
            method: "post",
            data: {
                house_master: house_master
            },
            dataType: "json",
            success: function(res) {
                // console.log(res);
                kmutt_auto_mode(
                    min1 = res.maxmin_min_1, min2 = res.maxmin_min_2, min3 = res.maxmin_min_3, min5 = res.maxmin_min_5,
                    max1 = res.maxmin_max_1, max2 = res.maxmin_max_2, max3 = res.maxmin_max_3, max5 = res.maxmin_max_5,
                    disb = true
                );
                $('.menu_config_auto').click(function(){
                    $(this).hide();
                    $('#save_auto_cont').show();
                    $('#close_auto_cont').show();
                    kmutt_auto_mode(
                        min1 = res.maxmin_min_1, min2 = res.maxmin_min_2, min3 = res.maxmin_min_3, min5 = res.maxmin_min_5,
                        max1 = res.maxmin_max_1, max2 = res.maxmin_max_2, max3 = res.maxmin_max_3, max5 = res.maxmin_max_5,
                        disb = false
                    );
                });
                $('#save_auto_cont').click(function(){
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
                                url: "routes/kmu/save_autoControl.php",
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
                                    if (res[0] === "Success") {

                                        swal({
                                            title: 'บันทึกข้อมูลสำเร็จ',
                                            type: 'success',
                                            allowOutsideClick: false,
                                            confirmButtonColor: '#32CD32'
                                        });
                                        $('.menu_config_auto').show();
                                        $('#save_auto_cont').hide();
                                        $('#close_auto_cont').hide();
                                        kmutt_auto_mode(
                                            min1 = res.min1, min2 = res.min_2, min3 = res.min_3, min5 = res.min_5,
                                            max1 = res.max1, max2 = res.max_2, max3 = res.max_3, max5 = res.max_5,
                                            disb = true
                                        );
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
                });
            }
        })
        function kmutt_auto_mode(min1, min2, min3, min5, max1, max2, max3, max5, disb) {
            var $range1 = $(".range_control1"),
                range_instance1;
            $range1.ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: min1,
                to: max1,
                grid: true,
                // disable: true
                // onChange: function(data) {
                //     console.log(data);
                // },
            });
            range_instance1 = $range1.data("ionRangeSlider");
            range_instance1.update({
                from: min1,
                to: max1,
                "disable": disb
            });

            var $range2 = $(".range_control2"),
                range_instance2;
            $range2.ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: min2,
                to: max2,
                grid: true,
                // disable: true
            });
            range_instance2 = $range2.data("ionRangeSlider");
            range_instance2.update({
                from: min2,
                to: max2,
                "disable": disb
            });

            var $range3 = $(".range_control3"),
                range_instance3;
            $range3.ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: min3,
                to: max3,
                grid: true,
                // disable: true
            });
            range_instance3 = $range3.data("ionRangeSlider");
            range_instance3.update({
                from: min3,
                to: max3,
                "disable": disb
            });

            var $range5 = $(".range_control5"),
                range_instance5;
            $range5.ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: min5,
                to: max5,
                grid: true,
                // disable: true
            });
            range_instance5 = $range5.data("ionRangeSlider");
            range_instance5.update({
                from: min5,
                to: max5,
                "disable": disb
            });
        }
    });
    $('.sw_mode_Auto').click(function () { // console.log($(this).attr("id"));
        // alert($(this).attr("id"))
        if ($(this).hasClass("active") === false) {
            switch_mode('mode', "อัตโนมัติ", "on", house_master + "/1/control/mode");
        }
    });
    $('.sw_mode_Manual').click(function () { // console.log($(this).attr("id"));
        if ($(this).hasClass("btn-success") === false) {
            switch_mode('mode', "กำหนดเอง", "off", house_master + "/1/control/mode");
        }
    });
    $('.sw_manual_on_1').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "น้ำหยด 1", "on", house_master + "/1/control/control_st_1", 'เปิด');
        }
    });
    $('.sw_manual_off_1').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "น้ำหยด 1", "off", house_master + "/1/control/control_st_1", 'ปิด');
        }
    });
    $('.sw_manual_on_2').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "น้ำหยด 2", "on", house_master + "/1/control/control_st_2", 'เปิด');
        }
    });
    $('.sw_manual_off_2').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "น้ำหยด 2", "off", house_master + "/1/control/control_st_2", 'ปิด');
        }
    });
    $('.sw_manual_on_3').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "พ่นหมอกในโรงเรือน", "on", house_master + "/1/control/control_st_3", 'เปิด');
        }
    });
    $('.sw_manual_off_3').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "พ่นหมอกในโรงเรือน", "off", house_master + "/1/control/control_st_3", 'ปิด');
        }
    });
    $('.sw_manual_on_4').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "สปริสปริงเกอร์หลังคา", "on", house_master + "/1/control/control_st_4", 'เปิด');
        }
    });
    $('.sw_manual_off_4').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "สปริสปริงเกอร์หลังคา", "off", house_master + "/1/control/control_st_4", 'ปิด');
        }
    });
    $('.sw_manual_on_5').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "ม่านพรางแสง", "on", house_master + "/1/control/control_st_5", 'เปิด');
        }
    });
    $('.sw_manual_off_5').click(function(){
        if ($(this).hasClass("active") === false) {
            switch_mode('load', "ม่านพรางแสง", "off", house_master + "/1/control/control_st_5", 'ปิด');
        }
    });
    function switch_mode(mode, sw_name, mess, topic, status) {
        if(mode === 'mode'){
            swal({
                title: 'เปลี่ยนโหมดการทำงาน !',
                text: "คุณต้องการเปลี่ยนเป็นไปใช้โหมด "+sw_name + " ?",
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
                        url: 'routes/kmu/send_mqtt_load.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            topic: topic,
                            topic2: house_master +'/1/control/control_user',
                            user: user,
                            mess: mess
                        },
                        success: function(ress) {
                            if (ress === "succress") {

                            }
                        }
                    });
                }
            });
        }else {
            swal({
                title: 'คุณต้องการ ' + status + ' ' + sw_name + ' ?',
                // text: "คุณต้องการเปลี่ยนไปใช้โหมด Manual !!!",
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
                        url: 'routes/kmu/send_mqtt_load.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            topic: topic,
                            topic2: house_master +'/1/control/control_user',
                            user: user,
                            mess: mess
                        },
                        success: function(ress) {
                            if (ress === "succress") {

                            }
                        }
                    });
                }
            });
        }
    }
</script>
