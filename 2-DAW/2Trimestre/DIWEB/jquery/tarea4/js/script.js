$(function () {
    $("li").on("mouseenter", function () {
        $(this).children().css("color", "black");
    });
    $("li").on("mouseleave", function () {
        $(this).children().css("color", "#00acdd");
    });
});
