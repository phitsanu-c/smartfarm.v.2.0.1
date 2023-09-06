<div class="page-content">
    <!--breadcrumb-->
    <!-- <div class="page-breadcrumb d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item" aria-current="page"> การเจริญเติบโตของพืช </li>
                </ol>
            </nav>
        </div>
    </div> -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-1">
        <div class="breadcrumb-title pe-3 d-none d-sm-block">
                <h5> การเจริญเติบโตของพืช </h5>
            </div>
            <div class="ps-3 d-none d-sm-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="-alt"></i></a> </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <h5 id="name_change_spr"></h5>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    <hr/>
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card w-100 radius-10">
            <div class="card-body">
                <button type="button" class="col-3 btn btn-outline-secondary px-2 view_sprout">เลือกรายการ</button>
                <div class="chartdiv" id="chart_sprout" style="color: black;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_sprout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title"><b>เลือกข้อมูลที่ต้องการ</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 d-flex">
                        <div class="card-body border radius-10 shadow-none mb-3">
                            <select class="form-select mb-3" id="val_plant">
                                <option value="0">เลือกชนิดพืช</option>
                                <?php
                                    require('../connectdb.php');
                                    $stmtt = $dbcon->query("SELECT * FROM `tbn_plant_name` ");
                                    while ($row_spr = $stmtt->fetch()) {
                                        echo '<option value="'.$row_spr[0].'" n_name="'.$row_spr[2].'">'.$row_spr[2].'</option>';
                                    }
                                ?>
							</select>
                            <input type="hidden" id="val_colp" value="4">
                            <!-- <select class="form-select mb-3" id="val_colp"><option selected="0">เลือกคอล์ป</option></select> -->
                            <div class="form-check">
                                <h5>
                                    <input type="checkbox" class="form-check-input" id="checkbox_all_spr" checked>
                                    <label class="form-check-label">เลือกทั้งหมด</label>
                                    <input type="hidden" id="count_checkbox_spr" value="5">
                                </h5>
                                <!-- <label class="form-check-label">sssss </label> -->
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="checkbox_spr[]" value="0" onchange="spr_check_all($(this))">
                                    <label class="form-check-label">ความสูง</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="checkbox_spr[]" value="1" onchange="spr_check_all($(this))">
                                    <label class="form-check-label">ความกว้างทรงพุ่ม</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="checkbox_spr[]" value="2" onchange="spr_check_all($(this))">
                                    <label class="form-check-label">จำนวนใบ</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="checkbox_spr[]" value="3" onchange="spr_check_all($(this))">
                                    <label class="form-check-label">พื้นที่ใบ</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" name="checkbox_spr[]" value="4" onchange="spr_check_all($(this))">
                                    <label class="form-check-label">น้ำหนักสดต้น</label>
                                </div>
                                <!-- <hr/> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" id="submit_sprout" class="btn btn-success waves-light">
                    <i class="fadeIn animated bx bx-check"></i> ตกลง
                </button>
                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">
                    <i class="fadeIn animated bx bx-window-close"></i> ยกเลิก
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.view_sprout').click(function(){
        $('#modal_sprout').modal('show');
        // $('#Modal_select_sn').modal('show');
    });
    $('#submit_sprout').click(function(){
        // alert($('#val_plant').val())
        if ($('#val_plant').val() == 0) {
            $('#val_plant').addClass('is-invalid')
            return false;
        }
        $('#val_plant').removeClass('is-invalid')
        if ($('#val_colp').val() == 0) {
            $('#val_colp').addClass('is-invalid')
            return false;
        }
        $('#val_colp').removeClass('is-invalid');
        let checked = [], name_val = [];
        if($('#checkbox_all_spr').prop('checked') == true){
            for (var i = 0; i < 5; i++) {
                checked.push(i);
                if(i == 0){
                    name_val.push('ความสูง (cm)');
                }else if(i == 1){
                    name_val.push('ความกว้างทรงพุ่ม (cm)');
                }else if(i == 2){
                    name_val.push('จำนวนใบ (ใบ)');
                }else if(i == 3){
                    name_val.push('พื้นที่ใบ (cm<sup>2</sup>)');
                }else if(i == 4){
                    name_val.push('น้ำหนักสดต้น (g)');
                }
            }
        }
        else {
            $("input[name='checkbox_spr[]']:checked").map(function (){
                if($(this).prop('checked') == true){
                    checked.push($(this).val());
                    if($(this).val() == 0){
                        name_val.push('ความสูง (cm)');
                    }else if($(this).val() == 1){
                        name_val.push('ความกว้างทรงพุ่ม (cm)');
                    }else if($(this).val() == 2){
                        name_val.push('จำนวนใบ (ใบ)');
                    }else if($(this).val() == 3){
                        name_val.push('พื้นที่ใบ (cm<sup>2</sup>)');
                    }else if($(this).val() == 4){
                        name_val.push('น้ำหนักสดต้น (g)');
                    }
                }
            });
        }
        if(checked.length < 1){
            Swal({
                'type': "warning",
                'html': "ระบุข้อมูลที่ต้องการ",
                'allowOutsideClick': false
            });
            return false;
        }
        // console.log(name_val);
        // console.log(checked.toString());
        // console.log(name_val.length);
        // alert($('option:selected', $('#val_plant')).attr('n_name'))
        // return false
        // let loading = verticalNoTitle();
        $('#chart_sprout').html('')
        let options = {
            chart: {
                // id: 'line',
                foreColor: '#9ba7b2',
                height: 560,
                type: 'line',
                // toolbar: {
                //     show: true,
                //     tools: {
                //         download: true,
                //         selection: true,
                //          zoom: true,
                //          zoomin: true,
                //          zoomout: true,
                //          pan: true,
                //     }
                // },
                // dropShadow: {
                //     enabled: true,
                //     top: 3,
                //     left: 2,
                //     blur: 4,
                //     opacity: 0.1,
                // }
                dropShadow: {
                    enabled: true,
                    color: '#000',
                    top: 18,
                    left: 7,
                    blur: 10,
                    opacity: 0.2
                },
                toolbar: {
                    show: false
                }
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            // colors: ["#85583F", '#00FF00','#0000FF', '#FFFF00', '#FF0000', '#9400D3', '#00FFFF','#406E1C'],
            // series: [{
            //   data: data.slice()
            // }],
            series: [],
            // [{
            //     name: "temp_out",
            //     data: res.data.temp_out//[1, 15, 56, 20, 33, 27]
            // }, {
            //     name: "temp_in",
            //     data: res.data.temp_in//[30, 33, 21, 42, 19, 32]
            // }],
            // title: {
            //     text: 'การเจริญเติบโตของพืช',
            //     align: 'left',
            //     offsetY: 30,
            //     // offsetX: 20
            // },
            animations: {
              enabled: true,
              easing: 'linear',
              // dynamicAnimation: {
              //   speed: 1000
              // }
            },
            markers: {
                size: 2,
                strokeWidth: 0,
                hover: {
                    size: 7
                }
            },
            grid: {
                show: true,
                padding: {
                    bottom: 0
                }
            },
            xaxis: {
                // type: 'datetime',
                // // categories:res.data.timestamp,
                // labels: {
                //     datetimeUTC: false,
                //     // format: 'dd/MM HH:mm',
                //     datetimeFormatter: {
                //         year: 'yyyy',
                //         month: 'MMM \'yy',
                //         day: 'dd MMM',
                //         hour: 'HH:mm'
                //     }
                // }
            },
            legend: {
                // position: 'top',
                // horizontalAlign: 'right',
                // offsetY: -30
            },
            fill: {
                type: "solid",
                fillOpacity: 0.7
            },
            noData: {
                text: 'Loading...'
            },
            // tooltip: {
            //     x: {
            //         format: 'yyyy-MM-dd HH:mm'
            //     },
            // },
        }
        let chart = new ApexCharts(document.querySelector('#chart_sprout'), options);
        chart.render();
        $.ajax({
            type: "POST",
            url: "routes/tu/get_spr_chart.php",
            data: {
                's_id': $('#val_plant').val(),
                // 'colp': $('#val_colp').val(),
                'val': checked,
            },
            dataType: 'json',
            success: function(res) {
                $('#modal_sprout').modal('hide');
                $('#name_change_spr').html($('option:selected', $('#val_plant')).attr('n_name'))
                // console.log(res);
                let Series_ = []
                // column_tb.push({title: "วัน-เวลา"})
                // alert(name_val.length)
                // console.log(name_val);
                for(var i = 0; i < name_val.length; i++){
                    Series_.push({name: name_val[i], data: res['data_'+(i+1)]})
                }
                console.log(Series_);
                chart.updateSeries(Series_)
                chart.updateOptions({
                    xaxis: {
                        categories: res.timestamp,
                        title: {
                           text: 'วันหลังปลูก'
                        }
                    },
                   //  yaxis: {
                   //     max: 100
                   // },
                   title:  {text: 'การเจริญเติบโตของ '+$('option:selected', $('#val_plant')).attr('n_name')},
                   tooltip: {
                       y: {
                           formatter: function (val) {
                               return  val //+ unit
                           }
                       }
                   }
                });
                // loadingOut(loading);
            }
        });
    })
    spr_check_all2()
    $('#checkbox_all_spr').click(function(){
        spr_check_all2()
        if($(this).prop( "checked") == true){
            $('#count_checkbox_spr').val(5)
        }else {
            $('#count_checkbox_spr').val(0)
        }
    });
    $('#val_plant').change(function(){
        $.get('routes/tu/get_corp_sel.php?id='+$(this).val(),function(req){
            $('#val_colp').html(req);
        });
    });
    function spr_check_all(thiss){
        // alert(thiss.prop('checked'))
        // alert($('#count_checkbox_spr').val())
        if(thiss.prop('checked') == true){
            if($('#count_checkbox_spr').val() == 0){
                $('#count_checkbox_spr').val(1)
            }else {
                $('#count_checkbox_spr').val(parseInt($('#count_checkbox_spr').val() ) +1)
            }
        }else {
            if($('#count_checkbox_spr').val() != 0){
                $('#count_checkbox_spr').val( parseInt( $('#count_checkbox_spr').val() ) -1)
            }
        }
        // $('#aa').html($('#count_checkbox_spr').val())
        if($('#count_checkbox_spr').val() == 5){
            $('#checkbox_all_spr').prop( "checked", true );
        }else {
            $('#checkbox_all_spr').prop( "checked", false );
        }
    }
    function spr_check_all2(){
        if($('#checkbox_all_spr').prop( "checked") == true){
            $("input[name='checkbox_spr[]']").prop( "checked", true );
        }else {
            $("input[name='checkbox_spr[]']").prop( "checked", false );
        }
    }

</script>
