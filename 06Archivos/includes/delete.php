<?php
require_once "db.php";

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $consulta = mysqli_query($conexion, "SELECT archivo FROM documentos WHERE id = $id");
    $fila = mysqli_fetch_assoc($consulta);

    if ($fila) {
        $archivo = $fila['archivo'];
        $ruta = "../files/" . $archivo;

        // Eliminar el archivo del servidor
        if (file_exists($ruta)) {
            unlink($ruta);
        }

        // Eliminar el registro de la base de datos
        $sql = "DELETE FROM documentos WHERE id = $id";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el registro de la base de datos.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Archivo no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no especificado.']);
}
?>
