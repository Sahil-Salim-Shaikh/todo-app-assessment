<?php
// Include database connection file
include 'db.php';

// Fetch tasks from the database
$tasks = []; // Initialize $tasks as an empty array

try {
    $query = $pdo->query("SELECT * FROM tasks ORDER BY id DESC");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to CSS file -->
</head>
<body>
    <div class="container">
        <h1>My Todo List</h1>

        <!-- Form to Add a New Task -->
        <form action="add.php" method="POST">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit">Add Task</button>
        </form>

        <!-- Display Task List -->
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li class="<?= $task['completed'] ? 'completed' : '' ?>">
                    <?= htmlspecialchars($task['task']) ?>

                    <div>
                        <?php if (!$task['completed']): ?>
                            <!-- Complete Button -->
                            <a href="complete.php?id=<?= $task['id'] ?>">
                                <button class="complete">Complete</button>
                            </a>
                        <?php endif; ?>
                        <!-- Edit Button -->
                        <a href="edit.php?id=<?= $task['id'] ?>">
                            <button class="edit">Edit</button>
                        </a>
                        <!-- Delete Button -->
                        <a href="delete.php?id=<?= $task['id'] ?>">
                            <button class="delete">Delete</button>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Filter Buttons for Task Status -->
        <div class="filter-buttons">
            <a href="filter.php?status=all">
                <button>All</button>
            </a>
            <a href="filter.php?status=completed">
                <button>Completed</button>
            </a>
            <a href="filter.php?status=pending">
                <button>Pending</button>
            </a>
        </div>
    </div>
</body>
</html>
