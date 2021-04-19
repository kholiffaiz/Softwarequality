<?php

namespace App\Models;

class Post
{
    public $createdBy;

    public function setCreatedBy(User $user)
    {
        $this->createdBy = $user->name;
    }

    public function deletedBy(User $user)
    {
        return $user->isAdmin || $this->createdBy === $user->name;
    }
}
