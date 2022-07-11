<?php
    require "../routes/connectdb.php";
    $user_id = $_SESSION['account_id'];
    // $query = $dbcon->query("SELECT * FROM tb2_login WHERE login_id = '$user_id' ")->fetch();
    $query = $dbcon->query("SELECT * FROM tbn_account WHERE account_id = '$user_id' ")->fetch();
    // print_r($query);
    // echo $query;
// echo array_count_values($controlstatus)['0'];
// exit();
?>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ตั้งค่า</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a></li>
                    <!-- <li class="breadcrumb-item" aria-current="page"></li> -->
                    <li class="breadcrumb-item title_ht" aria-current="page"></li>
                    <!-- <li class="breadcrumb-item" aria-current="page"> ข้อมูลผู้ใช้งาน </li> -->
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- <h6 class="mb-0 text-uppercase">Horizontal Card</h6> -->
    <hr/>
    <div class="row">
        <div class="col-12 col-lg-2 col-xl-2 d-flex">
            <div class="card w-100 radius-10">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-center pt_pt" data-bs-toggle="pill" href="#p-pt" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                                ข้อมูลผู้ใช้งาน
                            </a>
                        </li>
                        <?php //if($_SESSION['count_statusUser'] != 0){
                            echo '<li class="nav-item6" role="presentation">
                                <a class="nav-link text-center pt_st" data-bs-toggle="pill" href="#p-st" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    สถานที่
                                </a>
                            </li>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center pt_ht" data-bs-toggle="pill" href="#p-ht" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    โรงเรือน
                                </a>
                            </li>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center pt_ust" data-bs-toggle="pill" href="#p-ust" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    กำหนดสิทธิ์ผู้ใช้งาน
                                </a>
                            </li>';
                        //}?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-10 col-xl-10 d-flex">
            <div class="card w-100 radius-10">
                <div class="tab-content">
                    <div class="tab-pane fade" id="p-pt" role="tabpanel">
                        <div class="card radius-10 border shadow-none">
                            <div class="card-body p-5">
                                <div class="row g-3">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <?php if($query["account_img"] === ""){echo '<img src="public/images/users/user.png" class="rounded-circle p-1 bg-primary" width="110">';
                                        }else{ echo '<img src="public/images/users/'. $query["account_img"] .'" class="rounded-circle p-1 bg-primary" width="110">';} ?>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <label for="Username" class="form-label">ชื่อผู้ใช้งาน</label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                            <input type="text" class="form-control border-start-0" placeholder="ชื่อผู้ใช้งาน" value="<?= $query["account_user"] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="E-mail" class="form-label">อีเมลล์</label>
                                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mail-send"></i></span>
                                            <input type="email" class="form-control border-start-0" placeholder="อีเมลล์" value="<?= $query['account_email'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="Mobite" class="form-label">โทรศัพท์</label>
                                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mobile"></i></span>
                                            <input type="tel" class="form-control border-start-0" placeholder="โทรศัพท์" value="<?= $query['account_tel'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-info px-5 edit_p"><i class="fadeIn animated bx bx-message-square-edit"></i>แก้ไข</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal_profile" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">แก้ไขข้อมูลผู้ใช้งาน</h5>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" id="profile_from" enctype="multipart/form-data" onSubmit="return false;">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img class="rounded-circle p-1 bg-primary p_img" width="110">
                                    <div class="mt-3 input-group">
                                            <!-- <label class="input-group-text" for="inputGroupFile01"></label> -->
                                        <input type="file" class="form-control" name="p_img" id="p_img" onchange="Showimg_profile(this)">
                                        <input type="hidden" name="mode_insert" value="edit_profile">
                                        <input type="hidden" name="p_imgDF" value="<?= $query['account_img'] ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <label for="Username" class="form-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                        <input type="text" class="form-control border-start-0 p_name" name="p_name" placeholder="ชื่อผู้ใช้งาน">
                                        <div class="invalid-feedback bp_name"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="Password" class="form-label">รหัสผ่าน</label>
                                    <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="bx bxs-lock-open"></i></span>
                                        <input type="text" class="form-control border-start-0 p_pass" name="p_pass" placeholder="รหัสผ่าน">
                                        <input type="hidden" name="p_passDF" value="<?= $query['account_pass'] ?>">
                                        <input type="hidden" name="p_passDF2" value="<?= $query['account_pa'] ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="E-mail" class="form-label">อีเมลล์ <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mail-send"></i></span>
                                        <input type="email" class="form-control border-start-0 p_email" name="p_email" placeholder="อีเมลล์">
                                        <input type="hidden" name="p_emailDF" value="<?= $query['account_email'] ?>">
                                        <div class="invalid-feedback bp_email"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="Mobite" class="form-label">โทรศัพท์</label>
                                    <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mobile"></i></span>
                                        <input type="tel" class="form-control border-start-0 p_tel" name="p_tel" placeholder="โทรศัพท์">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success submit_p"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!--end row-->

</div>
<script>
    var pt = '<?= $_POST["pt"] ?>';
    alert(pt)
    $(".pt_st").click(function () {
        $.ajax({
            url: "views/setting_profile.php",
            method: "post",
            data: {
                // s_master: res.s_master,
                pt: 2
            },
            // dataType: "json",
            success: function(resp) {
                $("#pills-profile").html(resp);
            }
        });
    });
    $(".pt_ht").click(function () {
        $.ajax({
            url: "views/setting_profile.php",
            method: "post",
            data: {
                pt: 3
            },
            // dataType: "json",
            success: function(resp) {
                $("#pills-profile").html(resp);
            }
        });
    });

    $(".pt_ust").click(function () {
        $.ajax({
            url: "views/setting_profile.php",
            method: "post",
            data: {
                pt: 4
            },
            // dataType: "json",
            success: function(resp) {
                $("#pills-profile").html(resp);
            }
        });
    });
    if (pt == 1) {
        $(".title_ht").html("ข้อมูลผู้ใช้งาน");
        $(".pt_pt").addClass("active");
        $(".pt_st").removeClass("active");
        $(".pt_ht").removeClass("active");
        $(".pt_ust").removeClass("active");
        //
        $("#p-pt").addClass("show active");
        $("#p-st").removeClass("show active");
        $("#p-ht").removeClass("show active");
        $("#p-ust").removeClass("show active");
    }
    else if (pt == 2){
        $(".title_ht").html("สถานที่");
        $(".pt_pt").removeClass("active");
        $(".pt_st").addClass("active");
        $(".pt_ht").removeClass("active");
        $(".pt_ust").removeClass("active");
        //
        $("#p-pt").removeClass("show active");
        $("#p-st").addClass("show active");
        $("#p-ht").removeClass("show active");
        $("#p-ust").removeClass("show active");
    }
    else if (pt == 3){
        $(".title_ht").html("โรงเรือน");
        $(".pt_pt").removeClass("active");
        $(".pt_st").removeClass("active");
        $(".pt_ht").addClass("active");
        $(".pt_ust").removeClass("active");
        //
        $("#p-pt").removeClass("show active");
        $("#p-st").removeClass("show active");
        $("#p-ht").addClass("show active");
        $("#p-ust").removeClass("show active");
    }
    else if (pt == 4){
        $(".title_ht").html("กำหนดสิทธิ์ผู้ใช้งาน");
        $(".pt_pt").removeClass("active");
        $(".pt_st").removeClass("active");
        $(".pt_ht").removeClass("active");
        $(".pt_ust").addClass("active");
        //
        $("#p-pt").removeClass("show active");
        $("#p-st").removeClass("show active");
        $("#p-ht").removeClass("show active");
        $("#p-ust").addClass("show active");
        table_user();
    }
    function table_user(){
        var loading = verticalNoTitle();
        $("#user_access").load("views/load_tableUser.php?siteID="+$(".sel_main_site").val());
        loadingOut(loading);
    }
    $(".sel_main_site").change(function () {
        table_user();
    });
    $(".pt_ust").click(function () {
        table_user();
    });

    $(".edit_p").click(function () {
        $(".p_img").attr('src','public/images/users/<?= $_SESSION["account_img"] ?>');
        $("#p_img").val("");
        $(".p_name").val('<?= $query["account_user"] ?>');
        $(".p_pass").val("");
        $(".p_email").val('<?= $query['account_email'] ?>');
        $(".p_tel").val('<?= $query['account_tel'] ?>');
        $("#modal_profile").modal("show");
    });
    function Showimg_profile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.p_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".submit_p").click(function () {
        if($(".p_name").val() === ""){
            $(".p_name").addClass("is-invalid");
            $(".bp_name").html("กรถณาระบุชื่อผู้ใช้งาน");
            return false;
        }else{
            $(".p_name").removeClass("is-invalid");
        }
        if($(".p_email").val() === ""){
            $(".p_email").addClass("is-invalid");
            $(".bp_email").html("กรถณาระบุแีเมลล์");
            return false;
        }else{
            $(".p_email").removeClass("is-invalid");
        }
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#profile_from")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                loadingOut(loading);
                var parseJSON = $.parseJSON(res);
                // console.log(parseJSON.data)
                // return false
                if (parseJSON.status === "มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'มีรายชื่อนี้แล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".p_name").addClass("is-invalid");
                    $(".bp_name").html("กรถณาระบุชื่อผู้ใช้งานใหม่");
                    return false;
                }
                if (parseJSON.status === "รูปแบบ email ไม่ถูกต้อง") {
                    swal({
                        title: 'รูปแบบอีเมลล์ไม่ถูกต้อง !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".p_email").addClass("is-invalid");
                    $(".bp_email").html('กรถณาระบุแีเมลล์ใหม่');
                    return false;
                }
                if (parseJSON.status === "มี email นี้แล้ว") {
                    swal({
                        title: 'อีเมลล์นี้ถูกใช้งานแล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".p_email").addClass("is-invalid");
                    $(".bp_email").html('กรถณาระบุแีเมลล์ใหม่');
                    return false;
                }
                if (parseJSON.status === "สกุลไฟล์ไม่ถูกต้อง") {
                    swal({
                        title: 'รูปภาพไม่ถูกต้อง !',
                        text: "โปรดเลือกไฟล์สกุล gif, jpeg, jpg, png หรือ svg",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    return false;
                }
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
                    $(".user-img").attr("src", "public/images/users/" + parseJSON.data.image);
                    $(".user_name").html(parseJSON.data.user);
                    // $.ajax({
                    //     url: "views/setting_profile.php",
                    //     method: "post",
                    //     data: {
                    //         // s_master: res.s_master,
                    //         pt: 1
                    //     },
                    //     // dataType: "json",
                    //     success: function(resp) {
                    //         $("#load_pages_profile").html(resp);
                    //     }
                    // });
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_profile").modal("hide");
                }
            }
        });
    });
</script>

<script>
    // $('.s_internetO').daterangepicker({
    //     autoUpdateInput: false,
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     orientation: 'top right',
    //     timePicker: true,
    //     timePicker24Hour: true,
    //     minYear: 2016,
    //     // maxYear: parseInt(moment().format('YYYY'), 10),
    //     locale: {
    //         cancelLabel: 'Close'
    //     }
    // });
    // $('.s_internetO').on('apply.daterangepicker', function(ev, picker) {
    //     $(this).val(picker.startDate.format('YYYY/MM/DD'));
    // });
    $(".s_add").click(function() {
        $(".title_mSite").html("เพิ่มสถานที่");
        $('.s_img').attr("src", "public/images/default.jpg");
        $("#s_img").val("");
        $(".s_imgDF").val("");
        $(".mode_insert").val("add_site");
        $(".mode_siteID").val("");
        $(".s_name").removeClass("is-invalid").val("");
        $(".s_nameDF").val("");
        $(".s_address").removeClass("is-invalid").val("");
        $(".s_la").removeClass("is-invalid").val("");
        $(".s_long").removeClass("is-invalid").val("");
        $(".s_internet").val("");
        $(".s_internetO").val("");
        $("#modal_site").modal("show");
    });
    $(".edit_site").click(function(){
        $(".title_mSite").html("แก้สถานที่");
        var img = $(this).attr("img");
        // alert(img);
        if(img === ""){
        $('.s_img').attr("src", "public/images/default.jpg");
        }else{
        $('.s_img').attr("src", "public/images/site/"+img);
        }
        $(".s_imgDF").val(img);
        $("#s_img").val("");
        $(".mode_insert").val("edit_site");
        $(".mode_siteID").val($(this).attr("site_id"));
        $(".s_name").removeClass("is-invalid").val($(this).attr("name"));
        $(".s_nameDF").val($(this).attr("name"));
        $(".s_address").removeClass("is-invalid").val($(this).attr("adss"));
        $(".s_la").removeClass("is-invalid").val($(this).attr("la"));
        $(".s_long").removeClass("is-invalid").val($(this).attr("long"));
        $(".s_internet").val($(this).attr("inte"));
        $(".s_internetO").val($(this).attr("inteO"));
        $("#modal_site").modal("show");
    });
    $(".submit_s").click(function() {
        if($(".s_name").val() === ""){
            $(".s_name").addClass("is-invalid");
            $(".bs_name").html('กรุณาระบุชื่อสถานที่');
            return false;
        }else{
            $(".s_name").removeClass("is-invalid");
        }
        if($(".s_address").val() === ""){
            $(".s_address").addClass("is-invalid");
            return false;
        }else{
            $(".s_address").removeClass("is-invalid");
        }
        if($(".s_la").val() === ""){
            $(".s_la").addClass("is-invalid");
            return false;
        }else{
            $(".s_la").removeClass("is-invalid");
        }
        if($(".s_long").val() === ""){
            $(".s_long").addClass("is-invalid");
            return false;
        }else{
            $(".s_long").removeClass("is-invalid");
        }
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#site_form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                loadingOut(loading);
                var parseJSON = $.parseJSON(res);
                // console.log(parseJSON.data)
                // return false
                if (parseJSON.status === "มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'มีรายชื่อนี้แล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".s_name").addClass("is-invalid");
                    $(".bs_name").html('กรุณาระบุชื่อสถานที่ใหม่');
                    return false;
                }
                if (parseJSON.status === "สกุลไฟล์ไม่ถูกต้อง") {
                    swal({
                        title: 'รูปภาพไม่ถูกต้อง !',
                        text: "โปรดเลือกไฟล์สกุล gif, jpeg, jpg, png หรือ svg",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    return false;
                }
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
                    $.ajax({
                        url: "views/setting_profile.php",
                        method: "post",
                        data: {
                            pt: 2
                        },
                        success: function(resp) {
                            $("#pills-profile").html(resp);
                        }
                    });
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_site").modal("hide");
                }
            }
        });
    });
    $(".delete_site").click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบสถานที่ : "+$(this).attr("name")+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                var loading = verticalNoTitle();
                $.ajax({
                    url: 'routes/insert_setting.php',
                    type: 'POST',
                    data: {
                        site_id : $(this).attr("site_id"),
                        mode_insert : "delete_site",
                        img : $(this).attr("img")
                    },
                    dataType: 'json',
                    success: function(data) {
                        loadingOut(loading);
                        if (data.status == "Insert_Error") {
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
                            $.ajax({
                                url: "views/setting_profile.php",
                                method: "post",
                                data: {
                                    pt: 2
                                },
                                success: function(resp) {
                                    $("#pills-profile").html(resp);
                                }
                            });
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                            $("#modal_site").modal("hide");
                        }
                    }
                });
            }
        });
    });
    function Showimg_site(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.s_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // --------------------------
    $(".h_add").click(function() {
        $(".title_mHouse").html("เพิ่มโรงเรือน");
        $('.h_img').attr("src", "public/images/default.jpg");
        $("#h_imgDF").val("");
        $(".mode_insert").val("add_house");
        $(".mode_houseID").val("");
        $("#h_img").val("");
        $(".h_site").val("0");
        $(".h_name").removeClass("is-invalid").val("");
        $(".h_sn").removeClass("is-invalid").val("");
        $(".h_snDF").val("");
        $('.h_img_map').attr("src", "public/images/default.jpg");
        $(".h_img_mapDF").val("");
        $("#h_img_mapDF").val("");
        $("#modal_house").modal("show");
    });
    $(".h_edit").click(function() {
        $(".title_mHouse").html("แก้ไขโรงเรือน");
        var img = $(this).attr("img");
        if(img === ""){
        $('.h_img').attr("src", "public/images/default.jpg");
        }else{
        $('.h_img').attr("src", "public/images/house/"+img);
        }
        $(".h_imgDF").val(img);
        $(".mode_insert").val("edit_house");
        $(".mode_houseID").val($(this).attr("house_id"));
        $("#h_img").val("");
        $(".h_site").val($(this).attr("site_id"));
        $(".h_name").removeClass("is-invalid").val($(this).attr("name"));
        $(".h_sn").removeClass("is-invalid").val($(this).attr("sn"));
        $(".h_snDF").val($(this).attr("sn"));
        var img_map = $(this).attr("img_map");
        if(img_map === ""){
        $('.h_img_map').attr("src", "public/images/default.jpg");
        }else{
        $('.h_img_map').attr("src", "public/images/img_map/"+img_map);
        }
        $(".h_img_mapDF").val(img_map);
        $("#h_img_mapDF").val("");
        $("#modal_house").modal("show");
    });
    $(".submit_h").click(function() {
        if($(".h_site").val() === "0"){
            $(".h_site").addClass("is-invalid");
            return false;
        }else{
            $(".h_site").removeClass("is-invalid");
        }
        if($(".h_name").val() === ""){
            $(".h_name").addClass("is-invalid");
            return false;
        }else{
            $(".h_name").removeClass("is-invalid");
        }
        if($(".h_sn").val() === ""){
            $(".h_sn").addClass("is-invalid");
            $(".bh_sn").html('กรุณาระบุหมายเลขซีเรียล');
            return false;
        }else{
            $(".h_sn").removeClass("is-invalid");
        }
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/insert_setting.php",
            data: new FormData($("#house_form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                var parseJSON = $.parseJSON(res);
                // console.log(parseJSON.status)
                // return false
                if (parseJSON.status === "มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'มีหมายเลขซีเรียลนี้แล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".h_sn").addClass("is-invalid");
                    $(".bh_sn").html('กรุณาระบุหมายเลขซีเรียลใหม่');
                    return false;
                }
                if (parseJSON.status === "สกุลไฟล์ไม่ถูกต้อง") {
                    if(parseJSON.img === "img1"){
                        var e_img = "โรงเรือน";
                    }else{
                        var e_img = "จุดติดตั้งเซ็นเซอร์ทั้งหมด";
                    }
                    swal({
                        title: 'รูปภาพไม่ถูกต้อง !',
                        text: e_img+" : โปรดเลือกไฟล์สกุล gif, jpeg, jpg, png หรือ svg",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    return false;
                }
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
                    $.ajax({
                        url: "views/setting_profile.php",
                        method: "post",
                        data: {
                            pt: 3
                        },
                        success: function(resp) {
                            $("#pills-profile").html(resp);
                        }
                    });
                    // --------------------------------------
                    var house_master = $(".h_sn").val();
                    // Global variables
                    var client = null;
                    // These are configs
                    var hostname = "203.150.37.144"; //'103.2.115.15'; // 203.150.37.144   decccloud.com
                    var port = "8083";
                    var clientId = "mqtt_js_" + parseInt(Math.random() * 100000, 10);
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
                        client.subscribe("KO7MT001/1/control/mode", options);
                    }
                    function onFail(context) {
                        location.reload();
                    }
                    function onConnectionLost(responseObject) {
                        if (responseObject.errorCode !== 0) {
                            console.log("Connection Lost: " + responseObject.errorMessage);
                            // location.reload();
                            // window.alert("Someone else took my websocket!\nRefresh to take it back.");
                        }
                    }

                    function onMessageArrived(message) {
                        message = new Paho.MQTT.Message("Manual");
                        message.destinationName = house_master + "/1/control/mode";
                        message.retained = true;
                        message.qos = 1;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_1";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_2";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_3";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_4";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_5";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_6";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_7";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/dripper_8";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/foggy";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/fan";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("0");
                        message.destinationName = house_master + "/1/control/shader";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("OFF");
                        message.destinationName = house_master + "/1/control/fertilizer";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        message = new Paho.MQTT.Message("Default");
                        message.destinationName = house_master + "/1/control/user_control";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        var jsonstring = {
                            "control_status":{
                                "Mode":"Manual",
                                "fertilizer":"OFF",
                                "dripper_1":"OFF",
                                "dripper_2":"OFF",
                                "dripper_3":"OFF",
                                "dripper_4":"OFF",
                                "dripper_5":"OFF",
                                "dripper_6":"OFF",
                                "dripper_7":"OFF",
                                "dripper_8":"OFF",
                                "foggy":"OFF",
                                "fan":"OFF",
                                "shader":"0",
                                "user_control":"Default"
                            },
                            "control_serial":house_master
                        };
                        message = new Paho.MQTT.Message(JSON.stringify(jsonstring));
                        message.destinationName = house_master + "/1/control/time_control";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);

                        var jsonstring2 = {
                            "dripper_1":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_2":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_3":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_4":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_5":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_6":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_7":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"dripper_8":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"foggy":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"fan":{
                                "S_1":"99:99",
                                "E_1":"99:99",
                                "S_2":"99:99",
                                "E_2":"99:99",
                                "S_3":"99:99",
                                "E_3":"99:99",
                                "S_4":"99:99",
                                "E_4":"99:99",
                                "S_5":"99:99",
                                "E_5":"99:99",
                                "S_6":"99:99",
                                "E_6":"99:99"
                            },"shader":{
                                "S_1":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_2":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_3":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_4":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_5":{
                                    "T":"99:99",
                                    "L":"0"
                                },"S_6":{
                                    "T":"99:99",
                                    "L":"0"
                                }
                            }
                        };
                        message = new Paho.MQTT.Message(JSON.stringify(jsonstring2));
                        message.destinationName = house_master + "/1/control/json_control_filter";
                        message.qos = 1;
                        message.retained = true;
                        client.send(message);
                    }
                    connect();
                    // --------------------------------------
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_house").modal("hide");
                }
                loadingOut(loading);
            }
        });
    });
    $(".delete_house").click(function(){
        swal({
            title: 'Delete !',
            text: "คุณต้องการที่จะลบโรงเรือน : "+$(this).attr("name")+" หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ไช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                var loading = verticalNoTitle();
                $.ajax({
                    url: 'routes/insert_setting.php',
                    type: 'POST',
                    data: {
                        house_id : $(this).attr("house_id"),
                        sn : $(this).attr("sn"),
                        mode_insert : "delete_house",
                        img : $(this).attr("img"),
                        img_map : $(this).attr("img_map")
                    },
                    dataType: 'json',
                    success: function(data) {
                        loadingOut(loading);
                        if (data.status == "Insert_Error") {
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
                            $.ajax({
                                url: "views/setting_profile.php",
                                method: "post",
                                data: {
                                    pt: 3
                                },
                                success: function(resp) {
                                    $("#pills-profile").html(resp);
                                }
                            });
                            swal({
                                title: 'ลบข้อมูลสำเร็จ.',
                                // text: "" + sw_name + " ?",
                                type: 'success',
                                allowOutsideClick: false,
                                confirmButtonColor: '#32CD32'
                            });
                            $("#modal_house").modal("hide");
                        }
                    }
                });
            }
        });
    });
    function Showimg_house(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.h_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function Showimg_house_map(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.h_img_map').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#table1').DataTable( {
        "scrollY": 400,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "order": [
            [0, "desc"]
        ]
    });
    $('#table2').DataTable( {
        "scrollY": 400,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "order": [
            [0, "desc"]
        ]
    });
</script>
