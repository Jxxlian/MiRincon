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

        <h2>Enviame un mensaje</h2>
        <div id="caja_form">
            
            <form action="datos_contacto.php" method="POST">
                <div class="container-fullName">
                    <div>
                    <label>Nombre</label>
                    <input type="text" name="nombre" pattern="[A-Za-z]{1,30}" title="Solo se permiten letras" require>
                    </div>
                    <div>
                    <label>Apellido</label>
                    <input type="text" name="apellido" pattern="[A-Za-z]{1,30}" title="Solo se permiten letras" require>
                    </div>
                </div>

                <label>Correo electrónico</label>
                <input type="email" name="correo" require>
                
                <label>Tu mensaje</label>
                <textarea style="height:180px" type="text" name="mensaje" require></textarea>
                     
                <div>
                    <input class="btn_entrada" type="submit" value="Enviar mensaje" onClick="return confirm('¿Estas seguro que queres enviar este mensaje?')">                    
                </div>
            
            </form>
        </div> 

    </section> 
    
    <?php include("footer.html") ?>   
</body>
   
</html>