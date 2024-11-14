<?php
class EstadoDeCuenta {
    private $transacciones = [];

    public function registrarTransaccion($descripcion, $monto) {
        $id = uniqid();
        $transaccion = new Transaccion($id, $descripcion, $monto);
        $this->transacciones[] = $transaccion;
    }

    public function obtenerTransacciones() {
        return $this->transacciones;
    }

    public function generarEstadoDeCuenta() {
        $montoContado = array_reduce($this->transacciones, fn($suma, $t) => $suma + $t->monto, 0);
        $interes = $montoContado * 0.026;
        $cashback = $montoContado * 0.001;
        $montoFinal = $montoContado + $interes - $cashback;

        $estado = "EL estado de Cuenta:\n";
        $estado .= "************************\n";
        foreach ($this->transacciones as $t) {
            $estado .= "ID: {$t->id} | Descripción: {$t->descripcion} | Monto: ₡{$t->monto}\n";
        }
        $estado .= "************************\n";
        $estado .= "Monto Contado: ₡" . number_format($montoContado, 2) . "\n";
        $estado .= "Interés (2.6%): ₡" . number_format($interes, 2) . "\n";
        $estado .= "Cashback (0.1%): ₡" . number_format($cashback, 2) . "\n";
        $estado .= "Monto Final de Pagar: ₡" . number_format($montoFinal, 2) . "\n";

        file_put_contents("estado_cuenta.txt", $estado);

        return $estado;
    }
}
?>
