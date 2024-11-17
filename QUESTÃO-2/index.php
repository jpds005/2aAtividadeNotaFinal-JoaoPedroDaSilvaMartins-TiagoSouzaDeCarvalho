<?php
include 'database.php';

function getTarefa() {
    $db = getDB();
    $query = "SELECT * FROM tarefas ORDER BY due_date DESC";
    $stmt = $db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$tarefas = getTarefa();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: larger;
            background-color: rgb(13, 14, 27);
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 0 50px;
            justify-content: flex-start;
            align-items: center;
        }
        h1, h2 {
            text-align: center;
            width: 100%;
        }
        .Formulario {
            padding: 20px;
            background-color: rgb(114, 115, 131);
            border-radius: 10px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 600px;
        }
        .Formulario input[type="text"], .Formulario input[type="date"], .Formulario button {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .Formulario button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .Formulario button:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
            width: 100%;
            max-width: 600px;
        }
        li {
            background-color: rgb(114, 115, 131);
            color: white;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        a {
            color: white;
            text-decoration: none;
            padding: 5px;
            border-radius: 3px;
            background-color: rgb(50, 205, 50);
            margin-left: 10px;
        }
        a:hover {
            background-color: rgb(34, 139, 34);
        }

    </style>
</head>
<body>
    <h1>Lista de Tarefas</h1>

    <div class="Formulario">
        <form action="add_tarefa.php" method="POST">
            <input type="text" name="description" placeholder="Descrição da tarefa" required>
            <input type="date" name="due_date" required>
            <button type="submit">Adicionar Tarefa</button>
        </form>
    </div>

    <h2>Tarefas Pendentes</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <?php if ($tarefa['completed'] == 0): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['description']); ?> - <?php echo $tarefa['due_date']; ?>
                    <a href="update_tarefa.php?id=<?php echo $tarefa['id']; ?>">Marcar como concluída</a>
                    <a href="delete_tarefa.php?id=<?php echo $tarefa['id']; ?>">Excluir</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <h2>Tarefas Concluídas</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <?php if ($tarefa['completed'] == 1): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['description']); ?> - <?php echo $tarefa['due_date']; ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</body>
</html>
