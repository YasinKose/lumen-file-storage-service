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
            'api_key' => 'asdf',
            'domain_ip' => '127.0.0.1'
        ]);
    }
}
