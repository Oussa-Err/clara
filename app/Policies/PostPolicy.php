<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function modify(User $user, Post $post)
    {
        return $user->id === $post->user_id; // only the owner can modify
    }
}
