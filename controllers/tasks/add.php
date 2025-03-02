<?php

$config = require 'config.php';
$db = new Database($config['database']);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $task = $_POST['task'];

    // Insert a new task with 'pending' status
    $db->query("INSERT INTO tasks (task, status) VALUES (:task, 'pending')", [
        ':task' => $task
    ]);

    // Redirect back to the task list
    header("Location: /");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
