<?php

require_once __DIR__."/db_connect.php";

session_start();

$id;
$erros = [];
$sucessos = [];

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(mysqli_query($connect, "DELETE from livros WHERE id = {$id}")) {
        $sucessos[] = "Livro excluido com sucesso";
    } else {
        $erros[] = "Erro de conexao: ".mysqli_error( $connect );   
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>excluir livro</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <section class="avisos">
        <?php
            if(!empty($erros)) {
                foreach($erros as $erro) {
                    echo $erro;
                }
            }

            if(!empty($sucessos)) {
                foreach($sucessos as $sucesso) {
                    echo $sucesso;
                }
            }
        ?>
    </section>

    <div class="avisos">
        <button><a href="index.php">PAGINA INICIAL</a></button>
    </div>


    
</body>
</html>