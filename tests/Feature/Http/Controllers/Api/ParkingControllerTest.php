<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Parking;
use App\User;

class ParkingControllerTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Feature test to store a new parking.
     *
     * @return void
     */
    public function test_store()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->json('POST','/api/parkings',
        [
            'vehicle' => 'AB12345',
            'profile' => 'Residente',
            'month' => 'May',
            'intime'=>  time(),
        ], ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['vehicle','intime'])
                ->AssertJson(['vehicle' => 'AB12345'])
                ->AssertStatus(201);

        $this->AssertDatabaseHas('parkings',['vehicle' => 'AB12345']);

    }

    /**
     * Feature test to show.
     *
     * @return void
     */
    public function test_show()
    {
        //$this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $parking = factory(Parking::class)->create();

        $response = $this->json('GET',"/api/parkings/$parking->id",[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['id','vehicle','intime'])
                ->AssertJson(['vehicle' => $parking->vehicle])
                ->AssertStatus(200);
    }

    /**
     * Feature test to update a parking (in out).
     *
     * @return void
     */
    public function test_update()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $parking = factory(Parking::class)->create();

        $response = $this->json('PUT',"/api/parkings/$parking->id",
        [
            'vehicle' => 'AB12345',
        ],['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['vehicle','outtime'])
                ->AssertJson(['vehicle' => 'AB12345'])
                ->AssertStatus(200);

        $this->AssertDatabaseHas('parkings',['intime' => $parking->intime]);
    }

     /**
     * Feature test to display a listing of the parking
     *
     * @return void
     */
    public function test_index()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        factory(Parking::class,5)->create();

        $response = $this->json('GET','/api/parkings',[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['vehicle','intime']
            ]])->AssertStatus(200);

    }

}
