$(function () {
    $(window).on("scroll", function () {

        if ($(window).scrollTop() === 0) {
            $("div#content nav#main-menu").css({
                "position": "relative",
                "opacity": "1"
            })
        } else if ($(window).scrollTop() >= 150) {
            $("div#content nav#main-menu").css({
                "position": "fixed",
                "top": "0",
                "left": "0",
                "width": "100%",
                "opacity": ".8"
            })
        }
    });
    
    $(window).on("resize", function () {
        let ancho = $(window).width()

        if (ancho < 1024) {
            $("div#content nav#main-menu").css("display", "none")
        } else {
            $("div#content nav#main-menu").css("display", "block")
        }
    })

});
