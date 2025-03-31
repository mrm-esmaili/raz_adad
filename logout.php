<?php
session_start();

// حذف تمامی سشن‌ها
session_unset();
session_destroy();

// هدایت به صفحه ورود
header("Location: login.php");
exit();
?>
