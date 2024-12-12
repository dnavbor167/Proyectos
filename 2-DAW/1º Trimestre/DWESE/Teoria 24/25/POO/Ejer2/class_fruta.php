<?php
class Fruta
{
    private $color, $tamanyo;

    public function __construct($color_nuevo, $tamanyo_nuevo)
    {
        $this->color = $color_nuevo;
        $this->tamanyo = $tamanyo_nuevo;
        $this->imprimir();
    }

    public function setColor($color_nuevo)
    {
        $this->color = $color_nuevo;
    }
    public function setTamanyo($tamanyo_nuevo)
    {
        $this->tamanyo = $tamanyo_nuevo;
    }

    public function getColor()
    {
        return $this->color;
    }
    public function getTamanyo()
    {
        return $this->tamanyo;
    }

    private function imprimir()
    {
        echo "<h2>Información de mi fruta pera</h2>";
        echo "<p> <strong>Color: </strong>" . $this->color . "</p>";
        echo "<p> <strong>Tamanño: </strong>" . $this->tamanyo . "</p>";
    }
}
?>