<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nombre = $_POST['nombre1'];
$primerApellido = $_POST['primerApellido1'];
$segundoApellido = $_POST['segundoApellido1'];
$correo = $_POST['correo1'];
$contrasena = $_POST['contrasena1'];
$cedula = $_POST['cedula1'];
$telefono = $_POST['telefono1'];
$direccion =  $_POST['direccionExacta1'];
$distrito = $_POST['distrito1'];
$asada = $_POST['asada1'];

/*
$nombre = "Fontanera";
$primerApellido = "Nueva";
$segundoApellido = "Y asi";
$correo = "fontanera@fontanera.com";
$cedula = 190290192;
$telefono = 891289189;
$distrito = "Sabanilla";
$direccion =  "direccion";

*/

$query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");
$query2 = mysqli_query($conn,"SELECT idASADA FROM ASADA WHERE nombre = '$asada';");


if($query && $query2){
    $results = mysqli_fetch_array($query);
    $distrito = $results['idDISTRITO'];

    $results = mysqli_fetch_array($query2);
    $asada = $results['idASADA'];

    $sql = "INSERT into PERSONA (nombre, primerApellido, segundoApellido,idPersona, direccion, DISTRITO_idDISTRITO, TIPO_PERSONA_idTIPO_PERSONA) values ('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito, 1)";

    $sqlUsuario = "INSERT into USUARIO (nombreUsuario, contrasena, TIPO_USUARIO_idTIPO_USUARIO, PERSONA_cedula) values ('$correo', '$contrasena', 1, '$cedula')";

   $sqlAsada = "INSERT into USUARIO_X_ASADA (USUARIO_nombreUsuario, ASADA_idASADA) values ('$correo', '$asada')";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlUsuario) && mysqli_query($conn, $sqlAsada)){
         echo "Records inserted successfully.";
         //echo "si";
    } 
    else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        //echo "no";
     }
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   //echo "no";
}

mysqli_close ($conn); // Connection Closed.
?>

function submitForm() {
            alert("starting");
            console.log("submit event");
            var fd = new FormData(document.getElementById("fileinfo"));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "../php/editarASADA.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                alert("done");
                console.log("PHP Output:");
                console.log( data );
                result = data;
                alert(result);
            });
            alert("officially done");
            location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
            return false;
}