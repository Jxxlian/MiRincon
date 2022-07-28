<?php 
    include("header.php");
    include('loginpopup.html');

if(ISSET($_SESSION['usuario'])) 
{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo_blog.css">    
    <script type="text/javascript" src="ckeditor/ckeditor.js"> </script>
        
    <title>Redacción</title>
</head>
    
<body> 
            
    <section id="section-Form">
            <h2>Escribir nueva entrada</h2>            
            <form id="form_entrada" method="POST" enctype="multipart/form-data">
                
                    <label>Título</label>
                    <input type="text" name="titulo" >                   
                    
                    <label>Nueva entrada</label>
                    <div class="editor-size">
                        <textarea name="nota" id="editorDeTexto" ></textarea>
                    </div>
                        <script>
                            CKEDITOR.replace('editorDeTexto', {
                                extraPlugins: 'resize',
                                /* width: 800     */
                            });
                        </script> 
 
                    <label>Subír imagen (menor a 2MB)</label>
                    <input class="img-form" type="file" name="imagen">
                    
                        <div>
                            <input class="btn_entrada" style="margin-top:15px;" type="submit" value="Subir nueva entrada">                    
                        </div>
                </form>


        </section> 
                
    </body>
   
    <?php include("footer.html") ?> 
    <script src="confirmar.js"></script>
</html>

<?php } else {    
    header("location:index.php");
} 
?>