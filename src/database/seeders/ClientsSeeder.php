<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createClient1 = Client::create([
            'firstName'     =>  "Joe",
            'lastName'      =>  "Frederik",
            'email'         =>  "JoeFred@test.test",
            'phoneNumber'   =>  "",
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now()
        ]);

        $createClient2 = Client::create([
            'firstName'     =>  "Elon",
            'lastName'      =>  "Mask",
            'email'         =>  "eMask@test.test",
            'phoneNumber'   =>  "",
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now()
        ]);
    }
}
