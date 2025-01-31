$(function () {
    $("article.noticia > img").on("mouseenter mouseleave", function () {
        $(this).next().toggle('slow');
    });
});
