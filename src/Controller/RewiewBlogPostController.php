<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class RewiewBlogPostController
{
    private BlogPostRepository $repository;

    public function __construct(BlogPostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(BlogPost $data): BlogPost
    {
        return $this->repository->review($data);
    }

}
