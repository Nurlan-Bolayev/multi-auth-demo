<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_admin()
    {
        $password = '1234567';
        $admin = Admin::factory()->create(
            [
                'password'=> bcrypt($password),
            ]
        );

        $this
            ->postJson('admin/login',['email' => $admin->email,'password' => $password])
            ->dump()
            ->assertRedirect('admin');
    }
}
