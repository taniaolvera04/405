<?php
if (isset($_FILES['archivo'])) {

    extract($_POST);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $carpeta_destino = "files/";
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    if (in_array($extension, ["pdf", "doc", "docx", "png", "jpg", "jpeg", "mp3", "mp4"])) {
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            include "db.php";
            $sql = "INSERT INTO documentos (nombre, descripcion, archivo) VALUES ('$nombre', '$descripcion','$nombre_archivo')";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo '<html><head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body>';
                echo '<script type="text/javascript">
                Swal.fire({title: "¡SE SUBIÓ EL ARCHIVO CORRECTAMENTE!", text: "", icon: "success"}).then(() => {
                    window.location.href = "../views/index.php"; 
                });
                </script>';
                echo '</body></html>';
            } else {
                echo '<html><head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body>';
                echo '<script type="text/javascript">
                Swal.fire({title: "ERROR", text: "No se pudo subir archivo", icon: "error"}).then(() => {
                    window.location.href = "../views/index.php";
                });
                </script>';
                echo '</body></html>';
            }
        } else {
            echo '<html><head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body>';
            echo '<script type="text/javascript">
            Swal.fire({title: "ERROR", text: "Error al subir archivo", icon: "error"}).then(() => {
                window.location.href = "../views/index.php";
            });
            </script>';
            echo '</body></html>';
        }

    } else {
        echo '<html><head><script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head><body>';
        echo '<script type="text/javascript">
        Swal.fire({title: "Error", text: "Solo se permiten archivos PDF, DOC, DOCX, PNG, JPG, JPEG, MP3, MP4", icon: "error"}).then(() => {
            window.location.href = "../views/index.php";
        });
        </script>';
        echo '</body></html>';
    }
}
?>
