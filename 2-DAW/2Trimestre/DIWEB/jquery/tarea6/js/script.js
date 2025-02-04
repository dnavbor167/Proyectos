$(function () {
    $("#email, select#met-contacto").on("focus", function () {
        $(this).css("background", "lightblue");
    });
    $("#email, select#met-contacto").on("focusout", function () {
        $(this).css("background", "white");
    });
});
