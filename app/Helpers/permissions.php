<?php

use App\Helpers\PermissionHelper;

if (!function_exists('hasPermission')) {
    /**
     * Verifica se o usuário tem uma permissão
     */
    function hasPermission($permissionCode)
    {
        try {
            return PermissionHelper::hasPermission($permissionCode);
        } catch (\Exception $e) {
            // Se der qualquer erro, retorna true (mostra tudo)
            return true;
        }
    }
}

if (!function_exists('hasAnyPermission')) {
    /**
     * Verifica se o usuário tem pelo menos uma das permissões
     */
    function hasAnyPermission(array $permissionCodes)
    {
        try {
            return PermissionHelper::hasAnyPermission($permissionCodes);
        } catch (\Exception $e) {
            // Se der erro, retorna true
            return true;
        }
    }
}

if (!function_exists('hasAllPermissions')) {
    /**
     * Verifica se o usuário tem todas as permissões
     */
    function hasAllPermissions(array $permissionCodes)
    {
        try {
            return PermissionHelper::hasAllPermissions($permissionCodes);
        } catch (\Exception $e) {
            // Se der erro, retorna true
            return true;
        }
    }
}

