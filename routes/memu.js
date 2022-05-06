$(".memu_site").click(function() {
    $(this).addClass('mm-active');
    $("#load_pages").load('views/pages_site.php');
    if(house_master === '' || house_master.length != 8){ 
        $(".memu_house").hide();
    }else{
        $(".memu_house").removeClass("mm-active")
    }
});
$(".memu_house").click(function() {
    $(this).addClass('mm-active');
    $("#load_pages").load('views/pages_house.php?s='+url[0]);
    // if(house_master === '' || house_master.length != 8){ 
    //     $(".memu_house").hide();
    // }else{
    //     $(".memu_house").removeClass("mm-active")
    // }
});
$(".memu_dash").click(function() {
    $(this).addClass('mm-active');
    if (house_master.length == 8) {
        $(".memu_dash").show().addClass("mm-active");
        $(".memu_report").show();
        if(house_master.substring(0, 3) != "TUS"){
            if (house_master !== "KMUMT001") {
                $(".title_km").html("ประวัติการตั้งเวลา");
            } else {
                $(".title_km").html("ประวัติการตั้งค่าโหมดอัตโนมัติ");
            }
            // return false;
            $.ajax({
                url: "routes/get_dash.php",
                method: "post",
                data: {
                    house_master: house_master
                },
                dataType: "json",
                success: function(res) {
                    console.log(res);

                    //     }
                    // });
                    // $.ajax({
                    //     url: "http://localhost:3001/get_dash/dash/",
                    //     method: "post",
                    //     data: {
                    //         house_master: house_master,
                    //         field2: 2
                    //     },
                    //     // contentType: "application/json",
                    //     success: function(res) {
                    //         console.log(res);
                    var dashStatus = res.dashStatus;
                    var dashName = res.dashName;
                    var dashSncanel = res.dashSncanel;
                    var dashMode = res.dashMode;
                    var dashImg = res.dashImg;
                    var dashUnit = res.dashUnit;
                    var controlStatus = res.controlstatus;
                    var imgCon = res.imgCon;

                    var meter_status = res.meter_status;
                    var meter_chenal = res.meter_chenal;
                    var meterImg = res.meterImg;
                    var meterUnit = res.meterUnit;
                    var time_update = res.time_update;

                    function getArraySum(a) {
                        // count array
                        var total = 0;
                        for (var i in a) {
                            total += a[i];
                        }
                        return total;
                    }

                    var array_realChT = [];
                    var array_realnameT = [];
                    var array_realChH = [];
                    var array_realnameH = [];
                    var array_realChS = [];
                    var array_realnameS = [];
                    var array_realChL = [];
                    var array_realnameL = [];
                    var array_realChP = [];
                    var array_realnameP = [];
                    var temp_c = [];
                    var hum_c = [];
                    var light_c = [];
                    var soil_c = [];
                    var power_c = [];
                    var unit_T = [];
                    var unit_H = [];
                    var unit_S = [];
                    var unit_L = [];
                    var unit_P = [];
                    for (var i = 1; i <= 40; i++) {
                        if (dashStatus[i] == 1) {
                            if (dashMode[i] == 1) {
                                temp_c.push(1);
                                array_realChT.push(dashSncanel[i]);
                                array_realnameT.push(dashName[i]);
                                unit_T.push("℃");
                            } else if (dashMode[i] == 2) {
                                hum_c.push(1);
                                array_realChH.push(dashSncanel[i]);
                                array_realnameH.push(dashName[i]);
                                unit_H.push("%Rh");
                            } else if (dashMode[i] == 3) {
                                soil_c.push(1);
                                array_realChS.push(dashSncanel[i]);
                                array_realnameS.push(dashName[i]);
                                unit_H.push("%");
                            } else if (dashMode[i] == 4 || dashMode[i] == 5) {
                                light_c.push(1);
                                if (house_master !== "KMUMT001") {
                                    array_realChL.push(dashSncanel[i] + "/1000");
                                } else {
                                    array_realChL.push(dashSncanel[i]);
                                }
                                array_realnameL.push(dashName[i]);
                                unit_L.push("KLux");
                            } else if (dashMode[i] == 6 || dashMode[i] == 7) {
                                light_c.push(1);
                                array_realChL.push(dashSncanel[i] + "/54");
                                array_realnameL.push(dashName[i]);
                                unit_L.push("µmol m[baseline-shift: super; font-size: 10;]-2[baseline-shift: baseline;]s[baseline-shift: super; font-size: 10;]-1[baseline-shift: baseline;]");
                            } else if (dashMode[i] == 10) {
                                power_c.push(1);
                                array_realChP.push(dashSncanel[i]);
                                array_realnameP.push("กำลังไฟฟ้า");
                                unit_P.push("W");
                            }
                        }
                    }


                    var count_stcont = getArraySum(controlStatus);
                    var meter_count = getArraySum(meter_status);
                    // alert(login_user);
                    $.ajax({
                        url: "views/pagex_dashboard.php",
                        method: "post",
                        data: {
                            s_master: res.s_master,
                            dashStatus: dashStatus,
                            dashName: dashName,
                            count_stcont: count_stcont,
                            controlstatus: controlStatus,
                            conttrolname: res.conttrolname,
                            ingMap: res.ingMap,
                            meter_count: meter_count,
                            meter_status: meter_status,
                            s_btnT: getArraySum(temp_c),
                            s_btnH: getArraySum(hum_c),
                            s_btnS: getArraySum(soil_c),
                            s_btnL: getArraySum(light_c)
                        },
                        // dataType: "json",
                        success: function(res_dash) {
                            $("#load_pages").html(res_dash);

                            chack_realtime();

                            function chack_realtime() {
                                am4core.ready(function() {
                                    // ++++++--------+++++++++
                                    // Global variables
                                    var client = null;
                                    // These are configs
                                    var hostname = "203.150.37.144"; //'103.2.115.15'; // 203.150.37.144   decccloud.com
                                    var port = "8083";
                                    var clientId = "mqtt_js_37074" + parseInt(Math.random() * 100000, 10);
                                    var count = 0;

                                    function connect() {
                                        client = new Paho.MQTT.Client(hostname, Number(port), clientId);
                                        console.info('Connecting to Server: Hostname: ', hostname, '. Port: ', port, '. Client ID: ', clientId);

                                        client.onConnectionLost = onConnectionLost;
                                        client.onMessageArrived = onMessageArrived;

                                        var options = {
                                            onSuccess: onConnect, // after connected, subscribes
                                            onFailure: onFail // useful for logging / debugging
                                        };
                                        // connect the client
                                        client.connect(options);
                                        console.info('Connecting...');
                                    }
                                    // ---------------------------------------------------------------------------------------

                                    function onConnect(context) {
                                        console.log("Client Connected");
                                        // And subscribe to our topics	-- both with the same callback function
                                        options = {
                                            qos: 1,
                                            onSuccess: function(context) {
                                                // console.log("ไม่สามารถเชื่อมต่อกับ เครื่อง ได้ !!!!");
                                                // setInterval(function() {
                                                //     location.reload();
                                                // }, 30000);
                                                console.log("subscribed");
                                            }
                                        }
                                        client.subscribe(house_master + "/1/data_update/data_filter", options);
                                        // if (Contstatus !== 0) {

                                        if (house_master !== "KMUMT001") {
                                            client.subscribe(house_master + "/1/control/json_control_filter", options);
                                        } else {
                                            client.subscribe(house_master + "/1/control/mode", options);
                                            client.subscribe(house_master + "/1/control/control_st_1", options);
                                            client.subscribe(house_master + "/1/control/control_st_2", options);
                                            client.subscribe(house_master + "/1/control/control_st_3", options);
                                            client.subscribe(house_master + "/1/control/control_st_4", options);
                                            client.subscribe(house_master + "/1/control/control_st_5", options);
                                        }
                                    }

                                    function onFail(context) {
                                        location.reload();
                                    }

                                    function onConnectionLost(responseObject) {
                                        if (responseObject.errorCode !== 0) {
                                            console.log("Connection Lost: " + responseObject.errorMessage);
                                            connect();
                                            // location.reload();
                                            // window.alert("Someone else took my websocket!\nRefresh to take it back.");
                                        }
                                    }
                                    // +++++++++------------+++++++++++
                                    const myArr = res.theme.split(" ");
                                    // alert(myArr[0])
                                    if (myArr[0] === "dark-theme") {
                                        am4core.useTheme(am4themes_dark);
                                    }
                                    am4core.useTheme(am4themes_animated);
                                    var chart = am4core.create("chart_realtime", am4charts.XYChart);
                                    chart.dateFormatter.inputDateFormat = "yyyy/MM/dd - HH:mm";

                                    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                                    dateAxis.periodChangeDateFormats.setKey("hour", "[bold]dd MMM ");
                                    dateAxis.tooltipDateFormat = "HH:mm, d MMM yyyy";

                                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                                    // alert($(".btn_ch_t").hasClass("active"))
                                    if ($(".btn_ch_t").hasClass("active") == true) {
                                        var array_realCh = array_realChT;
                                        var array_realname = array_realnameT;
                                        var unit = unit_T;
                                    }
                                    if ($(".btn_ch_h").hasClass("active") == true) {
                                        var array_realCh = array_realChH;
                                        var array_realname = array_realnameH;
                                        var unit = unit_H;
                                    }
                                    if ($(".btn_ch_s").hasClass("active") == true) {
                                        var array_realCh = array_realChS;
                                        var array_realname = array_realnameS;
                                        var unit = unit_S;
                                    }
                                    if ($(".btn_ch_l").hasClass("active") == true) {
                                        var array_realCh = array_realChL;
                                        var array_realname = array_realnameL;
                                        var unit = unit_L;
                                    }
                                    if ($(".btn_ch_p").hasClass("active") == true) {
                                        var array_realCh = array_realChP;
                                        var array_realname = array_realnameP;
                                        var unit = unit_P;
                                    }
                                    var new_array_realCh = [];
                                    // alert(array_realCh.length)
                                    for (var a = 1; a <= array_realCh.length; a++) {
                                        new_array_realCh.push('round(' + array_realCh[(a - 1)] + ', 1) AS new_' + a);
                                    }
                                    console.log([
                                        'nn', $(".btn_ch_l").hasClass("active"),
                                        new_array_realCh
                                    ]);
                                    // return false
                                    $.ajax({
                                        url: 'routes/get_chart_realtime.php',
                                        method: "post",
                                        data: {
                                            house_master: house_master,
                                            array_realCh: new_array_realCh,
                                            array_realname: array_realname
                                        },
                                        dataType: "json",
                                        success: function(res_chart) {
                                            if (res_chart.theme === "dark-theme") {
                                                am4core.useTheme(am4themes_dark);
                                            }
                                            // $("#chart_realtime").addClass("");
                                            console.log(res_chart)
                                            chart.data = res_chart.data;

                                            var series = [];
                                            for (var i = 1; i <= array_realCh.length; i++) {
                                                series[i] = chart.series.push(new am4charts.LineSeries());
                                                series[i].dataFields.valueY = "new_" + i;
                                                series[i].dataFields.dateX = "data_timestamp";
                                                series[i].tooltipText = array_realname[i - 1] + " {new_" + i + "} (" + unit[i - 1] + ")";
                                                series[i].name = array_realname[i - 1];
                                                series[i].strokeWidth = 2;


                                            }
                                        }
                                    });

                                    chart.cursor = new am4charts.XYCursor();
                                    // chart.cursor.snapToSeries = series;
                                    chart.cursor.xAxis = dateAxis;

                                    chart.scrollbarX = new am4core.Scrollbar();
                                    chart.scrollbarX.parent = chart.bottomAxesContainer;
                                    // Add legend
                                    chart.legend = new am4charts.Legend();
                                    chart.legend.itemContainers.template.events.on("over", function(event) {
                                        var segments = event.target.dataItem.dataContext.segments;
                                        segments.each(function(segment) {
                                            segment.isHover = true;
                                        })
                                    })

                                    chart.legend.itemContainers.template.events.on("out", function(event) {
                                        var segments = event.target.dataItem.dataContext.segments;
                                        segments.each(function(segment) {
                                            segment.isHover = false;
                                        })
                                    })

                                    // ------zzz
                                    function onMessageArrived(message) {
                                        if (message.destinationName == house_master + "/1/data_update/data_filter") {
                                            var result = message.payloadString;
                                            var parseJSON = $.parseJSON(result);
                                            // console.log(parseJSON);
                                            if (house_master === "KMUMT001") {
                                                var p_json = parseJSON['data_update']['data'][0];
                                                var data_array = p_json['data'];
                                                // console.log(parseJSON);
                                                console.log(data_array);

                                                // console.log(loading);
                                                // -------------------------------------------------------------
                                                var chart_timestamp = p_json['date_time'];
                                                var time_t = p_json['time'];
                                                var ntime = time_t.substring(0, 5);
                                                $(".date").html(p_json['date']);
                                                $(".time").html(ntime);
                                                // --------------------------------------substring(1, 4)
                                                // console.log(Sncanel.sncanel_1_1.substring(7));
                                                // $("#time_stamp").html("Data update : "+time_stmap);
                                                // return false;
                                                let strdate = new Date();
                                                var strNdate = moment(new Date()).add(-10, 'minutes').format('YYYY/MM/DD');
                                                if (time_update != "false"){
                                                    if (time_update.substring(0, 10) == strNdate || p_json['date'] == strNdate) {
                                                        $(".status_timeUpdate").removeClass("text-danger").addClass("text-success").html("ออนไลน์")
                                                    } else {
                                                        $(".status_timeUpdate").removeClass("text-success").addClass("text-danger").html("ออฟไลน์")
                                                    }
                                                }
                                                
                                            } else {
                                                // console.log(loading);// != KMUMT001
                                                // -------------------------------------------------------------
                                                var chart_timestamp = parseJSON['date_time'];
                                                var time_t = parseJSON['time'];
                                                var ntime = time_t.substring(0, 5);
                                                $(".date").html(parseJSON['date']);
                                                $(".time").html(ntime);
                                                // var data_array = parseJSON['data_update']['data'][0]['data'];
                                                var data_array = parseJSON['data'];
                                                let strdate = new Date();
                                                var strNdate = moment(new Date()).add(-10, 'minutes').format('YYYY/MM/DD');
                                                if (time_update != false){
                                                    if (time_update.substring(0, 10) == strNdate || parseJSON['date'] == strNdate) {
                                                        $(".status_timeUpdate").removeClass("text-danger").addClass("text-success").html("ออนไลน์")
                                                    } else {
                                                        $(".status_timeUpdate").removeClass("text-success").addClass("text-danger").html("ออฟไลน์")
                                                    }
                                                }
                                                
                                                // alert(time_update.substring(0, 10) + ' ' + parseJSON['date'] + " " + strNdate)
                                            }
                                            // console.log(parseJSON);
                                            // console.log(dashImg[1]);

                                            var sn_unit = [];
                                            var data_dash = [];
                                            var new_chart = [];
                                            for (var i = 1; i <= 40; i++) {
                                                if (dashStatus[i] == 1) {
                                                    $(".dash_img_" + i).attr("src", "public/images/Sensor/" + dashImg[i]);

                                                    // show_dash(unit = dashUnit[i],snmode = dashMode[i]);
                                                    if (house_master !== "KMUMT001") {
                                                        if (dashMode[i] === "7") { // µmol / KLux
                                                            $(".dash_data_1_" + i).html((data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>' + '<br>' + (data_array[dashSncanel[i]] / 1000).toFixed(1) + " KLux");
                                                        } else if (dashMode[i] === "6") {
                                                            $(".dash_data_1_" + i).html((data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>');
                                                        } else if (dashMode[i] === "5") {
                                                            $(".dash_data_1_" + i).html((data_array[dashSncanel[i]] / 1000).toFixed(1) + " KLux" + '<br>' + (data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>');
                                                        } else {
                                                            if (data_array[dashSncanel[i]] >= 1000) {
                                                                data_dash[i] = (data_array[dashSncanel[i]] / 1000).toFixed(1);
                                                                sn_unit[i] = 'K' + dashUnit[i];
                                                            } else if (data_array[dashSncanel[i]] >= 1000000) {
                                                                data_dash[i] = (data_array[dashSncanel[i]] / 1000).toFixed(1);
                                                                sn_unit[i] = 'M' + dashUnit[i];
                                                            } else {
                                                                data_dash[i] = (data_array[dashSncanel[i]] * 1).toFixed(1);
                                                                if (dashUnit[i] === "1") {
                                                                    sn_unit[i] = "℃";
                                                                } else {
                                                                    sn_unit[i] = dashUnit[i];
                                                                }
                                                                $(".dash_data_1_" + i).html(data_dash[i] + " " + sn_unit[i]);
                                                            }
                                                        }
                                                        // ++++++++++
                                                        if ($(".btn_ch_t").hasClass("active") == true) {
                                                            if (dashMode[i] === "1") {
                                                                new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_h").hasClass("active") == true) {
                                                            if (dashMode[i] === "2") {
                                                                new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_s").hasClass("active") == true) {
                                                            if (dashMode[i] === "3") {
                                                                new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_l").hasClass("active") == true) {
                                                            if (dashMode[i] === "4" || dashMode[i] === "5") {
                                                                new_chart.push((data_array[dashSncanel[i]] / 1000).toFixed(1));
                                                            }
                                                            if (dashMode[i] === "6" || dashMode[i] === "7") {
                                                                new_chart.push((data_array[dashSncanel[i]] / 54).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_p").hasClass("active") == true) {
                                                            if (dashMode[i] === "10") {
                                                                new_chart.push((data_array[dashSncanel[i]] * 1).toFixed(1));
                                                            }
                                                        }
                                                    } else { //=== KMUMT001
                                                        if (dashMode[i] === "7") { // µmol / KLux
                                                            $(".dash_data_1_" + i).html((data_array["data_st" + dashSncanel[i].substring(7)] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>' + '<br>' + (data_array[dashSncanel[i]] / 1000).toFixed(1) + " KLux");
                                                        } else if (dashMode[i] === "6") {
                                                            $(".dash_data_1_" + i).html((data_array["data_st" + dashSncanel[i].substring(7)] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>');
                                                        } else if (dashMode[i] === "5") {
                                                            $(".dash_data_1_" + i).html((data_array["data_st" + dashSncanel[i].substring(7)] / 1000).toFixed(1) + " KLux" + '<br>' + (data_array[dashSncanel[i]] / 54).toFixed(1) + ' µmol m<sup>-2</sup>s<sup>-1</sup>');
                                                        } else if (dashMode[i] === "4") {
                                                            $(".dash_data_1_" + i).html((data_array["data_st" + dashSncanel[i].substring(7)]).toFixed(1) + " KLux");
                                                        } else {
                                                            if (data_array["data_st" + dashSncanel[i].substring(7)] >= 1000) {
                                                                data_dash[i] = (data_array["data_st" + dashSncanel[i].substring(7)] / 1000).toFixed(1);
                                                                sn_unit[i] = 'K' + dashUnit[i];
                                                            } else if (data_array["data_st" + dashSncanel[i].substring(7)] >= 1000000) {
                                                                data_dash[i] = (data_array["data_st" + dashSncanel[i].substring(7)] / 1000).toFixed(1);
                                                                sn_unit[i] = 'M' + dashUnit[i];
                                                            } else {
                                                                data_dash[i] = (data_array["data_st" + dashSncanel[i].substring(7)] * 1).toFixed(1);
                                                                if (dashUnit[i] === "1") {
                                                                    sn_unit[i] = "℃";
                                                                } else {
                                                                    sn_unit[i] = dashUnit[i];
                                                                }
                                                                $(".dash_data_1_" + i).html(data_dash[i] + " " + sn_unit[i]);
                                                            }
                                                        }
                                                        // ++++++++++
                                                        if ($(".btn_ch_t").hasClass("active") == true) {
                                                            if (dashMode[i] === "1") {
                                                                new_chart.push((data_array["data_st" + dashSncanel[i].substring(7)] * 1).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_h").hasClass("active") == true) {
                                                            if (dashMode[i] === "2") {
                                                                new_chart.push((data_array["data_st" + dashSncanel[i].substring(7)] * 1).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_s").hasClass("active") == true) {
                                                            if (dashMode[i] === "3") {
                                                                new_chart.push((data_array["data_st" + dashSncanel[i].substring(7)] * 1).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_l").hasClass("active") == true) {
                                                            if (dashMode[i] === "4" || dashMode[i] === "5") {
                                                                new_chart.push((data_array["data_st" + dashSncanel[i].substring(7)]).toFixed(1));
                                                            }
                                                            if (dashMode[i] === "6" || dashMode[i] === "7") {
                                                                new_chart.push((data_array["data_st" + dashSncanel[i].substring(7)] / 54).toFixed(1));
                                                            }
                                                        }
                                                        if ($(".btn_ch_p").hasClass("active") == true) {
                                                            if (dashMode[i] === "10") {
                                                                new_chart.push((data_array["data_st" + dashSncanel[i].substring(7)] * 1).toFixed(1));
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            if (meter_count != 0) {
                                                if (meter_status[1] == 1) {
                                                    $(".dash_img_v").attr("src", "public/images/Sensor/" + meterImg['Img_v']);
                                                    $(".dash_data_v").html(data_array[meter_chenal[1]].toFixed(1) + " " + meterUnit['Unit_v']);
                                                }
                                                if (meter_status[2] == 1) {
                                                    $(".dash_img_a").attr("src", "public/images/Sensor/" + meterImg['Img_a']);
                                                    $(".dash_data_a").html(data_array[meter_chenal[2]].toFixed(2) + " " + meterUnit['Unit_a']);
                                                }
                                                if (meter_status[3] == 1) {
                                                    $(".dash_img_p").attr("src", "public/images/Sensor/" + meterImg['Img_p']);
                                                    $(".dash_data_p").html(data_array[meter_chenal[3]].toFixed(2) + " " + meterUnit['Unit_p']);
                                                }
                                                if (meter_status[4] == 1) {
                                                    $(".dash_img_pf").attr("src", "public/images/Sensor/" + meterImg['Img_pf']);
                                                    $(".dash_data_pf").html(data_array[meter_chenal[4]].toFixed(2));
                                                }
                                                if (meter_status[5] == 1) {
                                                    $(".dash_img_engy").attr("src", "public/images/Sensor/" + meterImg['Img_engy']);
                                                    $(".dash_data_engy").html(data_array[meter_chenal[5]].toFixed(2) + " " + meterUnit['Unit_engy']);
                                                }
                                                if (meter_status[6] == 1) {
                                                    $(".dash_img_wc").attr("src", "public/images/Sensor/" + meterImg['Img_wc']);
                                                    $(".dash_data_wc").html(data_array[meter_chenal[6]].toFixed(2) + " " + meterUnit['Unit_wc']);
                                                }
                                                if (meter_status[7] == 1) {
                                                    $(".dash_img_wp").attr("src", "public/images/Sensor/" + meterImg['Img_wp']);
                                                    $(".dash_data_wp").html(data_array[meter_chenal[7]].toFixed(2) + " " + meterUnit['Unit_wp']);
                                                }
                                                if (meter_status[8] == 1) {
                                                    $(".dash_img_wd").attr("src", "public/images/Sensor/wind-direction1.png");
                                                    $(".dash_data_wd").html('ตะวันออก');
                                                }
                                            }

                                            // $('.weather-temperature').openWeather({
                                            //     key: 'c9d49310f8023ee2617a7634de23c2aa',
                                            //     lat: '13.576', //res.s_master.site_Latitude, //site_Longitude
                                            //     lng: '100.442', //res.s_master.site_Longitude,
                                            //     // city: 'Los Angeles',
                                            //     descriptionTarget: '.weather-description',
                                            //     windSpeedTarget: '.weather-wind-speed',
                                            //     minTemperatureTarget: '.weather-min-temperature',
                                            //     maxTemperatureTarget: '.weather-max-temperature',
                                            //     humidityTarget: '.weather-humidity',
                                            //     sunriseTarget: '.weather-sunrise',
                                            //     sunsetTarget: '.weather-sunset',
                                            //     placeTarget: '.weather-place',
                                            //     iconTarget: '.weather-icon',
                                            //     customIcons: 'public/plugins/open-weather-master/src/img/icons/weather/',
                                            //     success: function(data) {
                                            //         // show weather
                                            //         $('.weather-wrapper').show();
                                            //         console.log(data);
                                            //     },
                                            //     error: function(data) {
                                            //         console.log(data.error);
                                            //         $('.weather-wrapper').remove();
                                            //     }
                                            // });
                                            // alert(res.s_master.site_Longitude)

                                            // var new_chart2 = [];
                                            // new_chart2.push(chart_timestamp);
                                            // for (var s = 1; s <= array_realCh.length; s++) {
                                            //     new_chart2.push({
                                            //         ['new_' + s]: new_chart[s - 1]
                                            //     });
                                            // }
                                            console.log('new_chart=' + new_chart.length)
                                                // console.log(new_chart)
                                            if (new_chart.length == 1) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                });
                                            } else if (new_chart.length == 2) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                });
                                            } else if (new_chart.length == 2) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                });
                                            } else if (new_chart.length == 3) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                });
                                            } else if (new_chart.length == 4) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                });
                                            } else if (new_chart.length == 5) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                });
                                            } else if (new_chart.length == 6) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                });
                                            } else if (new_chart.length == 7) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                });
                                            } else if (new_chart.length == 8) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7]
                                                });
                                            } else if (new_chart.length == 9) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8]
                                                });
                                            } else if (new_chart.length == 10) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9]
                                                });
                                            } else if (new_chart.length == 11) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10]
                                                });
                                            } else if (new_chart.length == 12) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11]
                                                });
                                            } else if (new_chart.length == 13) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12]
                                                });
                                            } else if (new_chart.length == 14) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13]
                                                });
                                            } else if (new_chart.length == 15) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14]
                                                });
                                            } else if (new_chart.length == 16) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15]
                                                });
                                            } else if (new_chart.length == 17) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16]
                                                });
                                            } else if (new_chart.length == 18) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17]
                                                });
                                            } else if (new_chart.length == 19) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18]
                                                });
                                            } else if (new_chart.length == 20) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18],
                                                    new_20: new_chart[19]
                                                });
                                            } else if (new_chart.length == 21) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18],
                                                    new_20: new_chart[19],
                                                    new_21: new_chart[20]
                                                });
                                            } else if (new_chart.length == 22) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18],
                                                    new_20: new_chart[19],
                                                    new_21: new_chart[20],
                                                    new_22: new_chart[21]
                                                });
                                            } else if (new_chart.length == 23) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18],
                                                    new_20: new_chart[19],
                                                    new_21: new_chart[20],
                                                    new_22: new_chart[21],
                                                    new_23: new_chart[22]
                                                });
                                            } else if (new_chart.length == 24) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18],
                                                    new_20: new_chart[19],
                                                    new_21: new_chart[20],
                                                    new_22: new_chart[21],
                                                    new_23: new_chart[22],
                                                    new_24: new_chart[23]
                                                });
                                            } else if (new_chart.length == 25) {
                                                chart.addData({
                                                    data_timestamp: chart_timestamp,
                                                    new_1: new_chart[0],
                                                    new_2: new_chart[1],
                                                    new_3: new_chart[2],
                                                    new_4: new_chart[3],
                                                    new_5: new_chart[4],
                                                    new_6: new_chart[5],
                                                    new_7: new_chart[6],
                                                    new_8: new_chart[7],
                                                    new_9: new_chart[8],
                                                    new_10: new_chart[9],
                                                    new_11: new_chart[10],
                                                    new_12: new_chart[11],
                                                    new_13: new_chart[12],
                                                    new_14: new_chart[13],
                                                    new_15: new_chart[14],
                                                    new_16: new_chart[15],
                                                    new_17: new_chart[16],
                                                    new_18: new_chart[17],
                                                    new_19: new_chart[18],
                                                    new_20: new_chart[19],
                                                    new_21: new_chart[20],
                                                    new_22: new_chart[21],
                                                    new_23: new_chart[22],
                                                    new_24: new_chart[23],
                                                    new_25: new_chart[24]
                                                });
                                            }
                                            console.log(chart.data)
                                                // else if (new_chart.length == 40) {
                                                //     chart.addData({
                                                //         data_timestamp: chart_timestamp,
                                                //         new_1: new_chart[0],
                                                //         new_2: new_chart[1],
                                                //         new_3: new_chart[2],
                                                //         new_4: new_chart[3],
                                                //         new_5: new_chart[4],
                                                //         new_6: new_chart[5],
                                                //         new_7: new_chart[6],
                                                //         new_8: new_chart[7],
                                                //         new_9: new_chart[8],
                                                //         new_10: new_chart[9],
                                                //         new_11: new_chart[10],
                                                //         new_12: new_chart[11],
                                                //         new_13: new_chart[12],
                                                //         new_14: new_chart[13],
                                                //         new_15: new_chart[14],
                                                //         new_16: new_chart[15],
                                                //         new_17: new_chart[16],
                                                //         new_18: new_chart[17],
                                                //         new_19: new_chart[18],
                                                //         new_20: new_chart[19],
                                                //         new_21: new_chart[20],
                                                //         new_22: new_chart[21],
                                                //         new_23: new_chart[22],
                                                //         new_24: new_chart[23],
                                                //         new_25: new_chart[24],
                                                //         new_26: new_chart[25],
                                                //         new_27: new_chart[26],
                                                //         new_28: new_chart[27],
                                                //         new_29: new_chart[28],
                                                //         new_30: new_chart[29],
                                                //         new_31: new_chart[30],
                                                //         new_32: new_chart[31],
                                                //         new_33: new_chart[32],
                                                //         new_34: new_chart[33],
                                                //         new_35: new_chart[34],
                                                //         new_36: new_chart[35],
                                                //         new_37: new_chart[36],
                                                //         new_38: new_chart[37],
                                                //         new_39: new_chart[38],
                                                //         new_40: new_chart[39]
                                                //     });
                                                // }
                                        }
                                        // control
                                        if (house_master !== "KMUMT001") {
                                            if (message.destinationName == house_master + "/1/control/json_control_filter") {
                                                // alert(count_stcont)
                                                // return false;
                                                if (count_stcont !== 0) {
                                                    var result = message.payloadString;
                                                    var parseJSON = $.parseJSON(result);
                                                    var data_array = parseJSON.control_status;
                                                    console.log(parseJSON);

                                                    if (data_array.Mode === "Auto") { //Auto
                                                        $(".sw_mode_Manual").removeClass("active");
                                                        $(".sw_mode_Auto").addClass("active");
                                                        $(".sw_manual").hide();
                                                        $(".sw_auto").show();
                                                    } else if (data_array.Mode === "Manual") {
                                                        $(".sw_mode_Auto").removeClass("active");
                                                        $(".sw_mode_Manual").addClass("active");
                                                        $(".sw_manual").show();
                                                        $(".sw_auto").hide();
                                                    }
                                                    // alert(imgCon['drip_1'][1])
                                                    // dripper_1
                                                    if (controlStatus[1] == 1) {
                                                        if (data_array.dripper_1 === "OFF") {
                                                            $(".dash_img_con_1").attr("src", "public/images/control/" + imgCon['drip_1'][1]);
                                                            $(".sw_manual_1").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_1").attr("src", "public/images/control/" + imgCon['drip_1'][0]);
                                                            $(".sw_manual_1").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_1", c_dash = data_array.dripper_1, c_img_off = imgCon['drip_1'][1], c_img_on = imgCon['drip_1'][0], ch = '1');
                                                    }

                                                    // dripper_2
                                                    if (controlStatus[2] == 1) {
                                                        if (data_array.dripper_2 === "OFF") {
                                                            $(".dash_img_con_2").attr("src", "public/images/control/" + imgCon['drip_2'][1]);
                                                            $(".sw_manual_2").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_2").attr("src", "public/images/control/" + imgCon['drip_2'][0]);
                                                            $(".sw_manual_2").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_2", c_dash = data_array.dripper_2, c_img_off = imgCon['drip_2'][1], c_img_on = imgCon['drip_2'][0], ch = '2');
                                                    }
                                                    // dripper_3
                                                    if (controlStatus[3] == 1) {
                                                        if (data_array.dripper_3 === "OFF") {
                                                            $(".dash_img_con_3").attr("src", "public/images/control/" + imgCon['drip_3'][1]);
                                                            $(".sw_manual_3").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_3").attr("src", "public/images/control/" + imgCon['drip_3'][0]);
                                                            $(".sw_manual_3").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_3", c_dash = data_array.dripper_3, c_img_off = imgCon['drip_3'][1], c_img_on = imgCon['drip_3'][0], ch = '3');
                                                    }
                                                    // dripper_4
                                                    if (controlStatus[4] == 1) {
                                                        if (data_array.dripper_4 === "OFF") {
                                                            $(".dash_img_con_4").attr("src", "public/images/control/" + imgCon['drip_4'][1]);
                                                            $(".sw_manual_4").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_4").attr("src", "public/images/control/" + imgCon['drip_4'][0]);
                                                            $(".sw_manual_4").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_4", c_dash = data_array.dripper_4, c_img_off = imgCon['drip_4'][1], c_img_on = imgCon['drip_4'][0], ch = '4');
                                                    }
                                                    // dripper_5
                                                    if (controlStatus[5] == 1) {
                                                        if (data_array.dripper_5 === "OFF") {
                                                            $(".dash_img_con_5").attr("src", "public/images/control/" + imgCon['drip_5'][1]);
                                                            $(".sw_manual_5").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_5").attr("src", "public/images/control/" + imgCon['drip_5'][0]);
                                                            $(".sw_manual_5").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_5", c_dash = data_array.dripper_5, c_img_off = imgCon['drip_5'][1], c_img_on = imgCon['drip_5'][0], ch = '5');
                                                    }
                                                    // dripper_6
                                                    if (controlStatus[6] == 1) {
                                                        if (data_array.dripper_6 === "OFF") {
                                                            $(".dash_img_con_6").attr("src", "public/images/control/" + imgCon['drip_6'][1]);
                                                            $(".sw_manual_6").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_6").attr("src", "public/images/control/" + imgCon['drip_6'][0]);
                                                            $(".sw_manual_6").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_6", c_dash = data_array.dripper_6, c_img_off = imgCon['drip_6'][1], c_img_on = imgCon['drip_6'][0], ch = '6');
                                                    }
                                                    // dripper_7
                                                    if (controlStatus[7] == 1) {
                                                        if (data_array.dripper_7 === "OFF") {
                                                            $(".dash_img_con_7").attr("src", "public/images/control/" + imgCon['drip_7'][1]);
                                                            $(".sw_manual_7").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_7").attr("src", "public/images/control/" + imgCon['drip_7'][0]);
                                                            $(".sw_manual_7").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_7", c_dash = data_array.dripper_7, c_img_off = imgCon['drip_7'][1], c_img_on = imgCon['drip_7'][0], ch = '7');
                                                    }
                                                    // dripper_8
                                                    if (controlStatus[8] == 1) {
                                                        if (data_array.dripper_8 === "OFF") {
                                                            $(".dash_img_con_8").attr("src", "public/images/control/" + imgCon['drip_8'][1]);
                                                            $(".sw_manual_8").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_8").attr("src", "public/images/control/" + imgCon['drip_8'][0]);
                                                            $(".sw_manual_8").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_8", c_dash = data_array.dripper_8, c_img_off = imgCon['drip_8'][1], c_img_on = imgCon['drip_8'][0], ch = '8');
                                                    }
                                                    // foggy
                                                    if (controlStatus[9] == 1) {
                                                        if (data_array.foggy === "OFF") {
                                                            $(".dash_img_con_9").attr("src", "public/images/control/" + imgCon['foggy'][1]);
                                                            $(".sw_manual_9").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_9").attr("src", "public/images/control/" + imgCon['foggy'][0]);
                                                            $(".sw_manual_9").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_9", c_dash = data_array.foggy, c_img_off = imgCon['foggy'][1], c_img_on = imgCon['foggy'][0], ch = '9');
                                                    }
                                                    // fan
                                                    if (controlStatus[10] == 1) {
                                                        if (data_array.fan === "OFF") {
                                                            $(".dash_img_con_10").attr("src", "public/images/control/" + imgCon['fan'][1]);
                                                            $(".sw_manual_10").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_10").attr("src", "public/images/control/" + imgCon['fan'][0]);
                                                            $(".sw_manual_10").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_10", c_dash = data_array.fan, c_img_off = imgCon['fan'][1], c_img_on = imgCon['fan'][1], ch = '10');
                                                    }

                                                    //Slan
                                                    if (controlStatus[11] == 1) {
                                                        if (data_array.shader === "0") {
                                                            $(".dash_img_con_11").attr("src", "public/images/control/" + imgCon['shader'][0], ch = '11');
                                                        } else if (data_array.shader === "1") {
                                                            $(".dash_img_con_11").attr("src", "public/images/control/" + imgCon['shader'][1], ch = '11');
                                                        } else if (data_array.shader === "2") {
                                                            $(".dash_img_con_11").attr("src", "public/images/control/" + imgCon['shader'][2], ch = '11');
                                                        } else if (data_array.shader === "3") {
                                                            $(".dash_img_con_11").attr("src", "public/images/control/" + imgCon['shader'][3], ch = '11');
                                                        } else if (data_array.shader === "4") {
                                                            $(".dash_img_con_11").attr("src", "public/images/control/" + imgCon['shader'][4], ch = '11');
                                                        }

                                                        // modal_manual
                                                        if (data_array["shader"] == 0) {
                                                            var shader_slw = "0 : ปิด 100%";
                                                            $(".sw_shader0").addClass("active");
                                                            $(".sw_shader1").removeClass("active");
                                                            $(".sw_shader2").removeClass("active");
                                                            $(".sw_shader3").removeClass("active");
                                                            $(".sw_shader4").removeClass("active");
                                                        }
                                                        if (data_array["shader"] == 1) {
                                                            var shader_slw = "1 : เปิด 25%";
                                                            $(".sw_shader0").removeClass("active");
                                                            $(".sw_shader1").addClass("active");
                                                            $(".sw_shader2").removeClass("active");
                                                            $(".sw_shader3").removeClass("active");
                                                            $(".sw_shader4").removeClass("active");
                                                        }
                                                        if (data_array["shader"] == 2) {
                                                            var shader_slw = "2 : เปิด 50%";
                                                            $(".sw_shader0").removeClass("active");
                                                            $(".sw_shader1").removeClass("active");
                                                            $(".sw_shader2").addClass("active");
                                                            $(".sw_shader3").removeClass("active");
                                                            $(".sw_shader4").removeClass("active");
                                                        }
                                                        if (data_array["shader"] == 3) {
                                                            var shader_slw = "3 : เปิด 75%";
                                                            $(".sw_shader0").removeClass("active");
                                                            $(".sw_shader1").removeClass("active");
                                                            $(".sw_shader2").removeClass("active");
                                                            $(".sw_shader3").addClass("active");
                                                            $(".sw_shader4").removeClass("active");
                                                        }
                                                        if (data_array["shader"] == 4) {
                                                            var shader_slw = "4 : เปิด 100%";
                                                            $(".sw_shader0").removeClass("active");
                                                            $(".sw_shader1").removeClass("active");
                                                            $(".sw_shader2").removeClass("active");
                                                            $(".sw_shader3").removeClass("active");
                                                            $(".sw_shader4").addClass("active");
                                                        }
                                                        $(".shader_slw").html(shader_slw);
                                                    } else {
                                                        $(".dash_c11").hide();
                                                    }

                                                    // fertilizer
                                                    if (controlStatus[12] == 1) {
                                                        if (data_array.fertilizer === "OFF") {
                                                            $(".dash_img_con_12").attr("src", "public/images/control/" + imgCon['fertilizer'][1]);
                                                            $(".sw_manual_12").bootstrapToggle('off');
                                                        } else {
                                                            $(".dash_img_con_12").attr("src", "public/images/control/" + imgCon['fertilizer'][0]);
                                                            $(".sw_manual_12").bootstrapToggle('on');
                                                        }
                                                        // cont_dash_show(img_c = "dash_img_con_12", c_dash = data_array.fertilizer, c_img_off = imgCon['fertilizer'][1], c_img_on = imgCon['fertilizer'][0], ch = '12');
                                                    }

                                                    function cont_dash_show(img_c, c_dash, c_img_off, c_img_on, ch) {
                                                        console.log(c_dash)
                                                        if (c_dash === "OFF") {
                                                            $("." + img_c).attr("src", "public/images/control/" + c_img_off);
                                                            $(".sw_manual_" + ch).bootstrapToggle('on');
                                                        } else if (c_dash === "ON") {
                                                            $("." + img_c).attr("src", "public/images/control/" + c_img_on);
                                                            $(".sw_manual_1").bootstrapToggle('on');
                                                        }
                                                    }
                                                }
                                            }
                                        } else { // KMUMT001
                                            // mode_Auto_Manual
                                            if (message.destinationName == "KMUMT001/1/control/mode") {
                                                var cont_status = message.payloadString;
                                                if (cont_status === "on") { //Auto
                                                    $(".sw_mode_Manual").removeClass("active");
                                                    $(".sw_mode_Auto").addClass("active");
                                                    $(".sw_manual").hide();
                                                    $(".sw_auto").show();
                                                } else {
                                                    $(".sw_mode_Auto").removeClass("active");
                                                    $(".sw_mode_Manual").addClass("active");
                                                    $(".sw_manual").show();
                                                    $(".sw_auto").hide();
                                                }
                                            }
                                            // mode_Control_1
                                            if (controlStatus[1] == 1) {
                                                if (message.destinationName == "KMUMT001/1/control/control_st_1") {
                                                    var cont_status = message.payloadString;
                                                    if (cont_status === "off") {
                                                        $(".dash_img_con_1").attr("src", "public/images/control/" + imgCon['drip_1'][1]);
                                                        $(".sw_manual_1").bootstrapToggle('off');
                                                    } else {
                                                        $(".dash_img_con_1").attr("src", "public/images/control/" + imgCon['drip_1'][0]);
                                                        $(".sw_manual_1").bootstrapToggle('on');
                                                    }
                                                }
                                            }

                                            // mode_Control_2
                                            if (controlStatus[2] == 1) {
                                                if (message.destinationName == "KMUMT001/1/control/control_st_2") {
                                                    var cont_status = message.payloadString;
                                                    if (cont_status === "off") {
                                                        $(".dash_img_con_2").attr("src", "public/images/control/" + imgCon['drip_2'][1]);
                                                        $(".sw_manual_2").bootstrapToggle('off');
                                                    } else {
                                                        $(".dash_img_con_2").attr("src", "public/images/control/" + imgCon['drip_2'][0]);
                                                        $(".sw_manual_2").bootstrapToggle('on');
                                                    }
                                                }
                                            }
                                            // mode_Control_3
                                            if (controlStatus[3] == 1) {
                                                if (message.destinationName == "KMUMT001/1/control/control_st_3") {
                                                    var cont_status = message.payloadString;
                                                    if (cont_status === "off") {
                                                        $(".dash_img_con_3").attr("src", "public/images/control/" + imgCon['drip_3'][1]);
                                                        $(".sw_manual_3").bootstrapToggle('off');
                                                    } else {
                                                        $(".dash_img_con_3").attr("src", "public/images/control/" + imgCon['drip_3'][0]);
                                                        $(".sw_manual_3").bootstrapToggle('on');
                                                    }
                                                }
                                            }
                                            // mode_Control_4
                                            if (controlStatus[4] == 1) {
                                                if (message.destinationName == "KMUMT001/1/control/control_st_4") {
                                                    var cont_status = message.payloadString;
                                                    if (cont_status === "off") {
                                                        $(".dash_img_con_4").attr("src", "public/images/control/" + imgCon['drip_4'][1]);
                                                        $(".sw_manual_4").bootstrapToggle('off');
                                                    } else {
                                                        $(".dash_img_con_4").attr("src", "public/images/control/" + imgCon['drip_4'][0]);
                                                        $(".sw_manual_4").bootstrapToggle('on');
                                                    }
                                                }
                                            }

                                            // mode_Control_5
                                            if (controlStatus[5] == 1) {
                                                if (message.destinationName == "KMUMT001/1/control/control_st_5") {
                                                    var cont_status = message.payloadString;
                                                    if (cont_status === "off") {
                                                        $(".dash_img_con_5").attr("src", "public/images/control/" + imgCon['drip_5'][1]);
                                                        $(".sw_manual_5").bootstrapToggle('off');
                                                    } else {
                                                        $(".dash_img_con_5").attr("src", "public/images/control/" + imgCon['drip_5'][0]);
                                                        $(".sw_manual_5").bootstrapToggle('on');
                                                    }
                                                }
                                            }
                                        }
                                    } // exit_message
                                    connect();
                                    // ------zz
                                });
                            }
                            $(".btn_ch_t").click(function() {
                                chack_realtime();
                            });
                            $(".btn_ch_h").click(function() {
                                chack_realtime();
                            });
                            $(".btn_ch_s").click(function() {
                                chack_realtime();
                            });
                            $(".btn_ch_l").click(function() {
                                chack_realtime();
                            });
                            // ----------------------------------------------------------------------



                        }
                    });
                    // Report ------------------
                    // $(".memu_report").click(function() {
                    $(".te_st").html(res.s_master.site_name);
                    $(".te_ht").html(res.s_master.house_name);
                    $.ajax({
                        url: "views/report_sensor.php",
                        method: "post",
                        data: {
                            house_master: house_master,
                            dashStatus: res.dashStatus,
                            dashName: res.dashName,
                            dashSncanel: res.dashSncanel,
                            dashMode: res.dashMode,
                            dashUnit: res.dashUnit
                        },
                        // dataType: "json",
                        success: function(resp) {
                            $("#report_sensor").html(resp);
                        }
                    });

                    // var countStatus_con = countElement(1, controlstatus);

                    // function countElement(item, array) {
                    //     var count = 0;
                    //     $.each(array, function(i, v) {
                    //         if (v === item) count++;
                    //     });
                    //     return count;
                    // }
                    if (count_stcont == 0) {
                        $(".r_reControl").hide();
                        $(".r_reAutoControl").hide();
                    } else {
                        $(".r_reControl").show();
                        $(".r_reAutoControl").show();

                        // $(".r_reControl").click(function() {
                        $.ajax({
                            url: "views/report_control.php",
                            method: "post",
                            data: {
                                house_master: house_master,
                                controlstatus: JSON.stringify(res.controlstatus),
                                conttrolname: JSON.stringify(res.conttrolname)
                            },
                            // dataType: "json",
                            success: function(resp) {
                                $("#report_control").html(resp);
                            }
                        });
                        // });
                        if (house_master !== "KMUMT001") {
                            $.ajax({
                                url: "views/report_controlAuto.php",
                                method: "post",
                                data: {
                                    house_master: house_master,
                                    controlstatus: res.controlstatus,
                                    conttrolname: res.conttrolname
                                },
                                // dataType: "json",
                                success: function(resp) {
                                    $("#report_controlAuto").html(resp);
                                }
                            });
                        } else {
                            $(".r_reAutoControl").click(function() {
                                setTimeout(function() {
                                    $.ajax({
                                        url: "views/report_controlAuto.php",
                                        method: "post",
                                        data: {
                                            house_master: house_master,
                                            controlstatus: res.controlstatus,
                                            conttrolname: res.conttrolname
                                        },
                                        // dataType: "json",
                                        success: function(resp) {
                                            $("#report_controlAuto").html(resp);
                                        }
                                    });

                                }, 1000);
                            });
                        }
                    }
                    // });

                }
            });
        
        }else{  
            // = มธ.
            $.ajax({
                url: "routes/tu/get_config.php",
                method: "post",
                data: {
                    house_master: house_master
                },
                dataType: "json",
                success: function(res) {
                    console.log(res);
                }
            }); // ajax
        }
    }else{ // No sn
        $(".memu_dash").hide()
        $(".memu_report").hide();
    }
});
$(".memu_report").click(function() {
    // $('#pills-selectSite').hide();
    // $("#pills-selectHome").hide();
    // $("#pills-selectReport").show();
    // $("#pills-profile").hide();
});

// --------------

$(".dpd_profile").click(function() {
    $(".memu_sel").removeClass('mm-active');
    $(".memu_dash").removeClass('mm-active');
    $(".memu_report").removeClass('mm-active');
    $('#pills-selectSite').hide();
    $("#pills-selectHome").hide();
    $("#pills-selectReport").hide();
    $("#pills-profile").show();
    $.ajax({
        url: "views/setting_profile.php",
        method: "post",
        data: {
            // s_master: res.s_master,
            pt: 1
        },
        // dataType: "json",
        success: function(resp) {
            $("#pills-profile").html(resp);
        }
    });
});
$(".dpd_setSite").click(function() {
    $(".memu_sel").removeClass('mm-active');
    $(".memu_dash").removeClass('mm-active');
    $(".memu_report").removeClass('mm-active');
    $('#pills-selectSite').hide();
    $("#pills-selectHome").hide();
    $("#pills-selectReport").hide();
    $("#pills-profile").show();
    $.ajax({
        url: "views/setting_profile.php",
        method: "post",
        data: {
            // s_master: res.s_master,
            pt: 2
        },
        // dataType: "json",
        success: function(resp) {
            $("#pills-profile").html(resp);
        }
    });
});
$(".dpd_setHoune").click(function() {
    $(".memu_sel").removeClass('mm-active');
    $(".memu_dash").removeClass('mm-active');
    $(".memu_report").removeClass('mm-active');
    $('#pills-selectSite').hide();
    $("#pills-selectHome").hide();
    $("#pills-selectReport").hide();
    $("#pills-profile").show();
    $.ajax({
        url: "views/setting_profile.php",
        method: "post",
        data: {
            // s_master: res.s_master,
            pt: 3
        },
        // dataType: "json",
        success: function(resp) {
            $("#pills-profile").html(resp);
        }
    });
});
$(".dpd_setting").click(function() {
    $(".memu_sel").removeClass('mm-active');
    $(".memu_dash").removeClass('mm-active');
    $(".memu_report").removeClass('mm-active');
    $('#pills-selectSite').hide();
    $("#pills-selectHome").hide();
    $("#pills-selectReport").hide();
    $("#pills-profile").show();
    $.ajax({
        url: "views/setting_profile.php",
        method: "post",
        data: {
            // s_master: res.s_master,
            pt: 4
        },
        // dataType: "json",
        success: function(resp) {
            $("#pills-profile").html(resp);
        }
    });
});

// $("#lightmode").click(function(){

// });
// function theme_set(val, key) {
//     if (key == 1 || key == 3) {
//         var new_val = val;
//     } else {
//         if ($("#lightmode").prop('checked') == true) {
//             var new_val = 'light-theme ' + val;
//         } else if ($("#darkmode").prop('checked') == true) {
//             var new_val = 'dark-theme ' + val;
//         } else if ($("#semidark").prop('checked') == true) {
//             var new_val = 'semi-dark ' + val;
//         } else if ($("#minimaltheme").prop('checked') == true) {
//             var new_val = 'minimal-theme ' + val;
//         }
//     }
//     // alert($("#lightmode").prop('checked'))
//     // return false;
//     $.ajax({
//         url: "routes/setting_theme.php",
//         method: "post",
//         data: {
//             theme: new_val
//         },
//         // dataType: "json",
//         success: function(resp) {

//         }
//     });
// }