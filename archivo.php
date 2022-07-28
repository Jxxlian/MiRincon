<?php
include("header.php");
include ('loginpopup.html');
include("Manejo_obj.php");

if(ISSET($_SESSION['usuario'])) 
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo_blog.css">    
    <title>Entradas archivadas</title>
</head>
<body>
         
    <section>
    <h1 id="tituloArchivo">Entradas archivadas</h1>    
    <h4 id="subtituloArchivo">Acá se encuentran todas las entradas que por algún motivo guardaste y ya no son visibles al público general, <br> ¿queres editarlas o volver a publicarlas?</h4>
    <div class="preview_entrada">
    
    <?php    
        $entrada = new Manejo_obj;
        $entrada->queryEntradasArchivadas();
    ?>

    </section>
</body>
    <?php include ('footer.html')?>

<?php }else{
    header("location:index.php");
} ?>    

</html>
