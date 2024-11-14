<?php
class Transaccion {
    public $id;
    public $descripcion;
    public $monto;

    public function __construct($id, $descripcion, $monto) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->monto = $monto;
    }
}
?>
