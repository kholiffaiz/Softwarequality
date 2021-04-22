<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TweetTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     * @group tweet
     */
    public function guest_user_visit_tweet_page_should_redirect_to_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tweet')
                    ->assertRouteIs('login')
                    ->assertSee('LOG IN');
    });
    }
}
