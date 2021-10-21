<?php

declare(strict_types=1);

namespace App\Dto;

use DateTime;

class BlogPostOutputCollection
{
    public string $title;

    public string $content;

    public DateTime $createdAt;

    public int $viewsCount;
}
