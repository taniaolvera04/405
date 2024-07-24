<?php
require_once "config.php";
header('Content-Type: application/json; charset=utf-8');
$valido = array('success' => false, 'mensaje' => "");

$action = $_REQUEST['action'];

if ($action === 'registrar') {
    if ($_POST) {
        $a = $_POST['dulce'];
        $b = $_POST['precio'];

        $sql = "INSERT INTO dulceria VALUES(null,'$a','$b')";
        if ($cx->query($sql)) {
            $valido['success'] = true;
            $valido['mensaje'] = "SE REGISTRÓ CORRECTAMENTE";
        } else {
            $valido['mensaje'] = "ERROR AL REGISTRAR";
        }
    } else {
        $valido = array('success' => false, 'mensaje' => "ERROR AL GUARDAR");
    }
    echo json_encode($valido);
    
} elseif ($action === 'selectAll') {
    if ($_POST) {
        $sql = "SELECT * FROM dulceria";

        $registros = array('data' => array());
        $res = $cx->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_array()) {
                $registros['data'][] = array($row[0], $row[1], $row[2]);
            }
        }
    } else {
        $valido = array('success' => false, 'mensaje' => "ERROR AL CARGAR");
        echo json_encode($valido);
    }
    echo json_encode($registros);
    
}elseif ($action === 'buscar') {
    if ($_POST) {
        $i=$_POST['i'];
        $sql = "SELECT * FROM dulceria WHERE dulce LIKE '%$i%' OR precio LIKE '$i'";

        $registros = array('data' => array());
        $res = $cx->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_array()) {
                $registros['data'][] = array($row[0], $row[1], $row[2]);
            }
        }
    } else {
        $valido = array('success' => false, 'mensaje' => "ERROR AL CARGAR");
        echo json_encode($valido);
    }
    echo json_encode($registros);
} else {
    echo json_encode(["error" => "Método no permitido"]);
}
?>
