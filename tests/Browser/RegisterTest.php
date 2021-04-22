<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function user_can_register()
    {
    $this->browse(function (Browser $browser) {
    $browser->visit('/register')
    ->type('name', 'amirul')
    ->type('email', 'amirul@kawankoding.com')
    ->type('password', '12345678')
    ->type('password_confirmation', '12345678')
    ->press('REGISTER')
    ->pause(500)
    ->assertPathIs('/tweet')
    ;
    });
    }
}
