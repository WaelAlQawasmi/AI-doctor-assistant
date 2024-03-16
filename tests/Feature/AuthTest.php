<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
   
      /**
     * test register  user.
     */
    public function test_register(){ 
        $response = $this->post('/api/auth/signup', [
            'email' =>'x@mail.com',
            'password' => 'password',
            'name'=>'John Doe',
            'phone'=>'0795788479'
        ]);
        User::where('email','x@mail.com')->first()->delete();
        $response->assertStatus(201);
    }

     /**
     * test login  user with valid credentials.
     */
    public function test_login_with_correct_credentials()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'admin@infinta-jo.com',
            'password' => 'infinta2023',
        ]);
        $response->assertStatus(200);
        $this->assertAuthenticated(); 
    } 

      /**
     *  test login with  invalid password.
     */
    public function test_login_with_incorrect_credentials()
    {
       
        $response = $this->post('/api/auth/login', [
            'email' => "email@mail.com",
            'password' => 'passwo25rd',
        ]);

        $response->assertStatus(401);
    } 
    /**
     *  test login  invalid email field.
     */
    public function test_login_with_validation_errors()
    {
        $response = $this->post('/api/auth/login', [
            'email' => "emailmail.com",
            'password' => 'password',
        ]);
        $this->assertEquals("validation error", $response['message']); 
    }

}
