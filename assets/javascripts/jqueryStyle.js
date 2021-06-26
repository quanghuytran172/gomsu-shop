$(document).ready(function () {
    if ($(window).width() < 922) {
        $(".child").removeClass("child-hover");
        $(".list-clo").hide();
        $(".select-list span").click(function () {
            $(this).next().toggle();
            $("a-fix").addClass("a-fix1");
        });
        $(".categories").click(function () {
            $(".list-clo").slideToggle("slow");
        });
    } else {
        $(".child").removeClass("child-dropdown");
    }

    $(window).resize(function () {
        if (window.matchMedia("(max-width: 992px)").matches) {
            $(".child").removeClass("child-hover");
            $(".child").addClass("child-dropdown");
            $(".list-clo").hide();
        } else {
            $(".child").addClass("child-hover");
            $(".child").removeClass("child-dropdown");
            $("a-fix").removeClass("a-fix1");
            $(".list-clo").show();
        }
    });

    // $(".list-main-2 i").click(function () {
    //     $(this).toggleClass("fas fa-plus fas fa-minus");
    // });
    $(".icon-client .icon2-fix").click(function () {
        $(this).toggleClass("fas fa-bars fas fa-times");
    });
    // scroll to top
    $("#scrollup").click(function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
    $(".main-intro .text-button1").click(function () {
        $(".main-intro").css("display", "none").css("opacity", "0.3");

        $(".main-intro.m1").css({
            display: "flex",
            transition: "0.4s all ease-in",
        });
        setTimeout(function () {
            $(".main-intro.m1").css("opacity", "1");
        });
    });
    $(".main-intro .text-button2").click(function () {
        $(".main-intro").css("display", "none").css("opacity", "0.3");
        $(".main-intro.m2").css({
            display: "flex",
            transition: "0.4s all ease-in",
        });
        setTimeout(function () {
            $(".main-intro.m2").css("opacity", "1");
        });
    });
    $(".main-intro .text-button3").click(function () {
        $(".main-intro").css("display", "none").css("opacity", "0.3");
        $(".main-intro.m3").css({
            display: "flex",
            transition: "0.4s all ease-in",
        });
        setTimeout(function () {
            $(".main-intro.m3").css("opacity", "1");
        });
    });
});
