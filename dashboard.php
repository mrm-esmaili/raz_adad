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
  <link rel="stylesheet" href="style.css">
  <style>
    .profile-card {
      background-color: #1a2b5c;
      color: white;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin-top: 20px;
    }
    .profile-card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 20px;
    }
    .btn-primary, .btn-secondary {
      font-size: 1.1rem;
      padding: 12px 30px;
      margin-top: 20px;
      border-radius: 8px;
    }
    .btn-outline-primary {
      border-radius: 8px;
    }
    .profile-card h2 {
      font-size: 1.6rem;
    }
    .game-stats {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }
    .game-stats div {
      background-color: #2f3c7d;
      padding: 15px;
      border-radius: 8px;
      color: white;
      width: 48%;
    }
    .online-users {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }
    .online-users div {
      background-color: #f4f7f6;
      padding: 10px;
      border-radius: 8px;
      color: #333;
      width: 30%;
    }
    .leaderboard {
      margin-top: 30px;
      text-align: left;
    }
    .leaderboard table {
      width: 100%;
      border-collapse: collapse;
    }
    .leaderboard th, .leaderboard td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
  </style>
</head>
<body class="<?php echo isset($_SESSION['theme']) && $_SESSION['theme'] == 'dark' ? 'dark-mode' : ''; ?>">
  <div class="container py-5">
    <div class="profile-card">
      <img src="avatars/<?php echo $avatar; ?>" alt="Avatar" class="rounded-circle mb-3">
      <h2><?php echo htmlspecialchars($username); ?></h2>
      <p>امتیاز: <?php echo $best_score; ?></p>
      <button class="btn btn-primary w-100">شروع بازی</button>
      <button class="btn btn-secondary w-100 mt-3">تمرین</button>
    </div>

    <div class="game-stats">
      <div>
        <h5>تلاش‌ها</h5>
        <p>۳۰</p>
      </div>
      <div>
        <h5>رتبه شما</h5>
        <p>۱۰</p>
      </div>
    </div>

    <div class="online-users">
      <div>
        <h5>آدرینا</h5>
        <p>آنلاین</p>
      </div>
      <div>
        <h5>علیرضا</h5>
        <p>آنلاین</p>
      </div>
      <div>
        <h5>مریم</h5>
        <p>آنلاین</p>
      </div>
    </div>

    <div class="leaderboard">
      <h4>جدول برترین‌ها</h4>
      <table>
        <thead>
          <tr>
            <th>نام</th>
            <th>امتیاز</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>فاطمه</td>
            <td>۵۱۵۰</td>
          </tr>
          <tr>
            <td>رضا</td>
            <td>۴۹۰۰</td>
          </tr>
          <tr>
            <td>سامر</td>
            <td>۴۵۰۰</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="script.js"></script>
</body>
</html>
