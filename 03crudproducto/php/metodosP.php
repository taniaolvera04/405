<?php
require_once "config.php";
$valido['success']=array('success'=>false,'mensaje'=>"");

if($_SERVER['REQUEST_METHOD']==='POST'){

 $action=$_REQUEST['action'];

 switch($action){
    case "guardar":

    $a=$_POST['nombre'];
    $b=$_POST['precio'];
    $c=$_POST['cantidad'];
    $d=$_POST['proveedor'];
    $e=$_POST['unidadm'];
    $f=$_POST['categoria'];

    $sql="INSERT INTO producto VALUES (null,'$a','$b','$c','$d','$e','$f')";
    if($cx->query($sql)){
       $valido['success']=true;
       $valido['mensaje']="SE GUARDÓ CORRECTAMENTE";
    }else{
        $valido['success']=false;
       $valido['mensaje']="ERROR AL GUARDAR EN BD"; 
    }
    

echo json_encode($valido);

break;


case "selectAll":

    $sql="SELECT * FROM producto";
    $registros=array('data'=>array());
    $res=$cx->query($sql);
    if($res->num_rows>0){
        while($row=$res->fetch_array()){
            $registros['data'][]=array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6]);
        }
    }
    
    echo json_encode($registros);

break;


case "delete":

    $id=$_POST['id'];

    $sql="DELETE FROM producto WHERE id=$id";
    if($cx->query($sql)){
       $valido['success']=true;
       $valido['mensaje']="SE ELIMINÓ CORRECTAMENTE";
    }else{
        $valido['success']=false;
       $valido['mensaje']="ERROR AL ELIMINAR EN BD"; 
    }

    echo json_encode($valido);

break;


case "select":

    $valido['success']=array('success'=>false,
'mensaje'=>"",
'id'=>"",
'nombrep'=>"",
'precio'=>"",
'cantidad'=>"",
'proveedor'=>"",
'unidadm'=>"",
'categoria'=>"");

$id=$_POST['id'];
    $sql="SELECT * FROM producto WHERE id=$id";

    $res=$cx->query($sql);
    $row=$res->fetch_array();
    
    $valido['success']==true;
    $valido['mensaje']="SE ENCONTRÓ PRODUCTO";

    $valido['id']=$row[0];
    $valido['nombre']=$row[1];
    $valido['precio']=$row[2];
    $valido['cantidad']=$row[3];
    $valido['proveedor']=$row[4];
    $valido['unidadm']=$row[5];
    $valido['categoria']=$row[6];

echo json_encode($valido);

break;


case "update":

    $id=$_POST['id'];
    $a=$_POST['nombre'];
    $b=$_POST['precio'];
    $c=$_POST['cantidad'];
    $d=$_POST['proveedor'];
    $e=$_POST['unidadm'];
    $f=$_POST['categoria'];

    $sql="UPDATE producto SET nombrep='$a',
    precio='$b',
    cantidad='$c',
    proveedor='$d',
    unidadm='$e',
    categoria='$f'
    WHERE id=$id";

    if($cx->query($sql)){
       $valido['success']=true;
       $valido['mensaje']="SE ACTUALIZÓ CORRECTAMENTE EL PRODUCTO";
    }else{
        $valido['success']=false;
       $valido['mensaje']="ERROR AL ACTUALIZAR EN BD"; 
    }
    echo json_encode($valido);
   break;

  case "categorias":
    header('Content-Type: application/json; charset=utf-8');
    $categorias = json_decode($_POST['categorias']); 

    $categorias_str = "'" . implode("','", $categorias) . "'";

    $sql = "SELECT * FROM producto WHERE categoria IN ($categorias_str)";
    $registro = ['data' => []];
    $res = $cx->query($sql);

    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_array()) {
            $registro['data'][] = [$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]];
        }
    }

    echo json_encode($registro);

    break;


 }


}else{
    echo json_encode(["error" => "Método no permitido"]);
   }
   

?>