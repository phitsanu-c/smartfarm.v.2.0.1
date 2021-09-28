<?php
    session_start();
    require "connectdb.php";
    require_once "../public/plugins/PHPMailer/PHPMailer.php";
    require_once "../public/plugins/PHPMailer/SMTP.php";
    require_once "../public/plugins/PHPMailer/Exception.php";
    use PHPMailer\PHPMailer\PHPMailer;
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
        $mail = new PHPMailer();

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.office365.com";
        $mail->SMTPAuth = true;
        $mail->Username = "tanagorn.e@fuji-innovation.com"; // enter your email address
        $mail->Password = "Playboy032-4"; // enter your password
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("support@fuji-innovation.com", "Fuji Support");
        $mail->addAddress("tanagorn.e@fuji-innovation.com"); // Send to mail
        $mail->addAddress("theerasak.s@fuji-innovation.com"); // Send to mail
        $mail->addAddress("phitsanu.c@fuji-innovation.com"); // Send to mail
        $mail->addAddress("kittiphat.b@fuji-innovation.com"); // Send to mail
        $mail->addAddress("nunn98842@gmail.com"); // Send to mail
        $mail->addReplyTo($_POST["sg_email"], $_POST["sg_name"]);
        $mail->Subject = "<b>ปัญหาและข้อเสนอแนะ</b>";
        // $mail->Body = $_POST["sg_text"];

        $mail->msgHTML("
                        <b>ผู้ส่ง : </b>".$_POST["sg_name"]."<br /> 
                        <b>เบอร์ติดต่อ : </b>".$_POST["sg_tel"]."<br />
                        <b>อีเมลล์ผู้ส่ง : </b>".$_POST["sg_email"]."<br /> <br /> 
                        <b>หัวข้อ : </b>".$_POST["sg_title"]." <br /> 
                        <b>ข้อความ : </b>".$_POST["sg_text"]."<br /> ");

        $mail->CharSet = 'UTF-8';

        if($mail->send()) {
            $status = "success";
            $response = "Email was sented";
            echo json_encode(['status' => "Insert_success","status_Email" => $status, "response" => $response], JSON_UNESCAPED_UNICODE );
            exit();
        } else {
            $status = "failed";
            $response = "Something is wrong" . $mail->ErrorInfo;
            echo json_encode(['status' => "Insert_success", "status_Email" => $status, "response" => $response], JSON_UNESCAPED_UNICODE );
            exit();
        }
    }else{
        echo json_encode(['status' => "Insert_Error",'tb'=>'tb_suggestion'], JSON_UNESCAPED_UNICODE );
        exit();
    }


