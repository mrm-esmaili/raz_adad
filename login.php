<?php
session_start();
require_once "php/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');
  
  if ($email && $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['avatar'] = $user['avatar'];
      header("Location: dashboard.php");
      exit();
    } else {
      $error_message = "ایمیل یا رمز عبور اشتباه است.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card text-center shadow mx-auto" style="max-width: 400px">
      <div class="card-body">
        <h3 class="card-title mb-4">ورود به حساب کاربری</h3>
        <?php if (isset($error_message)): ?>
          <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">ایمیل</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">رمز عبور</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">ورود</button>
        </form>
        <a href="register.php" class="btn btn-outline-primary mt-3 w-100">ثبت‌نام</a>
      </div>
    </div>
  </div>
</body>
</html>
