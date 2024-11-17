<?php
include 'database.php';
if (isset($_GET['id'])) {
    $tarefa_id = $_GET['id'];
    $db = getDB();

    $query = "UPDATE tarefas SET completed = 1 WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':id', $tarefa_id);
    $stmt->execute();
    header('Location: index.php');

    exit;
}
?>
