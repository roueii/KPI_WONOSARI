@echo off
set "PATH=C:\laragon\bin\php\php-8.2.26-Win32-vs16-x64;%PATH%"
echo Starting KPI-WONOSARI (Frontend) on http://127.0.0.1:8080 ...
php artisan serve --port=8080 %*

