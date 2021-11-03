<?php
    // session_start();
    require 'connectdb.php';

    if(!isset($_POST["control_JSON"])){
        echo json_encode("No parseJSON");
    }else{
        // $parseJSON = $_POST["control_JSON"];
        $parseJSON = json_decode($_POST['control_JSON']);
        // $json2 = $parseJSON->mode;
        // echo $json2;
        if($parseJSON->mode == "off"){
            $mode = "Manual";
        }else{
            $mode = "Auto";
        }
        $sn = $parseJSON->sn;
        $dataA = [
            'siteID'      => $parseJSON->siteID,
            'houseID'     => $parseJSON->houseID,
            'control_user'=> $parseJSON->user,
            'mode'        => $mode,
            'fertilizer'  => 'OFF',
            'dripper_1'   => $parseJSON->ch_1,
            'dripper_2'   => $parseJSON->ch_2,
            'dripper_3'   => $parseJSON->ch_3,
            'dripper_4'   => $parseJSON->ch_4,
            'dripper_5'   => $parseJSON->ch_5,
            'dripper_6'   => 'OFF',
            'dripper_7'   => 'OFF',
            'dripper_8'   => 'OFF',
            'foggy'       => 'OFF',
            'fan'         => 'OFF',
            'shader'      => '0',
            'control_sn'  => $sn
        ];

        $sql = $dbcon->prepare("SELECT * FROM `tb3_control` WHERE control_sn = '$sn'  ORDER BY `control_id` DESC limit 1");
        $sql->execute();
        $data_array = array();
        $row = $sql->fetch(PDO::FETCH_BOTH);
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

    }