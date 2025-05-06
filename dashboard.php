<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle task creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_name'])) {
    $task_name = $_POST['task_name'];
    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task_name) VALUES (?, ?)");
    $stmt->execute([$user_id, $task_name]);
}

// Handle task status update
if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    $stmt = $pdo->prepare("UPDATE tasks SET status = 'completed' WHERE id = ? AND user_id = ?");
    $stmt->execute([$task_id, $user_id]);
}

// Fetch tasks
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  <style>
    .logout{
      text-align:center;
    }
  </style>
    <div class="container">
        <h2>Welcome, User!</h2>
        
        <h3>Add Task</h3>
        <form method="POST">
            <input type="text" name="task_name" placeholder="Task name" required>
            <button type="submit">Add Task</button>
        </form>
        <h3>Your Tasks</h3>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li class="<?php echo $task['status']; ?>">
                    <?php echo htmlspecialchars($task['task_name']); ?>
                    <?php if ($task['status'] == 'pending'): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit">Complete</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="logout">
        <a href="logout.php">Logout</a>

        </div>
    </div>
</body>
</html>
