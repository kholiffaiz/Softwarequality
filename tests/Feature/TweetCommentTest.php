<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TweetCommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;
    private $tweet;
    private $comment;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();

        $this->user = User::factory()->create();
        $this->tweet = Tweet::factory()->create([
            'user_id' => $this->user->id,
        ]);
        $this->comment = Comment::factory()->create([
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id
        ]);
    }


    /** @test */
    public function guest_cannot_add_comment()
    {
        $response = $this->post('tweet/' . $this->tweet->id . '/comment', [
            'content' => $this->faker->paragraph
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function user_can_add_comment()
    {
        $this->actingAs($this->user);
        $this->from('/tweet/' . $this->tweet->id);

        $response = $this->post('tweet/' . $this->tweet->id . '/comment', [
            'content' => $content = $this->faker->paragraph()
        ]);

        $this->assertDatabaseHas('comments', [
            'content' => $content
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tweet/' . $this->tweet->id);

    }

    /** @test */
    public function user_cannot_add_comment_without_content()
    {
        $this->actingAs($this->user);

        $response = $this->post('tweet/' . $this->tweet->id . '/comment', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'content'
        ]);
    }


    /** @test */
    public function user_can_edit_comment()
    {
        $this->actingAs($this->user);
        $this->from('/tweet/' . $this->tweet->id);

        $response = $this->put('/tweet/' . $this->tweet->id . '/comment/' . $this->comment->id, [
            'content' => $newComment = $this->faker->paragraph()
        ]);

        $this->assertDatabaseMissing('comments', [
            'id' => $this->comment->id,
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id,
            'content' => $this->comment->content
        ]);

        $this->assertDatabaseHas('comments', [
            'id' => $this->comment->id,
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id,
            'content' => $newComment
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tweet/' . $this->tweet->id);
    }

    /** @test */
    public function user_cannot_edit_comment_without_content()
    {
        $this->actingAs($this->user);
        $this->from('/tweet/' . $this->tweet->id . '/comment/' . $this->comment->id . '/edit');

        $response = $this->put('tweet/' . $this->tweet->id . '/comment/' . $this->comment->id, []);

        $response->assertStatus(302);
        $response->assertRedirect('/tweet/' . $this->tweet->id . '/comment/' . $this->comment->id . '/edit');
        $response->assertSessionHasErrors([
            'content'
        ]);

    }

    /** @test */
    public function user_cannot_edit_other_user_comment()
    {
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser);
        $response = $this->put('/tweet/' . $this->tweet->id . '/comment/' . $this->comment->id, [
            'content' => $newComment = $this->faker->paragraph()
        ]);

        $this->assertDatabaseMissing('comments', [
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id,
            'content' => $newComment
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id,
            'content' => $this->comment->content
        ]);

        $response->assertStatus(403);

    }


    /** @test */
    public function user_can_delete_comment()
    {
        $this->actingAs($this->user);
        $this->from('/tweet/' . $this->tweet->id);

        $response = $this->delete('/tweet/' . $this->tweet->id . '/comment/' . $this->comment->id);

        $this->assertDatabaseMissing('comments', [
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id,
            'content' => $this->comment->content
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tweet/' . $this->tweet->id);
    }

    /** @test */
    public function user_cannot_delete_other_user_comment()
    {
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser);
        $response = $this->delete('/tweet/' . $this->tweet->id . '/comment/' . $this->comment->id);

        $this->assertDatabaseHas('comments', [
            'user_id' => $this->user->id,
            'tweet_id' => $this->tweet->id,
            'content' => $this->comment->content
        ]);

        $response->assertStatus(403);
    }


    /** @test */
    public function post_owner_can_delete_comment()
    {
        $otherUser = User::factory()->create();
        $otherUserComment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'tweet_id' => $this->tweet->id,
            'content' => $this->faker->paragraph()
        ]);

        $this->actingAs($this->user);

        $response = $this->delete('/tweet/' . $this->tweet->id . '/comment/' . $otherUserComment->id);

        $this->assertDatabaseMissing('comments', [
            'user_id' => $otherUserComment->user_id,
            'tweet_id' => $otherUserComment->tweet_id,
            'content' => $otherUserComment->content
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/tweet/' . $this->tweet->id);

    }

    /** @test */
    public function user_cannot_delete_comment_on_other_user_tweet()
    {
        $otherUser = User::factory()->create();
        $otherTweet = Tweet::factory()->create([
            'user_id' => $otherUser->id
        ]);
        $otherCommentOnOtherTweet = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'tweet_id' => $otherTweet->id,
            'content' => $otherContent = $this->faker->paragraph()
        ]);

        $this->actingAs($this->user);
        $response = $this->delete('/tweet/' . $otherTweet->id . '/comment/' . $otherCommentOnOtherTweet->id);

        $this->assertDatabaseHas('comments', [
            'user_id' => $otherCommentOnOtherTweet->user_id,
            'tweet_id' => $otherCommentOnOtherTweet->tweet_id,
            'content' => $otherContent
        ]);

        $response->assertStatus(403);

    }

}
