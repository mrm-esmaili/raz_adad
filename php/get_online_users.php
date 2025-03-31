<?php
session_start();
require_once "config.php";

// چک کردن اینکه کاربر وارد شده باشد
if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'شما وارد نشده‌اید']);
  exit();
}

// دریافت کاربران آنلاین
$stmt = $pdo->query("SELECT users.username, users.avatar, user_online.last_active
                     FROM user_online
                     JOIN users ON user_online.user_id = users.id
                     WHERE TIMESTAMPDIFF(MINUTE, user_online.last_active, NOW()) < 5");

$online_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'success', 'online_users' => $online_users]);
?>
