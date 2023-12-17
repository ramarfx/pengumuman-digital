<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin',
        ]);
        $guruRole = Role::create([
            'name' => 'guru',
        ]);
        $studentCouncilRole = Role::create([
            'name' => 'osis',
        ]);
        $siswaRole = Role::create([
            'name' => 'siswa',
        ]);
        $ekskulRole = Role::create([
            'name' => 'ekskul',
        ]);

        // create users
        User::factory()->create([
            'name'    => 'Admin',
            'email'   => 'admin@gmail.com',
            'nis_nip' => '123456',
        ])->roles()->attach($adminRole);

        foreach (User::factory(10)->create() as $user) {
            $user->roles()->attach($guruRole);
        }

        // User::factory(10)->roles()->attach($guruRole);

        // User::factory(15)->roles()->attach($studentCouncilRole);

        // User::factory(7)->roles()->attach($ekskulRole);

        // User::factory(30)->roles()->attach($siswaRole);
    }
}
