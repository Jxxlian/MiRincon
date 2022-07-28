<?php session_start();  ?>
   <header>
        <div class="contenedor nav-flex">
            <div id="logo"> 
                

                 <a href='.\index.php'>Mi rincón</a> 
            </div>
            <!-- FALTA AGREGAR ANIMACIÓN AL OCULTAR/MOSTRAR EL MENÚ-->
            <div> 
            
                <nav id="barra_de_nav">
                    <ul id="menu">  <!-- esta clase solo esta puesta para menu oculto responsive -->
                        <li><a href=".\escritos.php">Escritos</a></li>                        
                        <li><a href=".\infPersonal.php">Sobre mi</a></li>                        
              
                        <!--ESTE ISSET ES PARA MOSTRAR/OCULTAR EL INICIO DE SESION-->
                        <?php                         
                            if(ISSET($_SESSION['usuario'])) { ?> 
                                <li><a href=".\Contacto.php" style="display: none";>Contacto</a></li>
                                <li><a href="#" id="btn-abrir-popup" style="display: none"; >Ingresar</a></li>  
                                <li><a href=".\Formulario_nuevaEntrada.php" style="display: block";>Nueva entrada</a></li> 
                                <li><a href=".\archivo.php" style="display: block";>Archivo</a></li> 
                                <li><a href=".\cerrarSesion.php" style="display: block";>Cerrar sesión</a></li> 
                           <?php } else { ?>   
                                <li><a href=".\Contacto.php" style="display: block";>Contacto</a></li>      
                                <?php include('Buscador.html') ?>                                                                      
                                <li><a href="#" id="btn-abrir-popup" style="display: block"; >Ingresar</a></li>  
                                <li><a href=".\cerrarSesion.php" style="display: none";>Cerrar sesión</a></li> 
                        <?php } ?>
                    </ul>


                </nav>
            </div>            
            <span id="menuIcono" onclick="Mostrar()"><img src="./img/hamburguesa.png" alt="ícono menú hamburguesa"></span>
        </div>               
    </header>

    <script src="menu.js"></script>
    
    <script type="text/javascript">
        window.addEventListener("scroll", function(){
            var cabecera = document.querySelector("header");
            cabecera.classList.toggle('deslizo', window.scrollY>0);
        })

    </script>

       
    
    <?php include ('loginpopup.html')?>