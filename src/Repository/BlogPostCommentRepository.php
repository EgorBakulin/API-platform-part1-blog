<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BlogPostComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogPostComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPostComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPostComment[]    findAll()
 * @method BlogPostComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPostComment::class);
    }
}
