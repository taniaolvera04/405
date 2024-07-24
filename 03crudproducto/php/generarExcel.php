
<?php

// Habilitar visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pro";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT nombrep, precio, cantidad, proveedor, unidadm, categoria FROM producto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="productos.xls"');
    header('Cache-Control: max-age=0');

    $output = fopen("php://output", "w");
    if ($output !== FALSE) {
        // Escribir encabezados
        fwrite($output, implode("\t", ['Nombre Producto', 'Precio', 'Cantidad', 'Proveedor', 'Unidad de Medida', 'Categoria']) . "\n");

        // Escribir datos
        while($row = $result->fetch_assoc()) {
            fwrite($output, implode("\t", $row) . "\n");
        }

        fclose($output);
    } else {
        echo "Error al abrir la salida de datos.";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>
