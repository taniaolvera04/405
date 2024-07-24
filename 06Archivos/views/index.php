<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUBIR ARCHIVOS</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
   
 

    <style>
        a {
            text-decoration: none;
        }

        .s {
            padding-top: 50px;
            text-align: center;
        }
        #musica {
        width: 100%;
    }

    #musica td {
        text-align: center; 
    }

    h3 {
        color: rebeccapurple;
    }

    </style>
</head>
<body class="text-center">

<nav class="navbar bg-dark">
        <div class="container-fluid text-center">
            <h1 class="navbar-brand m-auto text-white">SUBIR ARCHIVOS</h1>
        </div>
    </nav><br>

    <button type="button" class="btn btn-success mx-4" data-bs-toggle="modal" data-bs-target="#agregarA"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
</svg></button>
                <br><br>
            

            <div class="container">
                <table class="table table-dark table-striped" id="dataTable" width="75%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>USUARIO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>ARCHIVO</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    require_once "../includes/db.php";
    $consulta = mysqli_query($conexion, "SELECT * FROM documentos");
    while ($fila = mysqli_fetch_assoc($consulta)):
    ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['nombre']; ?></td>
            <td><?php echo $fila['descripcion']; ?></td>
            <td><?php echo $fila['archivo']; ?></td>
            <td>
                <button class="btn btn-info" onclick="downloadAndOpen('<?php echo $fila['id']; ?>', '<?php echo $fila['archivo']; ?>')">

                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="white" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
  <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708"/>
</svg>
                </button>
                <button class="btn btn-danger" onclick="eliminar('<?php echo $fila['id']; ?>')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></button>

            </td>
        </tr>
    <?php endwhile; ?>
</tbody>

                </table>
            </div>
        </div>

       
        
        <div class="modal fade" id="agregarA" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 w-100 m-auto" id="exampleModalLabel">AGREGAR UN ARCHIVO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../includes/upload.php" method="POST" enctype="multipart/form-data">
                  
                <table class="w-100">
    <tr>
        <td><label for="nombre" class="form-label m-auto mb-4">USUARIO</label></td>
        <td><input type="text" id="nombre" name="nombre" class="form-control m-auto mb-3" required></td>
    </tr>
    <tr>
        <td><label for="descripcion" class="form-label m-auto mb-4">DESCRIPCIÓN</label></td>
        <td><input type="text" id="descripcion" name="descripcion" class="form-control m-auto mb-3" required></td>
    </tr>
    <tr>
        <td><label for="archivo" class="form-label m-auto mb-4">ARCHIVO</label></td>
        <td><input type="file" name="archivo" id="archivo" class="form-control m-auto mb-3" required></td>
    </tr>
</table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" id="register" name="registrar">Guardar</button>
            </div>
                </form>
        </div>
    </div>
</div>

    </div><br><br>
    
    <table id="musica">
    <tr><h3>PLAYLIST</h3></tr>
    <?php

    // Consulta para obtener los archivos MP3
    $consulta = mysqli_query($conexion, "SELECT * FROM documentos WHERE archivo LIKE '%.mp3'");
    
    // Itera sobre los resultados y muestra las etiquetas de audio
    while ($fila = mysqli_fetch_assoc($consulta)) {
        $nombre_archivo = $fila['archivo'];
        $ruta_archivo = "../includes/files/" . $nombre_archivo;
    ?>
    <tr>
       
        <td> <center><audio controls><source src="<?php echo $ruta_archivo; ?>"></audio> </center></td>
       
    </tr>
    <?php
    }
    ?>
</table>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script>

function downloadAndOpen(id, filename) {
    var downloadUrl = '../includes/download.php?id=' + id;
    var openUrl = '../includes/files/' + filename;

    // Abrir el archivo en una nueva ventana
    var win = window.open(openUrl, '_blank');

    // Descargar el archivo
    var link = document.createElement('a');
    link.href = downloadUrl;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

const eliminar = async (id) => {
    Swal.fire({
        title: "¿Estás seguro de eliminar este archivo?",
        showDenyButton: true,
        confirmButtonText: "Sí, estoy seguro",
        confirmButtonColor: '#20c997',
        denyButtonText: "No estoy seguro"
    }).then(async (result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append('id', id);

            try {
                let response = await fetch('../includes/delete.php', {
                    method: 'POST',
                    body: formData
                });

                let json = await response.json();

                if (json.success) {
                    Swal.fire({
                        title: "¡Se eliminó con éxito!",
                        text: "Archivo eliminado",
                        icon: "success"
                    }).then(() => {
                        location.reload(); // Recargar la página para reflejar los cambios
                    });
                } else {
                    Swal.fire({
                        title: "ERROR",
                        text: json.message || "No se pudo eliminar el archivo",
                        icon: "error"
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: "ERROR",
                    text: "Ocurrió un error al eliminar el archivo",
                    icon: "error"
                });
            }
        }
    });
};

</script>

</body>
</html>
