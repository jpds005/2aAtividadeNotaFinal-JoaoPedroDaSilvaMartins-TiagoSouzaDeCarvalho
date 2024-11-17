<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $db = getDB();
    $query = "INSERT INTO tarefas (description, due_date) VALUES (:description, :due_date)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->execute();
    header('Location: index.php');

    exit;
}
?>
