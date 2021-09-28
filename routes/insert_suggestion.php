<?php
    session_start();
    require "connectdb.php";
    
    // chack_mail
    if(!filter_var($_POST["sg_email"], FILTER_VALIDATE_EMAIL)){
        echo json_encode(['status' => "รูปแบบ email ไม่ถูกต้อง"], JSON_UNESCAPED_UNICODE );
        exit();
    }
    $data = [
        'p1' => $_POST["sg_name"],
        'p2' => $_POST["sg_tel"],
        'p3' => $_POST["sg_email"],
        'p4' => $_POST["sg_text"],
        'userID' => $_SESSION['user_id']

    ];
    $sql = "INSERT INTO `tb_suggestion`(`suggestion_name`, `suggestion_tel`, `suggestion_email`, `suggestion_text`, `suggestion_userID`) VALUES (:p1, :p2, :p3, :p4, :userID)";
    if ($dbcon->prepare($sql)->execute($data) === TRUE) {
        echo json_encode(['status' => "Insert_success"], JSON_UNESCAPED_UNICODE );
        exit();
    }else{
        echo json_encode(['status' => "Insert_Error",'tb'=>'tb_suggestion'], JSON_UNESCAPED_UNICODE );
        exit();
    }

    