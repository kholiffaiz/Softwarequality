<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @group login
     */
    public function user_can_login_and_redirect_to_tweet_page()
    {
        $this->browse(function (Browser $browser) {
            // syaratnya di db harus ada data user
            $user = User::factory()->create();
            $browser->visit('/login')
            ->type('email', $user->email)
            ->type('password', 'password')
            ->press('LOG IN')
            ->assertPathIs('/tweet');

        });
    }
}
