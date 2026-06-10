<?php
require_once "DB.php";
try {
    if (
        empty($_POST['project_name']) ||
        empty($_POST['user_id']) ||
        empty($_POST['task_name'])
    ) {
        echo "All required field is not good";
        exit;
    }
    $connection->beginTransaction();
    $insertProject = $connection->prepare("
        INSERT INTO projects (name, user_id)
        VALUES (?, ?)
    ");
    $insertProject->execute([
        $_POST['project_name'],
        $_POST['user_id']
    ]);
    $project_id = $connection->lastInsertId();
    $insertTask = $connection->prepare("
        INSERT INTO tasks 
        (name, description, start_date, end_date, priority, category, status, is_archived, project_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insertTask->execute([
$_POST['task_name'],
$_POST['description'],
$_POST['start_date'],
$_POST['end_date'],
 $_POST['priority'],
$_POST['category'],
$_POST['status'],
$_POST['is_archived'],
        $project_id
    ]);
    $connection->commit();
    echo "Project and Task are good!";
} catch (Exception $e) {

    $connection->rollback();
    echo $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Project & Task</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: sans-serif; background: #f5f5f5; padding: 2rem; }
    .form-wrap { max-width: 640px; margin: 0 auto; }
    h2 { font-size: 18px; font-weight: 500; margin-bottom: 1rem; color: #111; }
    .section { background: #fff; border: 1px solid #e0e0e0; border-radius: 12px; padding: 1.25rem; margin-bottom: 1rem; }
    .section-title { font-size: 12px; font-weight: 500; color: #888; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 1rem; }
    .field { margin-bottom: 14px; }
    .field label { display: block; font-size: 13px; color: #555; margin-bottom: 5px; }
    .field label span { color: red; margin-left: 2px; }
    .row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .row3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
    input[type="text"],
    input[type="number"],
    input[type="date"],
    select,
    textarea {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
      color: #111;
      background: #fff;
    }
    input:focus, select:focus, textarea:focus {
      outline: none;
      border-color: #888;
    }
    textarea { resize: vertical; min-height: 80px; }
    .checkbox-label { display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; color: #555; }
    .submit-btn {
      width: 100%;
      padding: 10px;
      font-size: 15px;
      font-weight: 500;
      background: #1a73e8;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    .submit-btn:hover { background: #1558b0; }
    .submit-btn:disabled { opacity: 0.6; cursor: not-allowed; }
    .result {
      text-align: center;
      padding: 12px;
      border-radius: 8px;
      font-size: 14px;
      margin-top: 12px;
      display: none;
    }
    .result.ok { background: #e6f4ea; color: #2e7d32; }
    .result.err { background: #fdecea; color: #c62828; }
  </style>
</head>
<body>

<div class="form-wrap">
  <h2>Create Project & Task</h2>

  <form id="mainForm" action="receive.php" method="POST">

    <div class="section">
      <p class="section-title">Project</p>
      <div class="row">
        <div class="field">
          <label>Project name <span>*</span></label>
          <input type="text" name="project_name" placeholder="e.g. Website Redesign" required>
        </div>
        <div class="field">
          <label>User ID <span>*</span></label>
          <input type="number" name="user_id" placeholder="e.g. 42" required>
        </div>
      </div>
    </div>

    <div class="section">
      <p class="section-title">Task</p>

      <div class="field">
        <label>Task name <span>*</span></label>
        <input type="text" name="task_name" placeholder="e.g. Design homepage" required>
      </div>

      <div class="field">
        <label>Description</label>
        <textarea name="description" placeholder="Optional task details..."></textarea>
      </div>

      <div class="row">
        <div class="field">
          <label>Start date</label>
          <input type="date" name="start_date">
        </div>
        <div class="field">
          <label>End date</label>
          <input type="date" name="end_date">
        </div>
      </div>

      <div class="row3">
        <div class="field">
          <label>Priority</label>
          <select name="priority">
            <option value="">— select —</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
          </select>
        </div>
        <div class="field">
          <label>Category</label>
          <select name="category">
            <option value="">— select —</option>
            <option value="design">Design</option>
            <option value="development">Development</option>
            <option value="marketing">Marketing</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="field">
          <label>Status</label>
          <select name="status">
            <option value="">— select —</option>
            <option value="pending">Pending</option>
            <option value="in_progress">In progress</option>
            <option value="done">Done</option>
          </select>
        </div>
      </div>

      <div class="field">
        <label class="checkbox-label">
          <input type="checkbox" name="is_archived" value="1">
          Mark as archived
        </label>
      </div>
    </div>

    <button type="submit" class="submit-btn">Create Project & Task</button>
    <div class="result" id="result"></div>

  </form>
</div>

<script>
  document.getElementById('mainForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const res = document.getElementById('result');
    const btn = this.querySelector('.submit-btn');
    btn.disabled = true;
    btn.textContent = 'Saving...';
    try {
      const resp = await fetch(this.action, { method: 'POST', body: new FormData(this) });
      const text = await resp.text();
      res.style.display = 'block';
      if (text.includes('good')) {
        res.className = 'result ok';
        res.textContent = 'Project and task created successfully!';
        this.reset();
      } else {
        res.className = 'result err';
        res.textContent = text || 'Something went wrong.';
      }
    } catch {
      res.style.display = 'block';
      res.className = 'result err';
      res.textContent = 'Network error. Please try again.';
    }
    btn.disabled = false;
    btn.textContent = 'Create Project & Task';
  });
</script>

</body>
</html>