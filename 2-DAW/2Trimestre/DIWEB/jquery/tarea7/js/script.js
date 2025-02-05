$(function () {
    $("#email").on("select", function () {
        let elemento = $(this).next();
        elemento.toggle("slow")

        setTimeout(function() {
            elemento.toggle("slow");
        }, 3000)
    });
    
    $("select#met-contacto").on("change", function () {
        let valorOption = $(this).val();
        let elemento = $(this).next()

        if (valorOption !== "") {
            elemento.text('Vamos a contactar con usted por ' + valorOption).css("display", "block")
        } else {
            elemento.text('Vamos a contactar con usted por ' + valorOption).css("display", "none")
        }
    });

    $("#mensaje-seleccion").on("click", function () {
        let elemento = $("#email").val()
        alert("Email copiado: " +  elemento)
        console.log($("#email").val())
    });
});
