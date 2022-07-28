<?php    

    class Conexion{
        private $server = "localhost";
        private $user = "root";
        private $password = "";
        private $bd = "db_blog";

        public function conectarBD(){
            try {
                $c = mysqli_connect($this->server, $this->user, $this->password, $this->bd);
                //echo "estas conectado";
                return $c;                
            } catch (Exception $e){
                echo "Error al conectarse a la base de datos: " . $e->getMessage(); 
            }
        }
    }