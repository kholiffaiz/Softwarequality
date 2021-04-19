<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function post_can_delete_by_admin()
    {
        $post = new Post();
        $user = new User();

        $user->setIsAdmin(true);
        $result = $post->deletedBy($user);

        $this->assertTrue($result);
    }

    /** @test */
    public function post_can_deleted_by_same_user()
    {
        $post = new Post();
        $user = new User();

        $post->setCreatedBy($user);
        $result = $post->deletedBy($user);

        $this->assertTrue($result);
    }

    /** @test */
    public function post_cannot_deleted_by_another_user()
    {
        $post = new Post();
        $amirul = new User();
        $ihsan = new User();
        $amirul->setName('amirul');
        $ihsan->setName('ihsan');

        $post->setCreatedBy($amirul);
        $result = $post->deletedBy($ihsan);

        $this->assertFalse($result);
    }
}
