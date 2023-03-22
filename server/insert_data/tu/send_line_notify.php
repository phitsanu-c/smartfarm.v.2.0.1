<?php
	require "../connectdb.php";
    $house_master = $_POST["sn"];
	$log_token = [];
	$houseID = $dbcon->query("SELECT `house_id`, `site_name`, `house_name` FROM `tbn_house` INNER JOIN `tbn_site` ON `tbn_house`.`house_siteID` = `tbn_site`.`site_id` WHERE `house_master` = '$house_master' ")->fetch();
	
	$stmt = $dbcon->query("SELECT `account_token` FROM tbn_account WHERE `account_status` = 1 ");
	while ($row = $stmt->fetch()) {
		if($row['account_token'] != ''){
			$log_token[] = $row['account_token'];
		}
	}
	if(isset($_POST['sensor'])){ // sensor bad
		$log_token[] = '61e0pHvm9ltj9jvtMD0Q7myN4b7wPqi4Su7o58toGeS'; // Token ส่วนตัวปิง
		$stmt_ = $dbcon->query("SELECT `account_token` FROM `tbn_userst` INNER JOIN `tbn_account` ON `tbn_userst`.`userST_accountID` = `tbn_account`.`account_id` WHERE `userST_houseID` = '$houseID[0]' AND `userST_level` < 3 ");
		while ($row_ = $stmt_->fetch()) {
			if($row_['account_token'] != ''){
				$log_token[] = $row_['account_token'];
			}
		}
		$dbcon->prepare("INSERT INTO `tbn_sensor_log`(`sensor_log_sn`, `sensor_log_name`, `sensor_log_status`) VALUES (:sn, :n, :st)")->execute([
			'sn' => $house_master,
			'n' => $_POST['sensor'],
			'st' => $_POST['status']
		]);
	}else{ // load
		$stmt_ = $dbcon->query("SELECT `account_token` FROM `tbn_userst` INNER JOIN `tbn_account` ON `tbn_userst`.`userST_accountID` = `tbn_account`.`account_id` WHERE `userST_houseID` = '$houseID[0]' ");
		while ($row_ = $stmt_->fetch()) {
			if($row_['account_token'] != ''){
				$log_token[] = $row_['account_token'];
			}
		}
	}

	// exit();
	$data2 = json_decode($_POST['output']);
	// json_decode(
	// $sMessage = '
	// สถานที่ : '.$houseID[1].'
	// โรงเรือน : '.$houseID[2].'
	// '.implode('
	// ',$data);
	// echo $sMessage;
	// exit();
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	// $sToken = "k8t5OsBmt9fKPJv0EP1lVC9tmD26gZnmAnFvsE2iIBo";
	// $sMessage = $channel1;
  // ================================================
  $Message = '
		สถานที่ : '.$houseID[1].'
		โรงเรือน : '.$houseID[2].'
	 '.implode('
	 ',$data2).'
		เวลา : '.date("Y-m-d H:i:s");
		$imageFile = new CURLFILE('/var/www/203.159.93.76/smartfarm/server/insert_data/tu/1.gif');
		
		// echo $sMessage;
		$data = array(
			'message' => $Message,
			// 'imageFile' => new CURLFILE('1.gif'),//$imageFile
			// 'stickerPackageId'=>$stickerPkg,
      // 		'stickerId'=>$stickerId
		);
  // ================================================
  // echo $Message;
  // exit();
	for($i=1; $i <= count($log_token); $i++){
		$chOne = curl_init();
  curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt( $chOne, CURLOPT_POST, 1);
  curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
  curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
			$headers = array( 'Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$log_token[$i-1].'', ); // 'Content-type: application/x-www-form-urlencoded'
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
  curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec( $chOne );
  //Check error
  if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
  else { $result_ = json_decode($result, true);
  echo "status : ".$result_['status']; echo " message : ". $result_['message']; 
  }
			curl_close( $chOne );
	}
?>
