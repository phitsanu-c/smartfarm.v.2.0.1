$(".memu_site").click(function() {
    $(this).addClass('mm-active');
    // $("#load_pages_site").load('views/pages_site.php');
    if(url[1] == ''){
        $(".memu_house").hide();
        $(".memu_dash").hide();
    }else{
        $(".memu_house").removeClass("mm-active")
        if(house_master === '' || house_master.length != 8){
            $(".memu_dash").hide();
        }else{
            $(".memu_dash").show().removeClass("mm-active")
        }
    }
    $(".memu_report").hide()
    $('.memu_control').hide()
    // if(url[0] == 4){
    //     $(".memu_compare").show();
    // }else{
        $(".memu_compare").hide();
    // }
    $('#load_pages_site').show();
    $('#load_pages_house').hide();
    $('#load_pages_compare').hide();
    $('#load_pages_dashboard').hide();
    $('#load_pages_report').hide();
    $('#load_pages_profile').hide();
    $('.memu_setting').hide()
});
$(".memu_house").click(function() {
    $(this).addClass('mm-active');
    if(house_master === '' || house_master.length != 8){
        $(".memu_dash").hide();
    }else{
        $(".memu_dash").removeClass("mm-active")
    }
    $(".memu_report").hide()
    $('.memu_control').hide()
    if(url[0] == 4){
        $(".memu_compare").show();
    }else{
        $(".memu_compare").hide();
    }
    $('#load_pages_site').hide();
    $('#load_pages_house').show();
    $('#load_pages_compare').hide();
    $('#load_pages_dashboard').hide();
    $('#load_pages_report').hide();
    $('#load_pages_profile').hide();
    // $("#load_pages").load('views/pages_house.php?s='+url[1]);
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
                window.location.hash = $(this).attr("url");
                location.reload();
                // alert($(this).attr("url"))
                // window.location.href = $(this).attr("url");
            })
        }
    })
    $('.memu_setting').hide()
});
$(".memu_compare").click(function(){
    $(this).addClass('mm-active');
    $(".memu_house").removeClass("mm-active")
    $('#load_pages_site').hide();
    $('#load_pages_house').hide();
    $("#load_pages_compare").show().load('routes/tu/pages_compare.php?s='+url[1]);
    $('#load_pages_profile').hide();
    $('.memu_setting').hide()
})
$(".memu_dash").click(function() {
    $(this).addClass('mm-active');
    $(".memu_report").show();
    $(".memu_compare").hide();

    $('#load_pages_site').hide();
    $('#load_pages_house').hide();
    $('#load_pages_compare').hide();
    $('#load_pages_dashboard').show();
    $('#load_pages_report').hide();
    $('#load_pages_profile').hide();
    $('.memu_setting').hide()
});
$(".memu_report").click(function() {
    $('.memu_control').hide()
    $(this).addClass('mm-active');
    $(".memu_dash").show().removeClass("mm-active");
    $('#load_pages_dashboard').hide();
    $('#load_pages_report').show();
    $('#load_pages_profile').hide();
    $('.memu_setting').hide()
});
// $(".memu_report").click(function() {
//     $(this).addClass('mm-active');
//     $(".memu_dash").show().addClass("mm-active");
//     // $(".memu_report").show();
//     if(house_master.substring(0, 3) != "TUS"){
//
//     }
//     // $('#pills-selectSite').hide();
//     // $("#pills-selectHome").hide();
//     // $("#pills-selectReport").show();
//     // $("#pills-profile").hide();
// });

// --------------

$(".menu_setting").click(function() {
    $('.memu_setting').show().addClass('mm-active');
    $(".memu_site").removeClass('mm-active');
    $(".memu_house").removeClass("mm-active")
    $(".memu_dash").removeClass('mm-active');
    $('.memu_control').hide()
    $(".memu_report").removeClass('mm-active');
    $('#load_pages_site').hide();
    $('#load_pages_house').hide();
    $('#load_pages_compare').hide();
    $('#load_pages_dashboard').hide();
    $('#load_pages_report').hide();
    $("#load_pages_profile").show();
    $.ajax({
        url: "views/setting_profile.php",
        method: "post",
        data: {
            // s_master: res.s_master,
            pt: $(this).attr('menu')
        },
        // dataType: "json",
        success: function(resp) {
            $("#load_pages_profile").html(resp);
        }
    });
});
// $(".dpd_setSite").click(function() {
//     $(".memu_sel").removeClass('mm-active');
//     $(".memu_dash").removeClass('mm-active');
//     $(".memu_report").removeClass('mm-active');
//     $('#pills-selectSite').hide();
//     $("#pills-selectHome").hide();
//     $("#pills-selectReport").hide();
//     $("#pills-profile").show();
//     $.ajax({
//         url: "views/setting_profile.php",
//         method: "post",
//         data: {
//             // s_master: res.s_master,
//             pt: 2
//         },
//         // dataType: "json",
//         success: function(resp) {
//             $("#load_pages_profile").html(resp);
//         }
//     });
// });
// $(".dpd_setHoune").click(function() {
//     $(".memu_sel").removeClass('mm-active');
//     $(".memu_dash").removeClass('mm-active');
//     $(".memu_report").removeClass('mm-active');
//     $('#pills-selectSite').hide();
//     $("#pills-selectHome").hide();
//     $("#pills-selectReport").hide();
//     $("#pills-profile").show();
//     $.ajax({
//         url: "views/setting_profile.php",
//         method: "post",
//         data: {
//             // s_master: res.s_master,
//             pt: 3
//         },
//         // dataType: "json",
//         success: function(resp) {
//             $("#load_pages_profile").html(resp);
//         }
//     });
// });
// $(".dpd_setting").click(function() {
//     $(".memu_sel").removeClass('mm-active');
//     $(".memu_dash").removeClass('mm-active');
//     $(".memu_report").removeClass('mm-active');
//     $('#pills-selectSite').hide();
//     $("#pills-selectHome").hide();
//     $("#pills-selectReport").hide();
//     $("#pills-profile").show();
//     $.ajax({
//         url: "views/setting_profile.php",
//         method: "post",
//         data: {
//             // s_master: res.s_master,
//             pt: 4
//         },
//         // dataType: "json",
//         success: function(resp) {
//             $("#load_pages_profile").html(resp);
//         }
//     });
// });

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
