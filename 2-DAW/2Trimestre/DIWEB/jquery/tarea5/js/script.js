$(function () {
    $(document).on("keypress", function (e) {
        e.preventDefault();
        let d = String.fromCharCode(e.which)
        if (d == "d") {
            console.log(e.which)
            $("article.noticia h3").toggle("slow");
        }
    });
});
