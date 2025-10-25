<?php

require_once __DIR__."/../src/db_connect.php";

session_start();

$id;
$informacoes = [];
$erros=[];
$sucessos = [];

$titulo;
$autor;
$genero;
$anoPublicacao;

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = mysqli_query($connect, "SELECT titulo, ano_publicacao, autor, genero from livros WHERE id = {$id}");
    if($sql) {
        $array = mysqli_fetch_assoc($sql);
        $titulo = $array['titulo'];
        $autor = $array['autor'];
        $genero = $array['genero'];
        $anoPublicacao =  $array['ano_publicacao'];

    } else {
        $erros[] = "Erro ao procurar livro: ".mysqli_error($connect);
    }  
}

if(isset($_POST['enviar'])) {
    $novoTitulo = mysqli_real_escape_string($connect, $_POST['titulo']);
    $novoAnoPublicacao = mysqli_real_escape_string($connect, $_POST['anoPublicacao']);
    $novoGenero = mysqli_real_escape_string($connect, $_POST['genero']);
    $novoAutor = mysqli_real_escape_string($connect, $_POST['autor']);

    $sql = "UPDATE livros 
        SET titulo = '$novoTitulo', 
        ano_publicacao = '$novoAnoPublicacao', 
        genero = '$novoGenero', 
        autor = '$novoAutor'
        WHERE id = '$id'";

    if(mysqli_query($connect, $sql)) {
        $sucessos[] = "livro editado com sucesso";
        header("location: index.php");
        exit();

    } else {
        $erros[] = "erro ao editar livro: ".mysqli_error($connect);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar livro</title>
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
        ?>
    </section>

    <section class="informacoes">
        <h2>INFORMAÇÕES</h2>
        <label for="titulo">TITULO: <?php echo $titulo; ?></label><br>
        <label for="genero">GENERO: <?php echo $genero; ?></label><br>
        <label for="autor">AUTOR: <?php echo $autor; ?></label><br>
        <label for="anoPublicacao">ANO DE PUBLICAÇÃO: <?php echo $anoPublicacao; ?></label><br>
    </section>
    
    <form action="editar.php?id=<?php echo $id ?>" method="POST" class="editarLivro">
        <h2>EDITAR INFORMAÇÕES</h2>
        <label for="titulo">titulo</label><br>
        <input type="text" name="titulo" id="titulo"><br>

        <label for="autor">autor</label><br>
        <input type="text" name="autor" id="autor"><br>

        <label for="anoPublicacao">Ano de publicação</label><br>
        <input type="number" name="anoPublicacao" id="anoPublicacao"><br>

        <label for="genero">genero</label><br>
        <select name="genero" id="genero">
            <option value="">--Selecione--</option>
            <option value="ficcao">Ficção</option>
            <option value="nao-ficcao">Não Ficção</option>
            <option value="aventura">Aventura</option>
            <option value="romance">Romance</option>
            <option value="misterio">Mistério</option>
            <option value="fantasia">Fantasia</option>
            <option value="ficcao-cientifica">Ficção Científica</option>
            <option value="biografia">Biografia</option>
            <option value="historico">Histórico</option>
            <option value="poesia">Poesia</option>
            <option value="infantil">Infantil</option>
            <option value="autoajuda">Autoajuda</option>
            <option value="terror">Terror</option>
        </select><br>

        <button type="submit" name="enviar" >ENVIAR ALTERAÇÕES</button><br>

        <?php
            if(!empty($sucessos)) {
                foreach($sucessos as $sucesso) {
                    echo $sucesso;
                }
            }

            if(!empty($erros)) {
                foreach($erros as $erro) {
                    echo $erro;
                }
            }
        ?>

        <button><a href="index.php">PAGINA INICIAL</a></button>
    </form>

</body>
</html>