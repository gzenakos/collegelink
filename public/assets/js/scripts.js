jQuery(window).on("load", function ($) {
    jQuery.ready.then(function ($) {
        fix_hero_heigt($);
        $(window).on("resize", function () {
            fix_hero_heigt($);
        });
        $(window).focus(function (e) {
            // Run once when browser tab is focused, need if user opens tab in background to adjust heigth
            if (typeof $(".main-content").attr("seen") === "undefined") {
                fix_hero_heigt($);
                $(".main-content").attr("seen", true);
            }
        });
        $('#scroll-to-top').on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 'slow');
        });
        let headerHeight =  $(".main-header") ? $(".main-header").height() : 0;
        $('[data-toggle="offcanvas"]').on('click', function () {
            $('.offcanvas-collapse').toggleClass('open');
            $('.offcanvas-collapse').css("top", `${headerHeight}px`);
          })
    });
});
jQuery(window).on("scroll", function ($) {
    jQuery.ready.then(function ($) {
    scrollToTopToggleView($);
    });
});


// Scroll to top button
function scrollToTopToggleView($) {
    if ($(this).scrollTop() > 500) {
        $('#scroll-to-top').fadeIn();
    } else {
        $('#scroll-to-top').fadeOut();
    }
};


/* -------------- FIX MAKE HERO HEIGHT RESPONSIVE ----------------*/
function fix_hero_heigt($) {

    let headerHeight =  $(".main-header") ? $(".main-header").height() : 0;
    let bottomHeight = $("footer") ? $("footer").height() : 0;
    const mobileHeroHeight = window.innerHeight - headerHeight - bottomHeight - 3;
    if ($(window).width() < 960) {
        if (
            typeof $(".main-content").attr("fixedHeight") === "undefined" &&
            mobileHeroHeight + "px" > $(".main-content").css("height")
        ) {

            $(".main-content").css("min-height", `${mobileHeroHeight}px`);
            $(".main-content").attr("fixedHeight", true);
        }
    } else {
        const desktopHeroHeight = window.innerHeight - headerHeight - bottomHeight - 3;
        $(".main-content").css("min-height", `${desktopHeroHeight}px`);
    }
}

// var check_in_date = document.forms["searchFormList"]["check_in_date"];
// var check_out_date = document.forms["searchFormList"]["check_out_date"];

// var check_in_date_error = document.getElementById("check_in_date_error");
// var check_out_date_error = document.getElementById("check_out_date_error");

// function validateForm() {
//     if (check_in_date.value === "") {
//         check_in_date_error.textContent = "Please enter a Check-in Date.";
//         check_in_date.focus();
//         return false;
//     }
//     if (check_out_date.value === "") {
//         check_out_date_error.textContent = "Please enter a Check-out Date.";
//         check_out_date.focus();
//         return false;
//     }
// }
