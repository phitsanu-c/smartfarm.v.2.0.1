<?php
    require "../connectdb.php";
    $user_id = $_SESSION['account_id'];
    $siteID = $_GET["siteID"];
    // echo $siteID;
    // exit();
?>

<div class="table-responsive m-t-10">
    <table id="tb_users" class="table table-striped table-bordered dataTable" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">โรงเรือน</th>
                <th class="text-center">Images</th>
                <th class="text-center">ชื่อผู้ใช้งาน</th>
                <th class="text-center">อีเมลล์</th>
                <th class="text-center">โทรศัพท์</th>
                <!-- <th class="text-center">Site Main</th> -->
                <th class="text-center">ระดับผู้ใช้งาน</th>
                <!-- <th class="text-center">Approval</th> -->
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SESSION["sn"]['account_status'] == 1) {
                $stmt = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_account ON tbn_userst.userST_accountID = tbn_account.account_id INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE userST_siteID='$siteID'  "); //GROUP BY userST_accountID
            } else {
                $stmt = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_account ON tbn_userst.userST_accountID = tbn_account.account_id INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE userST_siteID='$siteID' AND userST_main='$user_id'  ");
            }
            $stmt->execute();
            $count = $stmt->rowCount();
            // if($count != 0){
            $i = 1;
            $data0 = array();
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                echo '<tr>
                        <td class="text-center">' . $i . '</td>
                        <td class="text-center">' . $row["house_name"] . '</td>';
                if ($row["account_img"] == "") {
                    echo '<td class="text-center"><img src="public/images/users/user.png" width="50"  height="50" alt="..."></td>';
                } else {
                    echo '<td class="text-center"><img src="public/images/users/' . $row["account_img"] . '" width="50"  height="50" alt="..."></td>';
                }
                echo '  <td class="text-center">' . $row["account_user"] . '</td>
                        <td class="text-center">' . $row["account_email"] . '</td>
                        <td class="text-center">' . $row["account_tel"] . '</td>
                        ';//<td class="text-center">' . $row["site_name"] . '</td>';
                if ($row["userST_level"] == 1) {
                    echo '<td class="text-center"><span class="badge bg-info"> Support Admin <span></td>';
                } else if ($row["userST_level"] == 2) {
                    echo '<td class="text-center"><span class="badge bg-success"> Admin <span></td>';
                } else if ($row["userST_level"] == 3) {
                    echo '<td class="text-center"><span class="badge bg-info"> User <span></td>';
                } else if ($row["userST_level"] == 4) {
                    echo '<td class="text-center"><span class="badge bg-warning"> Viewer <span></td>';
                }
                echo '<td class="text-center">
                        <div class="buttons">
                            <a href="javascript:void(0)" class="text-info u_edit"
                                userST_id="' . $row["userST_id"] . '"
                                houseID="' . $row["userST_houseID"] . '"
                                name="' . $row["account_user"] . '"
                                email="' . $row["account_email"] . '"
                                img="' . $row["account_img"] . '"
                                tel="' . $row["account_tel"] . '"
                                status="' . $row["userST_level"] . '">
                                <i class="fadeIn animated bx bx-message-square-edit"></i>
                            </a>';
                            if($_SESSION["sn"]['account_status'] == 1 || $row["userST_main"] == $user_id){
                                echo '<a href="javascript:void(0)" class="text-danger delete_user"
                                    userST_id="' . $row["userST_id"] . '"
                                    user_id="' . $row["account_id"] . '"
                                    name="' . $row["account_user"] . '"
                                    house="' . $row["house_name"] . '"
                                    img="' . $row["account_img"] . '">
                                    <i class="fadeIn animated bx bx-trash"></i>
                                </a>';
                            }else{echo '<a class="text-secondary" onclick="return false;"><i class="fadeIn animated bx bx-trash"></i></a>';}
                        echo '</div>
                    </td>
                </tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(".u_edit").click(function(){
        var houseID = $(this).attr('houseID');
        $(".title_mUser").html("แก้ไขผู้ใช้งาน");
        $(".us_user_sel").show();
        $(".use_site").val($(".sel_main_site").val());
        $(".use_house").load("routes/profile/op_house.php?siteID="+$(".sel_main_site").val()+'&us=1').attr("disabled",true);
        setTimeout(function() {
            $(".use_house").val(houseID);
            // alert(houseID)
        }, 500);
        $(".use_userID").val("0").removeClass("is-invalid");
        $(".us_img_user").hide();
        $('.user_edit').hide();
        if($(this).attr('img') === ''){
            $('.u_img').attr("src", "public/images/users/user.png")
        }else {
            $('.u_img').attr("src", "public/images/users/"+$(this).attr('img'))
        }

        $("#u_img").val("");
        $(".mode_insert").val("edit_user");
        $(".userST_id").val($(this).attr('userST_id'));

        $(".u_site").val($(".sel_main_site").val());
        $(".u_house").removeClass("is-invalid").val("0").attr("disabled",false);
        $(".u_user").removeClass("is-invalid").val($(this).attr('name')).attr("disabled",true);
        $(".us_pass").hide();
        $(".u_pass").removeClass("is-invalid").val("");
        $(".u_email").removeClass("is-invalid").val($(this).attr('email')).attr("disabled",true);
        $(".u_tel").val($(this).attr('tel')).attr("disabled",true);
        $(".u_status").val($(this).attr('status')).attr("disabled",false);
        $("#modal_User").modal("show");
    });

    $(".delete_user").click(function(){
        var img = $(this).attr("img");
        var user_id = $(this).attr("user_id");
        swal({
            title: "ลบผู้ใช้งานออกจากโรงเรือน !",
            html: "คุณต้องการที่จะลบผู้ใช้งาน : <b>"+$(this).attr("name")+"</b><br> ออกจากโรงเรือน : <b>"+$(this).attr('house')+"</b> หรือไม่ ?",
            type: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#00CC33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ยกเลิก'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'routes/profile/save_setting.php',
                    type: 'POST',
                    data: {
                        userST_id : $(this).attr('userST_id'),
                        user_id : user_id,
                        mode_insert : "delete_userST",
                        // img : $(this).attr("img")
                    },
                    dataType: 'json',
                    success: function(data) {
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
                            $("#user_access").load("routes/profile/get_tableUser.php?siteID="+$(".sel_main_site").val() );
                            if(data.count_userST === 0){
                                swal({
                                    title: 'ลบข้อมูลสำเร็จ.',
                                    // text: "" + sw_name + " ?",
                                    type: 'success',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#32CD32'
                                }).then((result) => {
                                    if (result.value) {
                                        swal({
                                            title: 'ลบผู้ใช้งานจากระบบ !',
                                            html: "คุณต้องการที่จะลบผู้ใช้งาน : <b>"+$(this).attr("name")+"</b><br> ออกจากระบบหรือไม่ ?",
                                            type: 'warning',
                                            allowOutsideClick: false,
                                            showCancelButton: true,
                                            confirmButtonColor: '#00CC33',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'ใช่',
                                            cancelButtonText: 'ยกเลิก'
                                            }).then((result) => {
                                            if (result.value) {
                                                $.ajax({
                                                    url: 'routes/profile/save_setting.php',
                                                    type: 'POST',
                                                    data: {
                                                        user_id : user_id,
                                                        mode_insert : "delete_account",
                                                        img : img
                                                    },
                                                    dataType: 'json',
                                                    success: function(data) {
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
                                                            swal({
                                                                title: 'ลบข้อมูลสำเร็จ.',
                                                                // text: "" + sw_name + " ?",
                                                                type: 'success',
                                                                allowOutsideClick: false,
                                                                confirmButtonColor: '#32CD32'
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                            else {
                                swal({
                                    title: 'ลบข้อมูลสำเร็จ.',
                                    // text: "" + sw_name + " ?",
                                    type: 'success',
                                    allowOutsideClick: false,
                                    confirmButtonColor: '#32CD32'
                                });
                            }
                        }
                    }
                });
            }
        });
    });
</script>
