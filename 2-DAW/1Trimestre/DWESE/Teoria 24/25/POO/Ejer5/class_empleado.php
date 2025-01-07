<?php
class Empleados
{
    private $nombre, $sueldo;

    public function __construct($nombre_nuevo, $sueldo_nuevo)
    {
        $this->nombre = $nombre_nuevo;
        $this->sueldo = $sueldo_nuevo;
    }

    public function setNombre($nombre_nuevo)
    {
        $this->nombre = $nombre_nuevo;
    }
    public function setTamanyo($sueldo_nuevo)
    {
        $this->sueldo = $sueldo_nuevo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function getSueldo()
    {
        return $this->sueldo;
    }

    public function impuestos() {
        if ($this->getSueldo() > 3000) 
            echo "<p>El empleado <strong>".$this->nombre."</strong> con sueldo <strong>".$this->sueldo."</strong>  tiene que pagar impuestos</p>";
        else 
            echo "<p>El empleado <strong>".$this->nombre."</strong> con sueldo <strong>".$this->sueldo."</strong>  no tiene que pagar impuestos</p>";
    }
}
?>