<?php
include_once("conexaodb.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Título da página</title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>Cursos</h1>

    <h2>Cursos Cadastrados</h2>

    <h2>Cadastrar novo Curso</h2>
    <form action="curso_add.php" method="get">
        <label for="nome_curso">Nome do Curso:</label>
        <input type="text" id="nome_curso" name="nome_curso">
        <br>
        <input type="submit">
    </form>
  </body>
</html>