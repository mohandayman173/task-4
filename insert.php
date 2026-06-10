<?php
if(isset($_POST['submit'])){

require_once "DB.php";
$project_name = $_POST['project_name'];
$user_id= $_POST['user_id'];
$task_name = $_POST['task_name'];
$description= $_POST['description'];
$start_date= $_POST['start_date'];
$end_date = $_POST['end_date'];
$priority  = $_POST['priority'];
$category = $_POST['category'];
$status  = $_POST['status'];
$is_archived = $_POST['is_archived'];


if(empty($project_name)){
    echo "project name is required";
    exit();
}
if(empty($user_id)){
    echo "user id is required";
    exit();
}
if(empty($task_name)){
    echo "task name is required";
    exit();
}
if(!in_array($priority, ['High', 'Medium', 'Low'])){
    echo "invalid priority value";
    exit();
}
if(!in_array($category, ['Bug', 'Fix'])){
    echo "invalid category value";
    exit();
}
if(!in_array($status, ['To Do', 'In Progress', 'Done'])){
    echo "invalid status value";
    exit();
}

$insertProject = "INSERT INTO projects (name, user_id)  VALUES (:name, :user_id)";

$query  = $connection->prepare($insertProject);
$result = $query->execute([
    ':name'=> $project_name,
    ':user_id' => $user_id,
]);

if($result){
    echo "project added";
}
$project_id = $connection->lastInsertId();
$insertTask = "INSERT INTO tasks 
(name, description, start_date, end_date, priority, category, status, is_archived, project_id)
VALUES (?,?,?,?,?,?,?,?,?)";

$query = $connection->prepare($insertTask);

$result=$query->execute([
    $task_name,
    $description,
    $start_date,
    $end_date,
    $priority,
    $category,
    $status,
    $is_archived,
    $project_id]);

if($result){
    header("Location:filter.php");
    exit();
    echo "insert succses";
}
}


?>
<form method="POST">

    <label>Project Name:</label><input type="text" name="project_name">

    <label>User ID:</label><input type="number" name="user_id">

    <label>Task Name:</label><input type="text" name="task_name">

    <label>end_date:</label><input type="date" name="end_date">
    <label>Description:</label>
    <input type="text" name="description">
    <label>:</label>start_date<input type="date" name="start_date">

    <label>Priority:</label>
    <select name="priority">
        <option value="">-- Select --</option>
        <option value="High">High</option>
        <option value="Medium">Medium</option>
        <option value="Low">Low</option>
    </select>

    <label>Category:</label>
    <select name="category">
        <option value="Bug">Bug</option>
        <option value="Fix">Fix</option>
    </select>

    <label>Status:</label>
    <select name="status">
        <option value="To Do">To Do</option>
        <option value="In Progress">In Progress</option>
        <option value="Done">Done</option>
    </select>

    <label>Archived:</label>
    <input type="radio" name="is_archived" value="0"> No
    <input type="radio" name="is_archived" value="1"> Yes

    <button type="submit" name="submit">Submit</button>

</form>