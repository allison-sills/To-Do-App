<?php

$config = require "config.php";
$db = new Database($config['database']);

$heading = "My To Do List";

$tasks = $db->query("select * from tasks")->get();

// Sort tasks by status (pending at the top, completed at the bottom)
usort($tasks, function ($task1, $task2) {
    // Define priority: 0 for pending, 1 for completed
    $statusOrder = ['pending' => 0, 'completed' => 1];
    return $statusOrder[$task1['status']] - $statusOrder[$task2['status']];
});
require "views/tasks/index.view.php"; 
