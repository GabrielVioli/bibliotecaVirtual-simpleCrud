<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ ."/db_connect.php";

session_start();

$erros = [];
$titulos = [];
$sucessos = [];

if($_SESSION['existente']) {
    $erros[] = "<h3> Ja existe um livro com esse titulo </h3> <br>";
}
 $_SESSION['existente'] = false;

$procurarLivro = mysqli_query($connect, "SELECT * from livros ORDER BY id");
while($registro = mysqli_fetch_assoc($procurarLivro)) {
    $titulos[] = $registro;
    if(mysqli_error($connect)) {
        $erros[] = "Erro de conexão: ".mysqli_error($connect);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>biblioteca virtual</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button class="adicionarLivro"><a href="adicionar.php?id=adicionarLivro">ADICIONAR LIVRO</a></button>
    <ul class="adicionarLivro">
        <?php
        if(!empty($erros)) {
            foreach($erros as $erro) {
                echo $erro;
            }
        }
        if(empty($titulos)) {
            echo"Adicione um livro";
        } else {
            foreach ($titulos as $titulo) {
                echo $titulo['titulo'] . "<button type='submit' name='excluir'><a href='excluir.php?id={$titulo['id']}'
                onclick='return confirm(\'tem certeza que deseja excluir?\');'> EXCLUIR LIVRO </a></button><br>".
                "<button type='submit' name='editar'><a href='editar.php?id={$titulo['id']}'>
                EDITAR LIVRO </a></button><br>";
            }
        }
        ?>
    </ul>
</body>
</html>