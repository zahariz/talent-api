<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = Contact::create([
            'first_name' => 'Riki',
            'last_name' => 'Kurniawan',
            'email' => 'riki@madebyriki.com',
            'phone' => '123123123',
            'age' => 26,
            'address' => 'Bandung'
        ]);
    }
}
