<?php
include_once("conexaodb.php");

//var_dump($_GET);
$nome_curso = $_GET['NomeCurso'];
echo "O nome do curso é: "  .  $nome_curso;

if (empty($nome_curso)) {
    echo "Erro: O nome do curso não pode estar vazio.";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

    // Verifica se o nome do curso informado existe no banco de dados
try {
    $stmt = $pdo->prepare("SELECT * FROM cursointeresse WHERE NomeCurso = :nome_curso");
    $stmt->bindParam(':nome_curso', $nome_curso);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Já existe um curso com este nome
        echo "Erro: Nome do curso já existe.<br>";
        die("<a href='javascript:history.back()'>Voltar</a>");
    }
} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit;
}

// Depois de todas as validações realizadas, criar o novo curso no banco de dados.
try {
    $stmt = $pdo->prepare("INSERT INTO `cursointeresse`(`NomeCurso`) VALUES (:nome_curso)");
    $stmt->bindParam(':nome_curso', $nome_curso);
    $stmt->execute();

} catch(PDOException $e) {
    echo "Erro: "  . $e->getMessage();
}