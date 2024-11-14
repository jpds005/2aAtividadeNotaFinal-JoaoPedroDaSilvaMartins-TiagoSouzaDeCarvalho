<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $ano = $_POST['ano'] ?? '';

    if (empty($titulo) || empty($autor) || empty($ano)) {
        echo "Todas as informações são obrigatórias.";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':autor', $autor);
    $stmt->bindParam(':ano', $ano);

    if ($stmt->execute()) {
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar livro.";
    }
}
?>
