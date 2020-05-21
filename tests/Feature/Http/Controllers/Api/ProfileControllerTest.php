<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Profile;
use App\User;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Feature test to store a new profile.
     *
     * @return void
     */
    public function test_store()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->json('POST','/api/profiles',
        [
            'name' => 'Residente',
            'paymentrequired' => true,
            'paymentperiod' => 'Monthly',
            'amoutperunit' => 0.05
        ], ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['id','name'])
                ->AssertJson(['name' => 'Residente'])
                ->AssertStatus(201);

        $this->AssertDatabaseHas('profiles',['name' => 'Residente']);

    }

    /**
     * Feature test to validate a new profile.
     *
     * @return void
     */
    public function test_validate_name()
    {
        $user = factory(User::class)->create();

        $response = $this->json('POST','/api/profiles',
        [
            'name' => '',
            'paymentrequired' => true,
            'paymentperiod' => 'Monthly',
            'amoutperunit' => 0.05
        ],['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        //Validate unprocessable entity
        $response->AssertStatus(422)
                ->assertJsonValidationErrors('name');

    }

    /**
     * Feature test to show.
     *
     * @return void
     */
    public function test_show()
    {
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();

        // Get profile with ID 1
        $response = $this->json('GET',"/api/profiles/$profile->id",[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['id','name'])
                ->AssertJson(['name' => $profile->name])
                ->AssertStatus(200);
    }

     /**
     * Feature test to show not found profile.
     *
     * @return void
     */
    public function test_404_show()
    {
        $user = factory(User::class)->create();

        // Get unregistered profile
        $response = $this->json('GET','/api/profiles/10000',[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->AssertStatus(404);
    }

     /**
     * Feature test to update a profile.
     *
     * @return void
     */
    public function test_update()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();

        $response = $this->json('PUT',"/api/profiles/$profile->id",
        [
            'name' => 'New',
            'paymentrequired' => true,
            'paymentperiod' => 'Monthly',
            'amoutperunit' => 0.05
        ],['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure(['id','name'])
                ->AssertJson(['name' => 'New'])
                ->AssertStatus(200);

        $this->AssertDatabaseHas('profiles',['name' => 'New']);
    }

     /**
     * Feature test to delete a profile (TEMP).
     *
     * @return void
     */
    public function test_delete()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $profile = factory(Profile::class)->create();

        $response = $this->json('DELETE',"/api/profiles/$profile->id",[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        //without content
        $response->assertSee(null)
                ->AssertStatus(204);

        $this->AssertDatabaseMissing('profiles',['id' => $profile->id]);
    }

    /**
     * Feature test to display a listing of the profiles
     *
     * @return void
     */
    public function test_index()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        factory(Profile::class,5)->create();

        $response = $this->json('GET','/api/profiles',[],
        ['Authorization' => 'Bearer '.\JWTAuth::fromUser($user)]);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id','name']
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

        $this->json('GET',    '/api/profiles')->assertStatus(401);
        $this->json('POST',   '/api/profiles')->assertStatus(401);
        //$this->json('GET',    '/api/profiles/1')->assertStatus(401);
        //$this->json('PUT',    '/api/profiles/1')->assertStatus(401);
        //$this->json('DELETE', '/api/profiles/1')->assertStatus(401);

    }

}
