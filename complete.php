<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("UPDATE tasks SET completed = 1 WHERE id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: index.php");
    exit();
}
?>
