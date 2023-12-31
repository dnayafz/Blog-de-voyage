<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Test for getAllCategories method
    public function test_can_get_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status', 'categories'
                 ]);
    }

    // Test for getSingleCategory method
    public function test_can_get_single_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson('/api/category/'.$category->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'category' => $category->toArray()
                 ]);
    }

    // Test for createCategory method
    public function test_can_create_category()
    {
        $categoryData = [
            'title' => 'New Category'
        ];

        $response = $this->postJson('/api/category/create', $categoryData);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => true,
                     'message' => 'Category Created Successfully'
                 ]);
    }

    // Test for updateCategory method
    public function test_can_update_category()
    {
        $category = Category::factory()->create();
        $updateData = ['title' => 'Updated Category'];

        $response = $this->postJson('/api/category/update/'.$category->id, $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => true,
                     'message' => 'Category Updated Successfully'
                 ]);
    }

    // Test for deleteSingleCategory method
    public function test_can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson('/api/category/'.$category->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Category deleted Successfully'
                 ]);
    }
}