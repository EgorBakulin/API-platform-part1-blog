<?php

declare(strict_types=1);

namespace App\Dto;

class BlogPostOutputItem
{
    public string $title;

    public string $content;

    public int $viewsCount;

    public array $comments;
}
