<?php

declare(strict_types=1);

namespace App\Dto;

class BlogPostCommentInputPost
{
    public string $content;

    public int $postId;
}
