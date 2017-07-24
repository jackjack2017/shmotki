<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use Illuminate\Support\Facades\DB;
use LaravelComponents\Users\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Adding users
         */
        $admin = User::create([
            'name' => 'admin',
            'password' => bcrypt('admin')
        ]);
        $manager = User::create([
            'name' => 'manager',
            'password' => bcrypt('manager')
        ]);

        /*
         * Add roles
         */
        $admin_role = Role::create([
            'name' => 'Администратор',
            'slug' => 'admin',
            'description' => '',
            'level' => 1
        ]);
        $manager_role = Role::create([
            'name' => 'Менеджер',
            'slug' => 'manager',
            'description' => '',
            'level' => 1
        ]);


        /*
         * Create permissions
         */
        $tune_app_permission = Permission::create([
            'name' => 'Изменять основные настройки приложения',
            'slug' => 'tune.app',
            'description' => 'Изменять основные настройки приложения, производить диагностику приложния'
        ]);
        $hard_tune_app_permission = Permission::create([
            'name' => 'Изменять все настройки приложения',
            'slug' => 'hard.tune.app',
            'description' => 'Изменять все настройки приложения, производить диагностику приложния'
        ]);

        $edit_content_permission = Permission::create([
            'name' => 'Изменять контент сайта',
            'slug' => 'edit.content',
            'description' => 'Изменение контента, управление сервисам, бригадами и сотрудниками'
        ]);
        $access_request_permission = Permission::create([
            'name' => 'Доступ к заявкам',
            'slug' => 'access.request',
            'description' => 'Возможность просматиривать и экспортирвать заявки'
        ]);
        $manage_users_permission = Permission::create([
            'name' => 'Управление пользователями',
            'slug' => 'manage.users',
            'description' => 'Добавлять, удалять и изменять пользователей'
        ]);

        /*
         * Attaching roles
         */
        $admin->attachRole($admin_role);
        $manager->attachRole($manager_role);

        /*
         * Attaching permissions
         */
        //Admin
        $admin_role->attachPermission($tune_app_permission);
        $admin_role->attachPermission($hard_tune_app_permission);
        $admin_role->attachPermission($manage_users_permission);
        $admin_role->attachPermission($edit_content_permission);
        $admin_role->attachPermission($access_request_permission);
        //Manager
        $manager_role->attachPermission($access_request_permission);
        $manager_role->attachPermission($tune_app_permission);
        $manager_role->attachPermission($edit_content_permission);

    }
}
