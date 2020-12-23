<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        $data = ['name' => 'Nurlan','email' => 'nurlan@gmail.com','password' => '1234567'];

        $this
            ->postJson('/register', $data)
            ->dump()
            ->assertRedirect('/login');
    }
    public function test_login_user()
    {
      $password = '1234567';
      $user = User::factory()->create(
          [
              'password' => bcrypt($password),
          ]
      );



      $this->postJson('/login',['email'=> $user->email,'password' => $password])
          ->dump()
          ->assertRedirect('/');
    }
}
