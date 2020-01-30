<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
//        use DatabaseTransactions;
//    use RefreshDatabase;
    public function test_signed_in_user_can_see_create_form()
    {
        $user = factory(User::class)->create(['role_id' => 35]);
        $this->actingAs($user);
        $this->get('/')->assertSee('Cytonn Libraries');
    }
}
