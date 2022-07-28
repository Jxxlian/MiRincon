<?php
include("Manejo_obj.php");

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$fecha = $_POST['fecha'];
$nota = $_POST['nota'];

$imagen = $_FILES['imagen']['name'];
$tipo_img = $_FILES['imagen']['type'];
$size_img = $_FILES['imagen']['size'];

if ($imagen == "") {
    $actualizarEntrada = new Manejo_obj;
    $actualizarEntrada ->actualizarSinIMG($id, $titulo, $nota); //en esta actualización se conserva la imagen que ya tenía la entrada 
} else {
    if($tipo_img == 'image/jpeg' || $tipo_img == 'image/png' || $tipo_img == 'image/jpg') 
    {
        //subo el archivo
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . './img/';
        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$imagen);       
    } else {
        echo 'Error con el formato del archivo que pretende subir. Solamente podes cargar imagens jpg, jpeg o png';
    }  
   
$actualizarEntrada = new Manejo_obj;
$actualizarEntrada ->actualizar($id, $titulo, $nota, $imagen);
}
header('location:index.php');
?>