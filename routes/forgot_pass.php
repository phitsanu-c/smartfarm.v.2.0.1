<?php
    // session_start();
    require "connectdb.php";
    // use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "../public/plugins/PHPMailer/PHPMailer.php";
    require_once "../public/plugins/PHPMailer/SMTP.php";
    require_once "../public/plugins/PHPMailer/Exception.php";

    // use PHPMailer\PHPMailer\PHPMailer;

    $post_email = $_POST["email"];
    $chack_email = $dbcon->query("SELECT COUNT('account_id') FROM tbn_account WHERE account_email = '$post_email' ")->fetch();
    if($chack_email[0] == 0){
        echo json_encode(['status' => "No email"], JSON_UNESCAPED_UNICODE );
        exit();
    }else{
        $row = $dbcon->query("SELECT * FROM tbn_account WHERE account_email = '$post_email' ")->fetch();

        $mail = new PHPMailer();

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.office365.com";
        $mail->SMTPAuth = true;
        $mail->Username = "phitsanu.c@fuji-innovation.com"; // enter your email address
        $mail->Password = "Tt@67235520"; // enter your password
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("support@fuji-innovation.com", "Support Smart Greenhouse");
        $mail->addAddress($post_email); // Send to mail

        // $mail->addReplyTo($_POST["sg_email"], $_POST["sg_name"]);
        $mail->Subject = "แจ้งข้อมูลรหัสผ่าน";
        // $mail->Body = $_POST["sg_text"];

        $mail->msgHTML("
                        <b>ข้อมูลของคุณ </b> <br/>
                        <b>Username : </b>".$row["account_user"]."<br />
                        <b>Password : </b>".$row["account_pa"]."<br /> <br /> ");

        $mail->CharSet = 'UTF-8';

        if($mail->send()) {
            $status = "success";
            $response = "Email was sented";
            echo json_encode(['status' => "success","status_Email" => $status, "response" => $response], JSON_UNESCAPED_UNICODE );
            exit();
        } else {
            $status = "failed";
            $response = "Something is wrong " . $mail->ErrorInfo;
            echo json_encode(['status' => "success", "status_Email" => $status, "response" => $response], JSON_UNESCAPED_UNICODE );
            exit();
        }
exit();
        // ---------------------------------------------
        require_once "../public/plugins/PHPMailer/PHPMailer.php";
        require_once "../public/plugins/PHPMailer/SMTP.php";
        require_once "../public/plugins/PHPMailer/Exception.php";

        $mail = new PHPMailer();

        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "innovationfuji@gmail.com"; // enter your email address
        $mail->Password = "FujiInc1-108"; // enter your password
        $mail->Port = 465;
        $mail->SMTPSecure = "stl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("innovationfuji@gmail.com", "Support Smart Greenhouse");
        $mail->addAddress($post_email); // Send to mail
        $mail->Subject = "แจ้งข้อมูลรหัสผ่าน";
        $mail->Body = '$detail';
        // $mail->msgHTML("
        //                 <b>ข้อมูลของคุณ </b> <br/>
        //                 <b>Username : </b>".$row["account_user"]."<br />
        //                 <b>Password : </b>".$row["account_pa"]."<br /> <br /> ");

        if($mail->send()) {
            $status = "success";
            $response = "Email was sented";
        } else {
            $status = "failed";
            $response = "Something is wrong " . $mail->ErrorInfo;
        }
        echo json_encode(array("status" => $status, "response" => $response));
    }
    // response: "Something is wrongSMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting"
