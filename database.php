<?php
$pdo = new PDO('sqlite:database.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "CREATE TABLE IF NOT EXISTS livros (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            autor TEXT NOT NULL,
            ano INT NOT NULL
        )";
$pdo->exec($sql);

$action = isset($_GET['action']) ? $_GET['action'] : '';
if ($action == 'read') {
    $stmt = $pdo->query("SELECT * FROM livros");
    $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($livros);
    exit;
}
?>
