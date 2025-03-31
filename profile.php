<?php
session_start();
require_once "php/config.php";

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$avatar = $_SESSION['avatar'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_username = trim($_POST['username'] ?? '');
  if ($new_username && $new_username !== $username) {
    $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
    $stmt->execute([$new_username, $user_id]);
    $_SESSION['username'] = $new_username;
    header("Location: profile.php");
    exit();
  }

  // تغییر آواتار
  $new_avatar = $_POST['avatar'] ?? $avatar;
  $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
  $stmt->execute([$new_avatar, $user_id]);
  $_SESSION['avatar'] = $new_avatar;
  header("Location: profile.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>پروفایل من</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card text-center shadow mx-auto" style="max-width: 400px">
      <div class="card-body">
        <img src="avatars/<?php echo $avatar; ?>" class="rounded-circle mb-3" width="100" height="100">
        <h3 class="card-title">پروفایل <?php echo htmlspecialchars($username); ?></h3>
        <form action="profile.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">تغییر نام کاربری</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
          </div>
          <div class="mb-3">
            <label for="avatar" class="form-label">انتخاب آواتار</label>
            <select name="avatar" id="avatar" class="form-select" required>
              <option value="avatar1.png" <?php echo ($avatar === 'avatar1.png') ? 'selected' : ''; ?>>آواتار ۱</option>
              <option value="avatar2.png" <?php echo ($avatar === 'avatar2.png') ? 'selected' : ''; ?>>آواتار ۲</option>
              <option value="avatar3.png" <?php echo ($avatar === 'avatar3.png') ? 'selected' : ''; ?>>آواتار ۳</option>
              <option value="avatar4.png" <?php echo ($avatar === 'avatar4.png') ? 'selected' : ''; ?>>آواتار ۴</option>
              <option value="avatar5.png" <?php echo ($avatar === 'avatar5.png') ? 'selected' : ''; ?>>آواتار ۵</option>
              <option value="avatar6.png" <?php echo ($avatar === 'avatar6.png') ? 'selected' : ''; ?>>آواتار ۶</option>
              <option value="avatar7.png" <?php echo ($avatar === 'avatar7.png') ? 'selected' : ''; ?>>آواتار ۷</option>
              <option value="avatar8.png" <?php echo ($avatar === 'avatar8.png') ? 'selected' : ''; ?>>آواتار ۸</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">تغییر نام کاربری و آواتار</button>
        </form>
        <a href="game.php" class="btn btn-success mt-3 w-100">بازی</a>
      </div>
    </div>
  </div>
</body>
</html>
