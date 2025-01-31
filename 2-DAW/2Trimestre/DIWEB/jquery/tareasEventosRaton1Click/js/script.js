$(function () {
    $("article.noticia > img").on("click", function () {
        $(this).next().css("display", "active");
    });

    $("article.noticia > img").on("dblclick", function () {
        $(this).next().css("display", "none");
    });
});
