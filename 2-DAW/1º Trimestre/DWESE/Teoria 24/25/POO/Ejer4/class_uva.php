<?php 
require 'class_fruta.php';
class Uva extends Fruta {
    private $tieneSemilla;

    public function __construct($color_nuevo, $tamanyo_nuevo, $tiene)
    {
        $this->tieneSemilla=$tiene;
        parent::__construct($color_nuevo, $tamanyo_nuevo);
    }

    public function tieneSemilla() {
        return $this->tieneSemilla;
    }

    public function imprimir()
    {
        echo "<p>Mi<strong>Color: </strong>" . parent::getColor() . "</p>";
        echo "<p> <strong>Tamanño: </strong>" . parent::getTamanyo() . "</p>";
    }
}
?>