<?php

include("Conexion.php");
include("Obj_entrada.php");

class Manejo_obj{

    //método para cargar nota a la BD
    public function cargarDatos($titulo, $fecha, $nota, $imagen)
    {
        $query = "INSERT INTO db_blog (Titulo, Fecha, Nota, Imagen, Activo) VALUES ('$titulo', '$fecha', '$nota', '$imagen', 1)";
        return $query;
    }   
    
   
    //método para mostrar contenido de BD
    public function getContenidoPorFecha() 
        {
            $conection = new Conexion();
                     
            //Consulto a BD, armo objeto y muestro 
            $query = 'SELECT * FROM db_blog WHERE Activo = "1" ORDER BY ID'; 
            $consulta = mysqli_query($conection->conectarBD(), $query); //conecta y ejecuto consulta

            $cant_por_pag = 6;
            if (ISSET($_GET["p"]))
            {
                    if($_GET["p"] == 1 )
                {
                    header("location:escritos.php");
                } else {
                    $pagina = $_GET["p"];
                }
            } else {
                $pagina = 1;
            }
            $empieza_desde = ($pagina - 1)*$cant_por_pag; //desde donde empieza el limit de la consulta
            $num_filas = $consulta->num_rows; //cantidad de filas en la base de datos            ;
            $total_pag = ceil($num_filas/$cant_por_pag); //cantidad de páginas que voy a tener según la cantidad de filas existentes 
            
            $query_limit = "SELECT ID, Titulo, DATE_FORMAT(Fecha, '%d - %m - %Y') AS fecha, Nota, Imagen  FROM db_blog WHERE Activo = '1' ORDER BY ID DESC LIMIT $empieza_desde, 
            $cant_por_pag";

            $consulta_limit = mysqli_query($conection->conectarBD(), $query_limit);
                   
                    while($dato = mysqli_fetch_assoc($consulta_limit)){

                        $entrada = new Entrada();

                        $entrada->setID($dato['ID']);
                        $entrada->setTitulo($dato['Titulo']);                        
                        $entrada->setFecha($dato['fecha']);
                        $entrada->setNota($dato['Nota']);
                        $entrada->setImg($dato['Imagen']);
                        
                        echo'<div class="p_entrada">
                            
                            <a href="nueva_entrada.php?id='.$entrada->getId().'">
                            <h1>' . $entrada->getTitulo(). ' </h1>
                            <h4>' . $entrada->getFecha() . '</h4></a>' ;    
                            
                        //SI INICIÓ SESION, PERMITO QUE SE VEAN ESTAS OPCIONES
                        if(ISSET($_SESSION['usuario'])) 
                        {                        
                        echo       '<div id="contenedor_btn">
                                        <a class="editar_entrada" href="editar.php?id='. $entrada->getId() .'" onClick="return confirm(\'¿Estas seguro que queres editar esta entrada?\')">Editar</a>
                                        <a class="borrar_entrada" href="desactivar_entrada.php?id='. $entrada->getId() .'" onClick="return confirm(\'¿Estas seguro que queres editar esta entrada?\')">Borrar</a>
                                    </div>  
                            </div>';
                        
                        } else {                        
                            echo '</div>'; //corresponde al div que tiene class="p_entrada"
                            }; 
                        }            
                    
                    //paginación
                    echo "<div id='paginacion-container'> 
                            <span>Páginas: </span>";
                        for($i=1; $i<=$total_pag; $i++) {
                    echo "<a href='?p=" .$i. "'>" . $i .  "</a>";
                        } ; 
                    echo  "</div>";                   
               
         

        } //cierra getcontenidoporfecha()

    //BUSCO EL ÚLTIMO ELEMTNO CARGADO EN LA BD (CON IMG) PARA QUE SEA EL 1er ELEMENTO DEL SLIDER
    public function primerID()
    {
        $conection = new Conexion();
        
            $query_nuevo = "SELECT * FROM db_blog WHERE Imagen <> '' && Activo = '1' ORDER BY Fecha ASC LIMIT 1 ";
            $consulta_nuevo = mysqli_query($conection->conectarBD(), $query_nuevo); 
            $array_nuevo = mysqli_fetch_assoc($consulta_nuevo);
            $ID_nuevo = $array_nuevo['ID'];
            
            return $ID_nuevo;        
    }

    //método para mostrar entradas solo con IMG. Lo uso en el Slider.
    public function getContenidoConImg($primerID) 
    {
        $conection = new Conexion();            
            //Consulto a BD, armo objeto y muestro 
            $query = "SELECT ID, Titulo, DATE_FORMAT(Fecha, '%d - %m - %Y') AS fecha, Nota, Imagen FROM db_blog WHERE Imagen <> '' && Activo = '1' ORDER BY Fecha DESC LIMIT 4";
            //conecta y ejecuto consulta
            $consulta = mysqli_query($conection->conectarBD(), $query); 
            
                                 
            while($dato = mysqli_fetch_assoc($consulta)){

                $entrada = new Entrada();

                $entrada->setID($dato['ID']);
                $entrada->setTitulo($dato['Titulo']);                
                $entrada->setFecha($dato['fecha']);
                $entrada->setNota($dato['Nota']);
                $entrada->setImg($dato['Imagen']);
                
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . './img/';

                //CON EN ESTE IF DETERMINO QUE ELEMENTO VA A TENER LA CLASS 'slider__body--show', SERIA EL PRIMERO EN MOSTRARSE
                if($primerID == $entrada->getId()) {
                echo '
                <section id="slider__body" class="slider__body slider__body--show" data-id="'. $entrada->getId() .'">
                   
                        <a href="nueva_entrada.php?id='. $entrada->getId().'" class="slider__text">
                            <h2 class="slider-title">'. $entrada->getTitulo() .'</h2>                                 
                            <p class="slider-abstract">'. $entrada->getFecha() .'</p>
                        </a>
                

                        <figure class="slider__picture">
                            <img src="img/'. $entrada->getImg() .'" class="slider__img">
                        </figure>
                    
                </section>';
                } else {
                    echo '
                    <section id="slider__body" class="slider__body" data-id="'. $entrada->getId() .'">

                        <a href="nueva_entrada.php?id='. $entrada->getId().'" class="slider__text">
                            <h2 class="slider-title">'. $entrada->getTitulo() .'</h2>                            
                            <p class="slider-abstract">'. $entrada->getFecha() .'</p>
                        </a>
                        
                        <figure class="slider__picture">
                            <img src="img/'. $entrada->getImg() .'" class="slider__img">
                        </figure>
                        
                    </section>';   
                }
            }
    }

    public function entradaElegida($id_url)
        {
            
            if($id_url > 0) {  /* condicional para evitar que entre sin pasar URL por parámetro */
            $conection = new Conexion();
                     
            //Consulto a BD, armo objeto y muestro 
            $query = "SELECT ID, Titulo, DATE_FORMAT(Fecha, '%d - %m - %Y') AS fecha, Nota, Imagen  FROM db_blog WHERE Activo = '1' ORDER BY ID";
            $consulta = mysqli_query($conection->conectarBD(), $query); //conecta y ejecuto consulta         
           
                 while($dato = mysqli_fetch_assoc($consulta)){
                    if($dato['ID'] == $id_url) 
                    
                    {
                        $entrada = new Entrada();

                        $entrada->setID($dato['ID']);
                        $entrada->setTitulo($dato['Titulo']);                        
                        $entrada->setFecha($dato['fecha']);
                        $entrada->setNota($dato['Nota']);
                        $entrada->setImg($dato['Imagen']);
                        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . './img/';
                            
                        
                        if($entrada->getImg() != '') {
                        echo '<div id="mostrarEntrada"> 
                                <div class="container--head">                             
                                    <div>
                                    <h1>' . $entrada->getTitulo() . '</h1>
                                    <h4>' . $entrada->getFecha() . '</h4>                            
                                    </div>
                                    
                                    <div> 
                                    <img src="./img/'.$entrada->getImg().'"/>
                                    </div>
                                </div>

                                <p>' . $entrada->getNota() . '</p>
                            </div>';
                        } else {
                            echo '<div id="mostrarEntrada">                              
                            
                                    <h1>' . $entrada->getTitulo() . '</h1>
                                    <h4>' . $entrada->getFecha() . '</h4>                                                   
                                
                                    <p>' . $entrada->getNota() . '</p>
                                </div>';
                        }
                    }
                } 
            } else {
                header('location:index.php');
            }
        }

        /* esta funcion la utilizo para el buscador del header */
        function mostrarBusqueda() {

            $conec = new Conexion;
            $busqueda = $_POST['busqueda'];

            if(isset($_POST['enviar']) & $busqueda != ''){                 
                $query ="SELECT ID, Titulo, DATE_FORMAT(Fecha, '%d - %m - %Y') AS fecha, Nota, Imagen 
                         FROM db_blog WHERE Activo = 1 AND Titulo LIKE '%$busqueda%' OR Nota LIKE '%$busqueda%'";
                $consulta = mysqli_query($conec->conectarBD(),$query);
                
                if( mysqli_fetch_assoc($consulta) > 0 ) { 
                    
                $cant_por_pag = 6;
                if (ISSET($_GET["p"]))
                {
                        if($_GET["p"] == 1 )
                    {
                        header("location:escritos.php");
                    } else {
                        $pagina = $_GET["p"];
                    }
                } else {
                    $pagina = 1;
                }
                $empieza_desde = ($pagina - 1)*$cant_por_pag; //desde donde empieza el limit de la consulta
                $num_filas = $consulta->num_rows; //cantidad de filas en la base de datos            ;
                $total_pag = ceil($num_filas/$cant_por_pag); //cantidad de páginas que voy a tener según la cantidad de filas existentes 
                
                
                $query_limit = "SELECT ID, Titulo, DATE_FORMAT(Fecha, '%d - %m - %Y') AS fecha, Nota, Imagen  
                            FROM db_blog 
                            WHERE Activo = '1' && Titulo LIKE '%$busqueda%' OR Nota LIKE '%$busqueda%' 
                            ORDER BY ID DESC LIMIT $empieza_desde, $cant_por_pag";
    
                $consulta_limit = mysqli_query($conec->conectarBD(), $query_limit);
                
                            
                    while($row = mysqli_fetch_assoc($consulta_limit)){
                        $entrada = new Entrada();
    
                        $entrada->setID($row['ID']);
                        $entrada->setTitulo($row['Titulo']);                        
                        $entrada->setFecha($row['fecha']);
                        $entrada->setNota($row['Nota']);
                        $entrada->setImg($row['Imagen']);                   
                                               
                   
                        echo'<div class="p_entrada">                                
                                <a href="nueva_entrada.php?id='.$entrada->getId().'">
                                <h1>' . $entrada->getTitulo(). ' </h1>
                                <h4>' . $entrada->getFecha() . '</h4></a>
                            </div>';                      
                        } 
                        
                        echo "<div id='paginacion-container'> 
                        <span>Páginas: </span>";
                            for($i=1; $i<=$total_pag; $i++) {
                            echo "<a href='?p=" .$i. "'>" . $i .  "</a>";
                            } ; 
                        echo  "</div>"; 
                        } else {
                            echo'<div class="notFound">
                                    <h1> No hay coincidencia en tu búsqueda </h1>
                                    <a href="index.php">Haz click aquí para volver al inicio</a>
                                </div>';
                        } 
                    } else {
                        echo'<div class="notFound">
                                <h1> No hay coincidencia en tu búsqueda </h1>
                                <a href="index.php">Haz click aquí para volver al inicio</a>
                            </div>';
                    }

                    
                }
                       
                        

        
    public function desactivarEntrada($id_parametro) 
    {
        $conection = new Conexion();            
        //Consulto a BD, armo objeto y muestro 
        $id = $id_parametro;
        $query = "UPDATE db_blog SET Activo = 0 WHERE ID = $id";
        //conecta y ejecuto consulta
        $consulta = mysqli_query($conection->conectarBD(), $query); 
    }

    public function activarEntrada($id) 
    {
        $conection = new Conexion();            
        //Consulto a BD, armo objeto y muestro 
        
        $query = "UPDATE db_blog SET Activo = 1 WHERE ID = $id";
        //conecta y ejecuto consulta
        mysqli_query($conection->conectarBD(), $query); 
    }

    public function entradaParaEditar($id_parametro) {
        $conection = new Conexion();                     
        $id = $id_parametro;
        $query = "SELECT * FROM db_blog WHERE ID = $id";
        $consulta = mysqli_query($conection->conectarBD(), $query); 

        while($dato = mysqli_fetch_assoc($consulta))
                {        
                $entrada = new Entrada();

                $entrada->setID($dato['ID']);
                $entrada->setTitulo($dato['Titulo']);
                $entrada->setFecha($dato['Fecha']);
                $entrada->setNota($dato['Nota']);
                $entrada->setImg($dato['Imagen']);
                
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . './img/';

                echo '<label>Título</label> 
                    <input type="hidden" name="fecha" value="'.$entrada->getFecha() .'">     
                    <input type="text" name="id" value="'.$entrada->getId() .'" style="display: none;" >     
                    <input type="text" name="titulo" value="'.$entrada->getTitulo() .'" >                
                    
                    <label>Escribí tu nota acá</label> 
                    <textarea name="nota" id="nota_edit">'. $entrada->getNota().'</textarea> 

                    <script>
                            CKEDITOR.replace("nota_edit");
                    </script>
                    
                    <label>Subír imagen (menor a 2MB)</label> 
                    <input class="img-form" type="file" name="imagen" value="'.$entrada->getImg() .'" >';                   
                }
        }   
        
    
        public function actualizar($id, $titulo, $nota, $imagen){
            $id = $id;
            $titulo = $titulo;            
            $nota = $nota;
            $imagen = $imagen;

            $conection = new Conexion();                                 
            $query = "UPDATE db_blog 
                    SET Titulo = '$titulo', Nota = '$nota', Imagen = '$imagen' 
                    WHERE ID = $id";
            mysqli_query($conection->conectarBD(), $query); 
        }   

        public function actualizarSinIMG($id, $titulo, $nota){
            $id = $id;
            $titulo = $titulo;            
            $nota = $nota;            

            $conection = new Conexion();                                 
            $query = "UPDATE db_blog SET Titulo = '$titulo', Nota = '$nota' WHERE ID = $id";
            mysqli_query($conection->conectarBD(), $query); 
        }   

    public function queryEntradasArchivadas(){
         $conection = new Conexion();
                     
            //Consulto a BD, armo objeto y muestro 
            $query = 'SELECT * FROM db_blog WHERE Activo = "0" ORDER BY ID'; 
            $consulta = mysqli_query($conection->conectarBD(), $query); //conecta y ejecuto consulta

            $cant_por_pag = 6;
            
            if (ISSET($_GET["p"]))
            {
                $pagina = $_GET["p"];
                
            } else {
                $pagina = 1;
            }
            $empieza_desde = ($pagina - 1)*$cant_por_pag; //desde donde empieza el limit de la consulta
            $num_filas = $consulta->num_rows; //cantidad de filas en la base de datos            ;
            $total_pag = ceil($num_filas/$cant_por_pag); //cantidad de páginas que voy a tener según la cantidad de filas existentes 
            
            $query_limit = "SELECT ID, Titulo, DATE_FORMAT(Fecha, '%d - %m - %Y') AS fecha, Nota, Imagen FROM db_blog WHERE Activo = '0' ORDER BY ID DESC LIMIT $empieza_desde, 
            $cant_por_pag";

            $consulta_limit = mysqli_query($conection->conectarBD(), $query_limit);
                     

                    while($dato = mysqli_fetch_assoc($consulta_limit)){

                        $entrada = new Entrada();

                        $entrada->setID($dato['ID']);
                        $entrada->setTitulo($dato['Titulo']);                        
                        $entrada->setFecha($dato['fecha']);
                        $entrada->setNota($dato['Nota']);
                        $entrada->setImg($dato['Imagen']);
                        
                        

                        echo'<div class="p_entrada"> 
                                <div>
                                    <h1>' . $entrada->getTitulo(). ' </h1>
                                    <h4>' . $entrada->getFecha() . '</h4>
                                </div>

                                <div id="contenedor_btn">
                                        <a class="editar_entrada" href="editar.php?id='. $entrada->getId() .'" onClick="return confirm(\'¿Estas seguro que queres editar esta entrada?\')">Editar</a>
                                        <a class="borrar_entrada" href="activar_entrada.php?id='. $entrada->getId() .'" onClick="return confirm(\'¿Estas seguro que queres activar esta entrada?\')">Publicar</a>
                                    </div>  
                            
                        </div>'; //este div de cierre funciona
                             
                        }            
                    
                    //paginación
                    echo "<div id='paginacion-container'> 
                            <span>Páginas: </span>";
                        for($i=1; $i<=$total_pag; $i++) {
                    echo "<a href='?p=" .$i. "'>" . $i .  "</a>";
                        } ; 
                    echo  "</div>"; 
            } //cierra getcontenidoporfecha()

    
    
} //cierre de manejo_objhuso horario de Argentina y por qué sería recomendable atrasar el reloj 