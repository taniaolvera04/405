<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPERACIONES MATEMÁTICAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="text-center">

<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <span class="navbar-brand m-auto w-100 h1">CALCULADORA PHP</span>
  </div>
</nav><br>

<form action="index.php" method="post">
    <h2>Número 1</h2>
    <input type="number" name="a" id="" class="form-control w-75 m-auto"><br> <!--AQUÍ SI IMPORTA EL NAME-->

    <h2>Número 2</h2> 
<input type="number" name="b" id="" class="form-control w-75 m-auto"><br>

<input type="submit" value="ENVIAR" class="btn btn-success"><br><br>
</form>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

    $a=@$_REQUEST['a']; //$ ES COMO LET O VAR
    $b=@$_REQUEST['b'];

    if(empty($_POST['a'])|| empty($_POST['b'])){
        echo '<script type="text/javascript">;
        Swal.fire({
          title: "CAMPOS VACÍOS",
          text: "Ingresa valores válidos",
          icon: "error"
        });
        </script>';
    }
    else{
    $suma=$a+$b;
    $resta=$a-$b;
    $multi=$a*$b;
    $div=$a/$b;
    $mo=$a%$b;

    if($a>$b){
        $mayor=$a;
        $menor=$b;
    }else{
        $mayor=$b;
        $menor=$a;
    }

    echo "<h1>SUMA: ".$suma."</h1>"; //PARA CONCATENAR ES .
    echo "<h1>RESTA: ".$resta."</h1>";
    echo "<h1>MULTIPLICACIÓN: ".$multi."</h1>";
    echo "<h1>DIVISIÓN: ".$div."</h1>";
    echo "<h1>MÓDULO: ".$mo."</h1>";
    echo "<h1>MAYOR: ".$mayor."</h1>";
    echo "<h1>MENOR: ".$menor."</h1>"; 
    echo "<h1>NÚMERO  ".$a." ES ".(($a%2==0)?"PAR":"IMPAR")."</h1>"; 
    echo "<h1>NÚMERO  ".$b." ES ".(($b%2==0)?"PAR":"IMPAR")."</h1>"; 

//EL SYSTEM.OUT.PRINTLN ES ECHO EN PHP
  
     

}

//COIGO PHP SE EJECUTA DEL LADO DE SERVIDOR Y LO QUE SE LE MUESTRA AL CLIENTE ES EL RESULTADO.

?>


    
</body>
</html>



