<?php
include 'db.php';

// Check if the status is set in the URL, default to 'all' if not
$status = isset($_GET['status']) ? $_GET['status'] : 'all';
$tasks = []; // Initialize $tasks as an empty array

try {
    // Build the query based on the status
    if ($status === 'completed') {
        $query = $pdo->query("SELECT * FROM tasks WHERE completed = 1");
    } elseif ($status === 'pending') {
        $query = $pdo->query("SELECT * FROM tasks WHERE completed = 0");
    } else {
        $query = $pdo->query("SELECT * FROM tasks");
    }

    $tasks = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any errors
    echo "Error fetching tasks: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filtered Tasks</title>
    <link rel="stylesheet" href="filter.css"> <!-- Link to the new CSS file -->
</head>
<body>
    <div class="container">
        <h2>Filtered Tasks (<?= htmlspecialchars($status) ?>)</h2>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <?= htmlspecialchars($task['task']) ?>
                    <?= $task['completed'] ? "(Completed)" : "" ?>
                    <div class="action-buttons">
                        <a href="complete.php?id=<?= $task['id'] ?>">Mark Complete</a>
                        <a href="delete.php?id=<?= $task['id'] ?>">Delete</a>
                        <a href="edit.php?id=<?= $task['id'] ?>">Edit</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php" class="back-button">Back to all tasks</a>
    </div>
</body>
</html>
