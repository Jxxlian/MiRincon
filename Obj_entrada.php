<?php
    
    class Entrada{
        private int $id;
        private string $titulo;        
        private string $fecha;
        private string $nota;
        private $image;
             
        //gettes 
        public function getId(){
            return $this->id;
        }

        public function getTitulo(){
            return $this->titulo;
        }

        public function getFecha(){
            return $this->fecha;
        }

        public function getNota(){
            return $this->nota;
        }

        public function getImg(){
            return $this->image;
        }

        //setters
        public function setID($id){
            $this->id =$id;
        }

        public function setFecha($fecha){
            $this->fecha=$fecha;
        }

        public function setTitulo($titulo){
            $this->titulo=$titulo;
        }

        public function setNota($nota){
            $this->nota=$nota;
        }

        public function setImg($image) {
            $this->image=$image;
        }
    }
?>
   