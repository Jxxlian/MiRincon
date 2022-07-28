<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo_blog.css">    
    <title>Document</title>
</head>
<body>
    <?php  
    include('header.php'); 

    include("Manejo_obj.php");
    $entrada = new Manejo_obj;
    $id = $entrada -> mostrarBusqueda();   

    include('footer.html')
    ?>
</body>
</html>
