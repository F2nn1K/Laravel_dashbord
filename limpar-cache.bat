@echo off
chcp 65001 >nul
title Limpar Cache - Marudi Mountain
color 0E

echo ==========================================
echo  LIMPANDO CACHE DO SISTEMA
echo ==========================================
echo.

cd /d "%~dp0"

php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo.
echo ==========================================
echo  CACHE LIMPO COM SUCESSO!
echo ==========================================
echo.

pause

