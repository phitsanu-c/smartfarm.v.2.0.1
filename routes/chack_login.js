var url = $.base64.decode(window.location.hash.substring(1))
if (url === "") {
    url = ',,'.split(',')
} else {
    url = url.split(',')
}
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
    if (msg.sn['account_status'] == 1) { // supportadmin
        if (url[1] === '') { // site = nail
            $(".memu_site").addClass("mm-active")
            $("#load_pages").load('views/pages_site.php');
            $(".memu_house").hide();
            $(".memu_dash").hide();
            $(".memu_report").hide();
            $('.memu_control').hide();
            $('.memu_compare').hide();
        }
        else { // site != nail
            if (house_master === '' || house_master.length != 8) { // chack sn != nail or ไม่ถูกต้อง
                $(".memu_site").removeClass("mm-active")
                $(".memu_house").show().addClass("mm-active")
                $(".memu_dash").hide();
                $(".memu_report").hide();
                $('.memu_control').hide();
                $('.memu_compare').hide();
                $("#load_pages").load('views/pages_house.php?s=' + url[1]);
            }
            else {
                $(".memu_site").removeClass("mm-active")
                $(".memu_house").removeClass("mm-active")
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
                $(".memu_site").hide()
                if (house_master === '' || house_master.length != 8) {
                    $(".memu_house").show().addClass("mm-active")
                    $(".memu_dash").hide();
                    $("#load_pages").load('views/pages_house.php?s=' + msg.sn['siteID']);
                }else {
                    $(".memu_house").show().removeClass("mm-active")
                    $(".memu_dash").show();
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
            // if(msg.sn['count_house'] == 1){
            if (url[1] === '') { // site = nail
                $(".memu_site").addClass("mm-active")
                $("#load_pages").load('views/pages_site.php');
                $(".memu_house").hide();
                $(".memu_dash").hide();
                $(".memu_report").hide();
                $('.memu_control').hide();
                $('.memu_compare').hide();
            } else { // site != nail
                if (house_master === '' || house_master.length != 8) { // chack sn != nail or ไม่ถูกต้อง
                    $(".memu_site").removeClass("mm-active")
                    $(".memu_house").show().addClass("mm-active")
                    $(".memu_dash").hide();
                    $(".memu_report").hide();
                    $('.memu_control').hide();
                    $('.memu_compare').hide();
                    $("#load_pages").load('views/pages_house.php?s=' + url[1]);
                } else {
                    $(".memu_site").removeClass("mm-active")
                    $(".memu_house").removeClass("mm-active")
                    if (url[0] == 4) {
                        $(".memu_compare").show();
                    } else {
                        $(".memu_compare").hide();
                    }
                }
            }
            // }
        }
    }

    $("#pills-selectReport").hide();

    // theme
    if (msg.theme === "dark-theme") {
        $("#toggleTheme").attr('checked', true);
    } else {
        $("#toggleTheme").attr('checked', false);
    }
    $("html").attr("class", msg.theme)
        // if (msg.theme === "dark-theme") {
        //     $("#lightmode").attr('checked', false);
        //     $("#darkmode").attr('checked', true);
        //     $("#semidark").attr('checked', false);
        //     $("#minimaltheme").attr('checked', false);
        // } else if (msg.theme === "semi-dark") {
        //     $("#lightmode").attr('checked', false);
        //     $("#darkmode").attr('checked', false);
        //     $("#semidark").attr('checked', true);
        //     $("#minimaltheme").attr('checked', false);
        // } else if (msg.theme === "minimal-theme") {
        //     $("#lightmode").attr('checked', false);
        //     $("#darkmode").attr('checked', false);
        //     $("#semidark").attr('checked', false);
        //     $("#minimaltheme").attr('checked', true);
        // } else {
        //     $("#lightmode").attr('checked', true);
        //     $("#darkmode").attr('checked', false);
        //     $("#semidark").attr('checked', false);
        //     $("#minimaltheme").attr('checked', false);
        // }
        // $("#theme").addClass(msg.theme);
    $(".btn_modal_sg").click(function() {
        $(".sg_name").val(msg.username);
        $(".sg_tel").val(msg.tel);
        $(".sg_email").val(msg.email);
        $(".sg_text").val("");
        $("#modal_sg").modal("show");
    });

    // window.addEventListener("beforeunload", function (e) {
    //   logout()
    //   return;
    // });
    // window.onunload = function(){
    //     logout()
    // alert("The window is closing now!");
    // }

});


function verticalNoTitle() {
    var loading = new Loading({
        discription: 'Loading...',
        defaultApply: true,
    });
    return loading;
    // loadingOut(loading);
}

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

function loadingOut(loading) {
    setTimeout(() => loading.out(), 100);
}

function toggleTheme(val) {
    if (val === true) {
        $("html").addClass('dark-theme');
        var theme = 'dark-theme';
    } else {
        $("html").attr("class", "color-sidebar sidebarcolor2 color-header headercolor2")
        var theme = "color-sidebar sidebarcolor2 color-header headercolor2";
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
