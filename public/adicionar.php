<?php


require_once __DIR__ ."/../src/db_connect.php";

session_start();

$erros = [];
$sucessos = [];
$titulos = [];

$livros = mysqli_query($connect, "SELECT * from livros");

while($linhas = mysqli_fetch_assoc($livros)) {
    $titulos[] = $linhas['titulo'];
}


if(isset($_POST['enviar'])) {
    $titulo = mysqli_real_escape_string($connect, $_POST["titulo"]);
    $autor = mysqli_real_escape_string($connect, $_POST["autor"]);
    $genero = mysqli_real_escape_string($connect, $_POST["genero"]);
    $anoLancamento = intval(mysqli_real_escape_string($connect, $_POST["anoPublicacao"]));

    if(in_array($titulo, $titulos)) {
        $_SESSION['existente'] = true;
        header("location: index.php");
        exit();
    } 

    if(mysqli_query($connect, "INSERT INTO livros(titulo, autor, ano_publicacao, genero) VALUES('$titulo','$autor', '$anoLancamento','$genero')")) {
        $sucessos[] = "Livro {$titulo} adicionado com sucesso";
        
    } else {
        $erros[] = "Erro ao adicionar livro: ". mysqli_error($connect);
    }
}

if(isset($_POST['voltar'])) {
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adicionar livro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="adicionar.php" method="POST" class="adicionarLivro">
        <h1>ADICIONAR LIVRO</h1>
        <h2>Dados Do Livro</h2>
        <label for="Titulo">TITULO</label><br>
        <input type="text" name="titulo" id="titulo" required placeholder="Titulo"><br>
        <label for="autor">AUTOR</label><br>
        <input type="text" name="autor" id="autor" required placeholder="Autor"><br>
        <label for="autor">ANO DE PUBLICAÇÃO</label><br>
        <input type="number" name="anoPublicacao" id="anoPublicacao" required placeholder="Ano de publicação"><br>
        <label for="autor">GENERO</label><br>
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

        <input type="submit" name="enviar" value="CADASTRAR"><br>

    </form>
    <button class="adicionarLivro"><a href="index.php">PAGINA INICIAL</a></button><br>

    <?php
    echo "<div class='adicionarLivro'>";
        if(!empty($erros)) {
            foreach($erros as $erro) {
                echo $erro;
            } 
        } else {
            foreach($sucessos as $sucesso) {
                echo $sucesso;
            }
         }
    echo "</div>";

    ?>  

</body>
</html>

<!--   header("Location: index.php");
   exit();
