<?php

use App\Helpers\PermissionHelper;

if (!function_exists('hasPermission')) {
    /**
     * Verifica se o usuário tem uma permissão
     */
    function hasPermission($permissionCode)
    {
        return PermissionHelper::hasPermission($permissionCode);
    }
}

if (!function_exists('hasAnyPermission')) {
    /**
     * Verifica se o usuário tem pelo menos uma das permissões
     */
    function hasAnyPermission(array $permissionCodes)
    {
        return PermissionHelper::hasAnyPermission($permissionCodes);
    }
}

if (!function_exists('hasAllPermissions')) {
    /**
     * Verifica se o usuário tem todas as permissões
     */
    function hasAllPermissions(array $permissionCodes)
    {
        return PermissionHelper::hasAllPermissions($permissionCodes);
    }
}

