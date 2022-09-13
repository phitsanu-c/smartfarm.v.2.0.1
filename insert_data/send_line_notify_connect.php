<?php
	require "connectdb.php";
    $house_master = $_POST["sn"];
	$status = $_POST["status"];
	$log_token = [];
	
	$df_status = $dbcon->query("SELECT `hw_connect_status` FROM `tbn_hardware_connect` WHERE `hw_connect_sn` = '$house_master' ORDER BY hw_connect_timestamp DESC LIMIT 1")->fetch();
	if($df_status == '' || $status != $df_status[0]){
		$dbcon->prepare("INSERT INTO `tbn_hardware_connect`( `hw_connect_timestamp`, `hw_connect_sn`, `hw_connect_status`) VALUES (:p1, :p2, :p3)")->execute(['p1' => $_POST['date'], 'p2' => $house_master, 'p3' => $status]);

		// exit();
		$houseID = $dbcon->query("SELECT `house_id`, `site_name`, `house_name` FROM `tbn_house` INNER JOIN `tbn_site` ON `tbn_house`.`house_siteID` = `tbn_site`.`site_id` WHERE `house_master` = '$house_master' ")->fetch();
		
		$stmt = $dbcon->query("SELECT `account_token` FROM tbn_account WHERE `account_status` = 1 ");
		while ($row = $stmt->fetch()) {
			if($row['account_token'] != ''){
				$log_token[] = $row['account_token'];
			}
		}
		$stmt_ = $dbcon->query("SELECT `account_token` FROM `tbn_userst` INNER JOIN `tbn_account` ON `tbn_userst`.`userST_accountID` = `tbn_account`.`account_id` WHERE `userST_houseID` = '$houseID[0]' ");
		while ($row_ = $stmt_->fetch()) {
			if($row_['account_token'] != ''){
				$log_token[] = $row_['account_token'];
			}
		}

		$log_token[] = '61e0pHvm9ltj9jvtMD0Q7myN4b7wPqi4Su7o58toGeS'; // Token ส่วนตัวปิง
		// $data = json_decode($_POST['output']);
		// json_decode(
		$Message = '
		สถานที่ : '.$houseID[1].'
		โรงเรือน : '.$houseID[2].'
		สถานะ : '.$status;
		// $imageFile = new CURLFILE('t1.png');
		if($status == 'online'){
			$stickerPkg = 2; //stickerPackageId
			$stickerId = 34; //stickerId
		}else{
			$stickerPkg = 2; //stickerPackageId
			$stickerId = 38; //stickerId
		}
		// echo $sMessage;
		$data = array(
			'message' => $Message,
			// 'imageFile' => $imageFileม
			'stickerPackageId'=>$stickerPkg,
      		'stickerId'=>$stickerId
		);
		// ==================================================
	
		// ==================================================
		// exit();
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
		date_default_timezone_set("Asia/Bangkok");

		// $sToken = "vPy3g8GZTGET0D29RLFzQpChusxwMVPiDqG1nv94qbw";
		// $sMessage = $channel1;

		for($i=1; $i <= count($log_token); $i++){
			$chOne = curl_init();
			curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt( $chOne, CURLOPT_POST, 1);
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
			$headers = array( 'Content-type: multipart/form-data', 'Authorization: Bearer '.$log_token[$i-1].'', ); // 'Content-type: application/x-www-form-urlencoded'
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec( $chOne );

			//Result error
			if(curl_error($chOne))
			{
				echo 'error:' . curl_error($chOne);
			}
			else {
				if($i == count($log_token)){
					$result_ = json_decode($result, true);
					echo "status : ".$result_['status']; echo "message : ". $result_['message'];
				}
			}
			curl_close( $chOne );
		}
	}
	else{
		echo 'sum';
	}
	
?>
