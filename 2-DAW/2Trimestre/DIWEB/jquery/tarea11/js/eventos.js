$(function () {
    $("div section div.texto").css("display", "none")
    $("div section>div").on("click", function (e) {
        $(this).next().stop().slideToggle()
        $(this).children().children().next().toggle()
        //$(this).find("svg:nth-child(2)").slideToggle()
    })
})

