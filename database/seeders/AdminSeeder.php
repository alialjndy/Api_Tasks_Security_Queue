<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'=>'Ali_Aljendy',
            'email'=>'alialjndy2@gmail.com',
            'password'=>Hash::make('password1234')
        ]);
        $adminRole = Role::where('name','admin')->first();
        $admin->roles()->attach($adminRole->id);
    }
}
