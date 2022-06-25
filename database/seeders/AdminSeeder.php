<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' =>'Edouard',
            'email' => 'edouard.client@client.iencli',
            'password' => Hash::make('-pUH.n9FjTFY_rU'), // password
            'role' => 'ADMIN',
        ]);
    }
}