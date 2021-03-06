<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileTest extends TestCase
{
    public function testSeeCreatePage()
    {
        $user = \App\User::firstOrFail();
        $response = $this->actingAs($user)->get('/files/create');
        $response->assertStatus(200);
    }

    public function testNotSeeCreatePage()
    {
        $response = $this->get('/files/create');
        $response->assertRedirect('/login');
    }

    public function testSeeSingleFilePage()
    {
        $user = \App\User::with('files')->firstOrFail();
        $response = $this->actingAs($user)->get('/files/' . $user->files->first()->id);
        $response->assertStatus(200);
    }

    public function testNotSeeSingleFilePageWhenUnauthenticated()
    {
        $file = \App\File::firstOrFail();

        $response = $this->get('/files/' . $file->id);
        $response->assertRedirect('/login');

        $response_api = $this->getJson('/api/files/' . $file->id);
        $response_api->assertStatus(401);
    }

    public function testCreateFile()
    {
        $user = \App\User::with('files')->firstOrFail();

        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.pdf');

        $data = array(
            'title' => 'Test title',
            'file' => $file,
            'public' => false,
        );

        $response = $this->actingAs($user, 'api')->post('/api/files', $data);
        $response->assertStatus(201);
    }

}
