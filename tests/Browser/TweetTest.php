<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TweetTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
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

    /**
     * @test
     * @group tweet-comment
     */
    public function user_can_not_post_comment_on_a_tweet()
    {
        $this->browse(function (Browser $browser) {
            $browser->LoginAs($this->user)
                    ->visit( url: '/tweet/' . $this->tweet->id)
                    ->type( field: 'content', value: '')
                    ->press( button: 'REPLY')
                    ->assertSee(text: 'The content field is required');
    });
    }

    /**
     * @test
     * @group tweet-comment
     */
    public function user_can_post_comment_on_a_tweet()
    {
        $this->browse(function (Browser $browser) {
            $browser->LoginAs($this->user)
                    ->visit( url: '/tweet/' . $this->tweet->id)
                    ->type( field: 'content', value: 'Komentar pada tweet')
                    ->press( button: 'REPLY')
                    ->assertSee(text: 'Komentar pada tweet');
    });
    }

}
