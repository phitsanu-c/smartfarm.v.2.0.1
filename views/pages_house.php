
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">เลือกโรงเรือน</div>
    </div>
    <!--end breadcrumb-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                
                
    <?php
        // session_start();
        require '../routes/connectdb.php';
        $url_host = 'http://' . $_SERVER['HTTP_HOST'];
        $url_part = explode("/", $_SERVER["PHP_SELF"]);
        $url_link = $url_host . '/' . $url_part[1];
        $siteID = $_GET["s"];
        // echo $_GET["s"];
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
            $site_stmt = $dbcon->query("SELECT * FROM tbn_house WHERE house_siteID = '$siteID' ");
        } else if ($_SESSION["sn"]['account_status'] >1) {
            $site_stmt = $dbcon->query("SELECT * FROM tbn_userst INNER JOIN tbn_house ON tbn_userst.userST_houseID = tbn_house.house_id WHERE  tbn_userst.userST_accountID='$accountID' AND tbn_userst.userST_siteID = '$siteID' GROUP BY `userST_houseID` ");
        }
        $i = 1;
        // $row_ = $site_stmt->fetch(PDO::FETCH_BOTH);
        foreach ($site_stmt as $row_) {
            // echo $url_link;
            // echo substr($row_["house_master"],0,3);
    ?>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4  col-xl-3">
            <a href="
                <?php 
                    // if(substr($row_["house_master"],0,3) == "TUS"){
                    //     echo $url_link .'/tu/#'.encode($row_["house_siteID"].','.$row_["house_master"]);
                    // }else{
                        echo $url_link .'#'.encode($row_["house_siteID"].','.$row_["house_master"]);
                    // } 
                ?>">
                <div class="card" style="padding: 1.25rem;  border-radius:20px">
                    <img src="<?php if($row_["house_img"] == ""){echo "public/images/default.jpg";}else{echo "public/images/house/".$row_["house_img"];} ?>" style="height: 20vh; width: 100%;" class="card-img-top img-fluid" alt="site01">
                    <!-- <div class="card"> -->
                    <h6 class="card-title text-bold text-center" style="margin-top: 15px">ชื่อ : <B><?= $row_["house_name"] ?></B></h6>
                    <h6 class="card-title text-bold text-center" style="margin-top: 10px">ขนาด : <B><?= substr($row_["house_size"],9,13) ?></B></h6>
                    <!-- <div class="d-grid" style="overflow:auto; padding-left:10px; padding-right:10px;" id="style-3"> -->
                    <?php 
                        echo '<h6 class="card-title text-bold text-center" style="margin-top: 10px">สถานะ : <B> ออนไลน์</B></h6>';
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