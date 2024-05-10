<?php

namespace Tests\Feature;

use App\Models\Contact;
use Database\Seeders\ContactSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateSuccess()
    {
        $this->post(uri: "/api/contacts", data:[
            'first_name' => 'Riki',
            'last_name' => 'Kurniawan',
            'email' => 'riki@madebyriki.com',
            'phone' => '123123123',
            'age' => 26,
            'address' => 'Bandung'
        ])->assertStatus(201)
        ->assertJson([
            'data' => [
                'first_name' => 'Riki',
                'last_name' => 'Kurniawan',
                'email' => 'riki@madebyriki.com',
                'phone' => '123123123',
                'age' => 26,
                'address' => 'Bandung'
            ]
        ]);
    }

    public function testCreateFailed()
    {
        $this->post(uri: "/api/contacts", data:[
            'first_name' => 'Riki',
            'last_name' => 'Kurniawan',
            'email' => 'riki@madebyriki.com',
            'phone' => '123123123',
            'age' => 'twentysix',
            'address' => 'Bandung'
        ])->assertStatus(400)
        ->assertJson([
            'errors' => [
                'age' => [
                    'The age field must be an integer.'
                ],
            ]
        ]);
    }



}
