<?php
session_start();
require_once "php/config.php";

// چک کردن اینکه آیا شناسه کاربری در URL داده شده است
$user_id = $_GET['id'] ?? null;
if (!$user_id) {
    header("Location: dashboard.php");
    exit();
}

// دریافت اطلاعات کاربر از دیتابیس
$stmt = $pdo->prepare("SELECT username, avatar, best_score FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "کاربر یافت نشد.";
    exit();
}

$username = $user['username'];
$avatar = $user['avatar'];
$best_score = $user['best_score'];
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>پروفایل عمومی</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card text-center shadow mx-auto" style="max-width: 400px;">
      <div class="card-body">
        <img src="avatars/<?php echo $avatar; ?>" class="rounded-circle mb-3" width="100" height="100">
        <h3 class="card-title">پروفایل <?php echo htmlspecialchars($username); ?></h3>
        <p class="card-text">بهترین رکورد: <?php echo $best_score; ?></p>
        <a href="chat.php" class="btn btn-primary w-100 mt-3">چت آنلاین</a>
        <a href="leaderboard.php" class="btn btn-outline-primary w-100 mt-3">بازگشت به جدول برترین‌ها</a>
      </div>
    </div>
  </div>
</body>
</html>
