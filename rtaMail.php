<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo_blog.css">    
    <title>Contacto</title>
</head>
    
<body> 
    <?php include("header.php") ?> 
    <?php include('loginpopup.html')?>

                    
    <section id="section-Form">
    <?php 
         if(isset($_GET['ok'])) {
            echo '<div class="container-rta">
                    <h1> Mensaje enviado con éxito </h1>
                    <h3> A la brevedad estaremos enviandote una respuesta </h3>
                    <a href="index.php">Hace click aquí para volver al inicio</a>
                  </div>';
        } else { 
                $error = $_GET['$bad'];
                echo '<div class="container-rta">
                        Ha ocurrido un error al intentar mandar el mail: <br/><br/><i>' .$error.'</i><br/><br/>
                        <a href="index.php">Hace click aquí para volver al inicio</a>
                      </div>';
        } 
    ?>
        

    </section> 
    
    <?php include("footer.html") ?>   
</body>
   
</html>