const DIR_API2 = "http://localhost/Proyectos/PHP/SERVICIOS_WEB/Actividad1/servicios_rest";

$(function () {
    obtener_productos();
});



function obtener_productos() {
    $.ajax({
        url: DIR_API2 + "/productos",
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.error) {
                $("#respuesta").html(data.error);
            }
            else {
                let html_tabla_productos = "<table id='tabla'>";
                html_tabla_productos += "<tr><th class='teh'>COD</th><th class='teh'>Nombre Corto</th><th class='teh'>PVP (€)</th></tr>";
                $.each(data.productos, function (key, tupla) {
                    html_tabla_productos += "<tr>";
                    html_tabla_productos += "<td class='tede'><button class='mensaje' onClick='obtenerProducto(\"" + tupla["cod"] + "\")'>" + tupla["cod"] + "</button></td>";
                    html_tabla_productos += "<td class='tede'>" + tupla["nombre_corto"] + "</td>";
                    html_tabla_productos += "<td class='tede'>" + tupla["PVP"] + "</td>";
                    html_tabla_productos += "</tr>";
                });
                html_tabla_productos += "</table>";
                $("#respuesta").html(html_tabla_productos);
            }
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}
function vacio() {
    $("#info").html("")
}

function obtenerProducto(producto) {
    $.ajax({
        url: DIR_API2 + "/producto/" + producto,
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            if (data.error) {
                $("#info").html(data.error);
            } else if (data.mensaje) {
                $("#info").html(data.mensaje);
            }
            else {
                let nombre = data.producto["nombre"] === null ? "" : data.producto["nombre"];
                let html_tabla_productos = "<h2>Información del producto: " + data.producto["cod"] + "</h2>";
                html_tabla_productos += "<table>";
                html_tabla_productos += "<tr><th>Nombre: </th><td>" + nombre + "</td></tr>";
                html_tabla_productos += "<tr><th>Nombre Corto: </th><td>" + data.producto["nombre_corto"] + "</td></tr>";
                html_tabla_productos += "<tr><th>Descripción: </th><td>" + data.producto["descripcion"] + "</td></tr>";
                html_tabla_productos += "<tr><th>PVP: </th><td>" + data.producto["PVP"] + "</td></tr>";
                html_tabla_productos += "<tr><th>Familia</th><td>" + data.producto["nombre_familia"] + "</td></tr>";
                html_tabla_productos += "</table>";
                html_tabla_productos += "<br><button onClick='vacio()'>Volver</button>";
                $("#info").html(html_tabla_productos);
            }
        })
        .fail(function (a, b) {
            $("#info").html(error_ajax_jquery(a, b));
        });
}


function llamada_get1() {
    $.ajax({
        url: DIR_API1 + "/saludo",
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            $("#respuesta").html(data.mensaje);
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });

}


function llamada_get2() {
    let nombre_envio = "María José";
    $.ajax({
        url: DIR_API1 + "/saludo/" + nombre_envio,
        dataType: "json",
        type: "GET"
    })
        .done(function (data) {
            $("#respuesta").html(data.mensaje);
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });

}

function llamada_post() {
    let nombre_envio = "María José";
    $.ajax({
        url: DIR_API1 + "/saludo",
        dataType: "json",
        type: "POST",
        data: { "name": nombre_envio }
    })
        .done(function (data) {
            $("#respuesta").html(data.mensaje);
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });

}

function llamada_delete() {
    let id = "9";
    $.ajax({
        url: DIR_API1 + "/borrar_saludo/" + id,
        dataType: "json",
        type: "DELETE"
    })
        .done(function (data) {
            $("#respuesta").html(data.mensaje);
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });

}

function llamada_put() {
    let id = "9";
    let nuevo_nombre = "Juan José";
    $.ajax({
        url: DIR_API1 + "/actualizar_saludo/" + id,
        dataType: "json",
        type: "PUT",
        data: { "name": nuevo_nombre }
    })
        .done(function (data) {
            $("#respuesta").html(data.mensaje);
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });

}

function error_ajax_jquery(jqXHR, textStatus) {
    var respuesta;
    if (jqXHR.status === 0) {

        respuesta = 'Not connect: Verify Network.';

    } else if (jqXHR.status == 404) {

        respuesta = 'Requested page not found [404]';

    } else if (jqXHR.status == 500) {

        respuesta = 'Internal Server Error [500].';

    } else if (textStatus === 'parsererror') {

        respuesta = 'Requested JSON parse failed.';

    } else if (textStatus === 'timeout') {

        respuesta = 'Time out error.';

    } else if (textStatus === 'abort') {

        respuesta = 'Ajax request aborted.';

    } else {

        respuesta = 'Uncaught Error: ' + jqXHR.responseText;

    }
    return respuesta;
}

