<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    // Test for createMedia method
    public function test_can_create_media()
    {
        $response = $this->postJson('/api/media/create', [
            'attachment' => UploadedFile::fake()->image('media.jpg'),
            'id_post' => 1 // Adjust as needed
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => true,
                     'message' => 'Media Created Successfully'
                 ]);
    }

    // Test for getSingleMedia method
    public function test_can_get_single_media()
    {
        $media = Media::factory()->create();

        $response = $this->getJson('/api/media/'.$media->id_post);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'media' => $media->toArray()
                 ]);
    }

    // Test for updateMedia method
    public function test_can_update_media()
    {
        $media = Media::factory()->create();

        $response = $this->postJson('/api/media/update/'.$media->id_post, [
            'attachment' => UploadedFile::fake()->image('new_media.jpg'),
            'id_post' => $media->id_post
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'status' => true,
                     'message' => 'Media Updated Successfully'
                 ]);
    }

    // Test for deleteSingleMedia method
    public function test_can_delete_media()
    {
        $media = Media::factory()->create();

        $response = $this->deleteJson('/api/media/'.$media->id_post);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => true,
                     'message' => 'Media deleted Successfully'
                 ]);
    }
}