<?php
$host = 'localhost'; // نام هاست دیتابیس
$dbname = 'raz_adad'; // نام دیتابیس
$username = 'root'; // نام کاربری دیتابیس
$password = ''; // رمز عبور دیتابیس

try {
    // ایجاد اتصال به دیتابیس
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // تنظیم ویژگی‌های اتصال برای مدیریت خطا
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // در صورت بروز خطا
    echo "خطا در اتصال به دیتابیس: " . $e->getMessage();
    exit();
}
?>
