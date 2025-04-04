# راز عدد - بازی آنلاین حدس عدد

راز عدد یک بازی آنلاین است که در آن شما باید یک عدد تصادفی بین ۱ تا ۱۰۰ را حدس بزنید. در این بازی، رکوردهای شما ثبت می‌شوند و می‌توانید در جدول برترین‌ها شرکت کنید.

## ویژگی‌ها

- بازی حدس عدد
- ثبت رکورد و نمایش بهترین رکورد
- چت آنلاین با کاربران دیگر
- پروفایل کاربری با آواتار و نام کاربری
- سیستم مدیریت حساب کاربری با ثبت‌نام و ورود
- جدول برترین‌ها برای مشاهده بهترین رکوردها

## نصب و راه‌اندازی

### پیش‌نیازها
- PHP 7.4 یا بالاتر
- MySQL یا MariaDB
- Apache یا Nginx (برای اجرای PHP)

### گام‌های نصب
1. فایل‌ها را دانلود کنید و در ریشه هاست خود قرار دهید.
2. فایل `db.sql` را برای ایجاد پایگاه داده و جداول مورد نیاز اجرا کنید.
3. تنظیمات اتصال به دیتابیس را در فایل `php/config.php` تنظیم کنید.
4. فایل `.htaccess` را در ریشه پروژه قرار دهید تا تنظیمات مربوط به سرور انجام شود.
5. اطمینان حاصل کنید که همه فایل‌ها به درستی روی سرور قرار دارند و مجوزهای لازم را دارند.

### اجرای پروژه
1. برای اجرای پروژه، کافی است به آدرس `index.html` یا `index.php` در مرورگر خود بروید.
2. کاربران می‌توانند با ثبت‌نام یا ورود به حساب خود وارد بازی شوند و رکوردهای خود را ثبت کنند.

## ساختار پروژه
- `index.html`: صفحه اصلی بازی
- `login.php`: فرم ورود
- `register.php`: فرم ثبت‌نام
- `game.php`: صفحه بازی حدس عدد
- `leaderboard.php`: جدول برترین‌ها
- `public_profile.php`: صفحه پروفایل عمومی کاربر
- `php/`: شامل فایل‌های PHP برای پردازش داده‌ها و تعامل با دیتابیس

## توسعه‌دهندگان

- **محمد اسماعیلی** - *توسعه‌دهنده اصلی* - [GitHub Profile](https://github.com/mrm-esmaili)
  
### تشکر و قدردانی
از تمامی افرادی که در این پروژه مشارکت کردند، تشکر می‌کنیم.

