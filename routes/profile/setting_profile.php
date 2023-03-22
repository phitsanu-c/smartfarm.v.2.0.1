<?php require '../connectdb.php'; $user_id = $_SESSION['account_id']; ?>
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
                            <a class="nav-link text-center <?php if($_POST['pt'] == 1){echo 'active';} ?>" data-bs-toggle="pill" href="#p-pt" role="tab" aria-selected="true" style="border: 1px solid transparent; border-color: #6c757d;">
                                ข้อมูลผู้ใช้งาน
                            </a>
                        </li>
                        <?php if ($_SESSION["sn"]['account_status'] < 3) {?>
                            <!-- <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center <?php// if($_POST['pt'] == 2){echo 'active';} ?>" data-bs-toggle="pill" href="#p-st" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    สถานที่
                                </a>
                            </li>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center <?php// if($_POST['pt'] == 3){echo 'active';} ?>" data-bs-toggle="pill" href="#p-ht" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    โรงเรือน
                                </a>
                            </li> -->
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center <?php if($_POST['pt'] == 4){echo 'active';} ?>" data-bs-toggle="pill" href="#p-ust" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    กำหนดสิทธิ์ผู้ใช้งาน
                                </a>
                            </li>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center <?php if($_POST['pt'] == 5){echo 'active';} ?> c_pt" data-bs-toggle="pill" href="#p-sst" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    ประวัติการเข้าสู่ระบบ
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION["sn"]['account_status'] == 1) {?>
                            <li class="nav-item6" role="presentation">
                                <a class="nav-link text-center" data-bs-toggle="pill" href="#p-ct" role="tab" aria-selected="false" style="border: 1px solid transparent; border-color: #6c757d;">
                                    ตั้งค่าหน้า Dashboard และสมการ
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-10 col-xl-10">
            <div class="card radius-10 border shadow-none">
                <div class="card-body tab-content">
                    <div class="tab-pane fade <?php if($_POST['pt'] == 1){echo "show active";} ?>" id="p-pt" role="tabpanel">
                        <div class="row g-3 p-5">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img class="rounded-circle p-1 bg-primary pt_img2" src="public/images/users/<?= $_SESSION["account_img"] ?>" width="110">
                                <input type="hidden" class="pt_img" value="<?= $_SESSION["account_img"] ?>">
                            </div>
                            <hr>
                            <div class="col-12">
                                <label for="Username" class="form-label">ชื่อผู้ใช้งาน</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-transparent"><i class="bx bxs-user"></i></span>
                                    <input type="text" class="form-control pt_name" placeholder="ชื่อผู้ใช้งาน" value="<?= $_SESSION["account_user"] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="E-mail" class="form-label">อีเมล</label>
                                <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mail-send"></i></span>
                                    <input type="email" class="form-control pt_email" placeholder="อีเมล" value="<?= $_SESSION["account_email"] ?>" disabled>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="Mobite" class="form-label">โทรศัพท์</label>
                                <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mobile"></i></span>
                                    <input type="tel" class="form-control pt_tel" placeholder="โทรศัพท์" value="<?= $_SESSION["account_tel"] ?>" disabled>
                                </div>
                            </div>
                            <?php if($_SESSION["account_user"] != 'KMUTT'){ ?>
                                <div class="col-12">
                                    <label for="Mobite" class="form-label">Token Line</label>
                                    <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><img src="public/images/icons/icons8-line.svg" style="width: 23px;"></span>
                                        <input type="text" class="form-control pt_token" placeholder="Token Line" value="<?= $_SESSION["account_token"] ?>" disabled>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="ms-auto">
                                        <label for="Mobite" class="form-control"><a href="line_token.html" target="_blank"> <-- วิธีสร้าง Token Line Notify --> </a></label>
                                    </div>
                                </div>
                            <<?php } ?>
                            <!-- <div class="col-12"> -->
                                <!-- <label for="Mobite" class="form-label">สถานะผู้ใช้งาน</label> -->
                                <!-- <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-transparent"><i class="bx bx-menu"></i></span> -->
                                    <!-- <input type="tel" class="form-control border-start-0" placeholder="โทรศัพท์" value="<?// $query['login_tel'] ?>" disabled> -->
                                    <!-- <select class="form-control border-start-0" value="<?// $query['login_status'] ?>" disabled >
                                        <option value="1">Supper Admin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">User</option>
                                        <option value="4">Viwer</option>
                                    </select>
                                </div> -->
                            <!-- </div> -->
                            <div class="text-center">
                                <button type="button" class="btn btn-info px-5 edit_p"><i class="fadeIn animated bx bx-message-square-edit"></i>แก้ไข</button>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION["sn"]['account_status'] < 3) {?>
                        <div class="tab-pane fade <?php if($_POST['pt'] == 2){echo "show active";} ?>" id="p-st" role="tabpanel">
                            <?php if ($_SESSION["sn"]['account_status'] == 1) {?>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-outline-success me-1 s_add mb-3"><i class="bi bi-plus-square"></i> เพิ่มสถานที่</button>
                                </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table id="table1" class="table table-striped table-bordered dataTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Images</th>
                                            <th class="text-center">ชื่อสถานที่</th>
                                            <th class="text-center">ที่อยู่</th>
                                            <th class="text-center">ละติจูด</th>
                                            <th class="text-center">ลองจิจูด</th>
                                            <th class="text-center">อินเตอร์เน็ต</th>
                                            <th class="text-center">วันอินเตอร์เน็ตหมด</th>
                                            <th class="text-center">ผู้บันทึกล่าสุด</th>
                                            <th class="text-center">วัน-เวลาอัพเดท</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION["sn"]['account_status'] == 1) {
                                            $stmt = $dbcon->prepare("SELECT * FROM tbn_site INNER JOIN tbn_account ON tbn_site.site_userST_id = tbn_account.account_id ");
                                        } else {
                                            $stmt = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_site ON tbn_userst.userST_siteID = tbn_site.site_id INNER JOIN tbn_account ON tbn_site.site_userST_id = tbn_account.account_id WHERE userST_accountID = '$user_id' GROUP BY tbn_userst.userST_siteID ");
                                        }
                                        $stmt->execute();
                                        $count = $stmt->rowCount();

                                        // if($count != 0){
                                        $inc = 1;
                                        $data0 = array();
                                        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                                            echo '<tr>
                                                        <td class="text-center">' . $inc . '</td>';
                                            if ($row["site_img"] == "") {
                                                echo '<td class="text-center"><img src="public/images/default.jpg" width="50"  height="50" alt="..."></td>';
                                            } else {
                                                echo '<td class="text-center"><img src="public/images/site/' . $row["site_img"] . '" width="50"  height="50" alt="..."></td>';
                                            }
                                            echo '  <td class="text-center">' . $row["site_name"] . '</td>
                                                        <td class="text-center">' . $row["site_address"] . '</td>
                                                        <td class="text-center">' . $row["site_Latitude"] . '</td>
                                                        <td class="text-center">' . $row["site_Longitude"] . '</td>
                                                        <td class="text-center">' . $row["site_internet"] . '</td>
                                                        <td class="text-center">' . $row["site_internetO"] . '</td>
                                                        <td class="text-center">' . $row["account_user"] . '</td>
                                                        <td class="text-center">' . $row["site_timestamp"] . '</td>
                                                        <td  class="text-center">
                                                            <div class="buttons">
                                                                <a href="javascript:void(0)" class="text-info edit_site"
                                                                    site_id="' . $row["site_id"] . '"
                                                                    img="' . $row["site_img"] . '"
                                                                    name="' . $row["site_name"] . '"
                                                                    adss="' . $row["site_address"] . '"
                                                                    la="' . $row["site_Latitude"] . '"
                                                                    long="' . $row["site_Longitude"] . '"
                                                                    inte="' . $row["site_internet"] . '"
                                                                    inteO="' . $row["site_internetO"] . '">
                                                                    <i class="fadeIn animated bx bx-message-square-edit"></i>
                                                                </a>';
                                                            if($_SESSION["sn"]['account_status'] == 1){
                                                                echo '<a href="javascript:void(0)" class="text-danger delete_site"
                                                                    site_id="' . $row["site_id"] . '"
                                                                    name="' . $row["site_name"] . '"
                                                                    img="' . $row["site_img"] . '">
                                                                    <i class="fadeIn animated bx bx-trash"></i>
                                                                </a>';
                                                            }else{echo '<a class="text-secondary" onclick="return false;"><i class="fadeIn animated bx bx-trash"></i></a>';}
                                                            echo '</div>
                                                        </td>
                                                    </tr>';
                                            $inc++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if($_POST['pt'] == 3){echo "show active";} ?>" id="p-ht" role="tabpanel">
                            <?php if ($_SESSION["sn"]['account_status'] == 1) {?>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-outline-success me-1 h_add mb-3"><i class="bi bi-plus-square"></i> เพิ่มโรงเรือน</button>
                                </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table id="table2" class="table table-striped table-bordered dataTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">สถานที่</th>
                                            <th class="text-center">ชื่อโรงเรือน</th>
                                            <th class="text-center">หมายเลขซีเรียล</th>
                                            <th class="text-center">โรงเรือน</th>
                                            <!-- <th class="text-center">จุดติดตั้งเซ็นเซอร์ทั้งหมด</th> -->
                                            <th class="text-center">ผู้บันทึกล่าสุด</th>
                                            <th class="text-center">วัน-เวลาอัพเดท</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_SESSION["sn"]['account_status'] == 1) {
                                            $stmt = $dbcon->prepare("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id INNER JOIN tbn_account ON tbn_house.house_userST_id = tbn_account.account_id ORDER BY house_siteID");
                                        } else {
                                            $stmt = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_site ON tbn_userst.userST_siteID = tbn_site.site_id INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id INNER JOIN tbn_account ON tbn_site.site_userST_id = tbn_account.account_id WHERE userST_accountID = '$user_id'  ORDER BY tbn_userst.userST_siteID");
                                        }
                                        $stmt->execute();
                                        $count = $stmt->rowCount();

                                        // if($count != 0){
                                        $inc = 1;
                                        $data0 = array();
                                        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                                            echo '<tr>
                                                        <td class="text-center">' . $inc . '</td>
                                                        <td class="text-center">' . $row["site_name"] . '</td>
                                                        <td class="text-center">' . $row["house_name"] . '</td>
                                                        <td class="text-center">' . $row["house_master"] . '</td>';
                                            if ($row["house_img"] == "") {
                                                echo '<td class="text-center"><img src="public/images/default.jpg" width="50" height="50" alt="..."></td>';
                                            } else {
                                                echo '<td class="text-center"><img src="public/images/house/' . $row["house_img"] . '" width="50"  height="50" alt="..."></td>';
                                            }
                                            // if ($row["house_img_map"] == "") {
                                            //     echo '<td class="text-center"><img src="public/images/default.jpg" width="50" height="50" alt="..."></td>';
                                            // } else {
                                            //     echo '<td class="text-center"><img src="public/images/img_map/' . $row["house_img_map"] . '" width="50"  height="50" alt="..."></td>';
                                            // }
                                            echo   '<td class="text-center">' . $row["account_user"] . '</td>
                                                    <td class="text-center">' . $row["house_timpstamp"] . '</td>
                                                    <td  class="text-center">
                                                        <div class="buttons">
                                                            <a href="javascript:void(0)" class="text-info h_edit"
                                                                house_id="' . $row["house_id"] . '"
                                                                site_id="' . $row["house_siteID"] . '"
                                                                name="' . $row["house_name"] . '"
                                                                sn="' . $row["house_master"] . '"
                                                                img="' . $row["house_img"] . '">
                                                                <i class="fadeIn animated bx bx-message-square-edit"></i>
                                                            </a>';
                                                            if($_SESSION["sn"]['account_status'] == 1){
                                                                echo '<a href="javascript:void(0)" class="text-danger delete_house"
                                                                    house_id="' . $row["house_id"] . '"
                                                                    sn="' . $row["house_master"] . '"
                                                                    name="' . $row["house_name"] . '"
                                                                    img="' . $row["house_img"] . '">
                                                                    <i class="fadeIn animated bx bx-trash"></i>
                                                                </a>';
                                                            }else{echo '<a class="text-secondary" onclick="return false;"><i class="fadeIn animated bx bx-trash"></i></a>';}
                                                    echo '</div>
                                                    </td>
                                                </tr>';
                                            $inc++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade <?php if($_POST['pt'] == 4){echo "show active";} ?>" id="p-ust" role="tabpanel">
                            <div class="d-sm-flex">
                                <div class="ps-3">
                                    <h5>เลือกสถานที &nbsp;
                                    <select class="btn btn-outline-info me-1 sel_main_site">
                                        <?php
                                            if ($_SESSION["sn"]['account_status'] != 1) {
                                                $site_stmt = $dbcon->prepare("SELECT * FROM `tbn_userst` INNER JOIN tbn_site ON tbn_userst.userST_siteID = tbn_site.site_id WHERE tbn_userst.userST_accountID = '$user_id' GROUP BY userST_siteID ");
                                            } else {
                                                $site_stmt = $dbcon->prepare("SELECT * FROM tbn_site ");
                                            }
                                            $site_stmt->execute();
                                            while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                            }
                                        ?>
                                    </select></h5>
                                </div>
                                <div class="ms-auto">
                                    <button class="btn btn-outline-success me-1 u_add mb-3"><i class="bi bi-plus-square"></i>เพิ่มผู้ใช้งานใหม่</button>
                                    <button class="btn btn-outline-success me-1 u_Suser mb-3"><i class="bi bi-plus-square"></i>กำหนดสิทธิ์ผู้ใช้งาน</button>
                                </div>
                            </div>
                            <div id="user_access"></div>
                        </div>
                        <div class="tab-pane fade <?php if($_POST['pt'] == 5){echo "show active";} ?>" id="p-sst" role="tabpanel">
                            <div class="d-sm-flex">
                                <div class="d-flex col-lg-6 col-xl-6 col-12 ms-auto ">
                                    <button type="button" class="col-3 btn btn-outline-secondary px-2 u_day">วันนี้</button>
                                    <button type="button" class="col-3 btn btn-outline-secondary px-2 u_week">7 วัน</button>
                                    <button type="button" class="col-3 btn btn-outline-secondary px-2 u_month">30 วัน</button>
                                    <button type="button" class="col-3 btn btn-outline-secondary px-2 u_from_to">กำหนดเอง</button>
                                </div>
                            </div>
                            <div id="user_report"></div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION["sn"]['account_status'] == 1) {?>
                        <div class="tab-pane fade" id="p-ct" role="tabpanel">
                            <select class="cont_sel" name="">
                                <option value="">เลือก</option>
                                <option value="TUSMT006">โรง 1 โซนหน้า</option>
                                <option value="TUSMT007">โรง 1 โซนหลัง</option>
                                <option value="TUSMT003">โรง 2</option>
                                <option value="TUSMT004">โรง 3</option>
                                <option value="TUSMT005">โรง 4</option>
                                <option value="TUSMT001">โรง 5</option>
                                <option value="TUSMT002">โรง 6</option>
                                <option value="TUSMT008">โรง Test </option>
                            </select>
                            <div id="get_set_cont"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_profile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขข้อมูลผู้ใช้งาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="profile_from" enctype="multipart/form-data" onSubmit="return false;">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img class="rounded-circle p-1 bg-primary p_img" width="110">
                        <div class="mt-3 input-group">
                            <input type="file" class="form-control" name="p_img" id="p_img_input" onchange="Showimg_profile(this)">
                            <input type="hidden" name="mode_insert" value="edit_profile">
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
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="E-mail" class="form-label">อีเมล <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mail-send"></i></span>
                            <input type="email" class="form-control border-start-0 p_email" name="p_email" placeholder="อีเมล">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="Mobite" class="form-label">โทรศัพท์</label>
                        <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><i class="fadeIn animated bx bx-mobile"></i></span>
                            <input type="tel" class="form-control border-start-0 p_tel" name="p_tel" placeholder="โทรศัพท์">
                        </div>
                    </div>
                    <?php if($_SESSION["account_user"] != 'KMUTT'){ ?>
                        <div class="col-12">
                            <label for="Mobite" class="form-label">Token Line</label>
                            <div class="input-group input-group-lg"> <span class="input-group-text bg-transparent"><img src="public/images/icons/icons8-line.svg" style="width: 23px;"></span>
                                <input type="text" class="form-control border-start-0 pt_token" name="pt_token" placeholder="Token Line" value="<?= $_SESSION["account_token"] ?>">
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="ms-auto">
                                <label for="Mobite" class="form-control"><a href="line_token.html" target="_blank"> <-- วิธีสร้าง Token Line Notify --> </a></label>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success submit_p"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="modal_site" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title title_mSite"> </h4>
            </div>
            <div class="modal-body">
                <form method="post" id="site_form" enctype="multipart/form-data" onSubmit="return false;">
                    <div class="text-center">
                        <img class="w-25 s_img mb-2" alt="...">
                        <input type="hidden" name="mode_insert" class="mode_insert">
                        <input type="hidden" name="site_id" class="mode_siteID">
                        <input type="hidden" name="s_imgDF" class="s_imgDF">
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- <label class="col-md-4">Images </label> -->
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="s_img" id="s_img" onchange="Showimg_site(this)">
                            </div>
                            <div class="col-md-4">
                                <label>ชื่อสถานที่ <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control s_name" name="s_name" placeholder="ชื่อสถานที่">
                                        <input type="hidden" name="s_nameDF" class="s_nameDF">
                                        <div class="invalid-feedback bs_name"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>ที่อยู่ <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <textarea type="text" class="form-control s_address" name="s_address" placeholder="ที่อยู่" rows="3"></textarea>
                                        <div class="invalid-feedback">กรุณาระบุที่อยู่</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>ละติจูด <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="number" class="form-control s_la" name="s_la" placeholder="ละติจูด">
                                        <div class="invalid-feedback">กรุณาระบุละติจูด</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>ลองจิจูด <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="number" class="form-control s_long" name="s_long" placeholder="ลองจิจูด">
                                        <div class="invalid-feedback">กรุณาระบุลองจิจูด</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>อินเตอร์เน็ต </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control s_internet" name="s_internet" placeholder="อินเตอร์เน็ต">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>อินเตอร์เน็ตหมดอายุ </label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control s_internetO" name="s_internetO" placeholder="อินเตอร์เน็ตหมดอายุ" aria-label="อินเตอร์เน็ตหมดอายุ" aria-describedby="button-addon2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success submit_s"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="modal_house" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title title_mHouse"> </h4>
            </div>
            <div class="modal-body">
                <form method="post" id="house_form" enctype="multipart/form-data" onSubmit="return false;">
                    <div class="text-center">
                        <img src="" class="w-25 h_img mb-2" alt="...">
                        <input type="hidden" name="mode_insert" class="mode_insert">
                        <input type="hidden" name="house_id" class="mode_houseID">
                        <input type="hidden" name="h_imgDF" class="h_imgDF">
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-md-4">โรงเรือน </label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="h_img" id="h_img" onchange="Showimg_house(this)">
                            </div>
                            <div class="col-md-4">
                                <label>สถานที่ <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select class="form-control h_site" name="h_site">
                                            <?php
                                                echo '<option value="0">เลือกสถานที่</option>';
                                                if ($_SESSION["sn"]['account_status'] != 1) {
                                                    $site_stmt = $dbcon->prepare("SELECT * FROM `tbn_userst` INNER JOIN tbn_site ON tbn_userst.userST_siteID = tbn_site.site_id WHERE tbn_userst.userST_accountID = '$user_id' GROUP BY userST_siteID ");
                                                } else {
                                                    $site_stmt = $dbcon->prepare("SELECT * FROM tbn_site ");
                                                }
                                                $site_stmt->execute();
                                                while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                                } ?>
                                        </select>
                                        <div class="invalid-feedback">กรุณาระบุสถานที่</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>ชื่อโรงเรือน <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control h_name" name="h_name" placeholder="ชื่อโรงเรือน">
                                        <div class="invalid-feedback">กรุณ่ระบุชื่อโรงเรือน</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>หมายเลขซีเรียล <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control h_sn" name="h_sn" placeholder="หมายเลขซีเรียล">
                                        <input type="hidden" name="h_snDF" class="h_snDF">
                                        <div class="invalid-feedback bh_sn"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <img src="" class="w-25 h_img_map mb-2" alt="...">
                        <input type="hidden" name="h_img_mapDF" class="h_img_mapDF">
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="col-md-4">จุดติดตั้งเซ็นเซอร์ทั้งหมด </label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" class="form-control" name="h_img_map" id="h_img_map" onchange="Showimg_house_map(this)">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success submit_h"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="modal_User" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title title_mUser"></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="user_form" enctype="multipart/form-data" onSubmit="return false;">
                    <div class="row us_user_sel">
                        <div class="col-md-4 text-end mb-2">
                            <label class="col-form-label mt-1">สถานที่</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <input type="hidden" class="use_site" name="use_site">
                                    <select class="form-control use_site" name="use_site" disabled>
                                        <?php
                                            $site_stmt = $dbcon->prepare("SELECT * FROM tbn_site ");
                                            $site_stmt->execute();
                                            while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                            } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end mb-2">
                            <label class="col-form-label mt-1">โรงเรือน <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <select class="form-control use_house" name="use_house"></select>
                                    <div class="invalid-feedback">กรุณาระบุโรงเรือน</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 user_edit text-end mb-2">
                            <label class="col-form-label mt-1">เลือกผู้ใช้งาน</label>
                        </div>
                        <div class="col-md-8 user_edit">
                            <div class="form-group has-icon-left">
                                <div class="position-relative">
                                    <select name="use_userID" class="form-control use_userID">
                                        <option value="0">เลือกผู้ใช้งาน</option>
                                    </select>
                                    <div class="invalid-feedback buse_userID"></div><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <img class="w-25 u_img mb-2" alt="...">
                        <input type="hidden" name="mode_insert" class="mode_insert">
                        <input type="hidden" name="userST_id" class="userST_id">
                    </div>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4 us_img_user text-end mb-2">
                                <label class="col-form-label mt-1">รูปผู้ใช้งาน </label>
                            </div>
                            <div class="col-md-8 us_img_user">
                                <input type="file" class="form-control" name="u_img" id="u_img" onchange="Showimg_user(this)">
                            </div>

                            <div class="col-md-4 us_img_user text-end mb-2">
                                <label class="col-form-label mt-1">สถานที่</label>
                            </div>
                            <div class="col-md-8 us_img_user">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="hidden" name="u_site" class="u_site">
                                        <select class="form-control u_site" name="u_site" disabled>
                                            <?php
                                                $site_stmt = $dbcon->prepare("SELECT * FROM tbn_site ");
                                                $site_stmt->execute();
                                                while ($row_site = $site_stmt->fetch(PDO::FETCH_BOTH)) {
                                                    echo '<option value="'.$row_site["site_id"].'">'.$row_site["site_name"].'</option>';
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 us_img_user text-end mb-2">
                                <label class="col-form-label mt-1">โรงเรือน <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 us_img_user">
                                <div class="form-group has-icon-left mb-2">
                                    <div class="position-relative">
                                        <select class="form-control u_house" name="u_house"></select>
                                        <div class="invalid-feedback">กรุณาระบุโรงเรือน</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end mb-2">
                                <label class="col-form-label mt-1">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control u_user" name="u_user" placeholder="ชื่อผู้ใช้งาน">
                                        <div class="invalid-feedback bu_user"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 us_pass text-end mb-2">
                                <label class="col-form-label mt-1">รหัสผ่าน <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 us_pass">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="password" class="form-control u_pass" name="u_pass" placeholder="รหัสผ่าน" value="">
                                        <div class="invalid-feedback bu_pass"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end mb-2">
                                <label class="col-form-label mt-1">อีเมล <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="email" class="form-control u_email" name="u_email" placeholder="อีเมล">
                                        <div class="invalid-feedback bu_email"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end mb-2">
                                <label class="col-form-label mt-1">หมายเลขโทรศัพท์</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" class="form-control u_tel" name="u_tel" placeholder="หมายเลขโทรศัพท์">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end mb-2">
                                <label class="col-form-label mt-1">ระดับผู้ใช้งาน</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <select name="u_status" class="form-control u_status">
                                            <?php
                                            if ($_SESSION["login_status"] == 1) {
                                                echo '<option value="3">User</option>
                                                      <option value="4">viewer</option>
                                                      <option value="2">Admin</option>
                                                      <option value="1">Supper Admin</option>';
                                            } else {
                                                echo '<option value="3">User</option>
                                                      <option value="4">viewer</option>
                                                      <option value="2">Admin</option> ';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success submit_u"><i class="fadeIn animated bx bx-save"></i>บันทึก</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fadeIn animated bx bx-window-close"></i>ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Modal_fromto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title">
                    <b class="">วัน - เวลา</b>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row hide_dwm">
                    <div class="col-lg-6 col-xl-6 col-sm-12">
                        <div class="input-group mb-3">
                            <span class="input-group-text col-sm-4" id="basic-addon3">เวลาเริ่ม</span>
                            <input type="text" class="form-control text-center val_start" placeholder="วันเวลาเริ่มต้น" aria-label="วันเวลาเริ่มต้น" aria-describedby="button-addon2">
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
<script type="text/javascript"> // profile
    $(".edit_p").click(function () {
        $(".p_img").attr('src','public/images/users/'+$('.pt_img').val());
        $("#p_img_input").val("");
        $(".p_name").val($('.pt_name').val());
        $(".p_pass").val('');
        $(".p_email").val($('.pt_email').val());
        $(".p_tel").val($('.pt_tel').val());
        $("#modal_profile").modal("show");
    });
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
        // console.log(new FormData($("#profile_from")[0]));
        // return false
        var loading = verticalNoTitle();
        $.ajax({
            type: "POST",
            url: "routes/profile/save_setting.php",
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
                        title: 'รูปแบบอีเมลไม่ถูกต้อง !',
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
                        title: 'อีเมลนี้ถูกใช้งานแล้ว !',
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

                    $('.pt_img').val(parseJSON.data.image);
                    $(".pt_img2").attr("src", "public/images/users/" + parseJSON.data.image);
                    $('.pt_name').val(parseJSON.data.user);
                    $('.pt_email').val(parseJSON.data.email);
                    $('.pt_tel').val(parseJSON.data.tel);
                    $('.pt_token').val(parseJSON.data.token)
                    $.ajax({
                        url: "routes/profile/setting_profile.php",
                        method: "post",
                        data: {
                            // s_master: res.s_master,
                            pt: 1
                        },
                        // dataType: "json",
                        success: function(resp) {
                            $("#load_pages_profile").html(resp);
                        }
                    });
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
    function Showimg_profile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.p_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<!-- <script type="text/javascript"> // site
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
            url: "routes/save_setting.php",
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
                        url: "routes/profile/setting_profile.php",
                        method: "post",
                        data: {
                            // s_master: res.s_master,
                            pt: 2
                        },
                        // dataType: "json",
                        success: function(resp) {
                            $("#load_pages_profile").html(resp);
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
                    url: 'routes/save_setting.php',
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
                                url: "routes/profile/setting_profile.php",
                                method: "post",
                                data: {
                                    // s_master: res.s_master,
                                    pt: 2
                                },
                                // dataType: "json",
                                success: function(resp) {
                                    $("#load_pages_profile").html(resp);
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
    $('#table1').DataTable({
        "scrollY": 330,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "destroy": true,
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [
            {
                // "targets": [ 1 ],
                // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                "visible": false,
                "searchable": false,
            },
        ],
    });
</script>
<script type="text/javascript"> // House
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
                        url: "routes/profile/setting_profile.php",
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
    $('#table2').DataTable({
        "scrollY": 330,
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "destroy": true,
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [
            {
                // "targets": [ 1 ],
                // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                "visible": false,
                "searchable": false,
            },
        ],
    });
</script> -->
<script type="text/javascript"> // access control
    $(".sel_main_site").change(function(){
        table_user()
    });
    table_user();
    function table_user(){
        //     var loading = verticalNoTitle();
        $.ajax({
            url: "routes/profile/get_tableUser.php",
            method: "GET",
            data: {
                siteID: $(".sel_main_site").val()
            },
            // dataType: "json",
            success: function(res) {
                $("#user_access").html(res);
                function Showimg_user(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.u_img').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            }
        });
         // loadingOut(loading);
    }

    $(".u_add").click(function() {
        // console.log('1');
        $(".title_mUser").html("ลงทะเบียนผู้ใช้ใหม่");
        $(".us_user_sel").hide();
        $(".us_img_user").show();
        $('.u_img').attr("src", "public/images/default.jpg").removeClass("mb-3");
        $("#u_img").val("");
        $(".mode_insert").val("add_user");
        $(".userST_id").val("");
        $(".u_site").val($(".sel_main_site").val());

        $(".u_house").removeClass("is-invalid").val("0").attr("disabled",false).load('routes/profile/op_house.php?siteID='+$('.sel_main_site').val());
        $(".u_user").removeClass("is-invalid").val("").attr("disabled",false);
        $(".us_pass").show();
        $(".u_pass").removeClass("is-invalid").val("");
        $(".u_email").removeClass("is-invalid").val("").attr("disabled",false);
        $(".u_tel").val("").attr("disabled",false);
        $(".u_status").val("3").attr("disabled",false);
        $("#modal_User").modal("show");
    });
    $(".u_Suser").click(function() {
        $(".title_mUser").html("กำหนดสิทธิ์ผู้ใช้งาน");
        $(".us_user_sel").show();
        $(".use_site").val($(".sel_main_site").val());
        $(".use_house").val('').load("routes/profile/op_house.php?siteID="+$(".sel_main_site").val()+'&us=1').attr("disabled",false);
        $(".use_userID").val("0").removeClass("is-invalid");
        $(".us_img_user").hide();
        $('.user_edit').show();
        $('.u_img').attr("src", "public/images/default.jpg")
        $("#u_img").val("");
        $(".mode_insert").val("add_user2");
        $(".userST_id").val("");

        $(".u_site").val($(".sel_main_site").val());
        $(".u_house").removeClass("is-invalid").val("0").attr("disabled",false);
        $(".u_user").removeClass("is-invalid").val("").attr("disabled",true);
        $(".us_pass").hide();
        $(".u_pass").removeClass("is-invalid").val("");
        $(".u_email").removeClass("is-invalid").val("").attr("disabled",true);
        $(".u_tel").val("").attr("disabled",true);
        $(".u_status").val('3').attr("disabled",false);
        $("#modal_User").modal("show");
        // ----------------------------------------
        $(".use_house").change(function () {
            $(".use_userID").load("routes/profile/op_user.php?houseID="+$(this).val());
        });
        $(".use_userID").change(function() {
            var user_id = $(this).val();
            $.ajax({
                url: "routes/profile/get_user_detel.php",
                method: "post",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                success: function(res) {
                    console.log(res);
                    var img = res.account_img;
                    if(img === ""){
                        $('.u_img').attr("src", "public/images/users/user.png").addClass("mb-3");
                    }else{
                        $('.u_img').attr("src", "public/images/users/"+img).addClass("mb-3");
                    }
                    $(".u_user").val(res.account_user);
                    $(".u_email").val(res.account_email);
                    $(".u_tel").val(res.account_tel);
                }
            });
        });
    });
    $(".submit_u").click(function () {
        // alert($(".mode_insert").val())
        if ($(".mode_insert").val() === "add_user") {
            if($(".u_house").val() === ""){
                $(".u_house").addClass("is-invalid");
                return false;
            }else{
                $(".u_house").removeClass("is-invalid");
            }
            if($(".u_user").val() === ""){
                $(".u_user").addClass("is-invalid");
                $(".bu_user").html("กรถณาระบุชื่อผู้ใช้งาน");
                return false;
            }else{
                $(".u_user").removeClass("is-invalid");
            }
            if($(".u_pass").val() === ""){
                $(".u_pass").addClass("is-invalid");
                $(".bu_pass").html("กรถณาระบุรหัสผ่าน");
                return false;
            }else{
                $(".u_pass").removeClass("is-invalid");
            }
            if($(".u_email").val() === ""){
                $(".u_email").addClass("is-invalid");
                $(".bu_email").html("กรถณาระบุอีเมล");
                return false;
            }else{
                $(".u_email").removeClass("is-invalid");
            }
        }
        if($(".mode_insert").val() === "add_user2") {
            if($(".use_house").val() === "0"){
                $(".use_house").addClass("is-invalid");
                return false;
            }else{
                $(".use_house").removeClass("is-invalid");
            }
            if($(".use_userID").val() === "0"){
                $(".use_userID").addClass("is-invalid");
                $(".buse_userID").html("กรุณาระบุโรงเรือน");
                return false;
            }else{
                $(".use_userID").removeClass("is-invalid");
            }
        }
        // var loading = verticalNoTitle();
        // console.log(new FormData($("#user_form")[0]));
        // return false;
        $.ajax({
            type: "POST",
            url: "routes/profile/save_setting.php",
            data: new FormData($("#user_form")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                // loadingOut(loading);
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
                    $(".u_user").addClass("is-invalid");
                    $(".bu_user").html("กรถณาระบุชื่อผู้ใช้งานใหม่");
                    return false;
                }
                if (parseJSON.status === "house มีรายชื่อนี้แล้ว") {
                    swal({
                        title: 'ผู้ใช้งานนี้เข้าถึงโรงเรือนนี้อยู่แล้ว !',
                        text: "กรุณาเลือกผู้ใช้งานใหม่",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".use_userID").addClass("is-invalid");
                    $(".buse_userID").html("กรถณาระบุชื่อผู้ใช้งานใหม่");
                    return false;
                }
                if (parseJSON.status === "รูปแบบ email ไม่ถูกต้อง") {
                    swal({
                        title: 'รูปแบบอีเมลไม่ถูกต้อง !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".u_email").addClass("is-invalid");
                    $(".bu_email").html('กรถณาระบุแีเมลล์ใหม่');
                    return false;
                }
                if (parseJSON.status === "มี email นี้แล้ว") {
                    swal({
                        title: 'มีอีเมลนีในระบบแล้ว !',
                        // text: "" + sw_name + " ?",
                        type: 'warning',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $(".u_email").addClass("is-invalid");
                    $(".bu_email").html('กรถณาระบุแีเมลล์ใหม่');
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
                    $("#user_access").load("routes/profile/get_tableUser.php?siteID="+$(".sel_main_site").val());
                    swal({
                        title: 'บันทึกข้อมูลสำเร็จ.',
                        // text: "" + sw_name + " ?",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#32CD32'
                    });
                    $("#modal_User").modal("hide");
                }
            }
        });
    });
    $('#tb_users').DataTable({
        "scrollY": '90vh',
        "scrollX": true,
        "scrollCollapse": false,
        "paging":    false,
        "searching": false,
        "destroy": true,
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [
            {
                // "targets": [ 1 ],
                // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                "visible": false,
                "searchable": false,
            },
        ],
    });
</script>
<script type="text/javascript"> // user_report
    var pt = '<?= $_POST['pt'] ?>';
    if(pt == 5){
        get_reportUser("day");
    }
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
    $('.c_pt').click(function(){
        get_reportUser("day")
    });
    $('.u_day').click(function(){
        get_reportUser("day")
    });
    $('.u_week').click(function(){
        get_reportUser("week")
    });
    $('.u_month').click(function(){
        get_reportUser("month")
    });
    $('#submit_fromTo').click(function(){
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
        // alert($('.val_start').val())
        // return false;
        get_reportUser("from_to")
        $('#Modal_fromto').modal('hide');
    });
    $('.u_from_to').click(function(){
        $('.val_start').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
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
                    $(this).val(picker.startDate.format('YYYY-MM-DD')).removeClass('is-invalid');
                }
            }else {
                $(this).val(picker.startDate.format('YYYY-MM-DD')).removeClass('is-invalid');
            }
        });

        $('.val_end').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
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
                    $(this).val(picker.startDate.format('YYYY-MM-DD')).removeClass('is-invalid');
                }
            }else {
                $(this).val(picker.startDate.format('YYYY-MM-DD')).removeClass('is-invalid');
            }
        });
        $('#Modal_fromto').modal('show');
    });
    function get_reportUser(val){
        if(val === 'day'){
            $('.u_day').addClass('active');
            $('.u_week').removeClass('active');
            $('.u_month').removeClass('active');
            $('.u_from_to').removeClass('active');
        }
        else if (val === 'week') {
            $('.u_day').removeClass('active');
            $('.u_week').addClass('active');
            $('.u_month').removeClass('active');
            $('.u_from_to').removeClass('active');
        }
        else if (val === 'month') {
            $('.u_day').removeClass('active');
            $('.u_week').removeClass('active');
            $('.u_month').addClass('active');
            $('.u_from_to').removeClass('active');
        }
        else if (val === 'from_to') {
            $('.u_day').removeClass('active');
            $('.u_week').removeClass('active');
            $('.u_month').removeClass('active');
            $('.u_from_to').addClass('active');
        }
        var loading = verticalNoTitle();
        $.ajax({
            url: "routes/profile/get_reportUser.php",
            method: "post",
            data: {
                siteID: url[1],
                status : val,
                s_time : $('.val_start').val(),
                e_time : $('.val_end').val(),
            },
            // dataType: "json",
            success: function(res) {
                $('#user_report').html(res)
                var countColumn = '<?= $count ?>';
                var currentdate = new Date();
                var datetime = currentdate.getFullYear() + "-"
                            + (currentdate.getMonth()+1)  + "-"
                            + currentdate.getDate() + "_"
                            + currentdate.getHours() + "."
                            + currentdate.getMinutes(); //+ ":"
                            // + currentdate.getSeconds();

                if(countColumn == 0){
                    $('#tb_users2').DataTable({
                        "scrollY": '90vh',
                        "scrollX": true,
                        "scrollCollapse": false,
                        "paging":    false,
                        "searching": false,
                        "destroy": true,
                        "order": [
                            [0, "desc"]
                        ],
                        "columnDefs": [
                            {
                                // "targets": [ 1 ],
                                // render: $.fn.dataTable.render.moment( 'X', 'YYYY/MM/DD' ),
                                // "render": $.fn.dataTable.render.moment( 'YYYY/MM/DD' ),
                                "visible": false,
                                "searchable": false,
                            },
                        ],
                    });
                }
                else {
                    $('#tb_users2').DataTable({
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
                                title: "Smart Farm Access Control",
                                charset: 'UTF-8',
                                extension: '.csv',
                                // exportOptions: {
                                //    columns: [ 0, 2, 5 ]
                                // },
                                className:'btn btn-outline-success px-5 btnexport3',
                                extend: 'csv',
                                format: 'YYYY/MM/dd',
                                // fieldSeparator: ';',
                                // fieldBoundary: '',
                                filename: 'smart_farm_access_control_'+datetime,
                                // className: 'btn-info',
                                bom: true
                            }
                        ]
                    });
                }
                loadingOut(loading);
            }
        });
    }
</script>
<script type="text/javascript"> // ตั้งค่า config
    $('.cont_sel').change(function() {
        // var sn = $(this).val();
        if($(this).val() !== ''){
            $.ajax({
                url: "routes/tu/get_page_profile_config.php",
                method: "post",
                data: {
                    sn: $(this).val()
                },
                // dataType: "json",
                success: function(res) {
                    $('#get_set_cont').html(res);
                }
            });
        }
    });
</script>
