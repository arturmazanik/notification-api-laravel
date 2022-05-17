<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createAdmin = User::create([
            'email'         =>  "test@test.test",
            'password'      =>  Hash::make("test"),
            'role'          =>  1,
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now()
        ]);
    }
}
