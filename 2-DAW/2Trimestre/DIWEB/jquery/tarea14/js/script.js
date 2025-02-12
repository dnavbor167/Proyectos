$(function () {
    $("#email").on("select", function () {
        let elemento = $(this).next();
        elemento.stop(true).slideToggle()

        setTimeout(function() {
            elemento.stop(true).slideToggle()
        }, 3000)
    });
    
    $("select#met-contacto").on("change", function () {
        let valorOption = $(this).val();
        let elemento = $(this).next()

        if (valorOption !== "") {
            elemento.text('Vamos a contactar con usted por ' + valorOption).stop(true).slideToggle()
        } else {
            elemento.text('Vamos a contactar con usted por ' + valorOption).stop(true).slideToggle()
        }
    });

    $("#mensaje-seleccion").on("click", function () {
        let elemento = $("#email").val()
        alert("Email copiado: " +  elemento)
        console.log($("#email").val())
    });

    $("button").on("mouseenter", function () {
        $(this).stop(true).fadeTo(300, 0.5)
    })

    $("button").on("mouseleave", function () {
        $(this).stop(true).fadeTo(200, 1)
    })
});
