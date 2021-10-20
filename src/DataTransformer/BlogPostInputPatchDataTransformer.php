<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\BlogPostInputPatch;
use App\Entity\BlogPost;

class BlogPostInputPatchDataTransformer implements DataTransformerInterface
{
    public function transform($object, string $to, array $context = []): BlogPost
    {
        $blogPost = $context['object_to_populate'];

        if ($object->content) {
            $blogPost->setContent($object->content);
        }

        return $blogPost;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return (
            ($context['operation_type'] === 'item') &&
            ($context['item_operation_name'] === 'patch') &&
            ($context['input']['class'] === BlogPostInputPatch::class) &&
            ($to === BlogPost::class)
        ); 
    }
}
