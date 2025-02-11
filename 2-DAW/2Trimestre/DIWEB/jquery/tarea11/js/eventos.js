$(function () {
    $("div section div.texto").css("display", "none")
    $("div section>div").on("click", function (e) {
        $(this).next().toggle()
        $(this).children().children().next().toggle()
        //$(this).find("svg:nth-child(2)").toggle()
    })
})

