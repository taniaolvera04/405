<?php
include("../../php/config.php"); 

$query = "SELECT * FROM contacto";
$result = $cx->query($query);

if ($result->num_rows > 0) {
    $listaContactos = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $listaContactos = [];
}
?>

<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF CONTACTOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="text-center" onload="cargarContactos()">

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="text-center w-100 m-auto">CRUD CONTACTOS</h1>
                </div>
                
                <div class="card-body">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bookmark-heart-fill mx-2" viewBox="0 0 16 16">
                        <path d="M2 15.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2zM8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z"/>
                      </svg> AGREGAR</button>

                      <table class="table table-striped table-dark w-75 m-auto mt-4">
                        <tr>
                            <td>ID</td>
                            <td>NOMBRE</td>
                            <td>A. MATERNO</td>
                            <td>A. PATERNO</td>
                            <td>TELEFONO</td>
                            <td colspan="2">ACTION</td>
                        </tr>

<?php foreach($listaContactos as $item): ?>
    <tr>
        <td> <?php echo $item['id']; ?> </td>
        <td> <?php echo $item['nombre']; ?> </td>
        <td> <?php echo $item['ap']; ?> </td>
        <td> <?php echo $item['am']; ?> </td>
        <td> <?php echo $item['telefono']; ?> </td>
     </tr>

     <?php endforeach; ?>
</table>
</body>
</html>


<?php

$html=ob_get_clean();

require_once '../libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf=new Dompdf();

$options=$dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

//$dompdf->loadHtml("HOLA YERSHOP");
$dompdf->loadHtml($html);

$dompdf->setPaper('letter');
//$dompdf->setPaper('A4','landscape');
$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment"=>false));//VISUALIZAR PDF CUANDO ESTA EN FALSE


?>