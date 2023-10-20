<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Modules;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [];
        $modules = [
            'Dashboard',
            'Users',
            'Roles',
            'Modules',
            'Job Vacancies',
            'Alternatives'
        ];
        foreach($modules as $module) {
            Modules::create([
                'name'  => $module,
                'slug'  => Str::of($module)->slug('-')
            ]);
            $permissions[] = [
                'name' => $module,
                'slug' => Str::of($module)->slug('-'),
                'browse' => true,
                'create' => true,
                'read' => true,
                'write' => true,
                'update' => true,
                'delete' => true
            ];
        }

        Roles::create([
            'name' => 'Super Admin',
            'permissions' => $permissions
        ]);

        for($i = 0; $i < 50; $i++) {
            User::create([
                'role_id'   => 1,
                'username'  => 'username' . $i,
                'name'      => 'name ' . $i,
                'email'     => 'username' . $i . '@gmail.com',
                'password'  => Hash::make('password123')
            ]);
        }
    }
}
