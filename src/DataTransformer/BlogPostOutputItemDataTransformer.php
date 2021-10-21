<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\BlogPostOutputItem;
use App\Entity\BlogPost;

class BlogPostOutputItemDataTransformer implements DataTransformerInterface
{
    public function transform($object, string $to, array $context = []): BlogPostOutputItem
    {
        $blogPostOutputCollection = new BlogPostOutputItem();

        $blogPostOutputCollection->title = $object->getTitle();
        $blogPostOutputCollection->content = $object->getContent();
        $blogPostOutputCollection->comments = $object->getComments()->toArray();
        $blogPostOutputCollection->viewsCount = $object->getViewsCount();
        
        return $blogPostOutputCollection;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ($data instanceof BlogPost) && ($to === BlogPostOutputItem::class);
    }
}
