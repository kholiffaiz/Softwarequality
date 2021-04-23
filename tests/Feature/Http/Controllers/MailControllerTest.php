<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestingMail;


class MailControllerTest extends TestCase
{
    /** @test */
    public function email_sent_successfully()
    {
        Mail::fake();
        $response = $this->get('/mail');
        Mail::assertSent(TestingMail::class);
    }
}
