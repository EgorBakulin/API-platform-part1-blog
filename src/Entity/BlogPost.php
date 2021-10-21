<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\BlogPostInputPatch;
use App\Dto\BlogPostInputPost;
use App\Dto\BlogPostOutputCollection;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'output' => BlogPostOutputCollection::class,
        ],
        'post' => [
            'input' => BlogPostInputPost::class,
            'output' => false,
        ]
    ],
    itemOperations: [
        'get',
        'patch' => [
            'input' => BlogPostInputPatch::class,
            'output' => false,
        ], 
        'delete' => [
            'output' => false,
        ]
    ],
)]
class BlogPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $onReview;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getOnReview(): ?bool
    {
        return $this->onReview;
    }

    public function setOnReview(bool $onReview): self
    {
        $this->onReview = $onReview;

        return $this;
    }
}
