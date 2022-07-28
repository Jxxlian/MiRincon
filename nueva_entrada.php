<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo_blog.css"> 
    <title></title>
</head>
<body>
    <?php include("header.php") ?> 


    <?php

    $id_url = $_GET['id'];
    
    
        if(ISSET($id_url))
        { 
            include("Manejo_obj.php");
            $nuevaEntrada = new Manejo_obj;
            $nuevaEntrada->entradaElegida($id_url);
        }       
    ?>        
   
    <?php include('footer.html')?>
</body>
</html>