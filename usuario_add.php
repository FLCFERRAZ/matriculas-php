<?php
include_once("conexaodb.php");
// Escreve o conteúdo recebido pelo formulário na tela
// var_dump $_GET;

$nome_usuario = $_GET["nome_usuario"];
$senha = md5($_GET["senha"]);
$id_perfil = $_GET["id_perfil"];

echo "O nome de usuário é: " . $nome_usuario . "<br>";
echo "A senha criptografada é: " . $senha . "<br>";
echo "O perfil é: ";
// Valida se o perfil é válido
switch ($id_perfil) {
    case 1:
        echo "Administrador";
        break;
    case 2:
        echo "Auxiliar de matrículas";
        break;
    case 3:
        echo "Atendente";
        break;
    default:
        // Se não for nenhuma das opções (1, 2 ou 3),
        // Encerra o código PHP (não processa nenhuma linha depois do "die")
        echo "Erro: Perfil inválido!<br>";
        die("<a href='javascript:history.back()'>Voltar</a>");
}

if (empty($nome_usuario)) {
    echo "Erro: O nome de usuário não pode estar vazio.";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

if (empty($senha)) {
    echo "Erro: A senha não pode estar vazia.";
    die("<a href='javascript:history.back()'>Voltar</a>");
}

// Verifica se o nome do usuário informado existe no banco de dados
try {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE NomeUsuarios = :nome_usuario");
    $stmt->bindParam(':nome_usuario', $nome_usuario);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        // Já existe um usuário com este nome
        echo "Erro: Nome de usuário já existe.<br>";
        die("<a href='javascript:history.back()'>Voltar</a>");
    }
} catch (PDOException $e) {
    echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    exit;
}

// Depois de todas as validações realizadas, criar o novo usuário no banco de dados.
try {
    $stmt = $pdo->prepare("INSERT INTO `usuarios`(`NomeUsuarios`, `Senha`, `idPerfil`) VALUES (:nome_usuario,:senha,:id_perfil)");
    $stmt->bindParam(':nome_usuario', $nome_usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':id_perfil', $id_perfil);
    $stmt->execute();

    // Se o comando foi executado com sucesso, o número dee linhas adicionadas é maior do que zero.

    if ($stmt->rowCount() > 0){
        echo "O usuário '" . $nome_usuario . "' foi adicionado com sucesso ao banco de dados.<br>";
        echo "Você será redirecionado automaticamente a página anterior após 5 segundos.<br>";
        // Retorna a página anterior após 5 segundos usando o JavaScript.
        echo "<script>
        setTimeout(function() {
            history.back();
        }, 5000);
        </script>";
        echo "Caso você não seja redirecionado automaticamente, <a href='javascript:history.back()'>clique aqui</a>";
    }
} catch(PDOException $e) {
    echo "Erro: "  . $e->getMessage();
}