<?php
session_start();
require_once "config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$score = $_POST['score'] ?? 0; // امتیاز ارسال‌شده از بازی

if ($score > 0) {
  $stmt = $pdo->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
  $stmt->execute([$user_id, $score]);
  
  // به‌روزرسانی بهترین رکورد
  $stmt = $pdo->prepare("SELECT MAX(score) AS best_score FROM scores WHERE user_id = ?");
  $stmt->execute([$user_id]);
  $best_score = $stmt->fetch(PDO::FETCH_ASSOC)['best_score'];

  // به‌روزرسانی رکورد بهترین بازی در دیتابیس
  $stmt = $pdo->prepare("UPDATE users SET best_score = ? WHERE id = ?");
  $stmt->execute([$best_score, $user_id]);

  echo json_encode(['status' => 'success', 'best_score' => $best_score]);
} else {
  echo json_encode(['status' => 'error', 'message' => 'امتیاز نامعتبر است']);
}
?>
