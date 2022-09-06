
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">เลือกโรงเรือน</div>
    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">


    <?php
        $siteID = $_POST["s"];
        $url_host = 'http://' . $_SERVER['HTTP_HOST'];
        $url_part = explode("/", $_SERVER["PHP_SELF"]);
        $url_link = $url_host . '/' . $url_part[1];
        // echo $_GET["s"];
        // exit();
        // $_SESSION["Username"] ;
        // $_SESSION["login_status"]  ;

        function encode($string){
            return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
        }

        // function decode($string) {
        //     return base64_decode(str_replace(['-','_'], ['+','/'], $string));
        // }
        // echo ;
        // exit();
        if($siteID == 3){ require '../routes/connectdb.php'; ?>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
                <a href="javascript:;" class="sw_house" url="<?= '#'.encode('2,3,KMUMT001') ?>">
                    <div class="card" style="padding: 1.25rem;  border-radius:20px">
                        <img src="public/images/site/kmutt.jpg" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                        <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 15px">ชื่อ : <B>มจธ Master</B></h6>
                        <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">ขนาด : <B>6x12</B></h6>
                        <?php
                            $house_master = "KMUMT001";
                            // echo $house_master;
                            $row_t = $dbcon->query("SELECT data_timestamp FROM tb_data_sensor WHERE data_sn = '$house_master' ORDER BY data_timestamp DESC")->fetch();
                            if(DateTime::createFromFormat("Y/m/d - H:i:s", $row_t[0])->format("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime('-30 minute')) ){
                                echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                            }else {
                                echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                            }
                        ?>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
                <a href="javascript:;" class="sw_house" url="<?= '#'.encode('3,3,KMUWE001') ?>">
                    <div class="card" style="padding: 1.25rem;  border-radius:20px">
                        <img src="public/images/site/kmutt.jpg" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                        <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 15px">ชื่อ : <B>Wemos 1 มจธ.</B></h6>
                        <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">ขนาด : <B>6x12</B></h6>
                        <?php
                            $house_master = "KMUWE001";
                            // echo $house_master;
                            $row_t = $dbcon->query("SELECT data_timestamp FROM tb_data_sensor WHERE data_sn = '$house_master' ORDER BY data_timestamp DESC")->fetch();
                            if(DateTime::createFromFormat("Y/m/d - H:i:s", $row_t[0])->format("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime('-30 minute')) ){
                                echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                            }else {
                                echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                            }
                        //}?>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
                <a href="javascript:;" class="sw_house" url="<?= '#'.encode('3,3,KMUWE002') ?>">
                    <div class="card" style="padding: 1.25rem;  border-radius:20px">
                        <img src="public/images/site/kmutt.jpg" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                        <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 15px">ชื่อ : <B>Wemos 2 มจธ.</B></h6>
                        <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">ขนาด : <B>6x12</B></h6>
                        <?php
                            $house_master = "KMUWE001";
                            // echo $house_master;
                            $row_t = $dbcon->query("SELECT data_timestamp FROM tb_data_sensor WHERE data_sn = '$house_master' ORDER BY data_timestamp DESC")->fetch();
                            if(DateTime::createFromFormat("Y/m/d - H:i:s", $row_t[0])->format("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime('-30 minute')) ){
                                echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                            }else {
                                echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                            }
                        //}?>
                    </div>
                </a>
            </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
                    <a href="javascript:;" class="sw_house" url="<?= '#'.encode('2,3,KMUMT002') ?>">
                        <div class="card" style="padding: 1.25rem;  border-radius:20px">
                            <img src="public/images/site/kmutt.jpg" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                            <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 15px">ชื่อ : <B>มจธ Master 2</B></h6>
                            <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">ขนาด : <B>6x12</B></h6>
                            <?php
                                $house_master = "KMUMT001";
                                // echo $house_master;
                                $row_t = $dbcon->query("SELECT data_timestamp FROM tb_data_sensor WHERE data_sn = '$house_master' ORDER BY data_timestamp DESC")->fetch();
                                if(DateTime::createFromFormat("Y/m/d - H:i:s", $row_t[0])->format("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime('-30 minute')) ){
                                    echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                                }else {
                                    echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                                }
                            ?>
                        </div>
                    </a>
                </div>
        <?php }
        else {
            require '../routes/connectdb.php';
            $accountID = $_SESSION['account_id'];
            if ($_SESSION["sn"]['account_status'] == 1) {
                $site_stmt = $dbcon->query("SELECT * FROM tbn_house WHERE house_siteID = '$siteID' ");
            } else if ($_SESSION["sn"]['account_status'] >1) {
                $site_stmt = $dbcon->query("SELECT * FROM tbn_userst INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE  tbn_userst.userST_accountID='$accountID' AND tbn_userst.userST_siteID = '$siteID' GROUP BY `userST_houseID` ");
            }
            $i = 1;
            // $row_ = $site_stmt->fetch(PDO::FETCH_BOTH);
            if($siteID == 10){
                $house_sn = 'TUSMT';
                $drow_ = $dbcon->query("SELECT * FROM tbn_data_tu WHERE data_sn = '$house_sn' ORDER BY data_timestamp DESC")->fetch();
            }
            foreach ($site_stmt as $row_) {
                // echo $url_link;
                // echo substr($row_["house_master"],0,3);
                // $url_link . ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
                    <a href="javascript:;" class="sw_house" url="<?= '#'.encode($row_['house_webv'].','.$row_["house_siteID"].','.$row_["house_master"] ) ?>">
                        <div class="card" style="padding: 1.25rem;  border-radius:20px">
                            <img src="<?php if($row_["house_img"] == ""){echo "public/images/default.jpg";}else{echo "public/images/house/".$row_["house_img"];} ?>" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                            <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 15px">ชื่อ : <B><?= $row_["house_name"] ?></B></h6>
                            <h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">ขนาด : <B><?= substr($row_["house_size"],9,13) ?></B></h6>
                            <?php
                            if ($row_['house_webv'] == 2) {
                                $house_master = $row_["house_master"];
                                // echo $house_master;
                                $row_t = $dbcon->query("SELECT data_timestamp FROM tb_data_sensor WHERE data_sn = '$house_master' ORDER BY data_timestamp DESC")->fetch();
                                if($house_master == 'KMUMT001'){
                                    if(DateTime::createFromFormat("Y/m/d - H:i:s", $row_t[0])->format("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime('-30 minute')) ){
                                        echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                                    }else {
                                        echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                                    }
                                }
                            }
                            else if ($row_['house_webv'] == 3) {
                                $house_master = $row_["house_master"];
                                // echo $house_master;
                                // $row_t = $dbcon->query("SELECT data_timestamp FROM tb_data_sensor WHERE data_sn = '$house_master' ORDER BY data_timestamp DESC")->fetch();
                                // if(DateTime::createFromFormat("Y/m/d - H:i:s", $row_t[0])->format("Y-m-d H:i:s") > date("Y-m-d H:i:s", strtotime('-2 minute')) ){
                                //     echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                                // }else {
                                //     echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                                // }
                            }
                            else if ($row_['house_webv'] == 4) {
                                $house_master = $row_["house_master"];
                                // echo $house_master;
                                $row_online = $dbcon->query("SELECT hw_connect_status FROM tbn_hardware_connect WHERE hw_connect_sn = '$house_master' ORDER BY hw_connect_timestamp DESC LIMIT 1")->fetch();
                                if($row_online == ''){
                                    echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                                }else {
                                    if($row_online[0] == 'online' ){
                                        echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-success"> ออนไลน์</B> ';
                                    }else {
                                        echo '<h6 class="card-title text-bold text-responsive3 text-center" style="margin-top: 10px">สถานะ : <B class="text-danger"> ออฟไลน์</B>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </a>
                </div>
                <?php if ($_SESSION["sn"]['account_status'] == 1) {?>
                    <script> $(".memu_compare").show(); </script>
                <?php }else { ?>
                    <script>
                        var userLevel = '<?= $row_['userST_level'] ?>';
                        if(userLevel > 2){
                            // alert(userLevel)
                            $(".memu_compare").hide();
                        }else {
                            $(".memu_compare").show();
                        }
                    </script>
                <?php } $i++;
            } ?>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    // $('.sw_house').click(function(){
    //     // alert($(this).attr("url"))
    //     window.location.href = $(this).attr("url");
    // })

    $('.sw_house').click(function(){
        window.location.hash =$(this).attr("url");
        location.reload();
        // alert($(this).attr("url"))
        // window.location.href = $(this).attr("url");
    })
</script>
