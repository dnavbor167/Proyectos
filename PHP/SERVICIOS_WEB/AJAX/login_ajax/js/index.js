const DIR_API = "http://localhost/Proyectos/PHP/SERVICIOS_WEB/Login_SW/Actividad3/API_login";

$(function () {
    if (logueado()) {
        montarVista(localStorage.getItem("usuario"), localStorage.getItem("tipo"))
    } else {
        montarLoguin()
    }
});

//Funcion para saber si estamos logueado
function logueado() {
    let usuario = localStorage.getItem("usuario")
    let ultima = Number(localStorage.getItem("ultm_accion"))

    //Solo pregunto si es null con usuario porque o están todos a null o están todos existentes
    if (!usuario || (Date.now() - ultima > 5 * 60 * 1000)) {
        localStorage.clear()
        return false
    }
    localStorage.setItem("ultm_accion", Date.now())
    return true
}

function montarLoguin() {
    localStorage.clear()
    let login = "<h1>Primer Loguin</h1>"
    login += "<form onsubmit='event.preventDefault(); login();'>"
    login += "<p class='error' id='error_vacio'></p>"
    login += "<label for='usuario'>Usuario: </label><input type='text' id='usuario' /> <span class='error' id='usuario_error'></span><br>"
    login += "<label for='clave'>Clave: </label><input type='password' id='clave' /><br>"
    login += "<button>Iniciar</button>"
    login += "</form>"

    //mostramos en html el loguin
    $("#respuesta").html(login)
}

function montarVista(usuario, tipo) {
    //si hubiese distinción entre una pagina admin o normal aqui preguntaria si tipo es de admin monte una cosa
    //y si es de tipo normal montamos otra cosa, como lo único que cambia es el tipo, pues lo monto el mismo
    let contenido
    contenido = "<h3>Bienvenido " + usuario + "</h3>"
    contenido += "<p>Eres de tipo " + tipo + " pulsa para salir <button onclick='event.preventDefault(); desLoguearse()' class='boton'>Salir</button></p>"
    $("#respuesta").html(contenido)
}

//Función para hacer loguin
function login() {
    let usuario = $("#usuario").val().trim()
    let clave = $("#clave").val().trim()

    if (!usuario || !clave) {
        $("#error_vacio").html("Rellena todos los campos")
        return
    }

    $("#error_vacio").html("")

    $.ajax({
        url: DIR_API + "/login",
        dataType: "json",
        type: "POST",
        data: { "usuario": usuario, "clave": clave }
    })
        .done(function (data) {
            if (data.error) {
                $("#respuesta").html("<p class='error'>" + data.error + "</p>");
            } else if (data.mensaje) {
                $("#usuario_error").html("Usuario y/o Contraseña incorrecto");
            }
            else {
                localStorage.setItem("usuario", data["usuario"]["usuario"])
                localStorage.setItem("tipo", data["usuario"]["tipo"])
                localStorage.setItem("ultm_accion", Date.now())
                location.reload()
            }
        })
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}

function desLoguearse() {
    localStorage.clear();
    montarLoguin();
}