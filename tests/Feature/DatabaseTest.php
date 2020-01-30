<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Role;
use App\Models\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
//        use RefreshDatabase;

   use DatabaseMigrations;
   use WithoutMiddleware;
    public function test_signed_in_user_can_see_logo()
    {
//        factory(Role::class)->create(['id' => 35]);
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get('/')->assertSee('Cytonn Libraries');
    }
    public function test_adding_a_book_to_the_database()
    {
        Event::fake();
        $this->withoutExceptionHandling();
//        $role = factory(User::class)->make();
        $user = factory(User::class)->create();
        $this->post('/books',[
            'name' => 'This is Maggie',
            'descritption' => 'Gal is writtng tests' ,
            'status_id' => 6,
        ]);
        $this->assertCount(1,Book::all());
//        $this->assertDatabaseHas('writeups', array $data);
    }
    public function test_getting_books_from_database()
    {
        $user = factory(User::class)->create();
        factory(Book::class)->create(['status_id' => 6]);
        $response = $this->get('/books')
        ->assertStatus(200);
    }
}
