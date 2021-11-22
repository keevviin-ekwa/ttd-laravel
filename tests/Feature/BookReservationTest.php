<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class  BookReservationTest extends TestCase
{
    /**
         * @test
         */
    public function a_book_can_be_added_to_library()
    {
        $this->withoutExceptionHandling();
        $response=$this->post('api/books',[
            'title'=>'Cool book title',
            'author'=>'Victor'
        ]);
        $response->assertOk();
       $this->assertCount(1,Book::all());

    }

    /**
         * @test
         */
    public function a_title_is_required()
    {
        //$this->withoutExceptionHandling();
        $response=$this->post('api/books',[
            'title'=>'',
            'author'=>'Victor'
        ]);
        $response->assertSessionHasErrors('title');
        //$this->assertCount(0,Book::all());
    }

    /**
     * @test
     */
    public function the_author_is_required()
    {
        //$this->withoutExceptionHandling();
        $response=$this->post('api/books',[
            'title'=>'Cool book title',
            'author'=>''
        ]);
        $response->assertSessionHasErrors('author');

    }

    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
         $this->post('api/books',[
            'title'=>'Cool book title',
            'author'=>'Victor'
        ]);
         $book= Book::first();
        $response=$this->patch('api/books/'.$book->id,[
            'title'=>'Harry Potter',
            'author'=>'Victor Hugo'
        ]);
        $response->assertOk();
        $this->assertEquals('Harry Potter',Book::first()->title);
        $this->assertEquals('Victor Hugo',Book::first()->author);
    }

}
