<?php
define('DB_PATH', 'tarefas.db');
function getDB() {
    try {
        $db = new PDO('sqlite:' . DB_PATH);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        exit;
    }
}
function createTarefasTable() {
    $db = getDB();
    $query = "
        CREATE TABLE IF NOT EXISTS tarefas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            description TEXT NOT NULL,
            due_date DATE NOT NULL,
            completed INTEGER DEFAULT 0
        );
    ";
    $db->exec($query);
}
createTarefasTable(); 
?>
