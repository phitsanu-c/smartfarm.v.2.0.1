<?php
    // ไม่ได้ใช้
    $channel = $_POST['channel'];
    $num = $_POST['num'];
    $cycle = $_POST['cycle'];
    $time_s = $_POST['time_s'];
    $on = $_POST['on'];
    $off = $_POST['off'];
    // $array = $_POST['array'];
    echo json_encode([
        'channel' => $channel,
        'num' => $num,
        'cycle' => $cycle,
        'time_s' => $time_s,
        'on' => $on,
        'off' => $off,
    ]);
    exit();

    // for ($channel=1; $channel < 7; $channel++) {

            for ($v = 1; $v <= $cycle[$channel]; $v++) {
                if($num[$v] != ''){
                    if($num[$v] == 0){
                        if($v == 1){
                            $decode2['P_'.$channel]['s_'.$v] = date("H:i:s", strtotime($time_s[$channel] ));
                            $decode2['P_'.$channel]['e_'.$v] = date("H:i:s", strtotime($decode2['P_'.$channel]['s_'.$v].+$on[$channel].'seconds'));
                        }else {
                            $decode2['P_'.$channel]['s_'.$v] = date("H:i:s", strtotime($decode2['P_'.$channel]['e_'.floor($v-1)].+$off[$channel].'seconds'));//;
                            $decode2['P_'.$channel]['e_'.$v] = date("H:i:s", strtotime($decode2['P_'.$channel]['s_'.$v].+$on[$channel].'seconds'));
                        }
                    }else { //$num != 0
                        if($v == 1){
                            $decode2['P_'.$channel]['s_'.($v+$num[$channel])] = date("H:i:s", strtotime($time_s[$channel]));
                            $decode2['P_'.$channel]['e_'.($v+$num[$channel])] = date("H:i:s", strtotime($decode2['P_'.$channel]['s_'.($v+$num[$channel])].+$on[$channel].'seconds'));
                        }else {
                            $decode2['P_'.$channel]['s_'.($v+$num[$channel])] = date("H:i:s", strtotime($decode2['P_'.$channel]['e_'.floor(($v+$num[$channel])-1)].+$off[$channel].'seconds'));//;
                            $decode2['P_'.$channel]['e_'.($v+$num[$channel])] = date("H:i:s", strtotime($decode2['P_'.$channel]['s_'.($v+$num[$channel])].+$on[$channel].'seconds'));
                        }
                    }
                }else {

                }
            }
        // $decode['load_'.$channel] = $decode2;
    // }
    echo json_encode($decode2);
?>
