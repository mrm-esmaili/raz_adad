<?php
session_start();
require_once "config.php";

// چک کردن اینکه کاربر وارد شده است یا خیر
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_username = trim($_POST['username'] ?? '');
  if ($new_username) {
    $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
    $stmt->execute([$new_username, $user_id]);
    $_SESSION['username'] = $new_username;
  }

  // تغییر آواتار
  $new_avatar = $_POST['avatar'] ?? '';
  if ($new_avatar) {
    $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
    $stmt->execute([$new_avatar, $user_id]);
    $_SESSION['avatar'] = $new_avatar;
  }

  header("Location: profile.php");
  exit();
}
?>
