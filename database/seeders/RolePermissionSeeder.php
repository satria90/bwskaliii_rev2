<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat beberapa role
        //membuat default user untuk super admin

        $ownerRole = Role::create([
            'name' => 'owner'
        ]);

        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $userRole = Role::create([
            'name' => 'client'
        ]);
        // akun super admin untuk mengelola data awal
        // data survey,request dsb
        $userOwner = User::create([
            'name' => 'bwskaliii',
            'avatar' => 'images/default-avatar.png',
            'email' => 'bwskaliii@gmail.com',
            'password' => bcrypt('123123123')
        ]);

        $userOwner->assignRole($ownerRole);

    }
}
