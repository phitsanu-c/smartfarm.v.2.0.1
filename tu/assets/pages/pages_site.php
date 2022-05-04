
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">เลือกสถานที่</div>
        <!-- <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cards</li>
                </ol>
            </nav>
        </div> -->
        <!-- <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div> -->
    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                
                
    <?php
        session_start();
        require '../../../routes/connectdb.php';
        $url_host = 'http://' . $_SERVER['HTTP_HOST'];
        $url_part = explode("/", $_SERVER["PHP_SELF"]);
        $url_link = $url_host . '/' . $url_part[1];
        // echo $url_part[1];
        // exit();
        $accountID = $_SESSION['account_id'];
        // $_SESSION["Username"] ;
        // $_SESSION["login_status"]  ;

        function encode($string){
            return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string . 'zasn'));
        }

        // function decode($string) {
        //     return base64_decode(str_replace(['-','_'], ['+','/'], $string));
        // }

        if ($_SESSION["sn"]['account_status'] == 1) {
            $site_stmt = $dbcon->query("SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id GROUP BY house_siteID ");
        } else {
            $site_stmt = $dbcon->query("SELECT * FROM `tbn_userst` INNER JOIN tbn_site ON tbn_userst.userST_siteID = tbn_site.site_id INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE tbn_userst.userST_accountID = '$accountID' GROUP BY userST_siteID ");
        }
        $i = 1;
        // $row_ = $site_stmt->fetch(PDO::FETCH_BOTH);
        foreach ($site_stmt as $row_) {
            $siteID = $row_["site_id"];
            if ($_SESSION["sn"]['account_status'] == 1) {
                $count_house = $dbcon->query("SELECT count(house_id) FROM tbn_house WHERE house_siteID = '$siteID' ")->fetch(PDO::FETCH_BOTH);
            }else{
                $count_house = $dbcon->query("SELECT count(userST_houseID) FROM tbn_userst WHERE userST_accountID = '$accountID' AND userST_siteID ='$siteID'")->fetch(PDO::FETCH_BOTH);
            }
            // echo $url_link .'/tu/#'.encode($row_["site_id"].',');
    ?>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
            <a href="
                <?php 
                    if($count_house[0] != 1){ 
                        echo $url_link .'/tu/#'.encode($row_["site_id"].',');
                    }else{ 
                        if(substr($row_["house_master"],0,2) == "TUS"){
                            echo $url_link .'/tu/#'.encode($row_["site_id"].','.$row_["house_master"]);
                        }else{
                            echo $url_link .'#'.encode($row_["site_id"].','.$row_["house_master"]);
                        }
                    } ?>">
                <div class="card" style="padding: 1.25rem; height:300px; border-radius:20px">
                    <img src="../public/images/site/<?= $row_["site_img"] ?>" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                    <!-- <div class="card"> -->
                    <h6 class="card-title text-bold text-center" style="margin-top: 15px">สถานที่ : <B><?= $row_["site_name"] ?></B></h6>
                    <h6 class="card-title text-bold text-center" style="margin-top: 10px">ที่ตั้ง : <B><?= $row_["site_address"] ?></B></h6>
                    <!-- <div class="d-grid" style="overflow:auto; padding-left:10px; padding-right:10px;" id="style-3"> -->
                    <?php 
                        echo '<h6 class="card-title text-bold text-center" style="margin-top: 10px">จำนวน : <B>'.$count_house[0].' โรงเรือน</B></h6>';
                        // foreach ($stmt2 as $row) {
                        //     echo '<a class="btn btn-outline-info px-5 radius-30" style="margin-top: 10px" href="'. $url_link .'#'. encode($row["house_master"]) .'">'. $row["house_name"].'</a>';
                        // }
                    ?>
                    <!-- </div> -->
                </div>
            </a>
        </div>





    <?php $i++;
    } ?>
         
    </div>   
</div>
<script>
    // al
</script>