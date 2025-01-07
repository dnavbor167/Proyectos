<?php
class Pelicula
{
    private $titulo, $anyo, $director, $alquilada, $precio, $fecha_devolucion;

    public function __construct($titulo_nuevo, $anyo_nuevo, $director_nuevo, $alquilada_nuevo, $precio_nuevo, $fecha_devolucion_nuevo)
    {
        $this->titulo = $titulo_nuevo;
        $this->anyo = $anyo_nuevo;
        $this->director = $director_nuevo;
        $this->alquilada = $alquilada_nuevo;
        $this->precio = $precio_nuevo;
        $this->fecha_devolucion = DateTime::createFromFormat('d-m-Y', $fecha_devolucion_nuevo);
    }

    //Hacemos los getters
    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getAnyo()
    {
        return $this->anyo;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getAlquilada()
    {
        return $this->alquilada;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getFechaDevolucion()
    {
        return $this->fecha_devolucion->format('d-m-Y');
    }

    //Función para saber los días restantes o cuantos días le quedan
    public function calcularDias()
    {
        if ($this->fecha_devolucion) {
            $hoy = new DateTime();
            $diferencia = $hoy->diff($this->fecha_devolucion);
            if ($hoy > $this->fecha_devolucion) {
                //Devolvemos los días de retraso y el recargo
                $dias_pasados = $diferencia->days;
                $recarga = $dias_pasados * 1.2;
                return "La película se ha retrasado por " . $dias_pasados . " días y tiene un recargo de " . $recarga . "€.";
            } else {
                return $diferencia->days;
            }
        }
        return "No hay fecha de devolución";
    }
}
