<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\BlogPostInputPost;
use App\Entity\BlogPost;
use DateTime;

class BlogPostInputPostDataTransformer implements DataTransformerInterface
{

    public function transform($object, string $to, array $context = []): BlogPost
    {
        $blogPost = new BlogPost();

        $blogPost
            ->setCreatedAt(new DateTime())
            ->setTitle($object->title)
            ->setContent($object->content)
            ->setOnReview(true)
            ->setViewsCount(0);
    
        return $blogPost;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return (
            ($context['operation_type'] === 'collection') &&
            ($context['collection_operation_name'] === 'post') &&
            ($context['input']['class'] === BlogPostInputPost::class) && 
            ($to === BlogPost::class)
        );
    }
}
