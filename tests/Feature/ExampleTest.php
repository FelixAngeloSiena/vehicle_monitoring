<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/auth/dashboard');
        $response->assertStatus(200);
    }

    public function admin_dashboard(){
        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200); 
    }

}
