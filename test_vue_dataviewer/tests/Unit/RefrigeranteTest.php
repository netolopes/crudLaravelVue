<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class RefrigeranteTest extends TestCase
{
 
    public function test_can_create_post() {
      
       
        $task = factory('App\Refrigerante')->create();
        $response = $this->get('/api/refrigerantes');
        $response->assertSee($task->title);
        $response->assertStatus(200);
        
    }

    public function test_can_update_post() {
       
     $task = factory('App\Refrigerante')->create();
     $task->marca = "Updated Title";
     $response = $this->put('/api/refrigerantes/'.$task->id, $task->toArray());
     $response->assertStatus(200);
    }
 
    public function test_can_show_post() {
        $post = factory('App\Refrigerante')->create();
        $this->get('/api/refrigerantes/'. $post->id)
            ->assertStatus(200);
    }
   
    public function test_can_delete_post() {
        $task = factory('App\Refrigerante')->create();
        $response = $this->delete('/api/refrigerantes/'.$task->id)
            ->assertStatus(200);
    }

    
    public function test_can_list_posts() {
        $post = factory('App\Refrigerante')->create();
        $this->get('/api/refrigerantes')
            ->assertStatus(200);
    }

}