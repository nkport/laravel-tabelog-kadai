<?php

namespace Tests\Feature\Admin\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_view_the_login_page()
    {
        $response = $this->get('/admin/auth/login');

        $response->assertStatus(200);
    }

}
