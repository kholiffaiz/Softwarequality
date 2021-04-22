<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;

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
    public function user_can_post_comment_on_a_tweet()
    {
        
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $tweet = Tweet::factory()->create();
            $browser->LoginAs($user)
                    ->visit( url: '/tweet/' . $tweet->id)
                    ->type( field: 'content', value: 'Komentar pada tweet')
                    ->press( button: 'REPLY')
                    ->assertSee(text: 'Komentar pada tweet');
    });
    }

    /**
     * @test
     * @group tweet-comment
     */
    public function user_can_not_post_comment_on_a_tweet()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $tweet = Tweet::factory()->create();
            $browser->LoginAs($user)
                    ->visit( url: '/tweet/' . $tweet->id)
                    ->type( field: 'content', value: '')
                    ->press( button: 'REPLY')
                    ->assertSee(text: 'The content field is required');
    });
    }

    /**
     * @test
     * @group tweet-comment
     */
    public function user_can_not_post_blank_comment()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $tweet = Tweet::factory()->create();
            $browser->LoginAs($user)
                    ->visit( url: '/tweet/' . $tweet->id)
                    ->press( button: 'REPLY');

            $browser->assertPathIs('/tweet/' . $tweet->id)
                    ->assertSee(text: 'The content field is required');
    });
    }

    /**
     * @test
     * @group tweet-comment
     */
    public function user_can_delete_their_comment()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $tweet = Tweet::factory()->create([
                'user_id' => $user->id
            ]);
            $comment = Comment::factory()->create([
                'user_id' => $user->id,
                'tweet_id' => $tweet->id
            ]);
            $browser->LoginAs($user)
                    ->visit( url: '/tweet/' . $tweet->id)
                    ->click( '#delete-comment-' . $comment->id);

            $browser->assertPathIs('/tweet/' . $tweet->id)
                    ->assertDontSee($comment->content);
    });
    }   

     /**
     * @test
     * @group tweet-comment
     */
    public function user_can_view_tweet_detail()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->create();
            $tweet = Tweet::factory()->create([
                'user_id' => $user->id
            ]);
            $browser->LoginAs($user)
                    ->visit( url: '/tweet/' . $tweet->id);

            $browser->assertSee($tweet->content);
    });
    }

}
