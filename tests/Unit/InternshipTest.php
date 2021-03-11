<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class InternshipTest extends TestCase
{
    public function testSeeInternshipPage()
    {
        $response = $this->get('/internships/apply');
        $response->assertStatus(200);
    }

    public function testFailSubmitInternshipPage()
    {
        $response = $this->post('/api/internships/apply', []);
        $response->assertStatus(302);
    }

    public function testSubmitInternshipPage()
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('file.pdf');

        $data = array(
            'interest' => 'test',
            'question_1' => 'test',
            'question_2' => 'test',
            'question_3' => 'test',
            'file' => $file,
        );
        $response = $this->post('/api/internships/apply', $data);
        $response->assertStatus(200);
    }

}
