
<?php require "connectdb.php"; ?>
<div class="page-breadcrumb d-flex align-items-center mb-1">
    <div class="ps-3 d-none d-sm-block">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a> </li>
                <li class="breadcrumb-item" aria-current="page">
                    <h5>Administrator</h5>
                </li>
            </ol>
        </nav>
    </div>

</div>
<!--end breadcrumb-->

<hr />
<!-- <div class="row"> -->
    <!-- <div class="col-12 d-flex"> -->
        <!-- <div class="card w-100 radius-10"> -->
            <!-- <div class="card-body"> -->
                <div class="card radius-10 border shadow-none">
                    <div class="card-body">
                        <!-- <h5 class="card-title text-center"><b>โรงเรือน ธรรมศาสตร์</b></h5> -->
                        <div class="row text-center">
                            <?php for ($i=1; $i < 9; $i++) { $sn = "TUSMT00".$i;
                                $sql = "SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE tbn_house.house_master = '$sn' ";
                                // echo $sql;
                                $stmt = $dbcon->query($sql);
                                while ($row = $stmt->fetch()) {echo '
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="card-body border radius-10 shadow-none mb-3">
                                            <div class="row">
                                                <h6 class="col-6">'.$row['house_name'].'</h6>
                                                <div class="col-6">
                                                    <h6 class="">SN : '.$row['house_master'].'</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Status : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_st_'.$i.'"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">User : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="am_user_'.$i.'"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Mode : </span>
                                                        </div>
                                                        <div class="col-6">
                                                        <span class="badge dash_Mmode'.$i.'"> </span>
                                                            <span class="badge dash_mode'.$i.'"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Panel : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="dash_panel_mode'.$i.'"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Dp 1 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_d1_'.$i.'">real</span>
                                                            <span class="badge img_dr1_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Fan 1 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_f1_'.$i.'">real</span>
                                                            <span class="badge img_fn1_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Dp 2 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_d2_'.$i.'">real</span>
                                                            <span class="badge img_dr2_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Fan 2 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_f2_'.$i.'">real</span>
                                                            <span class="badge img_fn2_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Dp 3 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_d3_'.$i.'">real</span>
                                                            <span class="badge img_dr3_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Fan 3 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_f3_'.$i.'">real</span>
                                                            <span class="badge img_fn3_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Dp 4 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_d4_'.$i.'">real</span>
                                                            <span class="badge img_dr4_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Fan 4 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_f4_'.$i.'">real</span>
                                                            <span class="badge img_fn4_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Fg 1(4ch) : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_fg1_'.$i.'">real</span>
                                                            <span class="badge img_fg1_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Sp(1ch) : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_sp_'.$i.'">real</span>
                                                            <span class="badge img_sp_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Fg 2(side) : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_fg2_'.$i.'">real</span>
                                                            <span class="badge img_fg2_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="">Slan : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_real_sl_'.$i.'">real</span>
                                                            <span class="badge img_sl_'.$i.' "></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="card radius-10 border shadow-none">
                    <div class="card-body">
                        <h5 class="card-title text-center"><b>โรงเรือน มจธ. และ อุบล</b></h5>
                        <div class="row text-center">
                            <?php
                                $sql2 = "SELECT * FROM tbn_house INNER JOIN tbn_site ON tbn_house.house_siteID = tbn_site.site_id WHERE tbn_house.house_master = 'KMUMT001' ";
                                // echo $sql;
                                $stmt2 = $dbcon->query($sql2);
                                while ($row2 = $stmt2->fetch()) {echo '
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="card-body border radius-10 shadow-none mb-3">
                                            <div class="row">
                                                <h6 class="col-6">'.$row2['house_name'].'</h6>
                                                <div class="col-6">
                                                    <h6 class="">SN : '.$row2['house_master'].'</h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Status : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge am_st_KMU"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Mode : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge dash_mode_KMU"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">User : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="am_user_KMU"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Dripper 1 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge img_dr1_KMU"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Foggy 1 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="img_fg1_KMU"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Dripper 2 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="badge img_dr2_KMU"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Foggy 2 : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="img_fg2_KMU"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span class="col-6">Slan : </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span class="img_sl_KMU"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';}
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="card-body border radius-10 shadow-none mb-3">
                                    <div class="row">
                                        <h6 class="col-6">อุบลฯ</h6>
                                        <div class="col-6">
                                            <h6 class="">SN : UBON250KW</h6>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="col-6">Status : </span>
                                            </div>
                                            <div class="col-6">
                                                <span class="badge am_st_ub"> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="col-6">Time : </span>
                                            </div>
                                            <div class="col-6">
                                                <span class="badge dash_time_ub"> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="col-6">User : </span>
                                            </div>
                                            <div class="col-6">
                                                <span class="am_user_KMU"></span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="col-6">Dripper 1 : </span>
                                            </div>
                                            <div class="col-6">
                                                <span class="badge img_dr1_KMU"> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="col-6">Foggy 1 : </span>
                                            </div>
                                            <div class="col-6">
                                                <span class="img_fg1_KMU"></span>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->
<!-- KMUMT001/1/control/control_st_5 on -->
<!-- KMUMT001/1/control/control_user Hardware -->
<!-- KMUMT001/1/control/mode off -->
