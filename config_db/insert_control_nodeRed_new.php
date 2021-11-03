<?php
    // session_start();
    require 'connectdb.php';

    if(!isset($_POST["control_JSON"])){
        echo json_encode("No parseJSON");
    }else{
        // $parseJSON = $_POST["control_JSON"];
        $parseJSON = json_decode($_POST['control_JSON']);
        // $json2 = $parseJSON->mode;
        // echo $parseJSON;
        // exit();
        $sn = $parseJSON->control_sn;
        if(!isset( $parseJSON->dripper_1 )){    $dripper_1 = 'OFF';  }else{ $dripper_1  = $parseJSON->dripper_1; }
        if(!isset( $parseJSON->dripper_2 )){    $dripper_2 = 'OFF';  }else{ $dripper_2  = $parseJSON->dripper_2; }
        if(!isset( $parseJSON->dripper_3 )){    $dripper_3 = 'OFF';  }else{ $dripper_3  = $parseJSON->dripper_3; }
        if(!isset( $parseJSON->dripper_4 )){    $dripper_4 = 'OFF';  }else{ $dripper_4  = $parseJSON->dripper_4; }
        if(!isset( $parseJSON->dripper_5 )){    $dripper_5 = 'OFF';  }else{ $dripper_5  = $parseJSON->dripper_5; }
        if(!isset( $parseJSON->dripper_6 )){    $dripper_6 = 'OFF';  }else{ $dripper_6  = $parseJSON->dripper_6; }
        if(!isset( $parseJSON->dripper_7 )){    $dripper_7 = 'OFF';  }else{ $dripper_7  = $parseJSON->dripper_7; }
        if(!isset( $parseJSON->dripper_8 )){    $dripper_8 = 'OFF';  }else{ $dripper_8  = $parseJSON->dripper_8; }
        if(!isset( $parseJSON->foggy )){        $foggy = 'OFF';      }else{ $foggy      = $parseJSON->foggy; }
        if(!isset( $parseJSON->fan )){          $fan = 'OFF';        }else{ $fan        = $parseJSON->fan; }
        if(!isset( $parseJSON->shader )){       $shader = '0';       }else{ $shader     = $parseJSON->shader; }
        if(!isset( $parseJSON->fertilizer )){   $fertilizer = 'OFF'; }else{ $fertilizer = $parseJSON->fertilizer; }
        $dataA = [
            'siteID'      => $parseJSON->siteID,
            'houseID'     => $parseJSON->houseID,
            'control_user'=> $parseJSON->user_control,
            'mode'        => $parseJSON->Mode,
            'fertilizer'  => $fertilizer,
            'dripper_1'   => $dripper_1,
            'dripper_2'   => $dripper_2,
            'dripper_3'   => $dripper_3,
            'dripper_4'   => $dripper_4,
            'dripper_5'   => $dripper_5,
            'dripper_6'   => $dripper_6,
            'dripper_7'   => $dripper_7,
            'dripper_8'   => $dripper_8,
            'foggy'       => $foggy,
            'fan'         => $fan,
            'shader'      => $shader,
            'control_sn'  => $sn
        ];

        $stmt = $dbcon->prepare("SELECT * FROM `tb3_control` WHERE control_sn = '$sn'  ORDER BY `control_id` DESC limit 1");
        $stmt->execute();
        $data_array = array();
        $count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_BOTH);
        if($count > 0){
            $dataB = [
                'siteID'      => $row["control_siteID"],
                'houseID'     => $row["control_houseID"],
                'control_user'=> $row["control_user"],
                'mode'        => $row["control_mode"],
                'fertilizer'  => $row["control_fertilizer"],
                'dripper_1'   => $row["control_dripper_1"],
                'dripper_2'   => $row["control_dripper_2"],
                'dripper_3'   => $row["control_dripper_3"],
                'dripper_4'   => $row["control_dripper_4"],
                'dripper_5'   => $row["control_dripper_5"],
                'dripper_6'   => $row["control_dripper_6"],
                'dripper_7'   => $row["control_dripper_7"],
                'dripper_8'   => $row["control_dripper_8"],
                'foggy'       => $row["control_foggy"],
                'fan'         => $row["control_fan"],
                'shader'      => $row["control_shader"],
                'control_sn'  => $row["control_sn"]
            ];
            // echo json_encode($dataB);
            // exit();
            if($dataA != $dataB){
                // echo json_encode(["Data_A != Data_B"]);
                // exit();
                try{
                    $ins_cont = "INSERT INTO `tb3_control`(`control_siteID`, `control_houseID`, `control_user`, `control_mode`, `control_fertilizer`, `control_dripper_1`, `control_dripper_2`, `control_dripper_3`, `control_dripper_4`, `control_dripper_5`, `control_dripper_6`, `control_dripper_7`, `control_dripper_8`, `control_foggy`, `control_fan`, `control_shader`, `control_sn`)
                            VALUES (:siteID, :houseID, :control_user, :mode, :fertilizer, :dripper_1, :dripper_2, :dripper_3, :dripper_4, :dripper_5, :dripper_6, :dripper_7, :dripper_8, :fan, :foggy, :shader, :control_sn)";
                    if ($dbcon->prepare($ins_cont)->execute($dataA) === TRUE) {
                        echo json_encode(['status' => "OK",'data' => "Insert_Success - sn ".$sn ] , JSON_UNESCAPED_UNICODE );
                    }else{
                        echo json_encode(['status' => 'Error','data' => "Insert_Error - sn ".$sn ] , JSON_UNESCAPED_UNICODE );
                    }
                }catch(Exception $ex){
                    echo $ex->getMessage();
                }
            }else{
                echo json_encode(['status' => 'Data_A == Data_B - sn '.$sn ] , JSON_UNESCAPED_UNICODE );
            }
        }else{
            try{
                $ins_cont = "INSERT INTO `tb3_control`(`control_siteID`, `control_houseID`, `control_user`, `control_mode`, `control_fertilizer`, `control_dripper_1`, `control_dripper_2`, `control_dripper_3`, `control_dripper_4`, `control_dripper_5`, `control_dripper_6`, `control_dripper_7`, `control_dripper_8`, `control_foggy`, `control_fan`, `control_shader`, `control_sn`)
                        VALUES (:siteID, :houseID, :control_user, :mode, :fertilizer, :dripper_1, :dripper_2, :dripper_3, :dripper_4, :dripper_5, :dripper_6, :dripper_7, :dripper_8, :fan, :foggy, :shader, :control_sn)";
                if ($dbcon->prepare($ins_cont)->execute($dataA) === TRUE) {
                    echo json_encode(['status' => "OK",'data' => "Insert_Success - sn ".$sn ] , JSON_UNESCAPED_UNICODE );
                }else{
                    echo json_encode(['status' => 'Error','data' => "Insert_Error - sn ".$sn ] , JSON_UNESCAPED_UNICODE );
                }
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }

    }