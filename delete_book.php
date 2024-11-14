<?php
require 'database.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'delete') {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Livro excluído com sucesso!";
    } else {
        echo "Erro ao excluir livro.";
    }
} else {
    echo "ID é obrigatório.";
}
?>
