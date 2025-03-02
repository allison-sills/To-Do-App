<?php require 'views/partials/head.php' ?>
<?php require 'views/partials/banner.php' ?>
<main>
<div class="container mt-4">
    <!-- Add Task Section -->
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3">Add a New Task</h4>
        <form action="/add" method="POST">
            <div class="input-group">
                <input type="text" name="task" class="form-control" placeholder="Enter your task..." required>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
        </form>
    </div>

    <?php foreach ($tasks as $task): ?>
        <div class="mt-4">
            <div class="card mt-3 shadow-sm <?= $task['status'] === 'completed' ? 'bg-light' : '' ?>">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <!-- Task Text -->
                    <span id="task-text-<?= $task['id'] ?>"><?= htmlspecialchars($task['task']) ?></span>

                    <!-- Edit Form (Hidden by Default) -->
                    <form action="/edit" method="POST" id="edit-form-<?= $task['id'] ?>" class="d-none" style="width:100%;">
                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                        <div class="input-group">
                            <input type="text" name="task" class="form-control" value="<?= htmlspecialchars($task['task']) ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="hideEditForm(<?= $task['id'] ?>)">Cancel</button>
                        </div>
                    </form>

                    <!-- Action Buttons -->
                    <div id="actions-<?= $task['id'] ?>">
                        <?php if ($task['status'] === 'completed'): ?>
                            <span class="badge text-bg-success fs-6 fw-normal">Completed</span>
                        <?php else: ?>
                            <form action="/complete" method="POST" style="display:inline;">
                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Complete">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>

                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit" onclick="showEditForm(<?= $task['id'] ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
function showEditForm(taskId) {
    document.getElementById('task-text-' + taskId).classList.add('d-none');
    document.getElementById('edit-form-' + taskId).classList.remove('d-none');
    document.getElementById('actions-' + taskId).classList.add('d-none'); // Hide buttons
}

function hideEditForm(taskId) {
    document.getElementById('task-text-' + taskId).classList.remove('d-none');
    document.getElementById('edit-form-' + taskId).classList.add('d-none');
    document.getElementById('actions-' + taskId).classList.remove('d-none'); // Show buttons again
}
</script>

<?php require 'views/partials/footer.php' ?>
