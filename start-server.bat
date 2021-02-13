@echo off
net start postgresql-x64-13
start http://localhost:8080/user/25648
php -S localhost:8080 -t public/