<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {

        $response = $this->json('POST','/api/register',
        [
            'name' => 'Victor',
            'email' => 'vawonder@gmail.com',
            'password' => 'alex2020'
        ]);

        $response->AssertStatus(201);
    }
}
