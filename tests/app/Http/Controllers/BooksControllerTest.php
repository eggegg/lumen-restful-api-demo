<?php

namespace Tests\App\Http\Controllers;

use TestCase;

//use Laravel\Lumen\Testing\DatabaseTransactions;

class BooksControllerTest extends TestCase
{
//    /**
//     * A basic test example.
//     *
//     * @return void
//     */
//    public function testExample()
//    {
//        $this->get('/');
//
//        $this->assertEquals(
//            $this->response->getContent(), $this->app->version()
//        );
//    }

    /** @test */
    public function index_status_code_should_be_200()
    {
        $this->get('/books')->seeStatusCode(200);
    }

    /** @test */
    public function index_should_return_a_collection_of_records()
    {
        $this->get('/books')
            ->seeJson([
                'title' => 'War of the Worlds'
            ])
            ->seeJson([
                'title' => 'A Wrinkle in Time'
            ]);
    }

}
