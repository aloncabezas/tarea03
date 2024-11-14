<?php
class GeneradorHtml {
    public static function renderFormulario() {
        return '
            <form method="post" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                    <div class="col-md-6">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Registrar Transacción</button>
                <button type="submit" name="generar_estado" class="btn btn-success mt-3">Generar Estado de Cuenta</button>
            </form>
        ';
    }

    public static function renderTablaTransacciones($transacciones) {
        if (empty($transacciones)) return '<p class="text-secondary">No hay transacciones registradas.</p>';

        $tabla = '<table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Monto (₡)</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($transacciones as $t) {
            $tabla .= "<tr>
                <td>{$t->id}</td>
                <td>{$t->descripcion}</td>
                <td>" . number_format($t->monto, 2) . "</td>
            </tr>";
        }

        $tabla .= '</tbody></table>';
        return $tabla;
    }
}
?>
