$(function () {
    let SliderModule = (function () {
        let pb = {}

        pb.elslider = $("#slider")

        pb.items = {
            panels: pb.elslider.find(".slider-wrapper > li")
        }

        let SliderInterval,
            currentSlider = 0,
            nextSlider = 1,
            lengthSlider = pb.items.panels.length

        pb.init = function (settings) {
            this.settings = settings || { duration: 5000 }
            let losControles = ""
            SliderInit()

            for (let i = 0; i < lengthSlider; i++) {
                if (i == 0) {
                    losControles += "<li class='active'></li>"
                } else {
                    losControles += "<li></li>"
                }
            }

            //insertamos los controles en el html
            $("#control-buttons").html(losControles)
            $("#control-buttons li").on("click", function () {
                //console.log($(this).index())
                //Se cambia la imagen solo si hacemos click en una 
                //bolita distinta a la que se ve actualmente
                if (currentSlider !== $(this).index()) {
                    cambiarPanel($(this).index())
                }

            })
        }

        let SliderInit = function () {
            SliderInterval = setInterval(pb.startSlider, pb.settings.duration)
        }

        pb.startSlider = function () {
            let paneles = pb.items.panels
            let controles = $("#control-buttons li")

            //console.log("Mensaje")
            if (nextSlider >= lengthSlider) {
                nextSlider = 0
                currentSlider = lengthSlider - 1
            }

            controles.removeClass("active")
            controles.eq(nextSlider).addClass("active")

            paneles.eq(currentSlider).fadeOut('slow')
            paneles.eq(nextSlider).fadeIn('slow')

            currentSlider = nextSlider
            nextSlider += 1
        }

        let cambiarPanel = function (indice) {
            //Limpiamos el intervalo de ejecución
            clearInterval(SliderInterval)

            let paneles = pb.items.panels
            let controles = $("#control-buttons li")
            //Comprobamos que el índice esté disponible
            //dentro de los paneles del slider
            if (indice >= lengthSlider) {
                indice = 0//para que no se salga de los panenes disponibles
            } else if (indice < 0) {
                indice = lengthSlider - 1
            }

            controles.removeClass("active")
            controles.eq(indice).addClass("active")

            paneles.eq(currentSlider).fadeOut("slow")
            paneles.eq(indice).fadeIn("slow")

            currentSlider = indice
            nextSlider = indice + 1

            //Reactivar el Slider
            SliderInit()
        }

        return pb //Devolvemos el objeto
    }()); //()); es para que se ejecute automáticamente

    //Llamada al constructor
    SliderModule.init({ duration: 3000 })

    //hover de la pelicula
    $('.video-container').on('mouseover', function () {
        $(this).find('video').css('filter', 'brightness(50%)');
        $(this).find('.play-icon').stop().fadeIn();
    });

    $('.video-container').on('mouseout', function () {
        $(this).find('video').css('filter', 'brightness(100%)');
        $(this).find('.play-icon').stop().fadeOut();
    });

    //Buscador
    let buscador = false
    $('#search-jq, #search-menu').on('click', function (e) {
        e.stopPropagation()
        $('main, footer').css('filter', 'blur(5px)');
        $('#search-bar').fadeIn();
    })
    //Cerramos el buscador cuando esté fuera del documento
    $(document).on('click', function (e) {
        e.stopPropagation()
        if (!$(e.target).closest('#search-jq, #search-bar').length) {
            $('main, footer').css('filter', 'none');
            $('#search-bar').stop().fadeOut();
        }
        if (!$(e.target).closest("div#menu-desplegable, #svg-menu").length) {
            if (menuVisible) {
                $("div#menu-desplegable nav").hide();
                menuVisible = false;
            }
        }
    })

    //active de los apartados del menu
    $('.apartado-menu').on('mousedown', function () {
        $(this).css('background-color', '#101820');
    })
    $('.apartado-menu').on('mouseup', function () {
        $(this).css('background-color', '#32363b');
    })

    //hover de los apartados del menú
    $('.apartado-menu').on('mouseover', function () {
        $(this).css('background-color', '#101820');
    })
    $('.apartado-menu').on('mouseleave', function () {
        $(this).css('background-color', '#32363b');
    })

    //Menú desplegable
    let menuVisible = false

    $("#svg-menu").on("click", function () {
        menuVisible = !menuVisible
        $("div#menu-desplegable nav").toggle(menuVisible)
    })

    $("#svg-menu-close, #search-menu").on("click", function () {
        $("div#menu-desplegable nav").hide()
        menuVisible = false
    })

    $("#svg-menu, #svg-menu-close").on("mouseenter", function () {
        $(this).find("path").attr('fill', 'gray')
    })

    $("#svg-menu, #svg-menu-close").on("mouseleave", function () {
        $(this).find("path").attr('fill', 'white')
    })

    $(window).on("resize", function () {
        if (menuVisible) {
            $("div#menu-desplegable nav").hide()
            menuVisible = false
        }
    })

    //Stars
    $(".not_fill").on('click', function () {
        $(this).hide()
        $(this).next().show()
    })
    $(".fill").on('click', function () {
        $(this).hide()
        $(this).prev().show()
    })

    //Ver contraseña, Ocultar contraseá
    $('#seePass').on('click', function () {
        $(this).hide()
        $(this).next().show()
        $('#clave').attr('type', 'text')
    })

    $('#dontSeePass').on('click', function () {
        $(this).hide()
        $(this).prev().show()
        $('#clave').attr('type', 'password')
    })

    //Errores formulario inicio sesión
    $('#btnIniciarSesión').on('click', function (e) {
        let email = $('#email').val()
        let clave = $('#clave').val()

        e.preventDefault()

        if (!email || email == "" || !clave || clave == "") {
            $('#logSigIn form input').css('margin-bottom', '0');
            $('.error').slideDown();
            $('#seePass').css('top', '30%')
            $('#dontSeePass').css('top', '30%')
        } else {
            window.location.href = '../index.html'
        }

    })

    $('#btnCrearCuenta').on('click', function (e) {
        e.preventDefault()
        window.location.href = 'signIn.html'

    })
});