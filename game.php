<?php
session_start();
require_once "php/config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// شروع بازی
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $score = $_POST['score'] ?? 0;

  if ($score > 0) {
    // ذخیره امتیاز جدید در دیتابیس
    $stmt = $pdo->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->execute([$user_id, $score]);

    // به‌روزرسانی بهترین رکورد
    $stmt = $pdo->prepare("SELECT MAX(score) AS best_score FROM scores WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $best_score = $stmt->fetch(PDO::FETCH_ASSOC)['best_score'];

    // به‌روزرسانی رکورد بهترین بازی
    $stmt = $pdo->prepare("UPDATE users SET best_score = ? WHERE id = ?");
    $stmt->execute([$best_score, $user_id]);

    header("Location: leaderboard.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>بازی حدس عدد</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
  <style>
    .game-container {
      text-align: center;
      margin-top: 50px;
    }
    .btn {
      font-size: 1.5rem;
      margin-top: 20px;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container game-container">
    <h2>بازی حدس عدد</h2>
    <p>حدس بزن که عدد بین ۱ و ۱۰۰ چقدر است!</p>
    <div>
      <input type="number" id="guess" class="form-control" placeholder="عدد خود را وارد کنید" min="1" max="100">
      <button id="submit" class="btn btn-primary w-100 mt-3">ارسال</button>
    </div>

    <div id="result"></div>

    <form id="game-form" method="POST" style="display:none;">
      <input type="hidden" name="score" id="score">
      <button type="submit" id="submit-score" class="btn btn-success w-100 mt-3">ثبت امتیاز</button>
    </form>
  </div>

  <script>
    const randomNumber = Math.floor(Math.random() * 100) + 1;
    let score = 0;

    document.getElementById('submit').addEventListener('click', function() {
      const guess = document.getElementById('guess').value;
      const result = document.getElementById('result');

      if (guess == randomNumber) {
        score = 100;  // امتیاز کامل در صورت حدس درست
        result.innerHTML = `<h3>آفرین! درست حدس زدی! امتیاز شما: ${score}</h3>`;
        document.getElementById('score').value = score;
        document.getElementById('game-form').style.display = 'block';
      } else if (guess < randomNumber) {
        result.innerHTML = `<p>عدد بزرگتر است.</p>`;
      } else {
        result.innerHTML = `<p>عدد کوچکتر است.</p>`;
      }
    });
  </script>
</body>
</html>
