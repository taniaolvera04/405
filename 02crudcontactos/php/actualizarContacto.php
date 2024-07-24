<?php
require_once "config.php";
$valido['success']=array('success'=>false,'mensaje'=>"");

if($_POST){

    $id=$_POST['id'];
    $a=$_POST['nombre'];
    $b=$_POST['ap'];
    $c=$_POST['am'];
    $d=$_POST['telefono'];

    $sql="UPDATE contacto SET nombre='$a',
    ap='$b',
    am='$c',
    telefono='$d'
    WHERE id=$id";

    if($cx->query($sql)){
       $valido['success']=true;
       $valido['mensaje']="SE ACTUALIZÓ CORRECTAMENTE EL CONTACTO";
    }else{
        $valido['success']=false;
       $valido['mensaje']="ERROR AL ACTUALIZAR EN BD"; 
    }
    
}else{
$valido['success']=false;
$valido['mensaje']="ERROR AL ACTUALIZAR";

}
echo json_encode($valido);
?>