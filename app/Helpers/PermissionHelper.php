<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PermissionHelper
{
    /**
     * Verifica se o usuário logado tem uma permissão específica
     */
    public static function hasPermission($permissionCode)
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        // FALLBACK: Se tabelas não existirem, retorna true (mostra tudo)
        try {
            if (!\Schema::hasTable('permissions') || !\Schema::hasTable('roles') || !\Schema::hasTable('user_role')) {
                return true; // Modo compatibilidade - mostra tudo
            }
        } catch (\Exception $e) {
            return true; // Se der erro, mostra tudo
        }

        // Cache por 5 minutos para performance
        $cacheKey = "user_{$user->id}_permissions";
        
        try {
            $userPermissions = Cache::remember($cacheKey, 300, function() use ($user) {
                return DB::table('permissions')
                    ->join('role_permission', 'permissions.id', '=', 'role_permission.permission_id')
                    ->join('user_role', 'role_permission.role_id', '=', 'user_role.role_id')
                    ->where('user_role.user_id', $user->id)
                    ->where('permissions.in_estatus', 'ativo')
                    ->pluck('permissions.code')
                    ->toArray();
            });

            return in_array($permissionCode, $userPermissions);
        } catch (\Exception $e) {
            // Se der erro na query, retorna true (mostra tudo)
            \Log::warning('Erro ao verificar permissão: ' . $e->getMessage());
            return true;
        }
    }

    /**
     * Verifica se o usuário tem TODAS as permissões listadas
     */
    public static function hasAllPermissions(array $permissionCodes)
    {
        foreach ($permissionCodes as $code) {
            if (!self::hasPermission($code)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Verifica se o usuário tem PELO MENOS UMA das permissões listadas
     */
    public static function hasAnyPermission(array $permissionCodes)
    {
        foreach ($permissionCodes as $code) {
            if (self::hasPermission($code)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Limpar cache de permissões do usuário
     */
    public static function clearUserPermissionsCache($userId = null)
    {
        $userId = $userId ?? Auth::id();
        Cache::forget("user_{$userId}_permissions");
    }
}

