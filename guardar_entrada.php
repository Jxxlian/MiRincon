<?php
    include ("Manejo_obj.php");

    $conection = new Conexion();
    $c = $conection->conectarBD(); 

    $titulo = $_POST['titulo'];    
    $nota = $_POST['nota'];
    
    //atributos de IMG (la bbdd tb acepta que sea null)
    $nombre_img = $_FILES['imagen']['name'];
    $tipo_img = $_FILES['imagen']['type'];
    $size_img = $_FILES['imagen']['size'];

    if($tipo_img == 'image/jpeg' || $tipo_img == 'image/png' || $tipo_img == 'image/jpg') 
    {
        //subo el archivo
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Portafolio/Blog Periodista/img/';
        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_img);       
    } else {
        echo 'Error con el formato del archivo que pretende subir. Solamente podes cargar imagens jpg, jpeg o png';
    }        
         
    //establecer la hora
   date_default_timezone_set('America/Argentina/Buenos_Aires');
   $fechaActual = date("Y-m-d H:i:s"); 
   
   //generamos conexión a BBDD e intentamos cargar información 
   $entrada1 = new Manejo_obj();
   $query = $entrada1->cargarDatos($titulo, $fechaActual, $nota, $nombre_img);  
   
    try {
        $InsertEnBD = mysqli_query($c, $query); 
        echo '<br>';var_dump($InsertEnBD);
        if (!empty($InsertEnBD) && mysqli_affected_rows($c))  //consulto si hubo modificación en la BD y evito que se carguen campos vacios
            {
            echo 'se realizó carga a la BD'; 
            }
       // header("Location:index.php");   
    } catch (Exception $e) {
        echo "<br>Error en cargar información a la base de datos: " . $e->getMessage();
    }
header('location: escritos.php');
?>