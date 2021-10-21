<?php

declare(strict_types=1);

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\BlogPost;

class ShowNotReviewedBlogPostsExtension implements QueryCollectionExtensionInterface
{
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        ?string $operationName = null
    ): void {
        if($this->isNeddedToExtend($resourceClass, $operationName))
        {
            $this->extend($queryBuilder);
        }
    }

    private function isNeddedToExtend(string $resourceClass, ?string $operationName = null): bool {
        return (
            ($operationName === 'get_not_reviewed') &&
            ($resourceClass === BlogPost::class)
        );
    }

    private function extend(QueryBuilder $queryBuilder): void 
    {
        $rootAlias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->andWhere($rootAlias . '.onReview = true');
    }
}
