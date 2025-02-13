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
            this.settings = settings || {duration: 5000}
            let losControles = ""
            SliderInit()

            for(let i = 0; i < lengthSlider; i++) {
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
    SliderModule.init({duration: 3000})
});
