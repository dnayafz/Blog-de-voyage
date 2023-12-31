<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Test for getAllPosts method
    public function test_can_get_all_posts()
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts/all'); // Adjust the URL as needed

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status', 'posts'
                 ]);
    }

    // Test for getSinglePost method
    public function test_can_get_single_post()
    {
        $post = Post::factory()->create();

        $response = $this->getJson('/api/post/'.$post->id); // Adjust the URL as needed

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'post' => $post->toArray()
                 ]);
    }

    // Test for createPost method
    public function test_can_create_post()
    {
        $postData = [
            'title' => 'Test Post',
            'body' => 'This is a test post body.',
            'id_user' => 1, 
            'id_category' => 1, // Adjust as needed
            'status' => 1 // Adjust as needed
        ];

        $response = $this->postJson('/api/post/create', $postData); // Adjust the URL as needed

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => true,
                     'message' => 'Post Created Successfully'
                 ]);
    }

    // Test for updatePost method
    public function test_can_update_post()
    {
        $post = Post::factory()->create();
        $updateData = [
            'title' => 'Updated Title',
            'body' => 'Updated body.',
            'id_category' => 2, // Adjust as needed
            'status' => 0 // Adjust as needed
        ];

        $response = $this->postJson('/api/post/update/'.$post->id, $updateData); // Adjust the URL as needed

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => true,
                     'message' => 'Post Updated Successfully'
                 ]);
    }

    // Test for deleteSinglePost method
    public function test_can_delete_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson('/api/post/'.$post->id); // Adjust the URL as needed

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Post deleted Successfully'
                 ]);
    }

    // Test for getUserPosts method
    public function test_can_get_user_posts()
    {
        $posts = Post::factory()->count(2)->create(['id_user' => 1]);

        $response = $this->getJson('/api/posts/1'); // Adjust the URL as needed

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status', 'posts'
                 ]);
    }

    // Test for getCategoryPosts method
    public function test_can_get_category_posts()
    {
        $posts = Post::factory()->count(2)->create(['id_category' => 1]); // Adjust category ID as needed

        $response = $this->getJson('/api/posts/category/1'); // Adjust the URL and category ID as needed

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status', 'posts'
                 ]);
    }
}