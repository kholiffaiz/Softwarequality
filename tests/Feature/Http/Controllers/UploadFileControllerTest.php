<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class UploadFileControllerTest extends TestCase
{
    /**
    * @test
    */
    public function uploaded_file_stored_in_right_path()
    {
        Storage::fake();
        $response = $this->post('/upload', [
            'file' => UploadedFile::fake()->image('photo1.jpg'),
        ]);

        Storage::assertExists($response->original);
    }
}
