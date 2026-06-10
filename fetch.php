<?php

require_once"DB.php";
if(isset($_GET["submit"])){
$user_id=$_GET["user_id"];

$sql = "SELECT *
        FROM projects p
        LEFT JOIN tasks t ON p.project_id = t.project_id
        WHERE p.user_id = :user_id";

$stmt = $connection->prepare($sql);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {

    if (($row["id"])) {
        echo "Task: " . $row["name"] ;
        echo "Status: " . $row["status"];
    } 
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fetch User Projects</title>
</head>
<body>

<h2>Show User Projects & Tasks</h2>

<form  method="GET">

    <label>User ID:</label>
    <input type="number" name="user_id" required>

    <br><br>

    <button type="submit" name= "submit">Show Data</button>

</form>

</body>
</html>



