<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use App\Models\Writeup;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
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
    public function test_adding_a_book_to_the_database()
    {
        Event::fake();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create(['role_id' => 35]);
        $this->post('books',[
            'name' => 'This is Maggie',
            'descritption' => 'Gal is writtng tests' ,
            'status_id' => 6,
        ]);
        $this->assertCount(1,Book::all());
//        $this->assertDatabaseHas('writeups', array $data);
    }
    public function test_getting_blogs_from_database()
    {
        $user = factory(User::class)->create();
        factory(Book::class)->create(['status_id' => 6]);
        $response = $this->get('books');
        $response->assertStatus(201);
    }
}
