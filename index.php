<?php
require_once 'classes/Transaccion.php';
require_once 'classes/EstadoDeCuenta.php';
require_once 'classes/GeneradorHtml.php'; // Cambiado aquí

session_start();
if (!isset($_SESSION['estadoDeCuenta'])) {
    $_SESSION['estadoDeCuenta'] = new EstadoDeCuenta();
}

$estadoDeCuenta = $_SESSION['estadoDeCuenta'];
$estadoDeCuentaTexto = null;

// Manejar registro de transacciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['descripcion'], $_POST['monto'])) {
        $descripcion = htmlspecialchars($_POST['descripcion']);
        $monto = (float) $_POST['monto'];
        $estadoDeCuenta->registrarTransaccion($descripcion, $monto);
    }

    if (isset($_POST['generar_estado'])) {
        $estadoDeCuentaTexto = $estadoDeCuenta->generarEstadoDeCuenta();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd;
        }
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center text-primary">Sistema de Estado de Cuenta</h1>
    <?= GeneradorHtml::renderFormulario() ?>
    <h3 class="text-secondary">Transacciones Registradas</h3>
    <?= GeneradorHtml::renderTablaTransacciones($estadoDeCuenta->obtenerTransacciones()) ?>

    <?php if ($estadoDeCuentaTexto): ?>
        <div class="alert alert-info mt-4">
            <pre><?= $estadoDeCuentaTexto ?></pre>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
