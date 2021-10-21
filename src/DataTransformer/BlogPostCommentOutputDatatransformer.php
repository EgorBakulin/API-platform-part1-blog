<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\BlogPostComment;
use App\Dto\BlogPostCommentOutput;

class BlogPostCommentOutputDatatransformer implements DataTransformerInterface
{
    public function transform($object, string $to, array $context = []): BlogPostCommentOutput
    {
        $blogPostCommentOutput = new BlogPostCommentOutput();

        $blogPostCommentOutput->content = $object->getContent();
        
        return $blogPostCommentOutput;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ($data instanceof BlogPostComment) && ($to === BlogPostCommentOutput::class);
    }
}
