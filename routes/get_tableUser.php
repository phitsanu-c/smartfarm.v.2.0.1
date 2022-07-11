<?php
    require "../routes/connectdb.php";
    $user_id = $_SESSION['account_id'];
    $siteID = $_GET["siteID"];
    // echo $siteID;
    // exit();
?>

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
            $stmt = $dbcon->prepare("SELECT * FROM tbn_userst INNER JOIN tbn_account ON tbn_userst.userST_accountID = tbn_account.account_id INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE userST_siteID='$siteID' GROUP BY userST_accountID ");
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
                echo '<td class="text-center"><span class="badge bg-info"> Admin <span></td>';
            } else if ($row["userST_level"] == 3) {
                echo '<td class="text-center"><span class="badge bg-info"> User <span></td>';
            }
            echo '<td class="text-center">
                    <div class="buttons">
                        <a href="javascript:void(0)" class="text-info u_edit"
                            userST_id="' . $row["userST_id"] . '"
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
