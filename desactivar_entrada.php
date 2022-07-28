<?php

$id = $_GET['id'];
  
include("Manejo_obj.php");
$a = new Manejo_obj();
$a->desactivarEntrada($id);                                

header("location:escritos.php")
?>