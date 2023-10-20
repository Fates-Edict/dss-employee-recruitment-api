<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Modules;
use App\Models\Roles;
use App\Models\JobVacancies;
use App\Models\Alternatives;
use App\Models\Criteria;
use App\Models\CriteriaAlternatives;
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
            'Alternatives',
            'Criteria',
            'Criteria Alternatives'
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

        $jobVacancies = ['Fullstack Developer', 'System Analyst', 'Project Manager', 'Designer'];
        foreach($jobVacancies as $row) {
            JobVacancies::create([
                'name' => $row,
                'slug' => Str::of($row)->slug('-'),
            ]);
        }

        for($i = 0; $i < 50; $i++) {
            Alternatives::create([
                'name' => 'Alternatif' . $i
            ]);
        }

        $criteria = [
            0 => ['Umur', 'cost'],
            1 => ['Ekspektasi Salary', 'cost'],
            2 => ['Jarak Rumah Ke Kantor', 'cost'],
            3 => ['Pengalaman Menjadi Backend', 'benefit'],
            4 => ['Pengalaman Menjadi Frontend', 'benefit'],
            5 => ['IPK', 'benefit']
        ];

        foreach($criteria as $row) {
            Criteria::create([
                'name' => $row[0],
                'slug' => Str::of($row[0])->slug('-'),
                'type' => $row[1]
            ]);
        }
    }
}
