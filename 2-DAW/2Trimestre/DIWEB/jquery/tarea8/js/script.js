$(function () {
    $(window).on("scroll", function () {

        if ($(window).scrollTop() === 0) {
            $("div#content nav#main-menu").stop(true,true).css({
                "position": "relative",
                "opacity": "1"
            })
        } else if ($(window).scrollTop() >= 150) {
            $("div#content nav#main-menu").stop(true,true).css({
                "position": "fixed",
                "top": "0",
                "left": "0",
                "width": "100%",
                "opacity": ".8"
            })
        }
    });
    
    let menuVisible = false

    $("#svg-menu").on("click", function() {
        menuVisible = !menuVisible
        $("nav#main-menu > ul").toggle(menuVisible)
    })

    $(window).on("resize", function () {
        if (menuVisible) {
            $("nav#main-menu > ul").hide()
            menuVisible = false
        }
    })

});
