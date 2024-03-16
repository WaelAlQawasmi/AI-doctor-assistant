<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserManegmentTest extends TestCase
{
    /**
     * The authenticated user for testing.
     *
     * @var \App\Models\User
     */
    protected $testingUser;
    /**
     * The Admin being used for testing.
     *
     * @var \App\Models\User
     */
    protected $adminUser;

    /**
     * Set up the test environment.
     *
     * This method runs before each test method.
     */
    public function setUp(): void
    {
        parent::setUp();
        // Retrieve an authenticated user with admin privileges
        $this->adminUser = User::where('email', 'admin@infinta-jo.com')->first();
        Sanctum::actingAs($this->adminUser);
        $this->testingUser=  User::where('email', 'testuser20@mail.com')->first();
    }

    /**
     * test activat user
     */
 
    public function test_activate_user(){
        $response = $this->postJson('/api/auth/activate', [
            'id' =>  $this->testingUser->id ,
        ]);

        $response->assertStatus(200);
    }

      /**
     * test deactivat user
     */
 
    public function test_deactivate_user(){
        $response = $this->postJson('/api/auth/deactivate', [
            'id' =>  $this->testingUser->id ,
        ]);
        $response->assertStatus(200);
    }


}
