<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @test
     */
    public function aUserCanLoggedInToDashboard()
    {
        $this->browse(function (Browser $browser) use ($admin) {
             $browser->visit('/register')
                ->type('email', 'kholif.faiz@gmail.com')
                ->type('password', '12345678')
                ->press('Register')
                ->pause(500)
                ->assertPathIs('/dashboard')
            ;
        });
    }
}
