<?php
session_start();
require_once "config.php";

// دریافت بهترین رکوردها
$stmt = $pdo->query("SELECT users.username, MAX(scores.score) AS best_score 
                     FROM users 
                     JOIN scores ON users.id = scores.user_id
                     GROUP BY users.id
                     ORDER BY best_score DESC LIMIT 10");

$top_scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>جدول برترین‌ها</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center">جدول برترین‌ها</h2>
    <table class="table table-bordered table-striped mt-3">
      <thead>
        <tr>
          <th>نام کاربری</th>
          <th>بهترین رکورد</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($top_scores as $rank): ?>
          <tr>
            <td><?php echo htmlspecialchars($rank['username']); ?></td>
            <td><?php echo htmlspecialchars($rank['best_score']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="game.php" class="btn btn-primary w-100 mt-3">شروع بازی</a>
  </div>
</body>
</html>
