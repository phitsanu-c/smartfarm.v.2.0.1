
var url = $.base64.decode(window.location.hash.substring(1))
if (url === "") {
    url = ',,'.split(',')
} else {
    url = url.split(',')
}
// alert(window.location.hash)
var house_master = url[2].substring(0, 8);
// alert(url[0])
console.log(house_master);
// console.log($.base64.encode('TSPWM001zasn'));
// console.log($.base64.decode('S083TVQwMDF6YXNu'))
// Chack user_status

$.getJSON('routes/login.php', function(msg) {
    console.log(msg);
    // return false;
    $(".user-img").attr("src", "public/images/users/" + msg.image);
    $(".user_name").html(msg.name_login);
    $(".INuser_name").val(msg.username);
    // console.log(msg.pages);
    if (msg.name_login === "") {
        window.location.href = "page_login.html";
        return false;
    }

    // console.log(msg.date_start);
    // if (msg.date_start != new Date().getDate()) {
    // logout();
    // return false;
    // console.log(window.location.pathname);
    // }

    // -----------------------------------------------------
    $('#load_pages_dashboard').hide();
    $('#load_pages_report').hide();
    $('.memu_setting').hide();
    $("#load_pages_profile").hide();
    if (msg.sn['account_status'] == 1) { // supportadmin
        $("#load_pages_site").load('views/pages_site.php');
        if (url[1] === '') { // site = nail
            $(".memu_site").addClass("mm-active")
            $(".memu_house").hide();
            $(".memu_dash").hide();
            $(".memu_report").hide();
            $('.memu_control').hide();
            $('.memu_compare').hide();
            $('#load_pages_site').show();
        }
        else { // site != nail
            $('#load_pages_site').hide();
            $.ajax({
                url: "views/pages_house.php",
                method: "POST",
                data: {
                    s: url[1]
                },
                // dataType: "json",
                success: function(res_dash) {
                    $("#load_pages_house").html(res_dash);
                    // $('.sw_house').click(function(){
                    //     window.location.hash =$(this).attr("url");
                    //     location.reload();
                    //     // alert($(this).attr("url"))
                    //     // window.location.href = $(this).attr("url");
                    // })
                }
            })
            if (house_master === '' || house_master.length != 8) { // chack sn != nail or ไม่ถูกต้อง
                $(".memu_site").removeClass("mm-active")
                $(".memu_house").show().addClass("mm-active")
                $(".memu_dash").hide();
                $(".memu_report").hide();
                $('.memu_control').hide();
                $('.memu_compare').hide();
                // $("#load_pages_house").load('views/pages_house.php?s=' + url[1]);
                $('#load_pages_house').show();
                $('#load_pages_compare').hide();
                $('#load_pages_profile').hide();
            }
            else {
                $(".memu_site").removeClass("mm-active")
                $(".memu_house").removeClass("mm-active")
                $('#load_pages_house').hide();
            }
            if (url[0] == 4) {
                $(".memu_compare").show();
            } else {
                $(".memu_compare").hide();
            }
        }
    }
    else { // user and admin != supportadmin
        // alert(res.sn['count_house'])
        if (msg.sn['count_site'] == 1) { // 1 site
            if (msg.sn['count_house'] == 1) { // 1 site 1 house
                $(".memu_site").hide()
                $(".memu_house").hide()
                    // $(".memu_dash").show().addClass("mm-active");
                $(".memu_report").show().removeClass("mm-active")
            }
            else { // 1 site > 1 house
                $(".memu_site").hide();
                // $("#load_pages_house").load('views/pages_house.php?s=' + url[1]);
                $.ajax({
                    url: "views/pages_house.php",
                    method: "POST",
                    data: {
                        s: url[1]
                    },
                    // dataType: "json",
                    success: function(res_dash) {
                        $("#load_pages_house").html(res_dash);
                        $('.sw_house').click(function(){
                            window.location.hash =$(this).attr("url");
                            location.reload();
                            // alert($(this).attr("url"))
                            // window.location.href = $(this).attr("url");
                        })
                    }
                })
                if (house_master === '' || house_master.length != 8) {
                    $(".memu_house").show().addClass("mm-active")
                    $(".memu_dash").hide();
                    $('#load_pages_house').show();
                }else {
                    $(".memu_house").show().removeClass("mm-active")
                    $(".memu_dash").show();
                    $('#load_pages_house').hide();
                }
                $(".memu_report").hide();
                $('.memu_control').hide();
            }
            if (url[0] == 4) {
                $(".memu_compare").show();
            } else {
                $(".memu_compare").hide();
            }
        } else { // > 1 site
            $("#load_pages_site").load('views/pages_site.php');
            if (url[1] === '') { // site = nail
                $(".memu_site").addClass("mm-active")
                $(".memu_house").hide();
                $(".memu_dash").hide();
                $(".memu_report").hide();
                $('.memu_control').hide();
                $('.memu_compare').hide();
            } else { // site != nail
                // $("#load_pages_house").load('views/pages_house.php?s=' + url[1]);
                $.ajax({
                    url: "views/pages_house.php",
                    method: "POST",
                    data: {
                        s: url[1]
                    },
                    // dataType: "json",
                    success: function(res_dash) {
                        $("#load_pages_house").html(res_dash);
                        $('.sw_house').click(function(){
                            window.location.hash =$(this).attr("url");
                            location.reload();
                            // alert($(this).attr("url"))
                            // window.location.href = $(this).attr("url");
                        })
                    }
                })
                if (house_master === '' || house_master.length != 8) { // chack sn != nail or ไม่ถูกต้อง
                    $(".memu_site").removeClass("mm-active")
                    $(".memu_house").show().addClass("mm-active")
                    $(".memu_dash").hide();
                    $(".memu_report").hide();
                    $('.memu_control').hide();
                    $('.memu_compare').hide();
                    $('#load_pages_house').show();
                } else {
                    $(".memu_site").removeClass("mm-active")
                    $(".memu_house").removeClass("mm-active")
                    if (url[0] == 4) {
                        $(".memu_compare").show();
                    } else {
                        $(".memu_compare").hide();
                    }
                    $('#load_pages_house').hide();
                }
            }
            // }
        }
    }
    if (msg.sn['account_status'] < 3) {
        $('.menu2').show();
        $('.menu3').show();
        $('.menu4').show();
        $('.menu5').show();
    }else {
        $('.menu2').hide();
        $('.menu3').hide();
        $('.menu4').hide();
        $('.menu5').hide();
    }
    // theme
    if (msg.theme === "dark-theme") {
        $("#toggleTheme").attr('checked', true);
    } else {
        $("#toggleTheme").attr('checked', false);
    }
    $("html").attr("class", msg.theme)
    $(".btn_modal_sg").click(function() {
        $(".sg_name").val(msg.username);
        $(".sg_tel").val(msg.tel);
        $(".sg_email").val(msg.email);
        $(".sg_text").val("");
        $("#modal_sg").modal("show");
    });
});

// logout
countdown(number = 1800); // วินาที

function countdown() {
    clearTimeout(countdown);
    setTimeout(countdown, 1000);
    // console.log(number)
    // $('#redirect').html("Redirecting in " + number + " seconds.");
    number--;
    if (number < 0) {
        number = 0;
    }
    if(number == 0){
        clearTimeout(countdown);
        logout();}
    // $("#test_timr").html("countdown : " + number);
}

function logout() {
    $.ajax({
        url: 'routes/login.php',
        type: 'POST',
        dataType: 'json',
        data: {
            logout: 'logout',
            // siteID: msg.sn['siteID']
        },
        success: function(ress) {
            if (ress === "logout_succress") {
                window.location = 'page_login.html';
            }
        }
    });
}

function verticalNoTitle() {
    var loading = new Loading({
        discription: 'Loading...',
        defaultApply: true,
    });
    return loading;
    // loadingOut(loading);
}
function loadingOut(loading) {
    setTimeout(() => loading.out(), 100);
}

function toggleTheme(val) {
    if (val === true) {
        $("html").addClass('dark-theme');
        var theme = 'dark-theme';
    } else {
        $("html").removeClass('dark-theme').addClass('light-theme'); //attr("class", "color-sidebar sidebarcolor2 color-header headercolor2")
        var theme = "light-theme";
    }
    $.ajax({
        url: "routes/setting_theme.php",
        method: "post",
        data: {
            theme: theme
        },
        // dataType: "json",
        success: function(resp) {

        }
    });
}
