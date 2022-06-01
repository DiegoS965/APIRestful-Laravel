<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideogameApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_user()
    {
        $user = [
            'name'=>'Diego prueba99',
            'username'=>'diegoPrueba99',
            'email'=>'diegoprueba99@gmail.com',
            'password'=>'1234563',
            'password_confirmation'=>'1234563'
        ];

        $this->json('POST',route('register'),$user)->assertStatus(201);
    }

    public function test_can_login_user()
    {
        $user = [
            'email'=>'diegoprueba@mail.com',
            'password'=>'123456',
        ];

        $this->json('POST',route('login'),$user)->assertStatus(201);
    } 

    public function test_can_logout_user()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );
        $this->json('POST',route('logout'))->assertStatus(200);
    }

    public function test_can_get_games()
    {
        $this->json('GET',route('game.index'))->assertStatus(200);
    }

    public function test_can_show_games()
    {
        $id = 1;
        $this->json('GET',route("game.show",$id))->assertStatus(200);
    }

    public function test_can_search_games()
    {
        $keyword = "eld";
        $this->json('GET',route("game.search",$keyword))->assertStatus(200);
    } 
    public function test_can_create_videogame()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $videogameData = [
            'title'=>'Testgame',
            'description'=>'testdescription',
            'genres_id'=>1,
            'platforms_id'=>1,
            'price'=>60,
        ];

        $this->json('POST',route('game.store'),$videogameData)->assertStatus(201);
    }  
}
