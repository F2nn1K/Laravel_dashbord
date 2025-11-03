<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Dashboard
            ['name' => 'Acesso ao Dashboard', 'code' => 'view-dashboard', 'description' => 'Permite visualizar o dashboard principal', 'module' => 'dashboard'],

            // Clientes
            ['name' => 'Ver Asociados', 'code' => 'view-asociados', 'description' => 'Permite visualizar lista de asociados', 'module' => 'clientes'],
            ['name' => 'Criar Asociados', 'code' => 'create-asociados', 'description' => 'Permite criar novos asociados', 'module' => 'clientes'],
            ['name' => 'Editar Asociados', 'code' => 'edit-asociados', 'description' => 'Permite editar asociados', 'module' => 'clientes'],
            ['name' => 'Deletar Asociados', 'code' => 'delete-asociados', 'description' => 'Permite deletar asociados', 'module' => 'clientes'],

            ['name' => 'Ver Investidores', 'code' => 'view-investidores', 'description' => 'Permite visualizar lista de investidores', 'module' => 'clientes'],
            ['name' => 'Criar Investidores', 'code' => 'create-investidores', 'description' => 'Permite criar novos investidores', 'module' => 'clientes'],
            ['name' => 'Editar Investidores', 'code' => 'edit-investidores', 'description' => 'Permite editar investidores', 'module' => 'clientes'],
            ['name' => 'Deletar Investidores', 'code' => 'delete-investidores', 'description' => 'Permite deletar investidores', 'module' => 'clientes'],

            ['name' => 'Ver Outros', 'code' => 'view-outros', 'description' => 'Permite visualizar lista de outros clientes', 'module' => 'clientes'],
            ['name' => 'Criar Outros', 'code' => 'create-outros', 'description' => 'Permite criar outros clientes', 'module' => 'clientes'],
            ['name' => 'Editar Outros', 'code' => 'edit-outros', 'description' => 'Permite editar outros clientes', 'module' => 'clientes'],
            ['name' => 'Deletar Outros', 'code' => 'delete-outros', 'description' => 'Permite deletar outros clientes', 'module' => 'clientes'],

            // Estoque
            ['name' => 'Ver Produtos', 'code' => 'view-produtos', 'description' => 'Permite visualizar lista de produtos', 'module' => 'estoque'],
            ['name' => 'Criar Produtos', 'code' => 'create-produtos', 'description' => 'Permite criar novos produtos', 'module' => 'estoque'],
            ['name' => 'Editar Produtos', 'code' => 'edit-produtos', 'description' => 'Permite editar produtos', 'module' => 'estoque'],
            ['name' => 'Deletar Produtos', 'code' => 'delete-produtos', 'description' => 'Permite deletar produtos', 'module' => 'estoque'],

            // Vendas
            ['name' => 'Ver Vendas', 'code' => 'view-vendas', 'description' => 'Permite visualizar lista de vendas', 'module' => 'vendas'],
            ['name' => 'Criar Vendas', 'code' => 'create-vendas', 'description' => 'Permite registrar novas vendas', 'module' => 'vendas'],
            ['name' => 'Editar Vendas', 'code' => 'edit-vendas', 'description' => 'Permite editar vendas', 'module' => 'vendas'],
            ['name' => 'Deletar Vendas', 'code' => 'delete-vendas', 'description' => 'Permite deletar vendas', 'module' => 'vendas'],
            ['name' => 'Abrir/Encerrar Caixa', 'code' => 'manage-caixa', 'description' => 'Permite abrir e encerrar caixa de vendas', 'module' => 'vendas'],

            // Relatórios
            ['name' => 'Ver Relatórios', 'code' => 'view-relatorios', 'description' => 'Permite acessar relatórios', 'module' => 'relatorios'],
            ['name' => 'Gerar Relatório Total Vendas', 'code' => 'relatorio-total-vendas', 'description' => 'Permite gerar relatório de vendas', 'module' => 'relatorios'],
            ['name' => 'Gerar Modelo de Gestão', 'code' => 'relatorio-modelo-gestao', 'description' => 'Permite gerar modelo de gestão', 'module' => 'relatorios'],
            ['name' => 'Gerar Modelo de Gestão 2', 'code' => 'relatorio-modelo-gestao-2', 'description' => 'Permite gerar modelo de gestão 2', 'module' => 'relatorios'],

            // Admin
            ['name' => 'Ver Usuários', 'code' => 'view-usuarios', 'description' => 'Permite visualizar lista de usuários', 'module' => 'admin'],
            ['name' => 'Criar Usuários', 'code' => 'create-usuarios', 'description' => 'Permite criar novos usuários', 'module' => 'admin'],
            ['name' => 'Editar Usuários', 'code' => 'edit-usuarios', 'description' => 'Permite editar usuários', 'module' => 'admin'],
            ['name' => 'Deletar Usuários', 'code' => 'delete-usuarios', 'description' => 'Permite deletar usuários', 'module' => 'admin'],

            ['name' => 'Ver Empresas', 'code' => 'view-empresas', 'description' => 'Permite visualizar lista de empresas', 'module' => 'admin'],
            ['name' => 'Criar Empresas', 'code' => 'create-empresas', 'description' => 'Permite criar novas empresas', 'module' => 'admin'],
            ['name' => 'Editar Empresas', 'code' => 'edit-empresas', 'description' => 'Permite editar empresas', 'module' => 'admin'],
            ['name' => 'Deletar Empresas', 'code' => 'delete-empresas', 'description' => 'Permite deletar empresas', 'module' => 'admin'],

            // Configurações
            ['name' => 'Ver Configurações', 'code' => 'view-configuracoes', 'description' => 'Permite acessar configurações', 'module' => 'configuracoes'],
            ['name' => 'Editar Configurações', 'code' => 'edit-configuracoes', 'description' => 'Permite editar configurações do sistema', 'module' => 'configuracoes'],

            // ACL
            ['name' => 'Gerenciar Permissões', 'code' => 'manage-permissions', 'description' => 'Permite gerenciar permissões do sistema', 'module' => 'acl'],
            ['name' => 'Gerenciar Perfis', 'code' => 'manage-roles', 'description' => 'Permite gerenciar perfis de usuário', 'module' => 'acl'],
            ['name' => 'Atribuir Permissões', 'code' => 'assign-permissions', 'description' => 'Permite atribuir permissões aos perfis', 'module' => 'acl'],
        ];

        foreach ($permissions as $permission) {
            // Evitar duplicidade se rodar mais de uma vez
            DB::table('permissions')->insertOrIgnore($permission);
        }

        // Criar perfis
        $roles = [
            ['name' => 'Administrador', 'code' => 'admin', 'description' => 'Acesso total ao sistema', 'in_estatus' => 'ativo'],
            ['name' => 'Gerente', 'code' => 'manager', 'description' => 'Gerente com acesso a relatórios e vendas', 'in_estatus' => 'ativo'],
            ['name' => 'Vendedor', 'code' => 'user', 'description' => 'Vendedor com acesso limitado', 'in_estatus' => 'ativo'],
            ['name' => 'Somente Leitura', 'code' => 'readonly', 'description' => 'Apenas visualização, sem editar/deletar', 'in_estatus' => 'ativo'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insertOrIgnore($role);
        }

        // Atribuir TODAS permissões ao Admin
        $adminRoleId = DB::table('roles')->where('code', 'admin')->value('id');
        $allPermissions = DB::table('permissions')->pluck('id');
        
        foreach ($allPermissions as $permissionId) {
            DB::table('role_permission')->insertOrIgnore([
                'role_id' => $adminRoleId,
                'permission_id' => $permissionId,
            ]);
        }

        // Atribuir perfil Admin ao usuário admin
        $adminUserId = DB::table('users')->where('name', 'admin')->value('id');
        if ($adminUserId) {
            DB::table('user_role')->insertOrIgnore([
                'user_id' => $adminUserId,
                'role_id' => $adminRoleId,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('user_role')->truncate();
        DB::table('role_permission')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
    }
};

