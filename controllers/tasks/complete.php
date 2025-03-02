<?php

$config = require 'config.php';
$db = new Database($config['database']);

// Ensure we get the task ID from the POST request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['task_id'])) {
    $taskId = $_POST['task_id'];

    // Update only the task with the provided ID
    $db->query("UPDATE tasks SET status = 'completed' WHERE id = :task_id", [
        ':task_id' => $taskId
    ]);

    // Redirect back to the task list
    header("Location: /");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
