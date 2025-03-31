<?php
session_start();
require_once "php/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $confirm_password = trim($_POST['confirm_password'] ?? '');
  
  if ($password !== $confirm_password) {
    $error_message = "رمز عبور و تایید رمز با هم مطابقت ندارند.";
  } else {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing_user) {
      $error_message = "این ایمیل قبلاً ثبت‌نام شده است.";
    } else {
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);
      $username = substr($email, 0, strpos($email, '@'));
      $avatar = 'avatar1.png'; // آواتار پیش‌فرض

      $stmt = $pdo->prepare("INSERT INTO users (email, password, username, avatar) VALUES (?, ?, ?, ?)");
      $stmt->execute([$email, $hashed_password, $username, $avatar]);

      $_SESSION['user_id'] = $pdo->lastInsertId();
      $_SESSION['username'] = $username;
      $_SESSION['avatar'] = $avatar;
      
      header("Location: login.php");
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت‌نام</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card text-center shadow mx-auto" style="max-width: 400px">
      <div class="card-body">
        <h3 class="card-title mb-4">ثبت‌نام</h3>
        <?php if (isset($error_message)): ?>
          <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">ایمیل</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">رمز عبور</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">تایید رمز عبور</label>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">ثبت‌نام</button>
        </form>
        <a href="login.php" class="btn btn-outline-primary mt-3 w-100">ورود</a>
      </div>
    </div>
  </div>
</body>
</html>
