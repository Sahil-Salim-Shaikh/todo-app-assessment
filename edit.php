<?php include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $query->execute(['id' => $id]);
    $task = $query->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $newTask = $_POST['task'];

    $stmt = $pdo->prepare("UPDATE tasks SET task = :task WHERE id = :id");
    $stmt->execute(['task' => $newTask, 'id' => $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="text" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
            <button type="submit">Update Task</button>
        </form>
    </div>
</body>
</html>
