<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'nom' => 'test',
            'prenom' => 'test',
            'email' => 'test@test.fr',
            'email_confirmation' => 'test@test.fr',
            'tel' => '0765566776',
            'nom_societe' => 'test',
            'numTVA' => 'grddfdsffefesd',
            'adresse' => '4 rue du puys',
            'pays' => 'France',
            'cp' => '45000',
            'ville' => 'orléans',
            'nameFileKbis' => 'test',
            'nameFileIdentiter' => 'test',
        ]);

        $response->assertStatus(200);
    }

    public function test_new_users_cant_register()
    {
        $response = $this->post('/register', [
            'nom' => '',
            'prenom' => 'test',
            'email' => 'test@test.fr',
            'email_confirmation' => 'test@test.fr',
            'tel' => '0765566776',
            'nom_societe' => 'test',
            'numTVA' => 'grddfdsffefesd',
            'adresse' => '4 rue du puys',
            'pays' => 'France',
            'cp' => '45000',
            'ville' => 'orléans',
            'nameFileKbis' => 'test',
            'nameFileIdentiter' => 'test',
        ]);

        $response->assertStatus(302);
    }
}
