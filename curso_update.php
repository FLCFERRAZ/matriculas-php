<?php
include_once("conexaodb.php");

var_dump($_GET);

$NomeCurso = $_GET["NomeCurso"];
$id = intval($_GET["id"]);

if (empty($NomeCurso)) {
    echo "Erro: O nome do curso não pode estar vazio.";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

if (empty($id)) {
    echo "Erro: ID do curso não pode estar vazio.";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

if (!is_int($id)) {
    echo "Erro: ID do curso deve ser um número inteiro!";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

try {
    $stmt = $pdo->prepare("UPDATE cursointeresse SET Nome = :NomeCurso WHERE idCursoInteresse = id");
    $stmt->bindParam(':NomeCurso', $NomeCurso);
    $stmt->bindParam(':id', $id);
    // se a execução da alteração do nome do curso no banco de dados foi bem-sucedida.
    if ($stmt->execute()) {
        echo "O nome do curso #" . $id .  " foi alterado com sucesso para '" . $NomeCurso . "' <br>";
        echo "<a href='javascript:history.back()'>Voltar</a>";
    }
} catch (PDOException $e) {
    echo "Erro durante a interação com o banco de dados: " . $e->getMessage();
}