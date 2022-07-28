<?php 
include("header.php");
if(ISSET($_SESSION['usuario'])) {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo_blog.css"> 
    <script type="text/javascript" src="ckeditor/ckeditor.js"> </script>
    
    <title></title>
</head>
<body>
    <section id="section-Form">
            <h2>Editar</h2>
            <div id="caja_form">
                <form action="editarActualizar.php" method="POST" enctype=multipart/form-data>
                
                        <?php 
                        $id = $_GET['id'];
            
                        include("Manejo_obj.php");
                        $editarEntrada = new Manejo_obj;
                        $editarEntrada ->entradaParaEditar($id);
                        ?>
                      
                    <div>
                    <input class="btn_entrada" style="margin-top:15px;" type="submit" value="Actualizar">                    
                    </div>
                </form>
                
            </div> 
    </section>  
</body> 

<?php include('footer.html')?>


<?php } else {
    header("location:index.php");}?>
    
</html>

