function obtener_productos()
{
    $.ajax({
        url:DIR_API+"/productos",
        dataType:"json",
        type:"GET",
        headers:{Authorization:"Bearer "+localStorage.token}
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#principal").html("");
        }
        else if(data.no_auth)
        {
            localStorage.clear();
            cargar_vista_login("El tiempo de sesión de la API ha expirado.");
        }
        else if(data.mensaje_baneo)
        {
            localStorage.clear();
            cargar_vista_login("Usted ya no se encuentra registrado en la BD");
        }
        else
        {
            let html_tabla_productos="<table class='txt_centrado centrado'>";
            html_tabla_productos+="<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th><th><button class='enlace' onclick='montar_vista_agregar()'>Productos+</button></th></tr>";
            $.each(data.productos,function(key,tupla){
                html_tabla_productos+="<tr>";
                html_tabla_productos+="<td><button class='enlace' onclick='obtener_detalles(\""+tupla["cod"]+"\")'>"+tupla["cod"]+"</button></td>";
                html_tabla_productos+="<td>"+tupla["nombre_corto"]+"</td>";
                html_tabla_productos+="<td>"+tupla["PVP"]+"</td>";
                html_tabla_productos+="<td><button class='enlace' onclick='montar_vista_borrar(\""+tupla["cod"]+"\")'>Borrar</button> - <button class='enlace' onclick='montar_vista_editar(\""+tupla["cod"]+"\")'>Editar</button></td>";
                html_tabla_productos+="</tr>";
            });
            html_tabla_productos+="</table>";
            $("#productos").html(html_tabla_productos);
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#principal").html("");
    });
}