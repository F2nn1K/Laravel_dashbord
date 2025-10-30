@echo off
chcp 65001 >nul
title Marudi Mountain - Sistema de Vendas
color 0A

cd /d "%~dp0"

echo ==========================================
echo  MARUDI MOUNTAIN - INICIANDO SISTEMA
echo ==========================================
echo.

REM Limpar caches
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1
php artisan view:clear >nul 2>&1

echo  [OK] Caches limpos
echo  [OK] Iniciando servidor...
echo.
echo ==========================================
echo  ACESSE: http://localhost:8001
echo ==========================================
echo.
echo  Usuario: admin
echo  Senha: admin123
echo.
echo  Pressione CTRL+C para parar o servidor
echo ==========================================
echo.

php artisan serve --port=8001

pause

