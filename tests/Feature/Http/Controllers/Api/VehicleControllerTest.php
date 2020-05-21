<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Vehicle;
use App\User;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Feature test to store a new vehicle.
     *
     * @return void
     */
    public function test_store()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->json('POST','/api/vehicles',
        [
            'registrationnumber' => 'AB12345',
            'owner' => 'Pedro Perez',
            'profile' => 'Residente',
        ], ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['id','owner'])
                ->AssertJson(['registrationnumber' => 'AB12345'])
                ->AssertStatus(201);

        $this->AssertDatabaseHas('vehicles',['registrationnumber' => 'AB12345']);

    }

    /**
     * Feature test to show.
     *
     * @return void
     */
    public function test_show()
    {
        $this->withoutExceptionHandling();
        
        $user = factory(User::class)->create();
        $vehicle = factory(Vehicle::class)->create();

        $response = $this->json('GET',"/api/vehicles/$vehicle->id",[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['id','registrationnumber','owner'])
                ->AssertJson(['owner' => $vehicle->owner])
                ->AssertStatus(200);
    }


     /**
     * Feature test to update a vehicles.
     *
     * @return void
     */
    public function test_update()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $vehicle = factory(Vehicle::class)->create();

        $response = $this->json('PUT',"/api/vehicles/$vehicle->id",
        [
            'registrationnumber' => 'AB12345',
            'owner' => 'Pedro Perez',
            'profile' => 'Residente',
        ],['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['registrationnumber','owner'])
                ->AssertJson(['registrationnumber' => 'AB12345'])
                ->AssertStatus(200);

        $this->AssertDatabaseHas('vehicles',['registrationnumber' => 'AB12345']);
    }

     /**
     * Feature test to delete a vehicle.
     *
     * @return void
     */
    public function test_delete()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $vehicle = factory(Vehicle::class)->create();

        $response = $this->json('DELETE',"/api/vehicles/$vehicle->id",[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        //without content
        $response->assertSee(null)
                ->AssertStatus(204);

        $this->AssertDatabaseMissing('vehicles',['registrationnumber' => $vehicle->registrationnumber]);
    }

    /**
     * Feature test to display a listing of the vehicles
     *
     * @return void
     */
    public function test_index()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        factory(Vehicle::class,5)->create();

        $response = $this->json('GET','/api/vehicles',[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['registrationnumber','owner']
            ]])->AssertStatus(200);

    }

     /**
     * Feature test to authentication
     *
     * @return void
     */
    public function test_guest()
    {
        //$this->withoutExceptionHandling();

        $this->json('GET',    '/api/vehicles')->assertStatus(401);
        $this->json('POST',   '/api/vehicles')->assertStatus(401);

    }

}
