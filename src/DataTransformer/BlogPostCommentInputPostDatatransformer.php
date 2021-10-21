<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\BlogPostCommentInputPost;
use App\Entity\BlogPostComment;
use App\Repository\BlogPostRepository;

class BlogPostCommentInputPostDatatransformer implements DataTransformerInterface
{
    private BlogPostRepository $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function transform($object, string $to, array $context = []): BlogPostComment
    {
        $comment = new BlogPostComment();

        $comment
            ->setContent($object->content)
            ->setBlogPost($this->blogPostRepository->find($object->postId));
        
        return $comment;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return (
            ($context['operation_type'] === 'collection') &&
            ($context['collection_operation_name'] === 'post') &&
            ($context['input']['class'] === BlogPostCommentInputPost::class) && 
            ($to === BlogPostComment::class)
        );
    }
}
