<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\BlogPostOutputCollection;
use App\Entity\BlogPost;

class BlogPostOutputCollectionDataTransformer implements DataTransformerInterface
{
    private const WORDS_COUNT = 10;

    public function transform($object, string $to, array $context = []): BlogPostOutputCollection
    {
        $blogPostOutput = new BlogPostOutputCollection();

        $blogPostContentWords = explode(' ', $object->getContent());

        $blogPostContentFirstWords = (count($blogPostContentWords) > self::WORDS_COUNT) ?
            array_slice($blogPostContentWords, 0, self::WORDS_COUNT):
            $blogPostContentWords;

        $blogPostOutput->title = $object->getTitle();
        $blogPostOutput->content = implode(
            ' ',
            $blogPostContentFirstWords
        );
        $blogPostOutput->createdAt = $object->getCreatedAt();
        $blogPostOutput->viewsCount = $object->getViewsCount();

        return $blogPostOutput;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return ($data instanceof BlogPost) && ($to === BlogPostOutputCollection::class);
    }
}
