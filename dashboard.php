<?php
session_start();

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$avatar = $_SESSION['avatar'];
$best_score = $_SESSION['best_score'];
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>داشبورد</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
  <style>
    .profile-card {
      text-align: center;
      padding: 30px;
      border-radius: 10px;
      background-color: #f1f1f1;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .profile-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 20px;
    }
    .profile-card h2 {
      font-size: 1.5rem;
      margin-bottom: 10px;
    }
    .profile-card p {
      font-size: 1rem;
      margin-bottom: 20px;
    }
    .btn {
      font-size: 1.2rem;
      margin-top: 15px;
    }
    .dark-mode {
      background-color: #333;
      color: white;
    }
    body.dark-mode {
      background-color: #333;
    }
  </style>
</head>
<body class="<?php echo isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark' ? 'dark-mode' : ''; ?>">
  <div class="container py-5">
    <div class="profile-card">
      <img src="avatars/<?php echo $avatar; ?>" alt="Avatar">
      <h2>خوش آمدید، <?php echo htmlspecialchars($username); ?></h2>
      <p>بهترین رکورد: <?php echo $best_score; ?></p>
      <div class="d-grid gap-2">
        <a href="game.php" class="btn btn-primary">شروع بازی</a>
        <a href="chat.php" class="btn btn-secondary">چت آنلاین</a>
        <a href="leaderboard.php" class="btn btn-outline-primary">جدول برترین‌ها</a>
      </div>
      <button id="theme-toggle" class="btn btn-outline-dark mt-3">حالت شب</button>
    </div>
  </div>

  <script>
    document.getElementById('theme-toggle').addEventListener('click', function() {
      document.body.classList.toggle('dark-mode');
      const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
      // ذخیره وضعیت تم در سشن
      fetch('php/save_theme.php', {
        method: 'POST',
        body: JSON.stringify({ theme: theme }),
        headers: { 'Content-Type': 'application/json' }
      });
    });
  </script>
</body>
</html>
