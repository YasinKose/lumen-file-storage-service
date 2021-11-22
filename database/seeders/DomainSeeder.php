<?php

namespace Database\Seeders;

use App\Models\Domain;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run()
    {
        Domain::create([
            'name' => 'Test',
            'apiKey' => 'asdf',
            'domainIp' => '1291658546354'
        ]);
    }
}
