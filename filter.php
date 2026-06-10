<?php
require_once "DB.php";

if(isset($_POST["submit"])) {

    $user_id = $_POST["user_id"];
    $priority = $_POST["priority"];
    $PDO = "SELECT * FROM tasks join projects on tasks.project_id=projects.project_id WHERE projects.user_id = :user_id && priority =:priority AND is_archived = 0";
    $stmt = $connection->prepare($PDO);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":priority", $priority);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($tasks as $task) {
        echo "Task: " . $task["name"]  ;
        echo "Priority: " . $task["priority"] ;
        echo "description:".$task["description"];
    }

 //header("Location:fetch.php");
  
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Filter Tasks</title>
</head>
<body>

<h2>Filter Tasks by Priority</h2>

<form method="POST">

    <label>User ID:</label>
    <input type="number" name="user_id" required>
    <br><br>

    <label>Priority:</label>
    <select name="priority" required>
        <option value="High">High</option>
        <option value="Medium">Medium</option>
        <option value="Low">Low</option>
    </select>

    <br><br>

    <button type="submit" name= "submit">Search</button>

</form>

</body>
</html>