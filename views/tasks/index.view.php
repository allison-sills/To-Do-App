<?php require 'views/partials/head.php' ?>
<?php require 'views/partials/banner.php' ?>
<main>
<div class="container mt-4">
    <!-- Add Task Section -->
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Add a New Task</h4>
        <form action="add_task.php" method="POST">
            <div class="input-group">
                <input type="text" name="task" class="form-control" placeholder="Enter your task..." required>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
        </form>
    </div>
    <?php foreach ($tasks as $task): ?>
<!-- Task List Section -->
<div class="mt-4">
    <!-- Task Card -->
    <div class="card mt-3 shadow-sm <?= $task['status'] === 'completed' ? 'bg-light' : '' ?>">
        <div class="card-body d-flex justify-content-between align-items-center">
            <span><?= htmlspecialchars($task['task'])?></span>

            <div>
                <!-- Display a badge for completed tasks -->
                <?php if ($task['status'] === 'completed'): ?>
                    <span class="badge bg-success">Completed</span>
                <?php endif; ?>

                <!-- Only show buttons for tasks that are NOT completed -->
                <?php if ($task['status'] !== 'completed'): ?>
                    <!-- Form for completing the task -->
                    <form action="/complete" method="POST" style="display:inline;">
                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                        <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Complete">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </form>

                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <!-- Delete Button -->
                    <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

</div>

<?php require 'views/partials/footer.php' ?>