<?php
require "connectdb.php";
$user_id = $_POST['user_id'];
$row = $dbcon->query("SELECT * FROM tbn_account WHERE account_id = '$user_id'")->fetch();
echo json_encode($row);
