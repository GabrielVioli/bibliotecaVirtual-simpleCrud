<?php

$connect = mysqli_connect("localhost", "root", "12345","exercicios");
if(mysqli_connect_error()) {
    echo "erro de conexão: ".mysqli_connect_error();
} 

?>