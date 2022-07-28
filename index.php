<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilo_blog.css">    
    <title>Página principal</title>
</head>
<body>
        
    <?php include("header.php") ?> 
    <?php include ('loginpopup.html')?>
       
    <div id="index_grid">        
            <div>
                <section class="slider">
                        <div class="slider__container container">
                            
                                        <?php    
                                        include("Manejo_obj.php");
                                        $a = new Manejo_obj();
                                        $primerID = $a->primerID();
                                        $a->getContenidoConImg($primerID);                                
                                        ?>
                        </div>
                </section>
            </div>     
            
            <section id="presentacion">
                <a href="infPersonal.php">
                    
                    <h1>Sobre mi....</h1>                    
                    <p>Flora Alejandra Pizarnik nació en el 29 de abril de 1936. Después de cursar estudios de filosofía y periodismo, que no terminó. Entre 1960 y 1964 vivió en París, estudió en La Sorbona. 

De regreso a Argentina publicó algunas de sus obras más destacadas. Los últimos años de su vida estuvieron marcados por serias crisis depresivas que la llevaron a intentar suicidarse. El 25 de septiembre de 1972 terminó con su vida con una sobredosis de secobarbital.</p>
                    
                </a>
            </section>
            
     </div>     
    <script src="slider.js">setInterval(changePosition); </script>
</body>
<?php include ('footer.html')?>
</html>
