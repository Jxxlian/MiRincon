
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo_blog.css">    
    <title>Escritos</title>
</head>

<body>
<?php include("header.php")?>

<section>  
    <div class="preview_entrada">
        
        <?php
            include("Manejo_obj.php");
            $a = new Manejo_obj();
            $a->getContenidoPorFecha();
        ?>           
    


</section>

<?php include ('footer.html')?>

</body>
</html>
