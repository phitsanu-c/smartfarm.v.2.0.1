<?php
    session_start();
    require "../../../routes/connectdb.php";
    
    $stmt = "UPDATE `tb2_login` SET `login_theme`=:theme WHERE `login_id`=:id";
    if ($dbcon->prepare($stmt)->execute([
        'theme' => $_POST["theme"],
        'id'=>$_SESSION['user_id']
    ]) === TRUE) {
// echo "OK";
    }else{echo "NO";}
    $_SESSION['login_theme'] = $_POST["theme"];
    echo $_SESSION['login_theme'];