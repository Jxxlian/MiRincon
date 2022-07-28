<?php

$id = $_GET['id'];
  
include("Manejo_obj.php");
$a = new Manejo_obj();
$a->activarEntrada($id);                                

header("location:index.php")
?>