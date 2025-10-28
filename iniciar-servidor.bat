@echo off
chcp 65001 >nul
title Marudi Mountain - Servidor Laravel
color 0A

echo ==========================================
echo  MARUDI MOUNTAIN - SERVIDOR LARAVEL
echo ==========================================
echo.
echo Iniciando servidor...
echo URL: http://localhost:8000
echo.
echo Para parar o servidor, pressione CTRL+C
echo ==========================================
echo.

cd /d "%~dp0"

php artisan serve

pause

